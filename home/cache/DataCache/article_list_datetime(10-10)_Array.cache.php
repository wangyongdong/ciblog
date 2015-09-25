<?php 
 $arr=array (
  'expiration' => 1443770374,
  'info' => 
  array (
    0 => 
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
    1 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:52:01',
    ),
    2 => 
    array (
      'id' => '73',
      'uid' => '1',
      'title' => 'jQuery中mouseleave和mouseout的区别',
      'content' => '<p>在写项目的时候碰到了一个问题，就是我在为公司网站新首页改版时，需要使用鼠标移入移出事件，但是发现效果很不好，总是达不到效果，上网上搜索了一下，发现了问题。<br/></p><p>很多人在使用jQuery实现鼠标悬停效果时，一般都会用到mouseover和mouseout这对事件。而在实现过程中，可能会出现一些不理想的状况。</p><p>先看下使用mouseout的效果：</p><p><span style=\\"text-decoration: line-through;\\">使用了mouseout事件↓</span></p><p>我们发现使用mouseout事件时，鼠标只要在下拉容器#list里一移动，就触发了hide()，其实是因为mouseout事件是会冒泡的，也就是事件可能被同时绑定到了该容器的子元素上，所以鼠标移出每个子元素时也都会触发我们的hide()。<br/><span id=\\"more-214\\"></span><br/>从jQuery 1.3开始新增了2个mouse事件，mouseenter和mouseleave。与mouseout事件不同，只有在鼠标指针离开被选元素时，才会触发 mouseleave 事件。<br/>我们来看一下mouseleave事件的效果：</p><p><span style=\\"text-decoration: line-through;\\">使用了mouseleave事件↓</span></p><p>mouseleave和mouseout事件各有用途，因为事件冒泡在某些时候是非常有用的。但是当我们不需要冒泡的时候，确实也挺烦人的。</p><p><br/></p>',
      'keyword' => 'jQuery,mouseleave,mouseout',
      'sortid' => '6',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:51:12',
    ),
    3 => 
    array (
      'id' => '72',
      'uid' => '1',
      'title' => 'php函数ob_start()、ob_end_clean()、ob_get_contents()',
      'content' => '<p>下面3个函数的用法</p><ul class=\\"simplelist\\"><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1605.html\\" rel=\\"rdfs-seeAlso\\">ob_get_contents()</a>&nbsp;- 返回输出缓冲区的内容</span></p></li><li><p>ob_flush() -&nbsp;冲刷出（送出）输出缓冲区中的内容</p></li><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1600.html\\" rel=\\"rdfs-seeAlso\\">ob_clean()</a>&nbsp;- 清空（擦掉）输出缓冲区</span></p></li><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1602.html\\" rel=\\"rdfs-seeAlso\\">ob_end_flush()</a>&nbsp;- 冲刷出（送出）输出缓冲区内容并关闭缓冲</span></p></li><li><p><span class=\\"function\\"><a class=\\"function\\" href=\\"http://www.phpstudy.net/php/1601.html\\" rel=\\"rdfs-seeAlso\\">ob_end_clean()</a>&nbsp;- 清空（擦除）缓冲区并关闭输出缓冲</span></p></li><li><p><span class=\\"function\\">flush() - 刷新输出缓冲　　　　</span></p></li></ul><p><strong><span style=\\"color: #ff0000;\\">通常是ob_flush();flush()同时一起使用</span></strong><br/>使用ob_start()把输出那同输出到缓冲区，而不是到浏览器。<br/>然后用ob_get_contents得到缓冲区的数据。</p><p>ob_start()在服务器打开一个缓冲区来保存所有的输出。所以在任何时候使用echo ，输出都将被加入缓冲区中，直到程序运行结束或者使用ob_flush()来结束。然后在服务器中缓冲区的内容才会发送到浏览器，由浏览器来解析显示。<br/><br/>函数ob_end_clean 会清除缓冲区的内容，并将缓冲区关闭，但不会输出内容。<br/>此时得用一个函数ob_get_contents()在ob_end_clean()前面来获得缓冲区的内容。<br/>这样的话， 能将在执行ob_end_clean()前把内容保存到一个变量中，然后在ob_end_clean()后面对这个变量做操作。</p><p><br/></p>',
      'keyword' => 'ob_start,ob_end_clean,ob_get_contents',
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:47:36',
    ),
    4 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:44:47',
    ),
    5 => 
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
      'sortid' => '3',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:43:09',
    ),
    6 => 
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
      'sortid' => '6',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:38:45',
    ),
    7 => 
    array (
      'id' => '68',
      'uid' => '1',
      'title' => 'js 处理 ie和firefox window.frames 兼容问题',
      'content' => '<p>在做项目的时候网页里嵌套iframe时想对iframe对象进行操作时ie和firefox是不同的。</p><p>&nbsp;</p><p>例如：</p><p>&lt;iframe id=&quot;xx1&quot;&nbsp; scrolling=&quot;auto&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; src=<a>http://</a>www.xxx.com&gt;&lt;/iframe&gt;</p><p>&nbsp;</p><p>js:</p><p>window.frames[&#39;xx1&#39;].document.location.replace(&#39;http://www.jjj.com&#39;);</p><p>&nbsp;</p><p>在ie下是没有问题的可是在firefox下就不行了，错误提示是找不到 window.frames[&#39;xx1&#39;]对象。</p><p>&nbsp;</p><p>这是怎么回事呢，刚开始我找了很长时间一直没有找到好的解决方法。后来经过我不歇的努力终于成功解决！</p><p>&nbsp;</p><p>原因是ie和firefox的内核是不一样的，ie是用过id来生成对象，可是firefox是通过name来生成对象。</p><p>所以在iframe加个name就行了。</p><p>&nbsp;</p><p>&lt;iframe id=&quot;xx1&quot;&nbsp; <span style=\\"color: #ff0000;\\">name=&quot;xx1&quot;</span> scrolling=&quot;auto&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; src=<a>http://</a>www.xxx.com&gt;&lt;/iframe&gt;</p><p>&nbsp;</p><p><br/></p>',
      'keyword' => 'js,ie,firefox,window.frames,兼容',
      'sortid' => '6',
      'img' => '',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'none',
      'status' => 'show',
      'datetime' => '2015-09-21 16:37:18',
    ),
    8 => 
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
      'topway' => 'sort',
      'status' => 'show',
      'datetime' => '2015-09-21 16:36:28',
    ),
    9 => 
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
      'sortid' => '3',
      'img' => '20120828_1395003_image001_751467_30008_0.jpg',
      'views' => '0',
      'comnum' => '0',
      'topway' => 'home',
      'status' => 'show',
      'datetime' => '2015-09-21 16:20:43',
    ),
  ),
); 
?>