<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable=['user_id','product_id','quantity','cookie_id','options'];
    //events->observers


    protected static function booted()
    {
   /*       static::creating(
            function (Cart $cart) {     
                $cart->id= Str::uuid(); 
            }
        );  */
        static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', '=', Cart::getCookieId());

            });
 
    }
    
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30*24*60*60); 
        }
        return $cookie_id;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Guest',
        ]);
    }
}
