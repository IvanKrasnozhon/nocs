<?php
include('/OSPanel/domains/local.nocs/includes/db.php');

$data = $_POST;

unset($_SESSION['logged_user']);

if(isset($data['do_signup'])) {
    
    $errors = array();
    if(trim($data['login']) == '' ) {
        $errors[] = "Enter Login!";
    }
    if(trim($data['email']) == '') {
        $errors[] = "Enter Email!";
    }
    if($data['password'] == '') {
        $errors[] = "Enter Password!";
    }
    if( $data['repeat_password'] != $data['password'] ) {
        $errors[] = "Passwords aren`t match!";
    }
    if( R::count('users', "login = ?", array($data['login'])) > 0 ) 
    {
        $errors[] = "User with this login already exists!";
    }
    if( R::count('users', "email = ?", array($data['email'])) > 0 ) 
    {
        $errors[] = "User with this email already exists!";
    }

    
    if(empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->name = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        header("Location: http://local.nocs/login.php");
        exit;
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
            <div class="user_menu medium_text">
                
            </div>
        </header>



        <div class="content">
            <div class="reg_form">
                <form method="POST" action="register.php">
                    <input type="text" placeholder="Your login" name="login" value="<?php echo(@$data['login']); ?>">
                    <input type="email" placeholder="Your email" name="email" value="<?php echo(@$data['email']); ?>">
                    <input type="password" placeholder="Your password" name="password" value="<?php echo(@$data['password']); ?>">
                    <input type="password" placeholder="Repeat your password" name="repeat_password" value="<?php echo(@$data['repeat_password']); ?>">
                <hr>
                    <input type="submit" value ="Register" class="sub_reg" name="do_signup">
                </form>

                <h4 style="color: red">
                    <?php
                    if(!empty($errors)) {
                        echo(array_shift($errors)); 
                    }  
                    ?>
                </h4>

                <h4>You are already registered?<a href="login.php"> Log In!</a></h2>
            </div>
            
            
        </div>
    </div>
</body>
</html>
