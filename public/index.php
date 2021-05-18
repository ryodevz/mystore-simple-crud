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

require_once '../bootstrap/core.php';
allowedMethods(['GET'], true);

Auth::start();

if (!Auth::check()) {
    return redirect('/auth/login.php');
}

$items = Database::query('SELECT * FROM barang ORDER BY id DESC');

?>
<?php component('header') ?>
<div class="content wrapping">
    <h3 class="content-title"><?= ___('Data Barang') ?></h3>
    <div class="content-body">
        <?php if (isset($_GET['status'])) : ?>
            <?php if ($_GET['action'] == 'delete') : ?>
                <div class="mb-2 alert bg-green text-light">
                    <p>Barang dengan id <?= e($_GET['item_id']) ?> berhasil di hapus.</p>
                </div>
            <?php elseif ($_GET['action'] == 'create') : ?>
                <div class="mb-2 alert bg-green text-light">
                    <p>Berhasil di tambahkan.</p>
                </div>
            <?php endif ?>
        <?php endif ?>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                    <th>Harga jual</th>
                    <th>Harga beli</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $loop___ = 1 ?>
                <?php foreach ($items as $item) : ?>
                    <tr class="centered">
                        <td><?= $loop___++ ?></td>
                        <td><?= e($item['nama']) ?></td>
                        <td><?= e($item['jenis']) ?></td>
                        <td><?= e($item['stok']) ?></td>
                        <td><?= e($item['harga_jual']) ?></td>
                        <td><?= e($item['harga_beli']) ?></td>
                        <td>
                            <img src="<?= $item['image'] ?>" width="50px" />
                        </td>
                        <td>
                            <form action="/destroy.php?id=<?= e($item['id']) ?>" method="POST" style="display: inline;">
                                <?= setMethod('delete') ?>
                                <button type="submit" class="btn bg-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            <a href="/edit.php?id=<?= e($item['id']) ?>" class="btn bg-warning"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php component('footer') ?>