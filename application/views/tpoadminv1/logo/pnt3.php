
<!--link href="<?php echo base_url(); ?>plugins/jquery-bootgrid/jquery.bootgrid.min.css" rel="stylesheet" type="text/css" /-->


<!-- Main content -->
<section class="content">
	<table id="grid" class="dataTable stripe hover order-column row-border cell-border compact">
		<thead>
	        <tr>
	            <th>id_proveedor</th>
				<th>Razón Social</th>
				<th>Nombre(s)</th>
				<th>Primer Apellido</th>
				<th>Segundo Apellido</th>
				<th>Nombre de los Proveedores y/o responsables</th>
				<th>Registro Federal de contribuyentes</th>
				<th>Procedimiento de contratación</th>
				<th>Fundamento juridicoz</th> 
				<th>Descripcion breve de las razones que justifican<th/>
	        </tr>
	    </thead>
	    <tbody>
	        <tr>
	            <th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
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
		/**/
		$(".tpo_btn").on("click", function(e){
			return false
			alert("lalal")
	    })
		/**/

		enviar_pnt = function(id){
			var data = $("#tpo_" + id).attr("data");
			var url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/test"

	    	$.get(url, JSON.parse(data), function(a){
	    		console.log(a)
	    	})
	    }
		/**/
	    $('#grid').DataTable({
	    	ajax: {
	    		url: "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/registros3",
	    		dataSrc: ''
	    	},
			columns: [
				{ data: 'id_proveedor' },
				{ data: 'Razón Social' },
				{ data: 'Nombre(s)' },
				{ data: 'Primer Apellido' },
				{ data: 'Segundo Apellido' },
				{ data: 'Nombre de los Proveedores y/o responsables' },
				{ data: 'Registro Federal de contribuyentes' },
				{ data: 'Procedimiento de contratación' },
				{ data: 'Fundamento juridico' },
				{ data: 'Descripcion breve de las razones que justifican' }
			]/*,
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
				    targets: 5,
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	if(!data) return  "<label class='btn'> <small> N/D </small></label>"
				        return (data.length > 100)? data.substr( 0, 100 ) + "..." : data
				    }
				},
				{
				    targets: 12,
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	var response = ""
					   

				      	if(!data){ 
				      		response = "<label class='btn'> <small> PENDIENTE </small></label><br>"
				      		response += "<a class='tpo_btn' href='#' id='tpo_" + row.id_presupuesto + "' data='"
				      		response += JSON.stringify(row) + "' onclick='enviar_pnt(" + row.id_presupuesto + ")'> Crear </a>"
				      		//response += JSON.stringify(row) + "'> Crear </a>"
				      		return response
				      	}

			      		response += "<button> Editar </button>"
			      		response += "<button> Eliminar </button>"

				      	return response
				    }
				},
				{
				    targets: [0,1,2,3,4,5,6,7,8,9,10,11],
				    data: "data",
				    render: function ( data, type, row, meta ) {
				      	if(!data) return "<label class='btn'> <small> N/D </small></label>"
				        return data
				    }
				}
			]
			*/
	    });

	  
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