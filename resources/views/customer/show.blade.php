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
                <div class="bg-white border p-4">
                    <div class="row mb-4 text-end">
                        <div class="col-md-12 col-lg-12 col-12 px-0">
                            <a href="{{route('customer.edit',$customer->id)}}" class="getstarted border-0">Edit Customer</a>
                        </div>
                    </div>
                    @if(isset($customer) && $customer !=NULL && $customer->name !=NULL)
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-3 col-12">
                                <label><b>Name :</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-12">
                                {{isset($customer->name) ? $customer->name:''}}
                            </div>
                        </div>
                    @endif
                    @if(isset($customer) && $customer !=NULL && $customer->email !=NULL)
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-3 col-12">
                                <label><b>Email :</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-12">
                                {{isset($customer->email) ? $customer->email:''}}
                            </div>
                        </div>
                    @endif
                    @if(isset($customer) && $customer !=NULL && $customer->mobile != NULL)
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-3 col-12">
                                <label><b>Mobile :</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-12">
                                {{isset($customer->mobile) ? $customer->mobile:''}}
                            </div>
                        </div>
                    @endif
                    @if(isset($customer) && $customer !=NULL && $customer->Description !=NULL)
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-3 col-12">
                                <label><b>Description :</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-12">
                                {{isset($customer->Description) ? $customer->Description :''}}
                            </div>
                        </div>
                    @endif
                    @if(isset($customer) && $customer !=NULL && $customer->status !=NULL)
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-3 col-12">
                                <label><b>Status :</b></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-12">
                                @if($customer->status == 'active')
                                    <span class="badge bg-success">{{isset($customer->status) ? $customer->status :''}}</span>
                                @else
                                    <span class="badge bg-danger">{{isset($customer->status) ? $customer->status :''}}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <label><b>Created :</b></label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-12">
                            {{isset($customer->created_at) && $customer->created_at !=NULL ? $customer->created_at->diffForHumans():''}}
                        </div>
                    </div>
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