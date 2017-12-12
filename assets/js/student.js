$("#studentlist").show();
$("#studentlog").hide();
$("#studentsubscription").hide();
student("GET", "studentlist", "studentlist");
$("#liststudentmenu").on('click', function() {
    student("GET", "studentlist", "studentlist");
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
    $("#studentlist").siblings().hide(1000);
    $("#studentlist").show(1000);
});
$("#listlogmenu").on('click', function() {
    $("#lognotify").text("");
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
    $("#studentlog").siblings().hide(1000);
    $("#studentlog").show(1000);
});
$("#subscriptionmenu").on('click', function() {
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
    $("#studentsubscription").siblings().hide(1000);
    $("#studentsubscription").show(1000);
});

function student(method, str, contentdiv) {
    if (str == "") {
        document.getElementById(contentdiv).innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(contentdiv).innerHTML = this.responseText;
        }
    }
    switch (method) {
        case "GET":
            if (arguments.length == 3) {
                xmlhttp.open("GET", "assets/php/dash.php?action=" + str, true);
                xmlhttp.send();
            } else if (arguments.length == 4) {
                xmlhttp.open("GET", "assets/php/dash.php?action=" + str + "&id=" + id, true);
                xmlhttp.send();
            }
            break;
        case "POST":
            break;
    }
}