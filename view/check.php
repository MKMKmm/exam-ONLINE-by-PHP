<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('../function/page.php'); //分页类 
$showrow = 2; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
$sql = "SELECT * FROM tb_check"; 
//$total = mysql_num_rows(mysql_query($sql)); //记录总条数 
$total=$conn->query($sql)->num_rows;
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
//$query = mysql_query($sql);

$query=$conn->query($sql);
?>
<!DOCtype>
<html>
<head>
<title>技术把关状态管理</title>
<style>
table{background-color: white;  width: 500px;height: 100px;margin: 0 auto; border: 1px solid #000;}
td{height: 20px;line-height: 20px;font-family: "微软雅黑";font-size: 14px;font-weight: normal;color: #0080FF;
text-align: center;border: 1px solid #CCC;background-color: white;;
}
#dht{padding:10px;

boder:1px solid#000000;

background: "教官信息管理.jpg";}
</style>
</head>
<body background="教官信息管理.jpg"
      style=" background-repeat:no-repeat ;
background-size:100% 100%;
background-attachment: fixed;">
<div align="center">
<h2>技术把关状态管理</h2>
</div>
<table>
<tr>
<td>阵地编号</td>
<td>测试程序</td>
<td>测试项目</td>
<td>岗位名称</td>
<td>导弹专业</td>
<td>测试条件</td>
<td>状态准备</td>
<td>操作状态</td>
<td>状态要求</td>
<td></td>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr>
<form method="post">
<td><input type="text" readonly="readonly" name="AreaID" value="<?php echo $row['AreaID']?>"/></td>
<td><input type="text" name="TestProcedure" value="<?php echo $row['TestProcedure']?>"/></td>
<td><input type="text" name="CheckItem" value="<?php echo $row['CheckItem']?>"/></td>
<td><input type="text" name="Position_Name" value="<?php echo $row['Position_Name']?>"/></td>
<td><input type="text" name="Speciality_Name" value="<?php echo $row['Speciality_Name']?>"/></td>
<td><input type="text" name="CheckPrepare" value="<?php echo $row['CheckPrepare']?>"/></td>
<td><input type="text" name="StatusPrepare" value="<?php echo $row['StatusPrepare']?>"/></td>
<td><input type="text" name="OperateStatus" value="<?php echo $row['OperateStatus']?>"/></td>
<td><input type="text" name="StatusNeed" value="<?php echo $row['StatusNeed']?>"/></td>
<td><input type="submit" name="modif" value="修改"/>
<input type="submit" name="delete" value="删除"/></td>
</form>
</tr>
<?php } ?> 
<tr>
<form method="post">
<td></td>
<td><input type="text" name="TestProcedure"/></td>
<td><input type="text" name="CheckItem"/></td>
<td><input type="text" name="Position_Name"/></td>
<td><input type="text" name="Speciality_Name"/></td>
<td><input type="text" name="CheckPrepare"/></td>
<td><input type="text" name="StatusPrepare"/></td>
<td><input type="text" name="OperateStatus"/></td>
<td><input type="text" name="StatusNeed"/></td>
<td><input type="submit" name="ZJ" value="增加信息" style="height:30px;width:70px;"/></td>
</form>
</tr>
</table> 
<div class="showPage"> 
    <?php 
    if ($total > $showrow) {//总记录数大于每页显示数，显示分页 
        $page = new page($total, $showrow, $curpage, $url, 2); 
        echo $page->myde_write(); 
    } 
    ?> 
</div>
</body>
</html>
<?php
    if(isset($_POST['modif'])){
        $AreaID=$_POST['AreaID'];
        $TestProcedure=$_POST['TestProcedure'];
        $CheckItem=$_POST['CheckItem'];
        $Position_Name=$_POST['Position_Name'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $CheckPrepare=$_POST['CheckPrepare'];
        $StatusPrepare=$_POST['StatusPrepare'];
        $OperateStatus=$_POST['OperateStatus'];
        $StatusNeed=$_POST['StatusNeed'];
        $sql1="update tb_check set TestProcedure='$TestProcedure',CheckItem='$CheckItem',Position_Name='$Position_Name',Speciality_Name='$Speciality_Name',
        CheckPrepare='$CheckPrepare',StatusPrepare='$StatusPrepare',OperateStatus='$OperateStatus',StatusNeed='$StatusNeed' where AreaID='$AreaID'";
        $result1=$conn->query($sql1);
        if($result1){
            echo "<script>alert('修改成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
        if(isset($_POST['delete'])){
        $AreaID=$_POST['AreaID'];
        $TestProcedure=$_POST['TestProcedure'];
        $CheckItem=$_POST['CheckItem'];
        $Position_Name=$_POST['Position_Name'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $CheckPrepare=$_POST['CheckPrepare'];
        $StatusPrepare=$_POST['StatusPrepare'];
        $OperateStatus=$_POST['OperateStatus'];
        $StatusNeed=$_POST['StatusNeed'];
        $sql2="delete from tb_check where AreaID='$AreaID'";
        $result2=$conn->query($sql2);
        if($result2){
            echo "<script>alert('删除成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }

    if(isset($_POST['ZJ'])){
        
        $TestProcedure=$_POST['TestProcedure'];
        $CheckItem=$_POST['CheckItem'];
        $Position_Name=$_POST['Position_Name'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $CheckPrepare=$_POST['CheckPrepare'];
        $StatusPrepare=$_POST['StatusPrepare'];
        $OperateStatus=$_POST['OperateStatus'];
        $StatusNeed=$_POST['StatusNeed'];
        $sql3="insert into tb_check (TestProcedure,CheckItem,Position_Name,Speciality_Name,CheckPrepare,StatusPrepare,OperateStatus,StatusNeed) values 
        ('$TestProcedure','$CheckItem','$Position_Name','$Speciality_Name','$CheckPrepare','$StatusPrepare','$OperateStatus','$StatusNeed')";
        $result3=$conn->query($sql3);
        if($result3){
            echo "<script>alert('增加成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
?>