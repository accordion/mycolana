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
    
    $(".addMeasurement").click(function() {
        var sidebar = $("#sidebar");
        var obid = $(this).nextAll('[name=object_id]').val();

        sidebar.load('/detail/measure', function() {
            var form = $('#form_measure');
            addResetListener(form);
            form.ajaxForm({
                target: sidebar, 
                success: reloadPage
            });
            form.find("[name=object_id]").attr('value', obid);
        });
    });
});
