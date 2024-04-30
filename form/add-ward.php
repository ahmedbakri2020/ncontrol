<?php
$cid = $_GET['cid'];
$table = 'ward';
if ($obj->getREQUEST('id')) {
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField($table, 'uin', $id);
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
        <form method="post" id="form" action="?fol=actpages&amp;page=act_addward">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                                      
                                        <select name="pradesh_id" class="form-control" id="province">

                                            <option value="">--Select Pradesh--</option>
                                            <?php 
                                            $res_pradesh = $obj->select('pradesh','*'); 
                                            while($row_pradesh = $res_pradesh->fetch()):
                                                ?>
                                                <option value="<?php echo $row_pradesh['uin'];?>" <?php if (isset($row) && $row['pradesh_id']==$row_pradesh['uin']) echo 'selected'; ?>><?php echo $row_pradesh['cat01category'];?></option>
                                                <?php endwhile;?>
                                                
                                                                                    </select>
                                    </div>
                                    
                                     <div class="form-group">
                                      
                                        <select name="district_id" class="form-control" id="district">

                                            <option value="">--Select District--</option>
                                            <?php 
                                            $res_dist = $obj->select('cat01category','*'); 
                                            while($row_dist = $res_dist->fetch()):
                                                ?>
                                                <option value="<?php echo $row_dist['cat01id'];?>" <?php if (isset($row) && $row['district_id']==$row_dist['cat01id']) echo 'selected'; ?>><?php echo $row_dist['cat01category'];?></option>
                                                <?php endwhile;?>
                                                
                                                                                    </select>
                                    </div>
                                     <div class="form-group">
                                      
                                        <select name="local_id" class="form-control" id="local">

                                            <option value="">--Local Level--</option>
                                            <?php 
                                            $res_dist = $obj->select('area_subdivision','*'); 
                                            while($row_dist = $res_dist->fetch()):
                                                ?>
                                                <option value="<?php echo $row_dist['aid'];?>" <?php if (isset($row) && $row['local_id']==$row_dist['aid']) echo 'selected'; ?>><?php echo $row_dist['address'];?></option>
                                                <?php endwhile;?>
                                                
                                                                                    </select>
                                    </div>
                    <div class="fields">
                        

                        <div class="form-group">
                            <input type="hidden" name="cid" value="<?php echo $cid ?>"/>
                            <input type="text" name="ward[]" value="<?php if (isset($row)) echo $row['ward']; ?>" placeholder="Address" class="form-control more-class" id="ward">
                        </div>

                    </div>

                    <?php if ($action == 'add'): ?>
                        <div class="form-group">
                            <button type="button" id="addmore" class="btn btn-info">Add More</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                <input type="hidden" name="id" value="<?php if (isset($row)) echo $row['uin']; ?>"/>
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            </div>

        </form>
    </section>
</article>
<script>
    $(document).ready(function () {
        var i = 1;
        var InnerHtml = '<div id="fields' + i + '"><div class="form-group margin-top"><input type="text" name="ward[]" class="form-control" placeholder="ward" id="ward"></div>'
                + '<button type="button"  name="remove" id="' + i + '" class="btn btn-danger btn_remove pull-right">X</button></div>';
        $("#addmore").click(function () {
            i++;
            $('.fields').before(InnerHtml);
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#fields' + button_id + '').remove();
        });

    });
     $("#province").on("change",function(){
      var provinceId = $(this).val();
      $.ajax({
        url :"ajax/election/district-list.php",
        type:"POST",
        cache:false,
        data:{provinceId:provinceId},
        success:function(data){
          $("#district").html(data);
        }
      });
    });
     $("#district").on("change",function(){
      var districtId = $(this).val();
      $.ajax({
        url :"ajax/election/district-list.php",
        type:"POST",
        cache:false,
        data:{districtId:districtId},
        success:function(data){
          $("#local").html(data);
        }
      });
    });


</script>