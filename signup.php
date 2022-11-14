<?php 
	if ($_POST['_action_'] == FALSE) {
		print '
    <header class="masthead" style="background-image: url(\'assets/img/login-signup-bg.jpg\');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="post-heading" style="height: 361px;">
                        <h1 class="text-center"><br>Sign up&nbsp;</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="position-relative py-4 py-xl-5">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-5" style="background: rgba(255,255,255,0);">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <form class="text-center" action="" id="registration_form" name="registration_form" method="POST">
                                                <input type="hidden" id="_action_" name="_action_" value="TRUE">
                                                <div class="mb-3"><input class="form-control" type="text" id="fname" name="firstname" placeholder="Name" required></div>
                                                <div class="mb-3"><input class="form-control" type="text" id="lname" name="lastname" placeholder="Your last natme.." required></div>
                                                <div class="mb-3"><input class="form-control" type="email" id="email" name="email" placeholder="Your e-mail.." required></div>
                                                <div class="mb-3"><input class="form-control" type="text" id="username" name="username" pattern=".{5,10}" placeholder="Username.." required></div>
                                                <div class="mb-3"><input class="form-control" type="password" id="password" name="password" placeholder="Password.." pattern=".{4,}" required></div>
                                                <label for="country">Country:</label>
                                                <select name="country" id="country">';
                                                $query  = "SELECT * FROM countries";
                                                $result = @mysqli_query($MySQL, $query);
                                                while($row = @mysqli_fetch_array($result)) {
                                                    print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
                                                }
                                                print'
                                                </div>
                                                <div class="mb-3">
                                                    <input class="btn btn-primary d-block w-100" type="submit" style="background: #252424;border-color: var(--bs-card-cap-bg);border-radius: 15px;"></input>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </header>';
                                            }
    else if ($_POST['_action_'] == TRUE) {
        $query  = "SELECT * FROM users";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($row['email'] == '' || $row['username'] == '') {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (firstname, lastname, email, username, password, country)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
			$result = @mysqli_query($MySQL, $query);
			
			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', thank you for registration </p>
			<hr>';
		}
		else {
			echo '<p>User with this email or username already exist!</p>';
		}
	}                                 
?>