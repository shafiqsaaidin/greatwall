<?php

    // Network stat Receive & Transmit
    $rx = shell_exec("vnstat -q -i wlp3s0 | grep 'today' | awk {'print $2$3'}");
    $tx = shell_exec("vnstat -q -i wlp3s0 | grep 'today' | awk {'print $5 $6'}");
    $total = shell_exec("vnstat -q -i wlp3s0 | grep 'today' | awk {'print $8 $9'}");

    function get_ram_usage(){
      $totalRam = shell_exec("vmstat  -s | grep 'total memory' | awk '{print $1}'");
      $totalUsage = shell_exec("vmstat  -s | grep 'used memory' | awk '{print $1}'");

      return intval($totalUsage / $totalRam * 100);
    }

    function get_cpu_usage(){
      $exec_loads = sys_getloadavg();
      $exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
      $cpu = round($exec_loads[1]/($exec_cores + 1)*100, 0);

      return $cpu;
    }

    function get_hdd_usage(){
      $hdd = shell_exec("df -h | sed -n '4p' | awk '{print $5}'");
      return $hdd;
    }

    // Create function to disable an enable firewall
    function fwCheck($stat){
      if($stat == "on"){
        exec('sudo ufw enable');
      } elseif($stat == "off") {
        exec('sudo ufw disable');
      } else {
        echo "error no input";
      }
    }

    function fwAdd($port){
        exec('sudo ufw allow '.$port);
    }

    function fwAdvance($policy, $direction, $src, $dst, $port, $protocol){
        exec("sudo ufw $policy $direction from $src to $dst port $port proto $protocol");
    }

    function fwDel($num){
        exec('echo "y" | sudo ufw delete '.$num);
    }

    function fwReset(){
      exec('sudo ufw disable');
      exec('echo "y" | sudo ufw reset');
      exec('sudo iptables -F && sudo iptables -X');
    }

    function fwStat(){
      $check = shell_exec('sudo ufw status verbose');
      return "<pre>$check</pre>";
    }

    function fwFilter($val){
      if($val == "on"){
        exec('sudo /etc/init.d/dnsmasq start');
      } elseif($val == "off") {
        exec('sudo /etc/init.d/dnsmasq stop');
      } else {
        echo "error no input";
      }
    }

    function fwRemote($val){
      if($val == "on"){
        exec('sudo /etc/init.d/ssh start');
      } elseif($val == "off") {
        exec('sudo /etc/init.d/ssh stop');
      } else {
        echo "error no input";
      }
    }

    function fwDevice($val){
      if($val == "poweroff"){
        exec('sudo shutdown -h now');
      } elseif($val == "restart") {
        exec('sudo shutdown -r now');
      } else {
        echo "error no input";
      }
    }

    function list_port_num(){
      $list = shell_exec("sudo ufw status numbered");
      return "<pre>$list</pre>";
    }

    // Function to add and delete domain in web-filter
    function filter_add($val){
      $domain = $val;
      exec(`sudo sh -c "echo 'address=/$domain/10.0.0.1' >> /etc/dnsmasq.conf"`);
      exec('sudo /etc/init.d/dnsmasq restart');
    }

    function filter_del($val){
      $domain = $val;
      exec("sudo sed -i '/$domain/d' /etc/dnsmasq.conf");
      exec('sudo /etc/init.d/dnsmasq restart');
    }
?>
