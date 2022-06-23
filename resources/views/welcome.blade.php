<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" type="text/css">
    <title>Nexura</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Lista de empleados
                            </b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-info" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Crear</span></a>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover" id="tablaEmpleados" >
                    <thead>
                        <tr>
                            <th style="width: 20%"><i class="fa-solid fa-user"></i> Nombre</th>
                            <th><i class="fa-solid fa-at"></i> Email</th>
                            <th><i class="fa-solid fa-venus-mars"></i> Sexo</th>
                            <th><i class="fa-solid fa-briefcase"></i> Área</th>
                            <th><i class="fa-solid fa-envelope"></i> Boletín</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $emplea)
                        <tr>
                            <td>{{ $emplea->nombre }}</td>
                            <td>{{ $emplea->email }}</td>
                            <td>@if($emplea->sexo == 'M') Masculino @else Femenino
                                @endif
                            </td>
                            <td>{{ $emplea->getNombreArea() }}</td>
                            <td>@if($emplea->boletin == 1) Si @else No
                                @endif
                            </td>
                            <td><a class="edit" style="cursor: pointer" data-toggle="modal" onclick="openModalEdit({{$emplea->id}});"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a></td>
                            <td><a href="#deleteEmployeeModal" data-id="{{$emplea->id}}" style="cursor: pointer" class="delete open-AddBookDialog" data-toggle="modal"><i class="material-icons" title="Eliminar">&#xE872;</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal crear empleado -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEmpleado">

                    <div class="modal-header">
                        <h4 class="modal-title">Crear empleado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Nombre completo *</b></label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre completo del empleado" required>
                        </div>
                        <div class="form-group">
                            <label><b>Correo electrónico *</b></label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <label><b>Sexo *</b></label>
                            <ul style="list-style: none;">
                            <li><input type="radio" name="sexo" id="sexo" value="M">Masculino</li>
                            <li><input type="radio" name="sexo" id="sexo" value="F">Femenino</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label><b>Área *</b></label>
                            <select name="area" id="area" class="form-control" required>
                                @foreach ($areas as $area)
                                <option value="{{$area->id}}">{{$area->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Descripción *</b></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción de la experiencia del empleado" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="boletin" id="boletin" value="1">Deseo recibir boletín informativo
                        </div>
                        <div class="form-group">
                            <label><b>Roles *</b></label>
                            <ul style="list-style: none;">
                                @foreach ($roles as $rol)
                                <li>
                                    <input type="checkbox" name="roles" id="roles_{{$rol->id}}" value="{{$rol->id}}">{{$rol->nombre}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="button" onclick="add();" class="btn btn-info" value="Guardar">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modal Editar HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEmpleado">

                    <div class="modal-header">
                        <h4 class="modal-title">Editar empleado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre completo *</label>
                            <input type="text" class="form-control" name="nombreEdit" id="nombreEdit" placeholder="Nombre completo del empleado" required>
                        </div>
                        <div class="form-group">
                            <label>Correo electrónico *</label>
                            <input type="email" class="form-control" name="correoEdit" id="correoEdit" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <label>Sexo *</label>
                            <ul style="list-style: none;">
                            <li><input type="radio" name="sexoEdit" id="sexoEditM" value="M">Masculino</li>
                            <li><input type="radio" name="sexoEdit" id="sexoEditF" value="F">Femenino</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label>Área *</label>
                            <select name="areaEdit" id="areaEdit" class="form-control" required>
                                @foreach ($areas as $area)
                                <option value="{{$area->id}}">{{$area->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descripción *</label>
                            <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" placeholder="Descripción de la experiencia del empleado" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="boletinEdit" id="boletinEdit" value="1">Deseo recibir boletín informativo
                        </div>
                        <div class="form-group">
                            <label>Roles *</label>
                            <ul style="list-style: none;">
                                @foreach ($roles as $rol)
                                <li>
                                <input type="checkbox" name="rolesEdit" id="rolesEdit_{{$rol->id}}" value="{{$rol->id}}">{{$rol->nombre}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="button" onclick="editEmpleado();" class="btn btn-info" value="Editar">
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar empleado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de eliminar el empleado?</p>
                        <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="button" onclick="eliminarEmpleado();" class="btn btn-danger" value="Eliminar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/function.js')}}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>

</html>