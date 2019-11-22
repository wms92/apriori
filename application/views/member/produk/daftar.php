<!-- Static Table Start -->
        <div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="clearfix">

                            <?php echo $this->session->flashdata('msgbox') ?>
                        </div>
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Daftar <span class="table-project-n">Produk</span></h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div class="add-product">
                                        <a href="<?= base_url('admin/produk/add');?>">Tambah Data</a>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id">NO</th>
                                                <th data-field="code">Code Produk</th>
                                                <th data-field="name">Nama Produk</th>
                                                <th data-field="harga">Harga Produk</th>
                                                <th data-field="stok">Stok Produk</th>
                                                <th data-field="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no =0;
                                            foreach ($listData as $value){ 
                                                
                                            $no ++
                                            ?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><?= $value->produk_code ?></td>
                                                <td><?= $value->produk_name ?></td>
                                                <td><?= $value->produk_harga ?></td>
                                                <td><?= $value->produk_stock ?></td>
                                                <td class="datatable-ct">
                                                    <a href="<?php echo base_url('admin/produk/edit/'.$value->produk_id) ?>"><button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                                    <a href="<?php echo base_url('admin/produk/doDelete/'.$value->produk_id) ?>"><button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>