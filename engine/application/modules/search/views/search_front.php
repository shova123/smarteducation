<script>
$(function(){	
    $('.click_event').click(function(){ 
	var _val = $(this).attr('value');
        alert(_val);
        //var _this = $(this);//alert(_id);
        //$.post(URL,data,callback); 
        $.post('<?php echo admin_url('search/quick_search');?>', {value : _val},
		//alert(data);
            function(data){
                 alert("Data: " + data + "\nStatus: " + status);
                _this.text(data);
				$('a#'+_val+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>
<div class="inner-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
            <h1>Quick Search</h1>
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 nomargin">
                    <table class="table table-bordered" width="100%">
                        <tr>
                            <th>Posted Date</th>
                            <th>Job Title</th>
                            <th>Deadline</th>
                            <th>Locations</th>
                            <th>Type</th>
                        </tr>
                    <?php 
                        if(!empty($search_result)){
                            foreach($search_result as $quickSearch){
                                $job_Id = $quickSearch->id;
                                
                                $Y = date('Y', strtotime($quickSearch->posted_date));
                                $m = date('m', strtotime($quickSearch->posted_date));
                                $d = date('d', strtotime($quickSearch->posted_date));
                                $apply_befor = $quickSearch->apply_before;
                                $final_day = $d+$apply_befor;
                    ?>
                        <tr>
                            <td><?php echo $quickSearch->posted_date;?></td>
                            <td><a href="<?php echo base_url("jobManager/job_details/$job_Id");?>"><?php echo $quickSearch->job_title;?>)</a></td>
                            <td><?php echo $Y.'-'.$m.'-'.$final_day;?></td>
                            <td><?php echo $quickSearch->job_location;?></td>
                            <td><span class="full-time"><?php echo $quickSearch->job_type;?></span></td>
                        </tr>
                    <?php }}?>    
                    </table>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <form method="post" action="<?php echo base_url("search/quick_search");?>">
                        <table class="table" width="100%">
                            <tr>
                                <td width="144"><input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your user name"></td>
                                <td width="134"><button type="button" class="btn btn-default" href="#search">Go</button></td>
                            </tr>
                            <tr class="active">
                                <td colspan="2"><h3>Category</h3></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <select name="job_categories" onchange="form.submit();">
                                        <option value="">--Select Job Category--</option>
                                    <?php if(!empty($job_category)){
                                        foreach($job_category as $jobCat){?>    
                                        <option value="<?php echo $jobCat->c_id;?>"><?php echo $jobCat->category_title;?></option>
                                    <?php }}?>
                                    </select>
                                </td>
                            </tr>
<!--                            <tr class="active">
                                <td colspan="2"><h3>Industry</h3></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <select>
                                        <option>--Select Organization Type--</option>
                                        <option>Advertising Agency</option>
                                        <option>Airlines / GSA</option>
                                        <option>Architecture / Interior Design Firm</option>
                                    </select> 
                                </td>
                            </tr>-->
                            <tr class="active">
                                <td colspan="2"><h3>Level</h3></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" onclick="form.submit();" name="job_level" value="Top"/> Top</td>
                                <td><input type="checkbox" onclick="form.submit();" name="job_level" value="Mid"/> Mid</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" onclick="form.submit();" name="job_level" value="Senior"/> Senior</td>
                                <td><input type="checkbox" onclick="form.submit();" name="job_level" value="Entry"/> Entry</td>
                            </tr>
                            <tr class="active">
                                <td colspan="2"><h3>Education</h3></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" onclick="form.submit();" name="education_qualification" value="master"/> Master</td>
                                <td><input type="checkbox" onclick="form.submit();" name="education_qualification" value="bachelor"/> Bachelor</td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" onclick="form.submit();" name="education_qualification" value="intermediate"/> + 2</td>
                            </tr>
                            <tr class="active">
                                <td colspan="2"><h3>Type</h3></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" onclick="form.submit();" name="job_type" value="full"/> Full Timer</td>
                                <td><input type="checkbox" onclick="form.submit();" name="job_type" value="part"/> Part Time</td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" onclick="form.submit();" name="job_type" value="contract"/> Contract</td>
                            </tr>
                            <tr class="active">
                                <td colspan="2"><h3>Location:</h3></td>
                            </tr>
                            <tr>
                            <td colspan="2">
                                 <select name="job_location" onchange="form.submit();">
                                    <option value="">Select Job Location</option>
                                    <option>Butwal</option>
                                    <option>Bhairahawa</option>
                                    <option>Birgunj</option>
                                </select> 
                            </td>
                            </tr>
                            <tr><input type="hidden" name="eventSubmit" value="eventSubmit" style="display: none;"/></tr>
                        </table>
                    </form>
                </div>
            </div>
            </div>
        </div>
        
        <hr />
        
        <div class="row">
            <div class="col-lg-12 col-md-12 cat">
                <div class="col-lg-4 col-md-4 nomargin nopadding"><h3>In Demand</h3>
                    <ul>
                        <?php 
                            if(!empty($in_demand_category)){
                                foreach($in_demand_category as $demandIN){
                                    $job_categoryID = $demandIN->job_category;
                                    
                                $cat_query = mysql_query("SELECT * FROM tbl_job_category WHERE c_id ='".$job_categoryID."' AND status='Publish' ");
                                while($cat_result = mysql_fetch_array($cat_query)){
                                    $catIDs = $cat_result['c_id'];
                        ?>
                        <li><a href="<?php echo base_url("search/quick_search/$catIDs");?>"><?php echo $cat_result['category_title'];?></a></li>
                        <?php }}}?>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-8 nomargin nopadding"><h3>Browse jobs</h3>
                    <div class="col-lg-6 col-md-6 nomargin nopadding">
                        <ul>
                            <?php 
                            //($count%2==0)
                            if(!empty($job_category)){
                                        $count=0;
                                        foreach($job_category as $jobCat){
                                            //echo $job_category[$count]->category_title;
                                            if(($count%2==0)){
                                                $IDsCatEven = $job_category[$count]->c_id;
                            ?>
                            <li><a href="<?php echo base_url("search/quick_search/$IDsCatEven");?>"><?php echo $job_category[$count]->category_title;?></a></li>                
                            <?php        
                                            }else{
                                                
                                            }
                            ?>    
                                        
                                    <?php $count++;}}?>
                           
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 nomargin nopadding">
                        <ul>
                            <ul>
                            <?php 
                            //($count%2==0)
                            if(!empty($job_category)){
                                        $count=0;
                                        foreach($job_category as $jobCat){
                                            //echo $job_category[$count]->category_title;
                                            if(($count%2==0)){
                                            }else{
                                                $IDsCatOdd = $job_category[$count]->c_id;
                            ?>
                            <li><a href="<?php echo base_url("search/quick_search/$IDsCatOdd");?>"><?php echo $job_category[$count]->category_title;?></a></li>                
                            <?php                    
                                            }
                            ?>    
                                        
                                    <?php $count++;}}?>
                           
                        </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>