let play_state = 'play';
let mute_state = 'unmuted';

const playIconContainer = document.getElementById('playBTN');
const muteIconContainer = document.getElementById('muteBTN');
let PlayImg = document.getElementById('playIMG');
let MuteImg = document.getElementById('muteIMG')

var download_btn = document.getElementById("download_btn");



playIconContainer.addEventListener('click', () => {
    if (play_state === 'play') {
        pause();
    } else {
        play();
    }
});
muteIconContainer.addEventListener('click', () => {
    if (mute_state === 'muted') {
        MuteImg.src = 'img/mute.svg';
        console.log("muted->unmuted");
        mute_state = 'unmuted';
        audio.muted = false;
    } else {
        console.log("unmuted->muted");
        mute_state = 'muted';
        MuteImg.src = 'img/unmute.png';
        audio.muted = true;
    }
});

function play() {
    console.log("pause->play");
    play_state = 'play';
    PlayImg.src = 'img/pause.png';
    audio.play();
}
function pause() {
    PlayImg.src = 'img/PlayBTN.png';
    console.log("play->pause");
    play_state = 'pause';
    audio.pause();
}

const audio = document.querySelector('audio');
const durationContainer = document.getElementById("duration");
const currentTimeContainer = document.getElementById("current_timer_value");
const audioSlider = document.getElementById("curr_timer");
const audioVolume = document.getElementById("volume");

audio.onloadedmetadata = function() {
    setSliderMax();
    console.log(Math.floor(audio.duration));
};


const calculateTime = (secs) => {
    const minutes = Math.floor(secs / 60);
    const seconds = Math.floor(secs % 60);
    const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
    return `${minutes}:${returnedSeconds}`;
}

displayDuration = () => {
    durationContainer.textContent = calculateTime(audio.duration);
    console.log(calculateTime(audio.currentTime));
}

if (audio.readyState > 0) {
    displayDuration();
    audio.volume = 0.1;
} else {
    audio.addEventListener('loadedmetadata', () => {
        displayDuration();
        audio.volume = 0.1;
    });
}

const setSliderMax = () => {
    audioSlider.max = Math.floor(audio.duration);
}

if (audio.readyState > 0) {
    displayDuration();
    setSliderMax();
} else {
    audio.addEventListener('play', () => {
        displayDuration();
        setSliderMax();
    });
}
audioVolume.addEventListener('input', () => {
    audio.volume = audioVolume.value / 100;
});

var updateTimer = setInterval(function() {
    currentTimeContainer.textContent = calculateTime(audio.currentTime);
}, 10);

var updateSlider = setInterval(function() {
    if(!audioSlider.onclick) {
        audioSlider.value = audio.currentTime;
    } 
}, 1000);

function seek(){         
    audio.currentTime = audioSlider.value;          
    play(); 
}

download_btn.setAttribute("src", audio.src);
sid = document.getElementById('current_song_id');

function play_song(song_src, picture_src, song_name, author, song_id, profile_id) {
    audio.setAttribute('src', song_src);
    audio.load();

    document.getElementById("audio_pic").setAttribute('src','../' + picture_src);
    document.getElementById("audio_info").innerHTML = "<a href='profile.php?profile_id="+ profile_id + "'>"+author + "</a>" + song_name;
    sid.innerHTML = song_id;
    download_btn.setAttribute("href", song_src);

    addView(song_id);
    is_liked();

    audio.play();
    play();
}

function addView(song_id) {
    var xhttp;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("GET", "./addview.php?song_id="+song_id, true);
    xhttp.send();
    console.log("Added view");
}

function is_liked() {
    var xhttp;
    song_id = sid.innerHTML;
    if(song_id == "") {
        document.getElementById("likeBTN").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById("likeBTN").innerHTML = this.responseText;
            console.log(this.responseText);
        }
    };
    xhttp.open("GET", "./is_liked.php?song_id="+song_id, true);
    xhttp.send();
    console.log('Is this liked?');
}