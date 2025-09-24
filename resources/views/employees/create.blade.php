<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Pegawai</title>
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Form Pegawai</h1>
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <table>
                    <tr>
                        <td>Nama Lengkap:</td>
                        <td><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" value="{{ old('email') }}" required></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon:</td>
                        <td><input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir:</td>
                        <td><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required></td>
                    </tr>
                    <tr>
                        <td>Alamat:</td>
                        <td><textarea name="alamat" required>{{ old('alamat') }}</textarea></td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk:</td>
                        <td><input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status" required>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit">Simpan</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
