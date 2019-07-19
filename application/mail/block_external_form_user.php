<?php

defined('C5_EXECUTE') or die("Access Denied.");

$subject = "【サイト名】フォーム";

$p_name = $input['p_name'];
$p_name_yomi = $input['p_name_yomi'];
$p_email = $input['p_email'];
$p_tel = $input['p_tel'];
$p_message = $input['p_message'];

$body = "

こんにちは サイト名 です。

メールフォームでのお問い合わせありがとうございます。
下記の内容が送信されました。

----------
お名前: $p_name
ふりがな: $p_name_yomi
メールアドレス: $p_email
お電話番号: $p_tel

メッセージ
$p_message
----------

改めてご連絡いたします。

もうしばらくお待ち下さい。

-----
サイト名
contact@example.com

";
