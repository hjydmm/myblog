@extends('layouts.home')

@section('content')

    <div id="articles">
        @if(count($articles) != 0)
            @foreach($articles as $article)
                <div class="article-list-template">
                    <div class="article-time_author clearfix">
                        <div id="article-time"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $article->created_at->diffForHumans() }}</div>
                        <div id="article-author"><i class="fa fa-user-o"></i>&nbsp;&nbsp;{{ $article->users->user_name }}</div>
                    </div>

                    <div class="article-title">
                        <a class="render-title" href="{{ route('user.articleDetail', [ 'id'=>$article->id ] ) }}">
                            {{--@if(stristr($article->title, $keyword) != false)--}}
                                {{--{{ substr_replace($article->title, '<span style="background-color: #fbc7c7;border-radius: 4px;">', stristr($article->title, $keyword), 0) }}--}}
                                {{--{{ substr(stristr($article->title, $keyword), 0, strlen(stristr($article->title, $keyword))) }}--}}
                            {{--@endif--}}
                            {{ $article->title }}
                        </a>
                    </div>
                    <div class="article-pic_content clearfix">
                        <div class="article-pic col-md-5">
                            @if($article->pic_name)
                                <img src="{{ url("/assets/images/articles/". $article->pic_name . ".png") }}" class="img-responsive center-block">
                            @else
                                <img src="{{ url("/assets/images/articles/". "default" . ".png") }}" class="img-responsive center-block">
                            @endif
                        </div>
                        <div class="article-content col-md-7">
                            <div id="article-shortcut">
                                <p>
                                    @if(preg_match("/(?<=[p][>]).*(?=[<])/", $article->markdown_content, $result))
                                        {{ str_limit($result[0], 180)  }}
                                    @else
                                        今回は「{{ $article->title }}」をタイトルとして紹介させていただきます。よろしくお願いします。
                                    @endif
                                </p>
                            </div>
                            <div class="article-info-more">

                                <div class="article-info">
                                    <div id="categories_tags">
                                        @inject('categoriesService', 'App\Services\CategoriesServiceInterface')
                                        <div class="article-category">
                                            @foreach($categoriesService->stringToArray(',', $article->categories->str_categories) as $category)
                                                {{--@if(strcasecmp($keyword, $category) == 0)--}}
                                                    {{--<a href="{{ route('category.articles',[ $category ]) }}" id="{{ $category }}" class="category-item" style="background-color: #fbc7c7;padding-left: 4px;padding-right: 4px;border-radius: 4px;"><i class="fa fa-folder"></i>&nbsp;&nbsp;<span class="article-item">{{ $category }}</span></a>--}}
                                                {{--@else--}}
                                                    {{--<a href="{{ route('category.articles',[ $category ]) }}" id="{{ $category }}" class="category-item" style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-folder"></i>&nbsp;&nbsp;<span class="article-item">{{ $category }}</span></a>--}}
                                                {{--@endif--}}
                                                <a href="{{ route('category.articles',[ $category ]) }}" id="{{ $category }}" class="category-item" style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-folder"></i>&nbsp;&nbsp;<span class="article-item">{{ $category }}</span></a>
                                            @endforeach
                                        </div>
                                        @inject('tagsService', 'App\Services\TagsServiceInterface')
                                        <div class="article-tag">
                                            @foreach($tagsService->stringToArray(',', $article->tags->str_tags) as $tag)
                                                {{--@if(strcasecmp($keyword, $tag) == 0)--}}
                                                    {{--<a href="{{ route('tag.articles',[ $tag ]) }}" id="{{ $tag }}" class="tag-item" style="background-color: #fbc7c7;padding-left: 4px;padding-right: 4px;border-radius: 4px;"><i class="fa fa-tag"></i>&nbsp;&nbsp;<span class="article-item">{{ $tag }}</span></a>--}}
                                                {{--@else--}}
                                                    {{--<a href="{{ route('tag.articles',[ $tag ]) }}" id="{{ $tag }}" class="tag-item" style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-tag"></i>&nbsp;&nbsp;<span class="article-item">{{ $tag }}</span></a>--}}
                                                {{--@endif--}}
                                                <a href="{{ route('tag.articles',[ $tag ]) }}" id="{{ $tag }}" class="tag-item" style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-tag"></i>&nbsp;&nbsp;<span class="article-item">{{ $tag }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="article-more">
                                <div id="see-more">
                                    <a href="{{ route('user.articleDetail', [ 'id'=>$article->id ] ) }}">
                                        more <span>&nbsp; > </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $articles->links() }}
        @else
            <div class="no-article-list-template">
                <span>
                    「 {{ $keyword }} 」の検索結果がありません
                </span>
            </div>
        @endif
    </div>

@endsection

@section('index_script')
    <script>

        // 只让pagination居中
        $(".pagination").wrap('<div id="pageWrap"></div>');
        $("#pageWrap").css("text-align", "center");

        $(document).ready(function () {
            var title_keyword = "{{ $keyword }}";
            $(".render-title").each(function () {
                var title_content = $(this).text();
                var reg = new RegExp(title_keyword, 'gi');
                title_content = title_content.replace(reg, function (replace_content) {
                    return replace_content.fontcolor("#fb7d52");
                });
                $(this).html(title_content);
            });

            var article_tag_category = "{{ $keyword }}";
            $(".article-item").each(function () {
                var article_item = $(this).text();
                var reg = new RegExp(article_tag_category, 'gi');
                article_item = article_item.replace(reg, function (replace_content) {
                    return replace_content.fontcolor("#fb100e");  //#fb7d52
                });
                $(this).html(article_item);
            });

        });

    </script>
@endsection



