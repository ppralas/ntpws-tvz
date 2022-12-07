<!DOCTYPE html>
<html lang="en">

<?php
if (1 == 1) {
    print '
    <header class="masthead" style="background-image:url(\'assets/img/home.jpg\');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                    <h1 class="text-center" style="font-weight:2rem"><br>Recomendations</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>';
}
if (isset($action) && $action != '') {
    $query = "SELECT * FROM destination";
    $query .= " WHERE id=" . $_GET['action'];
    $result = @mysqli_query($MySQL, $query);
    $row = @mysqli_fetch_array($result);
    print '
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Good reads</h2>
            </div>
        </div>
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col-md-8 col-xl-6 col-xxl-10 offset-md-2 offset-xl-3 offset-xxl-1">
                <div class="card"><img class="card-img-top w-100 d-block fit-cover" style="height: 600px;" src="assets/img/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
                    <div class="card-body p-4">
                        <p class="text-primary card-text mb-0">Destination :</p>
                        <h4 class="card-title">' . $row['title'] . '</h4>
                        <p class="card-text">' . $row['description'] . '</p>
                        <div class="d-flex">
                            <div>
                                <time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
                                <p class="text-muted mb-0">Patrik Pralas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
';
} else {
    $query = "SELECT * FROM destination";
    $query .= " WHERE archive='N'";
    $query .= " ORDER BY date DESC";
    $result = @mysqli_query($MySQL, $query);

    var_dump($result);

    while ($row = @mysqli_fetch_array($result)) {
        print '
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col-md-8 col-xl-6 offset-md-2 offset-xl-3">
                <div class="card"><img class="card-img-top w-100 d-block fit-cover" src="assets/img/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
                    <div class="card-body p-4">
                        <p class="text-primary card-text mb-0">Destination :</p>
                        <h4 class="card-title">' . $row['title'] . '</h4>';
        if (strlen($row['description']) > 300) {
            echo substr(strip_tags($row['description']), 0, 300) . '... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '" style="blue">More</a>';
        } else {
            echo strip_tags($row['description']);
        }
        print '
                        <div class="d-flex">
                            <div>
                                <time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
                                <p class="text-muted mb-0">Patrik Pralas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
';
    }
}
?>