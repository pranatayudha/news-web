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
              Login
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
        <?php echo validation_errors('<div class="alert alert-danger regError">', '</div>'); ?>
        <?php if($this->session->flashdata('userErr')) { echo "<div class='alert alert-danger'>" . $this->session->flashdata('userErr') . "</div>"; } ?>
        <div class="login-content">
          <div class="section-heading">
            <h4>Great to have you back!</h4>
            <div class="line"></div>
          </div>

          <form action="<?php echo base_url('auth/login'); ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="username" id="exampleInputText" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" name="password" id="exampleInputPassword1" class="form-control"
                placeholder="Password">
            </div>
            <div class="form-group">
              <span>Note:</span>
              <label>
                You can use username: admin, and password: admin123 for default or you can register new account.
              </label>
            </div>
            <button type="submit" class="btn vizew-btn w-100 mt-300">Login</button>
          </form>
          <div class="form-group text-center">
            <label for="register">
              Doesn't have an account ? <a href="<?php echo base_url('auth/register'); ?>" class="text-light">Register
                Here!</a>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>