    <!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    
    <div class="clearfix">
        <?php echo $this->session->flashdata('msgbox') ?>
    </div>
    <form action="<?php echo site_url('admin/pos/posTransaksi'); ?>" class="form-inline" method="post">
    <div style="margin-bottom: 10px" ng-app="myApp" ng-controller="myCtrl">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success">
                    <h5>No Transaksi : <?= $no_transaksi ?></h5>
                    <h5>Jumlah Harga : {{pos.harga_total|number:0}}</h5>
                    <h5>Tanggal Transaksi : <?= date('Y-m-d') ?></h5>
                </div>
                <div class="alert alert-danger" ng-if="pos.alert != ''">
                    <strong>{{pos.alert}}</strong>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-success">
                    <h5>Produk Rekomendasi : 
                        <span ng-if="dataApriori.length == 0 || dataApriori.dataConfident.length == 0">tidak ada rekomendasi</span>
                        <div class="row" ng-if="dataApriori.length != 0 && dataApriori.dataConfident.length != 0">
                            <div class="col-md-4" ng-repeat="data in dataApriori.dataConfident" >
                                <div class="border" style="text-align: center;border: 1px solid #e6e6e6;border-radius: 10px;margin-bottom: 10px;padding-top: 5px;padding-bottom: 5px;background-color: white;">
                                    <p style="margin: 0;text-align: center;">
                                    <span ng-repeat="datas in data.isi">
                                        {{($index != 0?dataApriori.tabular.tabular_name[datas]:'')}}
                                    </span></p>
                                </div>
                            </div>
                        </div>
                    </h5>
                    <h5>Produk Kurang Laku : 
                        <span ng-if="dataApriori.length == 0 || dataApriori.dataConfidentMin.length == 0">tidak ada produk kurang laku</span>
                        <div class="row" ng-if="dataApriori.length != 0 && dataApriori.dataConfidentMin.length != 0">
                            <div class="col-md-4" ng-repeat="data in dataApriori.dataConfidentMin" >
                                <div class="border" style="text-align: center;border: 1px solid #e6e6e6;border-radius: 10px;margin-bottom: 10px;padding-top: 5px;padding-bottom: 5px;background-color: white;">
                                    <p style="margin: 0;text-align: center;">
                                    <span ng-repeat="datas in data.isi">
                                        {{($index != 0?dataApriori.barang[datas]:'')}}
                                    </span></p>
                                </div>
                            </div>
                        </div>
                    </h5>
                    <a ng-if="dataApriori.length != 0" href="<?= base_url('admin/pos/downLoadExcel/') ?>{{data_idBarang}}">Perhitungan Download Disini</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered" style="margin-bottom: 10px">
                    <tr>
                        <th>No</th>
                        <th>Kode Menu</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                    <tr ng-repeat="data in pos.list_pos">
                        <th>{{$index+1}}</th>
                        <th>{{data.menu_code}}<input type="text" style="display: none;" name="barang_keluar[{{$index}}][menu_code]" ng-model="data.menu_code"></th>
                        <th>{{data.menu_name}}</th>
                        <th>{{data.menu_harga}}</th>
                        <th><input type="number" style="width: 100%;" name="barang_keluar[{{$index}}][jumlah]" ng-model="data.qty" ng-change="hitungJumlah()"></th>
                        <th><button class="btn btn-danger" ng-click="removePos($index)">x</button></th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6" style="border: 1px solid #e6e6e6;border-radius: 10px;background-color: white;">
                <h1 style="text-align: center;">List Barang</h1>
                <div class="row" style="max-height: 500px;overflow-y: scroll;">
                    <div class="col-md-4" ng-repeat="data in data_barang" ng-click="addCart(data)">
                        <div class="border" style="text-align: center;border: 1px solid #e6e6e6;border-radius: 10px;margin-bottom: 10px;padding-top: 5px;background-color: white;">
                            <img src="<?= $base_foto ?>{{data.menu_gambar}}" style="height: 100px;">
                            <p style="margin: 0;text-align: center;">{{data.menu_name}}</p>
                            <p style="margin: 0;text-align: center;">Harga : Rp.{{data.menu_harga|number:0}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group review-pro-edt">
            <button class="btn btn-primary waves-effect waves-light pull-right" style="margin-top: 10px;">Bayar</button>    
        </div>
    </div>
    </form>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<script type="text/javascript">
    var list_barang = <?= json_encode($barang_data) ?>;
    var base_url = "<?= base_url() ?>";
</script>
