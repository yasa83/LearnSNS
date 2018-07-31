$(function() {

    $('.js-like').on('click', function() {
        // console.log('ボタンが押されました。');
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin-user').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();
        console.log(feed_id);   //feed_idを取得できているか確認
        console.log(user_id);   //user_idを取得できているか確認



        $.ajax({
            // 送信先、送信するデータなど
            url: 'like.php',
            type: 'POST',
            datatype: 'json',
            data: {
                'feed_id': feed_id,
                'user_id': user_id,
            }
        })
        .done(function(data) {
            // 成功時の処理
            if(data == 'true'){
                like_count++;
                like_btn.siblimgs('.like_count').text(like_count);
            }

        })
        .fail(function(err) {
            // 失敗時の処理
            console.log('error');

        })
    });


});
