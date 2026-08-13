@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des FAQs</h1>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Ajouter une FAQ</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($faqs) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Question</th>
                        <th>Catégorie</th>
                        <th>Publié</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="faq-items">
                    @foreach($faqs as $faq)
                        <tr data-id="{{ $faq->id }}">
                            <td>
                                <span class="drag-handle">≡</span>
                                <span class="order-value">{{ $faq->order }}</span>
                            </td>
                            <td>{{ Str::limit($faq->question, 50) }}</td>
                            <td>{{ $faq->category ?: 'Général' }}</td>
                            <td>
                                @if($faq->is_published)
                                    <span class="badge badge-success">Oui</span>
                                @else
                                    <span class="badge badge-secondary">Non</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-info">Modifier</a>

                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                      class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette FAQ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Aucune FAQ disponible. Commencez par en ajouter une.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Rendre la liste des FAQs triable
        const faqItems = document.getElementById('faq-items');
        if (faqItems) {
            new Sortable(faqItems, {
                handle: '.drag-handle',
                animation: 150,
                onEnd: function() {
                    // Mettre à jour l'ordre des éléments
                    const items = [];
                    const rows = faqItems.querySelectorAll('tr');

                    rows.forEach((row, index) => {
                        const id = row.getAttribute('data-id');
                        items.push({
                            id: id,
                            order: index
                        });

                        // Mettre à jour la valeur de l'ordre affichée
                        const orderValueEl = row.querySelector('.order-value');
                        if (orderValueEl) {
                            orderValueEl.textContent = index;
                        }
                    });

                    // Envoyer l'ordre mis à jour au serveur
                    fetch('{{ route("admin.faqs.update-order") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ items })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Ordre mis à jour avec succès');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la mise à jour de l\'ordre:', error);
                    });
                }
            });
        }
    });
</script>
@endsection
