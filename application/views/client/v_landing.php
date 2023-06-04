<section class="hero--area section-padding-80">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 col-md-7 col-lg-8">
        <div class="tab-content" style="border: 1px solid #393c3d;">
          <?php foreach($article as $index => $value) : ?>
          <?php if($index < 8) : ?>
          <?php if($index == 0) : ?>
          <div class="tab-pane fade show active" id="post-<?php echo $index + 1; ?>" role="tabpanel"
            aria-labelledby="post-<?php echo $index + 1; ?>-tab">
            <div class="single-feature-post video-post bg-img"
              style="background-image: url(<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>">
              <?php else : ?>
              <div class="tab-pane fade" id="post-<?php echo $index + 1; ?>" role="tabpanel"
                aria-labelledby="post-<?php echo $index + 1; ?>-tab">
                <div class="single-feature-post video-post bg-img"
                  style="background-image: url(<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>">
                  <?php endif; ?>

                  <div class="post-content">
                    <a href="<?php
                        echo base_url('client/list_news/');
                        echo $value['type_id'];
                      ?>"
                      class="post-cata <?php echo $value['class'] ?>">
                      <?php echo $value['type_name']; ?>
                    </a>
                    <a href="<?php 
                        echo base_url('client/detail_news/');
                        echo $value['article_id'];  
                      ?>"
                      class="post-title">
                      <?php echo $value['article_title']; ?>
                    </a>
                    <div class="post-meta d-flex">
                      <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                        <?php echo $value['num_view']; ?></a>

                      <a href="#" style="pointer-events: none"></a>
                      <a href="#" id="likenum" style="pointer-events: none"
                        onclick="incrementLike(<?php echo $value['article_id'] ?>, <?php echo $value['num_like']; ?>)"><i
                          class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $value['num_like']; ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="col-12 col-md-5 col-lg-4">
            <ul class="nav vizew-nav-tab" role="tablist">
              <?php foreach($article as $index => $value) : ?>
              <?php if($index < 8) : ?>
              <li class="nav-item" style="width: 100%">
                <?php if($index == 0) : ?>
                <a class="nav-link active" id="post-<?php echo $index+1; ?>-tab" data-toggle="pill"
                  href="#post-<?php echo $index+1; ?>" role="tab" aria-controls="post-<?php echo $index+1; ?>"
                  aria-selected="false">
                  <?php else : ?>
                  <a class="nav-link" id="post-<?php echo $index+1; ?>-tab" data-toggle="pill"
                    href="#post-<?php echo $index+1; ?>" role="tab" aria-controls="post-<?php echo $index+1; ?>"
                    aria-selected="false">
                    <?php endif; ?>

                    <div class="single-blog-post style-2 d-flex align-items-center">
                      <div class="post-thumbnail">
                        <img src="<?php 
                            echo base_url('assets/img/'); 
                            echo $value['image'];  
                          ?>" alt=""
                          style="width: 110px; height: 62px">
                      </div>
                      <div class="post-content" style="width: 100%">
                        <h6 class="post-title">
                          <?php echo $value['article_title']; ?>
                        </h6>
                        <div id="trend-article" class="post-meta d-flex justify-content-between">

                          <span> </span>
                          <span><i class="fa fa-eye" aria-hidden="true"></i>
                            <?php echo $value['num_view']; ?></span>
                          <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <?php echo $value['num_like']; ?></span>
                        </div>
                      </div>
                    </div>
                  </a>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
</section>

<section class="trending-posts-area">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="section-heading">
          <h4>Trending Article</h4>
          <div class="line"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <?php foreach ($article_trend as $index => $value) : ?>

      <div class="col-12 col-md-4">
        <div class="single-post-area mb-80">
          <div class="post-thumbnail">
            <img src="<?php 
                echo base_url('assets/img/');
                echo $value['image'];
              ?>" 
              alt=""
              style="width: 350px; height: 210px">
          </div>

          <div class="post-content">
            <a href="<?php 
                echo base_url('client/list_news/');
                echo $value['type_id'];
              ?>"
              class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
            <a href="<?php 
                echo base_url('client/detail_news/'); 
                echo $value['article_id'];  
              ?>"
              class="post-title"><?php echo $value['article_title']; ?></a>
            <div class="post-meta d-flex">
              <a href="#" style="pointer-events: none"><i class="fa fa-eye">
                  <?php echo $value['num_view']; ?></i></a>
              <a href="#" style="pointer-events: none"></a>
              <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up">
                  <?php echo $value['num_like']; ?></i></a>
            </div>
          </div>
        </div>
      </div>

      <?php endforeach; ?>

    </div>

  </div>
</section>

<section class="vizew-post-area mb-50">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-7 col-lg-8">
        <div class="all-posts-area">

          <div class="section-heading style-2">
            <h4>Latest Article</h4>
            <div class="line"></div>
          </div>
          <div class="featured-post-slides owl-carousel mb-30">

            <?php foreach ($article_latest as $index => $value) : ?>

            <?php if($index < 4) : ?>

            <div class="single-feature-post video-post bg-img"
              style="background-image: url(<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>);">

              <div class="post-content">
                <a href="<?php
                  echo base_url('client/list_news/');
                  echo $value['type_id'];
                ?>"
                  class="post-cata <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                <a href="<?php 
                    echo base_url('client/detail_news/');
                    echo $value['article_id'];
                  ?>"
                  class="post-title"><?php echo $value['article_title']; ?></a>
                <div class="post-meta d-flex">
                  <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                    <?php echo $value['num_view']; ?></a>
                  <a href="#" style="pointer-events: none"></a>
                  <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <?php echo $value['num_like']; ?></a>
                </div>
              </div>
            </div>
            <?php endif;  ?>

            <?php endforeach; ?>

          </div>

          <?php foreach ($article_latest as $index => $value) : ?>

          <?php if($index >= 4) : ?>

          <div class="single-post-area mb-30">
            <div class="row align-items-center">
              <div class="col-12 col-lg-6">
                <div class="post-thumbnail">
                  <img src="<?php 
                    echo base_url('assets/img/');
                    echo $value['image'];
                  ?>" 
                    alt=""
                    style="width: 350px; height: 230px">
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="post-content mt-0">
                  <a href="<?php 
                    echo base_url('client/list_news/');
                    echo $value['type_id'];
                  ?>"
                    class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                  <a href="<?php 
                    echo base_url('client/detail_news/');
                    echo $value['article_id'];
                  ?>"
                    class="post-title mb-2"><?php echo $value['article_title']; ?></a>
                  <div class="post-meta d-flex align-items-center mb-2">
                    <a href="#" class="post-author">By <?php echo $value['author']; ?></a>
                    <i class="fa fa-circle" aria-hidden="true"></i>
                    <a href="#" class="post-date"><?php echo date("M d, Y", $value['created']) ?></a>
                  </div>
                  <p class="mb-2 text-justify">
                    <?php echo $value['article_desc']; ?>
                  </p>
                  <div class="post-meta d-flex">
                    <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                      <?php echo $value['num_view']; ?></a>
                    <a href="#" style="pointer-events: none"></a>
                    <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                      <?php echo $value['num_like']; ?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php endif; ?>

          <?php endforeach; ?>

        </div>
      </div>

      <div class="col-12 col-md-5 col-lg-4">
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
                  alt=""
                  style="width: 110px; height: 62px">
              </div>
              <div class="post-content" style="width:100%">
                <a href="<?php 
                    echo base_url('client/detail_news/');
                    echo $value['article_id'];
                  ?>"
                  class="post-title"><?php echo $value['article_title']; ?></a>
                <div class="post-meta d-flex justify-content-between">
                  <a href="#" style="pointer-events:none"></a>
                  <a href="#" style="pointer-events:none"><i class="fa fa-eye" aria-hidden="true"></i>
                    <?php echo $value['num_view']; ?></a>
                  <a href="#" style="pointer-events:none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
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