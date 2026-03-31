<!DOCTYPE html>
<html>
    
<head>
    <title>registration List</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>registration List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Tim</th>
                <th>User</th>
                <th>Event</th>
            </tr>
        </thead>
        <tbody>
    <tbody>
    @foreach($registration as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->team_name }}</td>
        <td>{{ $item->user_id }}</td>
        <td>{{ $item->event_id }}</td>
    </tr>
    @endforeach
</tbody>
</tbody>
        </tbody>
    </table>
</body>
</html>