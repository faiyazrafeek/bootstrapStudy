<?php
    session_start();
    $username ="";
    $email ="";
    $errors = array();

    $name ="";
    $address="";
    $id=0;
    $edit_state = false;

    //connect to the database
    $db = mysqli_connect('localhost','root','','php_login');

    //if registe button is clicked
    if(isset($_POST['register'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);

        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }
        if(empty($password_2)){
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2){
            array_push($errors, "Passwords do not match");
        }

        //if there are no errors
        if(count($errors)==0){
            $password = md5($password_1); //encrypt password before storing in database
            $sql = "INSERT INTO users (username, email, password) 
                                VALUES ('$username','$email','$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php'); //redirect to home page
        }
    }

    //log user in from login page
    if (isset($_POST['login'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);

        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Pasword is required");
        }
        if (count($errors)==0){
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success']="You are now logged in";
                header('location: index.php');
            }else{
                array_push($errors, "Wrong username/password combination");
            }
        }
    }

    
    //crud
    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $address = $_POST['address'];

        $sql = "INSERT INTO crud (name, address) VALUES ('$name','$address')";
        mysqli_query($db, $sql); 

        $_SESSION['success']="Details Saved";
        header('location: crud.php');
    }

    //update crud
    if(isset($_POST['update'])){        
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $id = mysqli_real_escape_string($db, $_POST['id']);

        $sql = "UPDATE crud  SET name = '$name' , address = '$address' WHERE id=$id";
        mysqli_query($db, $sql); 
        $_SESSION['success']="Details Updated";
        header('location: crud.php');
    }

    //delete crud
    if(isset($_GET['del'])){        
        $id = $_GET['del'];
        $sql = "DELETE FROM crud WHERE id=$id";
        mysqli_query($db, $sql); 
        $_SESSION['success']="Details Deleted";
        header('location: crud.php');
    }

    //retrieve crud details
    $query = "SELECT * FROM crud";
    $results = mysqli_query($db, $query);






    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location:login.php');
    }

?>