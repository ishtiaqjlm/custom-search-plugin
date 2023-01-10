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
 if(isset($_GET['bid']) && $_GET['bid'] != ""){
	 
	 $bid = $_GET['bid'];
	 $itemNames = $wpdb->get_results("SELECT * FROM website_brands  where bid='{$bid}'");
	 foreach ( $itemNames as $itemName ) 
			{
				$item_bid       = $itemName->bid;
				$type = $itemName->type;
				$category = $itemName->category;
				$brand = $itemName->brand;
				$supplier_link = $itemName->supplier_link;
				$logo_url       = $itemName->logo_url;
			}
}
if(isset($_POST['postbid']) && $_POST['postbid'] != ""){
	 
		    $bid = $_POST['postbid'];
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
			/*if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;exit;
			}*/
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
			   
			    echo $sql = "update website_brands  set type='{$type}' , category ='{$category}' , brand ='{$brand}' , supplier_link ='{$supplier_link}' , logo_url = '{$website_logo}' where bid='{$bid}'";
	 
	 if($wpdb->query($sql)){
		 
		  $redirect_url = get_site_url().'/wp-admin/admin.php?page=portfolio';
	     //header("Location: ".$redirect_url);
		   echo '<script>
		   window.location="'.$redirect_url.'";
		   </script>';
	 	   exit;
	 }
	 else{
		  echo "Fail to update the record";
		 }
			
	}
  }
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<div class="row">
  <div class="col-sm-12">
  <form enctype="multipart/form-data" action="" method="post" id="edit-portfolio">
        <input type="hidden" name="action" id="action" value="add_portfolio_post">
        <input type="hidden" name="postbid" id="postbid" value="<?php echo $item_bid ?>">
    <select id="type" class="styledSelect" name="type">
      <option value="">All Type...</option>
      <option <?php if($type == 'Alcohol'){?> selected="selected" <?php } ?> value="Alcohol">Alcohol</option>
      <option <?php if($type == 'Non-Alcohol'){?> selected="selected" <?php } ?> value="Non-Alcohol">Non-Alcohol</option>
    </select>
  </div><br /><br />
  <div class="col-sm-12">
    <!--<select id="category" class="styledSelect" name="category">
      <option value="">All Category..</option>
      <option <?php if($category == 'CIDER'){?> selected="selected" <?php } ?> value="CIDER">CIDER</option>
      <option <?php if($category == 'CRAFT'){?> selected="selected" <?php } ?>value="CRAFT">CRAFT</option>
      <option <?php if($category == 'DOMESTIC SPECIALTY'){?> selected="selected" <?php } ?>value="DOMESTIC SPECIALTY">DOMESTIC SPECIALTY</option>
      <option <?php if($category == 'FMB'){?> selected="selected" <?php } ?>value="FMB">FMB</option>
      <option <?php if($category == 'HARD SELTZERS'){?> selected="selected" <?php } ?>value="HARD SELTZERS">HARD SELTZERS</option>
      <option <?php if($category == 'IMPORT'){?> selected="selected" <?php } ?>value="IMPORT">IMPORT</option>
      <option <?php if($category == 'MALT LIQUOR'){?> selected="selected" <?php } ?>value="MALT LIQUOR">MALT LIQUOR</option>
      <option <?php if($category == 'MIXERS'){?> selected="selected" <?php } ?>value="MIXERS">MIXERS</option>
      <option <?php if($category == 'NEW AGE'){?> selected="selected" <?php } ?>value="NEW AGE">NEW AGE</option>
      <option <?php if($category == 'PREMIUM'){?> selected="selected" <?php } ?>value="PREMIUM">PREMIUM</option>
      <option <?php if($category == 'SODA'){?> selected="selected" <?php } ?>value="SODA">SODA</option>
      <option <?php if($category == 'SPIRITS'){?> selected="selected" <?php } ?>value="SPIRITS">SPIRITS</option>
      <option <?php if($category == 'SUB PREMIUM'){?> selected="selected" <?php } ?>value="SUB PREMIUM">SUB PREMIUM</option>
      <option <?php if($category == 'TEA/JUICE'){?> selected="selected" <?php } ?>value="TEA/JUICE">TEA/JUICE</option>
      <option <?php if($category == 'WATER'){?> selected="selected" <?php } ?>value="WATER">WATER</option>
      <option <?php if($category == 'WINE'){?> selected="selected" <?php } ?>value="WINE">WINE</option>
      <option <?php if($category == 'WINE PRODUCTS'){?> selected="selected" <?php } ?>value="WINE PRODUCTS">WINE PRODUCTS</option>
    </select>-->
    <input type="text" name="category" placeholder="add category" value="<?php echo $category ?>" size="30" maxlength="30" id="category" tabindex="2" />
  </div><br /><br />
  <div class="col-sm-12">
    <input type="text" name="brand" placeholder="add brand" value="<?php echo $brand ?>" size="30" maxlength="30" id="brand" tabindex="3" />
  </div><br /><br />
  <div class="col-sm-12">
    <input type="text" name="supplier_link" placeholder="add website link" value="<?php echo $supplier_link ?>" size="60" maxlength="60" id="supplier_link" tabindex="4" />
  </div><br /><br />
 <div class="col-sm-12">
    <input type="file" name="website_logo" placeholder="add website logo" value="<?php echo $logo_url ?>" size="60" maxlength="60" id="website_logo" tabindex="5" />
 </div><br /><br />
  <div class="col-sm-12">
    <input type="submit" name="submit_btn"  value="Edit"  id="submit_btn" tabindex="6" />
  </div><br /><br />
  </div>
 <?php
     add_action('wp_ajax_add_portfolio_post', 'edit_portfolio_post');
     add_action('wp_ajax_nopriv_add_portfolio_post', 'edit_portfolio_post');
	 
     function edit_portfolio_post(){
		 
		     echo "<pre>";print_r($_POST);exit;
		 } 
 ?>
 <script>
 	$(document).on('click', '#submit_btn', function() {
		  
		  var action = $('#action').val();// Action goes here.
		  var type  = $('#type').val();// Action goes here.
		  var category = $('#category').val();
		  var brand = $('#brand').val();
		  var supplier_link = $('#supplier_link').val();
		  //var supplier_link = $('#supplier_link').val();
		  
		  
		  $.ajax({
						url:"<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",	   
						type:'POST',
						//data:'action=custom_search&type='+type+'&category='+category+'&sort_by='+sort_by+'&brand='+brand,// + '&pid=' + $product,
						data:'action=add_portfolio_post&type='+type+'&category='+category+'&brand='+brand+'&supplier_link='+supplier_link,						   
						success:function(results)
						{
							 console.log(results);
							//$("#resultarea").html('');	
							//$("#resultarea").html(results);       
							//document.getElementById("productsListHolder").innerHTML=results;
							//$('#resultarea').show();
							//$('.loader').hide();
					    
						}
				});
		  
		});
 </script>