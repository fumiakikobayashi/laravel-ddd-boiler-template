# Laravelのボイラーテンプレート
Laravelでの開発スピードを上げることを目的に作成したボイラーテンプレートです。

## テストの実行
基本的には下記の名前がついたブランチにpushすると、Github Actionsが自動的にテストを行います
- feature/**
- fix/**
- bug/**  
- refact/**

pushをすると、Larastan(PHPUnit)を用いたテストの他に静的解析を行うPHPStan、コードフォーマッターのPHP Cs Fixerも自動的に実行されます

何かコードに不備があった場合やテストが通らなかった場合、PR画面下部にその旨が出力されるので、修正したのち再度pushしてください

### 補足：手動でテストを実行する方法
下記Makeコマンドを実行すると、Githubにpushをする前に手動でテストや静的解析、コードフォーマットを実行させることが可能です

#### Laravelのテストを実行
```
$ make test 
```
#### 静的解析を実行
```
$ make stan
```
#### コードフォーマッターを実行
```
　$ make cs
```
## コンテナの構造

```
docker
   ├── app
   ├── web
   └── db
```

### appコンテナ
- Base image
  -  [php](https://hub.docker.com/_/php):8.1.14-fpm-bullseye
  -  [composer](https://hub.docker.com/_/composer):2.4.4

### webコンテナ
- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.23

### dbコンテナ
- Base image
  - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0.31

### pmaコンテナ
- Base image
  - [phpmyadmin/phpmyadmin](https://hub.docker.com/_/phpmyadmin):5.2.0

## Requirement
- composer 2.4.4
- mysql 8.0.31
- nginx 1.23
- php 8.1.14
- laravel 9.47.0
- laravel-sanctum 3.2.0
