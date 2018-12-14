<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Config;
//use Mailchimp;

class subscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public $mailchimp;
    public $listId = 'fe5db3b08a';
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        try {

            
           Mailchimp::subscribe('fe5db3b08a', 'user@domain.com'); 

            return redirect()->back()->with('success','Email Subscribed successfully');

        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect()->back()->with('error','Email is Already Subscribed');
        } catch (\Mailchimp_Error $e) {
            return redirect()->back()->with('error','Error from MailChimp');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subscribe(Request $request)
    {
        /*
        $MailChimp = new MailChimp('357d344d38829c31600c5308f582cbe5-us14');
        $result = $MailChimp->post("lists/fe5db3b08a", [
                'email_address' => 'davy@example.com',
                'status'        => 'subscribed',
            ]);
        if ($MailChimp->success()) {
    print_r($result);   
} else {
    echo $MailChimp->getLastError();
}*/
                return view('sukses');

    }
    public function sukses() 
    {
        return view('sukses');
    }

}
