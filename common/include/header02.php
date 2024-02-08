<?php
	//Debugよう
	//HTTPSに最後する。んで、下の8888ポートの分岐も消す
$TJF_HTTP = "http://"; ?>
<?php 
	if($WEB_SERVER_NAME == 'localhost'){
		$WEB_SERVER_NAME = $WEB_SERVER_NAME.':8888';
	}
?>
<header id="headerWrap">
<div id="header">
<h1 class="lang_cn" lang="zh"><?php echo $h1; ?></h1>
<div id="headerIn">
<div id="headerLinks">
<p id="headerLogo"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/'; ?>"><img src="/common/images/header/logo01.gif" width="360" height="47" alt="パワーエレクトロニクスとオプトエレクトロニクスの京都電機器株式会社"></a></p>

<div id="headerMemberBox">
<p id="headerMemberLogin">
<?php if ($data['header_link']['is_login']): ?>
	<?php echo h($data['header_link']['name']); ?>&nbsp;様／<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/menu.php'; ?>">会員メニュー</a>／<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/logout.php'; ?>">ログアウト</a>
<?php else: ?>
	<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/'; ?>">ログイン／会員登録</a>
<?php endif; ?>
</p>
<ul><!--
--><li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/download/'; ?>">各種データダウンロード</a></li><!--
--><li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/site/'; ?>">サイトマップ</a></li><!--
--></ul>
<!-- /headerMemberBox --></div>
<!-- /headerIn --></div>
<div id="recruit">
	<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/careers/' ?>" target="_blank" target="_blank">採用情報</a>
</div>

<div id="headerSearch">
<p id="headerSearchTxt">サイト内検索</p>
<div id="headerSearchForm">
<form id="cse-search-box" action="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/search/'; ?>">
<input type="hidden" name="cx" value="002837320323205462703:yfzixrtfuwo">
<input type="hidden" name="ie" value="UTF-8">
<input type="text" name="q" size="31">
<input type="image" name="sa" src="/common/images/header/ico_search01.gif" alt="検索">
</form>
<!-- /headerSearchForm --></div>
<!-- /headerSearch --></div>

<?php if($lang){ ?>
<div id="language">
<ul class="clearfix">
<li class="left"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'.$path; ?>">JPN</a></li>
<li class="right"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/'.$path; ?>" class="current">CHN</a></li>
</ul>
</div>
<?php } ?>

<!-- /headerIn --></div>
<!-- /header --></div>

<div id="gNaviWrap">		
<nav id="gNavi">
<ul id="gNavi_in">
<li id="gNav01" class="lang_cn"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/'; ?>">产品信息</a></li>
<li id="gNav02"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">アプリケーション</a></li>
<li id="gNav03"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/faq/'; ?>">よくあるご質問</a></li>
<li id="gNav04"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/corporate/'; ?>">企業情報</a></li>
<li id="gNav05"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/'; ?>">お問い合わせ</a></li>
</ul>

<div id="megaMenu">

	<!-- 製品情報 -->
	<div id="gNav01_Drop" class="drop_menu">
		<div class="drop_in lang_cn" lang="zh">
			<div class="parent"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/'; ?>">产品信息</a></div>
			<div class="child">
				<dl>
					<dt>电力电子技术</dt>
					<dd><a class="has" rel="product_dc" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/dc/'; ?>">电源</a></dd>
					<dd><a class="has" rel="product_mdp" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/mdp/'; ?>">瞬时电压下降保护装置</a></dd>
				</dl>
				<dl class="mt40">
					<dt>光电技术</dt>
					<dd><a class="has" rel="product_led" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/'; ?>">图像处理用LED照明</a></dd>
					<dd><a class="has" rel="product_uv" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/uv/'; ?>">UV-LED照射装置</a></dd>
				</dl>
				<dl class="mt40">
					<dt>その他取り扱い商品</dt>
					<dd><a class="has" rel="product_fluorescent" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/fluorescent/'; ?>">图像处理用荧光灯照明</a></dd>
					<dd><a class="has" rel="product_xenon" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/xenon/'; ?>">氙气灯管频闪装置</a></dd>
				</dl>	


			</div>

			<!-- 製品情報 > パワーエレクトロニクス > 瞬時電圧低下保護装置 -->
			<div class="product_mdp last_cell">
				<div class="cell">
					<ul>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/mdp/kdp/'; ?>">KDP series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/mdp/kdp_g_b/'; ?>">KDP-G,B series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/mdp/kdp_d/'; ?>">KDP-D series</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/mdp/example/'; ?>">客户采购事例</a></li>
					</ul>
				</div>
			</div>

			<!-- 製品情報 > パワーエレクトロニクス > 直流電源装置 -->
			<div class="product_dc last_cell">
				<div class="cell">
					<ul>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/sat/'; ?>">SAT-56S/SAT-56D</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/kdc/'; ?>">KDC series</a></li>

					</ul>
				</div>
			</div>

			<!-- 製品情報 > オプトエレクトロニクス > 画像処理用LED照明 -->
			<div class="product_led last_cell">
				<div class="cell">
					<ul>
						<li><a class="new" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/kddb3/'; ?>">KDDB3 series</a></li>
						<li><a class="new" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/kdhm3/'; ?>">KDHM3 series</a></li>
						<li><a class="new" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/kdpb2/'; ?>">KDPB2 series</a></li>
						<li><a class="new" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/kdpl3/'; ?>">KDPL3 series</a></li>
						<li><a class="new" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/lfm-150/'; ?>">LFM-150</a></li>
						<li><a class="new" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/xenon_to_led/'; ?>">替换氙气灯的频闪照明</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/rgb/'; ?>">RGB照明</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdpb/'; ?>">KDPB series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdpl2_fan/'; ?>">KDPL2-FAN</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdfp/'; ?>">KDFP series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lfm-80w/'; ?>">LFM-80W</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdpl2/'; ?>">KDPL2 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddb2/'; ?>">KDDB2 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddb2_q/'; ?>">KDDB2-Q series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddl3/'; ?>">KDDL3 series</a></li>
						
					</ul>
				</div>

				<div class="cell">
					<ul>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddr_p/'; ?>">KDDR-P series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddr2/'; ?>">KDDR2/KDDR2-F series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddr2_la/'; ?>">KDDR2-LA/KDDR2-T series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdfv2/'; ?>">KDFV2 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kddd2/'; ?>">KDDD2 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdhm2/'; ?>">KDHM2 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdfl2/'; ?>">KDFL2 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/pl_plh2_plh3/'; ?>">PL/PLH2/PLH3 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/pls2_pls3_plsf/'; ?>">PLS2/PLS3/PLSF series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lfm-15w/'; ?>">LFM-15W series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/luv/'; ?>">LUV series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kduv-l/'; ?>">KDUV-L series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/ir/'; ?>">IR照明</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/uv/'; ?>">UV照明</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/r_box/'; ?>">电阻BOX</a></li>
					</ul>
				</div>

				<div class="cell lang_cn" lang="zh">
					<ul>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/dla/'; ?>">DLA series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/dcm/'; ?>">DCM DCOM</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lga_302/'; ?>">LGA-302</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lpa/'; ?>">LPA series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lek/'; ?>">LEK series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lda/'; ?>">LDA series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lfa/'; ?>">LFA series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lla/'; ?>">LLA series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/leb_lec/'; ?>">LEB・LEC series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lee/'; ?>">LEE series</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/cable/'; ?>">照明延长线</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/plate/'; ?>">扩散板</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/plate02/'; ?>">偏光板</a></li>
					</ul>
				</div>
			</div>
			<!-- UV-LED照射装置 -->
			<div class="product_uv last_cell">
				<div class="cell">
					<ul>
						<li><a href="#">none</a></li>
					</ul>
				</div>
			</div>
			<!-- 製品情報 > オプトエレクトロニクス > 画像処理用蛍光灯照明 -->
			<div class="product_fluorescent last_cell">
				<div class="cell">
					<ul>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/lst/'; ?>">LST series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/lsts/'; ?>">LSTS series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/ulst/'; ?>">ULST series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/hlst/'; ?>">HLST series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/fp/'; ?>">FP series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/lsj/'; ?>">LSJ series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/lsh/'; ?>">LSH series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/lsc_da1/'; ?>">LSC-DA1 series</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/cable/'; ?>">照明延长线</a></li>
					</ul>
				</div>
			</div>


			<!-- 製品情報 > オプトエレクトロニクス >キセノン管ストロボ装置 -->
			<div class="product_xenon last_cell">
				<div class="cell">
					<ul>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/kfs_10_15f1/'; ?>">KFS-10・15F1 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/kfs_30f1/'; ?>">KFS-30F1 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/kfs_60f1/'; ?>">KFS-60F1 series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/kfs_l/'; ?>">KFS-**L series</a></li>
						<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/kfs/'; ?>">KFS series</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/flashlamp/'; ?>">氙气闪光灯管</a></li>
						<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/cable/'; ?>">电缆</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- // 製品情報 -->

	<!-- アプリケーション -->
	<div id="gNav02_Drop" class="drop_menu">
		<div class="drop_in">
			<div class="parent">アプリケーション</div>
			<div class="child">
				<ul>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">瞬時電圧低下保護装置</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/led.php'; ?>">画像処理用LED照明</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- // アプリケーション -->

	<!-- よくあるご質問 -->
	<div id="gNav03_Drop" class="drop_menu">
		<div class="drop_in">
			<div class="parent">よくあるご質問</div>
			<div class="child">
				<ul>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/faq/'; ?>">瞬時電圧低下保護装置</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/faq/led.php'; ?>">画像処理用LED照明</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- // よくあるご質問 -->

	<!-- 企業情報 -->
	<div id="gNav04_Drop" class="drop_menu">
		<div class="drop_in">
			<div class="parent">企業情報</div>
			<div class="child">
				<ul>
					<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/corporate/'; ?>">代表致辞</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/about/'; ?>">会社概要</a></li>
					<li><a class="has" rel="equipment" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/business/'; ?>">業務案内</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/office/'; ?>">事業拠点</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/history/'; ?>">沿革/ 組織図</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/development/'; ?>">開発生産設備</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/quality/'; ?>">品質/ 環境方針</a></li>
					<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/group/'; ?>">関連会社</a></li>
				</ul>
			</div>
            
            <div class="equipment last_cell">
                <div class="cell">
                    <ul>
                        <li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/business/equipment/'; ?>">パワーエレクトロニクス 設備・サポート</a></li>
                    </ul>
                </div>
            </div>
		</div>
	</div>
	<!-- // 企業情報 -->

</div>


<!-- /gNavi --></nav>
<!-- /gNaviWrap --></div>
</header>