<?php
$file = fopen($_FILES['archivos']['tmp_name'], 'r');
 
while (!feof($file)) {
    $data[] = fgetcsv($file,null,';');
}

$headers = explode(',', $data[0][0]);
$headers[] = "Temperatura";

$body = array();

for ($i=1; $i < count($data); $i++) { 
    $completos = explode(',', $data[$i][0]);
    $strTmp = "";
    $arryTmp = array();
    foreach ($completos as $key => $value) {
        if(!is_numeric(strpos($value, '"'))){
            if($strTmp == ""){
                $arryTmp[] = $value;
            }else{
                $strTmp .= ',' . $value;
            }
        }else{
            if($strTmp == "")
                $strTmp = str_replace('"', '', $value);
            else{
                $strTmp .= ',' . str_replace('"', '', $value);
                $arryTmp[] = $strTmp;
                $strTmp = "";
            }
        }
    }
    $body[] = $arryTmp;
}

$json = array(
    'headers' => $headers,
    'body' => $body
);

echo json_encode($json);