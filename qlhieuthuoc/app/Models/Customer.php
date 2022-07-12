<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    // ko tự tăng ko phải kiểu int
    public $incrementing = false;

    public function getAll() {
        return Customer::orderBy('created_at','DESC')
        ->where('deleted_at',null)
        ->paginate(5);
    }
    public function getSearch($search) {
        return Customer::orderBy('created_at','DESC')
        ->where('customer_name','like','%'.$search.'%')
        ->where('deleted_at',null)
        ->paginate(5);
    }
    public function postAdd($data){
        return Customer::insert($data);
    }
    public function getDetail($id) {
        return Customer::where('id',$id)
        ->get();
    }
    public function postUpdate($data,$id){
        return Customer::where('id',$id)
        ->update($data);
    }
    public function postDelete($id) {
        return Customer::where('id',$id)
        ->delete();
    }
    public function trashDelete() {
        return Customer::onlyTrashed()
        ->orderBy('created_at','DESC')
        ->paginate(5);
    }
    public function trashSearch($search) {
        return Customer::onlyTrashed()
        ->orderBy('created_at','DESC')
        ->where('customer_name','like','%'.$search.'%')
        ->paginate(5);
    }
}