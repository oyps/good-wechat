<?php

/**
 * 机器人主程序
 */

require('./good_wechat.php');

$wechat = new Good_wechat();
$wechat->start();
$wechat->add_rule('/.*?music.*?/', function ($args) {
    return '你输入的内容包含了 music 哦';
});
// 如果没有匹配结果，将直接回复下面的内容
$wechat->send_text('系统升级中，敬请谅解
系统已设置部分保留关键词，你可以试试这些关键词
更多资讯可以关注：<a href="https://apee.top">鹏优创官方网站</a>');
