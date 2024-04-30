<?php
$type=$_GET['type'];
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from tbl_epaper where epaper_type=$type order by epaper_id desc";
$url = "?page=manage_paper";
$res_epaper = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
?>
<script type="text/javascript">
function delete_issue(epaper_id)
{
	alert(epaper_id);    
    if(confirm('Sure to delete ?'))
        {
			 $.ajax({
		   
	           url:'actpages/page_ordering.php',
    	       type:'post',
            data:{"epaper_id":epaper_id},
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
}

</script>

<div class="row">
   
    <div class="col-md-12 col-lg-12">
        <article class="module">
            <header>
                <h2>Epaper</h2>
                <a href="?fol=form&amp;page=add-epaper&type=<?php echo $type ?>" title=""><i class="fa fa-plus"></i> Add New</a>
            </header>
            <section>
            
                <div class="table-responsive">
                    <table class="table table-hover" id="news-table">
                        
                        <thead>
                            
                            <tr class="active">
                                <th>Sn</th>
                                <th>Title</th>
                                <th>Add Epaper</th>
                             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                      <?php
                          $sn=1;
                          while($row_epaper = $res_epaper[0]->fetch()){
                         
                          
                        ?>
                            <tr>
                                <th><?php echo $sn++;?></th>
                                <td><?php echo $row_epaper['epaper_name'];?></td>
                               
                                <td><a href="?page=add_paper&epaper_id=<?php echo $row_epaper['epaper_id'];?>&type=<?php echo $type;?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Add Epaper</a></td>
                                <!--<td><?php echo $row_type['posted_on'];?></td>-->
                               <td><a href="?fol=form&page=add-epaper&action=edit&id=<?php echo $row_epaper['epaper_id'];?>&type=<?php echo $row_epaper['epaper_type'];?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a><a href="?fol=actpages&amp;page=act_paperdel&delete=<?php echo $row_epaper['epaper_id'];?>&type=<?php echo $row_epaper['epaper_type'];?>" title="" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-close"></i>Delete</a></td>
                            </tr>
                            <?php
                          }
                          ?>
                         
                       

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 total-news-count">
                        <p><strong>Total Video Category : </strong> 50</p>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </article>
    </div>
</div>
<script>


                                                    $(function () {
                                                        $('#datePicker').datetimepicker({
                                                            format: "YYYY-MM-DD",
                                                            showTodayButton: true,
                                                            showClose: true
                                                        });
                                                        $('.timePicker').datetimepicker({
                                                            format: 'LT',
                                                            showClose: true
                                                        });
                                                    });
</script>