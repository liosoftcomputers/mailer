<?php 
	$this->load->view("include/upload_js");
	$image_upload_limit = 1; 
	if($this->config->item('facebook_poster_image_upload_limit') != '')
	$image_upload_limit = $this->config->item('facebook_poster_image_upload_limit'); 
	
	$video_upload_limit = 100; 
	if($this->config->item('facebook_poster_video_upload_limit') != '')
	$video_upload_limit = $this->config->item('facebook_poster_video_upload_limit');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/system/instagram/posting_style.css');?>">
<form action="#" enctype="multipart/form-data" id="auto_poster_form" method="post">
<section class="section section_custom">
	<div class="section-header">
		<h1><i class="fab fa-instagram"></i> <?php echo $page_title; ?></h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item"><a href="<?php echo base_url("instagram_poster"); ?>"><?php echo $this->lang->line("Instagram Posting"); ?></a></div>
			<div class="breadcrumb-item"><?php echo $page_title; ?></div>
		</div>
	</div>	
	<div class="section-body">
		<div class="row justify-content-md-center">			
			<?php include(APPPATH."modules/instagram_poster/views/image_video_post/upload.php");?>
			<div class="col-12 col-md-8 col-lg-5 colmid">
				<div class="card main_card">
					<div class="card-header pb-0 px-2">
						<h4><i class="fas fa-paper-plane"></i> <?php echo $this->lang->line("Create Post"); ?></h4>
					</div>
		          	<div class="card-body p-2">
		          		<ul class="nav nav-tabs w-100" role="tablist">
		          			
		          			<li class="nav-item">
		          				<a id="image_post" class="nav-link post_type active" data-toggle="tab" href="#imagePost" role="tab" aria-selected="false"><i class="fas fa-image"></i> <?php echo $this->lang->line("Image"); ?></a>
		          			</li>
		          			<li class="nav-item">
		          				<a id="video_post" class="nav-link post_type" data-toggle="tab" href="#videoPost" role="tab" aria-selected="false"><i class="fas fa-video"></i> <?php echo $this->lang->line("Video"); ?></a>
		          			</li>
		          		</ul>
			          	<!-- tab body started -->
			          	<div class="tab-content" id="post_tab_content">
							
								<div class="form-group">
									<label><?php echo $this->lang->line('Campaign Name');?></label>
									<input type="input" class="form-control"  name="campaign_name" id="campaign_name">
								</div>

								<div class="form-group">
									<label><?php echo $this->lang->line('Caption'); ?></label>
									<a href="#" data-placement="right"  data-toggle="popover" data-trigger="focus" title="<?php echo $this->lang->line("caption") ?>" data-content="<?php echo $this->lang->line("support Spintax"); ?>, Spintax example : {Hello|Howdy|Hola} to you, {Mr.|Mrs.|Ms.} {{Jason|Malina|Sara}|Williams|Davis}"><i class='fa fa-info-circle'></i> </a>
									<textarea class="form-control" name="message" id="message" placeholder="<?php echo $this->lang->line('Type your message here...');?>"></textarea>
								</div>


								<div class="row">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label><?php echo $this->lang->line("Post to Instagram Accounts");?>
												<a href="#" data-placement="right" data-toggle="popover" data-trigger="focus" title="<?php echo $this->lang->line("Select Account"); ?>" data-content="<?php echo $this->lang->line("Select the account you want to post. You can select multiple account to post."); ?>"><i class='fa fa-info-circle'></i> </a>
											</label>
											<select multiple class="form-control select2 w-100" id="post_to_pages" name="post_to_pages[]">
											<?php
												foreach($account_list as $key=>$val)
												{
													$id=$val['id'];
													$insta_username=$val['insta_username'];
													echo "<option value='{$id}'>{$insta_username}</option>";
												}
											 ?>
											</select>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<div class="form-group">
											<label><?php echo $this->lang->line("Posting Time") ?>
												<a href="#" data-placement="top" data-toggle="popover" data-trigger="focus" title="<?php echo $this->lang->line("Posting Time") ?>" data-content="<?php echo $this->lang->line("If you schedule a campaign, system will automatically process this campaign at mentioned time and time zone. Schduled campaign may take upto 1 hour longer than your schedule time depending on server's processing.") ?>"><i class='fa fa-info-circle'></i> </a>
											</label><br>
										  	<label class="custom-switch mt-2">
												<input type="checkbox" name="schedule_type" value="now" id="schedule_type" class="custom-switch-input" checked>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description"><?php echo $this->lang->line('Post Now');?></span>
										  	</label>
										</div>
									</div>
								</div>	

								<div class="row">
									<div class="schedule_block_item col-12 col-md-6">
										<div class="form-group">
											<label><?php echo $this->lang->line('Schedule time'); ?></label>
											<input placeholder="Time"  name="schedule_time" id="schedule_time" class="form-control datepicker_x" type="text"/>
										</div>
									</div>

									<div class="schedule_block_item col-12 col-md-6">
										<div class="form-group">
											<label><?php echo $this->lang->line('Time zone'); ?></label>
											<?php
											$time_zone[''] =$this->lang->line('Please Select');
											echo form_dropdown('time_zone',$time_zone,$this->config->item('time_zone'),' class="form-control select2 w-100" id="time_zone" required');
											?>
										</div>
									</div>

									<div class=" schedule_block_item col-12 col-md-6">
										<div class="input-group">
										  	<label class="input-group-addon"><?php echo $this->lang->line('repost this post'); ?></label>
										  	<div class="input-group">
					                          	<input type="number" class="form-control" name="repeat_times" id="repeat_times" aria-describedby="basic-addon2">
					                          	<div class="input-group-prepend">
						                            <div class="input-group-text"><?php echo $this->lang->line('Times'); ?></div>
					                          	</div>
				                        	</div>
										</div>
									  	
									</div>
									<div class="col-12 col-md-6">
										<div class="schedule_block_item">
											<div class="form-group">
												<label><?php echo $this->lang->line('time interval'); ?></label>
												<?php
													$time_interval[''] = $this->lang->line('Please Select Periodic Time Schedule');
													echo form_dropdown('time_interval',$time_interval,set_value('time_interval'),' class="form-control select2 w-100" id="time_interval" required');
												?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="clearfix"></div>

								<div class="card-footer padding-0">
									<input type="hidden" name="submit_post_hidden" id="submit_post_hidden" value="image_submit">
									<button class="btn btn-lg btn-primary" submit_type="image_submit" id="submit_post" name="submit_post" type="button"><i class="fas fa-paper-plane"></i> <?php echo $this->lang->line("Submit") ?> </button>
									<a class="btn btn-lg btn-light float-right d_none" onclick='goBack("instagram_poster/image_video",0)'><i class="fas fa-times"></i> <?php echo $this->lang->line("Cancel") ?> </a>
								</div>
						</div>
			        </div>
	          	</div>          
	        </div>
			<?php include(APPPATH."modules/instagram_poster/views/image_video_post/preview.php");?>
		</div>
	</div>
</section>
</form>
<?php include(APPPATH."modules/instagram_poster/views/image_video_post/image_editor.php");?>
<script src="<?php echo base_url('assets/js/system/instagram/posting_common.js');?>"></script>
<script src="<?php echo base_url('assets/js/system/instagram/posting_add.js');?>"></script>
<?php include(APPPATH."modules/instagram_poster/views/image_video_post/upload_requirement.php");?>