//Uses gpio.php to change pin modes and values
//Also uses gpio.php to get pin status and update buttons
//Associated with index.php to display table of pin modes and values

// following array used to convert output of wiringPi's getAlt() funtion into text for pinMode
pinModes = ["IN", "OUT", "ALT5", "ALT4", "ALT0", "ALT1", "ALT2", "ALT3"];

get_status();

function toggle_update() {
    if (document.getElementById("update_checkbox").checked) {
        // if checkbox ticked then run update
        get_status();
    } else {
        // if checkbox not ticked then clear any running Timeouts and change status
        window.clearTimeout(timerId);
        document.getElementById("workspace").innerHTML = "Static table";
    }
}

function change_pin_value(pin, value) {

    console.log("Pin: " + pin + " value: " + value);

    $.ajax({
        method: "GET",
        url: "gpio?pin=" + pin + "&value=" + value,
        success: function (data) {
            console.log(data);
            // gpio.php returns "success" if mode changed successfully
            get_status();
            return ("success");
        },
        error: function (err) {
            if (err.status == 500) {
                alert("server error");
                return ("fail");
            } else if (err.status != 200 && err.status != 500) {
                alert("Something went wrong!");
                return ("fail");
            }
            return ("fail");
        }
    });
}

function change_pin_mode(pin, mode) {
    console.log("Pin: " + pin + " mode: " + mode);

    $.ajax({
        method: "GET",
        url: "gpio?pin=" + pin + "&mode=" + mode,
        success: function (data) {
            console.log(data);
            // gpio.php returns "success" if mode changed successfully
            get_status();
            return ("success");
        },
        error: function (err) {
            if (err.status == 500) {
                alert("server error");
                return ("fail");
            } else if (err.status != 200 && err.status != 500) {
                alert("Something went wrong!");
                return ("fail");
            }
            return ("fail");
        }
    });
}

// holds id of timeOut timer. Used to cancel when stopping update
var timerId = 0;
var startup_flag = true;

function get_status() {

    var data = 0;

    // start timer to see how long process
    t1 = (new Date()).getTime();
    document.getElementById("workspace").innerHTML = "Updating...";
    //this is the http ajax to get full status

    $.ajax({
        method: "GET",
        url: "gpio?t=" + Math.random(),
        success: function (data) {
            console.log(data);
            // gpio.php returns "success" if mode changed successfully
            // values 1 - 28 (BCM) are values of each pin
            // values 30 - 57 (BCM) are values for each pins mode
            // see pinmodes array for how this value correlates to the mode of the pin
            data_arr = data.split(" ");
            console.log(data_arr);
            for (n = 0; n < 28; n++) {
                // for each pin
                value_button = document.getElementById("value" + n);
                if (value_button != null) {
                    // set value button text
                    value_button.value = (data_arr[n + 1] == 1 ? "HIGH" : "LOW");
                    // set class for high/low pin
                    value_button.className = data_arr[n + 1] == 1 ? "buttonHigh" : "buttonLow";
                    // change function of button
                    newvalue = 1 - data_arr[n + 1]; // new value is opposite to current value
                    value_button.onclick = new Function("change_pin_value(" + n + ", " + newvalue + ")");
                }
                mode_button = document.getElementById("mode" + n);
                if (mode_button != null) {
                    // set mode button text
                    mode_button.value = pinModes[data_arr[n + 30]];
                    // change function of button
                    // not sure about safety of changing pins to ALT modes on the fly so at present just toggles between input and output
                    newvalue = data_arr[n + 30] > 0 ? 0 : 1;
                    mode_button.onclick = new Function("change_pin_mode(" + n + ", " + newvalue + ")");
                }
                // end timer
                t2 = (new Date()).getTime();
                // display how long ajax took
                document.getElementById("workspace").innerHTML = "Done in " + (t2 - t1) + " milliseconds";
            }

            if (document.getElementById("update_checkbox").checked) {
                // if auto update check box is checked, clear existing timer and start a new one
                window.clearTimeout(timerId);
                timerId = window.setTimeout(get_status, 500);
            }
        },

        error: function (err) {
            if (err.status == 500) {
                alert("server error");
                dElementById("mode" + n);
                if (mode_button != null)
                    document.getElementById("workspace").innerHTML = "Server error (500 status)";
                return ("fail");
            } else if (err.status != 200 && err.status != 500) {
                alert("Something went wrong!");
                document.getElementById("workspace").innerHTML = "General error";
                return ("fail");
            }
            return ("fail");
        }

    });

}

//
$(function(){
    var current_page_URL = location.href;
    $( "a" ).each(function() {
       if ($(this).attr("href") !== "#") {
         var target_URL = $(this).prop("href");
         if (target_URL == current_page_URL) {
            $('sidebar-navigation a').parents('li, ul').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
         }
       }
    });
  });

// $(document).ready(function () {

//     $("#sidebar").mCustomScrollbar({
//          theme: "minimal"
//     });

//     $('#sidebarCollapse').on('click', function () {
//         // open or close navbar
//         $('#sidebar').toggleClass('active');
//         // close dropdowns
//         $('.collapse.in').toggleClass('in');
//         // and also adjust aria-expanded attributes we use for the open/closed arrows
//         // in our CSS
//         $('a[aria-expanded=true]').attr('aria-expanded', 'false');
//     });

// });

//
// $(document).ready(function () {

//     $('#sidebarCollapse').on('click', function () {
//         $('#sidebar').toggleClass('active');
//     });

// });
