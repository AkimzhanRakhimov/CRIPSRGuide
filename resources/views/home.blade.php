@extends('layouts.app')

@section('title', 'Home - CRISPR Designer')

@section('content')
<div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <h1 class="text-4xl font-bold mb-4 text-green-700">Welcome to CRISPR Designer</h1>
    <p class="mb-4 text-lg text-gray-600">Enter your DNA sequence to design CRISPR guides:</p>

    <form action="{{ route('design') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-96">
        @csrf
        <label for="pam" class="block font-semibold mb-2">Select PAM:</label>
        <select name="pam" class="form-select mb-2 w-full p-2 border rounded">
            <option value="GG">NGG (default)</option>
            <option value="AG">NAG</option>
        </select>

        <textarea class="form-control mb-4 w-full p-2 border rounded" name="sequence" rows="5" placeholder="Enter DNA sequence..." required></textarea>

        <button type="submit" class="w-full max-w-xs mx-auto block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
    Generate Guides
</button>

    </form>

    @if(!empty($guides))
        <h2 class="mt-6 text-2xl font-bold text-green-700">Generated CRISPR Guides:</h2>
        <ul class="list-group mt-2 space-y-2">
            @foreach($guides as $guide)
                <li class="list-group-item bg-gray-200 p-2 rounded">{{ $guide }}</li>
            @endforeach
        </ul>
        <a href="{{ route('download') }}" class="btn mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Download Guides</a>
    @else
        <p class="mt-4 text-red-500">No guides found</p>
    @endif
</div>
@if(!empty($guides))
    <a href="{{ route('download') }}" class="btn btn-success mt-3">Download Guides</a>
@endif
<h2 class="mt-8 text-2xl font-bold text-gray-700">Past CRISPR Guides:</h2>
<ul class="list-group mt-2 space-y-2">
    @foreach(DB::table('guides_history')->orderBy('created_at', 'desc')->take(5)->get() as $history)
        <li class="list-group-item bg-gray-100 p-2 rounded">
            <strong>Sequence:</strong> {{ $history->sequence }}<br>
            <strong>PAM:</strong> {{ $history->pam }}<br>
            <strong>Guides:</strong> {{ implode(', ', json_decode($history->guides)) }}
        </li>
    @endforeach
</ul>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@endsection