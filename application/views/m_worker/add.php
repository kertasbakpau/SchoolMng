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
            <h1 class="h3 display"><i class="fa fa-fire"></i> <?php echo $resource['res_master_worker']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mworker');?>"><i class="fa fa-table"></i> Index</a></div>
                  </div>
                </div>
                <div class="card-body">
                  <?php if($this->session->flashdata('warning_msg'))
                    {
                        $msg = $this->session->flashdata('warning_msg');
                        for($i=0 ; $i<count($msg); $i++)
                        {
                  ?>
                          <p class="text-danger"><?php echo $msg[$i]; ?></p>
                  <?php 
                        }
                    }
                  ?>
                    <!-- <p class="text-danger"><?php echo $this->session->flashdata('warning_msg_name_exist'); ?></p> -->
                 
                  <form method = "post" action = "<?php echo base_url('mworker/addsave');?>">
                  <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_classid']?></label>
                          <div>
                            <select required name="classid">
                              <option value="" selected>-- Select ClassId --</option>
                                <?php                                
                                  foreach ($Nama as $row) {  
                                    echo "<option value='".$row->Id."'>".$row->Nama."</option>";
                                        }
                                        echo"
                                        </select>"
                                            ?>
                        </div>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_nip']?></label>
                          <input id="nip" type="number" placeholder="<?php echo $resource['res_nip']?>" class="form-control" name = "nip" value="<?php echo $model['nip']?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><?php echo $resource['res_name']?></label>
                      <input id="named" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "named" value="<?php echo $model['name']?>" required> 
                    </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_place_of_birth1']?></label>
                          <div>
                            <input id="place_of_birth" type="text" placeholder="<?php echo $resource['res_place_of_birth1']?>" class="form-control" name = "place_of_birth" value="<?php echo $model['place_of_birth']?>">
                        </div>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_date_of_birth']?></label>
                          <input id="date_of_birth" type="date" placeholder="<?php echo $resource['res_date_of_birth']?>" class="form-control" name = "date_of_birth" value="<?php echo $model['date_of_birth']?>">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_gender']?></label>
                          <div>
                             <select id = "gender" name="gender" class="form-control">
                              <option value="" selected>-- Select Gender --</option>
                            <?php   
                            foreach ($enums['genderenum'] as $value)
                            { 
                            ?>
                              <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                            <?php 
                            }
                            ?>
                          </select>
                        </div>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_religion']?></label>
                          <option value="" selected>-- Select Religion --</option>
                            <select id = "religion" name="religion" class="form-control">
                            <?php   
                            foreach ($enums['religionenum'] as $value)
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
                      <label><?php echo $resource['res_address']?></label>
                      <input id="address" type="text" placeholder="<?php echo $resource['res_address']?>" class="form-control" name = "address" value="<?php echo $model['address']?>" required> 
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_telephone']?></label>
                          <div>
                             <input id="telephone" type="number" placeholder="<?php echo $resource['res_telephone']?>" class="form-control" name = "telephone" value="<?php echo $model['telephone']?>">                        </div>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_work_status']?></label>
                            <select id = "worker_status" name="worker_status" class="form-control">
                            <?php   
                            foreach ($enums['workstatusenum'] as $value)
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