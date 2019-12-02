@extends('layouts.articleEdit')

@section('editContent')

<section>

    <textarea id="detail"></textarea>
    <div class="button_group">
        <a href="javascript:void(0);" id="2" class="status-2 summit_btn" onclick="articleSubmit(this)">提交</a>
        <a href="javascript:void(0);" id="1" class="status-1 save_btn" onclick="articleSubmit(this)">一時保存</a>
    </div>

</section>

@endsection
