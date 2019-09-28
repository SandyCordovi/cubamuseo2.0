<?php

class CUI_Search
{
    function __construct()
    {

    }

    function Search($q)
    {
        try
        {
            return $this->ProcesaQuery($q);

        }
        catch (Exception $e)
        {
            return "";
        }
    }

    function ProcesaQuery($txt)
    {
        if ($txt=="")return "";
        $query = "";
        $txt = trim($txt);        
        $txt = preg_replace('/"/', ' " ', $txt) ;
        $txt = preg_replace('/\'/', ' " ', $txt) ;
        $txt = preg_replace("/\(/", " ( ", $txt) ;
        $txt = preg_replace("/\)/", " ) ", $txt) ;
        //$txt = preg_replace("/and/", " ", $txt) ;
        //$txt = preg_replace("/or/", " ", $txt) ;
        $txt = trim($txt);
        $txt = preg_split('/ /', $txt);
        $temp = array ();
        for($i=0; $i<count($txt); $i++)
        {
            if ($txt[$i]!="") {
                $temp[count($temp)] = $txt[$i];
            }
        }
        $txt_compact = array();
        $stack = array();
        $va=0;
        $cad="";
        for($i=0; $i<count($temp); $i++)
        {
            if($temp[$i]=='"' && $va==0)
            {                
                $va++;
            }
            else if ($va>0 && $temp[$i]!='"') {
                $cad.=$temp[$i].' ';
            }
            else if ($va>0 && $temp[$i]=='"') {
                $cad = trim($cad);
                $txt_compact[count($txt_compact)] = $cad;
                $va=0;
                $cad="";
            }
            else {
                $txt_compact[count($txt_compact)] = $temp[$i];
            }
        }

        $txt_final=array();
        $va=0;
        for($i=0; $i<count($txt_compact)-1; $i++)
        {           
            if (($txt_compact[$i]!="or" && $txt_compact[$i]!="and" && $txt_compact[$i]!="(") && ($txt_compact[$i+1]!="or" && $txt_compact[$i+1]!="and" && $txt_compact[$i+1]!=")")) {
                $txt_final[$va] = $txt_compact[$i];
                $va++;
                $txt_final[$va]='and';
                $va++;
            }
            else
            {
                $txt_final[$va] = $txt_compact[$i];
                $va++;
            }
        }
        $txt_final[$va]  = $txt_compact[count($txt_compact)-1];

        for($i=0; $i<count($txt_final); $i++)
        {
            if ($txt_final[$i]!="or" && $txt_final[$i]!="and" && $txt_final[$i]!="(" && $txt_final[$i]!=")") {
                $query.="(titulo like '%". utf8_encode($txt_final[$i])."%' or news like '%". utf8_encode($txt_final[$i])."%' or news.by like '%". utf8_encode($txt_final[$i])."%' or categoria=".$this->getNumByCategoriaName(utf8_encode($txt_final[$i])).") ";
            }
            else {
                $query.=$txt_final[$i]." ";
            }
        }

         if (count($txt_final)==1 && (int)$txt_final[0] ) {
            $query="id=".$txt_final[0]." ";
        }

        return '('.$query.')';
    }

    function getNumByCategoriaName($txt)
    {
        $txt = strtolower($txt);

        switch ($txt) {
        case "turismo":
            return 1;
            break;
        case "deporte":
            return 2;
            break;
        case "economia":
            return 3;
            break;
        case "ciencia_salud":
            return 4;
            break;
        case "cultura":
            return 5;
            break;
        default:
            return "0";
            break;
    }

    }
}

?>
