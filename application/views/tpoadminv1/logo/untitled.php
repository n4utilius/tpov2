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
	.items-formato li{ list-style: none; float: left; margin-right:20px;}
	.items-formato li a{ width: 140px; background-color: #cc33ff; border-color: #cc33ff; font-weight: bolder;}
</style>

<!-- Main content -->
<section class="content">
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
	        </tr>
	    </thead>
	    <tbody><tr> </tr></tbody>
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
    		scrollY: true,
	    	scrollX: true,
	    	columns: [
	    		{ data: 'id_proveedor' },
				{ data: 'id' },
				{ data: 'Razón Social' },
				{ data: 'Nombre(s)' },
				{ data: 'Primer Apellido' },
				{ data: 'Segundo Apellido' },
				{ data: 'Nombre de los Proveedores y/o responsables' },
				{ data: 'Registro Federal de contribuyentes' },
				{ data: 'Procedimiento de contratación' },
				{ data: 'Fundamento juridico' },
				{ data: 'Descripcion breve de las razones que justifican' }
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
				    targets: [0,1,2,3,4,5,6,7,8,9,10],
				    data: "data",
				    render: function ( data, type, row, meta ) {
				    	console.log(row)
				      	if(!data) return "<label class='btn'> <small> N/D </small></label>"
				        return data
				    }
				}
			]
	    });
	})
</script>
