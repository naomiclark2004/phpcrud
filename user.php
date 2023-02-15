<!-- Header -->
<?php include "header.php" ?>
<?php
if (isset($_GET['handle'])) {
    $handle = $_GET['handle'];
    $query = "SELECT * FROM user WHERE handle='{$handle}'";
    $view_user = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($view_user)) {
        $id = $row['id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $email = $row['email'];
        $bio = $row['bio'];
        $handle = $row['handle'];
    }
    ;

}
?>


<nav class="navbar  navbar-light flex-column flex-md-row bd-navbar" style="margin: 25px;">
    <a class="navbar-brand" href="">Social</a>
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



<div class="container mt-5 ">
    <div class="d-flex justify-content-center" id="container">
        <div class="card" style="width: 80%;">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-center align-items-center rounded"
                    style="height: 140px; background-color: #1DA1F2;">
                </div>
                <div class="d-flex justify-content-end">
                    <a class='btn btn-light m-2' href="/phpcrud/profile-setting.php?handle=<?php echo $handle ?>">Edit
                        Profile</a>
                </div>
            </div>
            <div class="text-center text-sm-left mb-2 p-3 pt-0">
                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap text-start">
                    <?php echo $fname ?>
                    <?php echo $lname ?>
                </h4>
                <p class="mb-0 text-start">@<?php echo $handle ?>
                </p>
                <p class="mb-0 mt-3 text-start">
                    <?php echo $bio ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5" style="width: 62%;">

    <div class="d-flex justify-content-center align-items-center rounded" style="height: 50px;">
        <a href='make-post.php?handle=<?php echo $handle ?>' class='rounded text-center'
            style='font-size:30px; text-decoration:none; color:black; width: 300px; background-color: #1DA1F2;'>+</a>
    </div>

    <div class="row justify-content-evenly mt-5 mb-3">

        <?php
        if (isset($_GET['handle'])) {

            $query = "SELECT * FROM `posts` WHERE post_by= '{$handle}'";

            $view_posts = mysqli_query($conn, $query);

            if (!$view_user) {
                echo "something went wrong" . mysqli_error($conn);
            } else {
                if (mysqli_num_rows($view_posts) > 0) {
                    while ($row = mysqli_fetch_assoc($view_posts)) {
                        $post_by = $row['post_by'];
                        $post_id = $row['id'];
                        $blog_text = $row['blog_text'];
                        $post_date = $row['post_date'];
                        echo " <div class='card mb-3' style='width: 18rem;'>
                <div class='card-body'>
                    <div class='media mb-3 d-flex py-2 justify-content-between border-bottom'>
                        <div class='media-body ml-3'>
                            @$handle
                            </div>
                        <div class='media-body ml-3'>
                        " .
                            $post_date .
                            "
                        </div>
                    </div>
                    <div class='container d-flex justify-content-center mb-3'>
                        <p class='card-text pt-3 pb-3'>
                        " .
                            $blog_text .
                            "
                        </p>
                    </div>
                    <div class='media mt-3 d-flex py-2 justify-content-end'>
                        <a href='delete.php?id=$post_id&handle=$handle' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
                </div> <br>";
                    }
                    ;
                } else {
                    echo "<p class='text-center mt-3 text-muted'>No Posts Yet</p>";
                }
                ;
            }
            ;
        }
        ;


        ?>


    </div>
</div>
</div>
</div>