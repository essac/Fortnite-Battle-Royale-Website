//Clock
function startTime() {
    offset = 0;
    var today = new Date();
    var h = today.getUTCHours();
    var m = today.getUTCMinutes();
    var s = today.getUTCSeconds();
    h = h + offset;
    if (h > 24) {
        h = h - 24;
    }
    if (h < 0) {
        h = h + 24;
    }
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML = 'UTC' + ' ' + 'TIME' + ':' + ' ' + h + ":" + m + ":" + s;
    var t = setTimeout(function () {
        startTime()
    }, 500);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    };
    return i;
}

//Time Function-calling
startTime()