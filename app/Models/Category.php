<?php

namespace App\Models;

use App\Rules\filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'parent_id',
        'created_at',
        'updated_at'
    ];  
    public static function rules($id=0)
    {
        return[
            'name' => ['required',
             'string',
              'min:3',
               'max:255',
               Rule::unique('categories','name')->ignore($id),
               function($attribute, $value,$fails)
               {
                if(strtolower($value)=='laravel')
                {
                    $fails('Name cant be laravel');
                }
               },
               new filter()
            ],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'mimetypes:image/jpg,image/jpeg,image/png', 'max:1048576'],
            'status' => ['in:active,archived' ,'required']
            //"unique:categories,name,$id"
        ];
    }
}
