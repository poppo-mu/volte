<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>課題曲ジェネレーター</title>
<link rel="stylesheet" href="css/style.css">
<meta name="description" content="サウンドボルテックスの課題曲ジェネレーターです">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <h1><a href="{{ route('gotop') }}">Sound Voltex 課題曲ジェネレーター</a></h1>
    </header>
    <main>
        <div>
            @yield('content')
        </div>
     </main>
</body>
</html>
