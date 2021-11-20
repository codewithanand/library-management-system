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
            <a href="./logout.php" class="btn btn-sm">LOG OUT</a>
            <a href="" class="btn btn-sm sec">admin</a>
        </div>
    </div>
    <div class="main">
        <form class="container md-col" action="./login.php" method="post">
            <div class="row-cen">
                <a href="./signup.php" class="btn btn-lg">New User</a>
            </div>
            <div class="row-cen">
                <a href="./bookissue.php" class="btn btn-lg">Issue a Book</a>
            </div>
            <div class="row-cen">
                <a href="./bookreturn.php" class="btn btn-lg">Return a Book</a>
            </div>
            <div class="row-cen">
                <a href="./bookentry.php" class="btn btn-lg">New Book Entry</a>
            </div>
            <div class="row-cen">
                <a href="./bookupdate.php" class="btn btn-lg">Update Book Entry</a>
            </div>
            <div class="row-cen">
                <a href="./bookdelete.php" class="btn btn-lg">Delete Book Entry</a>
            </div>
        </form>
    </div>
</body>
</html>