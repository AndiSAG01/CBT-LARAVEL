  <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="nav-item" href="{{ route('pages') }}">
                            <i class="fas fa-home menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('jadwal.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i><span class="nav-text">Jadwal Ujian</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-item" href="{{ route('hasil.index') }}">
                            <i class="fas fa-user-graduate"></i><span class="nav-text">Hasil Ujian</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->  