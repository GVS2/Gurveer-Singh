<?php
session_start();
include 'header_user.php';
include 'con.php';
?>

<?php
$senderID = $_SESSION['id'];
$receiverID = $_REQUEST['info'];

// Displaying receiver name
$sql1 = "SELECT * FROM users_tb WHERE id = $receiverID";
$result1 = mysqli_query($con, $sql1);
echo "<br><br><br><br><br><br><br>";
if (mysqli_num_rows($result1) > 0) {
    echo "<div class='container'>";
    while ($row = mysqli_fetch_assoc($result1)) {
        echo "
        <h1 style='position: fixed; top: 125px; left: 10px; z-index: 1000; background-color: #242424; padding: 10px; border-radius: 5px; width: 100%; text-align: center; opacity: 75%'>
            " . htmlspecialchars($row['name']) . "
        </h1>
        ";
    }
    echo "</div>";
}

// Displaying messages
$sql2 = "SELECT * FROM message_tb WHERE (sender_id = $senderID AND receiver_id = $receiverID) OR (sender_id = $receiverID AND receiver_id = $senderID)";
$result2 = mysqli_query($con, $sql2);

if (mysqli_num_rows($result2) > 0) {
    echo "<br><br><br><div class='container'>";
    while ($row = mysqli_fetch_assoc($result2)) {
        if ($row['sender_id'] == $senderID) {
            echo "<div class='alert alert-primary' role='alert' style='margin-left: 25%; text-align: right'>
                    " . htmlspecialchars($row['message']) . "</div>";
        } else {
            echo "<div class='alert alert-warning' role='alert' style='margin-right: 25%; text-align: left'>
                    " . htmlspecialchars($row['message']) . "</div>";
        }
    }
    echo "</div>";
}else {
    echo '<br><br><br><br><br><br>';
}
?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<form  style="
   background-color: #242424;
   border-radius: 5px;
   position: fixed;
   padding: 10px;
   bottom: 0;
   width: 100%;">
    <textarea id='sendMessage' rows='3' style='width: 100%; border-radius: 5px' placeholder='&nbsp;&nbsp;&nbsp;&nbsp;Send Message' name='message'></textarea>
    <br><br>
    <div class='d-grid gap-2'>
        <button id = $receiverID' class='btn btn-outline-warning' ><i class='bi bi-envelope-arrow-up-fill' style='font-size: x-large' onclick="sendMessage(id,sendMessage.value)"></i></button>
    </div>
</form>
<!--<form>
<textarea class='alert alert-warning' name ='message' id='$receiverID' rows='4' cols='50' onblur = sendMessage(id,message.value);>
</textarea>
</form>-->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include 'footer_chat.php';

// Send Message

?>
<script>
    function sendMessage(id,message){
        var datasrc = 'sendMSG.php?name='+ id + '-' + message;
        var ajax = new XMLHttpRequest();
        ajax.open('GET', datasrc);
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status ==200){
                location.reload(true);
            }
        }
        ajax.send(null);
    }
</script>
    <style>
        #message {
            position: absolute;
            bottom: 0;
        }
        #scrollButton {
            position: fixed;
            right: 15px;
            bottom: 15px;
            display: none;
            padding: 10px 20px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 40px;
            height: 40px;

        }
    </style>
<button id="scrollButton" onclick="scrollToMessage()" class=""><i class="bi bi-arrow-down-short"></i></button>

<script>
    var scrollToMessageBtn = document.getElementById('scrollButton');
    window.onscroll = function() {
        // Show button when scrolled 1000px above the message element
        if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
            scrollToMessageBtn.style.display = "block";
        } else {
            scrollToMessageBtn.style.display = "none";
        }
    };

    function scrollToMessage() {
        var messageElement = document.getElementById('footer');
        messageElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>