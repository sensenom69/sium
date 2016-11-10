<?PHP
// CLASS: classPlantilla, classPlantillaSustituciones, classPlantillaSecciones, classPlantillaElementos
// Ultima modificacion: 19/02/2011
// Version: 0.4.1

// CHANGELOG
// v.0.4.1
//  - Incluida la posibilidad de incluir el texto de una plantilla directamente

	class classPlantilla {
		private $archivo_nombre;			// archivo_nombre: nombre del archivo que contiene la plantilla
		private $archivo_leido;				// archivo_leido: contenido del archivo de la plantilla

		private $delimitador_sustitucion;	// delimitador_sustitucion: delimitador del texto de sustitucion
		private $delimitador_seccion;		// delimitador_seccion: delimitador de la seccion a mostrar u ocultar
		private $delimitador_elemento;		// delimitador_elemento: delimitador de un elemento

		private $sustituciones;				// sustituciones: sustituciones de la plantilla
		private $secciones;					// secciones: secciones de la plantilla
		public $elementos;					// elementos: elementos de la plantilla

		//function classPlantilla( $archivo_nombre, $delimitador_sustitucion="##", $delimitador_seccion="<!--!*-->", $delimitador_elemento="<!--\$*-->" ) {
		function __construct( $entrada, $entrada_archivo=TRUE, $delimitador_sustitucion="##", $delimitador_seccion="<!--!*-->", $delimitador_elemento="<!--\$*-->" ) {
			//$this->archivo_nombre 		= is_array($archivo_nombre) ? "" : $archivo_nombre;
			//$this->archivo_leido 			= is_array($archivo_nombre) ? $archivo_nombre : NULL;
			if ($entrada_archivo) {
				$this->archivo_nombre 		= $entrada;
				$this->archivo_leido 		= NULL;
			} else {
				$this->archivo_nombre 		= "";
				$this->archivo_leido 		= $entrada;
			}

			$this->delimitador_sustitucion 	= $delimitador_sustitucion;
			$this->delimitador_seccion 		= $delimitador_seccion;
			$this->delimitador_elemento 	= $delimitador_elemento;

			$this->sustituciones 			= new classPlantillaSustituciones($this->delimitador_sustitucion);
			$this->secciones 				= new classPlantillaSecciones();
			$this->elementos 				= new classPlantillaElementos($this->delimitador_sustitucion);

			if ($this->archivo_leido == NULL) $this->leerArchivo();
			$this->buscarSustituciones();
			$this->buscarSecciones();
			$this->buscarElementos();
		}

		function mostrar($cambios=TRUE) {
			if ($cambios) {
				return $this->realizarCambios();
			} else {
				return $this->archivo_leido;
			}
		}

		function realizarCambios() {
			$copia_texto = $this->archivo_leido;

			// INSERCCION DE LOS ELEMENTOS
			$elementos = $this->elementos->getDetectados();
			if (count($elementos) > 0) {
				list($delim1,$delim2) = explode("*", $this->delimitador_elemento);
				for ($i=0; $i<count($elementos); $i++) {
					$delimitador_ini = $delim1." INI ".$elementos[$i]." ".$delim2;
					$delimitador_fin = $delim1." FIN ".$elementos[$i]." ".$delim2;

					$desgloseAperturas = explode($delimitador_ini, $copia_texto);
					$copia_texto = $desgloseAperturas[0];

					for ($j=1; $j<count($desgloseAperturas); $j++) {
						$desgloseCierres = explode($delimitador_fin, $desgloseAperturas[$j]);
						$copia_texto .= $this->elementos->getDetectadosDeltipo($elementos[$i]);
						$copia_texto .= $desgloseCierres[1];
					}
				}
			}

			// VISIONADO DE LAS SECCIONES
			$secciones = $this->secciones->getDetectadas();
			if (count($secciones) > 0) {
				list($delim1,$delim2) = explode("*", $this->delimitador_seccion);
				for ($i=0; $i<count($secciones); $i++) {
					$delimitador_ini = $delim1." INI ".$secciones[$i]." ".$delim2;
					$delimitador_fin = $delim1." FIN ".$secciones[$i]." ".$delim2;

					$desgloseAperturas = explode($delimitador_ini, $copia_texto);
					$copia_texto = $desgloseAperturas[0];

					for ($j=1; $j<count($desgloseAperturas); $j++) {
						$desgloseCierres = explode($delimitador_fin, $desgloseAperturas[$j]);
						if ($this->secciones->getMostrar($secciones[$i]))
							$copia_texto .= $desgloseCierres[0];
						$copia_texto .= $desgloseCierres[1];
					}
				}
			}

			// CAMBIOS EN LAS SUSTITUCIONES
			$sustituciones = $this->sustituciones->getDetectadas();
			if (count($sustituciones) > 0) {
				$sustitucionesTratadas = array();
				foreach ($sustituciones as $posicion => $texto)
					$sustitucionesTratadas[$posicion] = $this->delimitador_sustitucion.$texto.$this->delimitador_sustitucion;
				$copia_texto = str_replace($sustitucionesTratadas, $this->sustituciones->getSustituciones(), $copia_texto);
			}

			return $copia_texto;
		}

		function cambiosARealizar($sustituciones=array(), $sustituciones_cambios=array(), $secciones=array(), $secciones_mostrar=array()) {
			if (count($sustituciones) != count($sustituciones_cambios) OR count($secciones) != count($secciones_mostrar))
				die("ERROR: los parametros de entrada deben ser arrays y tener la misma longitud");

			for ($i=0; $i<count($sustituciones); $i++)
				$this->cambioSustitucion($sustituciones[$i], $sustituciones_cambios[$i]);

			for ($i=0; $i<count($secciones); $i++)
				$this->cambioSeccion($secciones[$i], $secciones_mostrar[$i]);
		}

		function cambioSustitucion($sustitucion, $cambio) {
			$this->sustituciones->edit($sustitucion, $cambio);
		}

		function cambioSeccion($seccion, $mostrar) {
			$this->secciones->edit($seccion, $mostrar);
		}

		function insertarElemento($elemento, $sustituciones=array(), $sustituciones_cambios=array()) {
			$this->elementos->crear($elemento, $sustituciones, $sustituciones_cambios);
		}
        
        function insertarElementoTodas($elemento,$objecte,$afegits){
            $parametros = $objecte->get();
            $sustituciones = array();
            $sustituciones_cambios=array();
            $parametros = array_merge($parametros,$afegits);
            foreach($parametros AS $key=>$value){
                $sustituciones[] = $key;
                $sustituciones_cambios[] = (stripos($key,'fecha') !== FALSE)? date("d-m-Y",$value):$value;
                    
            }
            $this->elementos->crear($elemento, $sustituciones, $sustituciones_cambios);
        }
        
        function insertarElementoTodasSustituciones($elemento,$objecte,$afegits,$exclosos=""){
            $parametros = $objecte->get();
            $sustituciones = array();
            $sustituciones_cambios=array();
            $parametros = array_merge($parametros,$afegits);
            if($exclosos!=""){
                foreach($parametros AS $key=>$value){
                    if(in_array($key,$exclosos) && $key!="id")
                        unset($parametros[$key]);
                }
            }
            foreach($parametros AS $key=>$value){
                //OJOOOOOOOOOOOOOOOOO
                if(strpos($key,"id_")!==FALSE AND in_array(substr($key,3),$parametros)){
                    //$relacio = new Modelo(substr($key,3),array("id_local"=>$_SESSION["id_local"],"id"=>$value));
                    $key = substr($key,3);
                }
                
                $sustituciones[] = $key;
                if(stripos($key,'fecha') !== FALSE){
                    $sustituciones_cambios[] = date("d-m-Y",$value);
                }elseif(($key=='avisado' OR $key=='no-20-asistira') && $value==1){
                    $sustituciones_cambios[] = 'checked';
                }else{
                    $sustituciones_cambios[] = $value;
                }
                
                    
            }
            $this->elementos->crear($elemento, $sustituciones, $sustituciones_cambios);
        }
        
        function getSustituciones(){
            return $this->sustituciones->getDetectadas();
        }
        
        function cambioSustitucionTodas($sustitucions=array(),$valor=""){
            
            foreach($this->sustituciones->getDetectadas() AS $key=>$val){
                
                if(stripos($val,'fecha') !== FALSE){
                    $this->cambioSustitucion($val,(isset($sustitucions[$val])?  date("d-m-Y",$sustitucions[$val]):$valor));   
                }elseif((stripos($val,'avisado') !== FALSE) || (stripos($val,'no-20-asistira') !== FALSE)){
                    $this->cambioSustitucion($val,(isset($sustitucions[$val])?  ($sustitucions[$val]==1?"checked":""):$valor));   
                }
                else{
                    $this->cambioSustitucion($val,(isset($sustitucions[$val])? $sustitucions[$val]:$valor));   
                }
            }
        }
        
        function paginar($desde, $hasta, $por_pagina,$total_pagina){
            $pagina = floor($desde/$por_pagina)+1;
            $this->cambioSustitucion('num_pag',$pagina);
            $total_paginas = floor($total_pagina/$por_pagina)==0? "1":(floor($total_pagina/$por_pagina)+($total_pagina%$por_pagina!=0? 1:0));
            $this->cambioSustitucion('total_pagines',$total_paginas);
            if($pagina==$total_paginas)
                $this->cambioSustitucion("proxima_pagina","");
            else
                $this->cambioSustitucion("proxima_pagina","onclick");
            $this->cambioSustitucion('desde_arrere',(($desde-$por_pagina<=0)?'0':$desde-$por_pagina));
            $this->cambioSustitucion('hasta_arrere',(($desde-$por_pagina<=0)?$por_pagina:$desde-1));
            $this->cambioSustitucion('desde_avant',($hasta+1<=$total_pagina)?$hasta:$desde);
            $this->cambioSustitucion('hasta_avant',($hasta+1<=$total_pagina)?$hasta+$por_pagina:$hasta);
            $this->cambioSustitucion('pagina',($hasta-$por_pagina<=0)?0:$hasta-$por_pagina);
            
            
        }

		private function leerArchivo() {
			$this->archivo_leido = file_get_contents($this->archivo_nombre);
		}

		private function buscarSustituciones() {
			/* EJEMPLO DE SUSTITUCION:
			   BLA BLA ##prueba1## BLA BLA BLA BLA BLA ##otraprueba## BLA BLA BLA
			*/

			// CONTAR VECES QUE APARECE EL $delimitador_sustitucion PARA CONTABILIZAR SUSTITUCIONES POSIBLES
			$numApariciones = substr_count($this->archivo_leido, $this->delimitador_sustitucion);
			$numPosiblesSustituciones = floor($numApariciones/2);
			$posiblesFallos = (floor($numApariciones/2) == $numApariciones/2) ? FALSE : TRUE;

			// DETECTAR TEXTO DE LAS POSIBLES SUSTITUCIONES
			if ($posiblesFallos) {
				die("ERROR: el delimitador (".$this->delimitador_sustitucion.") usado para las sustituciones es incompatible con la plantilla actual");
			} else {
				$desglose = explode($this->delimitador_sustitucion, $this->archivo_leido);
				for ($i=0; $i<$numPosiblesSustituciones; $i++)
					$this->sustituciones->add($desglose[2*$i+1]);
			}
		}

		private function buscarSecciones() {
			/* EJEMPLO DE SECCION:
			   <!--! INI PRUEBA -->
			   BLA BLA BLA BLA BLA
			   BLA BLA BLA BLA BLA
			   BLA BLA BLA BLA BLA
			   <!--! FIN PRUEBA -->
			*/

			list($delim1,$delim2) = explode("*", $this->delimitador_seccion);
			$desglose = explode($delim1, $this->archivo_leido);
			for ($i=1; $i<count($desglose); $i++) { // desglose[0] nunca contendra una seccion
				$contenidoSeccion = trim($desglose[$i]);
				$inifin = substr($contenidoSeccion, 0, 3);
				$resto = trim(substr($contenidoSeccion, 3));

				list($etiqueta, $contenido) = explode($delim2, $resto, 2);
				$etiqueta = trim($etiqueta);
				$contenido = trim($contenido);

				if ($inifin == "INI") {
					$this->secciones->add($etiqueta);
				} elseif ($inifin == "FIN") {
					$this->secciones->cerrar($etiqueta);
				} else {
					die("ERROR: sintaxis incorrecta en secciones");
				}
			}

			if (!$this->secciones->validar())
				die("ERROR: sintaxis incorrecta en secciones");
		}

		private function buscarElementos() {
			/* EJEMPLO DE ELEMENTO:
			   <!--$ INI opcMenu --><p><a href="##link##">##texto##</a></p><!--$ FIN opcMenu -->
			*/

			list($delim1,$delim2) = explode("*", $this->delimitador_elemento);
			$desglose = explode($delim1, $this->archivo_leido);
			for ($i=1; $i<count($desglose); $i++) { // desglose[0] nunca contendra un elemento
				$contenidoElemento = trim($desglose[$i]);
				$inifin = substr($contenidoElemento, 0, 3);
				$resto = trim(substr($contenidoElemento, 3));

				list($etiqueta, $contenido) = explode($delim2, $resto, 2);
				$etiqueta = trim($etiqueta);
				$contenido = trim($contenido);

				if ($inifin == "INI") {
					$this->elementos->add($etiqueta, $contenido);
				} elseif ($inifin == "FIN") {
					$this->elementos->cerrar($etiqueta);
				} else {
					die("ERROR: sintaxis incorrecta en elementos");
				}
			}

			if (!$this->secciones->validar())
				die("ERROR: sintaxis incorrecta en elementos");
		}
        
	}

	class classPlantillaSustituciones {
		private $detectadas;				// detectadas: texto de las posibles sustituciones
		private $sustituciones;				// sustituciones: cambio a realizar en sustitucion
		private $apariciones;				// apariciones: veces que aparecen las sustituciones detectadas
		private $delimitador_sustitucion;	// delimitador: delimita las sustituciones

		function __construct($delimitador_sustitucion) {
			$this->detectadas 				= array();
			$this->sustituciones 			= array();
			$this->apariciones 				= array();
			$this->delimitador_sustitucion 	= $delimitador_sustitucion;
		}

		function add($objeto) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE) {
				$this->apariciones[$posicion]++;
			} else {
				$posicion = count($this->detectadas);

				$this->detectadas[$posicion] 	= $objeto;
				$this->sustituciones[$posicion] = $this->delimitador_sustitucion.$objeto.$this->delimitador_sustitucion;
				$this->apariciones[$posicion] 	= 1;
			}
		}

		function edit($objeto, $sustitucion) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE)
				$this->sustituciones[$posicion] = $sustitucion;
		}

		private function existe($objeto) {
			for ($i=0; $i<count($this->detectadas); $i++)
				if ($this->detectadas[$i] == $objeto)
					return $i;

			return FALSE;
		}

		function getApariciones() {
			return $this->apariciones;
		}

		function getDetectadas() {
			return $this->detectadas;
		}

		function getSustituciones() {
			return $this->sustituciones;
		}
	}

	class classPlantillaSecciones {
		private $detectadas;	// detectadas: secciones detectadas
		private $mostrar;		// mostrar: mostrar o no las secciones
		private $apariciones;	// apariciones: veces que aparecen las secciones
		private $cerradas;		// cerradas: veces que se ha cerrado cada seccion

		function __construct() {
			$this->detectadas 	= array();
			$this->mostrar 		= array();
			$this->apariciones 	= array();
			$this->cerradas 	= array();
		}

		function add($objeto) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE) {
				$this->apariciones[$posicion]++;
			} else {
				$posicion = count($this->detectadas);

				$this->detectadas[$posicion] 	= $objeto;
				$this->mostrar[$posicion] 		= FALSE;
				$this->apariciones[$posicion] 	= 1;
				$this->cerradas[$posicion] 		= 0;
			}
		}

		function edit($objeto, $visionado) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE)
				$this->mostrar[$posicion] = $visionado;
		}

		function cerrar($objeto) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE)
				$this->cerradas[$posicion]++;
		}

		private function existe($objeto) {
			for ($i=0; $i<count($this->detectadas); $i++)
				if ($this->detectadas[$i] == $objeto)
					return $i;

			return FALSE;
		}

		function getApariciones() {
			return $this->apariciones;
		}

		function getDetectadas() {
			return $this->detectadas;
		}

		function getMostrar($objeto) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE)
				return $this->mostrar[$posicion];

			return FALSE;
		}

		function validar() {
			for ($i=0; $i<count($this->detectadas); $i++)
				if ($this->apariciones[$i] != $this->cerradas[$i])
					return FALSE;

			return TRUE;
		}
	}

	class classPlantillaElementos {
		private $detectados;				// detectados: secciones detectadas
		private $contenidos;				// contenidos: contenido de las secciones
		private $apariciones;				// apariciones: veces que aparecen los elementos (en teoria solo 1 vez)
		private $cerrados;					// cerrados: veces que se ha cerrado cada elemento
		private $creados_tipo;				// creados_tipo: tipo del elemento creado
		private $creados_sustituciones;		// creados_sustituciones: sustituciones del elemento
		private $creados_cambios;			// creados_cambios: cambios de las sustituciones del elemento
		private $delimitador_sustitucion;	// delimitador: delimita las sustituciones

		function __construct($delimitador_sustitucion) {
			$this->detectados 				= array();
			$this->contenidos 				= array();
			$this->apariciones 				= array();
			$this->cerrados 				= array();
			$this->creados_tipo 			= array();
			$this->creados_sustituciones 	= array();
			$this->creados_cambios 			= array();
			$this->delimitador_sustitucion 	= $delimitador_sustitucion;
		}

		function add($objeto, $contenido) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE) {
				$this->apariciones[$posicion]++;
			} else {
				$posicion = count($this->detectados);

				$this->detectados[$posicion] 	= $objeto;
				$this->contenidos[$posicion] 	= $contenido;
				$this->apariciones[$posicion] 	= 1;
				$this->cerrados[$posicion] 		= 0;
			}
		}

		function crear($tipo, $sustituciones=array(), $cambios=array()) {
			$posicion = $this->existe($tipo);
			if ($posicion !== FALSE) {
				$posicion = count($this->creados_tipo);
				$this->creados_tipo[$posicion] 			= $tipo;
				$this->creados_sustituciones[$posicion] = $sustituciones;
				$this->creados_cambios[$posicion] 		= $cambios;
			}
		}

		function cerrar($objeto) {
			$posicion = $this->existe($objeto);
			if ($posicion !== FALSE)
				$this->cerrados[$posicion]++;
		}

		private function existe($objeto) {
			for ($i=0; $i<count($this->detectados); $i++)
				if ($this->detectados[$i] == $objeto)
					return $i;

			return FALSE;
		}

		function getApariciones() {
			return $this->apariciones;
		}

		function getDetectados() {
			return $this->detectados;
		}

		function getDetectadosDeltipo($tipo) {
			$retorno = "";

			$posicion = $this->existe($tipo);
			if ($posicion !== FALSE)
				for ($i=0; $i<count($this->creados_tipo); $i++)
					if ($this->creados_tipo[$i] == $tipo) {
						$sustituciones = array();
						foreach ($this->creados_sustituciones[$i] as $posicion_array => $texto)
							$sustituciones[$posicion_array] = $this->delimitador_sustitucion.$texto.$this->delimitador_sustitucion;
						$retorno .= str_replace($sustituciones, $this->creados_cambios[$i], $this->contenidos[$posicion]);
					}

			return $retorno;
		}

		function validar() {
			for ($i=0; $i<count($this->detectados); $i++)
				if ($this->apariciones[$i] != $this->cerrados[$i])
					return FALSE;

			return TRUE;
		}
	}
?>