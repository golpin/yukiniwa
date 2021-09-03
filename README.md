# YUKINIWA
 
yukiniwaはスノースポーツユーザーが
より簡単にスノースポーツの楽しさを発信・共有することを目的としたwebアプリポートフォリオです。

# 制作背景  

シーズンになればスノースポーツユーザーが各スノースポーツの楽しさやゲレンデの情報等をツイッター等SNSで発信しますが、  
ある対象に絞って実際のユーザーの声を知りたいと思った際に、必ずしもキーワード検索やタイムライン上で  
見つけられるか分からず、求めるものに到達するまでの手間や時間の浪費が発生し、簡便さや可視性が低いことに注目しました。
※作者はスキーヤーです。 

# デモ
 以下のURLから気軽にご利用ください。  
 ### mailaddress:user1@test.com  
 ### password:zxcv1234  
※新規登録の場合には架空のメールアドレスをご利用下さい  
 https://hidden-headland-38760.herokuapp.com/   
 ![yukiniwa-sample](https://user-images.githubusercontent.com/84654773/129986228-70902052-8c97-40b2-b2fa-46ec1ab5609a.png)

# 使用技術  
* HTML/CSS
* PHP 8.0.9  
* Laravel 8.40  
* Alpine.js 2.7.3  
* Tailwind CSS 2.0.2  
* MySQL(ローカル:MaridDB 10.4.20、本番環境:ClearDB）  
* AWS(S3)
* heroku

# 機能
 
 機能の紹介  
 ### 1.ゲスト(未ログイン状態)  
 ・投稿一覧画面の閲覧  
 ->12投稿ごとのページネーション  
 ->キーワード検索、スキー場検索、投稿の新旧順によるソート機能  
 
 ### 2.ユーザー(ログイン状態)   
 ・投稿一覧画面の閲覧  
 ->12投稿ごとのページネーション  
 ->自分の投稿のみ、モーダルに更新・削除ボタンが表示され機能の使用が可能   
 ->キーワード検索、スキー場検索、投稿の新旧順によるソート機能  
 ->投稿画像をクリックすると投稿モーダルが表示される。 
 ・投稿画面  
 ->タイトル・本文・画像の投稿 
 ・自分の投稿一覧画面の閲覧  
 ->モーダルに更新・削除ボタンが表示され機能の使用が可能  
 ・プロフィール  
 ->プロフィール画像、ユーザー名の表示、プロフィール文の表示、お気に入りのスキー場表示  
 ->上記の項目の編集機能、また、設定したプロフィールはユーザーアイコンをクリックすることでモーダル表示。
 
 ### 3.管理者  
 ・ブログ一覧画面の閲覧  
 ->12投稿ごとのページネーション
 ->任意のブログ記事を削除可能。更新は不可。  
 ・ユーザーリスト  
 ->任意のユーザーを削除出来る  
 ->削除されたユーザーの記事は全て削除される  
 ・スキー場リスト  
 ->スキー場の追加・編集が可能。
 
# Installation
 
1.cd yukiniwa 
2.composer install  
3.npm install  
4.npm run dev  
5.php artisan migrate (.envが必要です)  
6.画像の保存処理と表示の注意点	
現在、画像の保存処理はAWS S3に保存、表示関連についてもS3から表示となっております。   
ローカル完結で保存・表示を試されたい方は    
app/Http/Controllers/User/PostController.php内にローカル用の処理をコメントアウトしてありますのでそちらをご利用下さい。   
※php artisan storage:linkを必ず実施  
※public配下にno_image_logo.pngとYUKINIWA.pngがありますので  
no_image_logo.pngをstorage/app/public/imagesとstorage/app/public/iconsにコピーして下さい。  
YUKINIWA.pngはstorage/app/public/imagesにコピーして下さい。    
※resources/views/components内のblog-card.blade.php、admin-blog-card.blade.php、guest-blog-card.blade.php、   
showModal.blade.php、profileModal.blade.php、yukiniwa-logo.blade.phpに  
s3とローカル用の表示記述がありますのでどちらかをご利用下さい。  
※s3で試用する場合はpublicディレクトリ内にあるno_image_logo.pngとYUKINIWA.pngを予めバケットに保存しておく必要があります。  
7.php artisan serve 

 
# 作者
* ### golpin



