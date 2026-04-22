# Products API

## 📌 Описание
Реализация API для поиска товаров с фильтрами, сортировкой и пагинацией.

## ⚙️ Стек
```bash
- Laravel
- MySQL
```

## 🚀 Установка

```bash
git clone <repo>
cd project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

📬 Endpoint

```bash
GET /api/products
```

🔍 Фильтры

```bash
q — поиск по подстроке
price_from, price_to
category_id
in_stock
rating_from
```

🔃 Сортировка

```bash
price_asc
price_desc
rating_desc
newest
```

📄 Пагинация
```bash
per_page
```
