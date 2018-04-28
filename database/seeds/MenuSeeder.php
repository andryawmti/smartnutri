<?php

use Illuminate\Database\Seeder;
use \App\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $menu_list = array(
//            array(
//                'title' => 'Chocolate Sandcastle',
//                'calorie' => '480',
//                'config' => "{
//                    'ingredients':'ingredient a, ingredient b, ingredient c',
//                    'cook_instruction: 'cook with instruction',
//                }",
//            ),
//            array(
//                'title' => 'Classic Glazed Old-Fashioned',
//                'calorie' => '480',
//                'config' => "{
//                    'ingredients':'ingredient a, ingredient b, ingredient c',
//                    'cook_instruction: 'cook with instruction',
//                }",
//            ),
//            array(
//                'title' => 'Apple Fritter',
//                'calorie' => '490',
//                'config' => "{
//                    'ingredients':'ingredient a, ingredient b, ingredient c',
//                    'cook_instruction: 'cook with instruction',
//                }",
//            ),
//        );

        $menu = Menu::create(array(
            'title' => 'Chocolate Sandcastle',
            'calorie' => '480',
            'config' => "{'ingredients':'ingredient a, ingredient b, ingredient c','cook_instruction: 'cook with instruction',
            }",
        ));

        $menu = Menu::create(array(
            'title' => 'Classic Glazed Old-Fashioned',
            'calorie' => '480',
            'config' => "{'ingredients':'ingredient a, ingredient b, ingredient c','cook_instruction: 'cook with instruction',}",
        ));

        $menu = Menu::create(array(
            'title' => 'Apple Fritter',
            'calorie' => '490',
            'config' => "{'ingredients':'ingredient a, ingredient b, ingredient c','cook_instruction: 'cook with instruction',
            }",
        ));
    }
}
