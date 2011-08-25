$(document).ready(function() {
    
    $("#datepicker").click(function() {
        $(this).datepicker();
    });
    
    /*
     * Releads the page after 3 seconds
     */
    function reloadPage() {
        setTimeout('location.reload()', 3000);
    }
    
    $(".addMeasurement").click(function() {
        var sidebar = $("#sidebar");
        var obid = $(this).nextAll('input:hidden').val();
        
        sidebar.load('/detail/measure', function() {
            var form = $('#form_measure');
            form.ajaxForm({
                target: sidebar, 
                success: reloadPage
            });
            form.find("input:hidden").attr('value', obid);
        });
    });
});
