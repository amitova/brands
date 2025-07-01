@extends('layouts.app')

@section('title', 'Top Brands List')

@section('content')
    <div class="px-4">
        <div id="brand-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 px-4">
            <p>Loading brands…</p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const grid = document.getElementById('brand-grid');

        try {
            const response = await fetch('/api/toplist');
            if (!response.ok) throw new Error('Network response was not ok');

            const brands = await response.json();

            grid.innerHTML = brands.map(brand => createBrandCard(brand)).join('');
        } catch (error) {
            console.error('Error loading brands:', error);
            grid.textContent = 'Failed to load brands.';
        }
    });

   function createBrandCard(brand) {
        return `
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <img src="${brand.brand_image}"
                    alt="${brand.brand_name}"
                    class="w-full h-auto rounded mb-2"
                    onerror="this.onerror=null;this.src='/images/default-logo.png';">
                <h2 class="text-lg font-semibold mb-1">${brand.brand_name}</h2>
                <p class="text-yellow-500">${'⭐'.repeat(brand.rating)}</p>
            </div>`;
    }
</script>

@endpush
