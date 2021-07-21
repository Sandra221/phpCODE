<!--
<?php
session_start(); // Starta session
define('CSS_PATH', 'template/css/'); //define CSS path 
define('JS_PATH', 'template/js/'); //define JavaScript path
// Undviker javascript XSS attacker
ini_set('session.cookie_httponly', 1);
// Session ID kan inte skickas genom URLs
ini_set('session.use_only_cookies', 1);
//Använda säker connection
ini_set('session.cookie_secure', 1);

if (session_id() == '' || !isset($_SESSION["Namn"])) 
{
    header('Location:Notauthorized.html'); //Om inte användaren är inloggad kommer man till denna sidan
}
?>
php session koden sätts in här 

-->

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="StartsidaCSS.css"> <!-- samma CSS som startsidan -->
        <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Raleway" rel="stylesheet">
        <title>Startsida login</title>

        <style>
        .loginknapp /* stil för login-knappen */
        {
        background-color: #4CAF50;
        }
        </style>
    </head>
    <body>

    <ul style="margin-left: 150px; margin-right: 150px; margin-top: 0px;">
     <li><a class="active" href="#home"><img src="tvatt.png" height="25px;"></a></li>
     <li style="float: right; position: arelative;"><a class="logutknapp" href="LogOutPHP.php">LOGGA UT</a></li> <!-- LogOutPHP.php har session destroy -->
     <li style="float: right; position: arelative;"><a class="loginknapp">INLOGGAD</a></li>
     <li style="float: right; position: arelative;"><a href="MinaSidor1.php">MINA SIDOR</a></li>
    </ul>

    <div style="background-color: #eeeeee; margin-left: 150px; margin-right: 150px;">

    <!-- knapparna som kan ta användaren vidare till 4 olika sidor -->
        <br><br><br>
            <form action="BokaTvattid.php">
            <button href="BokaTvattid.php" class="button" style="vertical-align:middle; margin-top: 5px;"><span>BOKA TVÄTTID </span></button><br><br>
            </form>
            <form action="BokaBiltvatt.php">
            <button href="BokaBiltvatt.php" class="button" style="vertical-align:middle; margin-top: 5px;"><span>BOKA BILTVÄTT </span></button><br><br>
            </form>
            <form action="bokaLokal.php">
            <button href="bokaLokal.php" class="button" style="vertical-align:middle; margin-top: 5px;"><span>BOKA LOKAL </span></button><br><br>
            </form>
            <form action="Felanmalan.php">
            <button href="Felanmalan.php" class="button" style="vertical-align:middle; margin-top: 5px;"><span>FELANMÄLAN </span></button><br><br>
            </form>
    
    <!-- footer med information -->
    <div class="footer2">
    <footer class="footer1">
            <p>TVÄTTBJÖRNAR</p>
            <p>KONTAKT: MAILADRESS@MAIL.SE</p>
            <p>TELEFON: 031-4151414</p>
    </footer>
    </div>
    </body>
</html>