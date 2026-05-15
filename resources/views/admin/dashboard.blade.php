<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
</head>
<body>
    <h1>Dashboard Kasir Pizza</h1>
<hr>
<h3>Total Pendapatan: Rp {{ number_format($total_revenue) }}</h3>

<h3>Status Meja:</h3>
<ul>
    @foreach($tables as $table)
        <li>
            Meja {{ $table->number }} - 
            <strong>{{ strtoupper($table->status) }}</strong>
        </li>
    @endforeach
</ul>
</body>
</html>