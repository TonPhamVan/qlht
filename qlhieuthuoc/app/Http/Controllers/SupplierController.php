<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request) {
        $title = 'Thông tin nhà cung cấp';
        if(!empty($search = $request->search)){
            $list = Supplier::orderBy('created_at','DESC')
            ->where('supplier_name','like','%'.$search.'%')
            ->where('deleted_at',null)
            ->paginate(5);
        } else{
            $list = Supplier::orderBy('created_at','DESC')
            ->where('deleted_at',null)
            ->paginate(5);
        }
        return view('clients.suppliers.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    // thêm thông tin nhà cung cấp
    public function add() {
        $title = 'Thêm thông tin nhà cung cấp';
        return view('clients.suppliers.add',compact('title'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'supplier_name' => 'required|unique:suppliers',
            'phone' => 'required|digits:10|unique:suppliers|numeric',
            'email' => 'required|unique:suppliers|email'

        ],[
            'supplier_name.required' => "Tên nhà cung cấp bắt buộc phải nhập",
            'supplier_name.unique' => "Tên nhà cung cấp đã tồn tại",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :digits số',
            'phone.unique' => "Số điện thoại đã tồn tại",
            'phone.numeric' => "Số điện thoại phải là dạng số",
            'email.required' => "Email bắt buộc phải nhập",
            'email.unique' => "Email đã tồn tại",
            'email.email' => "Email không đúng định dạng",
        ]);
        $dataInsert = [
            'supplier_name'=>$request->supplier_name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        Supplier::insert($dataInsert);

        return redirect()->route('suppliers.index')->with('msg','Thêm thông tin nhà cung cấp thành công');
    }

    //sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin nhà cung cấp";
        if(!empty($id)){
            $detail = Supplier::where('id',$id)->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
        } else {
            return redirect()->route('suppliers.index')->with('msg','Thông tin nhà cung cấp không tồn tại');
        }
        return view('clients.suppliers.edit',compact('title','detail'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'supplier_name' => 'required',
            'phone' => 'required|digits:10|numeric',
            'email' => 'required|email'

        ],[
            'supplier_name.required' => "Tên nhà cung cấp bắt buộc phải nhập",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :digits số',
            'phone.numeric' => "Số điện thoại phải là dạng số",
            'email.required' => "Email bắt buộc phải nhập",
            'email.email' => "Email không đúng định dạng",

        ]);
        $dataUpdate = [
            'supplier_name'=>$request->supplier_name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        Supplier::where('id',$id)
        ->update($dataUpdate);
        return redirect()->route('suppliers.index')->with('msg','Cập nhật thông tin nhà cung cấp thành công');

    }
    //xóa mềm
    public function delete($id=0) {
        if(!empty($id)){
            $detail = Supplier::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = Supplier::where('id',$id)->delete();
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
        return redirect()->route('suppliers.index')->with('msg',$msg);
    }

    //danh sách nhà cung cấp đã xóa
    public function trash(Request $request){
        $title = 'Thông tin nhà cung cấp đã xóa';
        if(!empty($search = $request->search)){
            $listdelete = Supplier::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->where('supplier_name','like','%'.$search.'%')
                    ->paginate(5);
        } else{
            $listdelete = Supplier::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
        }
        return view('clients.suppliers.listdelete',compact('title','listdelete'))->with('i',(request()->input('page',1)-1)*1);
    }

    //phục hồi
    public function untrash($id=0) {
        $deleteStatus = Supplier::withTrashed()
        ->where('id',$id);
        $deleteStatus->restore();
        if($deleteStatus){
            $msg = 'Phục hồi thông tin nhà cung cấp thành công';
        } else {
            $msg = 'Bạn không thể phục hồi thông tin nhà cung cấp lúc này. Vui lòng thử lại';
        }

        return redirect()->route('suppliers.trash')->with('msg',$msg);
    }
    //xóa hẳn
    public function forceDelete($id=0) {
        $deleteStatus = Supplier::withTrashed()
        ->where('id',$id);
        $deleteStatus->forceDelete();
        if($deleteStatus){
            $msg = 'Xóa thông tin nhà cung cấp thành công';
        } else {
            $msg = 'Bạn không thể xóa thông tin nhà cung cấp lúc này. Vui lòng thử lại';
        }

        return redirect()->route('suppliers.trash')->with('msg',$msg);
    }
}
