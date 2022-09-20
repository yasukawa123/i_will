<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="flex flex-col min-h-[100vh]">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">Todoアプリ-編集画面</p>
            </div>
        </div>
    </header>

    <main class="grow grid place-items-center">
        <div class="w-full mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <form action="/tasks/{{ $task->id }}" method="post" class="mt-10">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center">
                        <label class="w-full max-w-3xl mx-auto">
                            <input
                                class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                type="text" name="task_name" value="{{ $task->name }}" />
                            @error('task_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                            @enderror
                        </label>
                        <div class="form-group">
                            <label for="date2" class="col-form-label">期限日：</label>
                            <input type="date" class="form-control" id="tsask_date" name="tsask_date">
                        </div>
                        <div class="form-group">
                            <label for="date2" class="col-form-label">状態：</label>
                            <select class="form-control" id="task_status" name="task_status">
                                <option value="1">未対応</option>
                                <option value="2">処理中</option>
                                <option value="3">確認待ち</option>
                                <option value="4">完了</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date2" class="col-form-label">優先度：</label>
                            <select class="form-control" id="task_priority" name="task_priority">
                                <option value="1">至急</option>
                                <option value="2">優先</option>
                                <option value="3" selected>中</option>
                                <option value="4">低</option>
                            </select>
                        </div>

                        <div class="mt-8 w-full flex items-center justify-center gap-10">
                            <button class="inline-flex items-center px-4 py-2 text-base font-medium leading-6 text-green-500 whitespace-no-wrap bg-blue-600 border border-blue-700 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" data-rounded="rounded-md" data-primary="blue-600" data-primary-reset="{}">
                                <a href="/tasks">戻る</a>
                            </button>
                            <button
                                class="inline-flex items-center px-4 py-2 text-base font-medium leading-6 text-green-500 whitespace-no-wrap bg-blue-600 border border-blue-700 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" data-rounded="rounded-md" data-primary="blue-600" data-primary-reset="{}">
                                編集する
                            </button>
                        </div>
                    </div>

                </form>

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
</body>

</html>