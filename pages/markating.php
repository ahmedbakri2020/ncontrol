<?php
$page = 'markating';

$title = 'Marketing Information System';
$type = 0;
$cat = 'all';
$add_url = '?fol=form&page=add_markat';
?>
    <article class="module">
        <header>
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $add_url ?>&action=add" title=""><i class="fa fa-plus"></i> Add Data</a>
        </header>
        <section>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Name</th>
                        <th>Status</th>
                      
                    </tr>
                    </thead>
                     <tbody id="result-list">

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p>Total: <strong id="total-data"> </strong> </p>
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
<?php //include 'ajax/pagination-js.php'; ?>