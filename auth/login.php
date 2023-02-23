<?php include "../partials/header.php";?>
<?php include "../config/config.php";?>
<?php
  if (isset($_SESSION['username'])) {
    header("location: http://localhost/blog");
  }
if (isset($_POST['submit'])) {
  if ($_POST['email']=='' OR $_POST['password']=='') {
    echo "no field should be empty";
  }else{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $login = $conn->prepare("select * from blog.users where email = '$email'");
    $login->execute();
    $row = $login->FETCH(PDO::FETCH_ASSOC);
    if($login->rowCount()>0){
      if(password_verify($pass,$row['password'])){
          $_SESSION['username'] = $row['username'];
          $_SESSION['user_id'] = $row['id'];
          header("location: http://localhost/blog");
        // echo 'logged in success';
      }else{
        echo 'wrong password';
      }
    }


  }
}

?>

               <form method="POST" action="login.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
                    

                   
                  </div>
                </form>

           
       <?php include "../partials/footer.php"; ?>