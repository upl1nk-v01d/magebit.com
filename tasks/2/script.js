$(document).ready(function() {

    function change_headings_txt(){
        $(".heading, .subheading").addClass('mobile');
        $(".heading").text('Thanks for subscribing!');
        $(".subheading").text('You have successfully subscribed to our email listing. Check your email for the discount code.');
        $(".heading").parent().prepend('<img id="success" src="../res/ic_success.svg">');
    }
    
    function chc_form_validation(){
        $('form').removeClass('not_valid');
        $(".tooltiptext").each(function(){
            //console.log($(this).hasClass('v'));
            if ($(this).hasClass('v')){ 
                $('form').addClass('not_valid');
                return;
            }
        })
        
        if ($('form').attr('class')!='not_valid'){ 
            //console.log($('form').attr('class'));
            change_headings_txt();
            $('form').remove();
        }
    }
    
    function chc_inputs(){
        $(".tooltiptext").each(function(){
            //console.log($(this).text());
            if ($(this).text().trim().length>0){
                $(this).addClass('v');
                $(".ic_arrow").addClass("disabled");
                $(".ic_arrow").css({'cursor' : 'not-allowed'});
                //return;
            } else {
                //$(".ic_arrow").removeClass("disabled");
                //$(".ic_arrow").css({'cursor' : 'pointer'});
                //return;
            }
            
            if ($(".TOS .checkmark input").is(":checked")) {
                 $(".TOS .tooltiptext").text("");
                 $(".TOS .tooltiptext").removeClass("v");
            } else {
                return;
            }
        })
        
        //console.log($('form').attr('class'));
    }
    
    $(".ic_arrow").click(function(){
        event.preventDefault();
        //$(".tooltiptext").removeClass('v');
        //$(".ic_arrow").removeClass("disabled");
        $(".tooltiptext").text("");
       
        if ($(".input_email_address .input_txt").val().indexOf("@") === -1) {
            $(".input_email_address .tooltiptext").text("Please provide a valid e-mail address");
        } 
        if( $(".input_email_address .input_txt").val() === '') {
            $(".input_email_address .tooltiptext").text("Email address is required");
        } 
        
        var txt = $(".input_email_address .input_txt").val();
        //console.log(txt.substr(txt.length-1)=="m");
        //console.log(txt.indexOf('.co')+1>0);
        if (txt.substr(-3)=='.co') {
            $(".input_email_address .tooltiptext").text("We are not accepting subscriptions from Colombia emails");
        } 
        
        if (!$(".TOS .checkmark input").is(":checked")) {
            $(".TOS .tooltiptext").text("You must accept the terms and conditions");
            //$(".TOS .tooltiptext").addClass('v');
        }
        //console.log($(".ic_arrow").attr("class"));
        //console.log($(".tooltiptext").text().trim().length)
        
        $(".tooltiptext").each(function(){
            //console.log($(this).text());
            if ($(this).text().trim().length>0){
                $(this).addClass('v');
                $(".ic_arrow").addClass("disabled");
            } else {
                $(this).removeClass('v');
                //$(".ic_arrow").removeClass("disabled");
            }
        })
        
        $( ".input_email_address .input_txt" ).keyup(function(){
            $(".ic_arrow").removeClass('disabled');
            $(".ic_arrow").css({'cursor' : 'pointer'});
        }); 

        chc_inputs();
        chc_form_validation();
        //console.log($('form').attr('class'));
    });
    
    $(".checkmark").click(function(){
        chc_inputs();
        $(".ic_arrow").removeClass("disabled");
        $(".ic_arrow").css({'cursor' : 'pointer'});
    })
});