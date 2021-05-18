<?php

/*
|--------------------------------------------------------------------------
| Author
|--------------------------------------------------------------------------
|
| Name: Ryo ID
| Repo: https://github.com/ryodevz/mystore-simple-crud
|
*/

use Illuminate\Support\Auth;
use Illuminate\Support\Database;
use Illuminate\Support\Str;

require_once '../bootstrap/core.php';
allowedMethods(['GET', 'POST'], true);

Auth::start();

if (!Auth::check()) {
    return redirect('/auth/login.php');
}

if (isset($_POST['btn-submit'])) {

    $item = $_POST;
    $newFileName = Str::random(10) . '.jpg';
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        if (in_array($image['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {
            if (in_array(Str::lower(explode('.', $image['name'], 2)[1]), ['png', 'jpg', 'jpeg'])) {
                if ($image['size'] < 11044070) {

                    $path___ = 'uploads/' . $newFileName;

                    if (@move_uploaded_file($image['tmp_name'], $path___)) {

                        // https://stackoverflow.com/questions/10130915/how-to-auto-resize-uploaded-image-using-php
                        $orig_image = imagecreatefromjpeg($path___);
                        $image_info = getimagesize($path___);
                        $width_orig  = $image_info[0]; // current width as found in image file
                        $height_orig = $image_info[1]; // current height as found in image file
                        $width = 1024; // new image width
                        $height = 768; // new image height
                        $destination_image = imagecreatetruecolor($width, $height);
                        imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                        // This will just copy the new image over the original at the same$path___.
                        imagejpeg($destination_image, $path___, 100);

                        $nama = $item['nama'];
                        $jenis = $item['jenis'];
                        $stok = (int)$item['stok'];
                        $harga_beli = (int)$item['harga_beli'];
                        $harga_jual = (int)$item['harga_jual'];
                        $expired = $item['expired'];
                        $ket_barang = $item['ket_barang'];

                        $status = validate([
                            [
                                'name' => 'nama',
                                'rules' => 'required|min:3',
                            ],
                            [
                                'name' => 'jenis',
                                'rules' => 'required',
                            ],
                            [
                                'name' => 'stok',
                                'rules' => 'required|integer',
                            ],
                            [
                                'name' => 'harga_beli',
                                'rules' => 'required|integer',
                            ],
                            [
                                'name' => 'harga_jual',
                                'rules' => 'required|integer',
                            ],
                            [
                                'name' => 'expired',
                                'rules' => 'required',
                            ],
                        ]);

                        unset($item['btn-submit']);

                        if ((isset($status['status']) ? $status['status'] : false)) {

                            $imagePath = $path___;

                            Database::query("INSERT INTO `barang` (`id`, `nama`, `jenis`, `stok`, `harga_beli`, `harga_jual`, `image`, `expired`, `ket_barang`) VALUES (NULL, '$nama', '$jenis', '$stok', '$harga_beli', '$harga_jual', '$imagePath', '$expired', '$ket_barang')");

                            return redirect('/?action=create&status=success');
                        }
                    } else {
                        setError('ada yang salah!');
                    }
                } else {
                    setError('Ukuran gambar terlalu besar!');
                }
            } else {
                setError('Ektensi Gambar tidak di perbolehkan!');
            }
        } else {
            setError('Type Gambar tidak di perbolehkan!');
        }
    } else {
        setError('Gambar tidak valid!');
    }
}

?>
<?php component('header') ?>
<div class="content wrapping">
    <h3 class="content-title"><?= ___('Create') ?></h3>
    <?php if (firstError()) : ?>
        <div class="mb-2">
            <p class="text-red"><?= firstError() ?></p>
        </div>
    <?php endif ?>
    <form action="" method="POST" class="content-body" enctype="multipart/form-data">

        <table class="table">
            <tr class="text-start">
                <th>Nama</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="nama" value="<?= e((old('nama'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Jenis</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="jenis" value="<?= e((old('jenis'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Stok</th>
                <td>:</td>
                <td><input type="number" class="form-control" name="stok" value="<?= e((old('stok'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Harga beli</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="harga_beli" value="<?= e((old('harga_beli'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Harga jual</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="harga_jual" value="<?= e((old('harga_jual'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Kadaluarsa</th>
                <td>:</td>
                <td><input type="date" class="form-control" name="expired" value="<?= e((old('expired'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Image</th>
                <td>:</td>
                <td>
                    <input type="file" name="image" />
                </td>
            </tr>
            <tr class="text-start">
                <th>Ket</th>
                <td>:</td>
                <td>
                    <textarea class="form-control" name="ket_barang" cols="30" rows="10" placeholder="Ket"><?= e((old('ket_barang'))) ?></textarea>
                </td>
            </tr>
        </table>

        <div class="">
            <button type="submit" name="btn-submit" value="true" class="btn bg-blue">Create</button>
        </div>
    </form>
</div>
<?php component('footer') ?>