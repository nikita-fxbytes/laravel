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
                    <div class="d-flex justify-content-between">
                        {{ Form::open([
                            'route' =>  'customer.trash',
                            'method' => 'GET'
                            ]) }}
                            <div class="d-flex">
                                {{Form::text('search',Request::input('search'),['class' => 'form-control me-2', 'placeholder' => 'Search Customer'])}}
                                {{Form::submit('Search',['class' => 'getstarted border-0 me-2'])}}
                                <a href="{{ route(\Route::currentRouteName()) }}" class="getstarted border-0">Reset</a>
                            </div>
                        {{ Form::close() }}
                        @if(isset($customer) && count($customer)>0)
                            <div class="d-flex">
                            {{ Form::open([
                                'route' =>  'customer.restoreall',
                                'method' => 'post'
                                ]) }}
                                <button type="submit" class="getstarted border-0 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure do you want restore all customer?')" > 
                                    <i class="bx bx-right-arrow-circle"></i> All Customer Restore
                                </button>
                            {{ Form::close() }}
                            {{ Form::open([
                                'route' =>  'customer.deleteall',
                                'method' => 'delete'
                                ]) }}
                                <button type="submit" class="getstarted border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure do you want delete all customer?')" > 
                                    <i class="bx bxs-trash"></i> All Customer Delete
                                </button>
                            {{ Form::close() }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#Id</th>
                                    <th>Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created at</th>
                                    <th class="text-center">Deleted at</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($customer) && count($customer)>0)
                                    @foreach($customer as $customers)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{route('customer.edit',$customers->id)}}">
                                                    {{isset($customers->id) && $customers->id !=NULL ? $customers->id:''}}
                                                </a>
                                            </td>
                                            <td>
                                                
                                                <b> {{isset($customers->name) && $customers->name !=NULL ? $customers->name:''}}</b>
                                            <br>
                                                <i>{{isset($customers->email) && $customers->email !=NULL ? $customers->email:''}}</i>
                                            </td>
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
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{isset($customers->deleted_at) && $customers->deleted_at !=NULL ? $customers->deleted_at->diffForHumans():''}}">
                                                    {{isset($customers->deleted_at) && $customers->deleted_at !=NULL ? $customers->deleted_at->diffForHumans():''}}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    {{ Form::open([
                                                        'route' =>  ['customer.restore',$customers->id],
                                                        'method' => 'post'
                                                        ]) }}
                                                        <button type="submit" class="h5 me-2 border-0 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore" onclick="return confirm('Are you sure do you want restore this customer?')" > 
                                                            <i class="bx bx-right-arrow-circle"></i>
                                                        </button>
                                                    {{ Form::close() }}
                                                    {{ Form::open([
                                                        'route' =>  ['customer.delete',$customers->id],
                                                        'method' => 'delete'
                                                        ]) }}
                                                        <button type="submit" class="h5 border-0 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure do you want delete this customer?')" > 
                                                            <i class="bx bxs-trash"></i>
                                                        </button>
                                                    {{ Form::close() }}
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
@endsection