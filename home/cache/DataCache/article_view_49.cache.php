<?php 
 $arr=array (
  'expiration' => 1447038216,
  'info' => 
  array (
    'id' => '49',
    'uid' => '1',
    'title' => 'Windows下安装redis缓存与PHP的使用',
    'content' => '<ol class=\\"\\\\&quot; list-paddingleft-2\\"><li><p>下载redis客户端</p><p>下载地址<a href=\\"\\\\&quot;https://github.com/dmajkic/redis/downloads\\\\&quot;\\" target=\\"\\\\&quot;_blank\\\\&quot;\\" data-mce-href=\\"\\\\&quot;https://github.com/dmajkic/redis/downloads\\\\&quot;\\">https://github.com/dmajkic/redis/downloads</a>。下载到的Redis支持32bit和64bit。根据自己实际情况选择。把文件内容拷贝到需要安装的目录下,比如：D:\\\\\\\\dev\\\\\\\\redis-2.4.5。</p><p><br/></p><p>打开一个cmd窗口，使用cd命令切换到指定目录（D:\\\\\\\\dev\\\\\\\\redis-2.4.5）运行&nbsp;redis-server.exe redis.conf&nbsp;。运行以后出现如下界面。</p><p><img src=\\"/public/upload/image/20150921/1442814218695694.png\\" title=\\"1442814218695694.png\\" alt=\\"127152838-1d64c3178a504a1dab2c48e270703104.png\\"/><br/></p><p>这就说明Redis服务端已经安装成功。</p><p><br/></p></li><li><p>重新打开一个cmd窗口，使用cd命令切换到指定目录（D:\\\\\\\\dev\\\\\\\\redis-2.4.5）运行&nbsp;redis-cli.exe -h 
127.0.0.1 -p 6379，其中 127.0.0.1是本地ip，6379是redis服务端的默认端口。运行成功如下图所示。</p><p><img src=\\"/public/upload/image/20150921/1442814248127223.png\\" title=\\"1442814248127223.png\\" alt=\\"227152846-f394a6eb01ad41ba92989d571f34d211.png\\"/><br/></p><p>这样，Redis windows环境下搭建已经完成，是不是很简单。</p><p><br/></p></li><li><p>环境已经搭建好，总得测试下吧。比如：存储一个key为test，value为hello word的字符串，然后获取key值。</p><p><img src=\\"/public/upload/image/20150921/1442814267427004.png\\" title=\\"1442814267427004.png\\" alt=\\"327152856-ead450e5a5dd408f957012d219bf0247.png\\"/><br/></p><p>正确输出 hell word，测试成功！</p><p><br/></p></li><li><p><strong>PHP中使用</strong></p><p>1 添加phpredis扩展</p><p>&nbsp;首先，查看所用php编译版本V6/V9 在phpinfo()中查看</p><p>&nbsp;<img src=\\"/public/upload/image/20150921/1442814291820400.jpg\\" title=\\"1442814291820400.jpg\\" alt=\\"405eba02c-ce36-32af-88d8-8c53856ea927.jpg\\"/></p><p><br/></p><p>2 下载扩展 地址：<a href=\\"\\\\&quot;https://github.com/nicolasff/phpredis/downloads\\\\&quot;\\" target=\\"\\\\&quot;_blank\\\\&quot;\\" data-mce-href=\\"\\\\&quot;https://github.com/nicolasff/phpredis/downloads\\\\&quot;\\">https://github.com/nicolasff/phpredis/downloads</a>（注意所支持的php版本）</p><p>&nbsp;</p><p>3&nbsp;首先把php_redis.dll 和 php_igbinary.dll 放入PHP的ext文件夹，然后在php.ini配置文件里添加如下代码：</p><p>extension=php_igbinary.dll</p><p>extension=php_redis.dll</p><p>注意：extension=php_igbinary.dll一定要放在extension=php_redis.dll的前面，否则此扩展不会生效&nbsp;</p><p>&nbsp;</p><p>4 重新启动服务，查看phpinfo(),下面表示成功；&nbsp;</p><p><br/></p></li></ol><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442814308119107.jpg\\" title=\\"1442814308119107.jpg\\" alt=\\"55c2af525-b89e-35bb-9bd5-996c1ffc10a2.jpg\\"/></p><p><br/></p><p>&nbsp; &nbsp;5 用PHP测试</p><p>&nbsp; &nbsp; &nbsp;Php代码 &nbsp;<a title=\\"\\\\&quot;收藏这段代码\\\\&quot;\\"><img class=\\"\\\\&quot;star\\\\&quot;\\" src=\\"\\\\&quot;http://alfred-long.iteye.com/images/icon_star.png\\\\&quot;\\" alt=\\"\\\\&quot;收藏代码\\\\&quot;\\" data-mce-src=\\"\\\\&quot;http://alfred-long.iteye.com/images/icon_star.png\\\\&quot;/\\"/></a><br data-mce-bogus=\\"\\\\&quot;1\\\\&quot;/\\"/></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">new&nbsp;Redis();&nbsp;&nbsp;</span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;connect(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;192.168.138.2&quot;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;6379&quot;);&nbsp;&nbsp;<span class=\\"\\\\&quot;comment\\\\&quot;\\">//php客户端设置的ip及端口&nbsp;&nbsp;</span></span></span></span></p><p><span class=\\"\\\\&quot;comment\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;//存储一个&nbsp;值&nbsp;&nbsp;</span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;set(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;say&quot;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;Hello&nbsp;World&quot;);&nbsp;&nbsp;</span></span></span></p><p><span class=\\"\\\\&quot;func\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;<span class=\\"\\\\&quot;vars\\\\&quot;\\">$redis-&gt;get(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;say&quot;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;comment\\\\&quot;\\">//应输出Hello&nbsp;World&nbsp;&nbsp;</span></span></span></span></p><p>&nbsp;&nbsp;</p><p><span class=\\"\\\\&quot;comment\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;//存储多个值&nbsp;&nbsp;</span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$array&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">array(<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_val&#39;,&nbsp;&nbsp;</span></span></span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_val&#39;,&nbsp;&nbsp;</span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_val&#39;);&nbsp;&nbsp;</span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$array_get&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">array(<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_key&#39;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_key&#39;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_key&#39;);&nbsp;&nbsp;</span></span></span></span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;mset(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$array);&nbsp;&nbsp;</span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;var_dump(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$redis-&gt;mget(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$array_get));&nbsp; <br/></span></span></p><p><br/></p>',
    'keyword' => 'Windows,redis,缓存',
    'sortid' => '3',
    'img' => '',
    'views' => '9',
    'comnum' => '0',
    'topway' => 'none',
    'status' => 'show',
    'datetime' => '2015-09-18 16:32:40',
  ),
); 
?>