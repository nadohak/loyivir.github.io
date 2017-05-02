<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Ubuntu:400,500&amp;subset=cyrillic" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
    <div class="form-container">
         
           <div class="row"> 
           
            <div class="col-md-6">
            <img src="img/toptail.png" alt="" class="top-img">
            <div class="form-img"> 

              <img src="img/form-img.png"  alt=""> 
            </div>      
         </div>   
              <div class="col-md-6" >
         <div class="form-container-right">
         <img src="img/bottomtail.png" alt="" class="bottom-img">
           <h2>Сохрани свой аккаунт</h2>  
           <h3>Получи бесплатно неограниченное количество  
форм, вопросов и ответов.</h3>  
          <form action="#" class="form" id="form">
            <input type="text" class="form-input form-input-name" name="name" placeholder="Имя или никнейм">
            <input type="email" class="form-input form-input-email" name="email" placeholder="Email">
            <input type="password" class="form-input form-input-password" name="password" placeholder="Пароль">
            <div class="form-button-holder">
              <button class="form-button">Сохранить &rsaquo;</button>
            </div>
          </form>
          <div class="entrance">
          <a href="#"><span class="registered">Уже есть аккаунт?</span></a>
           <a href="#"><span class="enter">Войти</span></a>
          </div>
         </div>  
         </div>     
         </div>  
      </div> 
    </div>
<!-- Modal -->
<div class="modal fade popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content dialog">
      <div class="modal-header">
        <button type="button" class="close dialog-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">  Благодарим за регистрацию!  </h4>
      </div>
       
    </div>
  </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="js/messages_ru.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      
    
   /*  $.validator.setDefaults( {
      submitHandler: function () {
        alert( "submitted!" );
      }
    } );*/
            $('#form').validate({
             
              rules: {
               name: {
                  required: true,
                  minlength: 2,
                  maxlength: 30
                },
                password: {
                  required: true,
                  minlength: 6,
                  maxlength: 30
                },
                email: {
                  required: true,
                  email: true,
                  maxlength: 30
                  },
                  submitHandler: function(form) {
                 
                 form.submit();
                
                  }
              },
              messages: {
                name: {
                  required: "Имя - обязательное поле",
                  minlength: jQuery.validator.format("Имя должно содержать хотя бы {0} символа")
                },
                password: {
                  required: "Пароль - обязательное поле",
                  minlength: jQuery.validator.format("Пароль должен содержать хотя бы {0} символов")
                }
              },
               
            });
        
         });


          
     
    </script>
     <script>
      
      $(document).ready(function() {

  $("#form").submit(function() {
    $.ajax({
      type: "POST",
      url: "php/smart.php",
      data: $(this).serialize()
    }).done(function() {
      $(this).find("input").val("");
      $('#myModal').modal('show');
      $("#form").trigger("reset");
    });
    return false;
  });
  
});
    </script>
  </body>
</html>