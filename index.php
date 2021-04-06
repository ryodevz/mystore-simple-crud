<?php

require_once 'helpers.php';
require_once 'connection.php';

$items = query('SELECT * FROM barang ORDER BY id DESC');

?>
<?php include 'components/header.php' ?>
<div class="content wrapping">
    <h3 class="content-title">Data Barang</h3>
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
                    <th>Kadaluarsa</th>
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
                        <td><?= e($item['expired']) ?></td>
                        <td>
                            <a href="/edit.php?id=<?= e($item['id']) ?>" class="btn bg-warning">Edit</a>
                            <a href="/delete.php?id=<?= e($item['id']) ?>" class="btn bg-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'components/footer.php' ?>