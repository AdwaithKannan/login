<?php
// upload and preview image
$error = ''; // add $error to hold error text
$image_url = ''; // add $image_url to hold image url
if (isset($_POST['submit'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $maxFileSize = 500000;
    $fileExt = explode(".", $fileName);
    $currFileExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($currFileExt, $allowed)) {
        if ($fileSize < $maxFileSize) {
            if ($fileError == 0) {
                $uniqueFileName = uniqid('', true) . "." . $currFileExt;



                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $uniqueFileName);
                //this part updated
                $image_url = 'uploads/' . $uniqueFileName;

                $db = mysqli_connect('localhost', 'root', '', 'registration');
                $userName = $_SESSION['username'];


                $query = " UPDATE `users` SET `image` = '$uniqueFileName' WHERE `username`='$userName'";
                mysqli_query($db, $query);
            } else {
                // this part updated
                $error = 'There is an error in uploading file';
            }
        } else {
            // this part updated
            $error = "fileSize should be atmost 500kb";
        }
    } else {
        // this part updated
        $error = "This type of file is not allowed";
    }
}



// get image 
$db = mysqli_connect('localhost', 'root', '', 'registration');
$userName = $_SESSION['username'];
$query ="SELECT image FROM `users` WHERE `username` = '$userName' ";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $image_url= 'uploads/' . $row["image"];
    }
  } else {
    echo "0 results";
  }





// upload and preview image ends
// address area 
$addressOutput='';
if (isset($_POST['addAddress'])) {

    $address= $_POST['address'];

    $db = mysqli_connect('localhost', 'root', '', 'registration');
    $userName = $_SESSION['username'];
    $query = " UPDATE `users` SET `image` = '$address' WHERE `username`='$userName'";
    mysqli_query($db, $query);


  
    $query ="SELECT image FROM `users` WHERE `username` = '$userName' ";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          $addressOutput= "Address: " . $row["image"]. "<br>";
        }
      } else {
        echo "0 results";
      }



    mysqli_close($db);
}

  



  ?>