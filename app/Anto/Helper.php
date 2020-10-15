<?php 
namespace App\Anto;
use PDF;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class Helper {
	public function hello($value='')
	{
		return " Hello! " . $value;
	}

    static function mail($view,$inputs,$uses,$to,$subject)
    {
      Mail::send($view, $inputs, function ($message) use ($uses,$to,$subject) {
        $message->from(getenv('ADMIN_MAIL'), getenv('ADMIN_NAME'));
        $message->to($to)->subject($subject);
      }); 
    }
    static function mailA($view,$inputs,$uses,$to,$subject,$attachments)
    {
      Mail::send($view, $inputs, function ($message) use ($uses,$to,$subject,$attachments) {
        $message->from(getenv('ADMIN_MAIL'), getenv('ADMIN_NAME'));
        $message->to($to)->subject($subject);
        foreach ($attachments as $key => $value) {
          $message->attachData($value, $key); 
        }
      }); 
    }
    static function sms($phone,$sms)
    {
     $sms = rawurlencode($sms);
     $priority = 'ndnd';
     $stype = 'normal';
     $user = getenv('SMS_USER');
     $pass = getenv('SMS_PASS');
     $sender = getenv('SMS_SENDER');

     return file_get_contents("http://bhashsms.com/api/sendmsg.php?user=".$user."&pass=".$pass."&sender=".$sender."&phone=".$phone."&text=".$sms."&priority=".$priority."&stype=".$stype); 
     // self::curl_request_async("http://bhashsms.com/api/sendmsg.php?user=".$user."&pass=".$pass."&sender=".$sender."&phone=".$phone."&text=".$sms."&priority=".$priority."&stype=".$stype,[],'GET'); 
   }
   static function upload(Request $request, $key, $destination)
   {
    if (!empty($request[$key])) {
      $destinationPath = $destination;
      $extension = Input::file($key)->getClientOriginalExtension(); 
      $fileName = time().'_'. $key .'.'.$extension; 
      Input::file($key)->move($destinationPath, $fileName);
      return $destinationPath.'/'.$fileName;
    } 
    return false;
  }
    // $type must equal 'GET' or 'POST'
  static function curl_request_async($url, $params, $type='POST')
  {
  	$post_params = [];

      foreach ($params as $key => &$val) {
        if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);
      }
      $post_string = implode('&', $post_params);

      $parts=parse_url($url);

      $fp = fsockopen($parts['host'],
          isset($parts['port'])?$parts['port']:80,
          $errno, $errstr, 30);

      // Data goes in the path for a GET request
      if('GET' == $type) $parts['path'] .= '?'.$post_string;

      $out = "$type ".$parts['path']." HTTP/1.1\r\n";
      $out.= "Host: ".$parts['host']."\r\n";
      $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
      $out.= "Content-Length: ".strlen($post_string)."\r\n";
      $out.= "Connection: Close\r\n\r\n";
      // Data goes in the request body for a POST request
      if ('POST' == $type && isset($post_string)) 
      	{
      		$out.= $post_string;
      	}

      fwrite($fp, $out);
      fclose($fp);
  }
}
?>