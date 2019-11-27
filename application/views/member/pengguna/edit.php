<!-- Basic Form Start -->
<div class="basic-form-area mg-tb-15">
    <div class="container-fluid">                
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="clearfix">

                    <?php echo $this->session->flashdata('msgbox') ?>
                </div>
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Form Edit Data</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form method="post" action="<?php echo base_url('admin/pengguna/doUpdate/'.$this->uri->segment(4));?>" enctype="multipart/form-data">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="full_name" class="form-control" value="<?= $detailData->user_name?>" required="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Jenis Kelamin</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="jk" class="form-control">
                                                            <option value="L" <?php if ($detailData->user_jenis_kelamin == 'L'){echo "selected";}?> > Laki laki</option>
                                                            <option value="P" <?php if ($detailData->user_jenis_kelamin == 'P'){echo "selected";}?> > Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Username</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="username" class="form-control" value="<?= $detailData->username?>" required="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Password</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="password" name="password" class="form-control" />
                                                        *) Fill to change password
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($userLogin['lvlUser'] == 9) {?>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">User Status</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="user_status" class="form-control">
                                                            <option value="2" <?php if ($detailData->user_status == '2'){echo "selected";}?> > Manager</option>
                                                            <option value="9" <?php if ($detailData->user_status == '9'){echo "selected";}?> > Admin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Foto Profile</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <?php if($detailData->user_foto <> ""){ ?>
                                                            <a href="<?= base_url($detailData->user_foto) ?>" target="_blank" style="color: #007bff;">View Current Image</a>
                                                        <?php } ?>
                                                        <input type="file" name="photo" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <a href="<?= base_url('admin/bahan/');?>" class="btn btn-default">Kembali</a>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Simpan Perubahan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>