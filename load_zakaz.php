<?php
include_once("connect_db.php");
?>
<?php 
 include ("header.php");
?>
<font color = red>В процессе пока</font>
<br/>
<div class="Name" align = "center" >
<div class="container"  align = "left" >

<?php
  if(isset($_POST['poisk_Nakl']))
  {
	$nom_zak = $_POST['poisk_Nakl'];
	echo "<label>Номер заказа : $nom_zak</label><br/>";
	@mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
	@mysql_select_db($sdd_db_name); // выбор бд	 
	@mysql_query('SET names "utf8"'); 
	$num = $_POST['poisk_Nakl'];
	$sql = "select * from `order` where Number = '$num' ORDER BY Number DESC";
	$result = mysql_query($sql);
	echo mysql_error() ;
	echo "<table width = 100% cellspacing='1' cellpadding='5' border='1' align = 'left' >";
	$total = 0;
	echo "<tr><td>Наименование</td><td>Цена</td><td>Количество</td><td>Стоимость</td></tr>";
     while($row=mysql_fetch_array($result))
	 {
	  $stat = $row[6];
	  $Cust_phone = $row[7];
	  $Cust_name = $row[2];	 
	  $cost = $row[4] * $row[5];
	  $total += $cost;
	  echo "<tr><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$cost</td></tr>";
	 }	 
   echo "<tr><td>Общая стоимость : </td><td> </td><td> </td><td>$total</td></tr>";
   echo "</table>"; 
   echo "<br/>";
   echo "<br/><label>Состояние заказа : $stat</label>";
   ?>
   <br/><label>Изменить состояние заказа</label>
   <select name = 'Select_Cond' title = 'Состояние заказа'>
   <option></option>
   <option>НОВЫЙ</option>
   <option>В ПРОЦЕССЕ</option>
   <option>ЗАКРЫТЬ - ПОЛОЖИТЕЛЬНО</option>
   <option>ЗАКРЫТ - ОТРИЦАТЕЛЬНО</option>
   </select>
<?php 
   echo "<br/><label>Имя клиента : $Cust_name</label><br/>";
   echo "<label>Телефон клиента : $Cust_phone</label><br/>";
  }	
?>
<label>Комментарий к заказу : </label><br/>
<textarea rows="10" cols="45" name="text"></textarea><br/>
<button type='submit' name='Change'>Применить</button>

</div>  
</div> 
<br/> 

<?php 
 include ("footer.php");
?>