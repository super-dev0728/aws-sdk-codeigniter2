<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Aws\S3\S3Client;
use Aws\Common\Credentials\Credentials;

class Welcome extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->config->load('aws_sdk');
        // $bucket = 'FirstBucket';
        // $keyname = $this->config->item('aws_access_key');

        // // Instantiate the client.
        // $s3 = S3Client::factory();

        // // Upload data.
        // $result = $s3->putObject([
        //     'Bucket' => $bucket,
        //     'Key' => $keyname,
        //     'Body' => 'Hello, world!',
        // ]);

        // echo $result['ObjectURL'];
        $this->aws_sdk->createBucket(['Bucket' => 'mylsybucket']);
    }

    public function get_bucket_list()
    {
        $list = $this->aws_sdk->listBuckets();

        var_dump($list);
        die();
        return $list;
    }

    public function sandbox()
    {
        $this->load->config('aws_sdk');
        $aws_key = $this->config->item('aws_access_key');
        $aws_secret = $this->config->item('aws_secret_key');

        $credentials = new Credentials($aws_key, $aws_secret);

        $s3 = S3Client::factory([
            'credentials' => $credentials,
            'region' => 'eu-east-1',
            'version' => 'latest',
            'signature_version' => 'v4',
        ]);

        $bucket = 'qweqwebucket';
        $image = base_url() . 'assets/images/1.jpg';

        // Upload data.
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => '123123123',
            'Body' => $image,
            'ACL' => 'public-read',
            'ContentType' => 'images/jpg',
        ]);

        echo $result['ObjectURL'];
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */