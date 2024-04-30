<?php
$page = 'epcat';
if ($previlage == 'All' || in_array(3, $arr_prev)) {

} else {
    $obj->redirect('?page=404.php');
}

    $title = 'Epaper Category';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&amp;page=add_epcat';

?>
    <article class="module">
        <header>
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $add_url ?>&action=add" title=""><i class="fa fa-plus"></i> Add Category</a>
        </header>
        <section>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Category</th>

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