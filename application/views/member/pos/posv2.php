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
                                    <h1>Form Tambah Data</h1>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                <form method="post" action="<?php echo  base_url('admin/pos/posTransaksiv2');?>">
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Kode Transaksi</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="no_transaksi" class="form-control" value="<?= $no_transaksi?>" required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Tanggal Transaksi</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="date" name="transaction_date" class="form-control" value="" required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Item Transaksi</label>
                                                            </div>
                                                            <div id="item_transact_container" class="col-lg-9 col-md-9 col-sm-9 col-xs-12 item_container">
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="item_container0">
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                        <select class="col-lg-12" style="margin-left:-16px;"name="barang_keluar[0][menu_kode]">
                                                                            <?php foreach($barang_data as $k => $val):?>
                                                                                <option value="<?= $val->menu_code?>"><?= $val->menu_name?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-9">
                                                                        <label class="login2">Qty</label>
                                                                        <input type="number" style="width: 52px;" name="barang_keluar[0][item_qty]">
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-9">
                                                                        <a class="btn btn-success" onclick="addItemTransaction()">+</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>
                                                                <div class="col-lg-9">
                                                                    <div class="login-horizental cancel-wp pull-left">
                                                                        <a href="<?= base_url('admin/transaksi/daftar');?>" class="btn btn-default"> Kembali</a>
                                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Simpan</button>
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
<script>
    var opt_menu = ""
    var indexItem = 1;
    <?php foreach($barang_data as $k => $val) :?>
        opt_menu += "<option value='<?= $val->menu_code?>'><?= $val->menu_name?></option>"
    <?php endforeach?>

    $(document).ready(function() {
        $("select").select2()
    })

    function addItemTransaction() {
        var divContainerItem = document.createElement("div")
        divContainerItem.id = "item_container"+indexItem
        divContainerItem.className = "col-lg-9 col-md-9 col-sm-9 col-xs-12"
        

        var divContainMenu = document.createElement("div")
        divContainMenu.className = "col-lg-4 col-md-4 col-sm-4 col-xs-12"
        var selectMenu = document.createElement("select")
        selectMenu.name = "barang_keluar["+indexItem+"][menu_kode]"
        selectMenu.innerHTML = opt_menu
        selectMenu.className = "col-lg-12"
        selectMenu.style.marginLeft = "-16px";
        divContainMenu.append(selectMenu)

        var divContainQty = document.createElement("div")
        divContainQty.className = "col-lg-3 col-md-3 col-sm-3 col-xs-9"
        var qtyLabel = document.createElement("label")
        qtyLabel.innerText = "Qty"
        qtyLabel.className = "login2"
        divContainQty.append(qtyLabel)

        var qtyInput = document.createElement("input")
        qtyInput.type = "number"
        qtyInput.style = "width: 52px"
        qtyInput.name = "barang_keluar["+indexItem+"][item_qty]"
        divContainQty.append(qtyInput)

        var divBtnRmv = document.createElement("div")
        divBtnRmv.className = "col-lg-3 col-md-3 col-sm-3 col-xs-9"
        var btnRmv = document.createElement("a")
        btnRmv.id = "containid-"+indexItem
        btnRmv.className = "btn btn-danger"
        btnRmv.onclick = function (e) { 
            id = e.target.id
            idExtract = id.split("-")
            idNum = idExtract[1]
            removeContainer(idNum)
        }
        btnRmv.innerText = "x"
        divBtnRmv.append(btnRmv)

        divContainerItem.append(divContainMenu)
        divContainerItem.append(divContainQty)
        divContainerItem.append(divBtnRmv)

        $('#item_transact_container').append(divContainerItem)
        $("#item_container"+indexItem+" select").select2()
        indexItem++;
    }


    function removeContainer(itemInd) {
        $("#item_container"+itemInd).remove()
    }
</script>