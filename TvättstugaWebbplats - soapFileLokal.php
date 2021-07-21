//Vi höll på med SOAP för att
<?php 
$servername = "localhost";
$username = "diaj0001";
$password = "Random123";
$dbname = "diaj0001";
//Det som kommer att skrivas ut på sidan kommer enbart ses i XML eller json
//Ingen design i CSS eller HTML inkluderas i detta dokument när det skrivs ut i XML
if(isset($_POST['Postnummer']) && floatval($_POST['Postnummer'])) {

	/* Här är variablerna som deklareras in */
	$format = strtolower('tvattider') == 'json' ? 'json' : 'xml'; 
	$postnummer = floatval($_POST['Postnummer']); 

/* Anslutning till databasen*/
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	/* Hämtar information från databasen genom Select*/
$query= "SELECT LokalID,Tider,Datum,Postnummer,Anvandare FROM Lokal WHERE Postnummer=$postnummer "; // hämta allt från tabell
$resultLokal = mysqli_query($conn,$query)  or die ("connection failed");

	/* Skapar en array med resultat*/
	$tider = array();
	if(mysqli_num_rows($resultLokal)) {
		while($lokalTider = mysqli_fetch_assoc($resultLokal)) {
			$tider[] = array('lokal'=>$lokalTider);
		}
	}

	/* Output i speciell format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('Tider'=>$tider));
    }
    else if($tider==NULL) // om det inte finns några tider 
{
    echo "<html>";
     include "adminOmraden.html";

echo "<p>Det finns inga tider hos detta område </p>";
echo' <div class="footer2">
<footer class="footer1" style="text-align: center;">
    <p>TVÄTTBJÖRNAR</p>
    <p>KONTAKT: MAILADRESS@MAIL.SE </p>
    <p>TELEFON: 031-4151414</p>
    <a href="adminInlogg.php" >Admin inlogg:<br><img src="adminBild.png"></a>
</footer>
</div>

</body>
</html>';
}
    else {//Skrivs ut i XML

		header('Content-type:text/xml');
		echo '<bokadeLokaltider>';
		foreach($tider as $index => $lokalTider) {
			if(is_array($lokalTider)) {
				foreach($lokalTider as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
	echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
	}}
		echo '</',$key,'>';
	}}}
		echo '</bokadeLokaltider>';
    }

	/* stänger av kopplingen med databas */
	@mysqli_close($conn);
}
?>
