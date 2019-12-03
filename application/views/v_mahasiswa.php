<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= $judul ?> - Pemrograman Web Framework Lanjut</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>jquery.dataTables.min.css">
	<style type="text/css">
		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}


		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}



		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>

<body>

	<div id="container">
		<h1>
			<a href="<?= base_url() ?>">
				<?= $judul ?>
			</a> /
			<a href="<?= base_url('mahasiswa/log') ?>">
				Log Perubahan
			</a>

		</h1>

		<center>
			<H3><?= $this->session->flashdata('msg'); ?></H3>
		</center>


		<div id="body">
			<a href="<?= base_url('mahasiswa/insert') ?>">
				<H3>Tambah Data<H3>
			</a>
			<div id="content">
				<table id="tabel" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<th width="3%">No</th>
						<th width="10%">NIM</th>
						<th width="30%">Nama</th>
						<th width="9%">Jenis Kelamin</th>
						<th>Alamat</th>
						<th>No. Handphone</th>
						<th width="15%">Aksi</th>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($mahasiswa as $m) { ?>
							<tr>

								<td align="center"><?= $no++ ?></td>
								<td><?= $m->nim ?></td>
								<td><?= $m->nama ?></td>
								<td align="center"><?= ($m->jk == "L") ? "Laki-laki" : "Perempuan" ?></td>
								<td><?= $m->alamat ?></td>
								<td><?= $m->no_hp ?></td>
								<td align="center"><a href="<?= base_url('mahasiswa/update/') . encrypt_url($m->nim) ?>">Update</a> | <a href="<?= base_url('mahasiswa/delete/') . encrypt_url($m->nim) ?>">Delete</a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

	<script src="<?= base_url('assets/js/') ?>jquery.min.js"></script>
	<script src="<?= base_url('assets/js/') ?>jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets/js/') ?>dataTables.bootstrap.min.js"></script>
	<script>
		$(function() {
			$('#tabel').DataTable()
		})
	</script>
</body>

</html>