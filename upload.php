<?php

// データベースに接続する
$dsn = 'mysql:dbname=ImageUploadSample;host=127.0.0.1';
$user = 'root';
$password='';
// データベース接続
$dbh = new PDO($dsn, $user, $password);
// エラーを画面に出す設定
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// DBを操作するときの文字コードを設定
$dbh->query('SET NAMES utf8');

// 送信されてきた画像データを取得する
$image = file_get_contents($_FILES['image']['tmp_name']);

// 画像データを登録する
$sql = 'INSERT INTO images(image) VALUES(:image)';
// SQL準備
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':image', $image, PDO::PARAM_LOB);
// 実行
$stmt->execute();

// view.phpに戻る
header("Location: view.php");