<?php

if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("poll_quest", 'uin', $id);
    $res_option = $obj->getAllDataByField("poll_answer", 'quest_id', $row['uin']);
} else {
    $action = "add";
}
?>

<form method="post" action="?fol=actpages&amp;page=act_adedpoll" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Photo</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="photoTitle">Question</label>
                        <input type="text" name="poll_question" value="<?php if (isset($row)) echo stripslashes($row['ques']); ?>" class="form-control" id="photoTitle">
                    </div>
                    
                    
                    
                    <?php
                       $c=1;
                       if($action=='edit'){ 
                        while($row_option = $res_option->fetch()):
                     ?>
                    <div class="form-group">
                        <label for="photoTitle">Option <?php echo $c; ?></label>
                        <input type="text" name="value[]" value="<?php if (isset($row)) echo stripslashes($row_option['answer']); ?>" class="form-control" id="photoTitle">
                    </div>
                    <?php $c++; endwhile; }else{ ?>
                    <select class="form-control" onchange="poll_option(this.value)" >
                        <option>Select One</option>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            ?>
                            <option value= <?php echo $i ?>><?php echo $i; ?></option>
                            <?php
                        }
                        ?>

                    </select>
                    <?php } ?>
                    
                    <div id="poll">
                        
                    </div>
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <!-- <div class="form-group">
                         <label for="datePicker">Date</label>
                         <input type="text" name="date" class="form-control" id="datePicker"/>
                     </div>-->
            <article class="module margin-top">
                <header>
                    <h2>Image</h2>
                </header>
                <section>
                    <div class="bs-upload-image" id="thumbnail" <?php if ($action == 'add') echo 'style="display: none;"'; ?>>
                        <?php if (isset($row) && $row['image'] != ""): ?>
                            <img src="<?php echo UPLOADS ?>poll/thumbs/<?php echo $row['image']; ?>">
                        <?php endif; ?>  
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>

                </section>
            </article>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="action" value="<?php echo $action ?>" />
            <input type="hidden" name="type" value="<?php echo $type ?>" />
            <input type="submit" name="btn_submit" class="btn margin-top btn-primary btn-lg btn-block" value="Publish" />
        </div>
    </div>
</form>
<script type="text/javascript">
    function poll_option(value)
    {
        htmlString = '';
        for (i = 1; i <= value; i++)
        {
            htmlString += "<div class=\"form-group\"><label>Option" + i + "</label><input type='text' class='form-control' placeholder='Please Enter the option' name='value[]'size='30'></div>";
        }
        $("#poll").show();
        $("#poll").html(htmlString);
    }
</script>