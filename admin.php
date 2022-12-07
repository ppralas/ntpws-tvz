<?php
if ($_SESSION['user']['valid'] == 'true') {
	if (!isset($action)) {
		$action = 1;
	}
	print '
		<header class="masthead" style="background-image:url(\'assets/img/contact.jpg\');">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-lg-8 mx-auto position-relative">
						<div class="site-heading">
							<h1>Administration</h1>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="col-md-6 col-xl-4">
		<div class="mb-3">
			<a class="d-block w-100" href="index.php?menu=8&amp;action=1">Users</a>
		</div>
		<div class="mb-3">
		<a class="d-block w-100" href="index.php?menu=8&amp;action=2">Destinations</a>
		</div>
		</div>';
	# Admin Users
	if ($action == 1) {
		include("admin/users.php");
	}

	# Admin destination
	else if ($action == 2) {
		include("admin/destination.php");
	}
	print '
		</div>';
} else {
	$_SESSION['message'] = '<p>Please register or login using your credentials!</p>';
	header("Location: index.php?menu=7");
}
?>