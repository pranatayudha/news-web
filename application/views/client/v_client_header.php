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
  <style>
  .post-details-area.mb-80 img {
    border: 1px solid white !important;
  }
  </style>
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

  <header class="header-area">
    <div class="top-header-area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <div class="breaking-news-area d-flex align-items-center">
              <div class="news-title">
                <label> You can login as an admin by clicking to the icon people in right bar. </label>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="top-meta-data d-flex align-items-center justify-content-end">
              <div class="top-social-info">
                <a href="https://www.instagram.com/_prntyudha/" target="_blank" data-toggle="tooltip"
                  data-placement="top" title="Instagram">
                  <i class="fa fa-instagram"></i>
                </a>
                <a href="https://twitter.com/pranatayudha_" target="_blank" data-toggle="tooltip" data-placement="top"
                  title="Twitter">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="<?php echo base_url('client/contact'); ?>" data-toggle="tooltip" data-placement="top"
                  title="Get in touch!">
                  <i class="fa fa-phone"></i>
                </a>
              </div>
              <a href="<?php echo base_url('client/login'); ?>" class="login-btn" data-toggle="tooltip"
                data-placement="top" title="Login as Admin"><i class="fa fa-user" aria-hidden="true"></i></a>
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

              <div id="classynav" class="classynav">
                <ul>
                  <li id="tab-0">
                    <a href="<?php echo base_url('client'); ?>">ALL</a>
                  </li>

                  <?php foreach ($type_name as $index => $value) : ?>

                  <li id="tab-<?php echo $value['type_id']; ?>"
                    class="<?php if($this->uri->segment(3) == $value['type_id']) echo 'active' ?>">
                    <a
                      href="<?php echo base_url(); ?>client/list_news/<?php echo $value['type_id']; ?>"><?php echo $value['type_name']; ?></a>
                  </li>

                  <?php endforeach; ?>

                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>