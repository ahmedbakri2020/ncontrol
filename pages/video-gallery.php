<?php
$page = 'video';
if ($obj->getREQUEST('type') && (int) $_GET['type'] != "") {
    $cat = 'category';
    $type = (int) $_GET['type'];
   //$rowType = $obj->getCategory('gallery','cat01id');
    $title = 'Video  Gallery';//$rowType['cat01category'];
} else {
    $title = 'Video  Gallery';
    $type = 0;
    $cat = 'latest';
}
?>
<article class="module">
    <header>
        <h2><?php echo $title; ?></h2>
        <a href="index.php?fol=form&amp;page=add-video&type=<?php echo $type ?>" title=""><i class="fa fa-plus"></i> Add Video</a>
    </header>
    <section>
        <div class="action-wrap md-no-margin-form-group margin-bottom">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text"  class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
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