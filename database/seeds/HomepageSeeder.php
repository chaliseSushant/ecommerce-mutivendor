<?php

use App\Brand;
use App\Card;
use App\Category;
use App\Container;
use App\HeroSlider;
use App\HomepageLayout;
use App\HomepageLayoutItem;
use App\Product;
use App\Store;
use App\HomepageLayoutGroup;
use App\Template;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template_data = [
            ['Card Rectangle','homepage-card-rectangle',2],
            ['Card Rectangle Double','homepage-card-rectangle-double',4],
            ['Card Rectangle One','homepage-card-rectangle-one',1],
            ['Card Rectangle Full Width','homepage-card-full-width',6],
            ['Banner Rectangle','homepage-banner-rectangle',null],
            ['Banner Rectangle Wide','homepage-banner-rectangle-wide',null],
            ['Banner Rectangle Double','homepage-banner-rectangle-double',null],
        ];
        foreach ($template_data as $datum)
        {
            $template = new Template();
            $template->name = $datum[0];
            $template->file = $datum[1];
            $template->size = $datum[2];
            $template->save();
        }

        /*$container_data = [
            [0,'Groceries','category',1,4,null],
            [1,'Cakes','category',2,2,null],
            [2,'TV Banner',null,null,5,[
                ['banner',null,'/banner/destination',null]
            ]],
            [2,'Alcohol Banner',null,null,6,[
                ['banner',null,'/banner/destination',null]
            ]],
            [3,'Electronics',null,null,4,[
                ['product',2,null,null,],
                ['product',6,null,null,],
                ['product',8,null,null,],
                ['product',10,null,null,],
                ['product',12,null,null,],
                ['product',4,null,null,],
            ]]
        ];

        foreach ($container_data as $datum)
        {
            $container = new Container();
            $container->order = $datum[0];
            $container->title = $datum[1];
            $container->type = $datum[2];
            $container->type_id = $datum[3];
            $container->template_id = $datum[4];
            $container->save();

            if ($datum[5] != null)
            {
                $i = 0;
                foreach ($datum[5] as $card_item)
                {
                 $card = new Card();
                 $card->order = $i;
                 $card->type = $card_item[0];
                 $card->type_id = $card_item[1];
                 $card->url = $card_item[2];
                 $card->image = $card_item[3];
                 $card->container_id = $container->id;
                 $card->save();
                 $i = $i+1;
                }
            }
        }*/

        $slider_data = [
            ['#','/storage/images/hero_slider/hero_slider_1622791735.jpg','jpg',1],
            ['#','/storage/images/hero_slider/hero_slider_1622791819.jpg','jpg',1],
            /*['#','/storage/images/hero_slider/hero_slider_1622791885.jpg','jpg',1],*/
        ];

        foreach ($slider_data as $datum)
        {
            $hero = new HeroSlider();
            $hero->url = $datum[0];
            $hero->image_url = $datum[1];
            $hero->extension = $datum[2];
            $hero->active = $datum[3];
            $hero->save();
        }
    }
}
