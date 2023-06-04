<div class="container">
  <div class="col-12 col-md-12">
    <h2>News Portal</h2>
    <hr />

    <?php foreach ($news_detail as $index => $value) : ?>
    <form action="<?php 
        echo base_url('admin/admin_update_news/');
        echo $value['article_id'];  
      ?>" method="post"
      enctype="multipart/form-data">

      <div class="form-group">
        <label for="">Title</label>
        <input type="text" name="judul" class="form-control" placeholder="News title"
          value="<?php echo $value['article_title']; ?>" required />
        <br />
      </div>
      <div class="form-group">
        <label for="">Article Type: </label>
        <select name="type_article" id="type_article" class="form-control" style="">
          <option disabled>Choose one</option>

          <?php foreach ($type_name as $index2 => $value2) : ?>

          <option <?php if($value['article_type'] == $value2['type_id']) { echo "selected"; } ?>
            value="<?php echo $value2['type_id']; ?>">
            <?php echo $value2['type_name']; ?>
          </option>

          <?php endforeach; ?>

        </select>
      </div>
      <div class="form-group">
        <label for="desc">Description</label>
        <input type="text" name="summary" class="form-control" placeholder="Article Summary"
          value="<?php echo $value['article_desc'] ?>" required /><br />
      </div>
      <div class="form-group">
        <label for="">Content</label>
        <textarea id="ckeditor" name="berita" class="form-control">
										<?php echo $value['article_content']; ?>
									</textarea><br />
      </div>
      <div class="form-group">
        <p>If you want to change the article picture, choose new image here.</p>
        <input type="file" name="filefoto"><br>
      </div>
      <div class="form-group">
        <button class="btn btn-primary btn-lg" type="submit">Post Article</button>
        <a href="<?php echo base_url('admin'); ?>" class="btn btn-danger btn-lg">
          Cancel
        </a>
      </div>
    </form>
    <?php endforeach; ?>
  </div>
</div>