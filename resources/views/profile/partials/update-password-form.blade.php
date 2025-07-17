<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">
            {{ __('Actualizar Contraseña') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ __('Asegúrate de usar una contraseña larga y segura para mantener tu cuenta protegida.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" class="form-label" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" class="form-label" />
            <x-text-input id="update_password_password" name="password" type="password" class="form-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" class="form-label" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
