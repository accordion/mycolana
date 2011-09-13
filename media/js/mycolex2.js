function add_reset_button(form, label) {
    form.append('<button name="reset" class="reset" onclick="return false">'+label+'</button>');
    $("[name=reset]").click(function() {
        form.clearForm();
    });
}

$(document).ready(function() {    
    $("#datepicker").click(function() {
        $(this).datepicker();
    });
});
