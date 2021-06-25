<!DOCTYPE html>
<html>
<head>
    <title>User Login System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">User Login System</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <?php
                if($this->session->flashdata('message'))
                {
                    echo '
                    <div class="alert alert-success">
                        '.$this->session->flashdata("message").'
                    </div>
                    ';
                }
                ?>
                <form method="post" action="<?php echo base_url(); ?>login/validation">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" />
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" />
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-success" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>