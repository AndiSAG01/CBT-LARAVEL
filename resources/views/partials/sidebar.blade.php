  <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                   
                    @if (Auth()->user()->isAdmin == 1)
                    <li>
                        <a class="nav-item" href="{{ route('dashboard') }}">
                            <i class="fas fa-home menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('guru') }}">
                            <i class="fas fa-chalkboard-teacher"></i><span class="nav-text">Data Guru</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('siswa.index') }}">
                            <i class="fas fa-user-graduate"></i><span class="nav-text">Data Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('siswa.laporan') }}">
                            <i class="fas fa-clipboard-list"></i><span class="nav-text">Laporan Siswa</span>
                        </a>
                    </li>
                    @elseif (Auth()->user()->isAdmin == 0)
                    <li>
                        <a class="nav-item" href="{{ route('dashboard') }}">
                            <i class="fas fa-home menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('kategori.index') }}">
                            <i class="far fa-file-alt"></i><span class="nav-text">Manajeman Soal</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('CategoryExam.index') }}">
                            <i class="fas fa-user-edit"></i><span class="nav-text">Manajeman Peserta Ujian</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('ujian.hasil') }}">
                            <i class="fas fa-clipboard-list"></i><span class="nav-text">Hasil Ujian</span>
                        </a>
                    </li>
                    @endif
                    
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->  