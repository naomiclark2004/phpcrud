<!-- Header -->
<?php include "header.php" ?>
<?php
if (isset($_GET['handle'])) {
    $handle = $_GET['handle'];
    $h = $handle;
    $query = "SELECT * FROM user WHERE handle='{$handle}'";
    $view_user = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($view_user)) {
        $id = $row['id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $email = $row['email'];
        $handle = $row['handle'];
    }
    ;

}

?>

<nav class="navbar navbar-light flex-column flex-md-row bd-navbar" style="margin: 25px 50px;">
    <a class="navbar-brand fadein" href="/phpcrud/user.php?handle=<?php echo $handle ?>">
        <img src="logo.png" width="100px">
    </a>
    <div id="navbarNav">
        <ul class="navbar-nav flex-row" style="column-gap: 15px;">
            <li class="nav-item active">
                <a class="nav-link" href="/phpcrud/user.php?handle=<?php echo $handle ?>">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/phpcrud/dashboard.php?handle=<?php echo $handle ?>">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/phpcrud/search.php?handle=<?php echo $handle ?>">Search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/phpcrud/">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container d-flex justify-content-center">
    <div class="panel" id="followers">
        <div class="panel-heading">
            <h3 class="panel-title mb-5 text-center">
                Users
            </h3>
        </div>
        <?php
        $query = "SELECT * FROM user WHERE handle!= '{$handle}' ORDER BY handle ASC";
        $view_users = mysqli_query($conn, $query);

        if (!$view_users) {
            echo "something went wrong" . mysqli_error($conn);
        } else {
            if (mysqli_num_rows($view_users) > 0) {
                while ($row = mysqli_fetch_assoc($view_users)) {
                    $fname = $row['firstname'];
                    $lname = $row['lastname'];
                    $other_h = $row['handle'];
                    $other_id = $row['id'];
                    echo "<div class='card flex-d flex-row justify-content-between p-4' style='width: 18rem;'>
                    <div class='media-body ml-3'>   
                        @" . $other_h .
                        "</div>
                    <div class='media-body ml-3'>
                    <a href='following.php?handle=$h&other=$other_h' id='follow'>
                    Follow
                    </a>
                    </div>
                </div> <br>";
                }
                ;
            }
            ;
        }
        ;
        ?>

    </div>
</div>