@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-3">
            @include('layouts.sidenav')
        </div>
  <div class="col-9">
    <div class="card-deck">

    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Products</div>
  <div class="card-body">
    <h5 class="card-title">4</h5>
  
  </div>
</div>
<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Categories</div>
  <div class="card-body">
    <h5 class="card-title">5</h5>
  
  </div>
</div>
</div>


</div>
</div>

</div>
 
@endsection
