function getClientRef( prefix ){
    // Get Date in YYMMDD format 
    var month = new Date().getMonth();
    var day = new Date().getDate();
    var year = new Date().getFullYear();
    //pull the last two digits of the year
    year = year.toString().substr(2,2);
    //increment month by 1 since it is 0 indexed
    month = month + 1;
    //converts month to a string
    month = month + "";
    //if month is 1-9 pad right with a 0 for two digits
    if (month.length == 1){ month = "0" + month; }
    //convert day to string
    day = day + "";
    //if day is between 1-9 pad right with a 0 for two digits
    if (day.length == 1){ day = "0" + day; }
    //return the string "MMddyy"
    var mydate = year + month + day;
    var rando = randomString(3, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    var ref = prefix + '-' + mydate + rando;
    return ref;
}

function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}