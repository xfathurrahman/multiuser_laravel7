@extends('layouts.admin')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center"> -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Creation</h1>
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
          <li class="breadcrumb-item active">User Management</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

    <div class="container">
    <div class="row justify-content-center">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
          <div class="card-header ">

    <section class="content">
      <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">{{ __('User Creation') }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form id="clientform" method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="alert-danger"><ul></ul></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }} *</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }} *</label>

                    <div class="col-md-6">
                        <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" autofocus>

                        @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }} *</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }} *</label>

                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus>

                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }} *</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" maxlenth="200" required autocomplete="address" autofocus>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }} *</label>

                    <div class="col-md-6">
                        <select id="country_id" class="form-control @error('country_id') is-invalid @enderror" name="country_id" value="{{ old('country_id') }}" required autocomplete="country_id" autofocus>
                        <option value="">Select Country</option>
                        @foreach($countries as $key=>$value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State Name') }} *</label>

                    <div class="col-md-6">
                        <select id="state_id" class="form-control @error('state_id') is-invalid @enderror" name="state_id" value="{{ old('state_id') }}" required autocomplete="state_id" autofocus>
                        <option value="">Select State</option>
                        @foreach($states as $key=>$value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                        </select>
                        @error('state_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pincode" class="col-md-4 col-form-label text-md-right">{{ __('Pincode') }} *</label>

                    <div class="col-md-6">
                        <input id="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" maxlenth="15" required autocomplete="pincode" autofocus>

                        @error('pincode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }} *</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} *</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} *</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-submit btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    </section>
      <!-- container -->

        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Client Register') }}</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">

                </div>
                </div>
            </div>
            </div>-->      
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#country_id").change(function(){
    country_id=this.value;
    $.ajax({
        type: "GET",
        url: "{{ url('country/state') }}/"+country_id,
        dataType: 'json',
        success: function(res){
            if(res.success===true){
                $("#state_id").html("");
                $("#state_id").append("<option value=''>Select State</option>");

                if(res.data && res.data.length>0){
                   res.data.map(function(item, index) {
                    $("#state_id").append("<option value='"+item.id+"'>"+item.name+"</option>"); 
                   })
                }
            }else{
                $("#state_id").append("<option value=''>Select State</option>");
            }
        }
    });
})
$(".btn-submit").click(function(e) {
    e.preventDefault();
    var formdata=$("#clientform").serialize();
    // console.log(formdata);return null;
    $.ajax({
        type: "POST",
        url: "{{ route('user.store') }}",
        data: formdata,
        success: function(res){
            if(res.success===true){
                alert(res.message);
                window.location.href = '{{ route('user.index') }}';
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
