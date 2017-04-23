$(document).ready(function(){
        $('#send_message').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#email').val();
            var name = $('#name').val();
            var message = $('#message').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#email').addClass("validation");
                
            }else{
                $('#email').removeClass("validation");
            }
            
            if(name.length == 0)
            {
                var error = true;
                
                $('#name').addClass("validation");
                
            }else{
                $('#name').removeClass("validation");
            }

            if(message.length == 0){
                var error = true;
                $('#message').addClass("validation");
            }else{
                $('#message').removeClass("validation");
            }
            
            // If there is no validation error, next to process the mail function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
                $('#send_message').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post("/php/email.php", $("#contact_form").serialize(),function(result){
                    //Check the result set from email.php file.
                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         
                         $('#send_message').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#mail_success').fadeIn(500);
                    }else{
                        //Display the error message
                        $('#mail_fail').fadeIn(500);
                        // Enable the submit button again
                        $('#send_message').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
        });    


        $('#send_feedback').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#email').val();
            var name = $('#name').val();
            var message = $('#message').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#email').addClass("validation");
                
            }else{
                $('#email').removeClass("validation");
            }
            
            if(name.length == 0)
            {
                var error = true;
                
                $('#name').addClass("validation");
                
            }else{
                $('#name').removeClass("validation");
            }

            if(message.length == 0){
                var error = true;
                $('#message').addClass("validation");
            }else{
                $('#message').removeClass("validation");
            }
            
            // If there is no validation error, next to process the mail function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
                $('#send_feedback').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post("/php/feedback.php", $("#contact_form").serialize(),function(result){
                    //Check the result set from email.php file.
                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         
                         $('#send_feedback').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#mail_success').fadeIn(500);
                    }else{
                        //Display the error message
                        $('#mail_fail').fadeIn(500);
                        // Enable the submit button again
                        $('#send_feedback').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
        }); 

    $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
       

        $("#fixed_booking_form").on( "submit", function( event ) {
            event.preventDefault();
           
            var allQueryVal=$(this).serializeObject();
            var allQueryVall=$(this).serialize();
           //console.log(allQueryVal);           
          
           var O={}; var error = false;
           O.email=allQueryVal['data[Reservation][email]'];
           O.date=allQueryVal['data[Reservation][date]'];
           O.numOfperson=allQueryVal['data[Reservation][num_of_person]'];
           O.name=allQueryVal['data[Reservation][name]'];
           O.phone=allQueryVal['data[Reservation][phone]'];
           O.time=allQueryVal['data[Reservation][time]'];
           O.actionurl=$(this).data('actionurl');           


            if(O.name.length == 0){
                error = true;
                $('#InputNameFixed').addClass("validation");
            }else{
                $('#InputNameFixed').removeClass("validation");
            }


            if(O.email.length == 0 || O.email.indexOf('@') < 1 || (O.email.lastIndexOf('.') - O.email.indexOf('@') < 2) || (O.email.length - O.email.lastIndexOf('.') < 2) )
            {
               error = true;                
                $('#InputEmailFixed').addClass("validation");                
            }else{
                $('#InputEmailFixed').removeClass("validation");
            }


            if(O.phone.length == 0){
               error = true;
                $('#inputPhoneFixed').addClass("validation");
            }else{
                $('#inputPhoneFixed').removeClass("validation");
            }

            if(O.date.length == 0){
               error = true;
                $('#datepicker-sidebar').addClass("validation");
            }else{
                $('#datepicker-sidebar').removeClass("validation");
            }

            if(O.time.length == 0){
               error = true;
                $('#InputTimeFixed').addClass("validation");
            }else{
                $('#InputTimeFixed').removeClass("validation");
            }

            if(O.numOfperson.length == 0){
               error = true;
                $('#InputNumOfPersonFixed').addClass("validation");
            }else{
                $('#InputNumOfPersonFixed').removeClass("validation");
            }

             if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
               // $('#send-message-sidebar').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post(O.actionurl, allQueryVall,function(result){

                    if(result == 'sent'){
                         $('#send-message-sidebar').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#sidebar_mail_success').fadeIn(500);
                    }else{
                         //Display the error message
                        $('#sidebar_mail_fail').fadeIn(500);
                        // Enable the submit button again
                        $('#send-message-sidebar').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
            return false;
        });
 
      

    
   
         $("#booking_form").on( "submit", function( event ) {
            event.preventDefault();
           
            var allQueryVal=$(this).serializeObject();
            var allQueryVall=$(this).serialize();
           //console.log(allQueryVal);           
          
           var O={}; var error = false;
           O.email=allQueryVal['data[Reservation][email]'];
           O.date=allQueryVal['data[Reservation][date]'];
           O.numOfperson=allQueryVal['data[Reservation][num_of_person]'];
           O.name=allQueryVal['data[Reservation][name]'];
           O.phone=allQueryVal['data[Reservation][phone]'];
           O.time=allQueryVal['data[Reservation][time]'];
           O.actionurl=$(this).data('actionurl');           


            if(O.name.length == 0){
                error = true;
                $('#InputName').addClass("validation");
            }else{
                $('#InputName').removeClass("validation");
            }


            if(O.email.length == 0 || O.email.indexOf('@') < 1 || (O.email.lastIndexOf('.') - O.email.indexOf('@') < 2) || (O.email.length - O.email.lastIndexOf('.') < 2) )
            {
               error = true;                
                $('#InputEmail').addClass("validation");                
            }else{
                $('#InputEmail').removeClass("validation");
            }


            if(O.phone.length == 0){
               error = true;
                $('#inputPhone').addClass("validation");
            }else{
                $('#inputPhone').removeClass("validation");
            }

            if(O.date.length == 0){
               error = true;
                $('#datepicker').addClass("validation");
            }else{
                $('#datepicker').removeClass("validation");
            }

            if(O.time.length == 0){
               error = true;
                $('#InputTime').addClass("validation");
            }else{
                $('#InputTime').removeClass("validation");
            }

            if(O.numOfperson.length == 0){
               error = true;
                $('#InputNumOfPerson').addClass("validation");
            }else{
                $('#InputNumOfPerson').removeClass("validation");
            }

             if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                
               // $('#send-message-reservation').attr({'enabled' : 'enable', 'value' : 'Sending...' });
                
                /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
                $.post(O.actionurl, allQueryVall,function(result){

                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         
                         $('#send-message-reservation').attr({'enabled' : 'enable', 'value' : 'send' });
                        //Display the success message
                        $('#reservation_mail_success').fadeIn(500);
                        var high = "";
                        high=$(".booking-back").height(); 
                        $(".book-table-wrapper .booking-image img").css("height", high+190); 
                    }else{
                        //Display the error message
                        $('#reservation_mail_fail').fadeIn(500);
                        var high = "";
                        high=$(".booking-back").height(); 
                        $(".book-table-wrapper .booking-image img").css("height", high+190); 
                        // Enable the submit button again
                        $('#send-message-reservation').removeAttr('disabled').attr('value', 'Send The Message');
                    }
                });
            }
            return false;
        });
 

      

$('#comment-submit').on("click",function(e){
            
            // Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            
            var email = $('#exampleInputEmail1').val();
            
            var name = $('#yourName1').val();
            
            
            if(email.length == 0 || email.indexOf('@') < 1 || (email.lastIndexOf('.') - email.indexOf('@') < 2) || (email.length - email.lastIndexOf('.') < 2) )
            {
                var error = true;
                
                $('#exampleInputEmail1').addClass("validation");
                
            }else{
                $('#exampleInputEmail1').removeClass("validation");
            }
            
            if(name.length == 0){
                var error = true;
                $('#yourName1').addClass("validation");
            }else{
                $('#yourName1').removeClass("validation");
            }
        });


    });




