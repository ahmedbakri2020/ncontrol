<?php
$page = 'plugin-chooser';
$title = 'Choose One plugin ';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
    <article class="module">
        <header>
            <h2><?php echo $title; ?></h2>
         
        </header>
        <section>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Share This Plugin</th>
                   <th>Status</th>
                          <th>Custom Plugin</th>
                          <th>Status</th>
                    </tr>
                    </thead>
                       <tbody>
                        <?php
                        $sn=1;
                        $res_plugin = $obj->db->query("select * from tbl_plugin where cat01id=1");
                        
                        while($row_plugin = $res_plugin->fetch()):
                         $sharestatus = ($row_plugin['sharethis_plugin']=='1')?"<span class='label label-success'>Active</span>":"<span class='label label-danger'>Inactive</span>";
                          $customstatus = ($row_plugin['custom_plugin']=='1')?"<span class='label label-success'>Active</span>":"<span class='label label-danger'>Inactive</span>";
                        ?>
                        <tr>
                            <td><?php echo $sn;?></td>
                            <td> <?php if ($row_plugin['sharethis_plugin'] == 1) { ?>
                                            <a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row_plugin['cat01id'] ?>, 0, 'sharethis_plugin', 'tbl_plugin', 'plugin')" /></a>

                                        <?php } else { ?>
                                            <a href="#"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row_plugin['cat01id'] ?>, 1, 'sharethis_plugin', 'tbl_plugin', 'plugin')" /></a>
                                        <?php } ?></td>
                                        <td><?php echo $sharestatus;?></td>
                            <td> <?php if ($row_plugin['custom_plugin'] == 1) { ?>
                                            <a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $row_plugin['cat01id'] ?>, 0, 'custom_plugin', 'tbl_plugin', 'plugin')" /></a>

                                        <?php } else { ?>
                                            <a href="#"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $row_plugin['cat01id'] ?>, 1, 'custom_plugin', 'tbl_plugin', 'plugin')" /></a>
                                        <?php } ?></td>
                                        <td><?php echo $customstatus;?></td>
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
                    <p>Total: <strong id="total-data"> </strong> </p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="active"><a href="#" id="1">1</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </article>
<?php include 'ajax/pagination-js.php'; ?>
<script type="text/javascript">
    function change_status(id, value, field, table, tbl_type) {

        if (confirm("Are you sure to perform this action ?")) {
            $.ajax({
                url: "actpages/change_status.php",
                type: "post",
                data: {'id': id, 'value': value, 'field': field, 'table': table, 'tbl_type': tbl_type},
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                }

            });
        }

    }
    </script>