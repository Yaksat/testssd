@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование поста</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Посты</a></li>
                        <li class="breadcrumb-item active">Редактирование поста</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="title" placeholder="Название поста"
                                   value="{{ old('title', $post->title) }}">
                            @error('title')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea id="summernote" name="content">
                                {{ old('content', $post->content) }}
                            </textarea>
                            @error('content')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="exampleInputFile">Добавить превью</label>
                            <div class="w-25 mb-2">
                                <img src="{{ url('storage/' . $post->preview_image) }}" alt="preview_image" class="w-50">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="preview_image">
                                    <label class="custom-file-label">Выберите изображение</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузка</span>
                                </div>
                            </div>
                            @error('preview_image')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="exampleInputFile">Добавить главное изображение</label>
                            <div class="w-50 mb-2">
                                <img src="{{ url('storage/' . $post->main_image) }}" alt="main_image" class="w-50">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="main_image">
                                    <label class="custom-file-label">Выберите изображение</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузка</span>
                                </div>
                            </div>
                            @error('main_image')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label>Выберите категорию</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id', $post->category_id) ? ' selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Тэги</label>
                            <select name="tag_ids[]" class="select2" multiple="multiple" data-placeholder="Выберите тэги" style="width: 100%;">
                                @if(is_array(old('tag_ids')))
                                    @foreach($tags as $tag)
                                        <option {{ in_array($tag->id, old('tag_ids')) ? ' selected' : '' }} value="{{ $tag->id }}"> {{ $tag->title }} </option>
                                    @endforeach
                                @else
                                    @foreach($tags as $tag)
                                        <option {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? ' selected' : '' }} value="{{ $tag->id }}"> {{ $tag->title }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Обновить">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
