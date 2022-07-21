<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\ExportDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportDetailController extends Controller
{
    public function index(Request $request) {
        $title = 'Thông tin thuốc cần xuất';
        $list = ExportDetail::select('export_details.*','drugs.drug_name','drugs.unit','drugs.price')
            ->rightJoin('drugs', 'export_details.drug_id','=','drugs.id')
            ->orderBy('created_at','DESC')
            ->where('export_details.id','!=','export_details.drug_id')
            ->where('export_details.deleted_at',null)
            ->where('drugs.deleted_at',null)
            ->paginate(5);
        // $quantityDrug = Drug::where('deleted_at', null)
        // ->get();
        // // dd($quantityDrug);

        // if(!empty($list) && !empty($quantityDrug)) {
        //     foreach ($list as $key => $item) {
        //         foreach($quantityDrug as $keys => $items){
        //             if($item->drug_id == $items->id && $item->status==1){
        //                 $dataUpdate=[
        //                     'total_price'=>$items->price*$item->quantity_export,
        //                     'updated_at'=>date('Y-m-d H:i:s')
        //                 ];
        //                 ExportDetail::where('id',$item->drug_id)->update($dataUpdate);
        //             }
        //         }
        //     }
        // }

        // $listExport = ExportDetail::select('export_details.*','drugs.drug_name','drugs.unit','drugs.price')
        //     ->rightJoin('drugs', 'export_details.drug_id','=','drugs.id')
        //     ->orderBy('created_at','DESC')
        //     ->where('export_details.id','!=','export_details.drug_id')
        //     ->where('export_details.deleted_at',null)
        //     ->where('drugs.deleted_at',null)
        //     ->paginate(5);
        // dd($listExport);
        return view('clients.export_details.list',compact('title','list'))->with('i',(request()->input('page',1)-1)*1);
    }
    // thêm thông tin
    public function add() {
        $title = 'Thêm thông tin thuốc cần xuất';
        $drug = Drug::where('deleted_at',null)->get();
        return view('clients.export_details.add',compact('title','drug'));
    }
    public function postAdd(Request $request) {
        $request->validate([
            'quantity_export' => 'required',

        ],[
            'quantity_export.required' => "Số lượng thuốc bắt buộc phải nhập",

        ]);


        $dataInsert = [
            'drug_id'=>$request->drug_id,
            'quantity_export'=>$request->quantity_export,
            'total_price'=>0,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        ExportDetail::insert($dataInsert);

        $list = ExportDetail::select('export_details.*','drugs.drug_name','drugs.unit','drugs.price')
            ->rightJoin('drugs', 'export_details.drug_id','=','drugs.id')
            ->orderBy('created_at','DESC')
            ->where('export_details.id','!=','export_details.drug_id')
            ->where('export_details.deleted_at',null)
            ->where('drugs.deleted_at',null)
            ->get();
        $quantityDrug = Drug::where('deleted_at', null)
        ->get();
        foreach ($list as $key => $item) {
            foreach($quantityDrug as $keys => $items){
                dd($item,$items);
                if($item->id == $items->drug_id && $item->status==1){
                    $dataUpdate=[
                        'total_price'=>$items->price*$item->quantity_export,
                        'updated_at'=>date('Y-m-d H:i:s')
                    ];
                    ExportDetail::where('id',$item->drug_id)->update($dataUpdate);
                }
            }
        }

        return redirect()->route('export_details.index')->with('msg','Thêm thông tin thuốc thành công');
    }


    public function updateQuantity() {
        $quantityExport = ExportDetail::where('deleted_at',null)
        ->where('status',1)
        ->get();
        // dd($quantityExport);
        $quantityDrug = Drug::where('deleted_at', null)
        ->get();
        // dd($quantityDrug);

        if(!empty($quantityExport) && !empty($quantityDrug)) {
            foreach ($quantityExport as $key => $item) {
                foreach($quantityDrug as $keys => $items){
                    if($item->drug_id == $items->id && $item->status==1){
                        $dataUpdate=[
                            'quantity'=>$items->quantity = $items->quantity - $item->quantity_export,
                            'updated_at'=>date('Y-m-d H:i:s')
                        ];
                        DB::beginTransaction();
                        try {
                        Drug::where('id',$item->drug_id)->update($dataUpdate);
                        ExportDetail::where('id',$item->id)->update(['status'=>0]);
                        DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            throw new Exception($e->getMessage());
                        }
                    }
                }
            }
            return redirect()->route('export_details.index')->with('msg','Đã cập nhật thuốc vào kho');
        } else {
            return redirect()->route('export_details.index')->with('msg','Không có thuốc cần cập nhật');
        }
    }


    //xóa
    public function delete($id=0) {
        if(!empty($id)){
            $detail = ExportDetail::where('id',$id)->get();
            if(!empty($detail[0])){
                $deleteStatus = ExportDetail::where('id',$id)->delete();
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
        return redirect()->route('export_details.index')->with('msg',$msg);
    }
}
