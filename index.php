<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Sean Price, seanevanprice@gmail.com">
    <meta name="description" content="Items to restock at Urbane Cyclist">
    <title>~ Urbane Restock ~</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        input{
            margin: 15px;
        }

    </style>
</head>
<body class="">

<div class="container" style="width:100%; margin:0 auto">
<?php
//if 'r' (reset) = 'y' (yes) -> Destroy session variables
if ($_GET['r']='y'){session_destroy();}
$uploadForm = isset($_SESSION["restockList"])? '<a href="?r=y"><i class="right material-icons">mode_edit</i></a>'  : '
<h3 style="text-align: center" id="uploadHeader ">Upload Yesterday\'s Report</h3>
<div style="width: 30%; margin:0 auto">
<form class="col s6 offset-s6"  action="php/upload.php" method="post" enctype="multipart/form-data">
    <input class="input-field" type="file" name="reportCSV"  accept=".csv" required><br/>
    <button style="margin-left: 20px" class="btn-floating btn-large waves-effect waves-light red" name="submit"><i class="material-icons">add</i></button>
</form>
</div>'
;
echo $uploadForm ?>


</div>

<div class="container">
    <?=$_SESSION["restockList"] ?>

</div>

</body>
</html>