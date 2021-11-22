<?php
    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $studentid = $_GET['studentid'];
        $bookid = $_GET['bookid'];
        $time_stamp = $_GET['timestamp'];

        if($bookid == '' OR $bookid == NULL){
            header('location: ../pages/bookissue.php');
        }

        $sql = "SELECT * FROM student_book WHERE student_id = '$studentid'";
        $result = mysqli_query($conn, $sql);

        $numRows = mysqli_num_rows($result);

        if($numRows == 1){

            $row = mysqli_fetch_assoc($result);

            if($row['book_issued_1'] == "" OR $row['book_issued_1'] == NULL){
                $sql = "UPDATE student_book SET book_issued_1 = '$bookid' WHERE student_id = '$studentid'";
                mysqli_query($conn, $sql);
            }else if($row['book_issued_2'] == "" OR $row['book_issued_2'] == NULL){
                $sql = "UPDATE student_book SET book_issued_2 = '$bookid' WHERE student_id = '$studentid'";
                mysqli_query($conn, $sql);
            }else if($row['book_issued_3'] == "" OR $row['book_issued_3'] == NULL){
                $sql = "UPDATE student_book SET book_issued_3 = '$bookid' WHERE student_id = '$studentid'";
                mysqli_query($conn, $sql);
            }
            
            $sql = "UPDATE book_details SET issued_by = '$studentid', issued_date = '$time_stamp' WHERE book_id = '$bookid'";
            mysqli_query($conn, $sql);
            header('location: ../pages/bookissue.php');
        }
    }
?>