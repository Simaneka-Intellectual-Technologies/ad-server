<?php
class API extends CI_Controller
{
    public function index()
    {
        echo 'Hello 123456789!';
    }
    public function get()
    {
        if (isset($this->input->request_headers()['authorisation'])) {
            $auth_code = $this->input->request_headers()['authorisation'];

            $where = array(
                'auth_code' => $auth_code
            );
            $site = $this->main_model->get_where('companies', $where);
            if ($site) {
                $type = $this->input->post('type');
                $tags = $this->input->post('tags');
                if (isset($type) && $type != '') {
                    $this->response($type, $tags, $site);
                } else {
                    echo json_encode(
                        array(
                            'status' => false,
                            'message' => 'You did not specify what type of add you want!'
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        'status' => false,
                        'message' => 'You are not allowed to get ads!'
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    'status' => false,
                    'message' => 'You did not give us your authorisation token!'
                )
            );
        }
        // YJ6kTKj7pcemMXVqLNCrPvB4n2HSf8EU
        // C2yM9apbB3UscfheT6Y8NkxzwgDAtGQV
        // nvy2Uh3k7zXERMWBmeKJjCxLNr6Za9Dg
        // t3N2m5apvBGzku9UePRAncYhV6Kx47FD
        // feNZkzsndW6ALtmJbEvuYHRxV59wFPcB
        // T8zp4Jsud7BVkrNxnCYL9ZfUqPjRGWv2
        // JtjAUpEV2LKemyFZSs75RBT8ah9gdQqc
        // s6Vnyw8getrmfUhWT2CADbjaPYLGQKx7
        // XDMhUBsGkW3wE4JnYgdf8z9CKPxvR6VA
        // AMaJZLVr3t9cRsqjPNueByQHw8E6vXGg
        // BePp6Qqw2RKMTjr7394kZzU8SydXAsLN
        // Dxmap97Beh8P4tAMKJVndcuGvgXwHWC6
        // EMKgeXhHqP6kNZTDQCz5SmUuJrbB7ncx
        // VDscPNFgKq7wpn63Zb2kHGWm4ASLERvM
        // fK7gFZeYQBduwJVNypHmzGjPcDShW695
    }
    public function response($type, $tags, $site)
    {
        $site = $site[0];
        $folder = strtolower(str_replace(' ', '_', $type));
        if (file_exists(FCPATH . 'assets/ads/' . $folder)) {
            $ad = $this->main_model->get_ad($type, $tags, $site);

            if ($ad['status']) {
                echo json_encode(
                    array(
                        'status' => true,
                        'message' => $ad['message'],
                        'link' => base_url('assets/' . $ad['ad']['file']),
                        'alt' => $type . ' Advetisment for ADS',
                        'href' => base_url('api/track/' . $ad['ad']['ad_id']),
                        'site' => $site['title'],
                        'website' => $site['website'],
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'status' => true,
                        'message' => 'There are no ' . str_replace('_', ' ', $type) . ' advertisments available!',
                        'link' => base_url('assets/ads/default.jpg'),
                        'alt' => $type . ' Advetisment Not Listed!',
                        'href' => base_url('track'),
                        'site' => $site['title'],
                        'website' => $site['website'],
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    'status' => false,
                    'message' => 'We do not have ' . str_replace('_', ' ', $type) . ' advertisments!',
                    'link' => base_url('assets/ads/default.jpg'),
                    'alt' => $type . ' Advetisment Not Found!',
                    'href' => base_url('track'),
                    'site' => $site['title'],
                    'website' => $site['website'],
                )
            );
        }
    }
    public function track($id)
    {
        $ad = $this->main_model->update_clicks($id);

        header('Location: ' . $ad['redirect_link']);
    }
}