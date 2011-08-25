$(document).ready(function() {
    $(".addMeasurement").click(function() {
        var form = $(this).nextAll(".form");
        form.load('/detail/measure', function() {
            $('#form_measure').ajaxForm({target: $(this).closest('.form')});
            var obid = $(this).prevAll('input:hidden').val();
            form.find("input:hidden").attr('value', obid);
        });
    });
});
