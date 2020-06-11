<string xmlns="http://tempuri.org/">
	<?xml version="1.0" encoding="utf-8"?>
	<Nfra_Xbrl_Final_Lists>
    @foreach($nafra_xbrl_final as $_data)
        <Nfra_Xbrl_Final_List CIN= "{{ $_data->CIN }}",
        yearoffiling= "{{ $_data->yearoffiling }}",
        otherIncome= "{{ $_data->otherIncome }}",
        totalProfitBeforeTax= "{{ $_data->totalProfitBeforeTax }}",
        totalDepreciationDepletionAndAmortisationExpense= "{{ $_data->totalDepreciationDepletionAndAmortisationExpense }}",
        financeCost= "{{ $_data->financeCost }}",
        PBT_Rs_Crores_as_on_March_31= "{{ $_data->PBT_Rs_Crores_as_on_March_31 }}",
        totalProfitLossForPeriod= "{{ $_data->totalProfitLossForPeriod }}",
        tradeReceivables= "{{ $_data->tradeReceivables }}",
        RevenueFromSaleofProducts= "{{ $_data->RevenueFromSaleofProducts }}",
        RevenueFromSaleofServices= "{{ $_data->RevenueFromSaleofServices }}",
        tradeReceivables_1= "{{ $_data->tradeReceivables_1 }}",
        totalCurrentLiabilities= "{{ $_data->totalCurrentLiabilities }}",
        totalProfitLossforPeriod_1= "{{ $_data->totalProfitLossforPeriod_1 }}",
        borrowingsNonCurrent= "{{ $_data->borrowingsNonCurrent }}",
        totalShareholdersFunds= "{{ $_data->totalShareholdersFunds }}",
        longTermBorrowings= "{{ $_data->longTermBorrowings }}",
        netCashFlowsFromusedinOperatingActivities= "{{ $_data->netCashFlowsFromusedinOperatingActivities }}",
        depositsAcceptedorRenewedDuringPeriod= "{{ $_data->depositsAcceptedorRenewedDuringPeriod }}"/>
    @endforeach
	</Nfra_Xbrl_Final_Lists>
</string>
