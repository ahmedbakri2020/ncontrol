<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Administrator</title>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <link href="assets/css/tokenfield-typeahead.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-tokenfield.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <!--Header-->
	<?php require_once('header.php');?>
	<form>
		<div class="row">
			<div class="col-sm-12">
				<article class="module">
					<header>
						<h2>Company Contact Info</h2>
					</header>
					<section>
						<div class="form-group">
							<label for="companyName">Name</label>
							<input type="text" class="form-control" id="companyName">
						</div>
						<div class="form-group">
							<label for="companyAddress">Address</label>
							<input type="text" class="form-control" id="companyAddress">
						</div>
						<div class="form-group">
							<label for="companyEmail">Email</label>
							<input type="text" class="form-control tokenfield" id="companyEmail" placeholder="Type & Hit Enter">
						</div>
						<div class="form-group">
							<label for="companyContact">Contact</label>
							<input type="number" class="form-control" id="companyContact">
						</div>
						<div class="form-group">
							<label for="facebookProfileURL">Facebook Profile</label>
							<div class="input-group">
								<div class="input-group-addon">https://www.facebook.com/</div>
								<input type="text" class="form-control" id="facebookProfileURL">
							</div>
						</div>
						<div class="form-group">
							<label for="twitterProfileURL">Twitter Profile</label>
							<div class="input-group">
								<div class="input-group-addon">https://www.twitter.com/</div>
								<input type="text" class="form-control" id="twitterProfileURL">
							</div>
						</div>
						<div class="form-group">
							<label for="googlePlusProfileURL">Google Plus Profile</label>
							<div class="input-group">
								<div class="input-group-addon">https://plus.google.com/u/1/</div>
								<input type="text" class="form-control" id="googlePlusProfileURL">
							</div>
						</div>
						<div class="form-group">
							<label for="youTubeChanel">Youtube Chanel</label>
							<div class="input-group">
								<div class="input-group-addon">https://www.youtube.com/user/</div>
								<input type="text" class="form-control" id="youTubeChanel">
							</div>
						</div>
						<div id="video-preview">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src=""></iframe>
							</div>
						</div>
						
					</section>
				</article>
				<article class="module margin-top">
					<header>
						<h2>Advertisement Contact Info</h2>
					</header>
					<section>
						<div class="form-group">
							<label for="advertisementCompanyName">Name</label>
							<input type="text" class="form-control" id="advertisementCompanyName">
						</div>
						<div class="form-group">
							<label for="advertisementContactPerson">Contact Person</label>
							<input type="text" class="form-control" id="advertisementContactPerson">
						</div>
						<div class="form-group">
							<label for="advertisementPhone">Phone</label>
							<input type="text" class="form-control" id="advertisementPhone">
						</div>
						<div class="form-group">
							<label for="advertisementEmail">Email</label>
							<input type="text" class="form-control" id="advertisementEmail">
						</div>
						<div class="form-group">
							<label for="content-editor">Advertisement Description</label>
							<textarea id="content-editor" class="form-control"></textarea>
						</div>
					</section>
				</article>
				<button type="submit" class="btn margin-top btn-primary btn-lg">Publish</button>
			</div>
		</div>
	</form>
	
	<?php require_once('footer.php');?>
	<script src="assets/js/bootstrap-tokenfield.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="assets/js/require.js"></script>
	<script>
		$('.tokenfield').tokenfield();
		CKEDITOR.replace( 'content-editor' );
	</script>
  </body>
</html>