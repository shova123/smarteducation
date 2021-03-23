<?php
function shorten_string($string, $wordsreturned){
    $retval = $string;
    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)
    {
    $retval = $string;
    }
    else
    {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array);
    }
    return $retval; 
    }
?>
<!-- dataTables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>gears/front/datatable/TableTools.css">
<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>gears/front/datatable/dataTableStyle.css">

<!-- New DataTables -->
<script src="<?php echo base_url(); ?>gears/front/momentjs/jquery.moment.min.js"></script>
<script src="<?php echo base_url(); ?>gears/front/momentjs/moment-range.min.js"></script>
<script src="<?php echo base_url(); ?>gears/front/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>gears/front/datatable/extensions/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>gears/front/datatable/extensions/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url(); ?>gears/front/datatable/extensions/dataTables.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>gears/front/datatable/extensions/dataTables.scroller.min.js"></script>

<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12">

            <div class="temp-list">
            <div class="sample">
                <h1><small><i class="fa fa-list-ol"></i> </small> Support List
                    
                </h1>
            <div class="box-content nopadding">
                <!--<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="null,text,text,select,daterange,select,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">-->
                <table class="table table-hover table-nomargin table-bordered dataTable">
                    <thead>
                        <tr>
<!--                            <th class='with-checkbox'>
                                <input type="checkbox" name="check_all" class="dataTable-checkall">
                            </th>-->
                            <th>Sno.</th>
                            <th>Created Date</th>
                            <th>Subject</th>
                            <!--<th>Title</th>-->
                            <th>Status</th>
                            <!--<th>Last Update By</th>-->
                            <th>Submitted By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if (!empty($ticket_list)) {
                        $countteachers = 1;
                        foreach ($ticket_list as $ticketDETAILS) {
                            $ticket_id = $ticketDETAILS->ticket_id;
                            $ticket_token = $ticketDETAILS->ticket_token;
                            $category_id = $ticketDETAILS->category_id;
                            $sub_cat_id = $ticketDETAILS->sub_cat_id;
                            $user_id = $ticketDETAILS->user_id;
                            //$temp_id = $ticketDETAILS->temp_id;
                            $subject = $ticketDETAILS->subject;
                            $content_message = $ticketDETAILS->body;
                            $ticektCreatedDate = $ticketDETAILS->date;
                            $ticektCreatedStatus = $ticketDETAILS->status;
                            
                            //$template_title = $ticketDETAILS->template_title;
                            $userFname = $ticketDETAILS->first_name;
                            $userLname = $ticketDETAILS->last_name;
                            $userFULLname = "$userFname $userLname";
                            $userEmail = $ticketDETAILS->email;
                            
                            
                            
                            
                                    $this->db->select("*");
                                    $this->db->where('category_id', $category_id);
                                    $queryCategory = $this->db->get("tbl_category");
                                    $resultCategory = $queryCategory->row();
                                            $catTitle = @$resultCategory->category_title;
                                    $this->db->select("*");
                                    $this->db->where('sub_cat_id', $sub_cat_id);
                                    $queryCategorySub = $this->db->get("tbl_category_sub");
                                    $resultCategorySub = $queryCategorySub->row();
                                            $subCatTitle = @$resultCategorySub->subcategory_title;
                            ?>
                        <tr>
<!--                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>-->
                            <td><?php echo $countteachers;?></td>
                            <td><?php echo $ticektCreatedDate;?></td>
                            <td><?php echo $subject;?></td>
                            <!--<td>Title templates</td>-->
                            <td><?php echo ucfirst($ticektCreatedStatus);?></td>
<!--                            <td>
                                ADMIN
                            </td>-->
                            <td><?php echo $userEmail;?></td>
                            <td>
                                <a href="<?php echo base_url("users/support_view/$ticket_token");?>" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    <?php $countteachers++;}}?>

                        
                    </tbody>
                </table>
            </div>
                </div>
        </div>
    </div><!--/template list-->
    <style type="text/css">
            .mystyle{
                    background-color: #90b941;
                background-image: linear-gradient(90deg, transparent 50%, rgba(152, 195, 68, 1) 50%);
                background-size: 3px 3px;
                border-bottom: 1px dashed #d2d3cf;
                border-top: 1px dashed #d2d3cf;
                box-shadow: 0 0 0 5px #90b941, 2px 1px 6px 4px rgba(10, 10, 0, 0.3);
                color: #fff;
                font-size: 14px;
                height: auto;
                line-height: 1em;
                margin: 15px auto;
                padding: 9px 0 !important;
                text-align: center;
                width: 100%;
            }
    </style>
    <?php $this->load->view("include_dashboard/alert-message");?>
</div><!--/list template info-->