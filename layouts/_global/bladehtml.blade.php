<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ $uri['media'] }}assets/ico/favicon.ico" />

    <title>@yield('title', 'Vaseman Prototype System')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ $uri['media'] }}css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ $uri['media'] }}css/prototype.css" rel="stylesheet">
    <link href="{{ $uri['media'] }}css/project.css" rel="stylesheet">

    @yield('stylesheet')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ $uri['media'] }}js/jquery.js"></script>
    <script src="{{ $uri['media'] }}js/bootstrap.min.js"></script>

    @yield('script')
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ $uri['base'] }}index.html">{site_name}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {% block nav %}
                <li class="active"><a href="{{ $uri['base'] }}index.html">Home</a></li>
                {% endblock %}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right"><a href="{{ $uri['base'] }}admin/article/index.html">Admin</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div id="main-body">
    @section('body')
        {!! $content !!}
    @show
</div>

<div id="footer">
    @section('footer')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h3>現在只就所謂</h3>
                <p>
                    有相當文化的根據，雖遇有些顛蹶，兄弟們到這樣時候，那人說，似皆出門去了，富豪是先天所賦與，兄弟們到這樣時候，
                    不聲不響地，這一句千古名言，也看得見濃墨一樣高低的樹林，夢寐中也只見得金錢的寶光，這有什麼含義？不曉得順這機會，
                    丙喝一喝茶，一個有年紀的人，保不定不鬧出事來，現時可說比較好些兒，他倆本無分別所行，經過了很久，住在福戶內的人。
                </p>
            </div>
            <div class="col-lg-3">
                <h3>不能成功，再鬧下去</h3>
                <p>
                    完全打消了，身量雖然較高，也沒有走到自由之路的慾望，是道路或非道路，不能不倍加他的工作，
                    明月已漸漸斜向西去，在這樣黑暗之下，去啊！也就分外著急，可不知道那就是培養反抗心的源泉，多亂惱惱地熱鬧著，就一味地吶喊著，
                    愈覺得金錢的寶貴，橋柱是否有傾斜，當科白尼還未出世，再鬧一回亦好。家門有興騰的氣象，濃濃密密把空間充塞著，不是誰都很強硬嗎？
                </p>
            </div>
            <div class="col-lg-3">
                <h3>現在只就所謂</h3>
                <p>
                    有相當文化的根據，雖遇有些顛蹶，兄弟們到這樣時候，那人說，似皆出門去了，富豪是先天所賦與，兄弟們到這樣時候，
                    不聲不響地，這一句千古名言，也看得見濃墨一樣高低的樹林，夢寐中也只見得金錢的寶光，這有什麼含義？不曉得順這機會，
                    丙喝一喝茶，一個有年紀的人，保不定不鬧出事來，現時可說比較好些兒，他倆本無分別所行，經過了很久，住在福戶內的人。
                </p>
            </div>
            <div class="col-lg-3">
                <h3>不能成功，再鬧下去</h3>
                <p>
                    完全打消了，身量雖然較高，也沒有走到自由之路的慾望，是道路或非道路，不能不倍加他的工作，
                    明月已漸漸斜向西去，在這樣黑暗之下，去啊！也就分外著急，可不知道那就是培養反抗心的源泉，多亂惱惱地熱鬧著，就一味地吶喊著，
                    愈覺得金錢的寶貴，橋柱是否有傾斜，當科白尼還未出世，再鬧一回亦好。家門有興騰的氣象，濃濃密密把空間充塞著，不是誰都很強硬嗎？
                </p>
            </div>
        </div>
    </div>
    @show
</div>

<hr />

<div id="copyright">
    @section('copyright')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>
                    Vaseman Copyright &copy;
                </p>
            </div>
        </div>
    </div>
    @show
</div>
</body>
</html>
