<?php
    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $bookid = $_POST['bookid'];
        $bookname = $_POST['bookname'];
        $authorname = $_POST['authorname'];

        if($bookid == '' OR $bookid == NULL){
            header('location: ../pages/bookupdate.php');
        }

        $sql = "SELECT * FROM book_details WHERE book_id = '$bookid'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows == 1){
            $sql = "UPDATE book_details SET book_name = '$bookname' , author_name = '$authorname' WHERE book_id = '$bookid'";
            mysqli_query($conn, $sql);
            header('location: ../pages/bookupdate.php');
        }else{
            echo 'Error! Wrong book id';
        }
        
    }
?>