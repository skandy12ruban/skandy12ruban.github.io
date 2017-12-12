$("#adminadd").hide();
$("#adminedit").hide();
$("#adminremove").hide();
admin("GET", "adminlist", "adminlist");

$("#adminlistmenu").on('click', function() {
    admin("GET", "adminlist", "adminlist");
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
    $("#adminlist").siblings().hide(1000);
    $("#adminlist").show(1000);
});
$("#adminaddmenu").on('click', function() {
    $("#adminadd").show(1000);
    $("#adminadd").siblings().hide(1000);
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
});
$("#adminaddsubmit").on('click', function() {
    url = "/assets/php/adminadd.php";
    var posting = $.post(url, {
        name: $("#adminname").val(),
        uname: $("#adminuname").val(),
        pwd: $("#adminpwd").val()
    });
    posting.done(function(data) {
        alert(data);
    });
});
$("#rmadmin").on('click', function() {
    console.log($(this).parent().children(':first-child').text());
})

function admin(method, str, contentdiv, id) {
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