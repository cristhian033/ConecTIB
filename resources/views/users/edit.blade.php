<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar usuario') }}
        </h2>
    </x-slot>
    @include('users.partials.head_users')
    <div class="container" style="margin-top: 100px;padding-bottom:100px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.editUser', [$user->id]) }}">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Document -->
                            <div>
                                <x-input-label for="document" :value="__('Cédula')" />
                                <x-text-input id="document" readonly class="block mt-1 w-full" type="text" name="document" value="{{ $user->document }}" required autofocus autocomplete="document" />
                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Celular')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $user->phone }}" autofocus autocomplete="phone" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <!-- Birth Date -->
                            <div>
                                <x-input-label for="birth_date" :value="__('Fecha de nacimiento')" />
                                <x-text-input data-date-format="DD MMMM YYYY" id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ $user->birth_date }}" required autofocus autocomplete="birth_date" />
                                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                            </div>

                            <!-- Country -->
                            <div>
                                <x-input-label for="country" :value="__('Pais')" />
                                <select id='country' required name='country' class="block mt-1 w-full">
                                    <option value='0'>-- Seleccionar Pais --</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{$country->id==$departments[0]->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>

                            <!-- Departament -->
                            <div>
                                <x-input-label for="departament" :value="__('Departamento')" />
                                <select id='departament' required name='departament' class="block mt-1 w-full">
                                    <option value='0'>-- Seleccionar Departamento --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{$department->id==$cities[0]->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('departament')" class="mt-2" />
                            </div>

                            <!-- Cities -->
                            <div>
                                <x-input-label for="city_id" :value="__('Ciudad')" />
                                <select id='city_id' required name='city_id' class="block mt-1 w-full">
                                    <option value='0'>-- Seleccionar Ciudad --</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ $city->id==$user->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" readonly class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ URL::route('user.show') }}">
                                    <x-secondary-button>
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                </a>
                                <x-primary-button class="ml-4">
                                    {{ __('Modificar') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<!-- Script -->
    <script type='text/javascript'>
    $(document).ready(function(){

        $('#country').change(function(){

             // id del pais seleccionado
             var id = $(this).val();

             // se optiene la ruta donde se leeran los departamentos
              var url="{{ route('departments.get') }}"+'/'+id;

             // se limpia el select de departamento
             $('#departament').find('option').not(':first').remove();
             $('#city_id').find('option').not(':first').remove();

             // AJAX request
             $.ajax({
                 url: url,
                 type: 'get',
                 dataType: 'json',
                 success: function(response){
                     var len = 0;
                     if(response['data'] != null){
                          len = response['data'].length;
                     }
                     if(len > 0){
                          // se lee la informacion y se crean las opciones
                          for(var i=0; i<len; i++){
                               var id = response['data'][i].id;
                               var name = response['data'][i].name;
                               var option = "<option value='"+id+"'>"+name+"</option>";
                               $("#departament").append(option);
                          }
                     }
                 }
             });
        });

        $('#departament').change(function(){

            // id del pais seleccionado
            var id = $(this).val();

            // se optiene la ruta donde se leeran los ciudades
             var url="{{ route('cities.get') }}"+'/'+id;

            // se limpia el select de ciudades
            $('#city_id').find('option').not(':first').remove();

            // AJAX request
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response['data'] != null){
                         len = response['data'].length;
                    }
                    if(len > 0){
                         // se lee la informacion y se crean las opciones
                         for(var i=0; i<len; i++){
                              var id = response['data'][i].id;
                              var name = response['data'][i].name;
                              var option = "<option value='"+id+"'>"+name+"</option>";
                              $("#city_id").append(option);
                         }
                    }
                }
            });
       });
    });
    </script>
