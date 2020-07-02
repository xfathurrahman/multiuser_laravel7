@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Book Management</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @if(Auth::user()->role===3)
          <li class="breadcrumb-item"><a href="{{ url('userprofile/'.Auth::user()->id) }}">Home</a></li>
          @endif
          @if(Auth::user()->role===2)
          <li class="breadcrumb-item"><a href="{{ url('clients/'.Auth::user()->id) }}">Home</a></li>
          @endif
          @if(Auth::user()->role===1)
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          @endif
          <li class="breadcrumb-item active">Book Management</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">{{ __('Book Creation') }}
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form id="ownbookform" method="POST" action="{{ route('ownbookcreate') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5><i class="icon fas fa-check"></i> Errors!</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <div class="form-group row">
                            <label for="book_name" class="col-md-4 col-form-label text-md-right">{{ __('Book Name') }} *</label>

                            <div class="col-md-6">
                                <input id="book_name" type="text" class="form-control @error('book_name') is-invalid @enderror" name="book_name" value="{{ old('book_name') }}" required autocomplete="book_name" autofocus>

                                @error('book_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isbn_number" class="col-md-4 col-form-label text-md-right">{{ __('ISBN Number') }} *</label>
                            <div class="col-md-6">
                                <input id="isbn_number" type="text" class="form-control @error('isbn_number') is-invalid @enderror" name="isbn_number" value="{{ old('isbn_number') }}" required autocomplete="isbn_number" autofocus>

                                @error('isbn_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="received_date" class="col-md-4 col-form-label text-md-right">{{ __('Received Date') }} *</label>

                            <div class="col-md-6">
                                <input id="received_date" type="date" class="form-control @error('received_date') is-invalid @enderror" name="received_date" value="{{ old('received_date') }}" required autocomplete="received_date" autofocus>

                                @error('received_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="del_date" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Date') }} *</label>

                            <div class="col-md-6">
                                <input id="del_date" type="date" class="form-control @error('del_date') is-invalid @enderror" name="delivery_date" value="{{ old('del_date') }}" required autocomplete="del_date" autofocus>

                                @error('del_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author_first_name" class="col-md-4 col-form-label text-md-right">{{ __('Author First Name') }} *</label>

                            <div class="col-md-6">
                                <input id="author_first_name" type="text" class="form-control @error('author_first_name') is-invalid @enderror" name="author_first_name" value="{{ old('author_first_name') }}" maxlenth="200" required autocomplete="address" autofocus>

                                @error('author_first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author_last_name" class="col-md-4 col-form-label text-md-right">{{ __('Author Last Name') }} *</label>

                            <div class="col-md-6">
                                <input type="text" id="author_last_name" class="form-control @error('author_last_name') is-invalid @enderror" name="author_last_name" value="{{ old('author_last_name') }}" required autocomplete="author_last_name" autofocus />
                                @error('author_last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary 
                                btn-submit">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".btn-submit").click(function(e) {
    e.preventDefault();
    var formdata=$("#ownbookform").serialize();
    // console.log(formdata);return null;
    $.ajax({
        type: "POST",
        url: "{{ url('ownbookcreate') }}",
        data: formdata,
        success: function(res){
            if(res.success===true){
                alert(res.message);
                window.location.href = "{{ route('ownbooklist') }}";
            }else{
                console.log(Object.values(res));
                let msg= Object.values(res)

                /*.message.map( function(item, index){
                    $(".alert-danger>ul").append("<li>"+item+"</li>")
                })*/
                alert('something wrong!');
                return null;
            }
        }
    });
});
</script>
@endsection
