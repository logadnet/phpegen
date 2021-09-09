<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><?=$page?></h1>

		<div class="row">
			<div class="col-xl-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-right">
						</div>
						<h5 class="card-title mb-0"><?=$page?></h5>
					</div>
					<div class="card-body">
						<form class="ajax-form">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" placeholder="Email Header" name="email_type" value="<?=(!empty($template->email_type)) ? $template->email_type : null;?>">
								<p class="text-danger"><b>*Use underscores (_) instead of spaces, avoid special characters (&,%,#)*</b></p>
							</div>
							<div class="form-group">
								<label>Email Header</label>
								<input type="text" class="form-control" placeholder="Email Header" name="email_header" value="<?=(!empty($template->email_header)) ? $template->email_header : null;?>">
							</div>
							<div class="form-group">
								<label>Email Subject</label>
								<input type="text" class="form-control" placeholder="Email Subject" name="email_subject" value="<?=(!empty($template->email_subject)) ? $template->email_subject : null;?>">
							</div>
							<div class="form-group">
								<label>Email Summary</label>
								<input type="text" class="form-control" placeholder="Email Summary" name="email_summary" value="<?=(!empty($template->email_summary)) ? $template->email_summary : null;?>">
							</div>
							<div class="form-group stop">
								<label>Email body (HTML is allowed)</label>
								<p class="text-danger">Be careful when editing variables ({{var}})</p>
								<p>Scroll down to see variables guide</p>
								<textarea id="summernote" class="form-control" name="email_body"><?=(!empty($template->email_body)) ? $template->email_body : null;?></textarea>
							</div>
							
							<button type="submit" class="btn btn-primary btn-lg"><?=(!empty($template->id)) ? "Save" : "Add";?> Template</button>
						</form>

					</div>
				</div>

				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Global Variables Guide</h5>
					</div>
					<div class="card-body table-responsivee">
						<p>These variables can only be used in the email body</p>
						<p>Variables can be edited in settings</p>
						<table class="data-table not-respp table table-striped">
							<thead>
								<tr>
									<th>Description</th>
									<th>Variable</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<?php /* foreach ($phpEGen->email_variables() as $variable) {
									?>
									<tr>
									    <td><?=$variable->description?></td>
									    <td>{{<?=$variable->key?>}}</td>
									    <td><?=$variable->value?></td>
									</tr>
									<?php
								} */
								?>
								<tr>
								    <td>Site name</td>
								    <td>{{sitename}}</td>
								    <td><?=$site->site_name?></td>
								</tr>
								<tr>
								    <td>Site Url</td>
								    <td>{{siteurl}}</td>
								    <td><?=$site->siteurl?></td>
								</tr>
								<tr>
								    <td>Site logo</td>
								    <td>{{sitelogo}}</td>
								    <td><?=$site->site_logo?></td>
								</tr>
								<tr>
								    <td>Site icon</td>
								    <td>{{siteicon}}</td>
								    <td><?=$site->site_icon?></td>
								</tr>
								<tr>
								    <td>Site address</td>
								    <td>{{siteaddress}}</td>
								    <td><?=$site->site_address?></td>
								</tr>
								<tr>
								    <td>Date (Year)</td>
								    <td>{{date}}</td>
								    <td><?=date("Y")?></td>
								</tr>
								<tr>
								    <td>Date (Full)</td>
								    <td>{{date_full}}</td>
								    <td><?=date("d M, Y")?></td>
								</tr>
								<tr>
								    <td>Facebook link</td>
								    <td>{{facebook_link}}</td>
								    <td><?=$site->facebook_link?></td>
								</tr>
								<tr>
								    <td>Instagram link</td>
								    <td>{{instagram_link}}</td>
								    <td><?=$site->instagram_link?></td>
								</tr>
								<tr>
								    <td>twitter link</td>
								    <td>{{twitter_link}}</td>
								    <td><?=$site->twitter_link?></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
				<script type="text/javascript">
					$("form.ajax-form").on('submit', function(event) {
					    event.preventDefault();
					    var formData = new FormData($(this)[0]);
					    btn = $(this).find("[type=submit]");
					    btn_text = btn.text();

					    htmlcode = $('#summernote').summernote('code');
					    formData.append('email_body', htmlcode);

					    btn.text("please wait..");
					    btn.addClass("disabled");
					    btn.attr("disabled", true);

					    <?php if(!empty($template->id)):?>
				    	formData.append('template_id', "<?=$template->id?>");
		    		    var req = ajax_request("./backend/template-actions?action=edit", formData);
		    	        <?php else:?>
					    var req = ajax_request("./backend/template-actions?action=add", formData);
		    	    	<?php endif?>

					    req.done(function(data){
					        if(data.code == 200){
					            alert(data.msg);
					            btn.text(btn_text);
					            btn.removeClass("disabled");
					            btn.removeAttr("disabled");
					            pjax.loadUrl("./email-templates");
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
		</div>

		
	</div>
</main>