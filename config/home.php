<?php

return [
    'version' => '1.0',
    
    /*
     * 限制评论发送
     */
    'comment' => [
        'limit'      => true,
        'limit_time' => 60,
    ],
    
    /* 图片限制 */
    'image'   => [
        'type' => ['jpg', 'png', 'gif', 'jpeg'],
        'size' => 500,
    ],
    //站点网址
    'website'    => 'http://myblog.com',
    //后台
    'admin_domain' => 'http://admin.myblog.com',
    //前台
    'home_domain' => 'http://myblog.com',
    //网站基本信息
    'site'        => [
        'title'       => '',
        'keywords'    => '',
        'description' => '',
    ],
    
    //每篇文章的tagsnumber
    'tagsnumber' => 3,
    //限制用户当前未审核通过或者草稿文章
    'articlelimit' => 2,

];
