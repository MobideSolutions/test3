<?php
$DB_HOST = "localhost";
$DB_NAME = "bartolo";
$DB_USER = "bartoloadmin";
$DB_PWD  = "bartoloetxea2014";

//-----------------------------------------------------------------------------------------------------------------------
// CONNECTION METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_connect()
{
  global $DB_HOST, $DB_USER, $DB_PWD, $DB_NAME;
  $conn = mysql_connect ($DB_HOST, $DB_USER, $DB_PWD) or die ("Internal server error");
 
  mysql_select_db ($DB_NAME)                          or die ("Internal server error");
  mysql_query ("SET NAMES 'utf8'");
  return $conn;
}
function db_close ($_conn)
{
  mysql_close ($_conn) or die ("Internal sever error");
}

//-----------------------------------------------------------------------------------------------------------------------
// ITEMS METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_items($_conn,$tipo)
{
 //$web_id = mysql_real_escape_string($_web_id);
 $query = "select * from pintxos where tipo=\"$tipo\""; //
 $result = mysql_query($query, $_conn);
 if(!$result)
    return null;   
 return $result;
}


function db_get_item_row($_conn, $_item_id)
{    
	$item_id = mysql_real_escape_string($_item_id);
	$query = "select * from pintxos where id = $item_id";  
	$result = mysql_query($query, $_conn);
	if(!$result)
		return null;   
	$row = mysql_fetch_array($result); 
	return $row;
}




//-----------------------------------------------------------------------------------------------------------------------
//SUPPLIER METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_supplier_id($_conn, $_host_url)
{  
  $host_url = mysql_real_escape_string($_host_url) ;
  $query = "select id from supplier where host_url = \"$host_url\"";
  $result = mysql_query ($query, $_conn);
  if(!$result || mysql_num_rows ($result) == 0)
    return null;
  return mysql_result($result, 0);
}

function db_get_supplier_row($_conn, $_supplier_id)
{    
	$supplier_id = mysql_real_escape_string($_supplier_id);
  $query = "select * from supplier where id = $supplier_id";  
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

//-----------------------------------------------------------------------------------------------------------------------
//WEB METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_web_id($_conn, $_web_code, $_supplier_id)
{
  $web_code = mysql_real_escape_string($_web_code);
	$supplier_id = mysql_real_escape_string($_supplier_id);
  $query = "select id from web where code = \"$web_code\" and supplier_id = $supplier_id";
  if($web_code == null)
    $query = "select id from web where main = 1 and supplier_id = $supplier_id";  
  $result = mysql_query ($query, $_conn);
  if(!$result || mysql_num_rows ($result) == 0)
    return null;
  return mysql_result($result, 0);
}

function db_get_web_code($_conn, $_web_id)
{
  $web_id = mysql_real_escape_string($_web_id);
  $query = "select code from web where id = $web_id";
  $result = mysql_query ($query, $_conn);
  if(!$result || mysql_num_rows ($result) == 0)
    return null;
  return mysql_result($result, 0);
}

function db_get_web_row($_conn, $_web_code, $_supplier_id)
{  
  $web_code = mysql_real_escape_string($_web_code);
	$supplier_id = mysql_real_escape_string($_supplier_id);
  $query = "select * from web where code = \"$web_code\" and supplier_id = $supplier_id";
  if($web_code == null)
    $query = "select * from web where main = 1 and supplier_id = $supplier_id";  
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}


//-----------------------------------------------------------------------------------------------------------------------
// PAGE METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_entry_page_row($_conn, $_web_id, $_lang_id)
{  
  $web_id = mysql_real_escape_string($_web_id);
  $lang_id = mysql_real_escape_string($_lang_id);  
  $query = "select * from page where entry = 1 and web_id = $web_id and lang_id = $lang_id";
  if($lang_id == null)//no lang_code passed by param and no browser language available
  {
    $query = "select * from page where entry = 1 and web_id = $web_id  LIMIT 1";
  }
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

function db_get_page_row($_conn, $_page_code, $_web_id, $_lang_id)
{  
  $web_id = mysql_real_escape_string($_web_id);
  $lang_id = mysql_real_escape_string($_lang_id);  
  $page_code = mysql_real_escape_string($_page_code); 
  $query = "select * from page where code = \"$page_code\" and web_id = $web_id and lang_id = $lang_id";
  if($lang_id == null)//no lang_code passed by param and no browser language available
  {
    $query = "select * from page where code = \"$page_code\" and web_id = $web_id  LIMIT 1";
  }
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

function db_get_web_entry_pages($_conn, $_web_id)
{
  $web_id = mysql_real_escape_string($_web_id);
  $query = "select * from page where entry = 1 and web_id = \"$web_id\"";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  return $result;
}

function db_get_page_link($_conn, $_page_id)
{
  $page_id = mysql_real_escape_string($_page_id);
  $query = "select code, web_id, lang_id from page where id = $page_id";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}


//-----------------------------------------------------------------------------------------------------------------------
// LANG METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_lang_id($_conn, $_lang_code)
{
  $lang_code = mysql_real_escape_string($_lang_code);
  $query = "select id from language where code = \"$lang_code\"";
  $result = mysql_query ($query, $_conn);
  if(!$result || mysql_num_rows ($result) == 0)
    return null;
  return mysql_result($result, 0);
}

function db_get_lang_code($_conn, $_lang_id)
{
  $lang_id = mysql_real_escape_string($_lang_id);
  $query = "select code from language where id = \"$lang_id\"";
  $result = mysql_query ($query, $_conn);
  if(!$result || mysql_num_rows ($result) == 0)
    return null;
  return mysql_result($result, 0);
}
function db_get_lang_row($_conn, $_lang_id)
{
  $lang_id = mysql_real_escape_string($_lang_id);
  $query = "select * from language where id = \"$lang_id\"";
  $result = mysql_query ($query, $_conn);
  if(!$result || mysql_num_rows ($result) == 0)
    return null;
  $row = mysql_fetch_array($result); 
  return $row;
}
//-----------------------------------------------------------------------------------------------------------------------
// THEME METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_theme_row($_conn, $_theme_id)
{
  $theme_id = mysql_real_escape_string($_theme_id);
  $query = "select * from theme where id = \"$theme_id\"";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

//-----------------------------------------------------------------------------------------------------------------------
// LIST_PAGE METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_list_page_row($_conn, $_list_page_id)
{
  $list_page_id = mysql_real_escape_string($_list_page_id);
  $query = "select * from list_page where id = \"$list_page_id\"";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

function db_get_list_page_items($_conn, $_list_page_id)
{
  $list_page_id = mysql_real_escape_string($_list_page_id);
  $query = "select * from list_page_item where list_page_id = $list_page_id order by sequence";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  return $result;//mysql_fetch_assoc?
}

//-----------------------------------------------------------------------------------------------------------------------
// ARTICLE_PAGE METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_article_page_row($_conn, $_article_page_id)
{
  $article_page_id = mysql_real_escape_string($_article_page_id);
  $query = "select * from article_page where id = \"$article_page_id\"";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

function db_get_article_page_blocks($_conn, $_article_page_id)
{
  $article_page_id = mysql_real_escape_string($_article_page_id);
  $query = "select * from article_page_block where article_page_id = $article_page_id order by sequence";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  return $result;//mysql_fetch_assoc?
}


//-----------------------------------------------------------------------------------------------------------------------
// GALLERY_PAGE METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_gallery_page_row($_conn, $_gallery_page_id)
{
  $gallery_page_id = mysql_real_escape_string($_gallery_page_id);
  $query = "select * from gallery_page where id = \"$gallery_page_id\"";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}

function db_get_gallery_page_images($_conn, $_gallery_page_id)
{
  $gallery_page_id = mysql_real_escape_string($_gallery_page_id);
  $query = "select * from gallery_page_image where gallery_page_id = $gallery_page_id order by sequence";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  return $result;//mysql_fetch_assoc?
}


//-----------------------------------------------------------------------------------------------------------------------
// CONTACT_PAGE METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_contact_page_row($_conn, $_contact_page_id)
{
  $contact_page_id = mysql_real_escape_string($_contact_page_id);
  $query = "select * from contact_page where id = \"$contact_page_id\"";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;   
  $row = mysql_fetch_array($result); 
  return $row;
}



//-----------------------------------------------------------------------------------------------------------------------
// BUTTON METHODS
//-----------------------------------------------------------------------------------------------------------------------
function db_get_page_buttons($_conn, $_page_id)
{
  $page_id = mysql_real_escape_string($_page_id);
  $query = "select * from button where page_id = $page_id and enabled order by sequence,position";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;    
  return $result;
}


function db_get_qr_tshirt_content_row($_conn, $_web_id, $_lang_id)
{
  $web_id = mysql_real_escape_string($_web_id);
	$lang_id = mysql_real_escape_string($_lang_id);
  $query = "select * from QR_tshirt_content where web_id = $web_id and lang_id = $lang_id order by RAND() limit 1";
  $result = mysql_query($query, $_conn);
  if(!$result)
    return null;    
	$row = mysql_fetch_array($result); 	
  return $row;
}








//========================================================================================================================================
// PDO METHODS
//========================================================================================================================================
/* PDO open close methods
function db_connect ()
{  
  global $DB_HOST, $DB_USER, $DB_PWD, $DB_NAME;
  $dbh = new PDO("mysql:host=".$DB_HOST.";dbname=".$DB_NAME, $DB_USER, $DB_PWD);
  return $dbh;
}

function db_close ($_conn)
{
  mysql_close ($_conn) or die ("Internal sever error");
}
*/

//SUPPLIER METHODS
function db_getSupplierId ($_conn, $_mouinSubDomain)
{    
  $preparedStatement = $_conn->prepare('select SupplierId from supplier where MouinSubDomain = :MouinSubDomain');
  $preparedStatement->execute(array(':MouinSubDomain' => $_mouinSubDomain));
  $count = $preparedStatement->rowCount();
  if ($count == 0)
  {
    return null;
  } 
  return $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);
}

function db_getSupplierInfo($_conn, $_supplierId)
{   
  $preparedStatement = $_conn->prepare('select * from supplier where SupplierId = :SupplierId');
  $preparedStatement->execute(array(':SupplierId' => $_supplierId));
  $result = $preparedStatement->fetch();
  if (!$result)
  {
    return null;
  } 
  return $result;
}

function db_getSupplierLanguageName ($_conn, $_supplierId, $_lang)
{ //$_lang is hardcoded server side, dont need to prevent from injections  
  $preparedStatement = $_conn->prepare('select '.$_lang.' from supplier where SupplierId = :SupplierId');
  $preparedStatement->execute(array (':SupplierId' => $_supplierId));
  $result = $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);
  if (!$result)
  {
    return null;
  } 
  return $result;
}

function db_getMouinSubDomain ($_conn, $_supplierId)
{  
  $preparedStatement = $_conn->prepare('select  MouinSubDomain from supplier where SupplierId = :SupplierId');
  $preparedStatement->execute(array(':SupplierId' => $_supplierId));
  $result = $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);
  if (!$result)
  {
    return null;
  } 
  return $result;
}

function db_updateSupplierConfig($_conn, $supplierId, $name, $address, $city, $telephone, $telephone2, $fax, $website, $email, $lang1, $lang2, $lang3, $lang4, $lang5, $lang1Key, $lang2Key, $lang3Key, $lang4Key, $lang5Key, $facebook, $twitter, $contactButtonL1, $contactButtonL2, $contactButtonL3, $contactButtonL4, $contactButtonL5, $GAnalytics)
{ 
  $paramsArray = array(':SupplierId' => $supplierId, ':Name'=> $name, ':Address'=> $address, ':City'=> $city , ':Telephone'=> $telephone, ':Telephone2'=> $telephone2, ':Fax'=> $fax, ':Website'=> $website , ':Email'=> $email, ':L1'=>$lang1, ':L2'=>$lang2, ':L3'=>$lang3, ':L4'=>$lang4, ':L5'=>$lang5, ':L1Key'=>$lang1Key, ':L2Key'=>$lang2Key, ':L3Key'=>$lang3Key, ':L4Key'=>$lang4Key, ':L5Key'=>$lang5Key, ':Facebook'=> $facebook, ':Twitter'=>$twitter, ':ContactButtonL1'=> $contactButtonL1, ':ContactButtonL2'=> $contactButtonL2, ':ContactButtonL3'=> $contactButtonL3, ':ContactButtonL4'=> $contactButtonL4, ':ContactButtonL5'=> $contactButtonL5, ':GAnalytics' => $GAnalytics);
  $preparedStatement = $_conn->prepare('UPDATE supplier SET Name= :Name, Address= :Address, City= :City, Telephone = :Telephone,  Telephone2 = :Telephone2,  Fax = :Fax, Website = :Website, Email = :Email, L1= :L1, L2= :L2, L3= :L3, L4= :L4, L5= :L5, L1Key= :L1Key, L2Key= :L2Key, L3Key= :L3Key, L4Key= :L4Key, L5Key= :L5Key,  Facebook= :Facebook, Twitter = :Twitter, ContactButtonL1 = :ContactButtonL1, ContactButtonL2 = :ContactButtonL2, ContactButtonL3 = :ContactButtonL3, ContactButtonL4 = :ContactButtonL4, ContactButtonL5 = :ContactButtonL5, GAnalytics = :GAnalytics WHERE SupplierId = :SupplierId');  
  $preparedStatement->execute($paramsArray);  
}

function db_getSupplierMaxProducts($_conn, $_supplierId)
{
  $preparedStatement = $_conn->prepare('select MaxProducts from supplier where SupplierId = :SupplierId');
  $preparedStatement->execute(array(':SupplierId' => $_supplierId));
  $result = $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);
  if (!$result)
  {
    return null;
  } 
  return $result;
}

//PRODUCT METHODS
function db_getProductId ($_conn, $_supplierId, $_productCode)
{   
  $preparedStatement = $_conn->prepare('select ProductId from product where  SupplierId =:SupplierId and Code = :Code');
  $preparedStatement->execute(array(':SupplierId'=> $_supplierId, ':Code' => $_productCode));
  $result = $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);
  if (!$result)
  {
    return null;
  } 
  return $result;
}

function db_existProductCode($_conn, $_supplierId, $_productCode)
{
  $preparedStatement = $_conn->prepare('select Code from product where  SupplierId =:SupplierId and Code = :Code');
  $preparedStatement->execute(array(':SupplierId'=> $_supplierId, ':Code' => $_productCode));
  $count = $preparedStatement->rowCount();
  if ($count == 0)
  {
    return null;
  } 
  return $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);
}

function db_getProductInfo($_conn, $_supplierId,  $_productId)
{  
  $preparedStatement = $_conn->prepare('select * from product where SupplierId = :SupplierId and ProductId = :ProductId');
  $preparedStatement->execute(array (':SupplierId'=> $_supplierId, ':ProductId' => $_productId));
  $result = $preparedStatement->fetch();
  if (!$result)
  {
    return null;
  } 
  return $result;
}

function db_getSupplierProducts($_conn, $_supplierId)
{     
  $preparedStatement = $_conn->prepare('select * from product where SupplierId = :SupplierId ORDER BY ProductId ');
  $preparedStatement->execute(array(':SupplierId' => $_supplierId));
  $result = $preparedStatement->fetchAll();
  if (!$result)
  {
    return null;
  } 
  return $result;
}

function db_insertProductConfig($_conn, $supplierId, $productCode, $numSections, $template, $sectionImagesPosition, $style, $productImage, $headerImage, $enabledL1, $enabledL2, $enabledL3, $enabledL4, $enabledL5, $bckColorHeader, $bckColorPage, $bckColorLanguages, $bckColorGradTop, $bckColorGradBottom, $bckColorGradText, $bckColorGradShadow)
{  
  $productId = db_getProductId($_conn, $supplierId, $productCode);
  if($productId == null)
  {
  $preparedStatement = $_conn->prepare('INSERT INTO `product` (`SupplierId`, `Code`, `NumSections`, `Template` , `SectionImagesPosition`, `Style`  , `ProductImg`, `HeaderImg`, `EnabledL1`, `EnabledL2`, `EnabledL3`, `EnabledL4`, `EnabledL5`, `HeaderBckColor`, `PageBckColor`, `LangLinkColor`, `GradTopColor`, `GradBottomColor`, `GradTextColor`, `GradTextShadowColor`)   VALUES (:SupplierId, :Code, :NumSections, :Template, :SectionImagesPosition, :Style, :ProductImg, :HeaderImg, :EnabledL1, :EnabledL2, :EnabledL3, :EnabledL4, :EnabledL5, :HeaderBckColor, :PageBckColor, :LangLinkColor, :GradTopColor, :GradBottomColor, :GradTextColor, :GradTextShadowColor)');
  $preparedStatement->execute(array(':SupplierId' => $supplierId, ':Code'=> $productCode, ':NumSections'=> $numSections, ':Template'=> $template, ':SectionImagesPosition'=>$sectionImagesPosition, ':Style'=> $style, ':ProductImg'=> $productImage, ':HeaderImg' => $headerImage, ':EnabledL1'=> $enabledL1, ':EnabledL2'=> $enabledL2, ':EnabledL3'=>$enabledL3, ':EnabledL4'=>$enabledL4, ':EnabledL5'=>$enabledL5, ':HeaderBckColor'=>$bckColorHeader, ':PageBckColor'=>$bckColorPage, ':LangLinkColor' =>$bckColorLanguages, ':GradTopColor'=>$bckColorGradTop, ':GradBottomColor'=>$bckColorGradBottom, ':GradTextColor'=> $bckColorGradText, ':GradTextShadowColor'=>$bckColorGradShadow));
  //$result = $preparedStatement->fetch(PDO::lastInsertId());
  $result = (int) $_conn -> lastInsertId();
  if (!$result)
  {
    return null;
  } 
  return $result;
  }
  return (int)$productId;
}

function db_updateProductConfig($_conn, $productId, $numSections, $template, $sectionImagesPosition, $style, $productImage, $headerImage, $enabledL1, $enabledL2, $enabledL3, $enabledL4, $enabledL5, $bckColorHeader, $bckColorPage, $bckColorLanguages, $bckColorGradTop, $bckColorGradBottom, $bckColorGradText, $bckColorGradShadow, $deleteLangContent)
{ 
  $paramsArray = array(':ProductId' => $productId, ':NumSections'=> $numSections, ':Template'=> $template, ':SectionImagesPosition'=>$sectionImagesPosition, ':Style'=> $style , ':EnabledL1'=> $enabledL1, ':EnabledL2'=> $enabledL2, ':EnabledL3'=>$enabledL3, ':EnabledL4'=>$enabledL4, ':EnabledL5'=>$enabledL5, ':HeaderBckColor'=>$bckColorHeader, ':PageBckColor'=>$bckColorPage, ':LangLinkColor' =>$bckColorLanguages, ':GradTopColor'=>$bckColorGradTop, ':GradBottomColor'=>$bckColorGradBottom, ':GradTextColor'=> $bckColorGradText, ':GradTextShadowColor'=>$bckColorGradShadow);
  $imageParams = ""; 
  if($productImage !=null)
  {
    $imageParams =  $imageParams . ", `ProductImg`= :ProductImg";
    $paramsArray [':ProductImg'] =  $productImage;
  }
  if($headerImage !=null)
  {
    $imageParams =  $imageParams . ", `HeaderImg`= :HeaderImg";
    $paramsArray [ ':HeaderImg'] = $headerImage;
  }
  $removedLanguagesParams = "";    
  if($deleteLangContent == 1)
  {
    $removedLanguagesParams = getRemovedLanguageParams($enabledL1, $enabledL2, $enabledL3, $enabledL4, $enabledL5, $numSections); 
  }
  $preparedStatement = $_conn->prepare(
    'UPDATE product SET NumSections= :NumSections, Template= :Template, SectionImagesPosition= :SectionImagesPosition, Style= :Style, '    
    .'EnabledL1= :EnabledL1, EnabledL2= :EnabledL2, EnabledL3= :EnabledL3, EnabledL4= :EnabledL4, EnabledL5= :EnabledL5, '
    .'HeaderBckColor= :HeaderBckColor, PageBckColor = :PageBckColor, LangLinkColor = :LangLinkColor, GradTopColor = :GradTopColor, GradBottomColor= :GradBottomColor, GradTextColor= :GradTextColor, GradTextShadowColor= :GradTextShadowColor '   
    . $imageParams 
    . $removedLanguagesParams
    .' WHERE ProductId = :ProductId');  
  $preparedStatement->execute($paramsArray);  
}

function getRemovedLanguageParams($enabledL1, $enabledL2, $enabledL3, $enabledL4, $enabledL5, $numSections)
{    
 $removedLanguagesParams = "";
  for($i=1;$i<6;$i++)
  {
    if(${'enabledL' . $i} == 0)
    {
      $removedLanguagesParams = $removedLanguagesParams.  ", `TitleL".$i."` = '', `SubTitleL".$i."` = '', `FooterTextL".$i."` = '', `FooterLinkL".$i."` = ''      ";
      for($j=1; $j<10+1;$j++) //Could use numSections that only remove the content for configured options, but if they have 5 sections, change to 4 and delete a language, the content of section5 for deleted language will not be removed, so better to use 10+1
      {
        $removedLanguagesParams = $removedLanguagesParams. ", `Section".$j."NameL".$i."` = '', `Section".$j."TextL".$i."` = ''       ";
      }
    }
  }
  return  $removedLanguagesParams;
}

function db_updateProductLanguage($_conn, $productId, $lang, $numSections, $title, $subtitle, $sectionImages, $sectionImageRepeat,  $sectionNames, $sectionTexts, $sectionLinks, $footerLink, $footerText, $name, $address, $city, $email, $telephone, $telephone2, $fax, $website, $facebook, $twitter, $moreInfo, $contactButton)
{
  if(strlen($lang) ==1) //to protect from inyections
  {
    $paramsArray = array(':ProductId' => $productId, ':Title'=> $title, ':Subtitle'=> $subtitle, ':FooterLink'=> $footerLink , ':FooterText'=> $footerText, ':Name' => $name, ':Address' => $address, ':City' => $city, ':Email' => $email, ':Telephone' => $telephone, ':Telephone2' => $telephone2, ':Fax' => $fax, ':Website' => $website, ':Facebook' => $facebook, ':Twitter' => $twitter, ':MoreInfo' => $moreInfo, ':ContactButton' => $contactButton);
    $sectionParams = ""; 
    for($j=0;$j<$numSections;$j++)
    {
      $i = $j+ 1;
      if($sectionImages[$j] !=null)
      {
        if($sectionImageRepeat[$j] == "repeat") //set the image name to all the languages of the current section
        {
          for($l=1; $l<6; $l++)
          {
            $sectionParams =  $sectionParams . ", Section".$i."ImgL".$l." = :Section".$i."ImgL".$l;
            $paramsArray [":Section".$i."ImgL".$l] =  $sectionImages[$j];
          }
        }
        else //set only the image name to the current section and language
        {
          $sectionParams =  $sectionParams . ", Section".$i."ImgL".$lang." = :Section".$i."ImgL".$lang;
          $paramsArray [":Section".$i."ImgL".$lang] =  $sectionImages[$j];
        }
      }
      //if($sectionNames[$j] !=null)  //if textbox is empty it arrives null
      {
        $sectionParams =  $sectionParams . ", Section".$i."NameL".$lang." = :Section".$i."NameL".$lang;
        $paramsArray [":Section".$i."NameL".$lang] =  $sectionNames[$j];
      }
      //if($sectionTexts[$j] !=null)  //if textarea is empty it arrives null
      {
        $sectionParams =  $sectionParams . ", Section".$i."TextL".$lang." = :Section".$i."TextL".$lang;
        $paramsArray [":Section".$i."TextL".$lang] =  $sectionTexts[$j];
      }
      //if($sectionLinks[$j] !=null)  //if textbox is empty it arrives null
      {
        $sectionParams =  $sectionParams . ", Section".$i."Link = :Section".$i."Link";
        $paramsArray [":Section".$i."Link"] =  $sectionLinks[$j];
      }
    }
    $preparedStatement = $_conn->prepare(
      'UPDATE product SET TitleL'.$lang.'= :Title, SubtitleL'.$lang.'= :Subtitle'  
      . $sectionParams 
      .', FooterLinkL'.$lang.'= :FooterLink, FooterTextL'.$lang.'= :FooterText'   
      .', NameL'.$lang.'= :Name, AddressL'.$lang.'= :Address, CityL'.$lang.'= :City, EmailL'.$lang.'= :Email, TelephoneL'.$lang.'= :Telephone, Telephone2L'.$lang.'= :Telephone2, FaxL'.$lang.'= :Fax, WebsiteL'.$lang.'= :Website, FacebookL'.$lang.'= :Facebook, TwitterL'.$lang.'= :Twitter, MoreInfoL'.$lang.'= :MoreInfo, ContactButtonL'.$lang.'= :ContactButton  '  
      .' WHERE ProductId = :ProductId');  
    $preparedStatement->execute($paramsArray);
  }
}

function db_deleteProduct($_conn, $productId)
{
  $paramsArray = array(':ProductId' => $productId); 
  $preparedStatement = $_conn->prepare('DELETE FROM product WHERE ProductId = :ProductId');  
  $preparedStatement->execute($paramsArray);
}

function db_deleteImage($_conn, $productId, $headerImage, $productImage, $lang, $section)
{
  $paramsArray = array(':ProductId' => $productId); 
  $params = "";
  if($headerImage !=null)
  {
    $paramsArray [':HeaderImg'] = null;     
    $params = "HeaderImg = :HeaderImg";
  }
  else if($productImage !=null)
  {
    $paramsArray [':ProductImg'] =  null;    
    $params = "ProductImg = :ProductImg";   
  }
  else if($lang !=null)
  {
    $paramsArray[":Section".$section."ImgL".$lang] =  " ";    
    $params = "Section".$section."ImgL".$lang." = :Section".$section."ImgL".$lang;
  }
  $preparedStatement = $_conn->prepare('UPDATE product SET ' .$params. ' WHERE ProductId = :ProductId');    
  $preparedStatement->execute($paramsArray);
}


//GALLERY METHODS

function db_getProductGalleryImages($_conn, $_productId)
{     
  $preparedStatement = $_conn->prepare('select * from galleryImage2 where ProductId = :ProductId');
  $preparedStatement->execute(array(':ProductId' => $_productId));
  $result = $preparedStatement->fetchAll();
  if (!$result)
  {
    return null;
  }
  return $result;
}

function db_getProductSectionLangGalleryImages($_conn, $_productId, $_sectionNumber, $_lang)
{     
  $preparedStatement = $_conn->prepare('select GalleryImageId, Img, Title from galleryImage where ProductId = :ProductId AND SectionNumber = :SectionNumber AND Lang = :Lang ORDER BY GalleryImageId');
  $preparedStatement->execute(array(':ProductId' => $_productId, ':SectionNumber' => $_sectionNumber, ':Lang' => $_lang));
  $result = $preparedStatement->fetchAll();
  if (!$result)
  {
    return null;
  }
  return $result;
}

function db_insertGalleryPhoto($_conn, $_productId, $_section, $_lang, $_title, $_imageName, $_titleRepeat, $_imageRepeat)
{  
  if($_imageRepeat == "repeat")
  {
    for($i=1; $i<6; $i++)//do an insert of image (and optionally title) foreach language
    {
      $title = $_title;
      if(($_titleRepeat != "repeat") && ($i != $_lang))// if not repeating title put null for rest of langs != current lang
      {
        $title = null;
      }
      $preparedStatement = $_conn->prepare('INSERT INTO galleryImage(ProductId, SectionNumber, Lang, Img, Title) VALUES (:ProductId, :SectionNumber, :Lang, :Img, :Title)');    
      $preparedStatement->execute(array(':ProductId' => $_productId, ':SectionNumber' => $_section, ':Lang' => $i, ':Img' => $_imageName, ':Title' => $title));
    }
  }
  else  //imageRepeat = false 
  {
    if($_titleRepeat == "repeat")
    {
      for($i=1; $i<6; $i++)//do an insert of the title foreach language and title + image on current lang
      {      
        $imageName = $_imageName;
        if($i != $_lang)//put null for rest of langs != current lang
        {
          $imageName = null;
        }
        $preparedStatement = $_conn->prepare('INSERT INTO galleryImage(ProductId, SectionNumber, Lang, Img, Title) VALUES (:ProductId, :SectionNumber, :Lang, :Img, :Title)');    
        $preparedStatement->execute(array(':ProductId' => $_productId, ':SectionNumber' => $_section, ':Lang' => $i, ':Img' => $imageName, ':Title' => $_title));
      }
    }
    else
    {
      $preparedStatement = $_conn->prepare('INSERT INTO galleryImage(ProductId, SectionNumber, Lang, Img, Title) VALUES (:ProductId, :SectionNumber, :Lang, :Img, :Title)');    
      $preparedStatement->execute(array(':ProductId' => $_productId, ':SectionNumber' => $_section, ':Lang' => $_lang, ':Img' => $_imageName, ':Title' => $_title));
    }
  }  
}

function db_deleteGalleryImage($_conn, $galleryImageId)
{
  $paramsArray = array(':GalleryImageId' => $galleryImageId); 
  $preparedStatement = $_conn->prepare('DELETE FROM galleryImage WHERE GalleryImageId = :GalleryImageId');  
  $preparedStatement->execute($paramsArray);
}

function db_getGalleryImagesNumber($_conn, $_productId, $_section, $_lang)
{
  $preparedStatement = $_conn->prepare('select COUNT(*) from galleryImage where ProductId = :ProductId AND SectionNumber = :SectionNumber AND Lang = :Lang');
  $preparedStatement->execute(array(':ProductId' => $_productId, ':SectionNumber' => $_section, ':Lang' => $_lang));
  $result = $preparedStatement->fetch(PDO::FETCH_COLUMN, 0);  
  if (!$result)
  {
    return 0;
  }
  return $result;
}

?>

