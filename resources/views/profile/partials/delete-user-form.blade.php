<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-xl font-bold text-red-600">
            {{ __('Eliminar Cuenta') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600 background: transparent !important; text-shadow: none !important;">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier información que desees conservar.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-danger"
    >{{ __('Eliminar Cuenta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-bold text-gray-900">
                    {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
                </h2>
            </div>
            
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-body">
                    <p class="text-sm text-gray-600 mb-6 backgrounsd: transparent !important; text-shadow: none !important;">
                        {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Por favor ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.') }}
                    </p>

                    <div class="form-group">
                        <x-input-label for="password" value="{{ __('Contraseña') }}" class="form-label" />
                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="form-input"
                            placeholder="{{ __('Contraseña') }}"
                        />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="modal-footer">
                    <x-secondary-button x-on:click="$dispatch('close')" class="btn btn-secondary">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="btn btn-danger">
                        {{ __('Eliminar Cuenta') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
