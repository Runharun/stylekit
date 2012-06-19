   <h1>Sign In</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifylogin'); ?>
     <label for="email">Email:</label>
     <input type="text" size="20" id="email" name="email"/>
     <br/>
     <label for="password">Password:</label>
     <input type="password" size="20" id="passowrd" name="password"/>
     <br/>
     <input type="submit" value="Sign In"/>
   </form>
<a href="/account/create">Create account</a>
