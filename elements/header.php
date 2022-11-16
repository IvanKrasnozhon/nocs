<header>
            <a href="http://local.nocs/"><div class="logo big_text">NoCS</div></a>
            <div class="">
                <form method="POST" action = "/search.php" class="search_wrapper">
                    <input class="search_bar" type="text" placeholder = "Song name..." name="search_info">
                    <button type="submit"><img src="img/search.svg" alt="#"></button>
                </form>
            </div>
            <div class="upload_button"><a href="upload.php"><img src="img/Upload.png" alt=""></a></div>
            <?php
            include("dropdown.php")
            ?>
</header>