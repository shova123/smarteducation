<?php 
$this->db->select('*');
$this->db->order_by("id");
$query = $this->db->get("tbl_services"); 
$return = $query->result_array(); 

if(!empty($return)){
//    $i=0;
//    foreach($page as $ipage){
        $title0=$return[0]['heading']; 
       
        
        $title4=$return[4]['heading']; 
       
        $title5=$return[5]['heading']; 
        
        
//    $i++;}
}
?>

<div class="row side-services">
  <h3>Our Services<small class="pull-right vall"><a href="<?php echo base_url("home/our_services");?>" title="view all services"><i class="glyphicon glyphicon-eye-open"></i> View All</a></small></h3>
    <div class="col-xs-12">
    <div class="box transtyle">
        <i class="glyphicon glyphicon-star servicon"></i><p><span class=""></span><a href="<?php echo base_url("home/our_services");?>#training"><?php echo @$title0;?></a></p>
    </div>
    </div>
    <div class="col-xs-12">
    <div class="box transtyle">
      <i class="glyphicon glyphicon-time servicon"></i><p><span class=""></span><a href="<?php echo base_url("home/our_services");?>#contracts"><?php echo @$title4;?></a></p>
    </div>
    </div>
    <div class="col-xs-12">
    <div class="box transtyle">
      <i class="glyphicon glyphicon-pencil servicon"></i><p><span class=""></span><a href="<?php echo base_url("home/our_services");?>#assessment"><?php echo @$title5;?></a></p>
    </div>
    </div>
  </div>