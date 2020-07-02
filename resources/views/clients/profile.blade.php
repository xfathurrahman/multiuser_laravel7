@extends('layouts.admin')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header ">
            <h3 class="card-title">{{ __('Client Profile') }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }} *</label>
                    <div class="col-md-6">
                        {{$clients->first_name}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }} *</label>
                    <div class="col-md-6">
                        {{$clients->middle_name}}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }} *</label>
                    <div class="col-md-6">
                        {{$clients->last_name}}
                    </div>
                </div>


                <div class="form-group row">
                    <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }} : </label>
                    <div class="col-md-6">
                        {{date('Y-m-d', strtotime($clients->dob))}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }} : </label>
                    <div class="col-md-6">
                        {{$clients->address}}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }} : </label>
                    <div class="col-md-6">
                        <!-- {{$clients->countryname}} -->
                        {{$country->name}}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('State Name') }} : </label>
                    <div class="col-md-6">
                        <!-- {{$clients->statename}} -->
                        {{$state->name}}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Pincode') }}: </label>
                    <div class="col-md-6">
                        {{$clients->pincode}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }} : </label>
                    <div class="col-md-6">
                        {{$clients->name}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} : </label>
                    <div class="col-md-6">
                        {{$clients->email}}
                    </div>
                </div>

          </div>
          <!-- /.card-body -->
        </div>
      </diWv>
    </div>
</section>
@endsection
