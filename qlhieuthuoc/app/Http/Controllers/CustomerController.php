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
    public function index(Request $request) {
        $title = 'Thông tin khách hàng';
        if(!empty($search = $request->search)){
            $list = $this->customer->getSearch($search);
        } else{
            $list = $this->customer->getAll();
        }
        return view('clients.customers.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    public function add() {
        $title = 'Thêm thông tin khách hàng';
        return view('clients.customers.add',compact('title'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'id' => 'required|unique:customers',
            'customer_name' => 'required',
            'phone' => 'required|size:10',

        ],[
            'id.required' => "Mã khách hàng bắt buộc phải nhập",
            'id.unique' => "Mã khách hàng đã tồn tại",
            'customer_name.required' => "Tên khách hàng bắt buộc phải nhập",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :size số',

        ]);
        $dataInsert = [
            'id'=>$request->id,
            'customer_name'=>$request->customer_name,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        $this->customer->postAdd($dataInsert);

        return redirect()->route('customers.index')->with('msg','Thêm thông tin khách hàng thành công');
    }
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin khách hàng";
        if(!empty($id)){
            $detail = $this->customer->getDetail($id);
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
            'id' => 'required|unique:customers,id,'.$id,
            'customer_name' => 'required',
            'phone' => 'required|size:10',

        ],[
            'id.required' => "Mã khách hàng bắt buộc phải nhập",
            'id.unique' => "Mã khách hàng đã tồn tại",
            'customer_name.required' => "Tên khách hàng bắt buộc phải nhập",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :size số',

        ]);
        $dataUpdate = [
            'id'=>$request->id,
            'customer_name'=>$request->customer_name,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        $this->customer->postUpdate($dataUpdate,$id);

        return redirect()->route('customers.index')->with('msg','Cập nhật thông tin khách hàng thành công');

    }
    public function delete($id=0) {
        if(!empty($id)){
            $detail = $this->customer->getDetail($id);
            if(!empty($detail[0])){
                $deleteStatus = $this->customer->postDelete($id);
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

    public function trash(Request $request){
        $title = 'Thông tin khách hàng đã xóa';
        if(!empty($search = $request->search)){
            $list = $this->customer->trashSearch($search);
        } else{
            $list = $this->customer->trashDelete();
        }
        return view('clients.customers.listdelete',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);
    }

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