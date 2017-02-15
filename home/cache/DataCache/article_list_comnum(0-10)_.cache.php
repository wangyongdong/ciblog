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
    2 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '1',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:10:37',
    ),
    3 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:20:15',
    ),
    4 => 
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
    5 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:22:18',
    ),
    6 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:23:17',
    ),
    7 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:40:45',
    ),
    8 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:45:14',
    ),
    9 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-18 10:51:45',
    ),
  ),
); 
?>