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
                            <h1>Data <span class="table-project-n">Profile</span></h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" class="table ">
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th></th>
                                    <th><?= $detailData->user_name?></th>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <th></th>
                                    <?php 

                                    if ($detailData->user_jenis_kelamin == 'L'){ 
                                        $jk = "Laki laki";
                                    } else {
                                        $jk = "Perempuan";
                                    }
                                    ?>
                                    <th><?= $jk?></th>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <th></th>
                                    <th><?= $detailData->username?></th>
                                </tr>
                                <tr>
                                    <th>Photo User</th>
                                    <th></th>
                                    <th><img src="<?= base_url($detailData->user_foto)?>" style="height: 100px;"></th>
                                </tr>
                                <tr>
                                    <th><a href="<?= base_url('admin/pengguna/edit/'.$detailData->user_id);?>" class="btn btn-primary">Edit Profile</a></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>