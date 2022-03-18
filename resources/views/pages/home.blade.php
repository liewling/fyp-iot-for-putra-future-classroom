@extends('layouts.default')
@section('content')

<?php
$pinInfo =  array(
                array('3.3v', '', ''), 
                array('5v', '', ''), 
                array('SDA.1', '8', '2'), 
                array('5v', '', ''), 
                array('SCL.1', '9', '3'), 
                array('0v', '', ''), 
                array('GPIO. 7', '7', '4'), 
                array('TxD', '15', '14'), 
                array('0v', '', ''), 
                array('RxD', '16', '15'), 
                array('GPIO. 0', '0', '17'), 
                array('GPIO. 1', '1', '18'), 
                array('GPIO. 2', '2', '27'), 
                array('0v', '', ''), 
                array('GPIO. 3', '3', '22'), 
                array('GPIO. 4', '4', '23'), 
                array('3.3v', '', ''), 
                array('GPIO. 5', '5', '24'), 
                array('MOSI', '12', '10'), 
                array('0v', '', ''), 
                array('MISO', '13', '9'), 
                array('GPIO. 6', '6', '25'), 
                array('SCLK', '14', '11'), 
                array('CE0', '10', '8'), 
                array('0v', '', ''), 
                array('CE1', '11', '7'), 
                array('SDA.0', '30', '0'), 
                array('SCL.0', '31', '1'), 
                array('GPIO.21', '21', '5'), 
                array('0v', '', ''), 
                array('GPIO.22', '22', '6'), 
                array('GPIO.26', '26', '12'), 
                array('GPIO.23', '23', '13'), 
                array('0v', '', ''), 
                array('GPIO.24', '24', '19'), 
                array('GPIO.27', '27', '16'), 
                array('GPIO.25', '25', '26'), 
                array('GPIO.28', '28', '20'), 
                array('0v', '', ''), 
                array('GPIO.29', '29', '21')
            );
?>

<style>
 

    table,
    th,
    td {
        font: 10pt Arial;
        text-align: center;
        border-collapse: collapse;
        padding: 3px;
    }

    .buttonLow {
        color: #c00000;
    }

    .buttonHigh {
        color: #008000;
    }

</style>

<div class="d-flex align-items-center" id="pageTitle" style="margin-top: 20px;">
<h3>HOME: 
<small class="text-muted">GPIO Status</small></h3>
<div>Model: Raspberry Pi 3 B+ </div>
</div>

<div class="card shadow-sm">


        <table width=80% id="gpioTable" class="table table-bordered table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>BCM#</th>
                    <th>wPi#</th>
                    <th>Name</th>
                    <th>Mode</th>
                    <th>Value</th>

                    <th colspan=2>Phys#</th>

                    <th>Value</th>
                    <th>Mode</th>
                    <th>Name</th>
                    <th>wPi#</th>
                    <th>BCM#</th>
                </tr>
            </thead>
            <?php
            for ($i = 0; $i < 40; $i+=2) { ?>
            <tr>
                <?php
                // for each physical pin look up name and equivalent BCM and wPi number and create table
                // and add in buttons to control the pin values and modes
                // left column "a"
                // formats table to mimic table given by "gpio readall" command but could be adjusted to give any format

                $a_pin_name = $pinInfo[$i][0];
                $a_pin_wPi = $pinInfo[$i][1];
                $a_pin_BCM = $pinInfo[$i][2];


                if ($a_pin_BCM == "") { ?>
                <td colspan=5> {{ $a_pin_name }} </td>
                <td> {{ $i+1 }} </td>
                <?php } else { ?>
                <td>{{ $a_pin_BCM }} </td>
                <td>{{ $a_pin_wPi }} </td>
                <td>{{ $a_pin_name }}</td>
                <td><input type="button" onclick='change_pin_mode({{ $a_pin_BCM }}, 0)' value=''
                        id='mode{{$a_pin_BCM}}'></td>
                <td><input type="button" onclick='change_pin_value({{ $a_pin_BCM }}, 0)' value=''
                        id='value{{$a_pin_BCM}}'></td>
                <td>{{ $i+1 }}</td>
                <?php }
                // right column "b"
                $b_pin_name = $pinInfo[$i+1][0];
                $b_pin_wPi = $pinInfo[$i+1][1];
                $b_pin_BCM = $pinInfo[$i+1][2];
                if ($b_pin_BCM == "") { ?>
                <td>{{ $i+2 }}</td>
                <td colspan="5">{{ $b_pin_name }}</td>
                <?php } else { ?>
                <td>{{ $i+2 }}</td>
                <td><input type="button" onclick='change_pin_value({{ $b_pin_BCM }}, 0)' value=''
                        id='value{{$b_pin_BCM}}'></td>
                <td><input type="button" onclick='change_pin_mode({{ $b_pin_BCM }}, 0)' value=''
                        id='mode{{$b_pin_BCM}}'></td>
                <td>{{ $b_pin_name }}</td>
                <td>{{ $b_pin_wPi }}</td>
                <td>{{ $b_pin_BCM }}</td>
                <?php } ?>
                </tr>
                <?php } ?>

        </table>

    <table class="table table-bordered" width="80%">
        <tr>
            <td nowrap><button type="button" class="btn btn-primary btn-sm" onclick="get_status()" id="update_button">Update</button></td>
            <td nowrap><input type="checkbox" onclick="toggle_update()" id="update_checkbox"/>Auto Update</td>
            <td width="80%">
                <div id="workspace" style="text-align: center;"></div>
            </td>
        </tr>
    </table>

</div>

<script src="{{ asset('/js/script.js') }}"></script>

@stop