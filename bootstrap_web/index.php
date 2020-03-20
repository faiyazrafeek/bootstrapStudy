<?php
    include('server.php');

    //if user is not logged in, they cannot access this page
    if(empty($_SESSION['username'])){
        header('location:login.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Home - Bootstrap Web</title>

   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="img/favicons/manifest.json">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="img/favicon.ico">
   
    <meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">PHP Login</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="index.php">Home</a>
        <a class="nav-link" href="crud.php">CRUD</a>
        <a class="nav-link" href="contact.php">Contact</a>
        <a class="nav-link" href="index.php?logout='1'">Logout</a>
      </nav>
    </div>
  </header>
    
  <div class="container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php
                    echo $_SESSION['success'];
                    unset ($_SESSION['success']);
                ?>
            </div>
        <?php endif ?>
    </div>

  <main role="main" class="inner cover">
    <div class="container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php
                    echo $_SESSION['success'];
                    unset ($_SESSION['success']);
                ?>
            </div>
        <?php endif ?>

        <?php if(isset($_SESSION["username"])): ?>
            <div class="starter-template">
                <h1 class="cover-heading">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
            </div>
        <?php endif ?>
    </div>
   
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Designed for <a href="#">FA Design</a>, by <a href="#">@faiyazrafeek</a>.</p>
    </div>
  </footer>
</div>
</body>
</html>
