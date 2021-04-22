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

use Illuminate\Support\Database;

require_once '../bootstrap/core.php';

allowedMethods(['GET', 'POST'], true);

if (isset($_POST['btn-submit'])) {

    $item = $_POST;

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
        Database::query("INSERT INTO `barang` (`id`, `nama`, `jenis`, `stok`, `harga_beli`, `harga_jual`, `expired`, `ket_barang`) VALUES (NULL, '$nama', '$jenis', '$stok', '$harga_beli', '$harga_jual', '$expired', '$ket_barang')");

        return redirect('/?action=create&status=success');
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
    <form action="" method="POST" class="content-body">

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
                <td><input type="number" class="form-control" name="harga_beli" value="<?= e((old('harga_beli'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Harga jual</th>
                <td>:</td>
                <td><input type="number" class="form-control" name="harga_jual" value="<?= e((old('harga_jual'))) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Kadaluarsa</th>
                <td>:</td>
                <td><input type="date" class="form-control" name="expired" value="<?= e((old('expired'))) ?>"></td>
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