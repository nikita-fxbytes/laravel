<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;
class CustomerController extends Controller
{

    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        // parent::__construct();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $customer = $this->customer
                            ->with('user')
                            // ->where(auth()->user()->id,'user_id')
                            ->where('name', 'LIKE', '%'.$request->input('search').'%')
                            ->orderBy('id', 'DESC')
                            ->simplePaginate(10);
            return view("customer.index",compact('customer'));

        }catch (\Exception $e) {

            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view("customer.create")->with('customer',$this->customer);

        }catch (\Exception $e) {

            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try{
            $request['user_id'] = auth()->user()->id;
            $request['password'] = Hash::make($request['password']);
            $customer = $this->customer->create($request->except('_token'));
            \Session::flash('success', 'Customer create successfully');
            return redirect()->route('customer.edit',$customer->id);

        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $customer = $this->customer->where('id',$id)->first();
            return view('customer.show',compact('customer'));

        }catch (\Exception $e) {

            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $customer = $this->customer->find($id);
            return view('customer.create',compact('customer'))->with('customer',$customer);

        }catch (\Exception $e) {

            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        try{
            // return $request->all();
            $request['user_id'] = auth()->user()->id;
            $request['password'] = Hash::make($request['password']);
            $customer = $this->customer->where('id',$id)
                                        ->update($request->except('_token','_method'));
            \Session::flash('success', 'Customer update successfully');
            return redirect()->route('customer.edit',$id);

        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $customer = $this->customer->where('id',$id)->delete();
            \Session::flash('success', 'Customer delete successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function trash(Request $request)
    {
        try{
            $customer = $this->customer
                            ->onlyTrashed()
                            ->where('name', 'LIKE', '%'.$request->input('search').'%')
                            ->simplePaginate();
            return view('customer.trash',compact('customer'));
        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id){
        try{
            $customer = $this->customer->where('id',$id)->forceDelete();
            \Session::flash('success', 'Customer delete successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function restore($id){
        try{
            $customer = $this->customer->where('id',$id)->restore();
            \Session::flash('success', 'Customer restore successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function restoreAll(Request $request)
    {
        try{
            $customer = $this->customer->onlyTrashed()->restore();
            \Session::flash('success', 'All customer restore successfully');
            return redirect()->back();
        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }
    public function deleteAll(Request $request)
    {
        try{
            // return 'demo';
            $customer = $this->customer->onlyTrashed()->forceDelete();
            \Session::flash('success', 'All customer delete successfully');
            return redirect()->back();
        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function trashAll(Request $request)
    {
        try{
            $customer = $this->customer->select('*')->delete();
            return redirect()->back();
        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function active($id){
        try{
             $customer = $this->customer->where('id',$id)->first();
             if(isset($customer) && $customer !=NULL && $customer->status == 'active'){
                $this->customer->where('id',$id)->update(['status'=>'inactive']);
                \Session::flash('success', 'Customer inactive successfully');
                return redirect()->back();
             }else{
                $this->customer->where('id',$id)->update(['status'=>'active']);
                \Session::flash('success', 'Customer active successfully');
                return redirect()->back();
             }
            

        }catch (\Exception $e) {
            \Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        try{
            $customer = $this->customer
                            ->where(function($query) use ($request){
                                if(isset($request->status) && $request->status != NULL && $request->status != '' && $request->status == 'active'){
                                    $query->where('status',$request->status);
                                }
                            })
                            ->where(function($query) use ($request){
                                if(isset($request->status) && $request->status != NULL && $request->status != '' && $request->status == 'inactive'){
                                    $query->where('status',$request->status);
                                }
                            })
                            ->orderBy('id', 'DESC')
                            ->get();
            $url = $request->url;
            $csrfToken = $request->csrfToken;
            if(isset($customer) && $customer != '[]'){
                $statusData = $this->statusHtml($customer,$url,$csrfToken);
                return \Response::json(["status" => "success","message"=>"Data get successfully", "data" => $statusData ]);
            }else{
                return \Response::json(["status"=>"failed", "message"=>"Data not found"]);
            }

        }catch (\Exception $e){
            return \Response::json(["status"=>"error", "message"=> $e->getMessage()]);
        }

    }

    private function statusHtml($data, $url,$csrfToken)
    {
        $html = '';
        foreach ($data as $customers) {
            $html .= '<tr>';
                $html .= '<td class="text-center">';
                    $html .= '<a href="'.$url.'/customer/'.$customers->id.'/edit">'.$customers->id.'</a>';
                $html .= '</td>';
                $html .= '<td>';
                    $html .= '<a href="'.$url.'/customer/'.$customers->id.'/show">';
                        $html .= '<b>'.$customers->name.'</b>';
                    $html .= '</a>';
                    $html .= '<br>';
                    $html .= '<i>'.$customers->email.'</i>';
                $html .= '</td>';
                $html .= '<td class="text-center">mobile</td>';
                $html .= '<td class="text-center">';
                if($customers->status != NULL && $customers->status == 'active'){
                    $html .= '<span class="badge bg-success">'.$customers->status.'</span>';
                }else{
                    $html .= '<span class="badge bg-danger">'.$customers->status.'</span>';
                }  
                $html .= '</td>';
                $html .= '<td class="text-center">';
                    $html .= '<span data-bs-toggle="tooltip" data-bs-placement="top" title="'.$customers->created_at.'">'.$customers->created_at.'</span>';
                $html .= '</td>';
                $html .= '<td class="text-center d-flex justify-content-center">';
                    $html .= '<a href="'.$url.'/customer/'.$customers->id.'/edit" class="h5 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">';
                        $html .= '<i class="bx bx-edit text-success"></i>';
                    $html .= '</a>';
                    
                    $html .= '<form action="'.$url.'/customer/'.$customers->id.'" method = "post" class="form">';
                        $html .= '<input name="_method" type="hidden" value="DELETE">';
                        $html .= '<input name="_token" type="hidden" value="'.$csrfToken.'">';
                        $html .= '<button type="submit" class="border-0 text-danger confirm_msg" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-type="delete">'; 
                            $html .= '<i class="bx bxs-trash"></i>';
                        $html .= '</button>';
                    $html .= '</form>';
                    if($customers->status != NULL && $customers->status == 'active'){
                        $html .= '<form action="'.$url.'/customers/'.$customers->id.'/active" method = "post" class="form">';
                        $html .= '<input name="_token" type="hidden" value="'.$csrfToken.'">';
                            $html .= '<button type="submit" class="border-0 text-danger confirm_msg" data-bs-toggle="tooltip" data-bs-placement="top" title="Inactive" data-type="inactive">'; 
                                $html .= '<i class="bx bxs-user"></i>';
                            $html .= '</button>';
                        $html .= '</form>';
                    }else{
                        $html .= '<form action="'.$url.'/customers/'.$customers->id.'/active" method = "post" class="form">';
                            $html .= '<input name="_token" type="hidden" value="'.$csrfToken.'">';
                            $html .= '<button type="submit" class="border-0 text-danger confirm_msg" data-bs-toggle="tooltip" data-bs-placement="top" title="Active" data-type="active">'; 
                                $html .= '<i class="bx bxs-user"></i>';
                            $html .= '</button>';
                        $html .= '</form>';
                    } 
                $html .= '</td>';
            $html .= '</tr>';
        }
        return $html;
    }

}
