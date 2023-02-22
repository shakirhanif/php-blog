<?php require "../partials/header.php";?>
<?php require "../config/config.php"; ?>
<?php 
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $sql = $conn->prepare(" select * from blog.users where id=:id ");
        $sql->execute(['id'=>$userId]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
    }
    if (isset($_POST['submit'])) {
        if (!$_POST['password']=='') {
            $password= password_hash($_POST['password'],PASSWORD_DEFAULT) ;
        }else{
            $password = $row['password'];
        }

        $update = $conn->prepare("update blog.users set username=:username,email=:email,password=:password where id=$userId;");
        $update->execute([
            ':email'=>$_POST['email'],
            ':username'=>$_POST['username'],
            ':password'=>$password,
        ]);
        header("location: $URL/user/profile.php?user_id=$userId");
    }
?>

<form method="POST" action="<?php echo $URL.'/user/profile.php'; ?>">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" value="<?php echo $row['email']; ?>" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" value="<?php echo $row['username'];?>" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" value="" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">UPDATE</button>
              </div>
            </form>
<?php require "../partials/footer.php";?>
