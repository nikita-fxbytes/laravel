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
            <div class="col-lg-12 col-md-12 col-12">
                @include('common.error')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                
                    <div class="text-end d-flex justify-content-between">
                        @if(isset($customer) && count($customer)>0)
                            <div class="">
                                {!! Form::select('', [''=>'Select','active' => 'Active', 'inactive' => 'Inactive'], null, ['class' => 'form-control changeStatus','data-route'=>'changestatus','data-url'=>url('/')]) !!}
                            </div>
                        @endif
                        {{ Form::open([
                            'route' =>  'customer.index',
                            'method' => 'GET'
                            ]) }}
                            <div class="d-flex">
                                {{Form::text('search',Request::input('search'),['class' => 'form-control me-2', 'placeholder' => 'Search Customer'])}}
                                {{Form::submit('Search',['class' => 'getstarted border-0 me-2'])}}
                                <a href="{{ route(\Route::currentRouteName()) }}" class="getstarted border-0">Reset</a>
                            </div>
                        {{ Form::close() }}
                        @if(isset($customer) && count($customer)>0)
                            {{ Form::open([
                                'route' =>  'customer.trashall',
                                'method' => 'delete'
                                ]) }}
                                <button type="submit" class="getstarted border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure do you want delete all customer?')" > 
                                    <i class="bx bxs-trash"></i> All Customer Delete
                                </button>
                            {{ Form::close() }}
                        @endif

                    </div>
                    <div class="table-responsive no_data">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="status_wise_data">
                                @if(isset($customer) && count($customer)>0)
                                    @foreach($customer as $customers)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{route('customer.edit',$customers->id)}}">
                                                    {{isset($customers->id) && $customers->id !=NULL ? $customers->id:''}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('customer.show',$customers->id)}}">
                                                    <b> {{isset($customers->name) && $customers->name !=NULL ? $customers->name:''}}</b>
                                                </a>
                                                <br>
                                                <i>({{isset($customers->user) && $customers->user !=NULL ? $customers->user->name:''}}, {{isset($customers->user) && $customers->user !=NULL ? $customers->user->email:''}})</i>
                                            </td>
                                            <td>{{isset($customers->email) && $customers->email !=NULL ? $customers->email:''}}</td>
                                            <td class="text-center">{{isset($customers->mobile) && $customers->mobile !=NULL ? $customers->mobile:''}}</td>
                                            <td class="text-center">
                                                @if(isset($customers->status) && $customers->status !=NULL && $customers->status == 'active')
                                                    <span class="badge bg-success">{{isset($customers->status) ? $customers->status :''}}</span>
                                                @elseif(isset($customers->status) && $customers->status !=NULL && $customers->status == 'inactive')
                                                    <span class="badge bg-danger">{{isset($customers->status) ? $customers->status :''}}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{isset($customers->created_at) && $customers->created_at !=NULL ? $customers->created_at->diffForHumans():''}}">
                                                    {{isset($customers->created_at) && $customers->created_at !=NULL ? $customers->created_at->diffForHumans():''}}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{route('customer.edit',$customers->id)}}" class="h5 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <i class="bx bx-edit text-success"></i>
                                                    </a>
                                                    {{ Form::open([
                                                        'route' =>  ['customer.destroy',$customers->id],
                                                        'method' => 'delete'
                                                        ]) }}
                                                        <button type="submit" class="border-0 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure do you want delete this customer?')" > 
                                                            <i class="bx bxs-trash"></i>
                                                        </button>
                                                    {{ Form::close() }}
                                                    @if(isset($customers->status) && $customers->status !=NULL && $customers->status == 'active')
                                                        {{ Form::open([
                                                            'route' =>  ['customer.active',$customers->id],
                                                            'method' => 'post'
                                                            ]) }}
                                                            <button type="submit" class="border-0 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Inactive" onclick="return confirm('Are you sure do you want inactive this customer?')" > 
                                                                <i class="bx bxs-user"></i>
                                                            </button>
                                                        {{ Form::close() }}
                                                    @elseif(isset($customers->status) && $customers->status !=NULL && $customers->status == 'inactive')
                                                        {{ Form::open([
                                                            'route' =>  ['customer.active',$customers->id],
                                                            'method' => 'post'
                                                            ]) }}
                                                            <button type="submit" class="border-0 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Active" onclick="return confirm('Are you sure do you want active this customer?')" > 
                                                                <i class="bx bxs-user"></i>
                                                            </button>
                                                        {{ Form::close() }}
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="6"><h4>No Data Found</h4></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end">
                        {{ $customer->links() }}
                    </div>
            </div>
        </div>
      </div>
    </section>

    

  </main>
@endsection
@section('footer')
    <script src="{{env('APP_URL')}}assets/js/customer.js"></script>
@endsection