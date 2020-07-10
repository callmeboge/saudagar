<?php

$menu = [
            [
                'class' => 'active',
                'link'  => 'index.html',
                'icon'  => 'fa fa-dashboard',
                'text'  => 'dashboard'
            ],
            [
                'class' => 'treeview',
                'link'  => '#',
                'icon'  => 'fa fa-edit',
                'text'  => 'form',
                'sub_menu' => [
                                'class' => 'treeview-menu',
                                'icon'  => 'fa fa-circle',
                                'sub_menu_list' => [
                                                        [
                                                            'class' => '',
                                                            'link'  => 'form_component',
                                                            'icon'  => 'fa fa-circle',
                                                            'text'  => 'Form Component'
                                                        ],
                                                        [
                                                            'class' => '',
                                                            'link'  => 'form_component',
                                                            'icon'  => 'fa fa-circle',
                                                            'text'  => 'Form Component'
                                                        ],
                                                    ]
                            ]
            ],
            [
                'class' => 'treeview',
                'link'  => '#',
                'icon'  => 'fa fa-share',
                'text'  => 'multi level',
                'sub_menu' => [
                                'class' => 'treeview-menu',
                                'icon'  => 'fa fa-circle',
                                'sub_menu_list' => [
                                                        [
                                                            'class' => '',
                                                            'link'  => 'blank_page',
                                                            'icon'  => 'fa fa-circle-o',
                                                            'text'  => 'Form Component'
                                                        ],
                                                        [
                                                            'class' => 'treeview',
                                                            'link'  => '#',
                                                            'icon'  => 'fa fa-circle-o',
                                                            'text'  => 'Form Component',
                                                            'sub_menu' => [
                                                                            'class' => 'treeview-menu',
                                                                            'icon' => 'fa fa-circle-o',
                                                                            'sub_menu_list' =>  [
                                                                                                    [
                                                                                                        'class' => '',
                                                                                                        'link'  => '',
                                                                                                        'icon'  => 'fa fa-circle-o'
                                                                                                    ],
                                                                                                    [
                                                                                                        'class' => '',
                                                                                                        'link'  => '',
                                                                                                        'icon'  => ''
                                                                                                    ]
                                                                                                ]                                                          
                                                            ]
                                                        ],
                                                    ]
                            ]
            ]
];

// print {$menu} array
// var_dump($menu);
// print_r($menu);
// foreach ($menu as $key => $value) {
//     if(is_)
// }


class test{
    public $test =1;
    public static $test1 = 2;


}



// echo test::$test1;

$test = new test;
echo $test->test;
echo $test->test1; 
// echo test::$test1;
// var_export($test);





