<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>StyleKit</title>

	<style type="text/css">
	</style>
</head>
<body>

<div id="container">
<h1 class="guide-title"><strong class="app-title">StyleKit</strong> Guide Library</h1>
<div id="guides-container">

<?php foreach ($guides as $guide): ?>

    <a href="guide/<?=$guide['id']?>" class="guide-container" id="<?=$guide['id']?>">
      <?=$guide['title'] ?>
    </a>

<?php endforeach ?>

<a class="guide-container new-guide" href="/newguide"><strong>+</strong>New Guide</a>

</div>
</div>

</body>
</html>

