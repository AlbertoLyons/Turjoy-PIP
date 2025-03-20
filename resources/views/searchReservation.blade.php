@extends('layouts.app')

@section('title')
    Buscar Reservas
@endsection
@section('content')
<style>
    .vertical-center {
      margin: 0;
      position: absolute;
      top: 35%;
      left: 40%;
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
      border: 30px solid white;
    }
    </style>

    <body>
        <center>
            <div class="sm:py-8 border rounded-lg shadow-lg vertical-center" style="background-color: white" >
                <div>
                    <p class="mb-4 mt-6 text-4xl tracking-tight font-bold text-center">Buscar reserva</p>
                </div>
                <hr class="w-48 h-1  bg-gray-100 border-0 rounded md:my-5 dark:bg-gray-700">
                <div class="flex justify-center">
                    <form data-tooltip-target="tooltip-default"  data-tooltip-placement="top" class="mt-4" method="POST" action="{{ route('search.store') }}">
                        @csrf
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
                        <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-1 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Su código debe ser  del tipo XXXX11
                        </div>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" name="code" id="default-search"
                                class="block w-80 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ingresa el código a buscar">
                            <button type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                                style="background-color:#0a74da">Buscar</button>
                        </div>
                        @if (session()->has('msg1'))
                            <p class="font-semibold rounded-lg my-4 text-lg text-center px-4 py-3 alert alert-danger mt-4 w-72 h-20"
                                style="background-color: #ff8a80; color:white">
                                {{ session()->get('msg1') }}
                            </p>
                        @endif
                        @if (session()->has('msg2'))
                            <p class="font-semibold rounded-lg my-4 text-lg text-center px-4 py-3 alert alert-danger mt-4 w-72 h-20"
                                style="background-color: #ff8a80; color:white">
                                {{ session()->get('msg2') }}
                            </p>
                        @endif
                    </form>
                </div>
            </div>
        </center>
    </body>
@endsection
