//I denna kod har man använt sig av en sök funktion för admin för att se bokade tvätttider, 
<?php include "adminOmraden.html";?>
<?php

session_start(); // start session
define('CSS_PATH', 'template/css/'); //define CSS path 
define('JS_PATH', 'template/js/'); //define JavaScript path
// Undviker javascript XSS attacker
ini_set('session.cookie_httponly', 1);
// Session ID kan inte skickas genom URLs
ini_set('session.use_only_cookies', 1);
//Använda säker connection
ini_set('session.cookie_secure', 1);

if (session_id() == '' || !isset($_SESSION["AdminNamn"])) 
{
    header('Location:Notauthorized.html'); // om ej inloggad kmr denna sidan visas
}?>
<html>
<br><h3>Sök tvätttider utifrån område</h3>

<form action="soapFileTvatt.php" method="POST">
<input type="number" placeholder="Mata in postnummer här" value="Postnummer" name="Postnummer"><br>
<input type="submit" value="Uppdatera" name="skicka">    
</form>
<div class="footer2">
        <footer class="footer1" style="text-align: center;">
            <p>TVÄTTBJÖRNAR</p>
            <p>KONTAKT: MAILADRESS@MAIL.SE </p>
            <p>TELEFON: 031-4151414</p>
            <a href="adminInlogg.php" >Admin inlogg:<br><img src="adminBild.png"></a>
        </footer>
        </div>

</body>
</html>
