<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductoutModel;
use App\Models\ListproductoutModel;
use App\Models\UserModel;
use App\Models\MasterapprovalModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Productout extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productoutModel = new ProductoutModel();
        $this->listproductoutModel = new ListproductoutModel();
        $this->masterapprovalModel = new MasterapprovalModel();
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
    }
    public function index()
    {
        $list_productout = $this->productoutModel->get_all_data();
        $list_user = $this->userModel->get_all_data();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $data = [
            'judul_page' => 'Pengajuan ATK',
            'list_productout' => $list_productout,
            'list_user' => $list_user,
            'sub_judul_page' => 'Table Data',
            'add' => '/add_productout/' . $randomString,
            'update' => '/add_productout',
            'url_delete' => 'hapus_productout',
            'url' => 'productout'
        ];
        return view('admin_productout', $data);
    }
    public function create($request_code)
    {
        $data = $this->productoutModel->get_data_by_request_code($request_code);
        $list_product_out = $this->listproductoutModel->get_data_by_request_code($request_code);
        if (count($data) > 0) {
            $data = [
                'validation' => $this->validation,
                'list_product_out' => $list_product_out,
                'action' => '/add_action_productout',
                'judul_page' => 'Pengajuan ATK',
                'sub_judul_page' => 'Update',
                'back' => '/productout',
                'url_delete' => 'hapus_productout',
                'request_date' => $data[0]['request_date'],
                'request_code' => $data[0]['request_code'],
                'description' => $data[0]['description'],
                'add_list' => '/add_listproductout/' . $request_code,
                'update_list' => '/update_listproductout',
                'url_delete' => 'hapus_listproductout',
                'id' => $data[0]['id'],
                'id_user' => '',
                'url' => 'productout',
            ];
        } else {
            $data = [
                'validation' => $this->validation,
                'list_product_out' => $list_product_out,
                'action' => '/add_action_productout',
                'judul_page' => 'Pengajuan ATK',
                'sub_judul_page' => 'Add',
                'back' => '/productout',
                'url_delete' => 'hapus_productout',
                'request_date' => date('Y-m-d'),
                'description' => old('description'),
                'request_code' => $request_code,
                'add_list' => '/add_listproductout/' . $request_code,
                'update_list' => '/update_listproductout',
                'url_delete' => 'hapus_listproductout',
                'id' => '',
                'id_user' => '',
                'url' => 'productout',
            ];
        }

        return view('admin_productout_form', $data);
    }
    public function create_action()
    {
        $data = $this->productoutModel->get_data_by_request_code($this->request->getPost('request_code'));
        if (count($data) == 0) {
            $data = [
                'request_date'          => $this->request->getPost('request_date'),
                'id_request'          => $this->session->get("id_user"),
                'request_code'          => $this->request->getPost('request_code'),
                'description'          => $this->request->getPost('description'),
            ];
            $insert = $this->productoutModel->insert_data($data);
            if ($insert) {
                return redirect()->to(base_url() . '/productout');
            }
        } else {
            $id = $this->request->getPost('id');
            $data = [
                'request_date'          => $this->request->getPost('request_date'),
                'request_code'          => $this->request->getPost('request_code'),
                'description'          => $this->request->getPost('description'),
            ];

            $update = $this->productoutModel->update_data($data, $id);

            if ($update) {
                return redirect()->to(base_url() . '/productout');
            }
        }
    }


    public function delete($id)
    {
        $delete = $this->productoutModel->delete_data($id);
        if ($delete) {
            return redirect()->to(base_url() . '/productout');
        }
    }


    public function submit($id)
    {

        $list_masterapproval = $this->masterapprovalModel->get_all_data();
        $approval = [];
        foreach ($list_masterapproval as $key => $value) {
            array_push($approval, $value['id_user']);
        }
        $data = [
            'approval'          => implode(",", $approval),
            'proccess'          => 1,
        ];

        $update = $this->productoutModel->update_data($data, $id);
        if ($update) {
            return redirect()->to(base_url() . '/productout');
        }
    }
    public function approval()
    {
        $list_productout = $this->productoutModel->get_all_data();
        $list_user = $this->userModel->get_all_data();
        $data = [
            'judul_page' => 'Pengajuan ATK',
            'list_productout' => $list_productout,
            'list_user' => $list_user,
            'sub_judul_page' => 'Table Data',
            'add' => '/add_productout/',
            'update' => '/add_productout',
            'url_delete' => 'hapus_productout',
            'url' => 'productout_app'
        ];
        return view('admin_productout_approval', $data);
    }
    public function approve($id)
    {
        $row = $this->productoutModel->get_by_id($id);
        $count = count(explode(",", $row['approval']));
        if ($row['proccess'] == ($count)) {
            $data = [
                'proccess'          => $row['proccess'] + 1,
                'approval_date'          => date('Y-m-d'),
            ];


            $update = $this->productoutModel->update_data($data, $id);


            $list_product_out = $this->listproductoutModel->get_data_by_request_code($row['request_code']);
            foreach ($list_product_out as $key => $value) {
                $rowProduct = $this->productModel->get_by_id($value['id_product']);
                $data = [
                    'stock_product'         => $rowProduct['stock_product'] - $value['qty'],
                ];
                $update = $this->productModel->update_data($data, $value['id_product']);
            }
        } else {
            $data = [
                'proccess'          => $row['proccess'] + 1,
            ];
            $update = $this->productoutModel->update_data($data, $id);
        }

        if ($update) {
            return redirect()->to(base_url() . '/productout_app');
        }
    }
    public function reject($id)
    {
        $data = [
            'proccess'          => 999,
        ];

        $update = $this->productoutModel->update_data($data, $id);
        if ($update) {
            return redirect()->to(base_url() . '/productout_app');
        }
    }

    public function cetak($id)
    {

        $productout = $this->productoutModel->get_by_id($id);
        $list_product_out = $this->listproductoutModel->get_data_by_request_code($productout['request_code']);

        $logo = base64_encode(file_get_contents('assets-admin/img/logo_pudc.png'));

        $user1 = $this->userModel->get_by_id($productout['id_request']);
        $approval = explode(",", $productout['approval']);
        $user2 = $this->userModel->get_by_id($approval[0]);
        $user3 = $this->userModel->get_by_id($approval[1]);
        $ttd = base64_encode(file_get_contents('public/assets-admin/img/ttd/' . $user1['photo_ttd']));
        $ttd2 = base64_encode(file_get_contents('public/assets-admin/img/ttd/' . $user2['photo_ttd']));
        $ttd3 = base64_encode(file_get_contents('public/assets-admin/img/ttd/' . $user3['photo_ttd']));
        $data = [
            'judul_page' => 'Pengajuan ' . $productout['display_name'] . ' periode ' . date('d F Y', strtotime($productout['request_date'])),
            'list_product_out' => $list_product_out,
            'productout' => $productout,
            'logo' => $logo,
            'ttd' => $ttd,
            'ttd2' => $ttd2,
            'ttd3' => $ttd3,
            'user1' => $user1,
            'user2' => $user2,
            'user3' => $user3,
        ];
        // print_r($head_data);die;
        // return view('pdf_jurnal',$data);
        $filename = 'Pengajuan ' . $productout['display_name'] . ' periode ' . date('d F Y', strtotime($productout['request_date']));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('pdf_productout', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => false));
        exit();
    }

    public function laporan()
    {

        $list_productout = $this->productoutModel->get_all_data();
        $list_product_detail_out = $this->listproductoutModel->get_all_data();
        $list_user = $this->userModel->get_all_data();
        $logo = base64_encode(file_get_contents('assets-admin/img/logo_pudc.png'));

        $data = [
            'judul_page' => 'Laporan Pengajuan ATK',
            'logo' => $logo,
            'list_product_out' => $list_productout,
            'list_product_detail_out' => $list_product_detail_out,
            'list_user' => $list_user,
        ];
        // print_r($head_data);die;
        // return view('pdf_jurnal',$data);
        $filename = 'Laporan Pengajuan ATK ';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan_productout', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => false));
        exit();
    }
}