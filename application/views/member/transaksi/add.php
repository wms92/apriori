<!-- Basic Form Start -->
<div class="basic-form-area mg-tb-15">
    <div class="container-fluid">                
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="clearfix">

                    <?php echo $this->session->flashdata('msgbox') ?>
                </div>
                <div class="sparkline12-list">
                    <div class="sparkline16-list responsive-mg-b-30">
                            <div class="sparkline16-hd">
                                <div class="main-sparkline16-hd">
                                    <h1>Search By Date</h1>
                                </div>
                            </div>
                            <div class="sparkline16-graph">
                                <div class="date-picker-inner">
                                    <form method="post" action="<?= base_url('admin/transaksi/daftar');?>">
                                        <div class="form-group data-custon-pick data-custom-mg">
                                            <label>Range select</label>
                                            <div class="input-daterange input-group">
                                                <input type="date" class="form-control" name="start" value="<?= date('Y-m-d');?>" />
                                                <span class="input-group-addon">to</span>
                                                <input type="date" class="form-control" name="end" value="<?= date('Y-m-d');?>" />
                                            </div>
                                        </div><br>
                                            <button type="submit" class="btn btn-perimary">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>