<?php
    $sel_ejercicios = '<option value="">Todos</option>';
    for($z = 0; $z < sizeof($ejercicios); $z++)
    {
        if($id_ejercicio_ultimo == $ejercicios[$z]['id_ejercicio']){
            $sel_ejercicios .= '<option value="'.$ejercicios[$z]['id_ejercicio'].'" selected>' . $ejercicios[$z]['ejercicio'] . '</option>';
        }else{
            $sel_ejercicios .= '<option value="'.$ejercicios[$z]['id_ejercicio'].'">' . $ejercicios[$z]['ejercicio'] . '</option>';
        }
    }
?>
<style>
    #ex1Slider .slider-selection {
        background-image: -webkit-linear-gradient(to bottom, #337ab7 0%, #3c8dbc 100%);
        background-image: -o-linear-gradient(to bottom, #337ab7 0%, #3c8dbc 100%);
        background-image: linear-gradient(to bottom, #337ab7 0%, #3c8dbc 100%);
    }
    .tooltip.bottom .tooltip-inner {
        background-color: #fff;
        border: 2px solid #ccc;
        color: black;
        font-size: 15px;
        font-weight: bold;
    }
    .tooltip.bottom .tooltip-arrow {
        border-bottom-color: #ccc;
    }
    .tooltip.top .tooltip-inner {
        background-color: #fff;
        border: 2px solid #ccc;
        color: black;
        font-size: 15px;
        font-weight: bold;
    }
    .tooltip.top .tooltip-arrow {
        border-top-color: #ccc;
    }
</style>
<div class="row tpo-div-descarga">
    <button id="descargabtn" type="button" class="btn btn-success pull-right" onclick="descargar_archivo()" title="<?php echo $indicadores_ayuda['btn_download']?>" data-placement="bottom" data-toggle="tooltip"><i class="fa fa-file"></i>&nbsp;&nbsp;Descarga de datos</button>
    <input type="hidden" id="link_descarga" value="<?php echo $link_descarga; ?>"/>
</div>
<div class="row"> <!-- Cabecera de filtrado-->
    <div class="col-md-4">
        <div class="box box-default bg-box-black">
            <div class="box-header header" title="<?php echo $indicadores_ayuda['ejercicio']?>" data-placement="bottom" data-toggle="tooltip">
                Ejercicio
            </div> <!-- / .box-header-->
            <div class="box-body with-border">
                <select id="id_ejercicio" name="id_ejercicio">
                    <?php echo $sel_ejercicios; ?>
                </select> 
            </div> <!-- / .box-body-->
        </div> <!-- / .box-->
    </div> <!-- / .col-->
    <div class="col-md-4">
        <div class="box box-default bg-box-black">
            <div class="box-header header" title="<?php echo $indicadores_ayuda['proveedores_n']?>" data-placement="bottom" data-toggle="tooltip">
                Proveedores 
            </div> <!-- / .box-header-->
            <div class="box-body with-border body">
                <span id="proveedor"  class="info-box-number">0</span>
            </div> <!-- / .box-body-->
        </div> <!-- / .box-->
    </div> <!-- / .col-->
    <div class="col-md-4">
        <div class="box box-default bg-box-black">
            <div class="box-header header" title="<?php echo $indicadores_ayuda['monto_gastado_n']?>" data-placement="bottom" data-toggle="tooltip">
                Monto gastado($) 
            </div> <!-- / .box-header-->
            <div class="box-body with-border body">
                <span id="monto_gastado" class="info-box-number">0</span>
            </div> <!-- / .box-body-->
        </div> <!-- / .box-->
    </div> <!-- / .col-->
</div> <!-- / .row cabecera -->

<div class="row text-center">
    <h4>Montos mayores a: <span id="tagMinimo"></span> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-info-circle text-primary" title="<?php echo $indicadores_ayuda['montos_mayores_n']?>" data-placement="bottom" data-toggle="tooltip"></i><h4>
    <input id="ex1" data-slider-id='ex1Slider' type="text"  data-slider-min="<?php echo $valores_slider['minimo'];?>" data-slider-max="<?php echo $valores_slider['maximo'];?>" data-slider-step="1"/>
    <input type="hidden" value="<?php echo $valores_slider['minimo']?>" id="minimo">
</div>
<div class="box box-info"> <!-- grafica -->
    <div class="box-header header">
        <i class="fa fa-info-circle text-primary" title="<?php echo $indicadores_ayuda['grafica_proveedores_n']?>" data-placement="bottom" data-toggle="tooltip"></i>
        <h4 id="info_not_data"></h4>
    </div>
    <div id="load_container" class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div id="container" style="min-height: 600px; margin: 0 auto"></div>
</div><!-- /. box gráfica-->

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle text-primary" title="<?php echo $indicadores_ayuda['tabla_proveedores_n']?>" data-placement="bottom" data-toggle="tooltip"></i>
                <div class="pull-right">
                    <a class="btn btn-default" onclick="print_btn()"><i class="fa fa-print"></i> Imprimir</a>
                    <a id="descargabtntable" class="btn btn-default" onclick="descargar_archivo_table()"><i class="fa fa-file"></i> Exportar datos</a>
                    <input type="hidden" id="link_descarga_table" value="<?php echo $link_descarga_table; ?>"/>
                    <input type="hidden" id="link_print" value="<?php echo $print_url; ?>"/>
                </div> 
            </div><!-- /.box-header -->   
            <div class="box-body table-responsive">
                <table id="proveedores" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ejercicio</th>
                            <th>Proveedor</th>
                            <th>Contratos</th>
                            <th>&Oacute;rdenes de compra</th>
                            <th>Monto total pagado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                    <tfoot>
                        <tr style="font-size:13px; border-top: 2px solid #e8e8e8;">
                            <th>Σ</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<script>
    var table = null; //para el objeto $('#myTable').DataTable();
    var reiniciar = false;
    var myslider;
    var inicializar_componentes = function()
    {
        get_valores_grafica(false);
        get_valores_table();

        // Without JQuery
        myslider = new Slider('#ex1', {
            formatter: function(value) {
                return '$ ' + parseFloat(value, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
            }
        });

        myslider.on("slideStop", function(value) {
            $('#minimo').val(value);
            var mxn = '$ ' + parseFloat(value, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
            $('#tagMinimo').html(mxn);
            get_valores_grafica(false);
        });
    }

    var get_valores_grafica = function(reiniciar_minimo)
    {
        var form_data = new FormData();                  
        form_data.append('id_ejercicio', $('select[name="id_ejercicio"]').val());
        reiniciar = reiniciar_minimo;
        if(reiniciar_minimo == true){
            form_data.append('minimo', '');
        }else{
            form_data.append('minimo', $('#minimo').val());
        }
        
        var url = '<?php echo base_url() . 'index.php/tpov1/proveedores/getDatosPorproveedores' ?>';

        buscar(url, form_data, init_grafica, 'container');
    }

    var get_valores_table = function(){
        
        if(table !== undefined && table != null){
            table.fnDestroy();
        }

        $('#proveedores').find('tbody').empty();
        $('#proveedores').find('tbody').append('<tr><td colspan="7" class="text-center">Buscando...</td></tr>');


        var form_data = new FormData();                  
        form_data.append('id_ejercicio', $('select[name="id_ejercicio"]').val());
        var url = '<?php echo base_url() . 'index.php/tpov1/proveedores/getDatosPorproveedoresTable' ?>';

        buscar(url, form_data, init_table, 'proveedores');
    }

    var buscar = function(url_server, formData, callback, container){
        var id_tag = '#load_' + container;     
        $(id_tag).show();                    
        $.ajax({
            url: url_server, // point to server-side PHP script 
            dataType: 'JSON',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: formData,                         
            type: 'post',
            complete: function(){
                $(id_tag).hide();
            },
            error:function(){
                error_data(container);
            },
            success: function(response){
                if(response && callback){
                    callback(response, container);
                }
            }
        });
    }

    var init_grafica = function(response, container){

        $('#proveedor').html(response['total_proveedores']);

        $('#minimo').val(response['minimo']);

        if(reiniciar == true && myslider !== undefined){
            reiniciar_slider(response);
        }

        if(response['data'].length == 0){
            $('#'+container).hide();
            $('#info_not_data').html('Sin información a graficar.');
            return;
        }else{
            $('#'+container).show();
            $('#info_not_data').empty();
        }

        Highcharts.chart(container, {

            title: {
                text: null
            },
            credits: {
                enabled: false
            },
            series: [{
                keys: ['from', 'to', 'weight'],
                type: 'sankey',
                name: null,
                tooltip: {
                    nodeFormat: "{point.name}:<br/> <b>{point.sum}</b>",
                    headerFormat: "",
                    pointFormat: "{point.fromNode.name} → {point.toNode.name}<br/> Monto ejercido: <b>{point.description}<br/>{point.toNode.name}: <b>{point.weight}</b></b>"
                },
                data: response['data']
            }]

        });

    }

    var init_table = function(response, container){
        container = '#'+container;
        var monto_total = 0;
        if(Array.isArray(response)){
            $(container).find('tbody').empty();
            var monto_total = 0;
            var num = 1;
            response.map(function (e){
                var body = '<td>' + num++ + '</td>' +
                           '<td>' + e.ejercicio + '</td>' +
                           '<td>' + e.nombre + '</td>' +
                           '<td>' + e.contratos + '</td>' +
                           '<td>' + e.ordenes + '</td>' +
                           '<td>' + e.monto + '</td>' +
                           '<td><a href="' + e.link + '" class="btn btn-default btn-xs" title="Detalle" target="_blank"><i class="fa fa-link"></i></a></td>'; 

                $(container).find('tbody').append('<tr>' + body + '</tr>');
                monto_total += e.monto_sin_formato;
            });
            initDataTable();
        }else{
            $(container).find('tbody').append('<tr><td colspan="7" class="text-center">No se encontro información</td></tr>');
        }
        var total = get_monto_format(monto_total);
        $('#monto_gastado').html(total);
    }

    var reiniciar_slider = function(response){
        $('#ex1').attr('data-slider-min', response['minimo']);
        $('#ex1').attr('data-slider-max', response['maximo']);
            
        myslider.destroy();

        myslider = new Slider('#ex1', {
            formatter: function(value) {
                return '$ ' + parseFloat(value, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
            }
        });

        myslider.on("slideStop", function(value) {
            $('#minimo').val(value);
            var mxn = '$ ' + parseFloat(value, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
            $('#tagMinimo').html(mxn);
            get_valores_grafica(false);
        });
        var mxn = '$ ' + parseFloat(response['minimo'], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
        $('#tagMinimo').html(mxn);
    }

    var error_data = function(container){
        if(container == 'container'){
            $('#'+container).addClass('overlay');
            $('#'+container).html('Informacion no disponible');
        }else if(container == 'proveedores'){
            container = '#'+container;
            $(container).find('tbody').empty();
            initDataTable();
            $('#monto_gastado').html('$ 0.00');
        }
    }
    var initDataTable = function(){
        table = $('#proveedores').dataTable({
            'bPaginate': true,
            'bLengthChange': true,
            'bFilter': true,
            'bSort': true,
            'bInfo': true,
            'bAutoWidth': false,
            'aLengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],  //Paginacion
            'oLanguage': { 
                'sSearch': 'B&uacute;squeda ',
                'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
                'sInfo': 'Mostrando registros del <b>_START_</b> al <b>_END_</b> de un total de <b>_TOTAL_</b> registros',
                'sZeroRecords': 'No se encontraron resultados',
                'EmptyTable': 'Ning&uacute;n dato disponible en esta tabla',
                'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sLoadingRecords': 'Cargando...',
                'sProcessing': 'Cargando...',
                'oPaginate': {
                    'sFirst': 'Primero',
                    'sLast': '&Uacute;ltimo',
                    'sNext': 'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'sLengthMenu': '_MENU_ Registros por p&aacute;gina'
            },
            'footerCallback': function(row, data, start, end, display){
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                pageTotal3 = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over this page
                pageTotal4 = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                pageTotal5 = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                var colum_5 = '$' + parseFloat(pageTotal5, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString(); 
                
                // Update footer
                $( api.column( 3 ).footer() ).html(
                    pageTotal3
                );
                
                // Update footer
                $( api.column( 4 ).footer() ).html(
                    pageTotal4
                );

                // Update footer
                $( api.column( 5 ).footer() ).html(
                    colum_5 
                );
            }
    });
}

    var get_monto_format = function(monto){
        var total = 0, cifra = '';

        if(monto <= 1000){
            //nada
        }else if(monto <= 1000000)// miles K
        {
            total = monto / 1000;
            cifra = ' K';
        }else if(monto <= 1000000000000){ // millones M
            total = monto / 1000000;
            cifra = ' M';
        }else{ // billones B
            total = monto / 1000000000000;
            cifra = ' B';
        }

        return '$ ' + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() + cifra; 
    }

    var descargar_archivo = function(){
        var url_server = $('#link_descarga').val();
        $('#descargabtn').empty();
        $('#descargabtn').append('<i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;Descarga de datos'); 
        $.ajax({
            url: url_server, // point to server-side PHP script 
            dataType: 'JSON',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: '',                         
            type: 'post',
            complete: function(){
                $('#descargabtn').empty();
                $('#descargabtn').append('<i class="fa fa-file"></i>&nbsp;&nbsp;Descarga de datos'); 
            },
            error:function(){
            },
            success: function(response){
                window.open(response, '_blank');
            }
        });
    }

    var print_btn = function(){
        var url = $('#link_print').val() + $('select[name="id_ejercicio"]').val();
        window.open(url, '_blank', 'location=yes,height=670,width=1020,scrollbars=yes,status=yes');
    }

    var descargar_archivo_table = function(){
        var url_server = $('#link_descarga_table').val() + '/' + $('select[name="id_ejercicio"]').val();
        $('#descargabtntable').empty();
        $('#descargabtntable').append('<i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;Exportando'); 
        $.ajax({
            url: url_server, // point to server-side PHP script 
            dataType: 'JSON',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: '',                         
            type: 'post',
            complete: function(){
                $('#descargabtntable').empty();
                $('#descargabtntable').append('<i class="fa fa-file"></i>&nbsp;&nbsp;Exportar datos'); 
            },
            error:function(){
            },
            success: function(response){
                window.open(response, '_blank');
            }
        });
    }
</script>