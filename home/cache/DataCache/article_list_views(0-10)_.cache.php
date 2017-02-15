<?php 
 $arr=array (
  'expiration' => 1473387068,
  'info' => 
  array (
    0 => 
    array (
      'id' => '49',
      'uid' => '1',
      'title' => 'Windows下安装redis缓存与PHP的使用',
      'content' => '<ol class=\\"\\\\&quot; list-paddingleft-2\\"><li><p>下载redis客户端</p><p>下载地址<a href=\\"\\\\&quot;https://github.com/dmajkic/redis/downloads\\\\&quot;\\" target=\\"\\\\&quot;_blank\\\\&quot;\\" data-mce-href=\\"\\\\&quot;https://github.com/dmajkic/redis/downloads\\\\&quot;\\">https://github.com/dmajkic/redis/downloads</a>。下载到的Redis支持32bit和64bit。根据自己实际情况选择。把文件内容拷贝到需要安装的目录下,比如：D:\\\\\\\\dev\\\\\\\\redis-2.4.5。</p><p><br/></p><p>打开一个cmd窗口，使用cd命令切换到指定目录（D:\\\\\\\\dev\\\\\\\\redis-2.4.5）运行&nbsp;redis-server.exe redis.conf&nbsp;。运行以后出现如下界面。</p><p><img src=\\"/public/upload/image/20150921/1442814218695694.png\\" title=\\"1442814218695694.png\\" alt=\\"127152838-1d64c3178a504a1dab2c48e270703104.png\\"/><br/></p><p>这就说明Redis服务端已经安装成功。</p><p><br/></p></li><li><p>重新打开一个cmd窗口，使用cd命令切换到指定目录（D:\\\\\\\\dev\\\\\\\\redis-2.4.5）运行&nbsp;redis-cli.exe -h 
127.0.0.1 -p 6379，其中 127.0.0.1是本地ip，6379是redis服务端的默认端口。运行成功如下图所示。</p><p><img src=\\"/public/upload/image/20150921/1442814248127223.png\\" title=\\"1442814248127223.png\\" alt=\\"227152846-f394a6eb01ad41ba92989d571f34d211.png\\"/><br/></p><p>这样，Redis windows环境下搭建已经完成，是不是很简单。</p><p><br/></p></li><li><p>环境已经搭建好，总得测试下吧。比如：存储一个key为test，value为hello word的字符串，然后获取key值。</p><p><img src=\\"/public/upload/image/20150921/1442814267427004.png\\" title=\\"1442814267427004.png\\" alt=\\"327152856-ead450e5a5dd408f957012d219bf0247.png\\"/><br/></p><p>正确输出 hell word，测试成功！</p><p><br/></p></li><li><p><strong>PHP中使用</strong></p><p>1 添加phpredis扩展</p><p>&nbsp;首先，查看所用php编译版本V6/V9 在phpinfo()中查看</p><p>&nbsp;<img src=\\"/public/upload/image/20150921/1442814291820400.jpg\\" title=\\"1442814291820400.jpg\\" alt=\\"405eba02c-ce36-32af-88d8-8c53856ea927.jpg\\"/></p><p><br/></p><p>2 下载扩展 地址：<a href=\\"\\\\&quot;https://github.com/nicolasff/phpredis/downloads\\\\&quot;\\" target=\\"\\\\&quot;_blank\\\\&quot;\\" data-mce-href=\\"\\\\&quot;https://github.com/nicolasff/phpredis/downloads\\\\&quot;\\">https://github.com/nicolasff/phpredis/downloads</a>（注意所支持的php版本）</p><p>&nbsp;</p><p>3&nbsp;首先把php_redis.dll 和 php_igbinary.dll 放入PHP的ext文件夹，然后在php.ini配置文件里添加如下代码：</p><p>extension=php_igbinary.dll</p><p>extension=php_redis.dll</p><p>注意：extension=php_igbinary.dll一定要放在extension=php_redis.dll的前面，否则此扩展不会生效&nbsp;</p><p>&nbsp;</p><p>4 重新启动服务，查看phpinfo(),下面表示成功；&nbsp;</p><p><br/></p></li></ol><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442814308119107.jpg\\" title=\\"1442814308119107.jpg\\" alt=\\"55c2af525-b89e-35bb-9bd5-996c1ffc10a2.jpg\\"/></p><p><br/></p><p>&nbsp; &nbsp;5 用PHP测试</p><p>&nbsp; &nbsp; &nbsp;Php代码 &nbsp;<a title=\\"\\\\&quot;收藏这段代码\\\\&quot;\\"><img class=\\"\\\\&quot;star\\\\&quot;\\" src=\\"\\\\&quot;http://alfred-long.iteye.com/images/icon_star.png\\\\&quot;\\" alt=\\"\\\\&quot;收藏代码\\\\&quot;\\" data-mce-src=\\"\\\\&quot;http://alfred-long.iteye.com/images/icon_star.png\\\\&quot;/\\"/></a><br data-mce-bogus=\\"\\\\&quot;1\\\\&quot;/\\"/></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">new&nbsp;Redis();&nbsp;&nbsp;</span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;connect(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;192.168.138.2&quot;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;6379&quot;);&nbsp;&nbsp;<span class=\\"\\\\&quot;comment\\\\&quot;\\">//php客户端设置的ip及端口&nbsp;&nbsp;</span></span></span></span></p><p><span class=\\"\\\\&quot;comment\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;//存储一个&nbsp;值&nbsp;&nbsp;</span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;set(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;say&quot;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;Hello&nbsp;World&quot;);&nbsp;&nbsp;</span></span></span></p><p><span class=\\"\\\\&quot;func\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;<span class=\\"\\\\&quot;vars\\\\&quot;\\">$redis-&gt;get(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;say&quot;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;comment\\\\&quot;\\">//应输出Hello&nbsp;World&nbsp;&nbsp;</span></span></span></span></p><p>&nbsp;&nbsp;</p><p><span class=\\"\\\\&quot;comment\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;//存储多个值&nbsp;&nbsp;</span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$array&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">array(<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_val&#39;,&nbsp;&nbsp;</span></span></span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_val&#39;,&nbsp;&nbsp;</span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_val&#39;);&nbsp;&nbsp;</span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$array_get&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">array(<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_key&#39;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_key&#39;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_key&#39;);&nbsp;&nbsp;</span></span></span></span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;mset(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$array);&nbsp;&nbsp;</span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;var_dump(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$redis-&gt;mget(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$array_get));&nbsp; <br/></span></span></p><p><br/></p>',
      'keyword' => 'Windows,redis,缓存',
      'sortid' => '3',
      'img' => '',
      'views' => '10',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 16:32:40',
    ),
    1 => 
    array (
      'id' => '85',
      'uid' => '1',
      'title' => 'PHP网站从Apache转移到Nginx后产生404错误的原因和解决办法',
      'content' => '<p><strong>原案例分析</strong>：</p><p>1、原来的网站在wamp环境下搭建完成，一切正常，上传到虚拟主机环境为lnmp，结果访问时可以打开主页，然后点其他页面全部报404错误；<br/>&nbsp;<br/>2、
经分析得出原因：原网站环境为wamp使用了伪静态，伪静态规则写在网站根目录的.htaccess文件中，Apache下默认识别此文件内容，而
Nginx服务器不识别.htaccess文件，导致伪静态规则无效，自然无法解析url地址，导致404错误（文件不存在）<br/>&nbsp;<br/>3、解决办法：因为Nginx服务器不识别.htaccess文件的，所以原来写在此文件中的伪静态规则需要转移出来，转移方式有两种：</p><p>方法一、如果想保留.htaccess文件，则在linux服务器此目录&nbsp; /usr/local/nginx/conf/rewrite/ 
下建立一个伪静态规则配置文件名字任取，例如：/usr/local/nginx/conf/rewrite/my.conf，将原来
在.htaccess文件中的rewrite规则转换成nginx下的rewrite规则，提供一个自动转换网址<br/>&nbsp;<br/>http://www.anilcetin.com/convert-apache-htaccess-to-nginx/&nbsp; &nbsp; 实测真实有用</p><p><a href=\\"http://www.linuxidc.com/topicnews.aspx?tid=14\\" target=\\"_blank\\" title=\\"CentOS\\">CentOS</a> 6.2实战部署Nginx+MySQL+PHP <a href=\\"http://www.linuxidc.com/Linux/2013-09/90020.htm\\">http://www.linuxidc.com/Linux/2013-09/90020.htm</a></p><p>使用Nginx搭建WEB服务器 <a href=\\"http://www.linuxidc.com/Linux/2013-09/89768.htm\\">http://www.linuxidc.com/Linux/2013-09/89768.htm</a></p><p>搭建基于Linux6.3+Nginx1.2+PHP5+MySQL5.5的Web服务器全过程 <a href=\\"http://www.linuxidc.com/Linux/2013-09/89692.htm\\">http://www.linuxidc.com/Linux/2013-09/89692.htm</a></p><p>CentOS 6.3下Nginx性能调优 <a href=\\"http://www.linuxidc.com/Linux/2013-09/89656.htm\\">http://www.linuxidc.com/Linux/2013-09/89656.htm</a></p><p>CentOS 6.3下配置Nginx加载ngx_pagespeed模块 <a href=\\"http://www.linuxidc.com/Linux/2013-09/89657.htm\\">http://www.linuxidc.com/Linux/2013-09/89657.htm</a></p><p>CentOS 6.4安装配置Nginx+Pcre+php-fpm <a href=\\"http://www.linuxidc.com/Linux/2013-08/88984.htm\\">http://www.linuxidc.com/Linux/2013-08/88984.htm</a></p><p>Nginx搭建视频点播服务器（仿真专业流媒体软件） <a href=\\"http://www.linuxidc.com/Linux/2012-08/69151.htm\\">http://www.linuxidc.com/Linux/2012-08/69151.htm</a><br/><strong>&nbsp;</strong><br/><strong>本案例原规则</strong>：<br/>&nbsp;<br/>&lt;IfModule mod_rewrite.c&gt;<br/>&nbsp;RewriteEngine on<br/>&nbsp;RewriteCond %{REQUEST_FILENAME} !-d<br/>&nbsp;RewriteCond %{REQUEST_FILENAME} !-f<br/>&nbsp;RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]<br/>&nbsp;&lt;/IfModule&gt;<br/><strong>&nbsp;</strong><br/><strong>转换成Nginx后</strong>：<br/>&nbsp;<br/>if (!-d $request_filename){<br/>&nbsp;set $rule_0 1$rule_0;<br/>&nbsp;}<br/>&nbsp;if (!-f $request_filename){<br/>&nbsp;set $rule_0 2$rule_0;<br/>&nbsp;}<br/>&nbsp;if ($rule_0 = &quot;21&quot;){<br/>&nbsp;rewrite ^/(.*)$ /index.php/$1 last;<br/>&nbsp;}</p><p>然后将转换好的规则替换.htaccess文件内容，将.htaccess文件导入my.conf，my.conf内容如下：<br/>&nbsp;<br/>location / {<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; include&nbsp; /home/wwwroot/dijin.com/web/.htaccess;<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br/>&nbsp;}</p><p>--至此完成伪静态转移</p><p>方法二、如果不想保留.htaccess文件，则前面的步骤照常，最后一步替换的时候直接将转换好的内容放入my.conf文件中，如下：<br/>&nbsp;<br/>location / {<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; if (!-d $request_filename){<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;set $rule_0 1$rule_0;<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; if (!-f $request_filename){<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; set $rule_0 2$rule_0;<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; if ($rule_0 = &quot;21&quot;){<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;rewrite ^/(.*)$ /index.php/$1 last;<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br/>&nbsp; }</p><p>--至此完成</p><p><br/></p><p>转自：http://www.linuxidc.com/Linux/2014-06/103103.htm</p>',
      'keyword' => 'PHP,Apache,Nginx,404',
      'sortid' => '5',
      'img' => '',
      'views' => '9',
      'comnum' => '1',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:54:48',
    ),
    2 => 
    array (
      'id' => '21',
      'uid' => '1',
      'title' => 'MySql避免重复插入记录方法(ignore,Replace,ON DUPLICATE KEY UPDATE)',
      'content' => '<p>本文章来给大家提供三种在mysql中避免重复插入记录方法，主要是讲到了ignore,Replace,ON DUPLICATE KEY UPDATE三种方法，各位同学可尝试参考。</p><p><strong>案一：使用ignore关键字</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;如果是用主键primary或者唯一索引unique区分了记录的唯一性,避免重复插入记录可以使用：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;IGNORE&nbsp;INTO&nbsp;`table_name`&nbsp;(`email`,&nbsp;`phone`,&nbsp;`user_id`)&nbsp;VALUES&nbsp;(&#39;test9@163.com&#39;,&nbsp;&#39;99999&#39;,&nbsp;&#39;9999&#39;);</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;这样当有重复记录就会忽略,执行后返回数字0</p><p>&nbsp;&nbsp;&nbsp;&nbsp;还有个应用就是复制表,避免重复记录：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;IGNORE&nbsp;INTO&nbsp;`table_1`&nbsp;(`name`)&nbsp;SELECT&nbsp;`name`&nbsp;FROM&nbsp;`table_2`;</pre><p><strong>方案二：使用Replace</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;语法格式：</p><pre class=\\"brush:sql;toolbar:false\\">REPLACE&nbsp;INTO&nbsp;`table_name`(`col_name`,&nbsp;...)&nbsp;VALUES&nbsp;(...);
REPLACE&nbsp;INTO&nbsp;`table_name`&nbsp;(`col_name`,&nbsp;...)&nbsp;SELECT&nbsp;...;
REPLACE&nbsp;INTO&nbsp;`table_name`&nbsp;SET&nbsp;`col_name`=&#39;value&#39;,</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;算法说明：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPLACE的运行与INSERT很相像,但是如果旧记录与新记录有相同的值，则在新记录被插入之前，旧记录被删除，即：</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;尝试把新行插入到表中 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当因为对于主键或唯一关键字出现重复关键字错误而造成插入失败时： <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;从表中删除含有重复关键字值的冲突行 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;再次尝试把新行插入到表中 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旧记录与新记录有相同的值的判断标准就是：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;表有一个PRIMARY KEY或UNIQUE索引，否则，使用一个REPLACE语句没有意义。该语句会与INSERT相同，因为没有索引被用于确定是否新行复制了其它的行。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;返回值：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; REPLACE语句会返回一个数，来指示受影响的行的数目。该数是被删除和被插入的行数的和<br/>受影响的行数可以容易地确定是否REPLACE只添加了一行，或者是否REPLACE也替换了其它行：检查该数是否为1（添加）或更大（替换）。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;示例:<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# eg:(phone字段为唯一索引)</p><pre class=\\"brush:sql;toolbar:false\\">REPLACE&nbsp;INTO&nbsp;`table_name`&nbsp;(`email`,&nbsp;`phone`,&nbsp;`user_id`)&nbsp;VALUES&nbsp;(&#39;test569&#39;,&nbsp;&#39;99999&#39;,&nbsp;&#39;123&#39;);</pre><p>另外,在 SQL Server 中可以这样处理：</p><pre class=\\"brush:sql;toolbar:false\\">if&nbsp;not&nbsp;exists&nbsp;(select
&nbsp;phone&nbsp;from&nbsp;t&nbsp;where&nbsp;phone=&nbsp;&#39;1&#39;)&nbsp;&nbsp;&nbsp;insert&nbsp;into&nbsp;t(phone,&nbsp;update_time)&nbsp;
values(&#39;1&#39;,&nbsp;getdate())&nbsp;else&nbsp;&nbsp;&nbsp;&nbsp;update&nbsp;t&nbsp;set&nbsp;update_time&nbsp;=&nbsp;getdate()&nbsp;
where&nbsp;phone=&nbsp;&#39;1&#39;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;更多信息请看：http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html#replace</p><p><strong>方案三：ON DUPLICATE KEY UPDATE</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;如‍上所写，你也可以在INSERT INTO…..后面加上 ON DUPLICATE KEY UPDATE方法来实现。如果您指定了ON 
DUPLICATE KEY UPDATE，并且插入行后会导致在一个UNIQUE索引或PRIMARY KEY中出现重复值，则执行旧行UPDATE。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;例如，如果列a被定义为UNIQUE，并且包含值1，则以下两个语句具有相同的效果：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`table`&nbsp;(`a`,&nbsp;`b`,&nbsp;`c`)&nbsp;VALUES&nbsp;(1,&nbsp;2,&nbsp;3)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;`c`=`c`+1;&nbsp;
UPDATE&nbsp;`table`&nbsp;SET&nbsp;`c`=`c`+1&nbsp;WHERE&nbsp;`a`=1;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;如果行作为新记录被插入，则受影响行的值为1；如果原有的记录被更新，则受影响行的值为2。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;注释：如果列b也是唯一列，则INSERT与此UPDATE语句相当：</p><pre class=\\"brush:sql;toolbar:false\\">UPDATE&nbsp;`table`&nbsp;SET&nbsp;`c`=`c`+1&nbsp;WHERE&nbsp;`a`=1&nbsp;OR&nbsp;`b`=2&nbsp;LIMIT&nbsp;1;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;如果a=1 OR b=2与多个行向匹配，则只有一个行被更新。通常，您应该尽量避免对带有多个唯一关键字的表使用ON DUPLICATE KEY子句。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;您可以在UPDATE子句中使用VALUES(col_name)函数从INSERT…UPDATE语句的INSERT部分引用列值。换句话说，如
果没有发生重复关键字冲突，则UPDATE子句中的VALUES(col_name)可以引用被插入的col_name的值。本函数特别适用于多行插入。
VALUES()函数只在INSERT…UPDATE语句中有意义，其它时候会返回NULL。</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`table`&nbsp;(`a`,&nbsp;`b`,&nbsp;`c`)&nbsp;VALUES&nbsp;(1,&nbsp;2,&nbsp;3),&nbsp;(4,&nbsp;5,&nbsp;6)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;`c`=VALUES(`a`)+VALUES(`b`);</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;本语句与以下两个语句作用相同：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`table`&nbsp;(`a`,&nbsp;`b`,&nbsp;`c`)&nbsp;VALUES&nbsp;(1,&nbsp;2,&nbsp;3)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;`c`=3;&nbsp;
INSERT&nbsp;INTO&nbsp;`table`&nbsp;(`a`,&nbsp;`b`,&nbsp;`c`)&nbsp;VALUES&nbsp;(4,&nbsp;5,&nbsp;6)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;c=9;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;注释：当您使用ON DUPLICATE KEY UPDATE时，DELAYED选项被忽略。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;示例：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这个例子是我在实际项目中用到的：是将一个表的数据导入到另外一个表中，数据的重复性就得考虑(如下)，唯一索引为：email：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`table_name1`&nbsp;(`title`,&nbsp;`first_name`,&nbsp;`last_name`,&nbsp;`email`,&nbsp;`phone`,&nbsp;`user_id`,&nbsp;`role_id`,&nbsp;`status`,&nbsp;`campaign_id`)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;SELECT&nbsp;&#39;&#39;,&nbsp;&#39;&#39;,&nbsp;&#39;&#39;,&nbsp;`table_name2`.`email`,&nbsp;`table_name2`.`phone`,&nbsp;NULL,&nbsp;NULL,&nbsp;&#39;pending&#39;,&nbsp;29&nbsp;FROM&nbsp;`table_name2`&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;WHERE&nbsp;`table_name2`.`status`&nbsp;=&nbsp;1&nbsp;
ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;`table_name1`.`status`=&#39;pending&#39;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;再贴一个例子：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`class`&nbsp;SELECT&nbsp;*&nbsp;FROM&nbsp;`class1`&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;`class`.`course`=`class1`.`course`</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;其它关键：DELAYED&nbsp; 做为快速插入，并不是很关心失效性，提高插入性能。 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IGNORE&nbsp; 只关注主键对应记录是不存在，无则添加，有则忽略。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;更多信息请看:&nbsp; http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html#insert</p><p>&nbsp;&nbsp;&nbsp;&nbsp;特别说明：在MYSQL中UNIQUE索引将会对null字段失效，也就是说(a字段上建立唯一索引)：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`test`&nbsp;(`a`)&nbsp;VALUES&nbsp;(NULL);</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;是可以重复插入的（联合唯一索引也一样）。</p><p>&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;转自：http://www.111cn.net/database/mysql/50135.htm</p><p><br/></p>',
      'keyword' => 'mysql,ignore',
      'sortid' => '4',
      'img' => '',
      'views' => '3',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 15:25:35',
    ),
    3 => 
    array (
      'id' => '84',
      'uid' => '1',
      'title' => '阿里云服务器搭建与问题',
      'content' => '<p class=\\"MsoListParagraph\\" style=\\"margin-left:28px\\">一、<span style=\\"font-family: 宋体\\">服务器选择</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">a)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">因为最近在搞域名就多关注了一下阿里云，发现有可以试用的服务器，于是打算申请一个免费服务器，</span><span style=\\"font-size:12px\\">15</span><span style=\\"font-size:12px;font-family:宋体\\">天的，因为自己也正打算买呢，所以打算一探究竟。</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">b)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">前期就是服务器的购买啊，设置等等；全部弄完以后，阿里云会给你发一封邮件，包括</span><span style=\\"font-size:12px\\">IP</span><span style=\\"font-size:12px;font-family:宋体\\">地址等等信息；</span><span style=\\"font-size:12px\\">OK</span><span style=\\"font-size:12px;font-family:宋体\\">，下面我们就可以进入了；</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:28px\\"><span style=\\"font-size:12px\\">二、<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">环境配置</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">a)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">系统选择：最终还是选择</span><span style=\\"font-size:12px\\">CentOS</span><span style=\\"font-size:12px;font-family: 宋体\\">，原因就是因为以前用过，比较熟悉；</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">b)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">下面就是磁盘的挂载了，也可以选择不挂载，那样系统会在一键安装时，给你默认挂载磁盘；</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">c)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">环境搭建：因为我本地的</span><span style=\\"font-size:12px\\">test</span><span style=\\"font-size:12px;font-family: 宋体\\">环境就是</span><span style=\\"font-size: 12px\\">apache+mysql+php</span><span style=\\"font-size:12px;font-family:宋体\\">的，所以决定选择</span><span style=\\"font-size:12px\\">LAMP</span><span style=\\"font-size:12px;font-family: 宋体\\">；</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:108px\\"><span style=\\"font-size:12px\\">1、<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">第一步：下载阿里云</span><span style=\\"font-size:12px\\">LAMP</span><span style=\\"font-size:12px;font-family: 宋体\\">一键安装包：访问：</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:108px;text-indent:0\\"><a href=\\"http://help.aliyun.com/knowledge_list/8314854.html?spm=5176.788314854.1863381.485.UOR7wv\\"><span style=\\"font-size:12px\\">http://help.aliyun.com/knowledge_list/8314854.html?spm=5176.788314854.1863381.485.UOR7wv</span></a><span style=\\"font-size:12px\\">&nbsp; </span><span style=\\"font-size:12px;font-family:宋体\\">选择</span><span style=\\"font-size:12px\\"> Linux</span><span style=\\"font-size:12px;font-family:宋体\\">一键安装</span><span style=\\"font-size:12px\\">web</span><span style=\\"font-size:12px;font-family: 宋体\\">环境全攻略，点击一键下载；</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:108px\\"><span style=\\"font-size:12px\\">2、<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">下载后，是用</span><span style=\\"font-size:12px\\">ftp</span><span style=\\"font-size:12px;font-family: 宋体\\">软件（随便），上传到服务器下的</span><span style=\\"font-size:12px\\">home/</span><span style=\\"font-size:12px;font-family: 宋体\\">下；然后就是执行</span><span style=\\"font-size:12px\\">apache/nginx</span><span style=\\"font-size:12px;font-family:宋体\\">、</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:112px;text-indent:0\\"><span style=\\"font-size:12px\\">mysql</span><span style=\\"font-size: 12px;font-family:宋体\\">、</span><span style=\\"font-size:12px\\">php</span><span style=\\"font-size:12px;font-family: 宋体\\">等安装；详细说明在一键安装包里的两个</span><span style=\\"font-size:12px\\">PDF</span><span style=\\"font-size:12px;font-family: 宋体\\">文档里面都有；</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">d)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">环境搭建：手动搭建，就是不使用一键安装包，而是逐个安装：参考：</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:28px\\"><a href=\\"http://bbs.aliyun.com/read.php?spm=5176.775973948.2.6.S91WUp&tid=130069\\"><span style=\\"font-size:12px\\">http://bbs.aliyun.com/read.php?spm=5176.775973948.2.6.S91WUp&amp;tid=130069</span></a> </p><p class=\\"MsoListParagraph\\" style=\\"margin-left:28px\\"><span style=\\"font-size:12px\\">三、<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">一些问题</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">a)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">修改</span><span style=\\"font-size: 12px\\">root</span><span style=\\"font-size:12px;font-family:宋体\\">密码：</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:84px;text-indent:0\\"><a href=\\"http://bbs.aliyun.com/read/171244.html?page=e\\"><span style=\\"font-size:12px\\">http://bbs.aliyun.com/read/171244.html?page=e</span></a> </p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">b)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">修改</span><span style=\\"font-size: 12px\\">hostname</span><span style=\\"font-size:12px;font-family:宋体\\">：</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:84px;text-indent:0\\"><a href=\\"http://www.itbulu.com/aliyun-hostname.html\\"><span style=\\"font-size:12px\\">http://www.itbulu.com/aliyun-hostname.html</span></a> </p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">c)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px\\">Phpmyadmin</span><span style=\\"font-size:12px;font-family:宋体\\">提示：您应该升级更高版本</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:84px;text-indent:0\\"><a href=\\"http://wxlccsu.com/archives/914\\"><span style=\\"font-size:12px\\">http://wxlccsu.com/archives/914</span></a> </p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">d)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px;font-family:宋体\\">设置</span><span style=\\"font-size: 12px\\">mysql</span><span style=\\"font-size:12px;font-family:宋体\\">支持远程链接</span></p><p class=\\"MsoListParagraph\\" style=\\"margin-left:84px;text-indent:0\\"><a href=\\"http://www.ainiu.net/AiNiuNetwork27-296.htm\\"><span style=\\"font-size:12px\\">http://www.ainiu.net/AiNiuNetwork27-296.htm</span></a> </p><p class=\\"MsoListParagraph\\" style=\\"margin-left:56px\\"><span style=\\"font-size:12px\\">e)<span style=\\"font:9px &#39;Times New Roman&#39;\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\\"font-size:12px\\">Apache</span><span style=\\"font-size:12px;font-family:宋体\\">转义到</span><span style=\\"font-size:12px\\"> nginx </span><span style=\\"font-size:12px;font-family:宋体\\">后</span><span style=\\"font-size:12px\\">404</span><span style=\\"font-size:12px;font-family: 宋体\\">的问题：</span></p><p style=\\"margin-left:84px\\"><a href=\\"http://www.linuxidc.com/Linux/2014-06/103103.htm\\"><span style=\\"font-size: 12px\\">http://www.linuxidc.com/Linux/2014-06/103103.htm</span></a> </p><p><br/></p>',
      'keyword' => '阿里云,服务器',
      'sortid' => '5',
      'img' => 'Image 1.png',
      'views' => '3',
      'comnum' => '0',
      'topway' => 'home',
      'status' => 'show',
      'datetime' => '2015-09-21 17:53:51',
    ),
    4 => 
    array (
      'id' => '1',
      'uid' => '1',
      'title' => '（转）PHP错误类型及屏蔽方法',
      'content' => '<p>程序只要在运行，就免不了会出现错误，错误很常见，比如Error，Notice，Warning等等。之前我们介绍过《<a href=\\"http://www.php100.com/html/dujia/2015/0119/8411.html\\" target=\\"_blank\\" data-mce-href=\\"http://www.php100.com/html/dujia/2015/0119/8411.html\\">易犯的PHP小错误及相应分析</a>》《<a href=\\"http://www.php100.com/html/dujia/2015/0115/8381.html\\" target=\\"_blank\\" data-mce-href=\\"http://www.php100.com/html/dujia/2015/0115/8381.html\\">为开发者准备的10款错误报告和追踪工具</a>》，这篇文章具体说一下PHP的错误类型和屏蔽方法。在PHP中，主要有以下3种错误类型。<br/><br/><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>1.&nbsp;注意（Notices）</strong><br/>这些都是比较小而且不严重的错误，比如去访问一个未被定义的变量。通常，这类的错误是不提示给用户的，但有时这些错误会影响到运行的结果。<br/><br/><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>2.&nbsp;警告（Warnings）</strong><br/>这就是稍微严重一些的错误了，比如想要包含include()一个本身不存在的文件。这样的错误信息会提示给用户，但不会导致程序终止运行。<br/><br/><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>3.&nbsp;致命错误（Fatal&nbsp;errors）</strong><br/>这些就是严重的错误，比如你想要初始化一个根本不存在的类的对象，或调用一个不存在的函数，这些错误会导致程序停止运行，PHP也会把这些错误展现给用户。</span></span></span></span></p><p><span style=\\"font-size: 14px;\\" data-mce-style=\\"font-size: 14px;\\"><strong>不同的错误种类包括：</strong><br/><br/>E_ERROR：通常会显示出来，也会中断程序执行。<br/>E_WARNING：通常都会显示出来，但不会中断程序的执行。<br/>E_NOTICE：在脚本正常运行下发生的代码错误。<br/>E_PARSE：语法解析错误。<br/><br/>E_CORE_ERROR：在PHP启动时发生的致命错误。<br/>E_CORE_WARNING：报告在PHP启动时发生的非致命性错误。<br/>E_COMPILE_ERROR：编译时发生的致命错误，指出脚本的错误。<br/><br/>E_USER_ERROR：用户产生的错误信息。<br/>E_USER_WARNING：用户产生的警告信息。<br/>E_USER_NOTICE：用户引发的注意消息。<br/><br/>E_STRICT：编码标准化警告，运行时发生的错误。<br/>E_RECOVERABLE_ERROR：接近致命的运行时错误，若未被捕获则视同E_ERROR。<br/>E_ALL：捕获所有的错误和警告。<br/><br/>&nbsp;</span></p><h2><span style=\\"color: #000000;\\" data-mce-style=\\"color: #000000;\\">屏蔽PHP错误提示</span></h2><p><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>方法一：</strong>在有可能出错的函数前加@,然后or&nbsp;die(&quot;&quot;)&nbsp;<br/>如：&nbsp;<br/>@mysql_connect(...)&nbsp;or&nbsp;die(&quot;Database&nbsp;Connect&nbsp;Error&quot;)<br/><br/><strong>方法二：</strong>编辑php.ini&nbsp;，查找&quot;display_errors&nbsp;=&quot;&nbsp;，将“=”后面的值改为&quot;off。<br/><br/><strong>方法三：</strong>在php脚本前加error_reporting(0)，屏蔽所有错误提示。<br/>其中，error_reporting&nbsp;配置错误信息回报的等级。<br/><br/>语法：int&nbsp;error_reporting(int&nbsp;[level]);<br/>返回值：整数<br/>函数种类：PHP&nbsp;系统功能</span></span></span></p><p>&nbsp;</p><p><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #000000;\\" data-mce-style=\\"color: #000000;\\">原文：<a href=\\"http://www.ecomspark.com/what-are-the-different-types-of-errors-in-php/\\" target=\\"_blank\\" data-mce-href=\\"http://www.ecomspark.com/what-are-the-different-types-of-errors-in-php/\\">http://www.ecomspark.com/what-are-the-different-types-of-errors-in-php/</a></span></span></span></span></p><p><br/></p>',
      'keyword' => 'php,错误,屏蔽',
      'sortid' => '3',
      'img' => '',
      'views' => '2',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 09:51:45',
    ),
    5 => 
    array (
      'id' => '4',
      'uid' => '1',
      'title' => 'php 上传cvs文件并读取，重新生成cvs文件',
      'content' => '<pre class=\\"brush:php;toolbar:false\\">&lt;?php
//校验上传文件类型
if(empty($_FILES[&#39;csv&#39;][&#39;error&#39;]))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$sFileExt&nbsp;=&nbsp;strtolower(substr($_FILES[&#39;csv&#39;][&#39;name&#39;],&nbsp;-3));&nbsp;//获取后缀名
&nbsp;&nbsp;&nbsp;&nbsp;if($sFileExt&nbsp;!=&nbsp;&#39;csv&#39;){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page::error(&#39;上传文件必须是csv文件&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;$sFileName&nbsp;=&nbsp;$_FILES[&#39;csv&#39;][&#39;tmp_name&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;$oFile&nbsp;=&nbsp;fopen($sFileName,&nbsp;&#39;r&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;$aSameNick&nbsp;=&nbsp;array();
&nbsp;&nbsp;&nbsp;&nbsp;while(($aRow&nbsp;=&nbsp;fgetcsv($oFile,&nbsp;10000))&nbsp;!==&nbsp;false)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$list[]&nbsp;=&nbsp;$aRow;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;fclose($oFile);
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//确定文件名
&nbsp;&nbsp;&nbsp;&nbsp;$sFilename&nbsp;=&nbsp;&quot;cvs生成_&quot;&nbsp;.&nbsp;time().&nbsp;&quot;.csv&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;$sFilename&nbsp;=&nbsp;mb_convert_encoding($sFilename,&nbsp;&#39;gbk&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-type:application/vnd.ms-excel&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-Disposition:filename=&quot;&nbsp;.&nbsp;$sFilename);
&nbsp;&nbsp;&nbsp;&nbsp;//导出生成的短链接
&nbsp;&nbsp;&nbsp;&nbsp;$sOut&nbsp;=&nbsp;&quot;手机,短链接,长链接,姓名,userid&quot;.&quot;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;$sOut&nbsp;=&nbsp;mb_convert_encoding($sOut,&nbsp;&#39;gbk&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$sOut;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;foreach($arr&nbsp;as&nbsp;$key&nbsp;=&gt;&nbsp;$val){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sOut&nbsp;=&nbsp;&quot;\\\\&quot;{$mobile}\\\\&quot;,&quot;&nbsp;.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;\\\\&quot;{$valurl_short}\\\\&quot;,&quot;&nbsp;.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;\\\\&quot;{$valurl_real}\\\\&quot;,&quot;&nbsp;.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;\\\\&quot;{$valuserName}\\\\&quot;,&quot;&nbsp;.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;\\\\&quot;{$valuserId}\\\\&quot;,\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sOut&nbsp;=&nbsp;mb_convert_encoding($sOut,&nbsp;&#39;gbk&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$sOut;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
?&gt;</pre><p><br/></p>',
      'keyword' => 'php,cvs',
      'sortid' => '3',
      'img' => '',
      'views' => '2',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:21:46',
    ),
    6 => 
    array (
      'id' => '12',
      'uid' => '1',
      'title' => 'php生成验证码，生成值和session里面的验证码值不一样',
      'content' => '<p><span style=\\"font-size: 18px; background-color: #cccccc;\\"><span style=\\"background-color: #ffffff; color: #000000;\\">今天写项目的时候，发现注册的时候验证码怎么弄都不正确，通过使用FireBug和打印Session发现，同一时间的验证码值不一样，这是什么原因呢？</span><br/></span></p><p><span style=\\"font-size: 18px; background-color: #cccccc;\\"><span style=\\"background-color: #ffffff; color: #000000;\\">经过多次测试发现获取到的验证码多加载了一次，于是</span></span></p><pre class=\\"brush:html;toolbar:false\\">&lt;a&nbsp;href=&quot;#&quot;&nbsp;onclick=&quot;javascript:code();return&nbsp;false;&quot;&gt;</pre><p>添加了return false; 后好了</p><p><br/></p>',
      'keyword' => '验证码',
      'sortid' => '3',
      'img' => '',
      'views' => '2',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 11:16:17',
    ),
    7 => 
    array (
      'id' => '13',
      'uid' => '1',
      'title' => '固定在屏幕下方的div，不滚动',
      'content' => '<pre class=\\"brush:html;toolbar:false\\">&lt;html&nbsp;xmlns=&quot;http://www.w3.org/1999/xhtml&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;head&nbsp;runat=&quot;server&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;&lt;/title&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;style&nbsp;type=&quot;text/css&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;html,body{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;padding:0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;margin:0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#low_right{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;position:&nbsp;fixed;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;width:&nbsp;100%;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;height:&nbsp;90px;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;background:&nbsp;#eee;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;background-color:&nbsp;#DCFCE9;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;text-align:&nbsp;center;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bottom:0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;left:0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right:0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/style&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;
&lt;body&gt;
&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;style=&quot;width:100%;height:500px;background:#FFE7BA&quot;&gt;&lt;/div&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;style=&quot;width:100%;height:500px;background:#FFAEB9&quot;&gt;&lt;/div&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;style=&quot;width:100%;height:500px;background:#CDCDB4&quot;&gt;&lt;/div&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;id=&quot;low_right&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;右下角
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;

&lt;/body&gt;
&lt;/html&gt;</pre><p><br/></p>',
      'keyword' => 'div,滚动',
      'sortid' => '6',
      'img' => '',
      'views' => '2',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 11:31:00',
    ),
    8 => 
    array (
      'id' => '20',
      'uid' => '1',
      'title' => '深入mysql \\"ON DUPLICATE KEY UPDATE\\" 语法的分析',
      'content' => '<p><span style=\\"color: #ff0000;\\">&nbsp;&nbsp;&nbsp;&nbsp;mysql &quot;ON DUPLICATE KEY UPDATE&quot; 语法<br/></span>&nbsp;&nbsp;&nbsp;&nbsp;如果在INSERT语句末尾指定了ON DUPLICATE KEY UPDATE，并且插入行后会导致在一个UNIQUE索引或PRIMARY KEY中出现重复值，则在出现重复值的行执行UPDATE；如果不会导致唯一值列重复的问题，则插入新行。 <br/>&nbsp;&nbsp;&nbsp;&nbsp;例如，如果列 a 为 主键 或 拥有UNIQUE索引，并且包含值1，则以下两个语句具有相同的效果：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;TABLE&nbsp;(a,c)&nbsp;VALUES&nbsp;(1,3)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;c=c+1;
UPDATE&nbsp;TABLE&nbsp;SET&nbsp;c=c+1&nbsp;WHERE&nbsp;a=1;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;如果行作为新记录被插入，则受影响行的值显示1；如果原有的记录被更新，则受影响行的值显示2。 <br/>&nbsp;&nbsp;&nbsp;&nbsp;这个语法还可以这样用: <br/>&nbsp;&nbsp;&nbsp;&nbsp;如果INSERT多行记录(假设 a 为主键或 a 是一个 UNIQUE索引列):</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;TABLE&nbsp;(a,c)&nbsp;VALUES&nbsp;(1,3),(1,7)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;c=c+1;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;执行后, c 的值会变为 4 (第二条与第一条重复, c 在原值上+1).</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;TABLE&nbsp;(a,c)&nbsp;VALUES&nbsp;(1,3),(1,7)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;c=VALUES(c);</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;执行后, c 的值会变为 7 (第二条与第一条重复, c 在直接取重复的值7). <br/><span style=\\"color: #ff0000;\\">&nbsp;&nbsp;&nbsp;&nbsp;注意：ON DUPLICATE KEY UPDATE只是MySQL的特有语法，并不是SQL标准语法！ <br/></span>&nbsp;&nbsp;&nbsp;&nbsp;这个语法和适合用在需要 判断记录是否存在,不存在则插入存在则更新的场景.<br/><br/><strong>&nbsp;&nbsp;&nbsp;&nbsp;INSERT INTO .. ON DUPLICATE KEY更新多行记录<br/></strong>&nbsp;&nbsp;&nbsp;&nbsp;如
果在INSERT语句末尾指定了ON DUPLICATE KEY UPDATE，并且插入行后会导致在一个UNIQUE索引或PRIMARY 
KEY中出现重复值，则执行旧行UPDATE；如果不会导致唯一值列重复的问题，则插入新行。例如，如果列a被定义为UNIQUE，并且包含值1，则以下
两个语句具有相同的效果：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;TABLE&nbsp;(a,b,c)&nbsp;
VALUES&nbsp;(1,2,3)&nbsp;ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;c=c+1;
UPDATE&nbsp;TABLE&nbsp;SET&nbsp;c=c+1&nbsp;WHERE&nbsp;a=1;</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;如果行作为新记录被插入，则受影响行的值为1；如果原有的记录被更新，则受影响行的值为2。<br/>&nbsp;&nbsp;&nbsp;&nbsp;如果你想了解更多关于INSERT INTO .. ON DUPLICATE KEY的功能说明，详见MySQL参考文档：13.2.4. INSERT语法<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;现
在问题来了，如果INSERT多行记录， ON DUPLICATE KEY 
UPDATE后面字段的值怎么指定？要知道一条INSERT语句中只能有一个ON DUPLICATE KEY 
UPDATE，到底他会更新一行记录，还是更新所有需要更新的行。这个问题困扰了我很久了，其实使用VALUES()函数一切问题都解决了。<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;举个例子，字段a被定义为UNIQUE，并且原数据库表table中已存在记录(2,2,9)和(3,2,1)，如果插入记录的a值与原有记录重复，则更新原有记录，否则插入新行：</p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;TABLE&nbsp;(a,b,c)&nbsp;VALUES&nbsp;
(1,2,3),
(2,5,7),
(3,3,6),
(4,8,2)
ON&nbsp;DUPLICATE&nbsp;KEY&nbsp;UPDATE&nbsp;b=VALUES(b);</pre><p>&nbsp;&nbsp;&nbsp;&nbsp;以
上SQL语句的执行，发现(2,5,7)中的a与原有记录(2,2,9)发生唯一值冲突，则执行ON DUPLICATE KEY 
UPDATE，将原有记录(2,2,9)更新成(2,5,9)，将(3,2,1)更新成(3,3,1)，插入新记录(1,2,3)和(4,8,2)<br/><span style=\\"color: #ff0000;\\">&nbsp;&nbsp;&nbsp;&nbsp;注意：ON DUPLICATE KEY UPDATE只是MySQL的特有语法，并不是SQL标准语法！</span></p><p>&nbsp;</p><p><span style=\\"color: #000000;\\">&nbsp;&nbsp;&nbsp;&nbsp;转自：http://www.jb51.net/article/39255.htm</span></p><p><br/></p>',
      'keyword' => 'mysql',
      'sortid' => '4',
      'img' => '',
      'views' => '2',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 15:24:42',
    ),
    9 => 
    array (
      'id' => '28',
      'uid' => '1',
      'title' => 'php生成excel',
      'content' => '<p><span style=\\"color: #000000;\\"><strong>1、用类生成</strong></span><br/></p><pre class=\\"brush:php;toolbar:false\\">&lt;?php

/**
&nbsp;*&nbsp;Simple&nbsp;excel&nbsp;generating&nbsp;from&nbsp;PHP5
&nbsp;*&nbsp;
&nbsp;*&nbsp;This&nbsp;is&nbsp;one&nbsp;of&nbsp;my&nbsp;utility-classes.
&nbsp;*&nbsp;
&nbsp;*&nbsp;The&nbsp;MIT&nbsp;License
&nbsp;*&nbsp;
&nbsp;*&nbsp;Copyright&nbsp;(c)&nbsp;2007&nbsp;Oliver&nbsp;Schwarz
&nbsp;*&nbsp;
&nbsp;*&nbsp;Permission&nbsp;is&nbsp;hereby&nbsp;granted,&nbsp;free&nbsp;of&nbsp;charge,&nbsp;to&nbsp;any&nbsp;person
&nbsp;*&nbsp;obtaining&nbsp;a&nbsp;copy&nbsp;of&nbsp;this&nbsp;software&nbsp;and&nbsp;associated&nbsp;documentation
&nbsp;*&nbsp;files&nbsp;(the&nbsp;&quot;Software&quot;),&nbsp;to&nbsp;deal&nbsp;in&nbsp;the&nbsp;Software&nbsp;without
&nbsp;*&nbsp;restriction,&nbsp;including&nbsp;without&nbsp;limitation&nbsp;the&nbsp;rights&nbsp;to&nbsp;use,
&nbsp;*&nbsp;copy,&nbsp;modify,&nbsp;merge,&nbsp;publish,&nbsp;distribute,&nbsp;sublicense,&nbsp;and/or
&nbsp;*&nbsp;sell&nbsp;copies&nbsp;of&nbsp;the&nbsp;Software,&nbsp;and&nbsp;to&nbsp;permit&nbsp;persons&nbsp;to&nbsp;whom&nbsp;the
&nbsp;*&nbsp;Software&nbsp;is&nbsp;furnished&nbsp;to&nbsp;do&nbsp;so,&nbsp;subject&nbsp;to&nbsp;the&nbsp;following
&nbsp;*&nbsp;conditions:
&nbsp;*
&nbsp;*&nbsp;The&nbsp;above&nbsp;copyright&nbsp;notice&nbsp;and&nbsp;this&nbsp;permission&nbsp;notice&nbsp;shall&nbsp;be
&nbsp;*&nbsp;included&nbsp;in&nbsp;all&nbsp;copies&nbsp;or&nbsp;substantial&nbsp;portions&nbsp;of&nbsp;the&nbsp;Software.
&nbsp;*&nbsp;
&nbsp;*&nbsp;THE&nbsp;SOFTWARE&nbsp;IS&nbsp;PROVIDED&nbsp;&quot;AS&nbsp;IS&quot;,&nbsp;WITHOUT&nbsp;WARRANTY&nbsp;OF&nbsp;ANY&nbsp;KIND,
&nbsp;*&nbsp;EXPRESS&nbsp;OR&nbsp;IMPLIED,&nbsp;INCLUDING&nbsp;BUT&nbsp;NOT&nbsp;LIMITED&nbsp;TO&nbsp;THE&nbsp;WARRANTIES
&nbsp;*&nbsp;OF&nbsp;MERCHANTABILITY,&nbsp;FITNESS&nbsp;FOR&nbsp;A&nbsp;PARTICULAR&nbsp;PURPOSE&nbsp;AND
&nbsp;*&nbsp;NONINFRINGEMENT.&nbsp;IN&nbsp;NO&nbsp;EVENT&nbsp;SHALL&nbsp;THE&nbsp;AUTHORS&nbsp;OR&nbsp;COPYRIGHT
&nbsp;*&nbsp;HOLDERS&nbsp;BE&nbsp;LIABLE&nbsp;FOR&nbsp;ANY&nbsp;CLAIM,&nbsp;DAMAGES&nbsp;OR&nbsp;OTHER&nbsp;LIABILITY,
&nbsp;*&nbsp;WHETHER&nbsp;IN&nbsp;AN&nbsp;ACTION&nbsp;OF&nbsp;CONTRACT,&nbsp;TORT&nbsp;OR&nbsp;OTHERWISE,&nbsp;ARISING
&nbsp;*&nbsp;FROM,&nbsp;OUT&nbsp;OF&nbsp;OR&nbsp;IN&nbsp;CONNECTION&nbsp;WITH&nbsp;THE&nbsp;SOFTWARE&nbsp;OR&nbsp;THE&nbsp;USE&nbsp;OR
&nbsp;*&nbsp;OTHER&nbsp;DEALINGS&nbsp;IN&nbsp;THE&nbsp;SOFTWARE.
&nbsp;*
&nbsp;*&nbsp;@package&nbsp;Utilities
&nbsp;*&nbsp;@author&nbsp;Oliver&nbsp;Schwarz&nbsp;&lt;oliver.schwarz@gmail.com&gt;
&nbsp;*&nbsp;@version&nbsp;1.0
&nbsp;*/

/**
&nbsp;*&nbsp;Generating&nbsp;excel&nbsp;documents&nbsp;on-the-fly&nbsp;from&nbsp;PHP5
&nbsp;*&nbsp;
&nbsp;*&nbsp;Uses&nbsp;the&nbsp;excel&nbsp;XML-specification&nbsp;to&nbsp;generate&nbsp;a&nbsp;native
&nbsp;*&nbsp;XML&nbsp;document,&nbsp;readable/processable&nbsp;by&nbsp;excel.
&nbsp;*&nbsp;
&nbsp;*&nbsp;@package&nbsp;Utilities
&nbsp;*&nbsp;@subpackage&nbsp;Excel
&nbsp;*&nbsp;@author&nbsp;Oliver&nbsp;Schwarz&nbsp;&lt;oliver.schwarz@vaicon.de&gt;
&nbsp;*&nbsp;@version&nbsp;1.0
&nbsp;*
&nbsp;&nbsp;*&nbsp;@todo&nbsp;Add&nbsp;error&nbsp;handling&nbsp;(array&nbsp;corruption&nbsp;etc.)
&nbsp;*&nbsp;@todo&nbsp;Write&nbsp;a&nbsp;wrapper&nbsp;method&nbsp;to&nbsp;do&nbsp;everything&nbsp;on-the-fly
&nbsp;*/
class&nbsp;ExcelNew
{

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Header&nbsp;of&nbsp;excel&nbsp;document&nbsp;(prepended&nbsp;to&nbsp;the&nbsp;rows)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Copied&nbsp;from&nbsp;the&nbsp;excel&nbsp;xml-specs.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;private
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$header&nbsp;=&nbsp;&quot;&lt;?xml&nbsp;version=\\\\&quot;1.0\\\\&quot;&nbsp;encoding=\\\\&quot;GBK\\\\&quot;?\\\\&gt;
&lt;Workbook&nbsp;xmlns=\\\\&quot;urn:schemas-microsoft-com:office:spreadsheet\\\\&quot;
&nbsp;xmlns:x=\\\\&quot;urn:schemas-microsoft-com:office:excel\\\\&quot;
&nbsp;xmlns:ss=\\\\&quot;urn:schemas-microsoft-com:office:spreadsheet\\\\&quot;
&nbsp;xmlns:html=\\\\&quot;http://www.w3.org/TR/REC-html40\\\\&quot;&gt;&quot;;

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Footer&nbsp;of&nbsp;excel&nbsp;document&nbsp;(appended&nbsp;to&nbsp;the&nbsp;rows)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Copied&nbsp;from&nbsp;the&nbsp;excel&nbsp;xml-specs.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;private
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$footer&nbsp;=&nbsp;&quot;&lt;/Workbook&gt;&quot;;

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Document&nbsp;lines&nbsp;(rows&nbsp;in&nbsp;an&nbsp;array)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;private
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;array
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$lines&nbsp;=&nbsp;array&nbsp;();
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$Index&nbsp;=&nbsp;1;

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Worksheet&nbsp;title
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Contains&nbsp;the&nbsp;title&nbsp;of&nbsp;a&nbsp;single&nbsp;worksheet
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;private&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@var&nbsp;string
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$worksheet_title&nbsp;=&nbsp;&quot;Table1&quot;;

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Add&nbsp;a&nbsp;single&nbsp;row&nbsp;to&nbsp;the&nbsp;$document&nbsp;string
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;private
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;array&nbsp;1-dimensional&nbsp;array
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@todo&nbsp;Row-creation&nbsp;should&nbsp;be&nbsp;done&nbsp;by&nbsp;$this-&gt;addArray
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;addRow&nbsp;($array)
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;initialize&nbsp;all&nbsp;cells&nbsp;for&nbsp;this&nbsp;row
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;=&nbsp;&quot;&quot;;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;foreach&nbsp;key&nbsp;-&gt;&nbsp;write&nbsp;value&nbsp;into&nbsp;cells
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($array&nbsp;as&nbsp;$k&nbsp;=&gt;&nbsp;$v):

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;.=&nbsp;&quot;&lt;Cell&gt;&lt;Data&nbsp;ss:Type=\\\\&quot;String\\\\&quot;&gt;&quot;&nbsp;.&nbsp;$v&nbsp;.&nbsp;&quot;&lt;/Data&gt;&lt;/Cell&gt;\\\\n&quot;;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;endforeach;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;transform&nbsp;$cells&nbsp;content&nbsp;into&nbsp;one&nbsp;row
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;lines[]&nbsp;=&nbsp;&quot;&lt;Row&gt;\\\\n&quot;&nbsp;.&nbsp;$cells&nbsp;.&nbsp;&quot;&lt;/Row&gt;\\\\n&quot;;

&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Add&nbsp;an&nbsp;array&nbsp;to&nbsp;the&nbsp;document
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;This&nbsp;should&nbsp;be&nbsp;the&nbsp;only&nbsp;method&nbsp;needed&nbsp;to&nbsp;generate&nbsp;an&nbsp;excel
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;document.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;public
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;array&nbsp;2-dimensional&nbsp;array
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@todo&nbsp;Can&nbsp;be&nbsp;transfered&nbsp;to&nbsp;__construct()&nbsp;later&nbsp;on
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;addArray&nbsp;($array)
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;run&nbsp;through&nbsp;the&nbsp;array&nbsp;and&nbsp;add&nbsp;them&nbsp;into&nbsp;rows
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($array&nbsp;as&nbsp;$k&nbsp;=&gt;&nbsp;$v):
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;addRow&nbsp;($v);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;endforeach;

&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Set&nbsp;the&nbsp;worksheet&nbsp;title
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Checks&nbsp;the&nbsp;string&nbsp;for&nbsp;not&nbsp;allowed&nbsp;characters&nbsp;(:\\\\/?*),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;cuts&nbsp;it&nbsp;to&nbsp;maximum&nbsp;31&nbsp;characters&nbsp;and&nbsp;set&nbsp;the&nbsp;title.&nbsp;Damn
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;why&nbsp;are&nbsp;not-allowed&nbsp;chars&nbsp;nowhere&nbsp;to&nbsp;be&nbsp;found?&nbsp;Windows
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;help&#39;s&nbsp;no&nbsp;help...
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;public
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$title&nbsp;Designed&nbsp;title
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;setWorksheetTitle&nbsp;($title)
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;strip&nbsp;out&nbsp;special&nbsp;chars&nbsp;first
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$title&nbsp;=&nbsp;preg_replace&nbsp;(&quot;/[\\\\\\\\\\\\|:|\\\\/|\\\\?|\\\\*|\\\\[|\\\\]]/&quot;,&nbsp;&quot;&quot;,&nbsp;$title);

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;now&nbsp;cut&nbsp;it&nbsp;to&nbsp;the&nbsp;allowed&nbsp;length
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$title&nbsp;=&nbsp;substr&nbsp;($title,&nbsp;0,&nbsp;31);

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;set&nbsp;title
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;worksheet_title&nbsp;=&nbsp;$title;

&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Generate&nbsp;the&nbsp;excel&nbsp;file
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Finally&nbsp;generates&nbsp;the&nbsp;excel&nbsp;file&nbsp;and&nbsp;uses&nbsp;the&nbsp;header()&nbsp;function
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;to&nbsp;deliver&nbsp;it&nbsp;to&nbsp;the&nbsp;browser.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;public
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$filename&nbsp;Name&nbsp;of&nbsp;excel&nbsp;file&nbsp;to&nbsp;generate&nbsp;(...xls)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;generateXML&nbsp;($filename)
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;deliver&nbsp;header&nbsp;(as&nbsp;recommended&nbsp;in&nbsp;php&nbsp;manual)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-Type:&nbsp;application/vnd.ms-excel;&nbsp;charset=UTF-8&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-Disposition:&nbsp;inline;&nbsp;filename=\\\\&quot;&quot;&nbsp;.&nbsp;$filename&nbsp;.&nbsp;&quot;.xls\\\\&quot;&quot;);

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//add&nbsp;by&nbsp;sun
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-Transfer-Encoding:&nbsp;binary&quot;);&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Pragma:&nbsp;public&quot;);&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Cache-Control:&nbsp;must-revalidate,&nbsp;post-check=0,&nbsp;pre-check=0&quot;);&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;end

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;print&nbsp;out&nbsp;document&nbsp;to&nbsp;the&nbsp;browser
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;need&nbsp;to&nbsp;use&nbsp;stripslashes&nbsp;for&nbsp;the&nbsp;damn&nbsp;&quot;&gt;&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;stripslashes&nbsp;($this-&gt;header);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;\\\\n&lt;Worksheet&nbsp;ss:Name=\\\\&quot;&quot;&nbsp;.&nbsp;$this-&gt;worksheet_title&nbsp;.&nbsp;&quot;\\\\&quot;&gt;\\\\n&lt;Table&gt;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;Column&nbsp;ss:Index=\\\\&quot;1\\\\&quot;&nbsp;ss:AutoFitWidth=\\\\&quot;0\\\\&quot;&nbsp;/&gt;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;implode&nbsp;(&quot;\\\\n&quot;,&nbsp;$this-&gt;lines);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;/Table&gt;\\\\n&lt;/Worksheet&gt;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$this-&gt;footer;

&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Add&nbsp;an&nbsp;array&nbsp;to&nbsp;the&nbsp;document
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;This&nbsp;should&nbsp;be&nbsp;the&nbsp;only&nbsp;method&nbsp;needed&nbsp;to&nbsp;generate&nbsp;an&nbsp;excel
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;document.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;public
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;array&nbsp;2-dimensional&nbsp;array
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@todo&nbsp;Can&nbsp;be&nbsp;transfered&nbsp;to&nbsp;__construct()&nbsp;later&nbsp;on
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;addallArray&nbsp;($array)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;run&nbsp;through&nbsp;the&nbsp;array&nbsp;and&nbsp;add&nbsp;them&nbsp;into&nbsp;rows
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($array&nbsp;as&nbsp;$k&nbsp;=&gt;&nbsp;$v):
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;addallRow&nbsp;($v);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;endforeach;

&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;/*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arr&nbsp;=&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;row&#39;=&gt;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;cell&#39;=&gt;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;MergeAcross&#39;=&gt;&#39;1&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;MergeDown&#39;=&gt;&#39;3&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;Type&#39;=&gt;&#39;Number&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;data&#39;=&gt;&#39;网络房源总量&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;row&#39;=&gt;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;cell&#39;=&gt;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;data&#39;=&gt;&#39;网络房源总量&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;addUMERows($arr)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(is_array($arr))
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($arr&nbsp;as&nbsp;$Row)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($Row&nbsp;as&nbsp;$Cell)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$type&nbsp;=&nbsp;$Cell[&#39;Type&#39;]?$Cell[&#39;Type&#39;]:&#39;String&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$MergeAcross&nbsp;=&nbsp;$Cell[&#39;MergeAcross&#39;]?&quot;&nbsp;ss:MergeAcross=\\\\&quot;&quot;.$Cell[&#39;MergeAcross&#39;].&quot;\\\\&quot;&quot;:&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$MergeDown&nbsp;=&nbsp;$Cell[&#39;MergeDown&#39;]?&quot;&nbsp;ss:MergeDown=\\\\&quot;&quot;.$Cell[&#39;MergeDown&#39;].&quot;\\\\&quot;&quot;:&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;.=&nbsp;&quot;&lt;Cell&quot;.$MergeAcross.$MergeDown.&quot;&gt;&lt;Data&nbsp;ss:Type=\\\\&quot;&quot;.$type.&quot;\\\\&quot;&gt;&quot;&nbsp;.&nbsp;$Cell[&#39;data&#39;]&nbsp;.&nbsp;&quot;&lt;/Data&gt;&lt;/Cell&gt;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;lines[]&nbsp;=&nbsp;&quot;&lt;Row&gt;\\\\n&quot;&nbsp;.&nbsp;$cells&nbsp;.&nbsp;&quot;&lt;/Row&gt;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;*&nbsp;Add&nbsp;a&nbsp;single&nbsp;row&nbsp;to&nbsp;the&nbsp;$document&nbsp;string
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@access&nbsp;private
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;array&nbsp;1-dimensional&nbsp;array
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@todo&nbsp;Row-creation&nbsp;should&nbsp;be&nbsp;done&nbsp;by&nbsp;$this-&gt;addArray
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;addallRow&nbsp;($array)
&nbsp;&nbsp;&nbsp;&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;initialize&nbsp;all&nbsp;cells&nbsp;for&nbsp;this&nbsp;row
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;=&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$flag&nbsp;=&nbsp;false;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;foreach&nbsp;key&nbsp;-&gt;&nbsp;write&nbsp;value&nbsp;into&nbsp;cells
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($array&nbsp;as&nbsp;$k&nbsp;=&gt;&nbsp;$v):
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(gettype($v)&nbsp;==&nbsp;&#39;array&#39;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($v&nbsp;as&nbsp;$k1&nbsp;=&gt;&nbsp;$v1):
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($flag)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;.=&nbsp;&quot;&lt;Cell&nbsp;ss:Index=\\\\&quot;&quot;.$this-&gt;Index.&quot;\\\\&quot;&gt;&lt;Data&nbsp;ss:Type=\\\\&quot;String\\\\&quot;&gt;&quot;&nbsp;.&nbsp;$v1&nbsp;.&nbsp;&quot;&lt;/Data&gt;&lt;/Cell&gt;\\\\n&quot;;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$flag&nbsp;=&nbsp;false;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;.=&nbsp;&quot;&lt;Cell&gt;&lt;Data&nbsp;ss:Type=\\\\&quot;String\\\\&quot;&gt;&quot;&nbsp;.&nbsp;$v1&nbsp;.&nbsp;&quot;&lt;/Data&gt;&lt;/Cell&gt;\\\\n&quot;;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;endforeach;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($v&nbsp;!=&nbsp;&quot;&quot;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($k&nbsp;==&#39;mergedown&#39;&nbsp;||&nbsp;$k&nbsp;==&nbsp;&#39;mergedown1&#39;&nbsp;||&nbsp;$k&nbsp;==&nbsp;&#39;mergedown2&#39;&nbsp;||&nbsp;$k&nbsp;==&nbsp;&#39;mergedown3&#39;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;.=&nbsp;&quot;&lt;Cell&nbsp;ss:MergeDown=\\\\&quot;2\\\\&quot;&nbsp;&gt;&lt;Data&nbsp;ss:Type=\\\\&quot;String\\\\&quot;&gt;&quot;&nbsp;.&nbsp;$v&nbsp;.&nbsp;&quot;&lt;/Data&gt;&lt;/Cell&gt;\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cells&nbsp;.=&nbsp;&quot;&lt;Cell&gt;&lt;Data&nbsp;ss:Type=\\\\&quot;String\\\\&quot;&gt;&quot;&nbsp;.&nbsp;$v&nbsp;.&nbsp;&quot;&lt;/Data&gt;&lt;/Cell&gt;\\\\n&quot;;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($k&nbsp;==&nbsp;&#39;mergedown&#39;)&nbsp;&nbsp;$this-&gt;Index&nbsp;=&nbsp;2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($k&nbsp;==&nbsp;&#39;mergedown1&#39;)&nbsp;$this-&gt;Index&nbsp;=&nbsp;3;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($k&nbsp;==&nbsp;&#39;mergedown2&#39;)&nbsp;$this-&gt;Index&nbsp;=&nbsp;4;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($k&nbsp;==&nbsp;&#39;mergedown3&#39;)&nbsp;$this-&gt;Index&nbsp;=&nbsp;5;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$flag&nbsp;=&nbsp;true;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;endforeach;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;transform&nbsp;$cells&nbsp;content&nbsp;into&nbsp;one&nbsp;row
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;lines[]&nbsp;=&nbsp;&quot;&lt;Row&gt;\\\\n&quot;&nbsp;.&nbsp;$cells&nbsp;.&nbsp;&quot;&lt;/Row&gt;\\\\n&quot;;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;}

}

?&gt;</pre><p><strong>2.简单的输出excel文件</strong></p><pre class=\\"brush:php;toolbar:false\\">header(&quot;Content-type:&nbsp;application/vnd.ms-excel&quot;);
header(&quot;Content-Disposition:&nbsp;attachment;&nbsp;filename=test.xml&quot;);&nbsp;
header(&quot;Pragma:no-cache&quot;);
header(&#39;Expires:0&#39;);
echo&nbsp;&quot;world&quot;.&quot;\\\\t&quot;;
echo&nbsp;&quot;\\\\t\\\\n&quot;;
&nbsp;&nbsp;
/*start&nbsp;of&nbsp;second&nbsp;line*/&nbsp;&nbsp;
echo&nbsp;&quot;this&nbsp;is&nbsp;second&nbsp;line&quot;.&quot;\\\\t&quot;;&nbsp;&nbsp;
echo&nbsp;&quot;Hi,pretty&nbsp;girl&quot;.&quot;\\\\t&quot;;&nbsp;&nbsp;
echo&nbsp;&quot;\\\\t\\\\n&quot;;</pre><p><br/></p>',
      'keyword' => 'php,excel',
      'sortid' => '3',
      'img' => '',
      'views' => '2',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 15:48:29',
    ),
  ),
); 
?>