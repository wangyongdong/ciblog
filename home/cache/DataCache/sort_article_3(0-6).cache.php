<?php 
 $arr=array (
  'expiration' => 1473390769,
  'info' => 
  array (
    0 => 
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
    1 => 
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
    2 => 
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
    3 => 
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
    4 => 
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
    5 => 
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
  ),
); 
?>