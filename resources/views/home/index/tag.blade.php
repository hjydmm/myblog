@extends('layouts.home')
@section('title', config('home.site.title'))
@section('keywords', config('home.site.keywords'))
@section('description', config('home.site.description'))


@section('content')

    <div id="articles">
        @foreach($tagArticleList as $tagArticle)
            <div class="panel panel-default" style="border:0 solid rgba(255,255,255,0);background-color: rgba(255,255,255,0);">
                <div class="panel-body" style="padding:0;border:0;background-color: rgba(255,255,255,0);">
                    <div>
                        <div class="col-md-3 col-sm-12" style="text-align: center;">
                            @inject('categoriesService', 'App\Services\CategoriesServiceInterface')
                            @foreach($categoriesService->stringToArray(',', $tagArticle->categories->str_categories) as $category)
                                @if(count($categoriesService->stringToArray(',', $tagArticle->categories->str_categories)) >=3 )
                                    <a href="{{ route('category.articles',[ $category ]) }}" style="display:block;padding: 8px 20px 8px 20px;margin: 6px 0 6px 0;background-color: {{ $tagArticle->categories->color_categories }};color: #fff;">{{ $category }}</a>
                                @else
                                    <a href="{{ route('category.articles',[ $category ]) }}" style="display:block;padding: 12px 20px 12px 20px;margin: 9px 0 9px 0;background-color: {{ $tagArticle->categories->color_categories }};color: #fff;">{{ $category }}</a>
                                    {{--<a href="{{ route('category.articles',[ $categoriesService->stringToArray(',', $latestArticle->categories->str_categories)[0] ]) }}" style="display:block;padding: 13px 20px 13px 20px;margin: 10px 0 10px 0;background-color: {{ $latestArticle->categories->color_categories }};color: #fff;">{{ $categoriesService->stringToArray(',', $latestArticle->categories->str_categories)[0] }}</a>--}}
                                    {{--<a href="{{ route('category.articles',[ $categoriesService->stringToArray(',', $latestArticle->categories->str_categories)[sizeof($categoriesService->stringToArray(',', $latestArticle->categories->str_categories))-1] ]) }}" style="display:block;padding: 13px 20px 13px 20px;margin: 10px 0 10px 0;background-color: {{ $latestArticle->categories->color_categories }};color: #fff;">{{ $categoriesService->stringToArray(',', $latestArticle->categories->str_categories)[sizeof($categoriesService->stringToArray(',', $latestArticle->categories->str_categories))-1] }}</a>--}}
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-9 col-sm-12" style="float: left;margin-top: 6px;background-color: #fff;border-left: 3px solid {{ $tagArticle->categories->color_categories }};">
                            <h3 style="margin-top: 10px;">

                                <a class="article_title" href="{{ route('user.articleDetail', [ 'id'=>$tagArticle->id ] ) }}">
                                    <span style="display:inline-block;color: rgba(255,255,255,0);background-color: {{ $tagArticle->categories->color_categories }};font-size: 20px;width: 24px;height: 24px;">{{ $tagArticle->id }}</span>
                                    {{ $tagArticle->title }}
                                </a>
                            </h3>
                            <span style="display:inline-block;margin: 10px 13px 6px 0;padding:3px 8px 3px 8px;background-color: rgba(200,200,200,0.2);border-radius: 3px;color: #000;"><i class="fa fa-user"></i> {{ $tagArticle->users->user_name }}</span>
                            <span style="display:inline-block;margin: 10px 13px 6px 0;padding:3px 8px 3px 8px;background-color: rgba(200,200,200,0.2);border-radius: 3px;color: #000;"><i class="fa fa-calendar"></i> {{ $tagArticle->created_at->diffForHumans() }}</span>
                            <span style="display:inline-block;margin: 10px 13px 6px 0;padding:3px 8px 3px 8px;background-color: rgba(200,200,200,0.2);border-radius: 3px;color: #000;"><i class="fa fa-thumbs-o-up"></i> {{ $tagArticle->article_relate->like_number }}</span>
                            <span style="display:inline-block;margin: 10px 13px 6px 0;padding:3px 8px 3px 8px;background-color: rgba(200,200,200,0.2);border-radius: 3px;color: #000;"><i class="fa fa-bookmark-o"></i> {{ $tagArticle->article_relate->store_number }}</span>
                            <span style="display:inline-block;margin: 10px 13px 6px 0;padding:3px 8px 3px 8px;background-color: rgba(200,200,200,0.2);border-radius: 3px;color: #000;"><i class="fa fa-comments-o"></i> {{ $tagArticle->article_relate->comment_number }}</span>
                            <div style="padding: 10px 0 10px 0;">
                                @inject('tagsService', 'App\Services\TagsServiceInterface')
                                <span style="margin-right: 15px;padding:6px 8px 6px 8px;color:#F67777;background-color: rgba(200,200,200,0.2);border-radius: 5px;">TAG</span>
                                @foreach($tagsService->stringToArray(',', $tagArticle->tags->str_tags) as $tag)
                                    <a href="{{ route('tag.articles',[ $tag ]) }}" id="{{ $tag }}" class="tag-in" style="margin: 5px 5px 5px 0px;padding:2px 5px 2px 5px;">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--分页--}}
        {{ $tagArticleList->links() }}
    </div>

@endsection

@section('index_script')
    <script>
        // 只让pagination居中
        $(".pagination").wrap('<div id="pageWrap"></div>');
        $("#pageWrap").css("text-align", "center");
    </script>
@endsection


