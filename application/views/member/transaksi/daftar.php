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
                                    <a href="<?= base_url('admin/transaksi/export');?>" class="btn btn-primary">Print Laporan</a>
                                    <div class="add-product">
                                        <a href="<?= base_url('admin/pos/v2');?>">Tambah Data</a>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id">NO</th>
                                                <th data-field="code" data-editable="true">Transaksi No</th>
                                                <th data-field="name" data-editable="true">Transaksi Tanggal</th>
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
                                                <td><?= $value->transaksi_no ?></td>
                                                <td><?= $value->transaksi_tgl ?></td>
                                                <td class="datatable-ct">
                                                    <a href="<?php echo base_url('admin/transaksi/edit/'.$value->transaksi_id) ?>"><button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                                    <a href="<?php echo base_url('admin/transaksi/doDelete/'.$value->transaksi_id) ?>"><button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')"></i></button></a>
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