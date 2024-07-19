<!DOCTYPE html>
<html lang="en">
<body class="index-page">
<?php
    session_start();
    include 'con.php';
    include 'header.php';
?>
<main class="main">

    <br><br><br><br><br>
    <form class="container" method="post" action="login.php">
        <h1 class="container">&nbsp;&nbsp;&nbsp;&nbsp;Log In</h1>
        <h6 id="loginInvalid"></h6>
        <br><br>
        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" class="form-control" name="userName">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <br>
        <button type="submit" class="btn btn-outline-success">Submit</button>
</form>

    <br><br><br><br>

</main>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users_tb WHERE user_name = '$userName' AND password = '$password'";
    $result = mysqli_query($con, $sql);

// Check if there are any results
    if (@mysqli_num_rows($result) == 1) {
        // Output data of each row
        while($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $_SESSION['id'] = $row["id"];
            $_SESSION['name'] = $row['name'];
            $_SESSION['userName'] = $row['user_name'];
            $_SESSION['password'] = $row['password'];
            echo "<script> window.open('user.php', '_self') </script>";
        }
    } else {
        echo "<script> 
                    document.getElementById('loginInvalid').textContent = 'Invalid';
                    document.getElementById('loginInvalid').style.color = 'red';
              </script>";
        }
}


// Close connection
mysqli_close($con);
include 'footer.php';