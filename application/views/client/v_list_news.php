<div class="vizew-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('client'); ?>"><i class="fa fa-home"
                  aria-hidden="true"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              <?php echo $article[0]['type_name'] ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="vizew-archive-list-posts-area mb-80">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <?php foreach ($article as $index => $value) : ?>
        <div class="single-post-area style-2">
          <div class="row align-items-center">
            <div class="col-12 col-md-6">
              <div class="post-thumbnail">
                <img src="<?php 
                  echo base_url('assets/img/');
                  echo $value['image'];
                ?>"
                  style="height: 210px; width: 100%" alt="">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="post-content mt-0">
                <a href="#"
                  class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                <a href="<?php 
                    echo base_url('client/detail_news/');
                    echo $value['article_id'];
                  ?>"
                  class="post-title mb-2"><?php echo $value['article_title']; ?></a>
                <div class="post-meta d-flex align-items-center mb-2">
                  <a href="#" class="post-author" style="pointer-events: none">By
                    <?php echo $value['author']; ?></a>
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <a href="#" class="post-date"
                    style="pointer-events: none"><?php echo date("M d, Y", $value['created']); ?></a>
                </div>
                <p class="mb-2 text-justify"><?php echo $value['article_desc'] ?></p>
                <div class="post-meta d-flex">
                  <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true""></i> <?php echo $value['num_view']; ?></a>
                                                <a href=" #"></a>
                  <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true""></i> <?php echo $value['num_like']; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php endforeach; ?>
    </div>

                    <div class=" col-12 col-md-5 col-lg-4">
                      <div class="sidebar-area">

                        <div class="single-widget mb-50">
                          <div class="section-heading style-2 mb-30">
                            <h4>Most Viewed</h4>
                            <div class="line"></div>
                          </div>

                          <?php foreach ($article_most_viewed as $index => $value) : ?>
                          <div class="single-blog-post d-flex">
                            <div class="align-self-center post-thumbnail">
                              <img src="<?php 
                                  echo base_url('assets/img/');
                                  echo $value['image'];
                                ?>"
                                style="height: 66px" alt="">
                            </div>
                            <div class="post-content">
                              <a href="<?php 
                                echo base_url('client/detail_news/');
                                echo $value['article_id'];
                              ?>"
                                class="post-title"><?php echo $value['article_title']; ?></a>
                              <div class="post-meta d-flex justify-content-between">
                                <a href="#"></a>
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                  <?php echo $value['num_view']; ?></a>
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                  <?php echo $value['num_like']; ?></a>
                              </div>
                            </div>
                          </div>

                          <?php endforeach; ?>

                        </div>

                      </div>
                </div>
              </div>
            </div>
          </div>