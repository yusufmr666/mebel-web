<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
              
                color: black;
            }
        </style>
    </head>
    <body>
        <div style="text-align:center">
            <h3> Laporan Pemesanan Anwar Jaya Funiture</h3>
        </div>
        <div class="mt-4">
        <table id="table">
            <thead>
                <tr>
                    <th>Id Transaksi</th>
                    <th>Tanggal Pembelian</th>            
                    <th>Nama Produk</th>
                    <th>Dikerjakan Oleh</th>
                    <th>Keterangan</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($wait->result() as $row) :?>
                    <?php foreach($this->mebel_model->get_chart($row->id_user,$row->id_transaksi)->result() as $rows):?>
                <tr>                 
                    <td scope="row"><?= $row->id_transaksi?></td>
                    <td scope="row"><?= tgl_indonesia($rows->tgl_pesan)?></td>
                     
                         
                            <td>
                                <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                                ><span class="fw-medium"><?= $rows->nama?></span>
                            </td>                           
                            <td><?=$rows->nama_tukang?></td>
                            <td><span class="badge <?php 
                            $status = $rows->status;
                            if($status == 'Pesan'){
                                $pesan = 'bg-label-secondary';
                            } else {
                                $pesan = 'bg-label-warning';
                            }
                            echo $pesan;?>"><?=$row->status?></span></td>
                             <td><span><?php if(empty($row->bukti)){echo "Belum Lunas";} else {echo "Lunas";}?></span></td>
                      
                   
                    <!--
                    <td>Kacang Goreng</td>
                    <td>Rp5.000,-</td>
                    <td>1</td>
                    <td>25 Oktober 2020, 17:01:03</td>
                    -->                   
                </tr>
                <?php endforeach?>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </body>
</html>

<?php
              	function tgl_indonesia($date){
                  $Bulan = array("Januari","Februari","Maret","April",
                          "Mei","Juni","Juli","Agustus","September",
                          "Oktober","November","Desember");
                  $Hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                  $tahun = substr($date, 0, 4);
                  $bulan = substr($date, 5, 2);
                  $tgl = substr($date, 8, 2);
                  $hari = date("w", strtotime($date));
                  return $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ";
                }
              ?>
              