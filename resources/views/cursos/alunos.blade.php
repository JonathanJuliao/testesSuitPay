<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Alunos Matriculados no Curso: ') . $curso->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow rounded">
                <div class="row mb-6">
                    <div class="col-md-6">
                        <h1 class="text-2xl font-bold mb-4">{{ __('Alunos Matriculados no Curso: ') . $curso->nome }}
                        </h1>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
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
                
                        @php

                            $prazoExpirado = \Carbon\Carbon::now()->isAfter(
                                \Carbon\Carbon::parse($curso->data_limite_matricula),
                            );
                        @endphp

                        @if ($prazoExpirado)

                            <div class="alert alert-danger" role="alert">
                                Prazo de matrícula expirado!
                            </div>
                        @else
                            <div class="form-group">
                                <label for="alunoSelect">Selecione um Aluno</label>
                                <br>
                                <select class="form-control select2" id="alunoSelect"
                                    data-placeholder="Selecione um Aluno">
                                    @foreach ($alunosDisponiveis as $aluno)
                                        <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a type="button" href="#" id="matricular-btn"
                                class="btn btn-sm btn-primary ml-2 pt-3" onclick="matricularAluno()">
                                Matricular
                            </a>
                        @endif
                    </div>
                </div>

                <br>

                <table id="alunosTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($curso->alunos as $aluno)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $aluno->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $aluno->nome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $aluno->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button class="btn btn-danger btn-sm desmatricular-btn"
                                        data-aluno-id="{{ $aluno->id }}">
                                        Desmatricular
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            inicalizaDataTable();
            $('.select2').select2({
                placeholder: "Selecione um Aluno",
                allowClear: true
            });
            $('.desmatricular-btn').on('click', function() {
                const alunoId = $(this).data('aluno-id');
                const cursoId = {{ $curso->id }};

                Swal.fire({
                    title: 'Você tem certeza?',
                    text: 'Esta ação irá desmatricular o aluno deste curso!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, desmatricular!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading(
                            'Por favor, aguarde enquanto o aluno é desmatriculado do curso.');
                        $.ajax({
                            url: `/cursos/${cursoId}/desmatricular/${alunoId}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                            success: function(response) {
                                Swal.fire('Desmatriculado!', response.message,
                                    'success');
                                location.reload();
                            },
                            error: function(error) {
                                Swal.fire('Erro!',
                                    'Ocorreu um erro ao desmatricular o aluno.' + error,
                                    'error');
                                console.error(error);
                            }
                        });
                    }
                });
            });
        });

        async function inicalizaDataTable() {
            $('#alunosTable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                }
            });
        }

       function matricularAluno() {
            const alunoId = $('#alunoSelect').val();
            const cursoId = {{ $curso->id }};
        
            if (!alunoId) {
                Swal.fire('Erro!', 'Por favor, selecione um aluno para matricular.', 'error');
                return;
            }
        
            showLoading('Aguarde enquanto o aluno é matriculado no curso.');
        
            $.ajax({
                url: `/cursos/${cursoId}/matricular/${alunoId}`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    Swal.fire('Matriculado!', response.message, 'success');
                    location.reload();
                },
                error: function(xhr) {
                  
                    const errorMessage = xhr.responseJSON?.error || 'Erro inesperado ao tentar matricular o aluno.';
                    
                    Swal.fire('Erro!', errorMessage, 'error');
                    console.error(xhr); 
                }
            });
}

        function showLoading(message) {
            Swal.fire({
                title: 'Carregando...',
                text: message || 'Aguarde enquanto a operação é concluída.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
    </script>

</x-app-layout>
