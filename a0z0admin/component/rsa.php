<?php
class cuiRSA
{
    public function encrypt($p)
    {
        $p=utf8_encode($p);
        $max = strlen($p);
        $code='';
        $rnd = rand(10000, 99999);
        for($i=0; $i<$max; $i++)
        {
            $asc=ord($p[$i]);
            $x=$this->f($asc, $rnd);
            $code.=$x."*";
        }
        return $code.$rnd;
    }

    public function decrypt($c)
    {
        $decoded='';
        $mysplit = explode("*", $c);
        $rnd = $mysplit[count($mysplit) - 1];
        for($i=0;$i<count($mysplit)-1;$i++)
        {
            $decoded .= chr($this->fi($mysplit[$i], $rnd));
        }
        return $decoded;
    }

    function f($n, $rnd)
    {
        return pow($n, 2)+$rnd-55;
    }

    function fi($n, $rnd)
    {
        return sqrt($n + 55 - $rnd);
    }
}
?>
