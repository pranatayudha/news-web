<div class="vizew-archive-list-posts-area mb-80">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-12">
        <div class="mt-15 mb-50">
          <h4>
            IT News Admin's
          </h4>
          <p>
            Mini review of all article
          </p>
        </div>

        <a href="<?php echo base_url('admin/admin_create_news'); ?>" class="btn btn-success btn-block mb-15">
          <i class="fa fa-plus"></i> Create New
        </a>
        <a href="<?php echo base_url('admin/see_message'); ?>" class="btn btn-dark btn-block mb-15">
          See all the feedback here
        </a>
        <div class="jumbotron">
          <h1>Article</h1>
        </div>
        <?php if($this->session->flashdata('articleDeleted')) : ?>

        <div class="alert alert-danger" id="articleDeleted">
          <?php echo $this->session->flashdata('articleDeleted'); ?>
        </div>

        <?php elseif($this->session->flashdata('articleUpdated')) : ?>

        <div class="alert alert-success" id="articleUpdated">
          <?php echo $this->session->flashdata('articleUpdated'); ?>
        </div>

        <?php endif; ?>
        <div class="form-group justify-content-around row no-gutters">
          <div class="mb-2 mb-md-0 pr-md-1 col-md-7 col-lg-8 input-group">
            <div class="input-group-prepend">
              <i class="input-group-text fa fa-search"></i>
            </div>
            <input type="text" id="searchInput" class="form-control" placeholder="Search Article Title, Article Type"
              onkeyup="filter_list_article_newest() || filter_list_article_latest()">
          </div>
          <div class="mb-2 mb-md-0 pr-md-1 pl-md-1 col-md-5 col-lg-4 input-group">
            <select id="selectSearch" class="form-control" style="-webkit-appearance: menulist">
              <option value="newest" selected>Newest</option>
              <option value="latest">Latest</option>
            </select>
          </div>
        </div>
        <ul class="list-group mb-2" id="listArticleNewest">

          <?php foreach ($article_full as $index => $value) : ?>

          <li class="list-group-item">
            <div class="row">
              <div class="col-md-5">
                <strong>
                  <?php echo $value['article_title']; ?>
                </strong>
                <div class="small">
                  <p class="mb-0">
                    <?php echo $value['type_name']; ?>
                  </p>
                </div>
                <div class="small">
                  <small>
                    <?php echo $value['author']; ?>
                  </small>
                </div>
              </div>
              <div class="col-md-3">
                <p class="mb-0">
                  <strong>Created on:</strong><small>
                    <?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                </p>
                <p class="mb-0">
                  <strong>Updated on:</strong>
                  <small><?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                </p>
              </div>
              <div class="col-md-4">
                <div class="pull-right">
                  <a href="<?php 
                      echo base_url('admin/admin_view_news/');
                      echo $value['article_id'];
                    ?>"
                    class="btn btn-dark">
                    <i class="fa fa-eye"></i> PREVIEW
                  </a href="">
                  <a href="<?php 
                      echo base_url('admin/admin_edit_news/');
                      echo $value['article_id'];
                    ?>"
                    class="btn btn-info">
                    <i class="fa fa-edit"></i> EDIT</a href="">
                  <a href="" class="btn btn-danger" data-toggle='modal'
                    data-target='#modal_delete_<?php echo $value['article_id']; ?>'>
                    <i class="fa fa-trash"></i> DELETE</a href="">
                </div>
              </div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>

        <ul class="list-group mb-2" id="listArticleLatest" style="display: none">

          <?php foreach (array_reverse($article_full) as $index => $value) : ?>

          <li class="list-group-item">
            <div class="row">
              <div class="col-md-5">
                <strong>
                  <?php echo $value['article_title']; ?>
                </strong>
                <div class="small">
                  <p class="mb-0">
                    <?php echo $value['type_name']; ?>
                  </p>
                </div>
                <div class="small">
                  <small>
                    <?php echo $value['author']; ?>
                  </small>
                </div>
              </div>
              <div class="col-md-3">
                <p class="mb-0">
                  <strong>Created on:</strong><small>
                    <?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                </p>
                <p class="mb-0">
                  <strong>Updated on:</strong>
                  <small><?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                </p>
              </div>
              <div class="col-md-4">
                <div class="pull-right">
                  <a href="<?php 
                      echo base_url('admin/admin_view_news/');
                      echo $value['article_id'];
                    ?>"
                    class="btn btn-dark">
                    <i class="fa fa-eye"></i> PREVIEW
                  </a href="">
                  <a href="<?php 
                      echo base_url('admin/admin_edit_news/');
                      echo $value['article_id'];
                    ?>"
                    class="btn btn-info">
                    <i class="fa fa-edit"></i> EDIT</a href="">
                  <a href="" class="btn btn-danger" data-toggle='modal'
                    data-target='#modal_delete_<?php echo $value['article_id']; ?>'>
                    <i class="fa fa-trash"></i> DELETE</a href="">
                </div>
              </div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="table-responsive" style="display: none">
          <div class="jumbotron">
            <h1>Article</h1>
          </div>
          <?php if($this->session->flashdata('articleDeleted')) : ?>

          <div class="alert alert-danger" id="articleDeleted">
            <?php echo $this->session->flashdata('articleDeleted'); ?>
          </div>

          <?php elseif($this->session->flashdata('articleUpdated')) : ?>

          <div class="alert alert-success" id="articleUpdated">
            <?php echo $this->session->flashdata('articleUpdated'); ?>
          </div>

          <?php endif; ?>
          <table class="table" id="table-news2">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Title</th>
                <th class="text-center">Type</th>
                <th class="text-center">Author</th>
                <th class="text-center">Created</th>
                <th class="text-center">Updated</th>
                <th class="text-center">Action</th>
              </tr>admin/admin_delete_news/<?php echo $value['article_id']; ?>'
            </thead>
            <tbody>

              <?php foreach ($article_full as $index => $value) : ?>

              <tr>
                <td class="text-center" width="5%">
                  <?php echo $value['article_id']; ?>
                </td>
                <td width="">
                  <?php echo $value['article_title']; ?>
                </td>
                <td class="text-center" width="10%">
                  <?php echo $value['type_name']; ?>
                </td>
                <td class="text-center" width="10%">
                  <?php echo $value['author']; ?>
                </td>
                <td class="text-center" width="10%">
                  <?php echo date("Y-m-d H:i:s", $value['created']); ?>
                </td>
                <td class="text-center" width="10%">
                  <?php echo date("Y-m-d H:i:s", $value['updated']); ?>
                </td>
                <td width="28%">
                  <div class='text-center'>
                    <a href='<?php 
                        echo base_url('admin/admin_view_news/');
                        echo $value['article_id'];
                      ?>'
                      class='btn btn-dark'>
                      <i class="fa fa-eye"></i> Preview
                    </a>
                    <a href='<?php
                        echo base_url('admin/admin_edit_news/');
                        echo $value['article_id'];
                      ?>'
                      class='btn btn-info'>
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href='' class='btn btn-danger' data-toggle='modal'
                      data-target='#modal_delete_<?php echo $value['article_id']; ?>'>
                      <i class="fa fa-trash"></i> Delete
                    </a>
                  </div>
                </td>
              </tr>

              <?php endforeach; ?>

            </tbody>
          </table>
        </div>

        <?php foreach ($article_full as $index => $value) : ?>

        <div class='modal fade' id='modal_delete_<?php echo $value['article_id']; ?>' tabindex='-1' role='dialog'
          aria-hidden='true'>
          <div class='modal-dialog ' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h6 class='modal-title text-danger'>Are you sure you want to delete <b
                    style="color: #797979"><?php echo $value['article_title']; ?></b> article?
                </h6>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <h7 class='modal-body'>Select 'Delete' below if you are sure to delete this article</h7>
              <div class='modal-footer'>
                <a class='btn btn-sm btn-secondary' href='#' data-dismiss='modal'>Cancel</a>
                <a href='<?php 
                  echo base_url('admin/admin_delete_news/');
                  echo $value['article_id'];
                ?>'
                  class='btn btn-sm btn-danger'>Delete</a>
              </div>
            </div>
          </div>
        </div>

        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>