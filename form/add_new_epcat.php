<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("epaper_new_cat", 'cat01id', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&amp;page=act_adednewepcat" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Year</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="userFirstName">Year</label>
                        <input type="text" id="datepicker" name="cat_name" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['cat01category']); ?>">
                    </div>

                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
           <!-- <article class="module">
                <header>
                    <h2>Category Image</h2>
                </header>
                <section>
                    <div class="bs-upload-image" <?php
                    if ($action == 'add') {
                        echo 'style="display: none;"';
                    }
                    ?> id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                        <?php if (isset($row) && $row['cat_image'] != ""): ?>
                            <img src="../uploads/paper/category/thumbs/<?php echo $row['cat_image']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>-->
            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
            <input type="hidden" name="action" value="<?php echo $action ?>" class="form-control">
            <button type="submit" name="submit" class="btn margin-top btn-primary btn-lg btn-block">Save</button>

        </div>
    </div>
</form>

<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="assets/js/moment.js"></script>
<script>
    var password = document.getElementById("password"), confirm_password = document.getElementById("repass");
    function validatePassword() {
        if (password.value != repass.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    function readURL(input) {

        $('#thumbnail').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail').html('<img src="' + e.target.result + '"  height="200"/>');

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="assets/js/password.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script>
$("#datepicker").datepicker({
format: "yyyy",
viewMode: "years",
minViewMode: "years"
});
</script>

