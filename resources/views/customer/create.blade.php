@extends('index')
@section('title', 'Page Title')
@section('header')
@endsection
@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
            <h1>Your New Online Presence with Bethany</h1>
            <h2>We are team of talented designers making websites with Bootstrap</h2>
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section>
    <main id="main">
        <section id="clients" class="clients">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12"></div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="bg-white border p-3">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    @include('common.error')
                                </div>
                            </div>
                            {{ Form::open([
                                'route' => $customer->exists ? ['customer.update',$customer->id]:'customer.store',
                                'method' => $customer->exists ? 'put':'post',
                                'data-parsley-validate'=>''
                                ]) }}
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group mb-3">
                                            {{Form::label('name', 'Name')}}<span class="text-danger">*</span>
                                            {{Form::text('name',isset($customer->name) && $customer->name !=NULL ? $customer->name:old('name'),['class' => 'form-control', 'placeholder' => 'Enter Name','data-parsley-required'=>'true'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group mb-3">
                                            {{Form::label('email', 'Email')}}<span class="text-danger">*</span>
                                            {{Form::email('email',isset($customer->email) && $customer->email !=NULL ? $customer->email:old('email'),['class' => 'form-control', 'placeholder' => 'Enter Email','data-parsley-required'=>'true','data-parsley-trigger'=>'change'])}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group mb-3">
                                            {{Form::label('mobile', 'Mobile')}}<span class="text-danger">*</span>
                                            {{Form::number('mobile',isset($customer->mobile) && $customer->mobile !=NULL ? $customer->mobile:old('mobile'),['class' => 'form-control', 'placeholder' => 'Enter Mobile','data-parsley-required'=>'true','data-parsley-maxlength'=>'10','data-parsley-minlength'=>'10'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group mb-3">
                                            {{Form::label('password', 'Password')}}
                                            {{Form::password('password',['class' => 'form-control', 'placeholder' => 'Enter Password','data-parsley-minlength'=>'6'])}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group mb-3">
                                            {{Form::label('status', 'Status')}}
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    {{Form::radio('status', 'active',isset($customer->status) && $customer->status !=NULL && $customer->status=='active'? true:'',['class' => 'form-check-input','id'=>'active'])}}
                                                    {{Form::label('active', 'Active',['class' => 'form-check-label','id'=>'active'])}}
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    {{Form::radio('status', 'inactive',isset($customer->status) && $customer->status !=NULL && $customer->status=='inactive'? true:'',['class' => 'form-check-input','id'=>'inactive'])}}
                                                    {{Form::label('inactive','InActive',['class' => 'form-check-label','id'=>'inactive'])}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group mb-3">
                                            {{Form::label('description', 'Description')}}
                                            {{Form::textarea('Description',isset($customer->Description) && $customer->Description !=NULL ? $customer->Description:old('Description'),['class' => 'form-control', 'placeholder' => 'Please Write'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            {{Form::submit($customer->exists?'Update':'Submit',['class' => 'getstarted border-0'])}}
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12"></div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('footer')
@endsection