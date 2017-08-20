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

    function fwStat(){
        $check = shell_exec('sudo ufw status verbose');
        return "<pre>$check</pre>";
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

    function list_port_num(){
        $list = shell_exec("sudo ufw status numbered");
        return "<pre>$list</pre>";
    }

?>
