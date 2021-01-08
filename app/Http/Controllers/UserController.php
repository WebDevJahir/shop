<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use App\Contact;
use App\Newsletter;
use App\Exports\userExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DB;
class UserController extends Controller
{
    public function register(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$usersCount = User::where('email',$data['email'])->count();
    		if($usersCount > 0){
    			return redirect()->back()->with('flash_message_error','Email already exists!');
    		}else{
    			$user = new User;
    			$user->name = $data['name'];
    			$user->email = $data['email'];
    			$user->password = bcrypt($data['password']);
                date_default_timezone_get('Asia/Dhaka');
                $user->created_at = date("Y-m-d H:i:s");
                $user->updated_at = date("Y-m-d H:i:s");
                $user->address = '';
                $user->city = '';
                $user->state = '';
                $user->country = '';
                $user->pincode = '';
                $user->mobile = '';
    			$user->save();

                //Send Register Email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                Mail::send('email.comfirmation',$messageData,function($messageData) use($email){
                    $messageData->to($email)->subject('Confirm your Online Shopping Account');
                });

                return redirect()->back()->with('flash_message_success','Please confirm your email to activate your account');


    			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
    				Session::put('frontSession',$data['email']);
    				return redirect('/cart');
    			}
    		}
    	}
    	return view('users.login');
    }

    public function userLoginRegister(){
        $meta_title = "User Login";
        $meta_description = "User Login and Register";
        $meta_keywords = "Login, Register";
    	return view('users.login')->with(compact('meta_title','meta_description','meta_keywords'));
    }

    public function checkEmail(Request $request){
    	$data = $request->all();
    	$usersCount = User::where('email',$data['email'])->count();
    	if($usersCount>0){
    		echo 'false';
    	}else{
    		echo 'true'; die;
    	}
    }

    public function login(Request $request){
    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    return redirect()->back()->with('flash_message_error','Your account is not activated! Please activate your account from email');
                }
    			Session::put('frontSession',$data['email']);
    			return redirect('/cart');
    		}else{
    			return redirect()->back()->with('flash_message_error','Invalid Username or Password');
    		}
    	}
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::where('email',$data['email'])->count();
            if($user == 0){
                return redirect()->back()->with('flash_message_error','Email Does Not Exits');
            }

            // Get User Details
            $userDetails = User::where('email',$data['email'])->first();

            //Generate Random Password
            $random_password = str_random(8);

            //Encode/Secure Password
            $new_password = bcrypt($random_password);

            User::where('email',$data['email'])->update(['password'=>$new_password]);
            $name = $userDetails->name;

            //Send forgot Password Email Code
            $email = $data['email'];
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
            ];
            Mail::send('email.forgotpassword',$messageData,function($message)use($email){
                $message->to($email)->subject('New Password - Online Shopping');
            });

            return redirect('login-register')->with('flash_message_success','Please Check your email for new password');
        }
        $meta_title = "forget Password";
        $meta_description = "Forget Password";
        $meta_keywords = "Forget Password";
        return view('users.forgot-password')->with(compact('meta_description','meta_title','meta_keywords'));
    }

    public function confirmAccount($code){
        $email = base64_decode($code);
        $usersCount = User::where('email',$email)->count();
        if($usersCount > 0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('/login-register')->with('flash_message_success','Your Email account is already activated. You can login now');
            }else{
                User::where('email',$email)->update(['status'=>1]);

                $messageData = ['email'=>$email,'name'=>$userDetails->name];
                Mail::send('email.welcome',$messageData,function($messageData)use($email){
                    $messageData->to($email)->subject('Welcome to Online Shopping Account');
                });
                 return redirect('login-register')->with('flash_message_success','Your Email account is activated. You can login now');
            }
        }else{
            abort(404);
        }
    }

    public function logout(){
    	Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
    	return redirect('/');
    }

    public function account(Request $request){
    	$user_id = Auth::user()->id;
    	$userDetails = User::find($user_id);
    	$countries = Country::get();
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$user = User::find($user_id);
    		$user->name = $data['name'];
    		$user->address = $data['address'];
    		$user->city = $data['city'];
    		$user->state = $data['state'];
    		$user->country = $data['country'];
    		$user->pincode = $data['pincode'];
    		$user->mobile = $data['mobile'];
    		$user->save();
    		return redirect()->back()->with('flash_message_success','Your Account Details updated successfully');
    	}
    	return view('users.account',compact('countries','userDetails'));
    }

    public function checkUserPassword(Request $request){
    	$data = $request->all();
    	$current_password = $data['current_password'];
    	$user_id = Auth::User()->id;
    	$check_password = User::where(['id'=>$user_id])->first();
    	if(hash::check($current_password,$check_password->password)){
    		echo "true"; die;
    	}else{
    		echo "false"; die;
    	}
    }

    public function updateUserPassword(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();

    		$old_password = User::where('id',Auth::User()->id)->first();
    		$current_password = $data['current_password'];
    		if(hash::check($current_password,$old_password->password)){
    			$new_password = bcrypt($data['new_password']);
    			User::where('id',Auth::User()->id)->update(['password'=>$new_password]);
    			return redirect()->back()->with('flash_message_success','Password Updated Successfully');
    		}else{
    			return redirect()->back()->with('flash_message_error','Password Updated Failed');
    		}
    	}
    }

    public function viewUsers(){
        if(Session::get('adminDetails')['users_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
        $users = User::get();
        return view('admin.users.view-users')->with(compact('users'));
    }


    public function viewUsersCharts(){
        $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        
        $last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        $last_to_month_users = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now(2)->subMonth())->count();
        return view('admin.users.view-users-charts')->with(compact('current_month_users','last_month_users','last_to_month_users'));
    }

    public function viewUsersCountriesCharts(){
        $getUserCountries = User::select('country',DB::raw('count(country) as count'))->groupBy('country')->get();
        //echo "<pre>"; print_r($getUserCountries); die;
        return view('admin.users.view-users-countries-charts')->with(compact('getUserCountries'));
    }

    public function allEnquiries(){
        $allEnquiries = Contact::get();
        return view('admin.enquiry.view_enquiries')->with(compact('allEnquiries'));
        }

    public function replyEnquiries(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            $email = $data['email'];
            $messageData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'comment' => $data['message']
            ];
            Mail::send('email.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject('Enquiry Reply From E-com Website');
            });
            return redirect('admin/view-enquiries')->with('flash_message_success','Message Sent Successfully');
        }
        $enquiry = Contact::where('id',$id)->first();
        return view('admin.enquiry.reply_enquiry')->with(compact('enquiry'));
    }

    public function deleteEnquiry($id){
        Contact::findorfail($id)->delete();
    }

    public function checkSubscriberEmail(Request $request){
        $data = $request->all();
        $checkSubscriberEmail = Newsletter::where('email',$data['email'])->count();
        if($checkSubscriberEmail>0){
            echo "You Have Already Subscibed";
        }else{
            $addSubscriber = new Newsletter;
            $addSubscriber->email = $data['email'];
            $addSubscriber->save();
            echo "Subsciption Completed Successfully";
        }
    }

    public function userExport(){
        return Excel::download(new UserExport,'Users.xlsx');
    }
}
