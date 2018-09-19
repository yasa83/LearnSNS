$(function(){
    $(document).on('click','.js-like',function(){
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin-user').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();
        console.log(feed_id);   //feed_idを取得できているか確認
        console.log(user_id);   //user_idを取得できているか確認

        $.ajax({
            // 送信先、送信するデータ
            url:'like.php',
            type:'POST',
            datatype:'json',
            data:{
                'feed_id': feed_id,
                'user_id': user_id,
            }
        })
        .done(function(data){
            // 成功時の処理
            if(data == 'true'){
                like_count++;
                like_btn.siblings('.like_count').text(like_count);
                like_btn.removeClass('js-like');
                like_btn.addClass('js-unlike');
                like_btn.children('span').text('いいねを取り消す');
            }
        })
        .fall(function(err){
            // 失敗時の処理
            console.log('error');
        })
    });
        $(document).on('click','.js-unlike',function(){
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin-user').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();

        $ajax({
            // 送信先、送信するデータ
            url: 'like.php',
            type: 'POST',
            datatype: 'json',
            data:{
                'feed_id': feed_id,
                'user_id': user_id,
                'is_unlike': true,
            }
        })
        .done(function(data){
            if(data == 'true'){
                like_count--;
                like_btn.siblings('.like_count').text(like_count);
                like_btn.removeClass('js-unlike');
                like_btn.addClass('js=like');
                like_btn.children('span').text('いいね！');
            }
        })
        .fail(function(err){
            console.log('error');
        })

    });

});