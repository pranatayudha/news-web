<div class="vizew-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#"><i class="fa fa-home" aria-hidden="true"></i>
                Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<section class="contact-area mb-80">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-7 col-lg-8">
        <div class="section-heading style-2">
          <h4>Get in touch</h4>
          <div class="line"></div>
        </div>

        <p style="font-size: 20px">If you have feedback for this website or want to sponsoring this website
          please message us. Thank you</p>

        <div class="contact-form-area mt-50">
          <?php echo $this->session->flashdata('msg'); ?>
          <?php echo validation_errors('<div class="alert alert-danger regError">', '</div>'); ?>
          <form action="<?php echo base_url(); ?>client/send_feedback" method="post">
            <div class="form-group">
              <label for="from_name">Name*</label>
              <input type="text" class="form-control" id="from_name" autocomplete="off" name="from_name" required>
            </div>
            <div class="form-group">
              <label for="subject">Subject*</label>
              <input type="text" class="form-control" id="subject" autocomplete="off" name="from_subject" required>
            </div>
            <div class="form-group">
              <label for="from_email">Email*</label>
              <input type="email" class="form-control" id="from_email" autocomplete="off" name="from_email" required>
            </div>
            <div class="form-group">
              <label for="message">Message*</label>
              <textarea name="from_message" class="form-control" id="message" cols="30" rows="10" required></textarea>
            </div>
            <button class="btn vizew-btn mt-30" type="submit">Send Now</button>
          </form>
        </div>
      </div>

      <div class="col-12 col-md-5 col-lg-4"></div>
    </div>
  </div>
</section>