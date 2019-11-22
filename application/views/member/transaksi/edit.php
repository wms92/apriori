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
                                    <h1>Daftar <span class="table-project-n">Transaksi</span></h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div class="add-product">
                                        <a href="<?= base_url('admin/produk/add');?>">Add Product</a>
                                    </div>
                                    <div class="form-group">
                                        <h4>No Transaksi</h4> <br><?= $detailData->transaksi_no?><hr>
                                    </div>
                                    <div class="form-group">
                                        <h4>Tanggal Transaksi</h4> <br><?= $detailData->transaksi_tgl?><hr>
                                    </div>
                                    <table id="table" class="table table-striped">
                                       
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Menu</th>
                                                <th>Jumlah Transaksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sql = $this->db->query("select * from  tbl_detail_transaksi as tdt INNER JOIN tbl_menu  as  tm ON tm.menu_code = tdt.id_menu_code  where tdt.id_transaksi_code = '".$detailData->transaksi_no."'")->result();
                                            $no = 0;
                                            foreach ($sql  as $key => $value) {
                                            $no++
                                            ?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><?= $value->menu_name?></td>
                                                <td><?= $value->transaksi_qty?></td>
                                            </tr>
                                            <?php }    ?>
                                        </tbody>
                                    </table>
                                    <a href="<?= base_url('admin/transaksi/');?>" class="btn btn-default"> Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>