# PHP＋MySQLで画像をアップロードする方法

## データベース・テーブルを作成する
1. 任意のデータベースを作成する
2. テーブルを作成する
3. 画像データを保存するカラムを以下のように設定する  
データ型：LongBlob
	![](./img/01.png)

## 画像をアップロードするFormを作成する
1. formタグに`enctype="multipart/form-data"`を設定
2. `input type="file"`を追加
		
	```HTML
	<form method="POST" action="./upload.php" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit" value="送信">
	</form>
	```

## POST送信されてきた画像データをデータベースに登録する
	
1. POST送信されてきた画像データを取得する
		
	```PHP
	$image = file_get_contents($_FILES['image']['tmp_name']);
	```