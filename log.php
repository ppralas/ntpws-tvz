<?php
if ($_POST['_action_'] == FALSE) {
    print '
<header class="masthead" style="background-image: url(\'assets/img/login-signup-bg.jpg\');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative" style="height: 500px;">
                    <div class="post-heading" style="height: 40%;">
                        <h1 class="text-center"><br>Log in</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="position-relative py-4 py-xl-5">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-5" style="background: rgba(255,255,255,0);">
                            <div class="card-body d-flex flex-column align-items-center">
                           
                                <form class="text-center" action="" name="myForm" id="myForm" method="POST">
                                    <input type="hidden" id="_action_" name="_action_" value="TRUE">

                                    <div class="mb-3"><input class="form-control" type="text" name="username" placeholder="Username"></div>

                                    <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>

                                    <div class="mb-3"><button class="btn btn-primary d-block w-100" name="submit" type="submit" style="background: #252424;border-color: rgba(255,255,255,0);border-radius: 15px;">Login</button></div>
                                </form>';
                            }
                            else if ($_POST['_action_'] == TRUE) {
		
                                $query  = "SELECT * FROM users";
                                $query .= " WHERE username='" .  $_POST['username'] . "'";
                                $query .= " AND archive='N'";
                                $result = @mysqli_query($MySQL, $query);
                                $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
                                
                                if (password_verify($_POST['password'], $row['password'])) {
                                    #password_verify https://secure.php.net/manual/en/function.password-verify.php
                                    $_SESSION['user']['valid'] = 'true';
                                    $_SESSION['user']['id'] = $row['id'];
                                    $_SESSION['user']['firstname'] = $row['firstname'];
                                    $_SESSION['user']['lastname'] = $row['lastname'];
                                    $_SESSION['message'] = '<p id="message">Welcome, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
                                    # Redirect to admin website
                                    header("Location: index.php?menu=7");
                                }
                                
                                #Bad username or password
                                else {
                                    unset($_SESSION['user']);
                                    $_SESSION['message'] = '<p id="message">You have entered wrong email or password!</p>';
                                    header("Location: index.php?menu=7");
                                }
                            }
                                print '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>'
?>
<script>
  setTimeout(function(){
    document.getElementById('message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 1500);
</script>