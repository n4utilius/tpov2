

CREATE TABLE `rel_pnt_factura` (
  `id_factura` int(20) DEFAULT NULL,
  `id_pnt` int(20) DEFAULT NULL,
  `estatus_pnt` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) 

	SELECT f.id_factura, pnt.id_pnt, f.id_ejercicio, p.fecha_inicio_periodo,
	   p.fecha_termino_periodo, so.funcion, scla.nombre_servicio_clasificacion,
	   scat.nombre_servicio_categoria, suni.nombre_servicio_unidad, ctip.nombre_campana_tipo, 
	   e.ejercicio, ctem.nombre_campana_tema, cobj.campana_objetivo, cam.objetivo_comunicacion,
	   cam.autoridad, cam.clave_campana, cam.campana_ambito_geo, cam.fecha_inicio, cam.fecha_termino,
	   rsex.id_poblacion_sexo, rlug.poblacion_lugar, edu.nombre_poblacion_nivel_educativo,
	   eda.nombre_poblacion_grupo_edad, CONCAT(f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor),
	   cam.fecha_validacion, cam.fecha_actualizacion, cam.nota, pnt.estatus_pnt
	FROM tab_facturas f
	JOIN tab_presupuestos_desglose pd ON pd.id_presupuesto_concepto = f.id_presupuesto_concepto
	JOIN tab_presupuestos p ON p.id_presupuesto = pd.id_presupuesto 
	JOIN vsujetosobligados so ON so.id_sujeto_obligado = p.id_sujeto_obligado
	JOIN tab_facturas_desglose fd ON fd.id_factura = f.id_factura 
	JOIN cat_servicios_clasificacion scla ON scla.id_servicio_clasificacion = fd.id_servicio_clasificacion
	JOIN cat_servicios_categorias scat ON scat.id_servicio_categoria = fd.id_servicio_categoria 
	JOIN cat_servicios_unidades suni ON suni.id_servicio_unidad = fd.id_servicio_unidad 
	JOIN tab_campana_aviso cam ON cam.id_campana_aviso = fd.id_campana_aviso
	JOIN cat_campana_tipos ctip ON ctip.id_campana_tipo = cam.id_campana_tipo 
	JOIN cat_ejercicios e ON e.id_ejercicio = cam.id_ejercicio 
	JOIN cat_campana_temas ctem ON ctem.id_campana_tema = cam.id_campana_tema 
	JOIN cat_campana_objetivos cobj ON cobj.id_campana_objetivo = cam.id_campana_objetivo 
	JOIN rel_campana_sexo rsex ON rsex.id_campana_aviso = cam.id_campana_aviso 
	JOIN rel_campana_lugar rlug ON rlug.id_campana_aviso = cam.id_campana_aviso
	JOIN rel_campana_nivel_educativo redu ON redu.id_campana_aviso = cam.id_campana_aviso
	JOIN cat_poblacion_nivel_educativo edu ON edu.id_poblacion_nivel_educativo = redu.id_poblacion_nivel_educativo
	JOIN rel_campana_grupo_edad reda ON reda.id_campana_aviso = cam.id_campana_aviso
	JOIN cat_poblacion_grupo_edad eda ON eda.id_poblacion_grupo_edad = reda.id_poblacion_grupo_edad
	JOIN rel_campana_nivel reco ON reco.id_campana_aviso = cam.id_campana_aviso
	JOIN cat_poblacion_nivel eco ON eco.id_poblacion_nivel = reco.id_poblacion_nivel
	LEFT JOIN rel_pnt_factura pnt ON pnt.id_factura = f.id_factura;

	SELECT f.id_factura, pnt.id_pnt, f.id_ejercicio, p.fecha_inicio_periodo,
	   p.fecha_termino_periodo, so.funcion, scla.nombre_servicio_clasificacion,
	   scat.nombre_servicio_categoria, suni.nombre_servicio_unidad,
	   CONCAT(f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor)
	FROM tab_facturas f
	JOIN tab_presupuestos_desglose pd ON pd.id_presupuesto_concepto = f.id_presupuesto_concepto
	JOIN tab_presupuestos p ON p.id_presupuesto = pd.id_presupuesto 
	JOIN vsujetosobligados so ON so.id_sujeto_obligado = p.id_sujeto_obligado
	JOIN tab_facturas_desglose fd ON fd.id_factura = f.id_factura 
	JOIN cat_servicios_clasificacion scla ON scla.id_servicio_clasificacion = fd.id_servicio_clasificacion
	JOIN cat_servicios_categorias scat ON scat.id_servicio_categoria = fd.id_servicio_categoria 
	JOIN cat_servicios_unidades suni ON suni.id_servicio_unidad = fd.id_servicio_unidad 
	LEFT JOIN rel_pnt_factura pnt ON pnt.id_factura = f.id_factura;


SELECT f.id_factura, pnt.id_pnt, f.id_ejercicio, p.fecha_inicio_periodo,
	   p.fecha_termino_periodo, so.funcion, scla.nombre_servicio_clasificacion,
	   scat.nombre_servicio_categoria, suni.nombre_servicio_unidad,
	   CONCAT(f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor) as referencia
	FROM tab_facturas f
	JOIN tab_presupuestos_desglose pd ON pd.id_presupuesto_concepto = f.id_presupuesto_concepto
	JOIN tab_presupuestos p ON p.id_presupuesto = pd.id_presupuesto 
	JOIN vsujetosobligados so ON so.id_sujeto_obligado = p.id_sujeto_obligado
	JOIN tab_facturas_desglose fd ON fd.id_factura = f.id_factura 
	JOIN cat_servicios_clasificacion scla ON scla.id_servicio_clasificacion = fd.id_servicio_clasificacion
	JOIN cat_servicios_categorias scat ON scat.id_servicio_categoria = fd.id_servicio_categoria 
	JOIN cat_servicios_unidades suni ON suni.id_servicio_unidad = fd.id_servicio_unidad 
	LEFT JOIN rel_pnt_factura pnt ON pnt.id_factura = f.id_factura;


SELECT f.id_factura, f.id_ejercicio,p.fecha_inicio_periodo, p.fecha_termino_periodo,
	   CONCAT(f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor) as referencia
	FROM tab_facturas f, 
	JOIN (Select pd.id_presupuesto_concepto, pd.id_presupuesto, p.fecha_inicio_periodo, p.fecha_termino_periodo
			from tab_presupuestos_desglose pd
			INNER JOIN tab_presupuestos p ON p.id_presupuesto = pd.id_presupuesto) p 
	ON p.id_presupuesto_concepto = f.id_presupuesto_concepto


Select pd.id_presupuesto, p.fecha_inicio_periodo, p.fecha_termino_periodo
from tab_presupuestos_desglose pd
INNER JOIN tab_presupuestos p ON p.id_presupuesto = pd.id_presupuesto;

SELECT f.id_factura, f.id_ejercicio,p.fecha_inicio_periodo, p.fecha_termino_periodo,
CONCAT(f.id_factura, '-', f.id_orden_compra, '-', f.id_contrato, '-', f.id_proveedor) as referencia
FROM tab_facturas f
LEFT JOIN tab_presupuestos_desglose pd ON pd.id_presupuesto_concepto = f.id_presupuesto_concepto
LEFT JOIN tab_presupuestos p ON p.id_presupuesto = pd.id_presupuesto;


