<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" readonly name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" readonly name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Celular')" />
            <x-text-input id="phone" readonly name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
        </div>

        <div>
            <x-input-label for="document" :value="__('Cédula')" />
            <x-text-input id="document" readonly name="document" type="text" class="mt-1 block w-full" :value="old('document', $user->document)" />
        </div>

        <div>
            <x-input-label for="birth_date" :value="__('Fecha de Nacimiento')" />
            <x-text-input id="birth_date" readonly name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->birth_date)" />
        </div>

        <div>
            <x-input-label for="city" :value="__('Ciudad')" />
            <x-text-input id="city" readonly name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city->name)" />
        </div>
    </div>
</section>
