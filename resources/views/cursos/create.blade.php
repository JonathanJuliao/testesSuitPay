<x-app-layout>
    <x-slot name="header">
        <h2 class="text-bold text-black ">
            {{ $curso->id ? 'Editar Curso' : 'Novo Curso' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6">
                
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
                
                <h1 class="text-2xl font-bold mb-4">
                    {{ $curso->id ? 'Editar Curso' : 'Novo Curso' }}
                </h1>
                <br>

                <form action="{{ $curso->id ? route('cursos.update', $curso->id) : route('cursos.store') }}" method="POST">
                    @csrf
                    @if ($curso->id)
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $curso->nome ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-gray-700">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="online" {{ old('tipo', $curso->tipo ?? '') === 'online' ? 'selected' : '' }}>Online</option>
                            <option value="presencial" {{ old('tipo', $curso->tipo ?? '') === 'presencial' ? 'selected' : '' }}>Presencial</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="quantidade_maxima_alunos" class="block text-gray-700">Quantidade Máxima de Alunos</label>
                        <input type="number" name="quantidade_maxima_alunos" id="quantidade_maxima_alunos" value="{{ old('quantidade_maxima_alunos', $curso->quantidade_maxima_alunos ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="data_limite_matricula" class="block text-gray-700">Data Limite de Matrícula</label>
                        <input type="date" name="data_limite_matricula" id="data_limite_matricula" value="{{ old('data_limite_matricula', $curso->data_limite_matricula ?? '') }}" class="form-control">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-success">{{ $curso->id ? 'Atualizar' : 'Salvar' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
