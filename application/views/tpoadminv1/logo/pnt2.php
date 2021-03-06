<?php  
if( !( isset($_SESSION['pnt']) ) or !( isset($_SESSION["pnt"]["success"]) ) or !( $_SESSION["pnt"]["success"] ) ){
    header("Location: " . base_url() ."index.php/tpoadminv1/logo/logo/alta_carga_logo");
    die();
}
?>


<link href="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css" />


<style type="text/css">
    body { transition: background-color ease-in 3s; /* tweak to your liking */ }
    .invisible { display: none; }
    .upload{ background-color: #ff0; }
    .loading{ float: left; } 
    h4{ float: left; margin-right: 30px; margin-top: 3px;  }
    .items-formato { margin-left:0; padding: 0 }
    .items-formato li{ list-style: none; float: left; margin-right:20px; max-width: 140px;}
    .items-formato li a.btn-group{ width: 140px; background-color: #cc33ff; border-color: #cc33ff; font-weight: bolder;}
    .subitems{ width: 600px; position: relative; top: 10px; border-left: 3px solid #c3f;
               height: 30px; margin: 0; padding-left: 5px;}
    .subitems li a{ background-color: #ff00bf; }
    .here{ background-color: #0277bd !important; border-color: #0277bd !important;}
</style>

<!-- Main content -->
<section class="content">
    <h4>Ejercicios</h4>
    <select id="year">
        <option value="">Selecciona un año</option> 
    </select>

    <br><br>

    <h4>Formatos</h4>

    <ul class="items-formato">
        <li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 1)? 'here': '' ?>" id="formato_1" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=1"> 70FXXIIIA </a> </li>
        <li> 
            <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 2)? 'here': '' ?>" id="formato_2" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=2"> 70FXXIIIB </a> 
            <ul class="subitems">
                <li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 21)? 'here': '' ?>" id="formato_21" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=21"> 70FXXIIIB1 </a> </li>
                <li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 22)? 'here': '' ?>" id="formato_22" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=22"> 70FXXIIIB2 </a> </li>
                <li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 23)? 'here': '' ?>" id="formato_23" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=23"> 70FXXIIIB3 </a> </li>
                
            </ul>
        </li>
        <li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 3)? 'here': '' ?>" id="formato_3" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=3"> 70FXXIIIC </a> </li>
        <li> <a class="btn-group btn btn-info btn-sm <?php echo ($formato == 4)? 'here': '' ?>" id="formato_4" href="<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/pnt?formato=4"> 70FXXIIID </a> </li>
    </ul>

    <br><br><br>
    <h2> Contratación de Servicios en Publicidad Oficial </h2>
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
                <!--img class='loading' src='<?php echo base_url(); ?>plugins/img/loading3.gif'-->
            </tr> 
        </tbody>
    </table>
</section>

<section id="detalles"> </section>


<!--script type="text/javascript" src="<?php echo base_url(); ?>plugins/jQuery/jQuery-3.3.1.js"></script-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.0.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>plugins/sanitizer/sanitizer.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>plugins/colorbox/jquery.colorbox.js"></script>

<link href="<?php echo base_url(); ?>plugins/DataTables2/datatables.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>plugins/DataTables2/datatables.min.js" type="text/javascript" ></script>

<script type="text/javascript">

    $(document).ready(function(){
    $.fn.dataTable.ext.errMode = 'none';

        var ejercicios_url =  "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/ejercicios"
    
    $.post(ejercicios_url, function(res, error){
        if(res) {
            for( var i = 0 in res)
                $("#year").append("<option value='" + res[i].ejercicio + "'>" + res[i].ejercicio + "</option>")
        }
    });

    $("#formato_<?php echo $formato?>").css("background-color:", "#0277bd")

        $.fn.dataTable.ext.search.push( function( settings, data, dataIndex ){
            var year = $('#year').val()
            var ejercicio = parseInt( data[3] ) || 0; 

            if (year == "") return true
            return (year == ejercicio);
        });

        $('#year').change( function() { table.draw(); });
        
        table = $('#grid').DataTable({
            ajax: {
                url: "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/registros2",
                dataSrc: ''
            },
            scrollY: true,
            scrollX: true,
            columns: [
                { data: 'id_tpo' },
                { data: 'id_pnt' },
                { data: 'id_factura' },
                { data: 'ejercicio' },
                { data: 'fecha_inicio' },
                { data: 'fecha_termino' },
                { data: 'funcion_sujeto' },
                { data: 'area_administrativa' },
                { data: 'id_servicio_clasificacion' },
                { data: 'nombre_servicio_categoria' },
                { data: 'id_servicio_subcategoria' },
                { data: 'nombre_servicio_unidad' },
                { data: 'tipo' },
                { data: 'nombre_campana_aviso' },
                { data: 'periodo' },
                { data: 'nombre_campana_tema' },
                { data: 'campana_objetivo' },
                { data: 'objetivo_comunicacion' },
                { data: 'precio_unitarios' },
                { data: 'clave_campana' },
                { data: 'autoridad' },
                { data: 'cobertura' },
                { data: 'campana_ambito_geo' },
                { data: 'fecha_inicio_cam' },
                { data: 'fecha_termino_cam' },
                { data: 'sexo' },
                { data: 'poblaciones' },
                { data: 'nivel_educativo' },
                { data: 'rangos_edad' },
                { data: 'poblacion_nivel' },
                { data: 'resp_pro_con' },
                { data: 'area_responsable' },
                { data: 'fecha_validacion' },
                { data: 'fecha_actualizacion' },
                { data: 'nota' },
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
                    targets: 35,
                    data: "data",
                    render: function ( data, type, row, meta ) {
                        var response = ""
                        //_row = HtmlSanitizer.SanitizeHtml(JSON.stringify(row)) 
                        _row = JSON.stringify(row)

                        if( !(row.id_pnt) || row.id_pnt === ""){ 
                            response += "<a class='tpo_btn crear' href='#' data='" + _row + "'>" 
                            response += "<span class='btn btn-success'><i class='fa fa-plus-circle'></i>  </span> </a>"

                            response += "<a class='tpo_btn eliminar invisible' href='#' data='" + _row + "'>" 
                            response += "<span class='btn btn-danger btn-sm'><i class='fa fa-close'></i>  </span> </a>"

                            response += "<a class='tpo_btn editar invisible' href='#' data='" + _row + "'>" 
                            response += "<span class='btn btn-warning btn-sm'> <i class='fa fa-edit'></i>  </span></a>"
                        }else{
                            response += "<a class='tpo_btn crear invisible' href='#' data='" + _row + "'>" 
                            response += "<span class='btn btn-success'><i class='fa fa-plus-circle'></i> </span> </a>"

                            response += "<a class='tpo_btn eliminar' href='#' data='" + _row + "'>" 
                            response += "<span class='btn btn-danger btn-sm'><i class='fa fa-close'></i>  </span> </a>"

                            response += "<a class='tpo_btn editar' href='#' data='" + _row + "'>" 
                            response += "<span class='btn btn-warning btn-sm'> <i class='fa fa-edit'></i>  </span></a>"
                        }

                        response += "<a class='tpo_btn ver_mas' href='#' data='" + row.resp_pro_con + "'>" 
                        response += "<span class='btn btn-warning btn-sm'> <i class='fa fa-edit'></i>  Ver más información </span></a>"
                        
                        return response
                    }
                },
                {
                    targets: [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34],
                    data: "data",
                    render: function ( data, type, row, meta ) {
                        if( !(row.id_pnt) || row.id_pnt === ""){ 
                            if(!data) return "<label class='btn'> <small> N/D </small></label>"
                            return data
                       //} else return "<input type='text' value='" + data + "'>" 
                        } else return data
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

            var ids = $(this).siblings("a.ver_mas").attr("data").split("-")

            formato = {
                "idFormato": "43320", //"Contratación de servicios de publicidad oficial"
                "IdRegistro": "",
                "token": '<?php echo $_SESSION["pnt"]["token"]["token"]; ?>',
                "correoUnidadAdministrativa": '<?php echo $_SESSION["user_pnt"]; ?>' ,
                "unidadAdministrativa": '<?php echo $_SESSION["unidad_administrativa"]; ?>',
                "SujetoObligado": '<?php echo $_SESSION["sujeto_obligado"]; ?>',
                "registros": [{
                    "numeroRegistro": 1,
                    "campos": [
                        {"idCampo": 333943, "valor": ( data["ejercicio"] != null )? data["ejercicio"] : '' },
                        {"idCampo": 333963, "valor": ( data["fecha_inicio"] != null )? data["fecha_inicio"].split('-').reverse().join('/') : '' },
                        {"idCampo": 333964, "valor": ( data["fecha_termino"] != null )? data["fecha_termino"].split('-').reverse().join('/') : '' },
                        {"idCampo": 333962, "valor": parseInt(data["funcion_sujeto"]) },
                        {"idCampo": 333950, "valor": data["area_administrativa"]},
                        {"idCampo": 333968, "valor": data["id_servicio_clasificacion"]},
                        {"idCampo": 333940, "valor": data["nombre_servicio_categoria"]},
                        //{"idCampo": 333969, "valor": data["id_servicio_subcategoria"] },
                        {"idCampo": 333970, "valor": data["nombre_servicio_unidad"]},
                        {"idCampo": 333956, "valor": parseInt(data["tipo"]) },
                        {"idCampo": 333947, "valor": data["nombre_campana_aviso"]},
                        {"idCampo": 333942, "valor": data["periodo"]},
                        {"idCampo": 333948, "valor": data["nombre_campana_tema"]},
                        {"idCampo": 333951, "valor": data["campana_objetivo"]},
                        {"idCampo": 333949, "valor": data["objetivo_comunicacion"]},
                        {"idCampo": 333972, "valor": data["precio_unitarios"]},
                        {"idCampo": 333944, "valor": data["clave_campana"]},
                        {"idCampo": 333973, "valor": data["autoridad"]},
                        {"idCampo": 333955, "valor": parseInt(data["cobertura"]) },
                        {"idCampo": 333971, "valor": data["campana_ambito_geo"]},
                        {"idCampo": 333952, "valor": ( data["fecha_inicio_cam"] != null )? data["fecha_inicio_cam"].split('-').reverse().join('/') : '' },
                        {"idCampo": 333953, "valor": ( data["fecha_termino_cam"] != null )? data["fecha_termino_cam"].split('-').reverse().join('/') : '' },
                        {"idCampo": 333965, "valor": parseInt(data["sexo"]) },
                        {"idCampo": 333946, "valor": data["poblaciones"]},
                        {"idCampo": 333941, "valor": data["nivel_educativo"]},
                        {"idCampo": 333945, "valor": data["rangos_edad"]},
                        {"idCampo": 333974, "valor": data["poblacion_nivel"]},
                        //(data.fecha_termino_periodo != null)? data.fecha_termino_periodo.split('-').reverse().join('/') : ''
                        {"idCampo": 333967, "valor": (data["area_responsable"] != null )? data["area_responsable"] : ''},
                        {"idCampo": 333954, "valor": (data["fecha_validacion"] != null )? data["fecha_validacion"].split('-').reverse().join('/') : '' },
                        {"idCampo": 333961, "valor": (data["fecha_actualizacion"] != null )? data["fecha_actualizacion"].split('-').reverse().join('/') : '' },
                        {"idCampo": 333966, "valor": data["nota"]}//
                    ]
                }],
              "_id_interno": data["id_factura"],
              "id_factura": ids[1],
              "id_contrato": ids[3]
            }

            $.post(url, formato, function(res, error){
                res = JSON.parse(res); console.log(res, error)
                if(!res || !('success' in res) ){
                    console.log("No se pudo insertar el elemento correctamente")
                    a.css("display", "block")
                } else {
                    tr.children("td").eq(1).text(res.id_pnt)
                    tr.children("td").eq(35).children("a.eliminar").removeClass("invisible")
                    tr.children("td").eq(35).children("img.check").removeClass("invisible")
                    tr.children("td").eq(35).children("a.crear").addClass("invisible")
                    location.reload();
                }

                td.children("img.loading").remove("")
                
                if(tr.hasClass("odd")) tr.css("background-color", "#f9f9f9")
                else tr.css("background-color", "#fff")

            })


        });

        $(document).on("click","a.ver_mas",function(e){ 
            e.preventDefault();
            var ids= $(this).attr("data").split("-")
            var url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/registros50";
            

            $.get(url, { id_factura: ids[1], id_contrato: ids[3] },  function(res, error){
                function get_subtables(tag, data){
                    var res = "<tr><td> <h3> Datos de " + tag + " </h3> "
                    for (var key in data){
                        if(data[key] == "") continue;
                        res += "<p> <b>" + key.toUpperCase() + ": </b>" + data[key] + "</p>"
                    }
                    return res + "</td></tr>";
                }

                var html = "<table>"
                    html += get_subtables("Facturas", res.facturas[0])
                    html += get_subtables("Contratos", res.contratos[0])
                    html += get_subtables("Presupuestos", res.presupuestos[0])
                    html += "</table>"

                $.colorbox({html: html});
                
            })
        })

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
                "idFormato": "43320", 
                "correoUnidadAdministrativa": '<?php echo $_SESSION["user_pnt"]; ?>',
                "token": token,
                "registros":[ { "numeroRegistro":1, "idRegistro": data.id_pnt || id_pnt } ],
                "id_pnt": data.id_pnt || id_pnt
            }

            var url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/eliminar_pnt"

            $.post(url, formato, function(res, error){
                if(res && ('success' in res) )  
                if(!res || !('success' in res) ){
                    console.log("No se pudo eliminar el elemento correctamente")
                    a.css("display", "block")
                    a.siblings().css("display", "block")
                } else {
                    tr.children("td").eq(1).html("<label class='btn'> <small> SIN SUBIR </small></label>")
                    tr.children("td").eq(35).children("a.eliminar").addClass("invisible")
                    tr.children("td").eq(35).children("img.check").addClass("invisible")
                    tr.children("td").eq(35).children("a.crear").css("display", "block")
                    location.reload();
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