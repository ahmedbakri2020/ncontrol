<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("u01user", 'uin', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&amp;page=act_adeduser" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add User</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="userUsername">Username</label>
                        <input type="text" name="username" value="<?php if (isset($row)) echo stripslashes($row['u01username']); ?>" class="form-control" id="userUsername">
                    </div>
                    <div class="form-group">
                        <label for="userFirstName">First Name</label>
                        <input type="text" name="fullname" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['u01fullname']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="userEmail" value="<?php if (isset($row)) echo stripslashes($row['u01email']); ?>" >
                    </div>
                    <div class="form-group">
                        <label for="userContact">Contact Number</label>
                        <input type="number" name="contact" class="form-control" id="userContact" value="<?php if (isset($row)) echo stripslashes($row['u01contact']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="userAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="userAddress" value="<?php if (isset($row)) echo stripslashes($row['u01address']); ?>">
                    </div>


                    <?php if ($action == 'add'): ?>
                        <div class="form-group">
                            <label for="userPassword">Password</label>
                            <input type="password" name="password" id="password" class="form-control" id="userPassword">
                        </div>
                        <div class="form-group" style="display: none;" id="p-bar">
                            <div class="pass_progress red">
                                <span class="bar" style="width:0%"></span>
                                <small class="feedback"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userRePassword">Confirm Password</label>
                            <input type="password"  class="form-control" id="repass">
                        </div>
                    <?php endif; ?>

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
                        <?php if (isset($row) && $row['u01image'] != ""): ?>
                            <img src="../uploads/user/thumbs/<?php echo $row['u01image']; ?>">
<?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>

            <article class="module">
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
            </article>

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
