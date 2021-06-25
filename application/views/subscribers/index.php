<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Subscribers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subscribers</li>
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
          
  

     
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Subscribers</h3>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="userTable" class="table table-hover text-nowrap">
                  <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Author</th>
                  <th>Subscription For</th>
                  <th>Story Text</th>

            
                </tr>
                </thead>
                  <tbody>
                  <?php if($user_data): ?>                  
                    <?php foreach ($user_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['user_info']['first_name'] .' '. $v['user_info']['last_name']; ?></td>
                        <td><?php echo $v['user_info']['email']; ?></td>
                        <td><?php echo $v['user_info']['phone']; ?></td>
                        <td><?php echo $v['user_info']['author']; ?></td>
                        <td><?php echo $v['user_info']['subscription_for']; ?></td>
                        <td><?php echo $v['user_info']['story_text']; ?></td>

                        <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>

                        
                      <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
    $("#li-users").addClass('menu-open');
    $("#link-users").addClass('active');
    $("#manage-users").addClass('active');
    });
  </script>
