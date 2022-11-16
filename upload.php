<?php

include('/OSPanel/domains/local.nocs/includes/db.php');

$error_bool = true;
if(!$_SESSION['logged_user']) {
    $error_message = '<h2 style="color: red; font-size: 36px">To upload new song u need to Log In! Redirecting to Log In page after 5 seconds!</h2>';
    $error_bool = false;
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
            <div class="upload_button"><a href="upload.php"><img src="img/Upload.png" alt=""></a></div>
            <?php
            include("dropdown.php")
            ?>
        </header>
        <div class="content">

            <h2 class="uploading_head">Song uploading:</h2>

            <?php  
                if($error_bool) {
                    echo '<form action="song_uploading.php" method="POST" enctype="multipart/form-data" class="form_wrapper">
                                <div class="file_input">
                                    <label for="song_file" class="up_label">
                                        <div>Select song file(WAV or MP3)</div>
                                        <input id="song_file" class="song_file" type="file" name="song_name" accept=".wav, .mp3">
                                    </label> 
                                </div>
                                
                                <div class="file_input">
                                    <label for="song_pic" class="up_label">
                                        <div>Select song picture file(JPEG, JPG, PNG)</div>
                                        <input id="song_pic" class="song_pic" type="file" name="pic_name" accept=".png,.jpeg,.jpg">
                                    </label>
                                </div>
                                <label for="song_name">
                                    <input id="song_name" class="song_name" type="text" name="display_song_name" placeholder = "Enter song name here(max 255 symbols):">
                                </label>
                                <div class="file_input">
                                    <input id="upload_btn" class="upload_btn" type="submit" value="Upload">
                                </div>
                            </form>';
                } else {
                    echo $error_message;
                    header('Refresh: 5; URL=http://local.nocs/login.php');
                }




            ?>
            
        </div>
    </div>
</body>