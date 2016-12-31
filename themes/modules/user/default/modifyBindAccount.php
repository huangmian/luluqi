<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <div class='col-md-6'>
        <div class='panel panel-default'>
        	<?=$this->render('navRight')?>
            <div class='panel-body'>
                <ul>
                    <li class="auth-client text-center">
                    	<a href="/user/default/auth?authclient=qq">
                    		<span class="fa fa-qq fa-2x"></span><br />
                    		<span><?=$user->getIsBind('qq')?>QQ登录</span>
                    	</a>
                	</li>
                	<li class="auth-client text-center">
                    	<a href="/user/default/auth?authclient=weibo">
                    		<span class="fa fa-weibo fa-2x"></span><br />
                    		<span><?=$user->getIsBind('weibo')?>微博登录</span>
                    	</a>
                	</li>
                	<li class="auth-client text-center">
                    	<a href="/user/default/auth?authclient=github">
                    		<span class="fa fa-github fa-2x"></span><br />
                    		<span><?=$user->getIsBind('github')?>Github登录</span>
                    	</a>
                	</li>
                </ul>
            </div>
        </div>
    </div>
</div>       