<div class="vizew-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <?php foreach($detail_news as $index => $value) : ?>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>client"><i class="fa fa-home"
                  aria-hidden="true"></i> Home</a></li>
            <li class="breadcrumb-item">
              <a href="<?php 
                  echo base_url('client/list_news/');
                  echo $value['type_id'];?>
                ">
                  <?php echo $value['type_name']; ?>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $value['article_title'] ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<section class="post-details-area mb-80">
  <div class="container" style="background-color: black; padding: 20px; border-radius: 10px;">


    <div class="row">
      <div class="col-12">
        <div class="post-details-thumb mb-50">
          <img src="<?php
              echo base_url('assets/img/');
              echo $value['image'];
          ?>" 
            alt=""
            style="width: 1100px; height: 400px">
        </div>
      </div>
    </div>

    <div class="row justify-content-center">

      <div class="col-12 col-lg-8 col-xl-8">
        <div class="post-details-content">

          <div class="blog-content">

            <div class="post-content mt-0">
              <a href="<?php
                  echo base_url('client/list_news/');
                  echo $value['type_id'];  
                ?>"
                class="post-cata cata-sm <?php echo $value['class']; ?>">
                <?php echo $value['type_name']; ?>
              </a>
              <a class="post-title mb-2" style="pointer-events: none">
                <?php echo $value['article_title']; ?>
              </a>
              <div class="d-flex justify-content-between mb-30">
                <div class="post-meta d-flex align-items-center">
                  <a href="#" class="post-author">By <?php echo $value['author']; ?></a>
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <a href="#" class="post-date"><?php echo date("M d, Y", $value['created']) ?></a>
                </div>
                <div class="post-meta d-flex">
                  <a id="num-view-main-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"><i
                      class="fa fa-eye" aria-hidden="true"></i>
                    <?php echo $value['num_view']; ?></a>
                  <a id="num-comment-main-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"></a>
                  <a id="num-like-main-<?php echo $value['article_id'] ?>" href="#" id="likenum"
                    onclick="incrementLike(<?php echo $value['article_id'] ?>, <?php echo $value['num_like']; ?>)"><i
                      class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <?php echo $value['num_like']; ?></a>
                </div>
              </div>
            </div>

            <div>
              <?php echo $value['article_content']; ?>
            </div>

            <?php endforeach; ?>
            <div class="related-post-area mt-5">

              <div class="section-heading style-2">
                <h4>Related Post</h4>
                <div class="line"></div>
              </div>

              <div class="row">

                <?php foreach ($related_news as $index => $value) : ?>
                <?php if($index < 2) : ?>

                <div class="col-12 col-md-6">
                  <div class="single-post-area mb-50">

                    <div class="post-thumbnail">
                      <img src="<?php 
                          echo base_url('assets/img/');
                          echo $value['image'];
                        ?>"
                        style="height: 210px; width: 100%" alt="">
                    </div>

                    <div class="post-content">
                      <a href="#"
                        class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                      <a href="<?php 
                          echo base_url('client/detail_news/');
                          echo $value['article_id'];  
                        ?>"
                        class="post-title"><?php echo $value['article_title']; ?></a>
                      <div class="post-meta d-flex">
                        <a id="num-view-related-<?php echo $value['article_id'] ?>" href="#"
                          style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                          <?php echo $value['num_view']; ?></a>

                        <a id="num-comment-related-<?php echo $value['article_id'] ?>" href="#"
                          style="pointer-events: none"></a>
                        <a id="num-like-related-<?php echo $value['article_id'] ?>" href="#"
                          style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                          <?php echo $value['num_like']; ?></a>
                      </div>
                    </div>
                  </div>
                </div>

                <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-12 col-md-4 col-lg-4">
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
                  style="width: 110px; height: 62px" alt="">
              </div>
              <div class="post-content" style="width:100%">
                <a href="<?php
                    echo base_url('client/detail_news/');
                    echo $value['article_id'];
                  ?>"
                  class="post-title"><?php echo $value['article_title']; ?></a>
                <div class="post-meta d-flex justify-content-between">
                  <a id="num-comment-mostview-<?php echo $value['article_id'] ?>" href="#"
                    style="pointer-events: none"></a>
                  <a id="num-view-mostview-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"><i
                      class="fa fa-eye" aria-hidden="true"></i>
                    <?php echo $value['num_view']; ?></a>
                  <a id="num-like-mostview-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"><i
                      class="fa fa-thumbs-o-up" aria-hidden="true"></i>
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
</section>