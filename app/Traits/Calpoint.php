<?php namespace App\Traits;

trait Calpoint {

    public function profilePoint($reviews)
    {
        // レビュー件数、評価件数、平均を取得
        $post_count = $reviews->count();
        $eval_count = 0;
        $eval_ave = 0;
        // \Debugbar::info($reviews);
        foreach ($reviews->get() as $review) {
            $eval_count += $review->evaluations->count();
            $eval_ave += $review->evaluations->sum('review_eval');
        }
        if($eval_count == 0) {
            $eval_ave = " -";
        }
        else {
            $eval_ave = "☆".number_format(round($eval_ave / $eval_count, 1), 1);
        }

        // 計算結果を配列に格納
        $datas = array('post_count' => $post_count,
                        'eval_count' => $eval_count,
                        'eval_ave' => $eval_ave);
        //\Debugbar::info($datas);

        return $datas;
    }

    public function reviewPoint($reviews)
    {
        // レビュー件数を取得
        $review_count = $reviews->count();

        // 平均値、トリム平均、中央値を取得
        if($review_count == 0) {
            $average = " -";
            $trim_ave = " -";
            $median = " -";
        }
        else {
            $review_points = $reviews->pluck('review_point')->sort();
            $average = round($review_points->avg(), 0);
            $trim_ave = round($review_points->slice($review_count/10, round($review_count * 0.8, 0))->avg(), 0);
            $median = round($review_points->median(), 0);
        }

        // 計算結果を配列に格納
        $datas = array('review_count' => $review_count,
                        'average' => $average,
                        'trim_ave' => $trim_ave,
                        'median' => $median);

        return $datas;
    }
}
