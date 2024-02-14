<?php
class API extends CI_Controller
{
	public function index()
	{
		echo 'Hello!';
	}
    public function get()
    {
        $auth_code = $this->input->request_headers()['authorisation'];

        $where = array(
            'auth_code' => $auth_code
        );
        if($this->main_model->get_where('sites', $where))
        {
            $type = $this->input->get('type');
            if (isset($type) && $type != '') {
                $this->response($type);
            }
        }
        // XUwCeuxr6ZjELa4cA9dhYSDV7fpsRMGz
        // Qn4dApbuBETjqM8hsYJFPweygXKa3k9V
        // e74HEtShpdvfTrXQwg3bsNynBJcPq2a8
        // bjDw4NtKucrnQheVzP6aYAygEvfR28dB
        // yLvHcnkezNZFbEKY96DsGuUj8BSg72qf
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
    public function response($type)
    {
        $folder = strtolower(str_replace(' ', '_', $type));
        if($type == 'Dark Square')
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/dark_square_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder)
                )
                );
        }
        
        elseif($type == 'Thick Horizontal Strip')
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/horizontal_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder)
                )
                );
        }
        
        elseif($type == 'Horizontal Strip')
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/horizontal_slip_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder)
                )
                );
        }
        
        elseif($type == 'Light Square')
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/light_square_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder)
                )
                );
        }
        
        elseif($type == 'Think Vertical Strip')
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/think_vertical_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder)
                )
                );
        }
        
        elseif($type == 'Vertical Strip')
        {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'We got your ' . str_replace('_', ' ', $type) . ' advertisment ready!',
                    'link' => base_url('assets/ads/'. $folder .'/vertical_strip_ad.jpg'),
                    'alt' => $type . ' Advetisment for ADS',
                    'href' => base_url('track/'. $folder)
                )
                );
        }
        else
        {
            echo json_encode(
                array(
                    'status' => false,
                    'message' => 'We did not find a ' . str_replace('_', ' ', $type) . ' advertisment!',
                    'link' => base_url('assets/ads/'. $folder .'/vertical_strip_ad.jpg'),
                    'alt' => $type . ' Advetisment Not Found!',
                    'href' => base_url('trfolder)
                )
                );
        }
    }
}
