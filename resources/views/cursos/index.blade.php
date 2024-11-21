<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark leading-tight">
            {{ __('Cursos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="container">
                        @if (session('status'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: '{{ session('status') }}',
                        });
                    </script>
                @endif

                @if (session('erro'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: '{{ session('erro') }}',
                        });
                    </script>
                @endif
                
                    <div class="row mb-6">
                        <div class="col-md-6">
                            <h1 class="text-2xl font-bold mb-4">Lista de Cursos</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <a type="button" href="{{ route('cursos.create') }}" class="btn btn-primary ml-2 pt-3"
                                onclick="showLoading()">Novo Curso</a>
                            <!-- Botão para excluir todos os cursos -->
                            <button id="deleteAllButton" onclick="handleDeleteAll()" class="btn btn-danger ml-2">Excluir
                                Todos os Cursos</button>
                        </div>
                    </div>

                    <table id="cursos" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Vagas</th>
                                <th>Data Limite</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursos as $curso)
                                <tr>
                                    <td>{{ $curso->id }}</td>
                                    <td>{{ $curso->nome }}</td>
                                    <td>{{ ucfirst($curso->tipo) }}</td>
                                    <td>{{ $curso->quantidade_maxima_alunos - $curso->alunos_count }} de {{ $curso->quantidade_maxima_alunos }}</td>
                                    <td>{{ \Carbon\Carbon::parse($curso->data_limite_matricula)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning btn-sm"
                                            onclick="showLoading()">Editar</a>
                                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                        <a href="{{ route('cursos.alunos', $curso->id) }}" class="btn btn-info btn-sm"
                                            onclick="showLoading()">Alunos</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para mostrar o SweetAlert de carregamento
        function showLoading() {
            Swal.fire({
                title: 'Carregando...',
                text: 'Por favor, aguarde enquanto a página carrega.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading(); // Exibe o indicador de carregamento
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            inicializaDatatable();
        });

        async function inicializaDatatable() {
            $('#cursos').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                }
            });
        }

        async function handleDeleteAll() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {

                const result = await Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Esta ação excluirá todos os cursos!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir todos!'
                });

                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Excluindo...',
                        text: 'Aguarde enquanto todos os cursos são excluídos.',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });


                    const response = await fetch('{{ route('cursos.destroyAll') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (!response.ok) {
                        const data = await response.json();
                        throw new Error(data.message || 'Erro ao excluir os cursos');
                    }

                    // Fechar o SweetAlert de carregamento e mostrar sucesso
                    await Swal.fire('Excluído!', 'Todos os cursos foram excluídos.', 'success');
                    location.reload(); // Recarregar a página após exclusão
                }
            } catch (error) {
                Swal.fire('Erro!', error.message, 'error');
            }
        };
    </script>
</x-app-layout>
