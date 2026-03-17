<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        @include('layouts.header')
    </head>
    <body>
        
        
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @isset($header)
            <div class="container">
                <div class="b-example-divider mb-0"></div>
                <header >
                    <div>
                        {{ $header }}
                    </div>
                </header>
                </div>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
        <!-- JS de Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>
