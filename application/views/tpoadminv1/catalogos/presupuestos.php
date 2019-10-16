<?php

/* 
 *  INAI TPO
 */

?>

<!-- Main content -->
<section class="content">
    <?php
        if ($this->session->flashdata('error'))
        {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-ban"></i> ¡Error!</h4>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php
        }
    ?>

    <?php
    if ($this->session->flashdata('exito'))
    {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4>	<i class="icon fa fa-check"></i> ¡Exito!</h4>
        <?php echo $this->session->flashdata('exito'); ?>
    </div>
    <?php
    }
    ?>

    <?php
        if ($this->session->flashdata('alert'))
        {
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
            <?php echo $this->session->flashdata('alert'); $this->session->set_flashdata('alert', ''); ?>
        </div>
        <?php
        }
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?php echo anchor("tpoadminv1/catalogos/catalogos/agregar_presupuesto", "<button class='btn btn-success'><i class=\"fa fa-plus-circle\"></i> Agregar</button></td>"); ?>
                    <div class="pull-right">
                        <a class="btn btn-default" <?php echo $print_onclick   ?>><i class="fa fa-print"></i> Imprimir</a>
                        <a class="btn btn-default" href="<?php echo base_url() . $path_file_csv ?>" download="<?php echo $name_file_csv ?>"><i class="fa fa-file"></i> Exportar a Excel</a>
                    </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                    <table id="presupuestos" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cap&iacute;tulo</th>
                                <th>Concepto</th>
                                <th>Partida</th>
                                <th>Denominaci&oacute;n</th>
                                <th>Descripci&oacute;n</th>
                                <th>Captura</th>
                                <th>Estatus</th>
                                <th style="width: 12px;"></th>
                                <th style="width: 12px;"></th>
                                <th style="width: 12px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $c_replace = array('\'', '"');
                                for($z = 0; $z < sizeof($presupuestos); $z++)
                                {
                                    echo '<tr>';
                                    echo '<td>' . $presupuestos[$z]['id_presupesto_concepto'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['capitulo'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['concepto'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['partida'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['denominacion'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['descripcion'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['id_captura'] . '</td>';
                                    echo '<td>' . $presupuestos[$z]['active'] . '</td>';
                                    echo "<td> <span class='btn-group btn btn-info btn-sm' onclick=\"abrirModal(" . $presupuestos[$z]['id_presupesto_concepto'] . ")\"> <i class='fa fa-search'></i></span></td>";
                                    echo '<td>' . anchor("tpoadminv1/catalogos/catalogos/editar_presupuesto/".$presupuestos[$z]['id_presupesto_concepto'], "<button class='btn btn-warning btn-sm' title='Editar'><i class=\"fa fa-edit\"></i></button></td>"); 
                                    echo "<td> <span class='btn-group btn btn-danger btn-sm' onclick=\"eliminarModal(" . $presupuestos[$z]['id_presupesto_concepto'] . ", '".  str_replace($c_replace, "", $presupuestos[$z]['partida']) . "')\"> <i class='fa fa-close'></i></span></td>";
                                    
									
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<!-- Modal Details-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Detalle</h3>
        </div>
        <div class="modal-body">
            <div id="loading_modal" class="text-center" ></div>
            <table id="table_modal" class="table form-horizontal">
                <tbody>
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Capitulo* </b>
                        </td>
                        <td class="col-sm-8" id="item_1"></td>
                    </tr>        
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Concepto* </b>
                        </td>
                        <td class="col-sm-8" id="item_2"></td>
                    </tr>           
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Partida* </b>
                        </td>
                        <td class="col-sm-8" id="item_3"></td>
                    </tr>     
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Denominaci&oacute;n* </b>
                        </td>
                        <td class="col-sm-8" id="item_4"></td>
                    </tr>
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Descripci&oacute;n* </b>
                        </td>
                        <td class="col-sm-8" id="item_5"></td>
                    </tr>
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Captura* </b>
                        </td>
                        <td class="col-sm-8" id="item_6"></td>
                    </tr>
                    <tr class="form-group">
                        <td class="control-label col-sm-4"><b>Estatus*</b></td>
                        <td class="col-sm-8" id="item_7"></td>
                    </tr>       
                </tbody>
            </table> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalDelete" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Eliminar registro</h3>
        </div>
        <div class="modal-body">
            <div id="mensaje_modal">
                ¿Desea eliminar el registro?
            </div>
        </div>
        <div class="modal-footer" id="footer_btns">
            
        </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    
    var eliminarModal = function(id, name){
        var html_btns = '<button type="button" class="btn btn-danger" onclick="eliminar('+id+')">Si</button>' +
                   '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>';
        $('#myModalDelete').find('#footer_btns').html(html_btns);
        $('#myModalDelete').find('#mensaje_modal').html('¿Desea eliminar la partida presupuestar&iacute;a  <b>' + name+ '</b>?');
        $('#myModalDelete').modal('show');
    }

    var eliminar = function (id){
        window.location.href = "eliminar_presupuesto/" + id;
    }

    var abrirModal = function(id){
        //utlizar cuando haya más campos
        $.ajax({
            url: '<?php echo base_url() . 'index.php/tpoadminv1/catalogos/catalogos/get_presupuesto/' ?>'+id,
            data: {action: 'test'},
            dataType:'JSON',
            beforeSend: function () {
                //Loading('Buscando');
                $('#myModal').find('#loading_modal').html('<span><i class="fa fa-spinner"><i> Cargando...</span>'); 
            },
            complete: function () {
                //Loading();
                $('#myModal').find('#loading_modal').html(''); 
            },
            error:function () {
                $('#myModal').modal('hide');
            },
            success: function (response) {
                if(response){
                    $('#myModal').find('#item_1').html(response.capitulo);
                    $('#myModal').find('#item_2').html(response.concepto);
                    $('#myModal').find('#item_3').html(response.partida);
                    $('#myModal').find('#item_4').html(response.denominacion);
                    $('#myModal').find('#item_5').html(response.descripcion);
                    $('#myModal').find('#item_6').html(response.id_captura);
                    $('#myModal').find('#item_7').html(response.active);
                    $('#myModal').modal('show'); 
                }
            }
        });
    }
    
</script>