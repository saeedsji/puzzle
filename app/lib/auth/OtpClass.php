<?php

namespace App\lib\auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OtpClass
{
    
    public function sendOtpSms($phone, $code)
    {
        $smsIrResult = $this->smsirOtp($phone, $code);
        if (!empty($smsIrResult->IsSuccessful))
        {
            return $smsIrResult->IsSuccessful ? true : false;
        }
        else
        {
            return false;
        }
        
    }
    
    public function smsirOtp($phone, $code)
    {
        try
        {
            $APIKey = "e23cb075580f18d4d050b4ef";
            $SecretKey = "puzzleapp";
            $APIURL = "https://ws.sms.ir/";
            
            // message data
            $data = array(
                "ParameterArray" => array(
                    array(
                        "Parameter" => "VerificationCode",
                        "ParameterValue" => $code
                    )
                ),
                "Mobile" => $phone,
                "TemplateId" => "22806"
            );
            
            $SmsIR_UltraFastSend = new SmsIrUltraFastSend($APIKey, $SecretKey, $APIURL);
            return $SmsIR_UltraFastSend->ultraFastSend($data);
            
            
        }
        catch (\Exception $e)
        {
            echo 'Error UltraFastSend : ' . $e->getMessage();
        }
    }
    
    public function kavenegarOtp($phone, $code)
    {
        try
        {
            $client = new Client();
            $request = $client->get('https://api.kavenegar.com/v1/33706C52436F7962793948515370722F714E34795155514F79437A62707857696D79694744784D306A6B6B3D/verify/lookup.json?receptor=' . $phone . '&token=' . $code . '&template=aramia');
            return json_decode($request->getBody(), true);
        }
        catch (GuzzleException $e)
        {
            return [
                'message' => 'مشکلی در ارسال پیامک رخ داد. لطفا مجددا تلاش کنید کاوه نگار',
                'success' => false,
                'IsSuccessful' => false,
                'e' => $e
            ];
        }
    }
    
}
