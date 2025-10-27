<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อผู้ใช้</title>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            margin: 40px;
            background: #f7f7f7;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>รายชื่อผู้ใช้จากฐานข้อมูล</h1>

    @if($users->isEmpty())
        <p>ไม่มีข้อมูลผู้ใช้ในระบบ</p>
    @else
        <table>
            <tr>
                <th>ID</th>
                <th>ชื่อ</th>
                <th>อีเมล</th>
                <th>สถานะ</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</body>
</html>
