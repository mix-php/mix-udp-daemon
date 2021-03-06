<?php

namespace Mix\Udp\Daemon\Commands;

use Mix\Helper\ProcessHelper;

/**
 * Class StopCommand
 * @package Mix\Udp\Daemon\Commands\Service
 * @author liu,jian <coder.keda@gmail.com>
 */
class StopCommand extends BaseCommand
{

    /**
     * 主函数
     */
    public function main()
    {
        // 获取服务状态
        $pid = $this->getServicePid();
        if (!$pid) {
            println(self::NOT_RUNNING);
            return;
        }
        // 停止服务
        ProcessHelper::kill($pid);
        while (ProcessHelper::kill($pid, 0)) {
            // 等待进程退出
            usleep(100000);
        }
        println(self::EXEC_SUCCESS);
    }

}
