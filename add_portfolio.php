<?php
/**
 * For add portfoloi
 * @package WordPress
 * @subpackage Administration
 */
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<div class="row" align="left" style="margin-left:100px;">
  <div class="col-sm-12">
  <form enctype="multipart/form-data" action="<?php echo home_url();?>/wp-admin/admin.php?page=portfolio" method="post" id="add-portfolio">
        <input type="hidden" name="action" id="action" value="add_portfolio_post">
    <select id="type" class="styledSelect" name="type">
      <option value="">All Type...</option>
      <option value="Alcohol">Alcohol</option>
      <option value="Non-Alcohol">Non-Alcohol</option>
    </select>
  </div> <br /><br />
  <div class="col-sm-12">
    <!--<select id="category" class="styledSelect" name="category">
      <option value="">All Category..</option>
      <option value="CIDER">CIDER</option>
      <option value="CRAFT">CRAFT</option>
      <option value="DOMESTIC SPECIALTY">DOMESTIC SPECIALTY</option>
      <option value="FMB">FMB</option>
      <option value="HARD SELTZERS">HARD SELTZERS</option>
      <option value="IMPORT">IMPORT</option>
      <option value="MALT LIQUOR">MALT LIQUOR</option>
      <option value="MIXERS">MIXERS</option>
      <option value="NEW AGE">NEW AGE</option>
      <option value="PREMIUM">PREMIUM</option>
      <option value="SODA">SODA</option>
      <option value="SPIRITS">SPIRITS</option>
      <option value="SUB PREMIUM">SUB PREMIUM</option>
      <option value="TEA/JUICE">TEA/JUICE</option>
      <option value="WATER">WATER</option>
      <option value="WINE">WINE</option>
      <option value="WINE PRODUCTS">WINE PRODUCTS</option>
    </select>-->
    <input type="text" name="category" placeholder="add category" value="" size="30" maxlength="30" id="category" tabindex="2" />
  </div><br /><br />
  <div class="col-sm-12">
    <input type="text" name="brand" placeholder="add brand" value="" size="30" maxlength="30" id="brand" tabindex="3" />
  </div><br /><br />
  <div class="col-sm-12">
    <input type="text" name="supplier_link" placeholder="add website link" value="" size="60" maxlength="60" id="supplier_link" tabindex="4" />
  </div><br /><br />
 <div class="col-sm-12">
    <input type="file" name="website_logo" placeholder="add website logo" value="" size="60" maxlength="60" id="website_logo" tabindex="5" />
 </div><br /><br />
  <div class="col-sm-12">
    <input type="submit" name="submit_btn"  value="submit"  id="submit_btn" tabindex="6" />
  </div><br /><br />
  </div>
 <?php
     add_action('wp_ajax_add_portfolio_post', 'add_portfolio_post');
     add_action('wp_ajax_nopriv_add_portfolio_post', 'add_portfolio_post');
	 
     function add_portfolio_post(){
		 
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