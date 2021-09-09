<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><?=$page?></h1>

		<div class="row">
			<div class="col-xl-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-right">
							<a href="./add-theme" class="btn btn-dark text-white lazy"><i class="align-middle fe-custom" data-feather="plus" stroke-width="2" width="30"></i></a>
						</div>
						<h5 class="card-title mb-0"><?=$page?></h5>
					</div>
					<div class="card-body table-responsive">
						<p>HTML knowledge may be required</p>
						<table class="data-table not-resp table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Added Date</th>
									<th>Modified Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								foreach ($phpEGen->email_themes() as $theme) {
									$count++;
									?>
									<tr item_id="<?=$phpEGen->encrypt($theme->id)?>">
										<td><?=$count?></td>
										<td><?=$theme->theme_name?></td>
										<td><?=date("d M, Y h:ia", $theme->date)?></td>
										<td><?=date("d M, Y h:ia", $theme->mod_date)?></td>
										<td class="table-action">
											<a href="./add-theme/<?=$theme->id?>" class="lazy"><i class="align-middle" data-feather="edit-2"></i></a>
											<a href="<?=$siteurl?>/preview.php?type=theme&t_id=<?=$theme->id?>" target="_blank" class="edit-item"><i class="align-middle" data-feather="eye"></i></a>
											<a href="javascript:" class="delete-item"><i class="align-middle" data-feather="trash"></i></a>
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

		<script type="text/javascript">
			$(".delete-item").on('click', function(event) {
				event.preventDefault();
				var conf = confirm("Are you sure?");
				if (conf != true) { return false;}
				tr = $(this).closest('tr');
				if (tr.hasClass('child')) {
					tr = tr.prev();
				}
				item_id = tr.attr('item_id');
				var data = {
					item_id:item_id
				}
				var req = ajax_request("./backend/theme-actions?action=delete", data, false);
				req.done(function(data){
				    if(data.code == 200){
				        alert(data.msg);
				        pjax_reload();
				    } else {
				        alert(data.msg);
				    }
				});
				req.fail(function(xhr){
					console.log(xhr.StatusText);
				});
			});
		</script>
	</div>
</main>