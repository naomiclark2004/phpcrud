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
        $pass = $row['pass'];
        $bio = $row['bio'];
    }
    ;
}

if (isset($_POST['change'])) {

    $fname_new = $_POST['fname_new'];
    $lname_new = $_POST['lname_new'];
    $email_new = $_POST['email_new'];
    $handle_new = $_POST['handle_new'];
    $pass_new = $_POST['pass_new'];
    $bio_new = $_POST['bio_new'];

    // insert text having apostrophe in it into a SQL table correctly
    $bio_new = str_replace("'", "''", "$bio_new");
    
    if ($bio_new === "") {
        $bio_new = $bio;
    }


    $query = "UPDATE user SET firstname = '{$fname_new}' , lastname = '{$lname_new}' , email= '{$email_new}' , handle= '{$handle_new}', pass= '{$pass_new}', bio = '{$bio_new}'  WHERE id = $id";
    $update_user = mysqli_query($conn, $query);

    if (!$update_user) {
        echo "something went wrong" . mysqli_error($conn);
    } else {
        header("Location: http://localhost:8081/phpcrud/user.php?handle=$handle_new");
    }
}


?>
<!-- Body -->


<div class="container mt-5 border p-3">
    <h1 class="text-start p-3">Setting</h1>
    <div class="tab-content pt-3">
        <div class="tab-pane active">
            <form class="form" novalidate="" action="" method="post">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="fname_new" placeholder=""
                                        value="<?php echo $fname ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="handle_new" placeholder="johnny.s"
                                        value="<?php echo $handle ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="lname_new" placeholder=""
                                        value="<?php echo $lname ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" placeholder="user@example.com"
                                        name="email_new" value="<?php echo $email ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-group">
                                    <label>Bio</label>
                                    <textarea class="form-control" rows="5" placeholder="<?php echo $bio ?>"
                                        name="bio_new"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" placeholder="••••••••••••"
                                        name="pass_new" value="<?php echo $pass ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" name="change">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="container mt-5 p-2">
    <a class="btn btn-primary" href="/phpcrud/user.php?handle=<?php echo $handle ?>">Back</a>
</div>