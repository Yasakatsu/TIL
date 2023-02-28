# M1マック「docker-compose」時のエラー解消

## エラー表示
１）The requested image's platform (linux/amd64) does not match the detected host platform (linux/arm64/v8) and no specific platform was requested   

２）phpmyadmin The requested image's platform (linux/amd64) does not match the detected host platform (linux/arm64/v8) and no specific platform was requested

### 解消方法

大体、　「〇〇〇〇The requested」冒頭の〇〇〇〇の部分にエラー対象となっている、イメージファイル内の項目のことを言っている

コンポーズしたファイルのディレクトリで隠しコマンド（shift+command+.）を押して

[docker-compose.yml]ファイルを開く

そうすると、下記のように表記がある
```yml
version: '3'
services:

  nginx:
    image: nginx:1.19.1
    container_name: php_simple_memo_nginx
    ports:
      - 8080:8080
    depends_on:
      - php
      - db
    volumes:
      - ./nginx/server.conf:/etc/nginx/conf.d/default.conf
      - ../:/var/www/html

  php:
    build: ./php
    container_name: php_simple_memo_php
    depends_on:
      - db
    volumes:
      - ../:/var/www/html
      - ./php/log/:/var/log/php/

  phpmyadmin:
    image: phpmyadmin/phpmyadmin:5.0.0
    platform: linux/amd64
    container_name: php_simple_memo_phpmyadmin
    environment:
      - PMA_ARBITRARY=1
      - PMA_HOST=db
      - PMA_USER=root
      - PMA_PASSWORD=password
    depends_on:
      - db
    ports:
      - 8081:80

  db:
    image: mysql:5.7
    container_name: php_simple_memo_mysql
    ports:
      - 13306:3306
    volumes:
      - ./mysql/data:/var/lib/mysql
      - ./mysql/log/:/var/log/mysql
      - ./mysql/my.cnf:/etc/mysql/conf.d/my.cnf
    environment:
      MYSQL_ROOT_PASSWORD: password
      TZ: Asia/Tokyo

```
今回は、nginx,php,phpmyadmin,dbの４つの設定を入れていて、

エラーのでた箇所の設定部分に,

### platform: linux/amd64
を挿入する。

具体的には、

```yml
 nginx:
    image: nginx:1.19.1
    container_name: php_simple_memo_nginx
    ports:
      - 8080:8080
    depends_on:
      - php
      - db
    volumes:
      - ./nginx/server.conf:/etc/nginx/conf.d/default.conf
      - ../:/var/www/html
      ```
      imageの下に挿入。これの場所間違えると、ダメっぽい。
      
      以上。備忘録として、自分に残す。
