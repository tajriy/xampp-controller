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

function menu()
{
    $command = "sudo -S /opt/lampp/lampp";
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
    $result = [];
    foreach ($menus as $menu) {
        switch ($menu) {
            case 1:
                $result += [' stop', 'sudo -S service mysql stop', ' start'];
                break;
            case 2:
                $result += [
                    ' stop',
                    'sudo -S service mysql stop',
                    ' startapache',
                    'sudo -S service mysql start',
                    ' startftp'
                ];
                break;
            case 3:
                $result += [
                    ' stopapache',
                    ' startapache',
                ];
                break;
            case 4:
                $result += [
                    ' stopmysql',
                    ' startmysql'
                ];
                break;
            case 5:
                $result += [
                    'sudo -S service mysql stop',
                    'sudo -S service mysql start',
                ];
                break;
            case 7:
                $result += ["sudo -S /opt/lampp/manager-linux-x64.run"];
                break;
            case 8:
                $result += [' stop'];
                break;
            case 9:
                $result += [' stop', 'sudo -S service mysql stop'];
                break;
            case 0:
                exit();
                break;
            default:
                $result = shell_exec("clear");
                echo "{$result}\n";
                echo "---[ Anda belum memilih menu, silahkan pilih menu berikut : ]---\n\n";
                menu();
        }
    }
//    var_dump($result);
    if ($menuBool) {
        foreach ($result as $comm) {
            $syntax = "";
            if (!strstr($comm, 'sudo')) {
                $syntax = "{$command}{$comm}";
            } else {
                $syntax = "{$comm}";
            }
//            var_dump("COMMAND : {$syntax}");
            echo shell_exec($syntax);
        }
        $result = shell_exec("clear");
        echo "{$result}\n";
        menu();
    }
}

menu();