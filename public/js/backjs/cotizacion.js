
function listarCotizaciones()
  {
    tablaCots=$('#tbl_cots').dataTable({
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
              url: dominio+'controllers/CotizacionController.php?op=listar-cotizaciones',
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
          // 	{"data":"5"}
          // ],
        "language": idioma_español,
        "bDestroy": true,
        "iDisplayLength": 25,//Paginacion
        "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
      }).DataTable();
}
listarCotizaciones();


function selectDias(id)
{
    $.post(dominio+'controllers/CotizacionController.php?op=selectDias', {id: id}, function(data) {
        $("#cotizacion_info #frm_add_extras #id").val(id);
        $("#cotizacion_info #frm_add_extras #dia").html(data);
        $("#cotizacion_info #frm_add_extras #dia").selectpicker('refresh');
    })
}

function info_cot(id){
  $.post(dominio+'controllers/CotizacionController.php?op=info-cot', {id: id}, function(data) {
    /*optional stuff to do after success */
    // typeof data;
    data = JSON.parse(data);
    // console.log(data.length)
    if (data.success) {
      selectDias(id);
      $("#cotizacion_info .modal-title").text('Cotizacion: '+data.datos.folio+' | Clave: '+data.datos.clave);
      $("#cotizacion_info .list-group span#name_coord").text(data.datos.coordinador);
      $("#cotizacion_info .list-group span#from").text(data.datos.procedencia);
      $("#cotizacion_info .list-group span#phone").text(data.datos.telefono);
      $("#cotizacion_info .list-group span#nights").text(data.datos.noches);
      $("#cotizacion_info .list-group span#days").text(data.datos.dias);
      $("#cotizacion_info").modal("show");
      $("#cotizacion_info #btn_reporte_interno").attr('href',dominio+'reportes/reporte_interno.php?k='+data.datos.token);
      if (data.datos.estado==0) {
        $("#cotizacion_info #btn_enviar_cotizacion").removeClass('hidden');
        $("#cotizacion_info #btn_enviar_cotizacion").attr('onclick','enviar_cot_mail(\''+data.datos.token+'\','+data.datos.id_user+')');
      }else{
        $("#cotizacion_info #btn_enviar_cotizacion").addClass('hidden');
      }
      $("#template_info").html("");
      $("#template_info").html(data.info);  
      listarExtras(id);  
    }else{
      swal({
        position: 'top-end',
        type: 'error',
        title: data.msg,
        showConfirmButton: false,
        timer: 4500
      })
    }
    // console.log(data);
  });
}

function view_ord(orden) {
  // console.log('orden: '+orden);
  $("#orden_view").modal("show");
  let embed = document.querySelector('#orden_view #pdf_orden');
  embed.src= dominio+'orden_servicio/'+orden;
}

function enviar_cot_mail(token,id_usuario)
{
  // console.log("Token: "+token+"<br>"+"Id Usuario: "+id_usuario);
  swal({
    title: 'Estas seguro de enviar esta cotizacion?',
    text: "esta accion solo es responsabilidad de quien la envia!",
    type: 'info',
    showCancelButton: true,
    confirmButtonText: 'Si, enviar!',
    cancelButtonText: 'No, no estoy seguro!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post('../mail/enviar_cotizacion.php', {k:token, iduser:id_usuario}, function(data) {
          data = JSON.parse(data);
          if (data.success) {
            swal({
              position: 'top-end',
              type: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 2500
            })
            tablaCots.ajax.reload();
          }else{
            swal({
              position: 'top-end',
              type: 'error',
              title: data.msg,
              showConfirmButton: false,
              timer: 4500
            })
          }
        // console.log(data);
      }); 
    } else if (
      // Read more about handling dismissals
      result.dismiss === swal.DismissReason.cancel
    ) {

    }
  })
}

function limpiarModalEdit(){
  $("#frm_edit_cotizacion")[0].reset();
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
  $(".btn-reg").fadeOut('250');
  $(".btn-reg").attr('hidden');
  $(".amn span").animateNumber({number:0},1);
  $(".amni span").animateNumber({number:0},1);
  let div = document.getElementById('days_try');
  while (div.childElementCount) {
      div.removeChild(div.firstElementChild);
  }
  arreglo_servicios=[];
}
// edit general (view data)
function edit(id)
{
  limpiarModalEdit();
  $.post(dominio+'controllers/CotizacionController.php?op=edit', {id: id}, function(data) {
    /*optional stuff to do after success */
    // typeof data;
    data = JSON.parse(data);
    if (data.success) {
      listarServicios();
      $("#edit .modal-title").text('Cotizacion: '+data.datos.folio+' | Clave: '+data.datos.clave);
      $("#formulario #empresa").val(data.datos.empresa);
      $("#formulario #jmr_contacto_estado").val(data.datos.estado);
      $("#formulario #jmr_contacto_estado").selectpicker('refresh');
        $.ajax({
          type: "POST",
          url: dominio+"controllers/CotizacionController.php?op=procedencia",
          data: { estado : data.datos.estado } 
        }).done(function(r){
          $("#formulario #jmr_contacto_municipio").html(r);
          $("#formulario #jmr_contacto_municipio").selectpicker('refresh');
          $("#formulario #jmr_contacto_municipio").val(data.datos.municipio);
          $("#formulario #jmr_contacto_municipio").selectpicker('refresh');
        });
      $("#formulario #telefono").val(data.datos.telefono);
      $("#formulario #email").val(data.datos.correo);
      $("#formulario #coordinador").val(data.datos.coordinador);
      $("#formulario #date_start").val(data.datos.fecha_entrada);
      $("#formulario #date_end").val(data.datos.fecha_salida);

      $("#formulario #date_end").attr('onchange','calcular(this.value,mostrarServicios('+id+'))');
      $("#formulario #date_start").trigger('onchange');
      $("#formulario #date_end").trigger('onchange');

      $("#formulario #dias").val(data.datos.dias);
      $("#formulario #total_c").val(data.datos.monto);
      $("#formulario #n_int").val(data.datos.huespedes);
      $(".amn span").animateNumber({number:data.datos.monto},0);
      $(".amni span").animateNumber({number:data.datos.huespedes},0);
      $("#formulario .amn span").text(data.datos.monto);
      $("#formulario .amni span").text(data.datos.huespedes);


      if (data.hospedaje.length>0) {
        $("#formulario .step_one").removeAttr('hidden');
        for (var i = 0; i < data.hospedaje.length; i++) {
           habitacion = data.hospedaje[i].habitacion.replace(" ","_");
          $("#formulario input."+habitacion).val(data.hospedaje[i].cantidad);
          $("#formulario i."+habitacion).text(data.hospedaje[i].tarifa);
          $("#formulario input."+habitacion).trigger('onchange');
        }
      }else{
        $("#formulario .step_one").attr('hidden','hidden');
        suma_rooms();
      }
      $("#formulario input#id_fila").val(id);
      $("#edit").modal("show");
    }else{
      swal({
        position: 'top-end',
        type: 'error',
        title: data.msg,
        showConfirmButton: false,
        timer: 4500
      })
    }
    // console.log(data);
  });
  // mostrarServicios(id);
}

function mostrarServicios(id) {
  $.post(dominio+'controllers/ServiceController.php?op=show-servicios', {id: id}, function(data) {
    /*optional stuff to do after success */
    // typeof data;
    data = JSON.parse(data);
    if (data.datos.length>0) {
      dias=[];
      for (var i = 0; i < data.datos.length; i++) {
        dias[i]=(data.datos[i].dia);
      }
      dias = dias.map(item => item)
      .filter((value, index, self) => self.indexOf(value) === index)

      // console.log('Dias: '+ dias);
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
      setTimeout(()=>{
        for (var i = 0; i < data.datos.length; i++) {
        
          dia_input = data.datos[i].dia.replace("_", " ").replace("_", " ").replace("_", " ");
          if (encuentra(data.datos[i].id+'_'+dia)) {
              swal({
                  position: 'top-end',
                  type: 'error',
                  title: 'Ese servicio ya esta agregado',
                  showConfirmButton: false,
                  timer: 1500
              })
          }else{
                arreglo_servicios.push(data.datos[i].id+'_'+data.datos[i].dia);
                num_integrantes = $("#n_int").val();
                // template servicio
                label = document.createElement('label');
                label.classList.add('label','label-danger');
                label.innerHTML = data.datos[i].servicio + ' $'+data.datos[i].precio;
                btn_delete = document.createElement('i');
                btn_delete.classList.add('fa','fa-times','btn','btn-warning','btn-xs','btn_del_service');
                btn_delete.setAttribute('onclick', 'del_servicio(event, \''+data.datos[i].id+'_'+data.datos[i].dia+'\')');
                input_cantidad = document.createElement('input');
                input_cantidad.setAttribute('type','number');
                input_cantidad.setAttribute('name','servicios['+dia_input+']['+data.datos[i].id+'][]');
                if(data.datos[i].tipo=="Buffet") {
                  input_cantidad.setAttribute('min',40);
                  // input_cantidad.setAttribute('max',data.datos[i].cantidad);
                }else{
                  input_cantidad.setAttribute('min',0);
                  // input_cantidad.setAttribute('max',data.datos[i].cantidad);
                }
                input_cantidad.setAttribute('data-costo',data.datos[i].precio);
                input_cantidad.setAttribute('onblur','set_value(this)');
                input_cantidad.setAttribute('onchange','calc_eats(this)');
                (data.datos[i].categoria == 'Precios Generales')? input_cantidad.value = 1 : input_cantidad.value = data.datos[i].cantidad;
                label.append(input_cantidad);
                label.append(btn_delete);
                columna = document.getElementById(`${data.datos[i].dia.replace(" ", "_").replace(" ", "_").replace(" ", "_")}`);
                columna.appendChild(label); 
                // console.table(arreglo_servicios);
          }
          // console.table(arregloFullDay);
          $("label input[name='servicios["+dia_input+"]["+data.datos[i].id+"][]']").trigger('onchange');
        }
      },500);
    }else{
      $("#days_try").html("");
    }
  });
}

// Actualizar Cotizacion
$(function(){
  $("#frm_edit_cotizacion").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_edit_cotizacion")[0]);

    $.ajax({
      url: dominio+'controllers/CotizacionController.php?op=update',
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
            timer: 1500
          })
          tablaCots.ajax.reload();
        }else{
          swal({
            position: 'top-end',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 3000
          })
        }
      }
    })
  })
})

// Eliminar cotizacion
function delete_cot(id)
{
  swal({
    title: 'Estas seguro de que esta cotizacion la deseas eliminar?',
    text: "esta accion no se puede revertir!",
    type: 'info',
    showCancelButton: true,
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'No, no estoy seguro!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(dominio+'controllers/CotizacionController.php?op=delete', {id: id}, function(data) {
        /*optional stuff to do after success */
        // typeof data;
          data = JSON.parse(data);
          if (data.success) {
            swal({
              position: 'top-end',
              type: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 2500
            })
            tablaCots.ajax.reload();
          }else{
            swal({
              position: 'top-end',
              type: 'error',
              title: data.msg,
              showConfirmButton: false,
              timer: 4500
            })
            tablaCots.ajax.reload();
          }
        // console.log(data);
      }); 
    } else if (
      // Read more about handling dismissals
      result.dismiss === swal.DismissReason.cancel
    ) {
    }
  })
}


// Confirmar Cotizacion
function confirmar(id){ 
  $.post(dominio+'controllers/CotizacionController.php?op=jwToken', {id:id},
    function (data) {
      data=JSON.parse(data);
      if (data.success) {
        $("#btn_generate_service").attr('href',`order-service.php?tkn=${data.token}&clave=${data.clave}`);
      } else{
        $("#btn_generate_service").attr('disabled',`disabled`);
      }
    }
  );
  $("#frm_confirm_cot #id").val(id); $("#modal_confirm_cot").modal("show");
}

function mostrarFilename(file){
  if(file.files.length>0){ 
    $("#frm_confirm_cot .name_file").text(file.files[0].name);
  }else{
    $("#frm_confirm_cot .name_file").text(""); 
  }
} 

$(function(){
  $("#frm_confirm_cot").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_confirm_cot")[0]);
    $('#frm_confirm_cot .progress').removeAttr('hidden');
    $.ajax({
        url: dominio+'controllers/CotizacionController.php?op=confirmar',
        type: 'post',
        dataType: 'json',
        encode: true,
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data)
        {
          tablaCots.ajax.reload();
           $("#modal_confirm_cot").modal("hide");
            setTimeout(function(){
              if (data.success) {
                swal({
                  position: 'top-end',
                  type: 'success',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 2500
                })
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
            $("#frm_confirm_cot")[0].reset();
            $("#frm_confirm_cot .name_file").text("");
        },
        xhr: function(){
           var xhr = new window.XMLHttpRequest();
           xhr.upload.addEventListener("progress", function(evt){
               if (evt.lengthComputable) {
                  var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                  //Do something with upload progress
                  // console.log(percentComplete);
                   $("#frm_confirm_cot #barra_estado").css({
                      "width": percentComplete+"%"
                   })
                  $("#frm_confirm_cot #barra_estado span").html(percentComplete+"%");
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
            $('#frm_confirm_cot #barra_estado').addClass('progress-bar-success');
            setTimeout(function () {
              $('#frm_confirm_cot .progress').attr('hidden', 'hidden');
              $("#frm_confirm_cot #barra_estado").css({
                "width": "0%"
              })
              $('#frm_confirm_cot #barra_estado').removeClass('progress-bar-success');
            }, 800);
        }
    })
  })
})

// Anular Cotizacion
function anular(id)
{
  swal({
    title: 'Estas seguro de anular la confirmacion de esta cotizacion?',
    // text: "esta accion !",
    type: 'info',
    showCancelButton: true,
    confirmButtonText: 'Si, anular!',
    cancelButtonText: 'No, no estoy seguro!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(dominio+'controllers/CotizacionController.php?op=anular', {id: id}, function(data) {
        /*optional stuff to do after success */
        // typeof data;
          data = JSON.parse(data);
          if (data.success) {
            swal({
              position: 'top-end',
              type: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 2500
            })
            tablaCots.ajax.reload();
          }else{
            swal({
              position: 'top-end',
              type: 'error',
              title: data.msg,
              showConfirmButton: false,
              timer: 4500
            })
            tablaCots.ajax.reload();
          }
        // console.log(data);
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