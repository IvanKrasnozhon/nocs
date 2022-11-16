<h3>
<?php

include('includes/db.php');

$login = $_GET['login'];
$password = $_GET['password'];

$count = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

if(mysqli_num_rows($count) == 0)
{
    echo "U are not registered!<br>";
}
else
{
    echo "Hello, " . $login . "!<br>";
}
?>

</h3>