<div class="content-inner">
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Master       </li>
          </ul>
        </div>
    </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header class="header-custom"> 
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_schoolyear']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_edit_data']?></h4> 
                    </div><div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mschoolyear');?>"><i class="fa fa-table"></i> Index</a></div>
                  </div>
                </div>
                <div class="card-body">
                  <form method = "post" action = "<?php echo base_url('mschoolyear/editsave');?>">

                    <input hidden = "true" name="idschoolyear" value="<?php echo $model['id']?>"/> 
                    <div class="form-group">
                      <label><?php echo $resource['res_name']?></label>
                      <input id="named" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "named" value="<?php echo $model['name']?>" required>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_fromyear']?></label>
                          <input id = "fromyear" placeholder="<?php echo $resource['res_fromyear']?>" type="number" class="form-control" name = "fromyear"  value="<?php echo $model['fromyear']?>">
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_toyear']?></label>
                          <input id="toyear" type="number" placeholder="<?php echo $resource['res_toyear']?>" class="form-control" name = "toyear" value="<?php echo $model['toyear']?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">     
                      <div class="row">
                        <div class="col">  
                        <label><?php echo $resource['res_monthstart']?></label>
                          <select id = "monthstart" name="monthstart" class="form-control">
                            <?php 	
                            foreach ($enums['monthsenum'] as $value)
                            { 
                            ?>
                              <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                            <?php 
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col">  
                          <!-- <div class="i-checks">
                            <input id="checkboxCustom2" type="checkbox" value="" checked="" class="checkbox-template">
                            <label for="checkboxCustom2"><?php echo $resource['res_active']?></label>
                          </div> -->
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="<?php echo $resource['res_save']?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<!-- modal -->
<div id="modalGroupUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Group User</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div id = "cardModalBody" class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group">
                <input id = "searchInput" type="text" class="form-control" >
                <div class="input-group-append">
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalGroup(1);">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id = "tblGroupUserLookUp" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Group </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script type = "text/javascript">

  $(document).ready(function() {    
    init();
    $("#monthstart").val("<?php echo $model['monthstart']?>");
  });

  function init(){
    <?php 
    if($this->session->flashdata('edit_warning_msg'))
    {
      $msg = $this->session->flashdata('edit_warning_msg');
      for($i=0 ; $i<count($msg); $i++)
      {
    ?>
        setNotification("<?php echo $msg[$i]; ?>", 3, "bottom", "right");
    <?php 
      }
    }
    ?>
  }
</script>