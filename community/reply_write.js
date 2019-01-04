$(document).ready(function(){
    $(".re_bt").click(function(){
        var params = $("form").serialize();

        $.ajax({
            type: 'post',
            url: '/community/commu_reply_p.php?idx=41',
            data : params,
            dataType : 'html',
            success: function(data){
                $(".reply_view").html(data);
                $(".reply_content").val('');
            }
        });
    });

});