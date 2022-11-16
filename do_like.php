<?php
    require('/OSPanel/domains/local.nocs/libs/rb.php');
    R::setup('mysql:host=localhost;
        dbname=nocs_music',
        'root'
    );
    session_start();

    $like = R::getAssocRow('SELECT * FROM songslikes WHERE song_id = :sid AND user_id = :uid', [
            ':sid' => intval($_GET['song_id']),
            ':uid' => intval($_SESSION['user_id'])
        ]
    );
    

    if($like[0]['id'] >= 1) {
        $sid = $like[0]['song_id'];
        $uid = $like[0]['user_id'];

       // echo $sid . " " . $uid . " " . $like[0]['is_liked'] . " ";
        if($like[0]['is_liked'] == 0) {
            //simply does like on true if it was unliked in prev time
            $addlike = R::load('songslikes', $like[0]['id']);
            $addlike->is_liked = 1;
            $song = R::findOne('songs', 'id = ' . $_GET['song_id']);
            $song->likes++;
            R::store($song);
            R::store($addlike);
            $is_liked = 1;
            echo "<img src='img/LikeBTN.png'>";//printing img in structure
        }else if($like[0]['is_liked'] == 1)
        {
            //if is liked
            $remove_like = R::load('songslikes', $like[0]['id']);
            $remove_like->is_liked = 0;
            $song = R::findOne('songs', 'id = ' . $_GET['song_id']);
            $song->likes--;
            R::store($song);
            R::store($remove_like);
            $is_liked = 0;
            echo "<img src='img/UnlikeBTN.png'>";
        }
    }else {
        $addlike = R::dispense("songslikes");
        $addlike->song_id = $_GET['song_id'];
        $addlike->user_id = $_SESSION['logged_user']->id;
        //echo "<br>".$addlike->song_id ." ". $addlike->user_id . "<br>";
        $addlike->is_liked = 1;
        R::store($addlike);
        $song = R::findOne('songs', 'id = ' . $_GET['song_id']);
        $song->likes++;
        R::store($song);
        echo "<img src='img/LikeBTN.png'>";
    }
