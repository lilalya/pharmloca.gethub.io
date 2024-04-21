<?php

include 'config.php';
session_start();


$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
  header('location:login.php');




}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./admin_style.css">


</head>
<body>
    <?php include 'admin_header.php';?>
    <section class="dashboard">
        <h1 class="heading">dashboard</h1>
        <div class="box-countainer"></div>
       
    <div class="box">
       <?php
       $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed ');
       $number_of_products = mysqli_num_rows($select_products);
       ?>
       <h3><?php echo $number_of_products; ?></h3>
       <p>products added</p>
       </div>
       <div class="box">
       <?php
       $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed ');
       $number_of_users = mysqli_num_rows($select_users);
       ?>
       <h3><?php echo $number_of_users; ?></h3>
       <p> users</p>
       </div>
       <div class="box">
       <?php
       $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed ');
       $number_of_admins = mysqli_num_rows($select_admins);
       ?>
       <h3><?php echo $number_of_admins; ?></h3>
       <p> admins</p>
       </div>
       <div class="box">
       <?php
       $select_messages = mysqli_query($conn, "SELECT * FROM `messages` ") or die('query failed ');
       $number_of_messages = mysqli_num_rows($select_messages);
       ?>
       <h3><?php echo $number_of_messages; ?></h3>
       <p> new messages</p>
       </div>
   
    </section>
</body>
</html>