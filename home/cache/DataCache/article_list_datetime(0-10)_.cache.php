<?php 
 $arr=array (
  'expiration' => 1474340657,
  'info' => 
  array (
    0 => 
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
      'views' => '12',
      'comnum' => '1',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:54:48',
    ),
    1 => 
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
    2 => 
    array (
      'id' => '83',
      'uid' => '1',
      'title' => '阿里云服务器Linux环境下设置mysql支持远程连接数据库',
      'content' => '<p>一是：改表法（这个方法我没有试）<br/>因为在linux环境下，默认是关闭3306端口远程连接的，需要开启，这个后面说！<br/>可能是你的帐号不允许从远程登陆，只能在localhost。这个时候只要在localhost的那台电脑，登入mysql后，更改 &quot;mysql&quot; 数据库 里的 &quot;user&quot;（远程数据库的名称） 表里的 &quot;host&quot; 项，从&quot;localhost&quot;改称&quot;%&quot; &nbsp;&nbsp;<br/>mysql -u root -pvmwaremysql&gt;use mysql; &nbsp;&nbsp;<br/>mysql&gt;update user set host = ’%’ where user = ’root’; &nbsp;&nbsp;<br/>mysql&gt;select host, user from user; &nbsp;&nbsp;<br/><br/>二是：授权法<br/>例如，你想myuser（远程连接的用户名）使用mypassword（远程连接的密码）从任何主机连接到mysql服务器的话。 &nbsp;&nbsp;<br/>GRANT ALL PRIVILEGES ON *.* TO ’myuser’@’%’IDENTIFIED BY ’mypassword’ WI &nbsp;&nbsp;<br/>TH GRANT OPTION; &nbsp;&nbsp;<br/>如果你想允许用户myuser（远程连接的用户名）从ip为192.168.1.6（你测试电脑上的IP）的主机连接到mysql服务器，并使用 mypassword（远程连接的密码）作为密码 &nbsp;&nbsp;<br/>GRANT ALL PRIVILEGES ON *.* TO ’myuser’@’192.168.1.6’IDENTIFIED BY &nbsp;&nbsp;<br/>’mypassword’ WITH GRANT OPTION; &nbsp;&nbsp;<br/>开始用的第一个方法,刚开始发现不行,在网上查了一下,少执行一个语句 mysql&gt;FLUSH RIVILEGES使修改生效，就可以了。 &nbsp;&nbsp;<br/>方法是在安装mysql的机器上运行： &nbsp;&nbsp;<br/>1、d:\\\\mysql\\\\bin\\\\&gt;mysql -h localhost -u root &nbsp; //这样应该可以进入MySQL服务器 &nbsp;&nbsp;<br/>2、mysql&gt;GRANT ALL PRIVILEGES ON *.* TO ’root’@’%’WITH GRANT OPTION &nbsp;&nbsp;<br/>//赋予任何主机访问数据的权限 &nbsp;&nbsp;<br/>3、mysql&gt;FLUSH PRIVILEGES &nbsp; //修改生效 &nbsp;&nbsp;<br/>4、mysql&gt;EXIT &nbsp; //退出MySQL服务器 &nbsp;<br/>这个时候还没结束呢，一般的服务器上安装的都有防火墙之类的东西，也需要我们开启3306端口才能用了<br/>在linux下要开启防火墙 打开3306 端口，编辑这个文件vim /etc/sysconfig/iptables<br/>输入<br/>-A RH-Firewall-1-INPUT -m state --state NEW -m tcp -p tcp --dport 3306 -j ACCEPT<br/>保存后在控制台输入 /etc/rc.d/init.d/iptables restart &nbsp;重启防火墙，记得一定要重启哦，我就是因为没有重启防火墙导致一直连接不上，最后终于找到答案了<br/><br/>快速让MySQL数据库服务器支持远程连接<br/><br/><br/>在CentOS上安装MySQL数据库服务器后，系统出于安全性考虑，缺省不支持用户通过非本机连接上数据库服务器，如果想让用户通过另外一台机器连接上数据库服务器必须手动进行修改：<br/><br/>1、在控制台执行 mysql -u root -p mysql，系统提示输入数据库root用户的密码，输入完成后即进入mysql控制台，这个命令的第一个mysql是执行命令，第二个mysql是系统数据名称，不一样的。<br/><br/>2、在mysql控制台执行 GRANT ALL PRIVILEGES ON *.* TO &#39;root&#39;@&#39;%&#39; IDENTIFIED BY &#39;MyPassword&#39; WITH GRANT OPTION;<br/><br/>3、 在mysql控制台执行命令中的 &#39;root&#39;@&#39;%&#39; 可以这样理解: 
root是用户名，%是主机名或IP地址，这里的%代表任意主机或IP地址，你也可替换成任意其它用户名或指定唯一的IP地址；&#39;MyPassword&#39;
 是给授权用户指定的登录数据库的密码；另外需要说明一点的是我这里的都是授权所有权限，可以指定部分权限<br/><br/>4、不放心的话可以在mysql控制台执行 select host, user from user; 检查一下用户表里的内容<br/><br/><br/>打开MySQL远程访问权限<br/><br/>1.以 root 帐户登陆 MySQL&nbsp;<br/><br/>MySQL -uroot -p123456&nbsp;<br/><br/>注：123456 为 root 用户的密码。<br/><br/>2.创建远程登陆用户并授权<br/><br/>grant all PRIVILEGES on discuz.* to ted@&#39;123.123.123.123&#39; identified by &#39;123456&#39;;&nbsp;<br/><br/>注：上面的语句表示将 discuz 数据库的所有权限授权给 ted 这个用户，允许 ted 用户在 123.123.123.123 这个 IP 进行远程登陆，并设置 ted 用户的密码为 123456 。<br/><br/>----------------<br/><br/>改表法&nbsp;<br/><br/>可能是你的帐号不允许从远程登陆，只能在localhost。这个时候只要在localhost的那台电脑，登入mysql后，更改 &quot;mysql&quot; 数据库里的 &quot;user&quot; 表里的 &quot;host&quot; 项，从&quot;localhost&quot;改称&quot;%&quot;&nbsp;<br/><br/>mysql -u root -p&nbsp;<br/><br/>mysql&gt;use mysql;&nbsp;<br/><br/>mysql&gt;update user set host = &#39;%&#39; where user = &#39;root&#39;;&nbsp;<br/><br/>mysql&gt;select host, user from user;</p>',
      'keyword' => '阿里云,服务器,Linux,mysql,远程,连接数据库',
      'sortid' => '5',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:52:56',
    ),
    3 => 
    array (
      'id' => '82',
      'uid' => '1',
      'title' => 'linux中提示The requested URL *** was not found on this server',
      'content' => '<p>本文章来给大家介绍关于在使用linux中提示The requested URL *** was not found on this server错误解决办法，有需要了解的朋友可进入参考。</p><p>因为之前别人在服务器上装了<a href=\\"http://www.111cn.net/list-195/\\" target=\\"_blank\\">nginx</a>,我装了<a href=\\"http://www.111cn.net/list-121/\\" target=\\"_blank\\">apache</a>后，访问出现The <a href=\\"http://www.111cn.net/tags.php/request/\\" target=\\"_blank\\">request</a>ed URL *** was not found on this server，查看了下/etc/httpd/conf/httpd.conf,发现原因：</p><p>DocumentRoot指向错误，于是修改之，另外确保你的apache开启了rewrite_module模块</p><p>Apache的rewrite_module模块，支持.htaccess</p><p><br/><strong>rewrite_module没开启，开启过程如下：</strong></p><p>centos的配置文件放在：</p><table style=\\"background:#FB7\\" align=\\"center\\" border=\\"0\\" cellpadding=\\"1\\" cellspacing=\\"1\\" width=\\"620\\">
	<tbody><tr>
		<td height=\\"27\\" bgcolor=\\"#FFE7CE\\" width=\\"464\\">&nbsp;代码如下</td>
		<td style=\\"cursor:pointer;\\" align=\\"center\\" bgcolor=\\"#FFE7CE\\" width=\\"109\\">复制代码</td>
	</tr>
	<tr>
		<td colspan=\\"2\\" style=\\"padding:10px;\\" class=\\"copyclass\\" id=\\"copy7251\\" height=\\"auto\\" bgcolor=\\"#FFFFFF\\" valign=\\"top\\">/etc/httpd/conf/httpd.conf</td>
	</tr>
	</tbody></table><p>打开文件找到：</p><table style=\\"background:#FB7\\" align=\\"center\\" border=\\"0\\" cellpadding=\\"1\\" cellspacing=\\"1\\" width=\\"620\\">
	<tbody><tr>
		<td height=\\"27\\" bgcolor=\\"#FFE7CE\\" width=\\"464\\">&nbsp;代码如下</td>
		<td style=\\"cursor:pointer;\\" align=\\"center\\" bgcolor=\\"#FFE7CE\\" width=\\"109\\">复制代码</td>
	</tr>
	<tr>
		<td colspan=\\"2\\" style=\\"padding:10px;\\" class=\\"copyclass\\" id=\\"copy8227\\" height=\\"auto\\" bgcolor=\\"#FFFFFF\\" valign=\\"top\\"><p>LoadModule rewrite_module modules/mod_rewrite.so</p></td>
	</tr>
	</tbody></table><p>将前面&quot;#&quot;去掉，如果不存在则添加上句。</p><p>如果你的网站是根目录的话：找到</p><table style=\\"background:#FB7\\" align=\\"center\\" border=\\"0\\" cellpadding=\\"1\\" cellspacing=\\"1\\" width=\\"620\\">
	<tbody><tr>
		<td height=\\"27\\" bgcolor=\\"#FFE7CE\\" width=\\"464\\">&nbsp;代码如下</td>
		<td style=\\"cursor:pointer;\\" align=\\"center\\" bgcolor=\\"#FFE7CE\\" width=\\"109\\">复制代码</td>
	</tr>
	<tr>
		<td colspan=\\"2\\" style=\\"padding:10px;\\" class=\\"copyclass\\" id=\\"copy3827\\" height=\\"auto\\" bgcolor=\\"#FFFFFF\\" valign=\\"top\\"><p>&lt;Directory /&gt;<br/>&nbsp; Options FollowSymLinks<br/>&nbsp; AllowOverride None&nbsp; <br/>&lt;/Directory&gt;</p></td>
	</tr>
	</tbody></table><p>将上面的<span style=\\"color:#ff0000\\">None改为All</span></p><p>如果你的站点不在根目录，设置如下：</p><table style=\\"background:#FB7\\" align=\\"center\\" border=\\"0\\" cellpadding=\\"1\\" cellspacing=\\"1\\" width=\\"620\\">
	<tbody><tr>
		<td height=\\"27\\" bgcolor=\\"#FFE7CE\\" width=\\"464\\">&nbsp;代码如下</td>
		<td style=\\"cursor:pointer;\\" align=\\"center\\" bgcolor=\\"#FFE7CE\\" width=\\"109\\">复制代码</td>
	</tr>
	<tr>
		<td colspan=\\"2\\" style=\\"padding:10px;\\" class=\\"copyclass\\" id=\\"copy1013\\" height=\\"auto\\" bgcolor=\\"#FFFFFF\\" valign=\\"top\\"><p>&lt;Directory &quot;/var/www/html/my_directory&quot;&gt;&nbsp;</p><p>Order allow,deny<br/>Allow from all<br/>AllowOverride All<br/>&lt;/Directory&gt;</p></td>
	</tr>
	</tbody></table><p>OK，然后重启服务器，service httpd restart ,这样.htaccess就可以使用了</p><p><br/></p>',
      'keyword' => 'linux',
      'sortid' => '5',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:51:59',
    ),
    4 => 
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
      'views' => '1',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:51:07',
    ),
    5 => 
    array (
      'id' => '80',
      'uid' => '1',
      'title' => 'CI设置伪静态对分页类不适用及分页类链接不完整的解决',
      'content' => '<p>在CI框架使用伪静态时，某些情况下伪静态并不适用。CI框架在包含多页链接时候如果使用伪静态就会在链接地址尾部加上事先自定义的后缀（例.html）。</p><p>但是在某些最后一个参数当使用命令为一个数字时候。控制器将会把.html一并接收，从而使接下来的执行出现异常。</p><p><span id=\\"more-37\\"></span></p><p>操作之前我们需要定义下伪静态后缀：</p><p>找到<strong>./application/config/config.php</strong>文件60行附近设置：</p><pre>$config[&#39;url_suffix&#39;]&nbsp;=&nbsp;&#39;.html&#39;;</pre><p><strong>解决方案开始</strong>：</p><p>找到<strong> ./system/core/URI.php</strong>文件280行附近_remove_url_suffix 函数可添加：</p><pre>$this-&gt;uri_string&nbsp;=&nbsp;str_replace($this-&gt;config-&gt;item(&#39;url_suffix&#39;),&nbsp;&#39;&#39;,&nbsp;$this-&gt;uri_string);</pre><pre>更新CI3.0&nbsp;在154行之后添加此句。</pre><p>此举可以在接收地址栏参数时候排除自定义的后缀名，解决隐患。</p><p>接着，在分页类使用过程中，以下某种情况将会出现：<br/>当配置参数$config[‘base_url’] 使用 site_url()点击非首页时候：</p><pre>http://127.0.0.1/article/list/1.html/10</pre><p>当配置参数$config[‘base_url’] 使用 base_url()点击首页时候根本没见到自定义的后缀好吗，亦或者这样：</p><pre>http://127.0.0.1/article/list/1/.html</pre><p>这个地址看起来太糟糕了有木有，所以我们将会把系统库的页面配置进行修改,在<strong>./system/libraries/Pagination.php</strong> 文件中225行附近$output=”;后添加</p><pre>$this-&gt;suffix&nbsp;=&nbsp;$CI-&gt;config-&gt;item(&#39;url_suffix&#39;);
$this-&gt;first_url=&nbsp;rtrim((($this-&gt;first_url&nbsp;==&nbsp;&#39;&#39;)&nbsp;?&nbsp;$this-&gt;base_url&nbsp;:&nbsp;$this-&gt;first_url),&nbsp;&#39;/&#39;).$this-&gt;suffix;</pre><pre>更新CI3.0&nbsp;在556行之后添加此内容，注意$CI-&gt;config-&gt;item(&#39;url_suffix&#39;);已改为$this-&gt;CI-&gt;config-&gt;item(&#39;url_suffix&#39;);。然后分别在566、580、612行中的$first_url替换为&nbsp;$this-&gt;first_url</pre><p>这样就能避免出现以上两种情况。</p><p><strong>注意</strong>：使用分页类时，配置参数$config[‘base_url’] 使用 base_url();而不用site_url();</p><p><strong>附赠</strong>：</p><pre>$Str[&#39;count_page&#39;]&nbsp;=&nbsp;ceil($total&nbsp;/&nbsp;$limit);//总页数
$Str[&#39;this_page&#39;]&nbsp;=&nbsp;$offset&nbsp;/&nbsp;$limit&nbsp;+&nbsp;1;//当前页</pre><p><br/></p><p>文章转自：http://www.vifoe.com/ci%E8%AE%BE%E7%BD%AE%E4%BC%AA%E9%9D%99%E6%80%81%E5%AF%B9%E5%88%86%E9%A1%B5%E7%B1%BB%E4%B8%8D%E9%80%82%E7%94%A8%E5%8F%8A%E5%88%86%E9%A1%B5%E7%B1%BB%E9%93%BE%E6%8E%A5%E4%B8%8D%E5%AE%8C%E6%95%B4%E7%9A%84/</p>',
      'keyword' => 'CI,伪静态,分页',
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:21:00',
    ),
    6 => 
    array (
      'id' => '79',
      'uid' => '1',
      'title' => 'CodeIgniter 的分页类调用并处理多参数',
      'content' => '<p>ci分页扩展类：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
if&nbsp;(!defined(&#39;BASEPATH&#39;))&nbsp;exit(&#39;No&nbsp;direct&nbsp;script&nbsp;access&nbsp;allowed&#39;);
/**
&nbsp;*&nbsp;分页类&nbsp;初始化与控制
&nbsp;*&nbsp;@author&nbsp;WangYongDong
&nbsp;*/
class&nbsp;Page&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;function&nbsp;loadPage($iCount,$iPageSize,$sUrl)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//加载分页类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$CI&nbsp;=&nbsp;&amp;&nbsp;get_instance();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$CI-&gt;load-&gt;library(&#39;pagination&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;base_url&#39;]&nbsp;=&nbsp;base_url().$sUrl;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;total_rows&#39;]&nbsp;=&nbsp;$iCount;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//总条数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;per_page&#39;]&nbsp;=&nbsp;$iPageSize;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//每页条数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;num_links&#39;]&nbsp;=&nbsp;2;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//定义当前页的前后各有几个数字链接
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;use_page_numbers&#39;]&nbsp;=&nbsp;TRUE;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//显示当前页码
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;first_link&#39;]&nbsp;=&nbsp;&#39;首页&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;last_link&#39;]&nbsp;=&nbsp;&#39;末页&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;next_link&#39;]&nbsp;=&nbsp;&#39;下一页&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;下一页显示
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;prev_link&#39;]&nbsp;=&nbsp;&#39;上一页&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;上一页显示
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;full_tag_open&#39;]&nbsp;=&nbsp;&#39;&lt;p&nbsp;class=&quot;page-bor&quot;&gt;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;//把打开的标签放在所有结果的左侧。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;full_tag_close&#39;]&nbsp;=&nbsp;&#39;&lt;/p&gt;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//把关闭的标签放在所有结果的右侧。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;first_tag_open&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“第一页”链接的打开标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;first_tag_close&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;//“第一页”链接的关闭标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;last_tag_open&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“最后一页”链接的打开标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;last_tag_close&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“最后一页”链接的关闭标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;next_tag_open&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“下一页”链接的打开标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;next_tag_close&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“下一页”链接的关闭标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;prev_tag_open&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“上一页”链接的打开标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;prev_tag_close&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“上一页”链接的关闭标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;cur_tag_open&#39;]&nbsp;=&nbsp;&#39;&lt;a&nbsp;class=&quot;page-othor&nbsp;current&quot;&gt;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;//“当前页”链接的打开标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;cur_tag_close&#39;]&nbsp;=&nbsp;&#39;&lt;/a&gt;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“当前页”链接的关闭标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;num_tag_open&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“数字”链接的打开标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;num_tag_close&#39;]&nbsp;=&nbsp;&#39;&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//“数字”链接的关闭标签。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;anchor_class&#39;]&nbsp;=&nbsp;&quot;class=&#39;page-othor&#39;&quot;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//给链接添加&nbsp;CSS&nbsp;类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;page_query_string&#39;]&nbsp;=&nbsp;TRUE;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//以?id=3&amp;name=4
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;query_string_segment&#39;]&nbsp;=&nbsp;&#39;page&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//设置分页参数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$CI-&gt;pagination-&gt;initialize($config);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//执行分页方法
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;static&nbsp;function&nbsp;getParam($iPageSize,$pageId)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pagenum&nbsp;=&nbsp;$iPageSize;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pageId&nbsp;=&nbsp;$pageId&nbsp;?&nbsp;$pageId&nbsp;:&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$start&nbsp;=&nbsp;($pageId&nbsp;-&nbsp;1)&nbsp;*&nbsp;$pagenum;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arr[&#39;start&#39;]&nbsp;=&nbsp;$start;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arr[&#39;pagenum&#39;]&nbsp;=&nbsp;$pagenum;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$arr;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
}</pre><p>分页调用函数：</p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;调用分页类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getPage($sTable,$sUrl,$pageId,$iPageNum=10,$sFilter=&#39;&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//调用page类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;library(&#39;page&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iCount&nbsp;=&nbsp;getPageCount($sTable,$sFilter);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iPageSize&nbsp;=&nbsp;$iPageNum;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;page-&gt;loadPage($iCount,$iPageSize,$sUrl);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//总页数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$num_pages&nbsp;=&nbsp;ceil($iCount/$iPageSize);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($pageId&gt;$num_pages)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pageId&nbsp;=&nbsp;$num_pages;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($pageId&lt;0)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pageId&nbsp;=&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arr&nbsp;=&nbsp;$this-&gt;page-&gt;getParam($iPageSize,$pageId);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$arr;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>调用实例：</p><pre class=\\"brush:php;toolbar:false\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//分页执行，无多余参数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pageId&nbsp;=&nbsp;$this-&gt;input-&gt;get(&#39;page&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arr&nbsp;=&nbsp;$this-&gt;public_model-&gt;getPage(&quot;links&quot;,&#39;links?&#39;,$pageId);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[&#39;list&#39;]&nbsp;=&nbsp;$this-&gt;links_model-&gt;getLinksList($arr[&#39;start&#39;],$arr[&#39;pagenum&#39;]);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//分页执行，有其他参数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//分页执行
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pageId&nbsp;=&nbsp;$this-&gt;input-&gt;get(&#39;page&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sFilter&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!empty($data[&#39;aFilter&#39;][&#39;keyword&#39;]))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sFilter&nbsp;=&nbsp;&#39;&nbsp;AND&nbsp;title&nbsp;LIKE&quot;%&#39;.$data[&#39;aFilter&#39;][&#39;keyword&#39;].&#39;%&quot;&nbsp;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arr&nbsp;=&nbsp;$this-&gt;public_model-&gt;getPage(&quot;article&quot;,&#39;article?&#39;,$pageId,$sFilter);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[&#39;list&#39;]&nbsp;=&nbsp;$this-&gt;article_model-&gt;getArticleList($arr[&#39;start&#39;],$arr[&#39;pagenum&#39;],$data[&#39;aFilter&#39;]);</pre><p><br/></p>',
      'keyword' => 'CodeIgniter,分页,参数',
      'sortid' => '3',
      'img' => '',
      'views' => '1',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:18:34',
    ),
    7 => 
    array (
      'id' => '78',
      'uid' => '1',
      'title' => 'URL带有其他参数时，如何使用PHP的CI框架分页类？',
      'content' => '<p>最近在学习用php的CI框架写一个自己的CMS，遇到了些问题。</p><p>其中一个就是CI分页的时候，我的URL带有其他参数，才能查出我想要的数据。于是我翻遍了谷歌度娘，终于找到了解决办法，和我想的差不多，就贴出了和大家分享下。</p><p>首先，设置你的base_url，$block，create_id，has_pass，pass_id为我的查询条件，表单提交GET方式，根据条件的有无，修改base_url和查询条件</p><pre class=\\"brush:php;toolbar:false\\">$config[&#39;base_url&#39;]&nbsp;=&nbsp;&nbsp;base_url().&quot;index.php/admin/article/manage?&quot;;&nbsp;&nbsp;
　　if(!empty($_GET[&#39;block&#39;])){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;db-&gt;where(&#39;class_id&#39;,&nbsp;$_GET[&#39;block&#39;]);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;base_url&#39;].=&quot;&amp;block=&quot;.$_GET[&#39;block&#39;];&lt;br&gt;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;if(!empty($_GET[&#39;create_id&#39;])){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;db-&gt;where(&#39;create_id&#39;,&nbsp;$_GET[&#39;create_id&#39;]);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;base_url&#39;].=&quot;&amp;create_id=&quot;.$_GET[&#39;create_id&#39;];&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;if(!empty($_GET[&#39;has_pass&#39;])){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;db-&gt;where(&#39;has_pass&#39;,&nbsp;$_GET[&#39;has_pass&#39;]);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;base_url&#39;].=&quot;&amp;has_pass=&quot;.$_GET[&#39;has_pass&#39;];&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;if(!empty($_GET[&#39;pass_id&#39;])){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;　　$this-&gt;db-&gt;where(&#39;pass_id&#39;,&nbsp;$_GET[&#39;pass_id&#39;]);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;　　$config[&#39;base_url&#39;].=&quot;&amp;pass_id=&quot;.$_GET[&#39;pass_id&#39;];&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;}</pre><p>然后开启page_query_string</p><pre class=\\"brush:php;toolbar:false\\">$config[&#39;page_query_string&#39;]&nbsp;=&nbsp;TRUE;</pre><p>最后出现的URL是这样的</p><p>http:<span class=\\"comment\\">//localhost/lycms/index.php/admin/article/manage?&amp;block=8&amp;create_id=0&amp;has_pass=1&amp;pagenow=2</span></p><p><span class=\\"comment\\"><br/></span></p><p><span class=\\"comment\\"></span></p><p>&amp;per_page=2是开启page_query_string后，自动在url后追加的。</p><p>OK，就这样搞定了。</p><p>还有的同学想在CI输出分页链接的时候加上&quot;共X条记录 N/X页&quot;等字样，其实很简单，只要在CI分页类的文件system\\\\libraries\\\\Pagination.php 里添加如下代码即可</p><pre class=\\"brush:php;toolbar:false\\">$output&nbsp;=&nbsp;&#39;共&#39;.$this-&gt;total_rows.&#39;条记录&nbsp;&nbsp;&#39;.$this-&gt;cur_page&nbsp;.&#39;/&#39;.$num_pages.&#39;页&nbsp;&#39;;</pre><p>好吧，就这样</p><p><span class=\\"comment\\"></span> <br/><br/></p>',
      'keyword' => 'ci,框架,分页',
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 17:13:56',
    ),
    8 => 
    array (
      'id' => '77',
      'uid' => '1',
      'title' => 'CodeIgniter分页类对多参数传递时的灵活处理',
      'content' => '<p>Codeigniter的分页类总体是很方便的，但其使用时有一定的限制，如点击页面跳转按钮的时候,按默认的url方式,必须是这样的格式<br/>http://example.com/index.php/控制器/方法名/页面的偏移值<br/><br/>页面的偏移值必须是方法名后第一个参数，否者分页类不能判断当前是哪一页，而用ci的分页类进行页面跳转时它是把偏移值加在base_url的最后面。这时如果我在点击页面跳转按钮进行页面跳转时还想带参数呢，像下面这样的话分页类就不能正常工作了。<br/><br/>http://example.com/index.php/控制器/方法名/其它参数1/其它参数2/页面的偏移值<br/><br/>网上查找多处文档，一般的解决方法如下：<br/><br/><span style=\\"color:#990030\\">解决方法，在config.php配置文件中把
$config[&#39;enable_query_strings&#39;] 设置为 TRUE,传给分页类的config配置数组中也要加一个设置
$config[&#39;page_query_string&#39;] = TRUE; 然后我们就能以这查询字符串的方式来跳转页面了。<br/>http://example.com/index.php?c=test&amp;m=page&amp;d1=222&amp;d2=3333&amp;per_page=20<br/><br/>其中的d1和d2是要传给控制器的别的参数。我们获取这两个参数可以用输入类里的
$this-&gt;input-&gt;get(&#39;d1&#39;);<br/></span><br/>经测试使用，不太成功，这种方法并不理想，并且在网站中部分URL使用不同的展现方式总是觉得很别扭，经本人摸索测试，可以使用以下简洁的方法实现之：<br/><br/><span style=\\"color:#22B14C\\"><span style=\\"color:#006600\\">经检查Pagination.php的源代码，发现其有很多
参数一般情况下都是未用的，并且其意义就表示可以处理各种特殊问题，其中suffix的变量引起本人注意，经浏览代码，它的意思是在每个链接的后面再增加
给定的内容，看到这里，灵机一动，那我们可以将页号放在分页正常需要的第3个位置，而将其他参数通过这个suffix加入链接不就行了吗？<br/>　　立刻测试，假定参照上述要求，则将test类中的page方法的变量次序调整一下，即：<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>public function page($page=1,$d1=&#39;111&#39;,$d2=&#39;111&#39;) {<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>....<br/>　　　&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>$config[&#39;suffix&#39;] = &#39;/222/333&#39; ;<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>...<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>$this-&gt;pagination-&gt;initialize($config);<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>$data[&#39;page_links&#39;] =
$this-&gt;pagination-&gt;create_links();<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>...<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>}<br/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>存盘后，F5看结果，Cool！一次性成功！<br/><br/><span style=\\"color:#006600\\"><span style=\\"color:#006600\\">经<span style=\\"color:#006600\\">实际<span style=\\"color:#006600\\">使用，还发现一个小Bug，<span style=\\"color:#006600\\">即数字1的链接总是会<span style=\\"color:#006600\\">链接不正常，经检查其源代码，是</span></span></span></span></span></span></span></span><span style=\\"color:#22B14C\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#22B14C\\"><span style=\\"color:#006600\\">Pagination.php自作聪明地将第一<span style=\\"color:#006600\\">页认为总是不必加分页<span style=\\"color:#006600\\">号，这样，我们设定的参数顺序就会受到影响，导致结果不正常，知道原因后则处理方式</span></span></span></span></span></span></span></span></span></span>也很简单<span style=\\"color:#006600\\"><span style=\\"color:#006600\\">，</span><span style=\\"color:#006600\\">再给</span>第1页传一个参数，这<span style=\\"color:#006600\\">个参数其实</span></span></span></span><span style=\\"color:#22B14C\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#006600\\"><span style=\\"color:#22B14C\\"><span style=\\"color:#006600\\">Pagination.php中也是使用的first_url<span style=\\"color:#006600\\">,<span style=\\"color:#006600\\">如下：<br/><span style=\\"color:#006600\\"><span style=\\"color:#006600\\">&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/>&nbsp;<wbr/><span style=\\"color:#006600\\">$config[&#39;first_url&#39;] = <span style=\\"color:#006600\\">&#39;<span style=\\"color:#006600\\">/test/page/1/222/333&#39; ;</span></span></span></span></span></span></span></span></span></span></span></span></span></p>',
      'keyword' => 'CodeIgniter,分页,参数,传递,ci,框架',
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'sort',
      'status' => 'show',
      'datetime' => '2015-09-21 17:12:30',
    ),
    9 => 
    array (
      'id' => '76',
      'uid' => '1',
      'title' => 'ueditor使用配置总结',
      'content' => '<p>因为本博客就是使用的百度ueditor编辑器，在使用过程中也是遇到了很多的问题，最终在我的不懈努力之下慢慢解决掉了。</p><p><span style=\\"font-size: 24px;\\"><strong>一、编辑器配置：</strong></span></p><h3>1.1 下载编辑器</h3><p>到官网下载 UEditor 最新版：<a href=\\"http://ueditor.baidu.com/website/download.html#ueditor\\" title=\\"官网下载地址\\">[官网地址]</a></p><h3>1.2 创建demo文件</h3><p>解压下载的包，在解压后的目录创建 demo.html 文件，填入下面的html代码</p><pre class=\\"brush:html;toolbar:false\\">&lt;!DOCTYPE&nbsp;HTML&gt;&lt;html&nbsp;lang=&quot;en-US&quot;&gt;&lt;head&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;meta&nbsp;charset=&quot;UTF-8&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;ueditor&nbsp;demo&lt;/title&gt;&lt;/head&gt;&lt;body&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;!--&nbsp;加载编辑器的容器&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;id=&quot;container&quot;&nbsp;name=&quot;content&quot;&nbsp;type=&quot;text/plain&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这里写你的初始化内容
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;!--&nbsp;配置文件&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;src=&quot;ueditor.config.js&quot;&gt;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;!--&nbsp;编辑器源码文件&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;src=&quot;ueditor.all.js&quot;&gt;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;!--&nbsp;实例化编辑器&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;ue&nbsp;=&nbsp;UE.getEditor(&#39;container&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/script&gt;&lt;/body&gt;&lt;/html&gt;</pre><h3>1.3 在浏览器打开demo.html</h3><p>如果看到了下面这样的编辑器，恭喜你，初次部署成功！</p><p><img src=\\"http://fex.baidu.com/ueditor/doc/images/demo.png\\" alt=\\"部署成功\\"/><br/></p><h3>1.4 传入自定义的参数</h3><p>编辑器有很多可自定义的参数项，在实例化的时候可以传入给编辑器：</p><pre style=\\"\\" class=\\"prettyprint lang-javascript prettyprinted\\">var&nbsp;ue&nbsp;=&nbsp;UE.getEditor(&#39;container&#39;,&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;autoHeight:&nbsp;false});</pre><p>配置项也可以通过 ueditor.config.js 文件修改，具体的配置方法请看<a class=\\"mardwodnlink\\" href=\\"http://fex.baidu.com/ueditor/#start-config\\">前端配置项说明</a></p><h3>1.5 设置和读取编辑器的内容</h3><p>通 getContent 和 setContent 方法可以设置和读取编辑器的内容</p><pre class=\\"brush:js;toolbar:false\\">var&nbsp;ue&nbsp;=&nbsp;UE.getContent();//对编辑器的操作最好在编辑器ready之后再做ue.ready(function()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;//设置编辑器的内容
&nbsp;&nbsp;&nbsp;&nbsp;ue.setContent(&#39;hello&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;//获取html内容，返回:&nbsp;&lt;p&gt;hello&lt;/p&gt;
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;html&nbsp;=&nbsp;ue.getContent();
&nbsp;&nbsp;&nbsp;&nbsp;//获取纯文本内容，返回:&nbsp;hello
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;txt&nbsp;=&nbsp;ue.getContentTxt();});</pre><p><strong><span style=\\"font-size: 24px;\\">三、编辑器配置图片上传</span></strong></p><p><span style=\\"font-size: 16px;\\"></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;一、 在线编辑器在页面正常显示</p><p>&nbsp;&nbsp;&nbsp;&nbsp;1. 上百度Editor首页下载http://ueditor.baidu.com/website/</p><p>&nbsp;&nbsp;&nbsp;&nbsp;2. COPY到自己的项目中去，然后记住ueditor所在文件的目录</p><p>&nbsp;&nbsp;&nbsp;&nbsp;3. 配置editor_config.js中的URL(<span style=\\"color: #ff0000;\\">这一步很重要</span>)<span style=\\"color: #000000;\\">，因为我在html文件中测试的时候是没有修改配置文件的信息也可以用，但是用在项目编辑器就无法显示</span></p><pre class=\\"brush:js;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;此处配置写法适用于UEditor小组成员开发使用，外部部署用户请按照上述说明方式配置即可，建议保留下面两行，以兼容可在具体每个页面配置window.UEDITOR_HOME_URL的功能。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;tmp&nbsp;=&nbsp;location.protocol.indexOf(&quot;file&quot;)==-1&nbsp;?&nbsp;location.pathname&nbsp;:&nbsp;location.href;
&nbsp;&nbsp;&nbsp;&nbsp;URL&nbsp;=&nbsp;window.UEDITOR_HOME_URL||tmp.substr(0,tmp.lastIndexOf(&quot;\\\\/&quot;)+1).replace(&quot;_examples/&quot;,&quot;&quot;).replace(&quot;website/&quot;,&quot;&quot;);//这里你可以配置成ueditor目录在您网站的相对路径或者绝对路径（指以http开头的绝对路径）</pre><pre class=\\"brush:js;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;配置项主体。注意，此处所有涉及到路径的配置别遗漏URL变量。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;window.UEDITOR_CONFIG&nbsp;=&nbsp;{

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//为编辑器实例添加一个路径，这个不能被注释
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UEDITOR_HOME_URL&nbsp;:&nbsp;URL

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//图片上传配置区
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;,imageUrl:URL+&quot;jsp/imageUp.jsp&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//图片上传提交地址
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;,imagePath:URL&nbsp;+&nbsp;&quot;jsp/&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//图片修正地址，引用了fixedImagePath,如有特殊需求，可自行配置</pre><p>图片上传路径配置区域是在：ueditor.config.js里URL路径是直接指向了ueditor所在项目中的位置。如：/tools/editor/</p><pre class=\\"brush:html;toolbar:false\\">&lt;!DOCTYPE&nbsp;HTML&gt;
&lt;html&gt;
&lt;head&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;完整的demo&lt;/title&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;meta&nbsp;http-equiv=&quot;Content-Type&quot;&nbsp;content=&quot;text/html;charset=gbk&quot;/&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;UEDITOR_HOME_URL&nbsp;=&nbsp;&quot;/ueditor/&quot;;　　//从项目的根目录开始
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;link&nbsp;type=&quot;text/css&quot;&nbsp;href=&quot;./themes/default/css/ueditor.css&quot;&nbsp;rel=&quot;stylesheet&quot;/&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;src=&quot;./editor_config.js&quot;&gt;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;src=&quot;./editor_all.js&quot;&gt;&lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;div&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;&nbsp;id=&quot;myEditor&quot;&nbsp;type=&quot;text/plain&quot;&gt;欢迎使用&lt;/script&gt;
&lt;/div&gt;
&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;//初始化
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;ue&nbsp;=&nbsp;UE.getEditor(&#39;myEditor&#39;);
&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</pre><p>原因是window.UEDITOR_HOME_URL没有定义，只要在引入script脚本前声明并复制就可以正常使用了，见下代码：</p><p><strong><span style=\\"font-size: 24px;\\"></span></strong></p><p>还有一点就是，如果没有引入editor.css文件那么部分功能的显示将会没有那么好看。(废话。。。)</p><p>二、 图片上传</p><p>1. 具体包括imageUp.jsp和Uploader.java这两个文件</p><p>2. 在jsp页面中只需要引入正确Uploader.java所在的包就行。</p><p>3. 剩下的工作就是在Uploader.java中修改图片上传的目录、制定文件名生成规则等等。 做实现过程中让我很纠结的是：配置完成没问题了，但是就是图片上传不成功具体错误如下：</p><p>&nbsp; &nbsp; &nbsp; 3.1 在没有找到Uploader类的情况下就会报：网络设置不正确，上传失败(大概就是这个意思。。。)</p><p>　　3.2 所有的工作都做完的情况下，上传图片就是不成功，捕获异常呢也捕获不到，最后设置断点之后才知道<span style=\\"color: #000000;\\">fii.hasNext()返回为false，根本原因就是：</span></p><p><span style=\\"color: #ff0000;\\">因为我用的是S2SH框架，在web.xml中struts2过滤器中把*.jsp去掉，如下代码应该去掉，那就OK了：</span></p><p><span style=\\"color: #ff0000;\\"></span></p><pre>&lt;filter-mapping&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;filter-name&gt;struts2&lt;/filter-name&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;url-pattern&gt;*.jsp&lt;/url-pattern&gt;
&lt;/filter-mapping&gt;</pre><pre class=\\"brush:js;toolbar:false\\">public&nbsp;void&nbsp;upload()&nbsp;throws&nbsp;Exception{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;boolean&nbsp;isMultipart&nbsp;=&nbsp;ServletFileUpload.isMultipartContent(this.request);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!isMultipart)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.state&nbsp;=&nbsp;this.errorInfo.get(&quot;NOFILE&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DiskFileItemFactory&nbsp;dff&nbsp;=&nbsp;new&nbsp;DiskFileItemFactory();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String&nbsp;savePath&nbsp;=&nbsp;this.getFolder(this.savePath);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dff.setRepository(new&nbsp;File(savePath));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ServletFileUpload&nbsp;sfu&nbsp;=&nbsp;new&nbsp;ServletFileUpload(dff);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sfu.setSizeMax(this.maxSize&nbsp;*&nbsp;1024);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sfu.setHeaderEncoding(&quot;gbk&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FileItemIterator&nbsp;fii&nbsp;=&nbsp;sfu.getItemIterator(this.request);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while&nbsp;(fii.hasNext())&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FileItemStream&nbsp;fis&nbsp;=&nbsp;fii.next();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!fis.isFormField())&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.originalName&nbsp;=&nbsp;fis.getName().substring(fis.getName().lastIndexOf(System.getProperty(&quot;file.separator&quot;))&nbsp;+&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!this.checkFileType(this.originalName))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.state&nbsp;=&nbsp;this.errorInfo.get(&quot;TYPE&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;continue;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.fileName&nbsp;=&nbsp;this.getName(this.originalName);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.type&nbsp;=&nbsp;this.getFileExt(this.fileName);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.url&nbsp;=&nbsp;savePath&nbsp;+&nbsp;&quot;/&quot;&nbsp;+&nbsp;this.fileName;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BufferedInputStream&nbsp;in&nbsp;=&nbsp;new&nbsp;BufferedInputStream(fis.openStream());
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FileOutputStream&nbsp;out&nbsp;=&nbsp;new&nbsp;FileOutputStream(new&nbsp;File(this.getPhysicalPath(this.url)));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BufferedOutputStream&nbsp;output&nbsp;=&nbsp;new&nbsp;BufferedOutputStream(out);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Streams.copy(in,&nbsp;output,&nbsp;true);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.state=this.errorInfo.get(&quot;SUCCESS&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//UE中只会处理单张上传，完成后即退出
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String&nbsp;fname&nbsp;=&nbsp;fis.getFieldName();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//只处理title，其余表单请自行处理
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!fname.equals(&quot;pictitle&quot;)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;continue;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BufferedInputStream&nbsp;in&nbsp;=&nbsp;new&nbsp;BufferedInputStream(fis.openStream());
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BufferedReader&nbsp;reader&nbsp;=&nbsp;new&nbsp;BufferedReader(new&nbsp;InputStreamReader(in));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;StringBuffer&nbsp;result&nbsp;=&nbsp;new&nbsp;StringBuffer();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while&nbsp;(reader.ready())&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;result.append((char)reader.read());&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.title&nbsp;=&nbsp;new&nbsp;String(result.toString().getBytes(),&quot;gbk&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;reader.close();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;catch&nbsp;(Exception&nbsp;e)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e.printStackTrace();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;this.state&nbsp;=&nbsp;this.errorInfo.get(&quot;UNKNOWN&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><strong><span style=\\"font-size: 24px;\\">四、实现编辑器自适应宽度的解决方案</span></strong></p><p><span style=\\"font-size: 24px;\\"></span></p><p>由于我的网站后台是自适应的，但我们在使用时会发现编辑器不能自适应宽度了，下文我们就一起来看问题解决办法．</p><p>UEditor百度富文本编辑器的initialFrameWidth属性,默认值是1000.</p><p>不能够自适应屏幕宽度.如图1:</p><p><img class=\\"\\" alt=\\"UEditor编辑器实现编辑器自适应宽度的解决方案\\" src=\\"http://filesimg.111cn.net/upload/image/20150201044317.jpg\\"/></p><p>刚开始的时候,我是直接设置initialFrameWidth=null的.效果如图2:</p><p><img class=\\"\\" alt=\\"UEditor编辑器实现编辑器自适应宽度的解决方案\\" src=\\"http://filesimg.111cn.net/upload/image/20150201044334.jpg\\"/></p><p>&nbsp;</p><p>这样子UEditor百度富文本编辑器会在第一次加载的时候获取屏幕宽度,然后赋值给initialFrameWidth属性.<br/>这样子确实是可以在第一次加载的时候适应屏幕宽度,但是却似乎宽度稍微过了一点点,超过上面的灰条了.而且这里还有一个问题:<br/>当你改变浏览器大小时,会有个很严重的排版BUG.<br/>由于它不会自适应宽度.所以会发现编辑器宽度溢出.如图3:</p><p><img class=\\"\\" alt=\\"UEditor编辑器实现编辑器自适应宽度的解决方案\\" src=\\"http://filesimg.111cn.net/upload/image/20150201044354.jpg\\"/></p><p><br/>解决方案:</p><p><br/>1.打开/ueditor/ueditor.config.js<br/>找到initialFrameWidth属性,默认值是1000.即是initialFrameWidth: 1000<br/>把值更改为&#39;100%&#39; , 即是initialFrameWidth: &#39;100%&#39;<br/>保存后,刷新浏览器再看看...</p><p><br/>效果如图4:<img class=\\"\\" alt=\\"UEditor编辑器实现编辑器自适应宽度的解决方案\\" src=\\"http://filesimg.111cn.net/upload/image/20150201044410.jpg\\"/></p><p><span style=\\"font-size: 24px;\\"><strong>五、百度编辑器ueditor 如何用JS取得内容</strong></span></p><p>调用百度编辑器后，用JS怎么取得内容呢？百度的帮助文档写的好隐晦……</p><p>我知道提交表单后，$_POST[&#39;editorValue&#39;];是可以获取内容的，但是JS中怎么做呢？我想用AJAX无刷新技术，所以问一下JS怎么获取内容。</p><pre class=\\"brush:html;toolbar:false\\">&lt;div&nbsp;id=&quot;myEditor&quot;&gt;
&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;id=&quot;myEditor&quot;&gt;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;editor&nbsp;=&nbsp;new&nbsp;baidu.editor.ui.Editor({&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;initialContent:&nbsp;&#39;&#39;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;editor.render(&quot;myEditor&quot;);&nbsp;
&lt;/script&gt;&nbsp;
&lt;/div&gt;</pre><p><br/></p>',
      'keyword' => 'ueditor,百度,编辑器',
      'sortid' => '3',
      'img' => 'Image 2.png',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'home',
      'status' => 'show',
      'datetime' => '2015-09-21 17:09:39',
    ),
  ),
); 
?>