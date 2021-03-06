$(function() {
    layui.use(['element'], function() {
        var element = layui.element()
    })

    //第一次获取我发布的	
    getReceived(1)
    getPublished(1)

    //获取我收到的列表	
    function getReceived(page) {
        var url = '/user/received'
        var Data = {
            page: page
        }
        Common.ajax(url, Data, function(data) {
            if (data.success) {
                if (data.result.result.length > 0) {
                    $('.comment-list').html('')
                    data.result.result.forEach(function(v) {
                        $('.comment-list').append('<li>' +
                            '<p><b>' + v.id_name + '</b> 评论 <a href="/detail/' + v.gid + '" target="_blank" title="' + v.good_name + '">' + v.good_name + '</a>：<span class="fr">发布于：' + v.create_time + '</span></p>' +
                            '<p>' + v.content + '</p>' +
                            '</li>')
                    })
                } else {
                    $('.comment-list').html('<div class="nodata">您还没有收到过留言</div>')
                }

                layui.laypage({
                    cont: 'page1',
                    pages: data.result.count,
                    first: 1,
                    curr: page || 1,
                    prev: '<em><</em>',
                    next: '<em>></em>',
                    jump: function(obj, first) {
                        var curr = obj.curr
                        if (!first) {
                            getReceived(curr)
                        }
                    }
                });
            } else {
                layer.msg(data.msg)
            }
        }, function(err) {
            console.log(err)
        }, function() {}, true, 'POST')
    }

    //我发布的
    function getPublished(page) {
        var url = '/user/published'
        var Data = {
            page: page
        }
        Common.ajax(url, Data, function(data) {
            if (data.success) {
                if (data.result.result.length > 0) {
                    $('.published-comment-list').html('')
                    data.result.result.forEach(function(v) {
                        $('.published-comment-list').append('<li>' +
                            '<p><b>' + v.id_name + '</b> 评论 <a href="/detail/' + v.gid + '" target="_blank" title="' + v.good_name + '">' + v.good_name + '</a>：<span class="fr">发布于：' + v.create_time + '</span></p>' +
                            '<p>' + v.content + '</p>' +
                            '</li>')
                    })
                } else {
                    $('.published-comment-list').html('<div class="nodata">您还没有发布过留言</div>')
                }

                layui.laypage({
                    cont: 'page2',
                    pages: data.result.count,
                    first: 1,
                    curr: page || 1,
                    prev: '<em><</em>',
                    next: '<em>></em>',
                    jump: function(obj, first) {
                        var curr = obj.curr
                        if (!first) {
                            getPublished(curr)
                        }
                    }
                });
            } else {
                layer.msg(data.msg)
            }
        }, function(err) {
            console.log(err)
        }, function() {}, true, 'POST')
    }
})