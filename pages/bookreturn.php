<?php
    $bookid='';
    $bookname='';
    $authorname='';
    $studentid='';
    $studentname='';
    $isReturnable = FALSE;
    $book_issued_1='';
    $book_issued_2='';
    $book_issued_3='';

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

            $numRows = mysqli_num_rows($result);

            if($numRows == 1){
                $sql = "SELECT * FROM student_book WHERE (student_id = '$studentid' AND book_issued_1 = '$bookid') OR (student_id = '$studentid' AND book_issued_2 = '$bookid') OR (student_id = '$studentid' AND book_issued_3 = '$bookid')";
                $result = mysqli_query($conn, $sql);

                $numRows = mysqli_num_rows($result);

                if($numRows == 1){
                    $row = mysqli_fetch_assoc($result);
                    $book_issued_1 = $row['book_issued_1'];
                    $book_issued_2 = $row['book_issued_2'];
                    $book_issued_3 = $row['book_issued_3'];
                    $isReturnable = TRUE;
                }
                else{
                    $studentid = 'Not Found';
                    $studentname = 'Not Found';
                    echo 'Error! This student id is not the book issuer.';
                    $isReturnable = FALSE;
                }
            }
            else{
                echo 'Error! Wrong student id';
                $studentid = 'Not Found';
                $studentname = 'Not Found';
                $isReturnable = FALSE;
            }
        }
        else{
            echo 'Error! Wrong book id.';
            $bookid = 'Not Found';
            $studentid = '';
            $isReturnable = FALSE;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Return | YSM Library</title>
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
        <div class="container md-row">

            <!-- =========================== STUDENT BOOK SEARCH FORM ======================== -->
            <form class="container md-col" action="./bookreturn.php" method="post" name="studentBookSearch">
                <div class="row">
                    <h1>BOOK RETURN</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="lb-sm" for="bookid">BOOK ID</label>
                    </div>
                    <div class="col">
                        <input class="lb-sm" type="text" name="bookid" placeholder="Book ID" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="lb-sm" for="studentid">STUDENT ID</label>
                    </div>
                    <div class="col">
                        <input class="lb-sm" type="text" name="studentid" placeholder="Student ID" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="reset" class="btn btn-sm">CLEAR</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-sm">SEARCH</button>
                    </div>
                </div>
            </form>

            <!-- =========================== CONFIRM BOOK ISSUE FORM ======================== -->
            <?php 
                echo '<form class="container md-col w-sm" action="../partials/confirmBookReturn.php?bookid='.$bookid.'&studentid='.$studentid.'" method="post">';
            ?>
                <div class="container md-col bg-wb">
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookid">BOOK ID</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookid" id="bookid" value="'.$bookid.'" disabled>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookname">BOOK NAME</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookname" id="bookname" value="'.$bookname.'"  disabled>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="authorname">AUTHOR NAME</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="authorname" id="authorname" value="'.$authorname.'" disabled>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container md-col bg-wb">
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="studentid">STUDENT ID</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="studentid" id="studentid" value="'.$studentid.'" disabled>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="studentname">STUDENT NAME</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="studentname" id="studentname" value="'.$studentname.'" disabled>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookissued1">BOOK ISSUED 1</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookissued1" id="bookissued1" value="'.$book_issued_1.'" disabled>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookissued2">BOOK ISSUED 2</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookissued2" id="bookissued2" value="'.$book_issued_2.'" disabled>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookissued3">BOOK ISSUED 3</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookissued3" id="bookissued3" value="'.$book_issued_3.'" disabled>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container md-col">
                    <div class="row row-cen">
                        <div class="col">
                            <!-- <button class="btn btn-sm" name="confBookIssue" type="submit">CONFIRM</button> -->
                            <?php 
                                if($isReturnable){
                                    echo '<button class="btn btn-sm" name="confBookIssue" type="submit">CONFIRM</button>'; 
                                }else{
                                    echo '<button class="btn btn-sm btn-disabled" name="confBookIssue" type="submit">CONFIRM</button>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>