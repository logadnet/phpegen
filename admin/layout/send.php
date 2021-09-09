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
					<div class="card-body" id="generate-div">
						<form class="ajax-form">
							<p>Choose a template to begin</p>
							<p>Theme : <?= (!empty($site->email_theme)) ? $phpEGen->email_themes($site->email_theme)->theme_name : "Select a theme in settings!";?></p>
							<div class="form-group">
								<label>Choose Template</label>
								<select name="email_template" class="form-control">
									<option value="">Choose</option>
									<?php foreach ($phpEGen->email_templates() as $template) {
										?>
										<option value="<?=$template->email_type?>"><?=$template->email_type?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Receiver email (optional)</label>
								<input type="email" class="form-control" name="send_to" placeholder="Receiver email">
							</div>

							<div class="custom-control custom-switch mb-2">
								<input type="checkbox" class="custom-control-input" id="add-vars">
								<label class="custom-control-label" for="add-vars">Add custom variables</label>
							</div>

							<div id="vars-div" style="display: none;">
								<div class="form-row mb-3">
									<div class="col-sm-12 col-md-6 col-lg-6 col-6">
										<input type="text" class="form-control" name="var_keys[]" placeholder="Variable Key">
									</div>
									<div class="col-sm-12 col-md-6 col-lg-6 col-6">
										<input type="text" class="form-control" name="var_values[]" placeholder="Variable Value">
									</div>
								</div>
							</div>
							<button style="display: none;" type="button" id="new-var" class="btn btn-dark btn-sm float-right mb-2">New variable</button><br>
							
							<button type="submit" class="btn btn-primary btn-lg">Send Email</button>
						</form>
					</div>
					<div class="card-body" id="result-div" style="display: none;">
						
					</div>
				</div>

				<script type="text/javascript">
					$("#add-vars").change(function(event) {
						if ($(this).is(':checked')) {
							$("#new-var").show();
							$("#vars-div").show();
							$("#vars-div input").removeAttr('disabled');
						}
						else {
							$("#new-var").hide();
							$("#vars-div").hide();
							$("#vars-div input").attr('disabled', true);
						}
					});
					$("#new-var").click(function(event) {
						$("#vars-div").append($("#vars-div .form-row:first").prop('outerHTML'));
					});
					$("form.ajax-form").on('submit', function(event) {
					    event.preventDefault();
					    var formData = new FormData($(this)[0]);
					    btn = $(this).find("[type=submit]");
					    btn_text = btn.text();

					    btn.text("please wait..");
					    btn.addClass("disabled");
					    btn.attr("disabled", true);

					    var req = ajax_request("./backend/email-actions?action=send", formData);
					    req.done(function(data){
					        if(data.code == 200) {
					            alert(data.msg);
					            btn.text(btn_text);
					            btn.removeClass("disabled");
					            btn.removeAttr("disabled");
					            pjax.loadUrl("./emails");
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