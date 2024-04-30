<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_markating", 'cat01id', $id);
} else {
    $action = "add";
}
?>
<form method="post" action="?fol=actpages&page=act_adedmarket" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Data</h2>
                </header>
                <section>

                    <div class="form-group">
                        <label for="userFirstName">Fullname</label>
                        <input type="text" name="fullname" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['m01fullname']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Post</label>
                        <input type="text" name="post" class="form-control" id="userEmail" value="<?php if (isset($row)) echo stripslashes($row['m01post']); ?>" >
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="text" name="email" class="form-control" id="userEmail" value="<?php if (isset($row)) echo stripslashes($row['m01email']); ?>" >
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Contact</label>
                        <input type="text" name="contact" class="form-control" id="userEmail" value="<?php if (isset($row)) echo stripslashes($row['m01contact']); ?>" >
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
