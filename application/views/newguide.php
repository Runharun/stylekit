<h2>Create a new guide</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('home/newguide') ?>

	<label for="title">Title</label> 
	<input type="input" name="title" /><br />
  <input type="hidden" name="account_id" value="<?=$account_id?>" />
	
	<input type="submit" name="submit" value="Create" />
  <a href="/">Cancel</a>
</form>
