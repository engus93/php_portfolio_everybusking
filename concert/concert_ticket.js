function doOpenCheck(chk){
    var obj = document.getElementsByName("check_box");
    for(var i=0; i<obj.length; i++){
        if(obj[i] != chk){
            obj[i].checked = false;
        }
    }
}

var sell_price;
var amount;

function init() {
    sell_price = document.form.sell_price.value;
    amount = document.form.amount.value;
    document.form.sum.value = sell_price;
    change();
}

function add() {
    sell_price = document.form.sell_price.value;
    hm = document.form.amount;
    sum = document.form.sum;
    hm.value++;

    sum.value = parseInt(hm.value) * sell_price;
}

function del() {
    sell_price = document.form.sell_price.value;
    hm = document.form.amount;
    sum = document.form.sum;
    if (hm.value > 1) {
        hm.value--;
        sum.value = parseInt(hm.value) * sell_price;
    }
}

function change() {
    hm = document.form.amount;
    sum = document.form.sum;

    if (hm.value < 0) {
        hm.value = 0;
    }
    sum.value = parseInt(hm.value) * sell_price;
}

$(document).ready(function(){
    $("#test-1").change(function(){
        if($("#test-1").is(":checked")){
            $("#re_support_hover1").css("background-color", "#FBAA48");
            $("#re_text_1").css("color", "#FFFFFF");
            $("#re_text_2").css("color", "black");
            $("#re_text_3").css("color", "black");
            $("#re_support_hover2").css("background-color", "#FFFFFF");
            $("#re_support_hover3").css("background-color", "#FFFFFF");

            $("#price_re").val(1000);

            sell_price = document.form.sell_price.value;
            hm = document.form.amount;
            sum = document.form.sum;

            hm.value = 1;
            sum.value = parseInt("1") * sell_price;

            $("#form_re").css("display", "block");
            $("#support_hover2").prop("disabled", false);

        }else{
            $("#re_text_1").css("color", "black");
            $("#re_support_hover2").css("background-color", "#FFFFFF");
            $("#re_support_hover3").css("background-color", "#FFFFFF");
            $("#re_support_hover1").css("background-color", "#FFFFFF");

            $("#price_re").val(0);

            sell_price = document.form.sell_price.value;
            sum = document.form.sum;

            hm.value = 1;
            sum.value = parseInt("1") * sell_price;

            $("#form_re").css("display", "none");

            $("#support_hover2").prop("disabled", true);

        }
    });

    $("#test-2").change(function(){
        if($("#test-2").is(":checked")){
            $("#re_support_hover2").css("background-color", "#FBAA48");
            $("#re_text_2").css("color", "#FFFFFF");
            $("#re_text_3").css("color", "black");
            $("#re_text_1").css("color", "black");
            $("#re_support_hover3").css("background-color", "#FFFFFF");
            $("#re_support_hover1").css("background-color", "#FFFFFF");

            $("#price_re").val(12000);
            $("#count_re").val(1);

            sell_price = document.form.sell_price.value;
            sum = document.form.sum;

            hm.value = 1;
            sum.value = parseInt("1") * sell_price;

            $("#form_re").css("display", "block");
            $("#support_hover2").prop("disabled", false);
        }else{
            $("#re_text_2").css("color", "black");
            $("#re_support_hover2").css("background-color", "#FFFFFF");
            $("#re_support_hover3").css("background-color", "#FFFFFF");
            $("#re_support_hover1").css("background-color", "#FFFFFF");

            $("#price_re").val(0);

            sell_price = document.form.sell_price.value;
            sum = document.form.sum;

            hm.value = 1;
            sum.value = parseInt("1") * sell_price;


            $("#form_re").css("display", "none");

            $("#support_hover2").prop("disabled", true);
        }
    });

    $("#test-3").change(function(){
        if($("#test-3").is(":checked")){
            $("#re_support_hover3").css("background-color", "#FBAA48");
            $("#re_text_3").css("color", "#FFFFFF");
            $("#re_text_1").css("color", "black");
            $("#re_text_2").css("color", "black");
            $("#re_support_hover1").css("background-color", "#FFFFFF");
            $("#re_support_hover2").css("background-color", "#FFFFFF");

            $("#price_re").val(20000);

            sell_price = document.form.sell_price.value;
            sum = document.form.sum;

            hm.value = 1;
            sum.value = parseInt("1") * sell_price;

            $("#form_re").css("display", "block");
            $("#support_hover2").prop("disabled", false);
        }else{
            $("#re_text_3").css("color", "black");
            $("#re_support_hover2").css("background-color", "#FFFFFF");
            $("#re_support_hover3").css("background-color", "#FFFFFF");
            $("#re_support_hover1").css("background-color", "#FFFFFF");

            $("#price_re").val(0);

            sell_price = document.form.sell_price.value;
            sum = document.form.sum;

            hm.value = 1;
            sum.value = parseInt("1") * sell_price;


            $("#form_re").css("display", "none");

            $("#support_hover2").prop("disabled", true);
        }
    });
});

function st1(idx) {

    var name = "#re_support_hover" + idx;

    if (document.getElementById("re_support_hover" + idx).innerHTML == "댓글달기") {

        $(name).css("display", "block");

        document.getElementById("re_support_hover" + idx).innerHTML = "취소하기";

    } else {

        $(name).css("display", "none");

        document.getElementById("re_support_hover" + idx).innerHTML = "댓글달기";

    }

}