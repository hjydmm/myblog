@extends('layouts.home')

@section('content')

<div id="articles">
    @foreach($articles as $article)
    <div class="article-list-template">
        <div class="article-time_author clearfix">
            <div id="article-time"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $article->created_at->diffForHumans() }}</div>
            <div id="article-author"><i class="fa fa-user-o"></i>&nbsp;&nbsp;{{ $article->users->user_name }}</div>
        </div>

        <div class="article-title">
            <a href="{{ route('user.articleDetail', [ 'id'=>$article->id ] ) }}">{{ $article->title }}</a>
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
                                    {{--background-color: {{ $article->categories->color_categories }};--}}
                                    <a href="{{ route('category.articles',[ $category ]) }}" id="{{ $category }}" class="category-item"><i class="fa fa-folder"></i>&nbsp;&nbsp;{{ $category }}</a>
                                @endforeach
                            </div>
                            @inject('tagsService', 'App\Services\TagsServiceInterface')
                            <div class="article-tag">
                                @foreach($tagsService->stringToArray(',', $article->tags->str_tags) as $tag)
                                    <a href="{{ route('tag.articles',[ $tag ]) }}" id="{{ $tag }}" class="tag-item" style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-tag"></i>&nbsp;&nbsp;{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="article-more">
                    <div id="see-more">
                        <a href="{{ route('user.articleDetail', [ 'id'=>$article->id ] ) }}">
                            more <span id="between"></span><i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ $articles->links() }}
</div>

@endsection

@section('index_script')
    <script>
        // 只让pagination居中
        $(".pagination").wrap('<div id="pageWrap"></div>');
        $("#pageWrap").css("text-align", "center");
    </script>
@endsection


