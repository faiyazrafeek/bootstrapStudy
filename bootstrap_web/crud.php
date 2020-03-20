<?php 

    include('server.php');

    //if user is not logged in, they cannot access this page
    if(empty($_SESSION['username'])){
        header('location:login.php');
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];

        $edit_state =true;

        $rec = mysqli_query($db, "SELECT * FROM crud WHERE id = $id");
        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $address = $record['address'];
        $id = $record['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Bootstrap Web</title>

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

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="crud.php?logout='1'">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<br>
<br>
 
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

    <div class="container">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td scope="row"> <?php echo $row['name']; ?> </td>
                        <td> <?php echo $row['address']; ?> </td>
                        <td>
                            <a class="btn btn-warning" href="crud.php?edit=<?php echo $row['id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="server.php?del=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
    </div>
   
    <div class="container">
        <form method="POST" action="crud.php">
            <div class="form-group">
                <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" >
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"> 
            </div>
            <?php if($edit_state==false): ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php else: ?>
            <button type="submit" class="btn btn-secondary" name="update">Update</button>
            <?php endif ?>
            
    </form>
    </div>



</body>
</html>