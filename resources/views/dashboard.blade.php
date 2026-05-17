<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row align-items-md-stretch g-3">

            <div class="col-md-3">
                <div class="h-100 p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <div class="text-muted small text-uppercase font-weight-bold mb-2">Productos Únicos</div>
                    <div class="h2 font-weight-bold mb-0">{{ $totalProductos }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="h-100 p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <div class="text-muted small text-uppercase font-weight-bold mb-2">Stock en Bodega</div>
                    <div class="h2 text-success font-weight-bold mb-0">{{ $totalInventario }} u.</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="h-100 p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <div class="text-muted small text-uppercase font-weight-bold mb-2">Categorías</div>
                    <div class="h2 text-info font-weight-bold mb-0">{{ \App\Models\Categoria::count() }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="h-100 p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <div class="text-muted small text-uppercase font-weight-bold mb-2">Estado del Sistema</div>
                    <div class="h5 text-warning font-weight-bold mb-0 mt-1">Activo</div>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <h5 class="mb-3 font-weight-bold text-muted small text-uppercase">Volúmenes de Inventario</h5>
                    <div class="d-flex justify-content-center" style="max-height: 280px;">
                        <canvas id="graficoInventario"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Traemos las variables desde el controlador de Laravel de forma segura
        const totalProductos = {{ $totalProductos ?? 0 }};
        const totalInventario = {{ $totalInventario ?? 0 }};

        const ctx = document.getElementById('graficoInventario').getContext('2d');
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Productos Únicos', 'Stock Total'],
                datasets: [{
                    data: [totalProductos, totalInventario],
                    backgroundColor: [
                        '#36A2EB', // Azul eléctrico
                        '#2ECC71'  // Verde esmeralda para el stock
                    ],
                    borderWidth: 0, // Sin bordes blancos para mantener la estética oscura
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#adb5bd', // Texto gris claro (Bootstrap text-muted)
                            font: {
                                size: 12
                            },
                            padding: 15
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>