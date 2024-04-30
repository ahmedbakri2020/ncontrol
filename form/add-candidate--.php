<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_candidate", 'uin', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&page=act_candidate" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <h2>Update Data</h2>
                </header>
                <section>
                    
                    <div class="form-group">
                        <label for="userFirstName">Candidate Name </label>
                        <input type="text" name="name" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['name']); ?>">
                    </div>
                     <div class="form-group">

  <label for="userFirstName">Election Type </label>          
                        <select name="election_type" class="form-control" id="election_type">
                            <option value="">---Choose--</option>
                            <option value="1" <?php echo (isset($row) &&(1==$row['election_type'])?'selected':'');?>>प्रतिनिधि सभा</option>
                            <option value="2" <?php echo (isset($row) &&(2==$row['election_type'])?'selected':'');?>>प्रदेश सभा</option>                         
                        </select>
                    </div>
                      <div class="form-group">
                            <label for="userFirstName">Province</label>   
                        <select name="pradesh_type" class="form-control" id="province_id">
                            <option value="">---Choose--</option>
                            <?php $res_province = $obj->select('pradesh');
                                    foreach($res_province as $row_province):
                                        echo '<option value="'.$row_province['uin'].'" '.(($row_province['uin']==$row['province_id'])?'selected':'').'>'.$row_province['cat01category'].'</option>';
                                    endforeach;
                                    ?>                       
                        </select>
                    </div>
                     <div class="form-group">
                            <label for="userFirstName">District</label>   
                        <select name="district_type" class="form-control" id="district_id">
                            <option value="">---Choose--</option>
                             <?php 
                                    if(isset($row) && $row['province_id']>0):
                                    $res_district = $obj->select('districts','*',array('province_id'=>$row['province_id']));
                                    foreach($res_district as $row_district):
                                        echo '<option value="'.$row_district['uin'].'" '.(($row_district['uin']==$row['district_id'])?'selected':'').'>'.$row_district['district_name_nepali'].'</option>';
                                    endforeach;
                                endif;
                                    ?>                 
                        </select>
                    </div>
                      <div class="form-group" id="group_type" style="display: none;">
                      <label for="userFirstName">Group</label>          
                        <select name="group_type" class="form-control">
                            <option value="">---Choose--</option>
                            <option value="1" <?php echo (isset($row) &&(1==$row['group_type'])?'selected':'');?>>क</option>
                            <option value="2" <?php echo (isset($row) &&(2==$row['group_type'])?'selected':'');?>>ख</option>                         
                        </select>
                    </div>
                     
                    
                    <div class="form-group">
                       
                        <select name="party" class="form-control">
                            <option value="">--पार्टी--</option>
                            <?php
                            $res_party = $obj->select("tbl_party");
                            if ($res_party->rowCount() > 0) {
                                while ($row_party = $res_party->fetch()) {
                                    ?>
                                    <option value="<?php echo $row_party['uin']; ?>" <?php if (isset($row) && $row['pid'] == $row_party['uin']) echo 'selected'; ?>> <?php echo $row_party['name'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module">
                <header>
                    <h2> क्षेत्र नं </h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul>
                            <?php
                            $res_area = $obj->select("cat01category", "*", array("type" => "area"));
                            if ($res_area->rowCount() > 0) {
                                while ($row_area = $res_area->fetch()) {
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="area"  value="<?php echo $row_area['cat01id']; ?>" <?php if (isset($row) && $row['aid'] == $row_area['cat01id']) echo 'checked'; ?>> <?php echo $row_area['cat01category'] ?>
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


            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
            <input type="hidden" name="action" value="<?php echo $action ?>" class="form-control">
            <button type="submit" name="submit" class="btn margin-top btn-primary btn-lg btn-block">Save</button>

        </div>
    </div>
</form>
<script>
 $('document').ready(function() {
      $("#election_type").on("change", function() {
            var typeId = $(this).val();
           if(typeId== 2){
            $('#group_type').show();

           }else{
            $('#group_type').hide();
           }
        });
    });
    $("#province_id").on("change", function() {
            var provinceId = $(this).val();
            console.log(provinceId);
            $.ajax({
                url: "ajax/election/choose-dropdown.php",
                type: "POST",
                cache: false,
                data: {
                    provinceId: provinceId,
                    action: 'province'
                },
                success: function(data) {
                    $("#district_id").html(data);
                }
            });
        });
</script>
