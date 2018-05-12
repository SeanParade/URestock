<?php
session_start();

# File Handler
$uploadOk = 1;
$uploadMsg = "Everything went as planned!";
$fileType = pathinfo($_FILES["reportCSV"]["name"], PATHINFO_EXTENSION);

# Check type. CSV only y'all.

if(isset($_POST["submit"])){
    if ($fileType != "csv"){
        $uploadOk=0;
        echo "$fileType ???<br> ";
        echo "THIS ISN'T A CSV, GUY!!<br> CSV FILES ONLY. NO GOOFS, ONLY FILES PLZ<br><br>";
    }
}

# File Size Check. "Now with Bonus Rejection!"
if ($_FILES["reportCSV"]["size"] > 200000)
{
    echo "Files have to be under 2mb";
    $uploadOk = 0;
}

# Still not uploading? Apologize.
# If it's good to upload, loljk process the csv as a string and whip it into an array
if ($uploadOk == 0)
{
    echo "Sorry, your file was not uploaded.";
}

else
{
    require_once("array_logic.php");
}

if ($uploadOk == 1)
{
    header('Location: http://www.seanprice.ca/restockapp');
}











