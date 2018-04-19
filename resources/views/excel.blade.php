<!DOCTYPE html>
<html>

 <tr class="cell"></tr>
 <tr class="cell"></tr>
 <tr class="cell"></tr>
 <tr class="cell"></tr>
 <tr class="cell"></tr>
 <tr class="cell"></tr>
 <tr class="cell"></tr>
 <tr class="cell"></tr>

 @foreach ($pacientes as $key => $paciente)
    <tr height="67.5px"><td id="cell">{{$key=$key+1}}</td>
    <td id="cell">{{$paciente->CI_PAC}}</td>
    <td id="cell">{{$paciente->NOM_PAC}}</td>
    <td id="cell">{{$paciente->APA_PAC}}</td>
    <td id="cell">{{$paciente->AMA_PAC}}</td>
    <td id="cell">
    <?php
    	if(($paciente->RFS_MED =='') &&($paciente->RFT_MED ==''))
    	{
    		echo $paciente->RFI_MED;
    	}
    	if(($paciente->RFS_MED !='') &&($paciente->RFT_MED ==''))
    	{
    		echo $paciente->RFI_MED.' y '.$paciente->RFS_MED;
    	}
     	if(($paciente->RFS_MED !='') &&($paciente->RFT_MED !=''))
     	{
     		echo $paciente->RFI_MED.', '.$paciente->RFS_MED.' y '.$paciente->RFT_MED;
     	}

    ?></td>
    <?php $dato=\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$paciente->FEC_MED)->format('d-m-Y')?>
    <td id="cell">{{ $dato }}</td>
 	<?php
 	if($paciente->APT_MED==1)
 	{
 		$apto='APTO';
 	}
 	else
 	{
 		$apto='NO APTO';
 	}
 	?>

    <td id="cell">
      @if (is_file('storage/'.$dato.'-'.preg_replace('[\s+]','', $paciente->CI_PAC.'.png')))
        <img height="67.5px"; style="margin-left:-10%;" src="storage/<?php echo  $paciente->FOT_PAC;?>">
      @else
        NO HAY IMAGEN / SUBALA MANUALMENTE
      @endif
    </td>
    <td id="cell">{{$apto}}</td>
    <td id="cell">
    <?php
    	if($paciente->APT_MED==2)
    		{
    			echo $paciente->MNA_MED;
    		}
    ?></td>
 </tr>
 @endforeach
</html>
