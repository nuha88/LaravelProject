<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;

class SessionsController extends Controller
{



  public function store(Request $request)
    {

        $this-> validate ($request, ['FullName'=>'required|max:30', 'Email' => 'required|email','PhoneNumber'=>'required|integer']);


        /*$file= $request->input('image');
        $destinationPath= 'public/uploads';
        $filename= $file->getClientOriginalName();
        $file->move($filename, $destinationPath);*/

        $FullName = $request -> input('FullName');
        $Email = $request -> input('Email');
         $PhoneNumber = $request -> input('PhoneNumber');
          $Address = $request -> input('Address');

          DB :: table('contacts') -> insert(['FullName' => $FullName,'Email'=> $Email, 'PhoneNumber'=>$PhoneNumber, 'Address'=>$Address]);
          return Redirect::to('AddressBook');

       
    }





    public function edit($id)
    {
            $contact = Contact::findOrFail($id);

        return view('contacts.edit')->withcontact($contact);
    }




    public function update(Request $request, $id)
    {

       $this-> validate ($request, ['FullName'=>'required|max:30', 'Email' => 'required|email','PhoneNumber'=>'required|integer']);
        //Saving Updates
        $FullName = $request -> input('FullName');
        $Email = $request -> input('Email');
        $PhoneNumber = $request -> input('PhoneNumber');
        $Address = $request -> input('Address');


          DB :: table('contacts') -> where('id',$id)-> update(['FullName' => $FullName,'Email'=> $Email, 'PhoneNumber'=>$PhoneNumber, 'Address'=>$Address]);
          return Redirect::to('AddressBook');

    }



    public function destroy($id)
    {
        //
        DB:: table('contacts')-> where('id',$id)->delete();
        return Redirect::to('AddressBook');
    }
}
