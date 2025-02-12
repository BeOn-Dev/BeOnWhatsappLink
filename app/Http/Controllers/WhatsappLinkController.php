<?php

namespace App\Http\Controllers;

use App\Models\LoginReference;
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

        $client = new Client([
            'cookies' => true,
        ]);
        $response = $client->post('https://beon.chat/api/send/message/otp', [
            'headers' => $headers,
            'json' => $payload,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        LoginReference::create([
            'reference' => $reference
        ]);

        return view('welcome', compact('responseBody','reference'));
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        $reference = LoginReference::where('reference',$data['reference'])->first();
        if(!$reference)
        {
            Log::info("not found");

            return false;
        }

        if($data['reference'] == $reference->reference)
        {
            $reference->update([
                'authenticated' => true
            ]);
            $user = User::firstOrCreate(
                ['phone' => $data['clientPhone']],
                ['name' => $data['clientName']]
            );
            Auth::login($user);
            return true;
        }
        Log::info($data['reference']);
        Log::info($reference);
        Log::info("not matched");

        return false;
    }


    public function checkStatus($reference)
    {
        $isExists = false;

        $reference = LoginReference::where([
            ['reference', $reference],
            ['authenticated', true]
        ])->first();
        if($reference)
        {
            $isExists = true;
           $reference->delete();
        }

        return response()->json(['authenticated' => $isExists]);
    }
}
