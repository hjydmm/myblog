/**************************/
//JQuery分页栏
/**************************/



$.fn.pageBar = function(options) {
    var configs = {
        PageIndex: 1,
        PageSize: 15,
        TotalPage: 0,
        RecordCount: 0,
        showPageCount: 4,
        onPageClick: function(pageIndex) {
            return false;   //默认的翻页事件
        }
    };
    $.extend(configs, options);
    var tmp = "",
        i = 0,
        j = 0,
        a = 0,
        b = 0,
        totalpage = Math.floor(configs.RecordCount / configs.PageSize);
    totalpage = configs.RecordCount % configs.PageSize > 0 ? totalpage + 1 : totalpage;
    tmp += "<span>总记录数：" + configs.RecordCount + "</span > ";
    tmp += " <span>页数：" + totalpage + "</span>";
    if (configs.PageIndex > 1) {
        tmp += "<a class='previous_page page-element'>" + "<" + "</a>"
    } else {
        tmp += "<a class='previous_page page-element no_previous_page'>" + "<" + "</a>"
    }
    tmp += "<a class='page-element' id='1'>1</a>";
    if (totalpage > configs.showPageCount + 1) {
        if (configs.PageIndex <= configs.showPageCount) {
            i = 2;
            j = i + configs.showPageCount;
            a = 1;
        } else if (configs.PageIndex > totalpage - configs.showPageCount) {
            i = totalpage - configs.showPageCount;
            j = totalpage;
            b = 1;
        } else {
            var k = parseInt((configs.showPageCount - 1) / 2);
            i = configs.PageIndex - k;
            j = configs.PageIndex + k + 1;
            a = 1;
            b = 1;
            if ((configs.showPageCount - 1) % 2) {
                i -= 1
            }
        }
    }
    else {
        i = 2;
        j = totalpage;
    }
    if (b) {
        tmp += "..."
    }
    for (; i < j; i++) {
        tmp += "<a class='page-element' id='" + i + "'>" + i + "</a>"
    }
    if (a) {
        tmp += " ... "
    }
    if (totalpage > 1) {
        tmp += "<a class='page-element' id='" + totalpage + "'>" + totalpage + "</a>"
    }
    if (configs.PageIndex < totalpage) {
        tmp += "<a class='next_page page-element'>" + ">" + "</a>"
    } else {
        tmp += "<a class='next_page page-element no_next_page'>" + ">" + "</a>"
    }
    tmp += "<input type='text' /><a>Go</a>";
    var pager = this.html(tmp);
    var index = pager.children('input')[0];

    //设置onPageClick的function的参数pageIndex的定义
    pager.children('a').click(function() {

        //var cls = $(this).attr('class');
        if (this.innerText == '<') {
            //对于<按钮,由于没有innerHTML值
            // if($(this).hasClass('no_previous_page') ) {
            //     //没有前页时值设为
            //     configs.onPageClick(-1 )
            // } else {
            //     //有前页时值设为
            //     configs.onPageClick(-2 )
            // }
            configs.onPageClick(-1 )
        } else if (this.innerText == '>') {
            //对于>按钮,由于没有innerHTML值,无论有多少页,设为totalpage值都没错
            // if($(this).hasClass('no_next_page') ) {
            //     //没有后页时值设为
            //     configs.onPageClick(-3 )
            // } else {
            //     //有后页时值设为
            //     configs.onPageClick(-4 )
            // }
            configs.onPageClick(-2 )
        } else if (this.innerHTML == 'Go') {
            if (!isNaN(index.value)) {
                var indexvalue = parseInt(index.value);
                indexvalue = indexvalue < 1 ? 1 : indexvalue;
                indexvalue = indexvalue > totalpage ? totalpage : indexvalue;
                configs.onPageClick(indexvalue - 1)
            }
        } else {
            if (!$(this).hasClass('cur') ) {
                configs.onPageClick(parseInt(this.innerHTML) - 1)
            }
        }
    }).each(function() {
        if (configs.PageIndex == parseInt(this.innerHTML)) {
            $(this).addClass('cur')
        }
    })
};
