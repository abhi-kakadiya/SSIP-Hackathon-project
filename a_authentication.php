<?php      
    include('connection.php');  
    $adminname = $_POST['adminname'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $adminname = stripcslashes($adminname);  
        $password = stripcslashes($password);  
        $adminname = mysqli_real_escape_string($con, $adminname);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from a_login where adminname = '$adminname' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            // echo "<h1><center> Login successful </center></h1>";
            echo '<script>alert("Login Successfully!!!")</script>';
			echo '<script>location.replace("hello.html")</script>'; 
        }  
        else{  
            // echo "<h1> Login failed. Invalid email or password.</h1>";  
            echo '<script>alert("check your credentials...")</script>';
			echo '<script>location.replace("AdminLogin.html")</script>';
        }     
?>