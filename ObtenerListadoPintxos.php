<?php
require_once("db.php");

$conn = db_connect ();
$tipo="Pintxo";
$lista_items = db_get_items($conn,$tipo);
$lista_items_dev=array();
error_log(mysql_num_rows($lista_items));
if(mysql_num_rows($lista_items) > 0)
      {
        while($item = mysql_fetch_assoc($lista_items))//FOR mysql escape string
        {
         $lista_items_dev[]=array("id"=>$item["id"],"srcimg"=>$item["srcimg"],"alias"=>$item["alias"],"ingredientes"=>$item["ingredientes"] );
        } 
      }

	  /*
$obj= array(array());
$obj[0]['id']= $_GET['valor1']; //string
$obj[0]['srcimg'] = $_GET['valor2'];  // integer.
$obj[0]['alias']= $_GET['valor3']; //array
$obj[0]['ingredientes']= $_GET['valor3']; //array

$obj[1]['id']= $_GET['valor1']; //string
$obj[1]['srcimg'] = $_GET['valor2'];  // integer.
$obj[1]['alias']= $_GET['valor3']; //array
$obj[1]['ingredientes']= $_GET['valor3']; //array

$obj[2]['id']= $_GET['valor1']; //string
$obj[2]['srcimg'] = $_GET['valor2'];  // integer.
$obj[2]['alias']= $_GET['valor3']; //array
$obj[2]['ingredientes']= $_GET['valor3']; //array
*/
echo json_encode($lista_items_dev);
?>
