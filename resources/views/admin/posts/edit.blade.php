@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Modifica Post
        </h1>

        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $post->title) }}" aria-describedby="emailHelp">
                @error('title')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="">-- nessuna --</option>
                    @foreach ($categories as $category)
                        <option {{ old('category_id', optional($post->category)->id) == $category->id ? 'selected' : '' }}
                            value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
            <div class="d-flex" style="gap: 1rem">

                {{-- FONDAMENTALE NEL name="tag[]" per far arrivare un array di tutti i tag selezionati --}}

                @foreach ($tags as $tag)
                    <div class="form-group form-check">
                        <input type="checkbox" {{ $post->tags->contains($tag) ? 'checked' : '' }}
                            class="form-check-input" value="{{ $tag->id }}" name="tags[]" id="tags-{{ $tag->id }}">
                        <label class="form-check-label" for="tags-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                    @error('tags')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                @endforeach


            </div>

            <div class="form-group">
                <label for="content">Articolo</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                    rows="3">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="published_at">Data Pubblicazione</label>
                <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at"
                    name="published_at" value="{{ old('published_at', Str::substr($post->published_at, 0, 10)) }}"
                    aria-describedby="emailHelp">
                @error('published_at')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>




            <button type="submit" class="btn btn-primary">Salva</button>


        </form>


    </div>
@endsection
