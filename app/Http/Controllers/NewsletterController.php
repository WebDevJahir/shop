<?php

namespace App\Http\Controllers;
use App\Newsletter;
use App\Exports\subscriberExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class NewsletterController extends Controller
{
    public function checkSubscriberEmail(Request $request){
        $data = $request->all();
        $checkSubscriberEmail = Newsletter::where('email',$data['email'])->count();
        if($checkSubscriberEmail>0){
            echo "Exits";
        }else{
            $addSubscriber = new Newsletter;
            $addSubscriber->email = $data['email'];
            $addSubscriber->save();
            echo "Success";
        }
    }

    public function viewSubscribedEmail(){
    	$newsletters = Newsletter::get();
    	return view('admin.newsletters.view-newsletters-email')->with(compact('newsletters'));
    }

    public function deleteSubscribedEmail($id){
    	Newsletter::findorfail($id)->delete();
    	return redirect()->back()->with('flash_message_success','Newsletter Email Deleted Successfully');
    }

    public function updateSubscribedEmail($id,$status){
    	Newsletter::where('id',$id)->update(['status'=>$status]);
    	return redirect()->back()->with('flash_message_success','Status updated successfully');
    }

    // public function exportNewsletters(){
    // 	$subscribedEmail = Newsletter::select('id','email','created_at')->where('status',1)->orderBy('id','Desc')->get();
    // 	$subscribedEmail = json_decode(json_encode($subscribedEmail),true);
    // 	return Excel::create('subscribers'.rand(),function($excel) use($subscribedEmail){$excel->sheet('mySheet',function($sheet) use($subscribedEmail){$sheet->fromArray($subscribedEmail);
    // 	});
    // })->download('xlsx');
    // }

    public function exportNewsletters(){
    	return Excel::download(new subscriberExport,'subcribers.xlsx');
    }
}
