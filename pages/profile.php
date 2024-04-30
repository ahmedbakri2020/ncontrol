<?php
$page = 'profile';
if ($previlage == 'All' || in_array(3, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}

$res_user_cat = $obj->select("p02prof_cat", "*");
if ($obj->getREQUEST('cat_id') && (int) $_GET['cat_id'] != "") {
    $cat = 'category';
    $type = (int) $_GET['cat_id'];
    $rowType = $obj->getDataByField("p02prof_cat", 'cat01id', $type);
    $title = $rowType['cat01category'];
    $add_url = '?fol=form&amp;page=add_profile';
} else {
    $title = 'Our Team';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&amp;page=add_profile';
}
?>
<article class="module">
    <header>
        <h2><?php echo $title; ?></h2>
        <a href="<?php echo $add_url ?>&action=add" title=""><i class="fa fa-plus"></i> Add Profile</a>
    </header>
    <section>
        <div class="action-wrap md-no-margin-form-group margin-bottom">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <select class="form-control" name="category" onchange="window.location = '?page=profile&cat_id=' + this.value">
                                <option>Change Category</option>
                                <?php
                                while ($row_user_cat = $res_user_cat->fetch()):
                                    echo '<option value="' . $row_user_cat['cat01id'] . '" '.(($row_user_cat['cat01id']==$type)?'selected':'').'>' . $row_user_cat['cat01category'] . '</option>';
                                endwhile;
                                ?>

                            </select>
                            
                        </div>
                    </div>
                </div>
              
              
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="news-table">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Full Name</th>
                        <th>Email</th>
                       
                      
                        <th>Post</th>
                      
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="result-list">
              

                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 total-news-count">
                <p>Total User: <strong id="total-data"> </strong> </p>
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
</article>
<?php include 'ajax/pagination-js.php'; ?>