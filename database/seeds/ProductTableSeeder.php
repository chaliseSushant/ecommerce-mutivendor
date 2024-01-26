<?php

use App\Brand;
use App\Category;
use App\Image;
use App\Outlet;
use App\Product;
use App\Review;
use App\Role;
use App\Specification;
use App\SpecificationValue;

use App\Tag;
use App\Vendor;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeding product
        for ($x = 1; $x <= 100; $x++) {
            $product = new Product();
            $product->sku = 'PRD' . $x;
            $product->name = 'Product ' . $x;
            $product->description = 'While the basic way to reference an icon is simple and hopefully straight-forward, we’ve provided support-level styling for things like sizing icons, aligning and listing icons, as well as rotating and transforming icons.You can also add your own custom styling to Font Awesome icons by adding your own CSS rules in your project’s code. Here’s a quick example. Product is product number ' . $x;
            $product->price = rand(50, 5000);
            $product->display_price = $product->price + 10;
            $product->shipping_local_base = 50;
            $product->shipping_local_additional = 20;
            $product->shipping_national_base = 100;
            $product->shipping_national_additional = 50;
            $product->value = rand(1, 10);
            $product->brand()->associate(Brand::all()[rand(0, 6)]);
            //$product->vendor()->associate(Vendor::all()[rand(0,2)]);
            $product->vendor_id = 1;
            //$product->outlet_id = 1;
            //$product->unit()->associate(Unit::all()[rand(0, 4)]);
            $product->save();
            $product->outlets()->attach(Outlet::find(1));
            $product->categories()->attach(Category::all()[rand(0, 4)]);
            $product->tags()->attach(Tag::all()[rand(0, 14)]);
        }
        //seeding image
        foreach (Product::all() as $product) {
            for ($y = 1; $y <= 3; $y++) {
                $image = new Image();
                $image->url = '/storage/images/vendors/1/products/01595325835.jpg';
                $image->product_id = $product->id;
                $image->save();
            }
        }
        //seeding rating
        foreach (Product::all() as $product) {
            $customers = Role::where('role', 'customer')->first()->users;
            foreach ($customers as $customer) {
                $review = new Review();
                $review->review = "This is a sample review text written by someone who is already registered user on the site and is intrested in this product.";
                $review->rating = rand(1, 5);
                $review->customer_id = $customer->customer->id;
                $review->product_id = $product->id;
                $review->save();
            }
        }

        //seeding specification
        for ($x = 1; $x <= 15; $x++) {
            $spec = new Specification();
            $spec->name = "Spec Title " . $x;
            //$spec->vendor()->associate(Vendor::where('name', 'Falano Kirana Store')->first());
            $spec->save();
        }

        //seeding specification value
        for ($x = 1; $x <= 60; $x++) {
            $spec = new SpecificationValue();
            $spec->value = "Spec Value " . $x;
            $spec->product()->associate(Product::all()[rand(0, 29)]);
            $spec->specification()->associate(Specification::all()[rand(0, 14)]);
            $spec->save();
        }
    }
}
