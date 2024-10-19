<div class="sidebar-panel bg-white">
    <div class="gull-brand pr-3 text-center ml-2 mt-4 mb-4 d-flex justify-content-center align-items-center">
        <img class="pl- 3" src="https://dev2.kopertis7.go.id/images/logo_dikbud.png" alt="alt" />
        <span class="item-name text-20 text-primary font-weight-700 ml-2">LLDIKTI VII</span>
        <div class="sidebar-compact-switch ml-auto"><span></span></div>
    </div>

    <!--  user -->
    <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
        <div class="side-nav">
            <div class="main-menu">
                <ul class="metismenu" id="menu">
                    <!-- Dashboard -->
                    <li class="Ul_li--hover">
                        <a href="{{ route('dashboard') }}">
                            <i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                            <span class="item-name text-15 text-muted">
                                Dashboard
                            </span>
                        </a>
                    </li>

                    @can('access_data_master')
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Master</span></a>
                        <ul class="mm-collapse">
                            @can('access_data_peringkat_akreditasi')
                            <li class="item-name">
                                <a href="{{ route('peringkat-akreditasi') }}">
                                    <i class="nav-icon i-Receipt-4"></i>
                                    <span class="item-name text-20">Peringkat Akreditasi</span>
                                </a>
                            </li>
                            @endcan
                            @can('access_data_lembaga_akreditasi')
                            <li class="item-name">
                                <a href="{{ route('lembaga-akreditasi') }}">
                                    <i class="nav-icon i-Receipt-4"></i>
                                    <span class="item-name">Lembaga Akreditesi</span>
                                </a>
                            </li>
                            @endcan
                            @can('access_data_jabatan')
                            <li class="item-name">
                                <a href="{{ route('jabatan-pimpinan') }}">
                                    <i class="nav-icon i-Receipt-4"></i>
                                    <span class="item-name">Jabatan</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>                        
                    @endcan

                    @can('access_data_badan_penyelenggara')
                        <li class="Ul_li--hover">
                            <a href="{{ route('badan-penyelenggara') }}">
                                <i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 text-muted">
                                    Badan Penyelenggara
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('access_data_perguruan_tinggi')
                        <li class="Ul_li--hover">
                            <a href="{{ route('perguruan-tinggi') }}">
                                <i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 text-muted">
                                    Perguruan Tinggi
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('access_user_management')
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Manajemen User</span></a>
                        <ul class="mm-collapse">
                            @can('access_role_permission')
                            <li class="item-name">
                                <a href="{{ route('role') }}">
                                    <i class="nav-icon i-Receipt-4"></i>
                                    <span class="item-name">Role & Permission</span>
                                </a>
                            </li>
                            @endcan
                            @can('access_user')
                            <li class="item-name">
                                <a href="{{ route('user') }}">
                                    <i class="nav-icon i-Receipt-4"></i>
                                    <span class="item-name">User</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    
                    @can('edit_own_profile')
                        <li class="Ul_li--hover">
                            <a href="{{ route('profile') }}">
                                <i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 text-muted">
                                    Profile
                                </span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
    </div>
    <!--  side-nav-close -->
</div>