<?php  
if( !( isset($_SESSION['pnt']) ) or !( isset($_SESSION["pnt"]["success"]) ) or !( $_SESSION["pnt"]["success"] ) ){
	header("Location: " . base_url() ."index.php/tpoadminv1/logo/logo/alta_carga_logo");
	die();
}
?>

<!--link href="<?php echo base_url(); ?>plugins/jquery-bootgrid/jquery.bootgrid.min.css" rel="stylesheet" type="text/css" /-->

<style type="text/css">
	
	#grid1{
		margin: 50px 0px 0px 10px !important;
		padding: 50px 0px 0px 10px !important;
	}

	.invisible {
		display: none;
	}

	.upload{
		background-color: #ff0;
	}


	body {
		transition: background-color ease-in 3s; /* tweak to your liking */
	}

	.loading{
		float: left;
	}

</style>
<!-- Main content -->
<section class="content">
	<table id="grid" class="dataTable stripe hover order-column row-border cell-border compact">
		<thead>
	        <tr>
	           	<th> ID TPO </th>
				<th> ID PNT </th>
				<th> ID FACTURA </th>
				<th> Ejercicio </th>
				<th> Fecha de inicio del periodo que se informa </th>
				<th> Fecha de término del periodo que se informa </th>
				<th> Función del Sujeto Obligado (catálogo) </th>
				<th> Área administrativa Encargada de Solicitar El Servicio o Producto, en su caso </th>
				<th> Clasificación Del(los) Servicios (catálogo) </th>
				<th> Tipo de Servicio </th>
				<th> Tipo de Medio(catálogo) </th>
				<th> Descripción de Unidad </th>
				<th> Tipo (catálogo) </th>
				<th> Nombre de la Campaña o Aviso Institucional </th>
				<th> Año de la Campaña </th>
				<th> Tema de la Campaña o Aviso Institucional </th>
				<th> Objetivo Institucional </th>
				<th> Objetivo de Comunicación </th>
				<th> Costo por unidad </th>
				<th> Clave Única de Indentificación de Campaña </th>
				<th> Autoridad que proporcionó la Clave </th>
				<th> Cobertura (catálogo) </th>
				<th> Ámbito Geográfico de Cobertura </th>
				<th> Fecha de inicio de la Campaña o Aviso Institucional </th>
				<th> Fecha de término de la Campaña o Aviso Institucional </th>
				<th> Sexo (catálogo) </th>
				<th> Lugar de Residencia </th>
				<th> Nivel Educativo </th>
				<th> Grupos de Edad </th>
				<th> Nivel Socioeconómico </th>
				<th> Respecto a los proveedores y su contratación </th>
				<th> Área(s) Responsable(s) que generan(n) posee(n), Publica(n) y Actualiza(n) la información </th>
				<th> Fecha de Validación </th>
				<th> Fecha de Actualización </th>
				<th> Nota </th>
				<th> Estatus PNT </th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr>
	           
	        </tr>
	    </tbody>
	</table>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>plugins/jQuery/jQuery-3.3.1.js"></script>

<!--link href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /-->
<link href="<?php echo base_url(); ?>plugins/DataTables2/datatables.css" rel="stylesheet" type="text/css" />

<!--script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript" ></script-->
<script src="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.js" type="text/javascript" ></script>

<script type="text/javascript">

	$(document).ready(function(){
		

	    $('#grid').DataTable({
	    	ajax: {
	    		url: "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/registros2",
	    		dataSrc: ''
	    	},
			columns: [
				{ data: 'ID TPO' },
				{ data: 'ID PNT' },
				{ data: 'ID FACTURA' },
				{ data: 'Ejercicio' },
				{ data: 'Fecha de inicio del periodo que se informa' },
				{ data: 'Fecha de término del periodo que se informa' },
				{ data: 'Función del Sujeto Obligado (catálogo)' },
				{ data: 'Área administrativa Encargada de Solicitar El Servicio o Producto, en su caso' },
				{ data: 'Clasificación Del(los) Servicios (catálogo)' },
				{ data: 'Tipo de Servicio' },
				{ data: 'Tipo de Medio(catálogo)' },
				{ data: 'Descripción de Unidad' },
				{ data: 'Tipo (catálogo)' },
				{ data: 'Nombre de la Campaña o Aviso Institucional' },
				{ data: 'Año de la Campaña' },
				{ data: 'Tema de la Campaña o Aviso Institucional' },
				{ data: 'Objetivo Institucional' },
				{ data: 'Objetivo de Comunicación' },
				{ data: 'Costo por unidad' },
				{ data: 'Clave Única de Indentificación de Campaña' },
				{ data: 'Autoridad que proporcionó la Clave' },
				{ data: 'Cobertura (catálogo)' },
				{ data: 'Ámbito Geográfico de Cobertura' },
				{ data: 'Fecha de inicio de la Campaña o Aviso Institucional' },
				{ data: 'Fecha de término de la Campaña o Aviso Institucional' },
				{ data: 'Sexo (catálogo)' },
				{ data: 'Lugar de Residencia' },
				{ data: 'Nivel Educativo' },
				{ data: 'Grupos de Edad' },
				{ data: 'Nivel Socioeconómico' },
				{ data: 'Respecto a los proveedores y su contratación' },
				{ data: 'Área(s) Responsable(s) que generan(n) posee(n), Publica(n) y Actualiza(n) la información' },
				{ data: 'Fecha de Validación' },
				{ data: 'Fecha de Actualización' },
				{ data: 'Nota' },
				{ data: 'Estatus PNT' }
			],
			columnDefs: [ 
				{
				    targets: 1,
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	if(!data) return "<label class='btn'> <small> SIN SUBIR </small></label>"
				      	return data
				    }
				},
				{
				    targets: 35,
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	var response = ""
				      	if(!data){ 
				      		response += "<a class='tpo_btn crear' href='#' data='"
				      		response += JSON.stringify(row) + "'> <img width='24' src='<?php echo base_url(); ?>plugins/img/upload.png'> </a>"
				      		
				      		response += "<img class='check invisible' src='<?php echo base_url(); ?>plugins/img/correct.png'>"
				      		response += "<a class='tpo_btn eliminar invisible' href='#' data='" + JSON.stringify(row) + "'> <img src='<?php echo base_url(); ?>plugins/img/erase.png'></a>"
				      		return response
				      	}else{
				      		response += "<a class='tpo_btn crear invisible' href='#' data='"
				      		response += JSON.stringify(row) + "'> <img width='24' src='<?php echo base_url(); ?>plugins/img/upload.png'> </a>"

				      		response += "<img src='<?php echo base_url(); ?>plugins/img/correct.png'>"
				      		response += "<a class='tpo_btn eliminar' href='#' data='" + JSON.stringify(row) + "'> <img src='<?php echo base_url(); ?>plugins/img/erase.png'></a>"
					      	return response

				      	}

				    }
				},
				{
				    targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34],
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	if(!data) return "<label class='btn'> <small> N/D </small></label>"
				        return data
				    }
				}
			]
	    });

		$(document).on("click","a.crear",function(e){ 
	    	e.preventDefault();
		    var data = JSON.parse( $(this).attr("data") )
			  , url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/agregar_pnt";
			
			var a = $(this)
		      , tr = a.parents("tr")
		      , td = a.parents("td")

		    a.css("display", "none")
		    tr.css("background-color", "rgba(0,255,0, 0.2)")
		    td.prepend("<img class='loading' src='<?php echo base_url(); ?>plugins/img/loading.gif'>")

		    formato = {
				"idFormato": 43320, /*"Contratación de servicios de publicidad oficial"*/
				"IdRegistro": "",
				"token": '<?php echo $_SESSION["pnt"]["token"]["token"]; ?>',
				"correoUnidadAdministrativa": '<?php echo $_SESSION["user_pnt"]; ?>' ,
				"unidadAdministrativa": '<?php echo $_SESSION["unidad_administrativa"]; ?>',
				"SujetoObligado": '<?php echo $_SESSION["sujeto_obligado"]; ?>',
				"registros": [{
				    "numeroRegistro": 1,
				    "campos": [
				    	{"idCampo": 333943, "valor": data["Ejercicio"] },
						{"idCampo": 333963, "valor": ( data["Fecha de inicio del periodo que se informa"] != null )? data["Fecha de inicio del periodo que se informa"].split('-').reverse().join('/') : '' },
						{"idCampo": 333964, "valor": ( data["Fecha de término del periodo que se informa"] != null )? data["Fecha de término del periodo que se informa"].split('-').reverse().join('/') : '' },
						{"idCampo": 333962, "valor": parseInt(data["Función del Sujeto Obligado (catálogo)"]) },
						{"idCampo": 333950, "valor": data["Área administrativa Encargada de Solicitar El Servicio o Producto, en su caso"]},
						{"idCampo": 333968, "valor": data["Clasificación Del(los) Servicios (catálogo)"]},
						{"idCampo": 333940, "valor": data["Tipo de Servicio<"]},
						{"idCampo": 333969, "valor": data["Tipo de Medio(catálogo)"] },
						{"idCampo": 333970, "valor": data["Descripción de Unidad"]},
						{"idCampo": 333956, "valor": parseInt(data["Tipo (catálogo)"]) },
						{"idCampo": 333947, "valor": data["Nombre de la Campaña o Aviso Institucional"]},
						{"idCampo": 333942, "valor": data["Año de la Campaña"]},
						{"idCampo": 333948, "valor": data["Tema de la Campaña o Aviso Institucional"]},
						{"idCampo": 333951, "valor": data["Objetivo Institucional"]},
						{"idCampo": 333949, "valor": data["Objetivo de Comunicación"]},
						{"idCampo": 333972, "valor": data["Costo por unidad"]},
						{"idCampo": 333944, "valor": data["Clave Única de Indentificación de Campaña"]},
						{"idCampo": 333973, "valor": data["Autoridad que proporcionó la Clave"]},
						{"idCampo": 333955, "valor": parseInt(data["Cobertura (catálogo)"]) },
						{"idCampo": 333971, "valor": data["Ámbito Geográfico de Cobertura"]},
						{"idCampo": 333952, "valor": ( data["Fecha de inicio de la Campaña o Aviso Institucional"] != null )? data["Fecha de inicio de la Campaña o Aviso Institucional"].split('-').reverse().join('/') : '' },
						{"idCampo": 333953, "valor": ( data["Fecha de término de la Campaña o Aviso Institucional"] != null )? data["Fecha de término de la Campaña o Aviso Institucional"].split('-').reverse().join('/') : '' },
						{"idCampo": 333965, "valor": parseInt(data["Sexo (catálogo)"]) },
						{"idCampo": 333946, "valor": data["Lugar de Residencia"]},
						{"idCampo": 333941, "valor": data["Nivel Educativo"]},
						{"idCampo": 333945, "valor": data["Grupos de Edad"]},
						{"idCampo": 333974, "valor": data["Nivel Socioeconómico"]},

						//(data.fecha_termino_periodo != null)? data.fecha_termino_periodo.split('-').reverse().join('/') : ''
						/* {"idCampo": 333957, "valor": "Respecto a los proveedores y su contratación"}, */
						/*
						{"idCampo": 43256, "valor": "Razón social"},
						{"idCampo": 43257, "valor": "Nombre(s)"},
						{"idCampo": 43258, "valor": "Primer apellido"},
						{"idCampo": 43259, "valor": "Segundo apellido"},
						{"idCampo": 43260, "valor": "Registro Federal de Contribuyente"},
						{"idCampo": 43261, "valor": "Procedimiento de contratación"},
						{"idCampo": 43262, "valor": "Fundamento jurídico del proceso de contratación"},
						{"idCampo": 43263, "valor": "Descripción breve del las razones que justifican"},
						{"idCampo": 43264, "valor": "Nombre(s) de los proveedores y/o responsables"},
						{"idCampo": 333958, "valor": "Respecto a los recursos y el presupuesto"},
						{"idCampo": 43265, "valor": "Partida genérica"},
						{"idCampo": 43266, "valor": "Clave del concepto"},
						{"idCampo": 43267, "valor": "Nombre del concepto"},
						{"idCampo": 43268, "valor": "Presupuesto asignado por concepto"},
						{"idCampo": 43269, "valor": "Presupuesto ejercido al periodo reportado de cada partida"},
						{"idCampo": 43270, "valor": "presupuesto total ejercido por concepto"},
						{"idCampo": 43271, "valor": "Denominación de cada partida"},
						{"idCampo": 43272, "valor": "Presupuesto total asignado a cada partida"},
						{"idCampo": 43273, "valor": "Presupuesto modificado por partida"},
						{"idCampo": 43274, "valor": "Presupuesto modificado por concepto"},
						{"idCampo": 333959, "valor": "Respecto al contrato y los montos"},
						{"idCampo": 43275, "valor": "Fecha de firma del contrato"},
						{"idCampo": 43276, "valor": "Número o referencia de identificación del contrato"},
						{"idCampo": 43277, "valor": "Objeto del contrato"},
						{"idCampo": 43278, "valor": "Hipervínculo al contrato firmado"},
						{"idCampo": 43279, "valor": "hipervínculo al convenio modificatorio, en su caso"},
						{"idCampo": 43280, "valor": "Monto total del contrato"},
						{"idCampo": 43281, "valor": "Monto pagado al periodo publicado"},
						{"idCampo": 43282, "valor": "Fecha de inicio de los servicios contratados"},
						{"idCampo": 43283, "valor": "Fecha de término de los servicios contratados"},
						{"idCampo": 43284, "valor": "Número de factura"},
						{"idCampo": 43285, "valor": "Hipervínculo a la factura"},
						*/
						{"idCampo": 333967, "valor": data["Área(s) Responsable(s) que generan(n) posee(n), Publica(n) y Actualiza(n) la información"]},
						{"idCampo": 333954, "valor": (data["Fecha de Validación"] != null )? data["Fecha de Validación"].split('-').reverse().join('/') : '' },
						{"idCampo": 333961, "valor": (data["Fecha de Actualización"] != null )? data["Fecha de Actualización"].split('-').reverse().join('/') : '' },
						{"idCampo": 333966, "valor": data["Nota"]}//
				    ]
				}],
			  "_id_interno": data["ID FACTURA"]
			}

			/**/
	    	$.post(url, formato, function(res, error){
    			if(res && res.success) {
	    			tr.children("td").eq(1).text(res.id_pnt)
	    			tr.children("td").eq(35).children("a.eliminar").removeClass("invisible")
	    			tr.children("td").eq(35).children("img.check").removeClass("invisible")
	    			tr.children("td").eq(35).children("a.crear").addClass("invisible")
	    		} else {
	    			console.log("No se pudo insertar el elemento correctamente")
	    			a.css("display", "block")
	    		}

    			td.children("img.loading").remove("")
    			
    			if(tr.hasClass("odd")) tr.css("background-color", "#f9f9f9")
    			else tr.css("background-color", "#fff")

	    	})
			/**/
	    });
		$(document).on("click","a.eliminar",function(e){ 
	    	e.preventDefault();

	    	var a = $(this)
		      , tr = a.parents("tr")
		      , td = a.parents("td")

		    a.css("display", "none")
		    a.siblings().css("display", "none")
		    tr.css("background-color", "rgba(255,0,0, 0.2)")
		    td.prepend("<img class='loading' src='<?php echo base_url(); ?>plugins/img/loading.gif'>")

		    var id_pnt = tr.children("td").eq(1).text()

	    	var data = JSON.parse( $(this).attr("data")  )
			  , token = '<?php echo $_SESSION["pnt"]["token"]["token"]; ?>'

			var formato = {
				"idFormato": 43320, 
				"correoUnidadAdministrativa": "so.inai@inai.org.mx",
				"token": token,
				"registros":[ { "numeroRegistro":1, "idRegistro": data.id_pnt || id_pnt } ],
				"id_pnt": data.id_pnt || id_pnt
			}

			var url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/eliminar_pnt"

	    	$.post(url, formato, function(res, error){
	    		//if(res.success) location.reload(); 
	    		if(res && res.success) {
	    			tr.children("td").eq(1).html("<label class='btn'> <small> SIN SUBIR </small></label>")
	    			tr.children("td").eq(13).children("a.eliminar").addClass("invisible")
	    			tr.children("td").eq(13).children("img.check").addClass("invisible")
	    			tr.children("td").eq(13).children("a.crear").css("display", "block")
	    		} else {
	    			console.log("No se pudo eliminar el elemento correctamente")
	    			a.css("display", "block")
	    			a.siblings().css("display", "block")
	    		}

    			td.children("img.loading").remove("")
    			if(tr.hasClass("odd"))
    				tr.css("background-color", "#f9f9f9")
    			else
    				tr.css("background-color", "#fff")
	    	})

	    })

	  
	})

</script>

<style type="text/css">
	#grid_wrapper{
		margin: 50px !important;
		padding: 50px !important;
	}

	/*
	 * Table styles
	 */
	table.dataTable {
	  width: 100%;
	  margin: 0 auto;
	  clear: both;
	  border-collapse: separate;
	  border-spacing: 0;
	  /*
	   * Header and footer styles
	   */
	  /*
	   * Body styles
	   */ }
	  table.dataTable thead th,
	  table.dataTable tfoot th {
	    font-weight: bold; }
	  table.dataTable thead th,
	  table.dataTable thead td {
	    padding: 10px 18px;
	    border-bottom: 1px solid #111111; }
	    table.dataTable thead th:active,
	    table.dataTable thead td:active {
	      outline: none; }
	  table.dataTable tfoot th,
	  table.dataTable tfoot td {
	    padding: 10px 18px 6px 18px;
	    border-top: 1px solid #111111; }
	  table.dataTable thead .sorting,
	  table.dataTable thead .sorting_asc,
	  table.dataTable thead .sorting_desc,
	  table.dataTable thead .sorting_asc_disabled,
	  table.dataTable thead .sorting_desc_disabled {
	    cursor: pointer;
	    *cursor: hand;
	    background-repeat: no-repeat;
	    background-position: center right; }
	  table.dataTable thead .sorting {
	    background-image: url("<?php echo base_url(); ?>plugins/DataTables2/DataTables-1.10.18/images/sort_both.png"); }
	  table.dataTable thead .sorting_asc {
	    background-image: url("<?php echo base_url(); ?>plugins/DataTables2/DataTables-1.10.18/images/sort_asc.png"); }
	  table.dataTable thead .sorting_desc {
	    background-image: url("<?php echo base_url(); ?>plugins/DataTables2/DataTables-1.10.18/images/sort_desc.png"); }
	  table.dataTable thead .sorting_asc_disabled {
	    background-image: url("<?php echo base_url(); ?>plugins/DataTables2/DataTables-1.10.18/images/sort_asc_disabled.png"); }
	  table.dataTable thead .sorting_desc_disabled {
	    background-image: url("<?php echo base_url(); ?>plugins/DataTables2/DataTables-1.10.18/images/sort_desc_disabled.png"); }
	  table.dataTable tbody tr {
	    background-color: white; }
	    table.dataTable tbody tr.selected {
	      background-color: #026baa; }
	  table.dataTable tbody th,
	  table.dataTable tbody td {
	    padding: 8px 10px; }
	  table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
	    border-top: 1px solid #dddddd; }
	  table.dataTable.row-border tbody tr:first-child th,
	  table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th,
	  table.dataTable.display tbody tr:first-child td {
	    border-top: none; }
	  table.dataTable.cell-border tbody th, table.dataTable.cell-border tbody td {
	    border-top: 1px solid #dddddd;
	    border-right: 1px solid #dddddd; }
	  table.dataTable.cell-border tbody tr th:first-child,
	  table.dataTable.cell-border tbody tr td:first-child {
	    border-left: 1px solid #dddddd; }
	  table.dataTable.cell-border tbody tr:first-child th,
	  table.dataTable.cell-border tbody tr:first-child td {
	    border-top: none; }
	  table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
	    background-color: #f9f9f9; }
	    table.dataTable.stripe tbody tr.odd.selected, table.dataTable.display tbody tr.odd.selected {
	      background-color: #0168a6; }
	  table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
	    background-color: whitesmoke; }
	    table.dataTable.hover tbody tr:hover.selected, table.dataTable.display tbody tr:hover.selected {
	      background-color: #0167a3; }
	  table.dataTable.order-column tbody tr > .sorting_1,
	  table.dataTable.order-column tbody tr > .sorting_2,
	  table.dataTable.order-column tbody tr > .sorting_3, table.dataTable.display tbody tr > .sorting_1,
	  table.dataTable.display tbody tr > .sorting_2,
	  table.dataTable.display tbody tr > .sorting_3 {
	    background-color: #f9f9f9; }
	  table.dataTable.order-column tbody tr.selected > .sorting_1,
	  table.dataTable.order-column tbody tr.selected > .sorting_2,
	  table.dataTable.order-column tbody tr.selected > .sorting_3, table.dataTable.display tbody tr.selected > .sorting_1,
	  table.dataTable.display tbody tr.selected > .sorting_2,
	  table.dataTable.display tbody tr.selected > .sorting_3 {
	    background-color: #0168a6; }
	  table.dataTable.display tbody tr.odd > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd > .sorting_1 {
	    background-color: #f1f1f1; }
	  table.dataTable.display tbody tr.odd > .sorting_2, table.dataTable.order-column.stripe tbody tr.odd > .sorting_2 {
	    background-color: #f3f3f3; }
	  table.dataTable.display tbody tr.odd > .sorting_3, table.dataTable.order-column.stripe tbody tr.odd > .sorting_3 {
	    background-color: whitesmoke; }
	  table.dataTable.display tbody tr.odd.selected > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd.selected > .sorting_1 {
	    background-color: #0165a0; }
	  table.dataTable.display tbody tr.odd.selected > .sorting_2, table.dataTable.order-column.stripe tbody tr.odd.selected > .sorting_2 {
	    background-color: #0165a2; }
	  table.dataTable.display tbody tr.odd.selected > .sorting_3, table.dataTable.order-column.stripe tbody tr.odd.selected > .sorting_3 {
	    background-color: #0166a3; }
	  table.dataTable.display tbody tr.even > .sorting_1, table.dataTable.order-column.stripe tbody tr.even > .sorting_1 {
	    background-color: #f9f9f9; }
	  table.dataTable.display tbody tr.even > .sorting_2, table.dataTable.order-column.stripe tbody tr.even > .sorting_2 {
	    background-color: #fbfbfb; }
	  table.dataTable.display tbody tr.even > .sorting_3, table.dataTable.order-column.stripe tbody tr.even > .sorting_3 {
	    background-color: #fdfdfd; }
	  table.dataTable.display tbody tr.even.selected > .sorting_1, table.dataTable.order-column.stripe tbody tr.even.selected > .sorting_1 {
	    background-color: #0168a6; }
	  table.dataTable.display tbody tr.even.selected > .sorting_2, table.dataTable.order-column.stripe tbody tr.even.selected > .sorting_2 {
	    background-color: #0169a7; }
	  table.dataTable.display tbody tr.even.selected > .sorting_3, table.dataTable.order-column.stripe tbody tr.even.selected > .sorting_3 {
	    background-color: #016aa9; }
	  table.dataTable.display tbody tr:hover > .sorting_1, table.dataTable.order-column.hover tbody tr:hover > .sorting_1 {
	    background-color: #eaeaea; }
	  table.dataTable.display tbody tr:hover > .sorting_2, table.dataTable.order-column.hover tbody tr:hover > .sorting_2 {
	    background-color: #ebebeb; }
	  table.dataTable.display tbody tr:hover > .sorting_3, table.dataTable.order-column.hover tbody tr:hover > .sorting_3 {
	    background-color: #eeeeee; }
	  table.dataTable.display tbody tr:hover.selected > .sorting_1, table.dataTable.order-column.hover tbody tr:hover.selected > .sorting_1 {
	    background-color: #01629c; }
	  table.dataTable.display tbody tr:hover.selected > .sorting_2, table.dataTable.order-column.hover tbody tr:hover.selected > .sorting_2 {
	    background-color: #01629d; }
	  table.dataTable.display tbody tr:hover.selected > .sorting_3, table.dataTable.order-column.hover tbody tr:hover.selected > .sorting_3 {
	    background-color: #01649f; }
	  table.dataTable.no-footer {
	    border-bottom: 1px solid #111111; }
	  table.dataTable.nowrap th, table.dataTable.nowrap td {
	    white-space: nowrap; }
	  table.dataTable.compact thead th,
	  table.dataTable.compact thead td {
	    padding: 4px 17px 4px 4px; }
	  table.dataTable.compact tfoot th,
	  table.dataTable.compact tfoot td {
	    padding: 4px; }
	  table.dataTable.compact tbody th,
	  table.dataTable.compact tbody td {
	    padding: 4px; }
	  table.dataTable th.dt-left,
	  table.dataTable td.dt-left {
	    text-align: left; }
	  table.dataTable th.dt-center,
	  table.dataTable td.dt-center,
	  table.dataTable td.dataTables_empty {
	    text-align: center; }
	  table.dataTable th.dt-right,
	  table.dataTable td.dt-right {
	    text-align: right; }
	  table.dataTable th.dt-justify,
	  table.dataTable td.dt-justify {
	    text-align: justify; }
	  table.dataTable th.dt-nowrap,
	  table.dataTable td.dt-nowrap {
	    white-space: nowrap; }
	  table.dataTable thead th.dt-head-left,
	  table.dataTable thead td.dt-head-left,
	  table.dataTable tfoot th.dt-head-left,
	  table.dataTable tfoot td.dt-head-left {
	    text-align: left; }
	  table.dataTable thead th.dt-head-center,
	  table.dataTable thead td.dt-head-center,
	  table.dataTable tfoot th.dt-head-center,
	  table.dataTable tfoot td.dt-head-center {
	    text-align: center; }
	  table.dataTable thead th.dt-head-right,
	  table.dataTable thead td.dt-head-right,
	  table.dataTable tfoot th.dt-head-right,
	  table.dataTable tfoot td.dt-head-right {
	    text-align: right; }
	  table.dataTable thead th.dt-head-justify,
	  table.dataTable thead td.dt-head-justify,
	  table.dataTable tfoot th.dt-head-justify,
	  table.dataTable tfoot td.dt-head-justify {
	    text-align: justify; }
	  table.dataTable thead th.dt-head-nowrap,
	  table.dataTable thead td.dt-head-nowrap,
	  table.dataTable tfoot th.dt-head-nowrap,
	  table.dataTable tfoot td.dt-head-nowrap {
	    white-space: nowrap; }
	  table.dataTable tbody th.dt-body-left,
	  table.dataTable tbody td.dt-body-left {
	    text-align: left; }
	  table.dataTable tbody th.dt-body-center,
	  table.dataTable tbody td.dt-body-center {
	    text-align: center; }
	  table.dataTable tbody th.dt-body-right,
	  table.dataTable tbody td.dt-body-right {
	    text-align: right; }
	  table.dataTable tbody th.dt-body-justify,
	  table.dataTable tbody td.dt-body-justify {
	    text-align: justify; }
	  table.dataTable tbody th.dt-body-nowrap,
	  table.dataTable tbody td.dt-body-nowrap {
	    white-space: nowrap; }
	 
	table.dataTable,
	table.dataTable th,
	table.dataTable td {
	  box-sizing: content-box; }
	 
	/*
	 * Control feature layout
	 */
	.dataTables_wrapper {
	  position: relative;
	  clear: both;
	  *zoom: 1;
	  zoom: 1; }
	  .dataTables_wrapper .dataTables_length {
	    float: left; }
	  .dataTables_wrapper .dataTables_filter {
	    float: right;
	    text-align: right; }
	    .dataTables_wrapper .dataTables_filter input {
	      margin-left: 0.5em; }
	  .dataTables_wrapper .dataTables_info {
	    clear: both;
	    float: left;
	    padding-top: 0.755em; }
	  .dataTables_wrapper .dataTables_paginate {
	    float: right;
	    text-align: right;
	    padding-top: 0.25em; }
	    .dataTables_wrapper .dataTables_paginate .paginate_button {
	      box-sizing: border-box;
	      display: inline-block;
	      min-width: 1.5em;
	      padding: 0.5em 1em;
	      margin-left: 2px;
	      text-align: center;
	      text-decoration: none !important;
	      cursor: pointer;
	      *cursor: hand;
	      color: #333333 !important;
	      border: 1px solid transparent;
	      border-radius: 2px; }
	      .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	        color: #333333 !important;
	        border: 1px solid #979797;
	        background-color: white;
	        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, gainsboro));
	        /* Chrome,Safari4+ */
	        background: -webkit-linear-gradient(top, white 0%, gainsboro 100%);
	        /* Chrome10+,Safari5.1+ */
	        background: -moz-linear-gradient(top, white 0%, gainsboro 100%);
	        /* FF3.6+ */
	        background: -ms-linear-gradient(top, white 0%, gainsboro 100%);
	        /* IE10+ */
	        background: -o-linear-gradient(top, white 0%, gainsboro 100%);
	        /* Opera 11.10+ */
	        background: linear-gradient(to bottom, white 0%, gainsboro 100%);
	        /* W3C */ }
	      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
	        cursor: default;
	        color: #666 !important;
	        border: 1px solid transparent;
	        background: transparent;
	        box-shadow: none; }
	      .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
	        color: white !important;
	        border: 1px solid #111111;
	        background-color: #585858;
	        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111111));
	        /* Chrome,Safari4+ */
	        background: -webkit-linear-gradient(top, #585858 0%, #111111 100%);
	        /* Chrome10+,Safari5.1+ */
	        background: -moz-linear-gradient(top, #585858 0%, #111111 100%);
	        /* FF3.6+ */
	        background: -ms-linear-gradient(top, #585858 0%, #111111 100%);
	        /* IE10+ */
	        background: -o-linear-gradient(top, #585858 0%, #111111 100%);
	        /* Opera 11.10+ */
	        background: linear-gradient(to bottom, #585858 0%, #111111 100%);
	        /* W3C */ }
	      .dataTables_wrapper .dataTables_paginate .paginate_button:active {
	        outline: none;
	        background-color: #2b2b2b;
	        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
	        /* Chrome,Safari4+ */
	        background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
	        /* Chrome10+,Safari5.1+ */
	        background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
	        /* FF3.6+ */
	        background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
	        /* IE10+ */
	        background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
	        /* Opera 11.10+ */
	        background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
	        /* W3C */
	        box-shadow: inset 0 0 3px #111; }
	    .dataTables_wrapper .dataTables_paginate .ellipsis {
	      padding: 0 1em; }
	  .dataTables_wrapper .dataTables_processing {
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    width: 100%;
	    height: 40px;
	    margin-left: -50%;
	    margin-top: -25px;
	    padding-top: 20px;
	    text-align: center;
	    font-size: 1.2em;
	    background-color: white;
	    background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(25%, rgba(255, 255, 255, 0.9)), color-stop(75%, rgba(255, 255, 255, 0.9)), color-stop(100%, rgba(255, 255, 255, 0)));
	    background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
	    background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
	    background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
	    background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
	    background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%); }
	  .dataTables_wrapper .dataTables_length,
	  .dataTables_wrapper .dataTables_filter,
	  .dataTables_wrapper .dataTables_info,
	  .dataTables_wrapper .dataTables_processing,
	  .dataTables_wrapper .dataTables_paginate {
	    color: #333333; }
	  .dataTables_wrapper .dataTables_scroll {
	    clear: both; }
	    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody {
	      *margin-top: -1px;
	      -webkit-overflow-scrolling: touch; }
	      .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > td, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > td {
	        vertical-align: middle; }
	      .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > th > div.dataTables_sizing,
	      .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > td > div.dataTables_sizing, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > th > div.dataTables_sizing,
	      .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > td > div.dataTables_sizing {
	        height: 0;
	        overflow: hidden;
	        margin: 0 !important;
	        padding: 0 !important; }
	  .dataTables_wrapper.no-footer .dataTables_scrollBody {
	    border-bottom: 1px solid #111111; }
	  .dataTables_wrapper.no-footer div.dataTables_scrollHead table.dataTable,
	  .dataTables_wrapper.no-footer div.dataTables_scrollBody > table {
	    border-bottom: none; }
	  .dataTables_wrapper:after {
	    visibility: hidden;
	    display: block;
	    content: "";
	    clear: both;
	    height: 0; }
	 
	@media screen and (max-width: 767px) {
	  .dataTables_wrapper .dataTables_info,
	  .dataTables_wrapper .dataTables_paginate {
	    float: none;
	    text-align: center; }
	  .dataTables_wrapper .dataTables_paginate {
	    margin-top: 0.5em; } }
	@media screen and (max-width: 640px) {
	  .dataTables_wrapper .dataTables_length,
	  .dataTables_wrapper .dataTables_filter {
	    float: none;
	    text-align: center; }
	  .dataTables_wrapper .dataTables_filter {
	    margin-top: 0.5em; } }

</style>