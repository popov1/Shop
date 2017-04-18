<?php 
 include ("header.php");
?>
<div class="Name" align = "center" >
<div class="container"  align = "left" >

<?php
  if(isset($_POST['check_tyre_id']))
  {
   $Tovar_Name = array();
   for($i = 0; $i < count($_POST['check_tyre_id']);$i++)
   {
	 array_push($Tovar_Name, $_POST['check_tyre_id'][$i]);	
   }
  } 
  if(isset($_POST['text']))
    {
   $kolich = array();
   for($i = 0; $i < count($_POST['text']);$i++)
   {
	if($_POST['text'][$i]!="")
	{
	 array_push($kolich, $_POST['text'][$i]);	
	}
   }   
  } 

  if(empty($Tovar_Name))
  {
    echo("Вы ничего не выбрали.");
  }
  else
  {
  
    echo "<form name='form_zakaz' method='POST' action='form_zakaz.php'>";  //action='form_zakaz.php'
    $N = count($Tovar_Name);
    echo("Вы выбрали $N товара (-ов): ");
	echo "<br/>";
	echo "<label>Имя клиента<font color='#FF0000'>*</font></label><br/>";
	echo "<input  required = true type = 'text' name = 'Name' value = 'Test'/>";
	echo "<br/>";
	echo "<label>Телефон<font color='#FF0000'>*</font></label><br/>";
	echo "<input required = true type = 'text' name = 'Phone' value = 'Test'/><br/>";
	echo "<br/>";
	
	//$comma_separated = implode(",", $Tovar_Name); 
    for($i=0; $i < $N; $i++)
    { 	
      //echo($Tovar_Name[$i] . " ");
    }
	$comma_separated = "'";
	for($i=0; $i < $N; $i++)
    { 	
      $comma_separated .= $Tovar_Name[$i]."','";
    }
	$Tovar = array();
	$comma_separated[strlen($comma_separated)-3]=NULL;  // удаление последней запятой	
	include_once("connect_db.php");
	@mysql_query('SET names "utf8"'); 
	@mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
	@mysql_select_db($sdd_db_name); // выбор бд
	$sql = "SELECT price, name, size, id FROM `tyre` WHERE id IN (".$comma_separated.") ORDER BY id ASC ";
	$result=mysql_query($sql); // запрос на выборку
	if(!empty($result))
	//echo "<br/>";
	echo "<table width = 100% cellspacing='1' cellpadding='5' border='1' align = 'left' ><tr><th width = 60%>Наименование</th><th>Цена</th><th>Количество</th><th>Стоимость</th></tr>";
	$i = 0;
	$total = 0;
	while($row=mysql_fetch_array($result))	
	{
		$price = $row[0];
		$Brend = $row[1];
		$Name = $row[2];
		$ID = $row[3];
		$Sum = $kolich[$i]*$price;
		$total += $Sum;
		
		array_push($Tovar, $Brend.$Name, $price, $kolich[$i]);
		echo "<tr><td width = 40%>$Brend $Name</td><td>$price</td><td>$kolich[$i]</td><td>$Sum</td></tr>";
		$i ++;
	}
	echo "<tr><td width = 40%>Итоговая сумма :</td><td></td><td></td><td>$total</td></tr>";
	echo "</table>";
	echo "<input type='submit' name='formSubmit' value='Заказать' />";
	echo "</form>";
	if(!isset($_SESSION['Tovar']))
	{
	 session_start();
	 $_SESSION['Tovar'] = $Tovar;
	} 
  }
?>  

</div>  
</div> 
<br/> 

<?php 
 include ("footer.php");
?>