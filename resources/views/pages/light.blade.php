@extends('layouts.default')
@section('content')

<div id="pageTitle">
<h4>Lighting Control</h4>
</div>

<div class="card shadow-sm">
<form method="get" action="">
        <br>
        <h4 style="margin: 0">Manual Control</h4>
        <p style="font-size: 12px; margin: 2px">* Turn sensor off to enable manual control</p>
        <input type="submit" value="Turn On" name="on">
        <input type="submit" value="Turn Off" name="off">
        <br><br>
        <h4>Sensor Control</h4>
        <input type="submit" value="Turn Sensor On" name="son">
        <input type="submit" value="Turn Sensor Off" name="soff">

</form>
</div>

<?php use App\Http\Controllers\LightController; ?>
{{LightController::lightControl()}}

@stop