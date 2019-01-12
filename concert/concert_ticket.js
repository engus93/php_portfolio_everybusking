var sell_price;
var amount;
var price = false;
var adress = false;
var adress_re = false;

function doOpenCheck(chk){
    var obj = document.getElementsByName("check_box");
    for(var i=0; i<obj.length; i++){
        if(obj[i] != chk){
            obj[i].checked = false;
        }
    }
}

function doOpenCheck_re(chk){
    var obj = document.getElementsByName("check_box_re");
    for(var i=0; i<obj.length; i++){
        if(obj[i] != chk){
            obj[i].checked = false;
        }
    }
}

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

function check_check(){

    if(price && adress){
        $("#support_hover2").prop("disabled", false);
    }else if(price && adress_re){
        $("#support_hover2").prop("disabled", false);
    }else {
        $("#support_hover2").prop("disabled", true);
    }

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
            $("#genre_text").val("옵션 1 : 그냥 후원하기 : 1000원");

            price = true;

            check_check();

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

            price = false;

            check_check();

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

            $("#genre_text").val("옵션 2 : 콘서트 티켓 : 12,000원");

            price = true;

            check_check();

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

            price = false;

            check_check();

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

            $("#genre_text").val("옵션 3 : 콘서트 티켓 + 굿즈 : 20,000원");

            price = true;

            check_check();

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

            price = false;

            check_check();

        }
    });

    $("#re_test-1").change(function(){
        if($("#re_test-1").is(":checked")){

            $("#address").css("display", "none");

            adress = true;

            check_check();

        }else{

            $("#address").css("display", "none");

            adress = false;

            check_check();

        }
    });

    $("#re_test-2").change(function(){
        if($("#re_test-2").is(":checked")){

            $("#address").css("display", "block");

        }else{

            $("#address").css("display", "none");

            adress_re = false;

            check_check();

        }
    });

    $("#adress_etc").on("keyup", function () {

        if ($("#adress_etc").val().length == 0 || $("#post").val().length == 0 || $("#addr").val().length == 0 ) {
            $("#adress_etc").css("background-color", "#FFFFFF");
            adress_re = false;
        } else {
            $("#adress_etc").css("background-color", "#FFB863");
            adress_re = true;
        }

        check_check();

    });

});
