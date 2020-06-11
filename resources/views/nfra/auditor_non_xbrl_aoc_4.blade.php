<string xmlns="http://tempuri.org/">
	<?xml version="1.0" encoding="utf-8"?>
	<Auditor_Non_Xbrl_Aoc4_Lists>
    @foreach($auditor_non_xbrl_aoc_4 as $_data)
        <Auditor_Non_Xbrl_Aoc4_List CIN= "{{ $_data->CIN }}",
        Yearoffiling= "{{ $_data->YEAROFFILING }}",
        Source= "{{ $_data->Source }}",
        Rule= "{{ $_data->Rule }}",
        RANKINDEX= "{{ $_data->RANKINDEX }}",
        AuditorPAN= "{{ $_data->AuditorPAN }}",
        AuditorCategory= "{{ $_data->AuditorCategory }}",
        AudMembrshpNo= "{{ $_data->AudMembrshpNo }}",
        AudtrFirmName= "{{ $_data->AudtrFirmName }}",
        AudtrFirmAddresFirstLine= "{{ $_data->AudtrFirmAddresFirstLine }}",
        AudtrFirmAddSecondLine= "{{ $_data->AudtrFirmAddSecondLine }}",
        City= "{{ $_data->City }}",
        State= "{{ $_data->State }}",
        Country= "{{ $_data->Country }}",
        Pincode= "{{ $_data->Pincode }}",
        ReprsntName= "{{ $_data->ReprsntName }}",
        ReprsntMembrshpNo= "{{ $_data->ReprsntMembrshpNo }}",
        SRNOfADT1= "{{ $_data->SRNOfADT1 }}" />
    @endforeach
	</Auditor_Non_Xbrl_Aoc4_Lists>
</string>
