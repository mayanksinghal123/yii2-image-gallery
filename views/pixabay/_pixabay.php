<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script>
    function nr(){
        alert("sss");
    }
   var iframeObj=$("#iframe_iframe").contents().find('body');
</script>
<style>
        .grid-filter-new li{
            float: none !important;
        }
        .popover-content{
            width: 100% !important;
        }
        .popover{
            width: 100% !important;
            max-width: 350px;
        }
        .custom-mrg{
            margin-top: 10px;
            font-weight: bold;
        }
        .custom-mrg-1{
            font-weight: bold;
        }
        .custom-button{
            color: #777;
            background: #f3f3f3;
            border-left: none;
            border-left-color: white;
            border-radius: 0;
            margin-left: -1px;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
        }
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            font-size: 24px;
            line-height: 1.33;
            border-radius: 35px;
        }
        .hide_gallery{
            display: none;
        }
        .show_gallery{
            display: none;
        }
    </style>
<div class="container" id="pixabay_image_gallery">
    <div class="row">
        <div class="col-md-12">
            <form onsubmit="return searchIt()">
                <div class="row" style="padding: 10px;    display: flex;flex-wrap: wrap;">

                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 " style="display: flex;align-items: center;justify-content: center;">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." id="search_data_pixabay">
                            <span class="input-group-btn">
        <button id="pixabay-filter" type="button" class="btn btn-default custom-button" data-toggle="popover" data-placement="bottom">Images
</button>
      </span>
                            <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Search</i></button>
      </span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <button onclick="useImage()" type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-check"></i></button>
                        <button onclick="cancelImage()" type="button" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-remove"></i></button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!--show image gallery-->
    <div class="row">
        <div class="col-md-12">
            <div class="flexbin flexbin-margin" id="image_gallery">

            </div>
            <div class="hide_gallery" id="image_gallery_no_image">
                <img src="https://app.contaqt.marketing/img/noimage.jpeg">
            </div>
        </div>
        <div class="col-md-12 hide_gallery" id="load_more_bt" style="padding: 10px;">
            <div id="pixabay_load_before" style="height: auto;width: 100%;float: left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;text-align: center;padding-top: 10px;">
                <button id="pixabay_load_before_button" onclick="loadMoreData(this)" type="button" class="" style="border:1px #6a7785 solid;background-color: #e5e9f4;padding: 10px 40px 10px 40px;border-radius: 30px;color: #6a7785;">Load more</button>
            </div>
        </div>
    </div>
</div>
<div style="position: absolute; left:-1000px;" id="pixabay-filter-html">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-4 custom-mrg">
                <span>Media type</span>
            </div>
            <div class="col-md-8" id="media-options">

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4 custom-mrg">
                <span>Orientation</span>
            </div>
            <div class="col-md-8" id="orientation-options">

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4 custom-mrg">
                <span>Order</span>
            </div>
            <div class="col-md-8" id="order-options">

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4 custom-mrg-1">
                <span>Category</span>
            </div>
            <div class="col-md-8">
                <select style="width: 100%" id="category-options" onchange="getCategory(this)"></select>
            </div>

        </div>
    </div>
</div>
<script>
    var API_KEY = '7214500-e1add1b17a42cc9b81113484b';
    var load_more_button='<div id="pixabay_load_before" style="height: auto;width: 100%;float: left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;text-align: center;padding-top: 10px;">' +
        '<button id="pixabay_load_before_button" onclick="loadMoreData(this)" type="button" class="" style="border:1px #6a7785 solid;background-color: #e5e9f4;padding: 10px 40px 10px 40px;border-radius: 30px;color: #6a7785;">Load more</button>'+
        '</div>';
    var curr_page=1;
    var URL;
    var categoryArray=['All', 'Fashion', 'Nature', 'Backgrounds', 'Science', 'Education', 'People', 'Feelings', 'Religion', 'Health', 'Places', 'Animals', 'Industry', 'Food', 'Computer', 'Sports', 'Transportation', 'Travel', 'Buildings', 'Business', 'Music'];
    var categoryArrayVal=['all','fashion', 'nature', 'backgrounds', 'science', 'education', 'people', 'feelings', 'religion', 'health', 'places', 'animals', 'industry', 'food', 'computer', 'sports', 'transportation', 'travel', 'buildings', 'business', 'music'];


    var mediaArray=['All images', 'Photos','Vector graphics','Illustrations'];
    var mediaArrayVal=["all", "photo",  "vector","illustration"];

    var orientationArray=['All','Horizontal','Vertical'];
    var orientationArrayVal=['all','horizontal','vertical'];

    var orderArray=['Popular','Latest'];
    var orderArrayVal=['popular','latest'];

    var filterData={
        category:categoryArrayVal[0],
        media:mediaArrayVal[0],
        orientation:orientationArrayVal[0],
        order:orderArrayVal[0]
    };
    //alert($(iframeObj).find("#media-options").get(0).id);
    //alert(document.getElementById('iframe_iframe').contentWindow.document.getElementById("media-options"));
    $(document).ready(function(){
        // set category type values
        for(var i in categoryArray){
            $('#category-options').append($('<option>', {
                value: categoryArray[i],
                text : categoryArray[i],
                id : categoryArrayVal[i],
            }));
        }

        // set media values
        for(var i in mediaArray){
            //alert($('#media-options').length);
            $('#media-options').append('<div class="radio">' + '<label><input id="'+mediaArrayVal[i]+'" type="radio" name="mediaType" onclick="getMedia(this)" value="'+mediaArrayVal[i]+'">'+mediaArray[i]+'</label>' +'</div>');
        }

        // set orientation values
        for(var i in orientationArray){
            $('#orientation-options').append('<div class="radio">' + '<label><input id="'+orientationArrayVal[i]+'" type="radio" name="orientationType" onclick="getOrientation(this)" value="'+orientationArrayVal[i]+'">'+orientationArray[i]+'</label>' +'</div>');
        }

        // set order values
        for(var i in orderArray){
            $('#order-options').append('<div class="radio">' + '<label><input id="'+orderArrayVal[i]+'" type="radio" name="orderType" onclick="getOrder(this)" value="'+orderArrayVal[i]+'">'+orderArray[i]+'</label>' +'</div>');
        }

        $('#pixabay-filter').popover({
            container: 'body',
            html:true,
            title:"Filters",
            content:$("#pixabay-filter-html").html()

        });
        setButtonImageData(0);

    });
    function getMedia(obj){
        var index=mediaArrayVal.indexOf($(obj).val());
        filterData.media=$(obj).val();
        setButtonImageData(index);
    }
    function getCategory(obj){
        var index=categoryArray.indexOf($(obj).val());
        filterData.category=categoryArrayVal[index];
    }

    function getOrientation(obj){
        filterData.orientation=$(obj).val();
    }
    function getOrder(obj){
        filterData.order=$(obj).val();
    }

    $('#pixabay-filter').on('shown.bs.popover', function () {
        $("#pixabay-filter-html #media-options").find("#"+filterData.media).attr("checked","checked");
        $("#pixabay-filter-html #category-options").find("#"+filterData.category).attr("selected","selected");
        $("#pixabay-filter-html #orientation-options").find("#"+filterData.orientation).attr("checked","checked");
        $("#pixabay-filter-html #order-options").find("#"+filterData.order).attr("checked","checked");
        $(".popover-content").html($("#pixabay-filter-html").html());
    });
    $('body').on('click', function (e) {
        //did not click a popover toggle or popover
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) {
            $('[data-toggle="popover"]').popover('hide');
        }
    });
    function setButtonImageData(index){
        $("#pixabay-filter").html(mediaArray[index]+" <span class=\"caret\" style=\"color: #777;position: unset;\"></span>");
    }


</script>
<script>
    setImages(-1);
    var imageChosen=null;
    var id="#image_gallery";
    function searchIt(){
        alert($("#search_data_pixabay").length);
        /*var val=$("#search_data_pixabay").val();
        setImages(val);*/
        return false;
    }
    function setImages(query){
        resetImageFound();
        curr_page=1;
        var urlParam="&image_type="+filterData.media+"&category="+filterData.category+"&orientation="+filterData.orientation+"&order="+filterData.order;

        if(query==-1){
            URL = "https://pixabay.com/api/?key="+API_KEY+urlParam;
        }else{
            URL = "https://pixabay.com/api/?key="+API_KEY+"&q="+encodeURIComponent(query)+urlParam;
        }
        URL=URL+"&page="+curr_page;
        $.getJSON(URL, function(data){
            data.loadMoreButton=load_more_button;
            console.log("log data first");
            console.log(data);
            if (parseInt(data.totalHits) > 0){
                if(data!=null){
                    $(id).html("");
                    $.each(data.hits, function(i, hit){
                        console.log(hit);
                        // alert(hit.id);
                        $(id).append('<a><img onclick=onImageClick(this) id="image_bg_'+hit.id+'" src="'+hit.webformatURL+'"><span><i class="fa fa-check"></i></span></a>');
                    });

                    $("#load_more_bt").removeClass('hide_gallery');
                }
            }
            else{
                noImageFound();
            }

            console.log('No hits');
        }).success(function(){})
            .error(function(){
                disableLoadMoreButton();
            })
            .complete(function(){});
    }
    function loadMoreData(obj){
        $(obj).attr('disabled','true');

        if($(obj).hasClass('no_load')){
            return false;
        }
        curr_page++;
        URL=URL+"&page="+curr_page;
        $.getJSON(URL, function(data){
            console.log("log data");
            console.log(data);
            if (parseInt(data.totalHits) > 0){
                $(obj).removeAttr('disabled');
                $.each(data.hits, function(i, hit){
                    console.log(hit);
                    // alert(hit.id);
                    //$('<a><img onclick=selectImage("image_bg_'+hit.id+'") id="image_bg_'+hit.id+'" src="'+hit.webformatURL+'"><span><i class="fa fa-check"></i></span></a>').insertBefore("#pixabay_load_before");
                    //$('<a><img onclick=onImageClick(this) id="image_bg_'+hit.id+'" src="'+hit.webformatURL+'"><span><i class="fa fa-check"></i></span></a>').insertBefore("#pixabay_load_before");
                    $(id).append('<a><img onclick=onImageClick(this) id="image_bg_'+hit.id+'" src="'+hit.webformatURL+'"><span><i class="fa fa-check"></i></span></a>');
                });
            }
            else{
                $(obj).removeAttr('disabled');
                disableLoadMoreButton();
                console.log('No hits');
            }

        }).success(function(){})
            .error(function(){
                $(obj).removeAttr('disabled');
                disableLoadMoreButton();
            })
            .complete(function(){});
    }
    function disableLoadMoreButton(){
        $("#pixabay_load_before_button").addClass('no_load');
        $("#pixabay_load_before_button").text('No more data');
    }
    function noImageFound(){
        $(id).html("");
        $("#image_gallery_no_image").removeClass('hide_gallery');
        $("#image_gallery").addClass('hide_gallery');
        $("#load_more_bt").addClass('hide_gallery');
    }
    function resetImageFound(){
        $("#image_gallery_no_image").addClass('hide_gallery');
        $("#image_gallery").removeClass('hide_gallery');
        $("#load_more_bt").addClass('hide_gallery');
    }
    function onImageClick(obj){
        imageChosen=obj;
        newCallback.onImageClick(obj);
    }
    function useImage(){
        alert("data");
        newCallback.onUseImage(imageChosen, $("#pixabay_image_gallery"));
    }
    function cancelImage(){
        //newCallback.onCancelImage($("#pixabay_image_gallery"));
        demoH();
    }
</script>
<script>
    var bootstrap3_enabled = (typeof $().emulateTransitionEnd == 'function');
</script>