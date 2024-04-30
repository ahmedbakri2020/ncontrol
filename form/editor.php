

<!--<html>
<head>
 
<meta charset="UTF-8">
<title>Title of the document</title>-->
<?php
$editor_url = 'https://nayapatrikadaily.com/ncontrol/assets/editor/ckeditor/ckeditor.js';
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="<?php echo $editor_url ?>"></script>
<!--</head>-->

<!--<body>-->
  <form method="post">
       <p>
           My Editor:<br>
           <textarea  id="editor" name="editor"></textarea>
 <script>
  var config = {
                                                                customConfig: '',
                                                                height: 700,
                                                                // Add the required plugin
                                                                 extraPlugins: 'simpleuploads',
                                                                // filebrowserBrowseUrl: 'https://nayapatrikadaily.com/assets/ncontent-editor/ckfinder/ckfinder.php?integration=ckeditor&ck_by=nayapatrika',
                                                                // filebrowserImageBrowseUrl: 'https://nayapatrikadaily.com/assets/ncontent-editor/ckfinder/ckfinder.php?Type=Images&integration=ckeditor&ck_by=nayapatrika',
                                                                // filebrowserUploadUrl: 'https://nayapatrikadaily.com/assets/ncontent-editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&integration=ckeditor&ck_by=nayapatrika',
                                                                // filebrowserImageUploadUrl: 'https://nayapatrikadaily.com/assets/ncontent-editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&integration=ckeditor&ck_by=nayapatrika',
                                                                //filebrowserWindowWidth : '1000',
                                                               // filebrowserWindowHeight : '700',
                                                            
    filebrowserBrowseUrl : 'https://nayapatrikadaily.com/assets/ncontent-editor//ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : 'https://nayapatrikadaily.com/assets/ncontent-editor//ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : 'https://nayapatrikadaily.com/assets/ncontent-editor//ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : 'https://nayapatrikadaily.com/assets/ncontent-editor//ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : 'https://nayapatrikadaily.com/assets/ncontent-editor//ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : 'https://nayapatrikadaily.com/assets/ncontent-editor//ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                                                simpleuploads_acceptedExtensions: '7z|avi|csv|doc|docx|flv|gif|gz|gzip|jpeg|jpg|mov|mp3|mp4|mpc|mpeg|mpg|ods|odt|pdf|png|ppt|pxd|rar|rtf|tar|tgz|txt|vsd|wav|wma|wmv|xls|xml|zip'
                                                            };
 
CKEDITOR.replace('editor',config);

 </script>
          
       </p>
       
   </form>
<!--</body>

</html>-->
