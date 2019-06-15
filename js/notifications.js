$(document).ready(function(){

    // Updating the notifications on the start
    load_unseen_notification();
    // ./
    
    // Load new notifications after closing the dropdown - clear the notification number and content after that
    $(document).on('click', '#notification_dropdown_button', function(){
     $('.open').removeClass('open');  // since I suck at JS timeline I make dropdown close it's self faster
     if(!($('#notification_dropdown').hasClass('open'))){
       $('.count').html('');  // clears the notification number
       load_unseen_notification('seen2');
     }
    });
    // ./
    
    // Check for new notifications every 5 sec
    setInterval(function(){
     load_unseen_notification();
    }, 5000);
    });
    // ./
    
    // Main function for updating notifications
    function load_unseen_notification(view = ''){
     $.ajax({     // request asks to check database for new comments and expects data to show in json
      url:"admin/processing/fetch_notifications.php",
      method:"POST",
      data:{view:view},
      dataType:"json",      // results expected dataType (by default - intelligent guessing)
      success:function(data){
       $('#notification_dropdown_menu').html(data.notification); // showing the notifications
       if(data.unseen_notification > 0){
        $('.count').html(data.unseen_notification);
       }
      }
     });
    }
    