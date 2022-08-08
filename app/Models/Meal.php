<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'meals';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'status'];

    public function mealCatergory()
    {
        return $this->hasOne(Category::class);
    }
    public function mealTags()
    {
        return $this->hasMany(Tag::class);
    }
    public function mealIngredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
