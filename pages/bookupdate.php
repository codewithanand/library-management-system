<?php
    $bookid='';
    $bookname='';
    $authorname='';

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
        }
        else{
            echo 'Error! Wrong book id.';
            $bookid = 'Not Found';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book UPDATE | YSM Library</title>
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
            <a href="" class="btn btn-sm sec">admin</a>
        </div>
    </div>
    <div class="main">
        <div class="container md-row">

            <!-- =========================== BOOK SEARCH FORM ======================== -->
            <form class="container md-col" action="./bookupdate.php" method="post" name="bookSearch">
                <div class="row">
                    <h1>BOOK UPDATE</h1>
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
            <form class="container md-col w-sm" action="../partials/confirmBookUpdate.php" method="post">
                <div class="container md-col bg-wb">
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookid">BOOK ID</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookid" id="bookid" value="'.$bookid.'">';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="bookname">BOOK NAME</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="bookname" id="bookname" value="'.$bookname.'">';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="lb-sm" for="authorname">AUTHOR NAME</label>
                        </div>
                        <div class="col">
                            <?php
                                echo '<input class="lb-sm" type="text" name="authorname" id="authorname" value="'.$authorname.'">';
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="container md-col">
                    <div class="row row-cen">
                        <div class="col">
                            <button class="btn btn-sm" name="confBookIssue" type="submit">CONFIRM</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>