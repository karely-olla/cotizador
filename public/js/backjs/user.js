let dominioRe = "/";
// mostrar imagen preview
function mostrarImagen(formulario, event) {
  let file = event.target.files[0];
  let conten_img = document.querySelector('#'+formulario+' .input-file .show_prev_img');
  let img = document.createElement('img');
  if(event.target.files.length>0){
    conten_img.innerHTML="";
    let reader = new FileReader();
    reader.onload = function(event) {
      img.classList.add('img-thumbnail','img-rounded');
      img.src= event.target.result;
      conten_img.appendChild(img);
    }
    reader.readAsDataURL(file);
  }else{
    conten_img.innerHTML="";
  }
}

// Login
$(function(){
  $("#frm_sign").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_sign")[0]);

    $.ajax({
      url: dominioRe+'controllers/UserController.php?op=login',
      type: 'POST',
      dataType: 'json',
      encode:true,
      data: form,
      contentType:false,
      processData:false,
      success:function(data){
        if (data.exito) {
          $(location).attr('href','./index.php');
        }else{
          swal({
            position: 'top-center',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 2500
          })
        }
      }
    })
  })
})

// reset-pass
$(function(){
  $("#frm_pass").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_pass")[0]);

    $.ajax({
      url: dominioRe+'controllers/UserController.php?op=reset-password',
      type: 'POST',
      dataType: 'json',
      encode:true,
      data: form,
      contentType:false,
      processData:false,
      success:function(data){
        if (data.success) {
          swal({
            position: 'top-center',
            type: 'success',
            title: data.msg,
            showConfirmButton: false,
            timer: 6500
          })          
        }else{
          swal({
            position: 'top-center',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 3500
          })
        }
      }
    })
  })
})


// update reset pass new of user
function validLength() {
  let pass_new = document.getElementById('pass_new_reset');
  if (pass_new.value.length<8) {
    return false;   
  }else{
    return true;
  }
}
function validConfirmPass() {
  let pass_new = document.getElementById('pass_new_reset');
  let pass_new_confirm = document.getElementById('pass_new_confirm');

  if (pass_new_confirm.value==pass_new.value) {
    return true;
  }else{
    return false;
  }
}
$(function(){
  $("#frm_resetpass_upd").on("submit", function(e){
    e.preventDefault();
    let pass_new = document.getElementById('pass_new_reset');
    let pass_new_confirm = document.getElementById('pass_new_confirm');
    if (validLength()) {
      if (validConfirmPass()) {
        form = new FormData($("#frm_resetpass_upd")[0]);

        $.ajax({
          url: dominioRe+'controllers/UserController.php?op=reset-password-update',
          type: 'POST',
          dataType: 'json',
          encode:true,
          data: form,
          contentType:false,
          processData:false,
          success:function(data){
            if (data.success) {
              swal({
                position: 'top-center',
                type: 'success',
                title: data.msg,
                showConfirmButton: false,
                timer: 3500
              })
              setTimeout(()=>{
                $(location).attr('href','./login.php');
              },4200)
            }else{
              swal({
                position: 'top-center',
                type: 'error',
                title: data.msg,
                showConfirmButton: false,
                timer: 2500
              })
            }
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



function listarUsuarios()
  {
    tablaUsuarios=$('#tbl_users').dataTable({
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginacion y filtrado realizados por el servidor
        dom: "<'row'<'text-center ' <''B>>>"+
             "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
             "<'row'<'col-lg-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
              // {
              //   extend: 'excelHtml5',
              //   text: '<strong><i class="fa fa-file-excel-o"></i> Excel</strong>',
              //   className: 'btn btn-success',
              //   title: "Reporte de Plantillas",
              //   // exportOptions: {
              //   // columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
              //   // },
              //   titleAttr: 'Excel'
              // },
              // {
              //   extend: 'pdfHtml5',
              //   text: '<strong><i class="fa fa-file-pdf-o"></i> PDF</strong>',
              //   className: 'btn btn-danger',
              //   title: "Reporte de Plantillas",
              //   // exportOptions: {
              //   //   columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
              //   // },
              //   titleAttr: 'PDF'
              // }
            ],

        "ajax":
            {
              url: dominioRe+'controllers/UserController.php?op=listar',
              type: "get",
              dataType: "json",
              error: function(e){
                console.log(e.responseText);
              }
            },
          // "columns":[
          // 	{"data":"0"},
          // 	{"data":"1"},
          // 	{"data":"2"},
          // 	{"data":"3"},
          // 	{"data":"4"},
          // 	{"data":"5"},
          //   {"data":"6"}
          // ],
        "language": idioma_español,
        "bDestroy": true,
        "iDisplayLength": 25,//Paginacion
        "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
      }).DataTable();
}
listarUsuarios();


$(function(){
  $("#frm_create").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_create")[0]);
    $('#frm_create .progress').removeAttr('hidden');
    $.ajax({
        url: dominioRe+'controllers/UserController.php?op=create',
        type: 'post',
        dataType: 'json',
        encode: true,
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data)
        {
          tablaUsuarios.ajax.reload();
            setTimeout(function(){
              if (data.success) {
                swal({
                  position: 'top-end',
                  type: 'success',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 2500
                })
                document.querySelector('#frm_create .input-file .show_prev_img').innerHTML="";
              }else{
                swal({
                  position: 'top-end',
                  type: 'error',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 2500
                })
              }
            },500);
            $("#frm_create")[0].reset();
        },
        xhr: function(){
           var xhr = new window.XMLHttpRequest();
           xhr.upload.addEventListener("progress", function(evt){
               if (evt.lengthComputable) {
                  var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                  //Do something with upload progress
                  // console.log(percentComplete);
                   $("#frm_create #barra_estado").css({
                      "width": percentComplete+"%"
                   })
                  $("#frm_create #barra_estado span").html(percentComplete+"%");
               }
           }, false);
           //Download progress
           xhr.addEventListener("progress", function(evt){
                if (evt.lengthComputable) {
                  var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                  //Do something with download progress
                  // console.log(percentComplete);
                }
           }, false);

           return xhr;
        },
        complete:function(data){
            // console.log("Request finished.");
            $('#frm_create #barra_estado').addClass('progress-bar-success');
            setTimeout(function () {
              $('#frm_create .progress').attr('hidden', 'hidden');
              $("#frm_create #barra_estado").css({
                "width": "0%"
              })
              $('#frm_create #barra_estado').removeClass('progress-bar-success');
            }, 800);
        }
    })
  })
})


// edit
function edit(id)
{
  $("#modal_edit #frm_edit")[0].reset();
  $.post(dominioRe+'controllers/UserController.php?op=edit', {id: id}, function(data) {
    /*optional stuff to do after success */
      const conten_img_user = document.querySelector('#frm_edit .input-file .show_prev_img');
      conten_img_user.innerHTML = "";
      data = JSON.parse(data);
      // console.log(data);
      $("#modal_edit #id_usuario").val(data.id);
      $("#modal_edit #nombre").val(data.nombre);
      $("#modal_edit #apellido").val(data.apellidos);
      $("#modal_edit #correo").val(data.correo);
      $("#modal_edit #telefono").val(data.telefono);
      $("#modal_edit #usuario").val(data.usuario);
      if (data.foto!=="sin foto") {
        let foto = document.createElement('img');
        foto.classList.add('img-thumbnail','img-rounded');
        foto.src= dominioRe+'public/images/avatars/'+data.foto;
        conten_img_user.appendChild(foto);
      }
      $("#modal_edit #contraseña").val(data.contrasena);
      $("#modal_edit #rol").val(data.rol);
      $("#modal_edit #rol").selectpicker('refresh');
      $("#modal_edit").modal('show');
  });
}

// Update
$(function(){
  $("#frm_edit").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_edit")[0]);
    $('#frm_edit .progress').removeAttr('hidden');
    $.ajax({
        url: dominioRe+'controllers/UserController.php?op=update',
        type: 'post',
        dataType: 'json',
        encode: true,
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data)
        {
          tablaUsuarios.ajax.reload();
            setTimeout(function(){
              if (data.success) {
                swal({
                  position: 'top-end',
                  type: 'success',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 2500
                })
                document.querySelector('#frm_edit .input-file .show_prev_img').innerHTML="";
              }else{
                swal({
                  position: 'top-end',
                  type: 'error',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 2500
                })
              }
            },500);
            $("#frm_edit")[0].reset();
        },
        xhr: function(){
           var xhr = new window.XMLHttpRequest();
           xhr.upload.addEventListener("progress", function(evt){
               if (evt.lengthComputable) {
                  var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                  //Do something with upload progress
                  // console.log(percentComplete);
                   $("#frm_edit #barra_estado").css({
                      "width": percentComplete+"%"
                   })
                  $("#frm_edit #barra_estado span").html(percentComplete+"%");
               }
           }, false);
           //Download progress
           xhr.addEventListener("progress", function(evt){
                if (evt.lengthComputable) {
                  var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                  //Do something with download progress
                  // console.log(percentComplete);
                }
           }, false);

           return xhr;
        },
        complete:function(data){
            // console.log("Request finished.");
            $('#frm_edit #barra_estado').addClass('progress-bar-success');
            setTimeout(function () {
              $('#frm_edit .progress').attr('hidden', 'hidden');
              $("#frm_edit #barra_estado").css({
                "width": "0%"
              })
              $('#frm_edit #barra_estado').removeClass('progress-bar-success');
            }, 800);
        }
    })
  })
})

// Delete
function eliminar(id)
{
      swal({
        title: 'Estas seguro de eliminar este Usuario?',
        text: "esta accion no se puede revertir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminarlo!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.post(dominioRe+'controllers/UserController.php?op=delete', {id: id}, function(data) {
            /*optional stuff to do after success */
              data = JSON.parse(data);
                if (data.success) {
                  swal({
                    position: 'top-end',
                    type: 'success',
                    title: data.msg,
                    showConfirmButton: false,
                    timer: 1500
                  })
                  tablaUsuarios.ajax.reload();
                }else{
                  swal({
                    position: 'top-end',
                    type: 'error',
                    title: data.msg,
                    showConfirmButton: false,
                    timer: 1500
                  })
                }
          });
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

// Deshabilitar
function onoff_user(state,id)
{
  if (state==0) {
    $.post(dominioRe+'controllers/UserController.php?op=habilitar', {id: id, state:1}, function(data) {
      /*optional stuff to do after success */
        data = JSON.parse(data);
        if (data.success) {
          swal({
            position: 'top-end',
            type: 'success',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
          tablaUsuarios.ajax.reload();
        }else{
          swal({
            position: 'top-end',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
        }
        // console.log(data.precio);
    });
  }else{
    $.post(dominioRe+'controllers/UserController.php?op=deshabilitar', {id: id, state:0}, function(data) {
      /*optional stuff to do after success */
        data = JSON.parse(data);
        if (data.success) {
          swal({
            position: 'top-end',
            type: 'success',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
          tablaUsuarios.ajax.reload();
        }else{
          swal({
            position: 'top-end',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
        }
        // console.log(data.precio);
    });
  }
}

