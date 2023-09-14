<?php
session_start();
include_once 'assets/php/databaseconnect.php';
header('Content-Type: text/html; charset=utf-8');

$cred = $_GET['cred'];
echo $cred;




   




?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        <?php include_once 'assets/css/style.css' ?>
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" >
    <style>
        <?php include_once 'assets/css/style.css' ?>
    </style>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<body>
    
<form action="" method="post">
<div class="estrelas">
                                            <input type="radio" id="vazio" name="rating" value="" checked>
                                            
                                            <label for="star1"><i class="fa"></i></label>
                                            <input type="radio" id="star1" name="rating" value="1" >

                                            <label for="star2"><i class="fa"></i></label>
                                            <input type="radio" id="star2" name="rating" value="2" >

                                            <label for="star3"><i class="fa"></i></label>
                                            <input type="radio" id="star3" name="rating" value="3">

                                            <label for="star4"><i class="fa"></i></label>
                                            <input type="radio" id="star4" name="rating" value="4">

                                           <label for="star5"><i class="fa"></i></label>
                                           <input type="radio" id="star5" name="rating" value="5">
                                            <!-- Add more stars here if needed -->
                                        </div>
    
</form>
</body>
</html>