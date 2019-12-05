<?php

namespace App\Http\Controllers;

use App\Blog;
use Auth;
use App\Admin;
use App\Investor;
use App\Investment;
use App\Transaction;
use App\PropertyUpload;
use App\TicketMessage;
use App\IpLog;
use Mail; //this adds the mail class
use URL;

use Carbon\Carbon;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class AdministratorController extends Controller
{




	public function AddNewAdministrator(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|max:255|unique:admins',
			'password' => 'required|between:6,30',
		]);

		

		$admin = new Admin;
		$admin->name = $request->name;
		$admin->email = $request->email;
		$admin->password = bcrypt($request->password);
		$admin->role = $request->role;
	
		$admin->save();

		$notification = array('message' => 'New Administrator has been added successfully','alert' => 'success' );
				return redirect()->back()->with($notification);


		// return $request->all();
	}

	public function Up()
	{
		\Artisan::call('up');

		$notification = array('message' => 'Site is up','alert' => 'success' );
			return redirect()->back()->with($notification);
	}
	public function Down()
	{
		\Artisan::call('down');

		$notification = array('message' => 'Site is down','alert' => 'danger' );
			return redirect()->back()->with($notification);
	}

	public function dashboard()
	{

		$today =  Carbon::today();

		
		$investors = Investor::all();
		$investments = Investment::where('active','=',1)->get();
		$transactions = Transaction::all();
		$property = PropertyUpload::where('active','=', 1)->get();
		$tickets = TicketMessage::all();
		$ipLogs = IpLog::all();
		
		// return $ipLogs;


		$users[] = Auth::user();
		$users[] = Auth::guard()->user();
		$users[] = Auth::guard('admin')->user();
	
		return view('admin.home',compact(
							'investors',
							'transactions',
							'property',
							'tickets',
							'ipLogs',
							'investments'
		));
		# code...
	}

	public function getByIdInvestor($id){
		$investor =  Investor::where('id','=',$id)->first();

		return response()->json($investor);
	}
	
	public function CheckForMaintance()
	{
		// $check = file_exists('./storage/framework/down');
		$check = Storage::exists('/framework/down');
		return response()->json($check);
	}

    public function createBlog(Request $request)
    {
		 if ($request->image) {    
		       $image = $request->file('image');
			   $filename = time(). '.' . $image->getClientOriginalExtension();
			   $blog = new Blog;
			   $blog->application_id = 1;
			   $blog->title = $request->title;
			   $blog->image = $filename;
			   $blog->content = Purifier::clean($request->content);
			   $blog->save();
			   if($blog){
				    $image->move('storage/blog', $filename);
			   }
				$notification = array('message' => $request->title.' has been added','alert' => 'success' );
				return redirect()->back()->with($notification);

		    //    return redirect()->back();
		      
	  
	     }else{
			$notification = array('message' => 'Please add an image to contiune','alert' => 'warning' );
			return redirect()->back()->with($notification);
	     }

            
       // return Purifier::clean($request->all());
	
	}

	public function updateBlog(Request $request)
	{
	
		$id = $request->id;

		if ($request->image) {    

			$image = $request->file('image');
			$filename = time(). '.' . $image->getClientOriginalExtension();
			

			$data = array(
				'title' => $request->title,
				'content' => Purifier::clean($request->content),
				'image' => $filename,
			);

			$posting = Blog::where('id','=',$id)->update($data);

			if($posting){
				$image->move('storage/blog', $filename);
		   }

			$notification = array('message' => $request->title.' has been updated ','alert' => 'success' );
			return redirect()->back()->with($notification);
			
   
	  }else{
		 
		$data = array(
			'title' => $request->title,
			'content' => Purifier::clean($request->content),
		);

		$posting = Blog::where('id','=',$id)->update($data);

		if($posting){
			$notification = array('message' => $request->title.' has been updated ','alert' => 'success' );
			return redirect()->back()->with($notification);
	   }

		
		
	  }

	
	}
	
	public function PostBlog()
	{
		$posts = Blog::where('active', '=',1)->get();
		$drafts = Blog::where('active', '=',0)->get();

		return view('admin.blog.manage',compact('posts','drafts'));
	}

	public function editPost($id = null)
	{
		$post = Blog::where('id','=',$id)->first();
	
		return view('admin.blog.edit',compact('post'));
		
		
		
	}

	public function draftPost($id = null)
	{

		$post = Blog::where('id','=',$id)->first();
		$blog = Blog::where('id','=',$id)->update(['active' => 0]);
		if($blog){
			$notification = array('message' => $post->title.' has been drafted ...','alert' => 'success' );
			return redirect()->back()->with($notification);
		}else{
			$notification = array('message' =>  'Server Error','alert' => 'danger' );
			return redirect()->back()->with($notification);
		}
	}

	public function deletePost($id = null)
	{
		$blog = Blog::where('id','=',$id)->delete();
		if($blog){
			$notification = array('message' => 'Deleted Successfully ...','alert' => 'success' );
			return redirect()->back()->with($notification);
		}else{
			$notification = array('message' =>  'Server Error','alert' => 'danger' );
			return redirect()->back()->with($notification);
		}
		
	}


	public function Settings()
	{
		$user = Auth::User();
		$admins = Admin::where('active', '=', 1)->get();
		return view('admin.profile.index',compact('user','admins'));

	}
	public function SettingsUpdatePassword(Request $request)
	{

		$id = Auth::user()->id;
		$cpassword = $request->old;
		$newpassword = $request->new;
		$cnewpassword = $request->con;
		$action = $request->action;
 
		
			if (Hash::check($cpassword, Auth::user()->password, [])) {
				if($newpassword == $cnewpassword){
					$data = array(
						'password' => bcrypt($request->input('newpass')),
					);

					Admin::where('id', $id)->update($data);

					$notification = array(

						'message' => 'Successful... You Have Channged your Password !',
						'alert' => 'success' 
					);
					return redirect()->back()->with($notification);
				}else{

					$notification = array(

						'message' => 'New Password & Confirm Password No Match ',
						'alert' => 'info' 
					);
					return redirect()->back()->with($notification);
				}
			}else{

				$notification = array(

					'message' => 'Old Password is invaild ',
					'alert' => 'error' 
				);
				return redirect()->back()->with($notification);
			}
		

	}

	
	


	
}