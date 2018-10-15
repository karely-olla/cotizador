
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

function sum_cot()
{
	var subs= $("[id^='sub_f']");
	st=0;
	for (var i = 0; i < subs.length; i++) {
		st += (subs[i].value!="") ? parseFloat(subs[i].value) : 0 ;
	}
	// console.log("suma subtotales: "+ st);
	let numbers = $("label input[type='number']");
	let suma_nums=0;
	for (var i = 0; i < numbers.length; i++) {
		suma_nums += (numbers[i].value=="")? 0 : parseFloat(numbers[i].value * numbers[i].getAttribute('data-costo') );
	}
	if (suma_nums==0) {
		$("#total_c").val(st);
		$(".amn span").text(st);
	}else{
		$("#total_c").val(Math.round(st + parseFloat(suma_nums)));
		$(".amn span").animateNumber({number:Math.round( st + parseFloat(suma_nums))},1);
	}
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
		$("#frm_cotizador_dias #date_start").val("");
	}else{
		$("#date_end").removeAttr('disabled');
		if ($("#date_end").val()!="") {
			calcular($("#date_end").val());
			$("#date_end").trigger('onchange');
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
	$("#frm_cotizador_dias #date_end").val("");
  }else if(fecha_salida>hoy){
	  f_inicio=moment($("#date_start").val());
	  f_fin=moment($("#date_end").val());
	  var dias=f_fin.diff(f_inicio,"days");
	  $("#noches").val(dias);
	  dias_reservados = $("#noches").val();
	if (dias_reservados>30) {
	  	alert("Fecha Incorrecta....Tu estancia no puede ser mayor a 30 dias");
	  	$("#frm_cotizador_dias #date_end").val("");
	  	$("#noches").val("");
	  	$("#dias").val("");
	  	dias_reservados = null;
	}else{
		  // arregloDias(f_inicio, dias_reservados);
		var fecha = new Date(f_inicio);
		if (arreglo_dias.length > 0) {
			arregloFullDay=[];
			arreglo_dias = [];
			arreglo_precios =[];
			arreglo_servicios=[];
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
		let nombre_dia = dia.split(" ");
		columnas += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="${dia.replace(" ", "_").replace(" ", "_").replace(" ", "_")}">
					<h3 class="title-cat">${dia} 
						<button type="button" onclick="mostrar_servicios('${dia}')" class="btn btn-danger btn-xs"> Servicios <i class="fa fa-plus"></i>
						</button>
					</h3>
					<div class="clearfix"></div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Subtotal:</label>
						<input type="text" readonly class="form-control" name="sub_final" id="sub_final">
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Integrantes:</label>
						<input type="text" readonly class="form-control" name="n_int" id="n_int">
					</div>
					<h4>Numero de Habitaciones</h4>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                  <label for="n_int">Sencilla:</label>
	                  <input type="number" class="form-control" max="103" min="0" maxlength="3" minlength="1" onkeypress="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" 
	                  onchange="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" id="n_hs" placeholder="0">
	                  <input type="hidden" name="tarifas[${dia}][tarifa_hs][]" id="tarifan_hs" value="0">
	                  <input type="hidden" id="subn_hs" value="0">
	                  <span class="avg label label-info">Tar. Promedio: $<i id="tarn_hs">0</i></span>
	                </div>
	                          
	                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                  <label for="n_int">Doble:</label>
	                  <input type="number" class="form-control" max="103" min="0" maxlength="3" minlength="1" onkeypress="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" 
	                  onchange="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" id="n_hd" placeholder="0">
	                  <input type="hidden" name="tarifas[${dia}][tarifa_hd][]" id="tarifan_hd" value="0">
	                  <input type="hidden" id="subn_hd" value="0">
	                  <span class="avg label label-primary">Tar. Promedio: $<i id="tarn_hd">0</i></span>
	                </div>

	                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                  <label for="n_int">Triple:</label>
	                  <input type="number" class="form-control" max="103" min="0" maxlength="3" minlength="1" onkeypress="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" 
	                  onchange="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" id="n_ht" placeholder="0">
	                  <input type="hidden" name="tarifas[${dia}][tarifa_ht][]" id="tarifan_ht" value="0">
	                  <input type="hidden" id="subn_ht" value="0">
	                  <span class="avg label label-warning">Tar. Promedio: $<i id="tarn_ht">0</i></span>
	                </div>
	                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                  <label for="n_int">Cuadruple:</label>
	                  <input type="number" class="form-control" max="103" min="0" maxlength="3" minlength="1" onkeypress="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" 
	                  onchange="calc('${nombre_dia[0]}','${dia.replace(" ","_").replace(" ","_").replace(" ","_")}',this.getAttribute('id'),this.value,this)" id="n_hc" placeholder="0">
	                  <input type="hidden" name="tarifas[${dia}][tarifa_hc][]" id="tarifan_hc" value="0">
	                  <input type="hidden" id="subn_hc" value="0">
	                  <span class="avg label label-danger">Tar. Promedio: $<i id="tarn_hc">0</i></span>
	                </div>
	                <div class="clearfix"></div> 
				</div>`;
	})
	$("#days_try").html(columnas);
}

function calc(dia,selector_dia,room,valor,input){
	suma=0;
	if (valor>0) {
		if (dia=="Domingo" || dia=="Lunes" || dia=="Martes" || 
					dia=="Miercoles" || dia=="Jueves") {
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
		}else if(dia=="Sabado" ||  dia=="Viernes"){
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
		// promedio=suma/1;
		// total_c = parseFloat(promedio);
		subtotal= parseFloat((suma*valor));
		sub = $(`#${selector_dia} #sub${room}`).val(subtotal.toFixed(2));
		tar = $(`#${selector_dia} #tar${room}`).text("");
		tar = $(`#${selector_dia} #tar${room}`).animateNumber({
				      number: suma.toFixed(2) * decimal_factor,

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
		$(input).attr('name',`habitaciones[${selector_dia.replace("_"," ").replace("_"," ").replace("_"," ")}][${room}][${suma.toFixed(2)}][]`)
		$(`#${selector_dia} #tarifa${room}`).val(suma.toFixed(2));		
		switch (room) {
			case 'n_hs':
				rooms = parseFloat(valor*hs);
				rooms += ($(`#${selector_dia} #n_hd`).val()!='')? parseFloat($(`#${selector_dia} #n_hd`).val()) * parseFloat(hd) : 0 * parseFloat(hd);
				rooms += ($(`#${selector_dia} #n_ht`).val()!='')? parseFloat($(`#${selector_dia} #n_ht`).val()) * parseFloat(ht) : 0 * parseFloat(ht);
				rooms += ($(`#${selector_dia} #n_hc`).val()!='')? parseFloat($(`#${selector_dia} #n_hc`).val()) * parseFloat(hc) : 0 * parseFloat(hc);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
			case 'n_hd':
				rooms = parseFloat(valor*hd);
				rooms += ($(`#${selector_dia} #n_hs`).val()!='')? parseFloat($(`#${selector_dia} #n_hs`).val()) * parseFloat(hs) : 0 * parseFloat(hs);
				rooms += ($(`#${selector_dia} #n_ht`).val()!='')? parseFloat($(`#${selector_dia} #n_ht`).val()) * parseFloat(ht) : 0 * parseFloat(ht);
				rooms += ($(`#${selector_dia} #n_hc`).val()!='')? parseFloat($(`#${selector_dia} #n_hc`).val()) * parseFloat(hc) : 0 * parseFloat(hc);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
			case 'n_ht':
				rooms = parseFloat(valor*ht);
				rooms += ($(`#${selector_dia} #n_hd`).val()!='')? parseFloat($(`#${selector_dia} #n_hd`).val()) * parseFloat(hd) : 0 * parseFloat(hd);
				rooms += ($(`#${selector_dia} #n_hs`).val()!='')? parseFloat($(`#${selector_dia} #n_hs`).val()) * parseFloat(hs) : 0 * parseFloat(hs);
				rooms += ($(`#${selector_dia} #n_hc`).val()!='')? parseFloat($(`#${selector_dia} #n_hc`).val()) * parseFloat(hc) : 0 * parseFloat(hc);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
			case 'n_hc':
				rooms = parseFloat(valor*hc);
				rooms += ($(`#${selector_dia} #n_hd`).val()!='')? parseFloat($(`#${selector_dia} #n_hd`).val()) * parseFloat(hd) : 0 * parseFloat(hd);
				rooms += ($(`#${selector_dia} #n_ht`).val()!='')? parseFloat($(`#${selector_dia} #n_ht`).val()) * parseFloat(ht) : 0 * parseFloat(ht);
				rooms += ($(`#${selector_dia} #n_hs`).val()!='')? parseFloat($(`#${selector_dia} #n_hs`).val()) * parseFloat(hs) : 0 * parseFloat(hs);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
		}
		// console.log("precios: "+arreglo_precios+" suma: "+suma+ " promedio: "+promedio);
	}else if(valor == 0 ){
		sub = $(`#${selector_dia} #sub${room}`).val(0);
		tar = $(`#${selector_dia} #tar${room}`).text("0,00");
		$(`#${selector_dia} #tarifa${room}`).val(0);		
		switch (room) {
			case 'n_hs':
				rooms = parseFloat(valor*hs);
				rooms += ($(`#${selector_dia} #n_hd`).val()!='')? parseFloat($(`#${selector_dia} #n_hd`).val()) * parseFloat(hd) : 0 * parseFloat(hd);
				rooms += ($(`#${selector_dia} #n_ht`).val()!='')? parseFloat($(`#${selector_dia} #n_ht`).val()) * parseFloat(ht) : 0 * parseFloat(ht);
				rooms += ($(`#${selector_dia} #n_hc`).val()!='')? parseFloat($(`#${selector_dia} #n_hc`).val()) * parseFloat(hc) : 0 * parseFloat(hc);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
			case 'n_hd':
				rooms = parseFloat(valor*hd);
				rooms += ($(`#${selector_dia} #n_hs`).val()!='')? parseFloat($(`#${selector_dia} #n_hs`).val()) * parseFloat(hs) : 0 * parseFloat(hs);
				rooms += ($(`#${selector_dia} #n_ht`).val()!='')? parseFloat($(`#${selector_dia} #n_ht`).val()) * parseFloat(ht) : 0 * parseFloat(ht);
				rooms += ($(`#${selector_dia} #n_hc`).val()!='')? parseFloat($(`#${selector_dia} #n_hc`).val()) * parseFloat(hc) : 0 * parseFloat(hc);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
			case 'n_ht':
				rooms = parseFloat(valor*ht);
				rooms += ($(`#${selector_dia} #n_hd`).val()!='')? parseFloat($(`#${selector_dia} #n_hd`).val()) * parseFloat(hd) : 0 * parseFloat(hd);
				rooms += ($(`#${selector_dia} #n_hs`).val()!='')? parseFloat($(`#${selector_dia} #n_hs`).val()) * parseFloat(hs) : 0 * parseFloat(hs);
				rooms += ($(`#${selector_dia} #n_hc`).val()!='')? parseFloat($(`#${selector_dia} #n_hc`).val()) * parseFloat(hc) : 0 * parseFloat(hc);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
			case 'n_hc':
				rooms = parseFloat(valor*hc);
				rooms += ($(`#${selector_dia} #n_hd`).val()!='')? parseFloat($(`#${selector_dia} #n_hd`).val()) * parseFloat(hd) : 0 * parseFloat(hd);
				rooms += ($(`#${selector_dia} #n_ht`).val()!='')? parseFloat($(`#${selector_dia} #n_ht`).val()) * parseFloat(ht) : 0 * parseFloat(ht);
				rooms += ($(`#${selector_dia} #n_hs`).val()!='')? parseFloat($(`#${selector_dia} #n_hs`).val()) * parseFloat(hs) : 0 * parseFloat(hs);
				// console.log("Suma total: "+rooms);
				$(`#${selector_dia} #n_int`).val(rooms);
			break;
		}
	}

	sumar_costos(arregloFullDay, selector_dia, room);
}

function sumar_costos(arregloDiasFull,selector_dia, room){
	let suma_subts =0;
	let sub_final =0;
	// for (var i = 0; i < arregloDiasFull.length; i++) {
		// let nombre_dia = arregloDiasFull[i].split(" ");
		switch (room) {
			case 'n_hs':
				suma_subts = ($(`#${selector_dia} #sub${room}`).val()!='') ? parseFloat($(`#${selector_dia} #sub${room}`).val()) : 0;
				suma_subts += ($(`#${selector_dia} #subn_hd`).val()!='')? parseFloat($(`#${selector_dia} #subn_hd`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_ht`).val()!='')? parseFloat($(`#${selector_dia} #subn_ht`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_hc`).val()!='')? parseFloat($(`#${selector_dia} #subn_hc`).val()) : 0 ;
			break;
			case 'n_hd':
				suma_subts = ($(`#${selector_dia} #sub${room}`).val()!='') ? parseFloat($(`#${selector_dia} #sub${room}`).val()) : 0;
				suma_subts += ($(`#${selector_dia} #subn_hs`).val()!='')? parseFloat($(`#${selector_dia} #subn_hs`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_ht`).val()!='')? parseFloat($(`#${selector_dia} #subn_ht`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_hc`).val()!='')? parseFloat($(`#${selector_dia} #subn_hc`).val()) : 0 ;
			break;

			case 'n_ht':
				suma_subts = ($(`#${selector_dia} #sub${room}`).val()!='') ? parseFloat($(`#${selector_dia} #sub${room}`).val()) : 0;
				suma_subts += ($(`#${selector_dia} #subn_hd`).val()!='')? parseFloat($(`#${selector_dia} #subn_hd`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_hs`).val()!='')? parseFloat($(`#${selector_dia} #subn_hs`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_hc`).val()!='')? parseFloat($(`#${selector_dia} #subn_hc`).val()) : 0 ;
			break;

			case 'n_hc':
				suma_subts = ($(`#${selector_dia} #sub${room}`).val()!='') ? parseFloat($(`#${selector_dia} #sub${room}`).val()) : 0;
				suma_subts += ($(`#${selector_dia} #subn_hd`).val()!='')? parseFloat($(`#${selector_dia} #subn_hd`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_ht`).val()!='')? parseFloat($(`#${selector_dia} #subn_ht`).val()) : 0 ;
				suma_subts += ($(`#${selector_dia} #subn_hs`).val()!='')? parseFloat($(`#${selector_dia} #subn_hs`).val()) : 0 ;
			break;
		}
		sub_final += parseFloat(suma_subts);
	// }
	$(`#${selector_dia} #sub_final`).val(sub_final);

	sum_cot();
}


function listarServicios(dia_selector)
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
              url: dominio+'controllers/ServiceController.php?op=template&integrantes='+$(`#${dia_selector} #n_int`).val(),
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
	dia_selector = dia_id.replace(" ", "_").replace(" ", "_").replace(" ", "_");
	$("#servicios_table").modal("show");
	listarServicios(dia_selector);
}

function agregar_servicio(id_servicio){
	$.get(dominio+'controllers/ServiceController.php?op=servicio', {id:id_servicio} , function(data) {
		/*optional stuff to do after success */
		data = JSON.parse(data);

		// console.log("selector: "+dia_selector);
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
			let num_integrantes = $(`#${dia_selector} #n_int`).val();
			num_integrantes= (num_integrantes=="") ? 1 : num_integrantes; 

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
			input_cantidad.setAttribute('onblur','set_value(this,"'+dia_selector+'")');
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
		sum_cot();
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
	// console.log('id pasado: '+id);
	for (var i = 0; i < arreglo_servicios.length; i++) {
		if (id=== arreglo_servicios[i]) {
			sw=true;
			// console.log(`id: ${id}  === id_arreglo: ${arreglo_servicios[i]}`);
		}
	}

	return sw;
}

function set_value(number, dia_sel){
	// console.log('ejecuto');
	if ($(number).val() == 0 || $(number).val()=='') {
		if ($(`#${dia_sel} #n_int`).val()=="" || $(`#${dia_sel} #n_int`).val()==0) {
			$(number).val(1);
			$(number).trigger('onchange');
		}else{
			$(number).val($(`#${dia_sel} #n_int`).val());
			$(number).trigger('onchange');
		}
	}
}
function calc_eats(number){
	let min= $(number).attr('min');
	if (min == 40) {
		if (parseFloat($(number).val()) < min) {
			alert("El numero ingresado no puede ser menor a 40 como minimo en todos los buffets");
			$(number).val(min)
			$(number).trigger('onchange');
		}else{
			sum_cot();	
		}
	}else{
		sum_cot();
	}
}

function frm_reset(){
	$("#frm_cotizador_dias")[0].reset();
	$("#date_start").val("");
	$("#date_end").val("");
	$("#date_end").attr('disabled','disabled');
	// $(".btn-reg").fadeOut('250');
	$(".btn-reg").attr('hidden','hidden');
	$(".amn span").animateNumber({number:0},1000);
	$(".amni span").animateNumber({number:0},1000);
	$("#days_try").html("");
	dias_reservados = '';
	arreglo_dias = [];
	arreglo_precios =[];
	arregloFullDay=[];
	arreglo_servicios=[];
}

$(function(){
	$("#frm_cotizador_dias").on("submit", function(e){
		e.preventDefault();
		form = new FormData($("#frm_cotizador_dias")[0]);
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
					url: dominio+'controllers/EspecialController.php?op=store',
					type: 'POST',
					dataType: 'json',
					encode: true,
					data: form,
					contentType:false,
					processData:false,
					success: function(data){
						console.log(data);
						if (data.success) {
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

