$("#add").hide();
$("#edit").hide();
$("#del").hide();
action("GET", "list", "list");
$("#listcoursemenu").on('click', function() {
    action("GET", "list", "list");
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
    $("#list").siblings().hide(1000);
    $("#list").show(1000);
});
$("#addcoursemenu").on('click', function() {
    $("#add").show(1000);
    $("#add").siblings().hide(1000);
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
});
$("#editcoursemenu").on('click', function() {
    action("GET", "edit", "selectid");
    $("#selectid").prop("selectedIndex", 0);
    $("#multiFiles").val("");
    $("#editform").empty();
    $("#edit").show(1000);
    $("#edit").siblings().hide(1000);
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
});
$("#deletecoursemenu").on('click', function() {
    action("GET", "edit", "selectrid");
    $("#del").show(1000);
    $("#del").siblings().hide(1000);
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
});
$("#courseform").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /* get the action attribute from the <form action=""> element */
    var $form = $(this),
        url = $form.attr('action');
    /* Send the data using post with element id name and name2*/

    var posting = $.post(url, {
        courseid: $('#courseid').val(),
        coursename: $('#coursename').val(),
        coursedescribe: $('#coursedescribe').val(),
        others: $('#others').val(),
    });
    /* Alerts the results  */
    posting.done(function(data) {
        alert(data);
    });

});
$("#updatesubmit").on('click', function() {

    url = "/assets/php/dashupdate.php";
    var posting = $.post(url, {
        id: $("#selectid").val(),
        courseid: $('#newid').text(),
        coursename: $('#newname').text()
    });
    posting.done(function(data) {
        alert(data);
    });
});

$("#removesubmit").on('click', function() {
    action("GET", "removeitem", "editrform", $("#selectrid").val());
});
$("#selectid").on('change', function() {
    action("GET", "edititem", "editform", $(this).val());
});
$("#selectrid").on('change', function() {
    action("GET", "edititem", "editrform", $(this).val());
});

function action(method, str, contentdiv, id) {
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