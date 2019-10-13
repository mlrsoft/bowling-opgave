<? 
namespace BowlingScore;

use Exception;

class CommunicationChannel {
    private $url;
    private $token;
    public function __construct( $url )
    {
        $this->url = $url;    
    }
    public function getUrl() {
        return $this->url;
    }
    public function getToken() {
        return $this->token;
    }
    public function fetchPoints() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url
        ]);
        $curlResponse = curl_exec($curl);
        $curlResponseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        if ($curlResponseCode !== 200) {
            throw new Exception("bad fetch responce code: $curlResponseCode");
        } 
        if (!is_string($curlResponse) || !strlen($curlResponse)) {
            throw new Exception('No data received');
        }
        $response = json_decode($curlResponse, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $jsonError = json_last_error_msg();
            throw new Exception("Json fetch decode error: $jsonError");
        }
        
        if (!array_key_exists('token', $response)) {
            throw new Exception('No Token received');
        }
        $this->token = $response['token'];
        if (!array_key_exists('points', $response)) {
            throw new Exception('No point information received');
        }
        return $response['points'];
    
    }

    public function validateSums($sums) {
        $jsonData = json_encode([
            "token" => $this->token,
            "points" => $sums
        ]);
        $curl = curl_init();
        $header = [
            "Content-Type: application/json",
            "Content-Length: ".strlen($jsonData)
        ];
        curl_setopt_array($curl, [
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url
        ]);
        $curlResponse = curl_exec($curl);
        $curlResponseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($curlResponseCode !== 200) {
            throw new Exception("bad validate Response code: $curlResponseCode");
        }
        if(!is_string($curlResponse) || !strlen($curlResponse)>0) {
            throw new Exception('No validation data');
        }
        $response = json_decode($curlResponse, true); 
        if (json_last_error() !== JSON_ERROR_NONE) {
            $jsonError = json_last_error_msg();
            throw new Exception("Json sums decode error: $jsonError");
        }

        return array_key_exists('success', $response) && $response['success'] === true;
    }
}

