<!DOCTYPE html>
<html>
<head>
    <title>category List</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>category List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                >
            </tr>
        </thead>
        <tbody>
    <tbody>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        
    </tr>
    @endforeach
</tbody>
</tbody>
        </tbody>
    </table>
</body>
</html>