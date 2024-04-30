<?php
$category = $_GET['cat'];
switch ($category) {
    case 'news': $table = 'n02news_cat';
        break;
    case 'archive': $table = 'a01newscat';
        break;
    default :
        $table = "tbl_".$category;
}
if($category=='sub_cat_news'){
    $getData = $obj->select($table, "*",array("type"=>$_GET['id']));
}else{
    $getData = $obj->select($table, "*");
}

if($table=='tbl_trends'){
    $field = 'trend';
}else{
    $field = 'n01type';
}

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
}
//echo $table;
$en_menu = array('news');
$count_result = $obj->countRow($getData);
?>
<article class="module">
    <header>
        <h2><?php echo $category ;?> Category</h2>
        <a href="?fol=form&page=add-category&category=<?php echo $category ?><?php if(isset($id)) echo '&cat_id=',$id; ?>" title=""><i class="fa fa-plus"></i> Add Category</a>
    </header>
    <section>

        <?php if ($getData->rowCount()>0) { ?>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">


                    <thead>
                    <tr class="active">
                        <th>S.n</th>
                        <th>Title</th>
                        <?php if(in_array($category, $en_menu)): ?>
                            <th>News Count</th>
                            <th>Enable Menu</th>
                              <th>Menu order</th>
                                <th>Status</th>
                        <?php endif; ?>
                      

                      
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sn = 1;
                    while ($row = $getData->fetch()):

                        $news = $obj->getAllDataByField(NEWS, $field, $row['cat01id']);
                        $count = $obj->countRow($news)
                        //print_r($row);
                        ?>
                        <tr>

                            <th><?php echo $sn; ?></th>
                            <td><?php echo $row['cat01category']; ?></td>
                            <?php if(in_array($category, $en_menu)): ?>
                                <td><?php echo $count; ?></td>

                                <td>
                                    <?php if ($row['menu'] == 1) { ?>
                                        <a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row['cat01id'] ?>, 0, 'menu', '<?php echo $table; ?>', 'category')" /></a>
                                    <?php } else { ?>
                                        <a href="#"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row['cat01id'] ?>, 1, 'menu', '<?php echo $table; ?>', 'category')" /></a>
                                    <?php } ?>
                                </td>
                                  <td>
                                <select onchange="changeAppOrder(<?php echo $row['cat01id'] ?>,this.value,'menu_order','<?php echo $table; ?>','category')">
                                    <?php
                                    for ($i = 1; $i <= $count_result; $i++):
                                        echo '<option value="' . $i . '" '.(($i==$row['menu_order'])?'selected':'').'>' . $i . '</option>';
                                    endfor;
                                    ?>
                                </select>

                            </td>
                              <td>
                                <?php if ($row['status'] == 1) { ?>
                                    <a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row['cat01id'] ?>, 0, 'status', '<?php echo $table; ?>', 'category')" /></a>
                                <?php } else { ?>
                                    <a href="#"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row['cat01id'] ?>, 1, 'status', '<?php echo $table; ?>', 'category')" /></a>
                                <?php } ?>
                            </td>
                            <?php endif; ?>


                          
                          
                            <td>
                                <?php if($category=='news'):?>
                                <a href="?page=category&cat=sub_cat_news&id=<?php echo $row['cat01id'] ?>" class="btn btn-warning btn-xs">Subcat</a>
                                <?php
                                endif;
                                ?>
                                <a href="?fol=form&amp;page=add-category&id=<?php echo $row['cat01id'] ?>&category=<?php echo $category ?><?php if(isset($id)) echo '&cat_id=',$id; ?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
                                <?php if($category!="news"){
                                    ?>

                                    <a href="?fol=actpages&amp;page=deleteCategory&delete=<?php echo $row['cat01id'] ?>&category=<?php echo $category ?>&id=<?php echo $row['type']?>" onclick="return confirm('Are you sure you want to delete this item?');" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a>
                                    <?php
                                }
                                ?>
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
<script type="text/javascript">
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
    function changeAppOrder(id, value, field, table, type)
    {
        // alert(id+'--------'+value);

        $.ajax({
            url: 'ajax/change_adorder.php',
            type: 'post',
            data: {"id": id, "field": field, "table": table, 'tbl_type': type, "value": value},
            dataType: 'json',
            success: function (response)
            {
                if (response.status == 1)
                {
                    location.reload();
                }
            }
        });

    }
</script>