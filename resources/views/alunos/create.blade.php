<x-app-layout>
    <x-slot name="header">
        <h2 class="text-bold text-black">
            {{ $aluno->id ? 'Editar Aluno' : 'Novo Aluno' }}
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
                    {{ $aluno->id ? 'Editar Aluno' : 'Novo Aluno' }}
                </h1>
                <br>

                <form action="{{ $aluno->id ? route('alunos.update', $aluno->id) : route('alunos.store') }}" method="POST">
                    @csrf
                    @if ($aluno->id)
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $aluno->nome ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $aluno->email ?? '') }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="telefone" class="block text-gray-700">Telefone</label>
                        <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $aluno->telefone ?? '') }}" class="form-control">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-success">{{ $aluno->id ? 'Atualizar' : 'Salvar' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
