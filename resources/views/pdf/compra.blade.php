<!DOCTYPE html>
<html>
<head>
    <title>Compra #{{ $compra->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2 f2 f2; }
        .total { text-align: right; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ORDEN DE COMPRA #{{ $compra->numeroCompra() }}</h1>
        <p>Fecha: {{ $compra->created_at->format('d/m/Y') }}</p>
    </div>

    <p><strong>Cedula:</strong> {{ $compra->proveedor->rif }} <strong>Nombre Cliente:</strong> {{ $compra->proveedor->nombre }}</p>
    <p><strong>Telefono:</strong> {{ $compra->proveedor->telefono }}</p>
    <p><strong>Direccion:</strong> {{ $compra->proveedor->direccion }}</p>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalleCompra as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>