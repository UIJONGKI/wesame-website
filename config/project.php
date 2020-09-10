<?php

return [
	'url' => env('APP_URL', 'http://localhost:8000'),
    'api_domain' => env('API_DOMAIN', 'api.wesame.dev'),
    'app_domain' => env('APP_DOMAIN', 'wesame.dev'),
    'description' => '',

	/* 태그 */
	'tags' => [
		'news' => '소식',
		'info' => '정보',
		'column' => '칼럼',
		'media' => '언론보도',
		'etc' => 'etc',
	],

    'gtags' => [
        'arttoy' => '아트토이',
        'diorama' => '디오라마',
        'lego' => '레고',
        'gunpla' => '건프라',
        'illust' => '일러스트',
        'etc' => 'etc',
    ],

	'mimes' => [
        'png',
        'jpg',
        'jpeg',
    ],

    'sorting' => [
    	'view_count' => '조회수',
    	'created_at' => '작성일',
    ],
];