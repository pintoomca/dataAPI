<string xmlns="http://tempuri.org/">
	<?xml version="1.0" encoding="utf-8"?>
	<NFRA_XBRL_Lists>
    @foreach($xbrl_list as $xbrl_data)
        <NFRA_XBRL_List cin= "{{ $xbrl_data->cin }}",companyName= "{{ $xbrl_data->companyName }}",address1= "{{ $xbrl_data->address1 }}",address2= "{{ $xbrl_data->address2 }}",companyStatus= "{{ $xbrl_data->companyStatus }}",
        companyClass= "{{ $xbrl_data->companyClass }}",listingStatus= "{{ $xbrl_data->listingStatus }}",yearofFilling= "{{ $xbrl_data->yearofFilling }}",incorporationDate= "{{ $xbrl_data->incorporationDate }}",mainActivityGroupCode= "{{ $xbrl_data->mainActivityGroupCode }}",
        mainActivityGroupCodeDesc= "{{ $xbrl_data->mainActivityGroupCodeDesc }}",paidupCapital= "{{ $xbrl_data->paidupCapital }}",turnover= "{{ $xbrl_data->turnover }}",aggregateOutstandingLoansOrDebentureAndDepositofCompany= "{{ $xbrl_data->aggregateOutstandingLoansOrDebentureAndDepositofCompany }}",
        categoryOfAuditor= "{{ $xbrl_data->categoryOfAuditor }}",dateOfSigningAuditReportByAuditors= "{{ $xbrl_data->dateOfSigningAuditReportByAuditors }}",dateOfSigningOfBalanceSheetByAuditors= "{{ $xbrl_data->dateOfSigningOfBalanceSheetByAuditors }}",
        firmsRegistrationNumberOfAuditFirm= "{{ $xbrl_data->firmsRegistrationNumberOfAuditFirm }}",membershipNumberOfAuditor= "{{ $xbrl_data->membershipNumberOfAuditor }}",nameOfAuditFirm= "{{ $xbrl_data->nameOfAuditFirm }}",
        nameOfAuditorSigningReport= "" />
    @endforeach
	</NFRA_XBRL_Lists>
</string>