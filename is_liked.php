<?php 
include('/OSPanel/domains/local.nocs/includes/db.php');

session_start();

$like = R::getAssocRow('SELECT * FROM songslikes WHERE song_id = :sid AND user_id = :uid', [
    ':sid' => intval($_GET['song_id']),
    ':uid' => intval($_SESSION['user_id'])
]
);

if($like[0]['is_liked'] == 1) {
    echo "<img src='img/LikeBTN.png'>";
}else if($like[0]['is_liked'] == 0) {
    echo "<img src='img/UnlikeBTN.png'>";
}

?>