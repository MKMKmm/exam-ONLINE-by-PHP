<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('./function/page.php'); //分页类 
$showrow = 2; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
//省略了链接mysql的代码，测试时自行添加 
$sql = "SELECT Book_ID,BookName,BookType,Position_Name,Speciality_Name FROM tb_book"; 
//$total = mysql_num_rows(mysql_query($sql)); //记录总条数 
$total=$conn->query($sql)->num_rows;
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
//$query = mysql_query($sql);

$query=$conn->query($sql);
?>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<table>
<tr>
<td>教材编号</td>
<td>教材名称</td>
<td>教材类型</td>
<td>专业岗位名称</td>
<td>导弹专业</td>
<td></td>
</tr>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr><td><?php echo $row['Book_ID']?></td>
<td><?php echo $row['BookName']?></td>
<td><?php echo $row['BookType']?></td>
<td><?php echo $row['Position_Name']?></td>
<td><?php echo $row['Speciality_Name']?></td>
<td><button><a href = "./upload_check.php?f=<?php echo $row['BookName'].".pdf"?>">
    下载</button></td></tr>
<?php } ?> 
</table>


<div class="showPage"> 
    <?php 
    if ($total > $showrow) {//总记录数大于每页显示数，显示分页 
        $page = new page($total, $showrow, $curpage, $url, 2); 
        echo $page->myde_write(); 
    } 
    ?> 
</div>