<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name'          => 'Rice',
                'description'   => 'Rice is the seed of the grass species Oryza sativa or, less commonly, O. glaberrima. The name wild rice is usually used for species of the genera Zizania and Porteresia, both wild and domesticated, although the term may also be used for primitive or uncultivated varieties of Oryza.',
            ],
            [
                'name'          => 'Egg',
                'description'   => 'Humans and human ancestors have scavenged and eaten animal eggs for millions of years. Humans in Southeast Asia had domesticated chickens and harvested their eggs for food by 1500 BCE. The most widely consumed eggs are those of fowl, especially chickens.',
            ],
            [
                'name'          => 'Bread',
                'description'   => 'Bread is a staple food prepared from a dough of flour and water, usually by baking. Throughout recorded history and around the world, it has been an important part of many cultures diet.',
            ],
            [
                'name'          => 'Apple',
                'description'   => 'An apple is a round, edible fruit produced by an apple tree. Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found.',
            ],
            [
                'name'          => 'Carrot',
                'description'   => 'The carrot is a root vegetable, typically orange in color, though purple, black, red, white, and yellow cultivars exist, all of which are domesticated forms of the wild carrot, Daucus carota, native to Europe and Southwestern Asia.',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
