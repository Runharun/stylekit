<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>StyleKit</title>
  <script type="text/javascript" src="/jquery-1.7.2.min.js"></script>
  <link rel="stylesheet" type="text/css" media="all" href="/screen.css" />
</head>
<body>
<?  if($loggedin == true) { ?>
<a class="button sign-out-button" href="/logout">Sign Out</a>
<? } ?>
  <div id="sign-in">
    <h1 class="app-title">StyleKit</h1>
<h2>Create a new style guide</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('home/newguide') ?>

	<input class="text-field" type="input" placeholder="Guide Name" name="title" /><br />
  <input type="hidden" name="account_id" value="<?=$account_id?>" />
	
    <hr />
    <a class="form-option" href="/">Cancel</a>
</form>
</body>
</html>
