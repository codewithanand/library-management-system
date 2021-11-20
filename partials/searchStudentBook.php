<?php
    include '../partials/dbConnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $bookid = $_POST['bookid'];
        $studentid = $_POST['studentid'];

        $sql = "SELECT * FROM book_details WHERE book_id = '$bookid'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);

            $bookname = $row['book_name'];
            $authorname = $row['author_name'];

            $sql = "SELECT * FROM student_data WHERE student_id = '$studentid'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $studentname = $row['student_name'];

            if($result){
                $sql = "SELECT * FROM student_book WHERE student_id = '$studentid'";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $row = mysqli_fetch_assoc($result);
                    if(($row['book_issued_1'] != "" OR $row['book_issued_1'] != NULL) AND ($row['book_issued_2'] != "" OR $row['book_issued_2'] != NULL) AND ($row['book_issued_3'] != "" OR $row['book_issued_3'] != NULL)){
                        echo 'Error! Book cannot be issued. First return any issued book.';
                        $book_issued_1 = $row['book_issued_1'];
                        $book_issued_2 = $row['book_issued_2'];
                        $book_issued_3 = $row['book_issued_3'];
                        header('location: ../pages/bookissue.php');
                    }
                    else{
                        $book_issued_1 = $row['book_issued_1'];
                        $book_issued_2 = $row['book_issued_2'];
                        $book_issued_3 = $row['book_issued_3'];
                        header('location: ../pages/bookissue.php');
                    }
                }
                else{
                    echo 'Error! Student not found.';
                    header('location: ../pages/bookissue.php');
                }
            }
            else{
                echo 'Error! No record found from the student id';
                header('location: ../pages/bookissue.php');
            }
        }
        else{
            echo 'Error! Wrong book id.';
            header('location: ../pages/bookissue.php');
        }
    }
?>