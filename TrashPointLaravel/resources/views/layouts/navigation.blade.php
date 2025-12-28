<div class="w-[15%] h-screen bg-gray-100">
                    <div id="sidebar" class="sidebar">
                        <div class="p-4 fw-bold fs-4 d-flex align-items-center">
                            <i class="fas fa-trash-alt me-2"></i>TrashPoint
                        </div>
                        <div class="nav flex-column text-white">
                            @if (Auth::user()->role === 'masyarakat')
                            <a href="{{ route('Masyarakat.Homepage.Page') }}" class="{{ request()->routeIs('Masyarakat.Homepage.Page') ? 'active' : '' }}">
                                <i class="fas fa-chart-line me-2"></i>Dashboard
                            </a>
                            <a href="{{ route('Masyarakat.Laporan.Page') }}"><i class="fas fa-file-alt me-2"></i>Laporan</a>
                            {{-- <a href="{{ route('Masyarakat.Pengaturan.Page') }}"><i class="fas fa-cogs me-2"></i>Pengaturan</a> --}}
                            @endif
                            @if (Auth::user()->role === 'admin')
                            <a href="{{ route('Admin.Homepage.Page') }}" class="{{ request()->routeIs('Admin.Homepage.Page') ? 'active' : '' }}">
                                <i class="fas fa-chart-line me-2"></i>Dashboard
                            </a>
                            <a href="{{ route('Admin.Schedule.Page') }}"><i class="fas fa-cogs me-2"></i>Schedule</a>
                            @endif
                        </div>
                        <div class="mt-auto p-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-trashpoint-logout w-100 py-2">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>