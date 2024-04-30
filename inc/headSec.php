<?php
session_start();
include '../system/application_user.php';

if(!$usr->is_loggedin())
{
 $obj->redirect('login.php');
}
$auth = $_SESSION['authid']; 
//var_dump($auth);
//die();
$previlage = $usrPrev->checkPrevilage($auth); 
?>
<!DOCTYPE html>
<html lang="en">
    
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       
        
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">-->
       <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Administrator</title>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
       <!-- <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">-->

        <link href="assets/css/tokenfield-typeahead.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-tokenfield.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">
        <link href="assets/css/dropzone.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/global.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
      <script>
            function showSpinner() {

                try {
                    $("#fountainG").show();
                    $(".fountainG").show();
                } catch (e) {
                    console.log("could not show spinner");
                }
            }

            function hideSpinner() {
                try {
                    $("#fountainG").hide();
                    $(".fountainG").hide();
                } catch (e) {
                    console.log("could not hide spinner");
                }
            }
        </script>
    </head>