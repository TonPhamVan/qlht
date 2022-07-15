<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\ImportDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ImportDetailController extends Controller
{
    public function index(Request $request) {
        $title = 'Thông tin thuốc';
        // $ImportDetail = Drug::select('import_details.*','drugs.drug_name')
        // ->leftJoin('import_details', 'import_details.drug_id','=','drugs.id')
        // ->where('drugs.deleted_at',null)
        // ->where('import_details.deleted_at',null);
        // dd($ImportDetail);
        if(!empty($search = $request->search)){
            // $list = ImportDetail::select('import_details.*','suppliers.supplier_name')
            //     ->rightJoin('suppliers', 'import_details.supplier_id','=','suppliers.id')
            //     ->union($ImportDetail)
            //     // ->where('import_details.id','!=','import_details.suppliers_id')
            //     ->where('suppliers.deleted_at',null)
            //     ->where('import_details.deleted_at',null)
            //     ->paginate(5);
            //     // dd($list);
        } else{
            $list = ImportDetail::select('import_details.*','suppliers.supplier_name','drugs.drug_name')
                ->rightJoin('suppliers', 'import_details.supplier_id','=','suppliers.id')
                ->rightJoin('drugs', 'import_details.drug_id','=','drugs.id')
                // ->union($ImportDetail)
                // ->where('import_details.id','!=','import_details.suppliers_id')
                ->where('suppliers.deleted_at',null)
                ->where('import_details.deleted_at',null)
                ->where('drugs.deleted_at',null)
                ->paginate(5);
            dd($list);

        }
        return view('clients.import_details.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);

    }
    // thêm thông tin
    public function add() {
        $title = 'Thêm thông tin thuốc';
        // $ImportDetailGroupName = ImportDetailGroup::where('deleted_at',null)->get();
        return view('clients.import_details.add',compact('title','ImportDetailGroupName'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'ImportDetail_name' => 'required|unique:ImportDetails',
            'price' => 'required'

        ],[
            'ImportDetail_name.required' => "Tên thuốc bắt buộc phải nhập",
            'ImportDetail_name.unique' => "Tên thuốc đã tồn tại",
            'price.required' => "giá bán bắt buộc phải nhập",

        ]);
        $dataInsert = [
            'ImportDetail_name'=>$request->ImportDetail_name,
            'id_ImportDetail_group'=>$request->id_ImportDetail_group,
            'ingredient'=>$request->ingredient,
            'uses'=>$request->uses,
            'producer'=>$request->producer,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'unit'=>$request->unit,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        ImportDetail::insert($dataInsert);
        return redirect()->route('import_details.index')->with('msg','Thêm thông tin thuốc thành công');
    }



    //sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin thuốc";
        $ImportDetailGroup = ImportDetail::select('ImportDetails.*','ImportDetail_groups.name_ImportDetail_group')
        ->leftJoin('ImportDetail_groups', 'ImportDetails.id_ImportDetail_group','=','ImportDetail_groups.id');
        // $ImportDetailGroupName = ImportDetailGroup::where('deleted_at',null)->get();
        if(!empty($id)){
            $detail = ImportDetail::select('ImportDetails.*','ImportDetail_groups.name_ImportDetail_group')
            ->rightJoin('ImportDetail_groups', 'ImportDetails.id_ImportDetail_group','=','ImportDetail_groups.id')
            ->union($ImportDetailGroup)
            ->where('ImportDetails.id','!=','ImportDetails.id_ImportDetail_group')
            ->where('ImportDetails.id',$id)
            ->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
            // dd($detail);
        } else {
            return redirect()->route('import_details.index')->with('msg','Thông tin thuốc không tồn tại');
        }
        return view('clients.import_details.edit',compact('title','detail','ImportDetailGroupName'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'ImportDetail_name' => 'required',
            'price' => 'required'

        ],[
            'ImportDetail_name.required' => "Tên thuốc bắt buộc phải nhập",
            'price.required' => "giá bán bắt buộc phải nhập",

        ]);
        $dataUpdate = [
            'ImportDetail_name'=>$request->ImportDetail_name,
            'id_ImportDetail_group'=>$request->id_ImportDetail_group,
            'ingredient'=>$request->ingredient,
            'uses'=>$request->uses,
            'producer'=>$request->producer,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'unit'=>$request->unit,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        ImportDetail::where('id',$id)->update($dataUpdate);

        return redirect()->route('import_details.index')->with('msg','Cập nhật thông tin thuốc thành công');

    }
    //xóa mềm
    public function delete($id=0) {
        if(!empty($id)){
            $detail = ImportDetail::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = ImportDetail::where('id',$id)->delete();
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
        return redirect()->route('import_details.index')->with('msg',$msg);
    }

    //danh sách đã xóa
    public function trash(Request $request){
        $title = 'Thông tin thuốc đã xóa';
        $ImportDetailGroup = ImportDetail::onlyTrashed()
        ->select('ImportDetails.*','ImportDetail_groups.name_ImportDetail_group')
        ->leftJoin('ImportDetail_groups', 'ImportDetails.id_ImportDetail_group','=','ImportDetail_groups.id');
        if(!empty($search = $request->search)){
            $listdelete = ImportDetail::onlyTrashed()
                ->select('ImportDetails.*','ImportDetail_groups.name_ImportDetail_group')
                ->rightJoin('ImportDetail_groups', 'ImportDetails.id_ImportDetail_group','=','ImportDetail_groups.id')
                ->union($ImportDetailGroup)
                ->where('ImportDetails.id','!=','ImportDetails.id_ImportDetail_group')
                ->where('ImportDetails.ImportDetail_name','like','%'.$search.'%')
                ->paginate(5);
        } else{
            $listdelete = ImportDetail::onlyTrashed()
                ->select('ImportDetails.*','ImportDetail_groups.name_ImportDetail_group')
                ->rightJoin('ImportDetail_groups', 'ImportDetails.id_ImportDetail_group','=','ImportDetail_groups.id')
                ->union($ImportDetailGroup)
                ->where('ImportDetails.id','!=','ImportDetails.id_ImportDetail_group')
                ->paginate(5);
                // dd($listdelete);
        }
        return view('clients.import_details.listdelete',compact('title','listdelete'))->with('i',(request()->input('page',1)-1)*1);
    }

    //phục hồi
    public function untrash($id=0) {
        $deleteStatus = ImportDetail::withTrashed()
        ->where('id',$id);
        $deleteStatus->restore();
        if($deleteStatus){
            $msg = 'Phục hồi thông tin thuốc thành công';
        } else {
            $msg = 'Bạn không thể phục hồi thông tin thuốc lúc này. Vui lòng thử lại';
        }

        return redirect()->route('import_details.trash')->with('msg',$msg);
    }
    //xóa hẳn
    public function forceDelete($id=0) {
        $deleteStatus = ImportDetail::withTrashed()
        ->where('id',$id);
        $deleteStatus->forceDelete();
        if($deleteStatus){
            $msg = 'Xóa thông tin thuốc thành công';
        } else {
            $msg = 'Bạn không thể xóa thông tin thuốc lúc này. Vui lòng thử lại';
        }

        return redirect()->route('import_details.trash')->with('msg',$msg);
    }
}