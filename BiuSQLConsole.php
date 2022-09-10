<?php
    // 不提示错误信息
    error_reporting(0);

    /* 方法 */
    // 登录检测系统
    function loginIf () {
        if ($_COOKIE['userName'] == null) {
            header('Location: ./BiuSQLLogin.php');
        }
    }

    // 读取数据库目录功能
    function readDatabasePath () {
        $path = './database';
        $scandir = scandir($path);
        return $scandir;
    }

    // 显示数据库目录功能
    function showDatabasePath ($readDatabasePath) {
        for ($i = 0; $i < count($readDatabasePath); $i ++) {
            if ($readDatabasePath[$i + 2] != null) {
                echo "<a href=\"BiuSQLConsole.php?filename=./database/".$readDatabasePath[$i + 2]."\"><button class=\"layui-btn layui-btn-normal margin database-name\">".$readDatabasePath[$i + 2]."</button></a>";
            }
        }
    }

    // 显示数据表列数信息
    function showDatabaseList ($path) {
        $file = fopen($path, 'r+');
        $array = [];
        $int = 0;
        while(($Buffer = fgets($file, (1024 * 10000))) == true) {
            $info = explode("////", $Buffer);
            $array[] = $info;
            $int ++;
        }

        for ($i = 0; $i < count($array[0]); $i ++) {
            if ($i == (count($array[0]) - 1)) {
                echo "<th class=\"background-color-th border-top-right-radius box-shadow-th th\">".$i."</th>";
            } else {
                echo "<th class=\"background-color-th box-shadow-th th\">".$i."</th>";
            }
        }
        return ['array' => $array, 'int' => $int];
    }

    // 显示数据表行数信息
    function showDatabaseLine ($path) {
        $file = fopen($path, 'r+');
        $array = [];
        $int = 0;
        while(($Buffer = fgets($file, (1024 * 10000))) == true) {
            $info = explode("////", $Buffer);
            $array[] = $info;
            
            echo "<tr>";
            echo "<td>".$int."</td>";
            for ($i = 0; $i < count($info); $i ++) {
                echo "<td>".$info[$i]."</td>";
            }
            echo "</tr>";
            $int ++;
        }
    }

    // 执行
    function start () {
        loginIf(); // 登录检测系统
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
    <title>BiuSQL - 控制台</title>

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

        .text-align-center {
            text-align: center;
        }

        .text-align-left {
            text-align: left;
        }

        .text-align-right {
            text-align: right;
        }

        .box-shadow {
            box-shadow: 0 2px 10px #dddddd;
        }

        .border-radius {
            border-radius: 2px;
        }

        .position-relative {
            position: relative;
        }

        .height-40 {
            height: 40px;
        }

        .height-60 {
            height: 60px;
        }

        .display-block {
            display: block;
        }

        .blockLayout > .right {
            overflow: auto;
        }

        .blockLayout > .left {
            overflow: auto;
        }

        .blockLayout > .left > span {
            overflow: auto;
        }

        .white-space {
            white-space: nowrap;
        }

        .width-45 {
            width: 45%;
        }

        .margin-left-5 {
            margin-left: 5%;
        }

        .margin-right-5 {
            margin-right: 5%;
        }

        .padding-top-bottom-10 {
            padding: 10px 0;
        }

        .height-100 {
            height: 100px;
        }

        .height-90 {
            height: 90%;
        }

        table {
            width: 100%;
            box-shadow: 0 2px 10px #dddddd;
            border-radius: 10px;
            height: 100px;
            overflow: auto;
            background-color: rgb(36 119 253 / 26%);
        }

        tr {
            /* border: 1px solid #dddddd; */
        }

        th {
            padding: 10px !important;
            background-color: #ffffff !important;
        }

        td {
            text-align: center;
            padding: 10px !important;
        }

        .overflow-auto {
            overflow: auto;
        }

        .background-transparent {
            background-color: transparent;
        }

        .background-color-white {
            background-color: white;
        }

        .border-top-left-radius {
            border-top-left-radius: 10px;
        }

        .border-top-right-radius {
            border-top-right-radius: 10px;
        }

        .background-color-th {
            background-color: #ff8d8dd9 !important;
        }

        .box-shadow-th {
            box-shadow: 0 2px 10px #ff8d8dd9;
        }

        .box-shadow-td {
            box-shadow: 0 2px 10px rgb(36 119 253 / 26%);
        }
    </style>

    <!-- 框架 -->
    <link rel="stylesheet" href="./css/css/layui.css">
</head>
<body>

    <header>
        <div class="right height-60">
            <a href="https://xlj0.com"><span class="right-title">作者</span></a>
        </div>
        <div class="left height-60">
            <span class="left-title">BiuSQL</span>
        </div>
    </header>

    <div class="blockLayout padding text-align-right">
        <span>欢迎您: <?php if ($_COOKIE['userName'] == 'xlj') {echo "我的主人是 XLJ~!";} else {echo $_COOKIE['userName'];} ?></span>
    </div>

    <div class="blockLayout position-relative box-shadow padding-top-bottom-10">
        <div class="right text-align-center width-45 margin-right-5 height-90">
            <span>操作数据库</span>
            <span class="display-block">请把数据库文件放到 ./database/ 下</span>
            <div class="overflow-auto height-100">
                <?php $readDatabasePath = readDatabasePath(); showDatabasePath($readDatabasePath); ?>
            </div>
        </div>
        <div class="left width-45 margin-left-5">
            <?php
                include './BiuSQL.php';
                $BiuSQL = new BiuSQL;
            ?>
            <span class="display-block">数据库信息</span>
            <span class="display-block">数据库: <?php echo $BiuSQL->name[0]; ?></span>
            <span class="display-block">版本号: <?php echo $BiuSQL->version[0]; ?></span>
            <span class="display-block">地址: <?php echo $_SERVER['SCRIPT_FILENAME'] ?></span>
            <span class="display-block">计算机: <?php echo $_SERVER['SERVER_NAME'] ?></span>
            <span class="display-block">端口: <?php echo $_SERVER['SERVER_PORT'] ?></span>
            <span class="display-block">PHP版本: <?php echo phpversion(); ?></span>
        </div>
    </div>

    <div class="blockLayout padding">

    </div>

    <div class="blockLayout padding box-shadow border-radius overflow-auto">
        <div class="overflow-auto">
            <table class="margin">
                <tr class="background-transparent">
                    <th class="border-top-left-radius x-y" style="box-shadow: 0 2px 10px #ffffff;">x/y</th>
                    <?php $showDatabaseList = showDatabaseList($_GET['filename']); ?>
                </tr>
                <?php showDatabaseLine($_GET['filename']); ?>
            </table>
        </div>
    </div>

    <script>
        var xy = document.getElementsByClassName('x-y');
        var info = document.getElementsByClassName('th');
        
        if (info[0] == null) {
            xy[0].innerText = '请先选择数据表';
        }
    </script>

    <div class="blockLayout padding">

    </div>

    <script src="./css/layui.js"></script>
</body>
</html>