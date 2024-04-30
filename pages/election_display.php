<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  if ($obj->getREQUEST('election') && (int) $_GET['election'] != "") {
        $cat = 'category';
        $type = (int) $_GET['election'];
        $rowType = $obj->getDataByField(NEWS_CAT, 'cat01id', $type);
        //$title = $rowType['cat01category'];
    } else {
        $title = 'Election';
        $type = 0;
        $cat = 'latest';
    }

?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Add Display Management</h2>
    </header>
    <section>
       <form id="" method="post" action="?fol=actpages&page=act_display_election">
                <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-group">
                                <select name="election_type" class="form-control" id="election_type" required>
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
                                <select name="constituency_id" class="form-control" id="locallevel" required>
                                    <option value="">--निर्बाचन क्षेत्र--</option>
                                    <?php $res_const = $obj->select('constituency');
                                    foreach($res_const  as $row_const):
                                    echo '<option value="'.$row_const['cat01id'].'">'.$row_const['cat01category'].'</option>';
                                    endforeach;
                                    ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" id="group_type" style="display:none">
                        <div class="form-group">
                            <div class="form-group">
                                <select name="group_id" class="form-control" id="locallevel">
                                    <option value="">--समूह--</option>
                                    <option value="1">क</option>
                                        <option value="2">ख</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="action" value="add">
                        <input type="submit"  class="btn btn-primary" value="Save">
                    </div>
                </div> 
            </form>
    </section>
</article>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Display Management</h2>
    </header>
    <section>
      
                <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-group">
                                <select name="election_type" class="form-control" id="election_type" onchange="window.location = '?page=election_display&election=' + this.value">
                                    <option value="">--- निर्बाचन छान्नुहोस ---</option>
                                    <option value="1">प्रतिनिधि सभा</option>
                                     <option value="2">प्रदेश सभा</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> 
            
       
    
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                        <tr class="active">   
                            <th></th>
                            <th>Election</th>    
                            <th>District</th>
                            <th>Constituency</th>
                            <th>Action</th>  
                           
                        </tr>
                    </thead>
                    <tbody id="sortable" class="election_result">
                       
                    </tbody>
                 
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p id="total_count"></p>
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

<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/script.js"></script>
<script>
        $('document').ready(function () {
            $(".pagination a").trigger('click'); // When page is loaded we trigger a click

        });

        $('.pagination').on('click', 'a', function (e) {
            var type = <?php echo $type; ?>;
            var page = this.id;
            var perPage = '200';
            var pagination = '';
            var data = {'perPage': perPage, 'page': page, '<?php echo $cat ?>': type};
            $.ajax({
                url: '<?php echo ADMIN_URL ?>ajax/election.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    // alert(response.newsList);
                    $('.election_result').html(response.newsList);
                    $('#total_count').html('<strong>Total List:' + response.count + ' </strong>');
                    $('html, body').animate({scrollTop: 0}, "slow");
                    if (page == 1)
                        pagination += '<li class="disabled"><a href="#" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
                    else
                        pagination += '<li class=""><a href="#" id="1" aria-label="First"><span aria-hidden="true">First</span></a></li><li class=""><a href="#" id="' + (page - 1) + '" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';

                    for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                        //	alert(i);
                        if (i >= 1 && i <= response.numPage) {

                            if (i == page)
                                pagination += '<li class="active"><a href="#" id="' + i + '">' + i + '</a></li>';
                            else
                                pagination += '<li><a href="#" id="' + i + '">' + i + '</a></li>';

                        } //end of if
                    } // end for loop

                    if (page == response.numPage)
                        pagination += '<li class="disabled"><a href="#"  aria-label="Next"><span aria-hidden="true">Next</span></a></li><li class="disabled"><a href="#" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';
                    else
                        pagination += '<li><a href="#" id="' + (parseInt(page) + 1) + '" aria-label="Next"><span aria-hidden="true">Next</span></a></li><li><a href="#" id="' + response.numPage + '" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';

                    $('.pagination').html(pagination); // We update the pagination DIV


                }, // end of success

                error: function () { }

            });

            return false;

        });

    function change_status(id, value, field, table, tbl_type) {

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
    
    function updateVote(id){
                 document.getElementById('spinner'+id).innerHTML ='<img src="<?php echo ADMIN_URL ?>assets/images/ajax-spinner.gif" />';
                var prati_win =  $("#prati_win"+id).val();
                var prati_agrata =  $("#prati_agrata"+id).val();
                var pradesh_win =  $("#pradesh_win"+id).val();
                var pradesh_agrata =  $("#pradesh_agrata"+id).val();
                // alert(value);
                $.ajax({
                    url: "ajax/update-election.php",
                    type: "post",
                    data: {'id':id,'prati_win':prati_win,'prati_agrata':prati_agrata,'pradesh_win':pradesh_win,'pradesh_agrata':pradesh_agrata},
                    dataType: "text",
                    success: function (response) {
                          document.getElementById('spinner'+id).innerHTML=response;
                       
                    }

                });
            };
    
    
    $(function() {
    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
    		// change order in the database using Ajax
            $.ajax({
                url: 'ajax/change_order.php',
                type: 'POST',
                data: {list_order:list_sortable,'table':'election_display','field':'sorts','action':'election_display'},
                success: function(data) {
                    //finished
                }
            });
        }
    }); // fin sortable
});
 $('document').ready(function() {
      $("#election_type").on("change", function() {
            var typeId = $(this).val();
           if(typeId== 2){
            $('#group_type').show();

           }else{
            $('#group_type').hide();
           }
        });
    });
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
</script>