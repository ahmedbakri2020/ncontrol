<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField('p02prof_cat', 'cat01id', $id);
} else {
    $action = "add";
}

?>
<article class="module">
    <header>
        <h2>Add Category</h2>
    </header>
    <section>
        <form method="post" id="form" action="?fol=actpages&amp;page=act_profilecat">
            <div class="row">
                <div class="col-md-6">
                    <div class="fields">
                        <div class="form-group">
                            <label for="categoryTitle">Title</label>
                            <input type="text" name="category" value="<?php if (isset($row)) echo $row['cat01category']; ?>" class="form-control more-class" id="categoryTitle">
                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" name="action" value="<?php echo  $action ?>" />
                  <input type="hidden" name="id" value="<?php echo $row['cat01id']; ?>">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
              
            </div>

        </form>
    </section>
</article>