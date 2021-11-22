<?php
    include '../partials/dbConnect.php';


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $bookid = $_POST['bookid'];
        $bookname = $_POST['bookname'];
        $bookauthor = $_POST['author'];

        

        $sql = "SELECT * FROM book_details WHERE book_id = '$bookid'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows > 0){
            echo 'Error! Book entry already exists';
        }
        else{
            $sql = "INSERT INTO book_details (`book_id`, `book_name`, `author_name`) VALUES ('$bookid', '$bookname', '$bookauthor')";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo 'Success! Book entry completed';
                header('location: ./bookentry.php');
            }
            else{
                echo 'Error! Fill the details carefully';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Book Entry | YSM Library</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo">
            <h2>YSM LIBRARY</h2>
        </div>
        <div class="nav-btns">
            <a href="./admin.php" class="btn btn-sm">HOME</a>
            <a href="./logout.php" class="btn btn-sm">LOG OUT</a>
            <a href="" class="btn btn-sm sec"><?php session_start(); echo $_SESSION['username'] ?></a>
        </div>
    </div>
    <div class="main">
        <form class="container md-col w-700" action="./bookentry.php" method="post">
            <div class="row row-cen">
                <h1>NEW BOOK ENTRY</h1>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg" for="bookid">BOOK ID</label>
                </div>
                <div class="col">
                    <input class="lb-lg" type="text" id="bookid" name="bookid" placeholder="Book ID" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg" for="bookname">BOOK NAME</label>
                </div>
                <div class="col">
                    <input class="lb-lg" type="text" id="bookname" name="bookname" placeholder="Book Name" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg" for="authorname">AUTHOR NAME</label>
                </div>
                <div class="col">
                    <input class="lb-lg" type="text" id="author" name="author" placeholder="Author Name" required>
                </div>
            </div>
            <div class="row row-cen">
                <button type="submit" class="btn btn-sm">SUBMIT</button>
            </div>
        </form>
    </div>
</body>
</html>