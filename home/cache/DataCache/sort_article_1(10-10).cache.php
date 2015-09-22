<?php 
 $arr=array (
  'expiration' => 1442991732,
  'info' => 
  array (
    0 => 
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
    1 => 
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
    2 => 
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
    3 => 
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
    4 => 
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
    5 => 
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
    6 => 
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
    7 => 
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
    8 => 
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
    9 => 
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
  ),
); 
?>