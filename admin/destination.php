<?php

if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_destination') {
	$_SESSION['message'] = '';
	$query = "INSERT INTO destination (title, description, archive)";
	$query .= " VALUES ('" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', '" . $_POST['archive'] . "')";
	$result = @mysqli_query($MySQL, $query);

	$ID = mysqli_insert_id($MySQL);

	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {

		$ext = strtolower(strrchr($_FILES['picture']['name'], "."));

		$_picture = $ID . '-' . rand(1, 100) . $ext;
		copy($_FILES['picture']['tmp_name'], "assets/img/" . $_picture);

		if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') {
			$_query = "UPDATE destination SET picture='" . $_picture . "'";
			$_query .= " WHERE id=" . $ID . " LIMIT 1";
			$_result = @mysqli_query($MySQL, $_query);
			$_SESSION['message'] .= '<p>You have successfully added an image.</p>';
		}
	}


	$_SESSION['flash_message'] .= '<p>You have successfully added a destination!</p>';
	header("Location: index.php?menu=7&action=2");
}

if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_destination') {
	$query = "UPDATE destination SET title='" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', archive='" . $_POST['archive'] . "'";
	$query .= " WHERE id=" . (int) $_POST['edit'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);

	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {

		$ext = strtolower(strrchr($_FILES['picture']['name'], "."));

		$_picture = (int) $_POST['edit'] . '-' . rand(1, 100) . $ext;
		copy($_FILES['picture']['tmp_name'], "assets/img/" . $_picture);


		if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
			$_query = "UPDATE destination SET picture='" . $_picture . "'";
			$_query .= " WHERE id=" . (int) $_POST['edit'] . " LIMIT 1";
			$_result = @mysqli_query($MySQL, $_query);
			$_SESSION['message'] .= '<p>You have successfully added an image.</p>';
		}
	}

	$_SESSION['message'] = '<p>You have successfully changed a destination!</p>';

	header("Location: index.php?menu=8&action=2");
}

if (isset($_GET['delete']) && $_GET['delete'] != '') {

	$query = "SELECT picture FROM destination";
	$query .= " WHERE id=" . (int) $_GET['delete'] . " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	@unlink("assets/img/" . $row['picture']);

	$query = "DELETE FROM destination";
	$query .= " WHERE id=" . (int) $_GET['delete'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);

	$_SESSION['message'] = '<p>You have successfully deleted from table destination!</p>';

	header("Location: index.php?menu=7&action=2");
}

if (isset($_GET['id']) && $_GET['id'] != '') {
	$query = "SELECT * FROM destination";
	$query .= " WHERE id=" . $_GET['id'];
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	print '
		<h2>Destination overview</h2>
		<div class="destination">
			<img src="assets/img/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
			<h2>' . $row['title'] . '</h2>
			' . $row['description'] . '
			<br>
			<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
			<hr>
		</div>
		<p><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '">Back</a></p>';
} else if (isset($_GET['add']) && $_GET['add'] != '') {

	print '
		<h2>Add Destination</h2>
		<form action="" id="destination_form" name="destination_form" method="POST" enctype="multipart/form-data">
		
			<input type="hidden" id="_action_" name="_action_" value="add_destination">
			
			<div class="mb-3"><input class="form-control" id="title" name="title" placeholder="Title" required></div>

			<div class="mb-3"><textarea class="form-control" id="description" name="description" placeholder="Description..." required></textarea></div>
				
			
			<div class="mb-3">
			<input class="btn btn-primary d-block " type="file" id="picture" name="picture" style="background: #252424;border-color: var(--bs-card-cap-bg);border-radius: 15px;">
            </div>
						
			<label for="archive">Archive:</label><br />
            <input type="radio" name="archive" value="Y"> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N" checked> NO
			
			<hr>
			
			<div class="mb-3">
                <input class="btn btn-primary d-block" type="submit" style="background: #252424;border-color: var(--bs-card-cap-bg);border-radius: 15px;"></input>
            </div>
		</form>
		<p><a class="btn btn-primary d-block" style="background: #252424;border-color: var(--bs-card-cap-bg);border-radius: 15px;" href="index.php?menu=' . $menu . '&amp;action=' . $action . '">Back</a></p>';
} else if (isset($_GET['edit']) && $_GET['edit'] != '') {
	$query = "SELECT * FROM destination";
	$query .= " WHERE id=" . $_GET['edit'];
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	$checked_archive = false;

	print '
		<h2>Edit destination</h2>
		<form action="" id="destination_from_edit" name="destination_from_edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="edit_destination">
			<input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
			
			<label for="title">Title</label>
			<div class="mb-3"><input class="form-control" value="' . $row['title'] . '" id="title" name="title" placeholder="Title" required></div>
		
			<label for="description">Description</label>
			<div class="mb-3"><textarea class="form-control " style= "height:100px!important" id="description" name="description" placeholder="Description..." required>' . $row['description'] . '</textarea></div>
			
			<div class="mb-3">
                <input class="btn btn-primary d-block" type="file" id="picture" name="picture" style="background: #252424;border-color: var(--bs-card-cap-bg);border-radius: 15px;"></input>
            </div>
						
			<label for="archive">Archive:</label><br />
            <input type="radio" name="archive" value="Y"';
	if ($row['archive'] == 'Y') {
		echo ' checked="checked"';
		$checked_archive = true;
	}
	echo ' /> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"';
	if ($checked_archive == false) {
		echo ' checked="checked"';
	}
	echo ' /> NO
			
			<hr>			
			<input type="hidden" id="_action_" name="_action_" value="edit_destination">
			
			<div class="mb-3">
                <input class="btn btn-primary d-block" type="submit" style="background: #252424;border-color: var(--bs-card-cap-bg);border-radius: 15px;"></input>
            </div>
		</form>
		<p><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '">Back</a></p>';
} else {
	print '
		<h2>destination</h2>
			<table>
			<div class="table-responsive">
            <table class="table">
				<thead>
					<tr>
						<th>Overview</th>
                        <th>Edit</th>
                        <th>Delete</th>
						<th>Title</th>
						<th>Description</th>
						<th>Date</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
	$query = "SELECT * FROM destination";
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	while ($row = @mysqli_fetch_array($result)) {
		print '
					<tr>
						<td class = "text-center"><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;id=' . $row['id'] . '">🔦</a></td>
						<td class = "text-center"><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;edit=' . $row['id'] . '">✏</a></td>
						<td class = "text-center"><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;delete=' . $row['id'] . '">🚫</a></td>
						<td>' . $row['title'] . '</td>
						<td>';
		if (strlen($row['description']) > 160) {
			echo substr(strip_tags($row['description']), 0, 160) . '...';
		} else {
			echo strip_tags($row['description']);
		}
		print '
						</td>
						<td>' . pickerDateToMysql($row['date']) . '</td>
						<td>';
		if ($row['archive'] == 'Y') {
			print '<img src="img/inactive.png" alt="" title="" />';
		} else if ($row['archive'] == 'N') {
			print '<img src="img/active.png" alt="" title="" />';
		}
		print '
						</td>
					</tr>';
	}
	print '
				</tbody>
			</table>
			<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink">Add a new destination</a>
		</div>';
}

@mysqli_close($MySQL);
?>