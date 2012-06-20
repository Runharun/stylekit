<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>StyleKit</title>
  <script type="text/javascript" src="/jquery-1.7.2.min.js"></script>
  <link rel="stylesheet" type="text/css" media="all" href="/screen.css" />
</head>
<body>
<div id="container">
<?  if($loggedin == true) { ?>
<a class="button sign-out-button" href="/logout">Sign Out</a>
<? } ?>
