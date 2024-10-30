<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Data User</title>
</head>
<body>
    <h1>Form Tambah Data User</h1>

    <a href="{{ url('/user') }}">Kembali</a>
    <br><br>

    <!-- Tampilkan pesan error global -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('/user/tambah_simpan/') }}"> 
        @csrf

        <table border="0" cellpadding="5">
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
                    <!-- Tampilkan pesan error untuk kolom ini -->
                    @error('username')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                    @error('nama')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="Masukkan Password">
                    @error('password')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Level ID</td>
                <td>
                    <input type="number" name="level_id" placeholder="Masukkan ID Level" value="{{ old('level_id') }}">
                    @error('level_id')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>
</html>
