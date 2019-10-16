
<?php

/* 
 *INAI
 */

?>
<?php
    $sel_estatus = '';
    $lista_estatus = ['Activo','Inactivo'];
    $lista_estatus_ids = ['1','2'];
    for($z = 0; $z < sizeof($lista_estatus_ids); $z++)
    {
        if( $atribucion_estatus == 'null' )
        {
            if($lista_estatus_ids[$z] == '1' ){
                $sel_estatus .= '<option value="'.$lista_estatus_ids[$z].'" selected>' . $lista_estatus[$z] . '</option>';
            }else{
                $sel_estatus .= '<option value="'.$lista_estatus_ids[$z].'">' . $lista_estatus[$z] . '</option>';
            }
        } else{
            if( $lista_estatus_ids[$z] == $atribucion_estatus ){
                $sel_estatus .= '<option value="'.$lista_estatus_ids[$z].'" selected>' . $lista_estatus[$z] . '</option>';
            }else{
                $sel_estatus .= '<option value="'.$lista_estatus_ids[$z].'">' . $lista_estatus[$z] . '</option>';
            }
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
        <form role="form" method="post" action="<?php echo base_url(); ?>index.php/tpoadminv1/catalogos/catalogos/validate_agregar_atribucion" enctype="multipart/form-data" >
            <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" value="" class="form-control" name="id_so_atribucion"/>
                    <div class="form-group">
                        <label>Funci&oacute;n del sujeto obligado*</label>
                        <?php $class = "form-control";
                            echo form_input(array('type' => 'text', 'name' => 'nombre_so_atribucion', 'value' => $atribucion_nombre, 'class' => $class)); ?>
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
                    <?php echo anchor("tpoadminv1/catalogos/catalogos/busqueda_atribuciones", "<button class='btn btn-default' type='button'>Regresar</button></td>"); ?>
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