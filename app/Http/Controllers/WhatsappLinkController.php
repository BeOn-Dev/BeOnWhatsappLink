<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLoginSession;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WhatsappLinkController extends Controller
{
    public function login()
    {
        $reference = Str::random(5);

        $payload = [
            'type' => 'whatsapp_link',
            'reference' => $reference,
        ];

        $headers = [
            'beon-token' => 'SPb4sbemr5bwb7sjzCqTcL',
            'Content-Type' => 'application/json',
        ];

        $client = new Client();
        $response = $client->post('https://beon.chat/api/send/message/otp', [
            'headers' => $headers,
            'json' => $payload,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        Session::put('reference', $reference);

//    dd($responseBody);

        return view('welcome', compact('responseBody'));
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        Log::info($data);
//        $phone = $data->phone;
        $reference = Session::get('reference');
        if($data['reference'] == $reference)
        {
            $user = User::firstOrCreate(['phone' => $data['clientPhone']]);
            Auth::login($user);
            Session::forget(['reference']);
            Session::put('authenticated', true);
        }

    }


    public function checkStatus()
    {
        return response()->json(['authenticated' => Session::get('authenticated', false)]);
    }
}
