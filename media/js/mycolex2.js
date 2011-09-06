$(document).ready(function() {
    
    /*
     * Clears all forms completeley even the default values
     */
    function addResetListener(selector) {
        $("[name=reset]").click(function() {
            $(selector).clearForm();
         });
    }
    
    /*
     * Releads the page after 3 seconds
     */
    function reloadPage() {
        setTimeout('location.reload()', 3000);
    }
    
    addResetListener("form");
    
    $("#datepicker").click(function() {
        $(this).datepicker();
    });
});
