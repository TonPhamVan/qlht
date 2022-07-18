<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $User;
    public function __construct()
    {
        $this->User = new User();
    }
    //danh sách tài khoản
    public function index(Request $request) {
        $title = 'Thông tin tài khoản';
        if(!empty($search = $request->search)){
            $list = User::orderBy('created_at','DESC')
            ->where('fullname','like','%'.$search.'%')
            ->where('deleted_at',null)
            ->paginate(5);
        } else{
            $list = User::orderBy('created_at','DESC')
            ->where('deleted_at',null)
            ->paginate(5);
        }
        return view('clients.users.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    // thêm thông tin tài khoản
    public function add() {
        $title = 'Thêm thông tin tài khoản';
        $permission = Permission::where('deleted_at',null)->get();
        return view('clients.users.add',compact('title','permission'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'user_email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'phone' => 'required|digits:10|unique:Users|numeric',

        ],[
            'user_email.required' => "Tài khoản email bắt buộc phải nhập",
            'user_email.unique' => "Tài khoản email phải là duy nhất",
            'user_email.email' => "Tài khoản email không đúng định dạng",
            'password.required' => "Mật khẩu bắt buộc phải nhập",
            'password.min' => "Mật khẩu phải có 8 kí tự trở lên",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :digits số',
            'phone.unique' => "Số điện thoại đã tồn tại",
            'phone.numeric' => "Số điện thoại phải là dạng số",

        ]);
        $dataInsert = [
            'user_email'=>$request->user_email,
            'password'=>Hash::make($request->password),
            'fullname'=>$request->fullname,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'permission_id'=>$request->permission_id,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        User::insert($dataInsert);

        return redirect()->route('users.index')->with('msg','Thêm thông tin tài khoản thành công');
    }

    //sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin tài khoản";
        if(!empty($id)){
            $detail = User::where('id',$id)->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
        } else {
            return redirect()->route('users.index')->with('msg','Thông tin tài khoản không tồn tại');
        }
        return view('clients.users.edit',compact('title','detail'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'User_name' => 'required',
            'phone' => 'required|digits:10|numeric',

        ],[
            'User_name.required' => "Tên tài khoản bắt buộc phải nhập",
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.size' => 'Số điện thoại phải có :digits số',
            'phone.numeric' => 'Số điện thoại phải là dạng số',

        ]);
        $dataUpdate = [
            'User_name'=>$request->User_name,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        User::where('id',$id)
        ->update($dataUpdate);
        return redirect()->route('users.index')->with('msg','Cập nhật thông tin tài khoản thành công');

    }
    //xóa mềm
    public function delete($id=0) {
        if(!empty($id)){
            $detail = User::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = User::where('id',$id)->delete();
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
        return redirect()->route('users.index')->with('msg',$msg);
    }

    //danh sách tài khoản đã xóa
    public function trash(Request $request){
        $title = 'Thông tin tài khoản đã xóa';
        if(!empty($search = $request->search)){
            $listdelete = User::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->where('User_name','like','%'.$search.'%')
                    ->paginate(5);
        } else{
            $listdelete = User::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
        }
        return view('clients.users.listdelete',compact('title','listdelete'))->with('i',(request()->input('page',1)-1)*1);
    }

    //phục hồi
    public function untrash($id=0) {
        $deleteStatus = User::withTrashed()
        ->where('id',$id);
        $deleteStatus->restore();
        if($deleteStatus){
            $msg = 'Phục hồi thông tin tài khoản thành công';
        } else {
            $msg = 'Bạn không thể phục hồi thông tin tài khoản lúc này. Vui lòng thử lại';
        }

        return redirect()->route('users.trash')->with('msg',$msg);
    }
    //xóa hẳn
    public function forceDelete($id=0) {
        $deleteStatus = User::withTrashed()
        ->where('id',$id);
        $deleteStatus->forceDelete();
        if($deleteStatus){
            $msg = 'Xóa thông tin tài khoản thành công';
        } else {
            $msg = 'Bạn không thể xóa thông tin tài khoản lúc này. Vui lòng thử lại';
        }

        return redirect()->route('users.trash')->with('msg',$msg);
    }
}