@extends('layout.application')

@section('content')
<h2>使い方</h2>
<p class="generate">下のエリアにscore.csvの内容を貼り付けると課題曲を出力します</p>
<p class="generate">絞り込みをしなければ全プレイ楽曲からランダムに選出されます</p>
<p class="generate">VOLFORCE課題曲は３曲固定です</p>

<form method="post" action="{{ route('select') }}">
  @csrf

    <textarea name="score" cols="60" rows="10"></textarea>

<p>レベル</p>
  <div class="kakoi">
        <?php
            for($i=1;$i<=20;$i++){
            echo ' <label><input type="checkbox" name="level[]" value=" ' . $i . ' " > ' . $i . ' </label> ';
            }
        ?>
    </div>
<p>難易度</p>
    <div class="kakoi">
        <?php
            $diff = ['NOVICE', 'ADVANCED', 'EXHAUST', 'MAXIMUM', 'INFINITE', 'GRAVITY', 'HEAVENLY', 'VIVID', 'EXCEED'];
            foreach($diff as $val){
                echo ' <label><input type="checkbox" name="diff[]" value=" ' . $val . ' " > ' . $val . ' </label> ';
            }
        ?>
    </div>
<p>グレード</p>
    <div class="kakoi">
        <?php
            $glade = ['D', 'C', 'B', 'A', 'A+', 'AA', 'AA+', 'AAA', 'AAA+', 'S'];
            foreach($glade as $val){
                echo ' <label><input type="checkbox" name="glade[]" value=" ' . $val . ' " > ' . $val . ' </label> ';
            }
        ?>
    </div>
<p>課題曲を<select name="num">
  <?php
  for($i=1;$i<=10;$i++){
      if($i == 3){
          echo ' <option  selected value=" ' . $i . ' "> ' . $i . '</option>';
      }else{
          echo ' <option value=" ' . $i . ' "> ' . $i . '</option>';
      }
  }
  ?>
</select>曲生成！</p>
<button>表示</button>
</form>
@endsection
