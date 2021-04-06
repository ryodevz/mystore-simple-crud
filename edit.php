<?php

require_once 'helpers.php';
require_once 'connection.php';

$status_____ = false;

if (isset($_POST['btn-submit'])) {

    $id = e((int)$_GET['id']);

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
            'rules' => 'min:3|required',
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
        query("UPDATE `barang` SET `nama` = '$nama', `jenis` = '$jenis', `stok` = '$stok', `harga_beli` = '$harga_beli', `harga_jual` = '$harga_jual', `expired` = '$expired', `ket_barang` = '$ket_barang' WHERE `barang`.`id` = $id");

        $status_____ = true;
    }
} else {
    $id = e((int)$_GET['id'] ?? null);

    $item = query("SELECT * FROM barang WHERE id = $id")->fetch_assoc();

    if (!($item)) return die('Barang tidak di temukan.');
}


?>
<?php include 'components/header.php' ?>
<div class="content wrapping">
    <h3 class="content-title">Data</h3>
    <?php if (firstError()) : ?>
        <div class="mb-2">
            <p class="text-red"><?= firstError() ?></p>
        </div>
    <?php endif ?>
    <form action="" method="POST" class="content-body">
        <?php if ($status_____) : ?>
            <div class="mb-2 alert bg-green text-light">
                <p>Barang dengan id <?= e($_GET['id']) ?> berhasil di update.</p>
            </div>
        <?php endif ?>

        <table class="table">
            <tr class="text-start">
                <th>Nama</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="nama" value="<?= e((old('nama') ?? $item['nama'])) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Jenis</th>
                <td>:</td>
                <td><input type="text" class="form-control" name="jenis" value="<?= e((old('jenis') ?? $item['jenis'])) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Stok</th>
                <td>:</td>
                <td><input type="number" class="form-control" name="stok" value="<?= e((old('stok') ?? $item['stok'])) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Harga beli</th>
                <td>:</td>
                <td><input type="number" class="form-control" name="harga_beli" value="<?= e((old('harga_beli') ?? $item['harga_beli'])) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Harga jual</th>
                <td>:</td>
                <td><input type="number" class="form-control" name="harga_jual" value="<?= e((old('harga_jual') ?? $item['harga_jual'])) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Kadaluarsa</th>
                <td>:</td>
                <td><input type="date" class="form-control" name="expired" value="<?= e((old('expired') ?? $item['expired'])) ?>"></td>
            </tr>
            <tr class="text-start">
                <th>Ket</th>
                <td>:</td>
                <td>
                    <textarea class="form-control" name="ket_barang" cols="30" rows="10" placeholder="Ket"><?= e((old('ket_barang') ?? $item['ket_barang'])) ?></textarea>
                </td>
            </tr>
        </table>

        <div class="">
            <button type="submit" name="btn-submit" value="true" class="btn bg-blue">Update</button>
        </div>
    </form>
</div>
<?php include 'components/footer.php' ?>