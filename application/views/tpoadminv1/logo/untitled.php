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
			  , token = "NzdhOGQ1MGY2YzdhZmZmNnNvLmluYWlAaW5haS5vcmcubXhTdW4gTWFyIDIyIDEzOjIyOjUwIENTVCAyMDIwc2lwb3RbQkA2MGFhMjhlYg=="
			  , url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/agregar_pnt";
			
			var a = $(this)
		      , tr = a.parents("tr")
		      , td = a.parents("td")

		    a.css("display", "none")
		    tr.css("background-color", "rgba(0,255,0, 0.2)")
		    td.prepend("<img class='loading' src='<?php echo base_url(); ?>plugins/img/loading.gif'>")

		    formato = {
				"idFormato": "43320", /*"Contratación de servicios de publicidad oficial"*/
				"IdRegistro": "",
				"token": "NjQzNDM2MTIyOGU5NmEzMnNvLmluYWlAaW5haS5vcmcubXhTdW4gTWFyIDA4IDE1OjUxOjA2IENTVCAyMDIwc2lwb3RbQkAzZTI5OWQ1OQ==",
				"correoUnidadAdministrativa": "so.inai@inai.org.mx",
				"unidadAdministrativa": "Dirección General de Comunicación Social y Difusión",
				"SujetoObligado": "INAI",
				"registros": [{
				    "numeroRegistro": 30,
				    "campos": [
				    	{"idCampo": 333943, "valor": data["Ejercicio"] },
						{"idCampo": 333963, "valor": data["Fecha de inicio del periodo que se informa"]},
						{"idCampo": 333964, "valor": data["Fecha de término del periodo que se informa"]},
						{"idCampo": 333962, "valor": data["Función del Sujeto Obligado (catálogo)"]},
						{"idCampo": 333950, "valor": data["Área administrativa Encargada de Solicitar El Servicio o Producto, en su caso"]},
						{"idCampo": 333968, "valor": data["Clasificación Del(los) Servicios (catálogo)"]},
						{"idCampo": 333940, "valor": data["Tipo de Servicio<"]},
						{"idCampo": 333969, "valor": data["Tipo de Medio(catálogo)"]},
						{"idCampo": 333970, "valor": data["Descripción de Unidad"]},
						{"idCampo": 333956, "valor": data["Tipo (catálogo)"]},
						{"idCampo": 333947, "valor": data["Nombre de la Campaña o Aviso Institucional"]},
						{"idCampo": 333942, "valor": data["Año de la Campaña"]},
						{"idCampo": 333948, "valor": data["Tema de la Campaña o Aviso Institucional"]},
						{"idCampo": 333951, "valor": data["Objetivo Institucional"]},
						{"idCampo": 333949, "valor": data["Objetivo de Comunicación"]},
						{"idCampo": 333972, "valor": data["Costo por unidad"]},
						{"idCampo": 333944, "valor": data["Clave Única de Indentificación de Campaña"]},
						{"idCampo": 333973, "valor": data["Autoridad que proporcionó la Clave"]},
						{"idCampo": 333955, "valor": data["Cobertura (catálogo)"]},
						{"idCampo": 333971, "valor": data["Ámbito Geográfico de Cobertura"]},
						{"idCampo": 333952, "valor": data["Fecha de inicio de la Campaña o Aviso Institucional"]},
						{"idCampo": 333953, "valor": data["Fecha de término de la Campaña o Aviso Institucional"]},
						{"idCampo": 333965, "valor": data["Sexo (catálogo)"]},
						{"idCampo": 333946, "valor": data["Lugar de Residencia"]},
						{"idCampo": 333941, "valor": data["Nivel Educativo"]},
						{"idCampo": 333945, "valor": data["Grupos de Edad"]},
						{"idCampo": 333974, "valor": data["Nivel Socioeconómico"]},
						/* {"idCampo": 333957, "valor": "Respecto a los proveedores y su contratación"}, */
						/*
						{"idCampo": 43256, "valor": "Razón social"},
						{"idCampo": 43257, "valor": "Nombre(s)"},
						{"idCampo": 43258, "valor": "Primer apellido"},
						{"idCampo": 43259, "valor": "Segundo apellido"},
						{"idCampo": 43260, "valor": "Registro Federal de Contribuyente"},
						{"idCampo": 43261, "valor": "Procedimiento de contratación"},
						{"idCampo": 43262, "valor": "Fundamento jurídico del proceso de contratación"},
						{"idCampo": 43263, "valor": "Descripción breve del las razones que justifican"},
						{"idCampo": 43264, "valor": "Nombre(s) de los proveedores y/o responsables"},
						{"idCampo": 333958, "valor": "Respecto a los recursos y el presupuesto"},
						{"idCampo": 43265, "valor": "Partida genérica"},
						{"idCampo": 43266, "valor": "Clave del concepto"},
						{"idCampo": 43267, "valor": "Nombre del concepto"},
						{"idCampo": 43268, "valor": "Presupuesto asignado por concepto"},
						{"idCampo": 43269, "valor": "Presupuesto ejercido al periodo reportado de cada partida"},
						{"idCampo": 43270, "valor": "presupuesto total ejercido por concepto"},
						{"idCampo": 43271, "valor": "Denominación de cada partida"},
						{"idCampo": 43272, "valor": "Presupuesto total asignado a cada partida"},
						{"idCampo": 43273, "valor": "Presupuesto modificado por partida"},
						{"idCampo": 43274, "valor": "Presupuesto modificado por concepto"},
						{"idCampo": 333959, "valor": "Respecto al contrato y los montos"},
						{"idCampo": 43275, "valor": "Fecha de firma del contrato"},
						{"idCampo": 43276, "valor": "Número o referencia de identificación del contrato"},
						{"idCampo": 43277, "valor": "Objeto del contrato"},
						{"idCampo": 43278, "valor": "Hipervínculo al contrato firmado"},
						{"idCampo": 43279, "valor": "hipervínculo al convenio modificatorio, en su caso"},
						{"idCampo": 43280, "valor": "Monto total del contrato"},
						{"idCampo": 43281, "valor": "Monto pagado al periodo publicado"},
						{"idCampo": 43282, "valor": "Fecha de inicio de los servicios contratados"},
						{"idCampo": 43283, "valor": "Fecha de término de los servicios contratados"},
						{"idCampo": 43284, "valor": "Número de factura"},
						{"idCampo": 43285, "valor": "Hipervínculo a la factura"},
						*/
						{"idCampo": 333967, "valor": data["Área(s) Responsable(s) que generan(n) posee(n), Publica(n) y Actualiza(n) la información"]},
						{"idCampo": 333954, "valor": data["Fecha de Validación"]},
						{"idCampo": 333961, "valor": data["Fecha de Actualización"]},
						{"idCampo": 333966, "valor": data["Nota"]}//
				    ]
				}],
			  "id_factura": data["ID FACTURA"]
			}
	    	$.post(url, formato, function(res, error){
	    		if(res && res.success) {
	    			tr.children("td").eq(1).text(res.id_pnt)
	    			tr.children("td").eq(13).children("a.eliminar").removeClass("invisible")
	    			tr.children("td").eq(13).children("img.check").removeClass("invisible")
	    			tr.children("td").eq(13).children("a.crear").remove()
	    		} else {
	    			console.log("No se pudo insertar el elemento correctamente")
	    			a.css("display", "block")
	    		}

    			td.children("img.loading").remove("")
    			if(tr.hasClass("odd"))
    				tr.css("background-color", "#f9f9f9")
    			else
    				tr.css("background-color", "#fff")

	    	})
	    });

	   

		$(document).on("click","a.eliminar",function(e){ 
	    	e.preventDefault();
	    	data = JSON.parse( $(this).attr("data")  )
			token = "MWQxMzIxM2UxMjM0NTJiNnNvLmluYWlAaW5haS5vcmcubXhGcmkgTWFyIDIwIDE5OjA3OjIyIENTVCAyMDIwc2lwb3RbQkA1OWU2YzE0Yw=="

			formato = {
				"idFormato": 43322, 
				"correoUnidadAdministrativa": "so.inai@inai.org.mx",
				"token": token,
				"registros":[ { "numeroRegistro":1, "idRegistro": parseInt(data.id_pnt) } ],
				"id_pnt": parseInt(data.id_pnt)
			}

			console.log(formato)

			var url = "<?php echo base_url(); ?>index.php/tpoadminv1/logo/logo/eliminar_pnt"

	    	$.post(url, formato, function(data){
	    		console.log(data)
	    	})

	    	return false
	    })
	  
	})