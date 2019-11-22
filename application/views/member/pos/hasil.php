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
                            <h1>Daftar <span class="table-project-n">Menu Rekomendasi</span></h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div class="add-product">
                                <a href="<?= base_url('admin/pos');?>">Kembali Ke POS</a>
                            </div>
                            <div>
                                <div class="alert alert-success">
                                    <h5>Menu Rekomendasi : <?php 
                                        if (!empty($dataApriod['dataApriori'])) {
                                            foreach ($dataApriod['dataApriori']['isi'] as $key => $value) {
                                            if ($key != '0') {
                                                echo ' and ';
                                            }
                                            echo $dataApriod['tabular']['tabular_name'][$value];
                                        }
                                    }else{
                                        echo "tidak ada rekomendasi";
                                    } ?></h5>
                                    <?php 
                                    if (!empty($dataApriod['dataApriori'])) {
                                    ?>
                                    <a href="<?= base_url('admin/pos/downLoadExcel/'.$id_barang) ?>">Perhitungan Download Disini</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>