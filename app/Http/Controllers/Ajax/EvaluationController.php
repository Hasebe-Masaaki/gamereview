<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Evaluation;
use App\Report;

use Auth;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    public function rateit(Request $request)
    {
        //\Debugbar::info($request);
        // Validationをかける
        $this->validate($request, Evaluation::$rules);

        // Evaluation Modelからデータを取得する
        $report = new Evaluation;
        $report->review_id = $request->review_id;
        $report->user_id = Auth::id();

        // 既存レコードがなければ新規登録、あれば更新
        $eval_record = Evaluation::where('review_id', $report->review_id)
                                    ->where('user_id', $report->user_id)->first();
        if(empty($eval_record)) {
            $report->created_at = Carbon::now();
        }
        else {
            $report = $eval_record;
        }

        // 送信されてきたフォームデータを格納する
        $report->review_eval = $request->review_eval;
        $report->updated_at = Carbon::now();

        // 該当するデータを上書きして保存する
        //\Debugbar::info($report);
        $report->save();

        return;
    }

    public function getrate(Request $request)
    {
        //\Debugbar::info($request);

        // 既存レコードがあれば評価値を取得
        $eval_record = Evaluation::where('review_id', $request->review_id)
                                    ->where('user_id', $request->login_id)->first();

        if(empty($eval_record)) {
            $review_eval = "-";
        }
        else {
            $review_eval = "☆".number_format($eval_record->review_eval, 1);
        }

        return $review_eval;
    }

    public function report(Request $request)
    {
        //\Debugbar::info($request);
        // Validationをかける
        $this->validate($request, Report::$rules);

        // Evaluation Modelからデータを取得する
        $report = new Report;
        $report->review_id = $request->review_id;
        $report->user_id = Auth::id();

        // 既存レコードがなければ新規登録、あれば更新
        $report_record = Report::where('review_id', $report->review_id)
                                    ->where('user_id', $report->user_id)->first();
        if(empty($report_record)) {
            $report->created_at = Carbon::now();
        }
        else {
            $report = $report_record;
        }
        $report->updated_at = Carbon::now();

        // 該当するデータを上書きして保存する
        //\Debugbar::info($report);
        $report->save();

        return;
    }
}
