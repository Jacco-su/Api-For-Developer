<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    'youku.json' => 'youku/youku/youku',
    
    '[demo]'=>[
        'codingke/:course/:cid/:vid'=>['demo/codingke/video',[],['course'=>'\w+','cid'=>'\d+','vid'=>'\d+']],
        'codingke/:course/:cid'=>['demo/codingke/lists',[],['course'=>'\w+','cid'=>'\d+']],
        'codingke/:course'=>['demo/codingke/courses',[],['course'=>'\w+']],
        'codingke'=>'demo/codingke/index',

        'maiziedu/:course/:cid/:vid'=>['demo/maiziedu/video',[],['course'=>'\w+','cid'=>'\d+','vid'=>'\d+']],
        'maiziedu/:course/:cid'=>['demo/maiziedu/lists',[],['course'=>'\w+','cid'=>'\d+']],
        'maiziedu/:course'=>['demo/maiziedu/courses',[],['course'=>'\w+']],
        'maiziedu'=>'demo/maiziedu/index',

        'jikexueyuan/:course/:cid/:vid'=>['demo/jikexueyuan/video',[],['course'=>'\w+','cid'=>'\d+','vid'=>'\d+']],
        'jikexueyuan/:course/:cid'=>['demo/jikexueyuan/lists',[],['course'=>'\w+','cid'=>'\d+']],
        'jikexueyuan/:course'=>['demo/jikexueyuan/courses',[],['course'=>'\w+']],
        'jikexueyuan'=>'demo/jikexueyuan/index',

    ],

    '[api]'=>[
        'codingke/courses/:id'=>['api/codingke/courses',[],['id'=>'\w+']],
        'codingke/videos/:id'=>['api/codingke/videos',[],['id'=>'\d+']],
        'codingke/info/:cid/:vid'=>['api/codingke/info',[],['cid'=>'\d+','vid'=>'\d+']],

        'maiziedu/category'=>'api/maiziedu/category',
        'maiziedu/courses/:id'=>['api/maiziedu/courses',[],['id'=>'\w+']],
        'maiziedu/videos/:id'=>['api/maiziedu/videos',[],['id'=>'\d+']],
        'maiziedu/info/:cid/:vid'=>['api/maiziedu/info',[],['cid'=>'\d+','vid'=>'\d+']],

        'jikexueyuan/type'=>'api/jikexueyuan/type',
        'jikexueyuan/courses/:type/:page'=>['api/jikexueyuan/courses',[],['type'=>'\w+','page'=>'\d+']],
        'jikexueyuan/videos/:id'=>['api/jikexueyuan/videos',[],['id'=>'\d+']],
        'jikexueyuan/info/:cid/:vid'=>['api/jikexueyuan/info',[],['cid'=>'\d+','vid'=>'\d+']],

        'mp4ba/index'=>'api/mp4ba/index',
        'mp4ba/category'=>'api/mp4ba/category',
        'mp4ba/lists/:category/:page'=>['api/mp4ba/lists',[],['category'=>'\d+','page'=>'\d+']],
        'mp4ba/item/:id'=>['api/mp4ba/item',[],['id'=>'[0-9a-f]{40}']],
    ],

    '[readme]'=>[
        'index'=>'readme/index/index',
        'codingke'=>'readme/index/codingke',
        'maiziedu'=>'readme/index/maiziedu',
        'jikexueyuan'=>'readme/index/jikexueyuan',
        'mp4ba'=>'readme/index/mp4ba',
    ],

];
