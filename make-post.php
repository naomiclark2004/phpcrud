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
        $bio = $row['bio'];
    }
    ;
}


if (isset($_POST['post'])) {
    $textareaValue = trim($_POST['blog_text']);
    $time = date('m/d/y');
    // insert text having apostrophe in it into a SQL table correctly
    $value = str_replace("'", "''", "$textareaValue");
    echo $value;

    $query = "INSERT INTO posts (post_by, blog_text, post_date) VALUES('$handle', '$value','$time')";
    $add_post = mysqli_query($conn, $query);
    if (!$add_post) {
        echo "something went wrong" . mysqli_error($conn);
    } else {
        header("Location: http://localhost:8081/phpcrud/user.php?handle=$handle");
    }
}
?>


<body style="background-color:#3b7bd0;">
    <h1 class="text-center mt-5 text-white ">Make Post</h1>
    <div class="d-flex container mt-5 mb-5 justify-content-center">

        <div class="card" style="width: 50%;">
            <form class="form" action="" method="post">
                <div class="card-body ">
                    <div class="media mb-5 d-flex justify-content-between">
                        <div class="media-body ml-3">
                            @
                            <?php echo $handle ?>
                        </div>
                    </div>
                    <div class="container d-flex justify-content-center mb-4 mt-4">
                        <textarea id="blog_text" name="blog_text" rows="5" cols="300" class="form-control"
                            style="border-color: grey; border-radius: var(--bs-border-radius); border-color: var(--bs-border-color-translucent);" placeholder="Share your thoughts..."></textarea>
                    </div>
                    <div class="container d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" name="post">Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>