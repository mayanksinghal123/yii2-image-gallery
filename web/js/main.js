/**
 * Created by OWNER on 30-11-2017.
 */
function uploadImageData(options){
    console.log("dims");
    console.log(options.select);
    defaultSelect=options.select;
    console.log("dims end");
    /*-------set more options------*/
    options.loadButtonText={
        load:"Load more",
        no_load:"No more data"
    };
    options.id="#image_gallery";
    options.API_KEY = '7214500-e1add1b17a42cc9b81113484b';
    options.load_more_button='<div id="pixabay_load_before" style="height: auto;width: 100%;float: left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;text-align: center;padding-top: 10px;">' +
        '<button id="pixabay_load_before_button" onclick="loadMoreData(this)" type="button" class="" style="border:1px #6a7785 solid;background-color: #e5e9f4;padding: 10px 40px 10px 40px;border-radius: 30px;color: #6a7785;">Load more</button>'+
        '</div>';
    options.curr_page=1;
    options.URL;
    options.categoryArray=['All', 'Fashion', 'Nature', 'Backgrounds', 'Science', 'Education', 'People', 'Feelings', 'Religion', 'Health', 'Places', 'Animals', 'Industry', 'Food', 'Computer', 'Sports', 'Transportation', 'Travel', 'Buildings', 'Business', 'Music'];
    options.categoryArrayVal=['all','fashion', 'nature', 'backgrounds', 'science', 'education', 'people', 'feelings', 'religion', 'health', 'places', 'animals', 'industry', 'food', 'computer', 'sports', 'transportation', 'travel', 'buildings', 'business', 'music'];


    options.mediaArray=['All images', 'Photos','Vector graphics','Illustrations'];
    options.mediaArrayVal=["all", "photo",  "vector","illustration"];

    options.orientationArray=['All','Horizontal','Vertical'];
    options.orientationArrayVal=['all','horizontal','vertical'];

    options.orderArray=['Popular','Latest'];
    options.orderArrayVal=['popular','latest'];

    options.filterData={
        category:options.categoryArrayVal[0],
        media:options.mediaArrayVal[0],
        orientation:options.orientationArrayVal[0],
        order:options.orderArrayVal[0]
    };
    options.imageChoose=null;
    options.defaultSelect=options.select;
    /*------end more options-----*/
    options.styleComp={
        div_in:'image-kit-input',
        div_out:'image-kit-item done',
        span_in:'glyphicon glyphicon-plus-sign add',
        span_out:'glyphicon glyphicon-remove-circle remove',
    };
    options.iframeId="iframe_iframe";
    options.pixabayHtmlData=$("<div/>").html(options.pixabayHtmlData).text();
    options.contDivId="1233456_handy_image_gallery_cont_10102390_9088989";
    options.contDivImaeGalleryId="657781_handy_image_gallery_cont_1190_56661_222";
    options.inputClass="6334341_handy_image_gallery_cont_rrr_44_564er_222";
    options.inputClass_2="34fg78941_handy_image_gallery_cont_dddr_44_564er_22s3_902";
    options.div_1="3098821_handy_image_gallery_cont_dddr_44_5rt5667_22s3_5672";
    options.visibleImage="visible";
    var methods = {
        defaultSelect:null,
        init: function(){
            this.defaultSelect=options.select;
            if(options.values==null){
//options.url=0;
                options.newItem=true;
                options.visibleImage="hidden";
            }else{
                if(options.values instanceof Object){
                    options.values.src=options.values.base_url+"/"+options.values.path;
                }else{
                    options.values.src=options.values;
                }

                options.newItem=false;
                options.visibleImage="visible";
                //options.url=options.base_url+"/"+options.path;
            }

            methods.addItem();
        },
        addItem:function(){
            var style="width:"+options.dims.width+"px !important;"+"height:"+options.dims.height+"px !important;";
            var imgStyle="width:100% !important;"+"max-width:"+options.dims.width+"px !important;"+"height:100% !important; border-radius:7px;"+" visibility: "+options.visibleImage;
            var name = options.name;
            var div_class;
            var span_class;
            if(options.newItem){
                div_class=options.styleComp.div_in;
                span_class=options.styleComp.span_in;
            }else{
                div_class=options.styleComp.div_out;
                span_class=options.styleComp.span_out;
            }
            var item = $('<div>', {"class":div_class,"style":style,"id":options.div_1})
                .append($('<img>', {"src":options.newItem?null:options.values.src,"style":imgStyle}))
                .append($('<input/>', {"class":options.inputClass_2,"name": name , "value": options.newItem?null:options.values.src, "type":"hidden"}))
                .append($('<input/>', {"class":options.inputClass,"name": name + '[path]', "value": options.newItem?null:options.values.path, "type":"hidden"}))
                .append($('<input/>', {"class":options.inputClass,"name": name + '[name]', "value": options.newItem?null:options.values.name, "type":"hidden"}))
                .append($('<input/>', {"class":options.inputClass,"name": name + '[size]', "value": options.newItem?null:options.values.size, "type":"hidden"}))
                .append($('<input/>', {"class":options.inputClass,"name": name + '[type]', "value": options.newItem?null:options.values.type, "type":"hidden"}))
                .append($('<input/>', {"class":options.inputClass,"name": name + '[order]', "value": options.newItem?null:options.values.order, "type":"hidden", "data-role": "order"}))
                .append($('<input/>', {"class":options.inputClass,"name": name + '[base_url]', "value": options.newItem?null:options.values.base_url, "type":"hidden"}))
                .append($('<span/>', {"class": span_class}));
            $("#"+options.cont_id+ " #piaxabay_img_container").append(item);
            $(item).on("click",function(){
                //alert(options.select);
                 methods.checkToStartImageGallery();
            })
        },
        checkToStartImageGallery:function(){
            if(options.newItem){
                methods.startImageGallery();
            }else{
                methods.unSetImage();
            }
        },
        startImageGallery:function(){
            $( "body" ).wrapInner( "<div id='"+options.contDivId+"' style='display: none'></div>");
            var iframe = $('<iframe>',{"id":options.iframeId,"style":"width:100%;,height:1000px;"}).appendTo('body');
            $("#iframe_iframe").contents().find('body').html(options.pixabayHtmlData);

            parent.pixabayDesign().onWindowResize();
            pixabayDesign().init(this,options);

        },
        onUseImage:function(obj){
            options.remoteUrl=$(obj).attr('src');
            methods.action();
        },
        closeImageGallery:function(){
            $('div#'+options.contDivId).contents().unwrap();
            $('#'+options.iframeId).remove();
        },
        setImageVisibility:function(view){
            $("#"+options.cont_id+ " img").css('visibility',view);
        },
        setImage:function(data){
            // get input names
            for(var key in data){
                var name = options.name + '['+key+']';
                if(key==="url"){
                    $("#"+options.cont_id +" input[name='"+options.name+"']" ).val(data[key]);
                }else{
                    $("#"+options.cont_id +" input[name='"+name+"']" ).val(data[key]);
                }
            }
            $("#"+options.cont_id+ " img").attr("src",data.url);
            methods.setImageVisibility('visible');
            options.newItem=false;
            methods.changeDivView();
            window[options.function_name]($("#"+options.cont_id+ " img"));
        },
        unSetImage:function(path){
            $("#"+options.cont_id+" ."+options.inputClass).val("");
            $("#"+options.cont_id+" ."+options.inputClass_2).val("");

            //$("#"+options.cont_id+" #"+options.id).val("");


             $("#"+options.cont_id+ " img").removeAttr("src");
            methods.setImageVisibility('hidden');
            options.newItem=true;
            methods.undoDivView();
        },
        changeDivView:function(){
            $("#"+options.cont_id+ " #"+options.div_1).attr("class",options.styleComp.div_out);
            $("#"+options.cont_id+ " #"+options.div_1).find("span").attr("class",options.styleComp.span_out);
        },
        undoDivView:function(){
            $("#"+options.cont_id+ " #"+options.div_1).attr("class",options.styleComp.div_in);
            $("#"+options.cont_id+ " #"+options.div_1).find("span").attr("class",options.styleComp.span_in);
        },
        action:function(){
            $.ajax({
                "type": "POST",
                "data":{"remoteUrl":options.remoteUrl},
                "dataType":"JSON",
                "url": options.url,
                 "success": function (data) {
                     var obj = $.parseJSON(data);
                     console.log(obj);
                   if(obj.status==1){
                       methods.setImage(obj.data);
                       methods.closeImageGallery();
                   }
            }
        });
        },
        pixabayFunctions:{

        }
    }
    /*methods.init.apply(this);*/
    methods.init.apply(this);
}

/*------Pixabay functions------*/
var loadButtonText;
var id;
var API_KEY ;
var load_more_button;
var curr_page;
var URL;
var categoryArray;
var categoryArrayVal;
var mediaArray;
var mediaArrayVal;
var orientationArray;
var orientationArrayVal;
var orderArray;
var orderArrayVal;
var filterData;
var imageChoose;
var defaultSelect;
var searchQuery;
var oldObj;
var catIndex,mediaIndex,orientationIndex,orderIndex,query;
function pixabayDesign(){
    var methods={
        oldObj:null,
        initiatePixabayVariables:function(){
            //alert(defaultSelect);

            if(defaultSelect==0){
                catIndex=0;
                mediaIndex=0;
                orientationIndex=0;
                orderIndex=0;
                query=-1;
            }else{
                catIndex=this.returnTrueIndex($.inArray(defaultSelect.category,categoryArrayVal));
                mediaIndex=this.returnTrueIndex($.inArray(defaultSelect.media,mediaArrayVal));
                orientationIndex=this.returnTrueIndex($.inArray(defaultSelect.orientation,orientationArrayVal));
                orderIndex=this.returnTrueIndex($.inArray(defaultSelect.order,orderArrayVal));
                if(typeof defaultSelect.query != 'undefined'){
                    query=defaultSelect.query;
                }
            }
            filterData.category=categoryArrayVal[catIndex];
            filterData.media=mediaArrayVal[mediaIndex];
            filterData.orientation=orientationArrayVal[orientationIndex];
            filterData.order=orderArrayVal[orderIndex];
            searchQuery=query;

            parent.pixabayDesign().setButtonImageData(mediaIndex);
        },
        returnTrueIndex:function(val){
            if(val==-1){
                return 0;
            }
            return val;
        },
        onWindowResize:function(){
            windowHeight = $(window).innerHeight();
            $("#iframe_iframe").css("height",windowHeight+"px");

        },
        setAllVariables:function(options){
            loadButtonText=options.loadButtonText;
            id=options.id;
            API_KEY = options.API_KEY;
            load_more_button=options.load_more_button;
            curr_page=options.curr_page;
            URL=options.URL;
            categoryArray=options.categoryArray;
            categoryArrayVal=options.categoryArrayVal;

            mediaArray=options.mediaArray;
            mediaArrayVal=options.mediaArrayVal;

            orientationArray=options.orientationArray;
            orientationArrayVal=options.orientationArrayVal;

            orderArray=options.orderArray;
            orderArrayVal=options.orderArrayVal;

            filterData=options.filterData;
            imageChoose=options.imageChoose;
            defaultSelect=options.defaultSelect;
        },
        init:function(that,options){
            oldObj=that;
            this.setAllVariables(options);
            for(var i in categoryArray){
                $("#iframe_iframe").contents().find('#category-options').append($('<option>', {
                    value: categoryArray[i],
                    text : categoryArray[i],
                    id : categoryArrayVal[i],
                }));
            }
            // set media values
            for(var i in mediaArray){
                //alert($('#media-options').length);
                $("#iframe_iframe").contents().find('#media-options').append('<div class="radio">' + '<label><input id="'+mediaArrayVal[i]+'" type="radio" name="mediaType" onclick="parent.pixabayDesign().getMedia(this)" value="'+mediaArrayVal[i]+'">'+mediaArray[i]+'</label>' +'</div>');
            }

            // set orientation values
            for(var i in orientationArray){
                $("#iframe_iframe").contents().find('#orientation-options').append('<div class="radio">' + '<label><input id="'+orientationArrayVal[i]+'" type="radio" name="orientationType" onclick="parent.pixabayDesign().getOrientation(this)" value="'+orientationArrayVal[i]+'">'+orientationArray[i]+'</label>' +'</div>');
            }

            // set order values
            for(var i in orderArray){
                $("#iframe_iframe").contents().find('#order-options').append('<div class="radio">' + '<label><input id="'+orderArrayVal[i]+'" type="radio" name="orderType" onclick="parent.pixabayDesign().getOrder(this)" value="'+orderArrayVal[i]+'">'+orderArray[i]+'</label>' +'</div>');
            }



            $("#iframe_iframe").contents().find('#pixabay-filter').on('shown.bs.popover', function () {
                $("#iframe_iframe").contents().find("#pixabay-filter-html #media-options").find("#"+filterData.media).attr("checked","checked");
                $("#iframe_iframe").contents().find("#pixabay-filter-html #category-options").find("#"+filterData.category).attr("selected","selected");
                $("#iframe_iframe").contents().find("#pixabay-filter-html #orientation-options").find("#"+filterData.orientation).attr("checked","checked");
                $("#iframe_iframe").contents().find("#pixabay-filter-html #order-options").find("#"+filterData.order).attr("checked","checked");
                $("#iframe_iframe").contents().find(".popover-content").html($("#iframe_iframe").contents().find("#pixabay-filter-html").html());
            });
            $("#iframe_iframe").contents().find('body').on('click', function (e) {
                //console.log(e.target);
                //did not click a popover toggle or popover
                if ($(e.target).data('toggle') !== 'popover'
                    && $(e.target).parents('.popover.in').length === 0) {
                    $("#iframe_iframe").contents().find('[data-toggle="popover"]').popover('hide');
                }
            });
            $("#iframe_iframe").contents().find('#pixabay-filter').popover({
                html:true,
                title:"Filters",
                content:$("#iframe_iframe").contents().find("#pixabay-filter-html").html()

            });
            $("#iframe_iframe").contents().find('#pixabay-filter').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState.click = false;
            });
            parent.pixabayDesign().setButtonImageData(0);

            parent.pixabayDesign().onSearchStart.setImages(true);
        },
        getMedia:function(obj){
            var index=mediaArrayVal.indexOf($(obj).val());
            filterData.media=$(obj).val();
            parent.pixabayDesign().setButtonImageData(index);
        },
        getCategory:function(obj){
            var index=categoryArray.indexOf($(obj).val());
            filterData.category=categoryArrayVal[index];
        },
        getOrientation:function(obj){
            filterData.orientation=$(obj).val();
        },
        getOrder:function(obj){
            filterData.order=$(obj).val();
        },
        setButtonImageData:function(index){
            $("#iframe_iframe").contents().find("#pixabay-filter").html(mediaArray[index]+" <span class=\"caret\" style=\"color: #777;position: unset;\"></span>");
        },

        onSearchStart:{
            searchIt:function(){
                var val=$("#iframe_iframe").contents().find("#search_data_pixabay").val();
                searchQuery=val;
                parent.pixabayDesign().onSearchStart.setImages(false);
                return false;
            },
            setImages:function(initiate){
                if(initiate){
                    parent.pixabayDesign().initiatePixabayVariables();
                }

                imageChoose=null;
                parent.pixabayDesign().onSearchStart.resetImageFound();
                parent.pixabayDesign().onSearchStart.enableLoadMoreButton();
                curr_page=1;
                var urlParam="&image_type="+filterData.media+"&category="+filterData.category+"&orientation="+filterData.orientation+"&order="+filterData.order+"&safesearch=true";
                URL = "https://pixabay.com/api/?key="+API_KEY+"&q="+encodeURIComponent(searchQuery)+urlParam;
                /*if(query==-1){
                    URL = "https://pixabay.com/api/?key="+API_KEY+urlParam;
                }else{
                    URL = "https://pixabay.com/api/?key="+API_KEY+"&q="+encodeURIComponent(searchQuery)+urlParam;
                }*/
                var newUrl=URL+"&page="+curr_page;
                $.getJSON(newUrl, function(data){
                    data.loadMoreButton=load_more_button;
                    console.log("log data first");
                    console.log(data);
                    if (parseInt(data.totalHits) > 0){
                        if(data!=null){
                            $("#iframe_iframe").contents().find(id).html("");
                            $.each(data.hits, function(i, hit){
                                console.log(hit);
                                // alert(hit.id);
                                $("#iframe_iframe").contents().find(id).append('<a><img onclick=parent.pixabayDesign().onSearchStart.imageClick(this) id="image_bg_'+hit.id+'" src="'+hit.webformatURL+'"><span><i class="fa fa-check"></i></span></a>');
                            });

                            $("#iframe_iframe").contents().find("#load_more_bt").removeClass('hide_gallery');
                        }
                    }
                    else{
                        parent.pixabayDesign().onSearchStart.noImageFound();
                    }

                    console.log('No hits');
                }).success(function(){
                    parent.pixabayDesign().onSearchStart.scrollDownContent();
                })
                    .error(function(){
                        parent.pixabayDesign().onSearchStart.disableLoadMoreButton();
                    })
                    .complete(function(){});
            },
            resetImageFound:function(){
                $("#iframe_iframe").contents().find(id).html("");
                $("#iframe_iframe").contents().find("#image_gallery_no_image").addClass('hide_gallery');
                $("#iframe_iframe").contents().find("#image_gallery").removeClass('hide_gallery');
                $("#iframe_iframe").contents().find("#load_more_bt").addClass('hide_gallery');
            },
            noImageFound:function(){
                $("#iframe_iframe").contents().find(id).html("");
                $("#iframe_iframe").contents().find("#image_gallery_no_image").removeClass('hide_gallery');
                $("#iframe_iframe").contents().find("#image_gallery").addClass('hide_gallery');
                $("#iframe_iframe").contents().find("#load_more_bt").addClass('hide_gallery');
            },
            loadMoreData:function (obj) {
                if($(obj).hasClass('no_load')){
                    return false;
                }
                curr_page++;
                var newUrl=URL+"&page="+curr_page;
                $.getJSON(newUrl, function(data){
                    console.log("log data");
                    console.log(data);
                    if (parseInt(data.totalHits) > 0){
                        //$(obj).removeAttr('disabled');
                        $.each(data.hits, function(i, hit){
                            console.log(hit);
                            $("#iframe_iframe").contents().find(id).append('<a><img onclick=parent.pixabayDesign().onSearchStart.imageClick(this) id="image_bg_'+hit.id+'" src="'+hit.webformatURL+'"><span><i class="fa fa-check"></i></span></a>');
                        });
                    }
                    else{
                        //$(obj).removeAttr('disabled');
                        parent.pixabayDesign().onSearchStart.disableLoadMoreButton();
                        console.log('No hits');
                    }

                }).success(function(){
                    //alert($("#iframe_iframe").contents().find('.auto_scroll').height());
                    parent.pixabayDesign().onSearchStart.scrollDownContent();
                })
                    .error(function(){
                        //$(obj).removeAttr('disabled');
                        parent.pixabayDesign().onSearchStart.disableLoadMoreButton();
                    })
                    .complete(function(){});


                //alert($("#iframe_iframe").contents().find('html, body'));
            },
            scrollDownContent:function(){
                $("#iframe_iframe").contents().find('html, body').animate({
                    scrollTop: $("#iframe_iframe").contents().find('.auto_scroll').height()+100
                },1000);
            },
            disableLoadMoreButton:function(){
                $("#iframe_iframe").contents().find("#pixabay_load_before_button").addClass('no_load');
                $("#iframe_iframe").contents().find("#pixabay_load_before_button").text(loadButtonText.no_load);
            },
            enableLoadMoreButton:function(){
                $("#iframe_iframe").contents().find("#pixabay_load_before_button").removeClass('no_load');
                $("#iframe_iframe").contents().find("#pixabay_load_before_button").text(loadButtonText.load);
            },
            imageClick:function(obj){
                $(obj).parents('.flexbin').find('a').removeClass("active");
                $(obj).parent().addClass("active");
                imageChoose=obj;
            },
            useImage:function(){
                oldObj.onUseImage(imageChoose);
                //alert(imageChoose);
            },
            cancelImage:function(){
                oldObj.closeImageGallery();
            }

        }
    };
    return methods;
}

$(window).resize(function() {
    parent.pixabayDesign().onWindowResize();
});
