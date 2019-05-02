@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-3">
            @include('layouts.sidenav')
        </div>
  <div class="col-9">
    <div class="alert alert-primary alert-s" role="alert" style="display: none;">
 
</div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">List</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Add</a>
  </li>

  
</ul>
<div class="tab-content" id="myTabContent">
  {{-- add category --}}
  <div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
    <form id="forms"> 
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Add Category</label>
          <input type="text" class="form-control" name="cat_name" placeholder="Enter Category">
          <p class="text-danger danger"></p>
      </div>
     
  
  <button type="submit" class="btn btn-primary" id="save">Submit</button>
</form>

  </div>

  {{-- list category --}}
  <div class="tab-pane fade show active " id="profile" role="tabpanel" aria-labelledby="profile-tab">
  
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                   <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                
              </tr>
            </thead>
            
             
            <tfoot>
              
            </tfoot>
          </table>
          
  

  </div>
  
</div>
    {{--  edit  delete--}}
       @include('partials.cat_edit')
        @include('partials.cat_delete')
  
</div>
</div>

</div>
<script type="text/javascript">
  $(document).ready(function () {
   
      // data table
        var table = $('#example').DataTable( {
        
        "ajax": "{{url('category')}}",
        "deferRender": true,
         "columns": [

            {"data":"cat_name"},
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                return "<button class='btn btn-primary' onclick='event.preventDefault();editTaskForm("+data.id+");' data-toggle='modal' value="+data.id+">Edit</button>"+" "+
                  "<button class='btn btn-danger' onclick='event.preventDefault();deleteTaskForm("+data.id+");' data-toggle='modal'>Delete</button>";
            } },
            
            
           
        ],
        
       
    } );
        $('#example tbody').on( 'click', 'button', function () {
        // var data = table.row( $(this).parents('tr') ).data();
        // alert( data[1] +"'s salary is: "+ data[1] );
    } );
      
    // add Category
    $("#forms").submit(function (e) {
      e.preventDefault();
    
        $.ajax({
                    type: "POST",
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url:"{{url('category')}}",
                    data:$('#forms').serialize(),
                    success: function (result) {
                      
                      if(result.success){
                         $('.alert-s').show();
                    $('.alert-s').html(result.success);
                     window.location.reload();
                        // alert(result.success);
                      }else{
                        $.each(result.errors,function(key,value){
                          $('.danger').html(value);
                        });
                      
                      }
                    },
                     error: function (error) {
                      // alert(error);/
                      console.log(error);

                    },

        });
    }); 
        // updation
        $("#btn-edit").click(function() {
        
        $.ajax({
            type: 'PUT',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'category/' + $("#frmEditTask input[name=cat_id]").val(),
            data: {
                cat_name: $("#frmEditTask input[name=cat_name]").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#frmEditTask').trigger("reset");
                $("#frmEditTask .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#edit-task-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });
    $("#btn-delete").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: 'category/' + $("#frmDeleteTask input[name=cat_id]").val(),
            dataType: 'json',
            success: function(data) {
                $("#frmDeleteTask .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    
  });
  // edit modal
  function editTaskForm(cat_id) {
    $.ajax({
        type: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'category/' + cat_id,
        success: function(data) {
            $("#edit-error-bag").hide();
            
            $("#frmEditTask input[name=cat_name]").val(data.cat.cat_name);
            $("#frmEditTask input[name=cat_id]").val(data.cat.id);
            $('#editTaskModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}
// delete modal
function deleteTaskForm(cat_id) {
    $.ajax({
        type: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'category/' + cat_id,
        success: function(data) {
            $("#frmDeleteTask #delete-title").html("Delete Task (" + data.cat.cat_name + ")?");
            $("#frmDeleteTask input[name=cat_id]").val(data.cat.id);
            $('#deleteTaskModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
  } 



</script>
 
@endsection