<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IT News</title>
  <link rel="icon" href="<?php echo base_url('assets/img/core-img/favicon.ico'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

</head>

<body>
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="lds-ellipsis">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <header class="header-area" style="padding: 0 10px">
    <div class="top-header-area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <a href="#">
              Welcome to Admin Page, <?php echo $this->session->userdata('admin-name'); ?>
            </a>
          </div>
          <div class="col-12 col-md-6">
            <div class="top-meta-data d-flex align-items-center justify-content-end">
              <a href="<?php echo base_url('auth/logout'); ?>" class="login-btn">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="vizew-main-menu" id="sticker">
      <div class="classy-nav-container breakpoint-off">
        <div class="container">
          <nav class="classy-navbar justify-content-between" id="vizewNav">

            <a href="<?php echo base_url('client'); ?>" class="nav-brand">IT News</a>

            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <div class="classy-menu">

              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>