<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'success';$color = '#fff';
        if($this->session->flashdata('success_message')){$message = $this->session->flashdata('success_message');}
        else if($this->session->flashdata('message')){$message = $this->session->flashdata('message');}
        else if($message){$message = $message;}
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'danger';$color = '#fff';
        if($this->session->flashdata('error_message')){$message = $this->session->flashdata('error_message');}
        else{$message = @$error_message;}
        
}else
{$display = '';$formClass = '';$formOuter = 'outer';$formHead ='head';$alertclass = 'danger';$color = '#000';$message = $this->session->flashdata('error_message');}
?>

<!--<style type="text/css">
    div .has-error{
        background-color: #a94442;
        color: #FFF !important;
        /*opacity: 0.6;*/
    }
</style>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/styles.css">
<!--
<div class="carousel slide hidden-xs" id="carousel-example-generic" data-ride="carousel">
	<ol class="carousel-indicators">
            <?php
            if (!empty($home_slider)) {
                $count =0;
                foreach ($home_slider as $slidersImages) {
            ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $count;?>" <?php if($count ==0){?>class="active"<?php }?>></li>
            <?php $count++;}}?>
	</ol>
    <div class="carousel-inner" style="">
        <?php
        if (!empty($home_slider)) {
            $counter =0;
            foreach ($home_slider as $slidersImages) {
                $slideTITLE = $slidersImages->title;
                $slideIMAGE = $slidersImages->imgname;
                $slideDESCRIBE = $slidersImages->describe;
        ?>
        <div class="item <?php if($counter ==0){echo 'active'; }?>">
        	<div class="fill" style="background:url('./uploads/slides/<?php echo $slideIMAGE;?>') no-repeat fixed center center"></div>
            <img src="<1?php echo base_url();?>uploads/slides/<1?php echo $slideIMAGE;?>"> 
            
            <img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/slides/<?php echo $slideIMAGE;?>&w=1500&h=800" alt="<?php echo $slideTITLE; ?>"/>
        </div>
        <?php $counter++;}}?>
    </div>
</div>-->
<div class="clearfix"></div>
<div class="dark-bg search-course" style="margin-top:75px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<h2>Find Materials</h2>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="sr-only">Search Keywords</label>
					<input type="text" class="form-control" placeholder="Keywords">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="sr-only">Choose Level</label>
					<select class="form-control">
						<option>-- Choose Level --</option>
						<option value="slc">SLC</option>
						<option value="+2">Plus Two</option>
						<option value="Bachelors">Bachelors</option>
					</select>
				</div>
			</div>
			<div class="col-sm-2 col-sm-offset-1">
				<div class="form-group">
					<input type="submit" value="search" class="btn btn-primary btn-block" name="search">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!--/special intro-->
<section class="fill2 large-gap">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 ">
                <iframe width="90%" height="315" src="https://www.youtube.com/embed/M0HAfbZFWp4?rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-7 col-md-6 col-md-offset-1 intro-desc">
                <div class="heading">
                    <h1>Signin Form</h1>
                </div>
                <form action="<?php echo base_url('signin/login'); ?>" method="post" id="form" class="form-validate" accept-charset="utf-8">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <a href="<?php echo base_url("linkedin_signup/initiate");?>" class="btn btn-primary linked-login"><i class="fa fa-linkedin"></i> Signin With LinkedIn</a>
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label for="text" class="sr-only">Username</label>
                            <input type="text" name='identity' id="identity" value="" placeholder="Email:" class='form-control' data-rule-required="true" data-rule-email="true"><!--data-rule-email="true"-->
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label for="password" class="sr-only">password</label>
                            <input type="password" name="password" id="password" value="" placeholder="Password" class='form-control' data-rule-required="true">
                        </div>
                    </div>

                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <div class="remember" style="margin-left:15px;">
                                <input type="checkbox" name="remember" value="1" id="remember"/>    
                                <label for="remember" class="side-label">Remember me</label>
                            </div>
                            <input type="submit" name="submit" value="Login" id="loginBtn" class="btn btn-success"/>
                        </div>
                    </div>

                </form>

                <div class="forget col-sm-10 col-sm-offset-1">
                    <a href="<?php echo base_url("signin/forgot_password"); ?>">
                        <span>Forgot password?</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>