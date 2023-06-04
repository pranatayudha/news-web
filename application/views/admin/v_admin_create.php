<div class="container">
	<div class="col-12 col-md-12">
		<h2>News Portal</h2>
		<hr />
		<form action="<?php echo base_url('admin/admin_save_news');?>" method="post" enctype="multipart/form-data">
			<div class="form-group mb-0">
				<label for="">Title</label>
				<input type="text" name="judul" class="form-control" placeholder="Article Title" required /><br />
			</div>
			<div class="form-group">
				<label for="">Article Type: </label>
				<select name="type_article" id="type_article" class="form-control" style="-webkit-appearance: menulist">
					<option disabled selected>Choose one</option>
					<?php foreach ($type_name as $index => $value) : ?>

					<option value="<?php echo $value['type_id']; ?>">
						<?php echo $value['type_name']; ?>
					</option>

					<?php endforeach; ?>

				</select>
			</div>
			<div class="form-group">
				<label for="desc">Description</label>
				<input type="text" name="summary" class="form-control" placeholder="Article Short Description"
					required /><br />
			</div>
			<div class="form-group">
				<label for="">Content</label>
				<textarea id="ckeditor" name="berita" class="form-control"></textarea><br />
			</div>
			<div class="form-group">
				<input type="file" name="filefoto" required><br>
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-lg" type="submit">Post Article</button>
				<a href="<?php echo base_url('admin'); ?>" class="btn btn-danger btn-lg">
					Cancel
				</a>
			</div>
		</form>
	</div>
</div>