<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products =[
            [ 
                'name'=>'Opp',
                'description'=> 'Opp Brand',
                'image'=>'https://dummyimage.com/200x300/000/fff&text=Samsung',
                'price'=> 104
            ],
            [
                'name'=>'Xawmy 12',
                'description'=>'Xawmy brand',
                'image'=>'https://dummyimage.com/200x300/000/fff&text=Iphone',
                'price'=> 1300
            ],
            [
                'name'=>'One Pus 2',
                'description'=> 'One Plus Brand',
                'image'=> 'https://dummyimage.com/200x300/000/fff&text=Google',
                'price'=>400
            ]
        ];
       foreach($products as $key=>$value){
        Cart::create($value);
       }
    }
}
