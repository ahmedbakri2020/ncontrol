<?php
$page = 'user';
if($previlage!='All'){
    header('location:index.php?page=404');
    $obj->redirect('index.php?page=404');
}

$res_user_cat = $obj->select("user_cat", "*");
if ($obj->getREQUEST('cat_id') && (int) $_GET['cat_id'] != "") {
    $cat = 'category';
    $type = (int) $_GET['cat_id'];
    $rowType = $obj->getDataByField("user_cat", 'cat01id', $type);
    $title = $rowType['cat01category'];
    $add_url = '?fol=form&amp;page=add-user&type=' . $type;
} else {
    $title = 'All Users';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&amp;page=add-user';
}
?>
    <article class="module">
        <header>
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $add_url ?>&action=add" title=""><i class="fa fa-plus"></i> Add User</a>
        </header>
        <section>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
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
        </script>