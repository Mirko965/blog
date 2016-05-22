<?php if(!isset($layout_context)) {
   $layout_context = "public";
   }?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog <?php if($layout_context == "admin"){echo "-Admin";}?></title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header id="header">
      <h1>My Blog <?php if($layout_context == "admin"){echo "-Admin";}?></h1>
      <img src="images/elephpant.png">
      <h2>PHP & MYSQL</h1>
    </header>
