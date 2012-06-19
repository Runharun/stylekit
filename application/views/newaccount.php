<h2>Create a new account</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('account/verifycreate') ?>

	<label for="title">Name</label> 
	<input type="input" name="name" /><br />
  <label for="email">Email:</label>
  <input type="text" size="20" id="email" name="email"/>
  <br/>
  <label for="password">Password:</label>
  <input type="password" size="20" id="password" name="password"/>
	
	<input type="submit" name="submit" value="Create" />

</form>
