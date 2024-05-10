<?php

namespace App\Models;

use App\Rules\filter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function scopeActive(EloquentBuilder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function scopeStatus(EloquentBuilder $builder, $status)
    {
        $builder->where('status', '=', $status);
    }
    public function scopeFilter(EloquentBuilder $builder,$Filters)
    {
        $builder->when($Filters['name']??false,function($builder,$value){

            $builder->where('categories.name','LIKE','%'.$value.'%');
        });           
        $builder->when($Filters['status']??false,function($builder,$value){

            $builder->where('categories.status','=',$value);
        });           

/* 
        if ($Filters['name']??false)
        {
            $builder->where('name','LIKE','%'.$Filters['name'].'%');
        }

        if ($Filters['status']??false)

        {
            $builder->where('status','=',$Filters['status']);
        } */
    }
    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
                function ($attribute, $value, $fails) {
                    if (strtolower($value) == 'laravel') {
                        $fails('Name cant be laravel');
                    }
                },
                new filter()
            ],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'mimetypes:image/jpg,image/jpeg,image/png', 'max:1048576'],
            'status' => ['in:active,archived', 'required']
            //"unique:categories,name,$id"
        ];
    }
}
