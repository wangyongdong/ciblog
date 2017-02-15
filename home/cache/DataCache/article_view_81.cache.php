<?php 
 $arr=array (
  'expiration' => 1447038212,
  'info' => 
  array (
    'id' => '81',
    'uid' => '1',
    'title' => '阿里云服务器Linux环境永久修改主机用户名方法',
    'content' => '<p>最近入手阿里云服务器，一来体验国内优秀的云主机产品，二来准备较为全面的分享阿里云服务器基础应用，把常用的教程分享出来供新手用户参考使用。对
于Windows系统基本没有多少可以分享的，我们可以直接IIS建站也可以用很多网上的服务器安装包就可以搭建网站环境，我们使用较多的以及比较生疏的
还是Linux系统环境。</p><p>在登陆SSH之后，我们可能会看到比较难看的主机名，很多人和老蒋一样比较讲究细节。</p><p><img data-tag=\\"bdshare\\" class=\\"alignnone size-full wp-image-1098\\" src=\\"http://www.itbulu.com/wp-content/uploads/2014/12/aliyun-name-1.jpg\\" alt=\\"阿里云服务器默认主机名\\" height=\\"329\\" width=\\"482\\"/></p><p>我们可以看到默认的阿里云服务器主机名很乱，我们希望设置自己的主机名。</p><p>第一步、编辑/etc/hosts文件</p><p>通过vi /etc/hosts打开修改主机名</p><p><img data-tag=\\"bdshare\\" class=\\"alignnone size-full wp-image-1099\\" src=\\"http://www.itbulu.com/wp-content/uploads/2014/12/aliyun-name-2.jpg\\" alt=\\"aliyun-name-2\\" height=\\"130\\" width=\\"457\\"/></p><p>第二步、编辑/etc/sysconfig/network文件</p><p><img data-tag=\\"bdshare\\" class=\\"alignnone size-full wp-image-1100\\" src=\\"http://www.itbulu.com/wp-content/uploads/2014/12/aliyun-name-3.jpg\\" alt=\\"aliyun-name-3\\" height=\\"166\\" width=\\"481\\"/></p><p>第三步、<a href=\\"http://www.itbulu.com/tag/hostname/\\" title=\\"View all posts in Hostname\\" target=\\"_blank\\" class=\\"tag_link\\">Hostname</a>设置</p><blockquote><p>hostname itbulu</p></blockquote><p>最后在设置新的主机名，这样起到双重保险，因为很多时候没有执行这几个步骤，会重启VPS之后，又还原成原来的主机名。</p><p>最后，我们reboot重启VPS之后，就可以看到新的主机名生效。</p><p><br/></p>',
    'keyword' => '阿里云,服务器,Linux,主机用户名',
    'sortid' => '5',
    'img' => '',
    'views' => '0',
    'comnum' => '0',
    'topway' => 'none',
    'status' => 'show',
    'datetime' => '2015-09-21 17:51:07',
  ),
); 
?>