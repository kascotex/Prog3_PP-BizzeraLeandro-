<?php

$_PUT = array();
$_DELETE = array();
$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {

	case "GET":
		echo "request GET  <br>";
		if ($consulta = Set($_GET, "consulta")) {
			require_once("");
			echo " <br>";
			// ConsultasVentas::Consulta($consulta);
		} else {
		//	require_once("");
			echo " <br>";
			// PizzaCarga::Cargar(Set($_GET, "sabor"), Set($_GET, "precio"), Set($_GET, "tipo"), Set($_GET, "cantidad"));
		}
		break;

	case "POST":
		echo "request POST <br>";
		if ($mail = Set($_POST, "mail")) {
			require_once("./");
			echo " <br>";
			// AltaVenta::Alta($mail, Set($_POST, "sabor"), Set($_POST, "tipo"), Set($_POST, "cantidad"), $_FILES);
		} else if ($precio = Set($_POST, "precio")) {
			require_once("./");
			echo " <br>";
			// PizzaCarga::Cargar(Set($_POST, "sabor"), $precio, Set($_POST, "tipo"), Set($_POST, "cantidad"), $_FILES);
		} else {
			require_once("./");
			echo " <br>";
			// echo PizzaConsultar::Consultar(Set($_POST, "sabor"), Set($_POST, "tipo"));
		}
		break;

	case "PUT":
		echo "request PUT <br>";
		parse_str(file_get_contents('php://input'), $_PUT);

		if ($mail = Set($_PUT, "mail")) {
			echo " <br>";
			require_once("./");
			// ModificarVenta::Modificar(Set($_PUT, "numPedido"), $mail, Set($_PUT, "sabor"), Set($_PUT, "tipo"), Set($_PUT, "cantidad"));
		}
		break;

	case "DELETE":
		echo "request DELETE <br>";
        parse_str(file_get_contents('php://input'), $_DELETE);
		break;

	default:
		echo "default <br>";
		break;
}


function Set(array $v, string $nombre)
{
	return isset($v[$nombre]) ? $v[$nombre] : false;
}


//*****************************

$v = array(
    "PizzaCarga",
    "PizzaConsultar"
    );
    
    CrearArchivos($v,".php");
    
    /** Quita la extension del nombre del achivo.
     *
     * @param   string $nombre nombre con extencion. 
     * @return  string extencion.
     */
    function QuitarExt(string $nombre)
    {
        $ext = explode('.', $nombre);
        return count($ext) == 2 ? $ext[0] : false;
    }
    
    function GuardarArchivo(string $ruta)
    {
        $result = false;
        $archivo = null;
        $clase = QuitarExt($ruta);
        $data = "<?php\n
            // require_once('./ ');\n
            class $clase {}";
    
        if ($ruta && ($archivo = fopen($ruta, "w"))) {        
    
            $result = fwrite($archivo, $data);
            fclose($archivo);
        }
        return $result;
    }
    
    function CrearArchivos(array $lista, string $ext = "")
    {
        if ($lista) {
            foreach ($lista as $val) {
                if (is_string($val)) {
                    if ($ext) $val .= $ext;
                    GuardarArchivo($val);
                }
            }
        }
    }

//*****************************
