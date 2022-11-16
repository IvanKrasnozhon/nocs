<?php

include('/OSPanel/domains/local.nocs/includes/db.php');

session_start();

if ($_SESSION['logged_user'] == null) {
    header("Location: http://local.nocs/login.php");
}
include("elements/docelem.php");
include("elements/header.php");

$connection = mysqli_connect('localhost', 'root', '', 'nocs_music');
if (!mysqli_connect('localhost', 'root', '')) {
    exit('Cannot connect to server');
}
if (!mysqli_select_db($connection, 'nocs_music')) {
    exit('Cannot select database');
}

//operating search result
$search_request = $_POST["search_info"];
$text;

if (isset($search_request)) {
    $search_request = trim($search_request);
    $search_request = mysqli_real_escape_string($connection, $search_request);
    $search_request = htmlspecialchars($search_request);
    if (!empty($search_request)) {
        if (strlen($search_request) < 3) {
            echo '<p>Search request is too short!</p>';
        } else if (strlen($search_request) > 128) {
            echo '<p>Search request is too long!</p>';
        } else {
            $q = "SELECT * FROM `songs` WHERE `name` LIKE '%$search_request%' OR `file_name` LIKE '%$search_request'";
            $result = mysqli_query($connection, $q);

            if (mysqli_affected_rows($connection) > 0) {
                $row = mysqli_fetch_assoc($result);
                $num = mysqli_num_rows($result);

?>
                <div class="content">
                    <div class="charts_top10">
                        <h2>Your search result from request: <?php echo $search_request ?></h2>
                        <h4>Found <?php echo $num ?> coincidences:</h4>
                        <ul>
            <?php
                do {
                    echo '<li>';
                    echo '<div class="song_card">';
                    $author_name = R::findOne('users', 'id = ?', array($row['user_id']));
                    $onclick_arg = '&quot;' .
                        $row['file_name'] . '&quot;, &quot;' .
                        $row['pic_name'] . '&quot;,&quot;' .
                        $row['name'] . '&quot;,&quot;' .
                        $author_name->name . '&quot;,' .
                        $row['id'] . ', ' .
                        $author_name->id;

                    echo '<a href="#" onclick = "play_song(' . $onclick_arg . ')">';
                    $img_src = $row['pic_name'];
                    echo '<img class="song_card_pic" src="' . $img_src . '" alt="#">';
                    $song_name = $row['name'];
                    echo '<a href="song.php?song_id=' . $row['id'] . '"><h4 class="song_card_name">' . $song_name . '</h4></a>';
                    echo '<div class="song_card_info"><img src="img/views.svg"><h4>' . $row['views'] . '</h4>';
                    echo '<img src="img/UnlikeBTN.png"><h4>' . $row['likes'] . '</h4></div>';
                    echo '</a></div>';
                    echo '</li>';
                } while ($row = mysqli_fetch_assoc($result));
            } else {
                echo $search_request;
                echo '<p>Nothing founded from your request</p>';
            }
        }
    } else {
        echo '<p>Empty request</p>';
    }
}
            ?>
                        </ul>
                    </div>
                </div>
                </div>

                <?php
                include("elements/custom_audioplayer.php");
                ?>
                <p id="current_song_id" hidden style="margin-left: -1000px"></p>
                <script src="js/audioplayer_custom.js"></script>
                <script src="js/like.js"></script>

                </html>