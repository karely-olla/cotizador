
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
	if (fecha_entrada < hoy) {
		alert("Fecha Incorrecta....Solo puedes reservar de hoy en adelante");
		$("#frm_cotizador #date_start").val("");
	}else{
		$("#date_end").removeAttr('disabled');
		if ($("#date_end").val()!="") {
			calcular($("#date_end").val());
		}
	}
}
function calcular(f_end)
{
  hoy =  moment().format("YYYY-MM-DD");
  fecha_start=moment($("#date_start").val());
  fecha_salida = f_end;
  if (fecha_salida <= hoy || fecha_salida <= $("#date_start").val()) {
	alert("Fecha Incorrecta....La fecha de salida debe ser mayor a la de hoy y a la de la fecha de entrada");
	$("#frm_cotizador #date_end").val("");
  }else if(fecha_salida>hoy){
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

function frm_reset(){
	$("#frm_hospedaje")[0].reset();
	rom_s.val("");
	rom_d.val("");
	rom_t.val("");
	rom_c.val("");
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
	// $(".btn-reg").fadeOut('250');
	$(".btn-reg").attr('hidden','hidden');
	$(".amn span").animateNumber({number:0},1000);
	$(".amni span").animateNumber({number:0},1000);
	dias_reservados = '';
	arreglo_dias = "";
	arreglo_dias = new Array();
	arreglo_precios = "";
	arreglo_precios = new Array();

}
$(function(){
	$("#frm_hospedaje").on("submit", function(e){
		e.preventDefault();
		form = new FormData($("#frm_hospedaje")[0]);
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
					url: dominio+'controllers/CotizacionController.php?op=hospedaje',
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