<?php
$page = 'photo';
if ($obj->getREQUEST('type') && (int) $_GET['type'] != "") {
    $cat = 'category';
    $type = (int) $_GET['type'];
    $rowType = $obj->getDataByField("tbl_gallery_cat","cat01id",$type);
    $title = $rowType['cat01category'];
} else {
    $title = 'Photo Gallery';
    $type = 0;
    $cat = 'latest';
}
?>

<article class="module">
    <header>
        <h2><?php echo $title; ?> Gallery</h2>
        <a href="?fol=form&amp;page=add-photo&type=<?php echo $type ?>" title=""><i class="fa fa-plus"></i> Add Photo</a>
    </header>
    <section>
      
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