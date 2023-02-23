<?php require "./config/config.php"; ?>

<?php 
$query = $_GET['query'];
$data=$conn->prepare("select posts.title from blog.posts where posts.title like :query limit 5 ;");
$data->execute([':query'=>"%$query%"]);
$postsRows = $data->fetchAll(PDO::FETCH_ASSOC);
foreach($postsRows as $x){
    echo $x['title']."<br>";
}
?>