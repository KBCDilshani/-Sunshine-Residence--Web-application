<?php
global $mysqli;
include("config.php");

// Check if form is submitted
if(isset($_POST['submit'])) {
    extract($_POST);
    $sql = "INSERT INTO `contact-data`(`firstname`, `lastname`, `phone`, `email`, `message`) VALUES ('".$firstname."','".$lastname."',".$phone.",'".$email."','".$message."')";
    $result = $mysqli->query($sql);
    if($result){
        // Redirect to details.php with success parameter
        header("Location: details.php?success=true");
        exit();
    } else {
        die("Couldn't enter data: ".$mysqli->error);
    }
}

$mysqli->close();
?>
