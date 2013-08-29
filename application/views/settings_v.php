<?php
if(!isset($quick_link)){
$quick_link = null;
}  
$userarray = $this->session->userdata;
$user_id = $userarray['user_id'];

$user_typ = User::getUserType($user_id);
$user_type = $user_typ[0]['user_type'];

?>

<?php if($user_type == 2 || $user_type==5) {?>
<div id="sub_menu">
<a href="<?php echo site_url('request_management');?>" class="top_menu_link sub_menu_link first_link  <?php if($quick_link == "request"){echo "top_menu_active";}?>">Requests</a>
<a href="<?php echo site_url("client_management");?>" class="top_menu_link sub_menu_link   <?php if($quick_link == "client"){echo "top_menu_active";}?>">Clients</a>
<a href="<?php echo site_url("test_controller");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "test"){echo "top_menu_active";}?>">Tests</a>
<a href="<?php echo site_url("sample_issue/listing");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Samples Listing"){echo "top_menu_active";}?>">Samples Unissued</a>
<a href="<?php echo site_url("sample_issue/issued_listing");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Samples Listing"){echo "top_menu_active";}?>">Samples Issued</a>
<a href="<?php echo site_url("inventory");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "Inventory"){echo "top_menu_active";}?>">Inventory</a>
<a href="<?php echo site_url("quotation");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "quotation"){echo "top_menu_active";}?>">Quotation</a>
<a href="<?php echo site_url("proforma");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "proforma"){echo "top_menu_active";}?>">Proforma</a>
<a href="<?php echo site_url("supervisors");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "supervisors"){echo "top_menu_active";}?>">Supervisors</a>
<a href="<?php echo site_url("sample_location");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "slocation"){echo "top_menu_active";}?>">Sample Location</a>
<a href="<?php echo site_url("analyst_supervisor");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "an_su"){echo "top_menu_active";}?>">Assign Supervisor</a>

</div>
<?php }?>

<div id="main_content">
<?php
$this->load->view($settings_view);
?>
</div>
