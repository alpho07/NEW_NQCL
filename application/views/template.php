<?php
if (!$this -> session -> userdata('user_id')) {
	redirect("user_management/login");
}
if (!isset($link)) {
	$link = null;
}
if (!isset($quick_link)) {
	$quick_link = null;
}
$access_level = $this -> session -> userdata('user_indicator');

$user_is_facility = false;
$user_is_moh = false;
$user_is_district=false;
$user_is_moh_user=false;
$user_is_facility_user = false;
$user_is_kemsa=false;

if ($access_level == "facility") {
	$user_is_facility = true;
}
if ($access_level == "moh") {
	$user_is_moh = true;
}
if ($access_level == "district") {
	$user_is_district = true;
}
if($access_level=="moh_user"){
	$user_is_moh_user=true;
}
if($access_level=="fac_user"){
	$user_is_facility_user =true;
}
if($access_level=="kemsa"){
	$user_is_kemsa=true;
}
?>
<?php //foreach($name_facility->Codes as $drug){echo $drug->facility_name;}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url().'CSS/styles.less'?>" type="text/less" media="screen" rel="stylesheet"/> 
<link href="<?php echo base_url().'Scripts/fancybox/source/jquery.fancybox.css?v=2.1.3'?>" type="text/css" media="screen" rel="stylesheet"/>
<link href="<?php echo base_url().'Scripts/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7'?>" type="text/css" media="screen" rel="stylesheet"/>  
<link href="<?php echo base_url().'Scripts/'?>" type="text/css" media="screen" rel="stylesheet"/> 
<link href="<?php echo base_url().'CSS/style.css'?>" type="text/css" rel="stylesheet"/> 
<link href="<?php echo base_url().'CSS/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'CSS/validationEngine.jquery.css'?>" type="text/css" rel="stylesheet"/> 

<script src="<?php echo base_url().'Scripts/jquery-1.10.2.js'?>"></script>
<script src="<?php echo base_url().'Scripts/migrate.js'?>"></script>
<script src="<?php echo base_url().'Scripts/jquery-ui.js'?>" type="text/javascript"></script> 


<script src="<?php echo base_url().'Scripts/relCopy.query.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/jquery.validate.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/fancybox/lib/jquery.mousewheel-3.0.6.pack.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5'?>" type="text/javascript"></script>  
<script src="<?php echo base_url().'Scripts/fancybox/source/jquery.fancybox.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/fancybox/source/jquery.fancybox.pack.js?v=2.1.3'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/jquery.validationEngine.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/jquery.validationEngine-en.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url();?>Scripts/jquery-bubble-popup-v3/scripts/jquery-bubble-popup-v3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>Scripts/jquery-impromptu.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>Scripts/jquery.simplemodal-1.4.4.js" type="text/javascript"></script> 
<link href="<?php echo base_url();?>Scripts/jquery-bubble-popup-v3/css/jquery-bubble-popup-v3.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>Scripts/messi.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>Scripts/jquery.lightbox_me.js" type="text/javascript"></script> 
<link href="<?php echo base_url();?>Scripts/messi.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>Scripts/jquery.validity.min.js" type="text/javascript"></script> 
<link href="<?php echo base_url();?>Scripts/jquery.validity.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>Scripts/jquery-impromptu.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url().'javascripts/jquery.dumbformstate-1.0.1.js'?>"></script>

<link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css'?>" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url().'javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'javascripts/DataTables-1.9.3/media/js/jquery.dataTables.grouping.js'?>" type="text/javascript"></script> 

  <script type="text/javascript" src="<?php echo base_url().'javascripts/noty/jquery.noty.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'javascripts/noty/layouts/topCenter.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'javascripts/noty/themes/default.js'?>"></script>
  <link href="<?php echo base_url().'javascripts/noty/button.css'?>" rel="stylesheet" type="text/css" />
  
  <script type="text/javascript" src="<?php echo base_url().'javascripts/jw/jquery-waiting.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'javascripts/jw/jquery-litelighter.js'?>"></script>


<?php
if (isset($script_urls)) {
	foreach ($script_urls as $script_url) {
		echo "<script src=\"" . $script_url . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($scripts)) {
	foreach ($scripts as $script) {
		echo "<script src=\"" . base_url() . "Scripts/" . $script . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($styles)) {
	foreach ($styles as $style) {
		echo "<link href=\"" . base_url() . "CSS/" . $style . "\" type=\"text/css\" rel=\"stylesheet\"/>";
	}
}
?>  
<script type="text/javascript">
	$(document).ready(function() {
		$("#my_profile_link").click(function(){
			$("#logout_section").css("display","block");
		});

	});

</script>
</head>

<body>
<div id="wrapper">
	<div id="top-panel">
		
		<div>
		
			    <!--div id="nqcl_logo">
				<a class="logo" href="<?php echo base_url();?>"><img src="<?php echo base_url() . "Images/nqcl_logo_full.png"; ?>"></a> 
				</div-->

				<!--div class="center_text" id="project_title">
				<a href="http://www.nqcl.co.ke"><h3></h3></a>
				</div-->
				
				<!--div id="moh_logo" class="align_rignt" >
				<a href=""><img src="<?php echo base_url()."Images/moh_logo.png"; ?>" /></a>
				</div-->
				
		</div>
	
				<?php $facility=$this -> session -> userdata('news');?>
 
 <!--div id="top_menu"> 

 	<?php
	//Code to loop through all the menus available to this user!
	//Fet the current domain
	$menus = $this -> session -> userdata('menu_items');
	$current = $this -> router -> class;
	$counter = 0;
?>
 	<a href="<?php echo base_url();?>home_controller" class="top_menu_link  first_link <?php
	if ($current == "home_controller") {echo " top_menu_active ";
	}
?>">Home </a>
<a href="<?php echo base_url();?>request_management" class="top_menu_link  first_link <?php
	if ($current == "request_management") {echo " top_menu_active ";
	}
?>">Tab A </a>

<?php if($user_is_facility_user){
	?>
	 	<a href="<?php echo base_url();?>order_management" class="top_menu_link <?php
	if ($quick_link == "order_listing") {echo " top_menu_active ";
	}
?>"> Orders </a> 



	
	<?php
}
?>
<?php if($user_is_district){
	?>
	 	<a href="<?php echo base_url();?>order_approval/district_orders" class="top_menu_link  first_link <?php
	if ($quick_link == "new_order") {echo " top_menu_active ";
	}
?>">District Orders</a>
	 	<a href="<?php echo base_url();?>user_management/dist_manage" class="top_menu_link  first_link <?php
	if ($current == "user_management") {echo " top_menu_active ";}?>">Users</a>
	<?php }
?>
<?php if($user_is_moh){
	?> 	
	 	<a href="<?php echo base_url();?>user_management/moh_manage" class="top_menu_link  first_link <?php
	if ($current == "user_management") {echo " top_menu_active ";}?>">Users</a>
	<?php }
?>
<?php
if($user_is_facility){
?>
 	<a href="<?php echo base_url();?>request_management" class="top_menu_link <?php
	if ($quick_link == "request_management") {echo " top_menu_active ";
	}
?>"> Tab A </a> 

<a href="<?php echo base_url();?>Issues_main" class="top_menu_link <?php
	if ($current == "Issues_main") {echo " top_menu_active ";
	}
?>">Tab B </a>	



 <?php
} ?>
<?php if($user_is_kemsa){
	?>
	<a href="<?php echo site_url('order_management/kemsa_order_v');?>" class="top_menu_link <?php
	if ($quick_link == "kemsa_order_v") {echo " top_menu_active ";
	}
?>">Orders</a>
	<?php
}
?>

<a ref="#" class="top_menu_link" id="my_profile_link"><?php echo "NQCL" ?></a>
 </div-->
<label class="labrefno" style="float: right; margin-right: 40px; margin-top: 0px;">Welcome, <?php /*echo $this -> session -> userdata('user_id')*/;?> <?php 

$userarray = $this->session->userdata;
$user_id = $userarray['user_id'];
	
$user_typ = User::getUserType($user_id);
$user_name = $user_typ[0]['fname'];

echo $user_name ;	
	?><a  class="link" href="<?php echo base_url();?>user_management/login"> | Logout</a><br>
<a href="<?php echo base_url();?>messages/inbox">My messages (<?php echo $this->session->userdata('messages');?>)</a><!--a  class="link" href="<?php echo base_url();?>user_management/reset_pass">Change Password</a></label-->

</div>

<div id="inner_wrapper"> 
<!-- MOH USR-->

<?php if($user_is_moh_user){
	?>
<div id="sub_menu">
	<a style="width:150px !important" href="<?php echo site_url('stock_management/stock_level_moh');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "load_stock") {echo "top_menu_active";
	}
	?>">Stock Level</a>
	<a style="width:150px !important" href="<?php echo site_url('order_management/moh_order_v');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "moh_order_v") {echo "top_menu_active";
	}
	?>">View Orders</a>
	<a style="width:150px !important" href="<?php echo site_url('order_management/unconfirmed');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "unconfirmed_orders") {echo "top_menu_active";
	}
	?>">Unconfirmed Orders</a>
	<a style="width:150px !important" href="<?php echo site_url('raw_data/trends');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "trends") {echo "top_menu_active";
	}
	?>">Trends</a>
	
</div>
<?php
}
?>
<?php if($user_is_moh){
	?>
<div id="sub_menu">
	<a style="width:150px !important" href="<?php echo site_url('stock_management/stock_level_moh');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "load_stock") {echo "top_menu_active";
	}
	?>">Stock Level</a>
	<a style="width:150px !important" href="<?php echo site_url('order_management/moh_order_v');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "moh_order_v") {echo "top_menu_active";
	}
	?>">View Orders</a>
    <a style="width:150px !important" href="<?php echo site_url('raw_data/getCounty');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "Consumption") {echo "top_menu_active";
	}
	?>">Consumption</a>
	<a style="width:150px !important" href="<?php echo site_url('raw_data/trends');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "trends") {echo "top_menu_active";
	}
	?>">Trends</a>
	
	
	
		
</div>
<?php
}
?>
<div id="main_wrapper"> 
 
<?php $this -> load -> view($content_view);?>
 
 
<!-- end inner wrapper --></div>
  <!--End Wrapper div--></div>
    <div id="bottom_ribbon">
        <div id="footer">
 <?php $this -> load -> view("footer_v");?>
    </div>
    </div>
</body>
</html>
