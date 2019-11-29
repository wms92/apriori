<nav id="sidebar" class="">
    <div class="sidebar-header">
        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
        <strong><img src="<?= base_url('assets_master/');?>img/logo/logosn.png" alt="" /></strong>
    </div>
    <div class="left-custom-menu-adp-wrap comment-scrollbar">
        <nav class="sidebar-nav left-sidebar-menu-pro">
            <ul class="metismenu" id="menu1">
                    <a class="" href="<?= base_url('admin/dashboard') ?>">
					   <i class="fa big-icon fa-home icon-wrap"></i>
					   <span class="mini-click-non">Dashboard</span>
					</a>
                <?php if ($userLogin['lvlUser'] == '1'){ ?>
                <?php } 
                    if ($userLogin['lvlUser'] == '2'){
                ?>
                <li>
                    <a class="" href="<?= base_url('admin/pos');?>" aria-expanded="false"><i class="fa big-icon fa-windows icon-wrap"></i> <span class="mini-click-non">Analisis Penjualan</span></a>
                </li>
                <?php } ?>
                    <?php if ($userLogin['lvlUser'] == '9'){ ?>
                    <li>
                        <a class="" href="<?= base_url('admin/menu');?>" aria-expanded="false"><i class="fa big-icon fa-list icon-wrap"></i> <span class="mini-click-non">Data Menu</span></a>
                    </li>
                    <li>
                        <a class="" href="<?= base_url('admin/pengguna/daftar');?>" aria-expanded="false"><i class="fa big-icon fa-user icon-wrap"></i> <span class="mini-click-non">Data Pengguna</span></a>
                    </li>
                    <li>
                        <a class="" href="<?= base_url('admin/transaksi');?>" aria-expanded="false"><i class="fa big-icon fa-credit-card icon-wrap"></i> <span class="mini-click-non">Data Transaksi</span></a>
                    </li>
                    <li>
                        <a class="" href="<?= base_url('admin/pos');?>" aria-expanded="false"><i class="fa big-icon fa-windows icon-wrap"></i> <span class="mini-click-non">Analisis Penjualan</span></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</nav>