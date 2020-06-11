<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\AuditorDetail_indas;
use Validator, DB, Hash;
use App\User;
use JWTAuth;
class AuditorDetailIndasController extends BaseController
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
        if(!empty($request->Yearoffiling))
        {
            $params[] = ['Yearoffiling', 'like', '%'.$request->Yearoffiling.'%'];
        }
        if(!empty($request->Source))
        {
            $params[] = ['Source', 'like', '%'.$request->Source.'%'];
        }
        if(!empty($request->Rule))
        {
            $params[] = ['Rule', 'like', '%'.$request->Rule.'%'];
        }
        if(!empty($request->Rankindex))
        {
            $params[] = ['Rankindex', 'like', '%'.$request->Rankindex.'%'];
        }
        if(!empty($request->AddressOfAuditors))
        {
            $params[] = ['AddressOfAuditors', 'like', '%'.$request->AddressOfAuditors.'%'];
        }
        if(!empty($request->CategoryOfAuditor))
        {
            $params[] = ['CategoryOfAuditor', 'like', '%'.$request->CategoryOfAuditor.'%'];
        }
        if(!empty($request->DateOfSigningAuditReportByAuditors))
        {
            $params[] = ['DateOfSigningAuditReportByAuditors', 'like', '%'.$request->DateOfSigningAuditReportByAuditors.'%'];
        }
        if(!empty($request->DateOfSigningOfBalanceSheetByAuditors))
        {
            $params[] = ['DateOfSigningOfBalanceSheetByAuditors', 'like', '%'.$request->DateOfSigningOfBalanceSheetByAuditors.'%'];
        }
        if(!empty($request->FirmsRegistrationNumberOfAuditFirm))
        {
            $params[] = ['FirmsRegistrationNumberOfAuditFirm', 'like', '%'.$request->FirmsRegistrationNumberOfAuditFirm.'%'];
        }
        if(!empty($request->MembershipNumberOfAuditor))
        {
            $params[] = ['MembershipNumberOfAuditor', 'like', '%'.$request->MembershipNumberOfAuditor.'%'];
        }
        if(!empty($request->NameOfAuditFirm))
        {
            $params[] = ['NameOfAuditFirm', 'like', '%'.$request->NameOfAuditFirm.'%'];
        }
        if(!empty($request->NameOfAuditorSigningReport))
        {
            $params[] = ['NameOfAuditorSigningReport', 'like', '%'.$request->NameOfAuditorSigningReport.'%'];
        }
        if(!empty($request->PermanentAccountNumberOfAuditorOrAuditorsFirm))
        {
            $params[] = ['PermanentAccountNumberOfAuditorOrAuditorsFirm', 'like', '%'.$request->PermanentAccountNumberOfAuditorOrAuditorsFirm.'%'];
        }
        if(!empty($request->SRNOfFormADT1))
        {
            $params[] = ['SRNOfFormADT1', 'like', '%'.$request->SRNOfFormADT1.'%'];
        }
        $companycsrs = DB::table('auditor_details_indas_2017')->where($params)->get();
        if (count($companycsrs) == '0') {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Data not found.</string>';
            die();
         }

       // return $this->sendResponse($companycsrs->toArray(), 'Nfra indas list retrieved successfully.');
       $data['auditor_detail_indas'] = $companycsrs;
        return response()
            ->view('nfra.auditor_detail_indas', $data, 200)
            ->header('Content-Type', 'text/xml');
    }

}
