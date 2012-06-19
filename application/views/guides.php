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

<?php foreach ($guides as $guide): ?>

    <a href="guide/<?=$guide['id']?>" class="guide-container" id="<?=$guide['id']?>">
      <?=$guide['title'] ?>
    </a>

<?php endforeach ?>

<a href="/newguide">New Guide</a>

</div>

</body>
</html>

