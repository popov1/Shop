<?php 
 include ("header.php");
?>
<font color = red>В процессе пока</font>
<br/>
<div class="Name" align = "center" >
<div class="container"  align = "left" >
 <p align = 'right'><a href="logout_mag.php" >Выйти</a> из системы</p>
 <fieldset>
		<legend>Фильтры</legend>
		<table border = 0 width = 100%><tr>
			<td>Имя клиента</td><td>Номер заказа</td><td>Дата заказа</td><td>Состояние</td></tr>
			<tr><td><input type = 'text' name = 'Custom_name'></td><td><input type = 'text' name = 'nomer_zakaz'></td>
			<td><input type = 'text' name = 'date_zakaz'></td>
			<td>
				<select name = 'Select_Cond' title = 'Состояние заказа'>
				<option></option>
				<option>НОВЫЙ</option>
				<option>В ПРОЦЕССЕ</option>
				<option>ЗАКРЫТЬ - ПОЛОЖИТЕЛЬНО</option>
				<option>ЗАКРЫТ - ОТРИЦАТЕЛЬНО</option>
				</select>
			</td></tr>
		</table>
 </fieldset>		
<?php

	 include_once("connect_db.php");
	 @mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
	 @mysql_select_db($sdd_db_name); // выбор бд	 
	 @mysql_query('SET names "utf8"'); 
	 $sql = "select * from `order` GROUP BY number ORDER BY number DESC";
	 $result = mysql_query($sql);
	 ?>
	 
	 <form method = "POST" action = 'load_zakaz.php'>
	 <table width = 100% cellspacing='1' cellpadding='5' border='1' align = 'left' >
	 
	 <?php
     while($row=mysql_fetch_array($result))
	 {
	  echo "<tr><td> <button type='submit' name='poisk_Nakl' value = '".$row['Number']."'>Открыть накладную</button></td><td>".$row['Status']."</td><td>".$row['Number']."</td>"."<td>".$row['Customer']."</td><td>".$row['Telephone']."</td><td>".$row['Date']."</td>";
	 }	
	 ?>
	 </table>
	 </form>
</div>  
</div> 
<br/> 

<?php 
 include ("footer.php");
?>