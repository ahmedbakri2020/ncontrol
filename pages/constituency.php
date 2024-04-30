<?php
$res_query = $obj->select('constituency');
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Constituency</h2>
         <a href="?fol=form&page=add-constituency" title=""><i class="fa fa-plus"></i> Add Data</a>
    </header>
    <section>
        <?php if ($res_query->rowCount() > 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                        <tr class="active">   
                            <th>S.n</th>
                            <th>Constituency</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php
                        $sn = 1;
                        while ($row = $res_query->fetch()):
                            ?>
                            <tr id="<?php echo $row['cat01id']; ?>">
                               
                                <td><?php echo $sn; ?></td>                            
                                <td><?php echo $row['cat01category']; ?></td>
                                <td>
                                    <a href="?fol=form&page=add-constituency&id=<?php echo $row['cat01id'] ?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
                                    <a href="<?php echo '?fol=actpages&page=act_constituency&action=delete&id=' . $row['cat01id']?>" onclick="return confirm('Delete / Uninstall cannot be undone! Are you sure you want to do this?')" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a>
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
