<div class="vizew-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href=""><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Register
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="vizew-login-area section-padding-80">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6">
        <div class="login-content">
          <div class="section-heading">
            <h4>Create your account, and publish news you want to share!</h4>
            <div class="line"></div>
          </div>
          <?php if(validation_errors()) : ?>
            <div class="alert alert-danger">
              <?php echo validation_errors('<p style="margin: 0; color: black">', '</p>'); ?>
            </div>
          <?php endif; ?>
          <?php if ($this->session->flashdata('regErr')) : ?>
            <div class='alert alert-danger'>
              <?php echo $this->session->flashdata('regErr'); ?>
            </div>
          <?php endif; ?>
          <form action="<?php echo base_url('auth/insert_admin_data'); ?>" method="post">
            <div class="form-group">
              <label for="inputFullname">Full Name</label>
              <input type="text" class="form-control" name="fullname" id="inputFullname" placeholder="Full Name"
                required>
            </div>
            <div class="form-group">
              <label for="inputFullname">Username</label>
              <input type="text" class="form-control" name="username" id="inputUsername" placeholder="User Name"
                required>
            </div>
            <div class="form-group">
              <label for="inputFullname">Email</label>
              <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="inputFullname">Password</label>
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password"
                required>
            </div>
            <button type="submit" class="btn vizew-btn w-100 mt-300" name="register">Register</button>
          </form>
          <div class="form-group text-center">
            <label for="login">
              Already have an account ?
              <a href="<?php echo base_url('auth/login'); ?>" class="text-light">
                Login here !
              </a>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>