<?php require "./partials/header.php";?>
<?php require "./config/config.php";?>

<?php 
    if (isset($_POST['search'])) {
         $search= $_POST['search'];
         $data = $conn->prepare("select * from blog.posts where posts.title like :search;");
         $data->execute([':search'=>"%$search%"]);
         $result = $data->fetchAll(PDO::FETCH_ASSOC);

    }
?>
          <?php foreach($result as $x): ?>
          <div class="post-preview">
            <a href="http://localhost/blog/posts/post.php?post_id=<?php echo $x['id']; ?>">
              <h2 class="post-title">
                <?php echo $x['title']; ?>
              </h2>
              <h3 class="post-subtitle">
              <?php echo $x['subtitle']; ?>
              </h3>
            </a>
            <p class="post-meta">
              Posted by 
              
              <a href="#!"><?php echo $x['username']; ?></a>
              <?php echo $x['niceDate']; ?>
            </p>
          </div>
          <!-- Divider-->
          <hr class="my-4" />
          <?php endforeach; ?>
          <!-- Pager-->
        </div>
      </div>

<?php require "./partials/footer.php";?>