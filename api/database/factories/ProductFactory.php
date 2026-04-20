<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Catalogue fixtures — mirrors what was previously mocked in controllers.
     */
    private static array $fixtures = [
        [
            'name'        => 'Wireless Headphones',
            'description' => 'Premium noise-canceling wireless headphones with 30-hour battery life',
            'price'       => 19999,
            'category'    => 'electronics',
            'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400',
            'stock'       => 15,
            'rating'      => 4.5,
        ],
        [
            'name'        => 'Smart Watch',
            'description' => 'Fitness tracking smartwatch with heart rate monitor and GPS',
            'price'       => 24999,
            'category'    => 'electronics',
            'image'       => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400',
            'stock'       => 8,
            'rating'      => 4.2,
        ],
        [
            'name'        => 'Laptop Backpack',
            'description' => 'Durable backpack with padded laptop compartment, fits up to 15" laptops',
            'price'       => 5999,
            'category'    => 'electronics',
            'image'       => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400',
            'stock'       => 22,
            'rating'      => 4.7,
        ],
        [
            'name'        => 'Classic Cotton T-Shirt',
            'description' => 'Comfortable 100% cotton t-shirt, available in multiple colors',
            'price'       => 1999,
            'category'    => 'clothing',
            'image'       => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400',
            'stock'       => 50,
            'rating'      => 4.0,
        ],
        [
            'name'        => 'Running Shoes',
            'description' => 'Lightweight running shoes with responsive cushioning',
            'price'       => 8999,
            'category'    => 'sports',
            'image'       => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400',
            'stock'       => 12,
            'rating'      => 4.6,
        ],
        [
            'name'        => 'The Design of Everyday Things',
            'description' => 'Classic book on design principles by Don Norman',
            'price'       => 1899,
            'category'    => 'books',
            'image'       => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400',
            'stock'       => 30,
            'rating'      => 4.8,
        ],
        [
            'name'        => 'Stainless Steel Water Bottle',
            'description' => 'Insulated water bottle keeps drinks cold for 24 hours',
            'price'       => 2999,
            'category'    => 'sports',
            'image'       => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=400',
            'stock'       => 40,
            'rating'      => 4.4,
        ],
        [
            'name'        => 'Desk Lamp',
            'description' => 'LED desk lamp with adjustable brightness and color temperature',
            'price'       => 3999,
            'category'    => 'home',
            'image'       => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=400',
            'stock'       => 18,
            'rating'      => 4.3,
        ],
        [
            'name'        => 'Yoga Mat',
            'description' => 'Non-slip yoga mat with carrying strap, 6mm thick',
            'price'       => 3499,
            'category'    => 'sports',
            'image'       => 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=400',
            'stock'       => 25,
            'rating'      => 4.5,
        ],
        [
            'name'        => 'Coffee Maker',
            'description' => 'Programmable coffee maker with thermal carafe, brews 12 cups',
            'price'       => 7999,
            'category'    => 'home',
            'image'       => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=400',
            'stock'       => 10,
            'rating'      => 4.1,
        ],
        [
            'name'        => 'Denim Jacket',
            'description' => 'Classic denim jacket with a modern fit',
            'price'       => 6999,
            'category'    => 'clothing',
            'image'       => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=400',
            'stock'       => 14,
            'rating'      => 4.2,
        ],
        [
            'name'        => 'JavaScript: The Good Parts',
            'description' => 'Essential guide to JavaScript programming by Douglas Crockford',
            'price'       => 2499,
            'category'    => 'books',
            'image'       => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400',
            'stock'       => 20,
            'rating'      => 4.7,
        ],
    ];

    private static int $index = 0;

    /**
     * Default definition — cycles through the catalogue fixtures.
     * Falls back to Faker for any extra products requested beyond the fixtures.
     */
    public function definition(): array
    {
        $fixture = self::$fixtures[self::$index % count(self::$fixtures)] ?? null;
        self::$index++;

        if ($fixture) {
            $category = Category::firstOrCreate(
                ['slug' => $fixture['category']],
                ['label' => ucfirst($fixture['category'])],
            );

            return [
                'name'        => $fixture['name'],
                'description' => $fixture['description'],
                'price'       => $fixture['price'],
                'category_id' => $category->id,
                'image'       => $fixture['image'],
                'stock'       => $fixture['stock'],
                'rating'      => $fixture['rating'],
            ];
        }

        // Faker fallback for tests or extra data
        return [
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price'       => $this->faker->numberBetween(999, 49999),
            'category_id' => Category::inRandomOrder()->value('id')
                          ?? Category::factory()->create()->id,
            'image'       => $this->faker->imageUrl(400, 400, 'product'),
            'stock'       => $this->faker->numberBetween(0, 100),
            'rating'      => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}

