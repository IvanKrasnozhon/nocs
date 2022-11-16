<footer>
            <div class="footer_container">
                <div ><audio id="audioPlayer" src="" type="audio/mpeg" preload="metadata"></div>
                <div class="audio_controls">
                    <button id="prevBTN" class="prevBTN" type="prev"><img src="img/PrevBTN.png" alt=""></button>
                    <button id="playBTN" class="playBTN" type="button"><img src="img/PlayBTN.png" alt="" id="playIMG"></button>
                    <button id="nextBTN" class="nextBTN" type="next"><img src="img/NextBTN.png" alt=""></button>
                    <span id="current_timer_value" class="time ">0:15</span>
                    <div class="progress">
                        <input type="range" min="1" max="" value="1" class="slider" id="curr_timer" onchange="seek()">
                    </div>
                    <div id="duration" class="time">0:00</div>
                    <div id="muteBTN" class="volume"><img src="img/mute.svg" alt="" id="muteIMG"></div>
                    <div class="audio_volume">
                        <input type="range" min="0" max="100" value="0" class="slider" id="volume" >
                    </div>
                    <div class="audio_info">
                        <img src="https://random.imagecdn.app/185/185" alt="" id="audio_pic">
                        <div class="audio_info_text small_text" id="audio_info">
                        </div>
                    </div>
                    <button class="likeBTN" id="likeBTN" type="button" onclick="do_like()"><img src="img/UnlikeBTN.png" alt="" srcset=""></button>
                    <button class="downloadBTN"><a href="" id="download_btn" download><img src="img/DownloadBTN.png" alt=""></a></button>
                </div>
            </div>
        </footer>
    </div>
</body>

