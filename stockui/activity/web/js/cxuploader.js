window.onload = function() {
    webuploaderAgain();
}

//滚动条
$("#uploader-demo").slimScroll({
    width: '1040px', //可滚动区域宽度
    height: '600px', //可滚动区域高度
    size: '4px', //组件宽度
    color: '#C8CCD3', //滚动条颜色
    opacity: 1, //滚动条透明度
    distance: '5px', //组件与侧边之间的距离
    railVisible: true, //是否 显示轨道
    railColor: '#FFFFFF', //轨道颜色
    railOpacity: 1, //轨道透明度
    alwaysVisible: false, //是否 始终显示组件
    wheelStep: 30, //滚轮滚动量
    railClass: 'slimScrollRail', //轨道div类名 
    barClass: 'slimScrollBar', //滚动条div类名
});

// 初始化Web Uploader
var uploader = WebUploader.create({

    auto: true, // 选完文件后，是否自动上传。

    swf: window.server+'/js/webuploader/Uploader.swf', // swf文件路径

    server:  window.server,

    pick: '#filePicker',

    fileNumLimit: 30, //一次最多上传文件个数

    fileSizeLimit: 20 * 1024 * 1024, // 总共的最大限制20M

    fileSingleSizeLimit: 2 * 1024 * 1024, // 单文件的最大限制2M

    duplicate: true, //允许重复上传

    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'jpg,jpeg,bmp,png',
        mimeTypes: 'image/jpg,image/jpeg,image/png,image/bmp'
    }
});
// 当有文件添加进来的时候
uploader.on('fileQueued', function(file) {
    var $li = $(
        '<div id="' + file.id + '" class="file-item thumbnail">' +
        '<img>' +
        '<div class="uploder-container">' +
        '<div  class="cxuploder">' +
        '<div class="queueList">' +
        '<div class="placeholder">' +
        '<div class="filePicker"></div>' +
        '</div>' +
        '<ul class="filelist"></ul>' +
        '</div>' +

        '<div class="statusBar" style="display:none;">' +
        '<div class="btns">' +
        '<div  class="jxfilePicker"></div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<span class="del_img"></span>' +
        '<i class="hintlong"></i>' +
        '<i class="hintshort"></i>' +
        '</div>'
        ),
    $img = $li.find('img');

    // $list为容器jQuery实例
    $("#fileList").append($li);
    //$.getScript('js/cxuploader.js', function() {});
    webuploaderAgain();

    // 创建缩略图
    thumbnailWidth = $(".thumbnail img").Width;
    thumbnailHeight = $(".thumbnail img").Height;
    uploader.makeThumb(file, function(error, ret) {
        if(error) {
            $img.replaceWith('<span>不能预览</span>');
            return;
        }
        $img.attr('src', ret);
    }, thumbnailWidth, thumbnailHeight);

});

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
uploader.on('uploadSuccess', function(file,response) {
//    $('#' + file.id).addClass('upload-state-done');
  alert(response["_raw"])
     $('<input type="hidden" name="img[]" value='+response["_raw"]+' class="'+file.id+' hehe"'+'>').appendTo("#form");
    
});

function webuploaderAgain() {
    var uploader1 = new Array(); //创建 uploader数组
    // 优化retina, 在retina下这个值是2
    var ratio = window.devicePixelRatio || 1,
    // 缩略图大小
    thumbnailWidth = 100 * ratio,
    thumbnailHeight = 100 * ratio,
    supportTransition = (function() {
        var s = document.createElement('p').style,
        r = 'transition' in s ||
        'WebkitTransition' in s ||
        'MozTransition' in s ||
        'msTransition' in s ||
        'OTransition' in s;
        s = null;
        return r;
    })();
    // 所有文件的进度信息，key为file id
    var percentages = {};

    //循环页面中每个上传域
    $('.uploder-container').each(function(index) {

        // 添加的文件数量
        var fileCount = 0;
        // 添加的文件总大小
        var fileSize = 0;

        var filePicker = $(this).find('.filePicker'); //上传按钮实例
        var queueList = $(this).find('.queueList'); //拖拽容器实例
        var jxfilePicker = $(this).find('.jxfilePicker'); //继续添加按钮实例
        var placeholder = $(this).find('.placeholder'); //按钮与虚线框实例
        var statusBar = $(this).find('.statusBar'); //再次添加按钮容器实例
        var info = statusBar.find('.info'); //提示信息容器实例

        // 图片容器       	
        var queue = $(this).find(".filelist");

        //初始化上传实例
        uploader1[index] = WebUploader.create({
            pick: {
                id: filePicker,
                label: '',
                multiple: false
            },
            dnd: queueList,

            //这里可以根据 index 或者其他，使用变量形式
            accept: {
                title: 'Images',
                extensions: 'jpg,jpeg,bmp,png',
                mimeTypes: 'image/jpg,image/jpeg,image/png,image/bmp'
            },

            // swf文件路径
            swf:window.server+'/js/webuploader/Uploader.swf',

            disableGlobalDnd: true, //禁用浏览器的拖拽功能，否则图片会被浏览器打开

            chunked: false, //是否分片处理大文件的上传

            server:  window.server, //上传地址

            fileNumLimit: 30, //一次最多上传文件个数

            fileSizeLimit: 20 * 1024 * 1024, // 总共的最大限制20M

            fileSingleSizeLimit: 2 * 1024 * 1024, // 单文件的最大限制3M

            auto: true,

            duplicate: true, //允许重复上传

            formData: {
                token: index //可以在这里附加控件编号，从而区分是哪个控件上传的
            }
        });

        // 添加“添加文件”的按钮
        uploader1[index].addButton({
            id: jxfilePicker,
            label: '',
            multiple: false
        });

        //当文件加入队列时触发	uploader[0].upload();
        uploader1[index].onFileQueued = function(file) {
            fileCount++;
            fileSize += file.size;

            if(fileCount === 1) {
                placeholder.addClass('element-invisible');
                statusBar.show();
            }

            //#fileList下边的图数量超出1，就删掉第一张
            if(queue.find("li").length > 0) {
                queue.find("li").eq(0).remove();
            }

            addFile(file, uploader1[index], queue);

        };

        uploader1[index].on('uploadSuccess', function(file, response) {
            alert(response["_raw"])
            $("."+window.file_id).after('<input type="hidden" name="img[]" value='+response["_raw"]+' class="'+file.id+' hehe"'+'>')
            $("#"+window.file_id).attr('id',file.id)
            var $li = $('.'+window.file_id);
            $li.remove();
          
            // $('<input type="hidden" name="img[]" value='+response["_raw"]+' class="'+file.id+' hehe"'+'>').after("."+window.file_id);
            console.log(window.file_id)
        });
    });

    // 当有文件添加进来时执行，负责view的创建
    function addFile(file, now_uploader, queue) {
        var $li = $('<li id="' + file.id + '">' +
            '<p class="imgWrap"></p>' +
            '</li>'),

        $wrap = $li.find('p.imgWrap');

        $wrap.text('预览中');
        if(file.flog == true) {
            var img = $('<img src="' + file.ret + '">');

            $wrap.empty().append(img);
        } else {
            now_uploader.makeThumb(file, function(error, ret) {
                if(error) {
                    $wrap.text('不能预览');
                    return;
                }
                var img = $('<img src="' + ret + '">');
                $wrap.empty().append(img);
            }, thumbnailWidth, thumbnailHeight);
        }

        percentages[file.id] = [file.size, 0];
        file.rotation = 0;

        $li.appendTo(queue);
    };
}

//重新上传/删除
$(document).on("mouseenter", ".filePicker label", function() {
    $(this).parents(".file-item").find(".hintlong").show();
})
$(document).on("mouseleave", ".filePicker label", function() {
    $(this).parents(".file-item").find(".hintlong").hide();
})
$(document).on("mouseenter", ".jxfilePicker label", function() {
    $(this).parents(".file-item").find(".hintlong").show();
})
$(document).on("mouseleave", ".jxfilePicker label", function() {
    $(this).parents(".file-item").find(".hintlong").hide();
})
$(document).on("mouseenter", ".del_img", function() {
    $(this).parents(".file-item").find(".hintshort").show();
})
$(document).on("mouseleave", ".del_img", function() {
    $(this).parents(".file-item").find(".hintshort").hide();
})

//删除图片
$(document).on("click", ".del_img", function() {
    $(this).parent(".file-item").remove();
})

////保存
//$(".img_save").click(function() {
//    if($("#fileList>.file-item").length > 10) {
//        layer.msg("最多上传十张图片");
//        return false;
//    }
//})