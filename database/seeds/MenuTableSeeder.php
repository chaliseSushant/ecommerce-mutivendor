<?php

use App\Category;
use App\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->name = 'Shop by Categories';
        $menu->url = '#';
        $menu->order = 0;
        $menu->parent_id = 0;
        $menu->save();

        $categories = [
            ["Fashion & Clothing",
                [
                    ["Women's Fashion",[
                        ["Women's Clothes",10],
                        ["Women's Shoes",10],
                        ["Women's Watch",10],
                        ["Women's Accessories",10],
                        ["Designer Jewelleries",3],
                    ]],
                    ["Men's Fashion",[
                        ["Men's Clothes",10],
                        ["Men's Shoes",5],
                        ["Men's Watches",10],
                        ["Men's Accessories",5],
                    ]],
                    ["Baby, Toys & Kids",[
                        ["Baby & Toddlers",7],
                        ["Toys & Games",7],
                        ["Babies & Fashions",7],
                        ["Gift Set & Accessories",7],
                        ["Girl's Fashion",7],
                        ["Boy's Fashion",7],
                    ]],
                ]
            ],
            ["Electronics",
                [
                    ["Phones & Tablets",[
                        ["Smart Phones",1.5],
                        ["Tablets",1.5],
                        ["Landlines",10],
                        ["Smart Watches",5],
                        ["Phone & Tablet Accessories",10],
                    ]],
                    ["Computers",[
                        ["Laptops",1.5],
                        ["Storage",5],
                        ["Peripherals & Accessories",10],
                        ["Components & Spare Parts",5],
                        ["Printers & Scanners",2],
                        ["Desktop & Monitor",3],
                        ["Desktop Computers",5],
                        ["Gaming PCs",5],
                        ["Bundles",5],
                        ["Software",5],
                        ["Projectors",3],
                    ]],
                    ["Video Games & Consoles",[
                        ["Consoles",3],
                        ["PS2",8],
                        ["Video Games",8],
                        ["Gaming Accessories",10],
                        ["Board & Card Games",3],
                        ["Fan & Heat Sinks",3],
                        ["Components",8],
                    ]],
                    ["TVs & Videos",[
                        ["DVD & Blueray Players",5],
                        ["Car Audio & GPS",5],
                        ["TV & Video Accessories",1.5],
                        ["Television",1.5],
                    ]],
                    ["Cameras",[
                        ["Cameras",1.5],
                        ["Accessories",10],
                        ["Lenses",10],
                        ["Drones & Drone Accessories",10],
                        ["Camcorders",10],
                        ["Photo Printing",10],
                    ]],
                    ["Audios",[
                        ["iPods & MP3 Player",8],
                        ["Hi-Fi & Stereo",8],
                        ["Musical Instruments",8],
                        ["Musical Instrument Accessories",8],
                        ["Home Theatres",8],
                    ]],
                ]
            ],
            ["Home Appliances",
                [
                    ["Large Appliances",[
                        ["Generators & Power Supplies",2],
                        ["Washers & Driers",2],
                        ["Refrigerators & Fridge",2],
                        ["Cooling & Heating",2],
                        ["Slimlines",2],
                        ["DC Solar",2],
                        ["Cooking",2],
                        ["Dishwashers",2],
                    ]],
                    ["Small Appliances",[
                        ["Mixing, Blending & Grinding",5],
                        ["Beverage Preparators",5],
                        ["Cooking",5],
                        ["Ironing & Laundry",5],
                        ["Vacuum Cleaner",5],
                        ["Floor Care",5],
                        ["Other Small Appliances",5],
                        ["Bundles",5],
                        ["Sewing Machines",5],
                        ["Carpet Washers",5],
                    ]],
                    ["Generator & Power Supplies",[
                        ["Inverters",3],
                        ["Generators",3],
                        ["UPS",3],
                        ["Stabilizers",3],
                        ["Extension Cords",7],
                    ]],
                ]
            ],
            ["Home Decors & Lifestyles",
                [
                    ["Home Decors",[
                        ["Wall Art",9],
                        ["Decorative Cushion Insert & Cover",9],
                        ["Mirrors",9],
                        ["Carpet & Rugs",9],
                        ["Curtains, Blinds & Sheets",9],
                        ["Other Home Decors",9],
                        ["Clock",9],
                        ["Artificial Flowers & Plants",9],
                        ["Candle & Candle Holders",9],
                        ["Picture Frames",9],
                        ["Vessels",9],
                        ["Seasonal Decorations",9],
                    ]],
                    ["Kitchen & Dining",[
                        ["Cookwares",8],
                        ["Cooking Knives",8],
                        ["Tablewares",8],
                        ["Kitchen Tools & Accessories",8],
                        ["Kitchen & Table Linen Accessories",8],
                        ["Grilling & BBQ",8],
                    ]],
                    ["Furniture",[
                        ["Bedroom Furniture",5],
                        ["Living Room Furniture",5],
                        ["Kitchen & Dining Furniture",5],
                        ["Office Furniture",5],
                        ["Hallway & Entry Furniture",5],
                        ["Study Room Furniture",5],
                        ["Outdoor Furniture",5],
                        ["Replica Furniture",5],
                        ["Carpets",5],
                        ["Dining Table",5],
                        ["Inflatable Sofa",5],
                        ["Coat Rack & Umbrella Stand",5],
                        ["Plant Stand & Telephone Table",5],
                    ]],
                    ["Bedding",[
                        ["Pillow",10],
                        ["Bed Linen",10],
                        ["Blanket Quilt Set",10],
                        ["Bedding Accessories",10],
                        ["Other Bedding Accessories",10],
                        ["Bedspreads",10],
                    ]],
                    ["Bath",[
                        ["Bathroom Accessories",5],
                        ["Towel, Mats & Robes",5],
                        ["Shower Accessories",5],
                    ]],
                    ["Lighting",[
                        ["Decorative Wall & Ceiling Lights",8],
                        ["Lamp & Shades",8],
                        ["Lighting Bulb & Components",8],
                        ["Outdoor Lighting",8],
                    ]],
                    ["Household Supplies",[
                        ["Brooms, Floor Brush & Dustbin",8],
                        ["Dishwashing & Bottle Brushes",8],
                        ["Housekeeping Duster",8],
                        ["Fly Swatters",8],
                        ["Housekeeping Gloves",8],
                        ["Ironing Board & Covers",8],
                        ["Laundry Brushes & Lint Removers",8],
                        ["Mops, Refills & Mop Set",8],
                        ["Pegs & Cloth Lines",8],
                        ["Toilet Brushes",8],
                        ["Trigger Spray Bottles",8],
                        ["Wiper & Wiper Covers",8],
                    ]],
                    ["Home Improvements",[
                        ["Hand Tools & Repairs",9],
                        ["Kitchen Fixtures",9],
                        ["Bathroom Fixtures",9],
                        ["Electric Fixtures",9],
                        ["Door Hardware",9],
                    ]],
                    ["House Storage Supplies",[
                        ["Safes & Vaults",4],
                        ["Bedroom & Clothes Storage",4],
                        ["Bathroom Storage",4],
                        ["Garage & Outdoor Storage",4],
                        ["Home Office Storage",4],
                        ["Deck Boxes & Storage",4],
                        ["Shoes Rack & Storage",4],
                        ["Hose Reets",4],
                        ["Gardening Products",4],
                        ["Outdoor Storage",4],
                    ]],
                    ["Lawn & Garden",[
                        ["Lawn & Plant Care",10],
                        ["Soil Fertilisers & Mulches",10],
                        ["Weed & Pest Control",10],
                        ["Pots, Plant & Urns",10],
                        ["Plant & Seeds",10],
                        ["Gardening Tools",10],
                        ["Watering System",10],
                        ["Fences",10],
                        ["Mower & Power Tools",10],
                    ]],
                    ["Outdoor & Garden",[
                        ["Camping",10],
                        ["Garden Tools",10],
                        ["Outdoor Grills & Accessories",10],
                        ["Travel Accessories",10],
                        ["Travel Pillows",10],
                        ["Mechanical Parts",10],
                    ]],
                ]],
            ["Health & Beauty",
                [
                    ["Beauty & Health",[
                        ["Makeup",7],
                        ["Skin Care",7],
                        ["Hand, Feet & Nail Care",7],
                        ["Hair Care",7],
                        ["Hair Color",7],
                        ["Fragrances",7],
                        ["Bath & Body",7],
                        ["Health Care",7],
                        ["Sanitary Pad & Hygiene",7],
                        ["Spa & Beauty",7],
                        ["Men's Grooming",7],
                        ["Personal Care",7],
                        ["Grooming & Styling Appliances",7],
                    ]],
                    ["Health & Checkups",[
                        ["Medicines",10],
                        ["Lab Services",30],
                    ]],
                ]],
            ["Groceries & Liquors",
                [
                    ["Groceries",[
                        ["Tea, Coffee & Beverages",5],
                        ["Laundry & Homecare",5],
                        ["Canned & Packaged Foods",5],
                        ["Grocery Bundles",5],
                        ["Baby & Toddler Foods",5],
                        ["Food & Drinks",5],
                        ["Cumin",5],
                        ["Pasta & Noodles",5],
                        ["Cooking Essentials",5],
                        ["Snacks",5],
                        ["Breakfast",5],
                        ["Chocolate & Desserts",5],
                        ["Energy Drinks",5],
                    ]],
                    ["Drinks & Liquors",[
                        ["Brandy",5],
                        ["Wine",5],
                        ["Beer",5],
                        ["Whiskey",5],
                        ["Local Brands",5],
                        ["Vodka",5],
                        ["Rum",5],
                        ["Gin",5],
                    ]],
                ]],
            ["Sports, Outdoor & Pets",
                [
                    ["Sports & Travels",[
                        ["Team Sports",7],
                        ["Racket Sports",7],
                        ["Shoes & Clothing",7],
                        ["Exercise & Fitness",7],
                        ["Equipments, Weighing, Strength, etc.",7],
                        ["Yoga",7],
                        ["Outdoor Activities",7],
                        ["Sports Bikes & Accessories",7],
                        ["Sports",7],
                        ["Slimming Belts",7],
                        ["Travel",7],
                        ["Kids Sports Items",7],
                    ]],
                ]],
            ["Hobbies & Lifestyle",
                [
                    ["Books & Stationery",[
                        ["Magazines",7],
                        ["English Language Books",7],
                        ["Nepali Language Books",7],
                        ["Stationery & Crafts",7],
                        ["Other Books & Stationery",7],
                        ["eBooks",7],
                        ["School Essentials",7],
                    ]],
                    ["Lifestyle Accessories",[
                        ["Religious Items",8],
                        ["Key Rings",8],
                        ["Cover & Cases",8],
                        ["Gifts",8],
                        ["Tobacco",8],
                        ["Packaging Materials",8],
                    ]],
                    ["Pets & Vets",[
                        ["Dogs",8],
                        ["Cats",8],
                        ["Birds",8],
                        ["Fish",8],
                        ["Hamster",8],
                        ["Other Pets",8],
                    ]],
                ]],
            ["Vehicles",
                [
                    ["Automobiles",[
                        ["Automotives",8],
                        ["Motorcycles",8],
                        ["Car Accessories",8],
                        ["Other Automotive & Motorcycles",8],
                        ["Inverter/Solar",8],
                    ]],
                ]],
            ["Other",
                [
                    ["Adult Accessories",[
                        ["Sex Toys",10],
                        ["Condoms",10],
                    ]],
                ]],
        ];

        $cat_id = 1;
        $cat_order = 0;
        $catidgen = Category::all();
        foreach ($categories as $category)
        {
            $cat = new Menu();
            $cat->name = $category[0];
            $cat->url = '#';
            $cat->order = $cat_order;
            $cat->parent_id = 1;
            $cat->save();
            $cat_id = $cat_id + 1;
            $cat_order = $cat_order + 1;

            $sub_cat_order = 0;
            foreach ($category[1] as $subcategory)
            {
                //http://multivendor/search?category=260
                $subcat = new Menu();
                $subcat->name = $subcategory[0];
                $subcat->url = '/search?category='.$catidgen->where('name',$subcategory[0])->first()->id;
                $subcat->order = $sub_cat_order;
                $subcat->parent_id = $cat->id;
                $subcat->save();

                $cat_id = $cat_id + 1;
                $sub_cat_order = $sub_cat_order + 1;

                $sub_sub_cat_order = 0;
                foreach ($subcategory[1] as $subsubcategory)
                {
                    $subsubcat = new Menu();
                    $subsubcat->name = $subsubcategory[0];
                    $subsubcat->url = '/search?category='.$catidgen->where('name',$subsubcategory[0])->first()->id;
                    $subsubcat->order = $sub_sub_cat_order;
                    $subsubcat->parent_id = $subcat->id;
                    $subsubcat->save();

                    $cat_id = $cat_id + 1;
                    $sub_sub_cat_order = $sub_sub_cat_order + 1;
                }
            }
        }
    }
}
