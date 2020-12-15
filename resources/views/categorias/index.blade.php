<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>valor</th>
            <th>cat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->nome }}</td>
                <td>{{ $category->valor }}</td>
                <td>{{ $category->catg }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
