<?php
/**
 * created by tamaasrory
 * http://github.com/tamaasrory
 *
 * HOW TO RUN (ubuntu terminal):
 *
 * $ php xampp-controller.php
 *
 * Date: 10/11/17
 * Time: 6:25
 */

function input()
{
    return trim(fgets(STDIN));
}

function menu($info = "")
{
    echo shell_exec("clear");
    $path = "sudo -S /opt/lampp/lampp";
    echo $info ? "-------------------------INFORMATION----------------------------\n"
        . "{$info}----------------------------------------------------------------\n" : "";
    $info = "";
    echo "Welcome to XAMPP Controller\n";
    echo " [1]. Start All (Apache, MariaDB, ProFTPD)\n";
    echo " [2]. Start All (Apache, MySQL, ProFTPD)\n";
    echo " [3]. Start Apache\n";
    echo " [4]. Start MariaDB\n";
    echo " [5]. Start MySQL\n";
    echo " [6]. Start ProFTPD\n";
    echo " [7]. Open XAMPP Control Panel\n";
    echo " [8]. Stop All (Apache, MariaDB, ProFTPD)\n";
    echo " [9]. Stop All (Apache, MySQL, ProFTPD)\n";
    echo " [0]. Exit\n";
    echo "Pilih satu atau beberapa (pisahkan dengan ',') menu di atas : ";
    $menus = input();
    $menus = trim($menus, ',');
    $menuBool = $menus = preg_replace('/ /', '', $menus);
    $menus = explode(',', $menus);
    $commands = [];
    foreach ($menus as $menu) {
        switch ($menu) {
            case 1:
                $commands += [' stop', 'sudo -S service mysql stop', ' start'];
                break;
            case 2:
                $commands += [
                    ' stop',
                    'sudo -S service mysql stop',
                    ' startapache',
                    'sudo -S service mysql start',
                    ' startftp'
                ];
                break;
            case 3:
                $commands += [
                    ' stopapache',
                    ' startapache',
                ];
                break;
            case 4:
                $commands += [
                    ' stopmysql',
                    'sudo -S service mysql stop',
                    ' startmysql'
                ];
                break;
            case 5:
                $commands += [
                    ' stopmysql',
                    'sudo -S service mysql stop',
                    'sudo -S service mysql start',
                ];
                break;
            case 7:
                $commands += ["sudo -S /opt/lampp/manager-linux-x64.run"];
                break;
            case 8:
                $commands += [' stop'];
                break;
            case 9:
                $commands += [' stop', 'sudo -S service mysql stop'];
                break;
            case 0:
                echo shell_exec("clear");
                exit();
                break;
            default:
                $commands = shell_exec("clear");
                echo "{$commands}\n";
                echo "---[ Anda belum memilih menu, silahkan pilih menu berikut : ]---\n\n";
                menu();
        }
    }
//    var_dump($result);
    if ($menuBool) {
        foreach ($commands as $command) {
            $syntax = "";
            if (!strstr($command, 'sudo')) {
                $syntax = "{$path}{$command}";
            } else {
                $syntax = "{$command}";
            }
//            var_dump("COMMAND : {$syntax}");
            $info .= shell_exec($syntax);
            $info .= "\n";
        }
        echo shell_exec("clear");
        menu($info);
    }
}

menu();
