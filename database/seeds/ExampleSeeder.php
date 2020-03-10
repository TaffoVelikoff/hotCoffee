<?php

namespace TaffoVelikoff\HotCoffee\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use TaffoVelikoff\HotCoffee\Menu;
use TaffoVelikoff\HotCoffee\Article;
use TaffoVelikoff\HotCoffee\MenuItem;
use TaffoVelikoff\HotCoffee\InfoPage;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create the test info page
        $info = InfoPage::create([
            'key'           => 'default',
            'title'         =>  [
                'en'    => 'Test Page',
                'bg'    => 'Тестова Страница'
            ],
            'content'      => [
                'en'    => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'bg'    => '<p>Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове. Този начин не само е оцелял повече от 5 века, но е навлязъл и в публикуването на електронни издания като е запазен почти без промяна. Популяризиран е през 60те години на 20ти век със издаването на Letraset листи, съдържащи Lorem Ipsum пасажи, популярен е и в наши дни във софтуер за печатни издания като Aldus PageMaker, който включва различни версии на Lorem Ipsum.</p>'
            ],
            'meta_desc'     => [
                'en'    => 'Meta description in English.',
                'bg'    => 'Мета описание на български.'
            ]
        ]);

        $info->createSef('my_page');

        // Create a test article
        $article = Article::create([
            'title'         =>  [
                'en'    => 'Test Article',
                'bg'    => 'Тестова Публикация'
            ],
            'content'      => [
                'en'    => '<p>This is a test article right here! Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'bg'    => '<p>Това е тестова публикация! Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове. Този начин не само е оцелял повече от 5 века, но е навлязъл и в публикуването на електронни издания като е запазен почти без промяна. Популяризиран е през 60те години на 20ти век със издаването на Letraset листи, съдържащи Lorem Ipsum пасажи, популярен е и в наши дни във софтуер за печатни издания като Aldus PageMaker, който включва различни версии на Lorem Ipsum.</p>'
            ],
            'meta_desc'     => [
                'en'    => 'Meta description in English.',
                'bg'    => 'Мета описание на български.'
            ]
        ]);

        $article->tag('tests,articles,examples');
        $article->createSef('my_article');

        // Create main menu
        $menu = Menu::create([
            'keyword' => 'main_menu',
            'description' => 'Main menu.'
        ]);

        // Add elements
        $home = MenuItem::create([
            'menu_id'       => $menu->id,
            'name' => [
                'en' => 'Home',
                'bg' => 'Начало'
            ],
            'parent'        => 0,
            'url'           => '/',
            'page_id'       => 0,
            'icon'          => '<i class="fa fa-home"></i>',
            'type'          => 'route',
            'new_window'    => 0,
            'ord'           => 0
        ]);

        $page = MenuItem::create([
            'menu_id'       => $menu->id,
            'name' => [
                'en' => 'Page',
                'bg' => 'Страница'
            ],
            'parent'        => 0,
            'page_id'       => $info->id,
            'icon'          => '<i class="fa fa-file-text"></i>',
            'type'          => 'page',
            'new_window'    => 0,
            'ord'           => 1
        ]);

        $internal = MenuItem::create([
            'menu_id'       => $menu->id,
            'name' => [
                'en' => 'Internal Link',
                'bg' => 'Вътрешна Връзка'
            ],
            'parent'        => 0,
            'url'           => 'internal_page',
            'page_id'       => 0,
            'icon'          => '<i class="fa fa-paperclip"></i>',
            'type'          => 'route',
            'new_window'    => 0,
            'ord'           => 2
        ]);

        $submenu = MenuItem::create([
            'menu_id'       => $menu->id,
            'name' => [
                'en' => 'With Submenu',
                'bg' => 'С Подменю'
            ],
            'parent'        => 0,
            'page_id'       => 0,
            'icon'          => '<i class="fa fa-caret-square-o-down"></i>',
            'type'          => 'nothing',
            'new_window'    => 0,
            'ord'           => 3
        ]);

        $external = MenuItem::create([
            'menu_id'       => $menu->id,
            'name' => [
                'en' => 'External Link',
                'bg' => 'Външна Връзка'
            ],
            'parent'        => $submenu->id,
            'page_id'       => 0,
            'icon'          => '<i class="fa fa-globe"></i>',
            'type'          => 'link',
            'new_window'    => 1,
            'ord'           => 4
        ]);
    }
}
