Top Brands API

A Laravel-based project that provides a dynamic, API-driven frontend to showcase top-rated brands based on country, with full CRUD functionality and mobile-friendly frontend.

Features

Toplist by Country
- Automatically fetches top brands based on CF-IPCountry header if 
  result is empty, returns default toplist.

Live Brand Search
- input search with visual feedback.
- Filters brands by name with a minimum rating logic (shows brands with a rating of 4 or higher,  configured in .ENV).

Full API Support
- CRUD operations for brands.
- Request validation and service-layer architecture.
- faker seeded data

Pagination & Filtering
- Optional per_page and search parameters for api search.

Responsive Frontend (Tailwind CSS)
- mobile-friendl, grid-based layout.
- fixed footer and "Back to Top" UX.

Optimizations
- lazy image loading, query indexes.
- dockerized environment.
- ebugbar disabled for production.

Requirements

- Docker & Docker Compose
- Node.js & NPM (for Vite dev)
- Laravel 11

Getting Started

1. Clone & Setup

git clone https://github.com/amitova/brands.git
cd brands
config .env
generate APP_KEY - docker compose exec web php artisan key:generate

1. Docker Setup

docker compose up -d --build
docker compose exec web php artisan migrate --seed

3. Vite Dev Server (optional)

npm install
npm run dev

Access the app at http://localhost:8088

Method  Endpoint            Description
GET     /api/toplist        Top brands per country
GET     /api/brands         All brands (paginated)
POST    /api/brands         Create new brand
PUT     /api/brands/{id}    Update brand
DELETE  /api/brands/{id}    Soft-delete brand

Supports ?search= and ?per_page= for filtering/pagination.

Notes

Fallback image used if brand logo fails to load.
Country is determined via Cloudflare Worker (locally simulated).
Soft deletes enabled via deleted_at column.
