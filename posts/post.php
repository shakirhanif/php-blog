<?php require "../partials/navbar.php"; ?>
<?php require "../config/config.php";?>
<?php 
    if (isset($_GET['post_id'])) {
        $id = $_GET['post_id'];
        $post = $conn->prepare("select *,DATE_FORMAT(createdAt,'%b %e-%Y %h:%i %p') as niceDate from blog.posts where id=$id;");
        $post->execute();
        $row = $post->fetch(PDO::FETCH_ASSOC);
        $comments=$conn->prepare("select comments.comment,users.username,DATE_FORMAT(comments.created_at,'%b %e-%Y %h:%i %p') as commentDate from blog.comments join blog.users on comments.user_id=users.id where comments.post_id=$id;");
        $comments->execute();
        $commentsRow = $comments->fetchAll(PDO::FETCH_ASSOC);
    }else{
        echo "404";
    }
    if (isset($_POST['submit'])) {
        $user_id=$_SESSION['user_id'];
        $comment=$conn->prepare(" insert into blog.comments (post_id,user_id,comment) values(:post_id,:user_id,:comment);");
        $comment->execute([
            ':post_id'=>$id,
            ':user_id'=>$user_id,
            ':comment'=>$_POST['comment'],
        ]);
        header("location: http://localhost/blog/posts/post.php?post_id=$id");
    }
?>
<?php if(!$row==''): ?>
        <!-- Page Header-->
        <header class="masthead" style='background-image: url(<?php $image = $row['image']; echo !$image==''? "http://localhost/blog/images/$image)":"http://localhost/blog/assets/img/post-bg.jpg)";?>'>
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $row['title'];?></h1>
                            <h2 class="subheading"><?php echo $row['subtitle'];?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $row['username'];?></a>
                                on <?php echo $row['niceDate'];?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?php echo $row['body']; ?> </p>
                        <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_id']==$row['user_id']): ?>
                        <a href="<?php echo "$URL/posts/delete.php?post_id=$id" ?>" class="btn btn-danger text-center float-end">DELETE</a>
                        <a href="<?php echo "$URL/posts/update.php?post_id=$id" ?>" class="btn btn-warning text-center">UPDATE</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>
    <?php else: ?>
        <header class="masthead" style='background-image: url(http://localhost/blog/assets/img/post-bg.jpg)'>
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>404 NOT FOUND</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <?php endif;?>
    <section>
          <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>

                <div class="card">
                  <div class="card-body">
                    <?php foreach($commentsRow as $z): ?>
                    <div class="d-flex flex-start align-items-center">
                    
                        <div>
                            <h6 class="fw-bold text-primary"><?php echo $z['username'];?><h8 class="p-3 text-black"><?php echo $z['commentDate']; ?></h8></h6>
                            
                        </div>
                        </div>

                        <p class="mt-3 mb-4 pb-2">
                        <?php echo $z['comment']; ?>
                        </p>
                   

                        <hr class="my-4" />
                        <?php endforeach; ?>

                 
                  </div>
                  <form method="POST" action="<?php echo $URL."/posts/post.php?post_id=".$id; ?>">

                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">

                            <div class="d-flex flex-start w-100">
                            
                                <div class="form-outline w-100">
                                    <textarea class="form-control" id="" placeholder="write message" rows="4"
                                     name="comment"></textarea>
                                
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
    <div>
            <?php require "../partials/footer.php"; ?>
