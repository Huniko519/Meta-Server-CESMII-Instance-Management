<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Organization;
use App\Models\Contact;
use App\Exceptions\CustomException;
use Throwable;

class OrganizationController extends Controller
{
    use ApiResponser;
    public function index(Request $request)
    {
        $orgs = [];
        $key = $request->q;
        if (!isset($key)) {
            $key = '';
        }
        
        $orgs = Organization::with('partner','contacts')
            ->where('name', 'ilike',  '%'.$key.'%')
            ->orwhere('city', 'ilike',  '%'.$key.'%')
            ->orwhere('address1', 'ilike',  '%'.$key.'%')
            ->orwhere('address2', 'ilike',  '%'.$key.'%')
            ->orwhere('state', 'ilike',  '%'.$key.'%')
            ->orwhere('postal_code', 'ilike',  '%'.$key.'%')
            ->orwhere('url', 'ilike',  '%'.$key.'%')
            ->orderBy('name')
            ->get();
        
        return $this->successResponse($orgs);
    }

    public function store(Request $request)
    {
        $validator = Organization::validator(request()->all());
        
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        $org = new Organization([
            'name' => $request->input('name'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'url' => $request->input('url'),
            'partner_type' => $request->input('partner_type'),
            'partner_id' => $request->input('partner_id'),
        ]);
        
        $org->save();

        $contact = new Contact([
            'organization_id' => $org->id,
            'type' => 'Technical',
            'name' => $request->input('contact_technical_name'),
            'email' => $request->input('contact_technical_email'),
            'phone' => $request->input('contact_technical_phone'),
        ]);

        $contact->save();

        $contact = new Contact([
            'organization_id' => $org->id,
            'type' => 'Commercial',
            'name' => $request->input('contact_commercial_name'),
            'email' => $request->input('contact_commercial_email'),
            'phone' => $request->input('contact_commercial_phone'),
        ]);

        $contact->save();
        
        return $this->successResponse($org);
    }

    public function show($id)
    {        
        $org = Organization::with('partner', 'contacts')->find($id);
        return $this->successResponse($org);
    }

    public function update($id, Request $request)
    {
        $org = Organization::find($id);
        if (!$org){
            return $this->errorResponse("Item does not exist.", 404);
        }
        
        $validator = Organization::updateValidator(request()->all(), $id);
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        
        if ($request->input('partner_id') && $request->input('partner_id') == (string)$org->id) {
            throw new CustomException('Partner should not be same as current Organization');
        }
        $org->update([
            'name' => $request->input('name'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'url' => $request->input('url'),
            'partner_type' => $request->input('partner_type'),
            'partner_id' => $request->input('partner_id'),
        ]);

        $contact_technical = null;
        $contact_commercial = null;
        if ($request['contact_technical_id']) {
            $contact_technical = Contact::find($request['contact_technical_id']);
        }
        if ($request['contact_commercial_id']) {
            $contact_commercial = Contact::find($request['contact_commercial_id']);
        }

        if ($contact_commercial) {
            $contact_commercial->update([
                'organization_id' => $org->id,
                'name' => $request['contact_commercial_name'],
                'email' => $request['contact_commercial_email'],
                'phone' => $request['contact_commercial_phone'],
                'type' => 'Commercial',
            ]);
        }
        else {
            $contact_commercial = new Contact([
                'organization_id' => $id,
                'name' => $request['contact_commercial_name'],
                'email' => $request['contact_commercial_email'],
                'phone' => $request['contact_commercial_phone'],
                'type' => 'Commercial',
            ]);
            $contact_commercial->save();
        }

        if ($contact_technical) {
            $contact_technical->update([
                'organization_id' => $id,
                'name' => $request['contact_technical_name'],
                'email' => $request['contact_technical_email'],
                'phone' => $request['contact_technical_phone'],
                'type' => 'Technical',
            ]);
        }
        else {
            $contact_technical = new Contact([
                'organization_id' => $id,
                'name' => $request['contact_technical_name'],
                'email' => $request['contact_technical_email'],
                'phone' => $request['contact_technical_phone'],
                'type' => 'Technical',
            ]);
            $contact_technical->save();
        }        
        $org = Organization::find($id);
        return $this->successResponse($org);
    }

    public function destroy($id)
    {        
        $org = Organization::find($id);
        if (!$org){
            return $this->errorResponse("Item does not exist.", 404);
        }
        if (count($org->children) > 0) {
            return $this->errorResponse("It has sub organizations.", 500);    
        }
        $org->delete();
        
        return $this->successResponse("Item has been successfully deleted.");
    }
    
}
