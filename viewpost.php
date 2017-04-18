<?php 
 include ("header.php");
?>
<br/>
<div class="Name" align = "center" >
<div class="container"  align = "left" >
<?php
		
		$sdd_db_host='localhost'; // ваш хост
		$sdd_db_name='Tyreshop'; // ваша бд
		$sdd_db_user='root'; // пользователь бд
		$sdd_db_pass='pev456'; // пароль к бд
		@mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
		@mysql_select_db($sdd_db_name); // выбор бд
		@mysql_query('SET names "utf8"'); 
		$sql = "SELECT price, name, size, id FROM tyre  ORDER BY id ASC";
		
		$result = mysql_query($sql);
		$kol_row = mysql_num_rows($result); // количество строк в запросе
					
		 $kol_per_page=10; // количество записей на странице
		// $total_pages = ceil($kol_row/$kol_per_page); // всего страниц
		// echo $total_pages." vsego stranic";
				 
		 // если страницы не существует, выводим первую страницу
		if(!isset($_GET['str']))
		{
		 $str = 0;
		}
		else
		{
		 $str = $_GET['str'];
		}
		// получем номер начальной записи страницы
		$start = $str * $kol_per_page; 
		
		// запрос    //where brend like '%".$name_brend."%'
		@mysql_query('SET names "utf8"'); 
		$r = mysql_query("SELECT price, name, size, id FROM tyre ORDER BY id ASC");
		$kol_row = mysql_num_rows($r);
		$r = mysql_query("SELECT price, name, size, id FROM tyre  ORDER BY id ASC LIMIT $start, $kol_per_page ");
		$n = mysql_num_rows($r); // возвращаем число рядов результата запроса	
		// если страница не первая, выводим ссылку НАЗАД
		if ($str > 0)
		{
		 $p = $str - 1;
		 echo "<a href=viewpost.php?str=$p>НАЗАД</a>	&nbsp;	&nbsp;	&nbsp;";
		}
		
		$str++;  // увеличиваем переменную $str на единицу;
		// выводим ссылку на следующие пять записей, если она есть, 
		// то есть число записей, которые нужно вывести,
		// и смещение не превышает общего числа записей		
		if($start + $n < $kol_row)
		{
		  echo "<a href=viewpost.php?str=$str>ДАЛЕЕ</a>"; 
		} 

		echo "<table width = 100% cellspacing='1' cellpadding='5' border='1' align = 'left' >";
        echo "<td width = 5% align = 'center'></td><td width = 60%>Наименование</td><td>Цена</td><td align = 'left'>Количество</td></tr>";		
		// выводим записи
		for ($i = 0; $i < $n; $i++)
		{
		 $row = mysql_fetch_array($r);
		 $price = $row[0];
		 $Brend = $row[1];
		 $Name = $row[2];
		 $ID = $row[3];	
		 echo "<form  name='form' method='POST' action='checkbox-form.php' ><td width = 5% align = 'center'>
													<!--   $ID  -->
				<input type='checkbox' name='check_tyre_id[]' value='$ID'/></td><td width = 60%>$row[1]  $row[2]</td><td>$row[0]</td><td >
				<input type = 'text' name = 'text[]' value = ''/></td></tr>";		 
		// printf ("<h3>%s</h3><p>%s</p>",
		// $myrow["name"], $myrow["size"] );
		}
	  echo "</table>";
	  echo "<br/>";
	  echo "<input type='submit' name='formSubmit' value='Оформить заказ' />";
	  echo "</form>"; 
  //   }	  
?>		

</div>  
</div> 
<br/> 

<?php 
 include ("footer.php");
?>