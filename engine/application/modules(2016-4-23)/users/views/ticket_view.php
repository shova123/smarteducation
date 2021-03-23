<?php
$groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());
$loginUserDetails = $this->ion_auth->login_user_details();
$login_userToken = $loginUserDetails->user_token;
$login_userId = $loginUserDetails->user_id;
?>
<div class="clearfix"></div>
<div class="row">
    <?php
    if(!empty($ticket_details)){
        $ticket_id = $ticket_details->ticket_id;
        $ticket_ticket_u_id = $ticket_details->ticket_u_id;
        $ticket_token = $ticket_details->ticket_token;
        $ticket_subject = $ticket_details->subject;
        $ticket_body = $ticket_details->body;
        $ticket_priority = $ticket_details->priority;
        $ticket_attachment = $ticket_details->attachment;
        $ticket_status = $ticket_details->status;
        $ticket_ip_address = $ticket_details->ip_address;
        $ticket_date = $ticket_details->date;
        
        
    ?>
    <div class="col-sm-8">
        <h2><i class="fa fa-ticket"></i> # <?php echo ucfirst($ticket_subject);?></h2>
        <hr>
        <?php
        if(!empty($ticket_replies)){
            
            foreach($ticket_replies as $replies){
                $user_image='';
                $imagePath='';
                $replier_t_reply_id = $replies->t_reply_id;
                $replier_content = $replies->content;
                $replier_type = $replies->replier;
                $replier_id = $replies->replier_id;
                $replier_time = $replies->time;
                
                $user_user_id = $replies->user_id;
                $user_c_user_id = $replies->c_user_id;
                $user_username = $replies->username;
                $user_first_name = $replies->first_name;
                $user_last_name = $replies->last_name;
                $user_userFULL_NAME = "$user_first_name $user_last_name";
                $user_email = $replies->email;
                $user_phone = $replies->phone;
                $user_address = $replies->address;
                $user_lat = $replies->lat;
                $user_lng = $replies->lng;
                $user_image = $replies->home_image;
                if(!empty($user_image)){
                    $imagePath = "profile/$user_image";
                }else{
                    $imagePath = "no-image.jpg";
                }
        ?>
        <?php
            if($ticket_ticket_u_id == $replier_id){
        ?>
        <!-- FIRST PERSON -->
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <!--<img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTFlMWQ0YWNlZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MWUxZDRhY2VlIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">-->
                    <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/<?php echo $imagePath;?>&w=64&h=64" alt="<?php echo $user_userFULL_NAME;?>" class="media-object" />
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php if(!empty($user_userFULL_NAME)){echo ucfirst($user_userFULL_NAME);}else{echo $user_email;}?></h4>
                <?php echo $replier_content;?>
            </div>
        </div>
        <hr>
        <?php }elseif($ticket_ticket_u_id != $replier_id){
        ?>
            <!-- SECOND PERSON -->
            <div class="media">
                <div class="media-body">
                    <h4 class="media-heading"><?php if(!empty($user_userFULL_NAME)){echo ucfirst($user_userFULL_NAME);}else{echo $user_email;}?></h4>
                    <?php echo $replier_content;?>
                </div>
                <div class="media-right">
                    <a href="#">
                        <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/<?php echo $imagePath;?>&w=64&h=64" alt="<?php echo $user_userFULL_NAME;?>" class="media-object" />
                    </a>
                </div>
            </div>
            <hr>
        <?php }?>
        
        <?php }}?>
        
        <form method="post" action="<?php echo base_url("users/support_reply");?>">
            <input type="hidden" name="ticket_id" value="<?php echo $ticket_id;?>"/>
            <input type="hidden" name="replier" value="<?php echo $groupTypeDashboardName;?>"/>
            <input type="hidden" name="replier_id" value="<?php echo $login_userId;?>"/>
            <div class="input-group">
                <label class="sr-only" for="msg">reply</label>
                <input type="text" name="content" class="form-control" placeholder="Send Message" id="msg">
                <span class="input-group-btn">
                    <input type="submit" name="submit" value="SEND !" class="btn btn-info" style="border:1px solid #ddd" >
<!--                    <button class="btn btn-info" style="border:1px solid #ddd" type="button">SEND !</button>-->
                </span>
            </div>					
        </form>
        <hr>
    </div>
    <div class="col-sm-4" style="padding-top:30px;">
        <div class="panel panel-default">
            <div class="panel-heading">Ticket Details</div>
            <div class="panel-body">
                <?php echo $ticket_body;?>
            </div>
            <ul class="list-group">
                <li class="list-group-item">Created On : <?php echo $ticket_date;?></li>
                <li class="list-group-item">Ticket Status : <?php echo ucfirst($ticket_status);?></li>
                
            </ul>
        </div>
    </div>
    <?php }?>
</div>
