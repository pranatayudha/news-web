<div class="vizew-archive-list-posts-area mb-80">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-12">
				<div class="mt-15 mb-50">
					<h4>
						<a href="<?php echo base_url('admin') ?>" style="text-decoration: none; color: #ffffff !important">
							IT News Admin's
						</a>
					</h4>
					<p>
						All the messages list here
					</p>
				</div>

				<a href="<?php echo base_url('admin'); ?>" class="btn btn-dark btn-block mb-15">
					Back to the article list
				</a>
				<div class="form-group justify-content-arround row no-gutters">
					<div class="mb-2 mb-md-0 pr-md-1 col-md-7 col-lg-8 input-group">
						<div class="input-group-prepend">
							<i class="input-group-text fa fa-search"></i>
						</div>
						<input type="text" id="searchMessage" class="form-control"
							placeholder="Search Message Subject, Message Sender"
							onkeyup="filter_list_message_newest() || filter_list_message_latest()">
					</div>
					<div class="mb-2 mb-md-0 pr-md-1 pl-md-1 col-md-5 col-lg-4 input-group">
						<select id="selectMessages" class="form-control" style="-webkit-appearance: menulist">
							<option value="newest" selected>Newest</option>
							<option value="latest">Latest</option>
						</select>
					</div>
				</div>
				<ul class="list-group mb-2" id="listMessagesNewest">

					<?php foreach($all_messages as $index => $value) : ?>

					<li class="list-group-item">
						<div class="row">
							<div class="col-md-12">
								<strong>
									<?php echo $value['sender_name'].', '.$value['sender_email']; ?>
								</strong>
								<div class="small">
									<p class="mb-0">
										<?php echo $value['subject']; ?>
									</p>
								</div>
								<div class="small">
									<small>
										<?php echo $value['message_text']; ?>
									</small>
								</div>
							</div>
						</div>
					</li>

					<?php endforeach; ?>

				</ul>
				<ul class="list-group mb-2" id="listMessagesLatest" style="display: none">

					<?php foreach(array_reverse($all_messages) as $index => $value) : ?>

					<li class="list-group-item">
						<div class="row">
							<div class="col-md-12">
								<strong>
									<?php echo $value['sender_name'].', '.$value['sender_email']; ?>
								</strong>
								<div class="small">
									<p class="mb-0">
										<?php echo $value['subject']; ?>
									</p>
								</div>
								<div class="small">
									<small>
										<?php echo $value['message_text']; ?>
									</small>
								</div>
							</div>
						</div>
					</li>

					<?php endforeach; ?>

				</ul>
			</div>
		</div>
	</div>
</div>