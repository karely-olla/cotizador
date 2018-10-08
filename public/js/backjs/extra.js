function listarExtras(id)
{
    tablaExtras=$('#tbl_extras').dataTable({
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
              url: dominio+'controllers/ExtrasController.php?op=listar&id_empresa='+id,
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

$(function(){
  $("#frm_add_extras").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_add_extras")[0]);

    $.ajax({
      url: dominio+'controllers/ExtrasController.php?op=guardar',
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
          tablaCots.ajax.reload();
          tablaExtras.ajax.reload();
          $("#frm_add_extras")[0].reset();
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
// Ver Extra
function show_extra(id)
{
   $.post(dominio+'controllers/ExtrasController.php?op=edit', {id: id}, function(data)  {
     /*optional stuff to do after success */
       data = JSON.parse(data);
       $.post('../../controllers/CotizacionController.php?op=selectDias', {id: data.id_empresa}, function(dias) {
          $("#modal_edit_extras #frm_upd_extras #dia").html(dias);
          $("#modal_edit_extras #frm_upd_extras #dia").selectpicker('refresh');
        })
      $("#cotizacion_info").modal("hide");
      setTimeout(function(){

        $("#modal_edit_extras #frm_upd_extras #id").val(data.id);
        $("#modal_edit_extras #frm_upd_extras #dia").val(data.dia);
        $("#modal_edit_extras #frm_upd_extras #dia").selectpicker('refresh');
        $("#modal_edit_extras #frm_upd_extras #servicio").val(data.servicio);
        $("#modal_edit_extras #frm_upd_extras #costo").val(data.costo);
        $("#modal_edit_extras").modal("show");
      },250);
   });
}
// Actualizar Extra
$(function(){
  $("#frm_upd_extras").on("submit", function(e){
    e.preventDefault();
    form = new FormData($("#frm_upd_extras")[0]);

    $.ajax({
      url: dominio+'controllers/ExtrasController.php?op=update',
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
          tablaCots.ajax.reload();
          tablaExtras.ajax.reload();          
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
// Eliminar Extra
function delete_extra(id)
{
    swal({
    title: 'Estas seguro de eliminar este servicio extra?',
    // text: "esta accion !",
    type: 'info',
    showCancelButton: true,
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'No, no estoy seguro!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(dominio+'controllers/ExtrasController.php?op=delete', {id: id}, function(data) {
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
            tablaExtras.ajax.reload();
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
      // swal(
      //   'Cancelado',
      //   'Your imaginary file is safe :)',
      //   'error'
      // )
    }
  })
}