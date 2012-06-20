<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>StyleKit</title>
  <script type="text/javascript" src="/jquery-1.7.2.min.js"></script>
  <link rel="stylesheet" type="text/css" media="all" href="/screen.css" />
</head>
<body>
  <div id="sign-in">
    <h1 class="app-title">StyleKit</h1>
    <div class="validation-errors">
    <?php echo validation_errors(); ?>
    </div>
    <?php echo form_open('verifylogin'); ?>
      <input class="text-field" type="text" size="20" id="email" placeholder="Email" name="email"/>
      <br/>
      <input class="text-field" type="password" placeholder="Password" size="20" id="password" name="password"/>
      <br/>
      <input class="button submit-button" type="submit" value="Sign In"/>
    </form>
    <hr />
    <a class="form-option" href="/account/create">Create account</a>
  </div>
</body>
</html>
