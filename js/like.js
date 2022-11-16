function do_like() {
    song_id = document.getElementById('current_song_id').innerHTML;
    var xhttp;
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
    xhttp.open("GET", "./do_like.php?song_id="+song_id, true);
    xhttp.send();
    console.log('Like!');
}