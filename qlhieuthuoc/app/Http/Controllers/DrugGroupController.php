<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrugGroup;


class DrugGroupController extends Controller
{
    private $drugGroups;
    public function __construct()
    {
        $this->drugGroups = new DrugGroup();
    }
    public function index(Request $request) {
        $title = 'Thông tin nhóm thuốc';
        if(!empty($search = $request->search)){
            $list = DrugGroup::orderBy('created_at','DESC')
            ->where('name_drug_group','like','%'.$search.'%')
            ->where('deleted_at',null)
            ->paginate(5);
        } else{
            $list = DrugGroup::orderBy('created_at','DESC')
            ->where('deleted_at',null)
            ->paginate(5);
        }
        return view('clients.drug_groups.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    // thêm thông tin 
    public function add() {
        $title = 'Thêm thông tin nhóm thuốc';
        return view('clients.drug_groups.add',compact('title'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'name_drug_group' => 'required|unique:drug_groups',

        ],[
            'name_drug_group.required' => "Tên nhóm thuốc bắt buộc phải nhập",
            'name_drug_group.unique' => "Tên nhóm thuốc đã tồn tại",

        ]);
        $dataInsert = [
            'name_drug_group'=>$request->name_drug_group,
            'note'=>$request->note,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        DrugGroup::insert($dataInsert);
        return redirect()->route('drug_groups.index')->with('msg','Thêm thông tin nhóm thuốc thành công');
    }

    //sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin nhóm thuốc";
        if(!empty($id)){
            $detail = DrugGroup::where('id',$id)->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
        } else {
            return redirect()->route('drug_groups.index')->with('msg','Thông tin nhóm thuốc không tồn tại');
        }
        return view('clients.drug_groups.edit',compact('title','detail'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'name_drug_group' => 'required',

        ],[
            'name_drug_group.required' => "Tên nhóm thuốc bắt buộc phải nhập",
        ]);
        $dataUpdate = [
            'name_drug_group'=>$request->name_drug_group,
            'note'=>$request->note,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        DrugGroup::where('id',$id)->update($dataUpdate);

        return redirect()->route('drug_groups.index')->with('msg','Cập nhật thông tin nhóm thuốc thành công');

    }
    //xóa mềm
    public function delete($id=0) {
        if(!empty($id)){
            $detail = DrugGroup::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = DrugGroup::where('id',$id)->delete();
                if($deleteStatus){
                    $msg = 'Xóa nhóm thuốc thành công';
                } else {
                    $msg = 'Bạn không thể xóa nhóm thuốc lúc này. Vui lòng thử lại';
                }
            } else {
                $msg = 'nhóm thuốc không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('drug_groups.index')->with('msg',$msg);
    }

    //danh sách đã xóa
    public function trash(Request $request){
        $title = 'Thông tin nhóm thuốc đã xóa';
        if(!empty($search = $request->search)){
            $listdelete = DrugGroup::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->where('name_drug_group','like','%'.$search.'%')
                    ->paginate(5);
        } else{
            $listdelete = DrugGroup::onlyTrashed()
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
        }
        return view('clients.drug_groups.listdelete',compact('title','listdelete'))->with('i',(request()->input('page',1)-1)*1);
    }

    //phục hồi
    public function untrash($id=0) {
        $deleteStatus = DrugGroup::withTrashed()
        ->where('id',$id);
        $deleteStatus->restore();
        if($deleteStatus){
            $msg = 'Phục hồi thông tin nhóm thuốc thành công';
        } else {
            $msg = 'Bạn không thể phục hồi thông tin nhóm thuốc lúc này. Vui lòng thử lại';
        }

        return redirect()->route('drug_groups.trash')->with('msg',$msg);
    }
    //xóa hẳn
    public function forceDelete($id=0) {
        $deleteStatus = DrugGroup::withTrashed()
        ->where('id',$id);
        $deleteStatus->forceDelete();
        if($deleteStatus){
            $msg = 'Xóa thông tin nhóm thuốc thành công';
        } else {
            $msg = 'Bạn không thể xóa thông tin nhóm thuốc lúc này. Vui lòng thử lại';
        }

        return redirect()->route('drug_groups.trash')->with('msg',$msg);
    }
}
