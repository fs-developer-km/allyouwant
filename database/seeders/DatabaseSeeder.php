<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Coupon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(['email'=>'admin@grocerymart.com'], [
            'name'=>'Admin','password'=>Hash::make('admin@123'),
            'role'=>'admin','is_active'=>true,'email_verified_at'=>now(),
        ]);
        // Customer
        User::updateOrCreate(['email'=>'customer@test.com'], [
            'name'=>'Rahul Kumar','phone'=>'9876543210',
            'password'=>Hash::make('password'),'role'=>'customer',
            'is_active'=>true,'email_verified_at'=>now(),
        ]);

        // Categories
        $cats = [
            ['name'=>'Vegetables','sort'=>1,'homepage'=>true],
            ['name'=>'Fruits','sort'=>2,'homepage'=>true],
            ['name'=>'Dairy & Eggs','sort'=>3,'homepage'=>true],
            ['name'=>'Meat & Fish','sort'=>4,'homepage'=>true],
            ['name'=>'Bakery','sort'=>5,'homepage'=>true],
            ['name'=>'Beverages','sort'=>6,'homepage'=>true],
            ['name'=>'Instant Food','sort'=>7,'homepage'=>false],
            ['name'=>'Personal Care','sort'=>8,'homepage'=>true],
            ['name'=>'Household','sort'=>9,'homepage'=>false],
            ['name'=>'Pet Care','sort'=>10,'homepage'=>false],
        ];
        $catIds = [];
        foreach ($cats as $c) {
            $cat = Category::updateOrCreate(['slug'=>Str::slug($c['name'])], [
                'name'=>$c['name'],'slug'=>Str::slug($c['name']),
                'is_active'=>true,'show_on_homepage'=>$c['homepage'],'sort_order'=>$c['sort'],
            ]);
            $catIds[$c['name']] = $cat->id;
        }

        // Products
        $products = [
            ['name'=>'Fresh Broccoli','cat'=>'Vegetables','price'=>60,'sale'=>49,'stock'=>50,'unit'=>'gram','weight'=>'500g','featured'=>true,'bestseller'=>false,'new'=>false],
            ['name'=>'Red Onion','cat'=>'Vegetables','price'=>40,'sale'=>null,'stock'=>200,'unit'=>'kg','weight'=>'1 kg','featured'=>false,'bestseller'=>true,'new'=>false],
            ['name'=>'Baby Spinach','cat'=>'Vegetables','price'=>45,'sale'=>35,'stock'=>80,'unit'=>'gram','weight'=>'250g','featured'=>true,'bestseller'=>false,'new'=>true],
            ['name'=>'Cherry Tomatoes','cat'=>'Vegetables','price'=>80,'sale'=>65,'stock'=>60,'unit'=>'gram','weight'=>'500g','featured'=>false,'bestseller'=>false,'new'=>false],
            ['name'=>'Garlic','cat'=>'Vegetables','price'=>30,'sale'=>null,'stock'=>150,'unit'=>'gram','weight'=>'250g','featured'=>false,'bestseller'=>true,'new'=>false],
            ['name'=>'Nagpur Oranges','cat'=>'Fruits','price'=>100,'sale'=>75,'stock'=>120,'unit'=>'kg','weight'=>'1 kg','featured'=>true,'bestseller'=>true,'new'=>false],
            ['name'=>'Fresh Strawberries','cat'=>'Fruits','price'=>120,'sale'=>99,'stock'=>40,'unit'=>'gram','weight'=>'250g','featured'=>true,'bestseller'=>false,'new'=>true],
            ['name'=>'Banana','cat'=>'Fruits','price'=>50,'sale'=>null,'stock'=>200,'unit'=>'dozen','weight'=>'12 pcs','featured'=>false,'bestseller'=>true,'new'=>false],
            ['name'=>'Royal Gala Apple','cat'=>'Fruits','price'=>150,'sale'=>120,'stock'=>80,'unit'=>'kg','weight'=>'1 kg','featured'=>false,'bestseller'=>false,'new'=>false],
            ['name'=>'Full Cream Milk','cat'=>'Dairy & Eggs','price'=>68,'sale'=>58,'stock'=>300,'unit'=>'litre','weight'=>'1 litre','featured'=>true,'bestseller'=>true,'new'=>false],
            ['name'=>'Farm Fresh Eggs','cat'=>'Dairy & Eggs','price'=>95,'sale'=>89,'stock'=>200,'unit'=>'dozen','weight'=>'12 pcs','featured'=>true,'bestseller'=>true,'new'=>false],
            ['name'=>'Paneer','cat'=>'Dairy & Eggs','price'=>120,'sale'=>null,'stock'=>80,'unit'=>'gram','weight'=>'200g','featured'=>false,'bestseller'=>true,'new'=>false],
            ['name'=>'Curd / Dahi','cat'=>'Dairy & Eggs','price'=>55,'sale'=>null,'stock'=>150,'unit'=>'gram','weight'=>'500g','featured'=>false,'bestseller'=>false,'new'=>false],
            ['name'=>'Orange Juice','cat'=>'Beverages','price'=>120,'sale'=>99,'stock'=>60,'unit'=>'litre','weight'=>'1 litre','featured'=>false,'bestseller'=>false,'new'=>false],
            ['name'=>'Green Tea','cat'=>'Beverages','price'=>180,'sale'=>null,'stock'=>50,'unit'=>'gram','weight'=>'100g','featured'=>false,'bestseller'=>false,'new'=>true],
        ];
        foreach ($products as $p) {
            $catId = $catIds[$p['cat']] ?? 1;
            Product::updateOrCreate(['slug'=>Str::slug($p['name'])], [
                'category_id'=>$catId,'name'=>$p['name'],'slug'=>Str::slug($p['name']),
                'price'=>$p['price'],'sale_price'=>$p['sale'],'stock_quantity'=>$p['stock'],
                'unit'=>$p['unit'],'weight'=>$p['weight'],'is_active'=>true,
                'is_featured'=>$p['featured'],'is_bestseller'=>$p['bestseller'],'is_new_arrival'=>$p['new'],
                'track_inventory'=>true,'low_stock_alert'=>10,
                'description'=>'Fresh and high quality '.$p['name'].'. Sourced directly from farms.',
                'short_description'=>'Fresh '.$p['name'].' — '.$p['weight'],
                'sku'=>strtoupper(substr(Str::slug($p['name']),0,3)).'-'.rand(100,999),
            ]);
        }

        // Banners
        $banners = [
            ['title'=>'Fresh Groceries Delivered in 60 Minutes','subtitle'=>'Order from 500+ fresh products','badge_text'=>'100% Organic','button_text'=>'Shop Now','button_link'=>'/shop','sort_order'=>1],
            ['title'=>'Flat 30% OFF on All Fruits Today','subtitle'=>'Use code FRUIT30 at checkout','badge_text'=>'Today Only','button_text'=>'Grab Offer','button_link'=>'/offers','sort_order'=>2],
            ['title'=>'First Order Flat ₹100 OFF','subtitle'=>'Use code WELCOME100 — min ₹299','badge_text'=>'New Customer','button_text'=>'Register Now','button_link'=>'/register','sort_order'=>3],
        ];
        foreach ($banners as $b) {
            Banner::updateOrCreate(['title'=>$b['title']], array_merge($b, ['is_active'=>true,'image'=>null]));
        }

        // Coupons
        Coupon::updateOrCreate(['code'=>'WELCOME100'], [
            'code'=>'WELCOME100','description'=>'New customer ₹100 off','type'=>'fixed',
            'value'=>100,'min_order_amount'=>299,'is_active'=>true,
        ]);
        Coupon::updateOrCreate(['code'=>'SAVE20'], [
            'code'=>'SAVE20','description'=>'20% off on all orders','type'=>'percent',
            'value'=>20,'min_order_amount'=>199,'max_discount'=>200,'is_active'=>true,
        ]);

        // Settings
        $settings = [
            ['key'=>'site_name','value'=>'GroceryMart','group'=>'general'],
            ['key'=>'site_tagline','value'=>'Fresh • Fast • Reliable','group'=>'general'],
            ['key'=>'site_email','value'=>'hello@grocerymart.in','group'=>'general'],
            ['key'=>'site_phone','value'=>'+91 98765 43210','group'=>'general'],
            ['key'=>'site_address','value'=>'123 Market Street, City','group'=>'general'],
            ['key'=>'whatsapp_number','value'=>'919876543210','group'=>'general'],
            ['key'=>'free_delivery_above','value'=>'499','group'=>'delivery'],
            ['key'=>'delivery_charge','value'=>'40','group'=>'delivery'],
            ['key'=>'cod_enabled','value'=>'1','group'=>'payment'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key'=>$s['key']], $s);
        }

        $this->command->info('✅ Done! Admin: admin@grocerymart.com / admin@123');
    }
}
