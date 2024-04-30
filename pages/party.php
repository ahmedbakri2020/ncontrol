<?php
 $getData = $obj->select('tbl_party', "*",NULL,array("data_order"=>"asc"));
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Manage Party</h2>
        <a href="?fol=form&page=add-party" title=""><i class="fa fa-plus"></i> Add party</a>
    </header>
    <section>
       
        <?php if ($getData->rowCount() > 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                        <tr class="active">   
                            <th></th>
                            
                            <th>Party Name</th>    
                            <th>Flag</th>
                            <th>प्रतिनिधि सभा(विजयी)</th>
                            <th>प्रदेश सभा(विजयी)</th>
                            <th>प्रतिनिधि सभा (अग्रता)</th>
                           <th>प्रदेश सभा (अग्रता)</th>
                               <th>समानुपातिक (अग्रता)</th>
                           <th></th>
        
                            <th>Action</th>  
                           
                        </tr>
                    </thead>
                    
                <form id="election">
                    <tbody id="sortable">
                        <?php
                        $sn = 1;
                        while ($row = $getData->fetch()):
                            ?>
                            <tr id="<?php echo $row['uin']; ?>">
                                <td><span></span></td>
                                                    
                                <td><?php echo $row['name']; ?></td>
                                <td><img src="<?php echo UPLOADS ?>election/thumbs/<?php echo $row['image'] ?>" /></td>
                               
                                 <td>
                                    <input type="text" class="form-control"  name="prati_win" value="<?php echo $row['prati_win'] ?>" id="prati_win<?php echo $row['uin'] ?>" />  
                                    
                                </td>
                                <td>
                                    <input type="text" class="form-control"  name="prati_agrata" value="<?php echo $row['prati_agrata'] ?>" id="prati_agrata<?php echo $row['uin'] ?>" />  
                                </td>

                                <td>
                                    <input type="text" class="form-control"  name="pradesh_win" value="<?php echo $row['pradesh_win'] ?>" id="pradesh_win<?php echo $row['uin'] ?>" />                                    
                                </td>
                               <td>
                                    <input type="text" class="form-control" name="pradesh_agrata" value="<?php echo $row['pradesh_agrata'] ?>" id="pradesh_agrata<?php echo $row['uin'] ?>" />                                    
                                </td>
                                 <td>
                                    <input type="text" class="form-control" name="samanupatik" value="<?php echo $row['samanupatik'] ?>" id="samanupatik<?php echo $row['uin'] ?>" />                                    
                                </td>


                                 <td>
                                    <input type="button" onclick="updateVote(<?php echo $row['uin'] ?>)"  value="Update">
                                     <div id="spinner<?php echo $row['uin'] ?>"></div>
                                </td> 
                             
                                
                                <td>
                                   
                                        <?php /* if ($row['status'] == 1) { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row['uin'] ?>, 0, 'status','tbl_party', 'normal')" /></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row['uin'] ?>, 1, 'status', 'tbl_party', 'normal')" /></a>
                                        <?php } */ ?>
                                    
                                  <a href="index.php?fol=form&page=add-party&id=<?php echo $row['uin']; ?>"class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                  <a href="index.php?fol=actpages&page=act_party&delete=<?php echo $row['uin']; ?>"class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
                            <?php
                            $sn++;
                        endwhile;
                        ?>
                    </tbody>
                  </form>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p><strong>Total Category : </strong> <?php echo $obj->countRow($getData); ?></p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">                            
                            <li class="active"><a href="#">1</a></li>                          
                        </ul>
                    </nav>
                </div>                  
            </div>
        <?php } else { ?>
            <strong>No Contents Found!</strong>  
        <?php } ?>

    </section>
</article> <!--test-->

<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/script.js"></script>
<script type="text/javascript">

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
                  var samanupatik =  $("#samanupatik"+id).val();
                // alert(value);
                $.ajax({
                    url: "ajax/update-election.php",
                    type: "post",
                    data: {'id':id,'prati_win':prati_win,'prati_agrata':prati_agrata,'pradesh_win':pradesh_win,'pradesh_agrata':pradesh_agrata,'samanupatik':samanupatik},
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
                data: {list_order:list_sortable,'table':'tbl_party','field':'data_order','tbl_type':'normal'},
                success: function(data) {
                    //finished
                }
            });
        }
    }); // fin sortable
});
</script>