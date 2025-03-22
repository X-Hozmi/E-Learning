<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">WEB</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Query Menu -->
        <?php
        // Membuat menu dinamis dengan menggabungkan 2 tabel (user_menu dan user_menu_akses)
        // Melalui primary key dari user_menu dan foreign key dari user_menu_akses
        $id_role = $this->session->userdata('id_role');
        $querymenu = $this->db->query("SELECT menu.id_menu, menu
							FROM menu JOIN menu_akses
							ON menu.id_menu = menu_akses.id_menu
							WHERE menu_akses.id_role = $id_role
							ORDER BY menu_akses.id_menu ASC")->result_array();
        $menu = $querymenu;
        ?>

        <!-- Menu Loop -->
        <?php foreach ($menu as $me) : ?>
            <div class="sidebar-heading">
                <?= $me['menu']; ?>
            </div>

            <!-- List sub-menu sesuai menu -->
            <?php
            // Membuat sub menu dinamis dengan menggabungkan 2 tabel (user_menu_sub dan user_menu)
            // Melalui foreign key dari user_menu_sub dan primary key dari user_menu
            $id_menu = $me['id_menu'];
            $querysub = $this->db->query("SELECT *
							FROM menu_sub JOIN menu
							ON menu_sub.id_menu = menu.id_menu
							WHERE menu_sub.id_menu = $id_menu
							AND menu_sub.is_active = 1")->result_array();
            $submenu = $querysub;
            ?>

            <?php foreach ($submenu as $sub) : ?>
                <?php if ($judul == $sub['nama_sub']) : ?>
                    <!-- Nav Item - Loop -->
                    <li class="nav-item active ">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url($sub['url']); ?>">
                        <i class="<?= $sub['ikon']; ?>"></i>
                        <span><?= $sub['nama_sub']; ?></span></a>
                    </li>
                <?php endforeach; ?>

                <!-- Divider -->
                <hr class="sidebar-divider mt-3">

            <?php endforeach; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

    </ul>
    <!-- End of Sidebar -->