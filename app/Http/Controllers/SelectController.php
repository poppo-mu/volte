<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function select(Request $request){
        $array = explode("\n", trim($request->score));
        foreach($array as $key => $val){
            if($key == 0) continue;
            if(empty(trim($val))) continue;
            $score[] = explode(',', $val);
        }

        if(empty($score)){
            return view ('generator');
        }

        for($i=0; $i<count($score);$i++){
            if(
                count($score[$i]) != 11 ||
                is_numeric($score[$i][2]) && floor($score[$i][2]) <= 0 ||
                is_numeric($score[$i][2]) && floor($score[$i][2]) > 20 ||
                !is_numeric($score[$i][2]) ||
                is_numeric($score[$i][5]) && floor($score[$i][5]) <= 0 ||
                is_numeric($score[$i][5]) && floor($score[$i][5]) > 10000000||
                !is_numeric($score[$i][5]) ||
                is_numeric($score[$i][9]) && floor($score[$i][9]) < 0 ||
                is_numeric($score[$i][9]) && floor($score[$i][9]) > 2 ||
                !is_numeric($score[$i][9]) ||
                is_numeric($score[$i][10]) && floor($score[$i][10]) < 0 ||
                is_numeric($score[$i][10]) && floor($score[$i][10]) > 2 ||
                !is_numeric($score[$i][10])
                )
                {
                $error = '<p class="forerror">不正なテキストです</p><p class="forerror">もう一度お試しください</p>';
                break;
            }else{
                $error = 'エラーなし';
            }
        }
        if($error == '<p class="forerror">不正なテキストです</p><p class="forerror">もう一度お試しください</p>'){
            return view('error')
            ->with(['error' => $error]);
        }


        $req = new SelectController();
        $req->score = $score;
        $req->level = $request->level;
        $req->diff = $request->diff;
        $req->glade = $request->glade;

        $num = $request->num;

        $vf = SelectController::vf($req);
        $result = $req->score;
        foreach ($result as $key => $value) {
            $sort[$key] = $value['11'];
        }
        array_multisort($sort, SORT_DESC, $result);
        $volforce = $result;
        array_splice($volforce, 50, count($volforce)-50);
        if(count($volforce) >= 3){
            for($i = 0; $i < 3;$i++){
                $rand_sort_keys = array_rand($volforce, 3);
                $vfkadai[] = $volforce[$rand_sort_keys[$i]];
            }
        }else{
            $vfkadai = $volforce;
        }





        if(isset($request->level)){
            $result = SelectController::level($req);
            $req->score = $result;
        }
        if(isset($request->diff)){
            $result = SelectController::diff($req);
            $req->score = $result;
        }
        if(isset($request->glade)){
            $result = SelectController::glade($req);
            $req->score = $result;
        }

        if(empty($result)){
            $error = '<p class="forerror">絞り込みに該当する楽曲がありません</p>';
            return view ('error')
            ->with(['error' => $error]);
        }elseif(count($result) < $num){
            $kekka = $result;
        }else{
            for($i = 0; $i < $num;$i++){
                $rand_sort_keys = array_rand($result,$num);
                $kekka[] = $result[$rand_sort_keys[$i]];
            }
        }

        return view('result')
        ->with([
            'result' => $kekka,
            'vf' => $vf,
            'vfkadai' => $vfkadai,
            ]);
    }

    public function level($req){
        $result = [];
        $level = $req->level;
        $score = $req->score;
        for($i_level = 0; $i_level < count($level) ; $i_level++){
            $i = 0;
            foreach($score as $val){
                if(($score[$i][2] == $level[$i_level]) && ($i < count($score)) && ($i_level < count($level))){
                $result[] = $val;
                }
                $i++;
                }
            }
        return $result;
    }

    public function diff($req){
        $result = [];
        $diff = $req->diff;
        $score = $req->score;
        for($i_diff = 0; $i_diff < count($diff) ; $i_diff++){
            $i = 0;
            foreach($score as $val){
                if(($score[$i][1] == $diff[$i_diff]) && ($i < count($score)) && ($i_diff < count($diff))){
                $result[] = $val;
                }
                $i++;
                }
        }
    return $result;
    }

    public function glade($req){
        $result = [];
        $glade = $req->glade;
        $score = $req->score;
        for($i_glade = 0; $i_glade < count($glade) ; $i_glade++){
            $i = 0;
            foreach($score as $val){
                if(($score[$i][4] == $glade[$i_glade]) && ($i < count($score)) && ($i_glade < count($glade))){
                $result[] = $val;
                }
                $i++;
                }
        }
    return $result;
    }

    public function vf($req){
        $score = $req->score;
        $vf = 0;
        for($i=0; $i<count($score);$i++){
            if($score[$i][4] == 'S'){
                $val_glade = 1.05;
            }elseif($score[$i][4] == 'AAA+'){
                $val_glade = 1.02;
            }elseif($score[$i][4] == 'AAA'){
                $val_glade = 1.00;
            }elseif($score[$i][4] == 'AA+'){
                $val_glade = 0.97;
            }elseif($score[$i][4] == 'AA'){
                $val_glade = 0.94;
            }elseif($score[$i][4] == 'A+'){
                $val_glade = 0.91;
            }elseif($score[$i][4] == 'A'){
                $val_glade = 0.88;
            }elseif($score[$i][4] == 'B'){
                $val_glade = 0.85;
            }elseif($score[$i][4] == 'C'){
                $val_glade = 0.82;
            }else{
                $val_glade = 0.80;
            }

            if($score[$i][3] == 'PERFECT'){
                $val_rate = 1.10;
            }elseif($score[$i][3] == 'ULTIMATE CHAIN'){
                $val_rate = 1.05;
            }elseif($score[$i][3] == 'EXCESSIVE COMPLETE'){
                $val_rate = 1.02;
            }elseif($score[$i][3] == 'COMPLETE'){
                $val_rate = 1.00;
            }else{
                $val_rate = 0.5;
            }

            if($score[$i][2] >= 1 && $score[$i][2] <= 20 && $score[$i][5]>= 0 && $score[$i][5] <= 10000000){
                $volforce[] = floor($score[$i][2] * $score[$i][5] * $val_glade * $val_rate * 2 / 1000000) / 10;
            }else{
                break;
            }

        $score[$i][11] = floor($score[$i][2] * $score[$i][5] * $val_glade * $val_rate * 2 / 1000000) / 10;
        }

        if(!empty($volforce)){
            rsort($volforce);
            for($i=0; $i<50; $i++){
                if($i == count($volforce)){
                    break;
                }
                $vf = $vf + $volforce[$i] /100;
            }
        }

        $req->score = $score;
        if(isset($vf)){
            return $vf;
        }
    }
}
