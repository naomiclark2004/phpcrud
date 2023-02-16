<!-- Header -->
<?php include "header.php" ?>
<!-- Body -->

<?php
//on create form submit
if (isset($_POST['create'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $handle = $_POST['handle'];
    $pass = $_POST['pass'];

    // insert text having apostrophe in it into a SQL table correctly
    $fname = str_replace("'", "''", "$fname");
    $lname = str_replace("'", "''", "$lname");

    $query = "INSERT INTO user(firstname, lastname, email, handle, pass) VALUES('{$fname}', '{$lname}', '{$email}','{$handle}','{$pass}')";
    $add_student = mysqli_query($conn, $query);

    if (!$add_student) {
        echo "something went wrong" . mysqli_error($conn);
    } else {
        $query = "SELECT * FROM user WHERE handle='{$handle}'";
        $view_user = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($view_user)) {
            $handle = $row['handle'];
        }
        ;
        header("Location: http://localhost:8081/phpcrud/user.php?handle=$handle");
    }

}
?>

<div class="container w-70 mt-5 d-flex">
    <div class="d-flex flex-column align-items-center justify-content-center  w-50">
        <img class="fadein" src="logo.png" width="250px" height="250px">

        <div class="d-flex flex-column" >
            <h1 class="header text-start" style="color: #687E8D;">Hello,</h1>
            <p class="text">
                Enter your information to create a new account!
            </p>
        </div>
    </div>
    <div class="container  w-50 my-5">
        <form action="" method="post" class="mt-5 p-5 border" style="border-radius: 30px;">
            <div class="form-group">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control" required placeholder="First Name">
            </div>

            <div class="form-group">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" required placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required placeholder="example@gmail.com">
            </div>

            <div class="form-group">
                <label for="handle" class="form-label">Username</label>
                <input type="text" name="handle" class="form-control" minlength="6" patterm="^[A-Za-z0-9_]{1,15}$
" required placeholder="username1234">
            </div>

            <div class="form-group">
                <label for="pass" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" minlength="8"
                    pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" required placeholder="Password1234">
            </div>

            <div class="form-group">
                <input type="submit" name="create" class="btn primary mt-2" value="Submit">
            </div>
        </form>

        <footer class="footer mt-5"> Already have a account?
            <a href="sign-in.php" class="mt-2">Sign In</a>
        </footer>
    </div>

    </body>

    </html>
</div>

</div>