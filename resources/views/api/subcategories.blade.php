<!DOCTYPE html>
<html>
<head>
    <title>Subcategory List</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Subcategory List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
          <tbody>
    @foreach($subcategories as $subcategory)
        <tr>
            <td>{{ $subcategory->id }}</td>
            <td>{{ $subcategory->name }}</td>
            <td>{{ $subcategory->category ? $subcategory->category->name : '-' }}</td>
            <td>{{ $subcategory->description }}</td>
        </tr>
    @endforeach
</tbody>
        </tbody>
    </table>
</body>
</html>
