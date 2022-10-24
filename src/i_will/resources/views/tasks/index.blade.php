<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"
/>
</head>

<body class="flex flex-col min-h-[100vh] bg-slate-800">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">Todoアプリ</p>
            </div>
        </div>
    </header>

    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center text-white">タスク管理</p>
                <form action="/tasks" method="post" class="mt-10">
                @csrf
                    <div class="flex flex-col items-center">
                        <label class="w-full max-w-3xl mx-auto">
                            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-full py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                placeholder="タスクを追加する" type="text" name="task_name" />
                                @error('task_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                                @enderror
                        </label>
                        <div class="flex justy-end">
                            <div class="form-group ">
                                <label for="date2" class="col-form-label flex text-gray-200">期限日：</label>
                                <input type="date" class="form-control placeholder:italic placeholder:text-slate-400 block bg-white border border-slate-300 rounded-full py-4 pl-4 pr-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                    id="task_limit" name="task_limit">
                            </div>
                            <div class="form-group">
                                <label for="date2" class="col-form-label text-gray-200">状態：</label>
                                <select class="form-control placeholder:italic placeholder:text-slate-400 block bg-white border border-slate-300 rounded-full py-4 pl-4 pr-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                    id="task_status" name="task_status">
                                    <option value="1" selected>未対応</option>
                                    <option value="2">処理中</option>
                                    <option value="3">確認待ち</option>
                                    <option value="4">完了</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date2" class="col-form-label text-gray-200">優先度：</label>
                                <select class="form-control placeholder:italic placeholder:text-slate-400 block bg-white border border-slate-300 rounded-full py-4 pl-4 pr-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                    id="task_priority" name="task_priority">
                                    <option value="1">至急</option>
                                    <option value="2">優先</option>
                                    <option value="3" selected>中</option>
                                    <option value="4">低</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="mt-8 p-4 bg-indigo-500 text-white rounded-full w-full max-w-xs hover:bg-slate-900 transition-colors">
                            追加する
                        </button>
                    </div>
                </form>
                
                {{-- 追記 --}}
                @if ($not_tasks)
                    <div class="max-w-7xl mx-auto mt-20" style="margin-top: 50px;">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead class="bg-indigo-700">
                                        <tr class="w-full bg-indigo-500" style="text-align: left;">
                                            <th scope="col" class="w-3/4 mt-10 py-3.5 pl-4" style="text-align: left; color: white">未対応</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">優先度</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">期日</th>
                                            <th scope="col" class="py-3.5 pr-4" style="text-align: center; color: white">ボタン</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-gray-600">
                                    @foreach ($not_tasks as $item)
                                            <tr>
                                                <td class="px-3 py-4 text-sm text-gray-200">
                                                    <div>
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->priority }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->limit }}
                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">
                                                        <div>
                                                            <form action="/tasks/{{ $item->id }}"
                                                                method="post"
                                                                class="inline-block text-gray-200 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('PUT')
                                                                {{-- 追記 --}}
                                                                <input type="hidden" name="status" value="{{$item->status}}">
                                                                {{-- 追記 --}}
                                                                <button type="submit"
                                                                    class="py-4 w-10 text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors">完了</button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <a href="/tasks/{{ $item->id }}/edit/"
                                                                class="inline-block text-center py-4 w-10 no-underline text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors color: white">編集</a>
                                                        </div>
                                                        <div>
                                                            <form onsubmit="return deleteTask();"
                                                                action="/tasks/{{ $item->id }}" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="py-4 w-10 mr-4 text-red-500 md:hover:bg-red-500 md:hover:text-white transition-colors">削除</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- 追記ここまで --}}

                {{-- 追記 --}}
                @if ($process_tasks)
                    <div class="max-w-7xl mx-auto mt-20" style="margin-top: 50px;">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr class="w-full bg-indigo-500" style="text-align: left;">
                                        <th scope="col" class="w-3/4 mt-10 py-3.5 pl-4" style="text-align: left; color: white">処理中</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">優先度</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">期日</th>
                                            <th scope="col" class="py-3.5 pr-4" style="text-align: center; color: white">ボタン</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-gray-600">
                                    @foreach ($process_tasks as $item)
                                            <tr>
                                                <td class="px-3 py-4 text-sm text-gray-200">
                                                    <div>
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->priority }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->limit }}
                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">
                                                        <div>
                                                            <form action="/tasks/{{ $item->id }}"
                                                                method="post"
                                                                class="inline-block text-gray-200 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('PUT')
                                                                {{-- 追記 --}}
                                                                <input type="hidden" name="status" value="{{$item->status}}">
                                                                {{-- 追記 --}}
                                                                <button type="submit"
                                                                    class="py-4 w-10 text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors">完了</button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <a href="/tasks/{{ $item->id }}/edit/"
                                                                class="inline-block text-center py-4 w-10 no-underline text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors color: white">編集</a>
                                                        </div>
                                                        <div>
                                                            <form onsubmit="return deleteTask();"
                                                                action="/tasks/{{ $item->id }}" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="py-4 w-10 mr-4 text-red-500 md:hover:bg-red-500 md:hover:text-white transition-colors">削除</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- 追記ここまで --}}

                {{-- 追記 --}}
                @if ($wait_tasks)
                    <div class="max-w-7xl mx-auto mt-20" style="margin-top: 50px;">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr class="w-full bg-indigo-500" style="text-align: left;">
                                            <th scope="col" class="w-3/4 mt-10 py-3.5 pl-4" style="text-align: left; color: white">確認待ち</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">優先度</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">期日</th>
                                            <th scope="col" class="py-3.5 pr-4" style="text-align: center; color: white">ボタン</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-gray-600">
                                        @foreach ($wait_tasks as $item)
                                            <tr>
                                                <td class="px-3 py-4 text-sm text-gray-200">
                                                    <div>
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->priority }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->limit }}
                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">
                                                        <div>
                                                            <form action="/tasks/{{ $item->id }}"
                                                                method="post"
                                                                class="inline-block text-gray-200 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('PUT')
                                                                {{-- 追記 --}}
                                                                <input type="hidden" name="status" value="{{$item->status}}">
                                                                {{-- 追記 --}}
                                                                <button type="submit"
                                                                    class="py-4 w-10 text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors">完了</button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <a href="/tasks/{{ $item->id }}/edit/"
                                                                class="inline-block text-center py-4 w-10 no-underline text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors color: white">編集</a>
                                                        </div>
                                                        <div>
                                                            <form onsubmit="return deleteTask();"
                                                                action="/tasks/{{ $item->id }}" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="py-4 w-10 mr-4 text-red-500 md:hover:bg-red-500 md:hover:text-white transition-colors">削除</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- 追記ここまで --}}

                {{-- 追記 --}}
                @if ($completion_tasks)
                    <div class="max-w-7xl mx-auto mt-20" style="margin-top: 50px;">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr class="w-full bg-indigo-500" style="text-align: left;">
                                            <th scope="col" class="w-3/4 mt-10 py-3.5 pl-4" style="text-align: left; color: white">完了</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">優先度</th>
                                            <th scope="col" class="py-3.5" style="text-align: center; color: white">期日</th>
                                            <th scope="col" class="py-3.5 pr-4" style="text-align: center; color: white">ボタン</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-gray-600">
                                        @foreach ($completion_tasks as $item)
                                            <tr>
                                                <td class="px-3 py-4 text-sm text-gray-200">
                                                    <div>
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->priority }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-200 text-center">
                                                    <div>
                                                        {{ $item->limit }}
                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">
                                                        <div>
                                                            <form action="/tasks/{{ $item->id }}"
                                                                method="post"
                                                                class="inline-block text-gray-200 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('PUT')
                                                                {{-- 追記 --}}
                                                                <input type="hidden" name="status" value="{{$item->status}}">
                                                                {{-- 追記 --}}
                                                                <button type="submit"
                                                                    class="py-4 w-10 text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors">完了</button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <a href="/tasks/{{ $item->id }}/edit/"
                                                                class="inline-block text-center py-4 w-10 no-underline text-blue-300 md:hover:bg-indigo-400 md:hover:text-white transition-colors color: white">編集</a>
                                                        </div>
                                                        <div>
                                                            <form onsubmit="return deleteTask();"
                                                                action="/tasks/{{ $item->id }}" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="py-4 w-10 mr-4 text-red-500 md:hover:bg-red-500 md:hover:text-white transition-colors">削除</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- 追記ここまで --}}
            </div>
        </div>
    </main>
    <footer class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-4 text-center">
                <p class="text-white text-sm">Todoアプリ</p>
            </div>
        </div>
    </footer>
    <script>
    function deleteTask() {
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>
</html>