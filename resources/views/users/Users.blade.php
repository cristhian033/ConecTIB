<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>

<html>
@include('users.partials.head_users')
<body>
    <div class="container" style="margin-top: 100px;margin-bottom: 100px; ">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Usuario Modificado.') }}</p>
                        @endif

                        @if (session('status') === 'profile-deleted')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Usuario Eliminado.') }}</p>
                        @endif

                        @if (session('status') === 'profile-deleted')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Usuario Creado.') }}</p>
                        @endif
                        <p><a href="{{ URL::route('register') }}"><button class="btn btn-info">Registrar nuevo usuario</button></a></p>
                            <table class="data-table mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Correo</th>
                                    <th>Nombre</th>
                                    <th>Celular</th>
                                    <th>Cédula</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Edad</th>
                                    <th>Ciudad</th>
                                    <th width='250px'></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

       $(document).ready(function() {
            $('.data-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.showall') }}",
                columns: [
                    { "data": "id", "searchable": false },
                    { "data": "email"},
                    { "data": "name" },
                    { "data": "phone" },
                    { "data": "document" },
                    { "data": "birth_date", "searchable": false },
                    { "data": 'birth_date', "searchable": false ,
                        render: function(data, type, full, meta) {
                            if (type === 'display' || type === 'filter') {
                                var birthdate = moment(data, 'YYYY-MM-DD');
                                var now = moment();
                                var age = now.diff(birthdate, 'years');
                                return age;
                            }
                            return data;
                        }
                    },
                    { "data": "city.name", "searchable": false },
                    {
                        // Columna para los botones
                        data: "id",
                        title: '',
                        render: function(data, type, row, meta) {
                            // Utiliza el método render para mostrar los botones
                            return '<a href="{{ URL::route('user.editUser') }}/'+data+'" >'+
                                        '<button class="btn btn-primary">Editar</button>'+
                                    '</a> '+
                                   '<a href="{{ URL::route('user.deleteUser') }}/'+data+'"'+
                                        '<button  class="btn btn-danger">Eliminar</button>'+
                                    '</a>';
                        }
                    }
                ],
            });
        });
    </script>

</body>

</html>

</x-app-layout>
