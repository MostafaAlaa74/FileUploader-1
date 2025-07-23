<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full max-w-9xl mx-auto rounded-lg p-6 overflow-auto">
            <div class="w-full max-w-9xl mx-auto bg-white rounded-lg shadow p-6 overflow-auto">
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
            <div class="w-full max-w-9xl mx-auto bg-white rounded-lg shadow p-6 overflow-auto">
                <div class="p-6 text-gray-900 overflow-auto">
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
                                        <div class="button-group">
                                            <!-- From Uiverse.io by SachinKumar666 -->
                                            <form action="{{ route('files.destroy', $file->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <!-- From Uiverse.io by cssbuttons-io -->
                                                <button class="delete-button"> Delete
                                                </button>
                                            </form>

                                            <!-- From Uiverse.io by dovatgabriel -->

                                            <a href="{{ asset('storage/' . $file->path) }}"
                                                class="buttonDownload">Download</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <style>
                        /* From Uiverse.io by cssbuttons-io */
                        .button-group {
                            display: flex;
                            gap: 10px;
                            /* spacing between buttons */
                            align-items: center;
                        }

                        .delete-button {
                            padding: 1.3em 3em;
                            font-size: 12px;
                            text-transform: uppercase;
                            letter-spacing: 2.5px;
                            font-weight: 500;
                            color: #000;
                            background-color: #fff;
                            border: none;
                            border-radius: 45px;
                            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
                            transition: all 0.3s ease 0s;
                            cursor: pointer;
                            display: inline;
                            outline: none;
                        }

                        .delete-button:hover {
                            background-color: #c42323;
                            box-shadow: 0px 15px 20px rgba(196, 35, 35, 0.4);
                            color: #fff;
                            transform: translateY(-7px);
                        }

                        .delete-button:active {
                            transform: translateY(-1px);
                        }

                        .buttonDownload {
                            padding: 1.3em 3em;
                            font-size: 12px;
                            text-transform: uppercase;
                            letter-spacing: 2.5px;
                            font-weight: 500;
                            color: #000;
                            background-color: #fff;
                            border: none;
                            border-radius: 45px;
                            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
                            transition: all 0.3s ease 0s;
                            cursor: pointer;
                            outline: none;
                        }

                        .buttonDownload:hover {
                            background-color: #23c463;
                            box-shadow: 0px 15px 20px rgba(35, 196, 99, 0.4);
                            color: #fff;
                            transform: translateY(-7px);
                        }

                        .buttonDownload:active {
                            transform: translateY(-1px);
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
