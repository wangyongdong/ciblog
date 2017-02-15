<?php 
 $arr=array (
  'expiration' => 1473390769,
  'info' => 
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
    'views' => '0',
    'comnum' => '0',
    'topway' => 'none',
    'status' => 'show',
    'datetime' => '2015-09-18 10:10:37',
  ),
); 
?>