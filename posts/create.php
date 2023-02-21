<?php include "../partials/header.php";?>
<?php require "../config/config.php"; ?>
<?php 
    if (!isset($_SESSION['username'])) {
      header("location: http://localhost/blog/auth/login.php");
    }
    if (isset($_POST['submit'])) {
        if ($_POST['title']=='' OR $_POST['subtitle']=='' OR $_POST['body']=='') {
            echo "one or more field is empty";
        }else{

            $title=$_POST['title'];
            $subtitle=$_POST['subtitle'];
            $body=$_POST['body'];
            if (!$_FILES['image']['name']=='') {
              $img = date("his").$_FILES['image']['name'];
            }else{
              $img = $_FILES['image']['name'];
            }
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['username'];
            $dir = '../images/' . basename($img);
            $insert = $conn->prepare("insert into blog.posts (title,subtitle,body,image,user_id,username) values (:title,:subtitle,:body,:image,:user_id,:user_name);");
            $insert->execute([
                ':title'=>$title,
                ':subtitle'=>$subtitle,
                ':body'=>$body,
                ':image'=>$img,
                ':user_id'=>$user_id,
                ':user_name'=>$user_name,
            ]);
            if (move_uploaded_file($_FILES['image']['tmp_name'],$dir)) {
              header('location: http://localhost/blog/index.php');
            }
            header('location: http://localhost/blog/index.php');
        }
    }

?>

            <form method="POST" action="http://localhost/blog/posts/create.php" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>
<?php include "../partials/footer.php";?>

