<?php

include('/OSPanel/domains/local.nocs/includes/db.php');

session_start();

if ($_SESSION['logged_user'] == null) {
    header("Location: http://local.nocs/login.php");
}
include("elements/docelem.php");
include("elements/header.php");

if (isset($_GET['profile_id'])) {
    $data = $_GET['profile_id'];
} else {
    $data = $_SESSION['user_id'];
}

$profile = R::findOne('users',  'id = ' . $data);
if ($profile) {
?>
    <div class="content">
        <div class="user_profile">
            <div class="user_profile_pic">
                <img src="<?php echo $profile->user_pic ?>" alt="#">
            </div>
            <div>
                <div class="profile_name"><?php echo $profile->name ?></div>
                <div class="liked_songs"><a href="liked_songs.php?profile_id=<?php echo $data ?>">Liked songs</a></div>
            </div>

        </div>
        <div style="margin-bottom:30px"></div>
        <div class="songs charts_top10">
            <div class="songs_uploaded"><h4>Uploaded
                <?php
                echo " " . $res = R::count('songs', ' user_id = ' . $profile->id) . " songs:";
                ?> <br>
                <?php
                    $vres = R::findAll('songs', 'user_id = '. $profile['id']);
                    $vres_count = 0;
                    $lres_count = 0;
                    foreach($vres as $ress) {
                        $vres_count += $ress->views;
                        $lres_count += $ress->likes;
                    }

                     echo "Views: " . $vres_count . "<br>Likes: " . $lres_count; 
                ?></h4>
            </div>
            <ul>
                <?php
                $songs = R::findAll('songs', 'user_id = ' . $data);
                

                foreach ($songs as $result) {
                    echo '<li>';
                    echo '<div class="song_card">';

                    $author_name = R::findOne('users', 'id = ?', array($result['user_id']));


                    $onclick_arg = '&quot;' .
                        $result['file_name'] . '&quot;, &quot;' .
                        $result['pic_name'] . '&quot;,&quot;' .
                        $result['name'] . '&quot;,&quot;' .
                        $author_name->name . '&quot;,' .
                        $result['id'] .', '.
                        $author_name->id;


                    echo '<a href="#" onclick = "play_song(' . $onclick_arg . ')">';
                    $img_src = $result['pic_name'];
                    echo '<img class="song_card_pic" src="' . $img_src . '" alt="#">';
                    $song_name = $result['name'];
                    echo '<a href="song.php?song_id=' . $result['id'] . '"><h4 class="song_card_name">' . $song_name . '</h4></a>';
                    echo '<div class="song_card_info"><img src="img/views.svg"><h4>' . $result['views'] . '</h4>';
                    echo '<img src="img/UnlikeBTN.png"><h4>' . $result['likes'] . '</h4></div>';
                    echo '</a></div>';
                    echo '</li>';
                }

                ?>

            </ul>

        </div>
        <div style="margin-bottom:90px"></div>
    </div>
<?php }
include("elements/custom_audioplayer.php"); ?>

</body>
<p id="current_song_id" hidden style="margin-left: -1000px"></p>
<script src="js/audioplayer_custom.js"></script>
<script src="js/like.js"></script>

</html>