<?php include_once("header.php");?>
<div class="container">
  <h2 class="my-3">Register new account</h2>
  <!-- Register User Form -->
  <!-- Navigate to reigster_user.php to deal register user into the database -->
  <form method="POST" action="process_registration.php">
  <div class="form-group row">
    <label for="accountType" class="col-sm-2 col-form-label text-right">Registering as a:</label>
	<div class="col-sm-10">
	  <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="accountType" id="accountBuyer" value="buyer" checked>
        <label class="form-check-label" for="accountBuyer">Buyer</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="accountType" id="accountSeller" value="seller">
        <label class="form-check-label" for="accountSeller">Seller</label>
      </div>
      <small id="accountTypeHelp" class="form-text-inline text-muted"><span class="text-danger">* Required.</span></small>
	</div>
  </div>
    
    <div class="form-group row">
      <label for="UserName" class="col-sm-3 col-form-label text-right">UserName <span class="text-danger">*</span> </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="UserName" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="Fullname" class="col-sm-3 col-form-label text-right">Fullname <span class="text-danger">*</span> </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="Fullname" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="Email" class="col-sm-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="Email" required>
    </div>
    </div>
    <div class="form-group row">
      <label for="Password" class="col-sm-3 col-form-label text-right">Password <span class="text-danger">*</span></label>
      <div class="col-sm-6">
        <input type="Password" class="form-control" name="Password" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="passwordConfirmation" class="col-sm-3 col-form-label text-right">Repeat password <span class="text-danger">*</span></label>
      <div class="col-sm-6">
        <input type="Password" class="form-control" name="passwordConfirmation" placeholder="Enter password again" required>
      </div>
    </div>
    <div class="form-group row">
      <button type="submit" class="btn btn-primary form-control">Register</button>
    </div>
  </form>
  <!-- Hyperlink to login.php if user want to login instead of register -->
  <div class="text-center">Already have an account? <a href="login.php">Login</a></div>
</div>
<?php include_once("footer.php")?>