<?php
function sql($string, $int = FALSE) {
	return $int ? preg_replace("/(\D)/i" , "" , $string) : mysql_real_escape_string(strip_tags($string));
}

function cod($value) {
	return base64_encode(pack('H*', sha1($value)));
}


function simpleXMLToArray($xml,
                    $flattenValues=true,
                    $flattenAttributes = true,
                    $flattenChildren=true,
                    $valueKey='@value',
                    $attributesKey='@attributes',
                    $childrenKey='@children'){

        $return = array();
        if(!($xml instanceof SimpleXMLElement)){return $return;}
        $name = $xml->getName();
        $_value = trim((string)$xml);
        if(strlen($_value)==0){$_value = null;};

        if($_value!==null){
            if(!$flattenValues){$return[$valueKey] = $_value;}
            else{$return = $_value;}
        }

        $children = array();
        $first = true;
        foreach($xml->children() as $elementName => $child){
            $value = simpleXMLToArray($child, $flattenValues, $flattenAttributes, $flattenChildren, $valueKey, $attributesKey, $childrenKey);
            if(isset($children[$elementName])){
                if($first){
                    $temp = $children[$elementName];
                    unset($children[$elementName]);
                    $children[$elementName][] = $temp;
                    $first=false;
                }
                $children[$elementName][] = $value;
            }
            else{
                $children[$elementName] = $value;
            }
        }
        if(count($children)>0){
            if(!$flattenChildren){$return[$childrenKey] = $children;}
            else{$return = array_merge($return,$children);}
        }

        $attributes = array();
        foreach($xml->attributes() as $name=>$value){
            $attributes[$name] = trim($value);
        }
        if(count($attributes)>0){
            if(!$flattenAttributes){$return[$attributesKey] = $attributes;}
            else{$return = array_merge($return, $attributes);}
        }
       
        return $return;
    }
	
	

function random ($numofletters) { 
    if (!isset($numofletters)) $numofletters = 15; 
    $literki = array('1', '2', '3', '4', '5', '6', '7', '8', '9'); 
    $ilosc_literek = count($literki); 
    for ($licz = 0; $licz < $numofletters; $licz++) { 
    $rand = rand(0, $ilosc_literek-1); 
    $vercode = $vercode.$literki[$rand]; 
    } 
	return $vercode;
}


?>