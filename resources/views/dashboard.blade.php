<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Indicadores -->
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div class="p-4 bg-white shadow rounded">
                    <h4 class="text-lg font-bold">Total de Cursos</h4>
                    <p class="text-2xl">{{ $totalCursos }}</p>
                </div>
                <div class="p-4 bg-white shadow rounded">
                    <h4 class="text-lg font-bold">Total de Alunos</h4>
                    <p class="text-2xl">{{ $totalAlunos }}</p>
                </div>
                <div class="p-4 bg-white shadow rounded">
                    <h4 class="text-lg font-bold">Vagas em Aberto</h4>
                    <p class="text-2xl">{{ $vagasAbertas }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    
                    <!-- Gráfico de Inscrições -->
                    <div class="mb-3">
                        <h4 class="text-lg font-bold mb-4">Cursos em Alta</h4>
                        <div class="p-4 bg-white shadow rounded">
                            @if (count($graficoLabels) > 0 && count($graficoDados) > 0)
                                <canvas id="graficoCursos"></canvas>
                            @else
                                <p class="text-gray-500">Nenhum dado disponível para exibir o gráfico.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Gráfico de Percentual de Vagas -->
                    <div>
                        <h4 class="text-lg font-bold mb-4">Percentual de Vagas Preenchidas</h4>
                        <div class="p-4 bg-white shadow rounded">
                            @if (count($percentualVagasDados) > 0)
                                <canvas id="graficoVagas"></canvas>
                            @else
                                <p class="text-gray-500">Nenhum dado disponível para exibir o gráfico.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Cursos com Vagas em Aberto -->
                <div class="col-md-6">
                    <h4 class="text-lg font-bold mb-4">Cursos com Vagas em Aberto</h4>
                    @if ($cursosComVagas->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                            @foreach ($cursosComVagas->take(8) as $curso)
                                <div class="p-4 border rounded shadow">
                                    <h5 class="font-bold">{{ $curso->nome }}</h5>
                                    <p>Tipo: {{ ucfirst($curso->tipo) }}</p>
                                    <p>Máx. Alunos: {{ $curso->quantidade_maxima_alunos }}</p>
                                    <p>Vagas Disponíveis: {{ $curso->quantidade_maxima_alunos - $curso->alunos_count }}</p>
                                </div>
                            @endforeach
                        </div>
                        @if ($cursosComVagas->count() > 8)
                            <div class="mt-4 text-center">
                                <a href="{{ route('cursos.index') }}"
                                   class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Ver Todos
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-500">Nenhum curso com vagas em aberto foi encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico de Inscrições
        @if (count($graficoLabels) > 0 && count($graficoDados) > 0)
            const ctxCursos = document.getElementById('graficoCursos').getContext('2d');
            new Chart(ctxCursos, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($graficoLabels) !!},
                    datasets: [{
                        label: 'Inscrições',
                        data: {!! json_encode($graficoDados) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                },
            });
        @endif

        // Gráfico de Percentual de Vagas
        @if (count($percentualVagasDados) > 0)
            const ctxVagas = document.getElementById('graficoVagas').getContext('2d');
            new Chart(ctxVagas, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($graficoLabels) !!},
                    datasets: [{
                        label: 'Percentual de Vagas Preenchidas',
                        data: {!! json_encode($percentualVagasDados) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                    }],
                },
            });
        @endif
    </script>
</x-app-layout>
