<!DOCTYPE html>
<html>
<head>
    <title>Despacho #{{ $despacho->id }}</title>
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
        <h1>ORDEN DE DESPACHO #{{ $despacho->numeroDespacho() }}</h1>
        <p>Fecha: {{ $despacho->created_at->format('d/m/Y') }}</p>
    </div>

    <p><strong>Cedula:</strong> {{ $despacho->cliente->cedula }} <strong>Nombre Cliente:</strong> {{ $despacho->cliente->nombreCompleto }}</p>
    <p><strong>Telefono:</strong> {{ $despacho->cliente->telefono }}</p>
    <p><strong>Direccion:</strong> {{ $despacho->cliente->direccion }}</p>
    <p><strong>Tasa:</strong> {{ $despacho->tasa->tasa }}</p>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalleDespacho as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ number_format($detalle->precio_dolar, 2) }}</td>
                <td>{{ number_format($detalle->cantidad * $detalle->precio_dolar, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Monto: {{ number_format($despacho->total_dolares, 2) }}</p>
    <p class="total">Total Monto: {{ number_format($despacho->total_bs, 2) }}</p>
</body>
</html>