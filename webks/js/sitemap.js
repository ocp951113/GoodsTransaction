(function () {
    //百度
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    } else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);

    //360
    var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?c0944e6ad1e70adf5c98bc80bc8e7eed":"https://jspassport.ssl.qhimg.com/11.0.1.js?c0944e6ad1e70adf5c98bc80bc8e7eed";
    document.write('<script src="' + src + '" id="sozz"><\/script>');
})();