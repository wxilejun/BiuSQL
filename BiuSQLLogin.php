<?php
    // 不提示错误信息
    error_reporting(0);

    // 数据库
    include 'BiuSQL.php';

    /* 方法 */
    // 登录系统
    function login () {
        if ($_POST['username'] != null) {
            echo "<script>console.log('账号:ok');</script>";
            if ($_POST['password'] != null) {
                echo "<script>console.log('密码:ok');</script>";
                if ($_POST['verificationcode'] == $_COOKIE['yanZhengMa']) {
                    echo "<script>console.log('验证码:ok');</script>";
                    $BiuSQL = new BiuSQL;
                    $path = './BiuSQLConfig.biu';
                    $line = $BiuSQL->readLine($path);
                    $list = $BiuSQL->readList($line);
                    for ($i = 0; $i < count($list['array']); $i ++) {
                        $array = [];
                        $int = 0;
                        if ($_POST['username'] == $list['array'][$i][0]) {
                            if ($_POST['password'] == $list['array'][$i][1]) {
                                setcookie('userName', $_POST['username'], 0);
                                header('Location: ./BiuSQLConsole.php');
                            }
                        }
                    }
                }
            }
        }    
    }

    function start () {
        login(); // 登录系统
    }
    /* 方法 */

    start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>请先登录</title>

    <!-- 样式 -->
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
        }

        body {
            font-size: 15px;
            font-weight: 200;
            position: relative;
        }

        header {
            box-shadow: 0 2px 10px #dddddd;
            height: 60px;
            line-height: 60px;
        }

        .right {
            width: 50%;
            position: absolute;
            right: 0;
            color: #000000;
            height: 60px;
            text-align: right;
        }

        .right-title {
            margin: 0 20% 0 0;
            font-weight: 200;
        }

        .left {
            width: 50%;
            /* background-color: #000000; */
            color: #000000;
            height: 60px;
        }

        .left-title {
            margin: 0 0 0 20%;
            font-size: 20px;
            font-weight: 200;
        }

        .blockLayout {
            width: 70%;
            margin: 0 auto;
        }

        .padding {
            padding: 10px;
        }

        .padding-top-20 {
            padding-top: 20px;
        }

        .margin {
            margin: 10px;
        }

        .form {
            /* text-align: center; */
        }

        .form span {
            display: block;
            padding: 10px;
            width: 80%;
            display: block;
            margin: 0 auto;
        }

        .form input {
            border: none;
            background-color: transparent;
            border: 1px solid #dddddd;
            margin-top: 20px;
            display: block;
            padding: 10px;
            width: 80%;
            margin: 0 auto;
        }

        .form div {
            text-align: center;
            padding: 10px;
        }

        .form img {
            border-radius: 10px;
            box-shadow: 0 2px 10px #000000;
        }
    </style>

    <!-- 框架 -->
    <link rel="stylesheet" href="./css/css/layui.css">
</head>
<body>

    <header>
        <div class="right">
            <span class="right-title">作者</span>
        </div>
        <div class="left">
            <span class="left-title">BiuSQL</span>
        </div>
    </header>

    <div class="blockLayout padding padding-top-20">
        <form action="./BiuSQLLogin.php" method="POST" class="form">
            <span>账号</span>
            <input type="text" placeholder="账号" name="username">
            <span>密码</span>
            <input type="password" placeholder="密码" name="password">
            <span>验证码</span>
            <div>
                <img src="./verificationcode.php" alt="">
            </div>
            <input type="text" placeholder="验证码" name="verificationcode">
            <div>
                <button class="layui-btn layui-btn-normal">登录</button>
            </div>
        </form>
    </div>

    <script src="./css/layui.js"></script>
</body>
</html>