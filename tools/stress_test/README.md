負荷テスト
---

## 準備

アプリを起動してローカルでAPIを疎通確認できる環境までセットアップしてください。

`./tools/stress_test/.env.example`からenvファイルを用意し、負荷テストの要件に合わせて各パラメータを変更してください。

また`ACCESS_TOKEN`には、APIツールで`/api/sign_up`と`/api/sign_in`を実行してアクセストークンを取得して、その値を設定してください。

## 起動方法

`./tools/stress_test/docker-compose.yml`の以下の設定でWeb UI操作できる環境とCI上で実行する環境が切り替えられます。

```yml
services:
  locust-master:

    ...

    # Web上からテスト実行の場合
    command: locust -f $LOCUSTFILE --host=$WEBAPI_HOST --master
    # # CLIからテスト実行の場合
    # command: locust -f $LOCUSTFILE --headless --host=$WEBAPI_HOST --users $USERS --spawn-rate $SPAWN_RATE --run-time $RUN_TIME --csv locust_stress_test
```