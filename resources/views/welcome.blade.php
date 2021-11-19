<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        
        <link rel="stylesheet" href="css/app.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="js/app.js"></script>
    </head>
    <body class="">
        <div class="container py-3">
            <main >
                <!-- <h2>Ejercicio practico de Agenda.</h1> -->
                <div class="row bg-white rounded">
                    
                    <div class="col-md-12">
                        <h2 class="text-center mt-2">Agenda</h3>
                        <hr>
                    </div>
                    <div class="col-md-3 col-sm-12 offset-md-1 mb-1" style="height:550px;">
                        <h4>
                            Contactos
                            <button class="btn btn-sm btn-outline-success float-right" title="Agregar contacto" id="btn-add"><i class="bi bi-person-plus"></i></button> 
                        </h4>
                        <hr>
                        <ul class="list-group list-group-flush" id="ul-listUser" style="height: 481px;overflow: auto;">
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12" id="div-detalle">
                        <h4>
                            <span id="name">Nombre</span>
                            <button class="btn btn-sm btn-outline-danger float-right" title="Eliminar contacto" id="btn-delete"><i class="bi bi-trash"></i></button> 
                            <button class="btn btn-sm btn-outline-primary float-right mr-2" title="Editar contacto" id="btn-edit"><i class="bi bi-pencil"></i></button> 
                        </h4>
                        <hr>
                        <p>
                            <b>Nombre </b><br>
                            <span id="fullname"></span> 
                        </p>
                        <p>
                            <b>Teléfono</b><br>
                            <div id="phone"></div>
                        </p>
                        <p>
                            <b>Correo electrónico </b><br>
                            <span id="email"></span>
                        </p>
                        <p>
                            <b>Grupo </b><br>
                            <span id="group"></span>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-12" style="display:none" id="div-edicion">
                        <form action="">
                        <h4>
                            Agregar Contacto 
                            <button class="btn btn-sm btn-success float-right" title="Guardar" id="btn-save"><i class="bi bi-person-check"></i></button>
                            <button class="btn btn-sm btn-success float-right" title="Guardar edición" id="btn-update" style="display:none;"><i class="bi bi-person-check"></i></button>
                            <button class="btn btn-sm btn-danger float-right mr-2" title="Cancelar" id="btn-cancel"><i class="bi bi-x-circle"></i></button>
                        </h4>
                            <div class="form-group">
                                <label input="input-name">Nombres*</label>
                                <input id="input-name" type="text" class=" form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="input-lastname">Apellidos</label>
                                <input id="input-lastname" type="text" class=" form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Teléfono (10 digitos)*</label>
                                <input type="text" class="form-control" id="inputPhone" required>
                                <span class="text-danger form-text" style="font-size:9px;">puede agregar mas de 1 número separandolo con una <b>','</b></span>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Correo electrónico</label>
                                <input id="input-email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="inputGroup">Grupo</label>
                                <!-- <input  type="text" class="form-control" id="inputGroup"> -->
                                <select id="inputGroup">
                                    <option disabled selected>Selecciona una opción</option>
                                    <option value="1">Familia</option>
                                    <option value="2">Amigos</option>
                                    <option value="3">Trabajo</option>
                                    <option value="4">Otros</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>  
            </main>
        </div>
    </body>
</html>
