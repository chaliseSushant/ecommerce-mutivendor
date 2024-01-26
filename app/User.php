<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role as Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'image', 'provider', 'provider_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function userDiscounts()
    {
        return $this->hasMany('App\UserDiscount');
    }
    public function hasPrivilege($privilege)
    {
        if ($this->hasRole('vendor') && ($this->vendor->status != 1 or $this->vendor->approved_at == null))
        {

            if ($privilege == 'view-vendor-general-setting' || $privilege == 'add/edit/delete-vendors' || $privilege == 'update-vendor-details' || $privilege == 'add/edit/delete-vendors-docs')
            {
                return $this->role->hasPrivilege($privilege);
            }
            else
            {
                return null;
            }
        }
        else
        {
            return $this->role->hasPrivilege($privilege);
        }
    }

    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
    public function inWish($id)
    {
        if ($this->wishlists->where('product_id',$id)->first() != null)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function countCartItems()
    {
        $carts = $this->carts->where('ordered',0);
        if ($carts->count() != 0) {
            $total = 0;
            foreach ($carts as $cart)
            {
                $total = $total+$cart->cartItems->count();
            }
            return $total;
        }
        else
        {
            return 0;
        }

    }
    public function district()
    {
            return $this->customer->addresses->where('default',1)->first()->district_id;
    }
    public function hasRole($role)
    {
        if ($this->role->role == $role)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function assignableRoles()
    {

        if ($this->role->role == 'admin')
        {
            return Role::all();
        }
        else
        {
            return Role::where('order','>',$this->role->order)->get();
        }

    }
    public function fp_discount_cumulative($min,$csum)
    {
        return $this->userDiscounts()
            ->where('is_cumulative',true)
            ->where('cumulative_sum',$csum)
            ->where('expire_at','>=',Carbon::now())
            ->where('applied_at',null)
            ->where('type',0)
            ->where('min','<=',$min)
            ->first();
    }
    public function fp_discount($min)
    {
        return $this->userDiscounts()
            ->where('expire_at','>=',Carbon::now())
            ->where('applied_at',null)
            ->where('type',0)
            ->where('min','<=',$min)
            ->first();
    }
    public function rfr_discount($min)
    {
        return $this->userDiscounts()
            ->where('expire_at','>=',Carbon::now())
            ->where('type',1)
            ->where('applied_at',null)
            ->where('min','<=',$min)
            ->get();
    }
    public function rfd_discount($min)
    {
        return $this->userDiscounts()
            ->where('applied_at',null)
            ->where('expire_at','>=',Carbon::now())
            ->where('type',2)
            ->where('min','<=',$min)
            ->first();
    }
    public function discount($min,$csum)
    {
        $discountables = [];
        if ($this->fp_discount($min))
        {
            array_push($discountables,$this->fp_discount($min)->id);
            $min = $min - $this->fp_discount($min)->min;
        }
        if($this->fp_discount_cumulative($min,$csum))
        {
            array_push($discountables,$this->fp_discount_cumulative($min,$csum)->id);
            $min = $min - $this->fp_discount($min)->cumulative_sum;
        }
        if($this->rfd_discount($min))
        {
            foreach ($this->rfd_discount($min) as $discount)
            {
                array_push($discountables,$discount->id);
                $min = $min - $discount->min;
            }
        }
        if($this->rfr_discount($min))
        {
            foreach ($this->rfd_discount($min) as $discount)
            {
                array_push($discountables,$discount->id);
                $min = $min - $discount->min;
            }
        }


        //return $this->fp_discount(20);
    }


}
