<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
    body{
        text-align: center;
    }
    button:focus{
        border: 0 !important;
    }
        .grid-filter-new li{
            float: none !important;
        }
        .popover-content{
            width: 100% !important;
        }
        .popover{
            /*width: 100% !important;
            max-width: 350px;*/
            width: 350px; !important;
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
<!--image gallery css below-->
<style>
    .flexbin {
        display: flex;
        overflow: hidden;
        flex-wrap: wrap;
        margin: -2.5px; }
    .flexbin:after {
        content: '';
        flex-grow: 999999999;
        min-width: 300px;
        height: 0; }
    .flexbin > * {
        position: relative;
        display: block;
        height: 218px;
        margin: 2.5px;
        flex-grow: 1; }
    .flexbin > * > img {
        height: 218px;
        object-fit: cover;
        max-width: 100%;
        min-width: 100%;
        vertical-align: bottom; }
    .flexbin.flexbin-margin {
        margin: 2.5px; }
    @media (max-width: 980px) {
        .flexbin {
            display: flex;
            overflow: hidden;
            flex-wrap: wrap;
            margin: -2.5px; }
        .flexbin:after {
            content: '';
            flex-grow: 999999999;
            min-width: 150px;
            height: 0; }
        .flexbin > * {
            position: relative;
            display: block;
            height: 150px;
            margin: 2.5px;
            flex-grow: 1; }
        .flexbin > * > img {
            height: 150px;
            object-fit: cover;
            max-width: 100%;
            min-width: 100%;
            vertical-align: bottom; }
        .flexbin.flexbin-margin {
            margin: 2.5px; } }
    @media (max-width: 400px) {
        .flexbin {
            display: flex;
            overflow: hidden;
            flex-wrap: wrap;
            margin: -2.5px; }
        .flexbin:after {
            content: '';
            flex-grow: 999999999;
            min-width: 100px;
            height: 0; }
        .flexbin > * {
            position: relative;
            display: block;
            height: 100px;
            margin: 2.5px;
            flex-grow: 1; }
        .flexbin > * > img {
            height: 100px;
            object-fit: cover;
            max-width: 100%;
            min-width: 100%;
            vertical-align: bottom; }
        .flexbin.flexbin-margin {
            margin: 2.5px; } }
    *, *:after, *:before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .flexbin a span{
        display: none;
    }
    .flexbin a{
        cursor: pointer;
    }
    .flexbin a.active span{
        width: 100%;
        position: absolute;
        background-color: green;
        opacity: .7;
        height: 100%;
        bottom: 0px;
        top: 0px;
        text-align: center;
        display: flex;
        align-items: center;
        cursor: context-menu;
    }
    .flexbin a.active span i{
        margin-left: 47%;
        font-size: 34px;
        color: white;
    }
    .affix {
        top: 0;
        width: 100%;
        z-index: 9999 !important;
    }
</style>
<div class="" id="pixabay_image_gallery">
    <div class="row">
        <div class="col-md-12" style="background: white; position: fixed; z-index:999;">
            <form onsubmit="return parent.pixabayDesign().onSearchStart.searchIt()">
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
                        <button onclick="parent.pixabayDesign().onSearchStart.useImage()" type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-check"></i></button>
                        <button onclick="parent.pixabayDesign().onSearchStart.cancelImage()" type="button" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-remove"></i></button>
                    </div>

                </div>
            </form>
        </div>
        <div class="col-md-12 auto_scroll" style="padding-top: 100px;">
            <div class="rows">
                <div class="col-md-12">
                    <div class="flexbin flexbin-margin" id="image_gallery">

                    </div>
                    <div class="hide_gallery" id="image_gallery_no_image">
                        <img src="https://app.contaqt.marketing/img/noimage.jpeg">
                    </div>
                </div>
                <div class="col-md-12 hide_gallery" id="load_more_bt" style="padding: 10px;">
                    <div id="pixabay_load_before" style="height: auto;width: 100%;float: left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;text-align: center;padding-top: 10px;">
                        <button id="pixabay_load_before_button" onclick="parent.pixabayDesign().onSearchStart.loadMoreData(this)" type="button" class="" style="border:1px #6a7785 solid;background-color: #e5e9f4;padding: 10px 40px 10px 40px;border-radius: 30px;color: #6a7785;">Load more</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--show image gallery-->

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
                <select style="width: 100%" id="category-options" onchange="parent.pixabayDesign().getCategory(this)"></select>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        parent.pixabayDesign().onSearchStart.setImages(-1);
    })
    var bootstrap3_enabled = (typeof $().emulateTransitionEnd == 'function');
</script>