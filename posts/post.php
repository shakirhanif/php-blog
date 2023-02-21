<?php require "../partials/navbar.php"; ?>
<?php require "../config/config.php";?>
<?php 
    if (isset($_GET['post_id'])) {
        $id = $_GET['post_id'];
        $post = $conn->prepare("select *,DATE_FORMAT(createdAt,'%b %e-%Y %h:%i %p') as niceDate from blog.posts where id=$id;");
        $post->execute();
        $row = $post->fetch(PDO::FETCH_ASSOC);

    }else{
        echo "404";
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
                        <?php if($_SESSION['user_id']==$row['user_id']): ?>
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
    <div>
            <?php require "../partials/footer.php"; ?>
