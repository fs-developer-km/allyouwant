# 🛒 GroceryMart — Setup Guide
## Bilkul Seedha Steps — Ek Ek Karke Karo

---

## Step 1 — .env file set karo

`.env` file mein ye change karo:

```
APP_NAME="GroceryMart"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grocery_mart
DB_USERNAME=root
DB_PASSWORD=
```

---

## Step 2 — phpMyAdmin mein database banao

1. Browser mein jao: http://localhost/phpmyadmin
2. Left side "New" click karo
3. Database name: `grocery_mart`
4. "Create" click karo

---

## Step 3 — CMD mein ye commands chalao (ek ek karke)

```bash
cd C:\xampp\htdocs\grocery-mart

composer install

php artisan key:generate

php artisan migrate:fresh

php artisan db:seed

php artisan storage:link

php artisan serve
```

---

## Step 4 — Website open karo

| URL | Kya hai |
|-----|---------|
| http://127.0.0.1:8000 | Customer website (Home page) |
| http://127.0.0.1:8000/login | Customer login |
| http://127.0.0.1:8000/register | New customer register |
| http://127.0.0.1:8000/shop | All products |
| http://127.0.0.1:8000/cart | Shopping cart |
| http://127.0.0.1:8000/admin | Admin panel |

---

## Login Details

**Admin Panel:**
- Email: `admin@grocerymart.com`
- Password: `admin@123`

**Test Customer:**
- Email: `customer@test.com`
- Password: `password`

---

## Admin Panel Pages

| URL | Page |
|-----|------|
| /admin | Dashboard |
| /admin/categories | Categories list |
| /admin/categories/create | Add category |
| /admin/products | Products list |
| /admin/products/create | Add product |
| /admin/orders | All orders |
| /admin/banners | Homepage banners |
| /admin/coupons | Discount coupons |
| /admin/inventory | Stock management |
| /admin/customers | Customer list |
| /admin/reviews | Product reviews |
| /admin/reports/sales | Sales report |
| /admin/settings | Site settings |

---

## Agar Error Aaye

**"Class not found" error:**
```bash
composer dump-autoload
```

**"Table not found" error:**
```bash
php artisan migrate:fresh --seed
```

**"Route not defined" error:**
```bash
php artisan route:clear
php artisan cache:clear
```

**"419 Page Expired" (form submit pe):**
- Form mein `@csrf` check karo

---

## Working Features ✅

- ✅ Home page with hero slider, categories, products
- ✅ Shop / product listing page
- ✅ Product detail page
- ✅ Add to cart (session based)
- ✅ Cart page with quantity update
- ✅ Customer login / register / logout
- ✅ Checkout with address form
- ✅ Order placement (COD)
- ✅ Order success page
- ✅ Customer dashboard & order history
- ✅ Admin dashboard with stats & charts
- ✅ Admin — Category CRUD
- ✅ Admin — Product CRUD with image upload
- ✅ Admin — Order management & status update
- ✅ Admin — Banner management
- ✅ Admin — Coupon management
- ✅ Admin — Inventory / stock management
- ✅ Admin — Customer list
- ✅ Admin — Reviews approve/delete
- ✅ Admin — Sales & product reports
- ✅ Admin — Settings

