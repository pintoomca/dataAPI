<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Nfra_xbrl;
use Validator, DB, Hash;
use App\User;
use JWTAuth;
class NfraXbrlController extends BaseController
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
        if(!empty($request->cin))
        {
            $params[] = ['cin', 'like', '%'.$request->cin.'%'];
        }
        if(!empty($request->companyName))
        {
            $params[] = ['companyName', 'like', '%'.$request->companyName.'%'];
        }
        if(!empty($request->address1))
        {
            $params[] = ['address1', 'like', '%'.$request->address1.'%'];
        }
        if(!empty($request->address2))
        {
            $params[] = ['address2', 'like', '%'.$request->address2.'%'];
        }
        if(!empty($request->companyStatus))
        {
            $params[] = ['companyStatus', '=', $request->companyStatus];
        }
        if(!empty($request->companyClass))
        {
            $params[] = ['companyClass', 'like', '%'.$request->companyClass.'%'];
        }
        if(!empty($request->listingStatus))
        {
            $params[] = ['listingStatus', 'like', '%'.$request->listingStatus.'%'];
        }
        if(!empty($request->yearofFilling))
        {
            $params[] = ['yearofFilling', 'like', '%'.$request->yearofFilling.'%'];
        }
        if(!empty($request->incorporationDate))
        {
            $params[] = ['incorporationDate', 'like', '%'.$request->incorporationDate.'%'];
        }
        if(!empty($request->mainActivityGroupCode))
        {
            $params[] = ['mainActivityGroupCode', 'like', '%'.$request->mainActivityGroupCode.'%'];
        }
        if(!empty($request->mainActivityGroupCodeDesc))
        {
            $params[] = ['mainActivityGroupCodeDesc', 'like', '%'.$request->mainActivityGroupCodeDesc.'%'];
        }
        if(!empty($request->paidupCapital))
        {
            $params[] = ['paidupCapital', 'like', '%'.$request->paidupCapital.'%'];
        }
        if(!empty($request->turnover))
        {
            $params[] = ['turnover', 'like', '%'.$request->turnover.'%'];
        }
        if(!empty($request->aggregateOutstandingLoansOrDebentureAndDepositofCompany))
        {
            $params[] = ['aggregateOutstandingLoansOrDebentureAndDepositofCompany', 'like', '%'.$request->aggregateOutstandingLoansOrDebentureAndDepositofCompany.'%'];
        }
        if(!empty($request->categoryOfAuditor))
        {
            $params[] = ['categoryOfAuditor', 'like', '%'.$request->categoryOfAuditor.'%'];
        }
        if(!empty($request->dateOfSigningAuditReportByAuditors))
        {
            $params[] = ['dateOfSigningAuditReportByAuditors', 'like', '%'.$request->dateOfSigningAuditReportByAuditors.'%'];
        }
        if(!empty($request->dateOfSigningOfBalanceSheetByAuditors))
        {
            $params[] = ['dateOfSigningOfBalanceSheetByAuditors', 'like', '%'.$request->dateOfSigningOfBalanceSheetByAuditors.'%'];
        }
        if(!empty($request->firmsRegistrationNumberOfAuditFirm))
        {
            $params[] = ['firmsRegistrationNumberOfAuditFirm', 'like', '%'.$request->firmsRegistrationNumberOfAuditFirm.'%'];
        }
        if(!empty($request->membershipNumberOfAuditor))
        {
            $params[] = ['membershipNumberOfAuditor', 'like', '%'.$request->membershipNumberOfAuditor.'%'];
        }
        if(!empty($request->nameOfAuditFirm))
        {
            $params[] = ['nameOfAuditFirm', 'like', '%'.$request->nameOfAuditFirm.'%'];
        }
        if(!empty($request->nameOfAuditorSigningReport))
        {
            $params[] = ['nameOfAuditorSigningReport', 'like', '%'.$request->nameOfAuditorSigningReport.'%'];
        }
        $companycsrs = DB::table('nfra_xbrl')->where($params)->get();
        if (count($companycsrs) == '0') {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Data not found.</string>';
            die();
         }
       
       // return $this->sendResponse($companycsrs->toArray(), 'Nfra xbrl list retrieved successfully.');
       $data['xbrl_list'] = $companycsrs;
        return response()
            ->view('nfra.xbrl_list', $data, 200)
            ->header('Content-Type', 'text/xml');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $companycsr = Nfra_xbrl::create($input);


        return $this->sendResponse($companycsr->toArray(), 'Company Csr created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companycsr = Nfra_xbrl::find($id);


        if (is_null($companycsr)) {
            return $this->sendError('Company Csr not found.');
        }


        return $this->sendResponse($companycsr->toArray(), 'Company csr retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nfra_xbrl $companycsr)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $companycsr->name = $input['name'];
        $companycsr->detail = $input['detail'];
        $companycsr->save();


        return $this->sendResponse($companycsr->toArray(), 'Company Csr updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nfra_xbrl $companycsr)
    {
        $companycsr->delete();


        return $this->sendResponse($companycsr->toArray(), 'Company Csr deleted successfully.');
    }
}