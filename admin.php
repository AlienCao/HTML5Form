<?php
    $action = $_GET["action"];
    $c_n    = $_GET["c_n"];
    $dtflg    = $_GET["dtflg"];
    if($dtflg == '1'){
	 $title = '党章知识竞赛名单';
    }elseif($dtflg == '2'){
	 $title = '团章知识竞赛名单';
    }
    $con = mysql_connect("localhost", "root", "09zasdcx");
    if (!$con){
       die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("jx09backup",$con);
    $sql_1    = "SELECT count(*) as count FROM dform";
    $result_1 = mysql_query($sql_1);
    while ($row_1 = mysql_fetch_array($result_1)){
            $bigCount = $row_1["count"];
    }
    $page      = $_GET["page"] ? $_GET["page"] : "1";
    $page_size = '10';
    $start = (intval($page)-1)*intval($page_size);
    $end   = intval($page_size);
    $limit = "LIMIT $start,$end";
    $sql = "SELECT * FROM dform WHERE dtflg = $dtflg ORDER BY date DESC  $limit";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)){
        $res['dname'] = $row["dname"];
        $res['dtel']       = $row["dtel"];
        $res['did']        = $row["did"];
	$res['dgroup']        = $row["dgroup"];
	$res['dadd']        = $row["dadd"];
	$res['score']        = $row["score"];
	$res['date']        = $row["date"];
	$results[] = $res;
    }
    if ($action == "del") {
        $upSql_2 = "UPDATE jx09_channel_num SET flag = '1' WHERE channel_num =".$c_n;   
        mysql_query($upSql_2);
	    $refurl = $_SERVER['HTTP_REFERER'];
        echo "<script>location.href=\"$refurl\";</script>"; 
    }
    if ($action == 'print') {
        header('Content-Type: application/vnd.ms-excel');
        header('Cache-Control: max-age=0');
	$fp = fopen('php://output', 'a');
        $head = array(iconv("UTF-8", "GB2312//IGNORE", '姓名'), iconv("UTF-8", "GB2312//IGNORE", '电话'), iconv("UTF-8", "GB2312//IGNORE", '身份证'), iconv("UTF-8", "GB2312//IGNORE", '所在党组织（团组织）'), iconv("UTF-8", "GB2312//IGNORE", '所在支部'), iconv("UTF-8", "GB2312//IGNORE", '得分'), iconv("UTF-8", "GB2312//IGNORE", '添加时间'));
        foreach ($head as $i => $v) {
            $head[$i] = $v;
        }
        fputcsv($fp, $head);
        $sql = "SELECT * FROM dform WHERE dtflg = $dtflg ORDER BY date DESC";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)){
            $res['dname'] = mb_convert_encoding(urldecode($row["dname"]),"GBK","UTF-8");
	    $res['dtel']  = $row["dtel"];
	    $res['did']   = $row["did"];
	    $res['dgroup'] = mb_convert_encoding(urldecode($row["dgroup"]),"GBK","UTF-8");
	    $res['dadd']  = mb_convert_encoding(urldecode($row["dadd"]),"GBK","UTF-8");
	    $res['score'] = $row["score"];
	    $res['date']  = $row["date"];
	    fputcsv($fp, $res);
        }
        header('Content-Disposition: attachment;filename=result.csv');
	exit();
    }
    mysql_close($con);
    //$count为总条目数，$page为当前页码，$page_size为每页显示条目数<br />
    function show_page($count,$page,$page_size,$dtflg){
        $page_count  = ceil($count/$page_size);  //计算得出总页数    
        $init=1;
        $page_len=7;
        $max_p=$page_count;
        $pages=$page_count;
        //判断当前页码
        $page=(empty($page)||$page<0)?1:$page;
        //获取当前页url
        $url = "http://cs.jx09.com/jx09source/html/201508contest/admin.php";
        //去掉url中原先的page参数以便加入新的page参数
        $parsedurl=parse_url($url);
        $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
        if($url_query != ''){
            $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
            $url = str_replace($parsedurl['query'],$url_query,$url);
            if($url_query != ''){
                $url .= '&';
            }
        } else {
            $url .= '?';
        }
        //分页功能代码
        $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
        $pageoffset = ($page_len-1)/2;  //页码个数左右偏移量
        $navs='';
        if($pages != 0){
            if($page!=1){
                $navs.="<a href=\"".$url."page=1&dtflg=$dtflg\">首页</a> ";        //第一页
                $navs.="<a href=\"".$url."page=".($page-1)."&dtflg=$dtflg"."\">上页</a>"; //上一页
            } else {
                $navs .= "<span class='disabled'>首页</span>";
                $navs .= "<span class='disabled'>上页</span>";
            }
            if($pages>$page_len)
            {
                //如果当前页小于等于左偏移
                if($page<=$pageoffset){
                    $init=1;
                    $max_p = $page_len;
                }
                else  //如果当前页大于左偏移
                {    
                    //如果当前页码右偏移超出最大分页数
                    if($page+$pageoffset>=$pages+1){
                        $init = $pages-$page_len+1;
                    }
                    else
                    {
                        //左右偏移都存在时的计算
                        $init = $page-$pageoffset;
                        $max_p = $page+$pageoffset;
                    }
                }
            }
            for($i=$init;$i<=$max_p;$i++)
            {
                if($i==$page){$navs.="<span class='current'>".$i.'</span>';} 
                else {$navs.=" <a href=\"".$url."page=".$i."&dtflg=$dtflg"."\">".$i."</a>";}
            }
            if($page!=$pages)
            {
                $navs.=" <a href=\"".$url."page=".($page+1)."&dtflg=$dtflg"."\">下页</a> ";//下一页
                $navs.="<a href=\"".$url."page=".$pages."&dtflg=$dtflg"."\">末页</a>";    //最后一页
            } else {
                $navs .= "<span class='disabled'>下页</span>";
                $navs .= "<span class='disabled'>末页</span>";
            }
            echo "$navs";
       }
    }
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>后台管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link href="css/bootstrap.min.css"    rel="stylesheet" type="text/css"/>
    <link href="css/style-metronic.css" rel="stylesheet" type="text/css"/>
</head>
<body class="page-header-fixed">
<div class="page-container">
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
<div class="col-md-12">
	<h3 class="text-center"><?php echo $title ?></h3>
    <table class="table table-hover">
        <thead class="flip-content">
        <tr>
            <th>姓名</th>
            <th>电话</th>
            <th>身份证</th>
            <th>所在党组织（团组织）</th>
	    <th>所在支部</th>
	    <th>得分</th>
	    <th>添加时间</th>
            <!--<th>操作</th>-->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $key => $value) {?>
            <tr>
                <td><?php echo urldecode($value['dname']) ?></td>
		<td><?php echo $value['dtel'] ?></td>
		<td><?php echo $value['did'] ?></td>
		<td><?php echo urldecode($value['dgroup']) ?></td>
		<td><?php echo urldecode($value['dadd']) ?></td>
		<td><?php echo $value['score'] ?></td>
		<td><?php echo $value['date'] ?></td>
                <!--<td>
                    <a class="btn btn-primary" onclick="return confirm('确定要删除吗？删除后无法恢复！')" href="?action=del&c_n=<?php echo $value ?>">删除</a>
                </td>-->
            </tr>
        <?php }?>
        </tbody>   
        </table>
        <div style="width:100%;text-align:center;font-size: 20px;">
            <?php show_page($bigCount,$page,$page_size,$dtflg) ?>
            <a href="?action=print&dtflg=<?php echo $dtflg?>">打印</a>
        </div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
</body>
<!-- END BODY -->
</html>