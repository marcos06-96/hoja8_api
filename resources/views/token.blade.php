<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tu Token de API') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Este es tu token para acceder a la API:</p>
                    <div class="bg-gray-100 p-4 rounded break-all">
                        <code>{{ $token }}</code>
                    </div>
                    <p class="mt-4 text-sm text-gray-600">Cópialo y úsalo en Postman en el header: Authorization: Bearer {token}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
