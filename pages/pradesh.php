<?php
 $getData = $obj->select('pradesh', "*");
?>
<article class="module">
    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <h2>Pradesh</h2>
       
    </header>
    <section>
       
        <?php if ($getData->rowCount() > 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                        <tr class="active">   
                            <th>Sn</th>
                            <th>Pradesh</th> 
                        </tr>
                    </thead>
                    
                <form id="election">
                    <tbody id="sortable">
                        <?php
                        $sn = 1;
                        while ($row = $getData->fetch()):
                            ?>
                            <tr id="<?php echo $row['uin']; ?>">
                                  <td><?php echo $sn; ?></td>
                                <td><?php echo $row['cat01category']; ?></td>
                               

                            </tr>
                            <?php
                            $sn++;
                        endwhile;
                        ?>
                    </tbody>
                  </form>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p><strong>Total Category : </strong> <?php echo $obj->countRow($getData); ?></p>
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
</article> 


