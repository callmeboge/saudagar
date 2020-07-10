<?php

// $list_num = [
//                 ['a' => 1, 'b' => 2, 'c' => 3],
//                 ['a' => 1, 'b' => 2, 'c' => 3],
//                 ['a' => 1, 'b' => 2, 'c' => 3]
//             ];
// $b = 'c';

// // foreach ($list_num as $key => $value) {
// //     # code...

// //     // var_dump($value['b']);
// //     var_export($value['b']);
// // }

// $array_map_operation = array_map( function($list) use ($b){ is_object($list) ? $list->{$b}  : $list[$b]; }, $list_num);

// var_dump($array_map_operation);

// // $b = function($a, $b) {echo $a . $b;};

// FUNCTION PLUCK //retrive all value by giving key

function pluck($item, $key){
    return array_map(function($item) use ($key) {
        return is_object($item) ? $item->$key : $item[$key];
    }, $item);

}

$list = [
            ['product_id' => 0, 'name' => 'Shopee'],
            ['product_id' => 1, 'name' => 'Lazada'],
                ['a' => 1, 'b' => 1, 'c' => 1],
                ['a' => 2, 'b' => 2, 'c' => 1],
                ['a' => 3, 'b' => 3, 'c' => 1]
];

print_r( pluck($list, 'c') );
var_dump( pluck($list, 'c') );
var_export( pluck($list, 'c') );