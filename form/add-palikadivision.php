<?php
$cid = $_GET['cid'];
$table = 'area_subdivision';
if ($obj->getREQUEST('id')) {
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField($table, 'aid', $id);
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
        <form method="post" id="form" action="?fol=actpages&amp;page=act_palikadiv">
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
                                                <option value="<?php echo $row_dist['cat01id'];?>" <?php if (isset($row) && $row['cid']==$row_dist['cat01id']) echo 'selected'; ?>><?php echo $row_dist['cat01category'];?></option>
                                                <?php endwhile;?>
                                                
                                                                                    </select>
                                    </div>
                                       <div class="form-group">
                            <select name="palika[]" class="form-control">
                                <option>--Choose One</option>
                                <option value="गाउँपालिका" <?php if ($row['palika_type'] == 'गाउँपालिका') echo "selected"; ?>>गाउँपालिका</option>
                                <option value="नगरपालिका" <?php if ($row['palika_type'] == 'नगरपालिका') echo "selected"; ?>>नगरपालिका</option>
                                <option value="महानगरपालिका" <?php if ($row['palika_type'] == 'महानगरपालिका') echo "selected"; ?>>महानगरपालिका</option>
                                 <option value="उपमहानगरपालिका" <?php if ($row['palika_type'] == 'उपमहानगरपालिका') echo "selected"; ?>>उपमहानगरपालिका</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <input type="hidden" name="cid" value="<?php echo $cid ?>"/>
                            <input type="text" name="address[]" value="<?php if (isset($row)) echo $row['address']; ?>" placeholder="Address" class="form-control more-class" id="address">
                        </div>
                    <div class="fields">
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
                <input type="hidden" name="id" value="<?php if (isset($row)) echo $row['aid']; ?>"/>
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            </div>

        </form>
    </section>
</article>
<script>
    $(document).ready(function () {
        var i = 1;
        var InnerHtml = '<div id="fields' + i + '"><div class="form-group margin-top"><input type="text" name="address[]" class="form-control" placeholder="Address" id="Address"></div>'
                + '<select name="palika[]" class="form-control">'
                + '<option>--Choose One</option>'
                + '<option value="गाउँपालिका">गाउँपालिका</option>'
                + '<option value="नगरपालिका">नगरपालिका</option>'
                + '<option value="महानगरपालिका">महानगरपालिका</option>'
                 + '<option value="उपमहानगरपालिका">उपमहानगरपालिका</option>'
                + '</select>'
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


</script>