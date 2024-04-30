<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_subscribe_rate", 'cat01id', $id);
} else {
    $action = "add";
}
?>
<form method="post" action="?fol=actpages&page=act_adedrate" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Rate</h2>
                </header>
                <section>

                    <div class="form-group">
                        <label for="userFirstName">Newspaper/Magazine</label>
                        <input type="text" name="name" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['cat01category']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Annual</label>
                        <input type="text" name="annual" class="form-control" id="userEmail" value="<?php if (isset($row)) echo stripslashes($row['cat01annual']); ?>" >
                    </div>


                    <div class="form-group">
                        <label for="userAddress">Half Yearly</label>
                        <input type="text" name="half" class="form-control" id="userAddress" value="<?php if (isset($row)) echo stripslashes($row['cat01half']); ?>">
                    </div>
                    <div class="col-md-3">
                    <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
                    <input type="hidden" name="action" value="<?php echo $action ?>" class="form-control">
                    <button type="submit" name="submit" class="btn margin-top btn-primary btn-lg btn-block">Save</button>
                    </div>


                </section>
            </article>
        </div>

    </div>
</form>

<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="assets/js/moment.js"></script>
