// const dominio = "http://cotizador-com.stackstaging.com/";
const dominio = "/cotizador/"

$('#date_start').bootstrapMaterialDatePicker({  lang : 'es', time: false, minDate : new Date() });
$('#date_end').bootstrapMaterialDatePicker({  lang : 'es', time: false, minDate : new Date() });


function showResults(k,grupos,sw){
	// console.log(grupos);
	const ul = document.querySelector('.c_quick-search__results');
	if (grupos.length>0) {
		ul.removeAttribute('hidden');
		list ='';
		grupos.forEach((grupo)=> {
			list+=`<li onclick="buscar(event,'${grupo.empresa} ${grupo.coordinador}','${grupo.tipo}')">
		              <a href="#"><i class="fa fa-search"></i>
		              	${grupo.empresa.replace(k, "<strong><u>"+k+"</u></strong>")}
		                 <small>${grupo.coordinador.replace(k, "<strong><u>"+k+"</u></strong>")}</small>		    
		              </a>
	               </li>`;
		});
		ul.innerHTML = list;
	}else if(grupos =='' && sw==0){
		ul.removeAttribute('hidden');
		ul.innerHTML = `No se encontraron resultados por: ${k}`;
		// ul.setAttribute('hidden', 'hidden');
	}else if (grupos =='' && sw==2) {
		ul.innerHTML = '';
		ul.setAttribute('hidden', 'hidden');
	}

}
function autoCompleteForm(grupo){
	$('.panel-body form input[name="clave"]').val(grupo.clave);
	$('.panel-body form input[name="empresa"]').val(grupo.empresa);
	$('.panel-body form input[name="empresa"]').attr('readonly','readonly');
	$('.panel-body form input[name="coordinador"]').val(grupo.coordinador);
	$('.panel-body form select[name="estado"]').val(grupo.estado);
	$('.panel-body form select[name="estado"]').selectpicker('refresh');
	$('.panel-body form button[data-id="jmr_contacto_estado"]').attr('disabled','disabled');
	$.ajax({
      type: "POST",
      url: dominio+"controllers/CotizacionController.php?op=procedencia",
      data: { estado : grupo.estado } 
    }).done(function(r){
      $('.panel-body form select[name="municipio"]').html(r);
      $('.panel-body form select[name="municipio"]').selectpicker('refresh');
      $('.panel-body form select[name="municipio"]').val(grupo.municipio);
      $('.panel-body form select[name="municipio"]').selectpicker('refresh');
    });
    $('.panel-body form button[data-id="jmr_contacto_municipio"]').attr('disabled','disabled');
    $('.panel-body form input[name="telefono"]').val(grupo.telefono);
    $('.panel-body form input[name="email"]').val(grupo.email);
}

// buscador
function buscar(e,k,tipo){
	// console.log('Evento: '+e.type);
	if (e.type ==='keyup') {
		// console.log('tecla: '+ e.keyCode);
		if (k.length>1) {
			$.ajax({
				url: dominio+'controllers/CotizacionController.php?op=suggestions',
				type: 'POST',
				dataType: 'json',
				encode:true,
				data: {q:k,tipo:tipo},
				success:function(data){
					if (data.success) {
						// console.log('Data: '+data.grupos);
						showResults(k,data.grupos,1);
					}else{
						showResults(k,grupos='',0);
					}
				}
			})
			if (e.keyCode==13) {
				const ul = document.querySelector('.c_quick-search__results');
				$.ajax({
					url: dominio+'controllers/CotizacionController.php?op=search-data',
					type: 'POST',
					dataType: 'json',
					encode:true,
					data: {q:k,tipo:tipo},
					success:function(data){
						if (data.success) {
							autoCompleteForm(data.grupo);
							$("input#buscar").val("");
							ul.innerHTML = '';
							ul.setAttribute('hidden', 'hidden');
						}else{
							
						}
					}
				})
			}
		}else{
			showResults(k,grupos='',2);
		}
	}else if(e.type==='click'){
		if (k.length>1) {
			const ul = document.querySelector('.c_quick-search__results');
			$.ajax({
				url: dominio+'controllers/CotizacionController.php?op=search-data',
				type: 'POST',
				dataType: 'json',
				encode:true,
				data: {q:k,tipo:tipo},
				success:function(data){
					if (data.success) {
						autoCompleteForm(data.grupo);
						$("input#buscar").val("");
						ul.innerHTML = '';
						ul.setAttribute('hidden', 'hidden');
					}else{
					}
				}
			})
		}else{
			showResults(k,grupos='',2);
		}
	}
	// console.log('filtro de busqueda: '+k);
}

// validar telefono
function validPhone(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789()-";
    especiales = "áéíóúabcdefghijklmnñopqrstuvwxyz";

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

	// console.log(e.target.value.length);
	if (e.target.value.length>15) {
		return false;
	}
    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function validLengthPhone(tel) {

	let lngt = $(tel).val();
	let sw;
	if (lngt.length >= 10) {
		sw = true;
	} else if (lngt.length < 10) {
		$(tel).val("");
		$(tel).parent().addClass('has-error');
		$("#helpPhone").text("El telefono debe tener minimo 10 numeros");
		setTimeout(() => {
			$(tel).parent().removeClass('has-error');
			$("#helpPhone").text("");
		}, 2000);
	}
}


// validar email usuario
function validEmail(email,input){
	$.post(dominio+'controllers/CotizacionController.php?op=validEmail', {email: email}, function(data) {
		/*optional stuff to do after success */
		data = JSON.parse(data);
		if (data.success) {

		}else{
			$(input).val("");
			$(input).parent().addClass('has-error');
			$("#helpEmail").text(data.msg);
			setTimeout(()=>{
				$(input).parent().removeClass('has-error');
				$("#helpEmail").text("");
			},2000);
		}
	});
}


// verificar cotizaciones vencidas
function vencimiento() {
	$.post(dominio+'controllers/CotizacionController.php?op=updVencimiento', function(data) {
		/*optional stuff to do after success */
		data = JSON.parse(data);
		if (data.success) {
			if (data.vencidas>0) {
				swal({
			        position: 'top-end',
			        type: 'info',
			        title: data.msg,
			        showConfirmButton: false,
			        timer: 8500
			    })				
			}
		}
	});
}
vencimiento();