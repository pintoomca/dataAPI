<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\AuditorNonXbrl_Aoc4;
use Validator, DB, Hash;
use App\User;
use JWTAuth;
class AuditorNonXbrlAoc4Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Invalid input parameter</string>';
        }
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
               return '<?xml version="1.0" encoding="UTF-8"?>
               <string xmlns="http://tempuri.org/">Authorization Failed.</string>
               ';
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Authentication failed</string>
            ';
        }
        $params = [];
        if(!empty($request->CIN))
        {
            $params[] = ['CIN', 'like', '%'.$request->CIN.'%'];
        }
        if(!empty($request->YEAROFFILING))
        {
            $params[] = ['YEAROFFILING', 'like', '%'.$request->YEAROFFILING.'%'];
        }
        if(!empty($request->Source))
        {
            $params[] = ['Source', 'like', '%'.$request->Source.'%'];
        }
        if(!empty($request->Rule))
        {
            $params[] = ['Rule', 'like', '%'.$request->Rule.'%'];
        }
        if(!empty($request->RANKINDEX))
        {
            $params[] = ['RANKINDEX', 'like', '%'.$request->RANKINDEX.'%'];
        }
        if(!empty($request->AuditorPAN))
        {
            $params[] = ['AuditorPAN', 'like', '%'.$request->AuditorPAN.'%'];
        }
        if(!empty($request->AuditorCategory))
       {
           $params[] = ['AuditorCategory', 'like', '%'.$request->AuditorCategory.'%'];
       }
       if(!empty($request->AudMembrshpNo))
       {
           $params[] = ['AudMembrshpNo', 'like', '%'.$request->AudMembrshpNo.'%'];
       }
       if(!empty($request->SRNOfADT1))
       {
           $params[] = ['SRNOfADT1', 'like', '%'.$request->SRNOfADT1.'%'];
       }
       if(!empty($request->AudtrFirmName))
       {
           $params[] = ['AudtrFirmName', 'like', '%'.$request->AudtrFirmName.'%'];
       }
       if(!empty($request->AudtrFirmAddresFirstLine))
       {
           $params[] = ['AudtrFirmAddresFirstLine', 'like', '%'.$request->AudtrFirmAddresFirstLine.'%'];
       }
       if(!empty($request->AudtrFirmAddSecondLine))
       {
           $params[] = ['AudtrFirmAddSecondLine', 'like', '%'.$request->AudtrFirmAddSecondLine.'%'];
       }
       if(!empty($request->City))
       {
           $params[] = ['City', 'like', '%'.$request->City.'%'];
       }
       if(!empty($request->State))
       {
           $params[] = ['State', 'like', '%'.$request->State.'%'];
       }
       if(!empty($request->Country))
       {
           $params[] = ['Country', 'like', '%'.$request->Country.'%'];
       }
       if(!empty($request->Pincode))
       {
           $params[] = ['Pincode', 'like', '%'.$request->Pincode.'%'];
       }
       if(!empty($request->ReprsntName))
       {
           $params[] = ['ReprsntName', 'like', '%'.$request->ReprsntName.'%'];
       }
       if(!empty($request->ReprsntMembrshpNo))
       {
           $params[] = ['ReprsntMembrshpNo', 'like', '%'.$request->ReprsntMembrshpNo.'%'];
       }
        $companycsrs = DB::table('auditor_non_xbrl_aoc_4_2017')->where($params)->get();
        if (count($companycsrs) == '0') {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Data not found.</string>';
            die();
         }

       // return $this->sendResponse($companycsrs->toArray(), 'Nfra indas list retrieved successfully.');
       $data['auditor_non_xbrl_aoc_4'] = $companycsrs;
        return response()
            ->view('nfra.auditor_non_xbrl_aoc_4', $data, 200)
            ->header('Content-Type', 'text/xml');
    }

}
