<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <li class="nav navbar top-nav">
                <a href="">
                    <?php
				function tanggal($format,$nilai="now"){
					$en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
					"Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
					$id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
					"Jan","Feb","Maret","April","Mei","Juni","Juli","Agustus","September",
					"Oktober","November","Desember");
					return str_replace($en,$id,date($format,strtotime($nilai)));
				}
				
				date_default_timezone_set('Asia/Jakarta');
				$tanggal=date('d-m-Y');
				echo tanggal("D, j M Y");

			?>
                </a>
            </li>
            <li class="nav navbar top-nav">
                <a>
                    Pukul <span id="jam"></span>
                </a>
            </li>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Alerts -->

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('autentikasi/logout'); ?>" data-toggle="modal"
                            data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>


        <!-- End of Topbar -->