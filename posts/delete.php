<?php
    require "../config/config.php";
    session_start();
    if (isset($_GET['post_id'])) {
        $did=$_GET['post_id'];
        $postOwner = $conn->prepare("select * from blog.posts where id=$did");
        $postOwner->execute();
        $postRow = $postOwner->fetch(PDO::FETCH_ASSOC);
        if ($postRow['user_id']==$_SESSION['user_id']) {
            $postDelete = $conn->prepare("delete from blog.posts where id=:id");
            $postDelete->execute([':id'=>$did]);
            header('location: http://localhost/blog');
        }else{
            echo "you can only delete your own post";
        }
    }
    
?>