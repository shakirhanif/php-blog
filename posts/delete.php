<?php
    require "../config/config.php";
    if (isset($_GET['post_id'])) {
        $did=$_GET['post_id'];
        $post = $conn->prepare("delete from blog.posts where id=:id");
        $post->execute([':id'=>$did]);
        header('location: http://localhost/blog');
    }
    
?>