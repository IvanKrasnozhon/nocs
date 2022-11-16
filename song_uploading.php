<?php
require('libs/rb.php');
R::setup('mysql:host=localhost;
        dbname=nocs_music',
        'root'
    );
    session_start();
    if($_FILES['song_name']['size'] > 25*1024*1024) {
        exit("File is bigger than 25Mb");
    }

    if(move_uploaded_file($_FILES['song_name']['tmp_name'], 'songs/' . $_FILES['song_name']['name']) and move_uploaded_file($_FILES['pic_name']['tmp_name'], 'pics/' . $_FILES['pic_name']['name'])) {
        
        $data = $_POST;
        echo 'Success <br>';
        echo 'Default file name - ' . $_FILES['song_name']['name'] . '<br>';
        echo 'File size - ' . $_FILES['song_name']['size'] . '<br>';
        echo 'MIME file type - ' . $_FILES['song_name']['type'] . '<br>';
        echo 'Temporary file which includes uploaded file  - ' . $_FILES['song_name']
        ['tmp_name'] . '<br>' . '<br>';

        echo 'Default file name - ' . $_FILES['pic_name']['name'] . '<br>';
        echo 'File size - ' . $_FILES['pic_name']['size'] . '<br>';
        echo 'MIME file type - ' . $_FILES['pic_name']['type'] . '<br>';
        echo 'Temporary file which includes uploaded file  - ' . $_FILES['pic_name']
        ['tmp_name'] . '<br>';

        
        echo $_SESSION['logged_user']['id'];
        $song = R::dispense('songs');
        $song->name = $data['display_song_name'];
        //echo "<br>" . $data['song_name'] . "<br>" . $_FILES['song_name']['name'] . "<br>" . $_FILES['pic_name']['name'];
        $song->file_name = 'songs/' . $_FILES['song_name']['name'];
        $song->pic_name = 'pics/' . $_FILES['pic_name']['name'];
        $song->user_id = intval($_SESSION['logged_user']['id']);
        R::store($song);
        header("Location: http://local.nocs/");
        exit;

    } else {
        echo 'Error';
    }
?>
