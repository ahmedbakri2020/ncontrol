<?php
if(isset($_GET['province']) && isset($_GET['district'])):
  $pradesh = $_GET['province'];
  $district = $_GET['district'];
    $pradesh_name = $obj->getDataByField('cat01category','cat01id',$district);
    $title = $pradesh_name['cat01category'];
  $res_query = $obj->db->query("select * from area_subdivision where cid= $district ");
elseif(isset($_GET['province'])):
   $pradesh = $_GET['province'];
    $pradesh_name = $obj->getDataByField('pradesh','uin',$pradesh);
    $title = $pradesh_name['cat01category'];
    $res_query = $obj->db->query("select * from area_subdivision where pradesh_id= $pradesh ");
    
else:
$cid = (int) $_GET['cid'];
$table = 'cat01category';
$res_query = $obj->select('area_subdivision', '*');
$country = $obj->select('cat01category', 'cat01category')->fetch();
endif;
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2><?php echo ucfirst($title) ?>  Palika Division</h2>
         <a href="?fol=form&page=add-palikadivision" title=""><i class="fa fa-plus"></i> Add Data</a>
    </header>
    <section>
        <form method="POST">
        <div class="row">
                    <div class="col-md-2">
                        <div class="form-group country">
                           <select  class="form-control" id="province">
                                <option value="0">------प्रदेश छान्नुहोस्-----</option>
                                <?php $res_pradesh = $obj->select('pradesh');
                                while($row_pradesh = $res_pradesh->fetch()):?>
                                <option value="<?php echo $row_pradesh['uin'];?>" <?php if(isset($_GET['province']) && $_GET['province']==$row_pradesh['uin']): echo 'selected';endif;?> ><?php echo $row_pradesh['cat01category'];?></option>           
                                <?php endwhile;?>
                                </select>
                        </div>
                        
                    </div>
                      <div class="col-md-2">
                        <div class="form-group country">
                           <select  class="form-control" id="district">
                                <option value="0">------जिल्ला छान्नुहोस्-----</option>
                                <?php 
                                if(isset($_GET['province'])):
                                $pro_id = $_GET['province'];
                                $res_dist = $obj->select('cat01category','*',array('type' =>'district',"pradesh_id"=>$pro_id));
                                while($row_dist = $res_dist->fetch()):?>
                                <option value="<?php echo $row_dist['cat01id'];?>" <?php if(isset($_GET['district']) && $_GET['district']==$row_dist['cat01id']): echo 'selected';endif;?>><?php echo $row_dist['cat01category'];?></option>           
                                <?php endwhile;
                                endif;
                                ?>
                                </select>
                        </div>
                        
                    </div>
                     <div class="col-4 border-left pb-2 pt-2">
                                       <button type="button" id="search-result" class="btn ink-reaction btn-raised btn-info" onclick="searchLocalLevel()"><i class="fa fa-search" aria-hidden="true"></i> Search </button>
                                        </div>

                </div>
                </form>

        <?php if ($res_query->rowCount() > 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">


                    <thead>
                        <tr class="active">   
                            <th>S.n</th>
                            <th>Address</th>
                            <th>Division Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php
                        $sn = 1;
                        while ($row = $res_query->fetch()):
                            ?>
                            <tr id="<?php echo $row['aid']; ?>">
                               
                                <td><?php echo $sn; ?></td>                            
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['palika_type']; ?></td>    
                                <td>
                                    <a href="?fol=form&amp;page=add-palikadivision&id=<?php echo $row['aid'] ?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
                                    <a href="<?php echo '?fol=actpages&amp;page=act_delete_locallevel&id=' . $row['aid'].'&pro='.$_GET['province'].'&dist='.$_GET['district'];?>" onclick="return confirm('Delete / Uninstall cannot be undone! Are you sure you want to do this?')" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a>
                                </td>
                            </tr>
                            <?php
                            $sn++;
                        endwhile;
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p><strong>Total Category : </strong> <?php echo $obj->countRow($res_query); ?></p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">                            
                            <li class="active"><a href="#">1</a></li>                          
                        </ul>
                    </nav>
                </div>                  
            </div>
<?php } else { ?>
            <strong>No Contents Found!</strong>  
<?php } ?>

    </section>
</article> <!--test-->
<script>
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
     function searchLocalLevel() {
   if ('0' == $('#province').val()) {
    alert('Please slect Pradesha');
         }else{
   var base_url = '?page=palika_division';
   var selectedProvince = $('#province').val();
   var selectedDistrict = $('#district').val();
   if(selectedProvince){
        base_url += '&province=' +  selectedProvince;
   }
   if(selectedDistrict){
        base_url += '&district=' +  selectedDistrict;
   }
   var search_url = base_url;
   document.location.href = search_url;  
         }
 
}
    </script>
