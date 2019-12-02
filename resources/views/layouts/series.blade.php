@extends('layouts.main')
@section('keywords', config('home.site.keywords'))
@section('description', config('home.site.description'))

@section('mainStyle')
    @yield('detailStyle')
@endsection


@section('navList')
    @yield('navList')
@endsection

@section('main')
    <section id="content">
        <div class="container">
            <div class="row">

                <div class="left-content col-md-3">
                    <div class="series-page">
                        <div class="series-widget series-description">
                            <a class="description" href="{{ route('series.articles',[ 'C言語学習ノート' ]) }}">
                                C言語学習ノート
                            </a>
                        </div>
                    </div>

                    <div class="series-page">
                        <div class="series-widget series-description">
                            <a class="description" href="{{ route('series.articles',[ 'C++学習ノート' ]) }}">
                                C++学習ノート
                            </a>
                        </div>
                    </div>

                    <div class="series-page">
                        <div class="series-widget series-description">
                            <a class="description" href="{{ route('series.articles',[ 'デザインパターン' ]) }}">
                                デザインパターン
                            </a>
                        </div>
                    </div>

                    <div class="series-page">
                        <div class="series-widget series-description">
                            <a class="description" href="{{ route('series.articles',[ 'BLOGシリーズ' ]) }}">
                                BLOGシリーズ
                            </a>
                        </div>
                    </div>

                </div><!-- left-content -->

                <div class="right-content col-md-9">
                    @yield('content')
                </div><!-- right-content -->

                <a style="display:none" href="javascript:void(0);"  id="backToTop"  title="トップへ"></a>
                {{--<div id="backToTop"><a href="#user-header">トップへ</a></div>--}}

            </div><!-- row -->
        </div><!-- container -->
    </section>
@endsection

@section('script')
    @yield('script')
    @yield('shareScript')
@endsection

@section('userScript')
    <script>

        var series_name = '{{ $series_name }}';
        $(".description").each(function () {
            if( $.trim($(this).text()) == series_name) {
                $(this).css("font-weight", "bold").css("color", "#000");
                var append_content = '<span class="fa fa-chevron-right" style="float: right;"></span>';
                $(this).append(append_content);
                $(this).attr("href", "javascript:void(0);");
            }
        });

        $(document).ready(function () {

        });

    </script>
@endsection
