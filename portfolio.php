<?php
/**
 * For add portfoloi
 * @package WordPress
 * @subpackage Administration
 */
 global $wpdb;
 $template_directory_url = get_template_directory_uri();
 $template_directory = get_template_directory();
 $doc_root = $_SERVER['DOCUMENT_ROOT'];//exit;
?>

 <?php
	
	
	//exit;
	if(isset($_POST) && $_POST['submit_btn'] !=""){
		
			//echo "<pre>";print_r($_POST);exit;
			$type = $_POST['type'];
			$category = $_POST['category'];
			$brand   = $_POST['brand'];
			$supplier_link = $_POST['supplier_link'];
			$website_logo = $_FILES["website_logo"]["name"];
			$target_dir = $doc_root.'/wp-content/brand_logo/';//"uploads directory path";
			$target_file = $target_dir . basename($_FILES["website_logo"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			
				$check = getimagesize($_FILES["website_logo"]["tmp_name"]);
				if($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";exit;
					$uploadOk = 0;
				}
			
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;exit;
			}
			// Check file size
			/*if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}*/
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;exit;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";exit;
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["website_logo"]["tmp_name"], $target_file)) {
					//echo "The file ". basename( $_FILES["website_logo"]["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";exit;
				}
			//if upload OK
			if($uploadOk == 1){
				
				 $sql = "INSERT INTO website_brands set type='{$type}' , category ='{$category}' , brand ='{$brand}' , supplier_link ='{$supplier_link}' , logo_url = '{$website_logo}' ";
				
				$wpdb->query($sql);
				$lastid = $wpdb->insert_id;
				if($lastid){
				   echo '<div> Portfolio is added successfully </div>';//$lastid;exit;	
				}
			}
			
	}
}
if($_GET['delid']!=""){
	
	$delid = $_GET['delid'];
	$sql = "DELETE from website_brands WHERE  bid = '{$delid}' ";
				
				$wpdb->query($sql);
				echo '<div> Portfolio has been deleted successfully </div>';
	
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>

  
 <?php
	if($_GET['orderby'] != "" && $_GET['field'] != ""){
		
		$order_by = "ORDER BY ".$_GET['field']." ".$_GET['orderby'];
	}else{
		
		$order_by ="order by bid desc";
	}
	//echo "SELECT * FROM website_brands  $order_by" ;
	$itemNames = $wpdb->get_results("SELECT * FROM website_brands  $order_by ");
	//echo "<pre>";print_r($itemNames);
	echo '<!--<div class="row" style="margin-top: 50px;">'.count($itemNames).' Record found</div>-->';
	echo '<div class="row" style="margin-top: 50px;">';
	echo '<table id="customers"><tr>';
	echo '<th><strong><a href="'.home_url().'/wp-admin/admin.php?page=portfolio&orderby=asc&field=type"><i class="fa fa-arrow-up"></i></a><a href="'.home_url().'/wp-admin/admin.php?page=portfolio&orderby=desc&field=type"><i class="fa fa-arrow-down"></i></a> type</strong></th>';
	echo '<th><strong><a href="'.home_url().'/wp-admin/admin.php?page=portfolio&orderby=asc&field=category"><i class="fa fa-arrow-up"></i></a><a href="'.home_url().'/wp-admin/admin.php?page=portfolio&orderby=desc&field=category"><i class="fa fa-arrow-down"></i></a> category</strong></th>';
	echo '<th><strong>
	<a href="'.home_url().'/wp-admin/admin.php?page=portfolio&orderby=asc&field=brand"><i class="fa fa-arrow-up"></i></a><a href="'.home_url().'/wp-admin/admin.php?page=portfolio&orderby=desc&field=brand"><i class="fa fa-arrow-down"></i></a> brand</strong> </th>';
	echo '<th><strong>supplier link</strong></th>';
	echo '<th><strong>logo link</strong></th>';
	echo '<th><strong>edit link</strong></th></tr>';
	foreach ( $itemNames as $itemName ) 
			{
				$item_bid       = $itemName->bid;
				$type = $itemName->type;
				$category = $itemName->category;
				$brand = $itemName->brand;
				$supplier_link = $itemName->supplier_link;
				$logo_url       = $itemName->logo_url;
				$edit_url = home_url().'/wp-admin/admin.php?page=edit_portfolio&bid='.$item_bid;
				$del_url = home_url().'/wp-admin/admin.php?page=portfolio&delid='.$item_bid;
				
				/*echo '<div class="col-lg-3">';
				echo '<div class="brands-images">';
				echo '<a href="http://'.$supplier_link.'" target="_blank">';
				echo '<img src="'.$template_directory_url.'/images/brand_logo/'.$logo_url.'" alt="'.$logo_url.'" width="40%" height="40%" /></a>';
				echo '<div class="button-detail">';
				echo '<a href="'.$edit_url.'" target="_blank">Edit</a>';
				echo ' </div>';
				//echo '';
				echo ' </div>';
				echo ' </div>';*/
				echo '<tr><td> '.$type.' </td>';
				echo '<td>'.$category.'</td>';
				echo '<td>'.$brand.' </td>';
				echo '<td><a href="http://'.$supplier_link.'" target="_blank">website link</a></td>';
				echo '<td><a href="'.home_url().'/wp-content/brand_logo/'.$logo_url.'" target="_blank">logo link</a></td>';
				echo '<td><a href="'.$edit_url.'">Edit </a> | <a href="'.$del_url.'">Delete </a></td></tr>';
			}
	echo '</table>';		
	echo ' </div>';
	
?>