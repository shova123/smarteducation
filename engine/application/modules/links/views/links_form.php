<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-latest.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.stringToSlug.js"></script>


<script>
    $(document).ready(function () {
        $("#link_title").stringToSlug();
    });
</script>


<?php $isEdit = isset($details) ? true : false; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-edit"></i><?php echo $links_title;?></h3>
                </div>
                <div class="box-content nopadding">
                    <form action="" method="post" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' >
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Social Link Title</label>
                                <div class="col-sm-10">
                                        <input type="text" name="link_title" id="link_title" value="<?php if (@$isEdit) echo $details->link_title; ?>" class="form-control">
                                        <span class="help-block">This is just a supporting text</span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Page Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="page_slug" id="permalink" value="<?php if (@$isEdit) echo $details->page_slug; ?>" class="form-control slug" readonly>
                                    <span class="help-block">This is page slug recognization</span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">HTTTP Links</label>
                                <div class="col-sm-10">
                                        <input type="text" name="http_links" id="http_links" value="<?php if (@$isEdit) echo $details->http_links; ?>" class="form-control">
                                        <span class="help-block">This is just a supporting text</span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Status</label>
                            <div class="col-sm-2">
                                <select name="status" id="select" class='chosen-select form-control'>
                                   <option value="Publish" <?php if (($isEdit) && ($details->status == 'Publish')){echo "selected";}?>> Publish </option>
                                    <option value="Unpublish" <?php if (($isEdit) && ($details->status == 'Unpublish')){echo "selected";}?>> Unpublish </option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-actions">
                            <input type="submit" name="submitLinks" class="btn btn-primary" value="SUBMIT">
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                            <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>