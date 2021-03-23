<script>
    $(function () {
        $('.publish_status a').click(function () {

            var _id = $(this).attr('id');
            var _status = $(this).text();

            $('a#' + _id + '').removeClass(_status);
            $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
            var _this = $(this);

            $.get('<?php echo base_url("course/board_status");?>', {id: _id, status: _status},
            //alert(data);
                    function (data) {
                        _this.text(data);
                        $('a#' + _id + '').addClass(data);
                        //$('.cross').hide();
                    });
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <!--<a href="<?php echo base_url('signin/create_group');?>" class="btn btn-round btn-success" type="button">Add Group</a>-->
            <a class="btn btn-round btn-primary" id="addboard">Create New Board <i class="fa fa-plus"></i></a>
        </div>

        <!--        <div class="title_right">
                    <button class="btn btn-round btn-success" type="button">Add Group</button>
                </div>-->
    </div>
    <div class="clearfix"></div>
<form class='form-validate' name='addForm' id='addForm'>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Below is a list of boards</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable">
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->

                                <th>Board Name</th>
                                <th>Status</th>

                                <th class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($boards)) {
                                foreach ($boards as $b) {
                                    $boardID = $b->board_id;
                                    $boardName = $b->board_name;
                                    $boardAliasName = $b->board_alias;
                                    ?>
                                    <tr class="even pointer">
        <!--                                <td class="a-center ">
                                            <input type="checkbox" class="tableflat">
                                        </td>-->
                                        <!--<td><a data-toggle="tooltip" data-placement="top" title="<?php echo ucfirst($boardName);?>"><strong><?php echo htmlspecialchars($boardAliasName, ENT_QUOTES, 'UTF-8');?></strong></a></td>-->
                                        <td><strong><?php echo ucfirst($boardName)?></strong></td>
                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $boardID;?>"  style="margin:5px; padding:5px 10px;<?php if (!empty($active)) { ?>background-color: #006600;<?php } ?>" class="badge">
                                                <?php
                                                if ($b->status == 1)
                                                    echo 'Active';
                                                else
                                                    echo "Inactive";
                                                ?>
                                            </a>
                                        </td>
                                        <td class=" last">
                                            <a class="btn" data-toggle="modal" data-target="#editModal<?php echo $boardID;?>" ><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            

                                            <a href="#modal<?php echo $boardID;?>" role="button" class="btn" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>

        <br />
        <br />
        <br />

    </div>
    </form>
</div>

<?php
if (!empty($boards)) {

    foreach ($boards as $b) {
        $boardIDs = $b->board_id;
        $boardAliasNames = $b->board_alias;
?>
<script>
    $(function () {
        $('#board_name<?php echo $boardIDs;?>').slugIt({
            output: '#board_slug<?php echo $boardIDs;?>',
            separator: '_',
        });
        $('#board_name<?php echo $boardIDs;?>').keyup();
    });
</script>
<div id="editModal<?php echo $boardIDs;?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Board Update</h4>
            </div>
            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="loginForm" name='loginForm' method="post" class="form-horizontal form-validate">
                    <!--<form method="post" action="<?php echo base_url("course/board");?>">-->
                <input type="hidden" class="form-control" name="board_id" value="<?php echo $boardIDs;?>"/>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Board Name</label>
                    <div class='col-xs-9 form-group has-feedback'>
                        <input type='text' name='board_name' id='board_name<?php echo $boardIDs;?>' value="<?php echo $b->board_name;?>"  class='form-control has-feedback-left' data-rule-required='true' data-rule-minlength='3'/>
                        <span class='fa fa-institution form-control-feedback left' aria-hidden='true'></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Board Slug</label>
                    <div class='col-xs-9 form-group has-feedback'>
                        <input type='text' name='board_slug' id='board_slug<?php echo $boardIDs;?>' value="<?php echo $b->board_slug;?>"  class='form-control has-feedback-left' readonly="readonly"/>
                        <span class='fa fa-copy form-control-feedback left' aria-hidden='true'></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Board Alias</label>
                    <div class='col-xs-5 form-group has-feedback'>
                        <input type='text' name='board_alias' id='board_alias' value="<?php echo $b->board_alias;?>"  class='form-control has-feedback-left' data-rule-required='true' data-rule-minlength='2'/>
                        <span class='fa fa-th-large form-control-feedback left' aria-hidden='true'></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Status</label>
                    <div class="col-xs-5">
                        <select name="status" class="form-control">
                            <option value="1" <?php if ($b->status == 1) echo "selected='selected'" ?>>Active</option>
                            <option value="0" <?php if ($b->status == 0) echo "selected='selected'" ?>>InActive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-5 col-xs-offset-3">
                        <button type="submit" class="btn btn-primary" >Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </form>



            </div>

        </div>

    </div>
</div>

<div id="modal<?php echo $boardIDs;?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Board Delete</h4>
            </div>

            <div class="modal-body">
                <p>
                    Are you sure to delete this Board <strong>[ <?php echo $boardAliasNames;?> ]</strong>
                </p>
            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url("course/board_delete/" . $boardIDs) ?>" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>

</div>

<?php }}?>
<script>
    $(function () {
        $('#board_name').slugIt({
            output: '#board_slug',
            separator: '_',
        });
        $('#board_name').keyup();
    });
</script>

    

<!--<div class='form-group'><div class='col-md-9 col-sm-9 col-xs-12'><select name='status' class='form-control'><option value=''>Choose Status</option><option value='1'>Enable</option><option value='0'>Disable</option></select></div></div>-->
<script>
    $(function () {
        $('#addboard').bind("click", function () {
            var tr = "<tr><td class='col-md-4'><div class='col-md-12 col-sm-12 col-xs-12 form-group has-feedback'><input type='text' name='board_name' placeholder='Board Name' class='form-control has-feedback-left' id='board_name' data-rule-required='true' data-rule-minlength='3'/><span class='fa fa-institution form-control-feedback left' aria-hidden='true'></span></div></td><td class='col-md-4'><div class='col-md-12 col-sm-12 col-xs-12 form-group has-feedback'><input type='text' name='board_alias' placeholder='Board Alias' class='form-control has-feedback-left' id='board_alias' data-rule-required='true' data-rule-minlength='2'/><span class='fa fa-th-large form-control-feedback left' aria-hidden='true'></span></div></td><td class='col-md-4'><div class='col-md-6 col-sm-6 col-xs-6'><select name='status' class='form-control'><option value=''>Choose Status</option><option value='1'>Enable</option><option value='0'>Disable</option></select></div><div class='col-md-6 col-sm-6 col-xs-6'><a id='saveboard' onclick='saveboard()' class='btn btn-success'>Save</a><a id='cancel' onclick='cancel()' class='btn btn-danger'>Cancel</a></div></td></tr>";
            $('tbody').prepend(tr);
            $(this).attr('disabled', 'disabled');
        });

    });
    function saveboard() {
        var board = $('input[name="board_name"]').val();
        var board_alias = $('input[name="board_alias"]').val();
        
        //================ change it to slug start
        var separator = '-';
        var slug = board;
        var slug = $.trim(slug.toString());
        
        var slug;
        // Ensure separator is composable into regexes
        var sep_esc  = separator.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        var re_trail = new RegExp('^'+ sep_esc +'+|'+ sep_esc +'+$', 'g');
        var re_multi = new RegExp(sep_esc +'+', 'g');

        slug = slug.replace(/[^-\w\d\$\*\(\)\'\!\_]/g, separator);  // swap spaces and unwanted chars
        slug = slug.replace(re_trail, '');                               // trim leading/trailing separators
        slug = slug.replace(re_multi, separator);                   // eliminate repeated separatos
        slug = slug.toLowerCase();
        //================ change it to slug end
        var status = $("tbody select option:selected").val();
        if (board === '' || board === 'undefined' || board === 'null') {
            $('tbody td:first').append('<p id="hide">Required Field</p>');
            $('p').fadeOut(5000);
            return false;
        }
        $.ajax({
            method: "post",
            data: {'board_name': board,'board_slug':slug,'board_alias':board_alias, 'status': status},
            url: "<?php echo base_url();?>course/board_add",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                window.location.href = "<?php echo base_url();?>course/board";
                //here i write success code
            }

        });

    }
    function cancel() {
        $('tbody tr:first').remove();
        $("#addboard").removeAttr('disabled');

    }
    $(function () {
        $('body').on('submit', 'form', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url("course/board_edit");?>",
                data: $(this).serialize(),
                success: function (response) {

                    new PNotify({
                        title: 'Success',
                        text: 'Successfully Edited!',
                        type: 'success'
                    });
                    //alert('Successfully Edited');
                    $('.modal').removeClass("in");
                },
                error: function () {
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Error On Data Modification.',
                        type: 'error'
                    });
                    //alert('Error On Data Modification');
                }
            });
        });
    });
</script>