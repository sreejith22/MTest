<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css?ver=2.0">
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post">
              <div class="card-body">
              <?php if(validation_errors()){ ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                </div>
              <?php } ?>
 
                <div class="form-group">
                  <label for="fname">First name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?php echo $user_data['first_name'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="lname">Last name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="<?php echo $user_data['last_name'] ?>" autocomplete="off">
                </div>
               
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $user_data['phone'] ?>" autocomplete="off">
                </div>

                <div class="form-group">
      <label>Date of birth </label>
      <input type="text" name="dob" class="form-control datepicker" value="<?php echo date("d-m-Y", strtotime($user_data['dob']))  ?>" />
      <span class="text-danger"><?php echo form_error('dob'); ?></span>
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
        <option value="story"<?php if($user_data['subscription_for']=='story') echo 'selected="selected"'; ?>>Story</option>
        <option value="comment"<?php if($user_data['subscription_for']=='comment') echo 'selected="selected"'; ?>>comment</option>
        <option value="poll"<?php if($user_data['subscription_for']=='poll') echo 'selected="selected"'; ?>>poll</option>
      </select>
      </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user_data['email'] ?>" autocomplete="off">
                </div>                


              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<script type="text/javascript">
  $(document).ready(function() {    
	$("#li-users").addClass('menu-open');
    $("#link-users").addClass('active');
    $("#manage-users").addClass('active');
    
  });
</script>
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