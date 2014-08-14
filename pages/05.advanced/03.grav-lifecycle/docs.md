---
title: Grav Lifecycle
taxonomy:
    category: docs
---

It is often useful to know how Grav processes in order to fully understand how best to extend Grav via plugins.  This is the Grav lifecycle:

<div id="lifecycle">
	<ol class="level-1">
		<h3>index.php</h3>
		<li>Autoload classes &amp; initialise Definitions <a href="https://github.com/getgrav/grav/blob/develop/index.php#L11"><i class="icon icon-right-open"></i></a></li>
		<li>Start output buffer <a href="https://github.com/getgrav/grav/blob/develop/index.php#L18"><i class="icon icon-right-open"></i></a></li>
		<li>Start  Debugger timer <a href="https://github.com/getgrav/grav/blob/develop/index.php#L22"><i class="icon icon-right-open"></i></a></li>
		<li>Enable Debugger <a href="https://github.com/getgrav/grav/blob/develop/index.php#L23"><i class="icon icon-right-open"></i></a></li>
		<li>Register:
			<ol class="flush">
				<li>Autoloader <a href="https://github.com/getgrav/grav/blob/develop/index.php#L30"><i class="icon icon-right-open"></i></a></li>
				<li>Grav <a href="https://github.com/getgrav/grav/blob/develop/index.php#L31"><i class="icon icon-right-open"></i></a></li>
				<li>Uri <a href="https://github.com/getgrav/grav/blob/develop/index.php#L32"><i class="icon icon-right-open"></i></a></li>
				<li>Config <a href="https://github.com/getgrav/grav/blob/develop/index.php#L33"><i class="icon icon-right-open"></i></a></li>
				<li>Cache <a href="https://github.com/getgrav/grav/blob/develop/index.php#L34"><i class="icon icon-right-open"></i></a></li>
				<li>Twig <a href="https://github.com/getgrav/grav/blob/develop/index.php#L35"><i class="icon icon-right-open"></i></a></li>
				<li>Pages <a href="https://github.com/getgrav/grav/blob/develop/index.php#L36"><i class="icon icon-right-open"></i></a></li>
				<li>Taxonomy <a href="https://github.com/getgrav/grav/blob/develop/index.php#L37"><i class="icon icon-right-open"></i></a></li>
			</ol>
		</li>
		<li>Call Grav->process() <a href="https://github.com/getgrav/grav/blob/develop/index.php#L41"><i class="icon icon-right-open"></i></a>
			<ol class="level-2">
				<h3>Grav.php</h3>
				<li>Get <b>Uri <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L77"><i class="icon icon-right-open"></i></a></b> and <b>Config <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L80"><i class="icon icon-right-open"></i></a></b> objects</li>
				<li>Set up Debugger based on configuration <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L82"><i class="icon icon-right-open"></i></a></li>
				<li>Initialize <b>Cache</b> mechanism <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L94"><i class="icon icon-right-open"></i></a></li>
				<li>Initialize <b>Plugins</b>: <b>onAfterInitPlugins()</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L98"><i class="icon icon-right-open"></i></a></li>
				<li>Get current theme and initialize it<a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L103"><i class="icon icon-right-open"></i></a></li>
				<li>Get <b>Twig</b> object and Initialize it<a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L107"><i class="icon icon-right-open"></i></a>
					<ol class="level-3">
						<h3>Twig.php</h3> 
						<li>Set Twig paths: <b>onAfterTwigTemplatesPaths() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L76"><i class="icon icon-right-open"></i></a></b></li>
						<li>Load Twig config options and loader chain: <b>onAfterTwigInit()</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L83"><i class="icon icon-right-open"></i></a></li>
						<li>Load Twig extensions: <b>onAfterTwigExtensions</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L99"><i class="icon icon-right-open"></i></a></li>
						<li>Set standard Twig variables (config, uri, site, taxonomy, etc) <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L108"><i class="icon icon-right-open"></i></a></li>
					</ol>
				</li>
				<li>Get all <b>Pages</b> and initialize <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L162"><i class="icon icon-right-open"></i></a>
					<ol class="level-3">
						<h3>Pages.php</h3> 
						<li>buildPages() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L66"><i class="icon icon-right-open"></i></a>
						<li>Check if cache is good <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L335"><i class="icon icon-right-open"></i></a></li>
						<li>If good load pages data from cache <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L337"><i class="icon icon-right-open"></i></a></li>
						<li>If not good, recurse the directory structure <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L359"><i class="icon icon-right-open"></i></a></li>
						<li>If a file, initialize it: <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L398"><i class="icon icon-right-open"></i></a>
							<ol class="level-4">
								<h3>Page.php</h3> 
								<li>init() to load the file details <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Page.php#L100"><i class="icon icon-right-open"></i></a></li>
								<li>set filePath, modified, id <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Page.php#L104"><i class="icon icon-right-open"></i></a></li>
								<li>initialize header() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Page.php#L141"><i class="icon icon-right-open"></i></a></li>
								<li>initialize slug() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Page.php#L701"><i class="icon icon-right-open"></i></a></li>
								<li>set visibile() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Page.php#L647"><i class="icon icon-right-open"></i></a></li>
								<li>set modularTwig() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Page.php#L1002"><i class="icon icon-right-open"></i></a></li>
							</ol>
						</li>
						<li><b>onAfterPageProcessed()</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L403"><i class="icon icon-right-open"></i></a></li>
						<li>If a folder, recurse the children <a hreaf="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L413"><i class="icon icon-right-open"></i></a></li>
						<li><b>onAfterFolderProcessed()</b> <a hreaf="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L430"><i class="icon icon-right-open"></i></a></li>
					</ol>
				</li>
				<li><b>onAfterGetPages() <a hreaf="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Grav.php#L111"><i class="icon icon-right-open"></i></a></b></li>
				<li>get <b>Taxonomy</b> object <a hreaf="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Grav.php#L116"><i class="icon icon-right-open"></i></a></li>
				<li>get current <b>Page</b> <a hreaf="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Grav.php#L119"><i class="icon icon-right-open"></i></a>
					<ol class="level-3">
						<h3>Pages.php</h3> 
						<li>displatch() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Pages.php#L217"><i class="icon icon-right-open"></i></a></li>
					</ol>
				</li>
				<li><b>OnAfterGetPage()</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L119"><i class="icon icon-right-open"></i></a></li>
				<li>process site with Twig <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L128"><i class="icon icon-right-open"></i></a>
					<ol class="level-3">
						<h3>Twig.php</h3> 
						<li>processSite() <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L218"><i class="icon icon-right-open"></i></a></li>
						<li><b>onAfterTwigSiteVars()</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L223"><i class="icon icon-right-open"></i></a></li>
						<li>return the output <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Twig.php#L238"><i class="icon icon-right-open"></i></a></li>
					</ol>
				</li>
				<li><b>onAfterGetOutput()</b> <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L128"><i class="icon icon-right-open"></i></a></li>
				<li>Set the header type <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L132"><i class="icon icon-right-open"></i></a></li>
				<li>echo output to buffer <a href="https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Grav.php#L134"><i class="icon icon-right-open"></i></a></li>
			</ol>
		</li>
		<li>Flush output Buffer <a href="https://github.com/getgrav/grav/blob/develop/index.php#L46"><i class="icon icon-right-open"></i></a></li>
	</ol>
</div>
