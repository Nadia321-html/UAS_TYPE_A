<?php
class Model_transaksi extends CI_Model
{
    function tampil_data()
    {
        $query = "SELECT td.t_detail_id, td.qty, td.harga, b.nama_barang, c.nama_kategori
        FROM transaksi_detail td, barang b, kategori_barang c
        WHERE b.barang_id = td.barang_id
        AND c.kategori_id = b.kategori_id
        AND td.status = '1'";
        return $this->db->query($query);
    }
    function tampilkan_detail_transaksi()
    {
        $query  = "SELECT td.t_detail_id, td.qty, td.harga, b.nama_barang
               FROM transaksi_detail AS td, barang AS b
               WHERE b.barang_id = td.barang_id AND td.status = '0'";

        return $this->db->query($query);
    }
    function simpan_barang()
    {
        $nama_barang = $this->input->post('barang');
        $qty = $this->input->post('qty');
        $idbarang = $this->db->get_where('barang', array('nama_barang' => $nama_barang))->row_array();
        $data = array('barang_id' => $idbarang['barang_id'], 'qty' => $qty, 'harga' => $idbarang['harga'], 'status' => '0');
        $this->db->insert('transaksi_detail', $data);
    }
    function hapusitem($id)
    {
        $this->db->where('t_detail_id', $id);
        $this->db->delete('transaksi_detail');
    }
    function selesai_belanja($data)
    {
        $this->db->insert('transaksi', $data);
        $last_id = $this->db->query("Select transaksi_id from transaksi order by transaksi_id desc")->row_array();
        $this->db->query("Update transaksi_detail set transaksi_id='" . $last_id['transaksi_id'] . "'where status='0'");
        $this->db->query("update transaksi_detail set status='1' where status='0'");
    }
    function laporan_default()
    {
        $query = "SELECT t.tanggal_transaksi, o.nama_lengkap, SUM(td.harga * td.qty) as total 
                  FROM transaksi as t, transaksi_detail as td, operator as o 
                  WHERE td.transaksi_id = t.transaksi_id AND o.operator_id = t.operator_id 
                  GROUP BY t.transaksi_id";
        return $this->db->query($query);
    }


    function laporan_periode($tanggal1, $tanggal2)
    {
        $query = "SELECT t.tanggal_transaksi, o.nama_lengkap, SUM(td.harga * td.qty) as total 
                  FROM transaksi as t, transaksi_detail as td, operator as o 
                  WHERE td.transaksi_id = t.transaksi_id AND o.operator_id = t.operator_id
                  AND t.tanggal_transaksi BETWEEN '$tanggal1' AND '$tanggal2'
                  GROUP BY t.transaksi_id";
        return $this->db->query($query);
    }
}
