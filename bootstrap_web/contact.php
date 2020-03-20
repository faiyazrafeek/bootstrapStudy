<?php 

    include('server.php');

    //if user is not logged in, they cannot access this page
    if(empty($_SESSION['username'])){
        header('location:login.php');
    }

    $msg = '';
    $msgClass = '';

    //check for submit

    if(filter_has_var(INPUT_POST, 'submit')){
        //echo 'Submitted';

        //Get form data

        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        //Check Required Fields
        if(!empty($email) && !empty($name) && !empty($message)){
            //passed
            //Check email 
            if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
                //failed
                $msg = 'Please use a valid email';
                $msgClass='alert-danger';
            }else{
                //passed
                // Recepient EMial
                $toEmail = 'faiyazrafeek@gmail.com';
                $subject = 'Contact request from '.$name;
                $body = '<h2>Contact Request</h2>
                        <h4>Name</h4><p>'.$name.'</p>
                        <h4>Email</h4><p>'.$email.'</p>
                        <h4>Message</h4><p>'.$message.'</p>';

                //Email headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
                
                //Additonal Headers
                $headers .= "From: " . $name . "<" . $email. ">" . "\r\n";
            
                if (mail($toEmail,$subject,$body,$headers)) {
                    //EMail Sent
                    $msg = 'Your email has been sent';
                    $msgClass='alert-success';
                } else {
                    $msg = 'Your email was not sent';
                    $msgClass='alert-danger';
                }
                

            }
        }else{
            //failed
            $msg = 'Please fill in all fields';
            $msgClass='alert-danger';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bootstrap Web</title>
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
        <a class="nav-link" href="contact.php?logout='1'">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

    <br>
    <div class="container">
        <?php if($msg!= ''): ?>
            <div class="alert <?php echo $msgClass; ?>" >
                <?php echo $msg; ?>
            </div>
        <?php endif ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" id="" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">
            Submit</button>
        </form>
    </div>
</body>
</html>