<?php

$arr = [
    [
        'name'=>'Trang chủ',
        'link'=>'#'
    ],
    [
        'name'=>'Tin tức',
        'link'=>   [
            [
                'name'=>'Tin xã hội',
                'link'=>'/tin-xa-hoi'
            ],
            [
                'name'=>'Tin thể thao',
                'link'=>'/tin-the-thao'
            ],
            [
                'name'=>'Tin văn hóa',
                'link'=>'/tin-van-hoa'
            ]
        ]     
    ],
    [
        'name'=>'Liên hệ',
        'link'=>'lien-he'
    ],

];

$arr = json_encode($arr);
$arr = json_decode($arr);

$settings = Aabc::$app->settings;
echo '<pre>';
// print_r(json_decode($settings->get('thongtin')));

print_r($arr);


?>
<!-- <form action="" method="POST">
    <input type="text" name="tuyen[]" link="Trang chủ" />
    <input type="text" name="tuyen[]" link="Tin tức" />

        <input type="text" name="tuyen[][]" link="Tin thể thao" />
        <input type="text" name="tuyen[][]" link="Tin thời sự" />
        <input type="text" name="tuyen[][]" link="Tin thời sự" />

    <input type="text" name="tuyen[]" link="Giới thiệu" />
    <input type="text" name="tuyen[]" link="Liên hệ" />

    <input type="submit" link="Submit" />
</form> -->

