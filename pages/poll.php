<?php
$page = 'poll';
$title = 'Public Poll';
$type = 0;
$cat = 'latest';
?>

<article class="module">
    <header>
        <h2><?php echo $title; ?></h2>
        <a href="?fol=form&amp;page=add-poll" title=""><i class="fa fa-plus"></i> Add Poll</a>
    </header>
    <section>
       <!-- <div class="action-wrap md-no-margin-form-group margin-bottom">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text"  class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-6"> </div>
            </div>
        </div>-->
        <div class="table-responsive">
            <table class="table table-hover" id="result-list">


            </table>
        </div>
        <div class="row">
            <div class="col-md-6 total-news-count">
                <strong>Total Data : <span id="total-data"></span></strong> 
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