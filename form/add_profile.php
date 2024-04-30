<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_profile", 'p_id', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&amp;page=act_adedprofile" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add User</h2>
                </header>
                <section>
                       <div class="form-group">
                        <label for="userFirstName">Category</label>
                        
                        <select class="form-control" name="type">
                                <option>Choose Category</option>
                             <?php
                             $res_team_cat = $obj->select("p02prof_cat", "*","",array("cat01id"=>"desc"));
                             while($row_team=$res_team_cat->fetch()):?>
                             
                              <option value="<?php echo $row_team['cat01id']; ?>" <?php if (isset($row) && $row['type'] == $row_team['cat01id']) echo 'selected'; ?>><?php echo $row_team['cat01category'];?></option>
                             
<?php endwhile;?>
                            </select>
                       
                    </div>
                    <div class="form-group">
                        <label for="userFirstName">FullName</label>
                        <input type="text" name="fullname" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['fullname']); ?>">
                    </div>
                    
                   <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="userEmail" value="<?php if (isset($row)) echo stripslashes($row['email']); ?>" >
                    </div>
                    

                    <div class="form-group">
                        <label for="userAddress">Post</label>
                        <input type="text" name="post" class="form-control" id="userAddress" value="<?php if (isset($row)) echo stripslashes($row['post']); ?>">
                    </div>


                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module">
                <header>
                    <h2>Image</h2>
                </header>
                <section>
                    <div class="bs-upload-image" <?php
                    if ($action == 'add') {
                        echo 'style="display: none;"';
                    }
                    ?> id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                        <?php if (isset($row) && $row['image'] != ""): ?>
                            <img src="../uploads/profile/thumbs/<?php echo $row['image']; ?>">
<?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>

           <!-- <article class="module">
                <header>
                    <h2>Authorization</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul>
                            <?php
                            $res_data = $obj->select("authorization", "*");
                            if ($res_data->rowCount() > 0) {
                                while ($row_data = $res_data->fetch()) {
                                    if (isset($row)) {
                                        if (is_int($row['auth'])) {
                                            $auth = $row['auth'];
                                        } else {
                                            $auth = explode(',', $row['auth']);
                                            //   print_r($type);
                                        }
                                    }
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="auth[]"  value="<?php echo $row_data['cat01id']; ?>"
                                                <?php
                                                if (isset($row)) {
                                                    if (is_array($auth) && in_array($row_data['cat01id'], $auth)) {
                                                        echo 'checked';
                                                    } elseif ($row_data['cat01id'] == $row['auth']) {
                                                        echo 'checked';
                                                    }
                                                }
                                                ?>> <?php echo $row_data['cat01category'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </section>
            </article>-->

           <!-- <div class="form-group">
                <label>is our team</label>
                <input type="radio" name="our_team"  value="1" <?php if (isset($row) && $row['our_team'] == 1) echo 'checked'; ?>> Yes
                <input type="radio" name="our_team"  value="0" <?php if (isset($row) && $row['our_team'] == 0) echo 'checked'; ?>> No
            </div>-->

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
