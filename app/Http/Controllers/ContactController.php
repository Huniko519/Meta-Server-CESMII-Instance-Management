<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use Exception;
use Throwable;

class ContactController extends Controller
{
    use ApiResponser;
    public function index($oid, Request $request)
    {
        $orgs = Contact::with('organization')->where('organization_id', $oid)->get();
        return $this->successResponse($orgs);
    }
    public function store($oid, Request $request)
    {
        $validator = $this->validateObj();
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        
        $org = new Contact([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'organization_id' => $oid,
            'type' => $request->input('type')
        ]);
        $org->save();
        
        return $this->successResponse($org);
    }
    public function show($oid, $id)
    {
        $contact = Contact::with('organization')->where('organization_id', $oid)->find($id);
        return $this->successResponse($contact);
    }
    public function update($oid, $id, Request $request)
    {
        $validator = $this->validateObj();
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        
        $contact = Contact::where('organization_id', $oid)->find($id);
        if (!$contact){
            return $this->errorResponse("Item does not exist.", 404);
        }

        $contact->update($request->all());
        return $this->successResponse($contact);
    }
    public function destroy($oid, $id)
    {
        $contact = Contact::with('organization')->where('organization_id', $oid)->find($id);
        if (!$contact){
            return $this->errorResponse("Item does not exist.", 500);
        }
        $contact->delete();
        
        return $this->successResponse("Item has been successfully deleted.");
    }

    public function validateObj(){
        return Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'string|max:255',
            'type' => 'in:Commercial,Technical',
        ]);
    }
}
