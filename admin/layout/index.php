<main class="content">
	<div class="container-fluid p-0">
		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3><strong>Admin</strong> Dashboard</h3>
			</div>

			<div class="col-auto ml-auto text-right mt-n1">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
						<li class="breadcrumb-item active"><a href="./">Admin Panel</a></li>
						<!-- <li class="breadcrumb-item " aria-current="page">Analytics</li> -->
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="w-100">
					<div class="row">
						<div class="col-sm-12 col-md-4 col-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Templates</h5>
										</div>

										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-light">
													<i class="align-middle" data-feather="users"></i>
												</div>
											</div>
										</div>
									</div>
									<h1 class="display-5 mt-1 mb-3"><?=count($phpEGen->email_templates())?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-4 col-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Themes</h5>
										</div>

										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-light">
													<i class="align-middle" data-feather="mail"></i>
												</div>
											</div>
										</div>
									</div>
									<h1 class="display-5 mt-1 mb-3">
										<?=count($phpEGen->email_themes())?>
									</h1>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-4 col-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Sent Emails</h5>
										</div>

										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-light">
													<i class="align-middle" data-feather="list"></i>
												</div>
											</div>
										</div>
									</div>
									<h1 class="display-5 mt-1 mb-3">
										<?=count($phpEGen->all_emails(false))?>
									</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</main>