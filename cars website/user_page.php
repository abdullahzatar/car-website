<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

if(isset($_POST['submit'])){

    $email = $_SESSION['user_email'];
    $car_type = $_POST['car_type'];
    $car_molde = $_POST['car_molde'];
    $date = $_POST['date'];

    $insert = "INSERT INTO user_cars( email, car_type, car_modle, date) VALUES('$email','$car_type','$car_molde','$date')";
    mysqli_query($conn, $insert);
    
    }

    if(isset($_POST['delete'])){

        $sql = "DELETE FROM user_cars WHERE id='".$_POST["id"]."'";
        mysqli_query($conn, $sql);
        
        
        }



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">

   <title>user page</title>

   <!-- custom css file link  -->
   
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <link rel="stylesheet" href="css/style1.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>


<header class="header">

    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="#" > <img src="image/large_anyvehicle[208].png" style="height: 70px;  "></a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#aboutus">About Us</a>
        <a href="#services">services</a>
        <a href="#blog">Blog</a>
        <a href="#contactus">Contact Us</a>
    </nav>

    <div>
        <form action="login_form.php">
            <button class="btn" >Call Us Now</button>
        </form>
    </div>

    <div>
       <p style="color:#FFFFFF  ; font-size:large; margin:10px ; text-align: end;"><?php echo $_SESSION['user_name'] ?> 
       <a href="logout.php" class="btn" style=" height: 40px; margin-left:10px ; ">logout</a>
      </p>
       
      </div>

</header> 

<div class="login-form-container">

    <span id="close-login-form" class="fas fa-times"></span>

    <form action=""  method="post">
        <h3>user login</h3>
        <input type="email" name="email" placeholder="email" class="box" value="<?php  echo $_SESSION['user_email'] ?>" disabled>
        <div style="text-align:left;"  class="box">
        <p for="car_type">Car Type:
        <select name="car_type" id="car_type"  class="box">
        <option value="audi" >Audi</option>
        <option value="kia" >Kia</option>
        <option value="Mercedes" >mercedes</option>
        </select></p>
        </div>
        <input type="text" placeholder="Car Molde" class="box" name="car_molde">

        <div style="text-align:left;"  class="box">
        <p for="car_type">Enter The Day You Want To Pick Up The Car:
        <input type="date" placeholder="enter the data u want to pickit up" class="box" name="date">
        </div>
        <input type="submit" name="submit" value="Add" class="btn">

        <div id="Register-btn">
        </div>
    </form>

</div>

<div class="Register-form-container">

    <span id="close-Register-form" class="fas fa-times"></span>

    <form action="">
        <h3>user Register</h3>
        <input type="text" placeholder="UserName" class="box">
        <input type="email" placeholder="email" class="box">
        <input type="password" placeholder="password" class="box">
        <input type="password" placeholder="Co-password" class="box">
        <div style="text-align:left;">
        <p>Type of User : <input type="radio" id="user" name="iduser" value="user">
            <label for="user">User</label>
            <input type="radio" id="admin" name="iduser" value="admin">
            <label for="admin">Admin</label></p>
        </div>
        <div style="text-align:left;">
        <p for="countries">Countries:
        <select name="countries" id="countries">
        <option value="null">Select One</option>
        <option value="JO">Jordan</option>
        <option value="SA">Saudi Arabia</option>
        <option value="EG">Egypt</option>
        <option value="UA">United Arab Emirates</option>
        </select></p>
        </div>
        <input type="submit" value="Register" class="btn">
        <p>or Register with</p>
        <div class="buttons">
            <a href="#" class="btn"> google </a>
            <a href="#" class="btn"> facebook </a>
        </div>
    </form>

</div>

<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <div id="login-btn">
        <button class="btn" >Add New Request</button>
    </div>
      
      <?php

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email1=$_SESSION['user_email'];
$sql = "SELECT id,email,car_type,car_modle,date,state FROM user_cars where email = '$email1' ";
$stmt = $conn->prepare($sql); 

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "<table  style='margin: 50px; width: 1000px;font-size :15px; '><tr><th>ID</th><th>Email</th><th>Car Type</th><th>Car Modle</th><th>date</th><th>state</th><th>delete</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["email"]."</td><td>".$row["car_type"]."</td><td>".$row["car_modle"]."</td><td>".$row["date"]."</td><td>".$row["state"]."</td>
    <td>
    <form action='' method='post'>
        <input type='hidden' class='btn'name='id' value='".$row["id"]."'>
        <input type='submit' class='btn' name='delete' title='go' value='delete' >
    </form></td>
    
    </tr>";
   
    

  }
  echo "</table>";
 
 
} 
$conn->close();


?>

      
   </div>

</div>



<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>


</body>
</html>