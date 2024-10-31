<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use app\database\factories\UserFactory\factory;
use App\Models\Email;
use App\Models\Address;
use App\Models\Phone_number;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // function index(Request $request){
    //     return view('welcome');
    // }
    
    //index
    public function index(Request $request){
        return view('add_user');
    }

    //store user info
    public function store(Request $request){
        
        $validated = $request->validate([
            'name'=>'required',
            'user'=>'required',
            'address'=>'required',
            'email' => 
            'required_without:phone|unique:emails,email|nullable|email'
            ,
            'phone' => 'required_without:email|unique:phone_numbers,phone_number|nullable'
            
        ]);
        // return view('welcome');
        //store to email
        $msg = 'success';
        $text = 'User added successfully';
        
        session()->flash($msg, $text);

        $email = new Email;

        if($email){
            $email->email = $request->email;
            $email->save(); 
            session()->flash('success', 'User added successfully ');
        }else{
            session()->flash('warning', 'Something went wrong!');
        }
        
        // dd($request->email);
        $address = new Address;
        if($address){
            $address->address = $request->address;
            $address->save();
            
        }else{
            session()->flash('warning', 'Something went wrong!');
        }
       

        $phone_number = new Phone_number;
        if($phone_number){
            $phone_number->phone_number = $request->phone;
            $phone_number->save();
        }else{
            session()->flash('warning', 'Something went wrong!');
        }
        
        //user
        $user = new User;
        if($user){
            $user->full_name = $request->name;
            $user->user_name = $request->user;
            $user->email_id = $email->id;
            $user->phone_number_id = $phone_number->id;
            $user->address_id=$address->id;
            $user->save();
        }else{
            session()->flash('warning', 'Something went wrong!');
        }

        return redirect()->route('show');

    }

    //show all users
    function show(Request $request){
        $user = DB::table('users')->get();
        $email = DB::table('emails')->get();
        $address = DB::table('addresses')->get();
        $phone = DB::table('phone_numbers')->get();

        $users = DB::table('users')->join('emails', 'users.email_id', '=', 'emails.id')->join('addresses', 'users.address_id', '=', 'addresses.id')->join('phone_numbers', 'users.phone_number_id', 'phone_numbers.id')->get();

        return view('show_users', compact('users'));
    }
    //edit user
    function edit(Request $request,$id){

        $fk_ids = DB::table('users')->select('email_id', 'phone_number_id', 'address_id')->where('id',$id)->get();

        $email_id = $fk_ids['0']->email_id;
        $phone_id = $fk_ids['0']->phone_number_id;
        $address_id = $fk_ids['0']->address_id;

        $email = DB::table('emails')->select('email')->where('id', $email_id)->get();

        $phone = DB::table('phone_numbers')->select('phone_number')->where('id', $phone_id)->get();

        $address = DB::table('addresses')->select('address')->where('id', $address_id)->get();
        
        $user = DB::table('users')->where('id', $id)->get();

        $user['0']->email = $email['0']->email;

        $user['0']->phone_number = $phone['0']->phone_number;

        $user['0']->address = $address['0']->address;
        return view('edit', compact('user'));

    }

    //del user
    function delete($id){
        $fk_ids = DB::table('users')->select('email_id', 'phone_number_id', 'address_id')->where('id',$id)->get();

        $email_id = $fk_ids['0']->email_id;
        $phone_number_id = $fk_ids['0']->phone_number_id;
        $address_id = $fk_ids['0']->address_id;

        $deleteEmail = Email::destroy($email_id);
        $deletePhone = Phone_number::destroy($phone_number_id);
        $deleteAddress = Address::destroy($address_id);
        $deleteUser = User::destroy($id);

        if($deleteUser == 0){
            $success = 'success';
            $msg = "User deleted successfully";
        }else{
            $success = 'error';
            $msg = "User not found";
        }

        return response()->json([
            'success'=>$success,
            'msg'=>$msg,
            
        ]);

        // DB::table('users')->where('id', $id)->delete();
        // // return redirect()->route('show');
        // if(Response::ajax()) return "OK";
    }

    function update(Request $request, $id){
        $fk_ids = DB::table('users')->select('email_id', 'phone_number_id', 'address_id')->where('id',$id)->get();

        $email_id = $fk_ids['0']->email_id;
        $phone_id = $fk_ids['0']->phone_number_id;
        $address_id = $fk_ids['0']->address_id;

        // dd($request);

        session()->flash('user_id', $id);

        $request->validate([
           'name'.$id=>'required',
            'user'.$id=>'required',
            'address'.$id=>'required',
            'email'.$id=> ['nullable',
            'required_without:phone'.$id, 'email',
            Rule::unique('emails', 'email')->ignore($email_id)
            ],
            'phone'.$id=> ['nullable','required_without:email'.$id,
            Rule::unique('phone_numbers', 'phone_number')->ignore($phone_id)
        ],
        ]);
        // dd($email_id, $phone_id, $address_id);

        // // return view('welcome');
        // //store to email

        $email = $request['email'.$id];
        // dd($email);

        $emailS = DB::table('emails')->where('id',$email_id)->update(['email' => $email]);
        // dd($request->email);

        $address = $request['address'.$id];
        $addressS = DB::table('addresses')->where('id',$address_id)->update(['address' => $address]);

        $phone_number = $request['phone'.$id];
        $phoneS = DB::table('phone_numbers')->where('id',$phone_id)->update(['phone_number' => $phone_number]);
        
        //user
        $full_name = $request['name'.$id];
        $user_name = $request['user'.$id];
        // dd($request, $full_name, $user_name, $id);
        $userS = DB::table('users')->where('id',$id)->update(['full_name' => $full_name, 'user_name'=>$user_name, 'email_id'=>$email_id, 'phone_number_id' => $phone_id, 'address_id'=>$address_id]);
        
        session()->flash('success', 'User updated successfully');


        return redirect()->route('show');
       
    }
}


