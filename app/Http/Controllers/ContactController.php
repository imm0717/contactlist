<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Repositories\ContactRepository;
use App\Mail\ContactAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    public function index(){
        return view('contactlist');
    }

    public function getAll(Request $request){
        if ($request->has('search')){
            $search_data = $request->query('search');
            return $this->repository->search($search_data);
        }else{
            return $this->repository->getAllContacts();
        }

    }

    public function add(Request $request){
        $data = $request->all();
        $newContact = new Contact();
        $newContact->firstname = $data['firstname'];
        $newContact->lastname = $data['lastname'];
        $newContact->email = $data['email'];
        $newContact->contact_number = $data['contact_number'];
        $newContact->save();

        Mail::to($newContact->email)->send(new ContactAdded());

        return $newContact->id;
    }

    public function update(Request $request, $id){

        $data = $request->all();
        $contact = $this->repository->getContact($id);

        $contact->firstname = $data['firstname'];
        $contact->lastname = $data['lastname'];
        $contact->email = $data['email'];
        $contact->contact_number = $data['contact_number'];

        $contact->save();

        return $contact;

    }

    public function delete($id){
        $contact = $this->repository->getContact($id);
        $contact->delete();

        return ['message' => 'Succesfull remove'];
    }

    public function search(Request $request){
        $search_data = $request->all();
        //return $this->repository->search($search_data);
        return $search_data;
    }
}
