
$(function(){
	$("#frm_edit_img").on("submit", function(e){
		e.preventDefault();

		let form = new FormData($("#frm_edit_img")[0]);

		$.ajax({
			url: dominio+'controllers/ProfileController.php?op=updImage',
			type: 'POST',
			dataType: 'json',
			encode:true,
			beforeSend: function() {
		        let loading = document.querySelector('.user-image #loading');
		        let img = document.getElementById('img_profile');
				img.classList.add('hidden');
		        loading.classList.remove('hidden');
		    },
			data: form,
			contentType:false,
			processData:false,
			success:function(data){
				loadImage(data.foto);
				$("#frm_edit_img")[0].reset();			
			}
		})		
	})
})

function loadImage(foto) {
	let loading = document.querySelector('.user-image #loading');
	let img = document.getElementById('img_profile');
	setTimeout(()=>{
		loading.classList.add('hidden');
		img.src= dominio+'public/images/avatars/'+foto;
		$(".user-panel .img-circle").attr('src', dominio+'public/images/avatars/'+foto);
		$(".user-menu a img").attr('src', dominio+'public/images/avatars/'+foto);
		$(".dw-user-box .u-img img").attr('src', dominio+'public/images/avatars/'+foto);
		img.classList.remove('hidden');
		$("#frm_edit_img .name_file").text("");
	},300)
}

function mostrarFilename(file){
  if(file.files.length>0){ 
    $("#frm_edit_img .name_file").text(file.files[0].name);
  }else{
    $("#frm_edit_img .name_file").text(""); 
  }
}


// Actualizar contraseña

function validLength() {
	let pass_new = document.getElementById('pass_new');
	if (pass_new.value.length<8) {
		return false;		
	}else{
		return true;
	}
}
function validConfirmPass() {
	let pass_new = document.getElementById('pass_new');
	let pass_new_confirm = document.getElementById('pass_new_confirm');

	if (pass_new_confirm.value==pass_new.value) {
		return true;
	}else{
		return false;
	}
}

$(function(){
	$("#frm_edit_pass").on("submit", function(e){
		e.preventDefault();
		let pass_new = document.getElementById('pass_new');
		let pass_new_confirm = document.getElementById('pass_new_confirm');
		if (validLength()) {
			if (validConfirmPass()) {
				let form = new FormData($("#frm_edit_pass")[0]);
				$.ajax({
					url: dominio+'controllers/ProfileController.php?op=updPass',
					type: 'POST',
					dataType: 'json',
					encode:true,
					data: form,
					contentType:false,
					processData:false,
					success:function(data){
						// console.log(data);
						if (data.success) {
							swal({
					            position: 'top-end',
					            type: 'success',
					            title: data.msg,
					            showConfirmButton: false,
					            timer: 3500
					          })
							$("#frm_edit_pass")[0].reset();
						}else{
							swal({
					            position: 'top-end',
					            type: 'error',
					            title: data.msg,
					            showConfirmButton: false,
					            timer: 3500
					        })
						}
						// loadImage(data.foto);
					}
				})	
			}else{
				pass_new_confirm.parentElement.classList.add('has-error');
				pass_new.parentElement.classList.add('has-error');
				$("#helpPassConfirm").text('Las contraseñas no coinciden');
				setTimeout(()=>{
					pass_new_confirm.parentElement.classList.remove('has-error');
					pass_new.parentElement.classList.remove('has-error');
					$("#helpPassConfirm").text('');
				},1800);
			}
		}else{
			pass_new.parentElement.classList.add('has-error');
			$("#helpPass").text('La contraseña debe tener minimo 8 caracteres');
			setTimeout(()=>{
				pass_new.parentElement.classList.remove('has-error');
				$("#helpPass").text('');
			},1800);
		}
	})
})



Highcharts.setOptions({
  colors: ['#058DC7','#FF9800','#50B432', '#E22622', '#777777', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
}); 

function getCots() {
	$.post(dominio+'controllers/ProfileController.php?op=stadistics',  function(data) {
	  /*optional stuff to do after success */
	  data = JSON.parse(data);
	  if (data.success) {
	    $(".not_found").text("");
	    $(".show_estadistics").html(data.chart);
	  }else{
	    $(".not_found").text(data.msg);
	    $(".show_estadistics").html("");
	  }
	});
}
getCots();

function getMonths(){
	$.post(dominio+'controllers/CotizacionController.php?op=getMonths',  function(data) {
		$("#perMonth").html(data);
		$("#perMonth").selectpicker('refresh');
	});
}
getMonths();
function show_PerMonth(Month) {
	console.log(Month);
	$.post(dominio+'controllers/ProfileController.php?op=stadistics', {month: Month}, function(data) {
		/*optional stuff to do after success */
		data = JSON.parse(data);
		if (data.success) {
		    $(".not_found").text("");
		    $(".show_estadistics").html(data.chart);
		}else{
		    $(".not_found").text(data.msg);
		    $(".show_estadistics").html("");
		}
	});
}
