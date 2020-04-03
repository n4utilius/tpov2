<?php  
if( !( isset($_SESSION['pnt']) ) or !( isset($_SESSION["pnt"]["success"]) ) or !( $_SESSION["pnt"]["success"] ) ){
	header("Location: " . base_url() ."index.php/tpoadminv1/logo/logo/alta_carga_logo");
	die();
}
?>

<link href="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	body { transition: background-color ease-in 3s; /* tweak to your liking */ }
	.invisible { display: none; }
	.upload{ background-color: #ff0; }
	.loading{ float: left; } 
	h4{ float: left; margin-right: 30px; margin-top: 3px;  }
	.items-formato { margin-left:0; padding: 0 }
	.items-formato li{ list-style: none; float: left; margin-right:20px; max-width: 140px;}
	.items-formato li a{ width: 140px; background-color: #cc33ff; border-color: #cc33ff; font-weight: bolder;}
	.subitems{ width: 600px; position: relative; top: 10px; border-left: 3px solid #c3f;
			   height: 30px; margin: 0; padding-left: 5px;}
	.subitems li a{ background-color: #ff00bf; }
	.here{ background-color: #0277bd !important; border-color: #0277bd !important;}
</style>

<!-- Main content -->
<section class="content">
	<h4>Ejercicios</h4>
	<select>
		<option>2010</option>	
		<option>2011</option>	
		<option>2012</option>	
		<option>2013</option>	
		<option>2014</option>	
		<option>2015</option>	
		<option>2016</option>	
		<option>2017</option>	
		<option>2018</option>	
		<option>2019</option>	
		<option>2020</option>	
	</select>

	<br><br>

	<h4>Formatos</h4>

	<ul class="items-formato">
		<li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 1)? 'here': '' ?>" id="formato_1" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=1"> 70FXXIIIA </a> </li>
		<li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 2)? 'here': '' ?>" id="formato_2" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=2"> 70FXXIIIB </a> </li>
		<li> 
			<a class="btn-group btn btn-info btn-sm <?php echo ($formato == 3)? 'here': '' ?>" id="formato_3" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=3"> 70FXXIIIC </a> 
			<ul class="subitems">
				<li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 31)? 'here': '' ?>" id="formato_31" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=31"> 70FXXIIIB1 </a> </li>
			</ul>
		</li>
		<li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 4)? 'here': '' ?>" id="formato_4" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=4"> 70FXXIIID </a> </li>

	<br><br>
	<h2> Presupuesto total asignado y ejercido de cada partida </h2>
	<table id="grid" class="dataTable stripe hover order-column row-border cell-border compact">
		<thead>
	        <tr>
	            <th>id_proveedor</th>
	            <th>id</th>
				<th>Razón Social</th>
				<th>Nombre(s)</th>
				<th>Primer Apellido</th>
				<th>Segundo Apellido</th>
				<th>Nombre de los Proveedores y/o responsables</th>
				<th>Registro Federal de contribuyentes</th>
				<th>Procedimiento de contratación</th>
				<th>Fundamento juridicos</th> 
				<th>Descripcion breve de las razones que justifican<th/>
				<th>Estatus<th/>
	        </tr>
	    </thead>
	    <tbody></tbody>
	</table>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>plugins/jQuery/jQuery-3.3.1.js"></script>
<link href="<?php echo base_url(); ?>plugins/DataTables2/datatables.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.js" type="text/javascript" ></script>

<script type="text/javascript">
	$(document).ready(function(){

	    $('#grid').DataTable({
	    	ajax: {
	    		url: "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/registros3",
	    		dataSrc: ''
	    	},
	    	columns: [
	    		{ data: 'id_proveedor' },
	    		{ data: 'id' },
				{ data: 'nombre_razon_social' },
				{ data: 'nombres' },
				{ data: 'primer_apellido' },
				{ data: 'segundo_apellido' },
				{ data: 'nombre_comercial' },
				{ data: 'rfc' },
				{ data: 'nombre_procedimiento' },
				{ data: 'fundamento_juridico' },
				{ data: 'descripcion_justificacion' },
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
				    targets: 12,
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

				      		response += "<img class='check' src='<?php echo base_url(); ?>plugins/img/correct.png'>"
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

		    formato = {
				"idFormato": 43369, /*"Contratación de servicios de publicidad oficial"*/
				"IdRegistro": "",
				"token": '<?php echo $_SESSION["pnt"]["token"]["token"]; ?>',
				"correoUnidadAdministrativa": '<?php echo $_SESSION["user_pnt"]; ?>' ,
				"unidadAdministrativa": '<?php echo $_SESSION["unidad_administrativa"]; ?>',
				"SujetoObligado": '<?php echo $_SESSION["sujeto_obligado"]; ?>',
				"registros": [{
				    "numeroRegistro": 1,
				    "campos": [
				    	{"idCampo": 333943, "valor": data["Ejercicio"] }
				    ]
				}],
			  "_id_interno": data["ID FACTURA"]
			}

			/**/
	    	$.post(url, formato, function(res, error){
    			if(res && res.success) {
	    			tr.children("td").eq(1).text(res.id_pnt)
	    			tr.children("td").eq(12).children("a.eliminar").removeClass("invisible")
	    			tr.children("td").eq(12).children("img.check").removeClass("invisible")
	    			tr.children("td").eq(12).children("a.crear").addClass("invisible")
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
	    			tr.children("td").eq(12).children("a.eliminar").addClass("invisible")
	    			tr.children("td").eq(12).children("img.check").addClass("invisible")
	    			tr.children("td").eq(12).children("a.crear").css("display", "block")
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