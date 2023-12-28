# 影评系统（mrs）后端

## 项目介绍

这学期修了一门叫《用HTML5 和 PHP编写JavaScript，jQuery 和 AJAX脚本》的 web 课（对，听起来很奇怪的名字）。期末大作业是写一个影评系统，前端允许使用框架，后端仅允许使用 php，具体的作业要求如下

> 1、制作一个电影评价系统（参考豆瓣电影），要求包含电影查找，电影介绍、评分和评论展示，用户注册、登陆、评论、评分等功能。用户分管理员用户和普通注册用户。管理员可对普通用户、电影介绍和评论进行管理（增删改查）。普通用户可以查看电影介绍，对电影评论、评分，管理自己的评论和评分等。其他功能可自由发挥，尽量提高用户体验。
>
> 2、要求界面美观，交互性强：至少有三处以上利用 js 实现的动态效果，必须应用到 ajax；服务器端脚本用 php。
>
> 3、~~三个人一组，实验报告要写清楚每个人的分工和工作量占比。~~（争取到了自己一个人写的机会）
>
> 4、系统演示与答辩。介绍系统功能、特点、实现方法、用到的主要技术等。
>
> 5、上交一份电子稿材料包括技术报告、完整的源代码、以及 sql 数据库备份文件。

## 项目结构

- `index.php`：入口文件，充当路由
- `api/v1`: 
    - `comment`：评论相关
    - `movie`：电影相关
    - `user`：用户相关
- `config/db.php`：数据库配置
- `utils`：工具函数
- `uploads`：用户上传的图片存放路径

## PHP 插件

- `mysqli`：数据库连接

## 前端

前端页面使用 Vue.js 实现，源码地址：[zhullyb/mrs-vue](https://github.com/zhullyb/mrs-vue)

## 数据库创建

```sql
CREATE TABLE `userinfo` (
  `uid` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` int DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `movieinfo` (
  `mid` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(255) NOT NULL COMMENT 'Movie Name',
  `image` varchar(255) DEFAULT NULL COMMENT 'Movie Image',
  `director` varchar(255) DEFAULT NULL COMMENT 'Movie Director',
  `screenwriter` varchar(255) DEFAULT NULL COMMENT 'Movie Screenwriter',
  `mainActor` varchar(2047) DEFAULT NULL COMMENT 'Movie Main Actor',
  `type` varchar(255) DEFAULT NULL COMMENT 'Movie Type',
  `website` varchar(255) DEFAULT NULL COMMENT 'Movie Website',
  `country` varchar(255) DEFAULT NULL COMMENT 'Movie Country',
  `language` varchar(255) DEFAULT NULL COMMENT 'Movie Language',
  `releaseDate` varchar(255) DEFAULT NULL COMMENT 'Movie Release Date',
  `length` varchar(255) DEFAULT NULL COMMENT 'Movie Length',
  `description` text COMMENT 'Movie Description',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `comments` (
  `cid` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `uid` int NOT NULL COMMENT 'User ID',
  `mid` int NOT NULL COMMENT 'Movie ID',
  `comment` varchar(500) NOT NULL COMMENT 'Comment',
  `rate` int NOT NULL COMMENT 'Rating',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created Time',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

## 开发

将 config/db.php.example 复制为 config/db.php，修改其中的数据库配置，使用如下命令启动 php 内置服务器

```bash
php -S localhost:8080 index.php
```

## 部署

### Docker

#### 镜像构建

```bash
docker build -t mrs-php .
```

#### 容器运行

```bash
docker run -d \
    -p 8080:80 \
    --name mrs-php \
    -v /path/to/uploads:/var/www/html/uploads \
    --restart unless-stopped \
    mrs-php
```

### nginx、caddy + php-fpm

请自行尝试，务必将流量转发到 `index.php`，否则路由将失效。可参考 OneManager-php 中的 [.htaccess 文件](https://github.com/qkqpttgf/OneManager-php/blob/master/.htaccess)中被注释的部分。

***

本项目使用 [GLWTPL](./LICENSE) 协议开源，祝你好运。