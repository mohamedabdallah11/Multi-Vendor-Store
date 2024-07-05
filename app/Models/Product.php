<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','store_id','description','price','status','image','compare_price','category_id','store_id'];
    protected static function booted(){
        static::addGlobalScope('store',new StoreScope());
    
    }
    public function category(){

        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id','id','id');
    }
    public function scopeActive(Builder $builder){
         $builder->where('status',"=",'active');
    }
    //Acssor
    public function getImageUrlAttribute()
    {
        if(!$this->image){
            return "https://media.istockphoto.com/id/1396814518/vector/image-coming-soon-no-photo-no-thumbnail-image-available-vector-illustration.jpg?s=612x612&w=0&k=20&c=hnh2OZgQGhf0b46-J2z7aHbIWwq8HNlSDaNp2wn_iko=";
    }
    if (Str::startsWith($this->image,['http://','https://'])) {
        return $this->image;
    }
    return asset('storage/'.$this->image);
}
public function getSalePercentAttribute(){
if (!$this->compare_price) {
    return 0;
}
 return round(($this->price - $this->compare_price) / $this->compare_price * 100);
 //return 100 -(100*$this->price/$this->compare_price);
}}