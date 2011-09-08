/*
 * Clears all forms completeley even the default values
 */
function reset_button_listener(form) {
    $("[name=reset]").click(function() {
        $(form).clearForm();
     });
}

/*
 * Releads the page after 3 seconds
 */
function reloadPage() {
    setTimeout('location.reload()', 3000);
}

 $(document).ready(function() {   
    reset_button_listener("form");
    
    $("#datepicker").click(function() {
        $(this).datepicker();
    });
});
