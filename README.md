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
①メニューバーの「Regist URL」をクリック<br>
②更新確認したいWebサイトのURLを入力し、「Submit」をクリック<br>
③リクエストに成功するとポップアップが表示されます。<br>
![giphy](https://user-images.githubusercontent.com/53083803/161560316-c906dbdb-a023-4799-8746-8e5051c8cc06.gif)

④Webサイトの更新を「Butterfly.Net」が認識すると/workspaceの表にサイトのドメインと更新が確認された時刻が表示されます。



## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
