<div class="basic-form-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="clearfix">
                    <?php echo $this->session->flashdata('msgbox')?>
                </div>

                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Analisis Transaksi</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form name="analisis_form" id="analisis_form" onsubmit="return false;">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2pull-right pull-right-pro">Start Date</label>
                                                    </div>

                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2pull-right pull-right-pro">End Date</label>
                                                    </div>

                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2pull-right pull-right-pro">Support</label>
                                                    </div>

                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                        <input type="number" min="0" max="100" name="support" id="support" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2pull-right pull-right-pro">Analysis Type</label>
                                                    </div>

                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                        <select name="analisis_type" id="analisis_type">
                                                            <option value="terlaris">Terlaris</option>
                                                            <option value="tak_laku">Tidak Laku</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <button id="start-btn" class="btn btn-sm btn-primary login-submit-cs" type="submit" onclick="handlingProcessAnalysis();">Start</button>
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

                        <div class="basic-login-form-ad">
                            <fieldset>
                                <legend>Result:</legend>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="result-container">
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalLoading">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      Loading . . . <br>
      Please Wait a Minute
    </div>
  </div>
</div>



<script>

    function handlingProcessAnalysis() {
        // clear data in table
        $('#result-container').html("")
        $("#start-btn").attr("disabled", true)
        $('#modalLoading').modal({show:true,focus: true})

        var data = $('#analisis_form').serialize()
        var type_analysis = $('#analisis_type').val()
        if (type_analysis == 'terlaris') {
            processAnalysisApriori(data)
        } else {
            processAnalysisNotSold(data)
        }
        
    }

    function processAnalysisApriori(data) {
        var tableContainer = $('#result-container')
        $.ajax({
            type: "GET",
            url: "<?= base_url('admin/analisis/apriori');?>",
            data,
            success: function(result) {
                var res = JSON.parse(result);
                if (res.result.length == 0) {
                    var tr = document.createElement("tr");
                    var td = document.createElement("td")
                    var data = document.createTextNode("Data Not Found")
                    td.appendChild(data)
                    tr.appendChild(td)
                    tableContainer.append(tr)
                    return false;
                }

                for(i = 0; i < res.result.length; i++) {
                    var tr = document.createElement("tr");
                    var td = document.createElement("td")
                    var data = document.createTextNode(res.result[i])
                    td.appendChild(data)
                    tr.appendChild(td)
                    tableContainer.append(tr)
                }
                
                $("#start-btn").attr("disabled", false)
                $('#modalLoading').modal('hide')
            }
        })
    }

    function processAnalysisNotSold(data) {
        var tableContainer = $('#result-container')
        $.ajax({
            type: "GET",
            url: "<?= base_url('admin/analisis/notsold');?>",
            data,
            success: function(result) {
                var res = JSON.parse(result);
                if (res.result.length == 0) {
                    var tr = document.createElement("tr");
                    var td = document.createElement("td")
                    var data = document.createTextNode("Data Not Found")
                    td.appendChild(data)
                    tr.appendChild(td)
                    tableContainer.append(tr)
                    return false;
                }

                for(i = 0; i < res.result.length; i++) {
                    var tr = document.createElement("tr");
                    var td = document.createElement("td")
                    var data = document.createTextNode(res.result[i])
                    td.appendChild(data)
                    tr.appendChild(td)
                    tableContainer.append(tr)
                }

                $("#start-btn").attr("disabled", false)
                $('#modalLoading').modal('hide')
                
            }
        })   
    }
</script>