
@extends('layouts.app')

@section('title', 'Tugas Petugas')

@section('content')
@php
    use App\Models\TrashSchedule;

    $schedules = TrashSchedule::where('idPetugas', App\Models\Petugas::where('idUser', Auth::id())->first()->idPetugas)
                        ->where('status', '!=', 'completed')
                        ->orderBy('scheduleDateTime', 'desc')
                        ->with(['detailTrashSchedules' => function($query) {
                            $query->whereHas('trash', function($q) {
                                $q->where('status', '!=', 'empty');
                            })->with('trash');
                        }, 'petugas.user', 'admin.user'])
                        ->get();
@endphp
<div class="w-full flex flex-col px-5 mt-5">
    <h1>Tugas</h1>
    <hr>
    <div class="w-full flex flex-col gap-2 rounded mt-2 overflow-y-scroll h-max max-h-96">
        @if($schedules->isEmpty())
            <div class='w-full flex flex-col p-2'>
                <h1 class='text-lg font-bold'>Tidak ada tugas</h1>
            </div>
        @else
            @foreach($schedules as $schedule)
                <div class="w-full flex flex-col justify-between p-2 border h-max border-zinc-700 rounded">
                    {{-- Tampilkan Peta hanya jika status bukan 'assigned' atau 'need accept' --}}
                    @if($schedule->status != 'assigned' && $schedule->status != 'need accept')
                        <div id="map{{ $schedule->idTrashSchedule }}" class="mb-3 w-full h-56 rounded-md border border-zinc-700"></div>
                        
                        {{-- Data Lokasi untuk JS --}}
                        @php
                            $locations = $schedule->detailTrashSchedules->map(function($detail) {
                                return [
                                    'idTempatSampah' => $detail->trash->idTrash,
                                    'lat' => $detail->trash->latitude,
                                    'lon' => $detail->trash->longitude,
                                    'name' => $detail->trash->city . ", " . $detail->trash->roadAddress,
                                    'status' => $detail->trash->status
                                ];
                            });
                        @endphp

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                initMap({{ $schedule->idTrashSchedule }}, @json($locations));
                            });
                        </script>
                    @endif

                    <div class="w-full flex flex-row justify-between">
                        <div>
                            <p class="text-sm">Petugas: {{ $schedule->petugas->user->username ?? '-' }}</p>
                            <p class="text-sm">Pemberi tugas: {{ App\Models\User::where('idUser', $schedule->admin->idUser ?? null)->value('username') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm">{{ $schedule->scheduleDateTime }}</p>
                            <p class="text-sm">Status: <span class="font-bold">{{ $schedule->status }}</span></p>
                        </div>
                    </div>

                    <div class="w-full flex gap-2 flex-col mt-2">
                        @if($schedule->status == 'scheduled' && $schedule->detailTrashSchedules->isEmpty())
                            {{-- <form action="{{ route('petugas.schedule.status', $schedule->idTrashSchedule) }}" method="POST"> --}}
                                @csrf
                                <button type="submit" onclick="selesai()" class="bg-green-500 text-white rounded p-2 w-full">Selesai</button>
                                <script>
                                    function selesai() {
                                        Swal.fire({
                                            title: 'Selesaikan Tugas',
                                            text: 'Apakah anda yakin ingin menyelesaikan tugas ini?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Ya',
                                            cancelButtonText: 'Tidak'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                fetch('/api/trash-schedule/complete-trash-schedule/{{ $schedule->idTrashSchedule }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({ status: 'complete' })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if(data.success) {
                                                        Swal.fire('Berhasil!', 'Tugas telah diselesaikan.', 'success')
                                                        .then(() => location.reload());
                                                    } else {
                                                        Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    Swal.fire('Gagal!', 'Terjadi kesalahan jaringan.', 'error');
                                                });
                                            }
                                        });
                                    }
                                </script>
                            {{-- </form> --}}
                        @elseif($schedule->status == 'on progress')
                            <form action="{{ route('petugas.schedule.status', $schedule->idTrashSchedule) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="need accept">
                                <button type="submit" class="bg-yellow-500 text-white rounded p-2 w-full">Selesaikan Tugas</button>
                            </form>
                        @elseif($schedule->status == 'need accept')
                            <p class="text-center mt-3 text-gray-500">Tunggu konfirmasi admin</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

{{-- Script Global untuk Peta --}}
<script>
    
    // Fungsi hitung jarak
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; 
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // Fungsi optimasi rute
    function optimizeRoute(locations) {
        if (locations.length < 2) return locations;
        let optimized = [];
        let unvisited = [...locations];
        let current = unvisited.shift();
        optimized.push(current);

        while (unvisited.length > 0) {
            let nearestIndex = 0;
            let nearestDistance = calculateDistance(current.lat, current.lon, unvisited[0].lat, unvisited[0].lon);

            for (let i = 1; i < unvisited.length; i++) {
                const distance = calculateDistance(current.lat, current.lon, unvisited[i].lat, unvisited[i].lon);
                if (distance < nearestDistance) {
                    nearestDistance = distance;
                    nearestIndex = i;
                }
            }
            current = unvisited.splice(nearestIndex, 1)[0];
            optimized.push(current);
        }
        return optimized;
    }

    // Fungsi inisialisasi peta per item
    function initMap(id, locations) {
        
        var map = L.map("map" + id).setView([-6.234, 106.979], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            zoomControl: false,
        }).addTo(map);

        var optimizedLocations = optimizeRoute(locations);
        var waypoints = optimizedLocations.map(function(location) {
            return L.latLng(location.lat, location.lon);
        });

        if (waypoints.length >= 2) {
            try {
                L.Routing.control({
                    waypoints: waypoints,
                    routeWhileDragging: false,
                    show: false,
                    lineOptions: { styles: [{ color: '#3b82f6', opacity: 0.7, weight: 5 }] },
                    addWaypoints: false,
                    draggableWaypoints: false,
                    fitSelectedRoutes: true,
                    createMarker: function(i, waypoint, n) {
                        if (i === 0 || i === waypoints.length - 1) {
                            return L.marker(waypoint.latLng, {
                                icon: L.divIcon({
                                    className: i === 0 ? 'start-marker' : 'end-marker',
                                    html: i === 0 ? '🟢 Start' : '🔴 End',
                                    iconSize: [60, 30]
                                })
                            });
                        }
                        return null;
                    }
                }).addTo(map);
            } catch (e) { console.error('Routing error:', e); }
        }

        optimizedLocations.forEach(function(location, index) {
            var marker = L.marker([location.lat, location.lon], {
                icon: L.divIcon({
                    className: 'trash-marker',
                    html: `<div style="background:#3b82f6;color:white;border-radius:50%;width:24px;height:24px;display:flex;align-items:center;justify-content:center">${index+1}</div>`,
                    iconSize: [24, 24]
                })
            }).addTo(map);

            marker.bindTooltip(`#${index+1}: ${location.name}`, { permanent: false, direction: 'top' });

            marker.on('click', function() {
                Swal.fire({
                    title: `Tempat Sampah #${index+1}`,
                    text: "Alamat: " + location.name,
                    confirmButtonText: 'Buang Sampah',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ambilSampah(location.idTempatSampah);
                    }
                });
            });
        });

        if (locations.length > 0) {
            var bounds = L.latLngBounds(locations.map(loc => [loc.lat, loc.lon]));
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    }

    function ambilSampah(id) {
        Swal.fire({
            title: 'Ambil Sampah',
            text: 'Apakah anda yakin ingin mengambil sampah?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/api/trash-schedule/clean-trash/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        Swal.fire('Berhasil!', 'Sampah telah diambil.', 'success')
                        .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan jaringan.', 'error');
                });
            }
        });
    }
    
</script>

<style>
    .start-marker,
    .end-marker {
        background: transparent;
        border: none;
    }

    .trash-marker {
        background: transparent;
        border: none;
    }

    .leaflet-routing-container {
        display: none;
    }
</style>
@endsection