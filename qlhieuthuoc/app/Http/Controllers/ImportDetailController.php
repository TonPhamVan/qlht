<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\ImportDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ImportDetailController extends Controller
{
    public function index(Request $request) {
        $title = 'Thông tin thuốc cần nhập';
        $list = ImportDetail::select('import_details.*','suppliers.supplier_name','drugs.drug_name')
            ->rightJoin('suppliers', 'import_details.supplier_id','=','suppliers.id')
            ->rightJoin('drugs', 'import_details.drug_id','=','drugs.id')
            ->where('import_details.id','!=','import_details.suppliers_id')
            ->where('import_details.deleted_at',null)
            ->where('suppliers.deleted_at',null)
            ->where('drugs.deleted_at',null)
            ->paginate(5);

        return view('clients.import_details.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);
    }
    // thêm thông tin
    public function add() {
        $title = 'Thêm thông tin thuốc cần nhập';
        $supplier = Supplier::where('deleted_at',null)->get();
        $drug = Drug::where('deleted_at',null)->get();
        return view('clients.import_details.add',compact('title','supplier','drug'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'quantity_import' => 'required',
            'price_import' => 'required',

        ],[
            'quantity_import.required' => "Tên thuốc bắt buộc phải nhập",
            'price_import.required' => "giá nhập bắt buộc phải nhập",

        ]);
        $dataInsert = [
            'drug_id'=>$request->drug_id,
            'supplier_id'=>$request->supplier_id,
            'quantity_import'=>$request->quantity_import,
            'price_import'=>$request->price_import,
            'unit'=>$request->unit,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        ImportDetail::insert($dataInsert);
        return redirect()->route('import_details.index')->with('msg','Thêm thông tin thuốc thành công');
    }


    public function updateQuantity() {
        $quantity = ImportDetail::where('deleted_at',null)
        ->where('status',1)
        ->get();
        dd($quantity);
    }

    // sửa thông tin
    public function getEdit(Request $request, $id=0) {
        $title = "Sửa thông tin thuốc";
        $supplier = Supplier::where('deleted_at',null)->get();
        $drug = Drug::where('deleted_at',null)->get();
        if(!empty($id)){
            $detail = ImportDetail::select('import_details.*','suppliers.supplier_name','drugs.drug_name')
            ->rightJoin('suppliers', 'import_details.supplier_id','=','suppliers.id')
            ->rightJoin('drugs', 'import_details.drug_id','=','drugs.id')
            ->where('import_details.id','!=','import_details.suppliers_id')
            ->where('import_details.id',$id)
            ->get();
            if(!empty($detail[0])){
                $request->session()->put('id',$id);
                $detail = $detail[0];
            }
            // dd($detail);
        } else {
            return redirect()->route('import_details.index')->with('msg','Thông tin thuốc không tồn tại');
        }
        return view('clients.import_details.edit',compact('title','detail','supplier','drug'));

    }
    public function postEdit(Request $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $request->validate([
            'quantity_import' => 'required',
            'price_import' => 'required',

        ],[
            'quantity_import.required' => "Tên thuốc bắt buộc phải nhập",
            'price_import.required' => "giá nhập bắt buộc phải nhập",

        ]);
        $dataUpdate = [
            'drug_id'=>$request->drug_id,
            'supplier_id'=>$request->supplier_id,
            'quantity_import'=>$request->quantity_import,
            'price_import'=>$request->price_import,
            'unit'=>$request->unit,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        ImportDetail::where('id',$id)->update($dataUpdate);

        return redirect()->route('import_details.index')->with('msg','Cập nhật thông tin thuốc thành công');

    }
    //xóa
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
}