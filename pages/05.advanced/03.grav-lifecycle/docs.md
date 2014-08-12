---
title: Grav Lifecycle
taxonomy:
    category: docs
---

It is often useful to know how Grav processes in order to fully understand how best to extend Grav via plugins.  This is the Grav lifecycle:

<div id="lifecycle">
	<ol class="level-1">
		<h3>index.php</h3>
		<li>Autoload classes &amp; initialise Definitions</li>
		<li>Start output buffer</li>
		<li>Start  Debugger timer</li>
		<li>Enable Debugger</li>
		<li>Register:
			<ol class="flush">
				<li>Autoloader</li>
				<li>Grav</li>
				<li>Uri</li>
				<li>Config</li>
				<li>Cache</li>
				<li>Twig</li>
				<li>Pages</li>
				<li>Taxonomy</li>
			</ol>
		</li>
		<li>Call Grav->process()
			<ol class="level-2">
				<h3>Grav.php</h3>
				<li>Get <b>Uri</b> and <b>Config</b> objects</li>
				<li>Set up Debugger based on configuration</li>
				<li>Initialize <b>Cache</b> mechanism</li>
				<li>Initialize <b>Plugins</b>: <b>onAfterInitPlugins()</b></li>
				<li>Get current theme and initialize it</li>
				<li>Get <b>Twig</b> object and Initialize it
					<ol class="level-3">
						<h3>Twig.php</h3>
						<li>Set Twig paths: <b>onAfterTwigTemplatesPaths()</b></li>
						<li>Load Twig config options and loader chain: <b>onAfterTwigInit()</b></li>
						<li>Load Twig extensions: <b>onAfterTwigExtensions</b></li>
						<li>Set standard Twig variables (config, uri, site, taxonomy, etc)</li>
					</ol>
				</li>
				<li>Get all <b>Pages</b> and initialize
					<ol class="level-3">
						<h3>Pages.php</h3>
						<li>buildPages()
						<li>Check if cache is good</li>
						<li>If good load pages data from cache</li>
						<li>If not good, recurse the directory structure</li>
						<li>If a file, initialize it:
							<ol class="level-4">
								<h3>Page.php</h3>
								<li>init() to load the file details</li>
								<li>set filePath, modified, id</li>
								<li>initialize header()</li>
								<li>initialize slug()</li>
								<li>set visibile()</li>
								<li>set modularTwig()</li>
								<li><b>onAfterPageProcessed()</b></li>
							</ol>
						</li>
						<li>If a folder, recurse the children</li>
						<li><b>onAfterFolderProcessed()</b></li>
					</ol>
				</li>
				<li><b>onAfterGetPages()</b></li>
				<li>get <b>Taxonomy</b> object</li>
				<li>get current <b>Page</b>
					<ol class="level-3">
						<h3>Pages.php</h3>
						<li>displatch()</li>
					</ol>
				</li>
				<li><b>OnAfterGetPage()</b></li>
				<li>process site with Twig
					<ol class="level-3">
						<h3>Twig.php</h3>
						<li>processSite()</li>
						<li><b>onAfterTwigSiteVars()</b></li>
						<li>return the output</li>
					</ol>
				</li>
				<li><b>onAfterGetOutput()</b></li>
				<li>Set the header type</li>
				<li>echo output to buffer</li>
			</ol>
		</li>
		<li>Flush output Buffer</li>
	</ol>
</div>
