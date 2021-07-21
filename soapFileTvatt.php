<?php 
$servername = "localhost";
$username = "diaj0001";
$password = "Random123";
$dbname = "diaj0001";
//Det som kommer att skrivas ut på sidan kommer enbart ses i XML eller json
//Ingen design i CSS eller HTML inkluderas i detta dokument när det skrivs ut i XML
if(isset($_POST['Postnummer']) && floatval($_POST['Postnummer'])) {

    //Källa av kod: https://davidwalsh.name/web-service-php-mysql-xml-json
    //Vi har använt oss av SOAP

	/* Här är variablerna som deklareras in */
	$format = strtolower('tvattider') == 'json' ? 'json' : 'xml'; //xml is the default
	$postnummer = floatval($_POST['Postnummer']); //no default

/* Anslutning till databasen*/
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	/* Hämtar information från databasen genom Select*/
$query= "SELECT	TvattstugeID,Tvattider,Datum,Postnummer,Anvandare FROM Tvattstuga WHERE Postnummer=$postnummer "; // hämta allt från tabell
$resultTvatttider = mysqli_query($conn,$query)  or die ("connection failed");

	/* Skapar en array med resultat*/
	$tider = array();
	if(mysqli_num_rows($resultTvatttider)) {
		while($tvattTider = mysqli_fetch_assoc($resultTvatttider)) {
			$tider[] = array('tvattider'=>$tvattTider);
		}
	}

	/* Output i speciell format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('Tvattider'=>$tider));
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

    else {//skrivs ut i XML
     
		header('Content-type:text/xml');
		echo '<bokadeTvattider>';
		foreach($tider as $index => $tvattTider) {
			if(is_array($tvattTider)) {
				foreach($tvattTider as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
	echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
	}}
		echo '</',$key,'>';
	}}}
		echo '</bokadeTvattider>';
    }

	/* stänger av kopplingen med databas */
	@mysqli_close($conn);
}
?>