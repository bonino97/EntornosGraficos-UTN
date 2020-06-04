<?php
$name =$_POST['name'];
$friend = $_POST['friend'];
$url = "recommendedSite.com";
$friends_email = $_POST['friendsemail'];


$message = "Hi $friend, you should see this website $url to learn php!!!,
from: $name";

$subject = "$friend i want you to see my php website";

$remittent =$_POST['email'];

if(mail($friends_email, $subject, $message,"From: $remittent"))
    echo "<div style='text:align:center'Requests sent</div>";

else
    echo "<div style='text:align:center'>Wrong request</div>";
?>