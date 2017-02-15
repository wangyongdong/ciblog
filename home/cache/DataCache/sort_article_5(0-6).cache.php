<?php 
 $arr=array (
  'expiration' => 1473387068,
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
      'views' => '9',
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
      'id' => '57',
      'uid' => '1',
      'title' => 'Windows 下配置 Vagrant 环境',
      'content' => '<p><a href=\\"http://www.vagrantup.com/\\">Vagrant</a>是一个基于 Ruby 的工具，用于创建和部署虚拟化开发环境。它使用 Oracle 的开源<a href=\\"https://www.virtualbox.org/\\">VirtualBox</a>虚拟化系统。</p><p>Vagrant 在快速搭建开发环境方面是很赞的，试想一个团队中，大家开发同一个东西，以前每个人都要自己搭建一套开发环境
，有了 Vagrant，你只需要搭建一份，然后分发给所有团队成员，这样大家都立刻就有完全相同的开发环境了，即便有成员在
Windows 下，也可以方便的使用 Linux 环境开发。如果团队中来了新人，也不需要手把手教他怎么搭建开发环境，给他丢一个
Box 就好了，只要他掌握了 Vagrant 的使用方法，立刻就可以融入到开发中来，而不需要费心去安装复杂的环境。</p><p>Vagrant 的跨平台的特性简直是太棒了，这都要利益于 VirtualBox 这样一款优秀的软件和 Vagrant 这些天才工程师们。</p><p>Vagrant 还支持使用<a href=\\"http://www.opscode.com/chef/\\">Chef</a>和<a href=\\"https://puppetlabs.com/\\">Puppet</a>来维护你的虚拟开发环境，不过因为我对这两个工具并不熟悉，本文中不作介绍，只简单
介绍如果在 Windows 下配置一个 Vagrant 环境。</p><h4>安装 Vagrant</h4><p>从 Vagrant 官网下载最新的 Vagrant 和对应的 VirtualBox 安装后，新建一个文件夹用来配置 Vagrant</p><p>因为使用vagrant init precise32 http://files.vagrantup.com/precise32.box命令下载 box 会比较慢，
所以最好是提前使用迅雷等工具下载好 box 放在一个文件中，然后初始化时使用本地路径，会快很多。</p><pre>vagrant&nbsp;init&nbsp;precise32&nbsp;..\\\\boxes\\\\precise32.box</pre><p>需要注意的是，这里使用本地路径时，需要使用 Windows 风格的路径，即用\\\\来作为路径分隔符。</p><p><strong>PS:</strong>可用的 Vagrant Boxes 见这里：<a href=\\"http://www.vagrantbox.es/\\">http://www.vagrantbox.es/</a></p><h4>端口转发</h4><p>Vagrant 中配置端口转发非常方便</p><pre>Vagrant.configure(&quot;2&quot;)&nbsp;do&nbsp;|config|
&nbsp;&nbsp;#&nbsp;other&nbsp;config&nbsp;here

&nbsp;&nbsp;config.vm.network&nbsp;:forwarded_port,&nbsp;guest:&nbsp;80,&nbsp;host:&nbsp;8080
end</pre><p>上面的配置会将 Vagrant 中的 80 端口和你本机的 8080 端口建立转发关系，这样你在本机访问 http://localhost:8080 
就相当于访问 Vagrant 中的 http://localhost:80 了。</p><p><strong>端口转发可以配置多组。</strong></p><h4>共享文件夹</h4><p>使用 Vagrant 有一个非常重要的一步就是共享文件夹（得益于强大的 VirtualBox）</p><p>在Vagrantfile中设置</p><pre>config.vm.synced_folder&nbsp;&quot;E:/Blog&quot;,&nbsp;&quot;/home/vagrant/Blog&quot;</pre><p>其中第一个参数E:/Blog为本机上需要共享的文件夹路径，第二个参数为 Vagrant 虚拟机中的映射路径，注意第二个参数需要
使用绝对路径，如/home/vagrant/Blog</p><h4>连接至 Vagrant</h4><p>配置好后，就可以启动虚拟机并连接到 Vagrant 了。</p><p>首先，执行vagrant up，等待片刻，vagrant 就启动好了。 ::</p><pre>e:\\\\Vagrant\\\\precise32&gt;vagrant&nbsp;reload
[default]&nbsp;Attempting&nbsp;graceful&nbsp;shutdown&nbsp;of&nbsp;VM...
[default]&nbsp;Setting&nbsp;the&nbsp;name&nbsp;of&nbsp;the&nbsp;VM...
[default]&nbsp;Clearing&nbsp;any&nbsp;previously&nbsp;set&nbsp;forwarded&nbsp;ports...
[default]&nbsp;Creating&nbsp;shared&nbsp;folders&nbsp;metadata...
[default]&nbsp;Clearing&nbsp;any&nbsp;previously&nbsp;set&nbsp;network&nbsp;interfaces...
[default]&nbsp;Preparing&nbsp;network&nbsp;interfaces&nbsp;based&nbsp;on&nbsp;configuration...
[default]&nbsp;Forwarding&nbsp;ports...
[default]&nbsp;--&nbsp;22&nbsp;=&gt;&nbsp;2222&nbsp;(adapter&nbsp;1)
[default]&nbsp;--&nbsp;5000&nbsp;=&gt;&nbsp;5000&nbsp;(adapter&nbsp;1)
[default]&nbsp;--&nbsp;3000&nbsp;=&gt;&nbsp;3000&nbsp;(adapter&nbsp;1)
[default]&nbsp;Booting&nbsp;VM...
[default]&nbsp;Waiting&nbsp;for&nbsp;VM&nbsp;to&nbsp;boot.&nbsp;This&nbsp;can&nbsp;take&nbsp;a&nbsp;few&nbsp;minutes.
[default]&nbsp;VM&nbsp;booted&nbsp;and&nbsp;ready&nbsp;for&nbsp;use!
[default]&nbsp;Configuring&nbsp;and&nbsp;enabling&nbsp;network&nbsp;interfaces...
[default]&nbsp;Mounting&nbsp;shared&nbsp;folders...
[default]&nbsp;--&nbsp;/vagrant
[default]&nbsp;--&nbsp;/home/vagrant/Blog
[default]&nbsp;--&nbsp;/home/vagrant/Notes
[default]&nbsp;--&nbsp;/home/vagrant/Projects</pre><p>如果你vagrant up后又修改了 Vagrantfile，要使之生效，需要执行vagrant reload</p><p>在 Windows 下，不能使用vagrant ssh来直接访问 vagrnat，不过该命令会告诉你如何通过 ssh 连接 vagrant ::</p><pre>e:\\\\Vagrant\\\\precise32&gt;vagrant&nbsp;ssh
`ssh`&nbsp;executable&nbsp;not&nbsp;found&nbsp;in&nbsp;any&nbsp;directories&nbsp;in&nbsp;the&nbsp;%PATH%&nbsp;variable.&nbsp;Is&nbsp;an
SSH&nbsp;client&nbsp;installed?&nbsp;Try&nbsp;installing&nbsp;Cygwin,&nbsp;MinGW&nbsp;or&nbsp;Git,&nbsp;all&nbsp;of&nbsp;which
contain&nbsp;an&nbsp;SSH&nbsp;client.&nbsp;Or&nbsp;use&nbsp;the&nbsp;PuTTY&nbsp;SSH&nbsp;client&nbsp;with&nbsp;the&nbsp;following
authentication&nbsp;information&nbsp;shown&nbsp;below:

Host:&nbsp;127.0.0.1
Port:&nbsp;2222
Username:&nbsp;vagrant
Private&nbsp;key:&nbsp;C:/Documents&nbsp;and&nbsp;Settings/greatghoul/.vagrant.d/insecure_private_key</pre><p>这样你就可以使用类似 putty 的 ssh 客户端来访问 vagrant 来进行开发了，这里极力推荐 Chrome 扩展<a href=\\"https://chrome.google.com/webstore/detail/pnhechapfaindjhompbnflcldabbghjo?utm_source=chrome-ntp-launcher\\">Secure Shell</a></p><p>

	

	</p><p>原文链接: <a href=\\"http://www.udpwork.com/redirect/11542\\" target=\\"_blank\\" title=\\"http://www.g2w.me/2013/07/vagrant-up-in-windows/\\">http://www.g2w.me/2013/07/vagrant-up-in-windows/</a></p><p><br/></p>',
      'keyword' => 'Windows,Vagrant',
      'sortid' => '5',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 15:48:38',
    ),
  ),
); 
?>