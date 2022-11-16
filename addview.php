<?php
$data = $_GET;
include('/OSPanel/domains/local.nocs/includes/db.php');

$song = R::findOne('songs', 'id = ?', array($data['song_id']));
$song->views = $song->views + 1;
echo $song->name . ' - views updated = ' . $song->views;
R::store($song);

?>