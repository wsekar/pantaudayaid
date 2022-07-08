<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->login) redirect('dashboard');
        $this->load->model('M_Petugas', 'm_petugas'); //load model petugas
        $this->load->model('M_Staff', 'm_staff'); //load model staff
    }

    public function index()
    {
        $this->load->view('login'); // load halaman login (view -> login)
    }

    public function proses_login()
    {
        if ($this->input->post('role') === 'Petugas') $this->_proses_login_petugas($this->input->post('username'));
        // saat menginputkan username untuk petugas maka akan terjadi proses login menuju halaman petugas
        elseif ($this->input->post('role') === 'Administrator') $this->_proses_login_staff($this->input->post('username'));
        // saat menginputkan username untuk staff maka akan terjadi proses login menuju halaman staff
        else { // selain kondisi diatas maka role tidak tersedia
?>
            <script>
                alert('role tidak tersedia!')
            </script>
<?php
        }
    }

    protected function _proses_login_petugas($username)
    { //fungsi proses login untuk petugas
        $get_petugas = $this->m_petugas->lihat_username($username); // mendeteksi username yang di inputkan
        if ($get_petugas) {
            if ($get_petugas->password == $this->input->post('password')) { // menginputkan password 
                $session = [
                    // dilakukan pengecekkan
                    'id' => $get_petugas->id_petugas,
                    'username' => $get_petugas->username,
                    'password' => $get_petugas->password,
                    'email' => $get_petugas->email,
                    'telephone' => $get_petugas->telephone,
                    'role' => $this->input->post('role'),
                    'jam_masuk' => date('H:i:s')
                ];

                $this->session->set_userdata('login', $session);
                // menambahkan flash data
                $this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!'); // menampilkan pesan login berhasil ('set_flashdata' -> didapat dari library session)
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password Salah!'); // menambahkan flash data jika password salah
                redirect();
            }
        } else {
            $this->session->set_flashdata('error', 'Username Salah!'); // menambahkan flash data jika username salah
            redirect();
        }
    }
    // proses login admin ini sama dengan login staff administrasi
    protected function _proses_login_staff($username)
    {
        $get_staff_administrasi = $this->m_staff->lihat_username($username);
        if ($get_staff_administrasi) {
            if ($get_staff_administrasi->password_staff == $this->input->post('password')) {
                $session = [
                    'id'        => $get_staff_administrasi->id_staff,
                    'username'  => $get_staff_administrasi->username_staff,
                    'password'  => $get_staff_administrasi->password_staff,
                    'email'     => $get_staff_administrasi->email_staff,
                    'telephone' => $get_staff_administrasi->telephone_staff,
                    'role'      => $this->input->post('role'),
                    'jam_masuk' => date('H:i:s')
                ];

                $this->session->set_userdata('login', $session);
                $this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password Salah!');
                redirect();
            }
        } else {
            $this->session->set_flashdata('error', 'Username Salah!');
            redirect();
        }
    }
}
