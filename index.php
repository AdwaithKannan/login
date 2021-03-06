<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

include('upload.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <div class="header">
        <h2>Home Page</h2>
    </div>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    // unset($_SESSION['success']);
                    ?>
                </h3><br>

                <form class="img"  action=" " method="post" enctype="multipart/form-data" action="upload.php">
                    <input type="file" name="file" id="file" size="35"><br>
                    <input type="submit" name="submit" id="submit" value="Submit">
                </form><br>

                <div id="imageHolder" style="height:200px;max-height:200px;max-width:200px;width:200px;border:1px solid black;">
                    <?php
                    //this part updated
                    if ($error) :
                    ?>
                        <p><?php echo $error; ?></p>
                    <?php
                    endif; ?>
                    <?php
                    if ($image_url) : ?>
                        <img src="<?php echo $image_url; ?>" id="image" style="height: 200px;width: 200px;" />
                    <?php
                    endif; ?>

                </div><br>
<!-- address  -->

                <div class="address">

                    <form  class="img1" method="post" enctype="multipart/form-data">
                        <label>Enter Address</label>
                        <input type="text" name="address"><br>
                        <input type="submit" name="addAddress">
                    </form>


                    <?php
                    if ($addressOutput) : ?>
                        <p><?php echo $addressOutput; ?> </p>
                    <?php
                    endif; ?>

                </div>
<!-- address  -->

            </div>


        <?php endif ?>

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
        <?php endif ?>
    </div>

</body>

</html>