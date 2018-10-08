
var diaSemana = new Array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
var mesAño = new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre',
			'Octubre','Noviembre','Diciembre');

// Validation int = habitaciones
var rooms;
var subtotal;
var dias_reservados;
var arreglo_dias= new Array();
var arreglo_precios= new Array();
var arreglo_servicios=new Array();
var arregloFullDay = new Array();
var decimal_places = 2;
var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);
// Tipos
hs=1; hd=2; ht=3; hc=4;
// Precios Habitaciones (Dom-Juev)
p_hs = 1092; p_hd = 1092; p_ht = 1387; p_hc = 1681;
// Precios Habitaciones (Vie-Sabado)
p_hsE = 1471; p_hdE = 1471; p_htE = 1765; p_hcE = 2059;
// Inputs Habitaciones
rom_s = $("#n_hs"); rom_d = $("#n_hd"); rom_t = $("#n_ht"); rom_c = $("#n_hc");

function sumavalidate()
{
	sum=0;
	hbts = $("[id^=n_h]");
	for (var i = 0; i<hbts.length; i++) {
		sum+=parseFloat(hbts[i].value);
		if (sum>103) {
			current_house = hbts[i];
			current_house.value = 0;
			alert("El numero de habitaciones a llegado a su tope");
			calc(current_house.getAttribute('id'),current_house.value);
			break;
		}
	}
	// console.log(sum);
}
function sum_cot()
{
	var subs= $("[id^='subn_']");
	st=0;
	for (var i = 0; i < subs.length; i++) {
		st += parseFloat(subs[i].value);
	}
	$("#total_c").val(st);
	$(".amn span").text(st);
}

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
function verifyDate(f_init)
{
	fecha_entrada = f_init;
	hoy =  moment().format("YYYY-MM-DD");
	// if (fecha_entrada < hoy) {
	// 	alert("Fecha Incorrecta....Solo puedes reservar de hoy en adelante");
	// 	$("#frm_cotizador #date_start").val("");
	// }else{
		$("#date_end").removeAttr('disabled');
		if ($("#date_end").val()!="") {
			calcular($("#date_end").val());
		}
	// }
}
function calcular(f_end)
{
 //  hoy =  moment().format("YYYY-MM-DD");
 //  fecha_start=moment($("#date_start").val());
 //  fecha_salida = f_end;
 //  if (fecha_salida <= hoy || fecha_salida <= $("#date_start").val()) {
	// alert("Fecha Incorrecta....La fecha de salida debe ser mayor a la de hoy y a la de la fecha de entrada");
	// $("#frm_cotizador #date_end").val("");
 //  }else if(fecha_salida>hoy){
	//   f_inicio=moment($("#date_start").val());
	//   f_fin=moment($("#date_end").val());
	//   var dias=f_fin.diff(f_inicio,"days");
	//   $("#noches").val(dias);
	//   dias_reservados = $("#noches").val();
	// if (dias_reservados>30) {
	//   	alert("Fecha Incorrecta....Tu estancia no puede ser mayor a 30 dias");
	//   	$("#frm_cotizador #date_end").val("");
	//   	$("#noches").val("");
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
	// 	if (rom_s.val()!="") {
	// 	  	$(rom_s).trigger('onchange');
	// 	}
	// 	  if (rom_d.val()!="") {
	// 		$(rom_d).trigger('onchange');
	// 	}
	// 	  if (rom_t.val()!="") {
	// 		$(rom_t).trigger('onchange');
	// 	}
	// 	  if (rom_c.val()!="") {
	// 		$(rom_c).trigger('onchange');
	// 	}
	// 	calcular_dias();		
	// }
	  
 //  }
  hoy =  moment().format("YYYY-MM-DD");
  fecha_start=moment($("#date_start").val());
  fecha_salida = f_end;
  if (fecha_salida <= $("#date_start").val()) {
	alert("Fecha Incorrecta....La fecha de salida debe ser mayor a la de hoy y a la de la fecha de entrada");
	$("#frm_cotizador #date_end").val("");
  }else{
	  f_inicio=moment($("#date_start").val());
	  f_fin=moment($("#date_end").val());
	  var dias=f_fin.diff(f_inicio,"days");
	  $("#noches").val(dias);
	  dias_reservados = $("#noches").val();
	if (dias_reservados>30) {
	  	alert("Fecha Incorrecta....Tu estancia no puede ser mayor a 30 dias");
	  	$("#frm_cotizador #date_end").val("");
	  	$("#noches").val("");
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
		if (rom_s.val()!="") {
		  	$(rom_s).trigger('onchange');
		}
		  if (rom_d.val()!="") {
			$(rom_d).trigger('onchange');
		}
		  if (rom_t.val()!="") {
			$(rom_t).trigger('onchange');
		}
		  if (rom_c.val()!="") {
			$(rom_c).trigger('onchange');
		}
		calcular_dias();		
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

function suma_rooms() {
	rms = $("[id^='n_h']");
	srms = 0;
	// console.log("rms: "+rms.length);
	for (var i = 0; i < rms.length; i++) {
		srms += (rms[i].value=="")? 0 : parseFloat(rms[i].value);
	}
	if (srms>=5) {
		mostrar_dias();
		$(".btn-reg").fadeIn('250');
		$(".btn-reg").removeAttr('hidden');
	}else if(srms<5){
		$(".btn-reg").fadeOut('250');
		$(".btn-reg").attr('hidden','hidden');
		$(".days_cot").fadeOut('250');
		// $(".btn_step_two").addClass('hidden');
	}
	$("#n_rooms").val(srms);
	// console.log("Suma de habitaciones: "+srms);
}
function calc(room,nr)
{
	// console.log(room);
	// console.log(nr);
	if (dias_reservados=='' || dias_reservados==null || dias_reservados.length ==0) {
		alert("No puedes ingresar alguna cantidad hasta definir el periodo de tu estancia");
		$("#"+room).val("");
		$("#date_start").focus();		
	}else{
		var fecha = new Date(f_inicio);
		if (arreglo_dias.length > 0) {
			arreglo_dias = "";
			arreglo_dias = new Array();
			arreglo_precios = "";
			arreglo_precios = new Array();
			arreglo_servicios = "";
			arreglo_servicios = new Array();
			arregloFullDay = [];
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
		suma=0;
		if (nr>0) {
			if (arreglo_dias.length == 1) {
				if (day=="Domingo" || day=="Lunes" || day=="Martes" || 
						day=="Miercoles" || day=="Jueves") {
					switch (room){
						case 'n_hs':
							suma+=parseFloat(1092);
						break;
						case 'n_hd':
							suma+=parseFloat(1092);
						break;
						case 'n_ht':
							suma+=parseFloat(1387);
						break;
						case 'n_hc':
							suma+=parseFloat(1681);
						break;
					}
				}else if(day=="Sabado" ||  day=="Viernes"){
					switch (room){
						case 'n_hs':
							suma+=parseFloat(1471);
						break;
						case 'n_hd':
							suma+=parseFloat(1471);
						break;
						case 'n_ht':
							suma+=parseFloat(1765);
						break;
						case 'n_hc':
							suma+=parseFloat(2059);
						break;
					}
				}
				promedio=suma/1;
				total_c = parseFloat(promedio);
				subtotal= parseFloat((total_c*nr)*arreglo_dias.length);
				sub = $("#sub"+room).val(subtotal.toFixed(2));
				tar = $("#tar"+room).text("");
				tar = $("#tar"+room).animateNumber({
						      number: promedio.toFixed(2) * decimal_factor,

						      numberStep: function(now, tween) {
						        var floored_number = Math.floor(now) / decimal_factor,
						            target = $(tween.elem);

						        if (decimal_places > 0) {
						          // force decimal places even if they are 0
						          floored_number = floored_number.toFixed(decimal_places);

						          // replace '.' separator with ','
						          floored_number = floored_number.toString().replace('.', ',');
						        }

						        target.text(floored_number);
						      }
						    },
						    450);
				$("#tarifa"+room).val(promedio.toFixed(2));
				// console.log("precios: "+arreglo_precios+" suma: "+suma+ " promedio: "+promedio);
				sum_cot();
				switch (room) {
					case 'n_hs':
						rooms = parseFloat(nr*hs);
						rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
						rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
						rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
					case 'n_hd':
						rooms = parseFloat(nr*hd);
						rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
						rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
						rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
					case 'n_ht':
						rooms = parseFloat(nr*ht);
						rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
						rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
						rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
					case 'n_hc':
						rooms = parseFloat(nr*hc);
						rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
						rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
						rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
				}
				// console.log("arreglo Dias: " +arreglo_dias);
				sumavalidate();
			}else{
				for (var i = 0; i < arreglo_dias.length; i++) {
					if (arreglo_dias[i]=="Domingo" || arreglo_dias[i]=="Lunes" || arreglo_dias[i]=="Martes" || 
						arreglo_dias[i]=="Miercoles" || arreglo_dias[i]=="Jueves") {
						switch (room){
							case 'n_hs':
								arreglo_precios[i]=1092;						
							break;
							case 'n_hd':
								arreglo_precios[i]=1092;						
							break;
							case 'n_ht':
								arreglo_precios[i]=1387;						
							break;
							case 'n_hc':
								arreglo_precios[i]=1681;						
							break;
						}
					}else if(arreglo_dias[i]=="Viernes" || arreglo_dias[i]=="Sabado"){
						switch (room) {
							case 'n_hs':
								arreglo_precios[i]=1471;						
							break;
							case 'n_hd':
								arreglo_precios[i]=1471;						
							break;
							case 'n_ht':
								arreglo_precios[i]=1765;						
							break;
							case 'n_hc':
								arreglo_precios[i]=2059;						
							break; 
						}
					}
					suma+=parseFloat(arreglo_precios[i]);
				}
				// console.log('arreglo_precios: '+arreglo_precios);
				promedio=parseFloat(suma/arreglo_precios.length);
				// console.log('tarifa promedio: '+promedio);
				total_c = parseFloat(promedio);
				subtotal= parseFloat((total_c*nr)*(arreglo_dias.length));
				sub = $("#sub"+room).val(subtotal.toFixed(2));
				tar = $("#tar"+room).animateNumber({
						      number: promedio.toFixed(2) * decimal_factor,

						      numberStep: function(now, tween) {
						        var floored_number = Math.floor(now) / decimal_factor,
						            target = $(tween.elem);

						        if (decimal_places > 0) {
						          // force decimal places even if they are 0
						          floored_number = floored_number.toFixed(decimal_places);

						          // replace '.' separator with ','
						          floored_number = floored_number.toString().replace('.', ',');
						        }

						        target.text(floored_number);
						      }
						    },
						    450);
				$("#tarifa"+room).val(promedio.toFixed(2));
				// arregloDias(f_inicio, dias_reservados);
				// console.log("precios: "+arreglo_precios+" suma: "+suma+ " promedio: "+promedio);
				sum_cot();
				switch (room) {
					case 'n_hs':
						rooms = parseFloat(nr*hs);
						rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
						rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
						rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
					case 'n_hd':
						rooms = parseFloat(nr*hd);
						rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
						rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
						rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
					case 'n_ht':
						rooms = parseFloat(nr*ht);
						rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
						rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
						rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
					case 'n_hc':
						rooms = parseFloat(nr*hc);
						rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
						rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
						rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
						// console.log("Suma total: "+rooms);
						$("#n_int").val(rooms);
						$(".amni span").animateNumber({number:rooms},250);
					break;
				}
				// console.log("arreglo Dias: " +arreglo_dias);
				sumavalidate();
			}
		}
		if (nr==0) {
			switch (room) {
				case 'n_hs':
					rooms = parseFloat(nr*hs);
					rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
					rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
					rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
					// console.log("Suma total: "+rooms);
					$("#n_int").val(rooms);
					$(".amni span").animateNumber({number:rooms},250);
				break;
				case 'n_hd':
					rooms = parseFloat(nr*hd);
					rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
					rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
					rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
					// console.log("Suma total: "+rooms);
					$("#n_int").val(rooms);
					$(".amni span").animateNumber({number:rooms},250);
				break;
				case 'n_ht':
					rooms = parseFloat(nr*ht);
					rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
					rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
					rooms += (rom_c.val()!='')? parseFloat(rom_c.val()) * parseFloat(hc) : 0 * parseFloat(hc);
					// console.log("Suma total: "+rooms);
					$("#n_int").val(rooms);
					$(".amni span").animateNumber({number:rooms},250);
				break;
				case 'n_hc':
					rooms = parseFloat(nr*hc);
					rooms += (rom_s.val()!='')? parseFloat(rom_s.val()) * parseFloat(hs) : 0 * parseFloat(hs);
					rooms += (rom_t.val()!='')? parseFloat(rom_t.val()) * parseFloat(ht) : 0 * parseFloat(ht);
					rooms += (rom_d.val()!='')? parseFloat(rom_d.val()) * parseFloat(hd) : 0 * parseFloat(hd);
					// console.log("Suma total: "+rooms);
					$("#n_int").val(rooms);
					$(".amni span").animateNumber({number:rooms},250);
				break;
			}
			$("#"+room).val("");
			sub = $("#sub"+room).val(0);
			sum_cot();
			// console.log("arreglo Dias: " +arreglo_dias);
			tar = $("#tar"+room).animateNumber({number: 0}, 450);
			$("#tarifa"+room).val(0);
		}
	}
	suma_rooms();
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
			// console.table(arreglo_servicios);
			swal({
			    position: 'top-end',
			    type: 'success',
			    title: 'Servicio Agregado',
			    showConfirmButton: false,
			    timer: 800
			})
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
		if (rom_s.val()!="") {
		  	$(rom_s).trigger('onchange');
		}
		  if (rom_d.val()!="") {
			$(rom_d).trigger('onchange');
		}
		  if (rom_t.val()!="") {
			$(rom_t).trigger('onchange');
		}
		  if (rom_c.val()!="") {
			$(rom_c).trigger('onchange');
		}
	}else{
		total_actual = $("#total_c").val();
		refresh_total = parseFloat(total_actual) - (valor*costo);
		$("#total_c").val(refresh_total);
		$(".amn span").animateNumber({number:refresh_total},1);
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
	numbers = $("label input[type='number']");
	if (min == 40) {
		if (parseFloat($(number).val()) < min) {
			alert("El numero ingresado no puede ser menor a 40 como minimo en todos los buffets");
			$(number).val(min)
			$(number).trigger('onchange');
		}else{
			for (var i = 0; i < numbers.length; i++) {
				suma_nums += (numbers[i].value=="")? 0 : parseFloat(numbers[i].value * numbers[i].getAttribute('data-costo') );
			}
			if (suma_nums==0) {
				sum_cot();
			}else{
				sum_cot();
				total_actual = $("#total_c").val();
				refresh_total = parseFloat(total_actual) + suma_nums;
				$("#total_c").val(Math.round(refresh_total));
				$(".amn span").animateNumber({number:Math.round( refresh_total)},1);

			}
		}
	}else{
		for (var i = 0; i < numbers.length; i++) {
			suma_nums += (numbers[i].value=="")? 0 : parseFloat(numbers[i].value * numbers[i].getAttribute('data-costo') );
		}
		if (suma_nums==0) {
			sum_cot();
		}else{
			sum_cot();
			total_actual = $("#total_c").val();
			refresh_total = parseFloat(total_actual) + suma_nums;
			$("#total_c").val(Math.round(refresh_total));
			$(".amn span").animateNumber({number:Math.round( refresh_total)},1);

		}
	}
}

// Reset Cotizador
function frm_reset(){
	$("#frm_cotizador")[0].reset();
	rom_s.val("");
	rom_d.val("");
	rom_t.val("");
	rom_c.val("");
	$("#date_start").val("");
	$("#date_end").val("");
	$("#date_end").attr('disabled','disabled');
	$("#tarn_hs").text(0);
	$("#tarn_hd").text(0);
	$("#tarn_ht").text(0);
	$("#tarn_hc").text(0);
	$("#subn_hs").val(0);
	$("#subn_hd").val(0);
	$("#subn_ht").val(0);
	$("#subn_hc").val(0);
	// $("#date_start").focus();
	$(".btn_reset").addClass('hidden');
	$(".btn_step_two").addClass('hidden');
	// $(".btn-reg").fadeOut('250');
	$(".btn-reg").attr('hidden','hidden');
	$(".amn span").animateNumber({number:0},1000);
	$(".amni span").animateNumber({number:0},1000);
	$("#days_try").html("");
	dias_reservados = '';
	arreglo_dias = "";
	arreglo_dias = new Array();
	arreglo_precios = "";
	arreglo_precios = new Array();

}


$(function(){
	$("#frm_cotizador").on("submit", function(e){
		e.preventDefault();
		form = new FormData($("#frm_cotizador")[0]);
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
					url: dominio+'controllers/CotizacionController.php?op=cotizacion',
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
							// window.location.href='../../reporte.php?k='+data.token;
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
	        }
	    })
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