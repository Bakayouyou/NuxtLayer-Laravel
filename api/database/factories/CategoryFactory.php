<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    private static array $categories = [
        ['slug' => 'books',       'label' => 'Books'],
        ['slug' => 'clothing',    'label' => 'Clothing'],
        ['slug' => 'electronics', 'label' => 'Electronics'],
        ['slug' => 'home',        'label' => 'Home'],
        ['slug' => 'sports',      'label' => 'Sports'],
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $category = self::$categories[self::$index % count(self::$categories)];
        self::$index++;

        return $category;
    }
}

