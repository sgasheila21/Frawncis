<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Classic Baguettes',
            'price' => 102000,
            'description' => 'These crunchy bagguettes feature a chewy interior riddled with holes,and a crip, deep-golden crust.',
            'product_type_id' => 1,
            'image' => 'user_1_product_1.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Caprese Ciabatta Toast',
            'price' => 74000,
            'description' => 'A twist on traditional caprese salad recipe served on crispy ciabatta toast.',
            'product_type_id' => 2,
            'image' => 'user_1_product_2.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Grilled Chicken Sandwich with Pesto',
            'price' => 54000,
            'description' => 'Rustic bread is slathered in my easy homemade pesto sauce, the topped with juicy grilled chichken breast, melted smoked mozzarella cheese, sun-dried tomatoes and fresh arugula greens for lots of bright,bold flavor!',
            'product_type_id' => 3,
            'image' => 'user_1_product_3.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Classic French Ham And Cheese Bagguette',
            'price' => 189000,
            'description' => 'Dont underestimate the delicious simplicity of this traditional bagguette sandwich.',
            'product_type_id' => 1,
            'image' => 'user_1_product_4.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Bagels',
            'price' => 209000,
            'description' => 'They are characterized by their unique shape, chewy texture and slightly sweet taste. Bagels are made by boiling the dough before baking, which keeps the inside dense and chewy, while the outer crust stays crunchy.',
            'product_type_id' => 1,
            'image' => 'user_1_product_5.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Baked Brie and Bread Wreath',
            'price' => 310000,
            'description' => 'Baked Brie and Bread Wreath is a delightful appetizer that combines the rich, creamy taste of Brie cheese with freshly baked bread.',
            'product_type_id' => 4,
            'image' => 'user_1_product_6.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Cheesy Broccoli Soup in a Bread Bowl',
            'price' => 163000,
            'description' => 'a staple food that has been enjoyed by cultures around the world for centuries. It is a baked product made from dough, consisting of flour, water, yeast and salt. its soft and smooth texture, which is achieved through fermentation and yeast processes.',
            'product_type_id' => 4,
            'image' => 'user_1_product_7.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Cheesy Pesto Pull Apart Bread',
            'price' => 194000,
            'description' => 'perfect for sharing and enjoying with friends and family. Each piece of bread can be easily pulled apart, revealing the stringy cheese and aromatic pesto inside.',
            'product_type_id' => 4,
            'image' => 'user_1_product_8.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Croatian Lepinja Bread',
            'price' => 251000,
            'description' => 'It is a type of flatbread with a soft and chewy texture.It can be sliced open and filled with a variety of ingredients, including grilled meats, vegetables, cheese, and condiments, creating a delicious and satisfying meal.',
            'product_type_id' => 4,
            'image' => 'user_1_product_9.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Crusty Italian Bread with Herbs',
            'price' => 311000,
            'description' => 'The bread crust is golden brown and crispy, providing a satisfying crunch in every bite. On the inside, the bread has a light and fluffy texture, perfect for dipping in sauces or enjoying with a spread of butter or olive oil.',
            'product_type_id' => 4,
            'image' => 'user_1_product_10.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Fantastic Focaccia Bread',
            'price' => 201000,
            'description' => 'is a delicious and flavorful Italian bread that is loved for its distinct texture and taste. It is characterized by its flat and dimpled shape, which creates a perfect balance between a crispy exterior and a soft, chewy interior.',
            'product_type_id' => 4,
            'image' => 'user_1_product_11.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Fruit & Vegetable Bug',
            'price' => 142000,
            'description' => '>By making healthy eating fun and exciting, Fruit & Vegetable Bug helps instill healthy habits in children from an early age, fostering a lifelong appreciation for nutritious foods.',
            'product_type_id' => 2,
            'image' => 'user_1_product_12.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Honey Oat Bread',
            'price' => 272000,
            'description' => 'Made with the goodness of oats and a touch of sweetness from honey, this bread is a perfect choice for those seeking a healthier alternative to traditional bread. The addition of oats gives it a pleasant nutty taste and adds a subtle crunch to each bite.',
            'product_type_id' => 4,
            'image' => 'user_1_product_13.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Pesto Breadsticks',
            'price' => 323000,
            'description' => 'Pesto Breadsticks are a savory and aromatic baked treat thats perfect for snacking on or as an accompaniment to soup, salad or pasta dishes.',
            'product_type_id' => 4,
            'image' => 'user_1_product_14.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Rosemary Focaccia Bread',
            'price' => 113000,
            'description' => 'Rosemary Focaccia bread is an Italian classic loved for its soft, chewy texture and sweet aroma. A feature of this bread is its dimpled surface, which is often drizzled with olive oil and sprinkled with fresh rosemary leaves and coarse salt.',
            'product_type_id' => 4,
            'image' => 'user_1_product_15.png'
        ]);

        DB::table('products')->insert([
            'name' => 'Stromboli',
            'price' => 225000,
            'description' => 'Every slice of Stromboli offers the perfect balance of melted cheese, savory meat and crunchy crust. Stromboli can be enjoyed alone as a delicious handheld food or served with marinara sauce for dipping.',
            'product_type_id' => 1,
            'image' => 'user_1_product_16.png'
        ]);
    }
}
