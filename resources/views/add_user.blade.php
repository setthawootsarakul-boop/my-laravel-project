<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มผู้ใช้ใหม่</title>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background: #f7f7f7;
            margin: 40px;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 6px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <h1>เพิ่มผู้ใช้ใหม่</h1>

    <form action="/users/add" method="POST">
        @csrf
        <label>ชื่อ:</label>
        <input type="text" name="name" required>

        <label>อีเมล:</label>
        <input type="email" name="email" required>

        <label>สถานะ:</label>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <button type="submit">เพิ่มผู้ใช้</button>
    </form>

    <p><a href="/users">กลับไปหน้ารายชื่อผู้ใช้</a></p>
</body>
</html>
