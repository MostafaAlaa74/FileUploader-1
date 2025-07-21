<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <span class="form-title">Upload your file</span>
                        <p class="form-paragraph">
                            File should be a PDF
                        </p>
                        <label for="file-input" class="drop-container">
                            <span class="drop-title">Drop files here</span>
                            or
                            <input type="file" name="file" required="" id="file-input">
                        </label>
                        @error('file')
                            <span class="text-danger" style="color: red; display:block">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="button">
                            Send
                        </button>
                    </form>
                    <style>
                        /* From Uiverse.io by RaspberryBee */
                        .button {
                            height: 2em;
                            width: 5em;
                            border-radius: 1em;
                            border: 0.1rem solid transparent;
                            background-color: rgb(64, 146, 239);
                            transition: 0.3s;
                            font-size: 1em;
                        }

                        .button:hover {
                            cursor: pointer;
                            transform: scale(1.05) rotate(3deg);
                        }

                        .button:active {
                            animation: borderMove 0.5s forwards;
                            transform: scale(0.9) rotate(-3deg);
                            background-color: rgb(0, 0, 0);
                            color: rgb(64, 146, 239);
                            border: 0.1rem solid rgb(38, 103, 224);
                        }

                        @keyframes borderMove {
                            0% {
                                border-width: 0.1rem;
                                transform: scale(1) rotate(0deg);
                            }

                            50% {
                                border-width: 0.4rem;
                                transform: scale(0.9) rotate(-3deg);
                            }

                            100% {
                                border-width: 0.15rem;
                                transform: scale(1) rotate(0deg);
                            }
                        }

                        /* From Uiverse.io by Yaya12085 */
                        .form {
                            background-color: #fff;
                            box-shadow: 0 10px 60px rgb(218, 229, 255);
                            border: 1px solid rgb(159, 159, 160);
                            border-radius: 20px;
                            padding: 2rem .7rem .7rem .7rem;
                            text-align: center;
                            font-size: 1.125rem;
                            max-width: 320px;
                        }

                        .form-title {
                            color: #000000;
                            font-size: 1.8rem;
                            font-weight: 500;
                        }

                        .form-paragraph {
                            margin-top: 10px;
                            font-size: 0.9375rem;
                            color: rgb(105, 105, 105);
                        }

                        .drop-container {
                            background-color: #fff;
                            position: relative;
                            display: flex;
                            gap: 10px;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            padding: 10px;
                            margin-top: 2.1875rem;
                            border-radius: 10px;
                            border: 2px dashed rgb(171, 202, 255);
                            color: #444;
                            cursor: pointer;
                            transition: background .2s ease-in-out, border .2s ease-in-out;
                        }

                        .drop-container:hover {
                            background: rgba(0, 140, 255, 0.164);
                            border-color: rgba(17, 17, 17, 0.616);
                        }

                        .drop-container:hover .drop-title {
                            color: #222;
                        }

                        .drop-title {
                            color: #444;
                            font-size: 20px;
                            font-weight: bold;
                            text-align: center;
                            transition: color .2s ease-in-out;
                        }

                        #file-input {
                            width: 350px;
                            max-width: 100%;
                            color: #444;
                            padding: 2px;
                            background: #fff;
                            border-radius: 10px;
                            border: 1px solid rgba(8, 8, 8, 0.288);
                        }

                        #file-input::file-selector-button {
                            margin-right: 20px;
                            border: none;
                            background: #084cdf;
                            padding: 10px 20px;
                            border-radius: 10px;
                            color: #fff;
                            cursor: pointer;
                            transition: background .2s ease-in-out;
                        }

                        #file-input::file-selector-button:hover {
                            background: #0d45a5;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
