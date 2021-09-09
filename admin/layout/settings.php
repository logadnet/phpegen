<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><?=$page?></h1>

		<div class="row">
			<div class="col-12 col-xl-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Site Settings</h5>
						<h6 class="card-subtitle text-muted">SEO & Contact Settings</h6>
					</div>
					<div class="card-body">
						<form class="ajax-form">
							<div class="form-group">
								<label class="form-label">Site Name</label>
								<input type="text" class="form-control" placeholder="Sitename" name="site_name" value="<?=$sitename?>">
							</div>
							
							<div class="form-group">
								<label class="form-label">Site Email</label>
								<input type="email" class="form-control" placeholder="Site email" value="<?=$site->site_email?>" name="site_email">
							</div>
							<div class="form-group">
								<label class="form-label">Site Phone</label>
								<input type="text" class="form-control" placeholder="+234------" value="<?=$site->site_phone?>" name="site_phone">
							</div>
							<div class="form-group">
								<?php
								if (!empty($site->site_logo)) {
									?>
									<a href="<?=$site->site_logo?>" target="_blank">Open</a>
									<?php
								}
								?>
								<label class="form-label">Site Logo (Recommended Width - 1980px: Height - 500px)</label>
								<input type="file" class="form-control" name="site_logo">
							</div>
							<div class="form-group">
								<?php
								if (!empty($site->site_icon)) {
									?>
									<a href="<?=$site->site_icon?>" target="_blank">Open</a>
									<?php
								}
								?>
								<label class="form-label">Site Icon (Recommended Width - 500px: Height - 500px)</label>
								<input type="file" class="form-control" name="site_icon">
							</div>
							<div class="form-group">
								<label class="form-label">Site Address</label>
								<input type="text" class="form-control" placeholder="Site address" value="<?=$site->site_address?>" name="site_address">
							</div>
							
							<input type="hidden" name="save_type" value="site-settings">
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</form>
					</div>
				</div>
			</div>

			<div class="col-12 col-xl-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Social Settings</h5>
						<h6 class="card-subtitle text-muted">Social network settings</h6>
					</div>
					<div class="card-body">
						<form class="ajax-form">
							<div class="form-group">
								<label class="form-label">Facebook Link</label>
								<input type="text" class="form-control" placeholder="Facebook Link" name="facebook_link" value="<?=$site->facebook_link?>">
							</div>
							<div class="form-group">
								<label class="form-label">Instagram Link</label>
								<input type="text" class="form-control" placeholder="Instagram Link" name="instagram_link" value="<?=$site->instagram_link?>">
							</div>
							<div class="form-group">
								<label class="form-label">Twitter Link</label>
								<input type="text" class="form-control" placeholder="Twitter Link" name="twitter_link" value="<?=$site->twitter_link?>">
							</div>
							<div class="form-group">
								<label class="form-label">LinkedIn Link</label>
								<input type="text" class="form-control" placeholder="LinkedIn Link" name="linkedin_link" value="<?=$site->linkedin_link?>">
							</div>
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<input type="hidden" name="save_type" value="social">
						</form>
					</div>
				</div>
			</div>		
		</div>

		<div class="row">
			
			<div class="col-12 col-xl-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Mail Settings</h5>
						<h6 class="card-subtitle text-muted">Email settings</h6>
					</div>
					<div class="card-body">
						<form class="ajax-form">
							<div class="form-group">
								<label class="form-label">Mail Method</label>
								<select name="mail_method" class="form-control">
									<option value="mail">Mail Server</option>
									<option value="smtp" <?=($site->mail_method == "smtp") ? "selected" : null;?> >SMTP</option>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label">Email Theme</label>
								<select name="email_theme" class="form-control">
									<?php foreach ($phpEGen->email_themes() as $theme) {
										?>
										<option value="<?=$theme->id?>" <?=($site->email_theme == $theme->id) ? "selected" : null;?>><?=$theme->theme_name?></option>
										<?php
									}
									?>
								</select>
							</div>
							<?php /*
							<div class="form-group">
								<label class="form-label">SMTP Host</label>
								<input type="text" class="form-control" placeholder="SMTP Host" name="smtp_host" value="<?=$site->smtp_host?>">
							</div>
							<div class="form-group">
								<label class="form-label">SMTP Username</label>
								<input type="text" class="form-control" placeholder="SMTP Username" name="smtp_username" value="<?=$site->smtp_username?>">
							</div>
							<div class="form-group">
								<label class="form-label">SMTP Password</label>
								<input type="text" class="form-control" placeholder="SMTP Password" name="smtp_password" value="<?=$site->smtp_password?>">
							</div>
							*/?>

							<input type="hidden" name="save_type" value="mail">
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$("form.ajax-form").on('submit', function(event) {
			    event.preventDefault();
			    var formData = new FormData($(this)[0]);
			    btn = $(this).find("[type=submit]");
			    btn_text = btn.text();

			    btn.text("please wait..");
			    btn.addClass("disabled");
			    btn.attr("disabled", true);

			    var req = ajax_request("./backend/save-settings", formData);
			    req.done(function(data){

			        if(data.code == 200){
			            alert(data.msg);
			            btn.text(btn_text);
			            btn.removeClass("disabled");
			            btn.removeAttr("disabled");
			        } else {
			            alert(data.msg);
			            btn.text(btn_text);
			            btn.removeClass("disabled");
			            btn.removeAttr("disabled");
			        }
			    });
			    req.fail(function(xhr){
			    	console.log(xhr);
			        btn.text(btn_text);
			        btn.removeClass("disabled");
			        btn.removeAttr("disabled");
			    });
			});
		</script>
	</div>
</main>