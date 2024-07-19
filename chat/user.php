<?php
    session_start();
    include 'header_user.php';
    include 'con.php';

    echo "
        <script>
            function openChat(ID){
                let chat_open = window.open('chat.php?info='+ID, '_self');
            }
            </script>
    ";

$search = $_GET['search'];
$sql = "SELECT * FROM users_tb WHERE name LIKE '%" . $search . "%'";
$search_result = @mysqli_query($con, $sql);
echo "<br><br><br><br><br>";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if (@mysqli_num_rows($search_result) > 0) {
        echo   "<form class='d-flex container' role='search' method='GET' action='user.php'>
                <input class='form-control me-2' type='search' placeholder='Search Names' aria-label='Search' name='search' style='max-width: 250px;'>
                <button class='btn btn-outline-success' type='submit'>Search</button>
            </form>";
        echo "
            <table class='table table-dark table-hover container'>
            <thead>
                <tr>
                    <th style='border-top-left-radius: 50px; background-color: #0c0c0c'>&nbsp;&nbsp;&nbsp;&nbsp;Name</th>
                    <th style='text-align: right; border-top-right-radius: 50px; background-color: #0c0c0c'>Chat Now&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
            </thead>
            ";
        while ($row = @mysqli_fetch_array($search_result)) {
            echo "
                <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;" . $row['name'] . "</td><td style='text-align: right'><i class='bi bi-envelope-plus-fill' style='color: green' onclick='openChat(".$row['id'].")'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
            ";
        }
        echo "</table><br>";
    }else{
        echo "<h2 style='text-align: center'>No results match '" . $search . "'</h2>";
    }
}
include 'footer.php';