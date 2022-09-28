@extends('layout.application')
@section('content')
<table>
    <thead>
        <tr>
                <?php
                $array = ['楽曲名','難易度','Lv','クリアランク','グレード','スコア','EXスコア','プレー','クリア','UC','PUC'];
                foreach($array as $val){
                    echo '<th>' . $val . '</th>';
                }
                ?>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($result as $val){
    ?>
    <tr>
      <?php
      for($i=0;$i<11;$i++){
        if($i == 9 || $i == 10){
          if($val[$i] == 0){echo'<td>' . "未達成" . '</td>';}
          else{echo '<td>' . "達成" . '</td>';}
        }else{
          echo '<td>' . $val[$i] . '</td>';
        }
      }
    } ?>
    </tr>
    </tbody>
</table>
<div class="tweet"><a href="https://twitter.com/share?url=https://do.gt-gt.org/tweet-button/&amp;text=今日の課題曲→<?php for($i=0;$i<count($result);$i++){echo 'Lv' . $result[$i][2] . ' ' . $result[$i][0] . '/';} ?>" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>

<p>あなたの推定VF:<?php echo $vf ?></p>
<p>スコアアップでVFを上げよう</p>
<table>
    <thead>
        <tr>
                <?php
                $array = ['楽曲名','難易度','Lv','クリアランク','グレード','スコア','EXスコア','プレー','クリア','UC','PUC'];
                foreach($array as $val){
                    echo '<th>' . $val . '</th>';
                }
                ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($vfkadai as $val){
        ?>
        <tr>
        <?php
        for($i=0;$i<11;$i++){
            if($i == 9 || $i == 10){
            if($val[$i] == 0){echo'<td>' . "未達成" . '</td>';}
            else{echo '<td>' . "達成" . '</td>';}
            }else{
            echo '<td>' . $val[$i] . '</td>';
            }
        }
        } ?>
        </tr>
    </tbody>
</table>

<div class="tweet"><a href="https://twitter.com/share?url=https://do.gt-gt.org/tweet-button/&amp;text=VF課題曲→<?php for($i=0;$i<count($vfkadai);$i++){echo 'Lv' . $vfkadai[$i][2] . ' ' . $vfkadai[$i][0] . '/';} ?>" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
@endsection
