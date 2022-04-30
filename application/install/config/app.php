<?php
// +----------------------------------------------------------------------
// | 海豚PHP框架 [ DolphinPHP ]
// +----------------------------------------------------------------------
// | 版权所有 2016~2019 广东卓锐软件有限公司 [ http://www.zrthink.com ]
// +----------------------------------------------------------------------
// | 官方网站: http://dolphinphp.com
// +----------------------------------------------------------------------

/**
 * 安装程序配置文件
 */
return array(
    //产品配置
    'install_product_name' => 'DolphinPHP', //产品名称
    'install_website_domain' => 'http://www.dolphinphp.com', //官方网址
    'install_company_name' => '广东卓锐软件有限公司', //公司名称
    'original_table_prefix' => 'dp_', //默认表前缀

    // 安装配置
    'install_table_total' => 253, // 安装时，需执行的sql语句数量
);
