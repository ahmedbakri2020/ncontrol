<?php
$page = 'profilecat';
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
    $title = 'Team Category';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&page=add-profilecat';
}
?>
<article class="module">
    <header>
        <h2><?php echo $title; ?></h2>
        <a href="<?php echo $add_url ?>&action=add" title=""><i class="fa fa-plus"></i> Add Category</a>
    </header>
    <section>
        <div class="action-wrap md-no-margin-form-group margin-bottom">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">

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
                        <th>Category Name</th>
                        <th>Ordering</th>
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
<script>
    function change_AdOrder(id, value, field, table, type)
    {
        //alert(id+'----- to perfom the action'))
        {
            $.ajax({---'+value);
            if (confirm('Sure
                url: 'actpages/change_order.php',
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
    }
</script>