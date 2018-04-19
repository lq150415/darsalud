<div class="panel panel-primary panel1">
    <div class="panel-body texto1 ">
      <center>
        <b style="font-size:40px; "><?php echo \Darsalud\Ticket::where('created_at','<=',\Carbon\Carbon::now())->count();?></b>
      </center>
    </div>
  <div class="panel-heading ">EVALUACIONES REALIZADAS</div>
</div>
<div class="panel panel-danger panel2">
    <div class="panel-body texto2">
      Bs.
    </div>
  <div class=" panel-heading">TOTAL VENTAS</div>
</div>
<div class="panel panel-success panel3">
    <div class="panel-body texto3">
      <?php ?>
    </div>
  <div class="panel-heading">PRODUCTO MAS VENDIDO	</div>
</div>
<div class="panel panel-success panel3">
  <center>
    <div class="panel-body ">
      <p> Bienvenido/a <?php echo $idUsuario = Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU;?> </p>
    </div>
  <div class="panel-footer">
    <?php if(Auth::user()->NIV_USU==1){

      echo "ADMINISTRADOR";
    }
      else
      {

      echo "USUARIO";
      }
    ?>
  </div>
</center>
</div>
