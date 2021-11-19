$(document).ready(function() {
    var idSelected = 0;
    var phonesArray = [];

    var name = $('#name'); 
    var fullname = $('#fullname');
    var email = $('#email');
    var group = $('#group');
    var phone = $('#phone');

    var inputName = $('#input-name');
    var inputLastame = $('#input-lastname');
    var inputPhone = $('#inputPhone');
    var inputEmail = $('#input-email');
    var inputGroup = $('#inputGroup');

    /**
     * Obtenemos la lista de usuario
     */
    $.ajax(settingsAjax('users',{},'GET')).done(function (response) {
        $('#ul-listUser').empty();
        $.each(jQuery.parseJSON(response), function( index, value ) {
            var element = '<li class="list-group-item list-user" id="'+value.id+'" >'+value.name+'</li>';
            $('#ul-listUser').append(element);
          });
    });

    /**
     * Obtenemos un usuario en especifico y llenamos los datos
     */
    $('#ul-listUser').on('click','li', function(){
        id = $(this).attr('id')
        idSelected = id;
        $.ajax(settingsAjax('getUsersId/'+id,{},'GET')).done(function (response) {
            $.ajax(settingsAjax('getPhoneUsersId/'+id,{},'GET')).done(function (response){
                phone.empty();
                var p = '';
                $.each(jQuery.parseJSON(response), function( index, value ) {
                    p += '<p>'+value.number+'</p>'
                });
                phone.append(p);
            });
            value = jQuery.parseJSON(response)[0];
            name.text( value.name);
            fullname.text(value.name +' '+value.second_name)
            email.text(value.email );
            text_group = '';
            switch(value.group){
                case 1: text_group = 'Familia';break;
                case 2: text_group = 'Amigos';break;
                case 3: text_group = 'Trabajo';break;
                case 4: text_group = 'Otros';break;
            }
            group.text(text_group);
        }); 
    });

    /**
     * Función para mostrar el contenedor para agregar un contacto
     */
    $('#btn-add').on('click', function(){
        $('#div-detalle').hide();
        $('#div-edicion').show();
    });

    /**
     * Función para ocultar el contenedor para agregar un contacto
     */
     $('#btn-cancel').on('click', function(){
        $('#div-edicion').hide();
        $('#div-detalle').show();
    });

    /**
     * Función para agregar un contacto
     */
     $('#btn-save').on('click', function(){
        phonesArray = [];
        _phone = {};
        regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ *]+$/s;
        regexPhone = /^[\d{10}]/;
        if(inputName.val() == '' || inputLastame.val() == '' || inputEmail.val() == '' || inputPhone.val() == '' || inputGroup.val() == null){
            alert("Los campos no pueden ir vacios.");
            return;
        }
        if(!regex.test(inputName.val())){
            alert('El nombre continen caracteres no permitidos');
            return;
        }
        if(!regex.test(inputLastame.val())){
            alert('El apellido continen caracteres no permitidos');
            return;
        }
        if(inputPhone.val().replace(' ','').length < 10){
            alert("El número de teléfono no tiene 10 caracteres");
            return;
        }
        if(!regexPhone.test(inputLastame.val())){
            alert('El teléfono continen caracteres no permitidos');
            return;
        }
        if(inputPhone.val().replace(' ','').length >= 10){
            _array = inputPhone.val().split(",");
            $.each(_array, function(index, value){
                if(value.replace(' ','').length == 10 ){
                    phonesArray.push({phone : value});
                }else{
                    alert("Uno de los números no cumple con el formato");
                    return;
                }
            });
        }
        
        data = {
                    "name": inputName.val(),
                    "second_name": inputLastame.val(),
                    "email": inputEmail.val(),
                    "group": inputGroup.val(),
                    "phones": phonesArray
                };

        $.ajax(settingsAjax('addUser',data,'POST')).done(function (response) {
            updateList();
        });
    });

    $('#btn-edit').on('click', function(){
        $.ajax(settingsAjax('getUsersId/'+id,{},'GET')).done(function (response) {
            $.ajax(settingsAjax('getPhoneUsersId/'+id,{},'GET')).done(function (response){
                var p = '';
                $.each(jQuery.parseJSON(response), function( index, value ) {
                    if(index == jQuery.parseJSON(response).length - 1){
                        p += value.number
                    }else{
                        p += value.number+','
                    }
                    
                });
                inputPhone.val(p);
            });
            value = jQuery.parseJSON(response)[0];
            inputName.val( value.name);
            inputLastame.val(value.second_name)
            inputEmail.val(value.email );
            inputGroup.val(value.group );
            
            $('#div-detalle').hide();
            $('#div-edicion').show();

            $('#btn-save').hide();
            $('#btn-update').show();
        }); 

    });

    $('#btn-update').on('click', function(){
        phonesArray = [];
        _phone = {};
        regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ *]+$/s;
        regexPhone = /^[\d{10}]/;
        if(inputName.val() == '' || inputLastame.val() == '' || inputEmail.val() == '' || inputPhone.val() == '' || inputGroup.val() == null){
            alert("Los campos no pueden ir vacios.");
            return;
        }
        if(!regex.test(inputName.val())){
            alert('El nombre continen caracteres no permitidos');
            return;
        }
        if(!regex.test(inputLastame.val())){
            alert('El apellido continen caracteres no permitidos');
            return;
        }
        if(inputPhone.val().replace(' ','').length < 10){
            alert("El número de teléfono no tiene 10 caracteres");
            return;
        }
        if(!regexPhone.test(inputLastame.val())){
            alert('El teléfono continen caracteres no permitidos');
            return;
        }
        if(inputPhone.val().replace(' ','').length >= 10){
            _array = inputPhone.val().split(",");
            $.each(_array, function(index, value){
                if(value.replace(' ','').length == 10 ){
                    phonesArray.push({phone : value});
                }else{
                    alert("Uno de los números no cumple con el formato");
                    return;
                }
            });
        }

        data = {
                    "name": inputName.val(),
                    "second_name": inputLastame.val(),
                    "email": inputEmail.val(),
                    "group": inputGroup.val(),
                    "phones": phonesArray
                };
        $.ajax(settingsAjax('editUser/'+idSelected,data,'PUT')).done(function (response) {
            updateList();
        });
    });

    /**
     * Función para eliminar un usuario
     */
    $('#btn-delete').on('click', function(){
        var r = confirm("Estas seguro que quieres eliminar este contacto!");
        if (r == true) {
            $.ajax(settingsAjax('deleteUser/'+idSelected,{},'DELETE')).done(function (response) {
            
                updateList();
            });
        } 
        
    });
    
    function updateList(){
        $.ajax(settingsAjax('users',{},'GET')).done(function (response) {
            $('#ul-listUser').empty();
            $.each(jQuery.parseJSON(response), function( index, value ) {
                var element = '<li class="list-group-item list-user" id="'+value.id+'" >'+value.name+'</li>';
                $('#ul-listUser').append(element);
              });
        });
    }

    /**
     * Función para configurar la petición
     * @param {*} url 
     * @param {*} data 
     * @param {*} type 
     * @returns 
     */
    function settingsAjax(url, data, type){
        var settings = {
            "url": "http://localhost:8888/agenda/public/api/"+url,
            "method": type,
            "timeout": 0,
            "headers": {
              "Content-Type": "application/json"
            },
            "data": JSON.stringify(data),
        };

        return settings;
    }

});