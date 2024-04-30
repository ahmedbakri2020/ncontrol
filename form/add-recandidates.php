<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("recandidates", 'uin', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&page=act_recandidates" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <h2>Update Data</h2>
                </header>
                <section>
                     <div class="form-group">
                          <label for="userFirstName">Election Type </label>          
                        <select name="election_type" class="form-control" id="election_type">
                            <option value="">---Choose--</option>
                            <option value="1" <?php echo (isset($row) &&(1==$row['election_type'])?'selected':'');?>>प्रतिनिधि सभा</option>
                            <option value="2" <?php echo (isset($row) &&(2==$row['election_type'])?'selected':'');?>>प्रदेश सभा</option>                         
                        </select>
                    </div>
                     <div class="form-group" id="group_type" <?php if ($action == 'add' || isset($row) && $row['election_type']==1) echo 'style="display:none;"'; ?>>
                      <label for="userFirstName">Group</label>          
                        <select name="group_type" class="form-control">
                            <option value="">---Choose--</option>
                            <option value="1" <?php echo (isset($row) &&(1==$row['group_type'])?'selected':'');?>>क</option>
                            <option value="2" <?php echo (isset($row) &&(2==$row['group_type'])?'selected':'');?>>ख</option>                         
                        </select>
                    </div>
                      <div class="form-group">
                         <label for="userFirstName">Party</label>      
                        <select name="party" class="form-control">
                            <option value="">--पार्टी--</option>
                            <?php
                            $res_party = $obj->select("tbl_party");
                            if ($res_party->rowCount() > 0) {
                                while ($row_party = $res_party->fetch()) {
                                    ?>
                                    <option value="<?php echo $row_party['uin']; ?>" <?php if (isset($row) && $row['party_id'] == $row_party['uin']) echo 'selected'; ?>> <?php echo $row_party['name'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                       <div class="form-group">
                        <label for="userFirstName">Candidate Name </label>
                        <input type="text" name="name" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['name']); ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                             <article class="module">
                <header>
                    <h2>Province</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul>
                            <?php
                           $res_province = $obj->select('pradesh');
                            if ($res_province->rowCount() > 0):
                               foreach($res_province as $row_province):
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="province_id" class="province_id"  value="<?php echo $row_province['uin']; ?>" <?php if (isset($row) && $row['province_id'] == $row_province['uin']) echo 'checked'; ?>> <?php echo $row_province['cat01category'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                </section>
            </article>
                        </div>
                <div class="col-md-4">
                             <article class="module">
                <header>
                    <h2>District</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul id="district_id">
                             <?php
                             if(isset($row) && $row['province_id']>0):
                                 $pro_id = $row['province_id'];
                               $res_dist = $obj->db->query("select * from districts where province_id=$pro_id");
                               foreach($res_dist as $row_dist):
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="district_id" class="district_id"  value="<?php echo $row_dist['uin']; ?>" <?php if (isset($row) && $row['district_id'] == $row_dist['uin']) echo 'checked'; ?>> <?php echo $row_dist['district_name'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </section>
            </article>
                        </div>
                                 <div class="col-md-4">
                             <article class="module">
                <header>
                    <h2>Constituency</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul>
                            <?php
                            $res_area = $obj->select("constituency");
                            if ($res_area->rowCount() > 0) {
                                while ($row_area = $res_area->fetch()) {
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="constituency_id"  value="<?php echo $row_area['cat01id']; ?>" <?php if (isset($row) && $row['constituency_id'] == $row_area['cat01id']) echo 'checked'; ?>> <?php echo $row_area['cat01category'] ?>
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
                        </div>
                    </div>
                    
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
                     <article class="module">
                <header>
                    <h2>Candidate Image</h2><br>
                    
                </header>
               
                <section>
                    <div class="bs-upload-image" <?php
                    if ($action == 'add') {
                        echo 'style="display: none;"';
                    }
                    ?> id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                         <?php if (isset($row) && $row['cimage'] != ""): ?>
                            <img src="../uploads/candidate/thumbs/<?php echo $row['cimage']; ?>">
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
    $(".province_id").on("click", function() {
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
