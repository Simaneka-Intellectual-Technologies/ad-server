<?php
class API extends CI_Controller
{
	public function index()
	{
		echo 'Hello!';
	}
    public function get()
    {
        if($this->input->request_headers()['authorisation'])
        {
            $auth_code = $this->input->request_headers()['authorisation'];

            $where = array(
                'auth_code' => $auth_code
            );
            $site = $this->main_model->get_where('sites', $where);
            if($site)
            {
                $type = $this->input->get('type');
                if (isset($type) && $type != '') {
                    $this->response($type, $site);
                }
                else {
                    echo json_encode(
                        array(
                            'status' => false,
                            'message' => 'You did not specify what type of add you want!'
                        )
                    );
                }
            }
            else {
                echo json_encode(
                    array(
                        'status' => false,
                        'message' => 'You are not allowed to get ads!'
                    )
                );
            }
        }
        else 
        {
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
    public function response($type, $site)
    {
        $folder = strtolower(str_replace(' ', '_', $type));
        if(file_exists(base_url('assets/ads/'. $folder)))
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/'. $folder .'_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder),
                    'site' => $site[0]['site_name'],
                    'website' => $site[0]['link'],
                )
            );
        }
        else
        {
            echo json_encode(
                array(
                    'status' => false,
                    'message' => 'We did not find a ' . str_replace('_', ' ', $type) . ' advertisment!',
                    'link' => base_url('assets/ads/extras/banner-advertising-online.jpg'),
                    'alt' => $type . ' Advetisment Not Found!',
                    'href' => base_url('track'),
                    'site' => $site[0]['site_name'],
                    'website' => $site[0]['link'],
                    'thing' => base_url('assets/ads/'. $folder)
                )
            );
        }
    }
}
