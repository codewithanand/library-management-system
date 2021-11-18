<?php
    include '../partials/dbConnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Issue | YSM Library</title>
</head>
<body>
    <form action="./bookissue.php" method="post">
        <input type="text" name="bookid" placeholder="Book ID" required>
        <?php

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $bookid = $_POST['bookid'];
                $studentid = $_POST['studentid'];
        
                $sql = "SELECT * FROM book_details WHERE book_id = '$bookid'";
                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
        
                if($numRows == 1){
                    $row = mysqli_fetch_assoc($result);
                    echo '
                    <input type="text" value="'.$row['book_id'].'" disabled>
                    <input type="text" value="'.$row['book_name'].'" disabled>
                    <input type="text" value="'.$row['author_name'].'" disabled>
                    ';
                    $sql = "SELECT * FROM student_data WHERE student_id = '$studentid'";
                    $result = mysqli_query($conn, $sql);

                    if($result){
                        $sql = "SELECT * FROM student_book WHERE student_id = '$studentid'";
                        $result = mysqli_query($conn, $sql);

                        if($result){
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
                            }else{
                                echo 'Error! Maximum number of books issued.';
                            }
                        }else{
                            echo 'Error! Student not found.';
                        }
                    }
                    else{
                        echo 'Error! No record found from the student id';
                    }
                }
                else{
                    echo 'Error! Wrong book id.';
                }
            }
        ?>
        <input type="text" name="studentid" placeholder="Student ID" required>
        <button type="reset">Reset</button>
        <button type="submit">Submit</button>
    </form>
</body>
</html>