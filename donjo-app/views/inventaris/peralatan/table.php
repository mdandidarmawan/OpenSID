<script src="<?php echo base_url('assets/js/sweetalert.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-validation-1.17.0/dist/jquery.validate.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-validation-1.17.0/dist/jquery.validate.min.js') ?>"></script>
<style>
	#footer
	{
		color: #f83535;
		text-shadow: 1px 1px 0.5px #444;
		padding: 8px;
		text-align: center;
		position: relative;
		bottom: 0px;
		width: 100%;
		background: #eaa852;
		height: 34px;
		position: fixed;
	}
	input[type=search] {
		width: 200px;
    	height: 30px;
	}
</style>
<div id="myModalExcel" class="modal fade" role="dialog" style="padding-top:30px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unduh Inventaris</h4>
      </div>
	  	<form action="" target="_blank" class="form-horizontal" method="get" >
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label required" style="text-align:left;" for="nama_barang">Tahun</label>
					<div class="col-sm-9">
						<select name="tahun" id="tahun" class="form-control">
							<option value="1">Semua Tahun</option>
							<?php for ($i=date("Y"); $i>=date("Y")-30; $i--): ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label required" style="text-align:left;" for="penandatangan">Penandatangan</label>
					<div class="col-sm-9">
						<select name="penandatangan" id="penandatangan" class="form-control">
							<?php foreach ($pamong AS $data): ?>
								<option value="<?= $data['pamong_id']?>" data-jabatan="<?= trim($data['jabatan'])?>"
									<?= (strpos(strtolower($data['jabatan']),'Kepala Desa') !== false) ? 'selected' : '' ?>>
									<?= $data['pamong_nama']?>(<?= $data['jabatan']?>)
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary pull-right"  id="form_download" name="form_download"  data-dismiss="modal">Unduh</button>		
			</div>

		</form>
    </div>

  </div>
</div>
<div id="myModal" class="modal fade" role="dialog" style="padding-top:30px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cetak Inventaris</h4>
      </div>
	  	<form action="" target="_blank" class="form-horizontal" method="get" >
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label required" style="text-align:left;" for="tahun_pdf">Tahun</label>
					<div class="col-sm-9">
						<select name="tahun_pdf" id="tahun_pdf" class="form-control">
							<option value="1">Semua Tahun</option>
							<?php for ($i=date("Y"); $i>=date("Y")-30; $i--): ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label required" style="text-align:left;" for="penandatangan_pdf">Penandatangan</label>
					<div class="col-sm-9">
						<select name="penandatangan_pdf" id="penandatangan_pdf" class="form-control">
							<?php foreach ($pamong AS $data): ?>
								<option value="<?= $data['pamong_id']?>" data-jabatan="<?= trim($data['jabatan'])?>"
									<?= (strpos(strtolower($data['jabatan']),'Kepala Desa') !== false) ? 'selected' : '' ?>>
									<?= $data['pamong_nama']?>(<?= $data['jabatan']?>)
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary pull-right"  id="form_cetak" name="form_cetak"  data-dismiss="modal">Cetak</button>
			</div>

		</form>
    </div>

  </div>
</div>

<div id="row">
<div class="col-lg-2">
	<div class="panel panel-default">
		<div class="panel-heading">Menu</div>
		<div class="panel-body">
			<?php
				$data['data'] = 1;
				$this->load->view('inventaris/peralatan/menu_kiri.php',$data);
			?>
		</div>
	</div>
</div>
<div class="col-lg-10">
	<div id="container">
		<form id="mainformexcel" name="mainformexcel" action="" method="post">
		  <div class="ui-layout-north panel">
				<div class="panel panel-default">
					<div class="panel-heading">
						Daftar Inventaris Peralatan dan Mesin Desa
					</div>
					<div class="panel-body">
						<div class="pull-right">
              				<a class="btn btn-primary" href="<?= base_url('index.php/inventaris_peralatan/form'); ?>" style="color:white;">
								<i class="fa fa-plus"></i> Tambah
							</a>
		        </div>
						<div class="pull-left">
							<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-file-pdf-o"></i> Cetak
							</a>
							<a type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalExcel">
								<i class="fa fa-file-excel-o"></i> Unduh Excel
							</a>
				 		 </div>

					</div>
					<div class="panel-body">
					<table id="example" class="stripe cell-border table" class="grid" style="width:100%;">
						<thead style="background-color:#f9f9f9;" >
						<tr>
							<th class="text-center" rowspan="2">No</th>
							<th class="text-center" rowspan="2">Nama Barang</th>
							<th class="text-center" rowspan="2">Kode Barang</th>
							<th class="text-center" rowspan="2">Merk/Type</th>
							<th class="text-center" rowspan="2">Tahun Pembelian</th>
							<th class="text-center" colspan="2">Nomor</th>
							<th class="text-center" rowspan="2">Asal Usul</th>
							<th class="text-center" rowspan="2">Harga (Rp)</th>
							<th class="text-center" rowspan="2" width="100px">Aksi</th>
						</tr>
						<tr>
							<th class="text-center" style="text-align:center;" rowspan="1">Polisi</th>
							<th class="text-center" style="text-align:center;" rowspan="1">BPKB</th>
						</tr>
						</thead>
						<tbody>
							<?php foreach ($main as $data): ?>
								<?php if ($data->status == "1"): ?>
									<tr style='background-color:#cacaca'>
								<?php else: ?>
									<tr>
								<?php endif; ?>
									<td></td>
									<td><?= $data->nama_barang;?></td>
									<td><?= $data->kode_barang;?></td>
									<td><?= $data->merk;?></td>
									<td><?= $data->tahun_pengadaan;?></td>
									<td>
										<?= (empty($data->no_polisi)) ? "-" : $data->no_polisi ?>
									</td>
									<td>
										<?= (empty($data->no_bpkb)) ? "-" : $data->no_bpkb ?>
									</td>
									<td><?= $data->asal;?></td>
									<td><?= number_format($data->harga,0,".",".");?></td>
									<td>
										<div class="btn-group" role="group" aria-label="...">
											<?php if ($data->status == "0"): ?>
												<a href="<?= base_url('index.php/inventaris_peralatan/form_mutasi/'.$data->id); ?>" title="Mutasi Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-external-link-square"></i></a>
											<?php endif; ?>
											<a href="<?= base_url('index.php/inventaris_peralatan/view/'.$data->id); ?>" title="Lihat Data" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
											<a href="<?= base_url('index.php/inventaris_peralatan/edit/'.$data->id); ?>" title="Edit Data"  type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> </a>
											<button href="" onclick="deleteItem(<?= $data->id; ?>)" title="Hapus Data" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="8" style="text-align:right">Total:</th>
								<th><?= number_format($total,0,".","."); ?></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
					</div>
					</div>
			</form>
	</div>
</div>

<script  TYPE='text/javascript'>
	function deleteItem($id)
	{
		swal(
		{
			title: "Apakah Anda Yakin?",
			text: "Setelah dihapus, Data hanya dapat dipulihkan di database!!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) =>
		{
			if (willDelete)
			{
				swal("Data berhasil dihapus!",
				{
					icon: "success",
				});

				window.location = "api_inventaris_peralatan/delete/" + $id;
			}
			else
			{
				swal("Data tidak berhasil dihapus!");
			}
		});
	}
	
	$(document).ready(function() {
		var t = $('#example').DataTable( {
			scrollY					: '100vh',
			scrollCollapse	: true,
			autoWidth				: true,
    	"columnDefs": [
    	{
        	"searchable": false,
        	"orderable": false,
        	"targets": 0
    	} ],
    	"order": [[ 1, 'asc' ]]
  	} );
		t.on( 'order.dt search.dt', function ()
		{
			t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();

	} );

	$("#form_cetak").click(function( event )
	{
		var link = '<?= site_url("inventaris_peralatan/cetak"); ?>'+ '/' + $('#tahun_pdf').val() + '/' + $('#penandatangan_pdf').val();
		window.open(link, '_blank');
		// alert('fell');
  });

	$("#form_download").click(function( event )
	{
		var link = '<?= site_url("inventaris_peralatan/download"); ?>'+ '/' + $('#tahun').val() + '/' + $('#penandatangan').val();
		window.open(link, '_blank');
		// alert('fell');
  });

</script>