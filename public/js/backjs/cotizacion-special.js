function listarCotizaciones()
  {
    tablaCots=$('#tbl_cots_especial').dataTable({
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
              url: dominio+'controllers/EspecialController.php?op=listar',
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
  $.post(dominio+'controllers/EspecialController.php?op=info', {id: id}, function(data) {
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
  $("#frm_edit_cotizacion_special")[0].reset();
  $("#date_start").val("");
  $("#date_end").val("");
  $("#date_end").attr('disabled','disabled');
  $(".btn-reg").fadeOut('250');
  $(".btn-reg").attr('hidden');
  $(".amn span").animateNumber({number:0},1);
  $("#formulario #date_end").attr('onchange','calcular(this.value)');
}
// edit general (view data)
function edit(id)
{
  limpiarModalEdit();

  $.post(dominio+'controllers/EspecialController.php?op=edit', {id: id}, function(data) {
    /*optional stuff to do after success */
    // typeof data;
    data = JSON.parse(data);
    if (data.success) {
      // console.log(data.hospedaje)
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

      $("#formulario #date_start").trigger('onchange');
      $("#formulario #date_end").trigger('onchange');
      $("#formulario #date_end").attr('onchange','calcular(this.value,mostrarServicios('+id+'))');

      $("#formulario #dias").val(data.datos.dias);
      $("#formulario #total_c").val(data.datos.monto);
      $(".amn span").animateNumber({number:data.datos.monto},0);
      $("#formulario .amn span").text(data.datos.monto);

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
    hospedaje = data.hospedaje;
    mostrarServicios(id);
  });
}

function mostrarServicios(id) {
  let div = document.getElementById('days_try');
  while (div.childElementCount) {
      div.removeChild(div.firstElementChild);
  }
  arreglo_servicios=[];
  $.post(dominio+'controllers/ServiceController.php?op=show-servicios', {id: id}, function(data) {
    /*optional stuff to do after success */
    // typeof data;
    data = JSON.parse(data);
    if (data.datos.length>0) {
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

      for(dia in hospedaje){
        // console.log(`${dia.replace(" ","_").replace(" ","_").replace(" ","_")}`);
        for(h in hospedaje[dia]){
          //console.log(`${h}:  ${hospedaje[dia][h].tarifa}`);
          switch (h){
             case 'habitacion sencilla':
                // console.log("es: n_hs");
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_hs`).val(hospedaje[dia][h].cantidad);
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_hs`).trigger('onchange');
             break;

             case 'habitacion doble':
                // console.log("es: n_hd");
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_hd`).val(hospedaje[dia][h].cantidad);
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_hd`).trigger('onchange');
             break;

             case 'habitacion triple':
                // console.log("es: n_ht");
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_ht`).val(hospedaje[dia][h].cantidad);
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_ht`).trigger('onchange');
             break;

             case 'habitacion cuadruple':
                // console.log("es: n_hc");
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_hc`).val(hospedaje[dia][h].cantidad);
                $(`#${dia.replace(" ","_").replace(" ","_").replace(" ","_")} input#n_hc`).trigger('onchange');
             break;
          }
        }
      }

      setTimeout(()=>{
        for (var i = 0; i < data.datos.length; i++) {
        
          dia_input = data.datos[i].dia.replace("_", " ").replace("_", " ").replace("_", " ");
          // if (encuentra(data.datos[i].id+'_'+dia)) {
          //     swal({
          //         position: 'top-end',
          //         type: 'error',
          //         title: 'Ese servicio ya esta agregado',
          //         showConfirmButton: false,
          //         timer: 1500
          //     })
          // }else{
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
          // }
          // console.table(arregloFullDay);
          $("label input[name='servicios["+dia_input+"]["+data.datos[i].id+"][]']").trigger('onchange');
          // console.table(arreglo_servicios);
        }
      },500);
    }else{
      $("#days_try").html("");
    }
  });
}

// Actualizar Cotizacion
$(function(){
  $("#frm_edit_cotizacion_special").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_edit_cotizacion_special")[0]);

    $.ajax({
      url: dominio+'controllers/EspecialController.php?op=update',
      type: 'POST',
      dataType: 'json',
      encode:true,
      data: form,
      contentType:false,
      processData:false,
      success:function(data){
        console.log(data);
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
function confirmar(id){ $("#frm_confirm_cot #id").val(id); $("#modal_confirm_cot").modal("show");}
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