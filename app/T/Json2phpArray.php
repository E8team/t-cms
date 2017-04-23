<?php
/**
 * 将Json文件转为php数组文件
 * author: taoyu
 * Date: 2017/3/29 0029
 * Time: 下午 5:21
 */

namespace App\T;


class Json2phpArray
{

    public static function convert($inFileName, $outFileName)
    {
        if (!file_exists($inFileName)) {
            trigger_error($inFileName . ' 文件不存在!');
        }

        $data = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($inFileName)), true);
        $str = '';
        self::printArray($data, $str);
        file_put_contents($outFileName, "<?php\nreturn {$str};");
    }

    public static function printArray(array $data, &$str = '', $level = 0)
    {
        $str .= "[\n";
        $i = 0;
        foreach ($data as $k => $v) {
            $str .= str_repeat("\t", $level + 1);

            if ($i !== $k) {
                if (is_numeric($k)) {
                    $str .= $k;
                } else {
                    $str .= "'$k'";
                }

                $str .= ' => ';
            }
            if (is_array($v)) {
                self::printArray($v, $str, $level + 1);
            } else if (is_numeric($v)) {
                $str .= $v;
            } else {
                $str .= "'$v'";
            }
            $str .= ", \n";
            $i++;
        }

        $str .= str_repeat("\t", $level);
        $str .= ']';
    }
}