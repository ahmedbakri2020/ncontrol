<?php
$page = "candidate";
$type = 0;
$cat = 'latest';
 $rowElection = $obj->getDataByField("tbl_status", 'uin', '1');
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Manage Candidate</h2>
          <?php
            if ($rowElection['status'] == 1) {
                echo '<button onclick="change_flash(1,0,\'status\',\'tbl_status\',\'normal\' )" class="btn btn-success margin-top" style="
    margin: 10px;
">Election Show</button>';
            } else {
                echo '<button onclick="change_flash(1,1,\'status\',\'tbl_status\',\'normal\' )" class="btn btn-danger margin-top" style="
    margin: 10px;
">Election Hide</button>';
            }
            ?>
        <a href="?fol=form&page=add-recandidates&type=<?php echo $type; ?>" title=""><i class="fa fa-plus"></i> Add Candidate</a>
        
    </header>
    <section>
        <div class="action-wrap md-no-margin-form-group margin-bottom">
            <form id="filter-dat" method="post">
                <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-group">
                                <select name="election_type" class="form-control" id="election_type">
                                    <option value="">--- निर्बाचन छान्नुहोस ---</option>
                                    <option value="1">प्रतिनिधि सभा</option>
                                     <option value="2">प्रदेश सभा</option>
                                </select>
                            </div>
                        </div>
                       
                    </div>
                      
                     <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-group">
                                <select name="province_id" class="form-control" id="province_id">
                                    <option value="">--- प्रदेश छान्नुहोस ---</option>
                                    <?php $res_pra = $obj->select('pradesh','*');
                                    while($row_pra = $res_pra->fetch()):
                                    ?>
                                    <option value="<?php echo $row_pra['uin'];?>"><?php echo $row_pra['cat01category'];?></option>
                                    <?php endwhile;?>
                                   
                                </select>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-2">
                        <div class="form-group country">
                           <select name="district_id" class="form-control" id="district">
                                <option value="">--जिल्ला--</option>
                               
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-group">
                                <select name="constituency_id" class="form-control" id="locallevel">
                                    <option value="">--निर्बाचन क्षेत्र--</option>
                                    <?php
                                    $res_area = $obj->select("constituency", "*");
                                    if ($res_area->rowCount() > 0) {
                                        while ($row_area = $res_area->fetch()) {
                                            ?>
                                            <option value="<?php echo $row_area['cat01id']; ?>" <?php if ($type == $row_area['cat01id']) echo 'selected'; ?>> <?php echo $row_area['cat01category'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="party_id" class="form-control">
                                <option value="">--पार्टी--</option>
                                <?php
                                $res_party = $obj->select("tbl_party");
                                if ($res_party->rowCount() > 0) {
                                    while ($row_party = $res_party->fetch()) {
                                        ?>
                                        <option value="<?php echo $row_party['uin']; ?>" <?php if ($type == $row_party['uin']) echo 'selected'; ?>> <?php echo $row_party['name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" id="data_filte" name="filter" class="btn btn-primary" value="filter"/>
                    </div>
                    <div class="col-md-2"><input type="text" id="search-data" placeholder="Search Name"  class="form-control"> </div>

                </div> 
            </form>

        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="active">                            
                        <th>S.n</th>
                        <th>Election</th>
                        <th>Party</th>
                        <th>Name</th> 
                        <th>Pradesh </th>
                        <th>District</th>
                        <th>Constituency</th> 
                        <th>Vote</th>
                        <th>Status</th>
                        <th></th>   
                    </tr>
                </thead>
                <tbody id="result-list">
                   
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-6 total-news-count">
                <p>Total Candidates: <strong id="total-data"> </strong> </p>
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination">                        
                        <li class="active"><a href="#" id="1">1</a></li>                        
                    </ul>
                </nav>
            </div>                  
        </div>


    </section>
</article> <!--test-->
<script type="text/javascript">
 $('document').ready(function() {
        $(".pagination a").trigger('click'); // When page is loaded we trigger a click

    });

    $('.pagination').on('click', 'a', function(e) {
        var type = <?php echo $type; ?>;
        var page = this.id;
        var perPage = '200';
        var pagination = '';
        var data = {
            'perPage': perPage,
            'page': page,
            '<?php echo $cat ?>': type
        };
        $.ajax({
            url: '<?php echo ADMIN_URL ?>ajax/pagination-recandidate.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                $('#result-list').html(response.result);
                $('#total-data').html('Showing 1 to ' + response.showing_count + ' of ' + response.total_count + ' entries');
                $('html, body').animate({
                    scrollTop: 0
                }, "slow");
                if (page == 1)
                    pagination += '<li class="disabled page-item"><a class="page-link" href="#" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="disabled page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
                else
                    pagination += '<li class="page-item"><a class="page-link" href="#" id="1" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="page-item"><a class="page-link" href="#" id="' + (page - 1) + '" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';

                for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                    //	alert(i);
                    if (i >= 1 && i <= response.numPage) {

                        if (i == page)
                            pagination += '<li class="active page-item"><a class="page-link" href="#" id="' + i + '">' + i + '</a></li>';
                        else
                            pagination += '<li class="page-item"><a class="page-link" href="#" id="' + i + '">' + i + '</a></li>';

                    } //end of if		  	
                } // end for loop

                if (page == response.numPage)
                    pagination += '<li class="disabled page-item"><a class="page-link" href="#"  aria-label="Next"><span aria-hidden="true">Next</span></a></li><li class="disabled page-item"><a class="page-link" href="#" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';
                else
                    pagination += '<li class="page-item"><a class="page-link" href="#" id="' + (parseInt(page) + 1) + '" aria-label="Next"><span aria-hidden="true">Next</span></a></li><li class="page-item"><a class="page-link" href="#" id="' + response.numPage + '" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';

                $('.pagination').html(pagination); // We update the pagination DIV


            }, // end of success

            error: function() {}

        });

        return false;

    });
    function change_status(id, value, field, table, tbl_type) {

        if (confirm("Are you sure to perform this action ?")) {
            $.ajax({
                url: "actpages/change_status.php",
                type: "post",
                data: {'id': id, 'value': value, 'field': field, 'table': table, 'tbl_type': tbl_type},
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                }

            });
        }

    }
    $('#filter-dat').on('submit', function (e) {
        e.preventDefault();
       // showSpinner();
        var data = {
            'filter': 'yes', 'page': '1','perPage':'200'
        };
        data = $(this).serialize() + '&' + $.param(data);
        $.ajax({
            type: "POST",
            url: 'ajax/pagination-recandidate.php',
            data: data,
            dataType: 'json',
            success: function (response)
            {
               // hideSpinner();
                 $('#result-list').html(response.result);
                $('#total-data').html('Showing 1 to ' + response.showing_count + ' of ' + response.total_count + ' entries');
            }
        });
    });
    $(function () {
        $('#search-data').keyup(function () {
            showSpinner();
            var value = this.value;
            $.ajax({
                url: "ajax/pagination-recandidate.php",
                type: "post",
                data: {'perPage': '100', 'page': '1', 'search': value},
                dataType: "json",
                success: function (response) {
                    hideSpinner();
                    $('#result-list').html(response.result);
                $('#total-data').html('Showing 1 to ' + response.showing_count + ' of ' + response.total_count + ' entries');
                }

            });
        });
    });
    function updateVote(id) {
        document.getElementById('spinner' + id).innerHTML = '<img src="<?php echo ADMIN_URL ?>assets/images/ajax-spinner.gif" />';
        var value = $("#" + id).val();
        // alert(value);
        $.ajax({
            url: "ajax/update-revote-count.php",
            type: "post",
            data: {'id': id, 'vote': value},
            dataType: "text",
            success: function (response) {
                document.getElementById('spinner' + id).innerHTML = response;

            }

        });
    }
 
  $("#province_id").on("change", function() {
            var provinceId = $(this).val();
            console.log(provinceId);
            $.ajax({
                url: "ajax/election/choose-dropdown.php",
                type: "POST",
                cache: false,
                data: {
                    provinceId: provinceId,
                    action: 'searchprovince'
                },
                success: function(data) {
                    $("#district").html(data);
                }
            });
        });
        $("#result-list").on('change', '#change_status', function() {
            var statusid = $(this).val();
               var id = $(':selected', this).data('id');
            $.ajax({
                url: "ajax/change-rewinner.php",
                type: "POST",
                cache: false,
                data: {
                    statusid: statusid,
                    id:id,
                    action: 'winner'
                },
                success: function(data) {
            
                }
            });
        });
</script>
 <script>
        function change_flash(id, value, field, table, tbl_type) {

            if (confirm("Are you sure to perform this action ?")) {
                $.ajax({
                    url: "ajax/election/change_flash.php",
                    type: "post",
                    data: {'id': id, 'value': value, 'field': field, 'table': table, 'tbl_type': tbl_type},
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status == 1) {
                            location.reload();
                        }
                    }

                });
            }
        }
    </script>
