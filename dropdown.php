<img class="user_pic" src="<?php echo $_SESSION['logged_user']->user_pic ?>" alt="">
<div class="user_menu medium_text dropdown">
    <button class="dropbtn"><?php

use RedBeanPHP\Util\DispenseHelper;

    $display_name;
    $display_dropdown = false;
    if(isset($_SESSION['logged_user'])) {
        $display_name = $_SESSION['user_name'];
        //print_r($_SESSION['user_name']);
        echo $display_name;
        $display_dropdown = true;
    } else {
        echo("<div class='log_inBtn'><a href='login.php' >Log In</a></div>");
        $display_dropdown = false;
    }
    ?></button>
    <?php if($display_dropdown) {
        echo('
        <div class="dropdown_content">
            <ul>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="liked_songs.php">Liked Songs</a></li>
                <li><a href="login.php">Log Out</a></li>
            </ul>   
        </div>
        ');
    } ?>
    
</div>