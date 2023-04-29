<?php      
    include('connection.php');  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from o_login where username = '$username' and password = '$password'";  
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
			echo '<script>location.replace("OfficerLogin.html")</script>';
        }     
?>