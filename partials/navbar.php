<?php
  session_start();
?>
<?php
  $URL="http://localhost/blog";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script
      src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
      crossorigin="anonymous"
    ></script>
    <!-- Google fonts-->
    <link
      href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="http://localhost/blog/css/styles.css" rel="stylesheet" />
    <script>
        function hintFunc(e) {
         var str = e.target.value;
         if (str.length===0) {
          document.getElementById('hint').innerHTML = "";
         }else{
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
            if (this.readyState==4 && this.status == 200) {
              document.getElementById('hint').innerHTML = this.responseText;
            }
          }
          xhttp.open("GET","http://localhost/blog/hint.php?query="+str,true);
          xhttp.send();
         }
        }
      </script>
  </head>
  <body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="http://localhost/blog/index.php">Start Bootstrap</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <div class="ml-4 input-group ps-5" >
          <div id="navbar-search-autocomplete" class="w-100 mr-4" style="position: relative;">
              <form method="POST" action="http://localhost/blog/search.php" class="mr-4" autocomplete="off">
                  <input name="search" type="search" id="form1" class="form-control mt-3" placeholder="search" onkeyup="hintFunc(event)" />
             
              </form>
              <!-- <p id="hint" class="w-100" style="position: absolute;top:20px;background-color: white;" >this suggestion <br> anoi</p> -->
              <p id="hint" class="w-100" style="position: absolute;top:20px;background-color: white;" ></p>

          </div>
         
        </div>
          <ul class="navbar-nav ms-auto py-4 py-lg-0">
            <li class="nav-item">
              <a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/blog/index.php"
                >Home</a
              >
            </li>
<?php if(isset($_SESSION['username'])): ?>

            <li class="nav-item">
              <a
                class="nav-link px-lg-3 py-3 py-lg-4"
                href="http://localhost/blog/posts/create.php"
                >create</a
              >
            </li>
            <li class="nav-item">
            <div class="dropdown">
              <button class="btn dropdown-toggle" style="color:aliceblue; margin-top:3px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username']; ?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo $URL.'/user/profile.php?user_id='.$_SESSION['user_id']; ?>">Profile</a>
                <a class="dropdown-item" href="http://localhost/blog/auth/logout.php">Logout</a>
              </div>
            </div>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/blog/auth/login.php"
                >login</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/blog/auth/register.php"
                >register</a
              >
            </li>
<?php endif; ?>

            <li class="nav-item">
              <a class="nav-link px-lg-3 py-3 py-lg-4" href="../blog/contact.php"
                >Contact</a
              >
            </li>
          </ul>
        </div>
      </div>
     
    </nav>