@extends('layouts.app')

@section('title', 'Top Brands')

@section('content')
    <input id="brand-search" type="text" placeholder="Search brands..." class="w-full p-2 border rounded mb-4" />

    <div class="px-4">
        <div id="brand-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 px-4">
            <p>Loading brands…</p>
        </div>
    </div>
@endsection
@push('scripts')
    @vite('resources/js/list.js')
@endpush
