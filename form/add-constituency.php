<?php
$cid = $_GET['cid'];
$table = 'constituency';
if ($obj->getREQUEST('id')) {
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField($table, 'cat01id', $id);
    $action = "edit";
} else {
    $action = 'add';
}
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Add Category</h2>
    </header>
    <section>
        <form method="post" id="form" action="?fol=actpages&page=act_constituency">
            <div class="row">
                <div class="col-md-6">
                         <div class="form-group">
                            <input type="text" name="constituency" value="<?php if (isset($row)) echo $row['cat01category']; ?>" placeholder="" class="form-control more-class">
                        </div>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                <input type="hidden" name="id" value="<?php if (isset($row)) echo $row['cat01id']; ?>"/>
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            </div>

        </form>
    </section>
</article>