<!-- Header -->
<?php include "header.php" ?>
<?php
if (isset($_GET['handle'])) {
    $handle = $_GET['handle'];
    $query = "SELECT * FROM user WHERE handle= '{$handle}'";
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

<nav class="navbar  navbar-light flex-column flex-md-row bd-navbar" style="margin: 25px 50px;">
    <a class="navbar-brand" href="/phpcrud/user.php?handle=<?php echo $handle ?>">Social</a>
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
                <a class="nav-link" href="/phpcrud">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<h3 class="panel-title mb-5 text-center">
    Dashboard
</h3>

<div class="container mt-5 mb-5">
    <div class="d-flex flex-column">
        <div class="col-lg-6" style="margin: 0 auto; width: 50%;">
            <div class="card mb-4">
                <div class="card-body ">
                    <div class="media mb-3 d-flex justify-content-between">
                        <div class="media-body ml-3">
                            <a href='' style='text-decoration: none;'>
                                @social_offical
                            </a>
                        </div>
                        <div class="media-body ml-3 ">
                            2/3/2023
                        </div>
                    </div>
                    <p class="border-top pt-3">
                        Welcome to this social media app! Thank you for joining!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php
    // find friends of of id
    $find = "SELECT friendname FROM friend_list WHERE username = '{$handle}'";
    $findfriend = mysqli_query($conn, $find);
    if (!$findfriend) {
        echo "something went wrong" . mysqli_error($conn);
    } else {
        while ($row = mysqli_fetch_assoc($findfriend)) {
            $theirname = $row['friendname'];
            $posts = "SELECT * FROM posts WHERE post_by = '{$theirname}' ";
            $find_posts = mysqli_query($conn, $posts);
            if (mysqli_num_rows($find_posts) > 0) {
                while ($r = mysqli_fetch_assoc($find_posts)) {
                    $post_by = $r['post_by'];
                    $post_id = $r['id'];
                    $blog_text = $r['blog_text'];
                    $post_date = $r['post_date'];
                    echo "
                    <div class='d-flex flex-column'>
        <div class='col-lg-6' style='margin: 0 auto; width: 50%;'>
            <div class='card mb-4'>
                <div class='card-body'>
                    <div class='media mb-3 d-flex justify-content-between'>
                        <div class='media-body ml-3'>
                            <a href='' style='text-decoration: none;'>
                                @$post_by
                            </a>
                        </div>
                        <div class='media-body ml-3'>
                            $post_date
                        </div>
                    </div>
                    <p class='border-top pt-3'>
                        $blog_text
                    </p>
                </div>
            </div>
        </div>
    </div>
                    ";
                }
            } else if (!$findfriend) {
                echo "something went wrong" . mysqli_error($conn);
            }

        }
        ;
    }
    ?>
</div>