<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Repositorios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Enlace</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    <tbody>
                        @forelse ($repositories as $repository)
                        <tr>
                            <td class="border px-4 py-2">{{$repository->id}}</td>
                            <td class="border px-4 py-2">{{$repository->url}}</td>
                            <td>&ensp;</td>
                            <td>
                                <a class="bg-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-green-800 cursor-pointer" href="{{route('repositories.show', $repository)}}">
                                    Ver
                                </a>
                            </td>
                            <td>&ensp;</td>
                            <td>
                                <a class="bg-orange-500 text-white font-bold py-2 px-4 rounded-md hover:bg-orange-800 cursor-pointer" href="{{route('repositories.edit', $repository)}}">
                                    Editar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No hay repositorios creados</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>