<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
              'name'=>$this->faker->name,
              'detail'=>$this->faker->paragraph,
              'price'=>$this->faker->numberBetween(100,1000),
              'stock'=>$this->faker->randomDigit,
              'discount'=>$this->faker->nu,mberBetween(2,10),
              'user_id'=>function(){
                return App\User::all()->random();
              }
        ];
    }
}
