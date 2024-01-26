<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use function PHPSTORM_META\type;

class Container extends Model
{
    public function template()
    {
        return $this->belongsTo('App\Template');
    }
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
    public function data()
    {
        $data[$this->id] = Cache::remember('data'.$this->id, 22*60, function() {
            return $this->data_processor();
        });
        return $data[$this->id];
        //return $this->data_processor();
    }
    public function data_processor()
    {
        $data['order'] = $this->order;
        $data['title'] = $this->title;
        $data['type'] = $this->type;
        $data['type_id'] = $this->type_id;
        $data['template'] = $this->template->file;
        if ($this->type != null && $this->type_id !=null)
        {
            if ($this->type == 'brand')
            {
                $data['url'] = 'brand/'.$this->type_id;
                $products = Brand::find($this->type_id)->products->where('status',1)->where('stock',1)->random($this->template->size);
                $i=0;
                foreach ($products as $product)
                {
                    $data['cards'][$i]['id'] = $product->id;
                    $data['cards'][$i]['type'] = 'product';
                    $data['cards'][$i]['url'] = '/product/'.$product->id;
                    $data['cards'][$i]['image'] = $product->thumbnail;
                    $data['cards'][$i]['title'] = $product->name;
                    $data['cards'][$i]['price'] = $product->price;
                    $data['cards'][$i]['wishlist'] = '/customer/wishlist/toggle/'.$product->id;
                    $i++;
                }
            }
            if ($this->type == 'category')
            {
                $data['url'] = 'category/'.$this->type_id;
                $products = Category::find($this->type_id)->listProducts()->where('status',1)->where('stock',1)->random($this->template->size);
                $i=0;
                foreach ($products as $product)
                {
                    $data['cards'][$i]['id'] = $product->id;
                    $data['cards'][$i]['type'] = 'product';
                    $data['cards'][$i]['url'] = '/product/'.$product->id;
                    $data['cards'][$i]['image'] = $product->thumbnail;
                    $data['cards'][$i]['title'] = $product->name;
                    $data['cards'][$i]['price'] = $product->price;
                    $data['cards'][$i]['wishlist'] = '/customer/wishlist/toggle/'.$product->id;
                    $i++;
                }
            }
        }
        else
        {
            $data['url'] = null;
            if ($this->cards->count()>0)
            {
                $i=0;
                foreach ($this->cards as $card)
                {
                    if ($card->type == 'product')
                    {
                        $product = Product::find($card->type_id);
                        $data['cards'][$i]['id'] = $product->id;
                        $data['cards'][$i]['type'] = 'product';
                        $data['cards'][$i]['url'] = '/product/'.$product->id;
                        $data['cards'][$i]['image'] = $product->thumbnail;
                        $data['cards'][$i]['title'] = $product->name;
                        $data['cards'][$i]['price'] = $product->price;
                        $data['cards'][$i]['wishlist'] = '/customer/wishlist/toggle/'.$product->id;
                    }
                    elseif($card->type == 'brand')
                    {
                        $product = Brand::find($card->type_id);
                        $data['cards'][$i]['type'] = 'brand';
                        $data['cards'][$i]['url'] = '/brand/'.$product->id;
                        $data['cards'][$i]['image'] = $product->icon;
                        $data['cards'][$i]['title'] = $product->name;
                        $data['cards'][$i]['price'] = null;
                    }
                    elseif($card->type == 'category')
                    {
                        $product = Category::find($card->type_id);
                        $data['cards'][$i]['type'] = 'category';
                        $data['cards'][$i]['url'] = '/category/'.$product->id;
                        $data['cards'][$i]['image'] = $card->image;
                        $data['cards'][$i]['title'] = $product->name;
                        $data['cards'][$i]['price'] = null;
                    }
                    else
                    {
                        $data['cards'][$i]['type'] = 'banner';
                        $data['cards'][$i]['url'] = $card->url;
                        $data['cards'][$i]['image'] = $card->image;
                        $data['cards'][$i]['price'] = null;
                    }
                    $i++;
                }
            }

        }
        return $data;
    }
}
