<?php
	class Search extends MX_Controller{
    	
		function __construct(){
			parent::__construct();
			$this->load->model('searchmodel');
                        $this->load->model('general_db_model');
		}	
    	
		function index(){	
                        $data['page_title']='Home';		
                        $data['home'] = $this->general_db_model->getByWhere( 'tbl_static_pages', 'page_title', 'homepage','pc_id',4);
                                                      //function getByWhere( $table, $fieldName, $name, $fieldId, $id)
//                        $data['slides'] = $this->general_db_model->getAll('tbl_slides');
////                        $data['gallery'] = $this->general_db_model->get_with_limit('tbl_gallery_images',4,0);
////                        $data['testimonial'] = $this->general_db_model->getByWhere( 'tbl_static_pages', 'page_title', 'testimonials','pc_id',4); 
//                        //$where.= ' ne_c_name = "Hot News" and type="news" ';
//                        $data['hot_news'] = $this->searchmodel->get_pages( 10,0,'ne_c_name = "Hot News" and type="news" '); 
//                        $data['about_us'] = $this->searchmodel->get_topic( 'tbl_static_pages','page_slug','about-us'); 
//                        $data['bride_gallery'] = $this->searchmodel->get_gallery('tbl_bridegroom','person_type','bride','date',3,0); 
//                        $data['groom_gallery'] = $this->searchmodel->get_gallery('tbl_bridegroom','person_type','groom','date',3,0); 
//                        $data['news'] = $this->searchmodel->get_news_events('tbl_news','ne_type','news','date'); 
//                        $data['events'] = $this->searchmodel->get_news_events('tbl_news','ne_type','events','date');
//function getByWhere( $table, $fieldName, $name, $fieldId, $id)
//function using to find testimonials within same page category id=4 tat is same for homepage & testimonials which can be visible in same index page
                        //$this->template->set('title', 'Home');
                        $this->template->load('template_front', 'search_front',$data);
		}

                
/*=======start of the fullpage =============*/
                function quick_search($jobCatids=null){	
                     $data['page_title']='Home 1';	
                    if($this->input->post('eventSubmit'))
                    {
                        $job_categories = $this->input->post('job_categories');
                        $job_level = $this->input->post('job_level');
                        $education_qualification = $this->input->post('education_qualification');
                        $job_type = $this->input->post('job_type');
                        $job_location = $this->input->post('job_location');       
                        
                        $data['search_result'] = $this->searchmodel->get_quick_search2('tbl_job_post',$job_categories,$job_level,$education_qualification,$job_type,$job_location);
                       
                    }
                    
                    
                   	
                        //$data['fullpages'] = $this->searchmodel->get_byId( 'tbl_news', 'id', $ids);
                        //$this->template->set('title', 'Home');
                        if($this->input->post('submitDetail'))
			{
                            $jobType = $this->input->post('job_type');
                            $jobTKC = $this->input->post('job_tkc');
                            $jobLocation = $this->input->post('job_location');
                            
                            $data['search_result'] =$result= $this->searchmodel->get_quick_search('tbl_job_post',$jobType,$jobTKC,$jobLocation,$jobCatids);
                        }
                        if($jobCatids)
			{
                            $jobType = "";
                            $jobTKC = "";
                            $jobLocation = "";
                            
                            $data['search_result'] =$result= $this->searchmodel->get_quick_search('tbl_job_post',$jobType,$jobTKC,$jobLocation,$jobCatids);
                        }
                        $data['job_category'] = $this->searchmodel->get_dropdown('tbl_job_category', 'status', 'Publish','category_title');	
                        $data['job_subcategory'] = $this->searchmodel->get_dropdown('tbl_job_subcategory', 'status', 'Publish','sub_cat_title');	
                        $data['in_demand_category'] = $this->searchmodel->get_mostRepeated('tbl_job_post', 'job_category');
                        $this->template->load('template_front', 'search_front',$data);
		}
/*=======end of the fullpage=============*/

                public function send(){  //function for sending email afer inserting into database
                    if($_POST['submit']){
                   /*
                    $config['charset'] = 'utf-8';  //conmverting email libraries data into string
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = 'text';
                    $this->email->initialize($config);
                    
                    $this->email->from($this->input->post('email'),$this->input->post('fullname'));
                    $this->email->to('menson.sundash@hotmail.com');
                    $this->email->subject('subject');
                    $this->email->message($this->input->post('message'));
                   */
                   
                        $date = date('Y-m-d H:i:s');
                        $data=array(                                        //inserting into database 
                                'mail_from'=>'',
                                'mail_to'=>$this->input->post('email'),
                                'subject'=>'joining mailing list',
                                'content'=>'',
                                'sent_date'=>$date
                            );
                        $this->load->model('searchmodel');
                        $this->load->searchmodel->add_email($data);
                        
                         //$this->email->send();
                         $this->index();
                    }    
                }
    }
?>