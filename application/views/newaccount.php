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
    <h2 class="form-title">Create a new account</h2>
    
    <div class="validation-errors">
    <?php echo validation_errors(); ?>
    </div>
    
    <?php echo form_open('account/verifycreate') ?>
    
    	<input class="text-field" type="input" placeholder="Name" name="name" />
      <input class="text-field" type="text" placeholder="Email" size="20" id="email" name="email"/>
      <input class="text-field" type="password" placeholder="Password" id="password" name="password"/>
    	
    	<input class="button submit-button" type="submit" name="submit" value="Create" />
    
    </form>  
    <hr />
    <a class="form-option" href="/">Cancel</a>
  </div>
</body>
</html>
