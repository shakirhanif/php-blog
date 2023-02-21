<?php require "../partials/navbar.php"; ?>
<?php require '../config/config.php'; ?>
<?php
    $post_id = $_GET['post_id'];
    $qry = $conn->prepare("select * from blog.posts where id=$post_id "); 
    $qry->execute();
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    $imageName = $row['image'];
    if (isset($_POST['submit'])) {
        if (!$_FILES['image']['name']=='') {
            $img = date("his").$_FILES['image']['name'];
        }else{
            $img = $imageName;
        };
        $dir = '../images/' . basename($img);
        $update = $conn->prepare("update blog.posts set title=:title,subtitle=:subtitle,body=:body,image=:image where id=$post_id ");
        $update->execute([
            ':title'=>$_POST['title'],
            ':subtitle'=>$_POST['subtitle'],
            ':body'=>$_POST['body'],
            ':image'=>$img,
        ]);
        if (move_uploaded_file($_FILES['image']['tmp_name'],$dir)) {
            unlink("../images/$imageName");
            header("location: $URL/posts/post.php?post_id=$post_id");
          }
        header("location: $URL/posts/post.php?post_id=$post_id");
    }

 ?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url(<?php echo !$imageName==''? "http://localhost/blog/images/$imageName" :'../assets/img/home-bg.jpg';?>)">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
       
        <div class="container px-4 px-lg-5">

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?post_id=$post_id"; ?>" enctype="multipart/form-data">
              <div class="form-outline mb-4">
                <input value="<?php echo $row['title']; ?>" type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input value="<?php echo $row['subtitle']; ?>" type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

              <div class="form-outline mb-4">
                <textarea name="body" id="form2Example1" cols="30" rows="10" style="width:100%"><?php echo $row['body']; ?></textarea>
            </div>
            
            <div id="preview" ><img src="" width="500px" id="output" ></div>
            
            <img src="" alt="" srcset="">
             <div class="form-outline mb-4">
                <input type="file" name="image"   id="image" onchange="loadFile(event)" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>


           
        </div>
        <script>
            function loadFile(e) {
                let output = document.getElementById('output');
                output.src = URL.createObjectURL(e.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
   <?php require "../partials/footer.php";?>
