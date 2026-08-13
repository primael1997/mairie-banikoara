@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modifier une FAQ</h1>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" name="question" id="question" class="form-control"
                           value="{{ old('question', $faq->question) }}" required>
                </div>

                <div class="form-group">
                    <label for="answer">Réponse</label>
                    <textarea name="answer" id="answer" class="form-control editor"
                              rows="10" required>{{ old('answer', $faq->answer) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <input type="text" name="category" id="category" class="form-control"
                           value="{{ old('category', $faq->category) }}">
                    <small class="form-text text-muted">
                        Laissez vide pour la catégorie "Général"
                    </small>
                </div>

                <div class="form-group">
                    <label for="order">Ordre</label>
                    <input type="number" name="order" id="order" class="form-control"
                           value="{{ old('order', $faq->order) }}">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_published" id="is_published"
                           class="form-check-input" value="1"
                           {{ old('is_published', $faq->is_published) ? 'checked' : '' }}>
                    <label for="is_published" class="form-check-label">Publier</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea.editor',
        height: 400,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });
</script>
@endsection
