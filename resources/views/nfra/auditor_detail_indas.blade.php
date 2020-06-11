<string xmlns="http://tempuri.org/">
	<?xml version="1.0" encoding="utf-8"?>
	<Auditor_Detail_Indas_Lists>
    @foreach($auditor_detail_indas as $_data)
        <Auditor_Detail_Indas_List CIN= "{{ $_data->CIN }}", Yearoffiling= "{{ $_data->Yearoffiling }}",
        Source= "{{ $_data->Source }}",Rule= "{{ $_data->Rule }}",
        Rankindex= "{{ $_data->Rankindex }}",AddressOfAuditors= "{{ $_data->AddressOfAuditors }}",
        CategoryOfAuditor= "{{ $_data->CategoryOfAuditor }}",
        DateOfSigningAuditReportByAuditors= "{{ $_data->DateOfSigningAuditReportByAuditors }}",
        DateOfSigningOfBalanceSheetByAuditors= "{{ $_data->DateOfSigningOfBalanceSheetByAuditors }}",
        FirmsRegistrationNumberOfAuditFirm= "{{ $_data->FirmsRegistrationNumberOfAuditFirm }}",
        MembershipNumberOfAuditor= "{{ $_data->MembershipNumberOfAuditor }}",
        NameOfAuditFirm= "{{ $_data->NameOfAuditFirm }}",
        NameOfAuditorSigningReport= "{{ $_data->NameOfAuditorSigningReport }}",
        PermanentAccountNumberOfAuditorOrAuditorsFirm= "{{ $_data->PermanentAccountNumberOfAuditorOrAuditorsFirm }}",
        SRNOfFormADT1= "{{ $_data->SRNOfFormADT1 }}" />
    @endforeach
	</Auditor_Detail_Indas_Lists>
</string>
