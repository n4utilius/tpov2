<?php

/*
INAI / USUARIOS
*/

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Logo extends CI_Controller
{
     // Constructor que manda llamar la funcion is_logged_in
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
    }

    // Funcion para revisar inicio de session 
    function is_logged_in() 
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('tpoadminv1/cms');
        }
    }
    
    // Funcion para cerrar session
    function logout() 
    {
        $this->session->sess_destroy();
        $this->session->sess_create();
        redirect('/');
    }
    
    
    function permiso_administrador()
    {
        //Revisamos que el usuario sea administrador
        if($this->session->userdata('usuario_rol') != '1')
        {
            redirect('tpoadminv1/securecms/sin_permiso');
        }
    }

    /**
     * Redirect with POST data.
     *
     * @param string $url URL.
     * @param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
     * @param array $headers Optional. Extra headers to send.
     */
    private function redirect_post($url, array $data, array $headers = null) {
        $params = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        if (!is_null($headers)) {
            $params['http']['header'] = '';
            foreach ($headers as $k => $v) {
                $params['http']['header'] .= "$k: $v\n";
            }
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if ($fp) {
            echo @stream_get_contents($fp);
            die();
        } else {
            // Error
            throw new Exception("Error loading '$url', $php_errormsg");
        }
    }

    function entrar_pnt(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/generaToken/";
        $data = array(
            "usuario" => $_POST["user"], 
            "password" => $_POST["password"] 
        );



        $options = array(
            'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
            )
        );

        $response = json_encode($data);

        header('Content-Type: application/json');
        echo  $response; 

        $context  = stream_context_create( $options );
        $result = file_get_contents( $URL, false, $context );
        //$result = json_decode($result, true);

        
        /*
        if( $result["success"] ){
            $_SESSION["user_pnt"] = $data["usuario"];
            $_SESSION["pnt"] = $result;

            $stm  = "SELECT nombre_sujeto_obligado, nombre_unidad_administrativa 
                FROM unidades_so WHERE correo_unidad_administrativa = '" . $data["usuario"] . "'";
            $query = $this->db->query($stm);

            $_SESSION["sujeto_obligado"] = $query->row()->nombre_sujeto_obligado;
            $_SESSION["unidad_administrativa"] = $query->row()->nombre_unidad_administrativa;
        
         }

        $response = json_encode($result);

        header('Content-Type: application/json');
        echo  $response; 
        */

    }

    function modificar_sujeto(){
        $_SESSION["unidad_administrativa"] = $_POST["unidad_administrativa"];
        $_SESSION["sujeto_obligado"] = $_POST["sujeto_obligado"];
        $query = false;
        
        $this->db->select('nombre_sujeto_obligado');
        $this->db->from('unidades_so');
        $this->db->where('correo_unidad_administrativa', $_SESSION["user_pnt"] );
        $q1 = $this->db->get();



        if ( $q1->num_rows() > 0 ){
            $stm  = "UPDATE unidades_so SET nombre_sujeto_obligado = '" . $_POST["sujeto_obligado"] . "', " .
                    "nombre_unidad_administrativa  = '" . $_POST["unidad_administrativa"] . "' " . 
                    "WHERE correo_unidad_administrativa = '" . $_SESSION["user_pnt"] . "'";
            
            $query = $this->db->query($stm);

        }else{
            $post_data = array(); 
            $post_data['nombre_sujeto_obligado'] =  $_POST["sujeto_obligado"];
            $post_data['nombre_unidad_administrativa'] =  $_POST["unidad_administrativa"];
            $post_data['correo_unidad_administrativa'] =  $_SESSION["user_pnt"];

            $this->db->insert('unidades_so', $post_data);
            $query =  $this->db->insert_id();
        }

        header('Content-Type: application/json');
        echo json_encode($query);
    }

    function salir_pnt(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/generaToken/";
        $data = array('usuario' => '', 'password' => '' );

        $options = array(
            'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
            )
        );
 
        $context  = stream_context_create( $options );
        $result = file_get_contents( $URL, false, $context );
        $result = json_decode($result, true);

        // Set session variables
        unset( $_SESSION["user_pnt"]);
        unset( $_SESSION["pnt"]);
        unset( $_SESSION["unidad_administrativa"]);
        unset( $_SESSION["sujeto_obligado"]);

        header('Content-Type: application/json');
        echo json_encode($result);

    }


    function agregar_pnt(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/mantenimiento/agrega";
        
        $data = array(
            'idFormato' => $_POST["idFormato"], 
            'token' => $_POST["token"], 
            'correoUnidadAdministrativa' => $_POST["correoUnidadAdministrativa"], 
            'unidadAdministrativa' => $_POST["unidadAdministrativa"], 
            'SujetoObligado' => $_POST["SujetoObligado"], 
            'registros' => $_POST["registros"]
        );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n"
            )
        );

        $context  = stream_context_create( $options );
        $res = file_get_contents( $URL, false, $context );
        $result = json_decode( $res, true );

        if( $result["success"] ){
            $pntid = $result["mensaje"]["registros"][0]["idRegistro"]; 

            $table = "rel_pnt_presupuesto";
            $nombre_id_interno = "id_presupuesto";

            switch ($_POST["idFormato"]) {
                case 43322:
                    $table = "rel_pnt_presupuesto";
                    $nombre_id_interno = "id_presupuesto";
                    break;
                case 43320:
                    $table = "rel_pnt_factura";
                    $nombre_id_interno = "id_factura";
                    break;
            }

            $post_data = array();
            $post_data[ $nombre_id_interno ] = $_POST["_id_interno"];
            $post_data['id_pnt'] = $pntid;
            $post_data['estatus_pnt'] ='SUBIDO';

            $this->db->insert($table, $post_data);
            $result['id_tpo'] =  $this->db->insert_id();
            $result['id_pnt'] =   $pntid;

        }
        
        $response = json_encode($result);
        header('Content-Type: application/json');
        echo  $response; 
    }


    function eliminar_pnt(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/mantenimiento/elimina";
        $data = array( 
            "idFormato" => $_POST["idFormato"],
            "correoUnidadAdministrativa" => $_POST["correoUnidadAdministrativa"],  
            "token" => $_POST["token"],  
            "registros" => $_POST["registros"]
        );
        
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n"
            )
        );

        $context  = stream_context_create( $options );
        $res = file_get_contents( $URL, false, $context );
        $result = json_decode( $res, true );

         switch ($_POST["idFormato"]) {
            case 43322:
                $table = "rel_pnt_presupuesto";
                break;
            case 43320:
                $table = "rel_pnt_factura";
                break;
        }

        if( $result["success"] ){
            $stm  = "DELETE FROM " . $table . " WHERE id_pnt = '" . $_POST["id_pnt"] . "'";
            $this->db->query($stm);                                                                                                                              
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        
    }


    function traer_formatos(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/informacionFormato/obtenerFormatos";
        $request = array( "token" => strval($_SESSION['pnt']->token->token) );

        // Al parecer no necesita "concentradora" ni "codigoSO" 
        //$request = array("token" => strval($_SESSION['pnt']->token->token), "concentradora" => 2, "codigoSO" => "INAI" );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($request),
                'header'=>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($URL, false, $context);

        //session_start();

        $data["formatos"] = json_decode($result);

        header('Content-Type: application/json');
        echo json_encode( $data["formatos"] ); 

        //$this->load->view('/tpoadminv1/logo/ver_formatos', $data);

    }

    function panel_pnt(){
        $this->load->view('/tpoadminv1/logo/panel_pnt');
    }

    function traer_campos(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/informacionFormato/camposFormato";

        $idFormato = ( isset($_GET["idFormato"]) )? $_GET["idFormato"] : 22532; /* Quitar valor de prueba*/

        $request = array("token" => strval($_SESSION['pnt']->token->token), "idFormato" => $idFormato );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($request),
                'header'=>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($URL, false, $context);

        //session_start();

        $data["formatos"] = json_decode($result);

        header('Content-Type: application/json');
        echo json_encode( $data["formatos"] ); 
    }

    /**/
    function traer_campo(){
        $URL = "http://devcarga.inai.org.mx:8080/sipot-web/spring/informacionFormato/campoCatalogo";

        $idCampo = ( isset($_GET["idCampo"]) )? $_GET["idCampo"] : 10658; /* Quitar valor de prueba*/

        $request = array("token" => strval($_SESSION['pnt']->token->token), "idCampo" => $idCampo );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($request),
                'header'=>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($URL, false, $context);

        //session_start();

        $data["formatos"] = json_decode($result);

        header('Content-Type: application/json');
        echo json_encode( $data["formatos"] ); 
    }


    function registros(){ 
        $query = $this->db->query("SELECT IFNULL(pnt.id_tpo, 'N/D'), pnt.id_pnt, p.id_presupuesto, e.ejercicio, p.fecha_inicio_periodo,
            p.fecha_termino_periodo, p.denominacion, p.fecha_publicacion, p.file_programa_anual,
            p.area_responsable, p.fecha_validacion, p.fecha_actualizacion, p.nota, pnt.estatus_pnt
            FROM tab_presupuestos p
            JOIN cat_ejercicios e ON p.id_ejercicio = e.id_ejercicio
            LEFT JOIN rel_pnt_presupuesto pnt ON p.id_presupuesto = pnt.id_presupuesto");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function registros2(){
        $query = $this->db->query("
                SELECT pnt.id_tpo 'ID TPO', pnt.id_pnt 'ID PNT', f.id_factura 'ID FACTURA', e.ejercicio 'Ejercicio',
                    CONCAT(CASE 
                        WHEN f.id_trimestre = 1 THEN '01/01/'
                        WHEN f.id_trimestre = 2 THEN '01/04/'
                        WHEN f.id_trimestre = 3 THEN '01/07/'
                        WHEN f.id_trimestre = 4 THEN '01/10/'
                    END, e.ejercicio ) 'Fecha de inicio del periodo que se informa', 
                    CONCAT(CASE 
                        WHEN f.id_trimestre = 1 THEN '31/03/'
                        WHEN f.id_trimestre = 2 THEN '30/06/'
                        WHEN f.id_trimestre = 3 THEN '30/09/'
                        WHEN f.id_trimestre = 4 THEN '31/12/'
                    END, e.ejercicio ) 'Fecha de término del periodo que se informa', 
                    (CASE 
                        WHEN ( (fd.id_so_contratante IS NOT NULL) && (fd.id_so_solicitante IS NOT NULL) ) THEN 2
                        WHEN ( (fd.id_so_contratante IS NOT NULL) && (fd.id_so_solicitante IS NULL) ) THEN 0
                        WHEN ( (fd.id_so_contratante IS NULL) && (fd.id_so_solicitante IS NOT NULL) ) THEN 1
                    END) 'Función del Sujeto Obligado (catálogo)',
                    fd.area_administrativa 'Área administrativa Encargada de Solicitar El Servicio o Producto, en su caso',
                    fd.id_servicio_clasificacion 'Clasificación Del(los) Servicios (catálogo)', 
                    scat.nombre_servicio_categoria 'Tipo de Servicio', sscat.nombre_servicio_subcategoria 'Tipo de Medio (catálogo)',
                    suni.nombre_servicio_unidad 'Descripción de Unidad',
                    (CASE 
                        WHEN cam.id_campana_tipo = 1 THEN 1
                        WHEN cam.id_campana_tipo = 2 THEN 0
                    END) 'Tipo (catálogo)',
                    cam.nombre_campana_aviso 'Nombre de la Campaña o Aviso Institucional',  
                    cam.periodo 'Año de la Campaña', ctem.nombre_campana_tema 'Tema de la Campaña o Aviso Institucional', 
                    cobj.campana_objetivo 'Objetivo Institucional' , cam.objetivo_comunicacion 'Objetivo de Comunicación', 
                    fd.precio_unitarios 'Costo por unidad',cam.clave_campana 'Clave Única de Indentificación de Campaña', 
                    cam.autoridad 'Autoridad que proporcionó la Clave', 
                    (CASE 
                        WHEN ccob.id_campana_cobertura = 1 THEN 3
                        WHEN ccob.id_campana_cobertura = 2 THEN 2
                        WHEN ccob.id_campana_cobertura = 3 THEN 1
                        WHEN ccob.id_campana_cobertura = 4 THEN 0
                    END) 'Cobertura (catálogo)', 
                    cam.campana_ambito_geo 'Ámbito Geográfico de Cobertura', 
                    cam.fecha_inicio 'Fecha de inicio de la Campaña o Aviso Institucional', 
                    cam.fecha_termino 'Fecha de término de la Campaña o Aviso Institucional', 
                    (CASE 
                        WHEN sexo.poblacion_sexo = 1 THEN 1
                        WHEN sexo.poblacion_sexo = 2 THEN 0
                        WHEN sexo.poblacion_sexo = 3 THEN 2
                    END) 'Sexo (catálogo)', 
                    lugar.poblaciones 'Lugar de Residencia', edu.nivel_educativo 'Nivel Educativo', edad.rangos_edad 'Grupos de Edad', 
                    neco.poblacion_nivel 'Nivel Socioeconómico',
                    CONCAT(f.id_ejercicio, '-', f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor) 'Respecto a los proveedores y su contratación', 
                    CONCAT(f.id_ejercicio, '-', f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor) 'Respecto a los recursos y presupuesto', 
                    CONCAT(f.id_ejercicio, '-', f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor) 'Respecto al Contrato y los Montos', 
                    f.area_responsable 'Área(s) Responsable(s) que generan(n) posee(n), Publica(n) y Actualiza(n) la información',
                    f.fecha_validacion 'Fecha de Validación', f.fecha_actualizacion 'Fecha de Actualización', f.nota 'Nota', 
                    pnt.estatus_pnt 'Estatus PNT'
                FROM tab_facturas f
                JOIN tab_facturas_desglose fd ON fd.id_factura = f.id_factura
                JOIN tab_campana_aviso cam ON cam.id_campana_aviso = fd.id_campana_aviso
                JOIN cat_servicios_clasificacion scla ON scla.id_servicio_clasificacion = fd.id_servicio_clasificacion
                JOIN cat_servicios_categorias scat ON scat.id_servicio_categoria = fd.id_servicio_categoria 
                JOIN cat_servicios_subcategorias sscat ON sscat.id_servicio_subcategoria = fd.id_servicio_subcategoria 
                JOIN cat_servicios_unidades suni ON suni.id_servicio_unidad = fd.id_servicio_unidad 
                JOIN cat_campana_coberturas ccob ON ccob.id_campana_cobertura = cam.id_campana_cobertura
                JOIN cat_ejercicios e ON e.id_ejercicio = cam.id_ejercicio 
                JOIN cat_campana_temas ctem ON ctem.id_campana_tema = cam.id_campana_tema 
                JOIN cat_campana_objetivos cobj ON cobj.id_campana_objetivo = cam.id_campana_objetivo 
                LEFT JOIN (SELECT reda.id_campana_aviso, GROUP_CONCAT(eda.nombre_poblacion_grupo_edad) rangos_edad
                    FROM rel_campana_grupo_edad reda
                    JOIN cat_poblacion_grupo_edad eda ON eda.id_poblacion_grupo_edad = reda.id_poblacion_grupo_edad
                    GROUP BY reda.id_campana_aviso
                ) edad ON edad.id_campana_aviso = cam.id_campana_aviso
                LEFT JOIN (SELECT rsex.id_campana_aviso, GROUP_CONCAT(sex.id_poblacion_sexo) poblacion_sexo
                    FROM rel_campana_sexo rsex
                    JOIN cat_poblacion_sexo sex ON sex.id_poblacion_sexo = rsex.id_poblacion_sexo
                    GROUP BY rsex.id_campana_aviso
                ) sexo ON sexo.id_campana_aviso = cam.id_campana_aviso 
                LEFT JOIN rel_campana_sexo rsex ON rsex.id_campana_aviso = cam.id_campana_aviso 
                LEFT JOIN ( SELECT id_campana_aviso, GROUP_CONCAT(poblacion_lugar) poblaciones 
                    FROM rel_campana_lugar GROUP BY id_campana_aviso) lugar ON lugar.id_campana_aviso = cam.id_campana_aviso
                LEFT JOIN (SELECT cne.id_campana_aviso, GROUP_CONCAT(ne.nombre_poblacion_nivel_educativo) nivel_educativo 
                    FROM rel_campana_nivel_educativo cne
                    JOIN cat_poblacion_nivel_educativo ne ON ne.id_poblacion_nivel_educativo = cne.id_poblacion_nivel_educativo
                    GROUP BY cne.id_campana_aviso) edu ON edu.id_campana_aviso = cam.id_campana_aviso
                LEFT JOIN (SELECT cn.id_campana_aviso, GROUP_CONCAT(pn.nombre_poblacion_nivel) poblacion_nivel 
                    FROM rel_campana_nivel cn
                    JOIN cat_poblacion_nivel pn ON pn.id_poblacion_nivel = cn.id_poblacion_nivel
                    GROUP BY cn.id_campana_aviso) neco ON neco.id_campana_aviso = cam.id_campana_aviso
                LEFT JOIN rel_pnt_factura pnt ON pnt.id_factura = f.id_factura
                ORDER BY pnt.id_pnt");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function registros21(){
        $query = $this->db->query("SELECT pnt.id_tpo, pnt.id_proveedor id, pnt.id_pnt, 
                    con.descripcion_justificacion, e.ejercicio, proc.nombre_procedimiento, 
                    con.fundamento_juridico, prov.nombre_razon_social, prov.nombres, prov.primer_apellido,
                    prov.segundo_apellido, prov.nombre_comercial, prov.rfc, pnt.estatus_pnt
                    FROM tab_facturas f
                    JOIN tab_facturas_desglose fd ON fd.id_factura = f.id_factura
                    JOIN tab_campana_aviso cam ON cam.id_campana_aviso = fd.id_campana_aviso
                    JOIN cat_ejercicios e ON e.id_ejercicio = cam.id_ejercicio 
                    JOIN tab_proveedores prov ON prov.id_proveedor = f.id_proveedor
                    LEFT JOIN tab_contratos con ON con.id_proveedor = prov.id_proveedor
                    LEFT JOIN cat_procedimientos proc ON proc.id_procedimiento = con.id_procedimiento
                    LEFT JOIN rel_pnt_proveedor pnt ON pnt.id_proveedor = prov.id_proveedor;");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function registros22(){
        $query = $this->db->query("SELECT pnt.id_presupuesto_desglose id_tpo, pnt.id_pnt, pnt.id,
                    ej.ejercicio, pcon.partida 'Partida Genérica',  pcon.concepto 'Clave del concepto',
                    pcon.nombre_concepto 'Nombre del concepto',
                    total.presupuesto 'Presupuesto Asignado por concepto',
                    total.modificado 'Presupuesto Modificado por concepto',
                    pcon.denominacion_partida 'Denominacion de cada partida',
                    pdes.monto_presupuesto 'Presupuesto total asignado a cada partida',
                    pdes.monto_modificacion 'Presupuesto modificado por partida',
                    fact.total_ejercido 'Presupuesto ejercido al periodo reportado de cada partida', 
                    pnt.estatus_pnt
                    FROM tab_presupuestos_desglose pdes 
                    JOIN tab_presupuestos pre ON pre.id_presupuesto = pdes.id_presupuesto
                    JOIN cat_ejercicios ej ON ej.id_ejercicio = pre.id_ejercicio
                    JOIN (SELECT p.id_presupesto_concepto, c.concepto, c.denominacion 'nombre_concepto', 
                               p.partida, p.denominacion 'denominacion_partida'
                          FROM (SELECT id_presupesto_concepto, concepto, partida, denominacion FROM cat_presupuesto_conceptos pc
                              WHERE trim(coalesce(concepto, '')) <> '' AND trim(coalesce(partida, '')) <> '' ) p 
                          JOIN (SELECT concepto, denominacion FROM cat_presupuesto_conceptos
                              WHERE trim(coalesce(concepto, '')) <>'' AND trim(coalesce(partida, '')) = '') c
                          ON c.concepto = p.concepto) pcon 
                    ON pcon.id_presupesto_concepto = pdes.id_presupuesto_concepto
                    JOIN (
                        ( SELECT pcon.id_presupesto_concepto, pcon.concepto, 
                                  SUM(pdes.monto_presupuesto) presupuesto, SUM(pdes.monto_modificacion) modificado
                           FROM tab_presupuestos_desglose pdes
                           JOIN (SELECT id_presupesto_concepto, p.concepto
                                 FROM (SELECT id_presupesto_concepto, concepto FROM cat_presupuesto_conceptos pc
                                     WHERE trim(coalesce(concepto, '')) <> '' AND trim(coalesce(partida, '')) <> '' ) p 
                                 JOIN (SELECT concepto FROM cat_presupuesto_conceptos
                                     WHERE trim(coalesce(concepto, '')) <>'' AND trim(coalesce(partida, '')) = '') c
                                 ON c.concepto = p.concepto) pcon 
                           ON pcon.id_presupesto_concepto = pdes.id_presupuesto_concepto
                           GROUP BY pcon.concepto, pcon.id_presupesto_concepto)
                    ) total ON total.id_presupesto_concepto = pdes.id_presupuesto_concepto
                    LEFT JOIN (SELECT numero_partida, SUM(cantidad) total_ejercido 
                               FROM tab_facturas_desglose GROUP BY numero_partida) fact 
                         ON fact.numero_partida = pcon.partida 
                    LEFT JOIN rel_pnt_presupuesto_desglose pnt ON pnt.id_presupuesto_desglose = pdes.id_presupuesto_desglose");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function registros23(){
        $query = $this->db->query("SELECT pnt.id_contrato id_tpo, pnt.id_pnt id_pnt, pnt.id,
            ej.ejercicio, cont.fecha_celebracion 'Fecha de firma del contrato',
            cont.numero_contrato 'Número o referencia de identificación del contrato',
            cont.objeto_contrato 'Objeto del contrato',
            vcon.`Archivo contrato en PDF (Vinculo al archivo)` 'Hipervínculo al contrato firmado',
            vcmod.`Archivo convenio en PDF (Vinculo al archivo)` 'Hipervínculo al convenio modificatorio en su caso',
            vcon.`Monto original del contrato` 'Monto total del contrato',
            vcon.`Monto pagado a la fecha` 'Monto pagado al periodo publicado',
            vcon.`Fecha inicio` 'Fecha de inicio de los servicios contratados',
            vcon.`Fecha fin` 'Fecha de término de los servicios contratados',
            f.numeros_factura 'Números de factura', f.files_factura_pdf 'Hipervínculos a la factura',
            area_responsable, fecha_validacion, fecha_actualizacion, nota, pnt.estatus_pnt
            FROM tab_contratos cont
            LEFT JOIN vout_contratos vcon ON vcon.`ID (Número de contrato)` = cont.id_contrato
            LEFT JOIN vout_convenios_modificatorios vcmod ON vcmod.`ID (Número de contrato)` = cont.id_contrato
            LEFT JOIN (SELECT f.id_contrato, f.numero_factura numeros_factura, 
                       f.file_factura_pdf files_factura_pdf, f.id_ejercicio
                       FROM tab_facturas f ) f ON f.id_contrato = cont.id_contrato
            LEFT JOIN cat_ejercicios ej ON ej.id_ejercicio = f.id_ejercicio
            LEFT JOIN rel_pnt_contrato pnt ON pnt.id_contrato = cont.id_contrato
            WHERE cont.numero_contrato != 'Sin contrato'; ");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

     function registros3(){
        $query = $this->db->query("SELECT pnt.id_campana_aviso id_tpo, pnt.id_pnt, pnt.id, ej.ejercicio 'Ejercicio', 
                  cam.fecha_inicio_periodo 'Fecha de inicio del periodo que se informa',
                  cam.fecha_termino_periodo 'Fecha de termino del periodo que se informa',
                  so.nombre_sujeto_obligado 'Sujeto obligado al que se le proporcionó el servicio/permiso',
                  ctip.nombre_campana_tipoTO 'Tipo (catálogo)',
                  cscat.nombre_servicio_categoria 'Medio de comunicación (catálogo)', 
                  csun.nombre_servicio_unidad 'Descripción de unidad por ejemplo: spot de 30 segundos (radio); mensaje en TV 20 segundos',
                  cam.nombre_campana_aviso 'Concepto o campaña',
                  cam.clave_campana 'Clave única de identificación de campaña o aviso institucional en su caso',
                  cam.autoridad  'Autoridad que proporcionó la clave única de identificación de campaña o aviso institucional',
                  ccob.nombre_campana_cobertura 'Cobertura (catálogo)',
                  cam.campana_ambito_geo 'Ámbito geográfico de cobertura',
                  sex.nombre_poblacion_sexo 'Sexo (catálogo)',
                  lug.poblacion_lugar 'Lugar de residencia',
                  edu.nombre_poblacion_nivel_educativo 'Nivel educativo', 
                  eda.nombre_poblacion_grupo_edad 'Grupo de edad',
                  niv.nombre_poblacion_nivel 'Nivel económico',
                  prov.nombre_razon_social 'Concesionario responsable de publicar la campaña o la comunicación correspondiente (razón social)',
                  prov.nombre_comercial 'Distintivo y/o nombre comercial del concesionario responsable de publicar la campaña o comunicación',
                  ord.descripcion_justificacion 'Descripción breve de las razones que justifican la elección del proveedor',
                  cam.monto_tiempo 'Monto total del tiempo de Estado o tiempo fiscal consumidos',
                  cam.area_responsable 'Área administrativa encargada de solicitar la difusión del mensaje o producto en su caso',
                  cam.fecha_inicio 'Fecha de inicio de difusión del concepto o campaña',
                  cam.fecha_termino 'Fecha de término de difusión del concepto o campaña',
                  -- 'Presupuesto total asignado y ejercido de cada partida', 
                  fac.numero_factura 'Número de factura en su caso' ,
                  fac.area_responsable 'Área(s) responsable(s) que genera(n) posee(n) publica(n) y actualizan la información',
                  cam.fecha_validacion 'Fecha de validación',
                  cam.fecha_actualizacion 'Fecha de Actualización',
                  cam.nota 'Nota',  pnt.estatus_pnt 'Estatus'
                  FROM tab_campana_aviso cam
                  JOIN cat_ejercicios ej ON ej.id_ejercicio = cam.id_ejercicio
                  JOIN tab_facturas_desglose fdes ON fdes.id_campana_aviso = cam.id_campana_aviso
                  JOIN tab_facturas fac ON fac.id_factura = fdes.id_factura
                  JOIN tab_proveedores prov ON prov.id_proveedor = fac.id_proveedor
                  JOIN tab_ordenes_compra ord ON ord.id_proveedor = fac.id_proveedor
                  JOIN cat_servicios_categorias cscat ON cscat.id_servicio_categoria = fdes.id_servicio_categoria
                  JOIN cat_servicios_unidades csun ON csun.id_servicio_unidad = fdes.id_servicio_unidad
                  JOIN tab_sujetos_obligados so ON so.id_sujeto_obligado = cam.id_so_solicitante
                  JOIN cat_campana_tiposTO ctip ON ctip.id_campana_tipoTO = cam.id_campana_tipoTO
                  JOIN cat_campana_coberturas ccob ON ccob.id_campana_cobertura = cam.id_campana_cobertura
                  JOIN (SELECT csex.id_campana_aviso, sex.nombre_poblacion_sexo
                        FROM rel_campana_sexo csex
                        JOIN cat_poblacion_sexo sex ON sex.id_poblacion_sexo = csex.id_poblacion_sexo) sex 
                  ON sex.id_campana_aviso = cam.id_campana_aviso
                  LEFT JOIN (SELECT clug.id_campana_aviso, clug.poblacion_lugar
                        FROM rel_campana_lugar clug
                        JOIN cat_poblacion_lugar lug ON lug.id_poblacion_lugar = clug.id_campana_lugar) lug
                  ON lug.id_campana_aviso = cam.id_campana_aviso
                  LEFT JOIN (SELECT cedu.id_campana_aviso, edu.nombre_poblacion_nivel_educativo
                        FROM rel_campana_nivel_educativo cedu
                        JOIN cat_poblacion_nivel_educativo edu ON edu.id_poblacion_nivel_educativo = cedu.id_rel_campana_nivel_educativo) edu
                  ON edu.id_campana_aviso = cam.id_campana_aviso
                  LEFT JOIN (SELECT ceda.id_campana_aviso, eda.nombre_poblacion_grupo_edad
                        FROM rel_campana_grupo_edad ceda
                        JOIN cat_poblacion_grupo_edad eda ON eda.id_poblacion_grupo_edad = ceda.id_rel_campana_grupo_edad) eda
                  ON eda.id_campana_aviso = cam.id_campana_aviso
                  JOIN (SELECT cniv.id_campana_aviso, GROUP_CONCAT(niv.nombre_poblacion_nivel) nombre_poblacion_nivel
                        FROM rel_campana_nivel cniv
                        JOIN cat_poblacion_nivel niv ON niv.id_poblacion_nivel = cniv.id_poblacion_nivel
                        GROUP BY cniv.id_campana_aviso) niv ON niv.id_campana_aviso = cam.id_campana_aviso
                  LEFT JOIN rel_pnt_campana_aviso2 pnt ON pnt.id_campana_aviso = cam.id_campana_aviso;");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function registros31(){ /* PROVISIONAL */
        $query = $this->db->query("SELECT pnt.id_presupuesto_desglose id_tpo, 
                       pnt.id_pnt, pnt.id,
                       pcon.denominacion_partida,
                       pdes.monto_presupuesto ,
                       fact.total_ejercido,
                       pnt.estatus_pnt
                FROM tab_presupuestos_desglose pdes
                JOIN (SELECT p.id_presupesto_concepto, c.concepto, c.denominacion 'nombre_concepto', 
                           p.partida, p.denominacion 'denominacion_partida'
                      FROM (SELECT id_presupesto_concepto, concepto, partida, denominacion FROM cat_presupuesto_conceptos pc
                          WHERE trim(coalesce(concepto, '')) <> '' AND trim(coalesce(partida, '')) <> '' ) p 
                      JOIN (SELECT concepto, denominacion FROM cat_presupuesto_conceptos
                          WHERE trim(coalesce(concepto, '')) <>'' AND trim(coalesce(partida, '')) = '') c
                      ON c.concepto = p.concepto
                ) pcon ON pcon.id_presupesto_concepto = pdes.id_presupuesto_concepto
                LEFT JOIN (SELECT numero_partida, SUM(cantidad) total_ejercido 
                           FROM tab_facturas_desglose GROUP BY numero_partida
                ) fact ON fact.numero_partida = pcon.partida
                LEFT JOIN rel_pnt_presupuesto_desglose2 pnt 
                ON pnt.id_presupuesto_desglose = pdes.id_presupuesto_desglose");

        $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function registros4(){
        $query = $this->db->query("SELECT pnt.id_campana_aviso id_tpo, pnt.id_pnt, pnt.id,  pnt.estatus_pnt, 
                ej.ejercicio, cam.fecha_inicio_periodo, cam.fecha_termino_periodo, cam.mensajeTO, 
                /*Hipervínculo, */ cam.fecha_validacion, cam.fecha_actualizacion, cam.area_responsable, cam.nota 
                FROM tab_campana_aviso cam 
                JOIN cat_ejercicios ej ON ej.id_ejercicio = cam.id_ejercicio 
                LEFT JOIN rel_pnt_campana_aviso pnt ON pnt.id_campana_aviso = cam.id_campana_aviso;"); 

       $rows = $query->result_array();

        header('Content-Type: application/json');
        echo json_encode( $rows ); 
    }

    function pnt(){
        //Validamos que el usuario tenga acceso
        $this->permiso_administrador();

        $this->load->model('tpoadminv1/logo/Logo_model');

        $data['title'] = "Plataforma Nacional de Transparencia";
        $data['heading'] = $this->session->userdata('usuario_nombre');
        $data['mensaje'] = "";
        $data['job'] = $this->session->userdata('usuario_rol_nombre');
        $data['active'] = 'pnt'; // solo active 
        $data['subactive'] = 'carga_pnt'; // class="active"
        $data['body_class'] = 'skin-blue';

        $formato = 1;
        $validpntformato = array(1,2,21,22,23,3,31,4);
        if( isset($_GET["formato"]) and in_array( $_GET["formato"], $validpntformato) ){
            $formato = $_GET["formato"];
        }

        $data['main_content'] = 'tpoadminv1/logo/pnt' . $formato;
        $data['formato'] = $formato;

        $data['url_logo'] = base_url() . "data/logo/logotop.png";
        $data['fecha_act'] = $this->Logo_model->dame_fecha_act_manual();

        $data['recaptcha'] = $this->Logo_model->get_registro_recaptcha();
        $data['grafica'] = $this->Logo_model->get_registro_grafica_presupuesto();
        
        $data['registro'] = array(
            'fecha_dof' => '',
            'name_file_imagen' => '',
        );

        // poner true para ocultar los botones
        $data['control_update'] = array (
            'file_by_save' => false,
            'file_saved' => true,
            'file_see' => true,
            'file_load' => true, 
            "mensaje_file" => 'Formatos permitidos PNG.'
        );

        $data['scripts'] = "<script type='text/javascript'>" .
                                "$(function () {" .
                                    
                                    "jQuery.datetimepicker.setLocale('es');". 
                                    "jQuery('input[name=\"fecha_act\"]').datetimepicker({ " .
                                        "timepicker:false," .
                                        "format:'Y-m-d'," .
                                        "scrollInput: false" .
                                    "});" .
                                    
                                    "$.fn.datepicker.dates['es'] = {" .
                                        "days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']," .
                                        "daysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],".
                                        "daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']," .
                                        "months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],".
                                        "monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],".
                                        "today: 'Hoy'," .
                                        "};" .
                                    "setTimeout(function() { " .
                                        "$('.alert').alert('close');" .
                                    "}, 3000);" .
                                    
                                "});" .
                            "</script>";
        
        $this->load->view('tpoadminv1/includes/template', $data);
    }

    function alta_carga_logo(){

        //Validamos que el usuario tenga acceso
        $this->permiso_administrador();

        $this->load->model('tpoadminv1/logo/Logo_model');

        $data['title'] = "Configuraci&oacute;n";
        $data['heading'] = $this->session->userdata('usuario_nombre');
        $data['mensaje'] = "";
        $data['job'] = $this->session->userdata('usuario_rol_nombre');
        $data['active'] = 'logo'; // solo active 
        $data['subactive'] = 'carga_logo'; // class="active"
        $data['body_class'] = 'skin-blue';
        $data['main_content'] = 'tpoadminv1/logo/carga_logo';

        $data['url_logo'] = base_url() . "data/logo/logotop.png";
        $data['fecha_act'] = $this->Logo_model->dame_fecha_act_manual();

        $data['recaptcha'] = $this->Logo_model->get_registro_recaptcha();
        $data['grafica'] = $this->Logo_model->get_registro_grafica_presupuesto();
        
        $data['registro'] = array(
            'fecha_dof' => '',
            'name_file_imagen' => '',
        );

        // poner true para ocultar los botones
        $data['control_update'] = array (
            'file_by_save' => false,
            'file_saved' => true,
            'file_see' => true,
            'file_load' => true, 
            "mensaje_file" => 'Formatos permitidos PNG.'
        );

        $data['scripts'] = "<script type='text/javascript'>" .
                                "$(function () {" .
                                    
                                    "jQuery.datetimepicker.setLocale('es');". 
                                    "jQuery('input[name=\"fecha_act\"]').datetimepicker({ " .
                                        "timepicker:false," .
                                        "format:'Y-m-d'," .
                                        "scrollInput: false" .
                                    "});" .
                                    
                                    "$.fn.datepicker.dates['es'] = {" .
                                        "days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']," .
                                        "daysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],".
                                        "daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']," .
                                        "months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],".
                                        "monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],".
                                        "today: 'Hoy'," .
                                        "};" .
                                    "setTimeout(function() { " .
                                        "$('.alert').alert('close');" .
                                    "}, 3000);" .
                                    
                                "});" .
                            "</script>";
        
        $this->load->view('tpoadminv1/includes/template', $data);
    }


    function validate_alta_carga_logo()
    {
        //Validamos que el usuario tenga acceso
        $permiso = $this->permiso_administrador();
        
        $this->load->model('tpoadminv1/logo/Logo_model');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('fecha_act', 'Fecha de actualizaci&oacute;n ', 'trim|required');
       // $this->form_validation->set_rules('comentario_act', 'Nombre(s)', 'trim|required|min_length[3]');
        
        $this->form_validation->set_error_delimiters('<p>','</p>');
        
        $data['title'] = "Carga logo o Alta fecha de actualizaci&oacute;n manual";
        $data['heading'] = $this->session->userdata('usuario_nombre');
        $data['mensaje'] = "";
        $data['job'] = $this->session->userdata('usuario_job');
        $data['active'] = 'usuarios'; // solo active 
        $data['subactive'] = 'alta_usuario'; // class="active"
        $data['body_class'] = 'skin-blue';
        $data['main_content'] = 'tpoadminv1/logo/carga_logo';

        $data['recaptcha'] = $this->Logo_model->get_registro_recaptcha();
        $data['grafica'] = $this->Logo_model->get_registro_grafica_presupuesto();

        $data['registro'] = array(
            'fecha_dof' => '',
            'name_file_imagen' => '',
        );

        // poner true para ocultar los botones
        $data['control_update'] = array (
            'file_by_save' => false,
            'file_saved' => true,
            'file_see' => true,
            'file_load' => true, 
            "mensaje_file" => 'Formatos permitidos PNG.'
        );

        $data['scripts'] = "<script type='text/javascript'>" .
                                "$(function () {" .
                                    
                                    "jQuery.datetimepicker.setLocale('es');". 
                                    "jQuery('input[name=\"fecha_act\"]').datetimepicker({ " .
                                        "timepicker:false," .
                                        "format:'d.m.Y'," .
                                        "scrollInput: false" .
                                    "});" .
                                    
                                    "$.fn.datepicker.dates['es'] = {" .
                                        "days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']," .
                                        "daysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],".
                                        "daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']," .
                                        "months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],".
                                        "monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],".
                                        "today: 'Hoy'," .
                                        "};" .
                                    "$('.datepicker').datepicker({ " .
                                        "format: 'dd.mm.yyyy'," .
                                        "language: 'es'," .
                                        "todayHighlight: true " .
                                    "});" .
                                    
                                "});" .
                            "</script>";
        
        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('tpoadminv1/includes/template', $data);
        }
        else 
        {
            $alta = $this->Logo_model->alta_fecha_manual();
            
            switch($alta)
            {
                case 1:
                    $this->session->set_flashdata('exito', "La fecha de actualizaci&oacute;n ".$this->input->post('fecha_act')." ha sido dado de alta exitosamente");
                    redirect('/tpoadminv1/logo/logo/alta_carga_logo');
                    break;
                case 2: 
                    $this->session->set_flashdata('error', "Ya existe la fecha de actualizaci&oacute;n ".$this->input->post('fecha_act'). " ,ingresa otra");
                    $this->load->view('tpoadminv1/includes/template', $data);
                    break;
                default:
                    $this->session->set_flashdata('alerta', "Hubo un error intente de nuevo");
                    $this->load->view('tpoadminv1/includes/template', $data);
                    break;
            }
        }
    }


    
    function upload_file()
    {
        //Validamos que el usuario tenga acceso
        $this->permiso_administrador();
        $this->load->model('tpoadminv1/Generales_model');

        $name_file = $this->Generales_model->clean_file_name(basename($_FILES['file_programa_imagen']['name']), false);
        $registro = array('error','<span class="text-danger">No fue posible subir el archivo, intentelo de nuevo.'. $name_file .'</span>');
        if(isset($name_file) && !empty($name_file))
        {
            //poner nombre por default 
            //$name_file = "logo.top"
            $porciones = explode(".", $name_file);
            $size = sizeof($porciones);
            if($size >= 2){
                //$extenciones = array('xlsx','xls','pdf','doc','docx');
                $extenciones = array('png');
                $aux = strtolower($porciones[$size-1]); 
                if(in_array($aux, $extenciones)){
                    // se guarda el archivo
                    $config['upload_path'] = './data/logo';
                    $config['allowed_types']        = '*';
                    $config['detect_mime']          = false;
                    $config['max_size'] = '20000';
                    $config['max_width']  = '150';
                    $config['max_height']  = '90';
                    $config['overwrite']  = TRUE;
                    $config['file_name']  = "logotop.png";

                    $this->load->library('upload', $config);

                    if(!$this->upload->do_upload('file_programa_imagen')){
                        $registro = array('alert', '<span class="text-warning">' . $this->upload->display_errors() . '<span>');
                    }
                    else{
                        $registro = array('exito', $name_file);
                    }
                }else{
                    $registro = array('alert', '<span class="text-danger">Tipo de archivo no permitido</span>');
                }
            } 
        }

        header('Content-type: application/json');
        
        echo json_encode( $registro );

    }


    function clear_file()
    {
        $clear_path = './data/logo/' . $this->input->post('file_archivo_nombre'); //utf8_decode($this->input->post('file_programa_anual'));
        if(file_exists($clear_path))
            unlink($clear_path);

        $registro = array('exito','Eliminado');
        header('Content-type: application/json');
        
        echo json_encode( $registro );
    }


    function actualizar_fecha()
    {
        $this->load->model('tpoadminv1/logo/Logo_model');
        $actualiza = $this->Logo_model->actualiza_fecha();
        
        switch ($actualiza) 
        {   
            case '1': $this->session->set_flashdata('exito', "Se ha actualizado correctamente");
                break;
            case 2: $this->session->set_flashdata('exito', "La fecha de actualizaci&oacute;n " . $this->input->post('fecha_act') . " ha sido inactivada");
               break;
            default: $this->session->set_flashdata('alerta', "Hubo un error intente de nuevo");
                break;
        }
        redirect('/tpoadminv1/logo/logo/alta_carga_logo');
    }

    function actualizar_recaptcha(){
        $this->load->model('tpoadminv1/logo/Logo_model');
        $registro = 0;
        $cad_a = "agregar"; $cad_e = "agregado"; 
        if(!empty($this->input->post('id_settings')) && intval($this->input->post('recaptcha') > 0)){
            $registro = $this->Logo_model->editar_recaptcha();
            $cad_a = "editar"; $cad_e = "editado"; 
        }else{
            $registro = $this->Logo_model->agregar_recaptcha();
        }

        if($registro == 0){
            $this->session->set_flashdata('alerta', "No fue posible ". $cad_a ." la reCATCHA.");
        }else {
            $this->session->set_flashdata('exito', "Se ha ". $cad_e ." la reCATCHA correctamente");
        }

        redirect('/tpoadminv1/logo/logo/alta_carga_logo');
    }

    function habilitarGrafica(){
        $this->load->model('tpoadminv1/logo/Logo_model');

        $registro = $this->Logo_model->habilitar_grafica();
        header('Content-type: application/json');

        echo json_encode( $registro );
    }

}
