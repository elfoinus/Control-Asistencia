<!DOCTYPE html>
<html>
<head>
  <title>Universidad Del Valle Sede Norte Del Cauca</title>
  
  <link rel="icon" type="image/png" href="CSS/Images/Favicon.ico" />

  <link rel="stylesheet" href=" {{ URL::to('CSS/Login.css') }} "/>

  <script class="cssdeck" type="text/javascript" src="../JS/Login.js"></script>
  <meta charset="UTF-8">
</head>
<body>
<div class="login-form">

  <form method="POST">
    
      <img src="CSS/Images/Index.png"/>
      {{csrf_field()}}
      
     <h1>{{$mensaje}}</h1>
     
     <div class="form-group ">
       <input type="text" class="form-control" placeholder="Usuario" name="usuario" id="UserName" required>
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group log-status">
       <input type="password" class="form-control" placeholder="Contraseña" name="password" id="Passwod" required>
       <i class="fa fa-lock"></i>
     </div>

     <input type="submit" class="log-btn" value="Entrar">

  </form>


     
   </div>

</body>
</html>