<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><?=$page?></h1>

		<div class="row">
			<div class="col-xl-12 col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"><?=$page?></h5>
					</div>
					<div class="card-body table-responsive">
						<table class="data-table not-resp table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>To</th>
									<th>Subject</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								foreach ($phpEGen->all_emails() as $email) {
									$count++;
									?>
									<tr item_id="<?=$phpEGen->encrypt($email->id)?>">
										<td>
											<?=$count?>
										</td>
										<td><?=$email->send_to?></td>
										<td><?=$email->subject?></td>
										<td><?=date("d M, Y h:ia", $email->date)?></td>
										<td class="table-action">
											<div class="btn-group">
											    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											        Actions
											    </button>
											    <div class="dropdown-menu">
											        <a class="dropdown-item" href="<?=$siteurl?>/preview.php?type=email&mail_id=<?=$email->id?>" target="_blank">View email</a>
											    </div>
											</div>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" class="lazy">
			$(".delete-item").on('click', function(event) {
				event.preventDefault();
				tr = $(this).closest('tr');
				if (tr.hasClass('child')) {
					tr = tr.prev();
				}
				item_id = tr.attr('item_id');
				var confirm_action = confirm("Are you sure?");
				if(confirm_action){
					data = {item_id:item_id};
					var req = ajax_request("./backend/mail-actions?action=delete", data, false);
					req.done(function(data){
					    if(data.code == 200){
					        alert(data.msg);
					        tr.remove();
					    } else {
					        alert(data.msg);
					    }
					});
					req.fail(function(xhr){
						alert(xhr.StatusText);
					});
				}
			});
		</script>

	</div>
</main>