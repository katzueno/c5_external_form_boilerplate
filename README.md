# concrete5 External Form Boiler Place

By @katzueno

This is sample script of External Form block which have the very basic contact fields, validation, confirmation screen and email notifications to admin and form submitter.

日本語は下部に。 / Scroll down for the readme in Japanese.

## Concept

This package was made for concrete5 Nagoya meet-up to understand how submitting form works in concrete5.

I didn't prepare the completion screen on purpose for you to learn step-by-step.

## How to install onto your concrete5

1. Modify the form PHPs accordingly.
    - application/blocks/external_form/form/confirm_form.php
    - application/blocks/external_form/form/controller/confirm_form.php
    - application/mail/block_external_form_admin.php
    - application/mail/block_external_form_user.php
1. Copy the files onto your concrete5 site
    - application/blocks/external_form/form/confirm_form.php
    - application/blocks/external_form/form/controller/confirm_form.php
    - application/mail/block_external_form_admin.php
    - application/mail/block_external_form_user.php
1. Add an external block to your site and select `Confirm Form` from pull down menu.
1. Publish a page
1. Test sending a form.

**You must change** config setting accordingly.

## LICENSE

MIT License.

## History

- 2019.7.20 Initial commit and tested on 8.5.1

# concrete5 外部フォームボイラープレート

By @katzueno

これは、外部フォームのサンプルプログラムです。基本的なお問い合わせ項目と、管理者とフォーム送信者へのメール通知を行います。

外部フォームブロックのカスタマイズ方法を紹介するために、第86回 concrete5 名古屋ユーザーグループ勉強会のために作成しました。

完了画面は用意していません。

## 使い方・インストール方法

1. 各 PHP ファイルを修正
    - application/blocks/external_form/form/confirm_form.php
    - application/blocks/external_form/form/controller/confirm_form.php
    - application/mail/block_external_form_admin.php
    - application/mail/block_external_form_user.php
1. 各ファイルを自分の concrete5 サイトの同じ場所にコピー
    - application/blocks/external_form/form/confirm_form.php
    - application/blocks/external_form/form/controller/confirm_form.php
    - application/mail/block_external_form_admin.php
    - application/mail/block_external_form_user.php
1. concrete5 上でブロック追加画面に。「外部フォームブロック」を選択し「Confirm Form」を選んで追加。
1. ページを公開
1. 動作テストを行う。

## お問い合わせ

 [concrete5 名古屋ユーザーグループ勉強会](https://concrete5nagoya.doorkeeper.jp/) にて受け付けております。
