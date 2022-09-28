@extends('layout.application')
@section('content')
<?php echo $error; ?>
<a href="{{ route('gotop') }}"><button class="topbutton">Topへ戻る</button></a>
@endsection
