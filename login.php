<?php
include('/OSPanel/domains/local.nocs/includes/db.php');

    $data = $_POST;

    unset($_SESSION['logged_user']);
    unset($_SESSION['user_id']);

    if(isset($data['do_login'])) {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if($user) {
            if(password_verify($data['password'], $user->password) ) {
             //logging in
                $_SESSION['logged_user'] = $user;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['user_id'] = $user->id;
            }
            else {
                $errors[] = "Incorrect password";
            }
        }else {
            $errors[] = "User doesn`t exists!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <title>NoCS - No Copyright music</title>

</head>
<body>
    <div class="wrapper">
        <header>
        <a href="http://local.nocs/"><div class="logo big_text">NoCS</div></a>
            <div >
                <form method="GET" action = "/test.php">
                    <input class="search_bar" type="text" placeholder = "Search..." name="search_info">
                </form>
            </div>
            
        </header>
        <div class="content">
            <div class="reg_form">
                <form method="POST" action="/login.php">
                    <input type="text" placeholder="Your login" name="login">
                    <input type="password" placeholder="Your password" name="password">
                <hr>
                    <input type="submit" value ="Login" class="sub_reg" name="do_login">
                </form>
                <h4 style="color: red">
                    <?php
                    if(!empty($errors)) {
                        echo(array_shift($errors)); 
                    }  
                    if($_SESSION['logged_user']) {
                        echo(" U are logged in!");
                        header('Refresh: 2; URL=http://local.nocs/');
                        echo 'After 2 seconds, you will be automatically redirected to the main page.';
                        exit;
                    }
                    ?>
                </h4>

                <h4>You are not already <a href="register.php">registered?</a></h4>
            </div>
            
            
        </div>
    </div>
</body>
</html>
