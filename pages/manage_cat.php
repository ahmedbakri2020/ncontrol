<?php
$category = $_GET['category'];
$type = (int) $_GET['type'];
$table = 'cat01category';
if(isset($_GET['province']) && $_GET['province']!=""):
$pro_id = $_GET['province'];
$getData = $obj->select('cat01category', '*', array("type" => $category,"pradesh_id" =>$pro_id), array("cat01id" => "asc"));
$count_result = $obj->countRow($getData);
else:
$getData = $obj->select('cat01category', '*', array("type" => $category), array("data_order" => "asc"));
$count_result = $obj->countRow($getData);
$palika_link = 'index.php?page=palika_division';
endif;
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Manage Category</h2>
          <a href="?fol=form&page=add-allcat&category=<?php echo $category ?>" title=""><i class="fa fa-plus"></i> Add Category</a>
    </header>
    <section>
         <div class="row">
                    
                    
                    <div class="col-md-2">
                        <div class="form-group country">
                           <select name="district" class="form-control" onchange="window.location = '?page=manage_cat&category=district&province=' + this.value">
                                <option value="">------प्रदेश छान्नुहोस्-----</option>
                                <?php $res_pradesh = $obj->select('pradesh');
                                while($row_pradesh = $res_pradesh->fetch()):?>
                                <option value="<?php echo $row_pradesh['uin'];?>" <?php if(isset($_GET['province']) && $_GET['province']==$row_pradesh['uin']): echo 'selected';endif;?> ><?php echo $row_pradesh['cat01category'];?></option>           
                                <?php endwhile;?>
                                </select>
                        </div>
                        
                    </div>
                    

                </div>

        <?php if ($getData->rowCount() > 0) { ?>
       
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">


                    <thead>
                        <tr class="active">                        
                            <?php if (in_array($category, $ordering)): echo '<td></td>';
                            endif;
                            ?>
                            <th>S.n</th>
                            <th>Title</th> 
                          <th>Pradesh</th>                     
                          <th>Pratinidhi Sabha</th> 
                            <th>Pradesh Sabha</th> 
                            <th>Sthaniya Sabha</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php
                        $sn = 1;
                        while ($row = $getData->fetch()):
                            $pradesh = $obj->getDataByField('pradesh','uin',$row['pradesh_id']);
                            ?>
                            <tr id="<?php echo $row['cat01id']; ?>">
                                <?php if (in_array($category, $ordering)): echo '<td><span></span></td>';
                                endif;
                                ?>
                                <td><?php echo $sn; ?></td>  
                                  <td><a href=""><?php echo $row['cat01category']; ?></a></td>
                                   <td><a href=""><?php echo $pradesh['cat01category']; ?></a></td>
                                     <td>
                                        <?php if ($row['pratnidhi_sabha'] == 1) { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row['cat01id'] ?>, 0, 'pratnidhi_sabha', '<?php echo $table; ?>', 'category')" /></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row['cat01id'] ?>, 1, 'pratnidhi_sabha', '<?php echo $table; ?>', 'category')" /></a>
                                    <?php } ?>
                                    </td> 
                                    
                                     <td>
                                        <?php if ($row['pradesh_sabha'] == 1) { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row['cat01id'] ?>, 0, 'pradesh_sabha', '<?php echo $table; ?>', 'category')" /></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row['cat01id'] ?>, 1, 'pradesh_sabha', '<?php echo $table; ?>', 'category')" /></a>
                                    <?php } ?>
                                    </td> 
                                    
                                    <td>
                                        <?php if ($row['sthaniya_sabha'] == 1) { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row['cat01id'] ?>, 0, 'sthaniya_sabha', '<?php echo $table; ?>', 'category')" /></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row['cat01id'] ?>, 1, 'sthaniya_sabha', '<?php echo $table; ?>', 'category')" /></a>
                                    <?php } ?>
                                    </td> 
                               
                                <td>
                                    <a href="?fol=form&amp;page=add-allcat&id=<?php echo $row['cat01id'] ?>&category=<?php echo $category ?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
                                    <a href="<?php echo '?fol=actpages&amp;page=act_delcategory&id=' . $row['cat01id'] ?>&category=<?php echo $category ?>" onclick="return confirm('Delete / Uninstall cannot be undone! Are you sure you want to do this?')" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a>
                                </td>
                            </tr>
                            <?php
                            $sn++;
                        endwhile;
                        ?>
                    </tbody>
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


                                $(function () {

                                    $('#sortable').sortable({
                                        axis: 'y',
                                        opacity: 0.7,
                                        handle: 'span',
                                        update: function (event, ui) {
                                            var list_sortable = $(this).sortable('toArray').toString();
                                            // change order in the database using Ajax
                                            $.ajax({
                                                url: 'ajax/change_order.php',
                                                type: 'POST',
                                                data: {list_order: list_sortable, 'table': 'cat01category', 'field': 'data_order'},
                                                success: function (data) {
                                                    //finished
                                                }
                                            });
                                        }
                                    }); // fin sortable
                                });

</script>