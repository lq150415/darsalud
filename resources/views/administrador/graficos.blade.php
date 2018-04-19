@extends('../admin')
@section('contenido')
  {!! Html::script('js/highcharts.js') !!}
  {!! Html::script('assets/js/pestania.js')!!}
  {!! Html::style('assets/css/pestania.css') !!}
<script type="text/javascript">
    $(function () {
        var data_medica = <?php echo $medica; ?>;
        var data_psico = <?php echo $psico; ?>;
        var data_oftalmo = <?php echo $oftalmo; ?>;
        var data_externa = <?php echo $externa; ?>;
        var data_total = <?php echo $total; ?>;
        var data_total2 = <?php echo $total2; ?>;
        console.log(data_medica);
        console.log(data_psico);
        console.log(data_oftalmo);
        console.log(data_externa);
        console.log(data_total);
        console.log(data_total2);
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cantidad de evaluados por mes - Segun tipo de evaluacion'
        },
        xAxis: {
            categories: ['Ene','Feb','Mar', 'Abr','May','Jun','Jul', 'Ago','Sep','Oct','Nov', 'Dic'],crosshair: true
        },
        yAxis: {
            title: {
                text: 'Rate'
            }
        },
        tooltip: {
           headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
           pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
           '<td style="padding:0"><b>{point.y} evaluaciones</b></td></tr>',
           footerFormat: '</table>',
           shared: true,
           useHTML: true
        },
        plotOptions: {
          column: {
           pointPadding: 0.2,
           borderWidth: 0
       }
    },
       series: [{
        name: 'Evaluaciones medicas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_medica.length; i++){
                    if(data_medica[i]['mes']==j+1){
                      data[j]=data_medica[i]['count'];
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()
    }, {
        name: 'Evaluaciones Psicologicas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_psico.length; i++){
                    if(data_psico[i]['mes']==j+1){
                      data[j]=data_psico[i]['count'];
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }, {
        name: 'Evaluaciones Oftalmologicas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_oftalmo.length; i++){
                    if(data_oftalmo[i]['mes']==j+1){
                      data[j]=data_oftalmo[i]['count'];
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }, {
        name: 'Consultas externas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_externa.length; i++){
                    if(data_externa[i]['mes']==j+1){
                      data[j]=data_externa[i]['count'];
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }, {
        name: 'Total',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_total.length; i++){
                    if(data_total[i]['mes']==j+1){
                      data[j]=data_total[i]['count'];
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }]
    });
    $('#container2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cantidad de evaluados por mes - Datos monetarios'
        },
        xAxis: {
            categories: ['Ene','Feb','Mar', 'Abr','May','Jun','Jul', 'Ago','Sep','Oct','Nov', 'Dic'],crosshair: true
        },
        yAxis: {
            title: {
                text: 'Rate'
            }
        },
        tooltip: {
           headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
           pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
           '<td style="padding:0"><b>{point.y} Bs.</b></td></tr>',
           footerFormat: '</table>',
           shared: true,
           useHTML: true
        },
        plotOptions: {
          column: {
           pointPadding: 0.2,
           borderWidth: 0
       }
    },
       series: [{
        name: 'Evaluaciones medicas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_medica.length; i++){
                    if(data_medica[i]['mes']==j+1){
                      data[j]=data_medica[i]['count']*50;
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()
    }, {
        name: 'Evaluaciones Psicologicas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_psico.length; i++){
                    if(data_psico[i]['mes']==j+1){
                      data[j]=data_psico[i]['count']*30;
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }, {
        name: 'Evaluaciones Oftalmologicas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_oftalmo.length; i++){
                    if(data_oftalmo[i]['mes']==j+1){
                      data[j]=data_oftalmo[i]['count']*30;
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }, {
        name: 'Consultas externas',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                for(var i= 0; i< data_externa.length; i++){
                    if(data_externa[i]['mes']==j+1){
                      data[j]=data_externa[i]['count']*50;
                    }
                    else{
                      if(!data[j]){
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    },{
        name: 'Total',
        data: (function(){
                var data= [];
                for(var j= 0; j< 12; j++){
                  var total2 = 0;
                for(var i= 0; i< data_total2.length; i++){
                  if(data_total2[i]['eva']=='Evaluacion medica'){
                  total2=total2+(data_total2[i]['count']*50);
                  console.log(total2);

                }if(data_total2[i]['eva']=='Evaluacion psicologica'){
                  total2=total2+(data_total2[i]['count']*30);
                  console.log(total2);

                }if(data_total2[i]['eva']=='Evaluacion oftalmologica'){
                  total2=total2+(data_total2[i]['count']*30);
                  console.log(total2);

                }if(data_total2[i]['eva']=='Consulta externa'){
                  total2=total2+(data_total2[i]['count']*50);
                  console.log(total2);

                }
                    if(data_total2[i]['mes']==j+1){

                    data[j]=total2;
                    }
                    else{
                      if(!data[j]){
                        var total2 = 0;
                        data[j]=0
                      }
                    }
                  }

                }
                return data;
              })()

    }]
    });
});
</script>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Grafico')" id="defaultOpen">Anual general</button>
  <button class="tablinks" onclick="openCity(event, 'Graficobs')">Anual Bs.</button>
</div>
  <div id="Grafico" class="tabcontent">
    <div class="row">
        <div class="col-md-12 col-md-offset">
            <div class="panel panel-info">
                <div class="panel-heading">Grafico general anual - Darsalud </div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div id="Graficobs" class="tabcontent">
    <div class="row">
        <div class="col-md-12 col-md-offset">
            <div class="panel panel-info">
                <div class="panel-heading">Grafico general anual Bs. - Darsalud </div>
                <div class="panel-body">
                    <div id="container2"></div>
                </div>
            </div>
        </div>
    </div>
  </div>

</div>

<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@endsection
