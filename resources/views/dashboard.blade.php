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
            <!-- Gráfico 1: Volúmenes -->
            <div class="col-md-6">
                <div class="p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <h5 class="mb-3 font-weight-bold text-muted small text-uppercase">Volúmenes de Inventario</h5>
                    <div class="d-flex justify-content-center" style="max-height: 280px;">
                        <canvas id="graficoInventario"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico 2: Valor en Dólares (Cambiado el ID a graficoDolares) -->
            <div class="col-md-6">
                <div class="p-4 bg-body-tertiary border border-secondary rounded-3 text-white">
                    <h5 class="mb-3 font-weight-bold text-muted small text-uppercase">Total de Dólares en Stock</h5>
                    <div class="d-flex justify-content-center" style="max-height: 280px;">
                        <canvas id="graficoDolares"></canvas>
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
        const totalDolares = {{ $totalDolares ?? 0 }}; // Asegúrate de enviar esta variable desde tu Controlador

        // --- Configuración Gráfico 1: Volúmenes ---
        const ctxInventario = document.getElementById('graficoInventario').getContext('2d');
        new Chart(ctxInventario, {
            type: 'doughnut',
            data: {
                labels: ['Productos Únicos', 'Stock Total'],
                datasets: [{
                    data: [totalProductos, totalInventario],
                    backgroundColor: ['#36A2EB', '#2ECC71'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#adb5bd', font: { size: 12 }, padding: 15 }
                    }
                }
            }
        });

        // --- Configuración Gráfico 2: Total Dólares ---
        const ctxDolares = document.getElementById('graficoDolares').getContext('2d');
        new Chart(ctxDolares, {
            type: 'bar', // Tipo barra para ver el volumen financiero claramente
            data: {
                labels: ['Valor del Inventario ($)'],
                datasets: [{
                    label: 'Total USD',
                    data: [totalDolares],
                    backgroundColor: ['#F1C40F'], // Amarillo/Dorado para representar dinero
                    borderWidth: 0,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#adb5bd' }
                    },
                    y: {
                        grid: { color: '#343a40' }, // Línea sutil en modo oscuro
                        ticks: { 
                            color: '#adb5bd',
                            callback: function(value) { return '$' + value.toLocaleString(); } // Agrega el signo $ al eje Y
                        }
                    }
                },
                plugins: {
                    legend: { display: false }, // Ocultamos la leyenda ya que el título de la tarjeta lo explica
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': $' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>