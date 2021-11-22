<?php
    $bookid='';
    $bookname='';
    $authorname='';
    $isBookDeletable = FALSE;

    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $bookid = $_POST['bookid'];

        $sql = "SELECT * FROM book_details WHERE book_id = '$bookid'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);

            $bookname = $row['book_name'];
            $authorname = $row['author_name'];

            $isBookDeletable = TRUE;
        }
        else{
            echo 'Error! Wrong book id.';
            $bookid = 'Not Found';
            $isBookDeletable = FALSE;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Delete | YSM Library</title>
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
        <div class="container md-row" id="resContent">

            <!-- =========================== BOOK SEARCH FORM ======================== -->
            <form class="container md-col" action="./bookdelete.php" method="post" name="bookSearch">
                <div class="row">
                    <h1>BOOK DELETE</h1>
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
                        <button type="reset" class="btn btn-sm">CLEAR</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-sm">SEARCH</button>
                    </div>
                </div>
            </form>

            <!-- =========================== CONFIRM BOOK UPDATE FORM ======================== -->
            <form class="container md-col w-sm" action="../partials/confirmBookDelete.php?bookid=<?php echo $bookid ?>" method="post">
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
                                echo '<input class="lb-sm" type="text" name="bookname" id="bookname" value="'.$bookname.'" disabled>';
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
                
                <div class="container md-col">
                    <div class="row row-cen">
                        <div class="col">
                            <!-- <button class="btn btn-sm" name="confBookIssue" type="submit">CONFIRM</button> -->
                            <?php 
                                if($isBookDeletable){
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