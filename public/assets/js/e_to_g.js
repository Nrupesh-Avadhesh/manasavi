$(document).ready(function () {

    $(document).on('keydown', ".e_to_g", function (event) {
        var html = '<div class="cus_in_box">' +
            '<input type="text" class="form-control cus_input" placeholder="text">' +
            '<div class="cus_input_sug"> </div>' +
            '</div>';
        // console.log(event.keyCode);
        if ((event.ctrlKey || event.metaKey || event.shiftKey) || event.keyCode == 16 || event.keyCode == 17 || event.keyCode == 190 || event.keyCode == 110 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 13) { return false; }
        else if (event.keyCode == 8 || event.keyCode == 46) {
            $(this).parents('.form-group').find(".cus_in_box").remove();
            $(this).trigger("focus");
        } else {
            if ($(this).parents('.form-group').find(".cus_in_box").length != 0) {
                $(this).parents('.form-group').find(".cus_input").trigger("focus");
            } else {
                $(this).parents('.form-group').append(html);
                $(this).parents('.form-group').find(".cus_input").trigger("focus");
            }
        }

    });

    $(document).on('click', '.new_option', function (event) {
        // event.preventdefault();
        _this = this;
        var new_data = $.trim($(_this).val());
        var old_val = $.trim($(_this).parents('.form-group').find(".e_to_g").val());
        if (old_val) {
            var n_val = old_val + " " + new_data;
            var trimStr = $.trim(n_val);
            $(_this).parents('.form-group').find(".e_to_g").val(trimStr);
        } else {
            $(_this).parents('.form-group').find(".e_to_g").val(new_data);
        }
        $(_this).parents('.form-group').find(".e_to_g").focus();
        $(_this).parents('.form-group').find(".cus_in_box").remove();

    });

    $(document).on('keyup', '.cus_input', function () {
        var datas = $(this).val();
        _this = this;
        var html = "";
        if (datas) {

            $.ajax({
                type: "GET",
                url: "https://inputtools.google.com/request?text=" + datas +
                    "&itc=gu-t-i0-und&num=5&cp=0&cs=1&ie=utf-8&oe=utf-8",
                success: function (data) {

                    $.each(data[1][0][1], function (index, value) {
                        html += '<input type="button" class="form-control new_option" id="address" name="address" value="' + value + '">';
                    });
                    $(_this).parents('.cus_in_box').find('.cus_input_sug').html(html);
                }
            });

        } else {
            $(_this).parents('.form-group').find(".e_to_g").focus();
            $(_this).parents('.form-group').find(".cus_in_box").remove();
        }
    });
});