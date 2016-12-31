$(function(){
	$("[data-toggle=tooltip]").tooltip({container: 'body'});
    //back-to-top滚动条
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
    $('#back-to-top').on('click', function(e){
		e.preventDefault();
		$('html, body').animate({scrollTop : 0},1000);
		return false;
    });
	//投票
    $('.vote a').on('click', function() {
        var a = $(this);
        var title = a.attr('data-original-title');
        $.ajax({
            url: a.attr('href'),
            type:'post',
            dataType: 'json',
            success: function(data) {
                a.parent().find('.up i').attr('class', 'fa fa-thumbs-o-up');
                a.parent().find('.down i').attr('class', 'fa fa-thumbs-o-down');
                a.find('i').attr('class', a.find('i').attr('class').replace('o-', ''));
                a.parent().find('.up em').html(data.up);
                a.parent().find('.down em').html(data.down);
                a.attr('data-original-title');
                a.attr('data-original-title', '您已' + title).tooltip('show').attr('data-original-title', title);
            },
            error: function (XMLHttpRequest, textStatus) {
                if(XMLHttpRequest.status == 302){
                    $('#modal').modal({ remote: XMLHttpRequest.getResponseHeader('X-Redirect')});
                }
                this.abort();
            }
        });
        return false;
    });
    //详细页收藏
    $('.collection a').on('click', function() {
        var a = $(this);
        var i = a.find('i');
        var em = a.find('em');
        var params = a.data('params');
        $.ajax({
        	//url发送请求的地址
            url: a.attr('href'),
            //type：POST、GET[默认]
            type:'post',
            //data是一个对象，连同请求发送到服务器的数据
            data:params,
            //预期服务器返回的数据类型。如果不指定，JQuery将自动根据HTTP包MIME信息来智能判断，一般我们采用json格式
            dataType: 'json',
            //请求成功调用的函数，传入返回的数据和包含成功代码的字符串
            success: function(data) {
                if(data.action == 'create') {
                    i.attr('class', 'fa fa-star');
                    a.attr('data-original-title', '您已收藏').tooltip('show').attr('data-original-title', '取消收藏');
                } else {
                    i.attr('class', 'fa fa-star-o');
                    a.attr('data-original-title', '您已取消收藏').tooltip('show').attr('data-original-title', '收藏');
                }
                em.html(data.count);
            },
            //请求失败调用的函数，传入XMLHttpRequest对象
            error: function (XMLHttpRequest, textStatus) {
                if(XMLHttpRequest.status == 302){
                    $('#modal').modal({ remote: XMLHttpRequest.getResponseHeader('X-Redirect')});
                }
                this.abort();
            }
        });
        return false;
    });
    //回复
    $(".reply-btn").click(function(){
        $(".reply-form").removeClass("hidden");
        if($(this).parent().attr("class")=="media-action") {
            $(".reply-form").appendTo($(this).parent());
            $(".reply-form").find("textarea").val("");
        } else {
            $(".reply-form").appendTo($(this).parents("li").find(".media-action"));
            var a = $(this).parents(".media-heading").find("a").html();
            $(".reply-form").find("textarea").val("@"+a);
        }
        $(".reply-form").find(".parent_id").val($(this).parents("li").attr("data-key"));
        return false;
    });
});