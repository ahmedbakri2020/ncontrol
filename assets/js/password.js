$(function(){
    $('#password').keyup(function(e) {
        document.getElementById('p-bar').style.display='block';
         var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
         var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
         var weakRegex = new RegExp("(?=.{6,}).*", "g");
 
        var password = $(this).val();
        if(false == weakRegex.test(password))
        {
            $('span.bar').css("width","25%");
            $('.pass_progress').addClass('orange');
            $('.pass_progress').addClass('red');
            $('.feedback').html('Weak');
        }
        else if(strongRegex.test(password))
        {
            $('span.bar').css("width","100%");
            $('.pass_progress').removeClass('orange');
            $('.pass_progress').removeClass('red');
            $('.feedback').html('Strong');
        }
        else if(mediumRegex.test(password))
        {
            $('span.bar').css("width","50%");
            $('.pass_progress').removeClass('red');
            $('.pass_progress').addClass('orange');
            $('.feedback').html('Medium');
        }
        else
        {
            $('span.bar').css("width","2%");
            $('.pass_progress').addClass('orange');
            $('.pass_progress').addClass('red');
            $('.feedback').html('Weak');
        }
    });
});