<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    public function getAllCustomer() {
        // return Customer::paginate(5);
        return DB::table($this->table)
        ->select('*')
        ->get();
    }
    public function searchCustomer($searchCustomer) {
        return DB::table($this->table)
        ->select('*')
        ->where('customer_name','like','%'.$searchCustomer.'%')
        ->get();
    }
    public function addCustomer($data){
        return DB::table($this->table)
        ->insert([
            'id'=> $data[0],
            'customer_name'=>$data[1],
            'gender'=>$data[2],
            'address'=>$data[3],
            'phone'=>$data[4],
            'create_at'=>$data[5],
        ]);
    }
    public function getDetail($id) {
        return DB::table($this->table)
        ->where('id',$id)
        ->get();
    }
    public function updateCustomer($data,$id){
        $data[] = $id;
        return DB::table($this->table)
        ->where('id',$id)
        ->update([
            'name'=> $data[0],
            'Price'=>$data[1],
            'update_at'=>$data[2]

        ]);
    }
    public function deleteCustomer($id) {
        return DB::table($this->table)
        ->where('id',$id)
        ->delete();
    }
}