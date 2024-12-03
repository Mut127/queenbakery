<!-- resources/views/emails/pelamar_accepted.blade.php -->
<!DOCTYPE html>
<html>

<body>
    <h1>Selamat, {{ $name }}!</h1>
    <p>Kami senang mengumumkan bahwa Anda DITERIMA untuk posisi {{ $kategori_id }}.</p>
    <p>Silakan datang ke kantor untuk proses selanjutnya.</p>
    <p>Terima kasih,<br>Tim Rekrutmen</p>
</body>

</html>

<!-- resources/views/emails/pelamar_rejected.blade.php -->
<!DOCTYPE html>
<html>

<body>
    <h1>Terima Kasih, {{ $name }}</h1>
    <p>Setelah melalui pertimbangan yang mendalam, kami mohon maaf memberitahu bahwa Anda TIDAK DITERIMA untuk posisi {{ $kategori_id }} pada saat ini.</p>
    <p>Kami menghargai minat dan waktu Anda dalam melamar.</p>
    <p>Tetap semangat,<br>Tim Rekrutmen</p>
</body>

</html>