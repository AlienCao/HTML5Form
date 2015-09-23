<?php
    $useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
    if(!strpos($useragent, 'MicroMessenger')){
      //header("Location:http://www.jx09.com/jx09source/test/404.html");
    }
    $dname = $_COOKIE['dname'];
    $dtel = $_COOKIE['dtel'];
    $did = $_COOKIE['did'];
    $dgroup = $_COOKIE['dgroup'];
    $dadd = $_COOKIE['dadd'];
   // $dtflg = $_COOKIE['dtflg'];
    $dtflg = '';
    $con = @mysql_connect("localhost","root","wiki");
    if (!$con){
	  die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("jx09",$con);
    //$selSql = "SELECT * FROM dform WHERE did = '".$did."'";
    //$insertSql = "INSERT INTO dform (dname,dtel,did,dgroup,dadd,score,date,dtflg) values ('".$dname."','".$dtel."','".$did."','".$dgroup."','".$dadd."','".$score."','".$date."','".$dtflg."')";
    //$result = mysql_query($selSql);
    //$toWhere = '0';
    //while ($row = mysql_fetch_array($result)){
    //	$towhere = '1';//已经参加过活动的
    //}
    //if($towhere == '1'){
    	//header("Location:http://cs.jx09.com/404/404.html");
    //}
    mysql_close();
    $file_path = "count.txt";
    $file = fopen($file_path,"r+");
    $countOld = file_get_contents($file_path);
    $countNew = $countOld+1;
    fwrite($file,$countNew);
    fclose($file);
    $appId = 'wx63aa13aad0891bf6';
    $appsecret = '2ec6032f647ec0cd3e83f3390be851eb';
    $timestamp = time();
    $jsapi_ticket = make_ticket($appId,$appsecret);
    $nonceStr = make_nonceStr();
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $imgUrl = 'http://cs.jx09.com/jx09source/html/contest/images/share.jpg?20150731';
    $signature = make_signature($nonceStr,$timestamp,$jsapi_ticket,$url);
    function make_nonceStr(){
        $codeSet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i<16; $i++) {
            $codes[$i] = $codeSet[mt_rand(0, strlen($codeSet)-1)];
        }
        $nonceStr = implode($codes);
        return $nonceStr;
    }

    function make_signature($nonceStr,$timestamp,$jsapi_ticket,$url){
        $tmpArr = array(
        'noncestr' => $nonceStr,
        'timestamp' => $timestamp,
        'jsapi_ticket' => $jsapi_ticket,
        'url' => $url
        );
        ksort($tmpArr, SORT_STRING);
        $string1 = http_build_query( $tmpArr );
        $string1 = urldecode( $string1 );
        $signature = sha1( $string1 );
        return $signature;
    }

    function make_ticket($appId,$appsecret){
        $data = json_decode(file_get_contents("access_token.json"));
        if ($data->expire_time < time()) {
            $TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appsecret;
            $ch = curl_init();
            $timeout = 30;
            curl_setopt($ch, CURLOPT_URL, $TOKEN_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($file_contents,true);
            $access_token = $result['access_token'];
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        }else{
            $access_token = $data->access_token;
        }
        $data = json_decode(file_get_contents("jsapi_ticket.json"));

        if ($data->expire_time < time()) {
            $ticket_URL="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
            $ch = curl_init();
            $timeout = 30;
            curl_setopt($ch, CURLOPT_URL, $ticket_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $json = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($json,true);
            $ticket = $result['ticket'];
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen("jsapi_ticket.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        }else{
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes"/>
<title>嘉兴路痴考试</title>
<link href="css/bootstrap.min.css?m=0711" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?2015"/>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<style type="text/css">
    body {
        background: url(images/bg.jpg) repeat-y ;
        background-size:100% auto !important;
    }
</style>
</head>
<div class="container">
    <div class="text-center header">
        <h1 class="bold">嘉兴路痴考试</h1>
        <p>
                    截止到<?php echo date("Y-m-d") ?>日,已有<?php echo $countNew ?>人参与“路痴”考试
        </p>
    </div>
    <div id="bd" class="panel">
        <div id="panel1" class="panel-body">
            <div class="buttons">
             <p>考试说明:</p>
             <p>
    	        1.考试时间：8月13日至8月19日<br/><br/>
    	        2.本次考试共25题，每位考生只要答对13题以上即可进入<span style="color:red;">幸运大转盘</span>参与抽奖<br/><br/>	        
    		    3.每个人可以多次参与考试以获取幸运大转盘资格,但幸运大转盘抽奖机会每人只有一次<br/><br/>
    		    4.希尔顿自助餐券,榨汁机,遮阳伞,自拍杆...奖品多多,赶快来参与吧~<br/>
    	     </p>
	         <p>提示：本活动最终解释权归主办方所有!</p>
                <a href="#result" class="btn btn-lg btn-danger btn-block" onclick="return next(0);">开始考试</a>
            </div>
        </div>
<?php
// if($dtflg == '1'){
// 	$res = mt_rand(1,4);
// }else{
// 	$res = mt_rand(3,4);
// }
include "1.php";
?>
    </div>
</div>
<form action="dform.php" method="POST" id="dform">
    <input type="hidden" id="dname" name="dname" value= <?php echo $dname?>>
    <input type="hidden" id="dtel" name="dtel" value= <?php echo $dtel?>>
    <input type="hidden" id="did" name="did" value= <?php echo $did?>>
    <input type="hidden" id="dgroup" name="dgroup" value= <?php echo $dgroup?>>
    <input type="hidden" id="dadd" name="dadd" value= <?php echo $dadd?>>
    <input type="hidden" id="dtflg" name="dtflg" value= <?php echo $dtflg?>>
    <input type="hidden" id="score" name="score"  value=''>
</form>
<div class="footer text-center navbar-fixed-bottom">
    <div class="container">
        <a href="">&copy;嘉兴第九区</a>
    </div>
</div>
<div class="loads" style="display:bolck"><i></i></div>
<script src="js/zepto.min.js"></script>
<script type="text/javascript">
    var total = '20';    //题目数量
    var tScore = 0;
    var scoreArr = new Array();
        scoreArr[0] = 0;
        scoreArr[1] = 70;
        scoreArr[2] = 80;
        scoreArr[3] = 90;
        scoreArr[4] = 100;

    function next(t){
        $(".panel-body").hide();
        $(".js_answer").eq(t).show();
    }

    function result(t){
        //console.log("得分"+tScore);
        $(".panel-body").hide();
        for (var i = scoreArr.length - 1; i >= 0; i--) {
            if ( parseInt(t) >= parseInt(scoreArr[i]) ) {
                //console.log("应该弹"+i);
                res = '你的分数是' + t + '分';
                $(".text-danger").text(res);
                $(".js_result").eq(i).show();
                return false;
            }else{
                continue;
            }
        };
    }

    function toggle(t){
        $(".list-group-item").removeClass('active')
        var score = $(t).attr("data-score");
        tScore  = parseInt(tScore) + parseInt(score);
        $(t).find('i').removeClass('glyphicon-unchecked').addClass('glyphicon-ok');
        var t = $(".js_answer").index($(t).parents(".js_answer")) + 1;
        if(t == total){
            $('#score').attr('value',tScore);
	   dname = $('#dname').val();
	   dtel =  $('#dtel').val();
	   did =  $('#did').val();
	   dgroup =  $('#dgroup').val();
	   dadd =  $('#dadd').val();
	   score =  $('#score').val();
	   dtflg =  $('#dtflg').val();
            $.ajax({
                data:{'dname':dname,'dtel':dtel,'did':did,'dgroup':dgroup,'dadd':dadd,'score':score,'dtflg':dtflg},
                dateType:'json',
                url:'postForm.php',
                type:'POST',
                success:function(json){
                    if(json == '1'){
                    }else{
                        alert('bad');
                    }
                },
                error:function(){
                    alert('error');
                }
            });
            result(tScore);
        }else{
            setTimeout(function(){next(t);},300);
        }
    }

    Zepto(function($){
        $('.loads').hide();
    })

    wx.config({
        debug:false,
        appId: "<?php echo $appId ?>",
        timestamp: "<?php echo $timestamp ?>",
        nonceStr:  "<?php echo $nonceStr ?>",
        signature: "<?php echo $signature ?>",
        jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
          ]
     });

    wx.ready(function () {
        var shareData = {
        title: '嘉兴路痴考试',
        desc:'路痴们！嘉兴这些地方你认识吗？超过一半不认识就别出门了！',
        link: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx63aa13aad0891bf6&redirect_uri=http%3a%2f%2fcs.jx09.com%2fjx09source%2fhtml%2fcontest%2findex.php&response_type=code&scope=snsapi_base&connect_redirect=1#wechat_redirect",
        imgUrl: '<?php echo $imgUrl ?>',
        type:'',
        dataUrl:'',
      };
         wx.onMenuShareAppMessage(shareData);
         wx.onMenuShareTimeline(shareData);
    });
</script>
<div class="hide"></div>
</body>
</html>