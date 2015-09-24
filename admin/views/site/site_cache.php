<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
		<h2 class="pull-left"><i class="icon-home"></i> 缓存控制</h2>
		<div class="bread-crumb pull-right">
			<a href="/admin"><i class="icon-home"></i> 首页</a>
			<span class="divider">/</span>
			<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="matter">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-head">
							<div class="pull-left">缓存控制</div>
							<div class="widget-icons pull-right">
								<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
								<a href="#" class="wclose"><i class="icon-remove"></i></a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="widget-content">
							<div class="padd statement">
								<div class="row">
									<div class="col-md-8">
										<div class="alert alert-warning">
											<div class="cache-list">
												<h3>
													全站缓存
													<?php 
													if($data['all_cache']=="y") {
													?>
													<button class="btn btn-info cache_up" id="all_cache">关闭</button>
													<?php 
													} else {
													?>
													<button class="btn btn-default cache_up" id="all_cache">开启</button>
													<?php 
													}
													?>
												</h3>
											</div>
											<div class="cache-list">
												<h3>
													网页缓存
													<?php 
													if($data['view_cache']=="y") {
													?>
													<button class="btn btn-info cache_up" id="view_cache">关闭</button>
													<?php 
													} else {
													?>
													<button class="btn btn-default cache_up" id="view_cache">开启</button>
													<?php 
													}
													?>
												</h3>
											</div>
											<div class="cache-list">
												<h3>
													数据缓存
													<?php 
													if($data['data_cache']=="y") {
													?>
													<button class="btn btn-info cache_up" id="data_cache">关闭</button>
													<?php 
													} else {
													?>
													<button class="btn btn-default cache_up" id="data_cache">开启</button>
													<?php 
													}
													?>
												</h3>
											</div>
										</div>
                      				</div>
                      			</div>
							</div>
							<div class="widget-foot">注：只有在开启全站缓存的时候，其他缓存开启才会生效。</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-head">
							<div class="pull-left">缓存更新</div>
							<div class="widget-icons pull-right">
								<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
								<a href="#" class="wclose"><i class="icon-remove"></i></a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="widget-content">
							<div class="padd statement">
								<div class="row">
									<div class="col-md-8">
										<div class="alert alert-info">
											<h3>全部缓存</h3>
											<p>缓存文件 共 (<?=$view_num+$data_num?>)个</p>
											<button type="button" class="btn btn-info" id="all" onclick="upCache(this.id,'all');">更新</button>
										</div>
                      				</div>
                      				<div class="col-md-6">
                      					<div class="alert alert-success cache_view">
                      						<h3>网页缓存</h3>
                      						<p>缓存文件 共 (<?=$view_num?>)个</p>
                      						<ul class="list-view">
                      							<li>
						                            <input type='checkbox' id="home" />
						                        	首页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="record" />
						                        	说说页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="article_list" />
						                        	文章列表页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="article_view" />
						                        	文章详细页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="cms_list" />
						                        	CMS列表页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="cms_view" />
						                        	CMS详细页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="archive" />
						                        	归档页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="contact" />
						                        	留言页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="event" />
						                        	历史页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="links" />
						                        	友情链接页
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="about" />
						                        	关于我页
				                        		</li>
                      						</ul>
                      						<button type="submit" class="btn btn-info" id="view" onclick="upCache(this.id,'view');">更新</button>
                      					</div>
                      				</div>
									<div class="col-md-6">
                      					<div class="alert alert-success cache_view">
                      						<h3>数据缓存</h3>
                      						<p>缓存文件 共 (<?=$data_num?>)个</p>
                      						<ul class="list-data">
                      							<li>
						                            <input type='checkbox' id="info" />
						                        	网站相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="record" />
						                        	说说相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="article" />
						                        	文章相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="CMS" />
						                        	CMS相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="sort" />
						                        	分类相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="comment" />
						                        	评论相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="archive" />
						                        	归档相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="event" />
						                        	事件相关
				                        		</li>
				                        		<li>
						                            <input type='checkbox' id="links" />
						                        	友链相关
				                        		</li>
                      						</ul>
                      						<button type="submit" class="btn btn-info" onclick="upCache('data');">更新</button>
                      					</div>
                      				</div>
                      			</div>
							</div>
							<div class="widget-foot"></div>
						</div>
					</div>
				</div>
				<hr />
			</div>
		</div>
	</div>
	<!-- Mainbar ends -->
	<div class="clearfix"></div>
</div>
<!-- Content ends -->