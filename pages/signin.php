<?php
    include "../partials/dbConnect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userID = $_POST['uid'];
        $pass = $_POST['pass'];
    
        $sql = "SELECT * FROM user_data WHERE uid = '$userID'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);
    
        if($numOfRows == 1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($pass, $row['password'])){
                    session_start();
                    $_SESSION['username'] = $userID;
                    $_SESSION['loggedin'] = true;
                    header('location: ./admin.php');
                }
                else{
                    echo 'Error! Incorrect password';
                }
            }
        }else{
            echo 'Error! User name does not exist';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | YSM Library</title>
</head>
<body>
    <div class="container">
        <form action="./signin.php" method="POST">
            <input type="text" placeholder="User ID" name="uid" id="uid">
            <input type="password" placeholder="Password" name="pass" id="pass">
            <button class="btn" type="submit">Sign in</button>
            <a href="./signup.php" class="btn">Sign up</a>
        </form>
    </div>
</body>
</html>