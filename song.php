<?php
$data = $_GET;

include('/OSPanel/domains/local.nocs/includes/db.php');

session_start();

if ($_SESSION['logged_user'] == null) {
    header("Location: http://local.nocs/login.php");
}
include("elements/docelem.php");
include("elements/header.php");
?>
<div class="content">
    <div style="margin-top:22px"></div>
    <?php
    $result = R::findOne('songs', 'id = ' . $data['song_id']);

    echo '<li>';
    echo '<div class="song_card">';
    $author_name = R::findOne('users', 'id = ?', array($result['user_id']));

    $onclick_arg = '&quot;' .
        $result['file_name'] . '&quot;, &quot;' .
        $result['pic_name'] . '&quot;,&quot;' .
        $result['name'] . '&quot;,&quot;' .
        $author_name->name . '&quot;,' .
        $result['id'].', '.
        $author_name->id;
    //print_r($result);

    echo '<a href="#" onclick = "play_song(' . $onclick_arg . ')">';
    $img_src = $result['pic_name'];
    echo '<img class="song_card_pic" src="' . $img_src . '" alt="#">';
    $song_name = $result['name'];
    echo '<a href="song.php?song_id=' . $result['id'] . '"><h4 class="song_card_name">' . $song_name . '</h4></a>';
    echo '<div class="song_card_info"><img src="img/views.svg"><h4>' . $result['views'] . '</h4>';
    echo '<img src="img/UnlikeBTN.png"><h4>' . $result['likes'] . '</h4></div>';
    echo '</a></div>';
    echo '</li>';
    ?>
</div>
</body>
<?php
include("elements/custom_audioplayer.php");
?>
<p id="current_song_id" hidden style="margin-left: -1000px"></p>
<script src="js/audioplayer_custom.js"></script>
<script src="js/like.js"></script>

</html>