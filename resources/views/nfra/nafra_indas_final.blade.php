<string xmlns="http://tempuri.org/">
	<?xml version="1.0" encoding="utf-8"?>
	<Nfra_Indas_Final_Lists>
    @foreach($nafra_indas_final as $_data)
        <Nfra_Indas_Final_List CIN= "{{ $_data->CIN }}",
        yearoffiling= "{{ $_data->yearoffiling }}",
        otherIncome= "{{ $_data->otherIncome }}",
        totalProfitBeforeTax= "{{ $_data->totalProfitBeforeTax }}",
        totalDepreciationDepletionAndAmortisationExpense= "{{ $_data->totalDepreciationDepletionAndAmortisationExpense }}",
        financeCost= "{{ $_data->financeCost }}",
        totalProfitBeforeTax_1= "{{ $_data->totalProfitBeforeTax_1 }}",
        totalProfitLossForPeriod= "{{ $_data->totalProfitLossForPeriod }}",
        tradeReceivablesCurrent= "{{ $_data->tradeReceivablesCurrent }}",
        revenueFromOperations= "{{ $_data->revenueFromOperations }}",
        tradeReceivablesCurrent_1= "{{ $_data->tradeReceivablesCurrent_1 }}",
        totalCurrentLiabilities= "{{ $_data->totalCurrentLiabilities }}",
        totalProfitLossForPeriod_1= "{{ $_data->totalProfitLossForPeriod_1 }}",
        totalEquity= "{{ $_data->totalEquity }}",
        borrowingsNonCurrent= "{{ $_data->borrowingsNonCurrent }}",
        borrowingsCurrent= "{{ $_data->borrowingsCurrent }}",
        netCashFlowsFromusedInOperatingActivities= "{{ $_data->netCashFlowsFromusedInOperatingActivities }}",
        depositsAcceptedorRenewedDuringPeriod= "{{ $_data->depositsAcceptedorRenewedDuringPeriod }}"/>
    @endforeach
	</Nfra_Indas_Final_Lists>
</string>
