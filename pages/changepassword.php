<?php
$id=$logged_rep['uin'];
$userData=$obj->db->query("select * from u01user where uin= $id");
$user=$userData->fetch();

if(isset($_POST['submit'])){


    $old_pass = $_POST['oldpass'];

    $new_pass = $_POST['newpass'];

    $email  =$_POST['email'];

    $usr->changePassword($id,$old_pass,$new_pass,$email);


}

?>
<form action="" method="post" onsubmit="return chksubmit();">
    <div class="form-group">
        <label for="userPassword">Old Password</label>
        <input type="password" name="oldpass" id="oldpass" class="form-control">
    </div>
    <div class="form-group">
        <label for="userPassword">New Password</label>
        <input type="password" name="newpass" id="newpass" class="form-control">
    </div>
    <div class="form-group">
        <label for="userRePassword">Confirm Password</label>
        <input type="password" name="repass"  class="form-control" id="repass">
    </div>
    <div class="form-group">
        <label for="userRePassword">email</label>
        <input type="email" name="email" value="<?php echo $user['u01email'];?>"  class="form-control" id="repass">
    </div>

    <button type="submit" name="submit" class="btn margin-top btn-primary btn-lg btn-block">Save</button>
</form>

<script type="text/javascript">
    function chksubmit(){
        var pass1 = document.getElementById("newpass").value;
        var pass2 = document.getElementById("repass").value;

        if(pass1 == pass2){
            return true;

        }else{
            alert ("Password not Matched. Re-enter Password");
            document.getElementById("newpass").focus();
            //document.getElementById("newpass").value= "";
            //document.getElementById("repass").value= "";
            return false;
        }
    }

</script>
