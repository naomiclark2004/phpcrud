<!-- Header -->
<?php include "header.php" ?>

<?php
if (isset($_GET['handle'])) {
    $other = $_GET['other'];
    $handle = $_GET['handle'];

    $check = "SELECT * FROM friend_list WHERE username='{$handle}' AND friendname='{$other}'";
    $checkfs = mysqli_query($conn, $check);


    if ($checkfs->num_rows == 0) {
        echo "Not Friends";
        $sql = "INSERT INTO friend_list (username, friendname) VALUES ('$handle', '$other')";
        $add = mysqli_query($conn, $sql);
        if (!$add) {
            echo "something went wrong" . mysqli_error($conn);
        } else {
            header("Location: http://localhost:8081/phpcrud/search.php?handle=$handle");
        }
    } else if ($checkfs->num_rows !== 0) {
        header("Location: http://localhost:8081/phpcrud/search.php?handle=$handle");
    }
}
?>