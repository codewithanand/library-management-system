<?php
    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $studentid = $_GET['studentid'];
        $bookid = $_GET['bookid'];

        $sql = "SELECT * FROM student_book WHERE (student_id = '$studentid' AND book_issued_1 = '$bookid') OR (student_id = '$studentid' AND book_issued_2 = '$bookid') OR (student_id = '$studentid' AND book_issued_3 = '$bookid')";
        $result = mysqli_query($conn, $sql);

        $numRows = mysqli_num_rows($result);

        if($numRows == 1){

            $row = mysqli_fetch_assoc($result);

            if($row['book_issued_1'] == $bookid){
                $sql = "UPDATE student_book SET book_issued_1 = '' WHERE student_id = '$studentid'";
                mysqli_query($conn, $sql);
            }else if($row['book_issued_2'] == $bookid){
                $sql = "UPDATE student_book SET book_issued_2 = '' WHERE student_id = '$studentid'";
                mysqli_query($conn, $sql);
            }else if($row['book_issued_3'] == $bookid){
                $sql = "UPDATE student_book SET book_issued_3 = '' WHERE student_id = '$studentid'";
                mysqli_query($conn, $sql);
            }
            $sql = "UPDATE book_details SET issued_by='', issued_date='' WHERE book_id='$bookid'";
            mysqli_query($conn, $sql);
            header('location: ../pages/bookreturn.php');
        }

        else{
            echo 'Error! This student is not the book issuer';
        }
    }
?>