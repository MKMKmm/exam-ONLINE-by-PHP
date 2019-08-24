<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('../function/page.php'); //分页类 
$showrow = 2; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
$sql = "SELECT * FROM tb_plan"; 
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
<title>处置预案管理</title>
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
<h2>处置预案管理</h2>
</div>
<table>
<tr>
<tr>
<td>方案编号</td>
<td>阵地编号</td>
<td>测试程序</td>
<td>测试项目</td>
<td>导弹专业</td>
<td>故障模式</td>
<td>故障原因</td>
<td>处置预案</td>
<td></td>
</tr>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr>
<form method="post">
<td><input type="text" readonly="readonly" name="Plan_ID" value="<?php echo $row['Plan_ID']?>"/></td>
<td><input type="text" name="AreaID" value="<?php echo $row['AreaID']?>"/></td>
<td><input type="text" name="TestProcedure" value="<?php echo $row['TestProcedure']?>"/></td>
<td><input type="text" name="TestItem" value="<?php echo $row['TestItem']?>"/></td>
<td><input type="text" name="Speciality_Name" value="<?php echo $row['Speciality_Name']?>"/></td>
<td><input type="text" name="ErrorMode" value="<?php echo $row['ErrorMode']?>"/></td>
<td><input type="text" name="ErrorFrom" value="<?php echo $row['ErrorFrom']?>"/></td>
<td><input type="text" name="HandPlan" value="<?php echo $row['HandPlan']?>"/></td>
<td><input type="submit" name="modif" value="修改"/>
<input type="submit" name="delete" value="删除"/></td>
</form>
</tr>
<?php } ?> 
<tr>
<form method="post">
<td></td>
<td><input type="text" name="AreaID"/></td>
<td><input type="text" name="TestProcedure"/></td>
<td><input type="text" name="TestItem"/></td>
<td><input type="text" name="Speciality_Name"/></td>
<td><input type="text" name="ErrorMode"/></td>
<td><input type="text" name="ErrorFrom"/></td>
<td><input type="text" name="HandPlan"/></td>
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
        $Plan_ID=$_POST['Plan_ID'];
        $AreaID=$_POST['AreaID'];
        $TestProcedure=$_POST['TestProcedure'];
        $TestItem=$_POST['TestItem'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $ErrorMode=$_POST['ErrorMode'];
        $ErrorFrom=$_POST['ErrorFrom'];
        $HandPlan=$_POST['HandPlan'];
        $sql1="update tb_plan set AreaID='$AreaID',TestProcedure='$TestProcedure',TestItem='$TestItem',Speciality_Name='$Speciality_Name',ErrorMode='$ErrorMode',
        ErrorFrom='$ErrorFrom',HandPlan='$HandPlan' where Plan_ID='$Plan_ID'";
        $result1=$conn->query($sql1);
        if($result1){
            echo "<script>alert('修改成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
        if(isset($_POST['delete'])){
        $Plan_ID=$_POST['Plan_ID'];
        $sql2="delete from tb_plan where Plan_ID='$Plan_ID'";
        $result2=$conn->query($sql2);
        if($result2){
            echo "<script>alert('删除成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }

    if(isset($_POST['ZJ'])){
        
        $AreaID=$_POST['AreaID'];
        $TestProcedure=$_POST['TestProcedure'];
        $TestItem=$_POST['TestItem'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $ErrorMode=$_POST['ErrorMode'];
        $ErrorFrom=$_POST['ErrorFrom'];
        $HandPlan=$_POST['HandPlan'];
        $sql3="insert into tb_plan (AreaID,TestProcedure,TestItem,Speciality_Name,ErrorMode,ErrorFrom,HandPlan) values 
        ('$AreaID','$TestProcedure','$TestItem','$Speciality_Name','$ErrorMode','$ErrorFrom','$HandPlan')";
        $result3=$conn->query($sql3);
        if($result3){
            echo "<script>alert('增加成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
?>