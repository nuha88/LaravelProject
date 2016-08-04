<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
//use Request;

class ContactsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function homepage()
    {
        return view('contacts.Homepage');
    }



    public function index()

    {
    	$contact = Contact::all() ;

    	return view('contacts.index', compact('contact'));

    }



  public function CreateContact(){

        	return view('contacts.new')
        	-> with ('title','Add New Contact');

    }


    public function show($id)
    {
    	$contact = Contact::find($id);
    	return view('contacts.contactinfo', compact('contact'));
    }







    public function store(Request $request)
    {

        //adding records to database

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
        //redirecting to updating records page
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
