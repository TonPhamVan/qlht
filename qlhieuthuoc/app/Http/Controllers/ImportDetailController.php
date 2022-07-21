<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\ImportDetail;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportDetailController extends Controller
{
    public function index(Request $request) {
        $title = 'Thông tin thuốc cần nhập';
        $list = ImportDetail::select('import_details.*','suppliers.supplier_name','drugs.drug_name','drugs.unit')
            ->rightJoin('suppliers', 'import_details.supplier_id','=','suppliers.id')
            ->rightJoin('drugs', 'import_details.drug_id','=','drugs.id')
            ->where('import_details.id','!=','import_details.suppliers_id')
            ->orderBy('created_at','DESC')
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
            'total_price'=>$request->quantity_import*$request->price_import,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        ImportDetail::insert($dataInsert);
        return redirect()->route('import_details.index')->with('msg','Thêm thông tin thuốc thành công');
    }


    public function updateQuantity() {
        $quantityImport = ImportDetail::where('deleted_at',null)
        ->where('status',1)
        ->get();
        // dd($quantityImport);
        $quantityDrug = Drug::where('deleted_at', null)
        ->get();
        // dd($quantityDrug);

        if(!empty($quantityImport) && !empty($quantityDrug)) {
            foreach ($quantityImport as $key => $item) {
                foreach($quantityDrug as $keys => $items){
                    if($item->drug_id == $items->id && $item->status==1){
                        $dataUpdate=[
                            'quantity'=>$items->quantity += $item->quantity_import,
                            'price'=>$items->price = $item->price_import+$item->price_import*10/100,
                            'updated_at'=>date('Y-m-d H:i:s')
                        ];
                        DB::beginTransaction();
                        try {
                        Drug::where('id',$item->drug_id)->update($dataUpdate);
                        ImportDetail::where('id',$item->id)->update(['status'=>0]);
                        DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            throw new Exception($e->getMessage());
                        }
                    }
                }
            }
            return redirect()->route('import_details.index')->with('msg','Đã cập nhật thuốc vào kho');
        } else {
            return redirect()->route('import_details.index')->with('msg','Không có thuốc cần cập nhật');
        }
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