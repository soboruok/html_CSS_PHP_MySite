<?php

/* ------------Cookies---------- */
/*
WE can set specific data to be stored in the broser and then, 
retrieve it when the user visits the site again. 
*/

//Set Cookie
//Save cookie for 30 days
//setcookie('name', 'Brad', time() + 86400 * 30);
setcookie('name', 'Brad', time() + 86400 );
if(isset($_COOKIE['name'])){
  echo $_COOKIE['name']; 
}
//unSet Cookie
setcookie('name', '' , time()-86400);

/* ------------Session---------- */
/* Sessions can store information to be used in multiple pages. 
unlike cookies, It is stored on the server
*/



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/common.css" />
    <title>MySite</title>
  </head>
  <body>
    <div class="navbar">
      <div class="container flex">
        <h1 class="logo"><img src="images/logo.png" alt="" /></h1>
        <nav>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="work.html">Work</a></li>
          </ul>
        </nav>
      </div>
    </div>