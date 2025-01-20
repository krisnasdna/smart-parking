<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Cards</title>
</head>
<body>
    <h1>Registered Cards</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Card ID</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cards as $card)
                <tr>
                    <td>{{ $card->id }}</td>
                    <td>{{ $card->card_id }}</td>
                    <td>{{ $card->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
