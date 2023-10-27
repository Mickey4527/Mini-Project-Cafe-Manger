function showTime(elId){
    const element = document.getElementById(elId);
    const today = new Date();
    let hour = today.getHours();
    let minutes = today.getMinutes();
    let seconds = today.getSeconds();
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);

    document.getElementById("time").innerHTML = hour + ":" + minutes + ":" + seconds;
    const t = setTimeout(function(){showTime(elId)}, 500);
}

function checkTime(i){
    if(i < 10){
        i = "0" + i;
    }
    return i;
}
document.addEventListener("DOMContentLoaded", function(){
    showTime("time");
});