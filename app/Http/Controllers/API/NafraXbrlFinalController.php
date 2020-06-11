<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\AuditorDetail_xbrl;
use Validator, DB, Hash;
use App\User;
use JWTAuth;
class NafraXbrlFinalController extends BaseController
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
        if(!empty($request->PBT_Rs_Crores_as_on_March_31))
        {
            $params[] = ['PBT_Rs_Crores_as_on_March_31', 'like', '%'.$request->PBT_Rs_Crores_as_on_March_31.'%'];
        }
        if(!empty($request->totalProfitLossForPeriod))
        {
            $params[] = ['totalProfitLossForPeriod', 'like', '%'.$request->totalProfitLossForPeriod.'%'];
        }
        if(!empty($request->tradeReceivables))
        {
            $params[] = ['tradeReceivables', 'like', '%'.$request->tradeReceivables.'%'];
        }
        if(!empty($request->RevenueFromSaleofProducts))
        {
            $params[] = ['RevenueFromSaleofProducts', 'like', '%'.$request->RevenueFromSaleofProducts.'%'];
        }
        if(!empty($request->RevenueFromSaleofServices))
        {
            $params[] = ['RevenueFromSaleofServices', 'like', '%'.$request->RevenueFromSaleofServices.'%'];
        }
        if(!empty($request->tradeReceivables_1))
        {
            $params[] = ['tradeReceivables_1', 'like', '%'.$request->tradeReceivables_1.'%'];
        }

        if(!empty($request->totalCurrentLiabilities))
        {
            $params[] = ['totalCurrentLiabilities', 'like', '%'.$request->totalCurrentLiabilities.'%'];
        }
        if(!empty($request->totalProfitLossforPeriod_1))
        {
            $params[] = ['totalProfitLossforPeriod_1', 'like', '%'.$request->totalProfitLossforPeriod_1.'%'];
        }
        if(!empty($request->borrowingsNonCurrent))
        {
            $params[] = ['borrowingsNonCurrent', 'like', '%'.$request->borrowingsNonCurrent.'%'];
        }
        if(!empty($request->totalShareholdersFunds))
        {
            $params[] = ['totalShareholdersFunds', 'like', '%'.$request->totalShareholdersFunds.'%'];
        }

        if(!empty($request->longTermBorrowings))
        {
            $params[] = ['longTermBorrowings', 'like', '%'.$request->longTermBorrowings.'%'];
        }
        if(!empty($request->netCashFlowsFromusedinOperatingActivities))
        {
            $params[] = ['netCashFlowsFromusedinOperatingActivities', 'like', '%'.$request->netCashFlowsFromusedinOperatingActivities.'%'];
        }
        if(!empty($request->depositsAcceptedorRenewedDuringPeriod))
        {
            $params[] = ['depositsAcceptedorRenewedDuringPeriod', 'like', '%'.$request->depositsAcceptedorRenewedDuringPeriod.'%'];
        }
        $companycsrs = DB::table('nafra_xbrl_final')->where($params)->get();
        if (count($companycsrs) == '0') {
            return '<?xml version="1.0" encoding="UTF-8"?>
            <string xmlns="http://tempuri.org/">Data not found.</string>';
            die();
         }

       // return $this->sendResponse($companycsrs->toArray(), 'Nfra xbrl list retrieved successfully.');
       $data['nafra_xbrl_final'] = $companycsrs;
        return response()
            ->view('nfra.nafra_xbrl_final', $data, 200)
            ->header('Content-Type', 'text/xml');
    }

}
