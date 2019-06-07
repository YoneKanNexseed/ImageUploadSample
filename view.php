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

// データを更新する
$sql = 'SELECT * FROM images';
// SQL準備
$stmt = $dbh->prepare($sql);
// 実行
$stmt->execute();


$records = array();

while (true) {
  // 1レコード取得
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($record == false) {
    // レコードが存在しない時、ループを終了
    break;
  }

  // 配列にレコードを追加
  $records[] = $record;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  <?php foreach($records as $record): ?>

    <img src="data:image/png;base64,<?= base64_encode($record['image']); ?>" >
    
  <?php endforeach; ?>

</body>
</html>