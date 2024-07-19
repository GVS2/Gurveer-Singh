<!DOCTYPE html>
<html lang="en">
<body class="index-page">

<?php
    session_start();
    include 'header.php';
    include 'con.php';
?>

<main class="main">

    <br><br><br><br><br>
    <form class="container" method="post" action="create_new_account.php">
        <h1 class="container">&nbsp;&nbsp;&nbsp;&nbsp;Create Account</h1><br>
        <h5>Login after creating account...</h5>
        <h6 id="loginInvalid"></h6><br>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input class="form-control" name="name">
        </div>
        <br>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input class="form-control" name="userName">
        </div>
        <br>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <br>
        <button type="submit" class="btn btn-outline-success">Submit</button>
    </form>
    <br><br>
</main>

<?php
include 'footer.php';
?>

</body>

</html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $sql1 = "INSERT INTO users_tb (id, name, user_name, password) VALUES ('', '$name', '$userName', '$password')";
    $result1 = @mysqli_query($con, $sql1);
    echo "<script>open('login.php', '_self')</script>";

    $sql2 = "SELECT * FROM users_tb WHERE user_name = '$userName' AND password = '$password')";
    $result2 = @mysqli_query($con, $sql2);

    if (@mysqli_num_rows($result2) > 0) {
        echo "<script> 
                    document.getElementById('loginInvalid').textContent = 'It already exists!';
                    document.getElementById('loginInvalid').style.color = 'red';
              </script>";
    }
}


// Close connection
mysqli_close($con);