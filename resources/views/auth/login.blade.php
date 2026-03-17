<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address 
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password 
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me 
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm ">{{ __('Recordar datos?') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Olvidaste el password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Iniciar Sesion') }}
            </x-primary-button>
        </div>--->
      <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">
              Control de Inventario
            </h1>
            <p class="col-lg-10 fs-5">
              Se puede Cargar el inventario de manera masiva a traves de un archivo excel; tambien los puedes hacer por Ordenes de Compra,
                ademas puedes descontar el inventario a traves de Despachos, manejar tasas de ventas, ingresar Categorias, Clientes y Proveedores,
                ademas de generar reportes de ventas, compras, despachos e inventarios.
            </p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
              <div class="form-floating mb-3">
                <input
                  type="email"
                  class="form-control"
                  name="email" :value="old('email')" required autofocus autocomplete="username"
                  id="floatingInput"
                  placeholder="name@example.com"
                />
                <label for="floatingInput">Correo</label>
              </div>
              <div class="form-floating mb-3">
                <input
                  type="password"
                  class="form-control"
                  name="password" required autocomplete="current-password"
                  id="floatingPassword"
                  placeholder="Password"
                />
                <label for="floatingPassword">Password</label>
              </div>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me" /> Recordar Datos
                </label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">
                Ingresar
              </button>
              <hr class="my-4" />
              <small class="text-body-secondary"
                >Realizado por Rruts.com</small
              >
          </div>
        </div>
      </div>



    </form>
</x-guest-layout>
