
var diaSemana = new Array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
var mesAño = new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre',
			'Octubre','Noviembre','Diciembre');

var subtotal;
var dias_reservados;
var arreglo_dias= new Array();
var arreglo_servicios=new Array();
var arregloFullDay = new Array();


function arregloDias(fecha_inicio, n_dias){
	var fecha = new Date(fecha_inicio);
	if (arreglo_dias.length > 0) {
		arreglo_dias = "";
		arreglo_dias = new Array();
		arreglo_precios = "";
		arreglo_precios = new Array();
	}
	for (var i = 0; i < n_dias; i++) {
		fecha.setDate(fecha.getDate() +1);
		arreglo_dias[i]=diaSemana[fecha.getDay()]
	}
	dia_inicial = new Date(f_inicio);
	day = diaSemana[dia_inicial.getDay()];
	arreglo_dias.unshift(day);
	[day].concat(arreglo_dias);
	arreglo_dias.pop();
}

function validarInt(integrantes)
{
	if (integrantes==0 || integrantes=="") {
		$("#dias").val("");
		$("#frm_servicios #date_start").val("");
		$("#frm_servicios #date_end").val("");
		$("#days_try").html("");
		$("#date_end").attr('disabled','disabled');
		$(".btn-reg").attr('hidden','hidden');
	}
}

function verifyDate(f_init)
{
	fecha_entrada = f_init;
	hoy =  moment().format("YYYY-MM-DD");
	// if (fecha_entrada < hoy) {
	// 	alert("Fecha Incorrecta....Solo puedes reservar de hoy en adelante");
	// 	$("#frm_servicios #date_start").val("");
	// }else{
		if ($("#n_int").val()==0 || $("#n_int").val() == "") {
			alert("El numero de integrantes no puede estar vacio");
			$("#frm_servicios #date_start").val("");
		}else{
			$("#date_end").removeAttr('disabled');
			if ($("#date_end").val()!="") {
				calcular($("#date_end").val());
				$("#date_end").trigger('onchange');
			}
		}
	// }
}
function calcular(f_end)
{
 //  hoy =  moment().format("YYYY-MM-DD");
 //  fecha_start=moment($("#date_start").val());
 //  fecha_salida = f_end;
 //  if (fecha_salida < hoy || fecha_salida < $("#date_start").val()) {
	// alert("Fecha Incorrecta....La fecha de salida debe ser mayor a la de hoy y a la de la fecha de entrada");
	// $("#frm_servicios #date_end").val("");
 //  }else if(fecha_salida>=hoy){
	//   f_inicio=moment($("#date_start").val());
	//   f_fin=moment($("#date_end").val());
	//   var dias=f_fin.diff(f_inicio,"days");
	//   $("#dias").val(dias);
	//   dias_reservados = $("#dias").val();

	// if (dias_reservados>30) {
	//   	alert("Fecha Incorrecta....Tu estancia no puede ser mayor a 30 dias");
	//   	$("#frm_servicios #date_end").val("");
	//   	$("#dias").val("");
	//   	dias_reservados = null;
	// }else{
	// 	  // arregloDias(f_inicio, dias_reservados);
	// 	var fecha = new Date(f_inicio);
	// 	if (arreglo_dias.length > 0) {
	// 		arreglo_dias = "";
	// 		arreglo_dias = new Array();
	// 		arreglo_precios = "";
	// 		arreglo_precios = new Array();
	// 		arreglo_servicios=[];
	// 		arregloFullDay =[];
	// 	}
	// 	for (var i = 0; i < dias_reservados; i++) {
	// 		fecha.setDate(fecha.getDate() +1);
	// 		arreglo_dias[i]=diaSemana[fecha.getDay()]
	// 	}
	// 	dia_inicial = new Date(f_inicio);
	// 	day = diaSemana[dia_inicial.getDay()];
	// 	arreglo_dias.unshift(day);
	// 	[day].concat(arreglo_dias);
	// 	arreglo_dias.pop();
	// 	calcular_dias();
	// 	mostrar_dias();
	// 	$(".btn-reg").removeAttr('hidden');
	// }
	  
 //  }
  hoy =  moment().format("YYYY-MM-DD");
  fecha_start=moment($("#date_start").val());
  fecha_salida = f_end;
  if (fecha_salida < $("#date_start").val()) {
	alert("Fecha Incorrecta....La fecha de salida debe ser mayor a la de hoy y a la de la fecha de entrada");
	$("#frm_servicios #date_end").val("");
  }else{
	  f_inicio=moment($("#date_start").val());
	  f_fin=moment($("#date_end").val());
	  var dias=f_fin.diff(f_inicio,"days");
	  $("#dias").val(dias);
	  dias_reservados = $("#dias").val();

	if (dias_reservados>30) {
	  	alert("Fecha Incorrecta....Tu estancia no puede ser mayor a 30 dias");
	  	$("#frm_servicios #date_end").val("");
	  	$("#dias").val("");
	  	dias_reservados = null;
	}else{
		  // arregloDias(f_inicio, dias_reservados);
		var fecha = new Date(f_inicio);
		if (arreglo_dias.length > 0) {
			arreglo_dias = "";
			arreglo_dias = new Array();
			arreglo_precios = "";
			arreglo_precios = new Array();
			arreglo_servicios=[];
			arregloFullDay =[];
		}
		for (var i = 0; i < dias_reservados; i++) {
			fecha.setDate(fecha.getDate() +1);
			arreglo_dias[i]=diaSemana[fecha.getDay()]
		}
		dia_inicial = new Date(f_inicio);
		day = diaSemana[dia_inicial.getDay()];
		arreglo_dias.unshift(day);
		[day].concat(arreglo_dias);
		arreglo_dias.pop();
		calcular_dias();
		mostrar_dias();
		$(".btn-reg").removeAttr('hidden');
	}
	  
  }
}

function calcular_dias()
{
	arregloDias(f_inicio, dias_reservados);

	dia_final = new Date(f_fin);
	day_end = diaSemana[dia_final.getDay()];
	arreglo_dias.push(day_end);
	var fecha = new Date(f_inicio);
	// console.log('dias: '+arreglo_dias.length);
	$("#dias").val(arreglo_dias.length);
}


function mostrar_dias()
{	
	arregloDias(f_inicio, dias_reservados);
	dia_final = new Date(f_fin);
	day_end = diaSemana[dia_final.getDay()];
	arreglo_dias.push(day_end);
	var fecha = new Date(f_inicio);
	// console.log('dias: '+arreglo_dias.length);
	
	for (var i = 0; i < arreglo_dias.length; i++) {
		fecha.setDate(fecha.getDate() +1);
		arregloFullDay[i]=diaSemana[fecha.getDay()]+" "+fecha.getDate()+" de "+mesAño[fecha.getMonth()];
	}
	dia_inicial = new Date(f_inicio);
	day = diaSemana[dia_inicial.getDay()]+" "+dia_inicial.getDate()+" de "+mesAño[dia_inicial.getMonth()];;
	arregloFullDay.unshift(day);
	[day].concat(arregloFullDay);
	arregloFullDay.pop();
	let columnas = '';
	arregloFullDay.forEach((dia)=>{
		columnas += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="${dia.replace(" ", "_").replace(" ", "_").replace(" ", "_")}">
					<h3 class="title-cat">${dia} 
						<button type="button" onclick="mostrar_servicios('${dia}')" class="btn btn-danger btn-xs"> Servicios <i class="fa fa-plus"></i>
						</button>
					</h3>

				</div>`;
	})
	$("#days_try").html(columnas);
}

// funcion para mostrar los servicios
function listarServicios()
  {
    tablaServicios=$('#tbl_servicios').dataTable({
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginacion y filtrado realizados por el servidor
        dom: "<'row'<'text-center ' <''B>>>"+
             "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
             "<'row'<'col-lg-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [],
        "ajax":
            {
              url: dominio+'controllers/ServiceController.php?op=template&integrantes='+$("#n_int").val(),
              type: "get",
              dataType: "json",
              error: function(e){
                console.log(e.responseText);
              }
            },
        "language": idioma_español,
        "bDestroy": true,
        "iDisplayLength": 25,//Paginacion
        "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
      }).DataTable();
}
// mostramos los servicios para agregarlos por dia
function mostrar_servicios(id_dia){
	dia_id = id_dia;
	$("#servicios_table").modal("show");
	listarServicios();
}


function agregar_servicio(id_servicio){
	$.get(dominio+'controllers/ServiceController.php?op=servicio', {id:id_servicio} , function(data) {
		/*optional stuff to do after success */
		data = JSON.parse(data);

		dia_input = dia_id.replace("_", " ").replace("_", " ").replace("_", " ");
		if (encuentra(data.id+'_'+dia_id)) {
			swal({
                position: 'top-end',
                type: 'error',
                title: 'Ese servicio ya esta agregado',
                showConfirmButton: false,
                timer: 1500
            })
        }else{
			arreglo_servicios.push(data.id+'_'+dia_id);
			num_integrantes = $("#n_int").val();
			// template servicio
			label = document.createElement('label');
			label.classList.add('label','label-danger');
			label.innerHTML = data.nombre + ' $'+data.precio;
			btn_delete = document.createElement('i');
			btn_delete.classList.add('fa','fa-times','btn','btn-warning','btn-xs','btn_del_service');
			btn_delete.setAttribute('onclick', 'del_servicio(event, \''+data.id+'_'+dia_id+'\')');
			input_cantidad = document.createElement('input');
			input_cantidad.setAttribute('type','number');
			input_cantidad.setAttribute('name','servicios['+dia_input+']['+data.id+'][]');
			if(data.tipo=="Buffet") {
				input_cantidad.setAttribute('min',40);
				// input_cantidad.setAttribute('max',num_integrantes);
			}else{
				input_cantidad.setAttribute('min',0);
				// input_cantidad.setAttribute('max',num_integrantes);
			}
			input_cantidad.setAttribute('data-costo',data.precio);
			input_cantidad.setAttribute('onblur','set_value(this)');
			input_cantidad.setAttribute('onchange','calc_eats(this)');
			(data.categoria == 'Precios Generales')? input_cantidad.value = 1 : input_cantidad.value = num_integrantes;
			label.append(input_cantidad);
			label.append(btn_delete);
			columna = document.getElementById(dia_id.replace(" ", "_").replace(" ", "_").replace(" ", "_"));
			columna.appendChild(label);	
			swal({
			    position: 'top-end',
			    type: 'success',
			    title: 'Servicio Agregado',
			    showConfirmButton: false,
			    timer: 800
			})
			// console.table(arreglo_servicios);
        }
		$("label input[name='servicios["+dia_input+"]["+data.id+"][]']").trigger('onchange');
	});

}
function del_servicio(e,id_servicio){
	e.target.parentElement.remove();
	costo= e.target.previousElementSibling.getAttribute('data-costo');
	valor= e.target.previousElementSibling.value;
	// console.log('id: '+id_servicio);
	for (var i = 0; i < arreglo_servicios.length; i++) {
		if (id_servicio=== arreglo_servicios[i]) {
			arreglo_servicios.splice([i], 1);
		}
	}
	if (arreglo_servicios.length ===0 || arreglo_servicios === null || arreglo_servicios ==='') {
		$("#total_c").val(0);
		$(".amn span").animateNumber({number:0},1);
	}else{
		total_actual = $("#total_c").val();
		refresh_total = parseFloat(total_actual) - (valor*costo);
		$("#total_c").val(Math.round(refresh_total));
		$(".amn span").animateNumber({number:Math.round(refresh_total)},1);
	}
	// console.table(arreglo_servicios);
}
function encuentra(id){
	sw=false;
	for (var i = 0; i < arreglo_servicios.length; i++) {
		if (id=== arreglo_servicios[i]) {
			sw=true;
		}
	}
	return sw;
}

function set_value(number){
	// console.log('ejecuto');
	if ($(number).val() == 0 || $(number).val()=='') {
		$(number).val($("#n_int").val());
	}
}
function calc_eats(number){
	suma_nums =0;
	min= $(number).attr('min');
	// if (parseFloat($(number).val())>$("#n_int").val()) {
	// 	alert("El numero ingresado no puede ser mayor al numero de huespedes calculados");
	// 	$(number).val("")
	// 	$(number).focus();
	// 	// sum_cot();
	// }else 
	if (min == 40) {
		if (parseFloat($(number).val()) < min) {
			alert("El numero ingresado no puede ser menor a 40 como minimo en todos los buffets");
			$(number).val(min)
			$(number).trigger('onchange');
		}else{
			numbers = $("label input[type='number']");
			for (var i = 0; i < numbers.length; i++) {
				suma_nums += (numbers[i].value=="")? 0 : parseFloat(numbers[i].value * numbers[i].getAttribute('data-costo') );
			}
			if (suma_nums==0) {
				$("#total_c").val(0);
			}else{
				total_actual = ($("#total_c").val()=="")? 0 : 0;
				refresh_total = parseFloat(total_actual) + suma_nums;
				$("#total_c").val(Math.round(refresh_total));
				$(".amn span").animateNumber({number:Math.round( refresh_total)},1);

			}
		}
	}else{
		numbers = $("label input[type='number']");
		for (var i = 0; i < numbers.length; i++) {
			suma_nums += (numbers[i].value=="")? 0 : parseFloat(numbers[i].value * numbers[i].getAttribute('data-costo') );
		}
		if (suma_nums==0) {
			$("#total_c").val(0);
		}else{
			total_actual = ($("#total_c").val()=="")? 0 : 0;
			refresh_total = parseFloat(total_actual) + suma_nums;
			$("#total_c").val(Math.round(refresh_total));
			$(".amn span").animateNumber({number:Math.round( refresh_total)},1);

		}
	}
}

// Reset Cotizador
function frm_reset(){
	$("#frm_servicios")[0].reset();
	$("#date_start").val("");
	$("#tarn_hs").text(0);
	$("#tarn_hd").text(0);
	$("#tarn_ht").text(0);
	$("#tarn_hc").text(0);
	$("#subn_hs").val(0);
	$("#subn_hd").val(0);
	$("#subn_ht").val(0);
	$("#subn_hc").val(0);
	// $("#date_start").focus();	
	$(".btn-reg").attr('hidden','hidden');
	$(".amn span").animateNumber({number:0},1000);
	$(".amni span").animateNumber({number:0},1000);
	$("#days_try").html("");
	dias_reservados = '';
	arreglo_dias = "";
	arreglo_dias = new Array();

}



$(function(){
	$("#frm_servicios").on("submit", function(e){
		e.preventDefault();
		suma_serv=0;
		servicios = $("input[name^='servicios[']");
		for (var i = 0; i < servicios.length; i++) {
			suma_serv+=(servicios[i].value=="")? 0 : parseFloat(servicios[i].value);
		}
		// console.log('suma servicios: '+suma_serv);
		// console.log('dias arreglo: '+arreglo_dias.length);
		if (suma_serv==0 || suma_serv < $("#n_int").val()) {
			alert("Es necesario tener distribuidos el numero de integrantes en los distintos servicios como minimo");
		}else {
			form = new FormData($("#frm_servicios")[0]);
			swal({
		        title: 'Estas seguro de haber terminado con la cotización?',
		        // text: "esta accion no se puede revertir!",
		        type: 'info',
		        showCancelButton: true,
		        confirmButtonText: 'Si, registrar!',
		        cancelButtonText: 'No, más tarde!',
		        reverseButtons: true
		      }).then((result) => {
		        if (result.value) {
			        $.ajax({
						url: dominio+'controllers/CotizacionController.php?op=servicios',
						type: 'POST',
						dataType: 'json',
						encode: true,
						data: form,
						contentType:false,
						processData:false,
						success: function(data){
							if (data.success) {
								// console.log(data);
								swal({
				                    position: 'top-end',
				                    type: 'success',
				                    title: data.msg,
				                    showConfirmButton: false,
				                    timer: 1500
				                })
				                frm_reset();
							}else{
								if (data.msg=='expired') {
									swal({
					                    position: 'top-center',
					                    type: 'error',
					                    title: 'La sesion a expirado',
					                    showConfirmButton: false,
					                    timer: 2500
					                })
					                setTimeout(()=>{				                	
	            						$(location).attr('href','http://localhost/cotizador_servidor/views/login.php');
					                },3000)
								}else{
									swal({
					                    position: 'top-end',
					                    type: 'error',
					                    title: data.msg,
					                    showConfirmButton: false,
					                    timer: 2500
					                })								
								}
							}
						}
					})
					.done(function() {
						// console.log("success");
					})	
		        } else if (
		          // Read more about handling dismissals
		          result.dismiss === swal.DismissReason.cancel
		        ) {
		          // swal(
		          //   'Cancelado',
		          //   'Your imaginary file is safe :)',
		          //   'error'
		          // )
		        }
		    })
			
		}
		
	})
})

function states(){
  $.ajax({
    type: "POST",
    url: dominio+"controllers/CotizacionController.php?op=procedencia",
    data: { estados : "Mexico" },
    success: function(data){
      $("#jmr_contacto_estado").html(data);
      $("#jmr_contacto_estado").selectpicker('refresh');
    } 
  }).done(function(data){
    $("#jmr_contacto_estado").html(data);
    $("#jmr_contacto_estado").selectpicker('refresh');
  });
}
states();
// Obtener municipios
$("#jmr_contacto_estado").change(function(){
  var estado = $("#jmr_contacto_estado option:selected").val();
  $.ajax({
    type: "POST",
    url: dominio+"controllers/CotizacionController.php?op=procedencia",
    data: { estado : estado } 
    }).done(function(data){
      $("#jmr_contacto_municipio").html(data);
      $("#jmr_contacto_municipio").selectpicker('refresh');
    });
});