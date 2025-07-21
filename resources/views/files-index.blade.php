<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <x-flash-message />
                @endif
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Available Function</h1>
                    <ul class="list-disc pl-5">
                        <li><a href="{{ route('files.create') }}" class="text-blue-500 hover:underline">Upload File</a>
                        </li>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">User Files</h1>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">File Name</th>
                                <th class="py-2 px-4 border-b">File Path</th>
                                <th class="py-2 px-4 border-b">Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $file->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $file->path }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <!-- From Uiverse.io by SachinKumar666 -->
                                        <form action="{{ route('files.destroy', $file->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button"></button>
                                        </form>

                                        <!-- From Uiverse.io by dovatgabriel -->

                                        <a href="{{ asset('storage/' . $file->path) }}"
                                            class="buttonDownload">Download</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <style>
                        /* From Uiverse.io by dovatgabriel */
                        .buttonDownload {
                            display: inline-block;
                            position: relative;
                            padding: 10px 25px;
                            background-color: #4CC713;
                            color: white;
                            font-family: sans-serif;
                            text-decoration: none;
                            font-size: 0.9em;
                            text-align: center;
                            text-indent: 15px;
                            border: none;
                        }

                        .buttonDownload:hover {
                            background-color: #45a21a;
                            color: white;
                        }

                        .buttonDownload:before,
                        .buttonDownload:after {
                            content: ' ';
                            display: block;
                            position: absolute;
                            left: 15px;
                            top: 52%;
                        }

                        .buttonDownload:before {
                            width: 10px;
                            height: 2px;
                            border-style: solid;
                            border-width: 0 2px 2px;
                        }

                        .buttonDownload:after {
                            width: 0;
                            height: 0;
                            margin-left: 3px;
                            margin-top: -7px;
                            border-style: solid;
                            border-width: 4px 4px 0 4px;
                            border-color: transparent;
                            border-top-color: inherit;
                            animation: downloadArrow 1s linear infinite;
                            animation-play-state: paused;
                        }

                        .buttonDownload:hover:before {
                            border-color: #cdefbd;
                        }

                        .buttonDownload:hover:after {
                            border-top-color: #cdefbd;
                            animation-play-state: running;
                        }

                        @keyframes downloadArrow {
                            0% {
                                margin-top: -7px;
                                opacity: 1;
                            }

                            0.001% {
                                margin-top: -15px;
                                opacity: 0.4;
                            }

                            50% {
                                opacity: 1;
                            }

                            100% {
                                margin-top: 0;
                                opacity: 0.4;
                            }
                        }

                        /* From Uiverse.io by SachinKumar666 */
                        .button {
                            cursor: pointer;
                            padding: 12px 20px;
                            background-color: rgb(207, 44, 44);
                            border: 2px solid rgb(0, 0, 0);
                            color: White;
                            font-size: 20px;
                            text-align: center;
                            text-transform: uppercase;
                            transition: all ease 0.3s;
                            border-radius: 7px;
                            box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
                            box-shadow:
                                rgba(0, 0, 0, 0.4) 0px 2px 4px,
                                rgba(0, 0, 0, 0.3) 0px 7px 13px -3px,
                                rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
                        }

                        .button:hover {
                            border-radius: 3px;
                            background-color: rgb(145, 6, 6);
                        }

                        .button::before {
                            content: "Delete";
                        }

                        .button:active {
                            content: "Deleted";
                            background-color: rgb(145, 6, 6);
                            box-shadow:
                                rgba(9, 30, 66, 0.25) 0px 1px 1px,
                                rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
