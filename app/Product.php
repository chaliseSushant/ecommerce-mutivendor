<?php

namespace App;

use App\Http\Resources\CategoryIndex;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;
    //public $asYouType = true;
    public function searchableAs()
    {
        return 'product_index';
    }
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            /*'brand' => $this->brand->name,*/
            'category' => $this->categories_name(),
            'tags' => $this->tags_keyword(),
            /*'certified' => $this->certified_item()*/
        ];
    }
    public function certified_item()
    {
        return $this->vendor->certified;
    }
    public function categories_name()
    {
        return $this->categories()->pluck('name');
    }
    public function categories_id()
    {
        return $this->categories()->pluck('id');
    }
    public function tags_keyword()
    {
        return $this->tags()->pluck('keyword');
    }
    public function commission_assignable()
    {
        return $this->categories->where('commission','!=',0)->first()->commission;
    }

    public function belongsToCategory($cat_id)
    {
        $result = false;
        foreach ($this->categories as $cat)
        {
            if ($cat->id == $cat_id)
            {
                $result = true;
            }
        }
        return $result;
    }
    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
    public function outlets()
    {
        return $this->belongsToMany('App\Outlet');
    }
    public function cartItems()
    {
        return $this->hasMany('App\Cart');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function specifications()
    {
        return $this->hasMany('App\SpecificationValue');
    }
    public function base_shipping($district)
    {
        //dd($this->outlets->where('district_id',$district)->first());

       if ($this->outlets->where('district_id',$district)->first() != null)
       {
           return $this->shipping_local_base;
       }
       else
       {
           return $this->shipping_national_base;
       }
    }
    public function additional_shipping($district)
    {
        if ($this->outlets->where('district_id',$district)->first() != null)
        {
            return $this->shipping_local_additional;
        }
        else
        {
            return $this->shipping_national_additional;
        }
    }
    public function card()
    {
        $data['id'] = $this->id;
        $data['type'] = 'product';
        $data['url'] = '/product/'.$this->id;
        $data['image'] = $this->thumbnail;
        $data['title'] = $this->name;
        $data['price'] = $this->price;
        $data['display_price'] = $this->display_price;
        $data['discount'] = ($this->display_price ==0||$this->price==$this->display_price ) ?null:round((($this->display_price-$this->price)/$this->display_price*100),2);
        $data['instant'] = $this->instant_delivery;
        $data['certified'] = $this->vendor->certified;
        $data['wishlist'] = '/customer/wishlist/toggle/'.$this->id;

        return $data;
    }
    public function discount()
    {
        return ($this->display_price ==0||$this->price==$this->display_price )?null:round((($this->display_price-$this->price)/$this->display_price*100),2);
    }
    public function instant_shipping($quantity)
    {
        return $this->shipping_instant_base + ($this->shipping_instant_additional*($quantity-1));
    }
    public function addToCart($qty = 1, $instant)
    {
        $existing_cart = Cart::where('ordered',null)->where('user_id',Auth::id())->first();
        if ($existing_cart == null)
        {
            $cart = new Cart();
            if ($instant || $this->national_delivery == 0)
            {
                $cart->deliverable_districts = implode(',',$this->outlets->pluck('district_id')->toArray());
            }
            $cart->user()->associate(Auth::user());
            $cart->save();

            $cart_item = new CartItem();
            $cart_item->quantity = $qty;
            if ($instant)
            {
                $cart_item->is_instant = 1;
            }
            $cart_item->product()->associate($this);
            $cart_item->cart()->associate($cart);
            $cart_item->save();
        }
        else
        {
            $existing_cart_item = $existing_cart->cartItems->where('product_id',$this->id)->first();
            if ($existing_cart_item != null)
            {
                $existing_cart_item->quantity = $existing_cart_item->quantity+$qty;
                $existing_cart_item->save();
            }
            else
            {
                if ($instant || $this->national_delivery == 0)
                {
                    if ($existing_cart->deliverable_districts != null)
                    {
                        $existing_delivery_district = explode(',',$existing_cart->deliverable_districts);
                        $product_delivery_district = $this->outlets->pluck('district_id')->toArray();
                        $new_delivery_district = implode(',',array_intersect($existing_delivery_district,$product_delivery_district));
                        if ($new_delivery_district == null)
                        {
                            $cart = new Cart();
                            $cart->deliverable_districts = implode(',',$this->outlets->pluck('district_id')->toArray());
                            $cart->user()->associate(Auth::user());
                            $cart->save();
                            $cart_item = new CartItem();
                            $cart_item->quantity = $qty;
                            if ($instant)
                            {
                                $cart_item->is_instant = 1;
                            }
                            $cart_item->product()->associate($this);
                            $cart_item->cart()->associate($cart);
                            $cart_item->save();
                        }
                        else
                        {
                            $existing_cart->deliverable_districts = $new_delivery_district;
                            $existing_cart->user()->associate(Auth::user());
                            $existing_cart->save();
                            $cart_item = new CartItem();
                            $cart_item->quantity = $qty;
                            if ($instant)
                            {
                                $cart_item->is_instant = 1;
                            }
                            $cart_item->product()->associate($this);
                            $cart_item->cart()->associate($existing_cart);
                            $cart_item->save();
                        }
                    }
                    else
                    {
                        $existing_cart->deliverable_districts = implode(',',$this->outlets->pluck('district_id')->toArray());;
                        $existing_cart->user()->associate(Auth::user());
                        $existing_cart->save();
                        $cart_item = new CartItem();
                        $cart_item->quantity = $qty;
                        if ($instant)
                        {
                            $cart_item->is_instant = 1;
                        }
                        $cart_item->product()->associate($this);
                        $cart_item->cart()->associate($existing_cart);
                        $cart_item->save();
                    }

                }
                else
                {
                    $existing_cart->user()->associate(Auth::user());
                    $existing_cart->save();
                    $cart_item = new CartItem();
                    $cart_item->quantity = $qty;
                    $cart_item->product()->associate($this);
                    $cart_item->cart()->associate($existing_cart);
                    $cart_item->save();
                }
            }
        }

        //Old Codes
        /*$existing_cart = Cart::where('ordered',null)->where('user_id',Auth::id())->first();
        if($existing_cart == null)
        {
            $cart = new Cart();
            if ($instant || $this->national_delivery == 0)
            {
                $cart->deliverable_districts = implode(',',$this->outlets->pluck('district_id')->toArray());
            }
            $cart->user()->associate(Auth::user());
            $cart->save();
            $cart_item = new CartItem();
            $cart_item->quantity = $qty;
            if ($instant)
            {
                $cart_item->is_instant = 1;
            }
            $cart_item->product()->associate($this);
            $cart_item->cart()->associate($cart);
            $cart_item->save();
            //maintain other items
        }
        else
        {
            $existing_cart_item = $existing_cart->cartItems->where('product_id',$this->id)->first();
            if($existing_cart_item == null)
            {
                if ($instant || $this->national_delivery == 0)
                {
                    if ( $existing_cart->deliverable_districts != null)
                    {
                        $existing_delivery_district = explode(',',$existing_cart->deliverable_districts);
                        $product_delivery_district = $this->outlets->pluck('district_id')->toArray();
                        $new_delivery_district = implode(',',array_intersect($existing_delivery_district,$product_delivery_district));
                    }
                    else
                    {
                        $new_delivery_district = implode(',',$this->outlets->pluck('district_id')->toArray());
                    }
                    if ($new_delivery_district == null)
                    {
                        $cart = new Cart();
                        $cart->deliverable_districts = implode(',',$this->outlets->pluck('district_id')->toArray());
                        $cart->user()->associate(Auth::user());
                        $cart->save();
                        $cart_item = new CartItem();
                        $cart_item->quantity = $qty;
                        if ($instant)
                        {
                            $cart_item->is_instant = 1;
                        }
                        $cart_item->product()->associate($this);
                        $cart_item->cart()->associate($cart);
                        $cart_item->save();

                    }
                    else
                    {

                        $existing_cart->deliverable_districts = implode(',',$this->outlets->pluck('district_id')->toArray());
                        $existing_cart->save();

                        $cart_item = new CartItem();
                        $cart_item->quantity = $qty;
                        if ($instant)
                        {
                            $cart_item->is_instant = 1;
                        }
                        $cart_item->product()->associate($this);
                        $cart_item->cart()->associate($existing_cart);
                        $cart_item->save();
                    }
                }
                else
                {
                    $cart_item = new CartItem();
                    $cart_item->quantity = $qty;
                    $cart_item->product()->associate($this);
                    $cart_item->cart()->associate($existing_cart);
                    $cart_item->save();
                }
            }
            else
            {
                $existing_cart_item->quantity = $existing_cart_item->quantity+$qty;
                $existing_cart_item->save();
            }
        }*/


    }
    /*Calculates Number of Rating for The Product*/
    public function ratingCount()
    {
        return $this->reviews->count();
    }
    public  function ratingAverage()
    {
        if ($this->ratingCount() == 0)
        {
            return 0;
        }
        else
        {
            $total = 0;
            foreach ($this->reviews as $rating)
            {
                $total = $total+$rating->rating;
            }
            return round($total/$this->ratingCount(),1);
        }

    }
    public function reviewDetails()
    {
        if (Auth::check())
        {
            if (Auth::user()->hasRole('customer'))
            {
                return $this->reviews->where('review','!=', null)->where('customer_id','!=',Auth::user()->customer->id);
            }
            else
            {
                return $this->reviews->where('review','!=', null);
            }
        }
        else
        {
            return $this->reviews->where('review','!=', null);
        }

    }
    public function reviewDetailsCount()
    {
        return $this->reviewDetails()->count();
    }
    public function myReview()
    {
        if (Auth::user()->hasRole('customer'))
        {
            $myReview = $this->reviews->where('customer_id',Auth::user()->customer->id)->first();
            if ($myReview != null)
            {
                return $myReview;
            }
            else
            {
                return null;
            }
        }
        else
        {
            return null;
        }

    }
    public function allReviews()
    {
        return $this->reviews->where('customer_id','!=',Auth::user()->customer->id);
    }
}
