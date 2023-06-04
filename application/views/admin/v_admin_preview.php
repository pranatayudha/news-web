<div class="vizew-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <?php foreach($news_detail as $index => $value) : ?>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin"><i class="fa fa-home"
                  aria-hidden="true"></i> Admin</a></li>
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
          <img src="<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>" alt=""
            style="width: 1100px; height: 400px; border: 1px solid white">
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <!-- Post Details Content Area -->
      <div class="col-12 col-lg-12 col-xl-12">
        <div class="post-details-content">
          <!-- Blog Content -->
          <div class="blog-content">
            <!-- Post Content -->
            <div class="post-content mt-0">
              <a href="<?php echo base_url(); ?>client/list_news/<?php echo $value['type_id']; ?>"
                class="post-cata cata-sm <?php echo $value['class']; ?>">
                <?php echo $value['type_name']; ?>
              </a>
              <a href="#" class="post-title mb-2">
                <?php echo $value['article_title']; ?>
              </a>
              <div class="d-flex justify-content-between mb-30">
                <div class="post-meta d-flex align-items-center">
                  <a href="#" class="post-author">By <?php echo $value['author']; ?></a>
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <a href="#" class="post-date"><?php echo date("M d, Y", $value['created']); ?></a>
                </div>
                <div class="post-meta d-flex">
                  <a id="num-view-main-<?php echo $value['article_id'] ?>" href="#"
                    style="pointer-events: none; color:#a6a6a6"><i class="fa fa-eye" aria-hidden="true"></i>
                    <?php echo $value['num_view']; ?></a>
                  <!-- <a id="num-comment-main-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none; color:#a6a6a6"><i class="fa fa-comments-o" aria-hidden="true"></i> 32</a> -->
                  <a id="num-comment-main-<?php echo $value['article_id'] ?>" href="#"
                    style="pointer-events: none; color:#a6a6a6"></a>
                  <a id="num-like-main-<?php echo $value['article_id'] ?>" href="#" id="likenum"
                    style="pointer-events: none; color:#a6a6a6"
                    onclick="incrementLike(<?php echo $value['article_id'] ?>, <?php echo $value['num_like']; ?>)"><i
                      class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <?php echo $value['num_like']; ?></a>
                </div>
              </div>
            </div>

            <?php echo $value['article_content']; ?>

            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>