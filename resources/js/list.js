let searchTimeout;

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('brand-search');
    const grid = document.getElementById('brand-grid');
    const btn = document.getElementById('backToTop');

    // back to top button
    window.addEventListener('scroll', () => {
        btn.style.display = window.scrollY > 300 ? 'block' : 'none';
    });

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // search input for toplist
    searchInput?.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        const search = searchInput.value.trim();

        searchTimeout = setTimeout(() => {
            if (search.length >= 2) {
                fetchBrands(search);
            } else if (search.length === 0) {
                fetchTopList(); // fallback only if input is cleared
            }
        }, 300); // debounce delay (300ms)
    });

    fetchTopList();
});
async function fetchBrands(search) {
    const grid = document.getElementById('brand-grid');

    // Show indication regardless of input
    grid.innerHTML = `<p class="col-span-full text-center text-gray-500">
        ${search ? 'Searching…' : 'Loading default toplist…'}
    </p>`;


    try {
        const url = search
            ? `/api/brands?search=${encodeURIComponent(search)}`
            : '/api/toplist';

        const response = await fetch(url);
        const data = await response.json();
        const brands = Array.isArray(data) ? data : data.data;

        if (!brands.length) {
            grid.innerHTML = `<p class="col-span-full text-center text-gray-500">No results found.</p>`;
            return;
        }

        renderBrands(brands);
    } catch (error) {
        console.error('Error loading brands:', error);
        showError();
    }
}


async function fetchTopList() {
    const grid = document.getElementById('brand-grid');
    grid.innerHTML = `<p class="col-span-full text-center text-gray-500">Loading default toplist…</p>`;

    try {
        const response = await fetch('/api/toplist');
        const brands = await response.json();
        renderBrands(brands);
    } catch (error) {
        console.error('Error loading toplist:', error);
        showError();
    }
}

function renderBrands(brands) {
    const grid = document.getElementById('brand-grid');
    grid.innerHTML = '';

    if (!brands.length) {
        grid.textContent = 'No brands found.';
        return;
    }

    const fragment = document.createDocumentFragment();
    brands.forEach(brand => fragment.appendChild(createBrandCard(brand)));
    grid.appendChild(fragment);
}

function showError() {
    const grid = document.getElementById('brand-grid');
    grid.innerHTML = `<p class="col-span-full text-center text-red-500">Failed to load brands.</p>`;
}
function createBrandCard(brand) {
    const card = document.createElement('div');
    card.className = 'bg-white rounded-lg shadow p-4 text-center';

    const img = document.createElement('img');
    img.src = brand.brand_image;
    img.alt = brand.brand_name;
    img.className = 'w-full h-auto rounded mb-2';
    img.loading = 'lazy';
    img.onerror = () => { img.src = '/images/default-logo.png'; };

    const title = document.createElement('h2');
    title.textContent = brand.brand_name;
    title.className = 'text-lg font-semibold mb-1';

    const rating = document.createElement('p');
    rating.className = 'text-yellow-500';
    rating.innerHTML = '';
    for (let i = 0; i < brand.rating; i++) {
        const icon = document.createElement('i');
        icon.className = 'bi bi-star-fill text-warning'; // Bootstrap star icon + yellow color
        icon.style.marginRight = '2px';
        rating.appendChild(icon);
    }

    card.appendChild(img);
    card.appendChild(title);
    card.appendChild(rating);

    return card;
}
