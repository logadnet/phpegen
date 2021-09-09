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
							<p class="text-danger">Be careful when editing variables ({{var}})</p>
							<div class="form-group">
								<label>Theme Name</label>
								<input type="text" class="form-control" placeholder="Email Header" name="theme_name" value="<?=(!empty($theme->theme_name)) ? $theme->theme_name : null;?>">
							</div>
							<div class="form-group stop">
								<label>Theme Header (HTML is allowed)</label>
								<textarea class="form-control summernote" name="theme_header"><?=(!empty($theme->theme_header)) ? $theme->theme_header : null;?></textarea>
							</div>
							<div class="form-group stop">
								<label>Theme body (HTML is allowed)</label>
								<textarea class="form-control summernote" name="theme_body"><?=(!empty($theme->theme_body)) ? $theme->theme_body : null;?></textarea>
							</div>
							<div class="form-group stop">
								<label>Theme Footer (HTML is allowed)</label>
								<textarea class="form-control summernote" name="theme_footer"><?=(!empty($theme->theme_footer)) ? $theme->theme_footer : null;?></textarea>
							</div>
							
							<button type="submit" class="btn btn-primary btn-lg"><?=(!empty($theme->id)) ? "Save" : "Add";?> Theme</button>
						</form>

					</div>
				</div>

				<script type="text/javascript">
					$("form.ajax-form").on('submit', function(event) {
					    event.preventDefault();
					    var formData = new FormData($(this)[0]);
					    btn = $(this).find("[type=submit]");
					    btn_text = btn.text();

					    html_header = $('[name=theme_header]').summernote('code');
					    html_body = $('[name=theme_body]').summernote('code');
					    html_footer = $('[name=theme_footer]').summernote('code');
					    formData.append('theme_footer', html_header);
					    formData.append('theme_body', html_body);
					    formData.append('theme_footer', html_footer);

					    btn.text("please wait..");
					    btn.addClass("disabled");
					    btn.attr("disabled", true);

					    <?php if(!empty($theme->id)):?>
				    	formData.append('theme_id', "<?=$theme->id?>");
		    		    var req = ajax_request("./backend/theme-actions?action=edit", formData);
		    	        <?php else:?>
					    var req = ajax_request("./backend/theme-actions?action=add", formData);
		    	    	<?php endif?>

					    req.done(function(data){
					        if(data.code == 200) {
					            alert(data.msg);
					            btn.text(btn_text);
					            btn.removeClass("disabled");
					            btn.removeAttr("disabled");
					            pjax.loadUrl("./email-themes");
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