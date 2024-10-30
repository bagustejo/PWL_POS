<!DOCTYPE html>
<html>
<head>
    <title>Formulir Ubah Data Pengguna</title>
</head>
<body>
    <h1>Formulir Ubah Data Pengguna</h1>

    <a href="{{ url('/user') }}">KEMBALI KE LIST</a>

    <form method="POST" action="{{ url('/user/ubah_simpan/' . $data->user_id) }}"> 
        @csrf
        @method('PUT')
        <table border="0" cellpadding="5">
            <tr>
                <td>Username</td>
            </tr>
            <tr>
                <td><input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username', $data->username) }}" required></td>
            </tr>
            <tr>
                <td>Nama</td>
            </tr>
            <tr>
                <td><input type="text" name="nama" placeholder="Masukkan Nama" value="{{ old('nama', $data->nama) }}" required></td>
            </tr>
            <tr>
                <td>Password Baru</td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Masukkan Password Baru" value="{{ old('password', $data->password) }}" required></td>
            </tr>
            <tr>
                <td>Level ID</td>
            </tr>
            <tr>
                <td><input type="number" name="level_id" placeholder="Masukkan ID Level" value="{{ old('level_id', $data->level_id) }}" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="btn btn-success" value="Simpan Perubahan"></td>
            </tr>
        </table>
    </form>
</body>
</html>
