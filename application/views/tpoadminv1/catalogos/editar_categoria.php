
<?php

/* 
 * INAI TPO
 */

?>
<?php
    $sel_estatus = '';
    $lista_estatus = ['Activo','Inactivo'];
    $lista_estatus_ids = ['1','2'];
    for($z = 0; $z < sizeof($lista_estatus_ids); $z++)
    {
        if($categoria['active'] == $lista_estatus_ids[$z]){
            $sel_estatus .= '<option value="'.$lista_estatus_ids[$z].'" selected>' . $lista_estatus[$z] . '</option>';
        }else{
            $sel_estatus .= '<option value="'.$lista_estatus_ids[$z].'">' . $lista_estatus[$z] . '</option>';
        }
        
    }

    $sel_clasificacion = '<option value="">-nada-</option>';
    for($z = 0; $z < sizeof($clasificacion); $z++)
    {
        if($categoria['id_servicio_clasificacion'] == $clasificacion[$z]['id_servicio_clasificacion']){
            $sel_clasificacion .= '<option value="'.$clasificacion[$z]['id_servicio_clasificacion'].'" selected>' . $clasificacion[$z]['nombre_servicio_clasificacion'] . '</option>';
        }else{
            $sel_clasificacion .= '<option value="'.$clasificacion[$z]['id_servicio_clasificacion'].'">' . $clasificacion[$z]['nombre_servicio_clasificacion'] . '</option>';
        }
    }
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
        <form role="form" method="post" action="<?php echo base_url(); ?>index.php/tpoadminv1/catalogos/servicios/validate_editar_categoria" enctype="multipart/form-data" >
            <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                <input type="hidden" value="<?php echo $categoria['id_servicio_categoria'] ?>" class="form-control" name="id_servicio_categoria"/>
                    <div class="form-group">
                        <label>Clasificaci&oacute;n del servicio*</label>
                        <select class="form-control" name="id_servicio_clasificacion">
                            <?php echo $sel_clasificacion; ?>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Categor&iacute;a del servicio*</label>
                         <?php $class = "form-control";
                            echo form_input(array('type' => 'text', 'name' => 'nombre_servicio_categoria', 'value' => $categoria['nombre_servicio_categoria'], 'class' => $class)); ?>
                    </div>
                    <div class="form-group">
                        <label>T&iacute;tulo gr&aacute;fica*</label>
                        <?php $class = "form-control";
                            echo form_input(array('type' => 'text', 'name' => 'titulo_grafica', 'value' => $categoria['titulo_grafica'], 'class' => $class)); ?>
                    </div>
                    <div class="form-group">
                        <label>Color gr&aacute;fica*</label>
                        <?php $class = "form-control";
                            echo form_input(array('type' => 'text', 'name' => 'color_grafica', 'value' => $categoria['color_grafica'], 'class' => $class)); ?>
                    </div>
                    <div class="form-group">
                        <label>Estatus*</label>
                        <select class="form-control" name="active">
                            <?php echo $sel_estatus; ?>
                        </select>
                    </div> 
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <?php echo anchor("tpoadminv1/catalogos/servicios/busqueda_categorias", "<button class='btn btn-default' type='button'>Regresar</button></td>"); ?>
                </div>     
            </div><!-- /.box -->    
            <?php 
                if(validation_errors() == TRUE)
                {
                    echo '<div class="alert alert-danger"><button class="close"  data-dismiss="alert">x</button>
                    <h4><i class="icon fa fa-ban"></i>¡Alerta!</h4>' . validation_errors() . '</div>';  
                }
            ?>
        </form>
    </div>
</section>