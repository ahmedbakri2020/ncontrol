<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_author", 'cat01id', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&amp;page=act_adedreporter" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add User</h2>
                </header>
                <section>

                    <div class="form-group">
                        <label for="userFirstName">Full Name(Nepali)</label>
                        <input type="text" name="fullname" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['cat01category']); ?>">
                    </div>
                     <div class="form-group">
                        <label for="userFirstName">Full Name(English)</label>
                        <input type="text" name="eng_fullname" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['eng_fullname']); ?>">
                    </div>


                    <div class="form-group">
                        <label for="userAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="userAddress" value="<?php if (isset($row)) echo stripslashes($row['address']); ?>">
                    </div>


                    <div class="form-group">
                        <label for="post">Post</label>
                        <input type="text" name="post" class="form-control" id="post" value="<?php if (isset($row)) echo stripslashes($row['post']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="facebookProfileURL">Facebook Profile</label>
                        <div class="input-group">
                            <div class="input-group-addon">https://www.facebook.com/</div>
                            <input type="text"  name="fb" value="<?php if (isset($row)) echo $row['fb']; ?>" class="form-control" id="facebookProfileURL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitterProfileURL">Twitter Profile</label>
                        <div class="input-group">
                            <div class="input-group-addon">https://www.twitter.com/</div>
                            <input type="text" name="twitter" value="<?php if (isset($row)) echo $row['twitter']; ?>" class="form-control" id="twitterProfileURL">
                        </div>
                    </div>
                    <div class="form-group">
                          
                        <label for="twitterProfileURL">Email</label>
                        <div class="input-group">
                            <div class="input-group-addon"></div>
                            <input type="email" name="email" value="<?php if (isset($row)) echo $row['email']; ?>" class="form-control" id="twitterProfileURL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitterProfileURL">Linkedin Profile</label>
                        <div class="input-group">
                            <div class="input-group-addon"></div>
                            <input type="text" name="link" value="<?php if (isset($row)) echo $row['link']; ?>" class="form-control" id="twitterProfileURL">
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="userFirstName">Description</label>
                        <textarea name="description" class="form-control" id="" ><?php if (isset($row)) echo stripslashes($row['description']); ?></textarea>
                    </div>

                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module">
                <header>
                    <h2>Image</h2><br>
                     <p>(width 652px and height 435px)</p>
                </header>
               
                <section>
                    <div class="bs-upload-image" <?php
                    if ($action == 'add') {
                        echo 'style="display: none;"';
                    }
                    ?> id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                         <?php if (isset($row) && $row['image'] != ""): ?>
                            <img src="../uploads/reporter/thumbs/<?php echo $row['image']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>



            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
            <input type="hidden" name="action" value="<?php echo $action ?>" class="form-control">
            <button type="submit" name="submit" class="btn margin-top btn-primary btn-lg btn-block">Save</button>

        </div>
    </div>
</form>

<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="assets/js/moment.js"></script>
<script>
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
