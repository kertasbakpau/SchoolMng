<?php
 // var_dump($enums['genderEnums'])
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
            <h1 class="h3 display"><i class="fa fa-fire"></i> <?php echo $resource['res_master_schedule']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('m_schedule');?>"><i class="fa fa-table"></i> Index</a></div>
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
                 
                  <form method = "post" action = "<?php echo base_url('M_Schedule/addSave');?>">
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_day']?></label>
                          <div>
                             <select id = "days" name="hari" class="form-control">
                              <option value="" selected>-- Select--</option>
                            <?php   
                            foreach ($enums['daysEnums'] as $value)
                            { 
                            ?>
                              <option value ="<?php echo $value->Value?>"> <?php echo $resource[$value->Resource]?> </option>
                            <?php 
                            }
                            ?>
                          </select>
                        </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_start_time']?></label>
                          <input type="text" placeholder="<?php echo $resource['res_start_time']?>" class="form-control" name ="jamMulai" value="<?php echo $model['jamMulai']?>" required> 
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_end_time']?></label>
                          <input type="text" placeholder="<?php echo $resource['res_end_time']?>" class="form-control" name ="jamAkhir" value="<?php echo $model['jamAkhir']?>" required> 
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_subject']?></label>
                          <div class="input-group">
                            <input hidden="true" id ="idMapel" type="text" class="form-control" name ="mapel" value="<?php echo $model['mapel']?>">
                            <input readonly id ="NamaMapel" placeholder="<?php echo $resource['res_subject']?>" type="text" class="form-control"  value="<?php echo $model['mapel']?>" name='namaMapel'>
                            <div class="input-group-append">
                              <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalGroup1(1);" data-target="#modalGroupClass"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                            <label><?php echo $resource['res_class']?></label>
                            <div class="input-group">
                              <input hidden="true" id = "kelas" type="text" class="form-control" name ="kelas" value="<?php echo $model['kelas']?>">
                              <input readonly id ="nama" placeholder="<?php echo $resource['res_class']?>" type="text" class="form-control"  value="<?php echo $model['kelas']?>">
                              <div class="input-group-append">
                                <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalGroup(1);" data-target="#modalGroupClass"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </div>
                      </div> 
                    </div>

                    <div class="form-group">
                        <label><?php echo $resource['res_teacher']?></label>
                        <div class="input-group">
                          <input hidden="true" id ="teacher" type="text" class="form-control" name ="guru" value="<?php echo $model['guru']?>">
                          <input readonly id ="Guru" placeholder="<?php echo $resource['res_teacher']?>" type="text" class="form-control"  value="<?php echo $model['guru']?>" name="namaGuru">
                          <div class="input-group-append">
                            <button id="btnGroupModa" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalGroup2(1);" data-target="#modalGroupTeacher"><i class="fa fa-search"></i></button>
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

<!-- Modal Mapel -->
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
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalGroup1(1);">Search</button>
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
    </div>
  </div>
</div>

<!-- Modal Mapel -->

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

        function getModalGroup1(page)
          {
            removeModalgroupclassComponent1();
            var search = $('#searchInput').val();
            $.ajax({
              type: "POST",
              url: "<?php echo base_url('M_mapel/mapelModal')?>",
              data:{
                    page: page,
                    search : search
                  },
              success:function(data){
                var groupclass = $.parseJSON(data);
                console.log(groupclass);
                setResourceModalGroupClass(groupclass['m_mapel']['resourcemodal']);

                var detail = groupclass['m_mapel']['modeldetailmodal'];
                for(var i = 0; i < detail.length; i++)
                {
                  $("#tblGroupClassLookUp").append("<tr onclick='chooseName1("+detail[i].Id+","+'"'+detail[i].NamaMapel+'"'+");'><td>" + detail[i].NamaMapel + "</td></tr>");
                }

                var previous = "";
                var pages = "";
                var next = "";
                var append = "";
                if(groupclass['m_mapel']['currentpagemodal'] > 3)
                {
                  previous += "<li class='page-item'>";
                  previous += "<a class='page-link' href='#' onclick = 'getModalGroup1("+(groupclass['m_mapel']['currentpagemodal']-1)+")' aria-label='Previous'>";
                  previous += "<span aria-hidden='true'>&laquo;</span>";
                  previous += "<span class='sr-only'>Previous</span>";
                  previous += "</a>" ;
                  previous += "</li>";
                }

                for (var i = groupclass['m_mapel']['firstpagemodal'] ; i <= groupclass['m_mapel']['lastpagemodal']; i++){
                  pages += " <li class='page-item' >";
                  pages += "<a class='page-link' href='#' onclick = 'getModalGroup1("+i+")'>"+i+"</a>";
                  pages += "</li>";
                }

                if(groupclass['m_mapel']['currentpagemodal'] < groupclass['m_mapel']['totalpagemodal'] - 2)
                {
                  next += "<li class='page-item'>";
                  next += "<a class='page-link' href='#' onclick = 'getModalGroup1("+(1+groupclass['m_mapel']['currentpagemodal'])+")' aria-label='Next'>";
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
                append +="Total Data : "+groupclass['m_mapel']['totalrowmodal'];
                append += "</div>";
                append += "</div>";
                
                $("#cardModalBody").append(append);
              }
            });
          };

  function chooseName1(Id, Nama)
  {
    $("#idMapel").val(Id);
    $("#NamaMapel").val(Nama);
    $('#modalGroupClass').modal('hide');
  }

  $("#modalgroupclass").on('hidden.bs.modal', function(){
    removeModalgroupclassComponent1();
  });

  function removeModalgroupclassComponent1()
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



<!-- Modal Guru -->
<div id="modalGroupTeacher" tabindex="-1" role="dialog" aria-labelledby="groupClassModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="grouClassModalLabel" class="modal-title">Group <?=$resource['res_teacher']?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div id = "cardModalBody" class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group">
                <input id = "searchInput" type="text" class="form-control" >
                <div class="input-group-append">
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalGroup2(1);">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id = "tblGroupClassLookUp2" class="table table-striped table-hover">
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

        function getModalGroup2(page)
          {
            removeModalgroupclassComponent2();
            var search = $('#searchInput').val();
            $.ajax({
              type: "POST",
              url: "<?php echo base_url('m_worker/teacherModal')?>",
              data:{
                    page: page,
                    search : search
                  },
              success:function(data){
                var groupclass = $.parseJSON(data);
                console.log(groupclass);
                setResourceModalGroupClass(groupclass['m_worker']['resourcemodal']);

                var detail = groupclass['m_worker']['modeldetailmodal'];
                  for(var i = 0; i < detail.length; i++)
                  {
                    $("#tblGroupClassLookUp2").append("<tr onclick='chooseName2("+detail[i].Id+","+'"'+detail[i].Name+'"'+");'><td>" + detail[i].NIP + "</td><td>"+ detail[i].Name+ "</tr>");
                  }

                var previous = "";
                var pages = "";
                var next = "";
                var append = "";
                if(groupclass['m_worker']['currentpagemodal'] > 3)
                {
                  previous += "<li class='page-item'>";
                  previous += "<a class='page-link' href='#' onclick = 'getModalGroup2("+(groupclass['m_worker']['currentpagemodal']-1)+")' aria-label='Previous'>";
                  previous += "<span aria-hidden='true'>&laquo;</span>";
                  previous += "<span class='sr-only'>Previous</span>";
                  previous += "</a>" ;
                  previous += "</li>";
                }

                for (var i = groupclass['m_worker']['firstpagemodal'] ; i <= groupclass['m_worker']['lastpagemodal']; i++){
                  pages += " <li class='page-item' >";
                  pages += "<a class='page-link' href='#' onclick = 'getModalGroup2("+i+")'>"+i+"</a>";
                  pages += "</li>";
                }

                if(groupclass['m_worker']['currentpagemodal'] < groupclass['m_worker']['totalpagemodal'] - 2)
                {
                  next += "<li class='page-item'>";
                  next += "<a class='page-link' href='#' onclick = 'getModalGroup2("+(1+groupclass['m_worker']['currentpagemodal'])+")' aria-label='Next'>";
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
                append +="Total Data : "+groupclass['m_worker']['totalrowmodal'];
                append += "</div>";
                append += "</div>";
                
                $("#cardModalBody").append(append);
              }
            });
          };


  function chooseName2(Id, Nama)
  {
    $("#teacher").val(Id);
    $("#Guru").val(Nama);
    $('#modalGroupTeacher').modal('hide');
  }

  $("#modalGroupTeacher").on('hidden.bs.modal', function(){
    removeModalgroupclassComponent2();
  });

  function removeModalgroupclassComponent2()
  {
    $("#tblGroupClassLookUp2").find("tr:gt(0)").remove();
    $("#modalgroupclassPaging").remove();
  }

  function setResourceModalGroupClass(resource)
  {
    $("#searchbutton").innerHtml = resource['res_search'];
    $("#groupclassModalLabel").text = resource['res_groupclass'];
  }
      </script>




<!-- Modal Kelas -->
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
        append +="Total Data : "+groupclass['m_kelas']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardModalBody").append(append);
      }
    });
  };

  function chooseName(Id, Nama)
  {
    $("#kelas").val(Id);
    $("#nama").val(Nama);
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