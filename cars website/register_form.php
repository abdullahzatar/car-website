<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['iduser'];
   $countries = $_POST['countries'];

   $select = " SELECT * FROM authdb WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO authdb(name, email, password, user_type, countries) VALUES('$name','$email','$pass','$user_type','$countries')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      
      <div style="text-align:left;" >
        <p>Type of User : <br>
         <input type="radio" id="user" name="iduser" value="user" style="width: 20px;  " >
            <label for="user" >User</label>
            <input type="radio" id="admin" name="iduser" value="admin" style="width: 20px; margin-left:20px ;">
            <label for="admin">Admin</label></p>
        </div>

        <div style="text-align:left;">
        <p for="countries">Countries:
        <select name="countries" id="countries">
        <option value="null" >Select One</option>
        <option value="JO" >Jordan</option>
        <option value="SA" >Saudi Arabia</option>
        <option value="EG" >Egypt</option>
        <option value="UA" >United Arab Emirates</option>
        </select></p>
        </div>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>