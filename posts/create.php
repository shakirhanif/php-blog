<?php include "../partials/header.php";?>
<?php require "../config/config.php"; ?>
<?php 
    if (!isset($_SESSION['username'])) {
      header("location: http://localhost/blog/auth/login.php");
    }
    $cats = $conn->prepare( "select *,DATE_FORMAT(createdAt,'%b %e-%Y %h:%i %p') as niceDate from blog.categories;" );
    $cats->execute();
    $catRows = $cats->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_POST['submit'])) {
        if ($_POST['title']=='' OR $_POST['subtitle']=='' OR $_POST['body']=='') {
            echo "one or more field is empty";
        }else{

            $title=$_POST['title'];
            $subtitle=$_POST['subtitle'];
            $body=$_POST['body'];
            $category = $_POST['category_id'];
            if (!$_FILES['image']['name']=='') {
              $img = date("his").$_FILES['image']['name'];
            }else{
              $img = $_FILES['image']['name'];
            }
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['username'];
            $dir = '../images/' . basename($img);
            $insert = $conn->prepare("insert into blog.posts (title,subtitle,body,image,user_id,username,categoryId) values (:title,:subtitle,:body,:image,:user_id,:user_name,:categoryId);");
            $insert->execute([
                ':title'=>$title,
                ':subtitle'=>$subtitle,
                ':body'=>$body,
                ':image'=>$img,
                ':user_id'=>$user_id,
                ':user_name'=>$user_name,
                ':categoryId'=>$category,
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
            <!-- <style>
              .dropdown{
                margin-left: 50%;
                position: relative;
              }
              .drpdwn{
                background-color: gray;
                position: absolute;
                width: 150px;
                display: none;
              }
              .dropdown p{
                margin-left: 10px;
              }
              .show{
                display: block;
              }
              .myButton{
                background-color: gray;
                width: 100px;
                cursor: pointer;
              }
              .myMain{
                display: flex;
              }
              .content{
                cursor: pointer;
              }
              .myInput{
                display: none;
              }
            </style> -->
            <!-- <div class="form-outline mb-4 dropdown">
                <div class="myMain">
                  <div onclick="myFunc()" class="myButton">Category:</div>
                  <div style="margin-left: 10px;" id="catName"></div>
                </div>
                <div class="drpdwn" id="myDropDown">
                  <php foreach($catRows as $x): ?>
                  <div class="content" onclick="funcTwo(event)"><php echo $x['name']; ?></div>
                  <php endforeach; ?>
                </div>
            </div>
            <input type="text" class="myInput" id="myInput" value="" name="category"> -->
            <!-- <script>
              function myFunc() {
                document.getElementById('myDropDown').classList.add('show');
              }
              window.onclick=function(e){
                if (!e.target.matches('.myButton')) {
                  document.getElementById('myDropDown').classList.remove('show');
                }
              }
              function funcTwo(e) {
                document.getElementById('catName').innerHTML = e.target.innerText;
                document.getElementById('myInput').value = e.target.innerText;
              }
            </script> -->
            <select name="category_id">
              <option selected>Select Category</option>
              <?php foreach($catRows as $x): ?>
              <option value="<?php echo $x['id'];?>"><?php echo $x['name']; ?></option>
              <?php endforeach; ?>
            </select>

              
             <div class="form-outline mb-4">
                <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>
<?php include "../partials/footer.php";?>

