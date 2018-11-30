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
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_schoolyear']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mschoolyear');?>"><i class="fa fa-table"></i> Index</a></div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?php echo base_url('mschoolyear/addsave');?>">
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
                        <label><?php echo $resource['res_marriagestatus']?></label>
                        <select id = "marriagestatus" name="marriagestatus" class="form-control">
                          <?php 	
                          foreach ($enums['marriageenum'] as $value)
                          { 
                          ?>
                            <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        </div>
                        <div class="col">  
                          
                        <label><?php echo $resource['res_familystatus']?></label>
                        <select id = "familystatus" name="familystatus" class="form-control">
                          <?php 	
                          foreach ($enums['familyenum'] as $value)
                          { 
                          ?>
                            <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                          <?php 
                          }
                          ?>
                        </select>
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

  
</script>