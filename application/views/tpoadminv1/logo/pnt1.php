<?php  
if( !( isset($_SESSION['pnt']) ) or !( isset($_SESSION["pnt"]["success"]) ) or !( $_SESSION["pnt"]["success"] ) ){
	header("Location: " . base_url() ."index.php/tpoadminv1/logo/logo/alta_carga_logo");
	die();
}
?>

<link href="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.css" rel="stylesheet" type="text/css" />

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
	<table id="grid1" class="dataTable stripe hover order-column row-border cell-border compact" >
		<thead>
	        <tr>
	            <th> ID TPO</th>
	            <th> ID PNT</th>
	            <th> ID PRESUPUESTO</th>
	            <th> Ejercicio</th>
	            <th> Fecha de inicio</th>
	            <th> Fecha de término</th>
	            <th> Denominación del documento</th>
	            <th> Fecha aprobovación</th>
	            <th> Hipervínculo al PACS</th>
	            <th> Área(s) responsable(s)</th>
	            <th> Fecha de Validación</th>
	            <th> Fecha de Actualización</th>
	            <th> Nota</th>
	            <th> Estatus PNT</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr>  </tr>
	    </tbody>
	    <tfoot></tfoot>
	</table>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>plugins/jQuery/jQuery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.js" type="text/javascript" ></script>
<script type="text/javascript">


	$(document).ready(function(){
		/**/
	    $('#grid1').DataTable({
	    	ajax: {
	    		url: "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/registros",
	    		dataSrc: ''
	    	},
			columns: [
				{ data: 'id_presupuesto' },
		        { data: 'id_pnt' },
		        { data: 'id_presupuesto' },
		        { data: 'ejercicio' },
		        { data: 'fecha_inicio_periodo' },
		        { data: 'fecha_termino_periodo' },
		        { data: 'denominacion' },
		        { data: 'fecha_publicacion' },
		        { data: 'file_programa_anual' },
		        { data: 'area_responsable' },
		        { data: 'fecha_validacion' },
		        { data: 'fecha_actualizacion' },
		        { data: 'nota_planeacion' },																																																																				
		        { data: 'estatus_pnt' }
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
				    targets: 6,
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	if(!data) return  "<label class='btn'> <small> N/D </small></label>"
				        return (data.length > 100)? data.substr( 0, 100 ) + "..." : data
				    }
				},
				{
				    targets: 13,
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
				    targets: [0,1,2,3,4,5,6,7,8,9,10,11, 12],
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

		    var formato = {
				"idFormato": 43322, // Programa Anual de Comunicación Social o equivalente
				"IdRegistro": "",
				"token": '<?php echo $_SESSION["pnt"]["token"]["token"]; ?>',
				"correoUnidadAdministrativa": '<?php echo $_SESSION["user_pnt"]; ?>' ,
				"unidadAdministrativa": '<?php echo $_SESSION["unidad_administrativa"]; ?>',
				"SujetoObligado": '<?php echo $_SESSION["sujeto_obligado"]; ?>',
				"registros": [{
				    "numeroRegistro": 10,
				    "campos": [
				    	{ "idCampo": 333986, "valor": data.ejercicio},
				    	{ "idCampo": 333990, "valor": (data.fecha_inicio_periodo != null)? data.fecha_inicio_periodo.split('-').reverse().join('/') : ''},
				    	{ "idCampo": 333991, "valor": (data.fecha_termino_periodo != null)? data.fecha_termino_periodo.split('-').reverse().join('/') : ''},
				    	{ "idCampo": 333985, "valor": data.denominacion},
				    	{ "idCampo": 333987, "valor": (data.fecha_publicacion != null)? data.fecha_publicacion.split('-').reverse().join('/') : ''},
				    	{ "idCampo": 333995, "valor": data.file_programa_anual},
				    	{ "idCampo": 333994, "valor": data.area_responsable},
				    	{ "idCampo": 333988, "valor": (data.fecha_validacion != null)? data.fecha_validacion.split('-').reverse().join('/') : ''},
				    	{ "idCampo": 333992, "valor": (data.fecha_actualizacion != null)? data.fecha_actualizacion.split('-').reverse().join('/') : ''},
				    	{ "idCampo": 333993, "valor": data.nota},
				    ]
				}],
			  "_id_interno": data.id_presupuesto
			}

	    	$.post(url, formato, function(res, error){
	    		if(res && res.success) {
	    			tr.children("td").eq(1).text(res.id_pnt)
	    			tr.children("td").eq(13).children("a.eliminar").removeClass("invisible")
	    			tr.children("td").eq(13).children("img.check").removeClass("invisible")
	    			tr.children("td").eq(13).children("a.crear").addClass("invisible")
	    		} else {
	    			console.log("No se pudo insertar el elemento correctamente")
	    			a.css("display", "block")
	    		}

    			td.children("img.loading").remove("")
    			
    			if(tr.hasClass("odd")) tr.css("background-color", "#f9f9f9")
    			else tr.css("background-color", "#fff")

	    	})
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
				"idFormato": 43322, 
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