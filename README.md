### BiuSQL
BiuSQL 是一个基于 PHP 高级编程语言开发的一款数据库系统，也是 XLJ 首个开发的数据库系统，Yiso搜索引擎选用 BiuSQL 作为 Yiso搜索引擎 的数据库系统，BiuSQL 她的性格就是快

> 关于 BiuSQL
> 整包大小 < 10KB<br>
> 索引数据 = 1000w/500ms (速度因磁盘速度而改变)<br>
> 语法结构 : 采用算法式执行 (解释语言的特点)，无SQL语句 (体现它的轻便)<br>
> 数据表结构 : 将采用图形化可视化操作 (更加容易上手)<br>
> 数据模式 : rwud (read write update delete) 模式 也就是增删改查<br>
> 特点总结 : BiuSQL以磁盘信息进行 IO 操作，这对于内存不大的用户来说简直是对抗高并发的武器<br>
> 数据采用自动回收系统，不用担心会有负载问题
> 采用 >= PHP 7.0 开发，请使用7.0或以上版本使用BiuSQL

当然 BiuSQL 也有不足的地方，BiuSQL 基于 MIT 开源协议，如果使用过程中出现问题或者提供一些建议可以致信 xlj@xlj0.com

BiuSQL控制台
![01][1]

### 项目结构
#### 文件结构
> ./css -静态资源<br>
> ./database -数据库文件<br>
> ./BiuSQL -BiuSQL功能核心<br>
> ./BiuSQLConfig.php -数据库控制台账号密码 (账号////密码)<br>
> ./BiuSQLConsole.php -数据库控制台<br>
> ./BiuSQLLogin.php -数据库控制台登录<br>
> ./verificationcode.php -验证码功能<br>

#### 数据表结构
BiuSQL使用的是 x,y 型数据定位，x顾名思义就是数学里的纵轴，y就是数学里的横轴
x代表的是行，y代表的是列，按照几行几列的方法去定位数据位置

比如数据内容是这样的
那么这个数据表就有 2行，2列数据，要定位到BiuSQL 找定位，数据在第一行第一列，那么就是 x,y = 1,1
是这样吗，不是的
在计算机里起步数是 0
所以正确定位到这个数据是 x,y = 0,0
> BiuSQL////SQL<br>
> XLJ////zuozhe

### 开始使用
下载 [BiuSQL.php][2] 并把文件放到项目文件夹

让我们来继续了解它
初始化并连接数据库只需要以下指令
$path 是 数据库文件地址
```php
// 初始化
include 'BiuSQL.php';
$BiuSQL = new BiuSQL;
// 连接数据库
$path = './BiuSQL/biusql.biu';
$line = $BiuSQL->readLine($path);
$list = $BiuSQL->readList($line);
```

到这一步就已经完成了，可以开始进行数据库数据操作了
#### **查询数据**
> $list (传入readList()方法的数据)<br>
> $readInfo (要搜索的内容 例如: "BiuSQL")<br>
> $secode (查询次数) 不填写默认为 null 只查询一条，如果填写 true 则查询到底<br>
> $readList (查询的数据表列数)<br>
> 返回值 ['array', 'int'] (array) 数据 / (int) 数据数量<br>
```php
$select = $BiuSQL->select($list, $readInfo, $secode = null, $readList);
```

#### **写入数据**
> $line (传入readLine()方法的数据)<br><br>
> $insertText (写入的数据信息)<br>
> $path (数据库地址)<br>
> 返回值 true (数据操作成功)<br>
```php
$insert = $BiuSQL->insert($line, $insertText, $path);
```

#### **修改数据**
> $line (传入readLine()方法的数据)<br>
> $lint (数据表列数)<br>
> $text (要修改的内容)<br>
> $updatetext (修改后的内容)<br>
> $path (数据库文件地址)<br>
> 返回值 true (数据操作成功)<br>
```php
$update = $BiuSQL->update($line, $lint, $text, $updatetext, $path);
```

#### **删除数据**
> $line (传入readLine()方法的数据)<br>
> $text (要删除的内容)<br>
> $lint (要删除内容的数据库表列数)<br>
> $path (数据库文件地址)<br>
> 返回值 true (数据操作成功)<br>
```php
$delete = $BiuSQL->delete($line, $text, $lint, $path);
```


  [1]: https://xlj0.com/usr/uploads/2022/06/1468934152.png
  [2]: https://gitee.com/wxilejun/BiuSQL/blob/master/BiuSQL.php
