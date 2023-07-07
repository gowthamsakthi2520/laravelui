<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class IndexController extends Controller
{
    public function admin_panel()
    {
        try {
            return view('backend.dashboard');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function whatsapphandler()
    {

        $receiver_number = "whatsapp:+917812880655";    
        $message = "This is a whatsapp Notification testing";

        $auth_sid = "AC2768789aac7115ad99bd537412f79628";
        $auth_token ="bc62b0e44e7327f852ebafaa43e79a61";
        $auth_from = "whatsapp:+14155238886";
        $newClient = new Client($auth_sid,$auth_token);
        $newClient->messages->create("whatsapp:+917812880655",[
            'from'=>"whatsapp:+14155238886",
            'body'=>$message
        ]);
        return "success";
    }
}