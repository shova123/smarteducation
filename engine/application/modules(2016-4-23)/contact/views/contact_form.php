div class="page-content">
      <div class="row">
        <div class="col-md-12">
          <h2><?php echo @$page_title;?></h2>
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            
         <div class="porlets-content">
          
                <form class="form-horizontal row-border" method="post" enctype="multipart/form-data" action="" parsley-validate novalidate>    

 
    
    <div class="row">
            <div class="col-md-12">
                <div class="block-web">
                <div class="header">
                    <div class="actions"> 
                        <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a> 
<!--                        <a href="#" class="refresh"><i class="fa fa-repeat"></i></a> 
                        <a href="#" class="close-down"><i class="fa fa-times"></i></a> -->
                    </div>
                    <h3 class="content-header">Contact Details</h3>
                </div>
                <div class="porlets-content">
                    <div class="form-horizontal row-border" ><!--form start-->

                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $details->address;?>" required/>
                                </div>
                            </div><!--/form-group-->
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $details->phone;?>" required/>
                                </div>
                            </div><!--/form-group-->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">email</label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $details->email;?>" required/>
                                </div>
                            </div><!--/form-group-->
                            
                            
                            
                            
                           
                            
                        </div><!--/form end-->
                </div><!--/porlets-content-->
                </div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div><!--/row-->
        
        <div class="form-group">
                                <label class="col-sm-2 col-sm-2"></label>
                                <div class="col-sm-10">
                                <input type="submit" name="submitDetail" value="Update" class="btn btn-primary"/>
                                </div>
                            </div>
    </form>    
            </div><!--/porlets-content-->  
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
       
    </div><!--/page-content end--> 
 





