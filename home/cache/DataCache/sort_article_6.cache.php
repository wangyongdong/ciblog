<?php 
 $arr=array (
  'expiration' => 1442990829,
  'info' => 
  array (
    0 => 
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
    1 => 
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
    2 => 
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
    3 => 
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
    4 => 
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
    5 => 
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
    6 => 
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
    7 => 
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
    8 => 
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
    9 => 
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
  ),
); 
?>