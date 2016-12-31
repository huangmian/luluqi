<?php
return 
[ 
	'user' => [
        'class' => 'modules\user\Module',
    ],
    'post' => [
        'class' => 'modules\post\Module',
    ],
    'redactor' => [
        'class' => 'lulubin\redactor\RedactorModule',
        'uploadDir' => '@webroot/images/post',
        'uploadUrl' => '@web/images/post',
        'imageAllowExtensions'=>['jpg','png','gif'],
    ],
    'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ],
];