<x-app-layout>
    <x-slot name="header">
        <h2 >
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <div>
                     @include('profile.partials.update-profile-information-form')
                    </div>
             </div>
            </div>

            <div class="col-md-6">

                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <div>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

            <div>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
    </div>
    
</x-app-layout>
