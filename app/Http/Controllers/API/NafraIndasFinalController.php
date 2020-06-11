<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator, DB, Hash;
use App\User;
use JWTAuth;
class NafraIndasFinalController extends BaseController
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
        if(!empty($request->yearoffiling))
        {
            $params[] = ['yearoffiling', 'like', '%'.$request->yearoffiling.'%'];
        }
        if(!empty($request->otherIncome))
        {
            $params[] = ['otherIncome', 'like', '%'.$request->otherIncome.'%'];
        }
        if(!empty($request->totalProfitBeforeTax))
        {
            $params[] = ['totalProfitBeforeTax', 'like', '%'.$request->totalProfitBeforeTax.'%'];
        }
        if(!empty($request->totalDepreciationDepletionAndAmortisationExpense))
        {
            $params[] = ['totalDepreciationDepletionAndAmortisationExpense', 'like', '%'.$request->totalDepreciationDepletionAndAmortisationExpense.'%'];
        }
        if(!empty($request->financeCost))
        {
            $params[] = ['financeCost', 'like', '%'.$request->financeCost.'%'];
        }
        if(!empty($request->totalProfitBeforeTax_1))
        {
            $params[] = ['totalProfitBeforeTax_1', 'like', '%'.$request->totalProfitBeforeTax_1.'%'];
        }
        if(!empty($request->totalProfitLossForPeriod))
        {
            $params[] = ['totalProfitLossForPeriod', 'like', '%'.$request->totalProfitLossForPeriod.'%'];
        }
        if(!empty($request->tradeReceivablesCurrent))
        {
            $params[] = ['tradeReceivablesCurrent', 'like', '%'.$request->tradeReceivablesCurrent.'%'];
        }
        if(!empty($request->revenueFromOperations))
        {
            $params[] = ['revenueFromOperations', 'like', '%'.$request->revenueFromOperations.'%'];
        }
        if(!empty($request->tradeReceivablesCurrent_1))
        {
            $params[] = ['tradeReceivablesCurrent_1', 'like', '%'.$request->tradeReceivablesCurrent_1.'%'];
        }
        if(!empty($request->totalCurrentLiabilities))
        {
            $params[] = ['totalCurrentLiabilities', 'like', '%'.$request->totalCurrentLiabilities.'%'];
        }
        if(!empty($request->totalProfitLossForPeriod_1))
        {
            $params[] = ['totalProfitLossForPeriod_1', 'like', '%'.$request->totalProfitLossForPeriod_1.'%'];
        }
        if(!empty($request->totalEquity))
        {
            $params[] = ['totalEquity', 'like', '%'.$request->totalEquity.'%'];
        }
        if(!empty($request->borrowingsNonCurrent))
        {
            $params[] = ['borrowingsNonCurrent', 'like', '%'.$request->borrowingsNonCurrent.'%'];
        }
        if(!empty($request->borrowingsCurrent))
        {
            $params[] = ['borrowingsCurrent', 'like', '%'.$request->borrowingsCurrent.'%'];
        }
        if(!empty($request->netCashFlowsFromusedInOperatingActivities))
        {
            $params[] = ['netCashFlowsFromusedInOperatingActivities', 'like', '%'.$request->netCashFlowsFromusedInOperatingActivities.'%'];
        }
        if(!empty($request->depositsAcceptedorRenewedDuringPeriod))
        {
            $params[] = ['depositsAcceptedorRenewedDuringPeriod', 'like', '%'.$request->depositsAcceptedorRenewedDuringPeriod.'%'];
        }
        $companycsrs = DB::table('nafra_indas_final')->where($params)->get();
        if (count($companycsrs) == '0') {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Data not found.</string>';
            die();
         }

       // return $this->sendResponse($companycsrs->toArray(), 'Nfra xbrl list retrieved successfully.');
       $data['nafra_indas_final'] = $companycsrs;
        return response()
            ->view('nfra.nafra_indas_final', $data, 200)
            ->header('Content-Type', 'text/xml');
    }

}
