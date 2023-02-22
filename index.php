<?php require './partials/header.php';?>
<?php require "./config/config.php"; ?>
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <!-- Post preview-->
          <?php
          $posts = $conn->prepare( "select *,DATE_FORMAT(createdAt,'%b %e-%Y %h:%i %p') as niceDate from blog.posts;" );
          $posts->execute();
          $rows = $posts->fetchAll(PDO::FETCH_ASSOC);
          $cats = $conn->prepare( "select *,DATE_FORMAT(created_at,'%b %e-%Y %h:%i %p') as niceDate from blog.categories;" );
          $cats->execute();
          $catRows = $cats->fetchAll(PDO::FETCH_ASSOC);

          ?>
          <?php foreach($rows as $x): ?>
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
      <style>
        .categories{
          display: flex;
          justify-content: center;
          width: 100%;
        }
        .cat{
          margin: 20px 20px;
          color: blue;
        }
      </style>
        <h4>Categories:</h4>
      <div class="categories" >
        <?php foreach($catRows as $y): ?>
          <div class="cat"> <a href="<?php echo $URL.'/posts/category.php?cat_id='.$y['id']; ?>"> <?php echo $y['name']; ?></a></div>
        <?php endforeach; ?>

      </div>
   
  <?php require "./partials/footer.php"; ?>
