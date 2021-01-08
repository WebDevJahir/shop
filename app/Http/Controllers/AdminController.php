<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function addAdmin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $exitsAdmin = Admin::where('username',$data['username'])->count();
            if($exitsAdmin>0){
                return redirect('admin/view-admins')->with('flash_message_error','Username Already 
                    Exits');
            }else{
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            if($data['type']=='Admin'){
                $addAdmin = new Admin;
                $addAdmin['username'] = $data['username'];
                $addAdmin['password'] = md5($data['password']);
                $addAdmin['status'] = $status;
                $addAdmin->save();
                return redirect('admin/view-admins')->with('flash_message_success','Admin Added Successfully');
                }else{
                    if(empty($data['status'])){
                        $status = 0;
                    }else{
                        $status = 1;
                    }
                    if(empty($data['categories_view_access'])){
                        $categories_view_access = 0;
                    }else{
                        $categories_view_access = 1;
                    }
                    if(empty($data['categories_edit_access'])){
                        $categories_edit_access = 0;
                    }else{
                        $categories_edit_access = 1;
                    }
                    if(empty($data['categories_full_access'])){
                        $categories_full_access = 0;
                    }else{
                        $categories_full_access = 1;
                    }
                    if(empty($data['products_access'])){
                        $products_access = 0;
                    }else{
                        $products_access = 1;
                    }
                    if(empty($data['orders_access'])){
                        $orders_access = 0;
                    }else{
                        $orders_access = 1;
                    }
                    if(empty($data['users_access'])){
                        $users_access = 0;
                    }else{
                        $users_access = 1;
                    }
                    $addAdmin = new Admin;
                    $addAdmin['username'] = $data['username'];
                    $addAdmin['password'] = md5($data['password']);
                    $addAdmin['status'] = $data['status'];
                    $addAdmin['type'] = $data['type'];
                    $addAdmin['categories_view_access'] = $categories_view_access;
                    $addAdmin['categories_edit_access'] = $categories_edit_access;
                    $addAdmin['categories_full_access'] = $categories_full_access;
                    $addAdmin['products_access'] = $products_access;
                    $addAdmin['orders_access'] = $orders_access;
                    $addAdmin['users_access'] = $users_access;
                    $addAdmin->save();
                    return redirect('admin/view-admins')->with('flash_message_success','Sub Admin Added Successfully');
                }
            }
        }
        return view('admin.admins.add_admin');
    }

    public function viewAdmins(){
        $allAdmin = Admin::get();
        return view('admin.admins.view-admins')->with(compact('allAdmin'));
    }

    public function editAdmin(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
        if(empty($data['status'])){
            $status = 0;
        }else{
            $status = 1;
        }
        if(empty($data['categories_view_access'])){
            $categories_view_access = 0;
        }else{
            $categories_view_access = 1;
        }
        if(empty($data['categories_edit_access'])){
            $categories_edit_access = 0;
        }else{
            $categories_edit_access = 1;
        }
        if(empty($data['categories_full_access'])){
            $categories_full_access = 0;
        }else{
            $categories_full_access = 1;
        }
        if(empty($data['products_access'])){
            $products_access = 0;
        }else{
            $products_access = 1;
        }
        if(empty($data['orders_access'])){
            $orders_access = 0;
        }else{
            $orders_access = 1;
        }
        if(empty($data['users_access'])){
            $users_access = 0;
        }else{
            $users_access = 1;
        }

            if($data['type']=='Admin'){
                Admin::where('id',$id)->update(['username'=>$data['username'],'password'=>md5($data['password']),'type'=>$data['type'],'status'=>$status]);
                return redirect('admin/view-admins')->with('flash_message_success','Admin Updated Successfully');
            }else{
            Admin::where('id',$id)->update(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>$status,'type'=>$data['type'],'categories_view_access'=>$categories_view_access,'categories_edit_access'=>$categories_edit_access,'categories_full_access'=>$categories_full_access,'products_access'=>$products_access,'orders_access'=>$orders_access,'users_access'=>$users_access]);
            return redirect('admin/view-admins')->with('flash_message_success','Sub Admin Updated Successfully');
                }
            }
        $admin = Admin::where('id',$id)->first();
        return view('admin.admins.edit_admin')->with(compact('admin'));
    }

    public function deleteAdmin($id){
        Admin::findorfail($id)->delete();
        return redirect('admin/view-admins')->with('flash_message_success','Admin Deleted Successfully');
    }

    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->input();
           $adminCount = Admin::where(['username' => $data['username'],'password' => md5($data['password']), 'status'=>1])->count(); 
    		if($adminCount > 0){
    			$admin = Session::put('adminSession',$data['username']);
    			return redirect('admin/dashboard');
    		}else{
    			return redirect('admin')->with('flash_message','Invalid Username or Password');
    		}
    	}
    	return view('admin.login');
    }

    public function dashboard(){
    	// if(Session::has('adminSession')){

    	// }else{
    	// 	return redirect('admin')->with('flash_message','Please Login to access');
    	// }

    	return view('admin.dashboard');
    }

    public function settings(){
        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();
    	return view('admin.settings')->with(compact('adminDetails'));
    }

    public function checkpassword(Request $request){
    	$data = $request->all();
    	$adminCount = Admin::where(['username' => Session::get('adminSession'),'password' => md5($data['current_password'])])->count();
    	if($adminCount == 1){
    		echo "true"; die;
    	}else{
    		echo "false"; die;
    	}
    }

    public function updatepassword(Request $request){
        if($request->isMethod('post')){
        $data = $request->all();
        $current_password = $data['current_password'];
        $adminCount = Admin::where(['username' => Session::get('adminSession'),'password' => md5($data['current_password'])])->count();
        if($adminCount == 1){
            $password = md5($data['new_password']);
            Admin::where('username', Session::get('adminSession'))->update(['password'=>$password]);
            return redirect('/admin/settings')->with('flash_message_success','Password updated Successfully');
        }else{
            return redirect('/admin/settings')->with('flash_message_error','Password update Failed');
        }
    }

    }

    Public function logout(){
    	session::flush();
    	return redirect('admin')->with('flash_message','Logout Successfully');;
    }
}
