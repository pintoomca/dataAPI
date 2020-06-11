<string xmlns="http://tempuri.org/">
	<?xml version="1.0" encoding="utf-8"?>
	<NFRA_XBRL_Lists>
    @foreach($nfra_cs_details as $nfra_cs)
        <NFRA_XBRL_List CIN= "{{ $nfra_cs->CIN }}",
        Designation= "{{ $nfra_cs->Designation }}",
        Name= "{{ $nfra_cs->Name }}",
        DIN_PAN= "{{ $nfra_cs->DIN_PAN }}",
        mailAddress= "{{ $nfra_cs->mailAddress }}",
        mobileNumber= "{{ $nfra_cs->mobileNumber }}"/>
    @endforeach
	</NFRA_XBRL_Lists>
</string>
