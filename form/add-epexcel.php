<?php
if ($obj->getREQUEST('id')) {
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField($table, 'cat01id', $id);
    $action = "edit";
} else {
    $action = "add";
}
?>
<div class="main-card card" style="
     margin-top: 35px;
     ">

    <div class="card-body">
        <h5 class="card-title"> Add Excel  </h5>
        <form method="POST" action="?fol=actpages&page=act_adedexcel" enctype="multipart/form-data" id="form-data">

            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label for="exampleEmail" class="">Import File</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="card-header">
                        <input type="hidden" name="id" value="<?php if (isset($row)) echo $row['uin']; ?>"/>

                        <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                        <button type="submit" title=""  class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
            </div>


        </form>
    </div>
</div>
