// Funciones para agregar y remover notas
function addNote(e, padre){
    e.preventDefault();
    // Añadir caja de texto.
    $(`#${padre}`).append(`<div class="input-separate">
        <input type=text name="funciones[]" class="form-control" required placeholder="Agregar Nota" />
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
                    <div class="form-group col-lg-12" id="a_${element}">                        
                        <h2>Recepcion:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_recepcion" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break; 
            case 'food':
                template += `
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Alimentos y Bebidas: ID: ${id}</h2>
                        <div class="food_all">                            
                        </div>                        
                    </div>  
                `;                               
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
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Mantenimiento:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_support" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break; 
            case 'buy':
                template += `
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Compras:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_buy" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break; 
            case 'mrs_keys':
                template += `
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Ama de Llaves:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_mrs_keys" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break; 
            case 'golf':
                template += `
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Campo de Golf:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_golf" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break; 
            case 'garden':
                template += `
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Jardineria:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_garden" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break; 
            case 'sell':
                template += `
                    <div class="form-group col-lg-12" id="a_${element}">
                        <h2>Ventas:</h2>
                        <h4>Notas:</h4>
                        <label for="">Agregar 
                        <a href="#" id="btAdd" onclick="addNote(event, 'a_${element}')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>                
                        </label>
                        <input type="text" name="note_sell" class="form-control" placeholder="Agregar nota">
                    </div>  
                `; 
            break;        
        }                     
    }        
    $("#areas_selected").html(template);
}

