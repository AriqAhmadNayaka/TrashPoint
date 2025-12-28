@extends('layouts.app')

@section('title', 'Admin Dashboard Monitoring')

@section('content')
@php
    use App\Models\HistoryTakeOutTrash;
    use App\Models\Masyarakat;
    use App\Models\Trash;
    use App\Models\HistoryVoucher;
    use App\Models\User;
    use App\Models\Petugas;
    use App\Models\Admin;
    use App\Models\TrashSchedule;
    
@endphp
<div class="flex flex-row gap-4 mb-5">
    <div class="col-md-8 w-7/12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-map-marker-alt me-2"></i> Peta Lokasi & Status Real-time</div>
                <div class="card-body">
                    <div style="height: 400px; background-color: #f8f9fa; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center;">
                        @php
                        $dataTempatSampah = Trash::where('status', 'full')->get()->toArray();
                        // dd($dataTempatSampah);
                        @endphp
                        <div id="map" class="w-full h-96 rounded-md mt-4"></div>
                        <script>
        var map = L.map('map').setView([-6.234, 106.979], 13); // Koordinat pusat Bekasi
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            zoomControl: false,
        }).addTo(map);

        var locations = [
            <?php 
            foreach ($dataTempatSampah as $row) { ?> {
                    idTrash: <?= $row["idTrash"] ?>,
                    province: "<?= $row["province"] ?>",
                    city: "<?= $row["city"] ?>",
                    roadAddress: "<?= $row["roadAddress"] ?>",
                    lat: <?= $row["latitude"] ?>,
                    lon: <?= $row["longitude"] ?>,
                    name: "<?= $row["city"] . ", " . $row["roadAddress"] ?>",
                    status: "<?= $row["status"] ?>"
                },
            <?php } ?>
        ];

        locations.forEach(function(location) {

            var marker = L.marker([location.lat, location.lon]).addTo(map);
            marker.on('click', function() {
                Swal.fire({
                    title: "Tempat Sampah",
                    text: "Alamat: " + location.province + ", " + location.city + ", " + location.roadAddress,
                });
            });

        });

        document.querySelector('.leaflet-control-zoom').remove();
        document.querySelector('.leaflet-control-attribution').remove();
    </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 w-4/12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-newspaper me-2"></i> History buang sampah</div>
                <div class="card-body h-[430px] overflow-y-scroll">
                    <div class="flex flex-col w-full mt-5 gap-2">
            <input type="hidden" name="idAdmin" id="idAdmin" value="{{ \App\Models\Admin::where('idUser', Auth::user()->idUser)->first()->idAdmin }}">
            <select name="idPetugas" class="form-select" id="">
                <option value="" disabled selected>Pilih Petugas</option>
                @foreach (\App\Models\Petugas::all() as $petugas)
                    <option class="text-black" value="{{ $petugas->idPetugas }}">{{ User::find($petugas->idUser)->username }}</option>
                @endforeach
            </select>
            <p>Pilih Tempat sampah</p>
                            <div class="flex border rounded border-zinc-700 flex-col w-full gap-2 overflow-y-scroll hideScrollbar h-36 ">
                                @php 
                                $tempatSampahData = Trash::where('status', 'full')->get()->toArray();
                                    @endphp
                                    @foreach ($tempatSampahData as $row) 
                                        <div class="flex flex-row items-center">
                                            <input type="checkbox" id="<?= $row['idTrash'] ?>" name="idTrash[]" value="<?= $row['idTrash'] ?>" class="border border-gray-300 rounded-md p-2 mx-5 outline-none" placeholder="Id Petugas">
                                            <label for="<?= $row['idTrash'] ?>"><?= $row['city'] . " " . $row["roadAddress"] ?></label>
                                        </div>
                                    @endforeach
                            </div>
            <input type="datetime-local" name="scheduleDateTime" class="border border-gray-300 rounded-md p-2 w-full outline-none">
            <button onclick="buatSchedule()" type="submit" name="submitEditTempatsampah" value="" class="bg-zinc-700 textWhite rounded text-white p-2 w-full">Tambah</button>
            <script>
                function buatSchedule() {
                    console.log("tambahTempatSampah dijalankan");
                    const idAdmin = document.getElementById('idAdmin').value;
                    const idPetugas = document.querySelector('select[name="idPetugas"]').value;
                    const scheduleDateTime = document.querySelector('input[name="scheduleDateTime"]').value;
                    const checkboxes = document.querySelectorAll('input[name="idTrash[]"]:checked');

                    Swal.fire(({
                        title: 'Yakin menambahkan jadwal pengangkutan sampah?',
                    })).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/api/trash-schedule/create-trash-schedule', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    idAdmin: idAdmin,
                                    idPetugas: idPetugas,
                                    scheduleDateTime: scheduleDateTime
                                    
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                
                                    // PERBAIKAN 1: Gunakan forEach (JavaScript) bukan foreach (PHP)
                                    checkboxes.forEach(function(checkbox) {
                                        // PERBAIKAN 2: Pindahkan kurung tutup fetch ke akhir objek konfigurasi
                                        fetch('/api/trash-schedule/add-detail-trash-schedule', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                idTrashSchedule: data.idTrashSchedule,
                                                idTrash: checkbox.value
                                            })
                                        });
                                    });
                                    
                                    Swal.fire('Berhasil!', 'Jadwal berhasil ditambahkan.', 'success', ).then(() => {
                                        location.reload();
                                    });
                                
                            });
                        }
                    });
                    
                }
            </script>
        </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card shadow-sm border-0 mb-5 bg-white">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-4 px-4 border-bottom">
            <div>
                <h5 class="fw-bold mb-0 text-success"><i class="fas fa-coins me-2"></i>Manajemen Jadwal</h5>
                <small class="text-muted">Kelola data jadwal pengangkutan sampah</small>
            </div>
        </div>
        
        <div class="table-responsive px-4 py-2">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted small">
                        <th class="border-0">PETUGAS</th>
                        <th class="border-0">PEMBERI TUGAS</th>
                        <th class="border-0">STATUS</th>
                        <th class="border-0">JADWAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(TrashSchedule::get() as $TrashSchedule)
                    <tr class="hover-row">
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success-subtle text-success fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                                    {{ substr(User::find(Petugas::find($TrashSchedule->idPetugas)->idUser)->username, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ User::find(Petugas::find($TrashSchedule->idPetugas)->idUser)->username }}</div>
                                    <div class="small text-muted">{{ User::find(Petugas::find($TrashSchedule->idPetugas)->idUser)->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <span class="">{{ User::find(Admin::find($TrashSchedule->idAdmin)->idUser)->username }}</span>
                            {{-- <div class="small text-muted">POIN TERAKHIR</div> --}}
                        </td>
                        <td>
                            @if ($TrashSchedule->status == 'scheduled')
                            <span class="badge bg-light text-warning border border-warning px-3">{{ $TrashSchedule->status }}</span>
                            @elseif ($TrashSchedule->status == 'completed')
                            <span class="badge bg-light text-success border border-success px-3">{{ $TrashSchedule->status }}</span>
                            @endif
                            </td>
                        <td class="">
                            <span class="">{{ $TrashSchedule->scheduleDateTime }}</span>
                            {{-- <div class="small text-muted">POIN TERAKHIR</div> --}}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                
                                {{-- <button onclick="OpenModalTempatSampahTambah{{$user->idUser}}()" class="btn btn-sm btn-outline-primary border-0 hover-scale"><i class="fas fa-edit"></i></button> --}}
                                {{-- <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')"> --}}
                                    {{-- @csrf @method('DELETE') --}}
                                {{-- </form> --}}
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
                
            
            </table>
        </div>
    </div>

@push('scripts')

@endpush
@endsection