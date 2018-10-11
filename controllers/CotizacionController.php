<?php 
session_start();

date_default_timezone_set('America/Monterrey');
$dominio = '/cotizador/';

require_once '../modelos/Cotizacion.php';

$cotizacion = new Cotizador();

$data = Array();
switch ($_GET['op']) {
	case 'validEmail':
		$email = $_POST['email'];
		$rspta = $cotizacion->validEmail($email);
		$filas = $rspta->rowCount();
		if ($filas>0) {
			$response=['success'=>false,'msg'=>'No puedes introducir correo empresarial'];
		}else{
			$response=['success'=>true];
		}
		echo json_encode($response);
	break;

	case 'suggestions':
		$q = $_POST['q'];
		$tipo = $_POST['tipo'];
		$rspta = $cotizacion->suggestions($q,$tipo);
		$grupos =[];
		if ($rspta) {
			$i=0;
			while($results = $rspta->fetch(PDO::FETCH_OBJ)){
				$grupos[$i]['empresa'] = $results->empresa;
				$grupos[$i]['coordinador']= $results->coordinador;
				$grupos[$i]['tipo']= $results->tipo;
				$i++;
			}
			echo json_encode(['success'=>true,'grupos'=>$grupos]);
		}else{
			$response = [
				'success'=>false,
				'msg'=>'No hay resultados de: '.$q
			];
			echo json_encode($response);
		}
	break;
	case 'search-data':
		$q = $_POST['q'];
		$tipo = $_POST['tipo'];
		$rspta = $cotizacion->buscar($q,$tipo);
		if ($rspta) {
			$fg = $rspta->fetch(PDO::FETCH_OBJ);

			$grupo = [
				'empresa'=>$fg->empresa,
				'coordinador'=>$fg->coordinador,
				'estado'=>$fg->estado,
				'municipio'=>$fg->municipio,
				'telefono'=>$fg->telefono,
				'email'=>$fg->correo,
				'clave'=>$fg->clave
			];
			echo json_encode(['success'=>true,'grupo'=>$grupo]);
		}else{
			$response = [
				'success'=>false,
				'msg'=>'No se encontraron grupos por la buqueda: '.$q
			];
			echo json_encode($response);
		}
	break;

	case 'procedencia':
			if(isset($_POST["estados"])){
			    // Capture selected country
			    $country = $_POST["estados"];
			     
			    // Define country and city array     
			    $countryArr = array( 
			        "Mexico" => array("Selecciona tu estado","Aguascalientes","Baja California","Baja California Sur","Campeche","Chiapas","Chihuahua","Coahuila","Colima","Distrito Federal","Durango","MÃ©xico","Guanajuato","Guerrero","Hidalgo","Jalisco","MichoacÃ¡n","Morelos","Nayarit","Nuevo LeÃ³n","Oaxaca","Puebla",
			        "QuerÃ©taro","Quintana Roo","San Luis PotosÃ­","Sinaloa","Sonora","Tabasco","Tamaulipas","Tlaxcala","Veracruz","YucatÃ¡n","Zacatecas")                 );
			     
			    
			    foreach($countryArr[$country] as $value){
			        echo "<option value='".utf8_decode($value)."'>". utf8_decode($value) . "</option>";
			    }
			}

			if(isset($_POST["estado"])){
			    // Capture selected country
			    $estado = $_POST["estado"];
			     
			    // Define country and city array
			    $municipiosARR = array(
			                    "Aguascalientes" => array("Selecciona tu municipio","Aguascalientes","Asientos","Calvillo","CosÃ­o",
			                        "JesÃºs MarÃ­a","PabellÃ³n De Arteaga","RincÃ³n De Romos","San JosÃ© De Gracia","TepezalÃ¡","El Llano",
			                        "San Francisco De Los Romo"),
			                    "Baja California" => array("Selecciona tu municipio","Ensenada","Mexicali","Tecate","Tijuana","Playas De Rosarito"),
			                    "Baja California Sur" => array("Selecciona tu municipio","ComondÃº","MulegÃ©","La Paz","Los Cabos","Loreto"),
			                    "Campeche" => array("Selecciona tu municipio","CalkinÃ­","Campeche","Carmen","ChampotÃ³n","HecelchakÃ¡n","HopelchÃ©n","Palizada","Tenabo","EscÃ¡rcega","Calakmul","Candelaria"),
			                    "Chiapas" => array("Selecciona tu municipio","Acacoyagua",
			                    "Osumacinta",
			                    "Acala",
			                    "Oxchuc",
			                    "Acapetahua",
			                    "Palenque",
			                    "Altamirano",
			                    "PantelhÃ³",
			                    "AmatÃ¡n",
			                    "Pantepec",
			                    "Amatenango De La Frontera",
			                    "Pichucalco",
			                    "Amatenango Del Valle",
			                    "Pijijiapan",
			                    "Ãngel Albino Corzo",
			                    "El Porvenir",
			                    "Arriaga",
			                    "Villa ComaltitlÃ¡n",
			                    "Bejucal De Ocampo",
			                    "Pueblo Nuevo SolistahuacÃ¡n",
			                    "Bella Vista",
			                    "RayÃ³n",
			                    "BerriozÃ¡bal",
			                    "Reforma",
			                    "Bochil",
			                    "Las Rosas",
			                    "El Bosque",
			                    "Sabanilla",
			                    "CacahoatÃ¡n",
			                    "Salto De Agua",
			                    "CatazajÃ¡",
			                    "San CristÃ³bal De Las Casas",
			                    "Cintalapa",
			                    "San Fernando",
			                    "Coapilla",
			                    "Siltepec",
			                    "ComitÃ¡n De DomÃ­nguez",
			                    "Simojovel",
			                    "La Concordia",
			                    "SitalÃ¡",
			                    "CopainalÃ¡",
			                    "Socoltenango",
			                    "ChalchihuitÃ¡n",
			                    "Solosuchiapa",
			                    "Chamula",
			                    "SoyalÃ³",
			                    "Chanal",
			                    "Suchiapa",
			                    "Chapultenango",
			                    "Ciudad Hidalgo",
			                    "ChenalhÃ³",
			                    "Sunuapa",
			                    "Chiapa De Corzo",
			                    "Tapachula",
			                    "Chiapilla",
			                    "Tapalapa",
			                    "ChicoasÃ©n",
			                    "Tapilula",
			                    "Chicomuselo",
			                    "TecpatÃ¡n",
			                    "ChilÃ³n",
			                    "Tenejapa",
			                    "Escuintla",
			                    "Teopisca",
			                    "Francisco LeÃ³n",
			                    "Frontera Comalapa",
			                    "Tila",
			                    "Frontera Hidalgo",
			                    "TonalÃ¡",
			                    "La Grandeza",
			                    "Totolapa",
			                    "HuehuetÃ¡n",
			                    "La Trinitaria",
			                    "HuixtÃ¡n",
			                    "TumbalÃ¡",
			                    "HuitiupÃ¡n",
			                    "Tuxtla GutiÃ©rrez",
			                    "Huixtla",
			                    "Tuxtla Chico",
			                    "La Independencia",
			                    "TuzantÃ¡n",
			                    "IxhuatÃ¡n",
			                    "Tzimol",
			                    "IxtacomitÃ¡n",
			                    "UniÃ³n JuÃ¡rez",
			                    "Ixtapa",
			                    "Venustiano Carranza",
			                    "Ixtapangajoya",
			                    "Ciudad De Villa Corzo",
			                    "Jiquipilas",
			                    "Villaflores",
			                    "Jitotol",
			                    "YajalÃ³n",
			                    "JuÃ¡rez",
			                    "San Lucas",
			                    "LarrÃ¡inzar",
			                    "ZinacantÃ¡n",
			                    "La Libertad",
			                    "San Juan Cancuc",
			                    "Mapastepec",
			                    "Aldama",
			                    "Las Margaritas",
			                    "BenemÃ©rito De Las AmÃ©ricas",
			                    "Mazapa De Madero",
			                    "Maravilla Tenejapa",
			                    "MazatÃ¡n",
			                    "MarquÃ©s De Comillas",
			                    "Metapa",
			                    "Montecristo De Guerrero",
			                    "Mitontic",
			                    "San AndrÃ©s Duraznal",
			                    "Motozintla",
			                    "Santiago el Pinar",
			                    "NicolÃ¡s RuÃ­z",
			                    "Belisario DomÃ­nguez",
			                    "Ocosingo",
			                    "Emiliano Zapata",
			                    "Ocotepec",
			                    "El Parral",
			                    "Ocozocoautla De Espinosa",
			                    "Mezcalapa",
			                    "OstuacÃ¡n"),
			                    "Chihuahua" => array("Selecciona tu municipio",
			                        "Ahumada",
			                        "Aldama",
			                        "Allende",
			                        "Aquiles SerdÃ¡n",
			                        "AscensiÃ³n",
			                        "BachÃ­niva",
			                        "Balleza",
			                        "Batopilas",
			                        "Bocoyna",
			                        "Buenaventura",
			                        "Camargo",
			                        "CarichÃ­",
			                        "Casas Grandes",
			                        "Coronado",
			                        "Coyame Del Sotol",
			                        "La Cruz",
			                        "CuauhtÃ©moc",
			                        "Cusihuiriachi",
			                        "Chihuahua",
			                        "ChÃ­nipas",
			                        "Delicias",
			                        "Dr. Belisario DomÃ­nguez",
			                        "Galeana",
			                        "Santa Isabel",
			                        "GÃ³mez FarÃ­as",
			                        "Gran Morelos",
			                        "Guadalupe",
			                        "Guadalupe y Calvo",
			                        "Guazapares",
			                        "Guerrero",
			                        "Hidalgo Del Parral",
			                        "HuejotitÃ¡n",
			                        "Ignacio Zaragoza",
			                        "Janos",
			                        "JimÃ©nez",
			                        "JuÃ¡rez",
			                        "Julimes",
			                        "Octaviano LÃ³pez",
			                        "Madera",
			                        "Maguarichi",
			                        "Manuel Benavides",
			                        "MatachÃ­",
			                        "Matamoros",
			                        "Meoqui",
			                        "Morelos",
			                        "Moris",
			                        "Namiquipa",
			                        "Nonoava",
			                        "Nuevo Casas Grandes",
			                        "Ocampo",
			                        "Ojinaga",
			                        "PrÃ¡xedis G. Guerrero",
			                        "San AndrÃ©s",
			                        "Rosales",
			                        "Rosario",
			                        "San Francisco De Borja",
			                        "San Francisco De Conchos",
			                        "San Francisco Del Oro",
			                        "Santa BÃ¡rbara",
			                        "SatevÃ³",
			                        "Saucillo",
			                        "TemÃ³sachi",
			                        "El Tule",
			                        "Urique",
			                        "Uruachi",
			                        "Valle De Zaragoza"),
			                    "Coahuila" => array("Selecciona tu municipio",
			                        "Abasolo",
			                        "AcuÃ±a",
			                        "Allende",
			                        "Arteaga",
			                        "Candela",
			                        "CastaÃ±os",
			                        "CuatrociÃ©negas",
			                        "Escobedo",
			                        "Francisco I. Madero",
			                        "Frontera",
			                        "General Cepeda",
			                        "Guerrero",
			                        "Hidalgo",
			                        "JimÃ©nez",
			                        "JuÃ¡rez",
			                        "Lamadrid",
			                        "Matamoros",
			                        "Monclova",
			                        "Morelos",
			                        "MÃºzquiz",
			                        "Nadadores",
			                        "Nava",
			                        "Ocampo",
			                        "Parras",
			                        "Piedras Negras",
			                        "Progreso",
			                        "Ramos Arizpe",
			                        "Sabinas",
			                        "Sacramento",
			                        "Saltillo",
			                        "San Buenaventura",
			                        "San Juan De Sabinas",
			                        "San Pedro",
			                        "Sierra Mojada",
			                        "TorreÃ³n",
			                        "Viesca",
			                        "Villa UniÃ³n",
			                        "Zaragoza",
			                        "Ignacio Zaragoza"
				),
			                    "Colima" => array("Selecciona tu municipio",
			                        "ArmerÃ­a",
			                        "IxtlahuacÃ¡n",
			                        "Colima",
			                        "Manzanillo",
			                        "Comala",
			                        "MinatitlÃ¡n",
			                        "CoquimatlÃ¡n",
			                        "TecomÃ¡n",
			                        "CuauhtÃ©moc",
			                        "Villa De Ãlvarez"),
			                    "Durango" => array("Selecciona tu municipio",
			                        "CanatlÃ¡n",
			                        "PeÃ±Ã³n Blanco",
			                        "Canelas",
			                        "Ciudad Villa UniÃ³n",
			                        "Coneto De Comonfort",
			                        "El Salto",
			                        "CuencamÃ©",
			                        "Rodeo",
			                        "Durango",
			                        "San Bernardo",
			                        "General SimÃ³n BolÃ­var",
			                        "San Dimas",
			                        "GÃ³mez Palacio",
			                        "San Juan De Guadalupe",
			                        "Guadalupe Victoria",
			                        "San Juan Del RÃ­o",
			                        "GuanacevÃ­",
			                        "San Luis Del Cordero",
			                        "Hidalgo",
			                        "San Pedro Del Gallo",
			                        "IndÃ©",
			                        "Santa Clara",
			                        "Lerdo",
			                        "Santiago Papasquiaro",
			                        "MapimÃ­",
			                        "SÃºchil",
			                        "Mezquital",
			                        "Tamazula",
			                        "Nazas",
			                        "Santa Catarina De Tepehuanes",
			                        "Nombre De Dios",
			                        "Tlahualilo",
			                        "Ocampo",
			                        "Topia",
			                        "El Oro",
			                        "Santa MarÃ­a De OtÃ¡ez",
			                        "Nuevo Ideal",
			                        "PÃ¡nuco De Coronado"),
			                    "Distrito Federal" => array("Selecciona tu municipio",
			                        "Ãlvaro ObregÃ³n",
			                        "Azcapotzalco",
			                        "Benito JuÃ¡rez",
			                        "CoyoacÃ¡n",
			                        "Cuajimalpa De Morelos",
			                        "CuauhtÃ©moc",
			                        "Gustavo A. Madero",
			                        "Iztacalco",
			                        "Iztapalapa",
			                        "La Magdalena Contreras",
			                        "Miguel Hidalgo",
			                        "Milpa Alta",
			                        "TlÃ¡huac",
			                        "Tlalpan",
			                        "Venustiano Carranza",
			                        "Xochimilco"
					),
			                    "Guanajuato" => array("Selecciona tu municipio",
			                        "Abasolo",
			                        "AcÃ¡mbaro",
			                        "San Miguel De Allende",
			                        "Apaseo el Alto",
			                        "Apaseo el Grande",
			                        "Atarjea",
			                        "Celaya",
			                        "Manuel Doblado",
			                        "Comonfort",
			                        "Coroneo",
			                        "Cortazar",
			                        "CuerÃ¡maro",
			                        "CuerÃ¡maro",
			                        "Doctor Mora",
			                        "Dolores Hidalgo Cuna De La Independencia Nacional",
			                        "Guanajuato",
			                        "HuanÃ­maro",
			                        "Irapuato",
			                        "Jaral Del Progreso",
			                        "JerÃ©cuaro",
			                        "LeÃ³n",
			                        "MoroleÃ³n",
			                        "Ocampo",
			                        "PÃ©njamo",
			                        "Pueblo Nuevo",
			                        "PurÃ­sima Del RincÃ³n",
			                        "Romita",
			                        "Salamanca",
			                        "Salvatierra",
			                        "San Diego De La UniÃ³n",
			                        "San Felipe",
			                        "San Francisco Del RincÃ³n",
			                        "San JosÃ© Iturbide",
			                        "San Luis De La Paz",
			                        "Santa Catarina",
			                        "Santa Cruz De Juventino Rosas",
			                        "Santiago MaravatÃ­o",
			                        "Silao De La Victoria",
			                        "Tarandacuao",
			                        "Tarimoro",
			                        "Tierra Blanca",
			                        "Uriangato",
			                        "Valle De Santiago",
			                        "Victoria",
			                        "VillagrÃ¡n",
			                        "XichÃº",
			                        "Yuriria"),
			                    "Guerrero" => array("Selecciona tu municipio",
			                        "Acapulco De JuÃ¡rez",
			                        "Ahuacuotzingo",
			                        "AjuchitlÃ¡n Del Progreso",
			                        "Alcozauca De Guerrero",
			                        "Alpoyeca",
			                        "Ciudad Apaxtla De CastrejÃ³n",
			                        "Arcelia",
			                        "Atenango Del RÃ­o",
			                        "Atlamajalcingo Del Monte",
			                        "Atlixtac",
			                        "Atoyac De Ãlvarez",
			                        "Ayutla De Los Libres",
			                        "AzoyÃº",
			                        "Benito JuÃ¡rez",
			                        "Buenavista De CuÃ©llar",
			                        "Coahuayutla De JosÃ© MarÃ­a Izazaga",
			                        "Cocula",
			                        "Copala",
			                        "Copalillo",
			                        "Copanatoyac",
			                        "Coyuca De BenÃ­tez",
			                        "Coyuca De CatalÃ¡n",
			                        "Cuajinicuilapa",
			                        "CualÃ¡c",
			                        "Cuautepec",
			                        "Cuetzala Del Progreso",
			                        "Cutzamala De PinzÃ³n",
			                        "Chilapa De Ãlvarez",
			                        "Chilpancingo De Los Bravo",
			                        "Florencio Villarreal",
			                        "General Canuto A. Neri",
			                        "General Heliodoro Castillo",
			                        "HuamuxtitlÃ¡n",
			                        "Huitzuco De Los Figueroa",
			                        "Iguala De La Independencia",
			                        "Igualapa",
			                        "Ixcateopan De CuauhtÃ©moc",
			                        "Zihuatanejo De Azueta",
			                        "Juan R. Escudero",
			                        "Leonardo Bravo",
			                        "Malinaltepec",
			                        "MÃ¡rtir De Cuilapan",
			                        "MetlatÃ³noc",
			                        "MochitlÃ¡n",
			                        "OlinalÃ¡",
			                        "Ometepec",
			                        "Pedro Ascencio Alquisiras",
			                        "PetatlÃ¡n",
			                        "Pilcaya",
			                        "Pungarabato",
			                        "Quechultenango",
			                        "San Luis AcatlÃ¡n",
			                        "San Marcos",
			                        "San Miguel Totolapan",
			                        "Taxco De AlarcÃ³n",
			                        "Tecoanapa",
			                        "TÃ©cpan De Galeana",
			                        "Teloloapan",
			                        "Tepecoacuilco De Trujano",
			                        "Tetipac",
			                        "Tixtla De Guerrero",
			                        "Tlacoachistlahuaca",
			                        "Tlacoapa",
			                        "Tlalchapa",
			                        "Tlalixtaquilla De Maldonado",
			                        "Tlapa De Comonfort",
			                        "Tlapehuala",
			                        "La UniÃ³n De Isidoro Montes De Oca",
			                        "XalpatlÃ¡huac",
			                        "XochihuehuetlÃ¡n",
			                        "Xochistlahuaca",
			                        "ZapotitlÃ¡n Tablas",
			                        "ZirÃ¡ndaro De Los ChÃ¡vez",
			                        "Zitlala",
			                        "Eduardo Neri",
			                        "Acatepec",
			                        "Marquelia",
			                        "Cochoapa el Grande",
			                        "JosÃ© JoaquÃ­n De Herrera",
			                        "JuchitÃ¡n",
			                        "Iliatenco"
			                        ),
			                    "Hidalgo" => array("Selecciona tu municipio",
			                        "AcatlÃ¡n",
			                        "AcaxochitlÃ¡n",
			                        "Actopan",
			                        "Agua Blanca De Iturbide",
			                        "Ajacuba",
			                        "Alfajayucan",
			                        "Almoloya",
			                        "Apan",
			                        "El Arenal",
			                        "Atitalaquia",
			                        "Atlapexco",
			                        "Atotonilco el Grande",
			                        "Atotonilco De Tula",
			                        "Calnali",
			                        "Cardonal",
			                        "Cuautepec De Hinojosa",
			                        "Chapantongo",
			                        "ChapulhuacÃ¡n",
			                        "Chilcuautla",
			                        "EloxochitlÃ¡n",
			                        "Emiliano Zapata",
			                        "Epazoyucan",
			                        "Franciso I. Madero",
			                        "Huasca De Ocampo",
			                        "Huautla",
			                        "Huazalingo",
			                        "Huehuetla",
			                        "Huejutla De Reyes",
			                        "Huichapan",
			                        "Ixmiquilpan",
			                        "Jacala De Ledezma",
			                        "JaltocÃ¡n",
			                        "JuÃ¡rez Hidalgo",
			                        "Lolotla",
			                        "Metepec",
			                        "San AgustÃ­n MetzquititlÃ¡n",
			                        "MetztitlÃ¡n",
			                        "Mineral Del Chico",
			                        "Mineral Del Monte",
			                        "La MisiÃ³n",
			                        "Mixquiahuala De JuÃ¡rez",
			                        "Molango De Escamilla",
			                        "NicolÃ¡s Flores",
			                        "Nopala De VillagrÃ¡n",
			                        "OmitlÃ¡n De JuÃ¡rez",
			                        "San Felipe OrizatlÃ¡n",
			                        "Pacula",
			                        "Pachuca De Soto",
			                        "Pisaflores",
			                        "Progreso De ObregÃ³n",
			                        "Mineral De La Reforma",
			                        "San AgustÃ­n Tlaxiaca",
			                        "San Bartolo Tutotepec",
			                        "San Salvador",
			                        "Santiago De Anaya",
			                        "Santiago Tulantepec De Lugo Guerrero",
			                        "Singuilucan",
			                        "Tasquillo",
			                        "Tecozautla",
			                        "Tenango De Doria",
			                        "Tepeapulco",
			                        "TepehuacÃ¡n De Guerrero",
			                        "Tepeji Del RÃ­o De Ocampo",
			                        "TepetitlÃ¡n",
			                        "Tetepango",
			                        "Villa De Tezontepec",
			                        "Tezontepec De Aldama",
			                        "Tianguistengo",
			                        "Tizayuca",
			                        "Tlahuelilpan",
			                        "Tlahuiltepa",
			                        "Tlanalapa",
			                        "Tlanchinol",
			                        "Tlaxcoapan",
			                        "Tolcayuca",
			                        "Tula De Allende",
			                        "Tulancingo De Bravo",
			                        "Xochiatipan",
			                        "XochicoatlÃ¡n",
			                        "Yahualica",
			                        "ZacualtipÃ¡n De Ãngeles",
			                        "ZapotlÃ¡n De JuÃ¡rez",
			                        "Zempoala",
			                        "ZimapÃ¡n",
					),
			                    "Jalisco" => array("Selecciona tu municipio",
			                        "Acatic",
			                        "AcatlÃ¡n De JuÃ¡rez",
			                        "Ahualulco De Mercado",
			                        "Amacueca",
			                        "AmatitÃ¡n",
			                        "Ameca",
			                        "San Juanito De Escobedo",
			                        "Arandas",
			                        "El Arenal",
			                        "Atemajac De Brizuela",
			                        "Atengo",
			                        "Atenguillo",
			                        "Atotonilco el Alto",
			                        "Atoyac",
			                        "AutlÃ¡n De Navarro",
			                        "AyotlÃ¡n",
			                        "Ayutla",
			                        "La Barca",
			                        "BolaÃ±os",
			                        "Cabo Corrientes",
			                        "Casimiro Castillo",
			                        "CihuatlÃ¡n",
			                        "ZapotlÃ¡n el Grande",
			                        "Cocula",
			                        "ColotlÃ¡n",
			                        "ConcepciÃ³n De Buenos Aires",
			                        "CuautitlÃ¡n De GarcÃ­a BarragÃ¡n",
			                        "Cuautla",
			                        "CuquÃ­o",
			                        "Chapala",
			                        "ChimaltitÃ¡n",
			                        "ChiquilistlÃ¡n",
			                        "Degollado",
			                        "Ejutla",
			                        "EncarnaciÃ³n De DÃ­az",
			                        "EtzatlÃ¡n",
			                        "El Grullo",
			                        "Guachinango",
			                        "Guadalajara",
			                        "Hostotipaquillo",
			                        "HuejÃºcar",
			                        "Huejuquilla el Alto",
			                        "La Huerta",
			                        "IxtlahuacÃ¡n De Los Membrillos",
			                        "IxtlahuacÃ¡n Del RÃ­o",
			                        "JalostotitlÃ¡n",
			                        "Jamay",
			                        "JesÃºs MarÃ­a",
			                        "JilotlÃ¡n De Los Dolores",
			                        "Jocotepec",
			                        "JuanacatlÃ¡n",
			                        "JuchitlÃ¡n",
			                        "Lagos De Moreno",
			                        "El LimÃ³n",
			                        "Magdalena",
			                        "Santa MarÃ­a Del Oro",
			                        "La Manzanilla De La Paz",
			                        "Mascota",
			                        "Mazamitla",
			                        "MexticacÃ¡n",
			                        "Mezquitic",
			                        "MixtlÃ¡n",
			                        "OcotlÃ¡n",
			                        "Ojuelos De Jalisco",
			                        "Pihuamo",
			                        "PoncitlÃ¡n",
			                        "Puerto Vallarta",
			                        "Villa PurificaciÃ³n",
			                        "Quitupan",
			                        "El Salto",
			                        "San CristÃ³bal De La Barranca",
			                        "San Diego De AlejandrÃ­a",
			                        "San Juan De Los Lagos",
			                        "San JuliÃ¡n",
			                        "San Marcos",
			                        "San MartÃ­n De BolaÃ±os",
			                        "San MartÃ­n Hidalgo",
			                        "San Miguel el Alto",
			                        "GÃ³mez FarÃ­as",
			                        "San SebastiÃ¡n Del Oeste",
			                        "Santa MarÃ­a De Los Ãngeles",
			                        "Sayula",
			                        "Tala",
			                        "Talpa De Allende",
			                        "Tamazula De Gordiano",
			                        "Tapalpa",
			                        "TecalitlÃ¡n",
			                        "TecolotlÃ¡n",
			                        "Techaluta De Montenegro",
			                        "TenamaxtlÃ¡n",
			                        "Teocaltiche",
			                        "TeocuitatlÃ¡n De Corona",
			                        "TepatitlÃ¡n De Morelos",
			                        "Tequila",
			                        "TeuchitlÃ¡n",
			                        "TizapÃ¡n el Alto",
			                        "Tlajomulco De ZÃºÃ±iga",
			                        "Tlaquepaque",
			                        "TolimÃ¡n",
			                        "TomatlÃ¡n",
			                        "TonalÃ¡",
			                        "Tonaya",
			                        "Tonila",
			                        "Totatiche",
			                        "TototlÃ¡n",
			                        "Tuxcacuesco",
			                        "Tuxcueca",
			                        "Tuxpan",
			                        "UniÃ³n De San Antonio",
			                        "UniÃ³n De Tula",
			                        "Valle De Guadalupe",
			                        "Valle De JuÃ¡rez",
			                        "San Gabriel",
			                        "Villa Corona",
			                        "Villa Guerrero",
			                        "Villa Hidalgo",
			                        "CaÃ±adas De ObregÃ³n",
			                        "Yahualica De GonzÃ¡lez Gallo",
			                        "Zacoalco De Torres",
			                        "Zapopan",
			                        "Zapotiltic",
			                        "ZapotitlÃ¡n De Vadillo",
			                        "ZapotlÃ¡n Del Rey",
			                        "Zapotlanejo",
			                        "San Ignacio Cerro Gordo"
			                        ),
			                    "MÃ©xico" => array("Selecciona tu municipio",
			                        "Acambay De Ruiz CastaÃ±eda",
			                        "Acolman",
			                        "Aculco",
			                        "Almoloya De Alquisiras",
			                        "Almoloya De JuÃ¡rez",
			                        "Almoloya Del RÃ­o",
			                        "Amanalco De Becerra",
			                        "Amatepec",
			                        "Amecameca De JuÃ¡rez",
			                        "Apaxco De Ocampo",
			                        "San Salvador Atenco",
			                        "AtizapÃ¡n",
			                        "AtizapÃ¡n De Zaragoza",
			                        "Atlacomulco De Fabela",
			                        "Atlautla",
			                        "Axapusco",
			                        "Ayapango De Gabriel Ramos MillÃ¡n",
			                        "Calimaya De DÃ­az GonzÃ¡lez",
			                        "Capulhuac",
			                        "Coacalco De BerriozÃ¡bal",
			                        "Coatepec Harinas",
			                        "CocotitlÃ¡n",
			                        "Coyotepec",
			                        "CuautitlÃ¡n",
			                        "Chalco",
			                        "Chapa De Mota",
			                        "Chapultepec",
			                        "Chiautla",
			                        "Chicoloapan",
			                        "Chiconcuac",
			                        "ChimalhuacÃ¡n",
			                        "Donato Guerra",
			                        "Ecatepec De Morelos",
			                        "Ecatzingo De Hidalgo",
			                        "Huehuetoca",
			                        "Hueypoxtla",
			                        "Huixquilucan",
			                        "Isidro Fabela",
			                        "Ixtapaluca",
			                        "Ixtapan De La Sal",
			                        "Ixtapan Del Oro",
			                        "Ixtlahuaca",
			                        "Xalatlaco",
			                        "Jaltenco",
			                        "Jilotepec",
			                        "Jilotzingo",
			                        "Jiquipilco",
			                        "JocotitlÃ¡n",
			                        "Joquicingo",
			                        "Juchitepec",
			                        "Lerma",
			                        "Malinalco",
			                        "Melchor Ocampo",
			                        "Metepec",
			                        "Mexicaltzingo",
			                        "Morelos",
			                        "Naucalpan De JuÃ¡rez",
			                        "NezahualcÃ³yotl",
			                        "Nextlalpan",
			                        "NicolÃ¡s Romero",
			                        "Nopaltepec",
			                        "Ocoyoacac",
			                        "Ocuilan",
			                        "El Oro",
			                        "Otumba",
			                        "Otzoloapan",
			                        "Otzolotepec",
			                        "Ozumba",
			                        "Papalotla",
			                        "La Paz",
			                        "PolotitlÃ¡n",
			                        "RayÃ³n",
			                        "San Antonio La Isla",
			                        "San Felipe Del Progreso",
			                        "San MartÃ­n De Las PirÃ¡mides",
			                        "San Mateo Atenco",
			                        "San SimÃ³n De Guerrero",
			                        "Santo TomÃ¡s",
			                        "Soyaniquilpan De JuÃ¡rez",
			                        "Sultepec",
			                        "TecÃ¡mac",
			                        "Tejupilco",
			                        "Temamatla",
			                        "Temascalapa",
			                        "Temascalcingo",
			                        "Temascaltepec",
			                        "Temoaya",
			                        "Tenancingo",
			                        "Tenango Del Aire",
			                        "Tenango Del Valle",
			                        "Teoloyucan",
			                        "TeotihuacÃ¡n",
			                        "Tepetlaoxtoc",
			                        "Tepetlixpa",
			                        "TepotzotlÃ¡n",
			                        "Tequixquiac",
			                        "TexcaltitlÃ¡n",
			                        "Texcalyacac",
			                        "Texcoco",
			                        "Tezoyuca",
			                        "Tianguistenco",
			                        "Timilpan",
			                        "Tlalmanalco",
			                        "Tlalnepantla De Baz",
			                        "Tlatlaya",
			                        "Toluca",
			                        "Tonatico",
			                        "Tultepec",
			                        "TultitlÃ¡n",
			                        "Valle De Bravo",
			                        "Villa De Allende",
			                        "Villa Del CarbÃ³n",
			                        "Villa Guerrero",
			                        "Villa Victoria",
			                        "XonacatlÃ¡n",
			                        "Zacazonapan",
			                        "Zacualpan",
			                        "Zinacantepec",
			                        "ZumpahuacÃ¡n",
			                        "Zumpango",
			                        "CuautitlÃ¡n Izcalli",
			                        "Valle De Chalco Solidaridad",
			                        "Luvianos",
			                        "San JosÃ© Del RincÃ³n",
			                        "Tonanitla"
			                        ),
			                    "MichoacÃ¡n" => array("Selecciona tu municipio",
			                        "Acuitzio",
			                        "Aguililla",
			                        "Ãlvaro ObregÃ³n",
			                        "Angamacutiro",
			                        "Angangueo",
			                        "ApatzingÃ¡n",
			                        "Aporo",
			                        "Aquila",
			                        "Ario",
			                        "Arteaga",
			                        "BriseÃ±as",
			                        "Buenavista",
			                        "CarÃ¡cuaro",
			                        "Coahuayana",
			                        "CoalcomÃ¡n De VÃ¡zquez Pallares",
			                        "Coeneo",
			                        "Contepec",
			                        "CopÃ¡ndaro",
			                        "Cotija",
			                        "Cuitzeo",
			                        "Charapan",
			                        "Charo",
			                        "Chavinda",
			                        "CherÃ¡n",
			                        "Chilchota",
			                        "Chinicuila",
			                        "ChucÃ¡ndiro",
			                        "Churintzio",
			                        "Churumuco",
			                        "Ecuandureo",
			                        "Epitacio Huerta",
			                        "ErongarÃ­cuaro",
			                        "Gabriel Zamora",
			                        "Hidalgo",
			                        "La Huacana",
			                        "Huandacareo",
			                        "Huaniqueo",
			                        "Huetamo",
			                        "Huiramba",
			                        "Indaparapeo",
			                        "Irimbo",
			                        "IxtlÃ¡n",
			                        "Jacona",
			                        "JimÃ©nez",
			                        "Jiquilpan",
			                        "JuÃ¡rez",
			                        "Jungapeo",
			                        "Lagunillas",
			                        "Madero",
			                        "MaravatÃ­o",
			                        "Marcos Castellanos",
			                        "LÃ¡zaro CÃ¡rdenas",
			                        "Morelia",
			                        "Morelos",
			                        "MÃºgica",
			                        "Nahuatzen",
			                        "NocupÃ©taro",
			                        "Nuevo Parangaricutiro",
			                        "Nuevo Urecho",
			                        "NumarÃ¡n",
			                        "Ocampo",
			                        "PajacuarÃ¡n",
			                        "PanindÃ­cuaro",
			                        "ParÃ¡cuaro",
			                        "Paracho",
			                        "PÃ¡tzcuaro",
			                        "Penjamillo",
			                        "PeribÃ¡n",
			                        "La Piedad",
			                        "PurÃ©pero",
			                        "PuruÃ¡ndiro",
			                        "QuerÃ©ndaro",
			                        "Quiroga",
			                        "CojumatlÃ¡n De RÃ©gules",
			                        "Los Reyes",
			                        "Sahuayo",
			                        "San Lucas",
			                        "Santa Ana Maya",
			                        "Salvador Escalante",
			                        "Senguio",
			                        "Susupuato",
			                        "TacÃ¡mbaro",
			                        "TancÃ­taro",
			                        "Tangamandapio",
			                        "TangancÃ­cuaro",
			                        "Tanhuato",
			                        "Taretan",
			                        "TarÃ­mbaro",
			                        "Tepalcatepec",
			                        "Tingambato",
			                        "TingÃ¼indÃ­n",
			                        "Tiquicheo De NicolÃ¡s Romero",
			                        "Tlalpujahua",
			                        "Tlazazalca",
			                        "Tocumbo",
			                        "TumbiscatÃ­o",
			                        "Turicato",
			                        "Tuxpan",
			                        "Tuzantla",
			                        "Tzintzuntzan",
			                        "Tzitzio",
			                        "Uruapan",
			                        "Venustiano Carranza",
			                        "Villamar",
			                        "Vista Hermosa",
			                        "YurÃ©cuaro",
			                        "Zacapu",
			                        "Zamora",
			                        "ZinÃ¡paro",
			                        "ZinapÃ©cuaro",
			                        "Ziracueretiro",
			                        "ZitÃ¡cuaro",
			                        "JosÃ© Sixto Verduzco",
			                        ),
			                    "Morelos" => array("Selecciona tu municipio",
			                        "Amacuzac",
			                        "Atlatlahucan",
			                        "Axochiapan",
			                        "Ayala",
			                        "CoatlÃ¡n Del RÃ­o (municipio)",
			                        "Cuautla",
			                        "Cuernavaca",
			                        "Emiliano Zapata",
			                        "Huitzilac",
			                        "Jantetelco",
			                        "Jiutepec",
			                        "Jojutla",
			                        "Jonacatepec",
			                        "Mazatepec",
			                        "MiacatlÃ¡n",
			                        "Ocuituco",
			                        "Puente De Ixtla",
			                        "Temixco",
			                        "Tepalcingo",
			                        "TepoztlÃ¡n",
			                        "Tetecala",
			                        "Tetela Del VolcÃ¡n",
			                        "Tlalnepantla",
			                        "TlaltizapÃ¡n",
			                        "Tlaquiltenango",
			                        "Tlayacapan",
			                        "Totolapan",
			                        "Xochitepec",
			                        "Yautepec",
			                        "Yecapixtla",
			                        "Zacatepec",
			                        "Zacualpan",
			                        "Temoac"
			),
			                    "Nayarit" => array("Selecciona tu municipio",
			                        "Acaponeta",
			                        "Ruiz",
			                        "AhuacatlÃ¡n",
			                        "San Blas",
			                        "AmatlÃ¡n De CaÃ±as",
			                        "San Pedro Lagunillas",
			                        "Compostela",
			                        "Santa MarÃ­a Del Oro",
			                        "Huajicori",
			                        "Santiago Ixcuintla",
			                        "IxtlÃ¡n Del RÃ­o",
			                        "Tecuala",
			                        "Jala",
			                        "Tepic",
			                        "Xalisco",
			                        "Tuxpan",
			                        "Del Nayar",
			                        "La Yesca",
			                        "Rosamorada",
			                        "BahÃ­a De Banderas"
						),
			                    "Nuevo LeÃ³n" => array("Selecciona tu municipio",
			                        "Abasolo",
			                        "Agualeguas",
			                        "Los Aldamas",
			                        "Allende",
			                        "AnÃ¡huac",
			                        "Ciudad Apodaca",
			                        "Aramberri",
			                        "Bustamante",
			                        "Cadereyta JimÃ©nez",
			                        "Carmen",
			                        "Cerralvo",
			                        "CiÃ©nega De Flores",
			                        "China",
			                        "Doctor Arroyo",
			                        "Doctor Coss",
			                        "Doctor GonzÃ¡lez",
			                        "Galeana",
			                        "GarcÃ­a",
			                        "San Pedro Garza GarcÃ­a",
			                        "General Bravo",
			                        "General Escobedo",
			                        "General TerÃ¡n",
			                        "General TreviÃ±o",
			                        "General Zaragoza",
			                        "General Zuazua",
			                        "Guadalupe",
			                        "Los Herreras",
			                        "Higueras",
			                        "Hualahuises",
			                        "Iturbide",
			                        "JuÃ¡rez",
			                        "Lampazos De Naranjo",
			                        "Linares",
			                        "MarÃ­n",
			                        "Melchor Ocampo",
			                        "Mier y Noriega",
			                        "Mina",
			                        "Montemorelos",
			                        "Monterrey",
			                        "ParÃ¡s",
			                        "PesquerÃ­a",
			                        "Los Ramones",
			                        "Rayones",
			                        "Sabinas Hidalgo",
			                        "Salinas Victoria",
			                        "San NicolÃ¡s De Los Garza",
			                        "Hidalgo",
			                        "Santa Catarina",
			                        "Santiago",
			                        "Vallecillo",
			                        "Villaldama"
					),
			                    "Oaxaca" => array("Selecciona tu municipio",
			                        "Abejones",
			                        "San Miguel Tlacotepec",
			                        "AcatlÃ¡n De PÃ©rez Figueroa",
			                        "San Miguel Tulancingo",
			                        "AsunciÃ³n Cacalotepec",
			                        "San Miguel Yotao",
			                        "AsunciÃ³n Cuyotepeji",
			                        "San NicolÃ¡s",
			                        "AsunciÃ³n Ixtaltepec",
			                        "San NicolÃ¡s Hidalgo",
			                        "AsunciÃ³n NochixtlÃ¡n",
			                        "San Pablo CoatlÃ¡n",
			                        "AsunciÃ³n OcotlÃ¡n",
			                        "San Pablo Cuatro Venados",
			                        "AsunciÃ³n Tlacolulita",
			                        "San Pablo Etla",
			                        "Ayotzintepec",
			                        "San Pablo Huitzo",
			                        "El Barrio De La Soledad",
			                        "San Pablo Huixtepec",
			                        "CalihualÃ¡",
			                        "San Pablo Macuiltianguis",
			                        "Candelaria Loxicha",
			                        "San Pablo Tijaltepec",
			                        "San Pablo Tijaltepec",
			                        "CiÃ©nega De ZimatlÃ¡n",
			                        "San Pablo Villa De Mitla",
			                        "Ciudad Ixtepec",
			                        "San Pablo Yaganiza",
			                        "Coatecas Altas",
			                        "San Pedro Amuzgos",
			                        "CoicoyÃ¡n De Las Flores",
			                        "San Pedro ApÃ³stol",
			                        "La CompaÃ±Ã­a",
			                        "San Pedro Atoyac",
			                        "ConcepciÃ³n Buenavista",
			                        "San Pedro Cajonos",
			                        "ConcepciÃ³n PÃ¡palo",
			                        "San Pedro Coxcaltepec CÃ¡ntaros",
			                        "Constancia Del Rosario",
			                        "San Pedro Comitancillo",
			                        "Cosolapa",
			                        "San Pedro el Alto",
			                        "Cosoltepec",
			                        "San Pedro Huamelula",
			                        "CuilÃ¡pam De Guerrero",
			                        "San Pedro Huilotepec",
			                        "Cuyamecalco Villa De Zaragoza",
			                        "San Pedro IxcatlÃ¡n",
			                        "Chahuites",
			                        "San Pedro Ixtlahuaca",
			                        "Chalcatongo De Hidalgo",
			                        "San Pedro Jaltepetongo",
			                        "ChiquihuitlÃ¡n De Benito JuÃ¡rez",
			                        "San Pedro JicayÃ¡n",
			                        "Heroica Ciudad De Ejutla De Crespo",
			                        "San Pedro Jocotipac",
			                        "EloxochitlÃ¡n De Flores MagÃ³n",
			                        "San Pedro Juchatengo",
			                        "El Espinal",
			                        "San Pedro MÃ¡rtir",
			                        "Tamazulapam Del EspÃ­ritu Santo",
			                        "San Pedro MÃ¡rtir Quiechapa",
			                        "Fresnillo De Trujano",
			                        "San Pedro MÃ¡rtir Yucuxaco",
			                        "Guadalupe Etla",
			                        "San Pedro Mixtepec - Distrito 22 ",
			                        "Guadalupe De RamÃ­rez",
			                        "San Pedro Mixtepec - Distrito 26",
			                        "Guelatao De JuÃ¡rez",
			                        "San Pedro Molinos",
			                        "Guevea De Humboldt",
			                        "San Pedro Nopala",
			                        "Mesones Hidalgo",
			                        "San Pedro Ocopetatillo",
			                        "Villa Hidalgo",
			                        "San Pedro Ocotepec",
			                        "Heroica Ciudad De Huajuapan De LeÃ³n",
			                        "San Pedro Pochutla",
			                        "Huautepec",
			                        "San Pedro Quiatoni",
			                        "Huautla De JimÃ©nez",
			                        "San Pedro Sochiapam",
			                        "IxtlÃ¡n De JuÃ¡rez",
			                        "San Pedro Tapanatepec",
			                        "Heroica Ciudad De JuchitÃ¡n De Zaragoza",
			                        "San Pedro Taviche",
			                        "Loma Bonita",
			                        "San Pedro Teozacoalco",
			                        "Magdalena Apasco",
			                        "San Pedro Teutila",
			                        "Magdalena Jaltepec",
			                        "San Pedro TidaÃ¡",
			                        "Santa Magdalena JicotlÃ¡n",
			                        "San Pedro Topiltepec",
			                        "Magdalena Mixtepec",
			                        "San Pedro Totolapa",
			                        "Magdalena OcotlÃ¡n",
			                        "Villa De Tututepec De Melchor Ocampo",
			                        "Magdalena PeÃ±asco",
			                        "San Pedro Yaneri",
			                        "Magdalena Teitipac",
			                        "San Pedro YÃ³lox",
			                        "Magdalena TequisistlÃ¡n",
			                        "San Pedro y San Pablo Ayutla",
			                        "Magdalena Tlacotepec",
			                        "Villa De Etla",
			                        "Magdalena ZahuatlÃ¡n",
			                        "San Pedro y San Pablo Teposcolula",
			                        "Mariscala De JuÃ¡rez",
			                        "San Pedro y San Pablo Tequixtepec",
			                        "MÃ¡rtires De Tacubaya",
			                        "San Pedro Yucunama",
			                        "MatÃ­as Romero AvendaÃ±o",
			                        "San Raymundo Jalpan",
			                        "MazatlÃ¡n Villa De Flores",
			                        "San SebastiÃ¡n Abasolo",
			                        "MiahuatlÃ¡n De Porfirio DÃ­az",
			                        "San SebastiÃ¡n CoatlÃ¡n",
			                        "MixistlÃ¡n De La Reforma",
			                        "San SebastiÃ¡n Ixcapa",
			                        "Monjas",
			                        "San SebastiÃ¡n Nicananduta",
			                        "Natividad",
			                        "San SebastiÃ¡n RÃ­o Hondo",
			                        "Nazareno Etla",
			                        "San SebastiÃ¡n Tecomaxtlahuaca",
			                        "Nejapa De Madero",
			                        "San SebastiÃ¡n Teitipac",
			                        "Ixpantepec Nieves",
			                        "San SebastiÃ¡n Tutla",
			                        "Santiago Niltepec",
			                        "San SimÃ³n Almolongas",
			                        "Oaxaca De JuÃ¡rez",
			                        "San SimÃ³n ZahuatlÃ¡n",
			                        "OcotlÃ¡n De Morelos",
			                        "Santa Ana",
			                        "La Pe",
			                        "Santa Ana Ateixtlahuaca",
			                        "Pinotepa De Don Luis",
			                        "Santa Ana CuauhtÃ©moc",
			                        "Pluma Hidalgo",
			                        "Santa Ana Del Valle",
			                        "San JosÃ© Del Progreso",
			                        "Santa Ana Tavela",
			                        "Putla Villa De Guerrero",
			                        "Santa Ana Tlapacoyan",
			                        "Santa Catarina Quioquitani",
			                        "Santa Ana Yareni",
			                        "Reforma De Pineda",
			                        "Santa Ana Zegache",
			                        "La Reforma",
			                        "Santa Catalina Quieri",
			                        "Reyes Etla",
			                        "Santa Catarina Cuixtla",
			                        "Rojas De CuauhtÃ©moc",
			                        "Santa Catarina Ixtepeji",
			                        "Salina Cruz",
			                        "Santa Catarina Juquila",
			                        "San AgustÃ­n Amatengo",
			                        "Santa Catarina Lachatao",
			                        "San AgustÃ­n Atenango",
			                        "Santa Catarina Loxicha",
			                        "San AgustÃ­n Chayuco",
			                        "Santa Catarina MechoacÃ¡n",
			                        "San AgustÃ­n De Las Juntas",
			                        "Santa Catarina Minas",
			                        "San AgustÃ­n Etla",
			                        "Santa Catarina QuianÃ©",
			                        "San AgustÃ­n Loxicha",
			                        "Santa Catarina Tayata",
			                        "San AgustÃ­n Tlacotepec",
			                        "Santa Catarina TicuÃ¡",
			                        "San AgustÃ­n Yatareni",
			                        "Santa Catarina YosonotÃº",
			                        "San AndrÃ©s Cabecera Nueva",
			                        "Santa Catarina Zapoquila",
			                        "San AndrÃ©s Dinicuiti",
			                        "Santa Cruz Acatepec",
			                        "San AndrÃ©s Huaxpaltepec",
			                        "Santa Cruz Amilpas",
			                        "San AndrÃ©s Huayapam",
			                        "Santa Cruz De Bravo",
			                        "San AndrÃ©s Ixtlahuaca",
			                        "Santa Cruz Itundujia",
			                        "San AndrÃ©s Lagunas",
			                        "Santa Cruz Mixtepec",
			                        "San AndrÃ©s NuxiÃ±o",
			                        "Santa Cruz Nundaco",
			                        "San AndrÃ©s PaxtlÃ¡n",
			                        "Santa Cruz Papalutla",
			                        "San AndrÃ©s Sinaxtla",
			                        "Santa Cruz Tacache De Mina",
			                        "San AndrÃ©s Solaga",
			                        "Santa Cruz Tacahua",
			                        "San AndrÃ©s TeotilÃ¡lpam",
			                        "Santa Cruz Tayata",
			                        "San AndrÃ©s Tepetlapa",
			                        "Santa Cruz Xitla",
			                        "San AndrÃ©s YaÃ¡",
			                        "Santa Cruz XoxocotlÃ¡n",
			                        "San AndrÃ©s Zabache",
			                        "Santa Cruz Zenzontepec",
			                        "San AndrÃ©s Zautla",
			                        "Santa Gertrudis",
			                        "San Antonino Castillo Velasco",
			                        "Santa InÃ©s Del Monte",
			                        "San Antonino el Alto",
			                        "Santa InÃ©s Yatzeche",
			                        "San Antonino Monte Verde",
			                        "Santa LucÃ­a Del Camino",
			                        "San Antonio Acutla",
			                        "Santa LucÃ­a MiahuatlÃ¡n",
			                        "San Antonio De La Cal",
			                        "Santa LucÃ­a Monteverde",
			                        "San Antonio Huitepec",
			                        "Santa LucÃ­a OcotlÃ¡n",
			                        "San Antonio Nanahuatipam",
			                        "Santa MarÃ­a Alotepec",
			                        "San Antonio Sinicahua",
			                        "Santa MarÃ­a Apazco",
			                        "San Antonio Tepetlapa",
			                        "Santa MarÃ­a La AsunciÃ³n",
			                        "San Baltazar Chichicapam",
			                        "Heroica Ciudad De Tlaxiaco",
			                        "San Baltazar Loxicha",
			                        "Ayoquezco De Aldama",
			                        "San Baltazar Yatzachi el Bajo",
			                        "Santa MarÃ­a Atzompa",
			                        "San Bartolo Coyotepec",
			                        "Santa MarÃ­a CamotlÃ¡n",
			                        "San BartolomÃ© Ayautla",
			                        "Santa MarÃ­a Colotepec",
			                        "San BartolomÃ© Loxicha",
			                        "Santa MarÃ­a Cortijo",
			                        "San BartolomÃ© Quialana",
			                        "Santa MarÃ­a Coyotepec",
			                        "San BartolomÃ© YucuaÃ±e",
			                        "Santa MarÃ­a Chachoapam",
			                        "San BartolomÃ© Zoogocho",
			                        "Villa De Chilapa De DÃ­az",
			                        "San Bartolo Soyaltepec",
			                        "Santa MarÃ­a Chilchotla",
			                        "San Bartolo Yautepec",
			                        "Santa MarÃ­a Chimalapa",
			                        "San Bernardo Mixtepec",
			                        "Santa MarÃ­a Del Rosario",
			                        "San Blas Atempa",
			                        "Santa MarÃ­a Del Tule",
			                        "San Carlos Yautepec",
			                        "Santa MarÃ­a Ecatepec",
			                        "San CristÃ³bal AmatlÃ¡n",
			                        "Santa MarÃ­a GuelacÃ©",
			                        "San CristÃ³bal Amoltepec",
			                        "Santa MarÃ­a Guienagati",
			                        "San CristÃ³bal Lachirioag",
			                        "Santa MarÃ­a Huatulco",
			                        "San CristÃ³bal Suchixtlahuaca",
			                        "Santa MarÃ­a HuazolotitlÃ¡n",
			                        "San Dionisio Del Mar",
			                        "Santa MarÃ­a Ipalapa",
			                        "San Dionisio Ocotepec",
			                        "Santa MarÃ­a IxcatlÃ¡n",
			                        "San Dionisio OcotlÃ¡n",
			                        "Santa MarÃ­a Jacatepec",
			                        "San Esteban Atatlahuca",
			                        "Santa MarÃ­a Jalapa Del MarquÃ©s",
			                        "San Felipe Jalapa De DÃ­az",
			                        "Santa MarÃ­a Jaltianguis",
			                        "San Felipe Tejalapam",
			                        "Santa MarÃ­a LachixÃ­o",
			                        "San Felipe Usila",
			                        "Santa MarÃ­a Mixtequilla",
			                        "San Francisco CahuacÃºa",
			                        "Santa MarÃ­a Nativitas",
			                        "San Francisco Cajonos",
			                        "Santa MarÃ­a Nduayaco",
			                        "San Francisco Chapulapa",
			                        "Santa MarÃ­a Ozolotepec",
			                        "San Francisco ChindÃºa",
			                        "Santa MarÃ­a PÃ¡palo",
			                        "San Francisco Del Mar",
			                        "Santa MarÃ­a PeÃ±oles",
			                        "San Francisco HuehuetlÃ¡n",
			                        "Santa MarÃ­a Petapa",
			                        "San Francisco IxhuatÃ¡n",
			                        "Santa MarÃ­a Quiegolani",
			                        "San Francisco Jaltepetongo",
			                        "Santa MarÃ­a Sola",
			                        "San Francisco LachigolÃ³",
			                        "Santa MarÃ­a Tataltepec",
			                        "San Francisco Logueche",
			                        "Santa MarÃ­a Tecomavaca",
			                        "San Francisco NuxaÃ±o",
			                        "Santa MarÃ­a Temaxcalapa",
			                        "San Francisco Ozolotepec",
			                        "Santa MarÃ­a Temaxcaltepec",
			                        "San Francisco Sola",
			                        "Santa MarÃ­a Teopoxco",
			                        "San Francisco Telixtlahuaca",
			                        "Santa MarÃ­a Tepantlali",
			                        "San Francisco Teopan",
			                        "Santa MarÃ­a TexcatitlÃ¡n",
			                        "San Francisco Tlapancingo",
			                        "Santa MarÃ­a Tlahuitoltepec",
			                        "San Gabriel Mixtepec",
			                        "Santa MarÃ­a Tlalixtac",
			                        "San Ildefonso AmatlÃ¡n",
			                        "Santa MarÃ­a Tonameca",
			                        "San Ildefonso Sola",
			                        "Santa MarÃ­a Totolapilla",
			                        "San Ildefonso Villa Alta",
			                        "Santa MarÃ­a Xadani",
			                        "San Jacinto Amilpas",
			                        "Santa MarÃ­a Yalina",
			                        "San Jacinto Tlacotepec",
			                        "Santa MarÃ­a YavesÃ­a",
			                        "San JerÃ³nimo CoatlÃ¡n",
			                        "Santa MarÃ­a Yolotepec",
			                        "San JerÃ³nimo Silacayoapilla",
			                        "Santa MarÃ­a YosoyÃºa",
			                        "San JerÃ³nimo Sosola",
			                        "Santa MarÃ­a Yucuhiti",
			                        "San JerÃ³nimo Taviche",
			                        "Santa MarÃ­a Zacatepec",
			                        "San JerÃ³nimo Tecoatl",
			                        "Santa MarÃ­a Zaniza",
			                        "San Jorge Nuchita",
			                        "Santa MarÃ­a ZoquitlÃ¡n",
			                        "San JosÃ© Ayuquila",
			                        "Santiago Amoltepec",
			                        "San JosÃ© Chiltepec",
			                        "Santiago Apoala",
			                        "San JosÃ© Del PeÃ±asco",
			                        "Santiago ApÃ³stol",
			                        "San JosÃ© Estancia Grande",
			                        "Santiago Astata",
			                        "San JosÃ© Independencia",
			                        "Santiago AtitlÃ¡n",
			                        "San JosÃ© LachiguirÃ­",
			                        "Santiago Ayuquililla",
			                        "San JosÃ© Tenango",
			                        "Santiago Cacaloxtepec",
			                        "San Juan Achiutla",
			                        "Santiago CamotlÃ¡n",
			                        "San Juan Atepec",
			                        "Santiago Comaltepec",
			                        "Ãnimas Trujano",
			                        "Santiago Chazumba",
			                        "San Juan Bautista Atatlahuca",
			                        "Santiago Choapam",
			                        "San Juan Bautista Coixtlahuaca",
			                        "Santiago Del RÃ­o",
			                        "San Juan Bautista CuicatlÃ¡n",
			                        "Santiago HuajolotitlÃ¡n",
			                        "San Juan Bautista Guelache",
			                        "Santiago Huauclilla",
			                        "San Juan Bautista JayacatlÃ¡n",
			                        "Santiago IhuitlÃ¡n Plumas",
			                        "San Juan Bautista Lo De Soto",
			                        "Santiago Ixcuintepec",
			                        "San Juan Bautista Suchitepec",
			                        "Santiago Ixtayutla",
			                        "San Juan Bautista Tlacoatzintepec",
			                        "Santiago Jamiltepec",
			                        "San Juan Bautista Tlachichilco",
			                        "Santiago Jocotepec",
			                        "San Juan Bautista Tuxtepec",
			                        "Santiago Juxtlahuaca",
			                        "San Juan Cacahuatepec",
			                        "Santiago Lachiguiri",
			                        "San Juan Cieneguilla",
			                        "Santiago Lalopa",
			                        "San Juan Coatzospam",
			                        "Santiago Laollaga",
			                        "San Juan Colorado",
			                        "Santiago Laxopa",
			                        "San Juan Comaltepec",
			                        "Santiago Llano Grande",
			                        "San Juan CotzocÃ³n",
			                        "Santiago MatatlÃ¡n",
			                        "San Juan ChicomezÃºchil",
			                        "Santiago Miltepec",
			                        "San Juan Chilateca",
			                        "Santiago Minas",
			                        "San Juan Del Estado",
			                        "Santiago Nacaltepec",
			                        "San Juan Del RÃ­o",
			                        "Santiago Nejapilla",
			                        "San Juan Diuxi",
			                        "Santiago Nundiche",
			                        "San Juan Evangelista Analco",
			                        "Santiago NuyoÃ³",
			                        "San Juan GuelavÃ­a",
			                        "Santiago Pinotepa Nacional",
			                        "San Juan Guichicovi",
			                        "Santiago Suchilquitongo",
			                        "San Juan Ihualtepec",
			                        "Santiago Tamazola",
			                        "San Juan Juquila Mixes",
			                        "Santiago Tapextla",
			                        "San Juan Juquila Vijanos",
			                        "Villa TejÃºpam De La UniÃ³n",
			                        "San Juan Lachao",
			                        "Santiago Tenango",
			                        "San Juan Lachigalla",
			                        "Santiago Tepetlapa",
			                        "San Juan Lajarcia",
			                        "Santiago Tetepec",
			                        "San Juan Lalana",
			                        "Santiago Texcalcingo",
			                        "San Juan De Los Cues",
			                        "Santiago TextitlÃ¡n",
			                        "San Juan MazatlÃ¡n",
			                        "Santiago Tilantongo",
			                        "San Juan Mixtepec -Distrito 08",
			                        "Santiago Tillo",
			                        "San Juan Mixtepec -Distrito 26",
			                        "Santiago Tlazoyaltepec",
			                        "San Juan Ã‘umÃ­",
			                        "Santiago Xanica",
			                        "San Juan Ozolotepec",
			                        "Santiago XiacuÃ­",
			                        "San Juan Petlapa",
			                        "Santiago Yaitepec",
			                        "San Juan Quiahije",
			                        "Santiago Yaveo",
			                        "San Juan Quiotepec",
			                        "Santiago YolomÃ©catl",
			                        "San Juan Sayultepec",
			                        "Santiago YosondÃºa",
			                        "San Juan TabaÃ¡",
			                        "Santiago Yucuyachi",
			                        "San Juan Tamazola",
			                        "Santiago Zacatepec",
			                        "San Juan Teita",
			                        "Santiago Zoochila",
			                        "San Juan Teitipac",
			                        "Nuevo Zoquiapam",
			                        "San Juan Tepeuxila",
			                        "Santo Domingo Ingenio",
			                        "San Juan Teposcolula",
			                        "Santo Domingo Albarradas",
			                        "San Juan YaeÃ©",
			                        "Santo Domingo Armenta",
			                        "San Juan Yatzona",
			                        "Santo Domingo ChihuitÃ¡n",
			                        "San Juan Yucuita",
			                        "Santo Domingo De Morelos",
			                        "San Lorenzo",
			                        "Santo Domingo IxcatlÃ¡n",
			                        "San Lorenzo Albarradas",
			                        "Santo Domingo NuxaÃ¡",
			                        "San Lorenzo Cacaotepec",
			                        "Santo Domingo Ozolotepec",
			                        "San Lorenzo Cuaunecuiltitla",
			                        "Santo Domingo Petapa",
			                        "San Lorenzo Texmelucan",
			                        "Santo Domingo Roayaga",
			                        "San Lorenzo Victoria",
			                        "Santo Domingo Tehuantepec",
			                        "San Lucas CamotlÃ¡n",
			                        "Santo Domingo Teojomulco",
			                        "San Lucas OjitlÃ¡n",
			                        "Santo Domingo Tepuxtepec",
			                        "San Lucas QuiavinÃ­",
			                        "Santo Domingo Tlatayapam",
			                        "San Lucas Zoquiapam",
			                        "Santo Domingo Tomaltepec",
			                        "San Luis AmatlÃ¡n",
			                        "Santo Domingo TonalÃ¡",
			                        "San Marcial Ozolotepec",
			                        "Santo Domingo Tonaltepec",
			                        "San Marcos Arteaga",
			                        "Santo Domingo XagacÃ­a",
			                        "San MartÃ­n De Los Cansecos",
			                        "Santo Domingo YanhuitlÃ¡n",
			                        "San MartÃ­n Huamelulpam",
			                        "Santo Domingo Yodohino",
			                        "San MartÃ­n Itunyoso",
			                        "Santo Domingo Zanatepec",
			                        "San MartÃ­n LachilÃ¡",
			                        "Santos Reyes Nopala",
			                        "San MartÃ­n Peras",
			                        "Santos Reyes PÃ¡palo",
			                        "San MartÃ­n Tilcajete",
			                        "Santos Reyes Tepejillo",
			                        "San MartÃ­n Toxpalan",
			                        "Santos Reyes YucunÃ¡",
			                        "San MartÃ­n Zacatepec",
			                        "Santo TomÃ¡s Jalieza",
			                        "San Mateo Cajonos",
			                        "Santo TomÃ¡s Mazaltepec",
			                        "CapulÃ¡lpam De MÃ©ndez",
			                        "Santo TomÃ¡s Ocotepec",
			                        "San Mateo Del Mar",
			                        "Santo TomÃ¡s Tamazulapan",
			                        "San Mateo YoloxochitlÃ¡n",
			                        "San Vicente CoatlÃ¡n",
			                        "San Mateo Etlatongo",
			                        "San Vicente LachixÃ­o",
			                        "San Mateo Nejapam",
			                        "San Vicente NuÃ±Ãº",
			                        "San Mateo PeÃ±asco",
			                        "Silacayoapam",
			                        "San Mateo PiÃ±as",
			                        "Sitio De Xitlapehua",
			                        "San Mateo RÃ­o Hondo",
			                        "Soledad Etla",
			                        "San Mateo Sindihui",
			                        "Villa De Tamazulapam Del Progreso",
			                        "San Mateo Tlapiltepec",
			                        "Tanetze De Zaragoza",
			                        "San Melchor Betaza",
			                        "Taniche",
			                        "San Miguel Achiutla",
			                        "Tataltepec De ValdÃ©s",
			                        "San Miguel AhuehuetitlÃ¡n",
			                        "Teococuilco De Marcos PÃ©rez",
			                        "San Miguel AloÃ¡pam",
			                        "TeotitlÃ¡n De Flores MagÃ³n",
			                        "San Miguel AmatitlÃ¡n",
			                        "TeotitlÃ¡n Del Valle",
			                        "San Miguel AmatlÃ¡n",
			                        "Teotongo",
			                        "San Miguel CoatlÃ¡n",
			                        "Tepelmeme Villa De Morelos",
			                        "San Miguel Chicahua",
			                        "TezoatlÃ¡n De Segura y Luna",
			                        "San Miguel Chimalapa",
			                        "San JerÃ³nimo Tlacochahuaya",
			                        "San Miguel Del Puerto",
			                        "Tlacolula De Matamoros",
			                        "San Miguel Del RÃ­o",
			                        "Tlacotepec Plumas",
			                        "San Miguel Ejutla",
			                        "Tlalixtac De Cabrera",
			                        "San Miguel el Grande",
			                        "Totontepec Villa De Morelos",
			                        "San Miguel Huautla",
			                        "Trinidad Zaachila",
			                        "San Miguel Mixtepec",
			                        "La Trinidad Vista Hermosa",
			                        "San Miguel Panixtlahuaca",
			                        "UniÃ³n Hidalgo",
			                        "San Miguel Peras",
			                        "Valerio Trujano",
			                        "San Miguel Piedras",
			                        "San Juan Bautista Valle Nacional",
			                        "San Miguel Quetzaltepec",
			                        "Villa DÃ­az Ordaz",
			                        "San Miguel Santa Flor",
			                        "Yaxe",
			                        "Villa Sola De Vega",
			                        "Magdalena Yodocono De Porfirio DÃ­az",
			                        "San Miguel Soyaltepec",
			                        "Yogana",
			                        "San Miguel Suchixtepec",
			                        "Yutanduchi De Guerrero",
			                        "Villa Talea De Castro",
			                        "Villa De Zaachila",
			                        "San Miguel TecomatlÃ¡n",
			                        "ZapotitlÃ¡n Del RÃ­o",
			                        "San Miguel Tenango",
			                        "ZapotitlÃ¡n Lagunas",
			                        "San Miguel Tequixtepec",
			                        "ZapotitlÃ¡n Palmas",
			                        "San Miguel Tilquiapam",
			                        "Santa InÃ©s De Zaragoza",
			                        "San Miguel Tlacamama",
			                        "ZimatlÃ¡n De Ãlvarez"),
			                    "Puebla" => array("Selecciona tu municipio",
			                        "Acajete",
			                        "Acateno",
			                        "AcatlÃ¡n De Osorio",
			                        "Acatzingo",
			                        "Acteopan",
			                        "AhuacatlÃ¡n",
			                        "AhuatlÃ¡n",
			                        "Ahuazotepec",
			                        "Ahuehuetitla",
			                        "Ajalpan",
			                        "AcaxtlahuacÃ¡n De Albino Zertuche",
			                        "Aljojuca",
			                        "Altepexi",
			                        "AmixtlÃ¡n",
			                        "Amozoc",
			                        "Aquixtla",
			                        "Atempan",
			                        "Atexcal",
			                        "Atlixco",
			                        "Atoyatempan",
			                        "Atzala",
			                        "AtzitzihuacÃ¡n",
			                        "Atzitzintla",
			                        "Axutla",
			                        "Ayotoxco De Guerrero",
			                        "Calpan",
			                        "Caltepec",
			                        "Camocuautla",
			                        "CaxhuacÃ¡n",
			                        "Coatepec",
			                        "Coatzingo",
			                        "Cohetzala",
			                        "CohuecÃ¡n",
			                        "Coronango",
			                        "CoxcatlÃ¡n",
			                        "Coyomeapan",
			                        "Coyotepec",
			                        "Cuapiaxtla De Madero",
			                        "Cuautempan",
			                        "CuautinchÃ¡n",
			                        "Cuautlancingo",
			                        "Cuayuca De Andrade",
			                        "Cuetzalan Del Progreso",
			                        "Cuyoaco",
			                        "Chalchicomula De Sesma",
			                        "Chapulco",
			                        "Chiautla",
			                        "Chiautzingo",
			                        "Chiconcuautla",
			                        "Chichiquila",
			                        "Chietla",
			                        "ChigmecatitlÃ¡n",
			                        "Chignahuapan",
			                        "Chignautla",
			                        "Chila De Las Flores",
			                        "Chila De La Sal",
			                        "Honey",
			                        "Chilchotla",
			                        "Chinantla",
			                        "Domingo Arenas",
			                        "EloxochitlÃ¡n",
			                        "EpatlÃ¡n",
			                        "Esperanza",
			                        "Francisco Z. Mena",
			                        "General Felipe Ãngeles",
			                        "Guadalupe",
			                        "Guadalupe Victoria",
			                        "Hermenegildo Galeana",
			                        "Huaquechula",
			                        "Huatlatlauca",
			                        "Huauchinango",
			                        "Huehuetla",
			                        "HuehuetlÃ¡n el Chico",
			                        "Huejotzingo",
			                        "Hueyapan",
			                        "Hueytamalco",
			                        "Hueytlalpan",
			                        "Huitzilan De SerdÃ¡n",
			                        "Huitziltepec",
			                        "Atlequizayan",
			                        "Ixcamilpa De Guerrero",
			                        "Ixcaquixtla",
			                        "IxtacamaxtitlÃ¡n",
			                        "Ixtepec",
			                        "IzÃºcar De Matamoros",
			                        "Jalpan",
			                        "Jolalpan",
			                        "Jonotla",
			                        "Jopala",
			                        "Juan C. Bonilla",
			                        "Juan Galindo",
			                        "Juan N. MÃ©ndez",
			                        "Lafragua",
			                        "Libres",
			                        "La Magdalena Tlatlauquitepec",
			                        "Mazapiltepec De JuÃ¡rez",
			                        "Mixtla",
			                        "Molcaxac",
			                        "CaÃ±ada Morelos",
			                        "Naupan",
			                        "Nauzontla",
			                        "Nealtican",
			                        "NicolÃ¡s Bravo",
			                        "Nopalucan",
			                        "Ocotepec",
			                        "Ocoyucan",
			                        "Olintla",
			                        "Oriental",
			                        "PahuatlÃ¡n",
			                        "Palmar De Bravo",
			                        "Pantepec",
			                        "Petlalcingo",
			                        "Piaxtla",
			                        "Puebla",
			                        "Quecholac",
			                        "QuimixtlÃ¡n",
			                        "Rafael Lara Grajales",
			                        "Los Reyes De JuÃ¡rez",
			                        "San AndrÃ©s Cholula",
			                        "San Antonio CaÃ±ada",
			                        "San Diego La Mesa Tochimiltzingo",
			                        "San Felipe Teotlalcingo",
			                        "San Felipe TepatlÃ¡n",
			                        "San Gabriel Chilac",
			                        "San Gregorio Atzompa",
			                        "San JerÃ³nimo Tecuanipan",
			                        "San JerÃ³nimo XayacatlÃ¡n",
			                        "San JosÃ© Chiapa",
			                        "San JosÃ© MiahuatlÃ¡n",
			                        "San Juan Atenco",
			                        "San Juan Atzompa",
			                        "San MartÃ­n Texmelucan",
			                        "San MartÃ­n Totoltepec",
			                        "San MatÃ­as Tlalancaleca",
			                        "San Miguel IxitlÃ¡n",
			                        "San Miguel Xoxtla",
			                        "San NicolÃ¡s Buenos Aires",
			                        "San NicolÃ¡s De Los Ranchos",
			                        "San Pablo Anicano",
			                        "San Pedro Cholula",
			                        "San Pedro Yeloixtlahuaca",
			                        "San Salvador el Seco",
			                        "San Salvador el Verde",
			                        "San Salvador Huixcolotla",
			                        "San SebastiÃ¡n Tlacotepec",
			                        "Santa Catarina Tlaltempan",
			                        "Santa InÃ©s Ahuatempan",
			                        "Santa Isabel Cholula",
			                        "Santiago MiahuatlÃ¡n",
			                        "HuehuetlÃ¡n el Grande",
			                        "Santo TomÃ¡s Hueyotlipan",
			                        "Soltepec",
			                        "Tecali De Herrera",
			                        "Tecamachalco",
			                        "TecomatlÃ¡n",
			                        "TehuacÃ¡n",
			                        "Tehuitzingo",
			                        "Tenampulco",
			                        "TeopantlÃ¡n",
			                        "Teotlalco",
			                        "Tepanco De LÃ³pez",
			                        "Tepango De RodrÃ­guez",
			                        "Tepatlaxco De Hidalgo",
			                        "Tepeaca",
			                        "Tepemaxalco",
			                        "Tepeojuma",
			                        "Tepetzintla",
			                        "Tepexco",
			                        "Tepexi De RodrÃ­guez",
			                        "Tepeyahualco",
			                        "Tepeyahualco De CuauhtÃ©moc",
			                        "Tetela De Ocampo",
			                        "Teteles De Ãvila Castillo",
			                        "TeziutlÃ¡n",
			                        "Tianguismanalco",
			                        "Tilapa",
			                        "Tlachichuca",
			                        "Tlacotepec De Benito JuÃ¡rez",
			                        "Tlacuilotepec",
			                        "Tlahuapan",
			                        "Tlaltenango",
			                        "Tlanepantla",
			                        "Tlaola",
			                        "Tlapacoya",
			                        "TlapanalÃ¡",
			                        "Tlatlauquitepec",
			                        "Tlaxco",
			                        "Tochimilco",
			                        "Tochtepec",
			                        "Totoltepec De Guerrero",
			                        "Tulcingo",
			                        "Tuzamapan De Galeana",
			                        "Tzicatlacoyan",
			                        "Venustiano Carranza",
			                        "Vicente Guerrero",
			                        "XayacatlÃ¡n De Bravo",
			                        "Xicotepec",
			                        "XicotlÃ¡n",
			                        "Xiutetelco",
			                        "Xochiapulco",
			                        "Xochiltepec",
			                        "XochitlÃ¡n De Vicente SuÃ¡rez",
			                        "XochitlÃ¡n Todos Santos",
			                        "YaonÃ¡huac",
			                        "Yehualtepec",
			                        "Zacapala",
			                        "Zacapoaxtla",
			                        "ZacatlÃ¡n",
			                        "ZapotitlÃ¡n",
			                        "ZapotitlÃ¡n De MÃ©ndez",
			                        "Zaragoza",
			                        "Zautla",
			                        "Zihuateutla",
			                        "Zinacatepec",
			                        "Zongozotla",
			                        "Zoquiapan",
			                        "ZoquitlÃ¡n"
			                        ),
			                    "QuerÃ©taro" => array("Selecciona tu municipio",
			                        "Amealco De Bonfil",
			                        "Pinal De Amoles",
			                        "Arroyo Seco",
			                        "Cadereyta De Montes",
			                        "ColÃ³n",
			                        "Corregidora",
			                        "Ezequiel Montes",
			                        "Huimilpan",
			                        "Jalpan De Serra",
			                        "Landa De Matamoros",
			                        "El MarquÃ©s",
			                        "Pedro Escobedo",
			                        "PeÃ±amiller",
			                        "QuerÃ©taro",
			                        "San JoaquÃ­n",
			                        "San Juan Del RÃ­o",
			                        "Tequisquiapan",
			                        "TolimÃ¡n"
			                        ),
			                    "Quintana Roo" => array("Selecciona tu municipio",
			                        "Cozumel",
			                        "JosÃ© MarÃ­a Morelos",
			                        "Felipe Carrillo Puerto",
			                        "LÃ¡zaro CÃ¡rdenas",
			                        "Isla Mujeres",
			                        "Solidaridad",
			                        "OthÃ³n P. Blanco",
			                        "Tulum",
			                        "Benito JuÃ¡rez",
			                        "Bacalar"
			),
			                    "San Luis PotosÃ­" => array("Selecciona tu municipio",
			                        "Ahualulco",
			                        "Alaquines",
			                        "AquismÃ³n",
			                        "Armadillo De Los Infante",
			                        "CÃ¡rdenas",
			                        "Catorce",
			                        "Cedral",
			                        "Cerritos",
			                        "Cerro De San Pedro",
			                        "Ciudad Del MaÃ­z",
			                        "Ciudad FernÃ¡ndez",
			                        "Tancanhuitz",
			                        "Ciudad Valles",
			                        "CoxcatlÃ¡n",
			                        "Charcas",
			                        "Ebano",
			                        "GuadalcÃ¡zar",
			                        "HuehuetlÃ¡n",
			                        "Lagunillas",
			                        "Matehuala",
			                        "Mexquitic De Carmona",
			                        "Moctezuma",
			                        "RayÃ³n",
			                        "Rioverde",
			                        "Salinas",
			                        "San Antonio",
			                        "San Ciro De Acosta",
			                        "San Luis PotosÃ­",
			                        "San MartÃ­n Chalchicuautla",
			                        "San NicolÃ¡s Tolentino",
			                        "Santa Catarina",
			                        "Santa MarÃ­a Del RÃ­o",
			                        "Santo Domingo",
			                        "San Vicente Tancuayalab",
			                        "Soledad De Graciano SÃ¡nchez",
			                        "Tamasopo",
			                        "Tamazunchale",
			                        "TampacÃ¡n",
			                        "TampamolÃ³n Corona",
			                        "TamuÃ­n",
			                        "TanlajÃ¡s",
			                        "TanquiÃ¡n De Escobedo",
			                        "Tierra Nueva",
			                        "Vanegas",
			                        "Venado",
			                        "Villa De Arriaga",
			                        "Villa De Guadalupe",
			                        "Villa De La Paz",
			                        "Villa De Ramos",
			                        "Villa De Reyes",
			                        "Villa Hidalgo",
			                        "Villa JuÃ¡rez",
			                        "Axtla De Terrazas",
			                        "Xilitla",
			                        "Zaragoza",
			                        "Villa De Arista",
			                        "Matlapa",
			                        "El Naranjo"
			),
			                    "Sinaloa" => array("Selecciona tu municipio",
			                        "Ahome",
			                        "El Fuerte",
			                        "Angostura",
			                        "Guasave",
			                        "Badiraguato",
			                        "MazatlÃ¡n",
			                        "Concordia",
			                        "Mocorito",
			                        "CosalÃ¡",
			                        "Rosario",
			                        "CuliacÃ¡n",
			                        "Salvador Alvarado",
			                        "Choix",
			                        "San Ignacio",
			                        "Elota",
			                        "Sinaloa",
			                        "Escuinapa",
			                        "Navolato"
			),
			                    "Sonora" => array("Selecciona tu municipio",
			                        "Aconchi",
			                        "Agua Prieta",
			                        "Ãlamos",
			                        "Altar",
			                        "Arivechi",
			                        "Arizpe",
			                        "Atil",
			                        "BacadÃ©huachi",
			                        "Bacanora",
			                        "Bacerac",
			                        "Bacoachi",
			                        "BÃ¡cum",
			                        "BanÃ¡michi",
			                        "BaviÃ¡cora",
			                        "Bavispe",
			                        "BenjamÃ­n Hill",
			                        "Caborca",
			                        "Cajeme",
			                        "Cananea",
			                        "CarbÃ³",
			                        "La Colorada",
			                        "Cucurpe",
			                        "Cumpas",
			                        "Divisaderos",
			                        "Empalme",
			                        "Etchojoa",
			                        "Fronteras",
			                        "Granados",
			                        "Guaymas",
			                        "Hermosillo",
			                        "Huachinera",
			                        "HuÃ¡sabas",
			                        "Huatabampo",
			                        "HuÃ©pac",
			                        "Imuris",
			                        "Magdalena",
			                        "MazatÃ¡n",
			                        "Moctezuma",
			                        "Naco",
			                        "NÃ¡cori Chico",
			                        "Nacozari De GarcÃ­a",
			                        "Navojoa",
			                        "Nogales",
			                        "Onavas",
			                        "Opodepe",
			                        "Oquitoa",
			                        "Pitiquito",
			                        "Puerto PeÃ±asco",
			                        "Quiriego",
			                        "RayÃ³n",
			                        "Rosario",
			                        "Sahuaripa",
			                        "San Felipe De JesÃºs",
			                        "San Javier",
			                        "San Luis RÃ­o Colorado",
			                        "San Miguel De Horcasitas",
			                        "San Pedro De La Cueva",
			                        "Santa Ana",
			                        "Santa Cruz",
			                        "SÃ¡ric",
			                        "Soyopa",
			                        "Suaqui Grande",
			                        "Tepache",
			                        "Trincheras",
			                        "Tubutama",
			                        "Ures",
			                        "Villa Hidalgo",
			                        "Villa Pesqueira",
			                        "YÃ©cora",
			                        "General Plutarco ElÃ­as Calles",
			                        "Benito JuÃ¡rez",
			                        "San Ignacio RÃ­o Muerto"
			),
			                    "Tabasco" => array("Selecciona tu municipio",
			                        "BalancÃ¡n",
			                        "CÃ¡rdenas",
			                        "Jalpa De MÃ©ndez",
			                        "Jonuta",
			                        "Centla",
			                        "Macuspana",
			                        "Centro",
			                        "Nacajuca",
			                        "Comalcalco",
			                        "ParaÃ­so",
			                        "CunduacÃ¡n",
			                        "Tacotalpa",
			                        "Emiliano Zapata",
			                        "Teapa",
			                        "Huimanguillo",
			                        "Tenosique",
			                        "Jalapa"
			),
			                    "Tamaulipas" => array("Selecciona tu municipio",
			                        "Abasolo",
			                        "Aldama",
			                        "Altamira",
			                        "Antiguo Morelos",
			                        "Burgos",
			                        "Bustamante",
			                        "Camargo",
			                        "Casas",
			                        "Ciudad Madero",
			                        "Cruillas",
			                        "Gomez FarÃ­as",
			                        "GonzÃ¡lez",
			                        "GÃ¼Ã©mez",
			                        "Guerrero",
			                        "Gustavo DÃ­az Ordaz",
			                        "Hidalgo",
			                        "Jaumave",
			                        "JimÃ©nez",
			                        "Llera",
			                        "Mainero",
			                        "El Mante",
			                        "Matamoros",
			                        "MÃ©ndez",
			                        "Mier",
			                        "Miguel AlemÃ¡n",
			                        "Miquihuana",
			                        "Nuevo Laredo",
			                        "Nuevo Morelos",
			                        "Ocampo",
			                        "Padilla",
			                        "Palmillas",
			                        "Reynosa",
			                        "RÃ­o Bravo",
			                        "San Carlos",
			                        "San Fernando",
			                        "San NicolÃ¡s",
			                        "Soto La Marina",
			                        "Tampico",
			                        "Tula",
			                        "Valle Hermoso",
			                        "Victoria",
			                        "VillagrÃ¡n",
			                        "XicotÃ©ncatl"
			),
			                    "Tlaxcala" => array("Selecciona tu municipio",
			                        "Amaxac De Guerrero",
			                        "Tetla De La Solidaridad",
			                        "ApetatitlÃ¡n De Antonio Carvajal",
			                        "Tetlatlahuca",
			                        "Atlangatepec",
			                        "Tlaxcala",
			                        "Altzayanca",
			                        "Tlaxco",
			                        "Apizaco",
			                        "TocatlÃ¡n",
			                        "Calpulalpan",
			                        "Totolac",
			                        "El Carmen Tequexquitla",
			                        "Zitlaltepec De Trinidad SÃ¡nchez Santos",
			                        "Cuapiaxtla",
			                        "Tzompantepec",
			                        "Cuaxomulco",
			                        "Xalostoc",
			                        "Chiautempan",
			                        "Xaltocan",
			                        "MuÃ±oz De Domingo Arenas",
			                        "Papalotla De XicohtÃ©ncatl",
			                        "EspaÃ±ita",
			                        "Xicohtzinco",
			                        "Huamantla",
			                        "Yauhquemecan",
			                        "Hueyotlipan",
			                        "Zacatelco",
			                        "Ixtacuixtla De Mariano Matamoros",
			                        "Benito JuÃ¡rez",
			                        "Ixtenco",
			                        "Emiliano Zapata",
			                        "Mazatecochco De JosÃ© MarÃ­a Morelos",
			                        "LÃ¡zaro CÃ¡rdenas",
			                        "Contla De Juan Cuamatzi",
			                        "La Magdalena Tlaltelulco",
			                        "Tepetitla De LardizÃ¡bal",
			                        "San DamiÃ¡n Texoloc",
			                        "SanctÃ³rum De LÃ¡zaro CÃ¡rdenas",
			                        "San Francisco Tetlanohcan",
			                        "Nanacamilpa De Mariano Arista",
			                        "San JerÃ³nimo Zacualpan",
			                        "Acuamanala De Miguel Hidalgo",
			                        "San JosÃ© Teacalco",
			                        "NatÃ­vitas",
			                        "San Juan Huactzingo",
			                        "Panotla",
			                        "San Lorenzo Axocomanitla",
			                        "San Pablo Del Monte",
			                        "San Lucas Tecopilco",
			                        "Santa Cruz Tlaxcala",
			                        "Santa Ana Nopalucan",
			                        "Tenancingo",
			                        "Santa Apolonia Teacalco",
			                        "Teolocholco",
			                        "Santa Catarina Ayometla",
			                        "Tepeyanco",
			                        "Santa Cruz Quilehtla",
			                        "Terrenate",
			                        "Santa Isabel Xiloxoxtla",
			),
			                    "Veracruz" => array("Selecciona tu municipio",
			                        "Acajete",
			                        "Las Minas",
			                        "AcatlÃ¡n",
			                        "MinatitlÃ¡n",
			                        "Acayucan",
			                        "Misantla",
			                        "Actopan",
			                        "Mixtla De Altamirano",
			                        "Acula",
			                        "MoloacÃ¡n",
			                        "Acultzingo",
			                        "Naolinco",
			                        "CamarÃ³n De Tejeda",
			                        "Naranjal",
			                        "AlpatlÃ¡huac",
			                        "Nautla",
			                        "Alto Lucero De GutiÃ©rrez Barrios",
			                        "Nogales",
			                        "Altotonga",
			                        "Oluta",
			                        "Alvarado",
			                        "Omealca",
			                        "AmatitlÃ¡n",
			                        "Orizaba",
			                        "Naranjos AmatlÃ¡n",
			                        "OtatitlÃ¡n",
			                        "AmatlÃ¡n De Los Reyes",
			                        "Oteapan",
			                        "Ãngel R. Cabada",
			                        "Ozuluama De MascareÃ±as",
			                        "La Antigua",
			                        "Pajapan",
			                        "Apazapan",
			                        "PÃ¡nuco",
			                        "Aquila",
			                        "Papantla",
			                        "Astacinga",
			                        "Paso Del Macho",
			                        "Atlahuilco",
			                        "Paso De Ovejas",
			                        "Atoyac",
			                        "La Perla",
			                        "Atzacan",
			                        "Perote",
			                        "Atzalan",
			                        "PlatÃ³n SÃ¡nchez",
			                        "Tlaltetela",
			                        "Playa Vicente",
			                        "Ayahualulco",
			                        "Poza Rica De Hidalgo",
			                        "Banderilla",
			                        "Las Vigas De RamÃ­rez",
			                        "Benito JuÃ¡rez",
			                        "Pueblo Viejo",
			                        "Boca Del RÃ­o",
			                        "Puente Nacional",
			                        "Calcahualco",
			                        "Rafael Delgado",
			                        "Camerino Z. Mendoza",
			                        "Rafael Lucio",
			                        "Carrillo Puerto",
			                        "Los Reyes",
			                        "Catemaco",
			                        "RÃ­o Blanco",
			                        "Cazones De Herrera",
			                        "Saltabarranca",
			                        "Cerro Azul",
			                        "San AndrÃ©s Tenejapan",
			                        "CitlaltÃ©petl",
			                        "San AndrÃ©s Tuxtla",
			                        "Coacoatzintla",
			                        "San Juan Evangelista",
			                        "CoahuitlÃ¡n",
			                        "Santiago Tuxtla",
			                        "Coatepec",
			                        "Sayula De AlemÃ¡n",
			                        "Coatzacoalcos",
			                        "Soconusco",
			                        "Coatzintla",
			                        "Sochiapa",
			                        "Coetzala",
			                        "Soledad Atzompa",
			                        "Colipa",
			                        "Soledad De Doblado",
			                        "Comapa",
			                        "Soteapan",
			                        "CÃ³rdoba",
			                        "TamalÃ­n",
			                        "Cosamaloapan De Carpio",
			                        "Tamiahua",
			                        "CosautlÃ¡n De Carvajal",
			                        "Tampico Alto",
			                        "Coscomatepec",
			                        "Tancoco",
			                        "Cosoleacaque",
			                        "Tantima",
			                        "Cotaxtla",
			                        "Tantoyuca",
			                        "Coxquihui",
			                        "Tatatila",
			                        "Coyutla",
			                        "Castillo De Teayo",
			                        "Cuichapa",
			                        "Tecolutla",
			                        "CuitlÃ¡huac",
			                        "Tehuipango",
			                        "Chacaltianguis",
			                        "Temapache",
			                        "Chalma",
			                        "Tempoal",
			                        "Chiconamel",
			                        "Tenampa",
			                        "Chiconquiaco",
			                        "TenochtitlÃ¡n",
			                        "Chicontepec",
			                        "Teocelo",
			                        "Chinameca",
			                        "Tepatlaxco",
			                        "Chinampa De Gorostiza",
			                        "TepetlÃ¡n",
			                        "Las Choapas",
			                        "Tepetzintla",
			                        "ChocamÃ¡n",
			                        "Tequila",
			                        "Chontla",
			                        "JosÃ© Azueta",
			                        "ChumatlÃ¡n",
			                        "Texcatepec",
			                        "Emiliano Zapata",
			                        "TexhuacÃ¡n",
			                        "Espinal",
			                        "Texistepec",
			                        "Filomeno Mata",
			                        "Tezonapa",
			                        "FortÃ­n",
			                        "Tierra Blanca",
			                        "GutiÃ©rrez Zamora",
			                        "TihuatlÃ¡n",
			                        "HidalgotitlÃ¡n",
			                        "Tlacojalpan",
			                        "Huatusco",
			                        "Tlacolulan",
			                        "Huayacocotla",
			                        "Tlacotalpan",
			                        "Hueyapan De Ocampo",
			                        "Tlacotepec De MejÃ­a",
			                        "Huiloapan De CuauhtÃ©moc",
			                        "Tlachichilco",
			                        "Ignacio De La Llave",
			                        "Tlalixcoyan",
			                        "IlamatlÃ¡n",
			                        "Tlalnelhuayocan",
			                        "Isla",
			                        "Tlapacoyan",
			                        "Ixcatepec",
			                        "Tlaquilpa",
			                        "IxhuacÃ¡n De Los Reyes",
			                        "Tlilapan",
			                        "IxhuatlÃ¡n Del CafÃ©",
			                        "TomatlÃ¡n",
			                        "Ixhuatlancillo",
			                        "TonayÃ¡n",
			                        "IxhuatlÃ¡n Del Sureste",
			                        "Totutla",
			                        "IxhuatlÃ¡n De Madero",
			                        "TÃºxpam",
			                        "Ixmatlahuacan",
			                        "Tuxtilla",
			                        "IxtaczoquitlÃ¡n",
			                        "Ãšrsulo GalvÃ¡n",
			                        "Jalacingo",
			                        "Vega De Alatorre",
			                        "Xalapa",
			                        "Veracruz",
			                        "Jalcomulco",
			                        "Villa Aldama",
			                        "JÃ¡ltipan",
			                        "Xoxocotla",
			                        "Jamapa",
			                        "Yanga",
			                        "JesÃºs Carranza",
			                        "Yecuatla",
			                        "Xico",
			                        "Zacualpan",
			                        "Jilotepec",
			                        "Zaragoza",
			                        "Juan RodrÃ­guez Clara",
			                        "Zentla",
			                        "Juchique De Ferrer",
			                        "Zongolica",
			                        "Landero y Coss",
			                        "ZontecomatlÃ¡n De LÃ³pez y Fuentes",
			                        "Lerdo De Tejada",
			                        "Zozocolco De Hidalgo",
			                        "Magdalena",
			                        "Agua Dulce",
			                        "Maltrata",
			                        "El Higo",
			                        "Manlio Fabio Altamirano",
			                        "Nanchital De LÃ¡zaro CÃ¡rdenas Del RÃ­o",
			                        "Mariano Escobedo",
			                        "Tres Valles",
			                        "MartÃ­nez De La Torre",
			                        "Carlos A. Carrillo",
			                        "MecatlÃ¡n",
			                        "Tatahuicapan De JuÃ¡rez",
			                        "Mecayapan",
			                        "Uxpanapa",
			                        "MedellÃ­n",
			                        "San Rafael",
			                        "MiahuatlÃ¡n",
			                        "Santiago Sochiapan"
			),
			                    "YucatÃ¡n" => array("Selecciona tu municipio",
			                        "AbalÃ¡",
			                        "Muxupip",
			                        "Acanceh",
			                        "OpichÃ©n",
			                        "Akil",
			                        "Oxkutzcab",
			                        "Baca",
			                        "PanabÃ¡",
			                        "BokobÃ¡",
			                        "Peto",
			                        "Buctzotz",
			                        "Progreso",
			                        "CacalchÃ©n",
			                        "Quintana Roo",
			                        "Calotmul",
			                        "RÃ­o Lagartos",
			                        "Cansahcab",
			                        "Sacalum",
			                        "Cantamayec",
			                        "Samahil",
			                        "CelestÃºn",
			                        "Sanahcat",
			                        "Cenotillo",
			                        "San Felipe",
			                        "Conkal",
			                        "Santa Elena",
			                        "Cuncunul",
			                        "SeyÃ©",
			                        "CuzamÃ¡",
			                        "SinanchÃ©",
			                        "ChacsinkÃ­n",
			                        "Sotuta",
			                        "Chankom",
			                        "SucilÃ¡",
			                        "Chapab",
			                        "Sudzal",
			                        "Chemax",
			                        "Suma",
			                        "Chicxulub Pueblo",
			                        "TahdziÃº",
			                        "ChichimilÃ¡",
			                        "Tahmek",
			                        "Chikindzonot",
			                        "Teabo",
			                        "ChocholÃ¡",
			                        "Tecoh",
			                        "Chumayel",
			                        "Tekal De Venegas",
			                        "Dzan",
			                        "TekantÃ³",
			                        "Dzemul",
			                        "Tekax",
			                        "DzidzantÃºn",
			                        "Tekit",
			                        "Dzilam De Bravo",
			                        "Tekom",
			                        "Dzilam GonzÃ¡lez",
			                        "Telchac Pueblo",
			                        "DzitÃ¡s",
			                        "Telchac Puerto",
			                        "Dzoncauich",
			                        "Temax",
			                        "Espita",
			                        "TemozÃ³n",
			                        "HalachÃ³",
			                        "TepakÃ¡n",
			                        "HocabÃ¡",
			                        "Tetiz",
			                        "HoctÃºn",
			                        "Teya",
			                        "HomÃºn",
			                        "Ticul",
			                        "HuhÃ­",
			                        "Timucuy",
			                        "HunucmÃ¡",
			                        "Tinum",
			                        "Ixil",
			                        "Tixcacalcupul",
			                        "Izamal",
			                        "Tixkokob",
			                        "KanasÃ­n",
			                        "TixmÃ©huac",
			                        "Kantunil",
			                        "TixpÃ©hual",
			                        "Kaua",
			                        "TizimÃ­n",
			                        "Kinchil",
			                        "TunkÃ¡s",
			                        "KopomÃ¡",
			                        "Tzucacab",
			                        "Mama",
			                        "Uayma",
			                        "ManÃ­",
			                        "UcÃº",
			                        "MaxcanÃº",
			                        "UmÃ¡n",
			                        "MayapÃ¡n",
			                        "Valladolid",
			                        "MÃ©rida",
			                        "Xocchel",
			                        "MocochÃ¡",
			                        "YaxcabÃ¡",
			                        "Motul",
			                        "Yaxkukul",
			                        "Muna",
			                        "YobaÃ­n"
			),
			                    "Zacatecas" => array("Selecciona tu municipio",
			                        "Apozol",
			                        "Apulco",
			                        "Atolinga",
			                        "Benito JuÃ¡rez",
			                        "Calera",
			                        "CaÃ±itas De Felipe Pescador",
			                        "ConcepciÃ³n Del Oro",
			                        "CuauhtÃ©moc",
			                        "Chalchihuites",
			                        "Fresnillo",
			                        "Trinidad GarcÃ­a De La Cadena",
			                        "Genaro Codina",
			                        "General Enrique Estrada",
			                        "General Francisco R. MurguÃ­a",
			                        "El Plateado De JoaquÃ­n Amaro",
			                        "General PÃ¡nfilo Natera",
			                        "Guadalupe",
			                        "Huanusco",
			                        "Jalpa",
			                        "Jerez",
			                        "JimÃ©nez Del Teul",
			                        "Juan Aldama",
			                        "Juchipila",
			                        "Loreto",
			                        "Luis Moya",
			                        "Mazapil",
			                        "Melchor Ocampo",
			                        "Mezquital Del Oro",
			                        "Miguel Auza",
			                        "Momax",
			                        "Monte Escobedo",
			                        "Morelos",
			                        "Moyahua De Estrada",
			                        "NochistlÃ¡n De MejÃ­a",
			                        "Noria De Ãngeles",
			                        "Ojocaliente",
			                        "PÃ¡nuco",
			                        "Pinos",
			                        "RÃ­o Grande",
			                        "SaÃ­n Alto",
			                        "El Salvador",
			                        "Sombrerete",
			                        "SusticacÃ¡n",
			                        "Tabasco",
			                        "TepechitlÃ¡n",
			                        "Tepetongo",
			                        "Teul De GonzÃ¡lez Ortega",
			                        "Tlaltenango De SÃ¡nchez RomÃ¡n",
			                        "ValparaÃ­so",
			                        "Vetagrande",
			                        "Villa De Cos",
			                        "Villa GarcÃ­a",
			                        "Villa GonzÃ¡lez Ortega",
			                        "Villa Hidalgo",
			                        "Villanueva",
			                        "Zacatecas",
			                        "Trancoso",
			                        "Santa MarÃ­a De La Paz"
			)
			                );
			     
			    $state = utf8_encode($estado);
			    foreach($municipiosARR[$state] as $value){
			        echo "<option value='".utf8_decode($value)."'>". utf8_decode($value) . "</option>";
			    }
			}	
	break;
	
	case 'listar-cotizaciones':
		$tipo = 'Complete';
		$rspta = $cotizacion->listar($tipo);
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				if ($reg->state==1) {
					$estado= '<p class="label label-primary">Confirmada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" class="btn btn-xs btn-success" onclick="view_ord(\''.$reg->orden.'\')"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'" checked>
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="anular('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==2){
					$estado= '<p class="label label-danger">Anulada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';						
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==3){
					$estado= '<p class="label label-default">Vencida</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning" disabled onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info" disabled onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank" disabled class="disabled btn btn-xs btn-danger" ><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<p class="label label-default">Expiro</p>';
				}else{
					$estado= '<p class="label label-warning">Pendiente</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}
				$data[]=array(

					"0"=>$reg->id,
					"1"=>'C-RM-'.$reg->id,
					"2"=>$reg->usuario,
		 			"3"=>strtoupper($reg->empresa),
		 			"4"=>$reg->correo,
		 			"5"=>number_format($reg->monto,0,'.',','),
		 			"6"=>$dias[date('w', strtotime($reg->fecha_entrada))]." ".date('d', strtotime($reg->fecha_entrada))." de ".$meses[date('n', strtotime($reg->fecha_entrada))-1]. " del ".date('Y', strtotime($reg->fecha_entrada)),
		 			"7"=>$estado,
		 			"8"=>$opciones,
		 			"9"=>$botonOrden,
					"10"=>$onoff
				);
			}
			$results = array(
					"sEcho"=>1, 
					"iTotalRecords"=>count($data), 
					"iTotalDisplayRecords"=>count($data), 
					"aaData"=>$data
				);
			echo json_encode($results);
		}
	break;

	case 'list-all':		
		$rspta = $cotizacion->listarAll();
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				if ($reg->state==1) {
					$estado= '<p class="label label-primary">Confirmada</p>';
					if ($reg->file!="") {
						$opciones='<a href="'.$dominio.'pdf_cotizaciones/'.$reg->file.'" download  class="btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" onclick="view_file(\''.$reg->file.'\',\'cotizacion\')" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}else{
						$opciones='<a href="#" disabled class="disabled btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" disabled class="disabled btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}
					if ($reg->orden!="") {
						$ordenBtn=' <button type="button" class="btn btn-xs btn-success" onclick="view_file(\''.$reg->orden.'\',\'orden\')"><i class="fa fa-copy"></i></button>';
					}else{
						$ordenBtn=' <button type="button" class="disabled btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					}	
				}else if($reg->state==2){
					$estado= '<p class="label label-danger">Anulada</p>';
					if ($reg->file!="") {
						$opciones='<a href="'.$dominio.'pdf_cotizaciones/'.$reg->file.'" download  class="btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" onclick="view_file(\''.$reg->file.'\',\'cotizacion\')" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}else{
						$opciones='<a href="#" disabled class="disabled btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" disabled class="disabled btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}
					if ($reg->orden!="") {
						$ordenBtn=' <button type="button" class="btn btn-xs btn-success" onclick="view_file(\''.$reg->orden.'\',\'orden\')"><i class="fa fa-copy"></i></button>';
					}else{
						$ordenBtn=' <button type="button" class="disabled btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					}
				}else if($reg->state==3){
					$estado= '<p class="label label-default">Vencida</p>';
					if ($reg->file!="") {
						$opciones='<a href="'.$dominio.'pdf_cotizaciones/'.$reg->file.'" download  class="btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" onclick="view_file(\''.$reg->file.'\',\'cotizacion\')" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}else{
						$opciones='<a href="#" disabled class="disabled btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" disabled class="disabled btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}
					if ($reg->orden!="") {
						$ordenBtn=' <button type="button" class="btn btn-xs btn-success" onclick="view_file(\''.$reg->orden.'\',\'orden\')"><i class="fa fa-copy"></i></button>';
					}else{
						$ordenBtn=' <button type="button" class="disabled btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					}
				}else{
					$estado= '<p class="label label-warning">Pendiente</p>';
					if ($reg->file!="") {
						$opciones='<a href="'.$dominio.'pdf_cotizaciones/'.$reg->file.'" download  class="btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" onclick="view_file(\''.$reg->file.'\',\'cotizacion\')" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}else{
						$opciones='<a href="#" disabled class="disabled btn btn-xs btn-info"><i class="fa fa-file-pdf-o"></i> <i class="fa fa-download"></i></a> <a href="#" disabled class="disabled btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
					}
					if ($reg->orden!="") {
						$ordenBtn=' <button type="button" class="btn btn-xs btn-success" onclick="view_file(\''.$reg->orden.'\',\'orden\')"><i class="fa fa-copy"></i></button>';
					}else{
						$ordenBtn=' <button type="button" class="disabled btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					}
				}
				$data[]=array(
					"0"=>$reg->id,
					"1"=>'C-RM-'.$reg->id,
					"2"=>$reg->usuario,
		 			"3"=>strtoupper($reg->empresa),
		 			"4"=>number_format($reg->monto,0,'.',','),
		 			"5"=>$dias[date('w', strtotime($reg->vencimiento))]." ".date('d', strtotime($reg->vencimiento))." de ".$meses[date('n', strtotime($reg->vencimiento))-1]. " del ".date('Y', strtotime($reg->vencimiento)),
		 			"6"=>$estado,
		 			"7"=>$opciones.$ordenBtn
				);
			}
			$results = array(
					"sEcho"=>1, 
					"iTotalRecords"=>count($data), 
					"iTotalDisplayRecords"=>count($data), 
					"aaData"=>$data
				);
			echo json_encode($results);
		}
	break;

	case 'info-cot':
		$id = $_POST['id'];
		$id_user = $_SESSION['iduser'];
		$rspta = $cotizacion->show($id,$id_user);
		if ($rspta) {
			$info='';
			$subtotal=0;
			$monto_total =0;
			$fh = $rspta['cotizaciones']->fetch(PDO::FETCH_OBJ);
			$datos_cotizacion =[
				'folio'=>'C-RM-'.$fh->id,
				'clave'=>$fh->clave,
				'id_user'=>$id_user,
				'token'=>$fh->token,
				'coordinador'=>$fh->coordinador,
				'procedencia'=>$fh->municipio.', '.$fh->estado,
				'telefono'=>$fh->telefono,
				'noches'=>$fh->noches,
				'dias'=>$fh->dias,
				'estado'=>$fh->state
			];
			$total_extras=0;
			if ($rspta['extras'] !='') {
				while ($f = $rspta['extras']->fetch(PDO::FETCH_OBJ)) {
					$total_extras = $total_extras + $f->costo;
				}
			}
			if ($fh->hospedaje !='') {
				// die(json_encode($total_extras));
				if ($rspta['servicios']->rowCount()>0) {
					$info.='<div class="row">';					
						$info.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-service">';
							$info .= '<h2 class="title-cat">Servicios</h2>';
							$info .= '<table class="table table-condensed">
								<thead>
									<tr>
										<th>Servicio</th>
										<th>Precio</th>
										<th>Cantidad</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>';
							while($cot = $rspta['servicios']->fetchAll(PDO::FETCH_OBJ)){
								$dias = array();
						          foreach ($cot as $f) {
						              $dias[] = $f->dia;
						          }
						          
						        $dias = array_values(array_unique($dias)); 
						        $cont=0;
						        if (count($dias)==1) {
						        	$info .= '<tr class="success"><td colspan="4">'.$dias[0].'</td></tr>';
							        foreach ($cot as $f): 
										$subtotal=( round(((($f->precio*16)/100)+$f->precio)) * $f->cantidad);
											$info.='<tr>
												      <td>'.$f->servicio.'</td>
													  <td>'.round(((($f->precio*16)/100)+$f->precio)).'</td>
													  <td>'.$f->cantidad.'</td>
													  <td><b>'.number_format($subtotal,2,'.',',').'</b></td>';
										$info .= '</tr>';
										$monto_total=($f->precio*$f->cantidad)+$monto_total;
									endforeach;
						        }else{
						        	foreach ($cot as $f): 

								        $dia_actual = $f->dia; 
								        if ($dia_actual == $dias[$cont]):
											$info .= '<tr class="success"><td colspan="4">'.$f->dia.'</td></tr>';
											// $info.=$hos;
											$cont++; 
									        if ($cont == count($dias)) {
									            $cont = 0;
									        } 
										endif;
										$subtotal=( round(((($f->precio*16)/100)+$f->precio)) * $f->cantidad);
											$info.='<tr>
												      <td>'.$f->servicio.'</td>
													  <td>'.round(((($f->precio*16)/100)+$f->precio)).'</td>
													  <td>'.$f->cantidad.'</td>
													  <td><b>'.number_format($subtotal,2,'.',',').'</b></td>';
										$info .= '</tr>';
										$monto_total=($f->precio*$f->cantidad)+$monto_total;
									endforeach;
						        } 
							}
							$info .='<tr>
						    			<td colspan="3" class="text-right">Servicios:</td>
						    			<td><b>'.number_format($monto_total,2,'.',',').'</b></td>
							    	</tr>
									<tr>
						    			<td colspan="3" class="text-right">16% IVA:</td>
						    			<td><b>'.number_format(round(($monto_total*16)/100),2,'.',',').'</b></td>
							    	</tr>
									<tr>
						    			<td colspan="3" class="text-right">10% Serv:</td>
						    			<td><b>'.number_format(round(($monto_total*10)/100),2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="3" class="text-right">Subtotal:</td>
						    			<td><b>'.number_format(round( ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) )  ),2,'.',',').'</b></td>
							    	</tr>';
							    	
							$info .= '</tbody>
							</table>';
						$info.='</div>';
				
						$habitaciones = json_decode($fh->hospedaje,true);
					    $total =0;
					    $info.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
					    	$info .= '<h2 class="title-cat">Hospedaje</h2>';
						    $info .= '<table class="table table-condensed">
								<thead>
									<tr>
										<th>Habitacion</th>
										<th>Cantidad</th>
										<th>Noches</th>
										<th>Tarifa</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>';
									
						    foreach ($habitaciones as $h => $cantidad) {
								$cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
						    	$info .= '<tr>
						    				<td>'.$h.'</td>
											<td>'.$cant.'</td>
											<td>'.$fh->noches.'</td>
											<td>'.number_format($cantidad["tarifa"],2,'.',',').'</td>';
								$info .= '<td> <b>'.number_format(($cant*$cantidad["tarifa"]),2,'.',',').'</b></td>   	
									    </tr>';
						    	$total=($cant*$cantidad['tarifa'])+$total;
						    }
						    $total_hos = ($total*$fh->noches);
						    $info .='<tr>
						    			<td colspan="4" class="text-right">Hospedaje:</td>
						    			<td><b>'.number_format($total_hos,2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="4" class="text-right">16% IVA:</td>
						    			<td><b>'.number_format(round(($total_hos*16)/100),2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="4" class="text-right">3% ISH:</td>
						    			<td><b>'.number_format(round(($total_hos*3)/100),2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="4" class="text-right">Subtotal:</td>
						    			<td><b>'.number_format(round( ( ((($total_hos*16)/100)+$total_hos) ) + ( (($total_hos*3)/100) )  ),2,'.',',').'</b></td>
							    	</tr>';
							    	
							$info .= '</tbody>
							</table>';
						    $info .= '<hr>
						     <h2>Total: <b>$'.number_format(round( ( ( ((($total_hos*16)/100)+$total_hos) ) + ( (($total_hos*3)/100) ) + ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) ) ) + $total_extras  ),2,'.',',').'</b></h2>';					     
					    $info.='</div>';
					$info.='</div>';
				}else{
					$info.='<div class="row">';									
						$habitaciones = json_decode($fh->hospedaje,true);
					    $total =0;
					    $info.='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
					    	$info .= '<h2 class="title-cat">Hospedaje</h2>';
						    $info .= '<table class="table table-condensed">
								<thead>
									<tr>
										<th>Habitacion</th>
										<th>Cantidad</th>
										<th>Noches</th>
										<th>Tarifa</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>';
									
						    foreach ($habitaciones as $h => $cantidad) {
								$cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
						    	$info .= '<tr>
						    				<td>'.$h.'</td>
											<td>'.$cant.'</td>
											<td>'.$fh->noches.'</td>
											<td>'.number_format($cantidad["tarifa"],2,'.',',').'</td>';
								$info .= '<td> <b>'.number_format(($cant*$cantidad["tarifa"]),2,'.',',').'</b></td>   	
									    </tr>';
						    	$total=($cant*$cantidad['tarifa'])+$total;
						    }
						    $total_hos = ($total*$fh->noches);
						    $info .='<tr>
						    			<td colspan="4" class="text-right">Hospedaje:</td>
						    			<td><b>'.number_format($total_hos,2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="4" class="text-right">16% IVA:</td>
						    			<td><b>'.number_format(round(($total_hos*16)/100),2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="4" class="text-right">3% ISH:</td>
						    			<td><b>'.number_format(round(($total_hos*3)/100),2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="4" class="text-right">Subtotal:</td>
						    			<td><b>'.number_format(round( ( ((($total_hos*16)/100)+$total_hos) ) + ( (($total_hos*3)/100) )  ),2,'.',',').'</b></td>
							    	</tr>';
							    	
							$info .= '</tbody>
							</table>';
						    $info .= '<hr>
						     <h2 class="text-right">Total: <b>$'.number_format(round( ( ( ((($total_hos*16)/100)+$total_hos) ) + ( (($total_hos*3)/100) ) + ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) ) ) + $total_extras  ),2,'.',',').'</b></h2>';					     
					    $info.='</div>';
					$info.='</div>';
				}
			}else{
				$info.='<div class="row">';
					$info.='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-service">';
						$info .= '<h2 class="title-cat">Servicios</h2>';
						$info .= '<table class="table table-condensed">
							<thead>
								<tr>
									<th>Servicio</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>';
						while($cot = $rspta['servicios']->fetchAll(PDO::FETCH_OBJ)){
							$dias = array();
					          foreach ($cot as $f) {
					              $dias[] = $f->dia;
					          }
					          
					        $dias = array_values(array_unique($dias)); 
					        $cont=0; 
					        if (count($dias)==1) {
					        	$info .= '<tr class="success"><td colspan="4">'.$dias[0].'</td></tr>';
						        foreach ($cot as $f): 
									$subtotal=( round(((($f->precio*16)/100)+$f->precio)) * $f->cantidad);
										$info.='<tr>
											      <td>'.$f->servicio.'</td>
												  <td>'.round(((($f->precio*16)/100)+$f->precio)).'</td>
												  <td>'.$f->cantidad.'</td>
												  <td><b>'.number_format($subtotal,2,'.',',').'</b></td>';
									$info .= '</tr>';
									$monto_total=($f->precio*$f->cantidad)+$monto_total;
								endforeach;
					        }else{
					        	foreach ($cot as $f): 

							        $dia_actual = $f->dia; 
							        if ($dia_actual == $dias[$cont]):
										$info .= '<tr class="success"><td colspan="4">'.$f->dia.'</td></tr>';
										// $info.=$hos;
										$cont++; 
								        if ($cont == count($dias)) {
								            $cont = 0;
								        } 
									endif;
									$subtotal=( round(((($f->precio*16)/100)+$f->precio)) * $f->cantidad);
										$info.='<tr>
											      <td>'.$f->servicio.'</td>
												  <td>'.round(((($f->precio*16)/100)+$f->precio)).'</td>
												  <td>'.$f->cantidad.'</td>
												  <td><b>'.number_format($subtotal,2,'.',',').'</b></td>';
									$info .= '</tr>';
									$monto_total=($f->precio*$f->cantidad)+$monto_total;
								endforeach;
					        } 
						}
						$info .='<tr>
					    			<td colspan="3" class="text-right">Servicios:</td>
					    			<td><b>'.number_format($monto_total,2,'.',',').'</b></td>
						    	</tr>
								<tr>
					    			<td colspan="3" class="text-right">16% IVA:</td>
					    			<td><b>'.number_format(round(($monto_total*16)/100),2,'.',',').'</b></td>
						    	</tr>
								<tr>
					    			<td colspan="3" class="text-right">10% Serv:</td>
					    			<td><b>'.number_format(round(($monto_total*10)/100),2,'.',',').'</b></td>
						    	</tr>
						    	<tr>
					    			<td colspan="3" class="text-right">Subtotal:</td>
					    			<td><b>'.number_format(round( ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) )  ),2,'.',',').'</b></td>
						    	</tr>';
						$info .= '</tbody>
						</table>';
						$info .= '<hr>
					     <h2 class="text-right">Total: <b>$'.number_format(round( ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) ) + $total_extras  ),2,'.',',').'</b></h2>';
					$info.='</div>';
				$info.='</div>';
			}
			$response=[
				'success'=>true,  
				'datos'=>$datos_cotizacion,
				'info' => $info
			];
		}else{
			$response=[
				'success'=>false,  
				'msg'=> 'No tienes permisos para ver la información de esta cotizacion'
			];
		}
		echo json_encode($response);
	break;

	case 'getMonths':
		$sql = "SELECT DISTINCT MonthName(created_at) as mes FROM cotizaciones";
		$result = $con->prepare($sql);
		$result->execute();
		$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		while ($f = $result->fetch(PDO::FETCH_OBJ)) {

			echo '<option value="'.$f->mes.'">'.$months[date('n', strtotime($f->mes))-1].'</option>';
		}
	break;
	case 'selectDias':
		$id = $_POST['id'];
		$rspta = $cotizacion->selectDias($id);
		while ($f = $rspta->fetch(PDO::FETCH_OBJ)) {
			echo "<option value='".$f->dia."'>".$f->dia."</option>";
		}
	break;
	case 'selectDiasHospedaje':
		$id = $_POST['id'];
		$rspta = $cotizacion->selectDiasHospedaje($id);
		if($rspta){
			$datos = $rspta->fetch(PDO::FETCH_OBJ);
			$response = ['success'=>true,'n_dias'=>$datos->dias,'fecha_entrada'=>$datos->fecha_entrada];
		}else{
			$response =['success'=>false,'msg'=>'No se encontraron los dias para los extras'];
		}
		echo json_encode($response);
	break;

	case 'cotizacion':
		$hospedaje=array();
		$tipo = $_POST['tipo'];
		if (!isset($_SESSION['iduser']) || empty($_SESSION['iduser'])) {
			$response=['success'=>false,'msg'=>'expired'];
		}else{
			if ($tipo==='Complete') {
				if (!empty($_POST['n_hs'])) {
					$hospedaje['habitacion sencilla']['cantidad'] = $_POST['n_hs'];
					$hospedaje['habitacion sencilla']['tarifa'] = $_POST['tarifa_hs'];
				}
				if (!empty($_POST['n_hd'])) {
					$hospedaje['habitacion doble']['cantidad'] = $_POST['n_hd'];
					$hospedaje['habitacion doble']['tarifa'] = $_POST['tarifa_hd'];
				}
				if (!empty($_POST['n_ht'])) {
					$hospedaje['habitacion triple']['cantidad'] = $_POST['n_ht'];
					$hospedaje['habitacion triple']['tarifa'] = $_POST['tarifa_ht'];
				}
				if (!empty($_POST['n_hc'])) {
					$hospedaje['habitacion cuadruple']['cantidad'] = $_POST['n_hc'];
					$hospedaje['habitacion cuadruple']['tarifa'] = $_POST['tarifa_hc'];
				}
				// var_dump($hospedaje);
				$hospedaje= json_encode($hospedaje);
				// die(json_encode($_POST));			
				$idusuario=$_SESSION['iduser'];
				$empresa=limpiarCadena($_POST['empresa']);
				$estado=limpiarCadena($_POST['estado']);
				$municipio=limpiarCadena($_POST['municipio']);
				$email=validarEmail($_POST['email']);
				$telefono=limpiarCadena($_POST['telefono']);
				$coordinador=limpiarCadena($_POST['coordinador']);
				$date_start=$_POST['date_start'];
				$date_end=$_POST['date_end'];
				$noches=$_POST['noches'];
				$dias=$_POST['dias'];
				$total_rooms=$_POST['total_rooms'];
				$n_int=$_POST['n_int'];
				$total=$_POST['total'];
				$token = bin2hex(openssl_random_pseudo_bytes(128));
				$clave = (!empty($_POST['clave'])) ? $_POST['clave'] : uniqid('CG_');
				$tipo = $_POST['tipo'];
				$now =  date('Y-m-d H:i:s');
				$venc = strtotime($now."+ 30 days");
				$vigencia = date("Y-m-d H:i:s",$venc);
				if (!isset($_POST['servicios'])) {
					$response=[
						'success'=>false,  
						'msg'=> 'La cotizacion no esta completa debe tener servicios aregados'
					];
				}else{
					$rspta = $cotizacion->store($idusuario,$empresa,$estado,$municipio,$email,$telefono,
							$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total_rooms,$n_int,$total,$token,$clave,$tipo,$vigencia,$now,$_POST['servicios']);

					if ($rspta) {
						$response=[
							'success'=>true,  
							'msg'=> 'Cotizacion registrada',
							'idcot'=> $rspta
						];
					}else{
						$response=[
							'success'=>false,  
							'msg'=> 'Algo va mal intenta mas tarde'
						];
					}
				}
			}else{			
				if (!empty($_POST['n_hs'])) {
					$hospedaje['habitacion sencilla']['cantidad'] = $_POST['n_hs'];
					$hospedaje['habitacion sencilla']['tarifa'] = $_POST['tarifa_hs'];
				}
				if (!empty($_POST['n_hd'])) {
					$hospedaje['habitacion doble']['cantidad'] = $_POST['n_hd'];
					$hospedaje['habitacion doble']['tarifa'] = $_POST['tarifa_hd'];
				}
				if (!empty($_POST['n_ht'])) {
					$hospedaje['habitacion triple']['cantidad'] = $_POST['n_ht'];
					$hospedaje['habitacion triple']['tarifa'] = $_POST['tarifa_ht'];
				}
				if (!empty($_POST['n_hc'])) {
					$hospedaje['habitacion cuadruple']['cantidad'] = $_POST['n_hc'];
					$hospedaje['habitacion cuadruple']['tarifa'] = $_POST['tarifa_hc'];
				}
				// var_dump($hospedaje);
				$hospedaje= json_encode($hospedaje);
				// die(json_encode($_POST));
				$idusuario=$_SESSION['iduser'];
				$empresa=limpiarCadena($_POST['empresa']);
				$estado=limpiarCadena($_POST['estado']);
				$municipio=limpiarCadena($_POST['municipio']);
				$email=validarEmail($_POST['email']);
				$telefono=limpiarCadena($_POST['telefono']);
				$coordinador=limpiarCadena($_POST['coordinador']);
				$date_start=$_POST['date_start'];
				$date_end=$_POST['date_end'];
				$noches=(isset($_POST['noches']))? $_POST['noches'] : "";
				$dias=$_POST['dias'];
				$total_rooms=$_POST['total_rooms'];
				$n_int=$_POST['n_int'];
				$total=$_POST['total'];
				$token = bin2hex(openssl_random_pseudo_bytes(128));
				$clave = (!empty($_POST['clave'])) ? $_POST['clave'] : uniqid('CG_');

				$tipo = $_POST['tipo'];
				$now =  date('Y-m-d H:i:s');
				$venc = strtotime($now."+ 30 days");
				$vigencia = date("Y-m-d H:i:s",$venc);
				$servicios = $_POST['servicios'];
				
				$rspta = $cotizacion->store($idusuario,$empresa,$estado,$municipio,$email,$telefono,
						$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total_rooms,$n_int,$total,$token,$clave,$tipo,$vigencia,$now,$_POST['servicios']);

				if ($rspta) {
					$response=[
						'success'=>true,  
						'msg'=> 'Cotizacion registrada',
						'idcot'=> $rspta
					];
				}else{
					$response=[
						'success'=>false,  
						'msg'=> 'Algo va mal intenta mas tarde'
					];
				}
			}			
		}
		echo json_encode($response);
	break;

	case 'edit':
		$id = $_POST['id'];
		$id_user = $_SESSION['iduser'];
		$rspta = $cotizacion->edit($id,$id_user);
		if ($rspta) {
			$fc = $rspta['q']->fetch(PDO::FETCH_OBJ);
			if ($fc->hospedaje!="") {				
				$habitaciones = json_decode($fc->hospedaje,true);
				$hospedaje=array(); 
				$i=0;
			    foreach ($habitaciones as $h => $cantidad) {
						$hospedaje[$i]['habitacion'] = $h;
						$hospedaje[$i]['cantidad'] = $cantidad['cantidad'];
						$hospedaje[$i]['tarifa'] = $cantidad['tarifa'];
					$i++;
				}
			}else{
				$hospedaje=[];
			}
			$datos = [
				'folio'=>'C-RM-'.$fc->id,
				'clave'=>$fc->clave,
				'empresa' => $fc->empresa,
				'estado' => $fc->estado,
				'municipio' => $fc->municipio,
				'telefono' => $fc->telefono,
				'correo' => $fc->correo,
				'coordinador' => $fc->coordinador,
				'fecha_entrada' => $fc->fecha_entrada,
				'fecha_salida' => $fc->fecha_salida,
				'noches' => $fc->noches,
				'dias' => $fc->dias,
				'huespedes' => $fc->huespedes,
				'monto' => $fc->monto,
			];
			$response = [
				'success'=>true,  
				'datos' => $datos,
				'hospedaje' => $hospedaje
			];
			echo json_encode($response);
		}else{
			$response=[
					'success'=>false,  
					'msg'=> 'No tienes permisos para editar esta cotizacion'
			];
			echo json_encode($response);
		}
	break;

	case 'update':
		// die(json_encode($_POST));
		$hospedaje=array();
		$tipo = $_POST['tipo'];
		if ($tipo==='Complete') {
			if (!empty($_POST['n_hs'])) {
				$hospedaje['habitacion sencilla']['cantidad'] = $_POST['n_hs'];
				$hospedaje['habitacion sencilla']['tarifa'] = $_POST['tarifa_hs'];
			}
			if (!empty($_POST['n_hd'])) {
				$hospedaje['habitacion doble']['cantidad'] = $_POST['n_hd'];
				$hospedaje['habitacion doble']['tarifa'] = $_POST['tarifa_hd'];
			}
			if (!empty($_POST['n_ht'])) {
				$hospedaje['habitacion triple']['cantidad'] = $_POST['n_ht'];
				$hospedaje['habitacion triple']['tarifa'] = $_POST['tarifa_ht'];
			}
			if (!empty($_POST['n_hc'])) {
				$hospedaje['habitacion cuadruple']['cantidad'] = $_POST['n_hc'];
				$hospedaje['habitacion cuadruple']['tarifa'] = $_POST['tarifa_hc'];
			}
			// var_dump($hospedaje);
			$hospedaje= json_encode($hospedaje);
			// die(json_encode($_POST));
			$id = $_POST['id'];			
			$empresa=limpiarCadena($_POST['empresa']);
			$estado=limpiarCadena($_POST['estado']);
			$municipio=limpiarCadena($_POST['municipio']);
			$email=validarEmail($_POST['email']);
			$telefono=limpiarCadena($_POST['telefono']);
			$coordinador=limpiarCadena($_POST['coordinador']);
			$date_start=$_POST['date_start'];
			$date_end=$_POST['date_end'];
			$noches=$_POST['noches'];
			$dias=$_POST['dias'];
			$total_rooms=$_POST['total_rooms'];
			$n_int=$_POST['n_int'];
			$total=$_POST['total'];
			$tipo = $_POST['tipo'];
			$now =  date('Y-m-d H:i:s');
			if (!isset($_POST['servicios'])) {
				$response=[
					'success'=>true,  
					'msg'=> 'La cotizacion no esta completa debe tener servicios aregados'
				];
			}else{
				$rspta = $cotizacion->update($empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,	$noches,$dias,$total_rooms,$n_int,$total,$now,$_POST['servicios'],$id);

				if ($rspta) {
					$response=[
						'success'=>true,  
						'msg'=> 'Cotizacion actualizada',
						'idcot'=> $rspta
					];
				}else{
					$response=[
						'success'=>false,  
						'msg'=> 'Algo va mal intenta mas tarde'
					];
				}
			}
		}else{
			if (!empty($_POST['n_hs'])) {
				$hospedaje['habitacion sencilla']['cantidad'] = $_POST['n_hs'];
				$hospedaje['habitacion sencilla']['tarifa'] = $_POST['tarifa_hs'];
			}
			if (!empty($_POST['n_hd'])) {
				$hospedaje['habitacion doble']['cantidad'] = $_POST['n_hd'];
				$hospedaje['habitacion doble']['tarifa'] = $_POST['tarifa_hd'];
			}
			if (!empty($_POST['n_ht'])) {
				$hospedaje['habitacion triple']['cantidad'] = $_POST['n_ht'];
				$hospedaje['habitacion triple']['tarifa'] = $_POST['tarifa_ht'];
			}
			if (!empty($_POST['n_hc'])) {
				$hospedaje['habitacion cuadruple']['cantidad'] = $_POST['n_hc'];
				$hospedaje['habitacion cuadruple']['tarifa'] = $_POST['tarifa_hc'];
			}
			$hospedaje = (count($hospedaje)>0) ? json_encode($hospedaje) : "";
			// $hospedaje= json_encode($hospedaje);
			// var_dump($hospedaje);
			// die();
			$id = $_POST['id'];			
			$empresa=limpiarCadena($_POST['empresa']);
			$estado=limpiarCadena($_POST['estado']);
			$municipio=limpiarCadena($_POST['municipio']);
			$email=validarEmail($_POST['email']);
			$telefono=limpiarCadena($_POST['telefono']);
			$coordinador=limpiarCadena($_POST['coordinador']);
			$date_start=$_POST['date_start'];
			$date_end=$_POST['date_end'];
			$noches=(isset($_POST['noches']))? $_POST['noches'] : "";
			$dias=$_POST['dias'];
			$total_rooms=(isset($_POST['total_rooms']))? $_POST['total_rooms'] : 0;
			$n_int=$_POST['n_int'];
			$total=$_POST['total'];
			$now =  date('Y-m-d H:i:s');
			// $servicios = $_POST['servicios'];

			if (isset($_POST['servicios'])) {
				$rspta = $cotizacion->update($empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,	$noches,$dias,$total_rooms,$n_int,$total,$now,$_POST['servicios'],$id);
				if ($rspta['success']) {
					$response=['success'=>true,'msg'=>'La cotizacion se actualizo correctamente'];
				}else{
					$response=['success'=>false,'msg'=>$rspta['msg']];
				}
			}else{
				$servicios ='';
				$rspta = $cotizacion->update($empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,	$noches,$dias,$total_rooms,$n_int,$total,$now,$servicios,$id);
				if ($rspta['success']) {
					$response=['success'=>true,'msg'=>'La cotizacion se actualizo correctamente'];
				}else{
					$response=['success'=>false,'msg'=>$rspta['msg']];
				}
			}	
		}
		echo json_encode($response);
	break;

	case 'delete':
		$id = $_POST['id'];
		$id_user = $_SESSION['iduser'];
		$rspta = $cotizacion->destroy($id,$id_user);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Cotizacion Eliminada'
			];
		}else{
			$response=[
				'success'=>false,  
				'msg'=> 'No tienes permisos para eliminar esta cotizacion'
			];
		}
		echo json_encode($response);
	break;

	case 'confirmar':
		$sqlAuth = "SELECT * FROM cotizaciones  WHERE id =".$_POST['id']." && id_usuario =".$_SESSION['iduser']." ";
		$resInAuth = $con->prepare($sqlAuth);
		$resInAuth->execute();
		$filas = $resInAuth->rowCount();

		if ($filas>0) {
			$user = $resInAuth->fetch(PDO::FETCH_OBJ);
			$archivo = $_FILES['orden'];
			$ext = new SplFileInfo($archivo['name']);
			$filename = 'orden_'.str_replace(" ", "_", strtolower('C-RM-'.$user->id.'_'.date('d-m-Y').'.'.$ext->getExtension()));
			$ext->getExtension();
			if ($archivo['type'] == "application/pdf" && $ext->getExtension()=='pdf') {				
				$carepta_destino = '../orden_servicio/';

				$move_ok =move_uploaded_file($_FILES['orden']['tmp_name'], $carepta_destino.$filename);
				if ($move_ok) {
					$sql = "UPDATE cotizaciones SET `state` = 1, `orden` = '$filename' WHERE id=".$_POST['id']." && id_usuario =".$_SESSION['iduser']." ";
					$upd = $con->prepare($sql);
					$upd->execute();
					$f = $upd->rowCount();
					if ($f>0) {
						$response=[
							'success'=>true,  
							'msg'=> 'Cotizacion confirmada'
						];
					}else{
						unlink($carepta_destino.$filename);
						$response=[
							'success'=>false,  
							'msg'=> 'No se pudo confirmar intenta de nuevo'
						];
					}				
				}else{
					$response=[
						'success'=>true,  
						'msg'=> 'No se pudo subir la orden de servicio intenta mas tarde'
					];
				}
			}else{
				$response=[
					'success'=>false,  
					'msg'=> 'Solo se adminten archivos en formato PDF'
				];
			}
		}else{
			$response=[
				'success'=>false,  
				'msg'=> 'No tienes permisos para confirmar esta cotizacion'
			];
		}
		echo json_encode($response);
	break;

	case 'anular':
		$sqlAuth = "SELECT * FROM cotizaciones  WHERE id =".$_POST['id']." && id_usuario =".$_SESSION['iduser']." ";
		$resInAuth = $con->prepare($sqlAuth);
		$resInAuth->execute();
		$filas = $resInAuth->rowCount();
		if ($filas>0) {
			$user = $resInAuth->fetch(PDO::FETCH_OBJ);
			$ubicacion = '../orden_servicio/';
			$filename = $user->orden;
			$sql = "UPDATE cotizaciones SET `state` = 2, `orden` = '' WHERE id=".$_POST['id']." && id_usuario = ".$_SESSION['iduser']." ";
			$upd = $con->prepare($sql);
			$upd->execute();
			$f = $upd->rowCount();
			if ($f>0) {
				if (unlink($ubicacion.$filename)) {				
					$response=[
							'success'=>true,  
							'msg'=> 'Cotizacion Anulada'
					];
				}else{
					$sqlRoll = "UPDATE cotizaciones SET `state` = 1, `orden` = '$filename' WHERE id=".$_POST['id']." && id_usuario = ".$_SESSION['iduser']." ";
					$updRoll = $con->prepare($sqlRoll);
					$updRoll->execute();
					$response=[
						'success'=>true,  
						'msg'=> 'La Cotizacion no se pudo anular intenta mas tarde'
					];
				}
			}else{
				$response=[
						'success'=>false,  
						'msg'=> 'No tienes permisos para anular esta cotizacion'
				];
			}
		}else{
			$response=[
				'success'=>false,  
				'msg'=> 'No tienes permisos para anular esta cotizacion'
			];
		}
		echo json_encode($response);
	break;

// -----------------------------------------------------------Funciones para Hospedaje y Servicios
	// Listar Hopedaje
	case 'listar-hospedaje':
		$tipo ='Hosting';
		$rspta = $cotizacion->listarHosting($tipo);
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				if ($reg->state==1) {
					$estado= '<p class="label label-primary">Confirmada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" class="btn btn-xs btn-success" onclick="view_ord(\''.$reg->orden.'\')"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'" checked>
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="anular('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==2){
					$estado= '<p class="label label-danger">Anulada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';						
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==3){
					$estado= '<p class="label label-default">Vencida</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning" disabled onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info" disabled onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank" disabled class="disabled btn btn-xs btn-danger" ><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<p class="label label-default">Expiro</p>';
				}else{
					$estado= '<p class="label label-warning">Pendiente</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}
				$data[]=array(

					"0"=>$reg->id,
					"1"=>'C-RM-'.$reg->id,
					"2"=>$reg->usuario,
		 			"3"=>strtoupper($reg->empresa),
		 			"4"=>$reg->correo,
		 			"5"=>number_format($reg->monto,0,'.',','),
		 			"6"=>$dias[date('w', strtotime($reg->fecha_entrada))]." ".date('d', strtotime($reg->fecha_entrada))." de ".$meses[date('n', strtotime($reg->fecha_entrada))-1]. " del ".date('Y', strtotime($reg->fecha_entrada)),
		 			"7"=>$estado,
		 			"8"=>$opciones,
		 			"9"=>$botonOrden,
					"10"=>$onoff
				);
			}
			$results = array(
					"sEcho"=>1, 
					"iTotalRecords"=>count($data), 
					"iTotalDisplayRecords"=>count($data), 
					"aaData"=>$data
				);
			echo json_encode($results);
		}
	break;

	// guardar hospedaje
	case 'hospedaje':
		if (!isset($_SESSION['iduser']) || empty($_SESSION['iduser'])) {
			$response=['success'=>false,'msg'=>'expired'];
		}else{
			$hospedaje=array();
			if (!empty($_POST['n_hs'])) {
				$hospedaje['habitacion sencilla']['cantidad'] = $_POST['n_hs'];
				$hospedaje['habitacion sencilla']['tarifa'] = $_POST['tarifa_hs'];
			}
			if (!empty($_POST['n_hd'])) {
				$hospedaje['habitacion doble']['cantidad'] = $_POST['n_hd'];
				$hospedaje['habitacion doble']['tarifa'] = $_POST['tarifa_hd'];
			}
			if (!empty($_POST['n_ht'])) {
				$hospedaje['habitacion triple']['cantidad'] = $_POST['n_ht'];
				$hospedaje['habitacion triple']['tarifa'] = $_POST['tarifa_ht'];
			}
			if (!empty($_POST['n_hc'])) {
				$hospedaje['habitacion cuadruple']['cantidad'] = $_POST['n_hc'];
				$hospedaje['habitacion cuadruple']['tarifa'] = $_POST['tarifa_hc'];
			}
			// var_dump($hospedaje);
			$hospedaje= json_encode($hospedaje);
			// die(json_encode($_POST));
			$idusuario=$_SESSION['iduser'];
			$empresa=limpiarCadena($_POST['empresa']);
			$estado=limpiarCadena($_POST['estado']);
			$municipio=limpiarCadena($_POST['municipio']);
			$email=validarEmail($_POST['email']);
			$telefono=limpiarCadena($_POST['telefono']);
			$coordinador=limpiarCadena($_POST['coordinador']);
			$date_start=$_POST['date_start'];
			$date_end=$_POST['date_end'];
			$noches=$_POST['noches'];
			$dias=$_POST['dias'];
			$total_rooms=$_POST['total_rooms'];
			$n_int=$_POST['n_int'];
			$total=$_POST['total'];
			$token = bin2hex(openssl_random_pseudo_bytes(128));
			$clave = (!empty($_POST['clave'])) ? $_POST['clave'] : uniqid('CG_');
			$tipo = $_POST['tipo'];
			$now =  date('Y-m-d H:i:s');
			$venc = strtotime($now."+ 30 days");
			$vigencia = date("Y-m-d H:i:s",$venc);
				// echo $vigencia;
				// die();
			$rspta = $cotizacion->storeHosting($idusuario,$empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total_rooms,$n_int,$total,$token,$clave,$tipo,$vigencia,$now);
			if ($rspta) {
				$response=[
					'success'=>true,  
					'msg'=> 'Cotizacion registrada',
					'idcot'=> $rspta
				];
			}else{
				$response=[
					'success'=>false,  
					'msg'=> 'Algo va mal intenta mas tarde'
				];
			}
		}
		echo json_encode($response);
	break;


	// Listar Servicios
	case 'listar-servicios':
		$tipo ='Service';
		$rspta = $cotizacion->listarService($tipo);
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				if ($reg->state==1) {
					$estado= '<p class="label label-primary">Confirmada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" class="btn btn-xs btn-success" onclick="view_ord(\''.$reg->orden.'\')"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'" checked>
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="anular('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==2){
					$estado= '<p class="label label-danger">Anulada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';						
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==3){
					$estado= '<p class="label label-default">Vencida</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning" disabled onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info" disabled onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank" disabled class="disabled btn btn-xs btn-danger" ><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<p class="label label-default">Expiro</p>';
				}else{
					$estado= '<p class="label label-warning">Pendiente</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}
				$data[]=array(

					"0"=>$reg->id,
					"1"=>'C-RM-'.$reg->id,
					"2"=>$reg->usuario,
		 			"3"=>strtoupper($reg->empresa),
		 			"4"=>$reg->correo,
		 			"5"=>number_format($reg->monto,0,'.',','),
		 			"6"=>$dias[date('w', strtotime($reg->fecha_entrada))]." ".date('d', strtotime($reg->fecha_entrada))." de ".$meses[date('n', strtotime($reg->fecha_entrada))-1]. " del ".date('Y', strtotime($reg->fecha_entrada)),
		 			"7"=>$estado,
		 			"8"=>$opciones,
		 			"9"=>$botonOrden,
					"10"=>$onoff
				);
			}
			$results = array(
					"sEcho"=>1, 
					"iTotalRecords"=>count($data), 
					"iTotalDisplayRecords"=>count($data), 
					"aaData"=>$data
				);
			echo json_encode($results);
		}
	break;
	// guardar servicios
	case 'servicios':
		// die(json_encode($_POST));
		if (!isset($_SESSION['iduser']) || empty($_SESSION['iduser'])) {
			$response=['success'=>false,'msg'=>'expired'];
		}else{
			if (!empty($_POST['servicios'])) {
				$idusuario=$_SESSION['iduser'];
				$empresa=limpiarCadena($_POST['empresa']);
				$estado=limpiarCadena($_POST['estado']);
				$municipio=limpiarCadena($_POST['municipio']);
				$email=validarEmail($_POST['email']);
				$telefono=limpiarCadena($_POST['telefono']);
				$coordinador=limpiarCadena($_POST['coordinador']);
				$date_start=$_POST['date_start'];
				$date_end=$_POST['date_end'];
				$dias=$_POST['dias'];
				$n_int=$_POST['n_int'];
				$total=$_POST['total'];
				$token = bin2hex(openssl_random_pseudo_bytes(128));
				$clave = (!empty($_POST['clave'])) ? $_POST['clave'] : uniqid('CG_');
				$tipo = $_POST['tipo'];
				$now =  date('Y-m-d H:i:s');
				$venc = strtotime($now."+ 30 days");
				$vigencia = date("Y-m-d H:i:s",$venc);

				$rspta = $cotizacion->storeServices($idusuario,$empresa,$estado,$municipio,$email,$telefono,$coordinador,$date_start,$date_end,$dias,$n_int,$total,$token,$clave,$tipo,$vigencia,$now, $_POST['servicios']);

				if ($rspta) {
					$response=[
						'success'=>true,  
						'msg'=> 'Cotizacion registrada',
						'idcot'=> $rspta
					];
				}else{
					$response=[
						'success'=>false,  
						'msg'=> 'Algo va mal intenta mas tarde'
					];
				}
			}else{
				$response=[
						'success'=>false,  
						'msg'=> 'No puedes registrar esta cotizacion si no tiene servicios'
					];
			}
		}
		echo json_encode($response);
	break;

	case 'updVencimiento':
		$rspta = $cotizacion->updVencimiento();	
		if ($rspta['success']) {
			$response=[
				'success'=>true,  
				'vencidas'=>$rspta['n_vencidas'],
				'msg'=> 'Cotizaciones vencidas: '.$rspta['n_vencidas']
			];
		}else{
			$response=[
				'success'=>false,  
				'msg'=> 'Algo va mal intenta mas tarde'
			];
		}
		echo json_encode($response);
	break;
	

	//devolver claves y token
	case'jwToken':
		$id=$_POST['id'];
		$rspta=$cotizacion->GetTokens($id);
		if ($rspta) {
			$jwt=$rspta->fetch(PDO::FETCH_OBJ);
			$response = [
				'success'=>true,
				'token'=>$jwt->token,
				'clave'=>$jwt->clave,
				'id'=>$jwt->id
			];
		}else{
			$response = [
				'success'=>false
			];
		}
		echo json_encode($response);
	break;

	// Devuelve los alimentos y servicios de la cotizacion por el ID
	case 'foodCotizacion':
		$id = $_POST['id'];
		$rspta = $cotizacion->foodCotizacion($id);
		if($rspta) {
			$foodTmpl='';
			while ($cot = $rspta->fetchAll(PDO::FETCH_OBJ)) {
				$dias = array();
				foreach ($cot as $f) {
					$dias[] = $f->dia;
				}

				$dias = array_values(array_unique($dias));
				$cont = 0;
				if (count($dias) == 1) {
					
				} else {
					foreach ($cot as $f) :
						
						$dia_actual = $f->dia;
						if ($dia_actual == $dias[$cont]) :
							$foodTmpl .= '<h3>' . $f->dia . '</h3>';
							$cont++;
							if ($cont == count($dias)) {
								$cont = 0;
							}
						endif;
						$Select;
						switch ($f->subcategoria) {
							case 'Desayuno':
							case 'Comida':
							case 'Cena':
									$Select='<select name="place[]" class="form-control">
									<option value="Restaurant Calandria">Restaurant Calandria</option>
									<option value="Restaurant Morillos">Restaurant Morillos</option>
									<option value="Bar Gato Montes">Bar Gato Montes</option>
									<option value="Jardin del Bar">Jardin del Bar</option>
									<option value="Palapa">Palapa</option>
								  </select>';
								break;
							
							case 'Equipo Audiovisual':
							case 'Coffe Break Tradicional':
							case 'Box Lunch':
									$Select='<select name="place[]" class="form-control">
									<option value="Salon Pinos">Salon Pinos</option>
									<option value="Salon Sauces">Salon Sauces</option>
									<option value="Salon Fresnos">Salon Fresnos</option>
									<option value="Casa Club (Medio)">Casa Club (Medio)</option>
									<option value="Casa Club (Completo)">Casa Club (Completo)</option>
								  </select>';
								break;

							case 'Renta de Salon sin Coffe Break':
									$Select='<select name="place[]" class="form-control">
									<option value="Salon Pinos">Salon Pinos</option>
									<option value="Salon Sauces">Salon Sauces</option>
								</select>';								
								break;
							default:
									$Select='';
								break;
						}
						$foodTmpl .= '<div class="pane-service" id="s_'.$f->id.'">';
							$foodTmpl .= '<h5>' . $f->subcategoria . '</h5>';
							$foodTmpl .= '<h5>' . $f->servicio . '</h5>';
							$foodTmpl .= '<h5>Cantidad: ' . $f->cantidad . '</h5>';
							$foodTmpl .= '<div class="col-lg-4">
											<input type="hidden" name="id_servicio[]" value="'.$f->id.'">
											<div class="form-group">
												<label>Lugar:</label>
												'.$Select.'
											</div>
											<div class="form-group">
												<label>Hora:</label>
												<input type="time" name="hour[]" class="form-control" >
											</div>
											<div class="form-group">
												<label>Menu:</label>
												<textarea class="form-control" name="menu[]" placeholder="Describe el Menu" ></textarea>
											</div>
										</div>
										<div class="clearfix"></div>';
							$foodTmpl .= '<h4>Notas:</h4>
								<label for="">Agregar 
								<a href="#" id="btAdd" onclick="addNoteFood(event, \'s_'.$f->id.'\')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
								</label>
								<input type="text" name="note_food['.$f->id.'][]" class="form-control" placeholder="Agregar nota">';
						$foodTmpl .= '</div>';
					endforeach;
				}
			}
			$response = [
				'success'=>true,
				'tmpl'=>$foodTmpl
			];
		} else {
			$response = [
				'success' => false
			];
		}
		echo json_encode($response);
	break;

}



?>