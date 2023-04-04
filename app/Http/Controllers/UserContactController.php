<?php

namespace App\Http\Controllers;

use App\Models\UserContact;
use App\Http\Requests\StoreUserContactRequest;
use App\Http\Requests\UpdateUserContactRequest;
use Inertia\Inertia;

class UserContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users_contact = UserContact::all();
        return Inertia::render('UserContacts/index',[
            'user_contacts' => $users_contact
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserContactRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user_contact = new UserContact($request->input());
        $user_contact->save();
        return redirect()->route('user_contact.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserContact $userContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserContact $userContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserContactRequest $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user_contact = UserContact::find($id);
        $user_contact->fill($request->input())->saveOrFail();
        return redirect()->route('user_contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_contact = UserContact::find($id);
        $user_contact->delete();
        return redirect()->route('user_contact.index');
    }
}
