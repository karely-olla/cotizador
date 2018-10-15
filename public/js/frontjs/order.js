// Funciones para agregar y remover notas
function addNote(e, padre){
    e.preventDefault();
    // Añadir caja de texto.
    $(`#${padre}`).append(`<div class="input-separate">
        <input type=text name="note_${padre}[]" class="form-control"  placeholder="Agregar Nota" />
        <a href="#" onclick="removeNote(event, this)" class="btn btn-sm btn-danger btn-remove">
            <i class="fa fa-times"></i>
        </a>
    </div>`);
}

function addNoteFood(e, padre) {
    e.preventDefault();
    // Añadir caja de texto.
    $(`#${padre}`).append(`<div class="input-separate">
        <input type=text name="note_food[${padre.replace("s_","")}][]" class="form-control"  placeholder="Agregar Nota" />
        <a href="#" onclick="removeNote(event, this)" class="btn btn-sm btn-danger btn-remove">
            <i class="fa fa-times"></i>
        </a>
    </div>`);
}

function removeNote(e, element){
    e.preventDefault();
    $(element).parent().remove();
}

function addAreas(){
    var areas = [];
	$(":checkbox[name^='areas']").each(function() { if (this.checked) {areas.push($(this).val()); } });
	if (areas.length > 0) {
        construir_areas(areas);
    }else{
        swal({
            position: 'top-center',
            type: 'error',
            title: 'Selecciona al menos una de las areas',
            showConfirmButton: false,
            timer: 2500
        })
    }    
}

function construir_areas(areas){
    let template = '';
    food ='';    
    let id = $("#frm_order #id_empresa").val();
    for (let i = 0; i < areas.length; i++) {
        const element = areas[i];
        switch (element) {
            case 'reception':        
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Recepcion</h3>
                            </div>
                            <div class="box-body" style="">
                                <label>Describe las Funciones:</label>
                                <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_reception[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div>
                `; 
            break; 
            case 'food':
                template += `
                <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Alimentos y Bebidas | Clave: C-RM-${id}</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" name="description[]">
                            <div class="food_all">

                            </div>                             
                        </div>
                    </div>
                </div>`;                               
                $.post(dominio + "controllers/CotizacionController.php?op=foodCotizacion", { id: id }, 
                    function(data) {
                        data = JSON.parse(data);                                            
                        food += `${data.tmpl}`;
                        console.log(food);
                        $(".food_all").html(food);
                });                
                
            break; 
            case 'support':
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Mantenimiento</h3>
                            </div>
                            <div class="box-body" style="">
                            <label>Describe las Funciones:</label>
                            <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_support[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div> 
                `; 
            break; 
            case 'buy':
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Compras</h3>
                            </div>
                            <div class="box-body" style="">
                            <label>Describe las Funciones:</label>
                            <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_buy[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div>  
                `; 
            break; 
            case 'mrs_keys':
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ama de Llaves</h3>
                            </div>
                            <div class="box-body" style="">
                            <label>Describe las Funciones:</label>
                            <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_mrs_keys[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div>  
                `; 
            break; 
            case 'golf':
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Campo de Golf</h3>
                            </div>
                            <div class="box-body" style="">
                            <label>Describe las Funciones:</label>
                            <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_golf[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div>  
                `; 
            break; 
            case 'garden':
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Jardineria</h3>
                            </div>
                            <div class="box-body" style="">
                            <label>Describe las Funciones:</label>
                            <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_garden[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div> 
                `; 
            break; 
            case 'sell':
                template += `
                    <div class="col-lg-6 col-md-6 col-sm-12 col-height">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ventas</h3>
                            </div>
                            <div class="box-body" style="">
                            <label>Describe las Funciones:</label>
                            <textarea name="description[]" class="form-control" required></textarea>
                                <fieldset id="${element}">
                                    <legend>Notas</legend>
                                    <label for="">Agregar
                                    <a href="#" id="btAdd" onclick="addNote(event, '${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                                    </label>
                                    <input type="text" name="note_sell[]" class="form-control" placeholder="Agregar nota">
                                </fieldset> 
                            </div>
                            <div class="box-footer" style="">
                            </div>
                        </div>
                    </div>  
                `; 
            break;        
        }                     
    }        
    $("#areas_selected").html(template);
}

