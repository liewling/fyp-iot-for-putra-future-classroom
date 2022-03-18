<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GpioController extends Controller
{
    //

    public function index()
    {
        return view('pages/home');
    }

    public function gpioRequestGet()
    {
        if (isset($_GET["pin"])) { // check to see if pin value has been sent to the page
            $pin = strip_tags($_GET["pin"]);
            if ((is_numeric($pin)) && ($pin <= 27) && ($pin >= 0)) { //test if pin is a number

                if (isset($_GET["value"])) {
                    // use gpio function to change pin value
                    $value = strip_tags($_GET["value"]);

                    if (is_numeric($value) && ($value >= 0) && ($value <= 1)) { // ensure value is either 1 or 0

                        error_log("change pin $pin to value $value");
                        exec("gpio -g write " . $pin . " " . $value); // try to change pin value
                        echo ("success"); // return "success", used by JavaScript functions to determine if request was successful

                    } else {
                        // if value is not 0 or 1 then print a fail message
                        echo ("fail - illegal value value");
                        error_log("fail - illegal value value");
                    }
                } elseif (isset($_GET["mode"])) {

                    $mode = strip_tags($_GET["mode"]);

                    if (is_numeric($mode) && ($mode >= 0) && ($mode <= 1)) {
                        //in/out/pwm/clock/up/down/tri
                        // TODO: update to allow pwm/clock/up/down/tri, requires update to main page
                        error_log("change pin $pin to mode $mode");
                        $mode_str = ($mode == 0) ? "in" : "out";
                        exec("gpio -g mode " . $pin . " " . $mode_str); // try to change pin value
                        echo ("success"); // return "success", used by JavaScript functions to determine if request was successful

                    } else {
                        // if value is not 0 or 1 then print a fail message
                        echo ("fail - illegal mode value");
                        error_log("fail - illegal mode value");
                    }
                } else {

                    /* pin variable set, but value or mode not provided
			get pin status using gpiopinstate.cgi by running with the pin given
			returns;
				Pin state for pin:
				<pin number>
				Mode:
				<mode (ALT)0-5>
				Value:
				<pin value 0(LOW)/1(HIGH)>
			
			written into $pinstate array

			not currently used, included for completeness
			*/
                    exec("sudo cgi-bin/gpiopinstate.cgi " . $pin, $pinstate);

                    // write to page
                    foreach ($pinstate as $i) {
                        echo $i . "\n";
                    }

                    error_log("returned pin $pin status");
                }
            } else {
                //
                echo ("fail - illegal pin value");
                error_log("fail - illegal pin value");
            }
        } else {

            /* if pin variable not supplied then return status of all pins as:
	(Pin_values) # # # # # .... # (Pin_modes) # # # # .... #
	by running gpiopinstate.cgi and writing output to $pinstate
	*/
            exec("sudo cgi-bin/gpiopinstate.cgi", $pinstate);

            // write $pinstate to page
            foreach ($pinstate as $i) {
                echo $i;
            }
            error_log("returned status of all pins");
        }
    }
}
