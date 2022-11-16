<?php
    require('/OSPanel/domains/local.nocs/libs/rb.php');
    R::setup('mysql:host=localhost;
        dbname=nocs_music',
        'root'
    );
    session_start();
?>