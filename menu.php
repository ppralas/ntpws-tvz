<?php 
	print '
	<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
		<li class="nav-item"><a class="nav-link" href="index.php?menu=1">Home</a></li>
		<li class="nav-item"><a class="nav-link" href="index.php?menu=2">Recomendations</a></li>
		<li class="nav-item"><a class="nav-link" href="index.php?menu=3">Contact</a></li>
		<li class="nav-item"><a class="nav-link" href="index.php?menu=4">About</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?menu=5">Gallery</a></li>';
        
		if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
			print '
			<li class="nav-item"><a class="nav-link" href="index.php?menu=6">Sign Up</a></li>
			<li class="nav-item"><a class="nav-link" href="index.php?menu=7">Log in</a></li>';
		}
		else if ($_SESSION['user']['valid'] == 'true') {
			print '
			<li class="nav-item"><a class="nav-link" href="index.php?menu=8">Admin</a></li>
			<li class="nav-item"><a class="nav-link" href="signout.php?menu">Sign Out</a></li>';
		}
		print '
	            </ul>
            </div>
        </div>
    </nav>';
?>