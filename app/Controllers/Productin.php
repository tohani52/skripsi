<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductinModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Productin extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productinModel = new ProductinModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
    }
    public function index()
    {
        $list_productin = $this->productinModel->get_all_data();
        $data = [
            'judul_page' => 'Pembelian ATK',
            'list_productin' => $list_productin,
            'sub_judul_page' => 'Table Data',
            'add' => '/add_productin',
            'update' => '/update_productin',
            'url_delete' => 'hapus_productin',
            'url' => 'productin'
        ];
        return view('admin_productin', $data);
    }
    public function create()
    {
        $list_product = $this->productModel->get_all_data();
        $data = [
            'validation' => $this->validation,
            'list_product' => $list_product,
            'action' => '/add_action_productin',
            'judul_page' => 'Pembelian ATK',
            'sub_judul_page' => 'Add',
            'back' => '/productin',
            'url_delete' => 'hapus_productin',
            'id_product' => old('id_product'),
            'qty' => 1,
            'description' => old('description'),
            'price' => old('price'),
            'id' => '',
            'id_user' => '',
            'url' => 'productin',
        ];
        return view('admin_productin_form', $data);
    }
    public function create_action()
    {
        $data = [
            'id_product'          => $this->request->getPost('id_product'),
            'description'          => $this->request->getPost('description'),
            'price'         => str_replace(".", "", str_replace(",", "", $this->request->getPost('price'))),
            'qty'         => str_replace(".", "", str_replace(",", "", $this->request->getPost('qty'))),
        ];
        $insert = $this->productinModel->insert_data($data);

        $rowProduct = $this->productModel->get_by_id($this->request->getPost('id_product'));
        $data = [
            'stock_product'         => $rowProduct['stock_product'] + str_replace(".", "", str_replace(",", "", $this->request->getPost('qty'))),
            'product_price'         => str_replace(".", "", str_replace(",", "", $this->request->getPost('price'))),
        ];
        $update = $this->productModel->update_data($data, $this->request->getPost('id_product'));

        if ($insert) {
            return redirect()->to(base_url() . '/productin');
        }
    }
    public function update($id)
    {
        $row = $this->productinModel->get_by_id($id);
        $list_product = $this->productModel->get_all_data();
        $data = [
            'validation' => $this->validation,
            'list_product' => $list_product,
            'action' => '/update_action_productin',
            'judul_page' => 'Pembelian ATK',
            'sub_judul_page' => 'Update',
            'back' => '/productin',
            'url_delete' => 'hapus_productin',
            'id' => $id,
            'id_product' => $row['id_product'],
            'price' => $row['price'],
            'qty' => $row['qty'],
            'description' => $row['description'],
            'url' => 'productin',
        ];
        return view('admin_productin_form', $data);
    }
    public function update_action()
    {
        $id = $this->request->getPost('id');
        $row = $this->productinModel->get_by_id($id);
        $data = [
            'id_product'          => $this->request->getPost('id_product'),
            'description'          => $this->request->getPost('description'),
            'price'         => str_replace(".", "", str_replace(",", "", $this->request->getPost('price'))),
            'qty'         => str_replace(".", "", str_replace(",", "", $this->request->getPost('qty'))),
        ];

        $update = $this->productinModel->update_data($data, $id);

        $rowProduct = $this->productModel->get_by_id($this->request->getPost('id_product'));
        $data = [
            'stock_product'         => $rowProduct['stock_product'] - $row['qty'] + str_replace(".", "", str_replace(",", "", $this->request->getPost('qty'))),
            'product_price'         => str_replace(".", "", str_replace(",", "", $this->request->getPost('price'))),
        ];
        $update = $this->productModel->update_data($data, $this->request->getPost('id_product'));

        if ($update) {
            return redirect()->to(base_url() . '/productin');
        }
    }

    public function delete($id)
    {

        $row = $this->productinModel->get_by_id($id);
        $rowProduct = $this->productModel->get_by_id($row['id_product']);
        $data = [
            'stock_product'         => $rowProduct['stock_product'] - $row['qty'],
        ];
        $update = $this->productModel->update_data($data, $row['id_product']);

        $delete = $this->productinModel->delete_data($id);
        if ($delete) {
            return redirect()->to(base_url() . '/productin');
        }
    }
    public function laporan()
    {

        $list_productin = $this->productinModel->get_all_data();
        $logo = base64_encode(file_get_contents('assets-admin/img/logo_pudc.png'));

        $data = [
            'judul_page' => 'Laporan Pembelian ATK',
            'logo' => $logo,
            'list_productin' => $list_productin,
        ];
        $filename = 'Laporan Pembelian ATK ';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan_productin', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => false));
        exit();
    }
}