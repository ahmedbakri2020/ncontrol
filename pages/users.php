<?php
$page = 'users';
if($previlage!='All'){
    header('location:index.php?page=404');
    $obj->redirect('index.php?page=404');
}

    $title = 'All Users';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&amp;page=add-user';

?>
    <article class="module">
        <header>
            <h2><?php echo $title; ?></h2>
           
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
                       
                        <th>Last Login</th>
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
