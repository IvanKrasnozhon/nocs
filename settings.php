<?php

include('/OSPanel/domains/local.nocs/includes/db.php');

session_start();

if ($_SESSION['logged_user'] == null) {
    header("Location: http://local.nocs/login.php");
}
include("elements/docelem.php");
include("elements/header.php");

$data = $_POST;
if (isset($data['do_saving'])) {
    $errors = array();
    $operations = array();

    $user = R::findOne('users', 'id = ?', array($_SESSION['user_id']));
    if ($user) {
        if (move_uploaded_file($_FILES['pic_name']['tmp_name'], 'pics/' . $_FILES['pic_name']['name'])) {
            $operations[] = "New Profile picture uploaded successfully!";
            $user->user_pic = 'pics/' . $_FILES['pic_name']['name'];
        }
        if(isset($data['user_name'])) {
            $user->name = $data['user_name'];
            $_SESSION['user_name'] = $data['user_name'];
        }
        if (isset($data['old_password']) and isset($data['password']) and isset($data['password2'])) {
            if (password_verify($data['old_password'], $user->password)) {
                if($data['password'] == $data['password2']) {
                   $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                    
                } else {
                    $errors[] = "Your new password doesn`t match to repeated password!";
                }
            } else {
                $errors[] = "Incorrect password";
            }
        }
        R::store($user); 
    } else {
        $errors[] = "User doesn`t exists!";
    }
}


?>

<div class="content">
    <h2 class="uploading_head">User Settings:</h2>
    <form action="settings.php" method="POST" enctype="multipart/form-data" class="form_wrapper">
        <div class="file_input">
            <label for="song_pic" class="up_label">
                <div>Select profile picture file(JPEG, JPG, PNG)</div>
                <input id="song_pic" class="song_pic" type="file" name="pic_name" accept=".png,.jpeg,.jpg">
            </label>
        </div>
        <label for="user_name">
            <input id="user_name" class="song_name" type="text" name="user_name" placeholder="Enter user name here(max 255 symbols):">
        </label>
        <label for="change_password">
            <input id="user_name" class="song_name" type="password" name="old_password" placeholder="Enter your new password here:">
            <input id="user_name" class="song_name" type="password" name="password" placeholder="Enter your new password here:">
            <input id="user_name" class="song_name" type="password" name="password2" placeholder="Repeat your new password here:">
        </label>

        <div class="file_input">
            <input id="upload_btn" class="upload_btn" type="submit" value="Save" name="do_saving">
        </div>

        <p>
            <?php 
                if(!empty($errors)) {
                    echo $errors;
                }
                
            ?>
        </p>
    </form>
</div>

</body>

</html>