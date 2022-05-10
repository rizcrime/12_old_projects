
<?php

 require_once("runQuery.php");
 $auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
 $step = "Step: Evaluasi by Eselon 3";
 $result = getTaskListByStep($auth,$step);

 function renderTasklist($array){
    // start table
    $html = '<table class="blueTable">';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '<th>Action</th>';    
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';

          if($key2=="instanceId") $instanceId = $value2;
          if($key2=="taskId") $taskId = $value2;
        }
        $html .= '<td><a href="formEselon3.php?instanceId='.$instanceId.'&taskId='.$taskId.'">Proses</a></td>';
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
  }

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<H1>Worklist Eselon 3</h1>
<?php

  if (count($result->taskList) > 0){
     echo renderTasklist($result->taskList);
  }

?>
</body>
</html>