<?php
    // BiuSQL开发者: XLJ (xlj0.com/xlj@xlj0.com)
    // 不提示错误信息
    error_reporting(0);
    
    // 类/方法
    class BiuSQL {
        public $name = ['BiuSQL'];
        public $version = ['1.0'];
        
        // 读取行数据
        public function readLine ($path) {
            $file = fopen($path, 'r+');
            $array = [];
            $int = 0;
            while (($Buffer = fgets($file, (10240 * 10000))) == true) {
                $array[] = $Buffer;
                $int ++;
            }
            fclose($file);
            return ['array' => $array, 'int' => $int];
        }
        // 读取列数据
        public function readList ($info) {
            $array = [];
            $int = 0;
            for ($i = 0; $i < $info['int']; $i ++) {
                $list = explode("////", $info['array'][$i]);
                $array[] = $list;
                $int ++;
            }
            return ['array' => $array, 'int' => $int];
        }
        // 找数据功能
        // @ secode = null(只查询一次)/true(查询到最后)
        public function select ($list, $readInfo, $secode = null, $readList) {
            switch ($secode) {
                case true:
                    $int = 0;
                    $array = [];
                    for ($i = 0; $i < $list['int']; $i ++) {
                        if ($readInfo == $list['array'][$i][$readList]) {
                            $int ++;
                            $array[] = $list['array'][$i][$readList];
                            // return [$list['array'][$i][0], $int];
                        }
                    }
                    return ['array' => $array, 'int' => $int];
                    break;
                case null:
                    $int = 0;
                    $array = [];
                    for ($i = 0; $i < $list['int']; $i ++) {
                        if ($readInfo == $list['array'][$i][$readList]) {
                            $int ++;
                            $array[] = $list['array'][$i][$readList];
                            // return [$list['array'][$i][0], $int];
                            return ['array' => $array, 'int' => $int];
                        }
                    }
                    break;
            }
        }
        // 读所有列数据功能
        public function list ($list, $lint) {
            $array = [];
            $int = 0;
            for ($i = 0; $i < count($list['array']); $i ++) {
                $array[] = $list['array'][$i][$lint];
                $int ++;
            }
            return ['array' => $array, 'int' => $int];
        }
        // 写入数据功能
        public function insert ($line, $insertText, $path) {
            $line_length = explode("////", $line['array'][0]);
            $length = count($line_length);
            $info_length = count(explode("////", $insertText));
            if ($length == ($info_length + 1)) {
                $array = $line['array'];
                $array[] = "\r\n".$insertText.'////return';
                $text = implode($array);
                // var_dump($text);
                // var_dump($array);
                $file = fopen($path, 'w+');
                fwrite($file, $text);
                fclose($file);
                return true;
            }
        }
        // 修改数据功能
        public function update ($line, $lint, $text, $updatetext, $path) {
            $array = [];
            $int = 0;
            // $info = $list['array'];
            for ($i = 0; $i < count($line['array']); $i ++) {
                $list = explode("////", $line['array'][$i]);
                // var_dump($list);
                if ($text == $list[$lint]) {
                    // var_dump($list[$lint]);
                    $info = $line['array'];
                    // $line['array'][$i] = $updatetext."\r\n";
                    if ($line['array'][$i + 1] == null) {
                        $line['array'][$i] = $updatetext;
                    } else {
                        $line['array'][$i] = $updatetext."\r\n";
                    }
                    // var_dump($line['array']);
                    $file = fopen($path, 'w');
                    $text = implode($line['array']);
                    // var_dump($text);
                    fwrite($file, $text);
                    fclose($file);
                    return true;
                }
            }
        }
        // 删除数据功能
        public function delete ($line, $text, $lint, $path) {
            $array = [];
            $int = 0;
            for ($i = 0; $i < count($line['array']); $i ++) {
                $info = explode("////", $line['array'][$i]);
                if ($text == $info[$lint]) {
                    // var_dump($line['array']);
                    unset($line['array'][$i]);
                    // var_dump($line['array']);
                    $infoText = implode($line['array']);
                    // var_dump($infoText);
                    $file = fopen($path, 'w');
                    fwrite($file, $infoText);
                    fclose($file);
                    return true;
                }
            }
        }
        // 版权
        public function v () {
            // echo $this->name;
            echo "<script>console.log('%cBiuSQL:V1.0:准备就绪', 'color: #ff0000;');</script>";
            /* 版权归属于 XLJ 所有 */
        }
    }
    // 类/方法
?>