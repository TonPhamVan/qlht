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
        $title = 'List Customer';
        if(!empty($searchCustomer = $request->searchCustomer)){
            $customersList = $this->customer->searchCustomer($searchCustomer);
        } else{
            $customersList = $this->customer->getAllCustomer();
        }
        return view('clients.customers.list',compact('title','customersList'))->with('i',(request()->input('page',1)-1)*1);

    }
    public function add() {
        $title = 'Add Customers';
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
            $request->id,
            $request->customer_name,
            $request->gender,
            $request->address,
            $request->phone,
            date('Y-m-d H:i:s')
        ];
        $this->customer->addCustomer($dataInsert);

        return redirect()->route('customers.index')->with('msg','Thêm thông tin khách hàng thành công');
    }
    public function getEdit(Request $request, $id=0) {
        $title = "Edit Product";
        if(!empty($id)){
            $productDetail = $this->sanpham->getDetail($id);
            if(!empty($productDetail[0])){
                $request->session()->put('id',$id);
                $productDetail = $productDetail[0];
            }
        } else {
            return redirect()->route('sanpham.index')->with('msg','Sản phẩm không tồn tại');
        }
        return view('clients.product.edit',compact('title','productDetail'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'name' => 'required|min:5',
            'Price' => 'required',

        ],[
            'name.required' => "Name bắt buộc phải nhập",
            'name.min' => "Name phải từ :min ký tự trở lên",
            'Price.required' => 'Price bắt buộc phải nhập',

        ]);
        $dataUpdate = [
            $request->name,
            $request->Price,
            date('Y-m-d H:i:s')
        ];
        $this->sanpham->updateProduct($dataUpdate,$id);

        return redirect()->route('sanpham.index')->with('msg','Cập nhật sản phẩm thành công');

    }
    public function delete($id=0) {
        if(!empty($id)){
            $productDetail = $this->sanpham->getDetail($id);
            if(!empty($productDetail[0])){
                $deleteStatus = $this->sanpham->deleteProduct($id);
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
        return redirect()->route('sanpham.index')->with('msg',$msg);
    }
}