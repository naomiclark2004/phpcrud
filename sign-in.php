<!-- Header -->
<?php include "header.php" ?>
<!-- Body -->

<?php
//on create form submit
if (isset($_POST['search'])) {
    $handle = $_POST['handle'];
    $pass = $_POST['pass'];

    $query = " SELECT * FROM user WHERE handle='$handle'";
    $search_user = mysqli_query($conn, $query);
    //compare user inout for password and password in database
    // only open user profile page is they match 
    while ($row = mysqli_fetch_assoc($search_user)) {
        $correct = $row['pass'];
    }
    ;

    if ($correct === $pass) {
        echo "<script type='text/javascript'>alert('Right')</script>";
        header("Location: http://localhost:8081/phpcrud/user.php?handle=$handle");
    } else {
        echo "<script type='text/javascript'>alert('Wrong!')</script>";
    }
    ;
}
?>

<div class="container w-50 mt-5">
    <!-- login or Social Name-->
    <div class="pt-5 welcome" >
        <h1 class="header" style="color: #687E8D;">Welcome back,</h1>
        <p class="text">
            Enter your information below to sign in!
        </p>
    </div>
    <div class="container welcome">
        <form action="" method="post">
            <div class="form-group">
                <label for="handle" class="form-label">Username</label>
                <input type="text" name="handle" class="form-control" minlength="6" patterm="^[A-Za-z0-9_]{1,15}$
" required placeholder="username1234">
            </div>

            <div class="form-group">
                <label for="pass" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" minlength="8"
                    pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" required placeholder="password1234">
            </div>

            <div class="form-group">
                <input type="submit" name="search" class="btn primary mt-2" value="Submit">
            </div>
        </form>

        <br>
        <a href="reset.php" class="d-flex justify-content-end mt-2">Forgot password?</a>
    </div>

    </form>

    <footer class="footer mt-5 welcome"> Need an account?
        <a href="index.php" class="mt-2">Sign Up</a>
    </footer>
    </body>

    </html>
</div>

</div>