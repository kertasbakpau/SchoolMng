<?php 


?>
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
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" name="ClassId" hidden="true" id="ClassId" placeholder="kelas" class="form-control" value="<?php echo $model['classid']?>" required>

                                <input readonly="" id="groupname" placeholder="<?php echo $resource['res_name']?>" type="text" class="form-control" value="<?php echo $model['classid'] ?>">

                                <div class="input-group-append">
                                  <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getClass(1);" data-target="#modalClass"><i class="fa fa-search"></i></button>
                                </div>
                              </div>

                            </div>   
                      <label><?php echo $resource['res_classid']?></label>
                      <div class="input-group">
                        <input hidden="true" id = "classid" type="text" class="form-control" name = "classid" value="<?php echo $model['classid']?>">
                        <input readonly id = "name" placeholder="<?php echo $resource['res_classid']?>" type="text" class="form-control"  value="<?php echo $model['name']?>">
                        <div class="input-group-append">
                          <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalGroup(1);" data-target="#modalGroupClass"><i class="fa fa-search"></i></button>
                        </div>
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
                      <input id="name" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "name" value="<?php echo $model['name']?>" required> 
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
                              <option value ="<?php echo $value->Value?>"><?php echo $value->EnumName?></option>
                            <?php 
                            }
                            ?>
                          </select>
                        </div>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_religion']?></label>
                            <select id = "religion" name="religion" class="form-control">
                          <option value="" selected>-- Select Religion --</option>
                          
                            <select id = "religion" name="religion" class="form-control">
                              <option value="" selected>-- Select Religion --</option>
                            <?php   
                            foreach ($enums['religionenum'] as $value)
                            { 
                            ?>
                              <option value ="<?php echo $value->Value?>"><?php echo $value->EnumName?></option>
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
                            <select id = "worker_status" name="work_status" class="form-control">
                          <option value="" selected>-- Select Status --</option>


                            <select id = "worker_status" name="worker_status" class="form-control">
                              <option value="" selected>-- Select Worker Status --</option>
                            <?php   
                            foreach ($enums['workstatusenum'] as $value)
                            { 
                            ?>
                              <option value ="<?php echo $value->Value?>"><?php echo $value->EnumName?></option>
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



      <!-- MODAL -->


      <div id="modalClass" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="groupUserModalLabel" class="modal-title">KELAS</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div id = "cardModalBody" class="card-body">
              <div class="form-group row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="input-group">
                      <input id = "searchInput" type="text" class="form-control" >
                      <div class="input-group-append">
                        <button id = "searchbutton" type="button" class="btn btn-primary" onclick ="getClass(1);">Search</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id = "tblClassLookUp" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Kelas</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


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

  function getClass(page)
  {
    removeModalClassComponent();
    var search = $('#searchInput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('M_kelas/groupClass')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var dataClass = $.parseJSON(data);
        console.log(dataClass);
        setResourceModalGroupUser(dataClass['M_kelas']['resourcemodal']);
        var detail = dataClass['M_kelas']['modeldetailmodal'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblClassLookUp").append("<tr onclick='chooseGroupName("+detail[i].Id+","+'"'+detail[i].Nama+'"'+");'><td>" + detail[i].Nama + "</td></tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(dataClass['M_kelas']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getClass("+(dataClass['M_kelas']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = dataClass['M_kelas']['firstpagemodal'] ; i <= dataClass['M_kelas']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getClass("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(dataClass['M_kelas']['currentpagemodal'] < dataClass['M_kelas']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getClass("+(1+dataClass['M_kelas']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalGroupUserPaging' class='row'>";
<div id="modalGroupClass" tabindex="-1" role="dialog" aria-labelledby="groupClassModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="grouClassModalLabel" class="modal-title">Group Class Id</h5>
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
          <table id = "tblGroupClassLookUp" class="table table-striped table-hover">
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

        function getModalGroup(page)
  {
    removeModalgroupclassComponent();
    var search = $('#searchInput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('M_kelas/groupclassmodal')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var groupclass = $.parseJSON(data);
        console.log(groupclass);
        setResourceModalGroupClass(groupclass['m_kelas']['resourcemodal']);

        var detail = groupclass['m_kelas']['modeldetailmodal'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblGroupClassLookUp").append("<tr onclick='chooseName("+detail[i].Id+","+'"'+detail[i].Nama+'"'+");'><td>" + detail[i].Nama + "</td></tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(groupclass['m_kelas']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getModalGroup("+(groupclass['m_kelas']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = groupclass['m_kelas']['firstpagemodal'] ; i <= groupclass['m_kelas']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getModalGroup("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(groupclass['m_kelas']['currentpagemodal'] < groupclass['m_kelas']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getModalGroup("+(1+groupclass['m_kelas']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalgroupclassPaging' class='row'>";
        append += "<div class = 'col-lg-6'>";
        append += "<nav aria-label='Page navigation example'>";
        append += "<ul class='pagination'>";
        append += previous;
        append += pages;
        append += next;
        append += "</ul>";
        append += "</nav>";
        append += "</div>";
        append += "<div class = 'col-lg-6 icon-custom-table-header'>";
        append +="Total Data : "+dataClass['M_kelas']['totalrowmodal'];
        append +="Total Data : "+groupclass['m_kelas']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardModalBody").append(append);
      }
    });
  };

  function chooseGroupName(Id, Nama)
  {
    $("#ClassId").val(Id);
    $("#groupname").val(Nama);
    $('#modalClass').modal('hide');
  }

  $("#modalClass").on('hidden.bs.modal', function(){
    removeModalClassComponent();
  });

  function removeModalClassComponent()
  {
    $("#tblClassLookUp").find("tr:gt(0)").remove();
    $("#modalGroupUserPaging").remove();
  }

  function setResourceModalGroupUser(resource)
  {
    $("#searchbutton").innerHtml = resource['res_search'];
    $("#groupUserModalLabel").text = resource['res_groupuser'];
  }
</script>
  function chooseName(Id, Nama)
  {
    $("#classid").val(Id);
    $("#name").val(Nama);
    $('#modalGroupClass').modal('hide');
  }

  $("#modalgroupclass").on('hidden.bs.modal', function(){
    removeModalgroupclassComponent();
  });

  function removeModalgroupclassComponent()
  {
    $("#tblGroupClassLookUp").find("tr:gt(0)").remove();
    $("#modalgroupclassPaging").remove();
  }

  function setResourceModalGroupClass(resource)
  {
    $("#searchbutton").innerHtml = resource['res_search'];
    $("#groupclassModalLabel").text = resource['res_groupclass'];
  }
      </script>
