<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios con posts publicados') }}
        </h2>
    </x-slot>
    @include('users.partials.head_users')
    <body>
        <div class="container" style="margin-top: 100px;padding-bottom:100px; ">
            <div class="row justify-content-center">
                <div class="col-md-20">
                    <div class="card">
                        <div class="card-body">
                                <table class="data-table mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Dirección</th>
                                        <th>Ciudad</th>
                                        <th>Telefono</th>
                                        <th>Pagina web</th>
                                        <th>Empresa</th>
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
    </body>
</x-app-layout>
        <script type="text/javascript">

        $(document).ready(function() {
                $('.data-table').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ordering: false,
                    ajax: "{{ route('posts.users') }}",
                    columnDefs: [
                        { targets: [1, 2, 3, 4, 5, 6, 7, 8, 9], "searchable": false},
                        { type: "num", targets: [0] }
                    ],
                    columns: [
                        { "data": "id", "bSearchable": true, "sType": "numeric"},
                        { "data": "name"},
                        { "data": "username" },
                        { "data": "email" },
                        { "data": "address",
                            render: function(data, type, full, meta) {
                                if (type === 'display' || type === 'filter') {
                                    return data.street+' '+data.suite;
                                }
                                return data;
                            }
                        },
                        { "data": "address",
                            render: function(data, type, full, meta) {
                                if (type === 'display' || type === 'filter') {
                                    return data.city;
                                }
                                return data;
                            }
                        },
                        { "data": "phone" },
                        { "data": "website" },
                        { "data": 'company' ,
                            render: function(data, type, full, meta) {
                                if (type === 'display' || type === 'filter') {
                                    return data.name;
                                }
                                return data;
                            }
                        },
                        {
                            // Columna para los botones
                            data: "id",
                            title: '',
                            render: function(data, type, row, meta) {
                                // Utiliza el método render para mostrar los botones
                                return '<a href="{{ URL::route('posts.getPosts') }}/'+data+'" >'+
                                            '<button class="btn btn-primary">Ver Posts</button>'+
                                        '</a> ';
                            }
                        }
                    ],
                });


            });
        </script>

