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
</head>
<body>
    <h1>New Book Entry</h1>
    <form action="./bookentry.php" method="post">
        <input type="text" id="bookid" name="bookid" placeholder="Book ID">
        <input type="text" id="bookname" name="bookname" placeholder="Book Name">
        <input type="text" id="author" name="author" placeholder="Author">
        <button type="submit">Submit</button>
    </form>
</body>
</html>