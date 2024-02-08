
$(document).ready(function(){

    $("input[name='cable_count']").keyup(function() {
        if ($(this).val() != "") {
            $("input[name='cable_needs']").val(['1']);
        }
    });
    $("input[name='cable_length_other']").keyup(function() {
        if ($(this).val() != "") {
            $("input[name='cable_length[]'][value=9]").attr("checked",true);
        }
    });
});
