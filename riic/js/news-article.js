$(document).ready(function() {

  // ADD NEWA
  $("#article_form").on('submit', function(e) {

    e.preventDefault();

    var news_title = $('#news_title').val();
    var news_article = $('#news_article').val();
  
    if(news_title == "" || news_article == "") {
      swal({
          title: 'Warning',
          text: 'All fields are required!',
          icon: 'error',
          buttons: false,
          closeOnClickOutside: false,
          closeOnEsc: false,
          timer: 2000
        })
  
    } else {

      $.ajax({  
         url:"controller/save-news.php",  
         method:"POST",  
         data: $("#article_form").serialize(),
         beforeSend:function() {
          $('#save_news').attr('disabled', true);
         },
         success:function(response) {
          // alert(response);
            if(response == 2) {
              swal({
                title: 'Warning',
                text: 'FAILED! News article could not be saved.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 2000
              })
            } else if(response == 1) {
              $('#article_form')[0].reset();

              swal({
                title: 'Success',
                text: 'SUCCESS! News article successfully saved.',
                icon: 'success',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                // window.location.reload();
                $("#reloadContent").load(window.location.href + " #reloadContent");
              })

            } else if(response == 0) {
              swal({
                title: 'Warning',
                text: 'Warning! News article is already on the list. Please try agian.',
                icon: 'error',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
              }).then(function() {
                // $("#reloadContent").load(window.location.href + " #reloadContent");
                window.location.reload();
              })
            } else {
              alert("Error occured. Please try again.");
            }

            $('#save_news').attr('disabled', false);
            $('#news_title').focus();

         }  
      });
    }
  });


  $(document).on('click', '.close_modal', function() {  

    window.location.reload();
    
  });


});

