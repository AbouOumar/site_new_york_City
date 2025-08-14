@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $hotel->name }}</h2>
    <p class="text-gray-700 mb-4">{{ $hotel->description }}</p>
    <a href="{{ route('hotels.index') }}" class="text-blue-500 hover:underline">← Retour à la liste</a>
</div>
@endsection
