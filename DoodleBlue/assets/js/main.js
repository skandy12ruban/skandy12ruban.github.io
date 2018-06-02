$(document).ready(function(){
   $("#form_submit").click(function(){
    if($("#fname").val() == ""){
        $("#fname").next("p").removeAttr('hidden', 'true');
        $("#fname").css('border-bottom', '1px solid #D91E18');
    }else{
        $("#fname").next("p").attr('hidden', 'true');
        $("#fname").css('border-bottom', '1px solid black');       
    }
    if($("#lname").val() == ""){
        $("#lname").next("p").removeAttr('hidden', 'true');
        $("#lname").css('border-bottom', '1px solid #D91E18');
    }else{
        $("#lname").next("p").attr('hidden', 'true');
        $("#lname").css('border-bottom', '1px solid black');       
    }
    email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    if(!email_regex.test($("#email").val())){
        $("#email").next("p").removeAttr('hidden', 'true');
        $("#email").css('border-bottom', '1px solid #D91E18');
    }else{
        $("#email").next("p").attr('hidden', 'true');
        $("#email").css('border-bottom', '1px solid black');       
    }
    if($("#phone").val() == ""){
        $("#phone").next("p").removeAttr('hidden', 'true');
        $("#phone").css('border-bottom', '1px solid #D91E18');
    }else{
        $("#phone").next("p").attr('hidden', 'true');
        $("#phone").css('border-bottom', '1px solid black');       
    }
    if($("#invest").val() == ""){
        $("#invest").next("p").removeAttr('hidden', 'true');
        $("#invest").css('border-bottom', '1px solid #D91E18');
    }else{
        $("#invest").next("p").attr('hidden', 'true');
        $("#invest").css('border-bottom', '1px solid black');       
    }
    if($("#msg").val() == ""){
        $("#msg").next("p").removeAttr('hidden', 'true');
        $("#msg").css('border-bottom', '1px solid #D91E18');    
    }else{
        $("#msg").next("p").attr('hidden', 'true');
        $("#msg").css('border-bottom', '1px solid black');       
    }
   })
//.form-right form input
});