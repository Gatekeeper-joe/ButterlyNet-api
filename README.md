# 業務改善ツール「Butterfly.Net」

![tumbnail](https://user-images.githubusercontent.com/53083803/161481561-9f765146-90ea-4a59-a8db-6fd1e99092ff.PNG)

## 概要
実際に制作者が携わっている業務に**非効率と感じられる点がいくつかあったため、その解消を目的として本アプリケーションを作成**しました。
一部機能はそのまま採用いただくことは難しいですが、このアプリケーションにある発想を実際の現場で活用して頂けるよう提案することを検討しております。

## 制作背景
制作者は現在、SOC業務に従事しており24時間体制で監視を行っています。主な業務としましては顧客のサーバに対して発生したサイバー攻撃の成否の判定になりますが、それ以外にレポートの作成や脆弱性情報の収集、次のシフト勤務者に向けた引継ぎ等の業務があります。

その中で**脆弱性情報の収集は**テキストファイルにまとめられている20～30のURLをブラウザに打ち込み**内容を精査するのに約20分**かかります。また、**引継ぎには**エクセルファイルを使用しておりますが、**ファイルが開き使えるようになるまでに遅いケースでは10分近くかかるという課題**を抱えています。この課題を解消できるツールを作成しようと思いついたことから本アプリケーションの制作にいたりました。

## 操作説明
URL：https://butterly-net.vercel.app/<br>
サンプルユーザ：test<br>
パスワード：aaAA11!!

※初回はユーザ登録が必須となります。

### ●Webサイトの更新確認
①ログイン後、メニューバーの「Regist URL」をクリック<br>
②更新確認したいWebサイトのURLを入力し、「Submit」ボタンをクリック<br>
③リクエストに成功するとポップアップが表示されます。<br>
![registURL](https://user-images.githubusercontent.com/53083803/161680907-106c7963-a980-4be2-8ed3-6c0a877dd064.gif)


④Webサイトの更新を「Butterfly.Net」が認識すると
<a href="https://butterly-net.vercel.app/workspace">/workspace</a>
の表に、更新が確認されたサイトのドメインと時刻が表示されます。
![updated](https://user-images.githubusercontent.com/53083803/161662052-b829fe7a-2dda-413b-87bd-55da409ad7fb.PNG)

### ●引継ぎの作成
①「NEW」ボタンをクリック<br>
②ダイアログが表示されるので、件名と本文を記載<br>
③「create」ボタンをクリック<br>
![Workspace](https://gyazo.com/b596e3951d768085f7c207ae3322209a.gif)

### ●引継ぎの編集
①ペンアイコンをクリック<br>
②ダイアログが表示されるので、変更したい箇所を編集。<br>
③「Update」ボタンをクリック<br>
![Workspace](https://gyazo.com/ebb09092f23a64479b742c8994df88c6.gif)

### ●引継ぎの削除
①ゴミ箱アイコンをクリック<br>
②確認ダイアログが表示されるので、問題なければ「Delete」ボタンをクリック<br>
![Workspace](https://gyazo.com/578d00e92cc5c40c21646303dfd5034f.gif)

## 使用技術
バックエンド<br>
PHP 7.4.28 / Laravel 8.70.2

フロントエンド<br>
HTML / CSS / javascript / Bootstrap.vue / Nuxt.js / Vuetify / Chart.js

インフラ<br>
mysql 5.6.51 / AWS(EC2) / XAMPP(開発環境)

その他の使用技術<br>
git(gitHub) / Visual Studio Code / Teratail(SSHクライアント)
lucidchart(ER図) / Drawio(AWS構成図)

## AWS構成図
![portfolio](https://user-images.githubusercontent.com/53083803/161743517-15bfacc2-c708-4564-8812-6754ce06fae8.png)

## ER図
![ER](https://user-images.githubusercontent.com/53083803/161806624-bffcd82f-a2ca-4b82-8a00-d8b1d69dce53.png)

