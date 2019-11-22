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
                                                <form method="post" action="<?php echo base_url('admin/menu/doUpdate/'.$this->uri->segment(4));?>" enctype="multipart/form-data">
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Code Menu</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="menu_code" class="form-control" value="<?= $detailData->menu_code?>" readonly required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Nama Menu</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="menu_name" class="form-control" value="<?= $detailData->menu_name?>" required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Harga Menu</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="menu_harga" class="form-control" value="<?= $detailData->menu_harga?>" required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Stok Menu</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="menu_stock" class="form-control" value="<?= $detailData->menu_stock?>" required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Gambar Menu</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="file-upload-inner ts-forms">
                                                                    <div class="input prepend-big-btn">
                                                                        <label class="icon-right" for="prepend-big-btn">
                                                                                <i class="fa fa-download"></i>
                                                                            </label>
                                                                        <div class="file-button">
                                                                            Browse
                                                                            <input type="file" name="photo" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                                                        </div>
                                                                        <input type="text" id="prepend-big-btn" placeholder="no file selected">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $sql = $this->db->query("select * from tbl_bahan_menu where id_produk = '".$detailData->produk_id."'")->result();
                                                    ?>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Bahan</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" >
                                                                <table class="table table-striped" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nama Bahan</th>
                                                                            <th>Jumlah Yang digunakan</th>
                                                                            <th>Opsi Form</th>
                                                                        </tr>
                                                                    </thead>
                                                 
                                                                    <tbody id="form-body">
                                                                        <?php foreach ($sql as $key => $Bvalue){?>
                                                                        <tr>
                                                                            <td>
                                                                                <select name="produk_bahan_edit[<?= $key ?>][id_bahan]" class="form-control">
                                                                                    <?php foreach ($listBahan as $value) {?>
                                                                                        <option value="<?= $value->bahan_id?>" <?php if ($value->bahan_id == $Bvalue->id_bahan){echo "selected";}?>> <?= $value->bahan_name?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" name="menu_bahan_edit[<?= $key ?>][id_bahan_menu]" value="<?= $Bvalue->bahan_menu_id?>">
                                                                                <input type="text" class="form-control" name="menu_bahan_edit[<?= $key ?>][jumlah_digunakan]" placeholder="0" value="<?= $Bvalue->jumlah_pemakaian?>">
                                                                            </td>
                                                                            <td>
                                                                               <a href="<?= base_url('admin/menu/deleteBahan/'.$Bvalue->bahan_menu_id.'/'.$this->uri->segment(4))?>"><button type="button" class="btn btn-danger" onclick="del_form(this)">Hapus</button></a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php }?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro"></label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="form-body">
                                                                <button type="button" onclick="add_form()" class="btn btn-danger">Tambah Bahan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>
                                                                <div class="col-lg-9">
                                                                    <div class="login-horizental cancel-wp pull-left">
                                                                        <a href="<?= base_url('admin/produk/');?>" class="btn btn-default"> Kembali</a>
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
<script src="<?= base_url();?>/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    var nongol = 0;
    function add_form()
        {
            nongol++;
        var selection_form = '';
            selection_form += '<tr>';
            selection_form += '<td><select name="menu_bahan['+nongol+'][id_bahan]" class="form-control">'+
                    <?php foreach ($listBahan as $key => $value): ?>
                        '<option value="'+<?= $value->bahan_id ?>+'"><?= $value->bahan_name?></option>'+
                    <?php endforeach ?>
                    '</select></td>';
            selection_form += '<td><input type="text" class="form-control" name="menu_bahan['+nongol+'][jumlah_digunakan]" placeholder="10"></td>';
            selection_form += '<td><button type="button" class="btn btn-danger" onclick="del_form(this)">Hapus</button></td>';
            selection_form += '</tr>';
            $('#form-body').append(selection_form);
        }
 
        function del_form(id)
        {
            id.closest('tr').remove();
        }
</script>