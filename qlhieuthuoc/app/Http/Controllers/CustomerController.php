<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customer;
    public function __construct()
    {
        $this->customer = new Customer();
    }
    //danh sách khách hàng
    public function index(Request $request) {
        $title = 'Thông tin khách hàng';
        if(!empty($search = $request->search)){
            $list = Customer::orderBy('created_at','DESC')
            ->where('customer_name','like','%'.$search.'%')
            ->where('deleted_at',null)
            ->paginate(5);
        } else{
            $list = Customer::orderBy('created_at','DESC')
            ->where('deleted_at',null)
            ->paginate(5);
        }
        return view('clients.customers.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    // thêm thông tin khách hàng
    public function add() {
        $title = 'Thêm thông tin khách hàng';
        return view('clients.customers.add',compact('title'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required|size:10|unique:customers',

        ],[
            'customer_name.required' => "Tên khách hàng bắt buộc phải nhập",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :size số',
            'phone.unique' => "Số điện thoại đã tồn tại",

        ]);
        $dataInsert = [
            'customer_name'=>$request->customer_name,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        Customer::insert($dataInsert);

        return redirect()->route('customers.index')->with('msg','Thêm thông tin khách hàng thành công');
    }

    //sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin khách hàng";
        if(!empty($id)){
            $detail = Customer::where('id',$id)->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
        } else {
            return redirect()->route('customers.index')->with('msg','Thông tin khách hàng không tồn tại');
        }
        return view('clients.customers.edit',compact('title','detail'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required|size:10',

        ],[
            'customer_name.required' => "Tên khách hàng bắt buộc phải nhập",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :size số',

        ]);
        $dataUpdate = [
            'customer_name'=>$request->customer_name,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        Customer::where('id',$id)
        ->update($dataUpdate);
        return redirect()->route('customers.index')->with('msg','Cập nhật thông tin khách hàng thành công');

    }
    //xóa mềm
    public function delete($id=0) {
        if(!empty($id)){
            $detail = Customer::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = Customer::where('id',$id)->delete();
                if($deleteStatus){
                    $msg = 'Xóa người dùng thành công';
                } else {
                    $msg = 'Bạn không thể xóa người dùng lúc này. Vui lòng thử lại';
                }
            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('customers.index')->with('msg',$msg);
    }

    //danh sách khách hàng đã xóa
    public function trash(Request $request){
        $title = 'Thông tin khách hàng đã xóa';
        if(!empty($search = $request->search)){
            $listdelete = Customer::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->where('customer_name','like','%'.$search.'%')
                    ->paginate(5);
        } else{
            $listdelete = Customer::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
        }
        return view('clients.customers.listdelete',compact('title','listdelete'))->with('i',(request()->input('page',1)-1)*1);
    }

    //phục hồi
    public function untrash($id=0) {
        $deleteStatus = Customer::withTrashed()
        ->where('id',$id);
        $deleteStatus->restore();
        if($deleteStatus){
            $msg = 'Phục hồi thông tin khách hàng thành công';
        } else {
            $msg = 'Bạn không thể phục hồi thông tin khách hàng lúc này. Vui lòng thử lại';
        }

        return redirect()->route('customers.trash')->with('msg',$msg);
    }
    //xóa hẳn
    public function forceDelete($id=0) {
        $deleteStatus = Customer::withTrashed()
        ->where('id',$id);
        $deleteStatus->forceDelete();
        if($deleteStatus){
            $msg = 'Xóa thông tin khách hàng thành công';
        } else {
            $msg = 'Bạn không thể xóa thông tin khách hàng lúc này. Vui lòng thử lại';
        }

        return redirect()->route('customers.trash')->with('msg',$msg);
    }
}