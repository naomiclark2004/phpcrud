<!-- Header -->
<?php include "header.php" ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $handle = $_GET['handle'];
    
    $query = "DELETE FROM `posts` WHERE id= '{$id}'";
    $delete_post = mysqli_query($conn, $query);

    if (!$delete_post) {
        echo "something went wrong" . mysqli_error($conn);
    } else {
        header("Location: http://localhost:8081/phpcrud/user.php?handle=$handle");
    };
}
?>