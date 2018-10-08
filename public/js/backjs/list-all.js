function listarCotizaciones()
  {
    tablaCots=$('#tbl_cots_all').dataTable({
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
              url: dominio+'controllers/CotizacionController.php?op=list-all',
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

function view_file(file,tipo) {
  // console.log('orden: '+orden);
  $("#orden_view").modal("show");
  let embed = document.querySelector('#orden_view #pdf_orden');
  if (tipo=="cotizacion") {
    embed.src= dominio+'pdf_cotizaciones/'+file;
    $("#orden_view .modal-title").text("Cotizacion | "+file)
  }else{
    embed.src= dominio+'orden_servicio/'+file;
    $("#orden_view .modal-title").text("Orden de Servicio | "+file)
  }
}