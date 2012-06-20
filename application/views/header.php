<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>StyleKit</title>
  <script type="text/javascript" src="/jquery-1.7.2.min.js"></script>
  <link rel="stylesheet" href="/screen.css" />
  <link rel="stylesheet" href="/codemirror/codemirror.css">
  <script src="/codemirror/codemirror.js"></script>
  <script src="/codemirror/mode/javascript/javascript.js"></script>
  <script src="/codemirror/mode/css/css.js"></script>
  <script src="/codemirror/mode/xml/xml.js"></script>
  <script src="/codemirror/mode/htmlmixed/htmlmixed.js"></script>
</head>
<body>
<div id="container">
<?  if($loggedin == true) { ?>
<a class="button sign-out-button" href="/logout">Sign Out</a>
<? } ?>
