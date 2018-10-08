
function listarServicios()
  {
    tablaServicios=$('#tbl_eats').dataTable({
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginacion y filtrado realizados por el servidor
        dom: "<'row'<'text-center ' <''B>>>"+
             "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
             "<'row'<'col-lg-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [],

        "ajax":
            {
              url: dominio+'controllers/ServiceController.php?op=listar',
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
listarServicios();


function category(cat)
{
  $("#frm_create .modal-body .tags, #frm_edit .modal-body .tags").remove();
  if (cat=="Alimentos") {
    $("#frm_create .modal-body, #frm_edit .modal-body").append('<div class="form-group tags">'+
                        '<label>Tag:</label>'+
                        '<div class="radio">'+
                          '<input type="radio" name="tag" id="normal" value="Normal" required>'+
                          '<label for="normal">Normal</label>'+
                                  
                          '<input type="radio" name="tag" id="buffet" value="Buffet" required>'+
                          '<label for="buffet">Buffet</label>'+
                        '</div>'+
                      '</div>');
  }else {
     $("#frm_create .modal-body .tags, #frm_edit .modal-body .tags").remove();
  }
}
function category_edit(cat)
{
  $("#frm_edit .modal-body .tags").remove();
  if (cat=="Alimentos") {
    $("#frm_edit .modal-body").append('<div class="form-group tags">'+
                        '<label>Tag:</label>'+
                        '<div class="radio">'+
                          '<input type="radio" name="tag" id="normal-edit" value="Normal" required>'+
                          '<label for="normal-edit">Normal</label>'+
                                  
                          '<input type="radio" name="tag" id="buffet-edit" value="Buffet" required>'+
                          '<label for="buffet-edit">Buffet</label>'+
                        '</div>'+
                      '</div>');
  }else {
     $("#frm_edit .modal-body .tags").remove();
  }

}

$(function(){
  $("#frm_create").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_create")[0]);

    $.ajax({
      url: dominio+'controllers/ServiceController.php?op=guardar',
      type: 'POST',
      dataType: 'json',
      encode:true,
      data: form,
      contentType:false,
      processData:false,
      success:function(data){
        if (data.success) {
          swal({
            position: 'top-end',
            type: 'success',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
          tablaServicios.ajax.reload();
          $("#frm_create")[0].reset();
        }else{
          swal({
            position: 'top-end',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
        }
      }
    })
    

  })
})


// edit
function edit(id)
{
  $("#modal_edit #frm_edit")[0].reset();
  $("#modal_edit #frm_edit .cats input[name='categoria']").removeAttr('checked');

  $.post(dominio+'controllers/ServiceController.php?op=edit', {id: id}, function(data) {
    /*optional stuff to do after success */
      data = JSON.parse(data);
      // console.log(data.categoria);
      categoria = data.categoria.toLowerCase()+"-edit";
      categoria = categoria.replace(" ","-");
      $("#frm_edit .modal-body .tags").remove();
      if (categoria=="alimentos-edit") {
        if (data.tipo =="Buffet") {
          $("#frm_edit .modal-body").append('<div class="form-group tags">'+
                              '<label>Tag:</label>'+
                              '<div class="radio">'+
                                '<input type="radio" name="tag" id="normal-edit" value="Normal" required>'+
                                '<label for="normal-edit">Normal</label>'+
                                        
                                '<input type="radio" name="tag" id="buffet-edit" checked value="Buffet" required>'+
                                '<label for="buffet-edit">Buffet</label>'+
                              '</div>'+
                            '</div>');
        }else if (data.tipo=="" || data.tipo==null) {
          $("#frm_edit .modal-body").append('<div class="form-group tags">'+
                              '<label>Tag:</label>'+
                              '<div class="radio">'+
                                '<input type="radio" name="tag" id="normal-edit" value="Normal" required>'+
                                '<label for="normal-edit">Normal</label>'+
                                        
                                '<input type="radio" name="tag" id="buffet-edit" value="Buffet" required>'+
                                '<label for="buffet-edit">Buffet</label>'+
                              '</div>'+
                            '</div>');
        }else if (data.tipo=="Normal") {
          $("#frm_edit .modal-body").append('<div class="form-group tags">'+
                              '<label>Tag:</label>'+
                              '<div class="radio">'+
                                '<input type="radio" name="tag" id="normal-edit" checked value="Normal" required>'+
                                '<label for="normal-edit">Normal</label>'+
                                        
                                '<input type="radio" name="tag" id="buffet-edit" value="Buffet" required>'+
                                '<label for="buffet-edit">Buffet</label>'+
                              '</div>'+
                            '</div>');
        }
      }else {
         $("#frm_edit .modal-body .tags").remove();
      }
      $("#modal_edit #id_servicio").val(data.id);
      $("#modal_edit .cats #"+categoria).attr('checked','checked');
      $("#modal_edit #subcategoria").val(data.subcategoria);
      $("#modal_edit #servicio").val(data.nombre);
      $("#modal_edit #precio").val(data.precio_iva);
      $("#modal_edit").modal('show');
  });
}

// Update
$(function(){
  $("#frm_edit").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_edit")[0]);

    $.ajax({
      url: dominio+'controllers/ServiceController.php?op=update',
      type: 'POST',
      dataType: 'json',
      encode:true,
      data: form,
      contentType:false,
      processData:false,
      success:function(data){
        if (data.success) {
          swal({
            position: 'top-end',
            type: 'success',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
          tablaServicios.ajax.reload();
        }else{
          swal({
            position: 'top-end',
            type: 'error',
            title: data.msg,
            showConfirmButton: false,
            timer: 1500
          })
        }
      }
    })
    

  })
})

// Delete
function eliminar(id)
{
      swal({
        title: 'Estas seguro de eliminar este servicio?',
        text: "esta accion no se puede revertir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminarlo!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.post(dominio+'controllers/ServiceController.php?op=delete', {id: id}, function(data) {
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
                  tablaServicios.ajax.reload();
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
function onoff_serv(state,id)
{
  if (state==0) {
    $.post(dominio+'controllers/ServiceController.php?op=habilitar', {id: id, state:1}, function(data) {
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
          tablaServicios.ajax.reload();
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
    $.post(dominio+'controllers/ServiceController.php?op=deshabilitar', {id: id, state:0}, function(data) {
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
          tablaServicios.ajax.reload();
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
