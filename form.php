<?php
 $dtflg = $_GET['dtflg'];
 if($dtflg == '1'){
 	$title = '党章知识竞赛';
	$select = '<option>新丰镇党委</option>
		      <option>余新镇党委</option>
		      <option>凤桥镇党委</option>
		      <option>大桥镇党委</option>
		      <option>七星镇党委</option>
		      <option>东栅街道党工委</option>
		      <option>建设街道党工委</option>
		      <option>新兴街道党工委</option>
		      <option>新嘉街道党工委</option>
		      <option>解放街道党工委</option>
		      <option>南湖街道党工委</option>
		      <option>嘉兴科技城党工委</option>
		      <option>区级机关党工委</option>
		      <option>区公安分局党委</option>
		      <option>区教文体局党委</option>
		      <option>区工商联党委</option>';
 }elseif($dtflg == '2'){
 	$title = '团章知识竞赛';
	$select = '<option>新丰镇团委</option>
		      <option>余新镇团委</option>
		      <option>凤桥镇团委</option>
		      <option>大桥镇团委</option>
		      <option>七星镇团委</option>
		      <option>东栅街道团工委</option>
		      <option>建设街道团工委</option>
		      <option>新兴街道团工委</option>
		      <option>新嘉街道团工委</option>
		      <option>解放街道团工委</option>
		      <option>南湖街道团工委</option>
		      <option>嘉兴科技城团工委</option>
		      <option>区级机关团工委</option>
		      <option>区公安分局团委</option>
		      <option>区教文体局团委</option>
		      <option>区工商联团委</option>';
 }
 $con = @mysql_connect("localhost","root","wiki");
 mysql_select_db("jx09com",$con);
 $tempID = implode(",",NoRand());
  if($dtflg == '1'){
  		$selTitle ="SELECT id,title FROM dang_title WHERE id IN (".$tempID.")";
  }else{
  		$selTitle ="SELECT id,title FROM tuan_title WHERE id IN (".$tempID.")";
  }
 
 $resTitle = mysql_query($selTitle);
while ($row = mysql_fetch_array($resTitle)){
	$tempRow['id']=$row['id'];
	$tempRow['title']=$row['title'];
	$titleArr[]=$tempRow;
}
if($dtflg == '1'){
 	$sel ="SELECT dt.title,ds.id,ds.select,ds.code FROM dang_select as ds LEFT JOIN dang_title as dt ON ds.id = dt.id WHERE ds.id IN (".$tempID.")";
}else{
	$sel ="SELECT dt.title,ds.id,ds.select,ds.code FROM tuan_select as ds LEFT JOIN tuan_title as dt ON ds.id = dt.id WHERE ds.id IN (".$tempID.")";
}
 $resSel = mysql_query($sel);

while ($row = mysql_fetch_array($resSel)){
	$tempSel['code'] = $row['code'];
	$tempSel['id'] = $row['id'];
	$tempSel['select'] = $row['select'];
	$tempSelArr[] = $tempSel;
}
 $temp='';
 for($i=0;$i<count($titleArr);$i++){
 	
 	$temp .= '<div id="panel2" class="panel-body js_answer"  style="display:none;"><dl><dd>';
 	$temp .= ($i+1).'.'.$titleArr[$i]['title'];
 	$temp .= '</dd></dl><ul class="list-group js_group">';
 	for($j=0;$j<count($tempSelArr);$j++){
 		if($titleArr[$i]['id'] == $tempSelArr[$j]['id']){
 			$temp .= '<li class="list-group-item" data-score="';
 			$temp .= $tempSelArr[$j]['code'].'" onclick="return toggle(this);"><i class="glyphicon glyphicon-unchecked"></i>'.$tempSelArr[$j]['select'].'</li>';
 		}
 	}
 	$temp .= '</ul></div>';
 }
$temp .= '<div id="panel3" class="panel-body js_result" data-id="0" style="display:none;">
            <h1 class="bold text-danger"></h1>
            <hr>
            <dl>
                <dt>详细分析:</dt>
                <dd>
                <p>看来对团章知识学习不够，要加倍努力！</p>
                <p style="color:red;">70以下</p>
                </dd>
            </dl>
        </div>
         <div id="panel3" class="panel-body js_result" data-id="1" style="display:none;">
            <h1 class="bold text-danger"></h1>
            <hr>
            <dl>
                <dt>详细分析:</dt>
                <dd>
                <p>刚进入及格线，还需努力!</p>
                <p style="color:red;"></p>
                </dd>
            </dl>
        </div>
        <div id="panel3" class="panel-body js_result" data-id="2" style="display:none;">
            <h1 class="bold text-danger"></h1>
            <hr>
            <dl>
                <dt>详细分析:</dt>
                <dd>
                <p>再接再厉，取得更好成绩！</p>
                <p style="color:red;">90以下</p>
                </dd>
            </dl>
        </div>
        <div id="panel3" class="panel-body js_result" data-id="3" style="display:none;">
            <h1 class="bold text-danger"></h1>
            <hr>
            <dl>
                <dt>详细分析:</dt>
                <dd>
                <p>成绩不错，给予表扬！</p>
                <p style="color:red;">90-100</p>
                </dd>
            </dl>
        </div>
        <div id="panel3" class="panel-body js_result" data-id="4" style="display:none;">
            <h1 class="bold text-danger"></h1>
            <hr>
            <dl>
                <dt>详细分析:</dt>
                <dd>
                <p>恭喜您满分通过！</p>
                <p>100</p>
                </dd>
            </dl>
        </div>'; 
mysql_close($con);
$myfile = fopen("20.php", "w") or die("Unable to open file!");
fwrite($myfile, $temp);
fclose($myfile);
 function NoRand($begin=0,$end=50,$limit=20){ 
	$rand_array=range($begin,$end); 
	shuffle($rand_array);//调用现成的数组随机排列函数 
	return array_slice($rand_array,0,$limit);//截取前$limit个 
} 
?>