@extends('layouts.app')

@section('content')
    <title>{{ $shop->name }}</title>
</head>
<body>
    <h1>{{ $shop->name }}</h1>
    <p>{{ $shop->description }}</p>
    <a href="{{ route('shops.index') }}">Back to Shops List</a>
</body>
@endsection
