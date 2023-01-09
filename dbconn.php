<?php
# Stop Hacking attempt
if (!defined('__APP__')) {
	die("Hacking attempt");
}

# Connect to MySQL database
$MySQL = mysqli_connect("localhost", "patrik", "patrik123", "patrik");
if (mysqli_connect_errno()) {
	throw new RuntimeException('mysqli connection error: ' . mysqli_connect_error());
}