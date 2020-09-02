<?php


namespace App\Http\Repositories;

use App\Contact;
use Illuminate\Support\Facades\DB;


class ContactRepository
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function getAllContacts(){
        return $this->model::paginate(5);
    }

    public function getContact($id){
        return $this->model::find($id);
    }

    public function search($search_data){
        return DB::table('contacts')->where('firstname', 'LIKE', '%'.$search_data.'%')
            ->orWhere('lastname', 'LIKE', '%'.$search_data.'%')
            ->orWhere('email', 'LIKE', '%'.$search_data.'%')
            ->orWhere('contact_number', 'LIKE', '%'.$search_data.'%')
            ->paginate(5);

    }

}
