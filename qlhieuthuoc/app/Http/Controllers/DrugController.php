<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\DrugGroup;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    private $drugs;
    public function __construct()
    {
        $this->drugs = new Drug();
    }
    public function index(Request $request) {
        $title = 'Thông tin thuốc';
        $drugGroup = Drug::select('drugs.*','drug_groups.name_drug_group')
        ->leftJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id')
        ->where('drug_groups.deleted_at',null)
        ->where('drugs.deleted_at',null);
        if(!empty($search = $request->search)){
            $list = Drug::select('drugs.*','drug_groups.name_drug_group')
                ->rightJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id')
                ->union($drugGroup)
                ->where('drugs.id','!=','drugs.id_drug_group')
                ->where('drugs.drug_name','like','%'.$search.'%')
                ->where('drug_groups.deleted_at',null)
                ->where('drugs.deleted_at',null)
                ->paginate(5);
                // dd($list);
        } else{
            $list = Drug::select('drugs.*','drug_groups.name_drug_group')
                ->rightJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id')
                ->union($drugGroup)
                ->where('drugs.id','!=','drugs.id_drug_group')
                ->where('drug_groups.deleted_at',null)
                ->where('drugs.deleted_at',null)
                ->paginate(5);

        }
        return view('clients.drugs.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    // thêm thông tin
    public function add() {
        $title = 'Thêm thông tin thuốc';
        $drugGroupName = DrugGroup::where('deleted_at',null)->get();
        return view('clients.drugs.add',compact('title','drugGroupName'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'drug_name' => 'required|unique:drugs',
            'price' => 'required'

        ],[
            'drug_name.required' => "Tên thuốc bắt buộc phải nhập",
            'drug_name.unique' => "Tên thuốc đã tồn tại",
            'price.required' => "giá bán bắt buộc phải nhập",

        ]);
        $dataInsert = [
            'drug_name'=>$request->drug_name,
            'id_drug_group'=>$request->id_drug_group,
            'ingredient'=>$request->ingredient,
            'uses'=>$request->uses,
            'producer'=>$request->producer,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'unit'=>$request->unit,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        Drug::insert($dataInsert);
        return redirect()->route('drugs.index')->with('msg','Thêm thông tin thuốc thành công');
    }



    //sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin thuốc";
        $drugGroup = Drug::select('drugs.*','drug_groups.name_drug_group')
        ->leftJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id');
        $drugGroupName = DrugGroup::where('deleted_at',null)->get();
        if(!empty($id)){
            $detail = Drug::select('drugs.*','drug_groups.name_drug_group')
            ->rightJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id')
            ->union($drugGroup)
            ->where('drugs.id','!=','drugs.id_drug_group')
            ->where('drugs.id',$id)
            ->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
            // dd($detail);
        } else {
            return redirect()->route('drugs.index')->with('msg','Thông tin thuốc không tồn tại');
        }
        return view('clients.drugs.edit',compact('title','detail','drugGroupName'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'drug_name' => 'required',
            'price' => 'required'

        ],[
            'drug_name.required' => "Tên thuốc bắt buộc phải nhập",
            'price.required' => "giá bán bắt buộc phải nhập",

        ]);
        $dataUpdate = [
            'drug_name'=>$request->drug_name,
            'id_drug_group'=>$request->id_drug_group,
            'ingredient'=>$request->ingredient,
            'uses'=>$request->uses,
            'producer'=>$request->producer,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'unit'=>$request->unit,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        Drug::where('id',$id)->update($dataUpdate);

        return redirect()->route('drugs.index')->with('msg','Cập nhật thông tin thuốc thành công');

    }
    //xóa mềm
    public function delete($id=0) {
        if(!empty($id)){
            $detail = Drug::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = Drug::where('id',$id)->delete();
                if($deleteStatus){
                    $msg = 'Xóa thông tin thuốc thành công';
                } else {
                    $msg = 'Bạn không thể xóa thuốc lúc này. Vui lòng thử lại';
                }
            } else {
                $msg =  'Thông tin thuốc không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('drugs.index')->with('msg',$msg);
    }

    //danh sách đã xóa
    public function trash(Request $request){
        $title = 'Thông tin thuốc đã xóa';
        $drugGroup = Drug::onlyTrashed()
        ->select('drugs.*','drug_groups.name_drug_group')
        ->leftJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id');
        if(!empty($search = $request->search)){
            $listdelete = Drug::onlyTrashed()
                ->select('drugs.*','drug_groups.name_drug_group')
                ->rightJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id')
                ->union($drugGroup)
                ->where('drugs.id','!=','drugs.id_drug_group')
                ->where('drugs.drug_name','like','%'.$search.'%')
                ->paginate(5);
        } else{
            $listdelete = Drug::onlyTrashed()
                ->select('drugs.*','drug_groups.name_drug_group')
                ->rightJoin('drug_groups', 'drugs.id_drug_group','=','drug_groups.id')
                ->union($drugGroup)
                ->where('drugs.id','!=','drugs.id_drug_group')
                ->paginate(5);
                // dd($listdelete);
        }
        return view('clients.drugs.listdelete',compact('title','listdelete'))->with('i',(request()->input('page',1)-1)*1);
    }

    //phục hồi
    public function untrash($id=0) {
        $deleteStatus = Drug::withTrashed()
        ->where('id',$id);
        $deleteStatus->restore();
        if($deleteStatus){
            $msg = 'Phục hồi thông tin thuốc thành công';
        } else {
            $msg = 'Bạn không thể phục hồi thông tin thuốc lúc này. Vui lòng thử lại';
        }

        return redirect()->route('drugs.trash')->with('msg',$msg);
    }
    //xóa hẳn
    public function forceDelete($id=0) {
        $deleteStatus = Drug::withTrashed()
        ->where('id',$id);
        $deleteStatus->forceDelete();
        if($deleteStatus){
            $msg = 'Xóa thông tin thuốc thành công';
        } else {
            $msg = 'Bạn không thể xóa thông tin thuốc lúc này. Vui lòng thử lại';
        }

        return redirect()->route('drugs.trash')->with('msg',$msg);
    }
}
