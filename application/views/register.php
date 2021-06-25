<!DOCTYPE html>
<html>
<head>
 <title>User Registration</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css?ver=2.0">
 <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>

</head>

<body>
 <div class="container">
  <br />
  <h3 align="center">User Registration</h3>
  <br />
  <div class="panel panel-default">
   <div class="panel-heading">Register</div>
   <div class="panel-body">
    <form method="post" action="<?php echo base_url(); ?>validation">
     <div class="form-group">
      <label>First Name</label>
      
      <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" />
      <span class="text-danger"><?php echo form_error('first_name'); ?></span>
     </div>
     <div class="form-group">
      <label>Last Name</label>
      <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" />
      <span class="text-danger"><?php echo form_error('last_name'); ?></span>
     </div>
     <div class="form-group">
      <label>Phone number(UK Numbers Only Allowed.)</label>
      <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>" />
      <span class="text-danger"><?php echo form_error('phone'); ?></span>
     </div>
     
     <div class="form-group">
      <label>Date of birth </label>
      <input type="text" name="dob" class="form-control datepicker" value="<?php echo set_value('dob'); ?>" />
      <span class="text-danger"><?php echo form_error('dob'); ?></span>
     </div>
     <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" />
      <span class="text-danger"><?php echo form_error('email'); ?></span>
     </div>
     <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" />
      <span class="text-danger"><?php echo form_error('password'); ?></span>
     </div>
     <div class="form-group">
      <label>Country </label>
      <input type="text" name="country" class="form-control" value="UK" disabled/>
      <span class="text-danger"><?php echo form_error('country'); ?></span>
     </div>
     <div class="form-group">
      <label for="sel1">Subscription For </label>
      <select class="form-control" name="subscription_for" id="sel1">
        <option value="">Select Subscription</option>
        <option value="story">Story</option>
        <option value="comment">Comment</option>
        <option value="poll">Poll</option>
      </select>
      <span class="text-danger"><?php echo form_error('subscription_for'); ?></span>
      </div>
     <div class="form-group">
      <input type="submit" id="submit" name="register" value="Register" class="btn btn-success" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>users/login">Login</a>
     </div>
    </form>
   </div>
  </div>
 </div>
</body>
</html>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<script>

$('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            drops: 'up',
            minYear: '1880',
            maxYear: '2021',
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
</script>