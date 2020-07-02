@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Book List Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if(Auth::user()->role===3)
		          <li class="breadcrumb-item"><a href="{{ url('user/'.Auth::user()->id) }}">Home</a></li>
		        @endif
		        @if(Auth::user()->role===2)
		          <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Home</a></li>
		        @endif
		        @if(Auth::user()->role===1)
		          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
		        @endif
              <li class="breadcrumb-item active">Book List Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ __('Book List Management') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>ISBN</th>
                  <th>Received Date</th>
                  <th>Delivery Date</th>
                  <th>Auhor Name</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($books as $user)
                <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->book_name}}</td>
                <td>{{$user->isbn_number}}</td>
                <td>{{date('d-m-Y', strtotime($user->received_date))}}</td>
                <td>{{date('d-m-Y', strtotime($user->delivery_date))}}</td>
                <td>{{$user->author_first_name}}</td>
                <td><a class="btn btn-warning ml-5" 
                	href="{{url('book/'.$user->id.'/edit')}}">Edit</a> 
                	<button class="btn btn-success btn-delete" 
                	value="{{$user->id}}" >
                	Delete</button>

                </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>ISBN</th>
                  <th>Received Date</th>
                  <th>Delivery Date</th>
                  <th>Auhor Name</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <script type="text/javascript">
    	// $(".btn-delete").click(function(){
    	$(document).on("click", ".btn-delete", function() { 
   	        var $ele = $(this).parent().parent();
    		var id=$(this).val();
    		var url="{{url('book')}}";
    		var delurl=url+'/'+id;
    		$.ajax({
    			url: delurl,
    			type: "DELETE",
    			cache: false,
    			data: {
    				_token: '{{csrf_token()}}'
    			},
    			success: function(dataResult){
    				// var dataResult = JSON.parse(dataResult);
    				alert(dataResult.message);
					if(dataResult.statusCode==200){
						$ele.fadeOut().remove();
					}
				}
	  		});
    	});

    </script>
@endsection
