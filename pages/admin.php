<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | YSM Library</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo">
            <h2>YSM LIBRARY</h2>
        </div>
        <div class="nav-btns">
            <a href="./logout.php" class="btn">LOG OUT</a>
            <a href="" class="btn sec">admin</a>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <form class="container" action="./login.php" method="post">
                <div class="row-cen">
                    <a href="./signup.php" class="btn">New User</a>
                </div>
                <div class="row-cen">
                    <a href="./bookissue.php" class="btn">Issue a Book</a>
                </div>
                <div class="row-cen">
                    <a href="./bookreturn.php" class="btn">Return a Book</a>
                </div>
                <div class="row-cen">
                    <a href="./bookentry.php" class="btn">New Book Entry</a>
                </div>
                <div class="row-cen">
                    <a href="./bookupdate.php" class="btn">Update Book Entry</a>
                </div>
                <div class="row-cen">
                    <a href="./bookdelete.php" class="btn">Delete Book Entry</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>