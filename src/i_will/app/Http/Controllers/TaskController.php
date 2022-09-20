<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;//追加
use Illuminate\Support\Facades\Validator;//追加バリデーションを使うとき

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_tasks = Task::get();

        $not_tasks = []; // 1：未対応
        $process_tasks = []; // 2：処理中
        $wait_tasks = []; // 3：確認待ち
        $completion_tasks = []; // 4：完了

        foreach ($get_tasks as $task) {
            // 優先度の表示を文字に（数値→文字）
            $priority = $task->priority;
            if ($priority == 1) {
                $task->priority = "至急";
            } elseif ($priority == 2) {
                $task->priority = "高";
            } elseif ($priority == 3) {
                $task->priority = "中";
            } elseif ($priority == 4) {
                $task->priority = "低";
            }

            // 状態ごとに配列を分ける
            if ($task->status == 1) {
                // 未対応
                $not_tasks[] = $task;
            } elseif ($task->status == 2) {
                // 処理中
                $process_tasks[] = $task;
            } elseif ($task->status == 3) {
                // 確認待ち
                $wait_tasks[] = $task;
            } elseif ($task->status == 4) {
                // 完了
                $completion_tasks[] = $task;
            }
        }
        return view('tasks.index', compact('not_tasks', 'process_tasks', 'wait_tasks', 'completion_tasks'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'task_name' => 'required|max:100',
        ];
        
        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
        
        Validator::make($request->all(), $rules, $messages)->validate();

        //モデルをインスタンス化
        $task = new Task;
        
        //モデル->カラム名 = 値 で、データを割り当てる
        $task->name = $request->input('task_name');
        
        //データベースに保存
        $task->save();
        
        //リダイレクト
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        var_dump($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //「編集する」ボタンをおしたとき
        if ($request->status === null) {
            $rules = [
                'task_name' => 'required|max:100',
            ];
        
            $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
        
            Validator::make($request->all(), $rules, $messages)->validate();
        
        
            //該当のタスクを検索
            $task = Task::find($id);
        
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->name = $request->input('task_name');
            $task->limit = $request->input('tsask_date');
            $task->status = $request->input('task_status');
            $task->priority = $request->input('task_priority');
        
            //データベースに保存
            $task->save();
        } else {
            //「完了」ボタンを押したとき
        
            //該当のタスクを検索
            $task = Task::find($id);
        
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->status = 4; //true:完了、false:未完了
        
            //データベースに保存
            $task->save();
        }
        
        
        //リダイレクト
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect('/tasks');
    }
}
