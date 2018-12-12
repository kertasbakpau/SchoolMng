<div class="content-inner">
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Master       </li>
          </ul>
        </div>
    </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header class="header-custom"> 
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_student']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mstudent');?>"><i class="fa fa-table"></i> Index</a></div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?php echo base_url('mstudent/addsave');?>">
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                        <label><?php echo $resource['res_nis']?></label>
                          <input id="nis" type="text" placeholder="<?php echo $resource['res_nis']?>" class="form-control" name = "nis" value="<?php echo $model['nis']?>" required>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_name']?></label>
                          <input id="named" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "named" value="<?php echo $model['name']?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_placeofbirth']?></label>
                          <input id = "placeofbirth" placeholder="<?php echo $resource['res_placeofbirth']?>" type="text" class="form-control" name = "placeofbirth"  value="<?php echo $model['placeofbirth']?>" required>
                        </div>
                        <div class="col">
                        <label><?php echo $resource['res_dateofbirth']?></label>
                          <!-- <input id="dateofbirth" type="text" placeholder="<?php echo $resource['res_dateofbirth']?>" class="form-control" name = "dateofborth" value=""> -->
                          <div class="input-group date"  id = "dateBirth">
                            <input id = "dateofbirth" data-date-format="dd-mm-yyyy" readonly placeholder="<?php echo $resource['res_dateofbirth']?>" type="text" class="form-control" name = "dateofbirth" value="<?php echo $model['dateofbirth']?>" required>
                           </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">     
                      <div class="row">
                        <div class="col">
                        <label><?php echo $resource['res_mothername']?></label>
                          <input id="mothername" type="text" placeholder="<?php echo $resource['res_mothername']?>" class="form-control" name = "mothername" value="<?php echo $model['mothername']?>">
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_fathername']?></label>
                          <input id="fathername" type="text" placeholder="<?php echo $resource['res_fathername']?>" class="form-control" name = "fathername" value="<?php echo $model['fathername']?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">        
                      <div class="row">
                        <div class="col">   
                          <label><?php echo $resource['res_address']?></label>
                          <textarea id="address" type="text" placeholder="<?php echo $resource['res_address']?>" class="form-control" name = "address" ><?php echo $model['address']?></textarea>
                        </div>
                        <div class="col"> 
                          <label><?php echo $resource['res_yearofstudy']?></label>
                          <input id="yearofstudy" type="number" placeholder="<?php echo $resource['res_yearofstudy']?>" class="form-control" name = "yearofstudy" value="<?php echo $model['yearofstudy']?>" required>
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

<script type = "text/javascript">
  $(document).ready(function() {    
    init();
  });

  function init(){
    <?php 
    if($this->session->flashdata('add_warning_msg'))
    {
      $msg = $this->session->flashdata('add_warning_msg');
      for($i=0 ; $i<count($msg); $i++)
      {
    ?>
        setNotification("<?php echo $msg[$i]; ?>", 3, "bottom", "right");
    <?php 
      }
    }
    ?>
  }

  $('#dateofbirth').datepicker()
  .on('changeDate', function(e) {
        $('#dateofbirth').val(e.date.toLocaleDateString("id-ID"))
  });

  
</script>