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
}

$servername = "localhost";
$username = "diaj0001";
$password = "Random123";
$dbname = "diaj0001";
// Skapar connection med databas
$conn = new mysqli($servername, $username, $password, $dbname);

echo "<br><h3>OMRÅDEN</h3>";

$sql1 = "SELECT * FROM Omraden"; // hämta allt från tabell
$resultat = mysqli_query($conn, $sql1)
    or die ("connection failed");

// här under skrivs tabellen ut
echo "<table align=center>";
echo "<th>Områden</th><th>Postnummer</th>";
while ($row = mysqli_fetch_array($resultat)){
    echo "<tr><td>". $row['Omrade']. "</td><td>". $row['Postnummer']."</td></tr>"; // skriver ut från databas
}
echo "</table>";


if( isset($_POST['Omrade'])) // gör så att databasen inte får tomma värden lagrade om hemsidan uppdateras 
{

$Omr =mysqli_real_escape_string($conn, $_POST['Omrade']);//Hämtar upp 
$Pst =mysqli_real_escape_string($conn, $_POST['Postnummer']);// Skapar connection med databas
/*$conn = new mysqli($servername, $username, $password, $dbname);*/

// Kollar connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Omraden (Omrade, Postnummer) VALUES ('$Omr', '$Pst')"; // min sql fråga för att uppdatera databas

if ($conn->query($sql) === TRUE) { // om allt gick bra
    header ('Location: AdminOmradenPHP.php'); 
} 

else {
    echo "Error: " . $sql . "<br>" . $conn->error; // felmeddelande
}

$conn->close();
}

?>
        <!-- HTML fortsätter här -->
    <p>Vill du se bokade tider utifrån områden? </p>
    <br><a href="OmradenSeBokadeTider.php">Biltvätt</a>
    <a href="OmradenSeBokadeLokalTider.php">Lokaltvätt</a>
    <a href="OmradenSeBokadeTvattTider.php">Tvättider</a>

        <br><h3>LÄGG TILL OMRÅDEN</h3>

        <form action="AdminOmradenPHP.php" method="POST">
        <input type="text" value="Område" onfocus="if (this.value=='Område') this.value='';" name="Omrade"><br>
        <input type="text" value="Postnummer" onfocus="if (this.value=='Postnummer') this.value='';" name="Postnummer"><br>
        <input type="submit" value="Uppdatera" name="skicka">    
        </form>

        <br><h3>TA BORT OMRÅDEN</h3>

        <form action="AdminTabortOmraden.php" method="POST">
        <input type="text" value="Område" onfocus="if (this.value=='Område') this.value='';" name="OmradeBort"><br>
        <input type="text" value="Postnummer" onfocus="if (this.value=='Postnummer') this.value='';" name="PstBort"><br>
        <input type="submit" value="Ta bort" name="Skicka">
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