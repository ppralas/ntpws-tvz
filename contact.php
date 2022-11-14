<?php
print'
<body>
    <header class="masthead" style="background-image:url(\'assets/img/contact-bg.jpg\');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container"><iframe allowfullscreen="" frameborder="0" loading="lazy" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCLmgJXjARmQwzKhTY3hZRGEVCQpYpIgwY&amp;q=Ilica%2C+Zagreb&amp;zoom=15" width="100%" height="400"></iframe></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <form  action="http://localhost/projekt/send-contact.php" id="contact_form" name="contact_form" method="POST">
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><input class="form-control" type="text" name ="name" id="name" required="" placeholder="Name"><label class="form-label" for="name">Name</label></div>
                        <div class="form-floating controls mb-3"><input class="form-control" type="text" name ="lastname" id="lastname" required="" placeholder="Last Name"><label class="form-label" for="lastName">Last name</label></div>
                    </div>
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><input class="form-control" type="email" name="email" id="email" required="" placeholder="Email Address"><label class="form-label" for="email">Email Address</label></div>
                    </div>
                    <label>Select your country</label>
                    <div class="form-floating controls mb-3">
                            <select id="country" name="country">
				            <option value="BE">Belgium</option>
				            <option value="HR" selected>Croatia</option>
				            <option value="LU">Luxembourg</option>
				            <option value="HU">Hungary</option>
			                </select>
                    </div>
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><textarea class="form-control" name="message" id="message" data-validation-required-message="Please enter a message." required="" placeholder="Message" style="height: 150px;"></textarea><label class="form-label" for="subject">Message</label></div>
                    </div>
                    <div id="success"></div>
                    <div class="mb-3"><button class="btn btn-primary" id="sendMessageButton" type="submit" style="background: #252424;border-radius: 15px;border-color: rgba(255,255,255,0);">Send</button></div>
                </form>
            </div>
        </div>
    </div>
    <hr>
</body>

' ?>
