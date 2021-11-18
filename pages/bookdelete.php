<?php
    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $bookid = $_POST['bookid'];

        $sql = "SELECT * FROM book_details WHERE book_id = '$bookid'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            echo $row['book_id'].' '.$row['book_name'].' by '.$row['author_name'];
            $sql = "DELETE FROM book_details WHERE book_id = '$bookid'";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo 'Success! Book removed from the database.';
            }
            else{
                echo 'Error! Something went wrong.';
            }
        }
        else{
            echo 'Error! Wrong book id.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book | YSM Library</title>
</head>
<body>
    <h1>Delete a Book</h1>
    <form action="./bookdelete.php" method="post">
        <input type="text" name="bookid" id="bookid" required>
        <input type="checkbox" name="confDel" id="confDel" required>
        <label for="confDel">Do you really want to delete the book?</label>
        <button class="btn danger" type="submit">Delete</button>
    </form>
</body>
</html>