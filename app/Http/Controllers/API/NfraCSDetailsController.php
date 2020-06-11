<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator, DB, Hash;
use App\User;
use JWTAuth;
class NfraCSDetailsController extends BaseController
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
        if(!empty($request->Designation))
        {
            $params[] = ['Designation', 'like', '%'.$request->Designation.'%'];
        }
        if(!empty($request->Name))
        {
            $params[] = ['Name', 'like', '%'.$request->Name.'%'];
        }
        if(!empty($request->DIN_PAN))
        {
            $params[] = ['DIN_PAN', 'like', '%'.$request->DIN_PAN.'%'];
        }
        if(!empty($request->mailAddress))
        {
            $params[] = ['mailAddress', 'like', '%'.$request->mailAddress.'%'];
        }
        if(!empty($request->mobileNumber))
        {
            $params[] = ['mobileNumber', 'like', '%'.$request->mobileNumber.'%'];
        }

        $companycsrs = DB::table('nfra_cs_details')->where($params)->get();
        if (count($companycsrs) == '0') {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Data not found.</string>';
            die();
         }

       // return $this->sendResponse($companycsrs->toArray(), 'Nfra xbrl list retrieved successfully.');
       $data['nfra_cs_details'] = $companycsrs;
        return response()
            ->view('nfra.nfra_cs_details', $data, 200)
            ->header('Content-Type', 'text/xml');
    }

}
