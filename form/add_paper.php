<script>
var all_chk = false;
function checkedAll(frm) 
{
	if(all_chk == false)
		all_chk = true;
	else
		all_chk = false;
	
	for (var i =0; i < frm.elements.length; i++)
	{ 
		if(frm.elements[i].type == "checkbox")
			frm.elements[i].checked = all_chk;	
	}
}
</script>
<?php
$type=$_GET['type'];
$res_1 = $obj->db->query("select * from tbl_epaper where epaper_type=$type order by epaper_id desc");
$epaper_id = $_GET['epaper_id'];
$ras_paper = $obj->db->query("select * from tbl_epaper where epaper_id = '$epaper_id' order by epaper_id desc");
$row_paper=$ras_paper->fetch();
//var_dump($row_paper);
$path = "../epaper/pages/".$row_paper['folder_name']."/large/";

$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 50;
$sql = "SELECT * from tbl_paper where epaper_id = '$_GET[epaper_id]' order by page_order asc";
$res_query = $obj->db->query("$sql");
$count_query = $res_query->rowCount();
$url = "?page=add_image&epaper_id=$_GET[epaper_id]";
$res = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
/*
if(isset($_POST['btn_gallary_image']))
{
	$type = $_FILES['image_file']['type'];
	$ext = "";
	if($type == "image/png")
		$ext = "png";
	elseif($type == "image/gif")
		$ext = "gif";
	elseif($type == "application/pdf")
		$ext = "pdf";
	elseif($type == "image/jpeg")
		$ext = "jpg";
	elseif($type == "image/bmp")
		$ext = "bmp";		
	elseif($type == "image/pjpeg")
		$ext = "jpg";
				
	if($ext != "")
	{	
		$uploadPath = "../epaper/pages/".$row_paper['directory_name']."/large/";
		$destPath = "../epaper/pages/".$row_paper['directory_name']."/medium/";
               // var_dump($destPath);
		$cnt1 = $obj->db->query("select * from tbl_paper where epaper_id = '$_GET[epaper_id]'");
                $cnt=$cnt1->rowCount();
		$page_order = $cnt + 1;
		$obj->tbl = "tbl_paper";
		$obj->val = array("paper_name"=>"","paper_loc"=>"","page_order"=>$page_order,"epaper_id"=>$_GET['epaper_id']);
		$id = $obj->insert();
               
		//for uploading image
		$temp_name = $_FILES['image_file']['tmp_name'];
		$img_name = $_POST['image_name'].".".$ext;
               // var_dump($img_name);
		$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		if(file_exists($uploadPath.$img_name))
		$obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,443,600);
                $obj->val = array("paper_loc"=>$img_name);
		$obj->cond = array("id"=>$id);
		$obj->update();
		$obj->redirect($_SERVER['HTTP_REFERER']);
	}	
}
*/

//to delete images
if(isset($_POST['btn_delete_gallery_images']))
{
	$ado->tbl = "tbl_paper";
	$id = $_POST['id'];
	foreach($id as $key=>$val)
	{
		$delete = "delete".$val;
		if(isset($_POST[$delete]))
		{
			$paper_image = $_POST['paper_image'][$key];
			$file = $path.$paper_image;
			$file1 = $path."large/".$paper_image;
			if(file_exists($file))
				@unlink($file);
			if(file_exists($file1))
				@unlink($file1);
               $obj->db->query("delete from tbl_paper where id = '$val'");
		}
	}
	$obj->redirect($_SERVER['HTTP_REFERER']);
}


?>
<script type="text/javascript">
function paper_ordering(id,page_order)
{
               //alert(id+'----------'+page_order);
			   $.ajax({
		   
	           url:'actpages/change_ordering.php',
    	       type:'post',
               data:{"id":id,"page_order":page_order},
	           dataType:'json',
    	      success:function(response)
            {
                if(response.status==1)
                    {
                        location.reload();
                    }
            }
            });
}
</script>

<div class="form-group">
    <select class="form-control" name="album" onchange="window.location='?page=add_paper&type=1&epaper_id='+this.value">
              <option value="">-Select a Paper-</option>
              <?php while($ras_1 = $res_1->fetch())
		{
		 ?>
              <option value="<?php echo $ras_1['epaper_id'];?>" <?php if($ras_1['epaper_id']==$_GET['epaper_id']) echo "selected";?>><?php echo $ras_1['epaper_name']?></option>
              <?php
		 }
		 ?>
            </select>
</div>
 <?php
    if(isset($_GET['epaper_id'])&&!empty($_GET['epaper_id']))
		{
		?>
<div class="row">
   <?php
if(!empty($res))
{
?>
     <div class="col-md-7 col-lg-8">
        <article class="module">
            <header>
                <h2><?php echo $row_paper['epaper_name'];?> Epaper</h2>
               <!-- <a href="?fol=form&amp;page=add-audio&type=<?php echo $type ?>" title=""><i class="fa fa-plus"></i> Add Audio</a>-->
            </header>
            <section>
      <div class="table-responsive">
                    <table class="table table-hover" id="news-table">
                        
                        <thead>
                            
                            <tr class="active">
                                <th><input type="checkbox" name="checkall" onclick="return checkedAll(this.form);" /></th>
                                <th>image</th>
                              <!--  <th>order</th>-->
                                <th>Action</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                             <?php
					$count = 0;
					while($ras = $res[0]->fetch())
					{
                                          
						$img_name = "../epaper/pages/".$row_paper['directory_name']."/medium/".$ras['paper_loc'];
                                              //  var_dump($img_name);
						//$img_big = $path.$ras['img_name'];
					?>
                      
                           <tr>
                                <th><input type="checkbox" name="delete<?php echo $ras['id'];?>" /></th>
                                <td><img src="<?php echo $img_name;?>" style="height:150px;width:150px"/>
                                 <input type="hidden" name="id[]" value="<?php echo $ras['id'];?>" />
                    <input type="hidden" name="paper_image[]" value="<?php echo $ras['paper_image'];?>" />
                                
                                </td>
                            <!--    <td>
                                    <select name="page_order" onchange="paper_ordering('<?php echo $ras['id']?>',this.value)">
                
                        <?php //for($i=0; $i<=$count_query; $i++)
                        {
                           ?>
                            
                       <!--  <option value="<?php //echo $i;?>" <?php //if($i == $ras['page_order']) echo "selected";?>><?php echo $i;?></option>-->
                    <?php
                        }?><!--</select>
                                    
                               </td>-->
                               <td><a href="?fol=actpages&amp;page=act_delepaper&delete=<?php echo $ras['id'];?>&type=<?php echo $ras['epaper_id'];?>" title="" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete')" ><i class="fa fa-close"></i>Delete</a></td>
                            
                               </tr>
                               <?php
                               $count++;
                                        }
                                        ?>
                         
                      
                        </tbody>
                           </table>
         
                </div>
            </section>
        </article>
     </div>
    <?php


  if(count($res[1])>1)
  {
  ?>
  <tr>
    <td style="text-align:center;"><?php echo " ".implode(" ",$res[1])." ";?></td>
  </tr>
  <?php
  }
}
 
?>
   <div class="col-md-5 col-lg-4">
        <article class="module">
            <header>
                <h2>Add New Paper</h2>
            </header>
            <section>
                <form method="post" enctype="multipart/form-data" action="?fol=actpages&page=act_adedpaper">
                     <div class="" id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                          
                       
                    </div>
               
                 
                 
                    <div class="form-group">
                        <label for="photoGalleryTitle">Image(1115px width and 1443px height or above)</label>
                      <!--  <input type="file" name="image_file" onchange="readURL(this);" class="form-control" id="image">-->
                        <input type="file" onchange="readURL(this);" name="file" class="form-control"  id="Image"/> 
                        <input type="hidden"  name="epaper_id" class="form-control"  value="<?php echo $epaper_id ?>"/> 
                    </div>
                    <div class="form-group">
                        <label for="photoGalleryTitle">Image Order(*Required)</label>
                      <!--  <input type="file" name="image_file" onchange="readURL(this);" class="form-control" id="image">-->
                        <input type="number"  name="image_name" class="form-control"  id="Image"/> 
                    </div>
                    
                     <input type="hidden" name="action" value="<?php echo  $action ?>" />
                     <td><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>"></td>
                      <td><input type="hidden" name="id" value="<?php echo $row['r_id']; ?>"></td>
                <div class="form-group">
                    <button type="submit" name="btn_gallary_image" class="btn btn-primary" onclick="return confirmdelete(this.form,'Are you sure to delete selected images?');">Submit</button>
                </div>
                </form>
            </section>
        </article>
    </div>
    
    
</div>
<?php
                }
                ?>
<script>

 function readURL(input) {

                                                      if (input.files && input.files[0]) {
                                                           var reader = new FileReader();

                                                           reader.onload = function (e) {
                                                                //alert(e.target.result);
                                                               $('#thumbnail').show();
                                                               $('#thumbnail').html('<img src="' + e.target.result + '"  height="200"/>');

                                                            };

                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }


</script>