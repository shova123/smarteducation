<!--<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsenav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>gears/front/images/logo-white.png" alt="smartsikshya" class="img-responsive" width="95"></a>
        </div>
        <div class="collapse navbar-collapse" id="collapsenav">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
                <li><a href="<?php echo base_url();?>courses/slc">SLC</a></li>
                <li><a href="<?php echo base_url();?>courses">Courses</a></li>
                <li class="dropdown">
					 
						<a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" >
							Academic Courses <span class="caret"></span>
						</a>
                   
                    <?php 
                                                        $this->db->select('*');
                                                        $this->db->where('status','1');
                                                        $this->db->where('level_type','academic');
                                                        $levels=$this->db->get('hya_course_level')->result();
                                                        if(!empty($levels)):?>
						<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						    <?php
                                                        foreach($levels as $level):
                                                            $levelId=$level->level_id;
                                                            $levelSlug=$level->level_slug;
                                                    ?>
						  <li class="dropdown-submenu">
							<a tabindex="-1" href="#"><?php echo $level->level_name;?></a>
                                                                <?php
                                                                    $this->db->select('*');
                                                                    $this->db->where('status','1');
                                                                    $this->db->where('level_id',$levelId);
                                                                    $streams=$this->db->get('hya_course_stream')->result();
                                                                    if(!empty($streams)):?>
                                                       
                                                            <ul class="dropdown-menu">
                                                                 <?php
                                                                        foreach($streams as $stream):
                                                                            $streamId=$stream->stream_id;
                                                                            $streamSlug=$stream->stream_slug;;
                                                                        ?>
                                                                
                                                              <li class="dropdown-submenu"><a tabindex="-1" href="#"><?php echo $stream->stream_name;?></a>
                                                                 <?php
                                                                    $this->db->select('*');
                                                                    $this->db->where('status','1');
                                                                    $this->db->where('level_id',$levelId);
                                                                    $this->db->where('stream_id',$streamId);
                                                                    $courses=$this->db->get('hya_course_course')->result();
                                                                    if(!empty($courses)):?>
                                                                  <ul class="dropdown-menu">
                                                                      <?php foreach($courses as $course): 
                                                                       $courseSlug=$course->course_slug;   
                                                                       ?>
                                                                      <li><a tabindex="-1" href="<?php echo base_url();?>courses/<?php echo $courseSlug;?>"><?php echo $course->course_alias;?></a>
                                                                          <?php endforeach;?>
                                                                  </ul>
                                                                  <?php endif; ?>
                                                              </li>
                                                              <?php
                                                                        endforeach;
                                                                        ?>
                                                              
                                                              <li><a href="#">Management</a></li>

                                                            </ul>
                                                                <?php
                                                                    endif;
                                                                ?>
						  </li>
                                                   <?php
                        endforeach;?>

                   <?php
                        endif;
                    
                    
                    ?>
						</ul>
                   
					
					
				</li>
               <li class="dropdown">
					 
						<a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" >
							General Courses <span class="caret"></span>
						</a>
                   
                                               <?php 
                                                        $this->db->select('*');
                                                        $this->db->where('status','1');
                                                        $this->db->where('level_type','general');
                                                        $levels=$this->db->get('hya_course_level')->result();
                                                        if(!empty($glevels)):?>
						<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						    <?php
                                                        foreach($glevels as $glevel):
                                                    ?>
						  <li class="dropdown-submenu">
							<a tabindex="-1" href="<?php echo base_url();?>courses/<?php echo $glevel->level_slug;?>"><?php echo $glevel->level_name;?></a>
                                                            
						  </li>
                                                   <?php
                                                    endforeach;?>

                  
						</ul>
                    <?php
                        endif;
                    
                    
                    ?>
					
					
				</li>
                
                <li><a href="<?php echo base_url('know_us.html');?>">Know Us</a></li>
                <li><a href="<?php echo base_url('contact-us.html');?>">Contact Us</a></li>
                <li class="join"><a href="#0" class="cd-btn"><i class="fa fa-sign-in"></i> join Now</a></li>
            </ul>
        </div>
    </div>
</nav>-->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top megamenu">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#MegaMenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>gears/front/images/logo-white.png" alt="smartsikshya" class="img-responsive" width="95"></a>
        </div>
        <div class="collapse navbar-collapse" id="MegaMenu">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
                <!--<li><a href="<?php echo base_url();?>courses">Courses</a></li>-->
                <li class="dropdown megamenu-fw">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Academic courses <span class="caret"></span></a>
                  <ul class="dropdown-menu megamenu-content" role="menu">
                    <li>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4><i class="fa fa-caret-right"></i> Academic Courses</h4>
                            </div>
                           
                               <?php 
                                                        $this->db->select('*');
                                                        $this->db->from('hya_course_level l');
                                                        $this->db->join('hya_course_board b','l.board_id=b.board_id');
                                                        $this->db->where('l.status','1');
                                                        $this->db->where('l.level_type','academic');
                                                        $this->db->order_by('l.order','ASC');
                                                        $levels=$this->db->get()->result();
                                                        if(!empty($levels)):
                                                            foreach($levels as $level):
                                                             $levelId=$level->level_id;
                                                             $boardId=$level->board_id;
                                                             $boardSlug=$level->board_slug;
                                                             $levelSlug=$level->level_slug;
                                                            
                                                            
                                                            
                                                            ?>
                            <div class="col-sm-3 col-xs-6">
                                <a href="<?php if($levelSlug=='school-leaving-certificate') echo base_url()."courses/$boardSlug/$levelSlug"?>" class="level"><?php echo $level->level_name;?>(<?php echo $level->board_alias;?>)</a>
                                <div class="row">
                                     <?php
                                                                    $this->db->select('*');
                                                                    $this->db->where('status','1');
                                                                    $this->db->where('level_id',$levelId);
                                                                    $streams=$this->db->get('hya_course_stream')->result();
                                                                    if(!empty($streams)):
                                                                        foreach($streams as $stream):
                                                                          $streamId=$stream->stream_id;
                                                                          $streamSlug=$stream->stream_slug;
                                                                        
                                                                        ?>
                                    <div class="col-sm-6">
                                        <a href="<?php if($levelSlug=='intermediate') echo base_url()."courses/$boardSlug/$levelSlug/$streamSlug"?>" class="stream"><?php echo $stream->stream_name;?></a>
                                         <?php
                                                                    $this->db->select('*');
                                                                    $this->db->where('status','1');
                                                                    //$this->db->where('board_id',$boardId);
                                                                    //$this->db->where('level_id',$levelId);
                                                                    $this->db->where('stream_id',$streamId);
                                                                    $courses=$this->db->get('hya_course_course')->result();
                                                                    if(!empty($courses)):
                                                                        
                                                                        
                                                                        ?>
                                        <ul class="list-unstyled">
                                            <?php foreach($courses as $course):
                                                $courseSlug=$course->course_slug;
                                                                         ?>
                                            <li><a href="<?php echo base_url("courses/$boardSlug/$levelSlug/$streamSlug/$courseSlug");?>"><?php echo $course->course_alias;?></a></li>
                                            <?php endforeach;?>
                                           
                                        </ul><?php endif; ?>
                                    </div>
                                    <?php  endforeach; endif;?>

                                </div>
                            </div>
                            <?php  endforeach; endif;?>

                        </div>
                      
                    </li>
                  </ul>
                </li>
               <li class="dropdown megamenu-fw">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">General courses <span class="caret"></span></a>
                  <ul class="dropdown-menu megamenu-content" role="menu">
                    <li>
                        
                        <div class="clearfix"></div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col-sm-12">
                                <h4><i class="fa fa-caret-right"></i> General Courses</h4>
                            </div>
                              <?php 
                                                        $this->db->select('*');
                                                        $this->db->from('hya_course_level l');
                                                        $this->db->join('hya_course_board b','l.board_id=b.board_id');
                                                        $this->db->where('l.status','1');
                                                        $this->db->where('l.level_type','general');
                                                        $this->db->order_by('l.order','ASC');
                                                        $levels=$this->db->get()->result();
                                                        if(!empty($levels)):
                                                            foreach($levels as $level):
                                                             $levelId=$level->level_id;
                                                             $boardId=$level->board_id;
                                                              $boardSlug=$level->board_slug;
                                                             $levelSlug=$level->level_slug;
                                                            
                                                            
                                                            
                                                            ?>
                            <div class="col-sm-3 col-xs-6">
                                <a href=javascript:;"" class="level"><?php echo $level->level_name;?>(<?php echo $level->board_alias;?>)</a>
                                <div class="row">
                                     <?php
                                                                    $this->db->select('*');
                                                                    $this->db->where('status','1');
                                                                    $this->db->where('level_id',$levelId);
                                                                    $streams=$this->db->get('hya_course_stream')->result();
                                                                    if(!empty($streams)):
                                                                        foreach($streams as $stream):
                                                                          $streamId=$stream->stream_id;
                                                                          $streamSlug=$stream->stream_slug;
                                                                        
                                                                        ?>
                                    <div class="col-sm-6">
                                        <a href="javascript:;" class="stream"><?php echo $stream->stream_name;?></a>
                                         <?php
                                                                    $this->db->select('*');
                                                                    $this->db->where('status','1');
                                                                    //$this->db->where('board_id',$boardId);
                                                                    //$this->db->where('level_id',$levelId);
                                                                    $this->db->where('stream_id',$streamId);
                                                                    $courses=$this->db->get('hya_course_course')->result();
                                                                    if(!empty($courses)):
                                                                        ?>
                                        <ul class="list-unstyled">
                                            <?php foreach($courses as $course):
                                                $levelSlug=$level->level_slug;
                                                                         ?>
                                            <li><a href="<?php echo base_url("courses/$boardSlug/$levelSlug/$streamSlug/$courseSlug");?>"><?php echo $course->course_alias;?></a></li>
                                            <?php endforeach;?>
                                           
                                        </ul><?php endif; ?>
                                    </div>
                                    <?php  endforeach; endif;?>

                                </div>
                            </div>
                            <?php  endforeach; endif;?>

                      </div>
                    </li>
                  </ul>
                </li>
                <!-- DropDown Menu MultiLevel -->
                <!-- <li class="dropdown">
                  <a href="" data-toggle="dropdown" class="dropdown-toggle">Academic Courses <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#0">SLC</a></li>
                    <li class="dropdown-submenu">
                      <a href="">HSEB</a>
                      <ul class="dropdown-menu">
                        <li><a href="">Management</a></li>
                        <li><a href="">Science</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a href="">A-Level</a>
                      <ul class="dropdown-menu">
                        <li><a href="">Management</a></li>
                        <li><a href="">Science</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a href="">Bachelors (T.U)</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                          <a href="">Science</a>
                          <ul class="dropdown-menu">
                            <li><a href="">B.E</a></li>
                          </ul>
                        </li>
                        <li class="dropdown-submenu">
                          <a href="">Management</a>
                          <ul class="dropdown-menu">
                            <li><a href="">BBS</a></li>
                            <li><a href="">BBA</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a href="">Bachelors (K.U)</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                          <a href="">Science</a>
                          <ul class="dropdown-menu">
                            <li><a href="">B.E</a></li>
                          </ul>
                        </li>
                        <li class="dropdown-submenu">
                          <a href="">Management</a>
                          <ul class="dropdown-menu">
                            <li><a href="">BBS</a></li>
                            <li><a href="">BBA</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a href="">Masters (T.U)</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                          <a href="">Science</a>
                          <ul class="dropdown-menu">
                            <li><a href="">M.E</a></li>
                          </ul>
                        </li>
                        <li class="dropdown-submenu">
                          <a href="">Management</a>
                          <ul class="dropdown-menu">
                            <li><a href="">MBS</a></li>
                            <li><a href="">MBA</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a href="">Masters (K.U)</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                          <a href="">Science</a>
                          <ul class="dropdown-menu">
                            <li><a href="">M.E</a></li>
                          </ul>
                        </li>
                        <li class="dropdown-submenu">
                          <a href="">Management</a>
                          <ul class="dropdown-menu">
                            <li><a href="">MBS</a></li>
                            <li><a href="">MBA</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li> -->
                <!-- End of multilevel menu -->
                <li><a href="<?php echo base_url('know_us');?>">Know Us</a></li>
                <li><a href="<?php echo base_url('contact_us');?>">Contact Us</a></li>
                <li class="join"><a href="#0" class="cd-btn"><i class="fa fa-sign-in"></i> join Now</a></li>
            </ul>
        </div>
    </div>
</nav>