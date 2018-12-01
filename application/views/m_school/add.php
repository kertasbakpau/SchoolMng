<div class="content-inner">
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Master </li>
          </ul>
        </div>
    </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header class="header-custom"> 
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_school']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('m_school');?>"><i class="fa fa-table"></i> Index</a></div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?php echo base_url('m_school/addsave');?>">
                    <div class="form-group">
                      <label><?php echo $resource['res_school_name']?></label>
                      <input id="named" type="text" placeholder="<?php echo $resource['res_school_name']?>" class="form-control" name = "named" value="<?php echo $model['namasekolah']?>" required>
                    </div>
                    <div class="form-group">       
                      <label><?php echo $resource['res_addres']?></label>
                      <input id="password" type="text" placeholder="<?php echo $resource['res_addres']?>" class="form-control" name = "addres" value="<?php echo $model['alamat']?>">
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

  function getModalGroup(page)
  {
    removeModalGroupUserComponent();
    var search = $('#searchInput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('M_groupuser/groupusermodal')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var groupuser = $.parseJSON(data);
        console.log(groupuser);
        setResourceModalGroupUser(groupuser['m_groupuser']['resourcemodal']);

        var detail = groupuser['m_groupuser']['modeldetailmodal'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblGroupUserLookUp").append("<tr onclick='chooseGroupName("+detail[i].Id+","+'"'+detail[i].GroupName+'"'+");'><td>" + detail[i].GroupName + "</td></tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(groupuser['m_groupuser']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getModalGroup("+(groupuser['m_groupuser']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = groupuser['m_groupuser']['firstpagemodal'] ; i <= groupuser['m_groupuser']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getModalGroup("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(groupuser['m_groupuser']['currentpagemodal'] < groupuser['m_groupuser']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getModalGroup("+(1+groupuser['m_groupuser']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalGroupUserPaging' class='row'>";
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
        append +="Total Data : "+groupuser['m_groupuser']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardModalBody").append(append);
      }
    });
  };

  function chooseGroupName(Id, Name)
  {
    $("#groupid").val(Id);
    $("#groupname").val(Name);
    $('#modalGroupUser').modal('hide');
  }

  $("#modalGroupUser").on('hidden.bs.modal', function(){
    removeModalGroupUserComponent();
  });

  function removeModalGroupUserComponent()
  {
    $("#tblGroupUserLookUp").find("tr:gt(0)").remove();
    $("#modalGroupUserPaging").remove();
  }

  function setResourceModalGroupUser(resource)
  {
    $("#searchbutton").innerHtml = resource['res_search'];
    $("#groupUserModalLabel").text = resource['res_groupuser'];
  }
</script>