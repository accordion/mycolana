$(document).ready(function() {
    
    $("#datepicker").click(function() {
        $(this).datepicker();
    });
    
    $(".addMeasurement").click(function() {
        var sidebar = $("#sidebar");
        var obid = $(this).nextAll('input:hidden').val();
        
        sidebar.load('/detail/measure', function() {
            var form = $('#form_measure');
            form.ajaxForm({target: sidebar});
            form.find("input:hidden").attr('value', obid);
        });
    });
});
