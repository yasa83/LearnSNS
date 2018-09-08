$(function(){
    $('.js-like').on('click',function(){
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin-user').text();
        console.log(feed_id);   //feed_idを取得できているか確認
        console.log(user_id);   //user_idを取得できているか確認

        $.ajax({
            // 送信先、送信するデータ
        })
        .done(function(data){
            // 成功時の処理
        })
        .fall(function(err){
            // 失敗時の処理
        })
    })

});