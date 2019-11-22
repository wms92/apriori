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
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa big-icon fa-cube icon-wrap"></i> <span class="mini-click-non">Master</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li style="display: none">
                        	<a title="Inbox" href="<?= base_url('admin/bahan');?>"><i class="fa fa-bars sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Bahan</span></a>
                       	</li>
                        <li style="display: none">
                        	<a title="View Mail" href="<?= base_url('admin/stok_bahan');?>"><i class="fa fa-television sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Stok Bahan</span></a>
                        </li>
                        <li>
                        	<a title="Compose Mail" href="<?= base_url('admin/produk');?>"><i class="fa fa-book sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Produk</span></a>
                        </li>
                        <!--
                        <li>
                        	<a title="Compose Mail" href="<?= base_url('admin/bahan_roduk');?>"><i class="fa fa-paper-plane sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Bahan Produk</span></a>
                        </li>
                    -->
                    </ul>
                </li>
                <li>
                    <a class="" href="<?= base_url('admin/transaksi');?>" aria-expanded="false"><i class="fa big-icon fa-credit-card icon-wrap"></i> <span class="mini-click-non">Transaksi</span></a>
                </li>
            <?php } 
                if ($userLogin['lvlUser'] == '2'){
            ?>
                <li>
                    <a class="" href="<?= base_url('admin/pos');?>" aria-expanded="false"><i class="fa big-icon fa-windows icon-wrap"></i> <span class="mini-click-non">POS</span></a>
                </li>
            <?php } ?>
                <?php if ($userLogin['lvlUser'] == '9'){ ?>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa big-icon fa-cube icon-wrap"></i> <span class="mini-click-non">Master</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li style="display: none;">
                            <a title="Inbox" href="<?= base_url('admin/bahan');?>"><i class="fa fa-bars sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Bahan</span></a>
                        </li>
                        <li style="display: none;">
                            <a title="View Mail" href="<?= base_url('admin/stok_bahan');?>"><i class="fa fa-television sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Stok Bahan</span></a>
                        </li>
                        <li>
                            <a title="Compose Mail" href="<?= base_url('admin/menu');?>"><i class="fa fa-book sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Menu</span></a>
                        </li>
                        <li>
                            <a title="Compose Mail" href="<?= base_url('admin/pengguna/daftar');?>"><i class="fa fa-user sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Pengguna</span></a>
                        </li>
                        <!--
                        <li>
                            <a title="Compose Mail" href="<?= base_url('admin/bahan_roduk');?>"><i class="fa fa-paper-plane sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Bahan Produk</span></a>
                        </li>
                    -->
                    </ul>
                </li>
                <li>
                    <a class="" href="<?= base_url('admin/transaksi');?>" aria-expanded="false"><i class="fa big-icon fa-credit-card icon-wrap"></i> <span class="mini-click-non">Transaksi</span></a>
                </li>
                <li>
                    <a class="" href="<?= base_url('admin/pos');?>" aria-expanded="false"><i class="fa big-icon fa-windows icon-wrap"></i> <span class="mini-click-non">POS</span></a>
                </li>
            <?php } ?>
            </ul>
        </nav>
    </div>
</nav>