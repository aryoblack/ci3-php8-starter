# CI3 PHP 8 Starter

Basis: CodeIgniter resmi 3.1.13 (MIT), dengan patch kompatibilitas lokal; bukan rilis resmi baru CI3.
Sumber: https://github.com/bcit-ci/CodeIgniter/tree/3.1.13
SHA256 arsip asli: 2E55FA5E1FC4BB22F2EA12058294EAFF5DEFD74347806ECAA4BD568094755778

## Pemakaian
1. Salin folder starter ke htdocs/nama-project. Aktifkan versi PHP yang dipilih pada Apache/PHP-FPM, bukan hanya CLI.
2. Atur CI_BASE_URL atau application/config/config.php sesuai alamat project.
3. Atur database sendiri pada application/config/database.php; koneksi database tidak diautoload.
4. Isi CI_ENCRYPTION_KEY dengan rahasia acak unik per project sebelum memakai enkripsi. Jangan memakai kunci uji Compat_check untuk produksi.
5. Folder application/cache/sessions dan application/logs harus dapat ditulis oleh server.
6. Buka http://localhost/ci3-php8/ (default) atau URL project masing-masing. index.php tetap dipakai; rewrite URL tidak diwajibkan.
7. Untuk produksi, atur CI_ENV=production pada server, HTTPS, cookie secure, izin folder, dan CSRF sesuai alur aplikasi. Jangan mengandalkan pengaturan development.

## Dependensi
PHP >=8.0 dan <8.5 pada manifest; versi 8.0 belum diuji karena runtime tidak tersedia. Target teruji: 8.1.10, 8.2.20, 8.3.29, 8.4.16.
PHP 8.5+ belum diklaim kompatibel dan dibatasi Composer sampai diuji.
Wajib pada starter berbasis MySQL: json, session, filter, hash, mbstring, mysqli.
Opsional sesuai modul: openssl (enkripsi), fileinfo (upload), zip (arsip), gd (gambar).
Tidak memerlukan plugin aaPanel khusus. Aktifkan ekstensi pada versi PHP website yang benar.
Tidak ada paket PDF, Excel, login, atau modul akademik yang disertakan; dependensi bisnis perlu diuji terpisah.
Composer tidak wajib untuk halaman awal. composer.json mendeklarasikan persyaratan starter tanpa mengunduh paket aplikasi tambahan.

## Verifikasi
Jalankan php index.php compat_check, atau composer check jika Composer tersedia.
Compat_check hanya dapat diakses via CLI; endpoint web mengembalikan 404.
Hasil pemeriksaan ada di TEST-RESULTS.json. Uji HTTP mencakup homepage dan sesi cookie dua request; enkripsi diuji roundtrip.
Pemeriksaan sintaks mencakup application/, system/, dan index.php pada PHP 8.4.
Ini smoke test, bukan sertifikasi seluruh fitur/driver CodeIgniter atau aplikasi pemakai.

## Dipakai pada project existing
Cadangkan project dan database, lalu migrasikan di salinan/staging.
Jangan menimpa application/ project existing dengan application/ starter ini.
Untuk mengganti framework, bandingkan patch lokal system/, gunakan system/ starter serta sesuaikan index.php dan konfigurasi yang diperlukan.
Update Composer dan dependensi aplikasi seperti PDF/Excel secara terpisah, lalu uji login, hak akses, session, database, AJAX, impor, cetak, dan upload.
Aplikasi datasiswa belum diubah ke framework starter ini.

## Patch dan keterbatasan
PHP8-PATCHES.json memuat daftar file dan penyesuaian framework.
Patch mempertahankan mekanisme dynamic properties CI3, nullable parameter, interpolasi, serta penggunaan pengaturan sesi native pada PHP 8.4.
Patch ini perlu dipelihara saat ada perubahan PHP/CI3. Dukungan versi PHP baru tidak otomatis.
