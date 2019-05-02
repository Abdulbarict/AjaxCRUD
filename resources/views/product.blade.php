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
    <form id="forms_prod" enctype="multipart/form-data" > 
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Add Product</label>
          <input type="text" class="form-control" name="pro_name" placeholder="Enter Product">
          <p class="text-danger danger-name"></p>
      </div>
       <div class="form-group">
          <label for="exampleInputEmail1">Select Category</label>
          <select class="form-control" id="category" name="pro_category">
              <option value="0" selected>--Select--</option>
                 @foreach($categories as $cat)
                  <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                  @endforeach
          </select>
          <p class="text-danger danger-name"></p>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Add Image</label>
          <input type="file" class="form-control image" name="pro_img" >
          <p class="text-danger danger-img"></p>
      </div>
    
  
  <button type="submit" class="btn btn-primary" id="save">Submit</button>
</form>
 
  </div>

  {{-- list category --}}
  <div class="tab-pane fade show active " id="profile" role="tabpanel" aria-labelledby="profile-tab">
    
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Products</th>
                <th scope="col">Category</th>

                <th scope="col">Action</th>
                
              </tr>
            </thead>
            <tbody>
         
              <tr>
                <th scope="row"></th>
                <td>}}</td>
                <td></td>
                <td>
                  <a onclick="event.preventDefault();ViewForm();" href="#" class="edit open-modal" data-toggle="modal" value=""><i class="material-icons" data-toggle="tooltip" title="View"></i>View</a>
                      <a onclick="event.preventDefault();editTaskForm();" href="#" class="edit open-modal" data-toggle="modal" value=""><i class="material-icons" data-toggle="tooltip" title="Edit"></i>Edit</a>

                      <a onclick="event.preventDefault();deleteTaskForm();" href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i>Delete</a>
                </td>
                
              </tr>
             
            </tbody>
          </table>
     
    <p>I don't have any records!</p>
  

  </div>
  
</div>
    {{--  edit  delete--}}
       
  
</div>
</div>

</div>

<script type="text/javascript">
  $(document).ready(function () {
    // add Category
    $("#forms_prod").submit(function (e) {
      e.preventDefault();
      
      var da= new FormData(document.getElementById("forms_prod"));
      alert(da);
        // formData.append('pro_img', $('input[type=file]')[0].files[0]);
              
        // $.ajax({
        //             type: "POST",
        //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //             dataType: 'json',
        //             url:"{{url('product')}}",
        //             data:formData,
        //             success: function (result) {
                      
        //               if(result.success){
        //                 console.log(result.success);
                    //      $('.alert-s').show();
                    // $('.alert-s').html(result.success);
                    //  window.location.reload();
                        // alert(result.success);
                      // }else{
                      //   $.each(result.errors,function(key,value){
                          // $('.danger').html(value);
                    //       console.log(value); 
                    //       alert(value);
                    //     });
                      
                    //   }
                    // },
                    //  error: function (error) {
                    //   // alert(error);/
                    //   console.log(error);

                    // },

        });
    // }); 
  });
//         // updation
//         $("#btn-edit").click(function() {
        
//         $.ajax({
//             type: 'PUT',
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             url: 'category/' + $("#frmEditTask input[name=cat_id]").val(),
//             data: {
//                 cat_name: $("#frmEditTask input[name=cat_name]").val(),
//             },
//             dataType: 'json',
//             success: function(data) {
//                 $('#frmEditTask').trigger("reset");
//                 $("#frmEditTask .close").click();
//                 window.location.reload();
//             },
//             error: function(data) {
//                 var errors = $.parseJSON(data.responseText);
//                 $('#edit-task-errors').html('');
//                 $.each(errors.messages, function(key, value) {
//                     $('#edit-task-errors').append('<li>' + value + '</li>');
//                 });
//                 $("#edit-error-bag").show();
//             }
//         });
//     });
//     $("#btn-delete").click(function() {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             type: 'DELETE',
//             url: 'category/' + $("#frmDeleteTask input[name=cat_id]").val(),
//             dataType: 'json',
//             success: function(data) {
//                 $("#frmDeleteTask .close").click();
//                 window.location.reload();
//             },
//             error: function(data) {
//                 console.log(data);
//             }
//         });
//     });
    
//   });
//   // edit modal
//   function editTaskForm(cat_id) {
//     $.ajax({
//         type: 'GET',
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         url: 'category/' + cat_id,
//         success: function(data) {
//             $("#edit-error-bag").hide();
            
//             $("#frmEditTask input[name=cat_name]").val(data.cat.cat_name);
//             $("#frmEditTask input[name=cat_id]").val(data.cat.id);
//             $('#editTaskModal').modal('show');
//         },
//         error: function(data) {
//             console.log(data);
//         }
//     });
// }
// // delete modal
// function deleteTaskForm(cat_id) {
//     $.ajax({
//         type: 'GET',
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         url: 'category/' + cat_id,
//         success: function(data) {
//             $("#frmDeleteTask #delete-title").html("Delete Task (" + data.cat.cat_name + ")?");
//             $("#frmDeleteTask input[name=cat_id]").val(data.cat.id);
//             $('#deleteTaskModal').modal('show');
//         },
//         error: function(data) {
//             console.log(data);
//         }
//     });
//   } 



</script>
 
@endsection