## Table of contents

- [\Grav\Common\Taxonomy](#class-gravcommontaxonomy)
- [\Grav\Common\Themes](#class-gravcommonthemes)
- [\Grav\Common\Cache](#class-gravcommoncache)
- [\Grav\Common\Session](#class-gravcommonsession)
- [\Grav\Common\Plugin](#class-gravcommonplugin)
- [\Grav\Common\Theme](#class-gravcommontheme)
- [\Grav\Common\Plugins](#class-gravcommonplugins)
- [\Grav\Common\Debugger](#class-gravcommondebugger)
- [\Grav\Common\Composer](#class-gravcommoncomposer)
- [\Grav\Common\Uri](#class-gravcommonuri)
- [\Grav\Common\Yaml (abstract)](#class-gravcommonyaml-abstract)
- [\Grav\Common\Utils (abstract)](#class-gravcommonutils-abstract)
- [\Grav\Common\Grav](#class-gravcommongrav)
- [\Grav\Common\Browser](#class-gravcommonbrowser)
- [\Grav\Common\Security](#class-gravcommonsecurity)
- [\Grav\Common\Inflector](#class-gravcommoninflector)
- [\Grav\Common\Iterator](#class-gravcommoniterator)
- [\Grav\Common\Getters (abstract)](#class-gravcommongetters-abstract)
- [\Grav\Common\Assets](#class-gravcommonassets)
- [\Grav\Common\Backup\ZipBackup](#class-gravcommonbackupzipbackup)
- [\Grav\Common\Config\CompiledLanguages](#class-gravcommonconfigcompiledlanguages)
- [\Grav\Common\Config\CompiledConfig](#class-gravcommonconfigcompiledconfig)
- [\Grav\Common\Config\Languages](#class-gravcommonconfiglanguages)
- [\Grav\Common\Config\CompiledBase (abstract)](#class-gravcommonconfigcompiledbase-abstract)
- [\Grav\Common\Config\Config](#class-gravcommonconfigconfig)
- [\Grav\Common\Config\Setup](#class-gravcommonconfigsetup)
- [\Grav\Common\Config\ConfigFileFinder](#class-gravcommonconfigconfigfilefinder)
- [\Grav\Common\Config\CompiledBlueprints](#class-gravcommonconfigcompiledblueprints)
- [\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)
- [\Grav\Common\Data\Blueprints](#class-gravcommondatablueprints)
- [\Grav\Common\Data\DataInterface (interface)](#interface-gravcommondatadatainterface)
- [\Grav\Common\Data\ValidationException](#class-gravcommondatavalidationexception)
- [\Grav\Common\Data\Data](#class-gravcommondatadata)
- [\Grav\Common\Data\Validation](#class-gravcommondatavalidation)
- [\Grav\Common\Data\BlueprintSchema](#class-gravcommondatablueprintschema)
- [\Grav\Common\Errors\BareHandler](#class-gravcommonerrorsbarehandler)
- [\Grav\Common\Errors\Errors](#class-gravcommonerrorserrors)
- [\Grav\Common\Errors\SystemFacade](#class-gravcommonerrorssystemfacade)
- [\Grav\Common\Errors\SimplePageHandler](#class-gravcommonerrorssimplepagehandler)
- [\Grav\Common\File\CompiledJsonFile](#class-gravcommonfilecompiledjsonfile)
- [\Grav\Common\File\CompiledYamlFile](#class-gravcommonfilecompiledyamlfile)
- [\Grav\Common\File\CompiledMarkdownFile](#class-gravcommonfilecompiledmarkdownfile)
- [\Grav\Common\Filesystem\RecursiveFolderFilterIterator](#class-gravcommonfilesystemrecursivefolderfilteriterator)
- [\Grav\Common\Filesystem\Folder (abstract)](#class-gravcommonfilesystemfolder-abstract)
- [\Grav\Common\GPM\Response](#class-gravcommongpmresponse)
- [\Grav\Common\GPM\AbstractCollection (abstract)](#class-gravcommongpmabstractcollection-abstract)
- [\Grav\Common\GPM\Upgrader](#class-gravcommongpmupgrader)
- [\Grav\Common\GPM\Licenses](#class-gravcommongpmlicenses)
- [\Grav\Common\GPM\Installer](#class-gravcommongpminstaller)
- [\Grav\Common\GPM\GPM](#class-gravcommongpmgpm)
- [\Grav\Common\GPM\Common\AbstractPackageCollection (abstract)](#class-gravcommongpmcommonabstractpackagecollection-abstract)
- [\Grav\Common\GPM\Common\Package](#class-gravcommongpmcommonpackage)
- [\Grav\Common\GPM\Common\CachedCollection](#class-gravcommongpmcommoncachedcollection)
- [\Grav\Common\GPM\Local\AbstractPackageCollection (abstract)](#class-gravcommongpmlocalabstractpackagecollection-abstract)
- [\Grav\Common\GPM\Local\Package](#class-gravcommongpmlocalpackage)
- [\Grav\Common\GPM\Local\Themes](#class-gravcommongpmlocalthemes)
- [\Grav\Common\GPM\Local\Plugins](#class-gravcommongpmlocalplugins)
- [\Grav\Common\GPM\Local\Packages](#class-gravcommongpmlocalpackages)
- [\Grav\Common\GPM\Remote\AbstractPackageCollection](#class-gravcommongpmremoteabstractpackagecollection)
- [\Grav\Common\GPM\Remote\Package](#class-gravcommongpmremotepackage)
- [\Grav\Common\GPM\Remote\Themes](#class-gravcommongpmremotethemes)
- [\Grav\Common\GPM\Remote\Plugins](#class-gravcommongpmremoteplugins)
- [\Grav\Common\GPM\Remote\Packages](#class-gravcommongpmremotepackages)
- [\Grav\Common\GPM\Remote\GravCore](#class-gravcommongpmremotegravcore)
- [\Grav\Common\Helpers\Excerpts](#class-gravcommonhelpersexcerpts)
- [\Grav\Common\Helpers\Base32](#class-gravcommonhelpersbase32)
- [\Grav\Common\Helpers\Truncator](#class-gravcommonhelperstruncator)
- [\Grav\Common\Helpers\Exif](#class-gravcommonhelpersexif)
- [\Grav\Common\Language\Language](#class-gravcommonlanguagelanguage)
- [\Grav\Common\Language\LanguageCodes](#class-gravcommonlanguagelanguagecodes)
- [\Grav\Common\Markdown\Parsedown](#class-gravcommonmarkdownparsedown)
- [\Grav\Common\Markdown\ParsedownExtra](#class-gravcommonmarkdownparsedownextra)
- [\Grav\Common\Media\Interfaces\MediaObjectInterface (interface)](#interface-gravcommonmediainterfacesmediaobjectinterface)
- [\Grav\Common\Media\Interfaces\MediaInterface (interface)](#interface-gravcommonmediainterfacesmediainterface)
- [\Grav\Common\Media\Interfaces\MediaCollectionInterface (interface)](#interface-gravcommonmediainterfacesmediacollectioninterface)
- [\Grav\Common\Page\Header](#class-gravcommonpageheader)
- [\Grav\Common\Page\Collection](#class-gravcommonpagecollection)
- [\Grav\Common\Page\Types](#class-gravcommonpagetypes)
- [\Grav\Common\Page\Page](#class-gravcommonpagepage)
- [\Grav\Common\Page\Media](#class-gravcommonpagemedia)
- [\Grav\Common\Page\Pages](#class-gravcommonpagepages)
- [\Grav\Common\Page\Interfaces\PageInterface (interface)](#interface-gravcommonpageinterfacespageinterface)
- [\Grav\Common\Page\Medium\VideoMedium](#class-gravcommonpagemediumvideomedium)
- [\Grav\Common\Page\Medium\MediumFactory](#class-gravcommonpagemediummediumfactory)
- [\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)
- [\Grav\Common\Page\Medium\ImageFile](#class-gravcommonpagemediumimagefile)
- [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)
- [\Grav\Common\Page\Medium\AudioMedium](#class-gravcommonpagemediumaudiomedium)
- [\Grav\Common\Page\Medium\ImageMedium](#class-gravcommonpagemediumimagemedium)
- [\Grav\Common\Page\Medium\RenderableInterface (interface)](#interface-gravcommonpagemediumrenderableinterface)
- [\Grav\Common\Page\Medium\GlobalMedia](#class-gravcommonpagemediumglobalmedia)
- [\Grav\Common\Page\Medium\StaticImageMedium](#class-gravcommonpagemediumstaticimagemedium)
- [\Grav\Common\Page\Medium\AbstractMedia (abstract)](#class-gravcommonpagemediumabstractmedia-abstract)
- [\Grav\Common\Page\Medium\ThumbnailImageMedium](#class-gravcommonpagemediumthumbnailimagemedium)
- [\Grav\Common\Processors\ConfigurationProcessor](#class-gravcommonprocessorsconfigurationprocessor)
- [\Grav\Common\Processors\ErrorsProcessor](#class-gravcommonprocessorserrorsprocessor)
- [\Grav\Common\Processors\ProcessorBase (abstract)](#class-gravcommonprocessorsprocessorbase-abstract)
- [\Grav\Common\Processors\SiteSetupProcessor](#class-gravcommonprocessorssitesetupprocessor)
- [\Grav\Common\Processors\TasksProcessor](#class-gravcommonprocessorstasksprocessor)
- [\Grav\Common\Processors\PluginsProcessor](#class-gravcommonprocessorspluginsprocessor)
- [\Grav\Common\Processors\TwigProcessor](#class-gravcommonprocessorstwigprocessor)
- [\Grav\Common\Processors\DebuggerAssetsProcessor](#class-gravcommonprocessorsdebuggerassetsprocessor)
- [\Grav\Common\Processors\InitializeProcessor](#class-gravcommonprocessorsinitializeprocessor)
- [\Grav\Common\Processors\DebuggerInitProcessor](#class-gravcommonprocessorsdebuggerinitprocessor)
- [\Grav\Common\Processors\AssetsProcessor](#class-gravcommonprocessorsassetsprocessor)
- [\Grav\Common\Processors\ThemesProcessor](#class-gravcommonprocessorsthemesprocessor)
- [\Grav\Common\Processors\RenderProcessor](#class-gravcommonprocessorsrenderprocessor)
- [\Grav\Common\Processors\ProcessorInterface (interface)](#interface-gravcommonprocessorsprocessorinterface)
- [\Grav\Common\Processors\PagesProcessor](#class-gravcommonprocessorspagesprocessor)
- [\Grav\Common\Service\SessionServiceProvider](#class-gravcommonservicesessionserviceprovider)
- [\Grav\Common\Service\ErrorServiceProvider](#class-gravcommonserviceerrorserviceprovider)
- [\Grav\Common\Service\PageServiceProvider](#class-gravcommonservicepageserviceprovider)
- [\Grav\Common\Service\TaskServiceProvider](#class-gravcommonservicetaskserviceprovider)
- [\Grav\Common\Service\AssetsServiceProvider](#class-gravcommonserviceassetsserviceprovider)
- [\Grav\Common\Service\ConfigServiceProvider](#class-gravcommonserviceconfigserviceprovider)
- [\Grav\Common\Service\StreamsServiceProvider](#class-gravcommonservicestreamsserviceprovider)
- [\Grav\Common\Service\OutputServiceProvider](#class-gravcommonserviceoutputserviceprovider)
- [\Grav\Common\Service\LoggerServiceProvider](#class-gravcommonserviceloggerserviceprovider)
- [\Grav\Common\Twig\TwigExtension](#class-gravcommontwigtwigextension)
- [\Grav\Common\Twig\Twig](#class-gravcommontwigtwig)
- [\Grav\Common\Twig\TwigEnvironment](#class-gravcommontwigtwigenvironment)
- [\Grav\Common\Twig\Node\TwigNodeMarkdown](#class-gravcommontwignodetwignodemarkdown)
- [\Grav\Common\Twig\Node\TwigNodeTryCatch](#class-gravcommontwignodetwignodetrycatch)
- [\Grav\Common\Twig\Node\TwigNodeScript](#class-gravcommontwignodetwignodescript)
- [\Grav\Common\Twig\Node\TwigNodeStyle](#class-gravcommontwignodetwignodestyle)
- [\Grav\Common\Twig\Node\TwigNodeSwitch](#class-gravcommontwignodetwignodeswitch)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserTryCatch](#class-gravcommontwigtokenparsertwigtokenparsertrycatch)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserSwitch](#class-gravcommontwigtokenparsertwigtokenparserswitch)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserScript](#class-gravcommontwigtokenparsertwigtokenparserscript)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserMarkdown](#class-gravcommontwigtokenparsertwigtokenparsermarkdown)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserStyle](#class-gravcommontwigtokenparsertwigtokenparserstyle)
- [\Grav\Common\User\Group](#class-gravcommonusergroup)
- [\Grav\Common\User\Authentication (abstract)](#class-gravcommonuserauthentication-abstract)
- [\Grav\Common\User\User](#class-gravcommonuseruser)
- [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)
- [\Grav\Console\Cli\SecurityCommand](#class-gravconsoleclisecuritycommand)
- [\Grav\Console\Cli\InstallCommand](#class-gravconsolecliinstallcommand)
- [\Grav\Console\Cli\ComposerCommand](#class-gravconsoleclicomposercommand)
- [\Grav\Console\Cli\CleanCommand](#class-gravconsoleclicleancommand)
- [\Grav\Console\Cli\SandboxCommand](#class-gravconsoleclisandboxcommand)
- [\Grav\Console\Cli\ClearCacheCommand](#class-gravconsolecliclearcachecommand)
- [\Grav\Console\Cli\BackupCommand](#class-gravconsoleclibackupcommand)
- [\Grav\Console\Cli\NewProjectCommand](#class-gravconsoleclinewprojectcommand)
- [\Grav\Console\Gpm\InfoCommand](#class-gravconsolegpminfocommand)
- [\Grav\Console\Gpm\InstallCommand](#class-gravconsolegpminstallcommand)
- [\Grav\Console\Gpm\UninstallCommand](#class-gravconsolegpmuninstallcommand)
- [\Grav\Console\Gpm\VersionCommand](#class-gravconsolegpmversioncommand)
- [\Grav\Console\Gpm\UpdateCommand](#class-gravconsolegpmupdatecommand)
- [\Grav\Console\Gpm\DirectInstallCommand](#class-gravconsolegpmdirectinstallcommand)
- [\Grav\Console\Gpm\IndexCommand](#class-gravconsolegpmindexcommand)
- [\Grav\Console\Gpm\SelfupgradeCommand](#class-gravconsolegpmselfupgradecommand)
- [\Grav\Console\TerminalObjects\Table](#class-gravconsoleterminalobjectstable)
- [\Grav\Framework\Cache\AbstractCache (abstract)](#class-gravframeworkcacheabstractcache-abstract)
- [\Grav\Framework\Cache\CacheInterface (interface)](#interface-gravframeworkcachecacheinterface)
- [\Grav\Framework\Cache\Adapter\FileCache](#class-gravframeworkcacheadapterfilecache)
- [\Grav\Framework\Cache\Adapter\ChainCache](#class-gravframeworkcacheadapterchaincache)
- [\Grav\Framework\Cache\Adapter\MemoryCache](#class-gravframeworkcacheadaptermemorycache)
- [\Grav\Framework\Cache\Adapter\DoctrineCache](#class-gravframeworkcacheadapterdoctrinecache)
- [\Grav\Framework\Cache\Adapter\SessionCache](#class-gravframeworkcacheadaptersessioncache)
- [\Grav\Framework\Cache\Exception\InvalidArgumentException](#class-gravframeworkcacheexceptioninvalidargumentexception)
- [\Grav\Framework\Cache\Exception\CacheException](#class-gravframeworkcacheexceptioncacheexception)
- [\Grav\Framework\Collection\FileCollectionInterface (interface)](#interface-gravframeworkcollectionfilecollectioninterface)
- [\Grav\Framework\Collection\AbstractFileCollection](#class-gravframeworkcollectionabstractfilecollection)
- [\Grav\Framework\Collection\ArrayCollection](#class-gravframeworkcollectionarraycollection)
- [\Grav\Framework\Collection\FileCollection](#class-gravframeworkcollectionfilecollection)
- [\Grav\Framework\Collection\CollectionInterface (interface)](#interface-gravframeworkcollectioncollectioninterface)
- [\Grav\Framework\Collection\AbstractLazyCollection (abstract)](#class-gravframeworkcollectionabstractlazycollection-abstract)
- [\Grav\Framework\ContentBlock\HtmlBlock](#class-gravframeworkcontentblockhtmlblock)
- [\Grav\Framework\ContentBlock\HtmlBlockInterface (interface)](#interface-gravframeworkcontentblockhtmlblockinterface)
- [\Grav\Framework\ContentBlock\ContentBlockInterface (interface)](#interface-gravframeworkcontentblockcontentblockinterface)
- [\Grav\Framework\ContentBlock\ContentBlock](#class-gravframeworkcontentblockcontentblock)
- [\Grav\Framework\File\Formatter\JsonFormatter](#class-gravframeworkfileformatterjsonformatter)
- [\Grav\Framework\File\Formatter\FormatterInterface (interface)](#interface-gravframeworkfileformatterformatterinterface)
- [\Grav\Framework\File\Formatter\SerializeFormatter](#class-gravframeworkfileformatterserializeformatter)
- [\Grav\Framework\File\Formatter\IniFormatter](#class-gravframeworkfileformatteriniformatter)
- [\Grav\Framework\File\Formatter\YamlFormatter](#class-gravframeworkfileformatteryamlformatter)
- [\Grav\Framework\File\Formatter\MarkdownFormatter](#class-gravframeworkfileformattermarkdownformatter)
- [\Grav\Framework\Object\PropertyObject](#class-gravframeworkobjectpropertyobject)
- [\Grav\Framework\Object\ObjectCollection](#class-gravframeworkobjectobjectcollection)
- [\Grav\Framework\Object\ArrayObject](#class-gravframeworkobjectarrayobject)
- [\Grav\Framework\Object\LazyObject](#class-gravframeworkobjectlazyobject)
- [\Grav\Framework\Object\Collection\ObjectExpressionVisitor](#class-gravframeworkobjectcollectionobjectexpressionvisitor)
- [\Grav\Framework\Object\Interfaces\NestedObjectInterface (interface)](#interface-gravframeworkobjectinterfacesnestedobjectinterface)
- [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface (interface)](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)
- [\Grav\Framework\Object\Interfaces\ObjectInterface (interface)](#interface-gravframeworkobjectinterfacesobjectinterface)
- [\Grav\Framework\Psr7\AbstractUri (abstract)](#class-gravframeworkpsr7abstracturi-abstract)
- [\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)
- [\Grav\Framework\Route\RouteFactory](#class-gravframeworkrouteroutefactory)
- [\Grav\Framework\Session\Session](#class-gravframeworksessionsession)
- [\Grav\Framework\Session\SessionInterface (interface)](#interface-gravframeworksessionsessioninterface)
- [\Grav\Framework\Uri\UriFactory](#class-gravframeworkuriurifactory)
- [\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)
- [\Grav\Framework\Uri\UriPartsFilter](#class-gravframeworkuriuripartsfilter)

<hr /><a id="class-gravcommontaxonomy"></a>
### Class: \Grav\Common\Taxonomy

> The Taxonomy object is a singleton that holds a reference to a 'taxonomy map'. This map is constructed as a multidimensional array. uses the taxonomy defined in the site.yaml file and is built when the page objects are recursed. Basically every time a page is found that has taxonomy references, an entry to the page is stored in the taxonomy map.  The map has the following format: [taxonomy_type][taxonomy_value][page_path] For example: [category][blog][path/to/item1] [tag][grav][path/to/item1] [tag][grav][path/to/item2] [tag][dog][path/to/item3]

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Constructor that resets the map</em> |
| public | <strong>addTaxonomy(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>array</em> <strong>$page_taxonomy=null</strong>)</strong> : <em>void</em><br /><em>Takes an individual page and processes the taxonomies configured in its header. It then adds those taxonomies to the map</em> |
| public | <strong>findTaxonomy(</strong><em>array</em> <strong>$taxonomies</strong>, <em>string</em> <strong>$operator=`'and'`</strong>)</strong> : <em>Collection Collection object set to contain matches found in the taxonomy map</em><br /><em>Returns a new Page object with the sub-pages containing all the values set for a particular taxonomy.</em> |
| public | <strong>getTaxonomyItemKeys(</strong><em>string</em> <strong>$taxonomy</strong>)</strong> : <em>array keys of this taxonomy</em><br /><em>Gets item keys per taxonomy</em> |
| public | <strong>taxonomy(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array the taxonomy map</em><br /><em>Gets and Sets the taxonomy map</em> |

<hr /><a id="class-gravcommonthemes"></a>
### Class: \Grav\Common\Themes

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Themes constructor.</em> |
| public | <strong>all()</strong> : <em>array</em><br /><em>Return list of all theme data with their blueprints.</em> |
| public | <strong>configure()</strong> : <em>void</em><br /><em>Configure and prepare streams for current template.</em> |
| public | <strong>current()</strong> : <em>string</em><br /><em>Return name of the current theme.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em><br /><em>Get theme configuration or throw exception if it cannot be found.</em> |
| public | <strong>init()</strong> : <em>void</em> |
| public | <strong>initTheme()</strong> : <em>void</em> |
| public | <strong>load()</strong> : <em>[\Grav\Common\Theme](#class-gravcommontheme)</em><br /><em>Load current theme.</em> |
| protected | <strong>autoloadTheme(</strong><em>string</em> <strong>$class</strong>)</strong> : <em>mixed false FALSE if unable to load $class; Class name if $class is successfully loaded</em><br /><em>Autoload theme classes for inheritance</em> |
| protected | <strong>loadConfiguration(</strong><em>string</em> <strong>$name</strong>, <em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config</strong>)</strong> : <em>mixed</em><br /><em>Load theme configuration.</em> |
| protected | <strong>loadLanguages(</strong><em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config</strong>)</strong> : <em>mixed</em><br /><em>Load theme languages.</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommoncache"></a>
### Class: \Grav\Common\Cache

> The GravCache object is used throughout Grav to store and retrieve cached data. It uses DoctrineCache library and supports a variety of caching mechanisms. Those include: APCu APC XCache RedisCache MemCache MemCacheD FileSystem

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public static | <strong>clearCache(</strong><em>string</em> <strong>$remove=`'standard'`</strong>)</strong> : <em>array</em><br /><em>Helper method to clear all Grav caches</em> |
| public | <strong>contains(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>bool true if the cached items exists</em><br /><em>Returns a boolean state of whether or not the item exists in the cache based on id key</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>bool true if the item was deleted successfully</em><br /><em>Deletes an item in the cache based on the id</em> |
| public | <strong>fetch(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>object/bool returns the cached entry, can be any type, or false if doesn't exist</em><br /><em>Gets a cached entry if it exists based on an id. If it does not exist, it returns false</em> |
| public | <strong>getCacheDriver()</strong> : <em>DoctrineCache\CacheProvider The cache driver to use</em><br /><em>Automatically picks the cache mechanism to use.  If you pick one manually it will use that If there is no config option for $driver in the config, or it's set to 'auto', it will pick the best option based on which cache extensions are installed.</em> |
| public | <strong>getCacheStatus()</strong> : <em>string</em><br /><em>Get cache state</em> |
| public | <strong>getDriverName()</strong> : <em>mixed</em><br /><em>Returns the current driver name</em> |
| public | <strong>getDriverSetting()</strong> : <em>mixed</em><br /><em>Returns the current driver setting</em> |
| public | <strong>getEnabled()</strong> : <em>bool</em><br /><em>Returns the current enabled state</em> |
| public | <strong>getKey()</strong> : <em>mixed</em><br /><em>Getter method to get the cache key</em> |
| public | <strong>getLifetime()</strong> : <em>mixed</em><br /><em>Retrieve the cache lifetime (in seconds)</em> |
| public | <strong>init(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Initialization that sets a base key and the driver based on configuration settings</em> |
| public | <strong>isVolatileDriver(</strong><em>mixed</em> <strong>$setting</strong>)</strong> : <em>bool</em><br /><em>is this driver a volatile driver in that it resides in PHP process memory</em> |
| public | <strong>save(</strong><em>string</em> <strong>$id</strong>, <em>array/object</em> <strong>$data</strong>, <em>int</em> <strong>$lifetime=null</strong>)</strong> : <em>void</em><br /><em>Stores a new cached entry.</em> |
| public | <strong>setEnabled(</strong><em>mixed</em> <strong>$enabled</strong>)</strong> : <em>void</em><br /><em>Public accessor to set the enabled state of the cache</em> |
| public | <strong>setKey(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Setter method to set key (Advanced)</em> |
| public | <strong>setLifetime(</strong><em>int</em> <strong>$future</strong>)</strong> : <em>void</em><br /><em>Set the cache lifetime programmatically</em> |

*This class extends [\Grav\Common\Getters](#class-gravcommongetters-abstract)*

*This class implements \Countable, \ArrayAccess*

<hr /><a id="class-gravcommonsession"></a>
### Class: \Grav\Common\Session

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__get(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Returns session variable.</em> |
| public | <strong>__isset(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>bool</em><br /><em>Checks if session variable is defined.</em> |
| public | <strong>__set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Sets session variable.</em> |
| public | <strong>__unset(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Removes session variable.</em> |
| public | <strike><strong>all()</strong> : <em>array Attributes</em></strike><br /><em>DEPRECATED - 1.5 Use getAll() method instead</em> |
| public | <strong>clear()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Free all session variables.</em> |
| public | <strong>close()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Force the session to be saved and closed</em> |
| public | <strong>getAll()</strong> : <em>array</em><br /><em>Returns all session variables.</em> |
| public | <strong>getFlashCookieObject(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>mixed/null</em><br /><em>Return object and remove it from the cookie.</em> |
| public | <strong>getFlashObject(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Return object and remove it from session.</em> |
| public | <strong>getId()</strong> : <em>string/null Session ID</em><br /><em>Get session ID</em> |
| public static | <strong>getInstance()</strong> : <em>[\Grav\Framework\Session\Session](#class-gravframeworksessionsession)</em><br /><em>Get current session instance.</em> |
| public | <strong>getIterator()</strong> : <em>\ArrayIterator Return an ArrayIterator of $_SESSION</em><br /><em>Retrieve an external iterator</em> |
| public | <strong>getName()</strong> : <em>string/null</em><br /><em>Get session name</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initialize session. Code in this function has been moved into SessionServiceProvider class.</em> |
| public static | <strike><strong>instance()</strong> : <em>[\Grav\Framework\Session\Session](#class-gravframeworksessionsession)</em></strike><br /><em>DEPRECATED - 1.5 Use getInstance() method instead</em> |
| public | <strong>invalidate()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Invalidates the current session.</em> |
| public | <strong>isStarted()</strong> : <em>Boolean</em><br /><em>Checks if the session was started.</em> |
| public | <strong>setAutoStart(</strong><em>bool</em> <strong>$auto</strong>)</strong> : <em>\Grav\Common\$this</em> |
| public | <strong>setFlashCookieObject(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$object</strong>, <em>int</em> <strong>$time=60</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Store something in cookie temporarily.</em> |
| public | <strong>setFlashObject(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$object</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Store something in session temporarily.</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session ID</em> |
| public | <strong>setName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session name</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Sets session.* ini variables.</em> |
| public | <strong>start(</strong><em>bool</em> <strong>$readonly=false</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Starts the session storage</em> |
| public | <strike><strong>started()</strong> : <em>Boolean</em></strike><br /><em>DEPRECATED - 1.5 Use isStarted() method instead</em> |

*This class extends [\Grav\Framework\Session\Session](#class-gravframeworksessionsession)*

*This class implements \IteratorAggregate, \Traversable, [\Grav\Framework\Session\SessionInterface](#interface-gravframeworksessionsessioninterface)*

<hr /><a id="class-gravcommonplugin"></a>
### Class: \Grav\Common\Plugin

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$name</strong>, <em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>, <em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config=null</strong>)</strong> : <em>void</em><br /><em>Constructor.</em> |
| public | <strong>config()</strong> : <em>array</em><br /><em>Get configuration of the plugin.</em> |
| public | <strong>getBlueprint()</strong> : <em>mixed</em><br /><em>Simpler getter for the plugin blueprint</em> |
| public static | <strong>getSubscribedEvents()</strong> : <em>array</em><br /><em>By default assign all methods as listeners using the default priority.</em> |
| public | <strong>isAdmin()</strong> : <em>bool</em><br /><em>Determine if this is running under the admin</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public static | <strong>saveConfig(</strong><em>string</em> <strong>$plugin_name</strong>)</strong> : <em>true</em><br /><em>Persists to disk the plugin parameters currently stored in the Grav Config object</em> |
| public | <strong>setConfig(</strong><em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config</strong>)</strong> : <em>\Grav\Common\$this</em> |
| protected | <strong>disable(</strong><em>array</em> <strong>$events</strong>)</strong> : <em>void</em> |
| protected | <strong>enable(</strong><em>array</em> <strong>$events</strong>)</strong> : <em>void</em> |
| protected | <strong>isPluginActiveAdmin(</strong><em>mixed</em> <strong>$plugin_route</strong>)</strong> : <em>bool</em><br /><em>Determine if this route is in Admin and active for the plugin</em> |
| protected | <strong>loadBlueprint()</strong> : <em>mixed</em><br /><em>Load blueprints.</em> |
| protected | <strong>mergeConfig(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>bool/mixed</em> <strong>$deep=false</strong>, <em>array</em> <strong>$params=array()</strong>, <em>string</em> <strong>$type=`'plugins'`</strong>)</strong> : <em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em><br /><em>Merge global and page configurations. plugin settings. merge with the plugin settings.</em> |
| protected | <strong>parseLinks(</strong><em>string</em> <strong>$content</strong>, <em>callable</em> <strong>$function</strong>, <em>string</em> <strong>$internal_regex=`'(.*)'`</strong>)</strong> : <em>string</em><br /><em>This function will search a string for markdown links in a specific format.  The link value can be optionally compared against via the $internal_regex and operated on by the callback $function provided. format: [plugin:myplugin_name](function_data)</em> |

*This class implements \RocketTheme\Toolbox\Event\EventSubscriberInterface, \Symfony\Component\EventDispatcher\EventSubscriberInterface, \ArrayAccess*

<hr /><a id="class-gravcommontheme"></a>
### Class: \Grav\Common\Theme

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>, <em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config</strong>, <em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Constructor.</em> |
| public | <strong>config()</strong> : <em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em><br /><em>Get configuration of the plugin.</em> |
| public | <strong>getBlueprint()</strong> : <em>mixed</em><br /><em>Simpler getter for the theme blueprint</em> |
| public static | <strong>saveConfig(</strong><em>string</em> <strong>$theme_name</strong>)</strong> : <em>true</em><br /><em>Persists to disk the theme parameters currently stored in the Grav Config object</em> |
| protected | <strong>loadBlueprint()</strong> : <em>mixed</em><br /><em>Load blueprints.</em> |
| protected | <strong>mergeConfig(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>string</em> <strong>$deep=`'merge'`</strong>, <em>array</em> <strong>$params=array()</strong>, <em>string</em> <strong>$type=`'themes'`</strong>)</strong> : <em>void</em><br /><em>Override the mergeConfig method to work for themes</em> |

*This class extends [\Grav\Common\Plugin](#class-gravcommonplugin)*

*This class implements \ArrayAccess, \Symfony\Component\EventDispatcher\EventSubscriberInterface, \RocketTheme\Toolbox\Event\EventSubscriberInterface*

<hr /><a id="class-gravcommonplugins"></a>
### Class: \Grav\Common\Plugins

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>add(</strong><em>mixed</em> <strong>$plugin</strong>)</strong> : <em>void</em><br /><em>Add a plugin</em> |
| public static | <strong>all()</strong> : <em>array</em><br /><em>Return list of all plugin data with their blueprints.</em> |
| public static | <strong>get(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Common\Data/null</em><br /><em>Get a plugin by name</em> |
| public | <strong>init()</strong> : <em>array/Plugin[] array of Plugin objects</em><br /><em>Registers all plugins.</em> |
| public | <strong>setup()</strong> : <em>\Grav\Common\$this</em> |
| protected | <strong>loadPlugin(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>mixed</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommondebugger"></a>
### Class: \Grav\Common\Debugger

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Debugger constructor.</em> |
| public | <strong>addAssets()</strong> : <em>\Grav\Common\$this</em><br /><em>Add the debugger assets to the Grav Assets</em> |
| public | <strong>addCollector(</strong><em>mixed</em> <strong>$collector</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Adds a data collector</em> |
| public | <strong>addException(</strong><em>[\Exception](http://php.net/manual/en/class.exception.php)</em> <strong>$e</strong>)</strong> : <em>[\Grav\Common\Debugger](#class-gravcommondebugger)</em><br /><em>Dump exception into the Messages tab of the Debug Bar</em> |
| public | <strong>addMessage(</strong><em>mixed</em> <strong>$message</strong>, <em>string</em> <strong>$label=`'info'`</strong>, <em>bool</em> <strong>$isString=true</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Dump variables into the Messages tab of the Debug Bar</em> |
| public | <strong>deprecatedErrorHandler(</strong><em>int</em> <strong>$errno</strong>, <em>string</em> <strong>$errstr</strong>, <em>string</em> <strong>$errfile</strong>, <em>int</em> <strong>$errline</strong>)</strong> : <em>bool</em> |
| public | <strong>enabled(</strong><em>bool</em> <strong>$state=null</strong>)</strong> : <em>null</em><br /><em>Set/get the enabled state of the debugger</em> |
| public | <strong>getCaller(</strong><em>mixed</em> <strong>$limit=2</strong>)</strong> : <em>mixed</em> |
| public | <strong>getCollector(</strong><em>mixed</em> <strong>$collector</strong>)</strong> : <em>\DebugBar\DataCollector\DataCollectorInterface</em><br /><em>Returns a data collector</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Returns collected debugger data.</em> |
| public | <strong>init()</strong> : <em>\Grav\Common\$this</em><br /><em>Initialize the debugger</em> |
| public | <strong>render()</strong> : <em>\Grav\Common\$this</em><br /><em>Displays the debug bar</em> |
| public | <strong>sendDataInHeaders()</strong> : <em>\Grav\Common\$this</em><br /><em>Sends the data through the HTTP headers</em> |
| public | <strong>setErrorHandler()</strong> : <em>void</em> |
| public | <strong>startTimer(</strong><em>mixed</em> <strong>$name</strong>, <em>string/null</em> <strong>$description=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Start a timer with an associated name and description</em> |
| public | <strong>stopTimer(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Stop the named timer</em> |
| protected | <strong>addDeprecations()</strong> : <em>void</em> |
| protected | <strong>getDepracatedMessage(</strong><em>mixed</em> <strong>$deprecated</strong>)</strong> : <em>mixed</em> |
| protected | <strong>getFunction(</strong><em>mixed</em> <strong>$trace</strong>)</strong> : <em>mixed</em> |

<hr /><a id="class-gravcommoncomposer"></a>
### Class: \Grav\Common\Composer

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getComposerExecutor()</strong> : <em>string</em><br /><em>Return the composer executable file path</em> |
| public static | <strong>getComposerLocation()</strong> : <em>string</em><br /><em>Returns the location of composer.</em> |

<hr /><a id="class-gravcommonuri"></a>
### Class: \Grav\Common\Uri

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string/array</em> <strong>$env=null</strong>)</strong> : <em>void</em><br /><em>Uri constructor.</em> |
| public | <strong>__toString()</strong> : <em>void</em> |
| public static | <strong>addNonce(</strong><em>string</em> <strong>$url</strong>, <em>string</em> <strong>$action</strong>, <em>string</em> <strong>$nonceParamName=`'nonce'`</strong>)</strong> : <em>string the url with the nonce</em><br /><em>Adds the nonce to a URL for a specific action</em> |
| public | <strong>base()</strong> : <em>String The base of the URI</em><br /><em>Return the base of the URI</em> |
| public | <strong>baseIncludingLanguage()</strong> : <em>String The base of the URI</em><br /><em>Return the base relative URL including the language prefix or the base relative url if multi-language is not enabled</em> |
| public | <strong>basename()</strong> : <em>String The basename of the URI</em><br /><em>Return the basename of the URI</em> |
| public static | <strong>buildParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>string</em> |
| public static | <strong>buildUrl(</strong><em>array</em> <strong>$parsed_url</strong>)</strong> : <em>string</em><br /><em>The opposite of built-in PHP method parse_url()</em> |
| public static | <strong>cleanPath(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>mixed/string</em><br /><em>Removes extra double slashes and fixes back-slashes</em> |
| public static | <strong>convertUrl(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>string/array</em> <strong>$url</strong>, <em>string</em> <strong>$type=`'link'`</strong>, <em>bool</em> <strong>$absolute=false</strong>, <em>bool</em> <strong>$route_only=false</strong>)</strong> : <em>string the more friendly formatted url</em><br /><em>Converts links from absolute '/' or relative (../..) to a Grav friendly format</em> |
| public static | <strong>convertUrlOld(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>string</em> <strong>$markdown_url</strong>, <em>string</em> <strong>$type=`'link'`</strong>, <em>null</em> <strong>$relative=null</strong>)</strong> : <em>string the more friendly formatted url</em><br /><em>Converts links from absolute '/' or relative (../..) to a Grav friendly format</em> |
| public | <strong>currentPage()</strong> : <em>int</em><br /><em>Return current page number.</em> |
| public | <strong>environment()</strong> : <em>String</em><br /><em>Gets the environment name</em> |
| public | <strong>extension(</strong><em>string/null</em> <strong>$default=null</strong>)</strong> : <em>string The extension of the URI</em><br /><em>Return the Extension of the URI</em> |
| public static | <strong>extractParams(</strong><em>mixed</em> <strong>$uri</strong>, <em>mixed</em> <strong>$delimiter</strong>)</strong> : <em>void</em> |
| public static | <strong>filterPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string The RFC 3986 percent-encoded uri path.</em><br /><em>Filter Uri path. This method percent-encodes all reserved characters in the provided path string. This method will NOT double-encode characters that are already percent-encoded.</em> |
| public static | <strong>filterQuery(</strong><em>string</em> <strong>$query</strong>)</strong> : <em>string The percent-encoded query string.</em><br /><em>Filters the query string or fragment of a URI.</em> |
| public static | <strong>filterUserInfo(</strong><em>string</em> <strong>$info</strong>)</strong> : <em>string The percent-encoded user or password string.</em><br /><em>Filters the user info string.</em> |
| public | <strong>fragment(</strong><em>string</em> <strong>$fragment=null</strong>)</strong> : <em>string/null</em><br /><em>Gets the Fragment portion of a URI (eg #target)</em> |
| public static | <strong>getCurrentRoute()</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em><br /><em>Returns current route.</em> |
| public static | <strong>getCurrentUri()</strong> : <em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)</em><br /><em>Returns current Uri.</em> |
| public | <strong>host()</strong> : <em>string/null The host of the URI</em><br /><em>Return the host of the URI</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the URI object based on the url set on the object</em> |
| public | <strong>initializeWithUrl(</strong><em>string</em> <strong>$url=`''`</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Initialize the URI class with a url passed via parameter. Used for testing purposes.</em> |
| public | <strong>initializeWithUrlAndRootPath(</strong><em>string</em> <strong>$url</strong>, <em>string</em> <strong>$root_path</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Initialize the URI class by providing url and root_path arguments</em> |
| public static | <strong>ip()</strong> : <em>string ip address</em><br /><em>Return the IP address of the current user</em> |
| public static | <strong>isExternal(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>boolean is eternal state</em><br /><em>Is this an external URL? if it starts with `http` then yes, else false</em> |
| public static | <strong>isValidUrl(</strong><em>mixed</em> <strong>$url</strong>)</strong> : <em>bool</em><br /><em>Is the passed in URL a valid URL?</em> |
| public | <strong>method()</strong> : <em>void</em> |
| public | <strong>param(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>bool/string</em><br /><em>Get URI parameter.</em> |
| public | <strong>params(</strong><em>string</em> <strong>$id=null</strong>, <em>bool/boolean</em> <strong>$array=false</strong>)</strong> : <em>null/string/array</em><br /><em>Return all or a single query parameter as a URI compatible string.</em> |
| public static | <strong>paramsRegex()</strong> : <em>string</em><br /><em>Calculate the parameter regex based on the param_sep setting</em> |
| public static | <strong>parseUrl(</strong><em>mixed</em> <strong>$url</strong>)</strong> : <em>void</em> |
| public | <strong>password()</strong> : <em>string/null</em><br /><em>Return password</em> |
| public | <strong>path()</strong> : <em>String The path of the URI</em><br /><em>Return the Path</em> |
| public | <strong>paths(</strong><em>string</em> <strong>$id=null</strong>)</strong> : <em>string/string[]</em><br /><em>Return URI path.</em> |
| public | <strong>port(</strong><em>bool</em> <strong>$raw=false</strong>)</strong> : <em>int/null</em><br /><em>Return the port number if it can be figured out</em> |
| public | <strong>post(</strong><em>string</em> <strong>$element=null</strong>, <em>string</em> <strong>$filter_type=null</strong>)</strong> : <em>array/mixed/null</em><br /><em>Get's post from either $_POST or JSON response object By default returns all data, or can return a single item</em> |
| public | <strong>query(</strong><em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$raw=false</strong>)</strong> : <em>string/array Returns an array if $id = null and $raw = true</em><br /><em>Return full query string or a single query attribute.</em> |
| public | <strong>referrer(</strong><em>string</em> <strong>$default=null</strong>, <em>string</em> <strong>$attributes=null</strong>)</strong> : <em>string</em><br /><em>Return relative path to the referrer defaulting to current or given page.</em> |
| public | <strong>rootUrl(</strong><em>bool</em> <strong>$include_host=false</strong>)</strong> : <em>mixed</em><br /><em>Return root URL to the site.</em> |
| public | <strong>route(</strong><em>bool</em> <strong>$absolute=false</strong>, <em>bool</em> <strong>$domain=false</strong>)</strong> : <em>string</em><br /><em>Return route to the current URI. By default route doesn't include base path.</em> |
| public | <strong>scheme(</strong><em>bool</em> <strong>$raw=false</strong>)</strong> : <em>string The scheme of the URI</em><br /><em>Return the scheme of the URI</em> |
| public | <strong>toArray()</strong> : <em>void</em> |
| public | <strong>uri(</strong><em>bool</em> <strong>$include_root=true</strong>)</strong> : <em>mixed</em><br /><em>Return the full uri</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$include_host=false</strong>)</strong> : <em>string</em><br /><em>Return URL.</em> |
| public | <strong>user()</strong> : <em>string/null</em><br /><em>Return user</em> |
| public | <strong>validateHostname(</strong><em>string</em> <strong>$hostname</strong>)</strong> : <em>boolean</em><br /><em>Validate a hostname</em> |
| protected | <strong>createFromEnvironment(</strong><em>array</em> <strong>$env</strong>)</strong> : <em>mixed</em> |
| protected | <strong>createFromString(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>mixed</em> |
| protected | <strong>hasStandardPort()</strong> : <em>bool</em><br /><em>Does this Uri use a standard port?</em> |
| protected | <strong>reset()</strong> : <em>void</em> |

<hr /><a id="class-gravcommonyaml-abstract"></a>
### Class: \Grav\Common\Yaml (abstract)

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>dump(</strong><em>mixed</em> <strong>$data</strong>, <em>mixed</em> <strong>$inline=null</strong>, <em>mixed</em> <strong>$indent=null</strong>)</strong> : <em>void</em> |
| public static | <strong>parse(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommonutils-abstract"></a>
### Class: \Grav\Common\Utils (abstract)

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>arrayFilterRecursive(</strong><em>array</em> <strong>$source</strong>, <em>callable</em> <strong>$fn</strong>)</strong> : <em>array</em><br /><em>Recursively filter an array, filtering values by processing them through the $fn function argument</em> |
| public static | <strong>arrayFlatten(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>array</em><br /><em>Flatten an array</em> |
| public static | <strong>arrayMergeRecursiveUnique(</strong><em>mixed</em> <strong>$array1</strong>, <em>mixed</em> <strong>$array2</strong>)</strong> : <em>mixed</em><br /><em>Recursive Merge with uniqueness</em> |
| public static | <strong>checkFilename(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>bool</em><br /><em>Returns true if filename is considered safe.</em> |
| public static | <strong>contains(</strong><em>string</em> <strong>$haystack</strong>, <em>string/string[]</em> <strong>$needle</strong>)</strong> : <em>bool</em><br /><em>Check if the $haystack string contains the substring $needle</em> |
| public static | <strong>date2timestamp(</strong><em>string</em> <strong>$date</strong>, <em>string</em> <strong>$format=null</strong>)</strong> : <em>int the timestamp</em><br /><em>Get the timestamp of a date strtotime argument</em> |
| public static | <strong>dateFormats()</strong> : <em>array</em><br /><em>Return the Grav date formats allowed</em> |
| public static | <strong>download(</strong><em>string</em> <strong>$file</strong>, <em>bool</em> <strong>$force_download=true</strong>, <em>int</em> <strong>$sec</strong>, <em>int</em> <strong>$bytes=1024</strong>)</strong> : <em>void</em><br /><em>Provides the ability to download a file to the browser</em> |
| public static | <strong>endsWith(</strong><em>string</em> <strong>$haystack</strong>, <em>string/string[]</em> <strong>$needle</strong>)</strong> : <em>bool</em><br /><em>Check if the $haystack string ends with the substring $needle</em> |
| public static | <strong>generateRandomString(</strong><em>int</em> <strong>$length=5</strong>)</strong> : <em>string</em><br /><em>Generate a random string of a given length</em> |
| public static | <strong>getDotNotation(</strong><em>mixed</em> <strong>$array</strong>, <em>mixed</em> <strong>$key</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Get a portion of an array (passed by reference) with dot-notation key</em> |
| public static | <strong>getExtensionByMime(</strong><em>string</em> <strong>$mime</strong>, <em>string</em> <strong>$default=`'html'`</strong>)</strong> : <em>string</em><br /><em>Return the mimetype based on filename extension</em> |
| public static | <strong>getMimeByExtension(</strong><em>string</em> <strong>$extension</strong>, <em>string</em> <strong>$default=`'application/octet-stream'`</strong>)</strong> : <em>string</em><br /><em>Return the mimetype based on filename extension</em> |
| public static | <strong>getMimeByFilename(</strong><em>string</em> <strong>$filename</strong>, <em>string</em> <strong>$default=`'application/octet-stream'`</strong>)</strong> : <em>string</em><br /><em>Return the mimetype based on filename</em> |
| public static | <strong>getMimeByLocalFile(</strong><em>string</em> <strong>$filename</strong>, <em>string</em> <strong>$default=`'application/octet-stream'`</strong>)</strong> : <em>string/bool</em><br /><em>Return the mimetype based on existing local file</em> |
| public static | <strong>getNonce(</strong><em>string</em> <strong>$action</strong>, <em>bool</em> <strong>$previousTick=false</strong>)</strong> : <em>string the nonce</em><br /><em>Creates a hashed nonce tied to the passed action. Tied to the current user and time. The nonce for a given action is the same for 12 hours.</em> |
| public static | <strong>getPagePathFromToken(</strong><em>mixed</em> <strong>$path</strong>, <em>\Grav\Common\Page/null</em> <strong>$page=null</strong>)</strong> : <em>string</em><br /><em>Get's path based on a token</em> |
| public static | <strong>getUploadLimit()</strong> : <em>mixed</em> |
| public static | <strong>isAdminPlugin()</strong> : <em>bool</em><br /><em>Simple helper method to get whether or not the admin plugin is active</em> |
| public static | <strong>isApache()</strong> : <em>bool</em><br /><em>Utility to determine if the server running PHP is Apache</em> |
| public static | <strong>isFunctionDisabled(</strong><em>string</em> <strong>$function</strong>)</strong> : <em>bool</em><br /><em>Check whether a function is disabled in the PHP settings</em> |
| public static | <strong>isPositive(</strong><em>string</em> <strong>$value</strong>)</strong> : <em>boolean</em><br /><em>Checks if a value is positive</em> |
| public static | <strong>isWindows()</strong> : <em>bool</em><br /><em>Utility method to determine if the current OS is Windows</em> |
| public static | <strong>mergeObjects(</strong><em>object</em> <strong>$obj1</strong>, <em>object</em> <strong>$obj2</strong>)</strong> : <em>object</em><br /><em>Merge two objects into one.</em> |
| public static | <strong>multibyteParseUrl(</strong><em>mixed</em> <strong>$url</strong>)</strong> : <em>mixed</em><br /><em>Multibyte-safe Parse URL function</em> |
| public static | <strong>normalizePath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Normalize path by processing relative `.` and `..` syntax and merging path</em> |
| public static | <strong>parseSize(</strong><em>mixed</em> <strong>$size</strong>)</strong> : <em>int</em><br /><em>Parse a readable file size and return a value in bytes</em> |
| public static | <strong>pathPrefixedByLangCode(</strong><em>string</em> <strong>$string</strong>)</strong> : <em>bool</em><br /><em>Checks if the passed path contains the language code prefix</em> |
| public static | <strong>replaceFirstOccurrence(</strong><em>mixed</em> <strong>$search</strong>, <em>mixed</em> <strong>$replace</strong>, <em>mixed</em> <strong>$subject</strong>)</strong> : <em>mixed</em><br /><em>Utility method to replace only the first occurrence in a string</em> |
| public static | <strong>replaceLastOccurrence(</strong><em>mixed</em> <strong>$search</strong>, <em>mixed</em> <strong>$replace</strong>, <em>mixed</em> <strong>$subject</strong>)</strong> : <em>mixed</em><br /><em>Utility method to replace only the last occurrence in a string</em> |
| public static | <strike><strong>resolve(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$path</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - Use getDotNotation() method instead</em> |
| public static | <strong>safeTruncate(</strong><em>string</em> <strong>$string</strong>, <em>int</em> <strong>$limit=150</strong>)</strong> : <em>string</em><br /><em>Truncate text by number of characters in a "word-safe" manor.</em> |
| public static | <strong>safeTruncateHtml(</strong><em>string</em> <strong>$text</strong>, <em>int</em> <strong>$length=25</strong>, <em>string</em> <strong>$ellipsis=`'...'`</strong>)</strong> : <em>string</em><br /><em>Truncate HTML by number of characters in a "word-safe" manor.</em> |
| public static | <strong>setDotNotation(</strong><em>mixed</em> <strong>$array</strong>, <em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>bool</em> <strong>$merge=false</strong>)</strong> : <em>mixed</em><br /><em>Set portion of array (passed by reference) for a dot-notation key and set the value</em> |
| public static | <strong>sortArrayByArray(</strong><em>array</em> <strong>$array</strong>, <em>array</em> <strong>$orderArray</strong>)</strong> : <em>array</em><br /><em>Sort a multidimensional array  by another array of ordered keys</em> |
| public static | <strong>sortArrayByKey(</strong><em>mixed</em> <strong>$array</strong>, <em>mixed</em> <strong>$array_key</strong>, <em>int</em> <strong>$direction=3</strong>, <em>int</em> <strong>$sort_flags</strong>)</strong> : <em>array</em><br /><em>Sort an array by a key value in the array</em> |
| public static | <strong>startsWith(</strong><em>string</em> <strong>$haystack</strong>, <em>string/string[]</em> <strong>$needle</strong>)</strong> : <em>bool</em><br /><em>Check if the $haystack string starts with the substring $needle</em> |
| public static | <strong>substrToString(</strong><em>mixed</em> <strong>$haystack</strong>, <em>mixed</em> <strong>$needle</strong>)</strong> : <em>string</em><br /><em>Returns the substring of a string up to a specified needle.  if not found, return the whole haystack</em> |
| public static | <strong>timezones()</strong> : <em>array</em><br /><em>Get the formatted timezones list</em> |
| public static | <strong>truncate(</strong><em>string</em> <strong>$string</strong>, <em>int</em> <strong>$limit=150</strong>, <em>bool</em> <strong>$up_to_break=false</strong>, <em>string</em> <strong>$break=`' '`</strong>, <em>string</em> <strong>$pad=`'&hellip;'`</strong>)</strong> : <em>string</em><br /><em>Truncate text by number of characters but can cut off words.</em> |
| public static | <strong>truncateHtml(</strong><em>string</em> <strong>$text</strong>, <em>int</em> <strong>$length=100</strong>, <em>string</em> <strong>$ellipsis=`'...'`</strong>)</strong> : <em>string</em><br /><em>Truncate HTML by number of characters. not "word-safe"!</em> |
| public static | <strong>url(</strong><em>mixed</em> <strong>$input</strong>, <em>bool</em> <strong>$domain=false</strong>)</strong> : <em>bool/null/string</em><br /><em>Simple helper method to make getting a Grav URL easier</em> |
| public static | <strong>verifyNonce(</strong><em>string/string[]</em> <strong>$nonce</strong>, <em>string</em> <strong>$action</strong>)</strong> : <em>boolean verified or not</em><br /><em>Verify the passed nonce for the give action</em> |

<hr /><a id="class-gravcommongrav"></a>
### Class: \Grav\Common\Grav

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em><br /><em>Magic Catch All Function Used to call closures like measureTime on the instance. Source: http://stackoverflow.com/questions/419804/closures-as-class-members</em> |
| public | <strong>fallbackUrl(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em><br /><em>This attempts to find media, other files, and download them</em> |
| public | <strong>fireEvent(</strong><em>string</em> <strong>$eventName</strong>, <em>\RocketTheme\Toolbox\Event\Event</em> <strong>$event=null</strong>)</strong> : <em>\RocketTheme\Toolbox\Event\Event</em><br /><em>Fires an event with optional parameters.</em> |
| public | <strong>header()</strong> : <em>void</em><br /><em>Set response header.</em> |
| public static | <strong>instance(</strong><em>array</em> <strong>$values=array()</strong>)</strong> : <em>[\Grav\Common\Grav](#class-gravcommongrav)</em><br /><em>Return the Grav instance. Create it if it's not already instanced</em> |
| public | <strong>process()</strong> : <em>void</em><br /><em>Process a request</em> |
| public | <strong>redirect(</strong><em>string</em> <strong>$route</strong>, <em>int</em> <strong>$code=null</strong>)</strong> : <em>void</em><br /><em>Redirect browser to another location.</em> |
| public | <strong>redirectLangSafe(</strong><em>string</em> <strong>$route</strong>, <em>int</em> <strong>$code=null</strong>)</strong> : <em>void</em><br /><em>Redirect browser to another location taking language into account (preferred)</em> |
| public static | <strong>resetInstance()</strong> : <em>void</em><br /><em>Reset the Grav instance.</em> |
| public | <strong>setLocale()</strong> : <em>void</em><br /><em>Set the system locale based on the language and configuration</em> |
| public | <strong>shutdown()</strong> : <em>void</em><br /><em>Set the final content length for the page and flush the buffer</em> |
| protected static | <strong>load(</strong><em>array</em> <strong>$values</strong>)</strong> : <em>\Grav\Common\static</em><br /><em>Initialize and return a Grav instance</em> |
| protected | <strong>registerService(</strong><em>string</em> <strong>$serviceKey</strong>, <em>string</em> <strong>$serviceClass</strong>)</strong> : <em>void</em><br /><em>Register a service with the container.</em> |
| protected | <strong>registerServiceProvider(</strong><em>string</em> <strong>$serviceClass</strong>)</strong> : <em>void</em><br /><em>Register a service provider with the container.</em> |
| protected | <strong>registerServices()</strong> : <em>void</em><br /><em>Register all services Services are defined in the diMap. They can either only the class of a Service Provider or a pair of serviceKey => serviceClass that gets directly mapped into the container.</em> |

*This class extends \RocketTheme\Toolbox\DI\Container*

*This class implements \ArrayAccess*

<hr /><a id="class-gravcommonbrowser"></a>
### Class: \Grav\Common\Browser

> Internally uses the PhpUserAgent package https://github.com/donatj/PhpUserAgent

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Browser constructor.</em> |
| public | <strong>getBrowser()</strong> : <em>string the lowercase browser name</em><br /><em>Get the current browser identifier Currently detected browsers: Android Browser BlackBerry Browser Camino Kindle / Silk Firefox / Iceweasel Safari Internet Explorer IEMobile Chrome Opera Midori Vivaldi TizenBrowser Lynx Wget Curl</em> |
| public | <strong>getLongVersion()</strong> : <em>string the browser full version identifier</em><br /><em>Get the current full version identifier</em> |
| public | <strong>getPlatform()</strong> : <em>string the lowercase platform name</em><br /><em>Get the current platform identifier Currently detected platforms: Desktop -> Windows -> Linux -> Macintosh -> Chrome OS Mobile -> Android -> iPhone -> iPad / iPod Touch -> Windows Phone OS -> Kindle -> Kindle Fire -> BlackBerry -> Playbook -> Tizen Console -> Nintendo 3DS -> New Nintendo 3DS -> Nintendo Wii -> Nintendo WiiU -> PlayStation 3 -> PlayStation 4 -> PlayStation Vita -> Xbox 360 -> Xbox One</em> |
| public | <strong>getVersion()</strong> : <em>string the browser major version identifier</em><br /><em>Get the current major version identifier</em> |
| public | <strong>isHuman()</strong> : <em>bool</em><br /><em>Determine if the request comes from a human, or from a bot/crawler</em> |

<hr /><a id="class-gravcommonsecurity"></a>
### Class: \Grav\Common\Security

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>detectXss(</strong><em>string</em> <strong>$string</strong>)</strong> : <em>boolean/string Type of XSS vector if the given `$string` may contain XSS, false otherwise. Copies the code from: https://github.com/symphonycms/xssfilter/blob/master/extension.driver.php#L138</em><br /><em>Determine if string potentially has a XSS attack. This simple function does not catch all XSS and it is likely to return false positives because of it tags all potentially dangerous HTML tags and attributes without looking into their content.</em> |
| public static | <strong>detectXssFromArray(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$prefix=`''`</strong>)</strong> : <em>array Returns flatten list of potentially dangerous input values, such as 'data.content'.</em> |
| public static | <strong>detectXssFromPages(</strong><em>mixed</em> <strong>$pages</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommoninflector"></a>
### Class: \Grav\Common\Inflector

> This file was originally part of the Akelos Framework

| Visibility | Function |
|:-----------|:---------|
| public | <strong>camelize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string UpperCamelCasedWord</em><br /><em>Returns given word as CamelCased Converts a word like "send_email" to "SendEmail". It will remove non alphanumeric character from the word, so "who's online" will be converted to "WhoSOnline"</em> |
| public | <strong>classify(</strong><em>string</em> <strong>$table_name</strong>)</strong> : <em>string SingularClassName</em><br /><em>Converts a table name to its class name according to rails naming conventions. Converts "people" to "Person"</em> |
| public | <strong>humanize(</strong><em>string</em> <strong>$word</strong>, <em>string</em> <strong>$uppercase=`''`</strong>)</strong> : <em>string Human-readable word</em><br /><em>Returns a human-readable string from $word Returns a human-readable string from $word, by replacing underscores with a space, and by upper-casing the initial character by default. If you need to uppercase all the words you just have to pass 'all' as a second parameter. instead of just the first one.</em> |
| public | <strong>hyphenize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string hyphenized word</em><br /><em>Converts a word "into-it-s-hyphenated-version" Convert any "CamelCased" or "ordinary Word" into an "hyphenated-word". This can be really useful for creating friendly URLs.</em> |
| public | <strong>init()</strong> : <em>void</em> |
| public | <strong>monthize(</strong><em>int</em> <strong>$days</strong>)</strong> : <em>int</em><br /><em>Converts a number of days to a number of months</em> |
| public | <strong>ordinalize(</strong><em>integer</em> <strong>$number</strong>)</strong> : <em>string Ordinal representation of given string.</em><br /><em>Converts number to its ordinal English form. This method converts 13 to 13th, 2 to 2nd ...</em> |
| public | <strong>pluralize(</strong><em>string</em> <strong>$word</strong>, <em>int</em> <strong>$count=2</strong>)</strong> : <em>string Plural noun</em><br /><em>Pluralizes English nouns.</em> |
| public | <strong>singularize(</strong><em>string</em> <strong>$word</strong>, <em>int</em> <strong>$count=1</strong>)</strong> : <em>string Singular noun.</em><br /><em>Singularizes English nouns.</em> |
| public | <strong>tableize(</strong><em>string</em> <strong>$class_name</strong>)</strong> : <em>string plural_table_name</em><br /><em>Converts a class name to its table name according to rails naming conventions. Converts "Person" to "people"</em> |
| public | <strong>titleize(</strong><em>string</em> <strong>$word</strong>, <em>string</em> <strong>$uppercase=`''`</strong>)</strong> : <em>string Text formatted as title</em><br /><em>Converts an underscored or CamelCase word into a English sentence. The titleize public function converts text like "WelcomePage", "welcome_page" or  "welcome page" to this "Welcome Page". If second parameter is set to 'first' it will only capitalize the first character of the title. first character. Otherwise it will uppercase all the words in the title.</em> |
| public | <strong>underscorize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string Underscored word</em><br /><em>Converts a word "into_it_s_underscored_version" Convert any "CamelCased" or "ordinary Word" into an "underscored_word". This can be really useful for creating friendly URLs.</em> |
| public | <strong>variablize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string Returns a lowerCamelCasedWord</em><br /><em>Same as camelize but first char is underscored Converts a word like "send_email" to "sendEmail". It will remove non alphanumeric character from the word, so "who's online" will be converted to "whoSOnline"</em> |

<hr /><a id="class-gravcommoniterator"></a>
### Class: \Grav\Common\Iterator

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>mixed</em><br /><em>Convert function calls for the existing keys into their values.</em> |
| public | <strong>__clone()</strong> : <em>void</em><br /><em>Clone the iterator.</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>)</strong> : <em>void</em><br /><em>Constructor to initialize array.</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Asset value</em><br /><em>Magic getter method</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>boolean True if the value is set</em><br /><em>Magic method to determine if the attribute is set</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Magic setter method</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Convents iterator to a comma separated list.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>append(</strong><em>array/[\Grav\Common\Iterator](#class-gravcommoniterator)</em> <strong>$items</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Append new elements to the list.</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Implements Countable interface.</em> |
| public | <strong>current()</strong> : <em>mixed Can return any type.</em><br /><em>Returns the current element.</em> |
| public | <strong>filter(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Filter elements from the list filter status</em> |
| public | <strong>first()</strong> : <em>mixed</em><br /><em>Get the first item</em> |
| public | <strong>indexOf(</strong><em>mixed</em> <strong>$needle</strong>)</strong> : <em>string/bool Key if found, otherwise false.</em> |
| public | <strong>key()</strong> : <em>mixed Returns scalar on success, or NULL on failure.</em><br /><em>Returns the key of the current element.</em> |
| public | <strong>last()</strong> : <em>mixed</em><br /><em>Get the last item</em> |
| public | <strong>next()</strong> : <em>void</em><br /><em>Moves the current position to the next element.</em> |
| public | <strong>nth(</strong><em>int</em> <strong>$key</strong>)</strong> : <em>mixed/bool</em><br /><em>Return nth item.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>prev()</strong> : <em>mixed</em><br /><em>Return previous item.</em> |
| public | <strong>random(</strong><em>int</em> <strong>$num=1</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Pick one or more random entries.</em> |
| public | <strong>remove(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Remove item from the list.</em> |
| public | <strong>reverse()</strong> : <em>\Grav\Common\$this</em><br /><em>Reverse the Iterator</em> |
| public | <strong>rewind()</strong> : <em>void</em><br /><em>Rewinds back to the first element of the Iterator.</em> |
| public | <strong>serialize()</strong> : <em>string Returns the string representation of the object.</em><br /><em>Returns string representation of the object.</em> |
| public | <strong>shuffle()</strong> : <em>\Grav\Common\$this</em><br /><em>Shuffle items.</em> |
| public | <strong>slice(</strong><em>int</em> <strong>$offset</strong>, <em>int</em> <strong>$length=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Slice the list.</em> |
| public | <strong>sort(</strong><em>\callable</em> <strong>$callback=null</strong>, <em>bool</em> <strong>$desc=false</strong>)</strong> : <em>\Grav\Common\$this/array</em><br /><em>Sorts elements from the list and returns a copy of the list in the proper order</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=3</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em><br /><em>Called during unserialization of the object.</em> |
| public | <strong>valid()</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>This method is called after Iterator::rewind() and Iterator::next() to check if the current position is valid.</em> |

*This class implements \ArrayAccess, \Iterator, \Traversable, \Countable, \Serializable*

<hr /><a id="class-gravcommongetters-abstract"></a>
### Class: \Grav\Common\Getters (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Medium value</em><br /><em>Magic getter method</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>boolean True if the value is set</em><br /><em>Magic method to determine if the attribute is set</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Magic setter method</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>count()</strong> : <em>int</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Returns an associative array of object properties.</em> |

*This class implements \ArrayAccess, \Countable*

<hr /><a id="class-gravcommonassets"></a>
### Class: \Grav\Common\Assets

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options=array()</strong>)</strong> : <em>void</em><br /><em>Assets constructor.</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>add(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>bool</em> <strong>$pipeline=true</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an asset or a collection of assets. It automatically detects the asset type (JavaScript, CSS or collection). You may add more than one asset passing an array as argument.</em> |
| public | <strike><strong>addAsyncJs(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$group=null</strong>)</strong> : <em>[\Grav\Common\Assets](#class-gravcommonassets)</em></strike><br /><em>DEPRECATED - Please use dynamic method with ['loading' => 'async']</em> |
| public | <strong>addCss(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$group=null</strong>, <em>string</em> <strong>$loading=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add a CSS asset. It checks for duplicates. You may add more than one asset passing an array as argument. The second argument may alternatively contain an array of options which take precedence over positional arguments.</em> |
| public | <strike><strong>addDeferJs(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$group=null</strong>)</strong> : <em>[\Grav\Common\Assets](#class-gravcommonassets)</em></strike><br /><em>DEPRECATED - Please use dynamic method with ['loading' => 'defer']</em> |
| public | <strong>addDir(</strong><em>string</em> <strong>$directory</strong>, <em>string</em> <strong>$pattern=`'/.\.(css|js)$/i'`</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add all assets matching $pattern within $directory.</em> |
| public | <strong>addDirCss(</strong><em>string</em> <strong>$directory</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add all CSS assets within $directory</em> |
| public | <strong>addDirJs(</strong><em>string</em> <strong>$directory</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add all JavaScript assets within $directory</em> |
| public | <strong>addInlineCss(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>null</em> <strong>$group=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an inline CSS asset. It checks for duplicates. For adding chunks of string-based inline CSS</em> |
| public | <strong>addInlineJs(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>string</em> <strong>$group=null</strong>, <em>null</em> <strong>$attributes=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an inline JS asset. It checks for duplicates. For adding chunks of string-based inline JS</em> |
| public | <strong>addJs(</strong><em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$loading=null</strong>, <em>string</em> <strong>$group=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add a JavaScript asset. It checks for duplicates. You may add more than one asset passing an array as argument. The second argument may alternatively contain an array of options which take precedence over positional arguments.</em> |
| public | <strong>addTo(</strong><em>array</em> <strong>$assembly</strong>, <em>mixed</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=null</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$loading=null</strong>, <em>string</em> <strong>$group=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an asset to its assembly. It checks for duplicates. You may add more than one asset passing an array as argument. The third argument may alternatively contain an array of options which take precedence over positional arguments.</em> |
| public | <strong>config(</strong><em>array</em> <strong>$config</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Set up configuration options. All the class properties except 'js' and 'css' are accepted here. Also, an extra option 'autoload' may be passed containing an array of assets and/or collections that will be automatically added on startup.</em> |
| public | <strong>css(</strong><em>string</em> <strong>$group=`'head'`</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>string</em><br /><em>Build the CSS link tags.</em> |
| public | <strong>exists(</strong><em>mixed</em> <strong>$asset</strong>)</strong> : <em>bool</em><br /><em>Determines if an asset exists as a collection, CSS or JS reference</em> |
| public | <strong>getCollections()</strong> : <em>array</em><br /><em>Return the array of all the registered collections</em> |
| public | <strong>getCss(</strong><em>null/string</em> <strong>$key=null</strong>)</strong> : <em>array</em><br /><em>Return the array of all the registered CSS assets If a $key is provided, it will try to return only that asset else it will return null</em> |
| public | <strong>getJs(</strong><em>null/string</em> <strong>$key=null</strong>)</strong> : <em>array</em><br /><em>Return the array of all the registered JS assets If a $key is provided, it will try to return only that asset else it will return null</em> |
| public | <strong>getQuerystring(</strong><em>mixed</em> <strong>$asset</strong>)</strong> : <em>string</em> |
| public | <strong>getTimestamp(</strong><em>bool</em> <strong>$include_join=true</strong>)</strong> : <em>string</em><br /><em>Get the timestamp for assets</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initialization called in the Grav lifecycle to initialize the Assets with appropriate configuration</em> |
| public | <strong>js(</strong><em>string</em> <strong>$group=`'head'`</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>string</em><br /><em>Build the JavaScript script tags.</em> |
| public | <strong>registerCollection(</strong><em>string</em> <strong>$collectionName</strong>, <em>array</em> <strong>$assets</strong>, <em>bool</em> <strong>$overwrite=false</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add/replace collection.</em> |
| public | <strong>removeCss(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Removes an item from the CSS array if set</em> |
| public | <strong>removeJs(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Removes an item from the JS array if set</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\$this</em><br /><em>Reset all assets.</em> |
| public | <strong>resetCss()</strong> : <em>\Grav\Common\$this</em><br /><em>Reset CSS assets.</em> |
| public | <strong>resetJs()</strong> : <em>\Grav\Common\$this</em><br /><em>Reset JavaScript assets.</em> |
| public | <strong>setCollection(</strong><em>mixed</em> <strong>$collections</strong>)</strong> : <em>void</em><br /><em>Set the array of collections explicitly</em> |
| public | <strong>setCss(</strong><em>mixed</em> <strong>$css</strong>)</strong> : <em>void</em><br /><em>Set the whole array of CSS assets</em> |
| public | <strong>setCssPipeline(</strong><em>boolean</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Sets the state of CSS Pipeline</em> |
| public | <strong>setJs(</strong><em>mixed</em> <strong>$js</strong>)</strong> : <em>void</em><br /><em>Set the whole array of JS assets</em> |
| public | <strong>setJsPipeline(</strong><em>boolean</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Sets the state of JS Pipeline</em> |
| public | <strong>setTimestamp(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Explicitly set's a timestamp for assets</em> |
| protected | <strong>attributes(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>string</em><br /><em>Build an HTML attribute string from an array.</em> |
| protected | <strong>buildLocalLink(</strong><em>string</em> <strong>$asset</strong>, <em>bool</em> <strong>$absolute=false</strong>)</strong> : <em>string the final link url to the asset</em><br /><em>Build local links including grav asset shortcodes</em> |
| protected | <strong>cssRewrite(</strong><em>string</em> <strong>$file</strong>, <em>string</em> <strong>$relative_path</strong>)</strong> : <em>mixed</em><br /><em>Finds relative CSS urls() and rewrites the URL with an absolute one</em> |
| protected | <strong>gatherLinks(</strong><em>array</em> <strong>$links</strong>, <em>bool</em> <strong>$css=true</strong>)</strong> : <em>string</em><br /><em>Download and concatenate the content of several links.</em> |
| protected | <strong>getLastModificationTime(</strong><em>string</em> <strong>$asset</strong>)</strong> : <em>string the last modifcation time or false on error</em><br /><em>Get the last modification time of asset</em> |
| protected | <strong>isRemoteLink(</strong><em>string</em> <strong>$link</strong>)</strong> : <em>bool</em><br /><em>Determine whether a link is local or remote. Understands both "http://" and "https://" as well as protocol agnostic links "//"</em> |
| protected | <strong>moveImports(</strong><em>string</em> <strong>$file</strong>)</strong> : <em>string the modified file with any @imports at the top of the file</em><br /><em>Moves @import statements to the top of the file per the CSS specification</em> |
| protected | <strong>pipelineCss(</strong><em>string</em> <strong>$group=`'head'`</strong>, <em>bool</em> <strong>$returnURL=true</strong>)</strong> : <em>bool/string URL or generated content if available, else false</em><br /><em>Minify and concatenate CSS</em> |
| protected | <strong>pipelineJs(</strong><em>string</em> <strong>$group=`'head'`</strong>, <em>bool</em> <strong>$returnURL=true</strong>)</strong> : <em>bool/string URL or generated content if available, else false</em><br /><em>Minify and concatenate JS files.</em> |
| protected | <strong>rglob(</strong><em>string</em> <strong>$directory</strong>, <em>string</em> <strong>$pattern</strong>, <em>string</em> <strong>$ltrim=null</strong>)</strong> : <em>array</em><br /><em>Recursively get files matching $pattern within $directory.</em> |
| protected | <strong>sortAssetsByPriorityThenOrder(</strong><em>mixed</em> <strong>$a</strong>, <em>mixed</em> <strong>$b</strong>)</strong> : <em>mixed</em> |

<hr /><a id="class-gravcommonbackupzipbackup"></a>
### Class: \Grav\Common\Backup\ZipBackup

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>backup(</strong><em>string/null</em> <strong>$destination=null</strong>, <em>\callable</em> <strong>$messager=null</strong>)</strong> : <em>null/string</em><br /><em>Backup</em> |

<hr /><a id="class-gravcommonconfigcompiledlanguages"></a>
### Class: \Grav\Common\Config\CompiledLanguages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>modified()</strong> : <em>void</em><br /><em>Function gets called when cached configuration is saved.</em> |
| protected | <strong>createObject(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create configuration object.</em> |
| protected | <strong>finalizeObject()</strong> : <em>void</em><br /><em>Finalize configuration object.</em> |
| protected | <strong>loadFile(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$filename</strong>)</strong> : <em>mixed</em><br /><em>Load single configuration file and append it to the correct position.</em> |

*This class extends [\Grav\Common\Config\CompiledBase](#class-gravcommonconfigcompiledbase-abstract)*

<hr /><a id="class-gravcommonconfigcompiledconfig"></a>
### Class: \Grav\Common\Config\CompiledConfig

| Visibility | Function |
|:-----------|:---------|
| public | <strong>load(</strong><em>bool</em> <strong>$withDefaults=false</strong>)</strong> : <em>mixed</em> |
| public | <strong>modified()</strong> : <em>void</em><br /><em>Function gets called when cached configuration is saved.</em> |
| public | <strong>setBlueprints(</strong><em>\callable</em> <strong>$blueprints</strong>)</strong> : <em>\Grav\Common\Config\$this</em><br /><em>Set blueprints for the configuration.</em> |
| protected | <strong>createObject(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create configuration object.</em> |
| protected | <strong>finalizeObject()</strong> : <em>void</em><br /><em>Finalize configuration object.</em> |
| protected | <strong>loadFile(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$filename</strong>)</strong> : <em>mixed</em><br /><em>Load single configuration file and append it to the correct position.</em> |

*This class extends [\Grav\Common\Config\CompiledBase](#class-gravcommonconfigcompiledbase-abstract)*

<hr /><a id="class-gravcommonconfiglanguages"></a>
### Class: \Grav\Common\Config\Languages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>checksum(</strong><em>mixed</em> <strong>$checksum=null</strong>)</strong> : <em>void</em> |
| public | <strong>mergeRecursive(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>modified(</strong><em>mixed</em> <strong>$modified=null</strong>)</strong> : <em>void</em> |
| public | <strong>reformat()</strong> : <em>void</em> |
| public | <strong>timestamp(</strong><em>mixed</em> <strong>$timestamp=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

<hr /><a id="class-gravcommonconfigcompiledbase-abstract"></a>
### Class: \Grav\Common\Config\CompiledBase (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$cacheFolder</strong>, <em>array</em> <strong>$files</strong>, <em>string</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>checksum()</strong> : <em>bool/string</em><br /><em>Returns checksum from the configuration files. You can set $this->checksum = false to disable this check.</em> |
| public | <strong>load()</strong> : <em>mixed</em><br /><em>Load the configuration.</em> |
| public | <strong>modified()</strong> : <em>void</em><br /><em>Function gets called when cached configuration is saved.</em> |
| public | <strong>name(</strong><em>string</em> <strong>$name=null</strong>)</strong> : <em>\Grav\Common\Config\$this</em><br /><em>Get filename for the compiled PHP file.</em> |
| public | <strong>timestamp()</strong> : <em>int Timestamp of compiled configuration</em><br /><em>Get timestamp of compiled configuration</em> |
| protected | <strong>createFilename()</strong> : <em>mixed</em> |
| protected | <strong>abstract createObject(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create configuration object.</em> |
| protected | <strong>abstract finalizeObject()</strong> : <em>void</em><br /><em>Finalize configuration object.</em> |
| protected | <strong>getState()</strong> : <em>mixed</em> |
| protected | <strong>loadCompiledFile(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>bool</em><br /><em>Load compiled file.</em> |
| protected | <strong>abstract loadFile(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$filename</strong>)</strong> : <em>mixed</em><br /><em>Load single configuration file and append it to the correct position.</em> |
| protected | <strong>loadFiles()</strong> : <em>bool</em><br /><em>Load and join all configuration files.</em> |
| protected | <strong>saveCompiledFile(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>void</em><br /><em>Save compiled file.</em> |

<hr /><a id="class-gravcommonconfigconfig"></a>
### Class: \Grav\Common\Config\Config

| Visibility | Function |
|:-----------|:---------|
| public | <strong>checksum(</strong><em>mixed</em> <strong>$checksum=null</strong>)</strong> : <em>void</em> |
| public | <strong>debug()</strong> : <em>void</em> |
| public | <strong>getLanguages()</strong> : <em>mixed</em> |
| public | <strong>init()</strong> : <em>void</em> |
| public | <strong>key()</strong> : <em>void</em> |
| public | <strong>modified(</strong><em>mixed</em> <strong>$modified=null</strong>)</strong> : <em>void</em> |
| public | <strong>reload()</strong> : <em>void</em> |
| public | <strong>timestamp(</strong><em>mixed</em> <strong>$timestamp=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

<hr /><a id="class-gravcommonconfigsetup"></a>
### Class: \Grav\Common\Config\Setup

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Grav\Common\Config\Container/array</em> <strong>$container</strong>)</strong> : <em>void</em> |
| public | <strong>getStreams()</strong> : <em>array</em><br /><em>Get available streams and their types from the configuration.</em> |
| public | <strong>init()</strong> : <em>\Grav\Common\Config\$this</em> |
| public | <strong>initializeLocator(</strong><em>\RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator</em> <strong>$locator</strong>)</strong> : <em>void</em><br /><em>Initialize resource locator by using the configuration.</em> |
| protected | <strong>check(</strong><em>\RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator</em> <strong>$locator</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

<hr /><a id="class-gravcommonconfigconfigfilefinder"></a>
### Class: \Grav\Common\Config\ConfigFileFinder

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getFiles(</strong><em>array</em> <strong>$paths</strong>, <em>string</em> <strong>$pattern=`'|\.yaml$|'`</strong>, <em>int</em> <strong>$levels=-1</strong>)</strong> : <em>array</em><br /><em>Return all locations for all the files with a timestamp.</em> |
| public | <strong>listFiles(</strong><em>array</em> <strong>$paths</strong>, <em>string</em> <strong>$pattern=`'|\.yaml$|'`</strong>, <em>int</em> <strong>$levels=-1</strong>)</strong> : <em>array</em><br /><em>Return all paths for all the files with a timestamp.</em> |
| public | <strong>locateFile(</strong><em>array</em> <strong>$paths</strong>, <em>string</em> <strong>$name</strong>, <em>string</em> <strong>$ext=`'.yaml'`</strong>)</strong> : <em>array</em><br /><em>Return all existing locations for a single file with a timestamp.</em> |
| public | <strong>locateFileInFolder(</strong><em>string</em> <strong>$filename</strong>, <em>array</em> <strong>$folders</strong>)</strong> : <em>array</em><br /><em>Find filename from a list of folders. Note: Only finds the last override.</em> |
| public | <strong>locateFiles(</strong><em>array</em> <strong>$paths</strong>, <em>string</em> <strong>$pattern=`'|\.yaml$|'`</strong>, <em>int</em> <strong>$levels=-1</strong>)</strong> : <em>array</em><br /><em>Return all locations for all the files with a timestamp.</em> |
| public | <strong>locateInFolders(</strong><em>array</em> <strong>$folders</strong>, <em>string</em> <strong>$filename=null</strong>)</strong> : <em>array</em><br /><em>Find filename from a list of folders.</em> |
| public | <strong>setBase(</strong><em>string</em> <strong>$base</strong>)</strong> : <em>\Grav\Common\Config\$this</em> |
| protected | <strong>detectAll(</strong><em>string</em> <strong>$folder</strong>, <em>string</em> <strong>$pattern</strong>, <em>int</em> <strong>$levels</strong>)</strong> : <em>array</em><br /><em>Detects all plugins with a configuration file and returns them with last modification time.</em> |
| protected | <strong>detectInFolder(</strong><em>string</em> <strong>$folder</strong>, <em>string</em> <strong>$lookup=null</strong>)</strong> : <em>array</em><br /><em>Detects all directories with the lookup file and returns them with last modification time.</em> |
| protected | <strong>detectRecursive(</strong><em>string</em> <strong>$folder</strong>, <em>string</em> <strong>$pattern</strong>, <em>int</em> <strong>$levels</strong>)</strong> : <em>array</em><br /><em>Detects all directories with a configuration file and returns them with last modification time.</em> |

<hr /><a id="class-gravcommonconfigcompiledblueprints"></a>
### Class: \Grav\Common\Config\CompiledBlueprints

| Visibility | Function |
|:-----------|:---------|
| public | <strong>checksum()</strong> : <em>bool/string</em><br /><em>Returns checksum from the configuration files. You can set $this->checksum = false to disable this check.</em> |
| protected | <strong>createObject(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create configuration object.</em> |
| protected | <strong>finalizeObject()</strong> : <em>void</em><br /><em>Finalize configuration object.</em> |
| protected | <strong>getState()</strong> : <em>mixed</em> |
| protected | <strong>getTypes()</strong> : <em>array</em><br /><em>Get list of form field types.</em> |
| protected | <strong>loadFile(</strong><em>string</em> <strong>$name</strong>, <em>array</em> <strong>$files</strong>)</strong> : <em>mixed</em><br /><em>Load single configuration file and append it to the correct position.</em> |
| protected | <strong>loadFiles()</strong> : <em>bool</em><br /><em>Load and join all configuration files.</em> |

*This class extends [\Grav\Common\Config\CompiledBase](#class-gravcommonconfigcompiledbase-abstract)*

<hr /><a id="class-gravcommondatablueprint"></a>
### Class: \Grav\Common\Data\Blueprint

| Visibility | Function |
|:-----------|:---------|
| public | <strong>extra(</strong><em>array</em> <strong>$data</strong>, <em>string</em> <strong>$prefix=`''`</strong>)</strong> : <em>array</em><br /><em>Return data fields that do not exist in blueprints.</em> |
| public | <strong>filter(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Filter data by using blueprints.</em> |
| public | <strong>getDefaults()</strong> : <em>array</em><br /><em>Get nested structure containing default values defined in the blueprints. Fields without default value are ignored in the list.</em> |
| public | <strong>mergeData(</strong><em>array</em> <strong>$data1</strong>, <em>array</em> <strong>$data2</strong>, <em>string</em> <strong>$name=null</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>array</em><br /><em>Merge two arrays by using blueprints.</em> |
| public | <strong>schema()</strong> : <em>[\Grav\Common\Data\BlueprintSchema](#class-gravcommondatablueprintschema)</em><br /><em>Return blueprint data schema.</em> |
| public | <strong>setTypes(</strong><em>array</em> <strong>$types</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set default values for field types.</em> |
| public | <strong>validate(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Validate data against blueprints.</em> |
| protected | <strong>dynamicConfig(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>dynamicData(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>getFiles(</strong><em>string/array</em> <strong>$path</strong>, <em>string</em> <strong>$context=null</strong>)</strong> : <em>array</em> |
| protected | <strong>initInternals()</strong> : <em>void</em><br /><em>Initialize validator.</em> |
| protected | <strong>loadFile(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>string</em> |

*This class extends \RocketTheme\Toolbox\Blueprints\BlueprintForm*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \ArrayAccess*

<hr /><a id="class-gravcommondatablueprints"></a>
### Class: \Grav\Common\Data\Blueprints

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string/string/array</em> <strong>$search=`'blueprints://'`</strong>)</strong> : <em>void</em> |
| public | <strong>get(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get blueprint.</em> |
| public | <strong>types()</strong> : <em>array List of type=>name</em><br /><em>Get all available blueprint types.</em> |
| protected | <strong>loadFile(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Load blueprint file.</em> |

<hr /><a id="interface-gravcommondatadatainterface"></a>
### Interface: \Grav\Common\Data\DataInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>blueprints()</strong> : <em>void</em><br /><em>Return blueprints.</em> |
| public | <strong>extra()</strong> : <em>void</em><br /><em>Get extra items which haven't been defined in blueprints.</em> |
| public | <strong>file(</strong><em>\RocketTheme\Toolbox\File\FileInterface</em> <strong>$storage=null</strong>)</strong> : <em>\RocketTheme\Toolbox\File\FileInterface</em><br /><em>Set or get the data storage.</em> |
| public | <strong>filter()</strong> : <em>void</em><br /><em>Filter all items by using blueprints.</em> |
| public | <strong>merge(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>mixed</em><br /><em>Merge external data.</em> |
| public | <strong>save()</strong> : <em>void</em><br /><em>Save data into the file.</em> |
| public | <strong>validate()</strong> : <em>void</em><br /><em>Validate by blueprints.</em> |
| public | <strong>value(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
###### Examples of DataInterface::value()
```
$value = $data->value('this.is.my.nested.variable');
```

<hr /><a id="class-gravcommondatavalidationexception"></a>
### Class: \Grav\Common\Data\ValidationException

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getMessages()</strong> : <em>mixed</em> |
| public | <strong>setMessages(</strong><em>array</em> <strong>$messages=array()</strong>)</strong> : <em>void</em> |

*This class extends \RuntimeException*

*This class implements \Throwable*

<hr /><a id="class-gravcommondatadata"></a>
### Class: \Grav\Common\Data\Data

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)/callable</em> <strong>$blueprints=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Asset value</em><br /><em>Magic getter method</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>boolean True if the value is set</em><br /><em>Magic method to determine if the attribute is set</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Magic setter method</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>blueprints()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Return blueprints.</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Implements Countable interface.</em> |
| public | <strong>def(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set default value by using dot notation for nested arrays/objects.</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Returns whether the data already exists in the storage. NOTE: This method does not check if the data is current.</em> |
| public | <strong>extra()</strong> : <em>array</em><br /><em>Get extra items which haven't been defined in blueprints.</em> |
| public | <strong>file(</strong><em>\RocketTheme\Toolbox\File\FileInterface</em> <strong>$storage=null</strong>)</strong> : <em>\RocketTheme\Toolbox\File\FileInterface</em><br /><em>Set or get the data storage.</em> |
| public | <strong>filter()</strong> : <em>$this Filter all items by using blueprints.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
| public | <strong>getDefaults()</strong> : <em>array</em><br /><em>Get nested structure containing default values defined in the blueprints. Fields without default value are ignored in the list.</em> |
| public | <strong>getJoined(</strong><em>string</em> <strong>$name</strong>, <em>array</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>array</em><br /><em>Get value from the configuration and join it with given data.</em> |
| public | <strong>join(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Join nested values together by using blueprints.</em> |
| public | <strong>joinDefaults(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set default values by using blueprints.</em> |
| public | <strong>merge(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Merge two configurations together.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets variable at specified offset.</em> |
| public | <strong>raw()</strong> : <em>string</em><br /><em>Return unmodified data as raw string. NOTE: This function only returns data which has been saved to the storage.</em> |
| public | <strong>save()</strong> : <em>void</em><br /><em>Save data if storage has been defined.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set value by using dot notation for nested arrays/objects.</em> |
| public | <strong>setDefaults(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set default values to the configuration if variables were not set.</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=3</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>undef(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Unset value by using dot notation for nested arrays/objects.</em> |
| public | <strong>validate()</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Validate by blueprints.</em> |
| public | <strong>value(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
###### Examples of Data::def()
```
$data->def('this.is.my.nested.variable', 'default');
```
###### Examples of Data::get()
```
$value = $this->get('this.is.my.nested.variable');
```
###### Examples of Data::set()
```
$data->set('this.is.my.nested.variable', $value);
```
###### Examples of Data::undef()
```
$data->undef('this.is.my.nested.variable');
```
###### Examples of Data::value()
```
$value = $data->value('this.is.my.nested.variable');
```

*This class implements [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommondatavalidation"></a>
### Class: \Grav\Common\Data\Validation

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>filter(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>mixed Filtered value.</em><br /><em>Filter value against a blueprint field definition.</em> |
| public static | <strong>filterIgnore(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| public static | <strong>filterItem_List(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>filterYaml(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>typeArray(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>Custom input: array</em> |
| public static | <strong>typeBool(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>typeCheckbox(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: checkbox</em> |
| public static | <strong>typeCheckboxes(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>Custom input: checkbox list</em> |
| public static | <strong>typeColor(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: color</em> |
| public static | <strong>typeCommaList(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| public static | <strong>typeDate(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: date</em> |
| public static | <strong>typeDatetime(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: datetime</em> |
| public static | <strong>typeDatetimeLocal(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: datetime-local</em> |
| public static | <strong>typeEmail(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: email</em> |
| public static | <strong>typeFile(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>Custom input: file</em> |
| public static | <strong>typeHidden(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: hidden</em> |
| public static | <strong>typeIgnore(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>Custom input: ignore (will not validate)</em> |
| public static | <strong>typeList(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| public static | <strong>typeMonth(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: month</em> |
| public static | <strong>typeNumber(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: number</em> |
| public static | <strong>typePassword(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: password</em> |
| public static | <strong>typeRadio(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: radio</em> |
| public static | <strong>typeRange(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: range</em> |
| public static | <strong>typeSelect(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: select</em> |
| public static | <strong>typeText(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: text</em> |
| public static | <strong>typeTextarea(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: textarea</em> |
| public static | <strong>typeTime(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: time</em> |
| public static | <strong>typeToggle(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>Custom input: toggle</em> |
| public static | <strong>typeUrl(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: url</em> |
| public static | <strong>typeWeek(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>HTML5 input: week</em> |
| public static | <strong>validate(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>array</em><br /><em>Validate value against a blueprint field definition.</em> |
| public static | <strong>validateAlnum(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateAlpha(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateArray(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateBool(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateDigit(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateFloat(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateHex(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateInt(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateJson(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validatePattern(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>validateRequired(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterArray(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>, <em>mixed</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterBool(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterCheckboxes(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterCommaList(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterDateTime(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterFile(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterFloat(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterInt(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterList(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterLower(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterNumber(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterRange(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterText(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| protected static | <strong>filterUpper(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommondatablueprintschema"></a>
### Class: \Grav\Common\Data\BlueprintSchema

| Visibility | Function |
|:-----------|:---------|
| public | <strong>filter(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Filter data by using blueprints.</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=3</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>validate(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Validate data against blueprints.</em> |
| protected | <strong>checkRequired(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$fields</strong>)</strong> : <em>array</em> |
| protected | <strong>dynamicConfig(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>filterArray(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$rules</strong>)</strong> : <em>array</em> |
| protected | <strong>validateArray(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$rules</strong>)</strong> : <em>void</em> |

*This class extends \RocketTheme\Toolbox\Blueprints\BlueprintSchema*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonerrorsbarehandler"></a>
### Class: \Grav\Common\Errors\BareHandler

| Visibility | Function |
|:-----------|:---------|
| public | <strong>handle()</strong> : <em>int/null</em> |

*This class extends \Whoops\Handler\Handler*

*This class implements \Whoops\Handler\HandlerInterface*

<hr /><a id="class-gravcommonerrorserrors"></a>
### Class: \Grav\Common\Errors\Errors

| Visibility | Function |
|:-----------|:---------|
| public | <strong>resetHandlers()</strong> : <em>void</em> |

<hr /><a id="class-gravcommonerrorssystemfacade"></a>
### Class: \Grav\Common\Errors\SystemFacade

| Visibility | Function |
|:-----------|:---------|
| public | <strong>handleShutdown()</strong> : <em>void</em><br /><em>Special case to deal with Fatal errors and the like.</em> |
| public | <strong>registerShutdownFunction(</strong><em>\callable</em> <strong>$function</strong>)</strong> : <em>void</em> |

*This class extends \Whoops\Util\SystemFacade*

<hr /><a id="class-gravcommonerrorssimplepagehandler"></a>
### Class: \Grav\Common\Errors\SimplePageHandler

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>addResourcePath(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>getResourcePaths()</strong> : <em>mixed</em> |
| public | <strong>handle()</strong> : <em>int/null</em> |
| protected | <strong>getResource(</strong><em>mixed</em> <strong>$resource</strong>)</strong> : <em>string</em> |

*This class extends \Whoops\Handler\Handler*

*This class implements \Whoops\Handler\HandlerInterface*

<hr /><a id="class-gravcommonfilecompiledjsonfile"></a>
### Class: \Grav\Common\File\CompiledJsonFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__sleep()</strong> : <em>void</em><br /><em>Serialize file.</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Unserialize file.</em> |
| public | <strong>content(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Get/set parsed file contents.</em> |
| protected | <strong>decode(</strong><em>string</em> <strong>$var</strong>, <em>bool</em> <strong>$assoc=true</strong>)</strong> : <em>array mixed</em><br /><em>Decode RAW string into contents.</em> |

*This class extends \RocketTheme\Toolbox\File\JsonFile*

*This class implements \RocketTheme\Toolbox\File\FileInterface*

<hr /><a id="class-gravcommonfilecompiledyamlfile"></a>
### Class: \Grav\Common\File\CompiledYamlFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__sleep()</strong> : <em>void</em><br /><em>Serialize file.</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Unserialize file.</em> |
| public | <strong>content(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Get/set parsed file contents.</em> |

*This class extends \RocketTheme\Toolbox\File\YamlFile*

*This class implements \RocketTheme\Toolbox\File\FileInterface*

<hr /><a id="class-gravcommonfilecompiledmarkdownfile"></a>
### Class: \Grav\Common\File\CompiledMarkdownFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__sleep()</strong> : <em>void</em><br /><em>Serialize file.</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Unserialize file.</em> |
| public | <strong>content(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Get/set parsed file contents.</em> |

*This class extends \RocketTheme\Toolbox\File\MarkdownFile*

*This class implements \RocketTheme\Toolbox\File\FileInterface*

<hr /><a id="class-gravcommonfilesystemrecursivefolderfilteriterator"></a>
### Class: \Grav\Common\Filesystem\RecursiveFolderFilterIterator

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\RecursiveIterator</em> <strong>$iterator</strong>)</strong> : <em>void</em><br /><em>Create a RecursiveFilterIterator from a RecursiveIterator</em> |
| public | <strong>accept()</strong> : <em>bool true if the current element is acceptable, otherwise false.</em><br /><em>Check whether the current element of the iterator is acceptable</em> |

*This class extends \RecursiveFilterIterator*

*This class implements \RecursiveIterator, \OuterIterator, \Traversable, \Iterator*

<hr /><a id="class-gravcommonfilesystemfolder-abstract"></a>
### Class: \Grav\Common\Filesystem\Folder (abstract)

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>all(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>array</em><br /><em>Return recursive list of all files and directories under given path.</em> |
| public static | <strong>copy(</strong><em>string</em> <strong>$source</strong>, <em>string</em> <strong>$target</strong>, <em>string</em> <strong>$ignore=null</strong>)</strong> : <em>void</em><br /><em>Recursively copy directory in filesystem.</em> |
| public static | <strong>create(</strong><em>string</em> <strong>$folder</strong>)</strong> : <em>mixed</em> |
| public static | <strong>delete(</strong><em>string</em> <strong>$target</strong>, <em>bool</em> <strong>$include_target=true</strong>)</strong> : <em>bool</em><br /><em>Recursively delete directory from filesystem.</em> |
| public static | <strong>getRelativePath(</strong><em>string</em> <strong>$path</strong>, <em>string/mixed/string</em> <strong>$base=`'/Users/rhuk/workspace/grav-learn'`</strong>)</strong> : <em>string</em><br /><em>Get relative path between target and base path. If path isn't relative, return full path.</em> |
| public static | <strong>getRelativePathDotDot(</strong><em>string</em> <strong>$path</strong>, <em>string</em> <strong>$base</strong>)</strong> : <em>string</em><br /><em>Get relative path between target and base path. If path isn't relative, return full path.</em> |
| public static | <strong>hashAllFiles(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Recursively md5 hash all files in a path</em> |
| public static | <strong>lastModifiedFile(</strong><em>string</em> <strong>$path</strong>, <em>string</em> <strong>$extensions=`'md|yaml'`</strong>)</strong> : <em>int</em><br /><em>Recursively find the last modified time under given path by file.</em> |
| public static | <strong>lastModifiedFolder(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>int</em><br /><em>Recursively find the last modified time under given path.</em> |
| public static | <strong>mkdir(</strong><em>string</em> <strong>$folder</strong>)</strong> : <em>void</em> |
| public static | <strong>move(</strong><em>string</em> <strong>$source</strong>, <em>string</em> <strong>$target</strong>)</strong> : <em>void</em><br /><em>Move directory in filesystem.</em> |
| public static | <strong>rcopy(</strong><em>mixed</em> <strong>$src</strong>, <em>mixed</em> <strong>$dest</strong>)</strong> : <em>bool</em><br /><em>Recursive copy of one directory to another</em> |
| public static | <strong>shift(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Shift first directory out of the path.</em> |
| protected static | <strong>doDelete(</strong><em>string</em> <strong>$folder</strong>, <em>bool</em> <strong>$include_target=true</strong>)</strong> : <em>bool</em> |

<hr /><a id="class-gravcommongpmresponse"></a>
### Class: \Grav\Common\GPM\Response

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>get(</strong><em>string</em> <strong>$uri=`''`</strong>, <em>array</em> <strong>$options=array()</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>string The response of the request</em><br /><em>Makes a request to the URL by using the preferred method</em> |
| public static | <strong>isCurlAvailable()</strong> : <em>boolean</em><br /><em>Checks if cURL is available</em> |
| public static | <strong>isFopenAvailable()</strong> : <em>boolean</em><br /><em>Checks if the remote fopen request is enabled in PHP</em> |
| public static | <strong>isRemote(</strong><em>mixed</em> <strong>$file</strong>)</strong> : <em>bool</em><br /><em>Is this a remote file or not</em> |
| public static | <strong>progress()</strong> : <em>void</em><br /><em>Progress normalized for cURL and Fopen Accepts a variable length of arguments passed in by stream method</em> |
| public static | <strong>setMethod(</strong><em>string</em> <strong>$method=`'auto'`</strong>)</strong> : <em>[\Grav\Common\GPM\Response](#class-gravcommongpmresponse)</em><br /><em>Sets the preferred method to use for making HTTP calls.</em> |

<hr /><a id="class-gravcommongpmabstractcollection-abstract"></a>
### Class: \Grav\Common\GPM\AbstractCollection (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>toArray()</strong> : <em>void</em> |
| public | <strong>toJson()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmupgrader"></a>
### Class: \Grav\Common\GPM\Upgrader

> Class Upgrader

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool/boolean</em> <strong>$refresh=false</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>Creates a new GPM instance with Local and Remote packages available</em> |
| public | <strong>getAssets()</strong> : <em>array</em><br /><em>Returns an array of assets available to download remotely</em> |
| public | <strong>getChangelog(</strong><em>string</em> <strong>$diff=null</strong>)</strong> : <em>array return the changelog list for each version</em><br /><em>Returns the changelog list for each version of Grav</em> |
| public | <strong>getLocalVersion()</strong> : <em>string</em><br /><em>Returns the version of the installed Grav</em> |
| public | <strong>getReleaseDate()</strong> : <em>string</em><br /><em>Returns the release date of the latest version of Grav</em> |
| public | <strong>getRemoteVersion()</strong> : <em>string</em><br /><em>Returns the version of the remotely available Grav</em> |
| public | <strong>isSymlink()</strong> : <em>boolean True if Grav is symlinked, False otherwise.</em><br /><em>Checks if Grav is currently symbolically linked</em> |
| public | <strong>isUpgradable()</strong> : <em>boolean True if it's upgradable, False otherwise.</em><br /><em>Checks if the currently installed Grav is upgradable to a newer version</em> |
| public | <strong>meetsRequirements()</strong> : <em>bool</em><br /><em>Make sure this meets minimum PHP requirements</em> |
| public | <strong>minPHPVersion()</strong> : <em>null</em><br /><em>Get minimum PHP version from remote</em> |

<hr /><a id="class-gravcommongpmlicenses"></a>
### Class: \Grav\Common\GPM\Licenses

> Class Licenses

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>get(</strong><em>mixed</em> <strong>$slug=null</strong>)</strong> : <em>string</em><br /><em>Returns the license for a Premium package</em> |
| public static | <strong>getLicenseFile()</strong> : <em>\RocketTheme\Toolbox\File\FileInterface</em><br /><em>Get's the License File object</em> |
| public static | <strong>set(</strong><em>mixed</em> <strong>$slug</strong>, <em>mixed</em> <strong>$license</strong>)</strong> : <em>boolean</em><br /><em>Returns the license for a Premium package</em> |
| public static | <strong>validate(</strong><em>mixed</em> <strong>$license=null</strong>)</strong> : <em>bool</em><br /><em>Validates the License format</em> |

<hr /><a id="class-gravcommongpminstaller"></a>
### Class: \Grav\Common\GPM\Installer

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>copyInstall(</strong><em>mixed</em> <strong>$source_path</strong>, <em>mixed</em> <strong>$install_path</strong>)</strong> : <em>bool</em> |
| public static | <strong>getMessage()</strong> : <em>string The message</em><br /><em>Returns the last message added by the installer</em> |
| public static | <strong>install(</strong><em>string</em> <strong>$zip</strong>, <em>string</em> <strong>$destination</strong>, <em>array</em> <strong>$options=array()</strong>, <em>string</em> <strong>$extracted=null</strong>)</strong> : <em>bool True if everything went fine, False otherwise.</em><br /><em>Installs a given package to a given destination.</em> |
| public static | <strong>isGravInstance(</strong><em>string</em> <strong>$target</strong>)</strong> : <em>boolean True if is a Grav Instance. False otherwise</em><br /><em>Validates if the given path is a Grav Instance</em> |
| public static | <strong>isValidDestination(</strong><em>string</em> <strong>$destination</strong>, <em>array</em> <strong>$exclude=array()</strong>)</strong> : <em>boolean True if validation passed. False otherwise</em><br /><em>Runs a set of checks on the destination and sets the Error if any</em> |
| public static | <strong>lastErrorCode()</strong> : <em>integer The code of the last error</em><br /><em>Returns the last error code of the occurred error</em> |
| public static | <strong>lastErrorMsg()</strong> : <em>string The message of the last error</em><br /><em>Returns the last error occurred in a string message format</em> |
| public static | <strong>moveInstall(</strong><em>mixed</em> <strong>$source_path</strong>, <em>mixed</em> <strong>$install_path</strong>)</strong> : <em>bool</em> |
| public static | <strong>setError(</strong><em>int/string</em> <strong>$error</strong>)</strong> : <em>void</em><br /><em>Allows to manually set an error</em> |
| public static | <strong>sophisticatedInstall(</strong><em>mixed</em> <strong>$source_path</strong>, <em>mixed</em> <strong>$install_path</strong>, <em>array</em> <strong>$ignores=array()</strong>)</strong> : <em>bool</em> |
| public static | <strong>unZip(</strong><em>mixed</em> <strong>$zip_file</strong>, <em>mixed</em> <strong>$destination</strong>)</strong> : <em>bool/string</em><br /><em>Unzip a file to somewhere</em> |
| public static | <strong>uninstall(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$options=array()</strong>)</strong> : <em>boolean True if everything went fine, False otherwise.</em><br /><em>Uninstalls one or more given package</em> |

<hr /><a id="class-gravcommongpmgpm"></a>
### Class: \Grav\Common\GPM\GPM

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool/boolean</em> <strong>$refresh=false</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>Creates a new GPM instance with Local and Remote packages available</em> |
| public | <strong>calculateMergedDependenciesOfPackages(</strong><em>array</em> <strong>$packages</strong>)</strong> : <em>mixed</em><br /><em>Calculates and merges the dependencies of the passed packages</em> |
| public | <strong>calculateVersionNumberFromDependencyVersion(</strong><em>string</em> <strong>$version</strong>)</strong> : <em>null/string</em><br /><em>Returns the actual version from a dependency version string. Examples: $versionInformation == '~2.0' => returns '2.0' $versionInformation == '>=2.0.2' => returns '2.0.2' $versionInformation == '2.0.2' => returns '2.0.2' $versionInformation == '*' => returns null $versionInformation == '' => returns null</em> |
| public | <strong>checkNextSignificantReleasesAreCompatible(</strong><em>string</em> <strong>$version1</strong>, <em>string</em> <strong>$version2</strong>)</strong> : <em>bool</em><br /><em>Check if two releases are compatible by next significant release ~1.2 is equivalent to >=1.2 <2.0.0 ~1.2.3 is equivalent to >=1.2.3 <1.3.0 In short, allows the last digit specified to go up</em> |
| public | <strong>checkNoOtherPackageNeedsTheseDependenciesInALowerVersion(</strong><em>mixed</em> <strong>$dependencies_slugs</strong>)</strong> : <em>void</em> |
| public | <strong>checkNoOtherPackageNeedsThisDependencyInALowerVersion(</strong><em>string</em> <strong>$slug</strong>, <em>string</em> <strong>$version_with_operator</strong>, <em>array</em> <strong>$ignore_packages_list</strong>)</strong> : <em>bool</em><br /><em>Check the package identified by $slug can be updated to the version passed as argument. Thrown an exception if it cannot be updated because another package installed requires it to be at an older version.</em> |
| public | <strong>checkPackagesCanBeInstalled(</strong><em>mixed</em> <strong>$packages_names_list</strong>)</strong> : <em>void</em><br /><em>Check the passed packages list can be updated</em> |
| public static | <strong>copyPackage(</strong><em>mixed</em> <strong>$package_file</strong>, <em>mixed</em> <strong>$tmp</strong>)</strong> : <em>null/string</em><br /><em>Copy the local zip package to tmp</em> |
| public | <strong>countInstalled()</strong> : <em>integer Amount of installed packages</em><br /><em>Returns the amount of locally installed packages</em> |
| public | <strong>countUpdates()</strong> : <em>integer Amount of available updates</em><br /><em>Returns the amount of updates available</em> |
| public static | <strong>downloadPackage(</strong><em>mixed</em> <strong>$package_file</strong>, <em>mixed</em> <strong>$tmp</strong>)</strong> : <em>null/string</em><br /><em>Download the zip package via the URL</em> |
| public | <strong>findPackage(</strong><em>string</em> <strong>$search</strong>, <em>bool</em> <strong>$ignore_exception=false</strong>)</strong> : <em>[\Grav\Common\GPM\Remote\Package](#class-gravcommongpmremotepackage)/bool Package if found, FALSE if not</em><br /><em>Searches for a Package in the repository</em> |
| public | <strong>findPackages(</strong><em>array</em> <strong>$searches=array()</strong>)</strong> : <em>array Array of found Packages Format: ['total' => int, 'not_found' => array, <found-slugs>]</em><br /><em>Searches for a list of Packages in the repository</em> |
| public static | <strong>getBlueprints(</strong><em>mixed</em> <strong>$source</strong>)</strong> : <em>array/bool</em><br /><em>Find/Parse the blueprint file</em> |
| public | <strong>getDependencies(</strong><em>array</em> <strong>$packages</strong>)</strong> : <em>mixed</em><br /><em>Fetch the dependencies, check the installed packages and return an array with the list of packages with associated an information on what to do: install, update or ignore. `ignore` means the package is already installed and can be safely left as-is. `install` means the package is not installed and must be installed. `update` means the package is already installed and must be updated as a dependency needs a higher version.</em> |
| public static | <strong>getInstallPath(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Get the install path for a name and a particular type of package</em> |
| public | <strong>getInstallable(</strong><em>array</em> <strong>$list_type_installed=array()</strong>)</strong> : <em>array The installed packages</em><br /><em>Returns the Locally installable packages</em> |
| public | <strong>getInstalled()</strong> : <em>[\Grav\Common\GPM\Local\Packages](#class-gravcommongpmlocalpackages)</em><br /><em>Return the locally installed packages</em> |
| public | <strong>getInstalledPackage(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>Local\Package The instance of the Package</em><br /><em>Return the instance of a specific Package</em> |
| public | <strong>getInstalledPlugin(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>Local\Package The instance of the Plugin</em><br /><em>Return the instance of a specific Plugin</em> |
| public | <strong>getInstalledPlugins()</strong> : <em>Iterator The installed plugins</em><br /><em>Returns the Locally installed plugins</em> |
| public | <strong>getInstalledTheme(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>Local\Package The instance of the Theme</em><br /><em>Return the instance of a specific Theme</em> |
| public | <strong>getInstalledThemes()</strong> : <em>Iterator The installed themes</em><br /><em>Returns the Locally installed themes</em> |
| public | <strong>getLatestVersionOfPackage(</strong><em>mixed</em> <strong>$package_name</strong>)</strong> : <em>string/null</em><br /><em>Get the latest release of a package from the GPM</em> |
| public static | <strong>getPackageName(</strong><em>mixed</em> <strong>$source</strong>)</strong> : <em>bool/string</em><br /><em>Try to guess the package name from the source files</em> |
| public static | <strong>getPackageType(</strong><em>mixed</em> <strong>$source</strong>)</strong> : <em>bool/string</em><br /><em>Try to guess the package type from the source files</em> |
| public | <strong>getPackagesThatDependOnPackage(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>array</em><br /><em>Return the list of packages that have the passed one as dependency</em> |
| public | <strong>getReleaseType(</strong><em>mixed</em> <strong>$package_name</strong>)</strong> : <em>string/null</em><br /><em>Get the release type of a package (stable / testing)</em> |
| public | <strong>getRepository()</strong> : <em>Remote\Packages Available Plugins and Themes Format: ['plugins' => array, 'themes' => array]</em><br /><em>Returns the list of Plugins and Themes available in the repository</em> |
| public | <strong>getRepositoryPlugin(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>mixed Package if found, NULL if not</em><br /><em>Returns a Plugin from the repository</em> |
| public | <strong>getRepositoryPlugins()</strong> : <em>Iterator The Plugins remotely available</em><br /><em>Returns the list of Plugins available in the repository</em> |
| public | <strong>getRepositoryTheme(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>mixed Package if found, NULL if not</em><br /><em>Returns a Theme from the repository</em> |
| public | <strong>getRepositoryThemes()</strong> : <em>Iterator The Themes remotely available</em><br /><em>Returns the list of Themes available in the repository</em> |
| public | <strong>getUpdatable(</strong><em>array</em> <strong>$list_type_update=array()</strong>)</strong> : <em>array Array of updatable Plugins and Themes. Format: ['total' => int, 'plugins' => array, 'themes' => array]</em><br /><em>Returns an array of Plugins and Themes that can be updated. Plugins and Themes are extended with the `available` property that relies to the remote version</em> |
| public | <strong>getUpdatablePlugins()</strong> : <em>array Array of updatable Plugins</em><br /><em>Returns an array of Plugins that can be updated. The Plugins are extended with the `available` property that relies to the remote version</em> |
| public | <strong>getUpdatableThemes()</strong> : <em>array Array of updatable Themes</em><br /><em>Returns an array of Themes that can be updated. The Themes are extended with the `available` property that relies to the remote version</em> |
| public | <strong>getVersionOfDependencyRequiredByPackage(</strong><em>mixed</em> <strong>$package_slug</strong>, <em>mixed</em> <strong>$dependency_slug</strong>)</strong> : <em>mixed</em><br /><em>Get the required version of a dependency of a package</em> |
| public | <strong>isPluginInstalled(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>boolean True if the Plugin has been installed. False otherwise</em><br /><em>Checks if a Plugin is installed</em> |
| public | <strong>isPluginInstalledAsSymlink(</strong><em>mixed</em> <strong>$slug</strong>)</strong> : <em>bool</em> |
| public | <strong>isPluginUpdatable(</strong><em>string</em> <strong>$plugin</strong>)</strong> : <em>boolean True if the Plugin is updatable. False otherwise</em><br /><em>Checks if a Plugin is updatable</em> |
| public | <strong>isStableRelease(</strong><em>mixed</em> <strong>$package_name</strong>)</strong> : <em>boolean</em><br /><em>Returns true if the package latest release is stable</em> |
| public | <strong>isTestingRelease(</strong><em>mixed</em> <strong>$package_name</strong>)</strong> : <em>boolean</em><br /><em>Returns true if the package latest release is testing</em> |
| public | <strong>isThemeInstalled(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>boolean True if the Theme has been installed. False otherwise</em><br /><em>Checks if a Theme is installed</em> |
| public | <strong>isThemeUpdatable(</strong><em>string</em> <strong>$theme</strong>)</strong> : <em>boolean True if the Theme is updatable. False otherwise</em><br /><em>Checks if a Theme is Updatable</em> |
| public | <strong>isUpdatable(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>boolean True if updatable. False otherwise or if not found</em><br /><em>Check if a Plugin or Theme is updatable</em> |
| public | <strong>versionFormatIsEqualOrHigher(</strong><em>mixed</em> <strong>$version</strong>)</strong> : <em>bool</em><br /><em>Check if the passed version information contains equal or higher operator Example: returns true for $version: '>=2.0'</em> |
| public | <strong>versionFormatIsNextSignificantRelease(</strong><em>mixed</em> <strong>$version</strong>)</strong> : <em>bool</em><br /><em>Check if the passed version information contains next significant release (tilde) operator Example: returns true for $version: '~2.0'</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmcommonabstractpackagecollection-abstract"></a>
### Class: \Grav\Common\GPM\Common\AbstractPackageCollection (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>toArray()</strong> : <em>void</em> |
| public | <strong>toJson()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmcommonpackage"></a>
### Class: \Grav\Common\GPM\Common\Package

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em> <strong>$package</strong>, <em>mixed</em> <strong>$type=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>void</em> |
| public | <strong>getData()</strong> : <em>mixed</em> |
| public | <strong>toArray()</strong> : <em>void</em> |
| public | <strong>toJson()</strong> : <em>void</em> |

<hr /><a id="class-gravcommongpmcommoncachedcollection"></a>
### Class: \Grav\Common\GPM\Common\CachedCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$items</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmlocalabstractpackagecollection-abstract"></a>
### Class: \Grav\Common\GPM\Local\AbstractPackageCollection (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$items</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\GPM\Common\AbstractPackageCollection](#class-gravcommongpmcommonabstractpackagecollection-abstract)*

*This class implements \ArrayAccess, \Iterator, \Traversable, \Countable, \Serializable*

<hr /><a id="class-gravcommongpmlocalpackage"></a>
### Class: \Grav\Common\GPM\Local\Package

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em> <strong>$package</strong>, <em>mixed</em> <strong>$package_type=null</strong>)</strong> : <em>void</em> |
| public | <strong>isEnabled()</strong> : <em>mixed</em> |

*This class extends [\Grav\Common\GPM\Common\Package](#class-gravcommongpmcommonpackage)*

<hr /><a id="class-gravcommongpmlocalthemes"></a>
### Class: \Grav\Common\GPM\Local\Themes

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Local Themes Constructor</em> |

*This class extends [\Grav\Common\GPM\Local\AbstractPackageCollection](#class-gravcommongpmlocalabstractpackagecollection-abstract)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmlocalplugins"></a>
### Class: \Grav\Common\GPM\Local\Plugins

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Local Plugins Constructor</em> |

*This class extends [\Grav\Common\GPM\Local\AbstractPackageCollection](#class-gravcommongpmlocalabstractpackagecollection-abstract)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmlocalpackages"></a>
### Class: \Grav\Common\GPM\Local\Packages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |

*This class extends [\Grav\Common\GPM\Common\CachedCollection](#class-gravcommongpmcommoncachedcollection)*

*This class implements \ArrayAccess, \Iterator, \Traversable, \Countable, \Serializable*

<hr /><a id="class-gravcommongpmremoteabstractpackagecollection"></a>
### Class: \Grav\Common\GPM\Remote\AbstractPackageCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>null</em> <strong>$repository=null</strong>, <em>bool</em> <strong>$refresh=false</strong>, <em>null</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>AbstractPackageCollection constructor.</em> |
| public | <strong>fetch(</strong><em>bool</em> <strong>$refresh=false</strong>, <em>mixed</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |

*This class extends [\Grav\Common\GPM\Common\AbstractPackageCollection](#class-gravcommongpmcommonabstractpackagecollection-abstract)*

*This class implements \ArrayAccess, \Iterator, \Traversable, \Countable, \Serializable*

<hr /><a id="class-gravcommongpmremotepackage"></a>
### Class: \Grav\Common\GPM\Remote\Package

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$package</strong>, <em>mixed</em> <strong>$package_type=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\GPM\Common\Package](#class-gravcommongpmcommonpackage)*

<hr /><a id="class-gravcommongpmremotethemes"></a>
### Class: \Grav\Common\GPM\Remote\Themes

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool</em> <strong>$refresh=false</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>Local Themes Constructor</em> |

*This class extends [\Grav\Common\GPM\Remote\AbstractPackageCollection](#class-gravcommongpmremoteabstractpackagecollection)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmremoteplugins"></a>
### Class: \Grav\Common\GPM\Remote\Plugins

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool</em> <strong>$refresh=false</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>Local Plugins Constructor</em> |

*This class extends [\Grav\Common\GPM\Remote\AbstractPackageCollection](#class-gravcommongpmremoteabstractpackagecollection)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommongpmremotepackages"></a>
### Class: \Grav\Common\GPM\Remote\Packages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool</em> <strong>$refresh=false</strong>, <em>mixed</em> <strong>$callback=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\GPM\Common\CachedCollection](#class-gravcommongpmcommoncachedcollection)*

*This class implements \ArrayAccess, \Iterator, \Traversable, \Countable, \Serializable*

<hr /><a id="class-gravcommongpmremotegravcore"></a>
### Class: \Grav\Common\GPM\Remote\GravCore

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool</em> <strong>$refresh=false</strong>, <em>null</em> <strong>$callback=null</strong>)</strong> : <em>void</em> |
| public | <strong>getAssets()</strong> : <em>array list of assets</em><br /><em>Returns the list of assets associated to the latest version of Grav</em> |
| public | <strong>getChangelog(</strong><em>string</em> <strong>$diff=null</strong>)</strong> : <em>array changelog list for each version</em><br /><em>Returns the changelog list for each version of Grav</em> |
| public | <strong>getDate()</strong> : <em>string</em><br /><em>Return the release date of the latest Grav</em> |
| public | <strong>getMinPHPVersion()</strong> : <em>null/string</em><br /><em>Returns the minimum PHP version</em> |
| public | <strong>getVersion()</strong> : <em>string</em><br /><em>Returns the latest version of Grav available remotely</em> |
| public | <strong>isSymlink()</strong> : <em>bool</em><br /><em>Is this installation symlinked?</em> |
| public | <strong>isUpdatable()</strong> : <em>mixed</em><br /><em>Determine if this version of Grav is eligible to be updated</em> |

*This class extends [\Grav\Common\GPM\Remote\AbstractPackageCollection](#class-gravcommongpmremoteabstractpackagecollection)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommonhelpersexcerpts"></a>
### Class: \Grav\Common\Helpers\Excerpts

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getExcerptFromHtml(</strong><em>string</em> <strong>$html</strong>, <em>string</em> <strong>$tag</strong>)</strong> : <em>array/null returns nested array excerpt</em><br /><em>Get an Excerpt array from a chunk of HTML</em> |
| public static | <strong>getHtmlFromExcerpt(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>string</em><br /><em>Rebuild HTML tag from an excerpt array</em> |
| public static | <strong>processImageExcerpt(</strong><em>array</em> <strong>$excerpt</strong>, <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>)</strong> : <em>mixed</em><br /><em>Process an image excerpt</em> |
| public static | <strong>processImageHtml(</strong><em>string</em> <strong>$html</strong>, <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>)</strong> : <em>string Returns final HTML string</em><br /><em>Process Grav image media URL from HTML tag</em> |
| public static | <strong>processLinkExcerpt(</strong><em>mixed</em> <strong>$excerpt</strong>, <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>string</em> <strong>$type=`'link'`</strong>)</strong> : <em>mixed</em><br /><em>Process a Link excerpt</em> |
| public static | <strong>processMediaActions(</strong><em>mixed</em> <strong>$medium</strong>, <em>mixed</em> <strong>$url</strong>)</strong> : <em>mixed</em><br /><em>Process media actions</em> |
| protected static | <strong>parseUrl(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>array/bool</em><br /><em>Variation of parse_url() which works also with local streams.</em> |
| protected static | <strong>resolveStream(</strong><em>mixed</em> <strong>$url</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommonhelpersbase32"></a>
### Class: \Grav\Common\Helpers\Base32

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>decode(</strong><em>mixed</em> <strong>$base32</strong>)</strong> : <em>string</em><br /><em>Decode in Base32</em> |
| public static | <strong>encode(</strong><em>mixed</em> <strong>$bytes</strong>)</strong> : <em>string</em><br /><em>Encode in Base32</em> |

<hr /><a id="class-gravcommonhelperstruncator"></a>
### Class: \Grav\Common\Helpers\Truncator

> This file is part of https://github.com/Bluetel-Solutions/twig-truncate-extension Copyright (c) 2015 Bluetel Solutions developers@bluetel.co.uk Copyright (c) 2015 Alex Wilson ajw@bluetel.co.uk For the full copyright and license information, please view the LICENSE file that was distributed with this source code.

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>htmlToDomDocument(</strong><em>string</em> <strong>$html</strong>)</strong> : <em>void</em><br /><em>Builds a DOMDocument object from a string containing HTML.</em> |
| public static | <strong>truncateLetters(</strong><em>string</em> <strong>$html</strong>, <em>integer</em> <strong>$limit</strong>, <em>string</em> <strong>$ellipsis=`''`</strong>)</strong> : <em>string Safe truncated HTML.</em><br /><em>Safely truncates HTML by a given number of letters.</em> |
| public static | <strong>truncateWords(</strong><em>string</em> <strong>$html</strong>, <em>integer</em> <strong>$limit</strong>, <em>string</em> <strong>$ellipsis=`''`</strong>)</strong> : <em>string Safe truncated HTML.</em><br /><em>Safely truncates HTML by a given number of words.</em> |

<hr /><a id="class-gravcommonhelpersexif"></a>
### Class: \Grav\Common\Helpers\Exif

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Exif constructor.</em> |
| public | <strong>getReader()</strong> : <em>mixed</em> |

<hr /><a id="class-gravcommonlanguagelanguage"></a>
### Class: \Grav\Common\Language\Language

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>enabled()</strong> : <em>bool</em><br /><em>Ensure that languages are enabled</em> |
| public | <strong>getActive()</strong> : <em>mixed</em><br /><em>Gets current active language</em> |
| public | <strong>getAvailable()</strong> : <em>string</em><br /><em>Gets a pipe-separated string of available languages</em> |
| public | <strong>getBrowserLanguages(</strong><em>array</em> <strong>$accept_langs=array()</strong>)</strong> : <em>array</em><br /><em>Get the browser accepted languages</em> |
| public | <strong>getDefault()</strong> : <em>mixed</em><br /><em>Gets current default language</em> |
| public | <strong>getFallbackLanguages()</strong> : <em>array</em><br /><em>Gets an array of languages with active first, then fallback languages</em> |
| public | <strong>getFallbackPageExtensions(</strong><em>string/null</em> <strong>$file_ext=null</strong>)</strong> : <em>array</em><br /><em>Gets an array of valid extensions with active first, then fallback extensions</em> |
| public | <strong>getLanguage()</strong> : <em>mixed</em><br /><em>Gets language, active if set, else default</em> |
| public | <strong>getLanguageURLPrefix(</strong><em>null</em> <strong>$lang=null</strong>)</strong> : <em>string</em><br /><em>Get's a URL prefix based on configuration</em> |
| public | <strong>getLanguages()</strong> : <em>array</em><br /><em>Gets the array of supported languages</em> |
| public | <strong>getTranslation(</strong><em>string</em> <strong>$lang</strong>, <em>string</em> <strong>$key</strong>, <em>bool</em> <strong>$array_support=false</strong>)</strong> : <em>string</em><br /><em>Lookup the translation text for a given lang and key</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initialize the default and enabled languages</em> |
| public | <strong>isIncludeDefaultLanguage(</strong><em>null</em> <strong>$lang=null</strong>)</strong> : <em>bool</em><br /><em>Test to see if language is default and language should be included in the URL</em> |
| public | <strong>isLanguageInUrl()</strong> : <em>bool</em><br /><em>Simple getter to tell if a language was found in the URL</em> |
| public | <strong>resetFallbackPageExtensions()</strong> : <em>void</em><br /><em>Resets the page_extensions value. Useful to re-initialize the pages and change site language at runtime, example: ``` $this->grav['language']->setActive('it'); $this->grav['language']->resetFallbackPageExtensions(); $this->grav['pages']->init(); ```</em> |
| public | <strong>setActive(</strong><em>mixed</em> <strong>$lang</strong>)</strong> : <em>bool</em><br /><em>Sets active language manually</em> |
| public | <strong>setActiveFromUri(</strong><em>mixed</em> <strong>$uri</strong>)</strong> : <em>mixed</em><br /><em>Sets the active language based on the first part of the URL</em> |
| public | <strong>setDefault(</strong><em>mixed</em> <strong>$lang</strong>)</strong> : <em>bool</em><br /><em>Sets default language manually</em> |
| public | <strong>setLanguages(</strong><em>mixed</em> <strong>$langs</strong>)</strong> : <em>void</em><br /><em>Sets the current supported languages manually</em> |
| public | <strong>translate(</strong><em>mixed</em> <strong>$args</strong>, <em>array</em> <strong>$languages=null</strong>, <em>bool</em> <strong>$array_support=false</strong>, <em>bool</em> <strong>$html_out=false</strong>)</strong> : <em>string</em><br /><em>Translate a key and possibly arguments into a string using current lang and fallbacks Other arguments can be passed and replaced in the translation with sprintf syntax</em> |
| public | <strong>translateArray(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$index</strong>, <em>null</em> <strong>$languages=null</strong>, <em>bool</em> <strong>$html_out=false</strong>)</strong> : <em>string</em><br /><em>Translate Array</em> |
| public | <strong>validate(</strong><em>mixed</em> <strong>$lang</strong>)</strong> : <em>bool</em><br /><em>Ensures the language is valid and supported</em> |

<hr /><a id="class-gravcommonlanguagelanguagecodes"></a>
### Class: \Grav\Common\Language\LanguageCodes

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getName(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getNames(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getNativeName(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getOrientation(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>mixed</em> |
| public static | <strong>isRtl(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>bool</em> |
| protected static | <strong>get(</strong><em>mixed</em> <strong>$code</strong>, <em>mixed</em> <strong>$type</strong>)</strong> : <em>mixed</em> |

<hr /><a id="class-gravcommonmarkdownparsedown"></a>
### Class: \Grav\Common\Markdown\Parsedown

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>mixed</em> <strong>$page</strong>, <em>mixed</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>Parsedown constructor.</em> |
| public | <strong>addBlockType(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$tag</strong>, <em>bool</em> <strong>$continuable=false</strong>, <em>bool</em> <strong>$completable=false</strong>, <em>mixed</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Block type or override an existing one</em> |
| public | <strong>addInlineType(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$tag</strong>, <em>mixed</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Inline type or override an existing one</em> |
| public | <strong>elementToHtml(</strong><em>array</em> <strong>$Element</strong>)</strong> : <em>string markup</em><br /><em>Make the element function publicly accessible, Medium uses this to render from Twig</em> |
| public | <strong>setSpecialChars(</strong><em>mixed</em> <strong>$special_chars</strong>)</strong> : <em>\Grav\Common\Markdown\$this</em><br /><em>Setter for special chars</em> |
| protected | <strong>blockTwigTag(</strong><em>array</em> <strong>$line</strong>)</strong> : <em>array/null</em><br /><em>Ensure Twig tags are treated as block level items with no <p></p> tags</em> |
| protected | <strong>init(</strong><em>mixed</em> <strong>$page</strong>, <em>mixed</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>Initialization function to setup key variables needed by the MarkdownGravLinkTrait</em> |
| protected | <strong>inlineImage(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineLink(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineSpecialCharacter(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>isBlockCompletable(</strong><em>mixed</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be completable</em> |
| protected | <strong>isBlockContinuable(</strong><em>mixed</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be continuable</em> |

*This class extends \Parsedown*

<hr /><a id="class-gravcommonmarkdownparsedownextra"></a>
### Class: \Grav\Common\Markdown\ParsedownExtra

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>mixed</em> <strong>$page</strong>, <em>mixed</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>ParsedownExtra constructor.</em> |
| public | <strong>addBlockType(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$tag</strong>, <em>bool</em> <strong>$continuable=false</strong>, <em>bool</em> <strong>$completable=false</strong>, <em>mixed</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Block type or override an existing one</em> |
| public | <strong>addInlineType(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$tag</strong>, <em>mixed</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Inline type or override an existing one</em> |
| public | <strong>elementToHtml(</strong><em>array</em> <strong>$Element</strong>)</strong> : <em>string markup</em><br /><em>Make the element function publicly accessible, Medium uses this to render from Twig</em> |
| public | <strong>setSpecialChars(</strong><em>mixed</em> <strong>$special_chars</strong>)</strong> : <em>\Grav\Common\Markdown\$this</em><br /><em>Setter for special chars</em> |
| protected | <strong>blockTwigTag(</strong><em>array</em> <strong>$line</strong>)</strong> : <em>array/null</em><br /><em>Ensure Twig tags are treated as block level items with no <p></p> tags</em> |
| protected | <strong>init(</strong><em>mixed</em> <strong>$page</strong>, <em>mixed</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>Initialization function to setup key variables needed by the MarkdownGravLinkTrait</em> |
| protected | <strong>inlineImage(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineLink(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineSpecialCharacter(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>isBlockCompletable(</strong><em>mixed</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be completable</em> |
| protected | <strong>isBlockContinuable(</strong><em>mixed</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be continuable</em> |

*This class extends \ParsedownExtra*

<hr /><a id="interface-gravcommonmediainterfacesmediaobjectinterface"></a>
### Interface: \Grav\Common\Media\Interfaces\MediaObjectInterface

> Class implements media object interface.

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="interface-gravcommonmediainterfacesmediainterface"></a>
### Interface: \Grav\Common\Media\Interfaces\MediaInterface

> Class implements media interface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getMedia()</strong> : <em>MediaCollectionInterface Collection of associated media.</em><br /><em>Gets the associated media collection.</em> |
| public | <strong>getMediaFolder()</strong> : <em>string/null Media path or null if the object doesn't have media folder.</em><br /><em>Get filesystem path to the associated media.</em> |
| public | <strong>getMediaOrder()</strong> : <em>array Empty array means default ordering.</em><br /><em>Get display order for the associated media.</em> |

<hr /><a id="interface-gravcommonmediainterfacesmediacollectioninterface"></a>
### Interface: \Grav\Common\Media\Interfaces\MediaCollectionInterface

> Class implements media collection interface.

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="class-gravcommonpageheader"></a>
### Class: \Grav\Common\Page\Header

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>)</strong> : <em>void</em><br /><em>Constructor to initialize array.</em> |
| public | <strong>def(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Set default value by using dot notation for nested arrays/objects.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets variable at specified offset.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Set value by using dot notation for nested arrays/objects.</em> |
| public | <strong>undef(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Unset value by using dot notation for nested arrays/objects.</em> |
###### Examples of Header::def()
```
$data->def('this.is.my.nested.variable', 'default');
```
###### Examples of Header::get()
```
$value = $this->get('this.is.my.nested.variable');
```
###### Examples of Header::set()
```
$data->set('this.is.my.nested.variable', $value);
```
###### Examples of Header::undef()
```
$data->undef('this.is.my.nested.variable');
```

*This class implements \ArrayAccess*

<hr /><a id="class-gravcommonpagecollection"></a>
### Class: \Grav\Common\Page\Collection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>array</em> <strong>$params=array()</strong>, <em>[\Grav\Common\Page\Pages](#class-gravcommonpagepages)/null/[\Grav\Common\Page\Pages](#class-gravcommonpagepages)</em> <strong>$pages=null</strong>)</strong> : <em>void</em><br /><em>Collection constructor.</em> |
| public | <strong>add(</strong><em>mixed</em> <strong>$path</strong>, <em>mixed</em> <strong>$slug</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Add a page with path and slug</em> |
| public | <strong>addPage(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Add a single page to a collection</em> |
| public | <strong>adjacentSibling(</strong><em>string</em> <strong>$path</strong>, <em>integer</em> <strong>$direction=1</strong>)</strong> : <em>Page The sibling item.</em><br /><em>Returns the adjacent sibling based on a direction.</em> |
| public | <strong>batch(</strong><em>mixed</em> <strong>$size</strong>)</strong> : <em>array/[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)[]</em><br /><em>Split collection into array of smaller collections.</em> |
| public | <strong>copy()</strong> : <em>\Grav\Common\Page\static</em><br /><em>Create a copy of this collection</em> |
| public | <strong>current()</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em><br /><em>Returns current page.</em> |
| public | <strong>currentPosition(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>Integer the index of the current page.</em><br /><em>Returns the item in the current position.</em> |
| public | <strong>dateRange(</strong><em>mixed</em> <strong>$startDate</strong>, <em>bool</em> <strong>$endDate=false</strong>, <em>bool/mixed</em> <strong>$field=false</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Returns the items between a set of date ranges of either the page date field (default) or an arbitrary datetime page field where end date is optional Dates can be passed in as text that strtotime() can process http://php.net/manual/en/function.strtotime.php</em> |
| public | <strong>intersect(</strong><em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em> <strong>$collection</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Intersect another collection with the current collection</em> |
| public | <strong>isFirst(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>boolean True if item is first.</em><br /><em>Check to see if this item is the first in the collection.</em> |
| public | <strong>isLast(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>boolean True if item is last.</em><br /><em>Check to see if this item is the last in the collection.</em> |
| public | <strong>key()</strong> : <em>mixed</em><br /><em>Returns current slug.</em> |
| public | <strong>merge(</strong><em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em> <strong>$collection</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Merge another collection with the current collection</em> |
| public | <strong>modular()</strong> : <em>Collection The collection with only modular pages</em><br /><em>Creates new collection with only modular pages</em> |
| public | <strong>nextSibling(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>Page The next item.</em><br /><em>Gets the next sibling based on current position.</em> |
| public | <strong>nonModular()</strong> : <em>Collection The collection with only non-modular pages</em><br /><em>Creates new collection with only non-modular pages</em> |
| public | <strong>nonPublished()</strong> : <em>Collection The collection with only non-published pages</em><br /><em>Creates new collection with only non-published pages</em> |
| public | <strong>nonRoutable()</strong> : <em>Collection The collection with only non-routable pages</em><br /><em>Creates new collection with only non-routable pages</em> |
| public | <strong>nonVisible()</strong> : <em>Collection The collection with only non-visible pages</em><br /><em>Creates new collection with only non-visible pages</em> |
| public | <strong>ofOneOfTheseAccessLevels(</strong><em>mixed</em> <strong>$accessLevels</strong>)</strong> : <em>Collection The collection</em><br /><em>Creates new collection with only pages of one of the specified access levels</em> |
| public | <strong>ofOneOfTheseTypes(</strong><em>mixed</em> <strong>$types</strong>)</strong> : <em>Collection The collection</em><br /><em>Creates new collection with only pages of one of the specified types</em> |
| public | <strong>ofType(</strong><em>mixed</em> <strong>$type</strong>)</strong> : <em>Collection The collection</em><br /><em>Creates new collection with only pages of the specified type</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>order(</strong><em>string</em> <strong>$by</strong>, <em>string</em> <strong>$dir=`'asc'`</strong>, <em>array</em> <strong>$manual=null</strong>, <em>string</em> <strong>$sort_flags=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Reorder collection.</em> |
| public | <strong>params()</strong> : <em>array</em><br /><em>Get the collection params</em> |
| public | <strong>prevSibling(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>Page The previous item.</em><br /><em>Gets the previous sibling based on current position.</em> |
| public | <strong>published()</strong> : <em>Collection The collection with only published pages</em><br /><em>Creates new collection with only published pages</em> |
| public | <strong>remove(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/string/null</em> <strong>$key=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Remove item from the list.</em> |
| public | <strong>routable()</strong> : <em>Collection The collection with only routable pages</em><br /><em>Creates new collection with only routable pages</em> |
| public | <strong>setParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Set parameters to the Collection</em> |
| public | <strong>toExtendedArray()</strong> : <em>array</em><br /><em>Get the extended version of this Collection with each page keyed by route</em> |
| public | <strong>visible()</strong> : <em>Collection The collection with only visible pages</em><br /><em>Creates new collection with only visible pages</em> |

*This class extends [\Grav\Common\Iterator](#class-gravcommoniterator)*

*This class implements \Serializable, \Countable, \Traversable, \Iterator, \ArrayAccess*

<hr /><a id="class-gravcommonpagetypes"></a>
### Class: \Grav\Common\Page\Types

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>)</strong> : <em>void</em><br /><em>Constructor to initialize array.</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Implements Countable interface.</em> |
| public | <strong>current()</strong> : <em>mixed Can return any type.</em><br /><em>Returns the current element.</em> |
| public | <strong>key()</strong> : <em>mixed Returns scalar on success, or NULL on failure.</em><br /><em>Returns the key of the current element.</em> |
| public | <strong>modularSelect()</strong> : <em>void</em> |
| public | <strong>next()</strong> : <em>void</em><br /><em>Moves the current position to the next element.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>pageSelect()</strong> : <em>void</em> |
| public | <strong>register(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$blueprint=null</strong>)</strong> : <em>void</em> |
| public | <strong>rewind()</strong> : <em>void</em><br /><em>Rewinds back to the first element of the Iterator.</em> |
| public | <strong>scanBlueprints(</strong><em>mixed</em> <strong>$uri</strong>)</strong> : <em>void</em> |
| public | <strong>scanTemplates(</strong><em>mixed</em> <strong>$uri</strong>)</strong> : <em>void</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=3</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>valid()</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>This method is called after Iterator::rewind() and Iterator::next() to check if the current position is valid.</em> |

*This class implements \ArrayAccess, \Iterator, \Traversable, \Countable*

<hr /><a id="class-gravcommonpagepage"></a>
### Class: \Grav\Common\Page\Page

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Page Object Constructor</em> |
| public | <strong>active()</strong> : <em>bool True if it is active</em><br /><em>Returns whether or not this page is the currently active page requested via the URL.</em> |
| public | <strong>activeChild()</strong> : <em>bool True if active child exists</em><br /><em>Returns whether or not this URI's URL contains the URL of the active page. Or in other words, is this page's URL in the current URL</em> |
| public | <strong>addContentMeta(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Add an entry to the page's contentMeta array</em> |
| public | <strong>adjacentSibling(</strong><em>integer</em> <strong>$direction=1</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/bool the sibling page</em><br /><em>Returns the adjacent sibling based on a direction.</em> |
| public | <strong>ancestor(</strong><em>bool</em> <strong>$lookup=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage) page you were looking for if it exists</em><br /><em>Helper method to return an ancestor page.</em> |
| public | <strong>blueprintName()</strong> : <em>string</em><br /><em>Get the blueprint name for this page.  Use the blueprint form field if set</em> |
| public | <strong>blueprints()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get blueprints for the page.</em> |
| public | <strong>cacheControl(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Gets and sets the cache-control property.  If not set it will return the default value (null) https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control for more details on valid options</em> |
| public | <strong>cachePageContent()</strong> : <em>void</em><br /><em>Fires the onPageContentProcessed event, and caches the page content using a unique ID for the page</em> |
| public | <strong>canonical(</strong><em>bool</em> <strong>$include_lang=true</strong>)</strong> : <em>string</em><br /><em>Returns the canonical URL for a page</em> |
| public | <strong>childType()</strong> : <em>string</em><br /><em>Returns child page type.</em> |
| public | <strong>children()</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Returns children of this page.</em> |
| public | <strong>collection(</strong><em>string/string/array</em> <strong>$params=`'content'`</strong>, <em>bool/boolean</em> <strong>$pagination=true</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get a collection of pages in the current context.</em> |
| public | <strong>content(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string Content</em><br /><em>Gets and Sets the content based on content portion of the .md file</em> |
| public | <strong>contentMeta()</strong> : <em>mixed</em><br /><em>Get the contentMeta array and initialize content first if it's not already</em> |
| public | <strong>copy(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$parent</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Prepare a copy from the page. Copies also everything that's under the current page. Returns a new Page object for the copy. You need to call $this->save() in order to perform the move.</em> |
| public | <strong>currentPosition()</strong> : <em>Integer the index of the current page.</em><br /><em>Returns the item in the current position.</em> |
| public | <strong>date(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int unix timestamp representation of the date</em><br /><em>Gets and sets the date for this Page object. This is typically passed in via the page headers</em> |
| public | <strong>dateformat(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string string representation of a date format</em><br /><em>Gets and sets the date format for this Page object. This is typically passed in via the page headers using typical PHP date string structure - http://php.net/manual/en/function.date.php</em> |
| public | <strong>debugger()</strong> : <em>mixed</em><br /><em>Returns the state of the debugger override etting for this page</em> |
| public | <strong>eTag(</strong><em>boolean</em> <strong>$var=null</strong>)</strong> : <em>boolean show etag header</em><br /><em>Gets and sets the option to show the etag header for the page.</em> |
| public | <strong>evaluate(</strong><em>string/array</em> <strong>$value</strong>, <em>bool</em> <strong>$only_published=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Returns whether the page exists in the filesystem.</em> |
| public | <strong>expires(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int The expires value</em><br /><em>Gets and sets the expires field. If not set will return the default</em> |
| public | <strong>extension(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null/string</em><br /><em>Gets and sets the extension field.</em> |
| public | <strong>extra()</strong> : <em>array</em><br /><em>Get unknown header variables.</em> |
| public | <strong>file()</strong> : <em>\Grav\Common\Page\MarkdownFile/null</em><br /><em>Get file object to the page.</em> |
| public | <strong>filePath(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null the file path</em><br /><em>Gets and sets the path to the .md file for this Page object.</em> |
| public | <strong>filePathClean()</strong> : <em>string The relative file path</em><br /><em>Gets the relative path to the .md file</em> |
| public | <strong>filter()</strong> : <em>void</em><br /><em>Filter page header from illegal contents.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$url</strong>, <em>bool</em> <strong>$all=false</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage) page you were looking for if it exists</em><br /><em>Helper method to return a page.</em> |
| public | <strong>folder(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null</em><br /><em>Get/set the folder.</em> |
| public | <strong>folderExists()</strong> : <em>bool</em><br /><em>Returns whether or not the current folder exists</em> |
| public | <strong>frontmatter(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets and Sets the page frontmatter</em> |
| public | <strong>getAction()</strong> : <em>string The Action string.</em><br /><em>Gets the action.</em> |
| public | <strong>getContentMeta(</strong><em>null</em> <strong>$name=null</strong>)</strong> : <em>mixed</em><br /><em>Return the whole contentMeta array as it currently stands</em> |
| public | <strong>getMedia()</strong> : <em>MediaCollectionInterface Representation of associated media.</em><br /><em>Gets the associated media collection.</em> |
| public | <strong>getMediaFolder()</strong> : <em>string/null</em><br /><em>Get filesystem path to the associated media.</em> |
| public | <strong>getMediaOrder()</strong> : <em>array Empty array means default ordering.</em><br /><em>Get display order for the associated media.</em> |
| public | <strong>getMediaUri()</strong> : <em>null/string</em><br /><em>Get URI ot the associated media. Method will return null if path isn't URI.</em> |
| public | <strong>getOriginal()</strong> : <em>Page The original version of the page.</em><br /><em>Gets the Page Unmodified (original) version of the page.</em> |
| public | <strong>getRawContent()</strong> : <em>string the current page content</em><br /><em>Needed by the onPageContentProcessed event to get the raw page content</em> |
| public | <strong>header(</strong><em>object/array</em> <strong>$var=null</strong>)</strong> : <em>object the current YAML configuration</em><br /><em>Gets and Sets the header based on the YAML configuration at the top of the .md file</em> |
| public | <strong>home()</strong> : <em>bool True if it is the homepage</em><br /><em>Returns whether or not this page is the currently configured home page.</em> |
| public | <strong>id(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the identifier</em><br /><em>Gets and sets the identifier for this Page object.</em> |
| public | <strong>inherited(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em><br /><em>Helper method to return an ancestor page to inherit from. The current page object is returned.</em> |
| public | <strong>inheritedField(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>array</em><br /><em>Helper method to return an ancestor field only to inherit from. The first occurrence of an ancestor field will be returned if at all.</em> |
| public | <strong>init(</strong><em>[\SplFileInfo](http://php.net/manual/en/class.splfileinfo.php)</em> <strong>$file</strong>, <em>string</em> <strong>$extension=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Initializes the page instance variables based on a file</em> |
| public | <strong>isDir()</strong> : <em>bool True if its a directory</em><br /><em>Returns whether or not this Page object is a directory or a page.</em> |
| public | <strong>isFirst()</strong> : <em>boolean True if item is first.</em><br /><em>Check to see if this item is the first in an array of sub-pages.</em> |
| public | <strong>isLast()</strong> : <em>boolean True if item is last</em><br /><em>Check to see if this item is the last in an array of sub-pages.</em> |
| public | <strong>isPage()</strong> : <em>bool True if its a page with a .md file associated</em><br /><em>Returns whether or not this Page object has a .md file associated with it or if its just a directory.</em> |
| public | <strong>language(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>mixed</em><br /><em>Get page language</em> |
| public | <strong>lastModified(</strong><em>boolean</em> <strong>$var=null</strong>)</strong> : <em>boolean show last_modified header</em><br /><em>Gets and sets the option to show the last_modified header for the page.</em> |
| public | <strong>link(</strong><em>bool</em> <strong>$include_host=false</strong>)</strong> : <em>string the permalink</em><br /><em>Gets the URL for a page - alias of url().</em> |
| public | <strong>maxCount(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int the maximum number of sub-pages</em><br /><em>Gets and sets the maxCount field which describes how many sub-pages should be displayed if the sub_pages header property is set for this page object.</em> |
| public | <strong>media(</strong><em>[\Grav\Common\Page\Media](#class-gravcommonpagemedia)</em> <strong>$var=null</strong>)</strong> : <em>Media Representation of associated media.</em><br /><em>Gets and sets the associated media as found in the page folder.</em> |
| public | <strong>menu(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the menu field for the page</em><br /><em>Gets and sets the menu name for this Page.  This is the text that can be used specifically for navigation. If no menu field is set, it will use the title()</em> |
| public | <strong>metadata(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an Array of metadata values for the page</em><br /><em>Function to merge page metadata tags and build an array of Metadata objects that can then be rendered in the page.</em> |
| public | <strong>modified(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int modified unix timestamp</em><br /><em>Gets and sets the modified timestamp.</em> |
| public | <strong>modifyHeader(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Modify a header value directly</em> |
| public | <strong>modular(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if modular_twig</em><br /><em>Gets and sets the modular var that helps identify this page is a modular child</em> |
| public | <strong>modularTwig(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if modular_twig</em><br /><em>Gets and sets the modular_twig var that helps identify this page as a modular child page that will need twig processing handled differently from a regular page.</em> |
| public | <strong>move(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$parent</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Prepare move page to new location. Moves also everything that's under the current page. You need to call $this->save() in order to perform the move.</em> |
| public | <strong>name(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string The name of this page.</em><br /><em>Gets and sets the name field.  If no name field is set, it will return 'default.md'.</em> |
| public | <strong>nextSibling()</strong> : <em>Page the next Page item</em><br /><em>Gets the next sibling based on current position.</em> |
| public | <strong>order(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int/bool</em><br /><em>Get/set order number of this page.</em> |
| public | <strong>orderBy(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string supported options include "default", "title", "date", and "folder"</em><br /><em>Gets and sets the order by which the sub-pages should be sorted. default - is the order based on the file system, ie 01.Home before 02.Advark title - is the order based on the title set in the pages date - is the order based on the date set in the pages folder - is the order based on the name of the folder with any numerics omitted</em> |
| public | <strong>orderDir(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the order, either "asc" or "desc"</em><br /><em>Gets and sets the order by which any sub-pages should be sorted.</em> |
| public | <strong>orderManual(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>array</em><br /><em>Gets the manual order set in the header.</em> |
| public | <strong>parent(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$var=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null the parent page object if it exists.</em><br /><em>Gets and Sets the parent object for this page</em> |
| public | <strong>path(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null the path</em><br /><em>Gets and sets the path to the folder where the .md for this Page object resides. This is equivalent to the filePath but without the filename.</em> |
| public | <strong>permalink()</strong> : <em>string The permalink.</em><br /><em>Gets the URL with host information, aka Permalink.</em> |
| public | <strong>prevSibling()</strong> : <em>Page the previous Page item</em><br /><em>Gets the previous sibling based on current position.</em> |
| public | <strong>process(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an Array of name value pairs where the name is the process and value is true or false</em><br /><em>Gets and Sets the process setup for this Page. This is multi-dimensional array that consists of a simple array of arrays with the form array("markdown"=>true) for example</em> |
| public | <strong>publishDate(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int unix timestamp representation of the date</em><br /><em>Gets and Sets the Page publish date</em> |
| public | <strong>published(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is published</em><br /><em>Gets and Sets whether or not this Page is considered published</em> |
| public | <strong>raw(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string Raw content string</em><br /><em>Gets and Sets the raw data</em> |
| public | <strong>rawMarkdown(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Gets and Sets the Page raw content</em> |
| public | <strong>rawRoute(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null/string</em><br /><em>Gets and Sets the page raw route</em> |
| public | <strong>redirect(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets the redirect set in the header.</em> |
| public | <strong>relativePagePath()</strong> : <em>void</em><br /><em>Returns the clean path to the page file</em> |
| public | <strong>root()</strong> : <em>bool True if it is the root</em><br /><em>Returns whether or not this page is the root node of the pages tree.</em> |
| public | <strong>routable(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is routable</em><br /><em>Gets and Sets whether or not this Page is routable, ie you can reach it via a URL. The page must be *routable* and *published*</em> |
| public | <strong>route(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string The route for the Page.</em><br /><em>Gets the route for the page based on the route headers if available, else from the parents route and the current Page's slug.</em> |
| public | <strong>routeAliases(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array The route aliases for the Page.</em><br /><em>Gets the route aliases for the page based on page headers.</em> |
| public | <strong>routeCanonical(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>bool/string</em><br /><em>Gets the canonical route for this page if its set. If provided it will use that value, else if it's `true` it will use the default route.</em> |
| public | <strong>save(</strong><em>bool/bool/mixed</em> <strong>$reorder=true</strong>)</strong> : <em>void</em><br /><em>Save page if there's a file assigned to it.</em> |
| public | <strong>setContentMeta(</strong><em>mixed</em> <strong>$content_meta</strong>)</strong> : <em>mixed</em><br /><em>Sets the whole content meta array in one shot</em> |
| public | <strong>setRawContent(</strong><em>mixed</em> <strong>$content</strong>)</strong> : <em>void</em><br /><em>Needed by the onPageContentProcessed event to set the raw page content</em> |
| public | <strong>setSummary(</strong><em>string</em> <strong>$summary</strong>)</strong> : <em>void</em><br /><em>Sets the summary of the page</em> |
| public | <strong>shouldProcess(</strong><em>string</em> <strong>$process</strong>)</strong> : <em>bool whether or not the processing method is enabled for this Page</em><br /><em>Gets the configured state of the processing method.</em> |
| public | <strong>slug(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the slug</em><br /><em>Gets and Sets the slug for the Page. The slug is used in the URL routing. If not set it uses the parent folder from the path</em> |
| public | <strong>ssl(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>void</em> |
| public | <strong>summary(</strong><em>int</em> <strong>$size=null</strong>, <em>bool/boolean</em> <strong>$textOnly=false</strong>)</strong> : <em>string</em><br /><em>Get the summary.</em> |
| public | <strong>taxonomy(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an array of taxonomies</em><br /><em>Gets and sets the taxonomy array which defines which taxonomies this page identifies itself with.</em> |
| public | <strong>template(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the template name</em><br /><em>Gets and sets the template field. This is used to find the correct Twig template file to render. If no field is set, it will return the name without the .md extension</em> |
| public | <strong>templateFormat(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Allows a page to override the output render format, usually the extension provided in the URL. (e.g. `html`, `json`, `xml`, etc).</em> |
| public | <strong>title(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the title of the Page</em><br /><em>Gets and sets the title for this Page.  If no title is set, it will use the slug() to get a name</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert page to an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert page to JSON encoded string.</em> |
| public | <strong>toYaml()</strong> : <em>string</em><br /><em>Convert page to YAML encoded string.</em> |
| public | <strong>topParent()</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null the top parent page object if it exists.</em><br /><em>Gets the top parent object for this page</em> |
| public | <strong>translatedLanguages(</strong><em>bool</em> <strong>$onlyPublished=false</strong>)</strong> : <em>array the page translated languages</em><br /><em>Return an array with the routes of other translated languages</em> |
| public | <strong>unpublishDate(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int/null unix timestamp representation of the date</em><br /><em>Gets and Sets the Page unpublish date</em> |
| public | <strong>unsetRouteSlug()</strong> : <em>void</em><br /><em>Helper method to clear the route out so it regenerates next time you use it</em> |
| public | <strong>untranslatedLanguages(</strong><em>bool</em> <strong>$includeUnpublished=false</strong>)</strong> : <em>array the page untranslated languages</em><br /><em>Return an array listing untranslated languages available</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$include_host=false</strong>, <em>bool</em> <strong>$canonical=false</strong>, <em>bool</em> <strong>$include_base=true</strong>, <em>bool</em> <strong>$raw_route=false</strong>)</strong> : <em>string The url.</em><br /><em>Gets the url for the Page.</em> |
| public | <strong>urlExtension()</strong> : <em>string The extension of this page. For example `.html`</em><br /><em>Returns the page extension, got from the page `url_extension` config and falls back to the system config `system.pages.append_url_extension`.</em> |
| public | <strong>validate()</strong> : <em>void</em><br /><em>Validate page header.</em> |
| public | <strong>value(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Get value from a page variable (used mostly for creating edit forms).</em> |
| public | <strong>visible(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is visible</em><br /><em>Gets and Sets whether or not this Page is visible for navigation</em> |
| protected | <strong>adjustRouteCase(</strong><em>mixed</em> <strong>$route</strong>)</strong> : <em>void</em> |
| protected | <strong>cleanPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string the path</em><br /><em>Cleans the path.</em> |
| protected | <strong>clearMediaCache()</strong> : <em>void</em><br /><em>Clear media cache.</em> |
| protected | <strong>doRelocation()</strong> : <em>void</em><br /><em>Moves or copies the page in filesystem.</em> |
| protected | <strong>doReorder(</strong><em>mixed</em> <strong>$new_order</strong>)</strong> : <em>void</em><br /><em>Reorders all siblings according to a defined order</em> |
| protected | <strong>getCacheKey()</strong> : <em>string</em> |
| protected | <strong>getInheritedParams(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>array</em><br /><em>Method that contains shared logic for inherited() and inheritedField()</em> |
| protected | <strong>getMediaCache()</strong> : <em>[\Grav\Common\Cache](#class-gravcommoncache)</em> |
| protected | <strong>processFrontmatter()</strong> : <em>void</em> |
| protected | <strong>processMarkdown()</strong> : <em>void</em><br /><em>Process the Markdown content.  Uses Parsedown or Parsedown Extra depending on configuration</em> |
| protected | <strong>setMedia(</strong><em>[\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface)</em> <strong>$media</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Sets the associated media collection.</em> |
| protected | <strong>setPublishState()</strong> : <em>void</em> |

*This class implements [\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)*

<hr /><a id="class-gravcommonpagemedia"></a>
### Class: \Grav\Common\Page\Media

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$media_order=null</strong>)</strong> : <em>void</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Initialize static variables on unserialize.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| public | <strong>path()</strong> : <em>mixed</em><br /><em>Enable accessing the media path</em> |
| protected | <strong>init()</strong> : <em>void</em><br /><em>Initialize class.</em> |

*This class extends [\Grav\Common\Page\Medium\AbstractMedia](#class-gravcommonpagemediumabstractmedia-abstract)*

*This class implements [\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface), \ArrayAccess, \Countable*

<hr /><a id="class-gravcommonpagepages"></a>
### Class: \Grav\Common\Page\Pages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$c</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>accessLevels()</strong> : <em>array</em><br /><em>Get access levels of the site pages</em> |
| public | <strong>addPage(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>string</em> <strong>$route=null</strong>)</strong> : <em>void</em><br /><em>Adds a page and assigns a route to it.</em> |
| public | <strong>all(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$current=null</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get all pages</em> |
| public | <strong>ancestor(</strong><em>string</em> <strong>$route</strong>, <em>string</em> <strong>$path=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null</em><br /><em>Get a page ancestor.</em> |
| public | <strong>base(</strong><em>string</em> <strong>$path=null</strong>)</strong> : <em>string</em><br /><em>Get or set base path for the pages.</em> |
| public | <strong>baseRoute(</strong><em>string</em> <strong>$lang=null</strong>)</strong> : <em>string</em><br /><em>Get base route for Grav pages.</em> |
| public | <strong>baseUrl(</strong><em>string</em> <strong>$lang=null</strong>, <em>bool/null</em> <strong>$absolute=null</strong>)</strong> : <em>string</em><br /><em>Get base URL for Grav pages.</em> |
| public | <strong>blueprints(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get a blueprint for a page type.</em> |
| public | <strong>children(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get children of the path.</em> |
| public | <strong>dispatch(</strong><em>string</em> <strong>$route</strong>, <em>bool</em> <strong>$all=false</strong>, <em>bool</em> <strong>$redirect=true</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null</em><br /><em>Dispatch URI to a page.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$route</strong>, <em>bool</em> <strong>$all=false</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null</em><br /><em>alias method to return find a page.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em><br /><em>Get a page instance.</em> |
| public static | <strong>getHomeRoute()</strong> : <em>string</em><br /><em>Gets the home route</em> |
| public | <strong>getList(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$current=null</strong>, <em>int</em> <strong>$level</strong>, <em>bool</em> <strong>$rawRoutes=false</strong>, <em>bool</em> <strong>$showAll=true</strong>, <em>bool</em> <strong>$showFullpath=false</strong>, <em>bool</em> <strong>$showSlug=false</strong>, <em>bool</em> <strong>$showModular=false</strong>, <em>bool</em> <strong>$limitLevels=false</strong>)</strong> : <em>array</em><br /><em>Get list of route/title of all pages.</em> |
| public | <strong>getPagesCacheId()</strong> : <em>mixed</em><br /><em>Get the Pages cache ID this is particularly useful to know if pages have changed and you want to sync another cache with pages cache - works best in `onPagesInitialized()`</em> |
| public static | <strong>getTypes()</strong> : <em>[\Grav\Common\Page\Types](#class-gravcommonpagetypes)</em><br /><em>Get available page types.</em> |
| public | <strong>homeUrl(</strong><em>string</em> <strong>$lang=null</strong>, <em>bool</em> <strong>$absolute=null</strong>)</strong> : <em>string</em><br /><em>Get home URL for Grav site.</em> |
| public | <strong>inherited(</strong><em>string</em> <strong>$route</strong>, <em>string</em> <strong>$field=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null</em><br /><em>Get a page ancestor trait.</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Class initialization. Must be called before using this class.</em> |
| public | <strong>instances()</strong> : <em>array/[\Grav\Common\Page\Page](#class-gravcommonpagepage)[]</em><br /><em>Returns a list of all pages.</em> |
| public | <strong>lastModified(</strong><em>int</em> <strong>$modified=null</strong>)</strong> : <em>int/null</em><br /><em>Get or set last modification time.</em> |
| public static | <strong>modularTypes()</strong> : <em>array</em><br /><em>Get available page types.</em> |
| public static | <strong>pageTypes()</strong> : <em>array</em><br /><em>Get template types based on page type (standard or modular)</em> |
| public static | <strong>parents()</strong> : <em>array</em><br /><em>Get available parents routes</em> |
| public static | <strong>parentsRawRoutes()</strong> : <em>array</em><br /><em>Get available parents raw routes.</em> |
| public static | <strong>resetHomeRoute()</strong> : <em>void</em><br /><em>Needed for testing where we change the home route via config</em> |
| public | <strong>resetPages(</strong><em>mixed</em> <strong>$pages_dir</strong>)</strong> : <em>void</em><br /><em>Accessible method to manually reset the pages cache</em> |
| public | <strong>root()</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em><br /><em>Get root page.</em> |
| public | <strong>route(</strong><em>string</em> <strong>$route=`'/'`</strong>, <em>string</em> <strong>$lang=null</strong>)</strong> : <em>string</em><br /><em>Get route for Grav site.</em> |
| public | <strong>routes()</strong> : <em>array</em><br /><em>Returns a list of all routes.</em> |
| public | <strong>sort(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>string</em> <strong>$order_by=null</strong>, <em>string</em> <strong>$order_dir=null</strong>, <em>mixed</em> <strong>$sort_flags=null</strong>)</strong> : <em>array</em><br /><em>Sort sub-pages in a page.</em> |
| public | <strong>sortCollection(</strong><em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em> <strong>$collection</strong>, <em>mixed</em> <strong>$orderBy</strong>, <em>string</em> <strong>$orderDir=`'asc'`</strong>, <em>null</em> <strong>$orderManual=null</strong>, <em>mixed</em> <strong>$sort_flags=null</strong>)</strong> : <em>array</em> |
| public static | <strong>types()</strong> : <em>array</em><br /><em>Get available page types.</em> |
| public | <strong>url(</strong><em>string</em> <strong>$route=`'/'`</strong>, <em>string</em> <strong>$lang=null</strong>, <em>bool</em> <strong>$absolute=null</strong>)</strong> : <em>string</em><br /><em>Get URL for Grav site.</em> |
| protected | <strong>arrayShuffle(</strong><em>array</em> <strong>$list</strong>)</strong> : <em>array</em><br /><em>Shuffles an associative array</em> |
| protected | <strong>buildPages()</strong> : <em>void</em><br /><em>Builds pages.</em> |
| protected | <strong>buildRoutes()</strong> : <em>void</em> |
| protected | <strong>buildSort(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$pages</strong>, <em>string</em> <strong>$order_by=`'default'`</strong>, <em>array</em> <strong>$manual=null</strong>, <em>int</em> <strong>$sort_flags=null</strong>)</strong> : <em>void</em> |
| protected | <strong>recurse(</strong><em>string</em> <strong>$directory</strong>, <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)/null/[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$parent=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em><br /><em>Recursive function to load & build page relationships.</em> |

<hr /><a id="interface-gravcommonpageinterfacespageinterface"></a>
### Interface: \Grav\Common\Page\Interfaces\PageInterface

> Class implements page interface.

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="class-gravcommonpagemediumvideomedium"></a>
### Class: \Grav\Common\Page\Medium\VideoMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>autoplay(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the autoplay attribute</em> |
| public | <strong>controls(</strong><em>bool</em> <strong>$display=true</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set or remove the HTML5 default controls</em> |
| public | <strong>loop(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the loop attribute</em> |
| public | <strong>muted(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the muted attribute</em> |
| public | <strong>playsinline(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the playsinline attribute</em> |
| public | <strong>poster(</strong><em>mixed</em> <strong>$urlImage</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the video's poster image</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset medium.</em> |
| public | <strong>resize(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Resize media by setting attributes</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediummediumfactory"></a>
### Class: \Grav\Common\Page\Medium\MediumFactory

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>fromArray(</strong><em>array</em> <strong>$items=array()</strong>, <em>\Grav\Common\Page\Medium\Blueprint/null/[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> <strong>$blueprint=null</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create Medium from array of parameters</em> |
| public static | <strong>fromFile(</strong><em>string</em> <strong>$file</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create Medium from a file</em> |
| public static | <strong>scaledFromMedium(</strong><em>[\Grav\Common\Page\Medium\ImageMedium](#class-gravcommonpagemediumimagemedium)</em> <strong>$medium</strong>, <em>int</em> <strong>$from</strong>, <em>int</em> <strong>$to</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)/array</em><br /><em>Create a new ImageMedium by scaling another ImageMedium object.</em> |

<hr /><a id="class-gravcommonpagemediumlink"></a>
### Class: \Grav\Common\Page\Medium\Link

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>mixed</em><br /><em>Forward the call to the source element</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$attributes</strong>, <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em> <strong>$medium</strong>)</strong> : <em>void</em><br /><em>Construct.</em> |
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Get an element (is array) that can be rendered by the Parsedown engine</em> |

*This class implements [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface)*

<hr /><a id="class-gravcommonpagemediumimagefile"></a>
### Class: \Grav\Common\Page\Medium\ImageFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>cacheFile(</strong><em>string</em> <strong>$type=`'jpg'`</strong>, <em>int</em> <strong>$quality=80</strong>, <em>bool</em> <strong>$actual=false</strong>)</strong> : <em>string</em><br /><em>This is the same as the Gregwar Image class except this one fires a Grav Event on creation of new cached file</em> |
| public | <strong>clearOperations()</strong> : <em>void</em><br /><em>Clear previously applied operations</em> |

*This class extends \Gregwar\Image\Image*

<hr /><a id="class-gravcommonpagemediummedium"></a>
### Class: \Grav\Common\Page\Medium\Medium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allow any action to be called on this medium from twig or markdown</em> |
| public | <strong>__clone()</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> <strong>$blueprint=null</strong>)</strong> : <em>void</em><br /><em>Construct.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Return string representation of the object (html).</em> |
| public | <strong>addAlternative(</strong><em>mixed</em> <strong>$ratio</strong>, <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em> <strong>$alternative</strong>)</strong> : <em>void</em><br /><em>Add alternative Medium to this Medium.</em> |
| public | <strong>addMetaFile(</strong><em>mixed</em> <strong>$filepath</strong>)</strong> : <em>void</em><br /><em>Add meta file for the medium.</em> |
| public | <strong>classes()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Add a class to the element from Markdown or Twig Example: ![Example](myimg.png?classes=float-left) or ![Example](myimg.png?classes=myclass1,myclass2)</em> |
| public | <strong>copy()</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create a copy of this media object</em> |
| public | <strong>display(</strong><em>string</em> <strong>$mode=`'source'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch display mode.</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Check if this medium exists or not</em> |
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>id(</strong><em>mixed</em> <strong>$id</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Add an id to the element from Markdown or Twig Example: ![Example](myimg.png?id=primary-img)</em> |
| public | <strong>lightbox(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link with lightbox enabled</em> |
| public | <strong>link(</strong><em>bool/boolean</em> <strong>$reset=true</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link</em> |
| public | <strong>meta()</strong> : <em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em><br /><em>Return just metadata from the Medium object</em> |
| public | <strong>metadata()</strong> : <em>array</em><br /><em>Returns an array containing just the metadata</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Get an element (is array) that can be rendered by the Parsedown engine</em> |
| public | <strong>path(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string path to file</em><br /><em>Return PATH to file.</em> |
| public | <strong>querystring(</strong><em>string</em> <strong>$querystring=null</strong>, <em>bool/boolean</em> <strong>$withQuestionmark=true</strong>)</strong> : <em>string</em><br /><em>Get/set querystring for the file's url</em> |
| public | <strong>relativePath(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>mixed</em><br /><em>Return the relative path to file</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset medium.</em> |
| public | <strong>style(</strong><em>string</em> <strong>$style</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to add an inline style attribute from Markdown or Twig Example: ![Example](myimg.png?style=float:left)</em> |
| public | <strong>thumbnail(</strong><em>string</em> <strong>$type=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch thumbnail.</em> |
| public | <strong>thumbnailExists(</strong><em>string</em> <strong>$type=`'page'`</strong>)</strong> : <em>bool</em><br /><em>Helper method to determine if this media item has a thumbnail or not</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return URL to file.</em> |
| public | <strong>urlHash(</strong><em>string</em> <strong>$hash=null</strong>, <em>bool/boolean</em> <strong>$withHash=true</strong>)</strong> : <em>string</em><br /><em>Get/set hash for the file's url</em> |
| protected | <strong>getThumbnail()</strong> : <em>[\Grav\Common\Page\Medium\ThumbnailImageMedium](#class-gravcommonpagemediumthumbnailimagemedium)</em><br /><em>Get the thumbnail Medium object</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |
| protected | <strong>textParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for text display mode</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)*

<hr /><a id="class-gravcommonpagemediumaudiomedium"></a>
### Class: \Grav\Common\Page\Medium\AudioMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>autoplay(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the autoplay attribute</em> |
| public | <strong>controls(</strong><em>bool</em> <strong>$display=true</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set or remove the HTML5 default controls</em> |
| public | <strong>controlsList(</strong><em>mixed</em> <strong>$controlsList</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the controlsList behaviour Separate multiple values with a hyphen</em> |
| public | <strong>loop(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the loop attribute</em> |
| public | <strong>muted(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the muted attribute</em> |
| public | <strong>preload(</strong><em>mixed</em> <strong>$preload</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the preload behaviour</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset medium.</em> |
| public | <strong>resize(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Resize media by setting attributes</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediumimagemedium"></a>
### Class: \Grav\Common\Page\Medium\ImageMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this/mixed</em><br /><em>Forward the call to the image processing method.</em> |
| public | <strong>__clone()</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> <strong>$blueprint=null</strong>)</strong> : <em>void</em><br /><em>Construct.</em> |
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>addMetaFile(</strong><em>mixed</em> <strong>$filepath</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Add meta file for the medium.</em> |
| public | <strong>cache()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Simply processes with no extra methods.  Useful for triggering events.</em> |
| public | <strong>clearAlternatives()</strong> : <em>void</em><br /><em>Clear out the alternatives</em> |
| public | <strong>derivatives(</strong><em>int/int[]</em> <strong>$min_width</strong>, <em>mixed</em> <strong>$max_width=2500</strong>, <em>mixed</em> <strong>$step=200</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Generate alternative image widths, using either an array of integers, or a min width, a max width, and a step parameter to fill out the necessary widths. Existing image alternatives won't be overwritten.</em> |
| public | <strong>filter(</strong><em>string</em> <strong>$filter=`'image.filters.default'`</strong>)</strong> : <em>void</em><br /><em>Filter image by using user defined filter parameters.</em> |
| public | <strong>format(</strong><em>string</em> <strong>$format</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Sets image output format.</em> |
| public | <strong>getImagePrettyName()</strong> : <em>mixed</em> |
| public | <strong>height(</strong><em>string/mixed</em> <strong>$value=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the height attribute from Markdown or Twig Examples: ![Example](myimg.png?width=200&height=400) ![Example](myimg.png?resize=100,200&width=100&height=200) ![Example](myimg.png?width=auto&height=auto) ![Example](myimg.png?width&height) {{ page.media['myimg.png'].width().height().html }} {{ page.media['myimg.png'].resize(100,200).width(100).height(200).html }}</em> |
| public | <strong>higherQualityAlternative()</strong> : <em>ImageMedium the alternative version with higher quality</em><br /><em>Return the image higher quality version</em> |
| public | <strong>lightbox(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link with lightbox enabled</em> |
| public | <strong>link(</strong><em>bool/boolean</em> <strong>$reset=true</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link</em> |
| public | <strong>path(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string path to image</em><br /><em>Return PATH to image.</em> |
| public | <strong>quality(</strong><em>int</em> <strong>$quality=null</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Sets or gets the quality of the image</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset image.</em> |
| public | <strong>setImagePrettyName(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Allows the ability to override the Inmage's Pretty name stored in cache</em> |
| public | <strong>sizes(</strong><em>string</em> <strong>$sizes=null</strong>)</strong> : <em>string</em><br /><em>Set or get sizes parameter for srcset media action</em> |
| public | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |
| public | <strong>srcset(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return srcset string for this Medium and its alternatives.</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return URL to image.</em> |
| public | <strong>width(</strong><em>string/mixed</em> <strong>$value=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the width attribute from Markdown or Twig Examples: ![Example](myimg.png?width=200&height=400) ![Example](myimg.png?resize=100,200&width=100&height=200) ![Example](myimg.png?width=auto&height=auto) ![Example](myimg.png?width&height) {{ page.media['myimg.png'].width().height().html }} {{ page.media['myimg.png'].resize(100,200).width(100).height(200).html }}</em> |
| protected | <strong>image()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Gets medium image, resets image manipulation operations.</em> |
| protected | <strong>saveImage()</strong> : <em>string</em><br /><em>Save the image with cache.</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="interface-gravcommonpagemediumrenderableinterface"></a>
### Interface: \Grav\Common\Page\Medium\RenderableInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return Parsedown Element from the medium.</em> |

<hr /><a id="class-gravcommonpagemediumglobalmedia"></a>
### Class: \Grav\Common\Page\Medium\GlobalMedia

| Visibility | Function |
|:-----------|:---------|
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| protected | <strong>addMedium(</strong><em>string</em> <strong>$stream</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)/null</em> |
| protected | <strong>resolveStream(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>string/null</em> |

*This class extends [\Grav\Common\Page\Medium\AbstractMedia](#class-gravcommonpagemediumabstractmedia-abstract)*

*This class implements [\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface), \ArrayAccess, \Countable*

<hr /><a id="class-gravcommonpagemediumstaticimagemedium"></a>
### Class: \Grav\Common\Page\Medium\StaticImageMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>resize(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Resize media by setting attributes</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediumabstractmedia-abstract"></a>
### Class: \Grav\Common\Page\Medium\AbstractMedia (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__invoke(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>mixed</em><br /><em>Call object as function to get medium by filename.</em> |
| public | <strong>all()</strong> : <em>array/\Grav\Common\Page\Medium\MediaObjectInterface[]</em><br /><em>Get a list of all media.</em> |
| public | <strong>audios()</strong> : <em>array/\Grav\Common\Page\Medium\MediaObjectInterface[]</em><br /><em>Get a list of all audio media.</em> |
| public | <strong>files()</strong> : <em>array/\Grav\Common\Page\Medium\MediaObjectInterface[]</em><br /><em>Get a list of all file media.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)/null</em><br /><em>Get medium by filename.</em> |
| public | <strong>images()</strong> : <em>array/\Grav\Common\Page\Medium\MediaObjectInterface[]</em><br /><em>Get a list of all image media.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| public | <strong>videos()</strong> : <em>array/\Grav\Common\Page\Medium\MediaObjectInterface[]</em><br /><em>Get a list of all video media.</em> |
| protected | <strong>add(</strong><em>string</em> <strong>$name</strong>, <em>\Grav\Common\Page\Medium\MediaObjectInterface</em> <strong>$file</strong>)</strong> : <em>void</em> |
| protected | <strong>getFileParts(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>array</em><br /><em>Get filename, extension and meta part.</em> |
| protected | <strong>orderMedia(</strong><em>mixed</em> <strong>$media</strong>)</strong> : <em>array</em><br /><em>Order the media based on the page's media_order</em> |

*This class extends [\Grav\Common\Getters](#class-gravcommongetters-abstract)*

*This class implements \Countable, \ArrayAccess, [\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface)*

<hr /><a id="class-gravcommonpagemediumthumbnailimagemedium"></a>
### Class: \Grav\Common\Page\Medium\ThumbnailImageMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>display(</strong><em>string</em> <strong>$mode=`'source'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch display mode.</em> |
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>lightbox(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link with lightbox enabled</em> |
| public | <strong>link(</strong><em>bool/boolean</em> <strong>$reset=true</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool/boolean</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Get an element (is array) that can be rendered by the Parsedown engine</em> |
| public | <strong>srcset(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return srcset string for this Medium and its alternatives.</em> |
| public | <strong>thumbnail(</strong><em>string</em> <strong>$type=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch thumbnail.</em> |
| protected | <strong>bubble(</strong><em>string</em> <strong>$method</strong>, <em>array</em> <strong>$arguments=array()</strong>, <em>bool/boolean</em> <strong>$testLinked=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Bubble a function call up to either the superclass function or the parent Medium instance</em> |

*This class extends [\Grav\Common\Page\Medium\ImageMedium](#class-gravcommonpagemediumimagemedium)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)*

<hr /><a id="class-gravcommonprocessorsconfigurationprocessor"></a>
### Class: \Grav\Common\Processors\ConfigurationProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorserrorsprocessor"></a>
### Class: \Grav\Common\Processors\ErrorsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsprocessorbase-abstract"></a>
### Class: \Grav\Common\Processors\ProcessorBase (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$container</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommonprocessorssitesetupprocessor"></a>
### Class: \Grav\Common\Processors\SiteSetupProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorstasksprocessor"></a>
### Class: \Grav\Common\Processors\TasksProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorspluginsprocessor"></a>
### Class: \Grav\Common\Processors\PluginsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorstwigprocessor"></a>
### Class: \Grav\Common\Processors\TwigProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsdebuggerassetsprocessor"></a>
### Class: \Grav\Common\Processors\DebuggerAssetsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsinitializeprocessor"></a>
### Class: \Grav\Common\Processors\InitializeProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsdebuggerinitprocessor"></a>
### Class: \Grav\Common\Processors\DebuggerInitProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsassetsprocessor"></a>
### Class: \Grav\Common\Processors\AssetsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsthemesprocessor"></a>
### Class: \Grav\Common\Processors\ThemesProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsrenderprocessor"></a>
### Class: \Grav\Common\Processors\RenderProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="interface-gravcommonprocessorsprocessorinterface"></a>
### Interface: \Grav\Common\Processors\ProcessorInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

<hr /><a id="class-gravcommonprocessorspagesprocessor"></a>
### Class: \Grav\Common\Processors\PagesProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonservicesessionserviceprovider"></a>
### Class: \Grav\Common\Service\SessionServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceerrorserviceprovider"></a>
### Class: \Grav\Common\Service\ErrorServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonservicepageserviceprovider"></a>
### Class: \Grav\Common\Service\PageServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonservicetaskserviceprovider"></a>
### Class: \Grav\Common\Service\TaskServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceassetsserviceprovider"></a>
### Class: \Grav\Common\Service\AssetsServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceconfigserviceprovider"></a>
### Class: \Grav\Common\Service\ConfigServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>blueprints(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |
| public static | <strong>languages(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |
| public static | <strong>load(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> |
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |
| public static | <strong>setup(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonservicestreamsserviceprovider"></a>
### Class: \Grav\Common\Service\StreamsServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \RocketTheme\Toolbox\DI\ServiceProviderInterface, \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceoutputserviceprovider"></a>
### Class: \Grav\Common\Service\OutputServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceloggerserviceprovider"></a>
### Class: \Grav\Common\Service\LoggerServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommontwigtwigextension"></a>
### Class: \Grav\Common\Twig\TwigExtension

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>TwigExtension constructor.</em> |
| public | <strong>absoluteUrlFilter(</strong><em>mixed</em> <strong>$string</strong>)</strong> : <em>mixed</em> |
| public | <strong>arrayFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>array</em><br /><em>Casts input to array.</em> |
| public | <strong>arrayIntersectFunc(</strong><em>mixed</em> <strong>$array1</strong>, <em>mixed</em> <strong>$array2</strong>)</strong> : <em>array</em><br /><em>Wrapper for array_intersect() method</em> |
| public | <strong>arrayKeyValueFunc(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$val</strong>, <em>array</em> <strong>$current_array=null</strong>)</strong> : <em>array</em><br /><em>Workaround for twig associative array initialization Returns a key => val array</em> |
| public | <strong>authorize(</strong><em>string/array</em> <strong>$action</strong>)</strong> : <em>bool Returns TRUE if the user is authorized to perform the action, FALSE otherwise.</em><br /><em>Authorize an action. Returns true if the user is logged in and has the right to execute $action. entry can be a string like 'group.action' or without dot notation an associative array.</em> |
| public | <strong>base32DecodeFilter(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>bool/string</em><br /><em>Return Base32 decoded string</em> |
| public | <strong>base32EncodeFilter(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Return Base32 encoded string</em> |
| public | <strong>base64DecodeFilter(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>bool/string</em><br /><em>Return Base64 decoded string</em> |
| public | <strong>base64EncodeFilter(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Return Base64 encoded string</em> |
| public | <strong>bodyClassFunc(</strong><em>mixed</em> <strong>$classes</strong>)</strong> : <em>string</em><br /><em>takes an array of classes, and if they are not set on body_classes look to see if they are set in theme config</em> |
| public | <strong>boolFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>bool</em><br /><em>Casts input to bool.</em> |
| public | <strong>chunkSplitFilter(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$chars</strong>, <em>string</em> <strong>$split=`'-'`</strong>)</strong> : <em>string</em><br /><em>Wrapper for chunk_split() function</em> |
| public | <strong>containsFilter(</strong><em>String</em> <strong>$haystack</strong>, <em>String</em> <strong>$needle</strong>)</strong> : <em>boolean</em><br /><em>determine if a string contains another</em> |
| public | <strong>definedDefaultFilter(</strong><em>mixed</em> <strong>$value</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>null</em> |
| public | <strong>dump(</strong><em>\Twig_Environment</em> <strong>$env</strong>, <em>mixed</em> <strong>$context</strong>)</strong> : <em>void</em><br /><em>Based on Twig_Extension_Debug / twig_var_dump (c) 2011 Fabien Potencier</em> |
| public | <strong>endsWithFilter(</strong><em>mixed</em> <strong>$haystack</strong>, <em>mixed</em> <strong>$needle</strong>)</strong> : <em>bool</em> |
| public | <strong>evaluateStringFunc(</strong><em>mixed</em> <strong>$context</strong>, <em>mixed</em> <strong>$string</strong>)</strong> : <em>mixed</em><br /><em>This function will evaluate a $string through the $environment, and return its results.</em> |
| public | <strong>evaluateTwigFunc(</strong><em>array</em> <strong>$context</strong>, <em>string</em> <strong>$twig</strong>)</strong> : <em>mixed</em><br /><em>This function will evaluate Twig $twig through the $environment, and return its results.</em> |
| public | <strong>exifFunc(</strong><em>mixed</em> <strong>$image</strong>, <em>bool</em> <strong>$raw=false</strong>)</strong> : <em>mixed</em><br /><em>Get's the Exif data for a file</em> |
| public | <strong>fieldNameFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Filters field name by changing dot notation into array notation.</em> |
| public | <strong>floatFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>float</em><br /><em>Casts input to float.</em> |
| public | <strong>getCookie(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>mixed</em><br /><em>Used to retrieve a cookie value</em> |
| public | <strong>getFilters()</strong> : <em>array</em><br /><em>Return a list of all filters.</em> |
| public | <strong>getFunctions()</strong> : <em>array</em><br /><em>Return a list of all functions.</em> |
| public | <strong>getGlobals()</strong> : <em>array</em><br /><em>Register some standard globals</em> |
| public | <strong>getTokenParsers()</strong> : <em>array</em> |
| public | <strong>gistFunc(</strong><em>string</em> <strong>$id</strong>, <em>bool/string/bool</em> <strong>$file=false</strong>)</strong> : <em>string</em><br /><em>Output a Gist</em> |
| public | <strong>inflectorFilter(</strong><em>string</em> <strong>$action</strong>, <em>string</em> <strong>$data</strong>, <em>int</em> <strong>$count=null</strong>)</strong> : <em>mixed</em><br /><em>Inflector supports following notations: `{{ 'person'|pluralize }} => people` `{{ 'shoes'|singularize }} => shoe` `{{ 'welcome page'|titleize }} => "Welcome Page"` `{{ 'send_email'|camelize }} => SendEmail` `{{ 'CamelCased'|underscorize }} => camel_cased` `{{ 'Something Text'|hyphenize }} => something-text` `{{ 'something_text_to_read'|humanize }} => "Something text to read"` `{{ '181'|monthize }} => 5` `{{ '10'|ordinalize }} => 10th`</em> |
| public | <strong>intFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>int</em><br /><em>Casts input to int.</em> |
| public | <strong>isAjaxFunc()</strong> : <em>true if HTTP_X_REQUESTED_WITH exists and has been set to xmlhttprequest</em><br /><em>Check if HTTP_X_REQUESTED_WITH has been set to xmlhttprequest, in which case we may unsafely assume ajax. Non critical use only.</em> |
| public | <strong>jsonDecodeFilter(</strong><em>string</em> <strong>$str</strong>, <em>bool</em> <strong>$assoc=false</strong>, <em>int</em> <strong>$depth=512</strong>, <em>int</em> <strong>$options</strong>)</strong> : <em>array</em><br /><em>Decodes string from JSON.</em> |
| public | <strong>ksortFilter(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>array</em><br /><em>Return ksorted collection.</em> |
| public | <strong>ltrimFilter(</strong><em>mixed</em> <strong>$value</strong>, <em>null</em> <strong>$chars=null</strong>)</strong> : <em>string</em> |
| public | <strong>markdownFunction(</strong><em>mixed</em> <strong>$string</strong>, <em>bool</em> <strong>$block=true</strong>)</strong> : <em>mixed/string</em> |
| public | <strong>md5Filter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Return MD5 hash from the input.</em> |
| public | <strong>mediaDirFunc(</strong><em>mixed</em> <strong>$media_dir</strong>)</strong> : <em>\Grav\Common\Twig\Media/null</em><br /><em>Process a folder as Media and return a media object</em> |
| public | <strong>modulusFilter(</strong><em>string/int</em> <strong>$number</strong>, <em>int</em> <strong>$divider</strong>, <em>array</em> <strong>$items=null</strong>)</strong> : <em>int</em><br /><em>Returns the modulus of an integer</em> |
| public | <strong>niceFilesizeFunc(</strong><em>mixed</em> <strong>$bytes</strong>)</strong> : <em>string</em><br /><em>Returns a nicer more readable filesize based on bytes</em> |
| public | <strong>niceNumberFunc(</strong><em>int/float</em> <strong>$n</strong>)</strong> : <em>bool/string</em><br /><em>Returns a nicer more readable number</em> |
| public | <strong>nicetimeFunc(</strong><em>mixed</em> <strong>$date</strong>, <em>bool/mixed</em> <strong>$long_strings=true</strong>)</strong> : <em>boolean</em><br /><em>displays a facebook style 'time ago' formatted date/time</em> |
| public | <strong>nonceFieldFunc(</strong><em>string</em> <strong>$action</strong>, <em>string</em> <strong>$nonceParamName=`'nonce'`</strong>)</strong> : <em>string the nonce input field</em><br /><em>Used to add a nonce to a form. Call {{ nonce_field('action') }} specifying a string representing the action. For maximum protection, ensure that the string representing the action is as specific as possible</em> |
| public static | <strong>padFilter(</strong><em>mixed</em> <strong>$input</strong>, <em>mixed</em> <strong>$pad_length</strong>, <em>string</em> <strong>$pad_string=`' '`</strong>, <em>int</em> <strong>$pad_type=1</strong>)</strong> : <em>string</em><br /><em>Pad a string to a certain length with another string</em> |
| public | <strong>pageHeaderVarFunc(</strong><em>mixed</em> <strong>$var</strong>, <em>null</em> <strong>$pages=null</strong>)</strong> : <em>mixed</em><br /><em>Look for a page header variable in an array of pages working its way through until a value is found</em> |
| public | <strong>randomStringFunc(</strong><em>int</em> <strong>$count=5</strong>)</strong> : <em>string</em><br /><em>Generate a random string</em> |
| public | <strong>randomizeFilter(</strong><em>array</em> <strong>$original</strong>, <em>int</em> <strong>$offset</strong>)</strong> : <em>array</em><br /><em>Returns array in a random order.</em> |
| public | <strong>rangeFunc(</strong><em>int</em> <strong>$start</strong>, <em>int</em> <strong>$end=100</strong>, <em>int</em> <strong>$step=1</strong>)</strong> : <em>array</em><br /><em>Generates an array containing a range of elements, optionally stepped</em> |
| public | <strong>readFileFunc(</strong><em>mixed</em> <strong>$filepath</strong>)</strong> : <em>bool/string</em><br /><em>Simple function to read a file based on a filepath and output it</em> |
| public | <strong>redirectFunc(</strong><em>string</em> <strong>$url</strong>, <em>int</em> <strong>$statusCode=303</strong>)</strong> : <em>void</em><br /><em>redirect browser from twig</em> |
| public | <strong>regexFilter(</strong><em>mixed</em> <strong>$array</strong>, <em>mixed</em> <strong>$regex</strong>, <em>int</em> <strong>$flags</strong>)</strong> : <em>array</em><br /><em>Twig wrapper for PHP's preg_grep method</em> |
| public | <strong>regexReplace(</strong><em>mixed</em> <strong>$subject</strong>, <em>mixed</em> <strong>$pattern</strong>, <em>mixed</em> <strong>$replace</strong>, <em>int</em> <strong>$limit=-1</strong>)</strong> : <em>mixed the resulting content</em><br /><em>Twig wrapper for PHP's preg_replace method</em> |
| public | <strong>repeatFunc(</strong><em>string</em> <strong>$input</strong>, <em>int</em> <strong>$multiplier</strong>)</strong> : <em>string</em><br /><em>Repeat given string x times.</em> |
| public | <strong>rtrimFilter(</strong><em>mixed</em> <strong>$value</strong>, <em>null</em> <strong>$chars=null</strong>)</strong> : <em>string</em> |
| public | <strong>safeEmailFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Protects email address.</em> |
| public | <strong>sortByKeyFilter(</strong><em>array</em> <strong>$input</strong>, <em>string</em> <strong>$filter</strong>, <em>int</em> <strong>$direction=4</strong>, <em>int</em> <strong>$sort_flags</strong>)</strong> : <em>array</em><br /><em>Sorts a collection by key</em> |
| public | <strong>startsWithFilter(</strong><em>mixed</em> <strong>$haystack</strong>, <em>mixed</em> <strong>$needle</strong>)</strong> : <em>bool</em> |
| public | <strong>stringFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>string</em><br /><em>Casts input to string.</em> |
| public | <strong>stringFunc(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>Returns a string from a value. If the value is array, return it json encoded</em> |
| public | <strong>themeVarFunc(</strong><em>mixed</em> <strong>$var</strong>, <em>bool</em> <strong>$default=null</strong>)</strong> : <em>string</em><br /><em>Get a theme variable</em> |
| public | <strong>translate()</strong> : <em>mixed</em> |
| public | <strong>translateArray(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$index</strong>, <em>null</em> <strong>$lang=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>translateFunc()</strong> : <em>string</em><br /><em>Translate a string</em> |
| public | <strong>translateLanguage(</strong><em>mixed</em> <strong>$args</strong>, <em>array/null/array</em> <strong>$languages=null</strong>, <em>bool</em> <strong>$array_support=false</strong>, <em>bool</em> <strong>$html_out=false</strong>)</strong> : <em>mixed</em><br /><em>Translate Strings</em> |
| public | <strong>urlFunc(</strong><em>string</em> <strong>$input</strong>, <em>bool</em> <strong>$domain=false</strong>)</strong> : <em>string/null Returns url to the resource or null if resource was not found.</em><br /><em>Return URL to the resource.</em> |
| public | <strong>vardumpFunc(</strong><em>mixed</em> <strong>$var</strong>)</strong> : <em>void</em><br /><em>Dump a variable to the browser</em> |
| public | <strong>xssFunc(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>bool/string/array</em><br /><em>Allow quick check of a string for XSS Vulnerabilities</em> |
| public | <strong>yamlDecodeFilter(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>mixed</em><br /><em>Decode/Parse data from YAML format</em> |
| public | <strong>yamlEncodeFilter(</strong><em>mixed</em> <strong>$data</strong>, <em>mixed</em> <strong>$inline=10</strong>)</strong> : <em>mixed</em><br /><em>Dump/Encode data into YAML format</em> |
###### Examples of TwigExtension::urlFunc()
```
{{ url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4') }}
```

*This class extends \Twig\Extension\AbstractExtension*

*This class implements \Twig\Extension\ExtensionInterface, \Twig\Extension\GlobalsInterface*

<hr /><a id="class-gravcommontwigtwig"></a>
### Class: \Grav\Common\Twig\Twig

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>addPath(</strong><em>mixed</em> <strong>$template_path</strong>, <em>string/null</em> <strong>$namespace=`'__main__'`</strong>)</strong> : <em>void</em><br /><em>Wraps the Twig_Loader_Filesystem addPath method (should be used only in `onTwigLoader()` event</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Twig initialization that sets the twig loader chain, then the environment, then extensions and also the base set of twig vars</em> |
| public | <strong>loader()</strong> : <em>\Twig_Loader_Filesystem</em> |
| public | <strong>prependPath(</strong><em>mixed</em> <strong>$template_path</strong>, <em>string/null</em> <strong>$namespace=`'__main__'`</strong>)</strong> : <em>void</em><br /><em>Wraps the Twig_Loader_Filesystem prependPath method (should be used only in `onTwigLoader()` event</em> |
| public | <strong>processPage(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$item</strong>, <em>string</em> <strong>$content=null</strong>)</strong> : <em>string The rendered output</em><br /><em>Twig process that renders a page item. It supports two variations: 1) Handles modular pages by rendering a specific page based on its modular twig template 2) Renders individual page items for twig processing before the site rendering</em> |
| public | <strong>processSite(</strong><em>string</em> <strong>$format=null</strong>, <em>array</em> <strong>$vars=array()</strong>)</strong> : <em>string the rendered output</em><br /><em>Twig process that renders the site layout. This is the main twig process that renders the overall page and handles all the layout for the site display.</em> |
| public | <strong>processString(</strong><em>string</em> <strong>$string</strong>, <em>array</em> <strong>$vars=array()</strong>)</strong> : <em>string</em><br /><em>Process a Twig template directly by using a Twig string and optional array of variables</em> |
| public | <strong>processTemplate(</strong><em>string</em> <strong>$template</strong>, <em>array</em> <strong>$vars=array()</strong>)</strong> : <em>string</em><br /><em>Process a Twig template directly by using a template name and optional array of variables</em> |
| public | <strike><strong>setAutoescape(</strong><em>boolean</em> <strong>$state</strong>)</strong> : <em>void</em></strike><br /><em>DEPRECATED - 1.5</em> |
| public | <strong>setTemplate(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$template</strong>)</strong> : <em>void</em><br /><em>Adds or overrides a template.</em> |
| public | <strong>template(</strong><em>string</em> <strong>$template</strong>)</strong> : <em>string the template name</em><br /><em>Simple helper method to get the twig template if it has already been set, else return the one being passed in</em> |
| public | <strong>twig()</strong> : <em>\Twig_Environment</em> |

<hr /><a id="class-gravcommontwigtwigenvironment"></a>
### Class: \Grav\Common\Twig\TwigEnvironment

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>writeCacheFile(</strong><em>mixed</em> <strong>$file</strong>, <em>mixed</em> <strong>$content</strong>)</strong> : <em>void</em><br /><em>This exists so template cache files use the same group between apache and cli</em> |

*This class extends \Twig\Environment*

<hr /><a id="class-gravcommontwignodetwignodemarkdown"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeMarkdown

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig_Node</em> <strong>$body</strong>, <em>mixed</em> <strong>$lineno</strong>, <em>string</em> <strong>$tag=`'markdown'`</strong>)</strong> : <em>void</em> |
| public | <strong>compile(</strong><em>\Twig_Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeOutputInterface*

<hr /><a id="class-gravcommontwignodetwignodetrycatch"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeTryCatch

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig_Node</em> <strong>$try</strong>, <em>\Twig_Node</em> <strong>$catch=null</strong>, <em>mixed</em> <strong>$lineno</strong>, <em>mixed</em> <strong>$tag=null</strong>)</strong> : <em>void</em> |
| public | <strong>compile(</strong><em>\Twig_Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface*

<hr /><a id="class-gravcommontwignodetwignodescript"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeScript

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig_Node/null/\Twig_Node</em> <strong>$body=null</strong>, <em>\Twig_Node_Expression/null/\Twig_Node_Expression</em> <strong>$file=null</strong>, <em>\Twig_Node_Expression/null/\Twig_Node_Expression</em> <strong>$group=null</strong>, <em>\Twig_Node_Expression/null/\Twig_Node_Expression</em> <strong>$priority=null</strong>, <em>\Twig_Node_Expression/null/\Twig_Node_Expression</em> <strong>$attributes=null</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeScript constructor.</em> |
| public | <strong>compile(</strong><em>\Twig_Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeCaptureInterface*

<hr /><a id="class-gravcommontwignodetwignodestyle"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeStyle

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig_Node/null/\Twig_Node</em> <strong>$body=null</strong>, <em>\Twig_Node_Expression</em> <strong>$file=null</strong>, <em>\Twig_Node_Expression</em> <strong>$group=null</strong>, <em>\Twig_Node_Expression</em> <strong>$priority=null</strong>, <em>\Twig_Node_Expression/null/\Twig_Node_Expression</em> <strong>$attributes=null</strong>, <em>int</em> <strong>$lineno</strong>, <em>null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeAssets constructor.</em> |
| public | <strong>compile(</strong><em>\Twig_Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeCaptureInterface*

<hr /><a id="class-gravcommontwignodetwignodeswitch"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeSwitch

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig_Node</em> <strong>$value</strong>, <em>\Twig_Node</em> <strong>$cases</strong>, <em>\Twig_Node</em> <strong>$default=null</strong>, <em>mixed</em> <strong>$lineno</strong>, <em>mixed</em> <strong>$tag=null</strong>)</strong> : <em>void</em> |
| public | <strong>compile(</strong><em>\Twig_Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparsertrycatch"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserTryCatch

> Handles try/catch in template file. <pre> {% try %} <li>{{ user.get('name') }}</li> {% catch %} {{ e.message }} {% endcatch %} </pre>

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideCatch(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>void</em> |
| public | <strong>decideEnd(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>void</em> |
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>\Twig_Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserswitch"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserSwitch

> Adds ability use elegant switch instead of ungainly if statements {% switch type %} {% case 'foo' %} {{ my_data.foo }} {% case 'bar' %} {{ my_data.bar }} {% default %} {{ my_data.default }} {% endswitch %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideIfEnd(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>bool</em><br /><em>Decide if current token marks end of swtich block.</em> |
| public | <strong>decideIfFork(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>bool</em><br /><em>Decide if current token marks switch logic.</em> |
| public | <strong>getTag()</strong> : <em>mixed</em> |
| public | <strong>parse(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>void</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserscript"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserScript

> Adds a script to head/bottom/custom location in the document. {% script 'theme://js/something.js' in 'bottom' priority: 20 with { defer: true, async: true } %} {% script in 'bottom' priority: 20 %} alert('Warning!'); {% endscript %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideBlockEnd(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>bool</em> |
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>\Twig_Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |
| protected | <strong>parseArguments(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>array</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparsermarkdown"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserMarkdown

> Adds ability to inline markdown between tags. {% markdown %} This is **bold** and this _underlined_ 1. This is a bullet list 2. This is another item in that same list {% endmarkdown %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideMarkdownEnd(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>bool</em><br /><em>Decide if current token marks end of Markdown block.</em> |
| public | <strong>getTag()</strong> : <em>mixed</em> |
| public | <strong>parse(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>void</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserstyle"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserStyle

> Adds a style to the document. {% style 'theme://css/foo.css' priority: 20 %} {% style priority: 20 with { media: 'screen' } %} a { color: red; } {% endstyle %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideBlockEnd(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>bool</em> |
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>\Twig_Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |
| protected | <strong>parseArguments(</strong><em>\Twig_Token</em> <strong>$token</strong>)</strong> : <em>array</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommonusergroup"></a>
### Class: \Grav\Common\User\Group

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>groupExists(</strong><em>string</em> <strong>$groupname</strong>)</strong> : <em>bool</em><br /><em>Checks if a group exists</em> |
| public static | <strong>groupNames()</strong> : <em>array</em><br /><em>Get the groups list</em> |
| public static | <strong>load(</strong><em>string</em> <strong>$groupname</strong>)</strong> : <em>object</em><br /><em>Get a group by name</em> |
| public static | <strong>remove(</strong><em>string</em> <strong>$groupname</strong>)</strong> : <em>bool True if the action was performed</em><br /><em>Remove a group</em> |
| public | <strong>save()</strong> : <em>void</em><br /><em>Save a group</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

<hr /><a id="class-gravcommonuserauthentication-abstract"></a>
### Class: \Grav\Common\User\Authentication (abstract)

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>create(</strong><em>string</em> <strong>$password</strong>)</strong> : <em>string/bool</em><br /><em>Create password hash from plaintext password.</em> |
| public static | <strong>verify(</strong><em>string</em> <strong>$password</strong>, <em>string</em> <strong>$hash</strong>)</strong> : <em>int Returns if the check fails, 1 if password matches, 2 if hash needs to be updated.</em><br /><em>Verifies that a password matches a hash.</em> |

<hr /><a id="class-gravcommonuseruser"></a>
### Class: \Grav\Common\User\User

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__sleep()</strong> : <em>void</em><br /><em>Serialize user.</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Unserialize user.</em> |
| public | <strong>authenticate(</strong><em>string</em> <strong>$password</strong>)</strong> : <em>bool</em><br /><em>Authenticate user. If user password needs to be updated, new information will be saved.</em> |
| public | <strike><strong>authorise(</strong><em>string</em> <strong>$action</strong>)</strong> : <em>bool</em></strike><br /><em>DEPRECATED - use authorize()</em> |
| public | <strong>authorize(</strong><em>string</em> <strong>$action</strong>)</strong> : <em>bool</em><br /><em>Checks user authorization to the action.</em> |
| public | <strong>avatarUrl()</strong> : <em>string</em><br /><em>Return the User's avatar URL</em> |
| public static | <strong>find(</strong><em>string</em> <strong>$query</strong>, <em>array</em> <strong>$fields=array()</strong>)</strong> : <em>[\Grav\Common\User\User](#class-gravcommonuseruser)</em><br /><em>Find a user by username, email, etc</em> |
| public static | <strong>load(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>[\Grav\Common\User\User](#class-gravcommonuseruser)</em><br /><em>Load user account. Always creates user object. To check if user exists, use $this->exists().</em> |
| public | <strong>offsetExists(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| public static | <strong>remove(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>bool True if the action was performed</em><br /><em>Remove user account.</em> |
| public | <strong>save()</strong> : <em>void</em><br /><em>Save user without the username</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

<hr /><a id="class-gravconsoleconsolecommand"></a>
### Class: \Grav\Console\ConsoleCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clearCache(</strong><em>array</em> <strong>$all=array()</strong>)</strong> : <em>int</em> |
| public | <strong>composerUpdate(</strong><em>mixed</em> <strong>$path</strong>, <em>string</em> <strong>$action=`'install'`</strong>)</strong> : <em>void</em> |
| public static | <strong>getGrav()</strong> : <em>[\Grav\Common\Grav](#class-gravcommongrav)</em> |
| public | <strong>isGravInstance(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>bool</em> |
| public | <strong>loadLocalConfig()</strong> : <em>mixed string the local config file name. false if local config does not exist</em><br /><em>Load the local config file</em> |
| public | <strong>setupConsole(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>void</em><br /><em>Set colors style definition for the formatter.</em> |
| protected | <strong>displayGPMRelease()</strong> : <em>void</em> |
| protected | <strong>execute(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>int/null/void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends \Symfony\Component\Console\Command\Command*

<hr /><a id="class-gravconsoleclisecuritycommand"></a>
### Class: \Grav\Console\Cli\SecurityCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>outputProgress(</strong><em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolecliinstallcommand"></a>
### Class: \Grav\Console\Cli\InstallCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclicomposercommand"></a>
### Class: \Grav\Console\Cli\ComposerCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclicleancommand"></a>
### Class: \Grav\Console\Cli\CleanCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>setupConsole(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>void</em><br /><em>Set colors style definition for the formatter.</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>execute(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>int/null/void</em> |

*This class extends \Symfony\Component\Console\Command\Command*

<hr /><a id="class-gravconsoleclisandboxcommand"></a>
### Class: \Grav\Console\Cli\SandboxCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolecliclearcachecommand"></a>
### Class: \Grav\Console\Cli\ClearCacheCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclibackupcommand"></a>
### Class: \Grav\Console\Cli\BackupCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>output(</strong><em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclinewprojectcommand"></a>
### Class: \Grav\Console\Cli\NewProjectCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpminfocommand"></a>
### Class: \Grav\Console\Gpm\InfoCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpminstallcommand"></a>
### Class: \Grav\Console\Gpm\InstallCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>askConfirmationIfMajorVersionUpdated(</strong><em>mixed</em> <strong>$package</strong>)</strong> : <em>void</em><br /><em>If the package is updated from an older major release, show warning and ask confirmation</em> |
| public | <strong>installDependencies(</strong><em>array</em> <strong>$dependencies</strong>, <em>string</em> <strong>$type</strong>, <em>string</em> <strong>$message</strong>, <em>bool</em> <strong>$required=true</strong>)</strong> : <em>void</em><br /><em>Given a $dependencies list, filters their type according to $type and shows $message prior to listing them to the user. Then asks the user a confirmation prior to installing them.</em> |
| public | <strong>progress(</strong><em>mixed</em> <strong>$progress</strong>)</strong> : <em>void</em> |
| public | <strong>setGpm(</strong><em>mixed</em> <strong>$gpm</strong>)</strong> : <em>void</em><br /><em>Allows to set the GPM object, used for testing the class</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>bool</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmuninstallcommand"></a>
### Class: \Grav\Console\Gpm\UninstallCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmversioncommand"></a>
### Class: \Grav\Console\Gpm\VersionCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmupdatecommand"></a>
### Class: \Grav\Console\Gpm\UpdateCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmdirectinstallcommand"></a>
### Class: \Grav\Console\Gpm\DirectInstallCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>bool</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmindexcommand"></a>
### Class: \Grav\Console\Gpm\IndexCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>filter(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>mixed</em> |
| public | <strong>sort(</strong><em>mixed</em> <strong>$packages</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmselfupgradecommand"></a>
### Class: \Grav\Console\Gpm\SelfupgradeCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>formatBytes(</strong><em>mixed</em> <strong>$size</strong>, <em>int</em> <strong>$precision=2</strong>)</strong> : <em>string</em> |
| public | <strong>progress(</strong><em>mixed</em> <strong>$progress</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>int/null/void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleterminalobjectstable"></a>
### Class: \Grav\Console\TerminalObjects\Table

| Visibility | Function |
|:-----------|:---------|
| public | <strong>result()</strong> : <em>void</em> |

*This class extends \League\CLImate\TerminalObject\Basic\Table*

*This class implements \League\CLImate\TerminalObject\Basic\BasicTerminalObjectInterface*

<hr /><a id="class-gravframeworkcacheabstractcache-abstract"></a>
### Class: \Grav\Framework\Cache\AbstractCache (abstract)

> Cache trait for PSR-16 compatible "Simple Cache" implementation

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$namespace=`''`</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$defaultLifetime=null</strong>)</strong> : <em>void</em> |
| public | <strong>abstract clear()</strong> : <em>bool True on success and false on failure.</em><br /><em>Wipes clean the entire cache's keys.</em> |
| public | <strong>abstract delete(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool True if the item was successfully removed. False if there was an error.</em><br /><em>Delete an item from the cache by its unique key.</em> |
| public | <strong>abstract deleteMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>)</strong> : <em>bool True if the items were successfully removed. False if there was an error.</em><br /><em>Deletes multiple cache items in a single operation.</em> |
| public | <strong>abstract doClear()</strong> : <em>void</em> |
| public | <strong>abstract doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doDeleteMultiple(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>bool</em> |
| public | <strong>abstract doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doGetMultiple(</strong><em>array</em> <strong>$keys</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>array</em> |
| public | <strong>abstract doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>abstract doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>doSetMultiple(</strong><em>array</em> <strong>$values</strong>, <em>int</em> <strong>$ttl</strong>)</strong> : <em>bool</em> |
| public | <strong>abstract get(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed The value of the item from the cache, or $default in case of cache miss.</em><br /><em>Fetches a value from the cache.</em> |
| public | <strong>abstract getMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.</em><br /><em>Obtains multiple cache items by their unique keys.</em> |
| public | <strong>abstract has(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Determines whether an item is present in the cache. NOTE: It is recommended that has() is only to be used for cache warming type purposes and not to be used within your live applications operations for get/set, as this method is subject to a race condition where your has() will return true and immediately after, another script can remove it making the state of your app out of date.</em> |
| public | <strong>abstract set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>abstract setMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$values</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists a set of key => value pairs in the cache, with an optional TTL. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>setValidation(</strong><em>mixed</em> <strong>$validation</strong>)</strong> : <em>void</em> |
| protected | <strong>convertTtl(</strong><em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl</strong>)</strong> : <em>int/null</em> |
| protected | <strong>getDefaultLifetime()</strong> : <em>int/null</em> |
| protected | <strong>getNamespace()</strong> : <em>string</em> |
| protected | <strong>init(</strong><em>string</em> <strong>$namespace=`''`</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$defaultLifetime=null</strong>)</strong> : <em>void</em><br /><em>Always call from constructor.</em> |
| protected | <strong>validateKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>void</em> |
| protected | <strong>validateKeys(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface), \Psr\SimpleCache\CacheInterface*

<hr /><a id="interface-gravframeworkcachecacheinterface"></a>
### Interface: \Grav\Framework\Cache\CacheInterface

> PSR-16 compatible "Simple Cache" interface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>doClear()</strong> : <em>void</em> |
| public | <strong>doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doDeleteMultiple(</strong><em>mixed</em> <strong>$keys</strong>)</strong> : <em>void</em> |
| public | <strong>doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doGetMultiple(</strong><em>mixed</em> <strong>$keys</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>doSetMultiple(</strong><em>mixed</em> <strong>$values</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |

*This class implements \Psr\SimpleCache\CacheInterface*

<hr /><a id="class-gravframeworkcacheadapterfilecache"></a>
### Class: \Grav\Framework\Cache\Adapter\FileCache

> Cache class for PSR-16 compatible "Simple Cache" implementation using file backend. Defaults to 1 year TTL. Does not support unlimited TTL.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$namespace=`''`</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$defaultLifetime=null</strong>)</strong> : <em>void</em> |
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>clear()</strong> : <em>bool True on success and false on failure.</em><br /><em>Wipes clean the entire cache's keys.</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool True if the item was successfully removed. False if there was an error.</em><br /><em>Delete an item from the cache by its unique key.</em> |
| public | <strong>deleteMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>)</strong> : <em>bool True if the items were successfully removed. False if there was an error.</em><br /><em>Deletes multiple cache items in a single operation.</em> |
| public | <strong>doClear()</strong> : <em>void</em> |
| public | <strong>doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>get(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed The value of the item from the cache, or $default in case of cache miss.</em><br /><em>Fetches a value from the cache.</em> |
| public | <strong>getMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.</em><br /><em>Obtains multiple cache items by their unique keys.</em> |
| public | <strong>has(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Determines whether an item is present in the cache. NOTE: It is recommended that has() is only to be used for cache warming type purposes and not to be used within your live applications operations for get/set, as this method is subject to a race condition where your has() will return true and immediately after, another script can remove it making the state of your app out of date.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>setMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$values</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists a set of key => value pairs in the cache, with an optional TTL. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public static | <strong>throwError(</strong><em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$message</strong>, <em>mixed</em> <strong>$file</strong>, <em>mixed</em> <strong>$line</strong>)</strong> : <em>void</em> |
| protected | <strong>getFile(</strong><em>string</em> <strong>$key</strong>, <em>bool</em> <strong>$mkdir=false</strong>)</strong> : <em>string</em> |
| protected | <strong>initFileCache(</strong><em>string</em> <strong>$namespace</strong>, <em>string</em> <strong>$directory</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Cache\AbstractCache](#class-gravframeworkcacheabstractcache-abstract)*

*This class implements \Psr\SimpleCache\CacheInterface, [\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)*

<hr /><a id="class-gravframeworkcacheadapterchaincache"></a>
### Class: \Grav\Framework\Cache\Adapter\ChainCache

> Cache class for PSR-16 compatible "Simple Cache" implementation using chained cache adapters.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$caches</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$defaultLifetime=null</strong>)</strong> : <em>void</em><br /><em>Chain Cache constructor.</em> |
| public | <strong>clear()</strong> : <em>bool True on success and false on failure.</em><br /><em>Wipes clean the entire cache's keys.</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool True if the item was successfully removed. False if there was an error.</em><br /><em>Delete an item from the cache by its unique key.</em> |
| public | <strong>deleteMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>)</strong> : <em>bool True if the items were successfully removed. False if there was an error.</em><br /><em>Deletes multiple cache items in a single operation.</em> |
| public | <strong>doClear()</strong> : <em>void</em> |
| public | <strong>doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doDeleteMultiple(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>bool</em> |
| public | <strong>doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doGetMultiple(</strong><em>array</em> <strong>$keys</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>array</em> |
| public | <strong>doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>doSetMultiple(</strong><em>array</em> <strong>$values</strong>, <em>int</em> <strong>$ttl</strong>)</strong> : <em>bool</em> |
| public | <strong>get(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed The value of the item from the cache, or $default in case of cache miss.</em><br /><em>Fetches a value from the cache.</em> |
| public | <strong>getMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.</em><br /><em>Obtains multiple cache items by their unique keys.</em> |
| public | <strong>has(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Determines whether an item is present in the cache. NOTE: It is recommended that has() is only to be used for cache warming type purposes and not to be used within your live applications operations for get/set, as this method is subject to a race condition where your has() will return true and immediately after, another script can remove it making the state of your app out of date.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>setMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$values</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists a set of key => value pairs in the cache, with an optional TTL. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |

*This class extends [\Grav\Framework\Cache\AbstractCache](#class-gravframeworkcacheabstractcache-abstract)*

*This class implements \Psr\SimpleCache\CacheInterface, [\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)*

<hr /><a id="class-gravframeworkcacheadaptermemorycache"></a>
### Class: \Grav\Framework\Cache\Adapter\MemoryCache

> Cache class for PSR-16 compatible "Simple Cache" implementation using in memory backend. Memory backend does not use namespace or default ttl as the cache is unique to each cache object and request.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clear()</strong> : <em>bool True on success and false on failure.</em><br /><em>Wipes clean the entire cache's keys.</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool True if the item was successfully removed. False if there was an error.</em><br /><em>Delete an item from the cache by its unique key.</em> |
| public | <strong>deleteMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>)</strong> : <em>bool True if the items were successfully removed. False if there was an error.</em><br /><em>Deletes multiple cache items in a single operation.</em> |
| public | <strong>doClear()</strong> : <em>void</em> |
| public | <strong>doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>get(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed The value of the item from the cache, or $default in case of cache miss.</em><br /><em>Fetches a value from the cache.</em> |
| public | <strong>getMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.</em><br /><em>Obtains multiple cache items by their unique keys.</em> |
| public | <strong>has(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Determines whether an item is present in the cache. NOTE: It is recommended that has() is only to be used for cache warming type purposes and not to be used within your live applications operations for get/set, as this method is subject to a race condition where your has() will return true and immediately after, another script can remove it making the state of your app out of date.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>setMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$values</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists a set of key => value pairs in the cache, with an optional TTL. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |

*This class extends [\Grav\Framework\Cache\AbstractCache](#class-gravframeworkcacheabstractcache-abstract)*

*This class implements \Psr\SimpleCache\CacheInterface, [\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)*

<hr /><a id="class-gravframeworkcacheadapterdoctrinecache"></a>
### Class: \Grav\Framework\Cache\Adapter\DoctrineCache

> Cache class for PSR-16 compatible "Simple Cache" implementation using Doctrine Cache backend.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Doctrine\Common\Cache\CacheProvider</em> <strong>$doctrineCache</strong>, <em>string</em> <strong>$namespace=`''`</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$defaultLifetime=null</strong>)</strong> : <em>void</em><br /><em>Doctrine Cache constructor.</em> |
| public | <strong>clear()</strong> : <em>bool True on success and false on failure.</em><br /><em>Wipes clean the entire cache's keys.</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool True if the item was successfully removed. False if there was an error.</em><br /><em>Delete an item from the cache by its unique key.</em> |
| public | <strong>deleteMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>)</strong> : <em>bool True if the items were successfully removed. False if there was an error.</em><br /><em>Deletes multiple cache items in a single operation.</em> |
| public | <strong>doClear()</strong> : <em>void</em> |
| public | <strong>doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doDeleteMultiple(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>bool</em> |
| public | <strong>doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doGetMultiple(</strong><em>array</em> <strong>$keys</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>array</em> |
| public | <strong>doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>doSetMultiple(</strong><em>array</em> <strong>$values</strong>, <em>int</em> <strong>$ttl</strong>)</strong> : <em>bool</em> |
| public | <strong>get(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed The value of the item from the cache, or $default in case of cache miss.</em><br /><em>Fetches a value from the cache.</em> |
| public | <strong>getMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.</em><br /><em>Obtains multiple cache items by their unique keys.</em> |
| public | <strong>has(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Determines whether an item is present in the cache. NOTE: It is recommended that has() is only to be used for cache warming type purposes and not to be used within your live applications operations for get/set, as this method is subject to a race condition where your has() will return true and immediately after, another script can remove it making the state of your app out of date.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>setMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$values</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists a set of key => value pairs in the cache, with an optional TTL. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |

*This class extends [\Grav\Framework\Cache\AbstractCache](#class-gravframeworkcacheabstractcache-abstract)*

*This class implements \Psr\SimpleCache\CacheInterface, [\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)*

<hr /><a id="class-gravframeworkcacheadaptersessioncache"></a>
### Class: \Grav\Framework\Cache\Adapter\SessionCache

> Cache class for PSR-16 compatible "Simple Cache" implementation using session backend.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clear()</strong> : <em>bool True on success and false on failure.</em><br /><em>Wipes clean the entire cache's keys.</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool True if the item was successfully removed. False if there was an error.</em><br /><em>Delete an item from the cache by its unique key.</em> |
| public | <strong>deleteMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>)</strong> : <em>bool True if the items were successfully removed. False if there was an error.</em><br /><em>Deletes multiple cache items in a single operation.</em> |
| public | <strong>doClear()</strong> : <em>void</em> |
| public | <strong>doDelete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doGet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$miss</strong>)</strong> : <em>void</em> |
| public | <strong>doHas(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>doSet(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$ttl</strong>)</strong> : <em>void</em> |
| public | <strong>get(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed The value of the item from the cache, or $default in case of cache miss.</em><br /><em>Fetches a value from the cache.</em> |
| public | <strong>getMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$keys</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.</em><br /><em>Obtains multiple cache items by their unique keys.</em> |
| public | <strong>getNamespace()</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Determines whether an item is present in the cache. NOTE: It is recommended that has() is only to be used for cache warming type purposes and not to be used within your live applications operations for get/set, as this method is subject to a race condition where your has() will return true and immediately after, another script can remove it making the state of your app out of date.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| public | <strong>setMultiple(</strong><em>\Psr\SimpleCache\iterable</em> <strong>$values</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$ttl=null</strong>)</strong> : <em>bool True on success and false on failure.</em><br /><em>Persists a set of key => value pairs in the cache, with an optional TTL. the driver supports TTL then the library may set a default value for it or let the driver take care of that.</em> |
| protected | <strong>doGetStored(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Cache\AbstractCache](#class-gravframeworkcacheabstractcache-abstract)*

*This class implements \Psr\SimpleCache\CacheInterface, [\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)*

<hr /><a id="class-gravframeworkcacheexceptioninvalidargumentexception"></a>
### Class: \Grav\Framework\Cache\Exception\InvalidArgumentException

> InvalidArgumentException class for PSR-16 compatible "Simple Cache" implementation.

| Visibility | Function |
|:-----------|:---------|

*This class extends \InvalidArgumentException*

*This class implements \Throwable, \Psr\SimpleCache\InvalidArgumentException, \Psr\SimpleCache\CacheException*

<hr /><a id="class-gravframeworkcacheexceptioncacheexception"></a>
### Class: \Grav\Framework\Cache\Exception\CacheException

> CacheException class for PSR-16 compatible "Simple Cache" implementation.

| Visibility | Function |
|:-----------|:---------|

*This class extends \Exception*

*This class implements \Throwable, \Psr\SimpleCache\CacheException*

<hr /><a id="interface-gravframeworkcollectionfilecollectioninterface"></a>
### Interface: \Grav\Framework\Collection\FileCollectionInterface

> Collection of objects stored into a filesystem.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getPath()</strong> : <em>string</em> |

*This class implements [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, \Doctrine\Common\Collections\Selectable*

<hr /><a id="class-gravframeworkcollectionabstractfilecollection"></a>
### Class: \Grav\Framework\Collection\AbstractFileCollection

> Collection of objects stored into a filesystem.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getPath()</strong> : <em>string</em> |
| public | <strong>matching(</strong><em>\Doctrine\Common\Collections\Criteria</em> <strong>$criteria</strong>)</strong> : <em>[\Grav\Framework\Collection\ArrayCollection](#class-gravframeworkcollectionarraycollection)</em> |
| protected | <strong>__construct(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>void</em> |
| protected | <strong>addFilter(</strong><em>\callable</em> <strong>$filterFunction</strong>)</strong> : <em>\Grav\Framework\Collection\$this</em> |
| protected | <strong>createObject(</strong><em>[\RecursiveDirectoryIterator](http://php.net/manual/en/class.recursivedirectoryiterator.php)</em> <strong>$file</strong>)</strong> : <em>object</em> |
| protected | <strong>doInitialize()</strong> : <em>void</em> |
| protected | <strong>doInitializeByIterator(</strong><em>\SeekableIterator</em> <strong>$iterator</strong>, <em>mixed</em> <strong>$nestingLimit</strong>)</strong> : <em>void</em> |
| protected | <strong>doInitializeChildren(</strong><em>[\RecursiveDirectoryIterator](http://php.net/manual/en/class.recursivedirectoryiterator.php)[]</em> <strong>$children</strong>, <em>mixed</em> <strong>$nestingLimit</strong>)</strong> : <em>array</em> |
| protected | <strong>setIterator()</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Collection\AbstractLazyCollection](#class-gravframeworkcollectionabstractlazycollection-abstract)*

*This class implements \JsonSerializable, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, [\Grav\Framework\Collection\FileCollectionInterface](#interface-gravframeworkcollectionfilecollectioninterface), \Doctrine\Common\Collections\Selectable*

<hr /><a id="class-gravframeworkcollectionarraycollection"></a>
### Class: \Grav\Framework\Collection\ArrayCollection

> General JSON serializable collection.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>chunk(</strong><em>int</em> <strong>$size</strong>)</strong> : <em>array</em><br /><em>Split collection into chunks.</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implementes JsonSerializable interface.</em> |
| public | <strong>reverse()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Reverse the order of the items.</em> |
| public | <strong>shuffle()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Shuffle items.</em> |

*This class extends \Doctrine\Common\Collections\ArrayCollection*

*This class implements \Doctrine\Common\Collections\Selectable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable*

<hr /><a id="class-gravframeworkcollectionfilecollection"></a>
### Class: \Grav\Framework\Collection\FileCollection

> Collection of objects stored into a filesystem.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$path</strong>, <em>int</em> <strong>$flags=null</strong>)</strong> : <em>void</em> |
| public | <strong>addFilter(</strong><em>\callable</em> <strong>$filterFunction</strong>)</strong> : <em>\Grav\Framework\Collection\$this</em> |
| public | <strong>getFlags()</strong> : <em>int</em> |
| public | <strong>getNestingLimit()</strong> : <em>int</em> |
| public | <strong>setFilter(</strong><em>\callable</em> <strong>$filterFunction=null</strong>)</strong> : <em>\Grav\Framework\Collection\$this</em> |
| public | <strong>setNestingLimit(</strong><em>int</em> <strong>$limit=99</strong>)</strong> : <em>\Grav\Framework\Collection\$this</em> |
| public | <strong>setObjectBuilder(</strong><em>\callable</em> <strong>$objectFunction=null</strong>)</strong> : <em>\Grav\Framework\Collection\$this</em> |

*This class extends [\Grav\Framework\Collection\AbstractFileCollection](#class-gravframeworkcollectionabstractfilecollection)*

*This class implements \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Collection\FileCollectionInterface](#interface-gravframeworkcollectionfilecollectioninterface), \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable*

<hr /><a id="interface-gravframeworkcollectioncollectioninterface"></a>
### Interface: \Grav\Framework\Collection\CollectionInterface

> Collection Interface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>chunk(</strong><em>int</em> <strong>$size</strong>)</strong> : <em>array</em><br /><em>Split collection into chunks.</em> |
| public | <strong>reverse()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Reverse the order of the items.</em> |
| public | <strong>shuffle()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Shuffle items.</em> |

*This class implements \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \JsonSerializable*

<hr /><a id="class-gravframeworkcollectionabstractlazycollection-abstract"></a>
### Class: \Grav\Framework\Collection\AbstractLazyCollection (abstract)

> General JSON serializable collection.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>chunk(</strong><em>mixed</em> <strong>$size</strong>)</strong> : <em>void</em> |
| public | <strong>jsonSerialize()</strong> : <em>void</em> |
| public | <strong>reverse()</strong> : <em>void</em> |
| public | <strong>shuffle()</strong> : <em>void</em> |

*This class extends \Doctrine\Common\Collections\AbstractLazyCollection*

*This class implements \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable*

<hr /><a id="class-gravframeworkcontentblockhtmlblock"></a>
### Class: \Grav\Framework\ContentBlock\HtmlBlock

> HtmlBlock

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addFramework(</strong><em>string</em> <strong>$framework</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>addHtml(</strong><em>string</em> <strong>$html</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'bottom'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addInlineScript(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addInlineStyle(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addScript(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addStyle(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>build(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>getAssets()</strong> : <em>array</em> |
| public | <strong>getFrameworks()</strong> : <em>array</em> |
| public | <strong>getHtml(</strong><em>string</em> <strong>$location=`'bottom'`</strong>)</strong> : <em>array</em> |
| public | <strong>getScripts(</strong><em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>array</em> |
| public | <strong>getStyles(</strong><em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>array</em> |
| public | <strong>toArray()</strong> : <em>array[]</em> |
| protected | <strong>getAssetsFast()</strong> : <em>array</em> |
| protected | <strong>getAssetsInLocation(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$location</strong>)</strong> : <em>array</em> |
| protected | <strong>sortAssets(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>void</em> |
| protected | <strong>sortAssetsInLocation(</strong><em>array</em> <strong>$items</strong>)</strong> : <em>void</em> |
###### Examples of HtmlBlock::addStyle()
```
$block->addStyle('assets/js/my.js');$block->addStyle(['href' => 'assets/js/my.js', 'media' => 'screen']);
```

*This class extends [\Grav\Framework\ContentBlock\ContentBlock](#class-gravframeworkcontentblockcontentblock)*

*This class implements \Serializable, [\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface), [\Grav\Framework\ContentBlock\HtmlBlockInterface](#interface-gravframeworkcontentblockhtmlblockinterface)*

<hr /><a id="interface-gravframeworkcontentblockhtmlblockinterface"></a>
### Interface: \Grav\Framework\ContentBlock\HtmlBlockInterface

> Interface HtmlBlockInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addFramework(</strong><em>string</em> <strong>$framework</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>addHtml(</strong><em>string</em> <strong>$html</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'bottom'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addInlineScript(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addInlineStyle(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addScript(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>addStyle(</strong><em>string/array</em> <strong>$element</strong>, <em>int</em> <strong>$priority</strong>, <em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>bool</em> |
| public | <strong>getAssets()</strong> : <em>array</em> |
| public | <strong>getFrameworks()</strong> : <em>array</em> |
| public | <strong>getHtml(</strong><em>string</em> <strong>$location=`'bottom'`</strong>)</strong> : <em>array</em> |
| public | <strong>getScripts(</strong><em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>array</em> |
| public | <strong>getStyles(</strong><em>string</em> <strong>$location=`'head'`</strong>)</strong> : <em>array</em> |
###### Examples of HtmlBlockInterface::addStyle()
```
$block->addStyle('assets/js/my.js');$block->addStyle(['href' => 'assets/js/my.js', 'media' => 'screen']);
```

*This class implements [\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface), \Serializable*

<hr /><a id="interface-gravframeworkcontentblockcontentblockinterface"></a>
### Interface: \Grav\Framework\ContentBlock\ContentBlockInterface

> ContentBlock Interface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$id=null</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>addBlock(</strong><em>[\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface)</em> <strong>$block</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>build(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public static | <strong>create(</strong><em>string</em> <strong>$id=null</strong>)</strong> : <em>\Grav\Framework\ContentBlock\static</em> |
| public static | <strong>fromArray(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>[\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface)</em> |
| public | <strong>getChecksum()</strong> : <em>string</em> |
| public | <strong>getId()</strong> : <em>string</em> |
| public | <strong>getToken()</strong> : <em>string</em> |
| public | <strong>setChecksum(</strong><em>string</em> <strong>$checksum</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>setContent(</strong><em>string</em> <strong>$content</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>toArray()</strong> : <em>array</em> |
| public | <strong>toString()</strong> : <em>string</em> |

*This class implements \Serializable*

<hr /><a id="class-gravframeworkcontentblockcontentblock"></a>
### Class: \Grav\Framework\ContentBlock\ContentBlock

> Class to create nested blocks of content. $innerBlock = ContentBlock::create(); $innerBlock->setContent('my inner content'); $outerBlock = ContentBlock::create(); $outerBlock->setContent(sprintf('Inside my outer block I have %s.', $innerBlock->getToken())); $outerBlock->addBlock($innerBlock); echo $outerBlock;

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$id=null</strong>)</strong> : <em>void</em><br /><em>Block constructor.</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>addBlock(</strong><em>[\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface)</em> <strong>$block</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>build(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public static | <strong>create(</strong><em>string</em> <strong>$id=null</strong>)</strong> : <em>\Grav\Framework\ContentBlock\static</em> |
| public static | <strong>fromArray(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>[\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface)</em> |
| public | <strong>getChecksum()</strong> : <em>string</em> |
| public | <strong>getId()</strong> : <em>string</em> |
| public | <strong>getToken()</strong> : <em>string</em> |
| public | <strong>serialize()</strong> : <em>string</em> |
| public | <strong>setChecksum(</strong><em>string</em> <strong>$checksum</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>setContent(</strong><em>string</em> <strong>$content</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>toArray()</strong> : <em>array</em> |
| public | <strong>toString()</strong> : <em>string</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>checkVersion(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>generateId()</strong> : <em>string</em> |

*This class implements [\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface), \Serializable*

<hr /><a id="class-gravframeworkfileformatterjsonformatter"></a>
### Class: \Grav\Framework\File\Formatter\JsonFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>mixed</em> |
| public | <strike><strong>getFileExtension()</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use $formatter->getDefaultFileExtension() instead.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>mixed</em> |

*This class implements [\Grav\Framework\File\Formatter\FormatterInterface](#interface-gravframeworkfileformatterformatterinterface)*

<hr /><a id="interface-gravframeworkfileformatterformatterinterface"></a>
### Interface: \Grav\Framework\File\Formatter\FormatterInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decode(</strong><em>string</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Decode a string into data.</em> |
| public | <strong>encode(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>string</em><br /><em>Encode data into a string.</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>string File extension (can be empty).</em><br /><em>Get default file extension from current formatter (with dot). Default file extension is the first defined extension.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>string[]</em><br /><em>Get file extensions supported by current formatter (with dot).</em> |

<hr /><a id="class-gravframeworkfileformatterserializeformatter"></a>
### Class: \Grav\Framework\File\Formatter\SerializeFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>IniFormatter constructor.</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>mixed</em> |
| public | <strike><strong>getFileExtension()</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use $formatter->getDefaultFileExtension() instead.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>mixed</em> |
| protected | <strong>preserveLines(</strong><em>mixed</em> <strong>$data</strong>, <em>array</em> <strong>$search</strong>, <em>array</em> <strong>$replace</strong>)</strong> : <em>mixed</em><br /><em>Preserve new lines, recursive function.</em> |

*This class implements [\Grav\Framework\File\Formatter\FormatterInterface](#interface-gravframeworkfileformatterformatterinterface)*

<hr /><a id="class-gravframeworkfileformatteriniformatter"></a>
### Class: \Grav\Framework\File\Formatter\IniFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>IniFormatter constructor.</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>mixed</em> |
| public | <strike><strong>getFileExtension()</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use $formatter->getDefaultFileExtension() instead.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>mixed</em> |

*This class implements [\Grav\Framework\File\Formatter\FormatterInterface](#interface-gravframeworkfileformatterformatterinterface)*

<hr /><a id="class-gravframeworkfileformatteryamlformatter"></a>
### Class: \Grav\Framework\File\Formatter\YamlFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>, <em>mixed</em> <strong>$inline=null</strong>, <em>mixed</em> <strong>$indent=null</strong>)</strong> : <em>void</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>mixed</em> |
| public | <strike><strong>getFileExtension()</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use $formatter->getDefaultFileExtension() instead.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>mixed</em> |

*This class implements [\Grav\Framework\File\Formatter\FormatterInterface](#interface-gravframeworkfileformatterformatterinterface)*

<hr /><a id="class-gravframeworkfileformattermarkdownformatter"></a>
### Class: \Grav\Framework\File\Formatter\MarkdownFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>, <em>[\Grav\Framework\File\Formatter\FormatterInterface](#interface-gravframeworkfileformatterformatterinterface)</em> <strong>$headerFormatter=null</strong>)</strong> : <em>void</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>mixed</em> |
| public | <strike><strong>getFileExtension()</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use $formatter->getDefaultFileExtension() instead.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>mixed</em> |

*This class implements [\Grav\Framework\File\Formatter\FormatterInterface](#interface-gravframeworkfileformatterformatterinterface)*

<hr /><a id="class-gravframeworkobjectpropertyobject"></a>
### Class: \Grav\Framework\Object\PropertyObject

> Property Object class.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| protected | <strong>doGetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>bool/callable/bool</em> <strong>$doCreate=false</strong>)</strong> : <em>mixed Property value.</em> |
| protected | <strong>doHasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doSetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>void</em> |
| protected | <strong>getElement(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>getElements()</strong> : <em>array</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>initObjectProperties()</strong> : <em>void</em> |
| protected | <strong>isPropertyLoaded(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been loaded.</em> |
| protected | <strong>offsetLoad(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>offsetPrepare(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>offsetSerialize(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>setElements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>void</em> |
| protected | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravframeworkobjectobjectcollection"></a>
### Class: \Grav\Framework\Object\ObjectCollection

> Object Collection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>call(</strong><em>string</em> <strong>$method</strong>, <em>array</em> <strong>$arguments=array()</strong>)</strong> : <em>array Return values.</em> |
| public | <strong>collectionGroup(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\static[]</em><br /><em>Group items in the collection by a field and return them as associated array of collections.</em> |
| public | <strong>copy()</strong> : <em>\Grav\Framework\Object\static</em><br /><em>Create a copy from this collection by cloning all objects in the collection.</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>doDefProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>doGetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>array Key/Value pairs of the properties.</em> |
| public | <strong>doHasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>array Key/Value pairs of the properties.</em> |
| public | <strong>doSetProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>doUnsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array Key/Value pairs of the properties.</em> |
| public | <strong>getObjectKeys()</strong> : <em>array</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>group(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array</em><br /><em>Group items in the collection by a field.</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array Key/Value pairs of the properties.</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>matching(</strong><em>\Doctrine\Common\Collections\Criteria</em> <strong>$criteria</strong>)</strong> : <em>void</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>getElements()</strong> : <em>mixed</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>setElements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Collection\ArrayCollection](#class-gravframeworkcollectionarraycollection)*

*This class implements \JsonSerializable, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="class-gravframeworkobjectarrayobject"></a>
### Class: \Grav\Framework\Object\ArrayObject

> Array Object class.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| protected | <strong>doGetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>bool</em> <strong>$doCreate=false</strong>)</strong> : <em>mixed Property value.</em> |
| protected | <strong>doHasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doSetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>void</em> |
| protected | <strong>getElement(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>getElements()</strong> : <em>array</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>setElements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>void</em> |
| protected | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravframeworkobjectlazyobject"></a>
### Class: \Grav\Framework\Object\LazyObject

> Lazy Object class.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| protected | <strong>doGetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>bool/callable/bool</em> <strong>$doCreate=false</strong>)</strong> : <em>mixed Property value.</em> |
| protected | <strong>doHasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doSetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>void</em> |
| protected | <strong>getElement(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>getElements()</strong> : <em>array</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>initObjectProperties()</strong> : <em>void</em> |
| protected | <strong>isPropertyLoaded(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been loaded.</em> |
| protected | <strong>offsetLoad(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>offsetPrepare(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>offsetSerialize(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>setElements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>void</em> |
| protected | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravframeworkobjectcollectionobjectexpressionvisitor"></a>
### Class: \Grav\Framework\Object\Collection\ObjectExpressionVisitor

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>filterLength(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>void</em> |
| public static | <strong>filterLower(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>void</em> |
| public static | <strong>filterLtrim(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>void</em> |
| public static | <strong>filterRtrim(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>void</em> |
| public static | <strong>filterTrim(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>void</em> |
| public static | <strong>filterUpper(</strong><em>mixed</em> <strong>$str</strong>)</strong> : <em>void</em> |
| public static | <strong>getObjectFieldValue(</strong><em>object</em> <strong>$object</strong>, <em>string</em> <strong>$field</strong>)</strong> : <em>mixed</em><br /><em>Accesses the field of a given object.</em> |
| public static | <strong>sortByField(</strong><em>string</em> <strong>$name</strong>, <em>int</em> <strong>$orientation=1</strong>, <em>[\Closure](http://php.net/manual/en/class.closure.php)</em> <strong>$next=null</strong>)</strong> : <em>[\Closure](http://php.net/manual/en/class.closure.php)</em><br /><em>Helper for sorting arrays of objects based on multiple fields + orientations.</em> |
| public | <strong>walkComparison(</strong><em>\Doctrine\Common\Collections\Expr\Comparison</em> <strong>$comparison</strong>)</strong> : <em>void</em> |

*This class extends \Doctrine\Common\Collections\Expr\ClosureExpressionVisitor*

<hr /><a id="interface-gravframeworkobjectinterfacesnestedobjectinterface"></a>
### Interface: \Grav\Framework\Object\Interfaces\NestedObjectInterface

> Object Interface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |

*This class implements [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \JsonSerializable, \Serializable*

<hr /><a id="interface-gravframeworkobjectinterfacesobjectcollectioninterface"></a>
### Interface: \Grav\Framework\Object\Interfaces\ObjectCollectionInterface

> ObjectCollection Interface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>call(</strong><em>string</em> <strong>$name</strong>, <em>array</em> <strong>$arguments</strong>)</strong> : <em>array Return values.</em> |
| public | <strong>collectionGroup(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\static[]</em><br /><em>Group items in the collection by a field and return them as associated array of collections.</em> |
| public | <strong>copy()</strong> : <em>\Grav\Framework\Object\Interfaces\static</em><br /><em>Create a copy from this collection by cloning all objects in the collection.</em> |
| public | <strong>getObjectKeys()</strong> : <em>array</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>array Property value.</em> |
| public | <strong>group(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>array</em><br /><em>Group items in the collection by a field and return them as associated array.</em> |
| public | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |

*This class implements [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Serializable*

<hr /><a id="interface-gravframeworkobjectinterfacesobjectinterface"></a>
### Interface: \Grav\Framework\Object\Interfaces\ObjectInterface

> Object Interface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getType()</strong> : <em>string</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |

*This class implements \Serializable, \JsonSerializable*

<hr /><a id="class-gravframeworkpsr7abstracturi-abstract"></a>
### Class: \Grav\Framework\Psr7\AbstractUri (abstract)

> Bare minimum PSR7 implementation.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>abstract __construct()</strong> : <em>void</em><br /><em>Please define constructor which calls $this->init().</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>abstract getAuthority()</strong> : <em>string The URI authority, in "[user-info@]host[:port]" format.</em><br /><em>Retrieve the authority component of the URI. If no authority information is present, this method MUST return an empty string. The authority syntax of the URI is: <pre></em> |
| public | <strong>abstract getFragment()</strong> : <em>string The URI fragment.</em><br /><em>Retrieve the fragment component of the URI. If no fragment is present, this method MUST return an empty string. The leading "#" character is not part of the fragment and MUST NOT be added. The value returned MUST be percent-encoded, but MUST NOT double-encode any characters. To determine what characters to encode, please refer to RFC 3986, Sections 2 and 3.5.</em> |
| public | <strong>abstract getHost()</strong> : <em>string The URI host.</em><br /><em>Retrieve the host component of the URI. If no host is present, this method MUST return an empty string. The value returned MUST be normalized to lowercase, per RFC 3986 Section 3.2.2.</em> |
| public | <strong>abstract getPath()</strong> : <em>string The URI path.</em><br /><em>Retrieve the path component of the URI. The path can either be empty or absolute (starting with a slash) or rootless (not starting with a slash). Implementations MUST support all three syntaxes. Normally, the empty path "" and absolute path "/" are considered equal as defined in RFC 7230 Section 2.7.3. But this method MUST NOT automatically do this normalization because in contexts with a trimmed base path, e.g. the front controller, this difference becomes significant. It's the task of the user to handle both "" and "/". The value returned MUST be percent-encoded, but MUST NOT double-encode any characters. To determine what characters to encode, please refer to RFC 3986, Sections 2 and 3.3. As an example, if the value should include a slash ("/") not intended as delimiter between path segments, that value MUST be passed in encoded form (e.g., "%2F") to the instance.</em> |
| public | <strong>abstract getPort()</strong> : <em>null/int The URI port.</em><br /><em>Retrieve the port component of the URI. If a port is present, and it is non-standard for the current scheme, this method MUST return it as an integer. If the port is the standard port used with the current scheme, this method SHOULD return null. If no port is present, and no scheme is present, this method MUST return a null value. If no port is present, but a scheme is present, this method MAY return the standard port for that scheme, but SHOULD return null.</em> |
| public | <strong>abstract getQuery()</strong> : <em>string The URI query string.</em><br /><em>Retrieve the query string of the URI. If no query string is present, this method MUST return an empty string. The leading "?" character is not part of the query and MUST NOT be added. The value returned MUST be percent-encoded, but MUST NOT double-encode any characters. To determine what characters to encode, please refer to RFC 3986, Sections 2 and 3.4. As an example, if a value in a key/value pair of the query string should include an ampersand ("&") not intended as a delimiter between values, that value MUST be passed in encoded form (e.g., "%26") to the instance.</em> |
| public | <strong>abstract getScheme()</strong> : <em>string The URI scheme.</em><br /><em>Retrieve the scheme component of the URI. If no scheme is present, this method MUST return an empty string. The value returned MUST be normalized to lowercase, per RFC 3986 Section 3.1. The trailing ":" character is not part of the scheme and MUST NOT be added.</em> |
| public | <strong>abstract getUserInfo()</strong> : <em>string The URI user information, in "username[:password]" format.</em><br /><em>Retrieve the user information component of the URI. If no user information is present, this method MUST return an empty string. If a user is present in the URI, this will return that value; additionally, if the password is also present, it will be appended to the user value, with a colon (":") separating the values. The trailing "@" character is not part of the user information and MUST NOT be added.</em> |
| public | <strong>abstract withFragment(</strong><em>string</em> <strong>$fragment</strong>)</strong> : <em>static A new instance with the specified fragment.</em><br /><em>Return an instance with the specified URI fragment. This method MUST retain the state of the current instance, and return an instance that contains the specified URI fragment. Users can provide both encoded and decoded fragment characters. Implementations ensure the correct encoding as outlined in getFragment(). An empty fragment value is equivalent to removing the fragment.</em> |
| public | <strong>abstract withHost(</strong><em>string</em> <strong>$host</strong>)</strong> : <em>static A new instance with the specified host.</em><br /><em>Return an instance with the specified host. This method MUST retain the state of the current instance, and return an instance that contains the specified host. An empty host value is equivalent to removing the host.</em> |
| public | <strong>abstract withPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>static A new instance with the specified path.</em><br /><em>Return an instance with the specified path. This method MUST retain the state of the current instance, and return an instance that contains the specified path. The path can either be empty or absolute (starting with a slash) or rootless (not starting with a slash). Implementations MUST support all three syntaxes. If the path is intended to be domain-relative rather than path relative then it must begin with a slash ("/"). Paths not starting with a slash ("/") are assumed to be relative to some base path known to the application or consumer. Users can provide both encoded and decoded path characters. Implementations ensure the correct encoding as outlined in getPath().</em> |
| public | <strong>abstract withPort(</strong><em>null/int</em> <strong>$port</strong>)</strong> : <em>static A new instance with the specified port.</em><br /><em>Return an instance with the specified port. This method MUST retain the state of the current instance, and return an instance that contains the specified port. Implementations MUST raise an exception for ports outside the established TCP and UDP port ranges. A null value provided for the port is equivalent to removing the port information. removes the port information.</em> |
| public | <strong>abstract withQuery(</strong><em>string</em> <strong>$query</strong>)</strong> : <em>static A new instance with the specified query string.</em><br /><em>Return an instance with the specified query string. This method MUST retain the state of the current instance, and return an instance that contains the specified query string. Users can provide both encoded and decoded query characters. Implementations ensure the correct encoding as outlined in getQuery(). An empty query string value is equivalent to removing the query string.</em> |
| public | <strong>abstract withScheme(</strong><em>string</em> <strong>$scheme</strong>)</strong> : <em>static A new instance with the specified scheme.</em><br /><em>Return an instance with the specified scheme. This method MUST retain the state of the current instance, and return an instance that contains the specified scheme. Implementations MUST support the schemes "http" and "https" case insensitively, and MAY accommodate other schemes if required. An empty scheme is equivalent to removing the scheme.</em> |
| public | <strong>abstract withUserInfo(</strong><em>string</em> <strong>$user</strong>, <em>null/string</em> <strong>$password=null</strong>)</strong> : <em>static A new instance with the specified user information.</em><br /><em>Return an instance with the specified user information. This method MUST retain the state of the current instance, and return an instance that contains the specified user information. Password is optional, but the user information MUST include the user; an empty string for the user is equivalent to removing user information.</em> |
| protected | <strong>getBaseUrl()</strong> : <em>string</em><br /><em>Return the fully qualified base URL ( like http://getgrav.org ). Note that this method never includes a trailing /</em> |
| protected | <strong>getParts()</strong> : <em>array</em> |
| protected | <strong>getPassword()</strong> : <em>string</em> |
| protected | <strong>getUrl()</strong> : <em>string</em> |
| protected | <strong>getUser()</strong> : <em>string</em> |
| protected | <strong>initParts(</strong><em>array</em> <strong>$parts</strong>)</strong> : <em>void</em> |
| protected | <strong>isDefaultPort()</strong> : <em>bool</em> |

*This class implements \Psr\Http\Message\UriInterface*

<hr /><a id="class-gravframeworkrouteroute"></a>
### Class: \Grav\Framework\Route\Route

> Implements Grav Route.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$parts=array()</strong>)</strong> : <em>void</em><br /><em>You can use `RouteFactory` functions to create new `Route` objects.</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>getGravParam(</strong><em>string</em> <strong>$param</strong>)</strong> : <em>string/null</em> |
| public | <strong>getGravParams()</strong> : <em>array</em> |
| public | <strong>getLanguagePrefix()</strong> : <em>string</em> |
| public | <strong>getParam(</strong><em>string</em> <strong>$param</strong>)</strong> : <em>string/null</em><br /><em>Return value of the parameter, looking into both Grav parameters and query parameters. If the parameter exists in both, return Grav parameter.</em> |
| public | <strong>getParams()</strong> : <em>array</em><br /><em>Return array of both query and Grav parameters. If a parameter exists in both, prefer Grav parameter.</em> |
| public | <strong>getParts()</strong> : <em>array</em> |
| public | <strong>getQueryParam(</strong><em>string</em> <strong>$param</strong>)</strong> : <em>string/null</em> |
| public | <strong>getQueryParams()</strong> : <em>array</em> |
| public | <strong>getRootPrefix()</strong> : <em>string</em> |
| public | <strong>getRoute(</strong><em>int</em> <strong>$offset</strong>, <em>int/null</em> <strong>$length=null</strong>)</strong> : <em>string</em> |
| public | <strong>getRouteParts(</strong><em>int</em> <strong>$offset</strong>, <em>int/null</em> <strong>$length=null</strong>)</strong> : <em>array</em> |
| public | <strong>getUri()</strong> : <em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)</em> |
| public | <strong>withGravParam(</strong><em>string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| public | <strong>withQueryParam(</strong><em>string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| protected | <strong>getUriPath()</strong> : <em>string</em> |
| protected | <strong>getUriQuery()</strong> : <em>string</em> |
| protected | <strong>initParts(</strong><em>array</em> <strong>$parts</strong>)</strong> : <em>void</em> |
| protected | <strong>withParam(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Route\static</em> |

<hr /><a id="class-gravframeworkrouteroutefactory"></a>
### Class: \Grav\Framework\Route\RouteFactory

> Class RouteFactory

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>buildParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>string</em> |
| public static | <strong>createFromParts(</strong><em>mixed</em> <strong>$parts</strong>)</strong> : <em>mixed</em> |
| public static | <strong>createFromString(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getLanguage()</strong> : <em>mixed</em> |
| public static | <strong>getParamValueDelimiter()</strong> : <em>mixed</em> |
| public static | <strong>getParams(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>array</em> |
| public static | <strong>getRoot()</strong> : <em>mixed</em> |
| public static | <strong>parseParams(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>array</em> |
| public static | <strong>setLanguage(</strong><em>mixed</em> <strong>$language</strong>)</strong> : <em>void</em> |
| public static | <strong>setParamValueDelimiter(</strong><em>mixed</em> <strong>$delimiter</strong>)</strong> : <em>void</em> |
| public static | <strong>setRoot(</strong><em>mixed</em> <strong>$root</strong>)</strong> : <em>void</em> |
| public static | <strong>stripParams(</strong><em>string</em> <strong>$path</strong>, <em>bool</em> <strong>$decode=false</strong>)</strong> : <em>string</em> |

<hr /><a id="class-gravframeworksessionsession"></a>
### Class: \Grav\Framework\Session\Session

> Class Session

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options=array()</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Returns session variable.</em> |
| public | <strong>__isset(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>bool</em><br /><em>Checks if session variable is defined.</em> |
| public | <strong>__set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Sets session variable.</em> |
| public | <strong>__unset(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Removes session variable.</em> |
| public | <strong>clear()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Free all session variables.</em> |
| public | <strong>close()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Force the session to be saved and closed</em> |
| public | <strong>getAll()</strong> : <em>array</em><br /><em>Returns all session variables.</em> |
| public | <strong>getId()</strong> : <em>string/null Session ID</em><br /><em>Get session ID</em> |
| public static | <strong>getInstance()</strong> : <em>[\Grav\Framework\Session\Session](#class-gravframeworksessionsession)</em><br /><em>Get current session instance.</em> |
| public | <strong>getIterator()</strong> : <em>\ArrayIterator Return an ArrayIterator of $_SESSION</em><br /><em>Retrieve an external iterator</em> |
| public | <strong>getName()</strong> : <em>string/null</em><br /><em>Get session name</em> |
| public | <strong>invalidate()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Invalidates the current session.</em> |
| public | <strong>isStarted()</strong> : <em>Boolean</em><br /><em>Checks if the session was started.</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session ID</em> |
| public | <strong>setName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session name</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Sets session.* ini variables.</em> |
| public | <strong>start(</strong><em>bool</em> <strong>$readonly=false</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Starts the session storage</em> |
| protected | <strong>ini_set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>isSessionStarted()</strong> : <em>bool</em><br /><em>http://php.net/manual/en/function.session-status.php#113468 Check if session is started nicely.</em> |

*This class implements [\Grav\Framework\Session\SessionInterface](#interface-gravframeworksessionsessioninterface), \Traversable, \IteratorAggregate*

<hr /><a id="interface-gravframeworksessionsessioninterface"></a>
### Interface: \Grav\Framework\Session\SessionInterface

> Class Session

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__get(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Returns session variable.</em> |
| public | <strong>__isset(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>bool</em><br /><em>Checks if session variable is defined.</em> |
| public | <strong>__set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Sets session variable.</em> |
| public | <strong>__unset(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Removes session variable.</em> |
| public | <strong>clear()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Free all session variables.</em> |
| public | <strong>close()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Force the session to be saved and closed</em> |
| public | <strong>getAll()</strong> : <em>array</em><br /><em>Returns all session variables.</em> |
| public | <strong>getId()</strong> : <em>string/null Session ID</em><br /><em>Get session ID</em> |
| public static | <strong>getInstance()</strong> : <em>[\Grav\Framework\Session\Session](#class-gravframeworksessionsession)</em><br /><em>Get current session instance.</em> |
| public | <strong>getIterator()</strong> : <em>\ArrayIterator Return an ArrayIterator of $_SESSION</em><br /><em>Retrieve an external iterator</em> |
| public | <strong>getName()</strong> : <em>string/null</em><br /><em>Get session name</em> |
| public | <strong>invalidate()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Invalidates the current session.</em> |
| public | <strong>isStarted()</strong> : <em>Boolean</em><br /><em>Checks if the session was started.</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session ID</em> |
| public | <strong>setName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session name</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Sets session.* ini variables.</em> |
| public | <strong>start(</strong><em>bool</em> <strong>$readonly=false</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Starts the session storage</em> |

*This class implements \IteratorAggregate, \Traversable*

<hr /><a id="class-gravframeworkuriurifactory"></a>
### Class: \Grav\Framework\Uri\UriFactory

> Class Uri

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>buildQuery(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>string</em><br /><em>Build query string from variables.</em> |
| public static | <strong>createFromEnvironment(</strong><em>array</em> <strong>$env</strong>)</strong> : <em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)</em> |
| public static | <strong>createFromParts(</strong><em>array</em> <strong>$parts</strong>)</strong> : <em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)</em><br /><em>Creates a URI from a array of `parse_url()` components.</em> |
| public static | <strong>createFromString(</strong><em>string</em> <strong>$uri</strong>)</strong> : <em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)</em> |
| public static | <strong>parseQuery(</strong><em>string</em> <strong>$query</strong>)</strong> : <em>mixed</em><br /><em>Parse query string and return it as an array.</em> |
| public static | <strong>parseUrl(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>array</em><br /><em>UTF-8 aware parse_url() implementation.</em> |
| public static | <strong>parseUrlFromEnvironment(</strong><em>array</em> <strong>$env</strong>)</strong> : <em>array</em> |

<hr /><a id="class-gravframeworkuriuri"></a>
### Class: \Grav\Framework\Uri\Uri

> Implements PSR-7 UriInterface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$parts=array()</strong>)</strong> : <em>void</em><br /><em>You can use `UriFactory` functions to create new `Uri` objects.</em> |
| public | <strong>getAuthority()</strong> : <em>string The URI authority, in "[user-info@]host[:port]" format.</em><br /><em>Retrieve the authority component of the URI. If no authority information is present, this method MUST return an empty string. The authority syntax of the URI is: <pre></em> |
| public | <strong>getBaseUrl()</strong> : <em>string</em> |
| public | <strong>getFragment()</strong> : <em>string The URI fragment.</em><br /><em>Retrieve the fragment component of the URI. If no fragment is present, this method MUST return an empty string. The leading "#" character is not part of the fragment and MUST NOT be added. The value returned MUST be percent-encoded, but MUST NOT double-encode any characters. To determine what characters to encode, please refer to RFC 3986, Sections 2 and 3.5.</em> |
| public | <strong>getHost()</strong> : <em>string The URI host.</em><br /><em>Retrieve the host component of the URI. If no host is present, this method MUST return an empty string. The value returned MUST be normalized to lowercase, per RFC 3986 Section 3.2.2.</em> |
| public | <strong>getParts()</strong> : <em>array</em> |
| public | <strong>getPassword()</strong> : <em>string</em> |
| public | <strong>getPath()</strong> : <em>string The URI path.</em><br /><em>Retrieve the path component of the URI. The path can either be empty or absolute (starting with a slash) or rootless (not starting with a slash). Implementations MUST support all three syntaxes. Normally, the empty path "" and absolute path "/" are considered equal as defined in RFC 7230 Section 2.7.3. But this method MUST NOT automatically do this normalization because in contexts with a trimmed base path, e.g. the front controller, this difference becomes significant. It's the task of the user to handle both "" and "/". The value returned MUST be percent-encoded, but MUST NOT double-encode any characters. To determine what characters to encode, please refer to RFC 3986, Sections 2 and 3.3. As an example, if the value should include a slash ("/") not intended as delimiter between path segments, that value MUST be passed in encoded form (e.g., "%2F") to the instance.</em> |
| public | <strong>getPort()</strong> : <em>null/int The URI port.</em><br /><em>Retrieve the port component of the URI. If a port is present, and it is non-standard for the current scheme, this method MUST return it as an integer. If the port is the standard port used with the current scheme, this method SHOULD return null. If no port is present, and no scheme is present, this method MUST return a null value. If no port is present, but a scheme is present, this method MAY return the standard port for that scheme, but SHOULD return null.</em> |
| public | <strong>getQuery()</strong> : <em>string The URI query string.</em><br /><em>Retrieve the query string of the URI. If no query string is present, this method MUST return an empty string. The leading "?" character is not part of the query and MUST NOT be added. The value returned MUST be percent-encoded, but MUST NOT double-encode any characters. To determine what characters to encode, please refer to RFC 3986, Sections 2 and 3.4. As an example, if a value in a key/value pair of the query string should include an ampersand ("&") not intended as a delimiter between values, that value MUST be passed in encoded form (e.g., "%26") to the instance.</em> |
| public | <strong>getQueryParam(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>string/null</em> |
| public | <strong>getQueryParams()</strong> : <em>array</em> |
| public | <strong>getScheme()</strong> : <em>string The URI scheme.</em><br /><em>Retrieve the scheme component of the URI. If no scheme is present, this method MUST return an empty string. The value returned MUST be normalized to lowercase, per RFC 3986 Section 3.1. The trailing ":" character is not part of the scheme and MUST NOT be added.</em> |
| public | <strong>getUrl()</strong> : <em>string</em> |
| public | <strong>getUser()</strong> : <em>string</em> |
| public | <strong>getUserInfo()</strong> : <em>string The URI user information, in "username[:password]" format.</em><br /><em>Retrieve the user information component of the URI. If no user information is present, this method MUST return an empty string. If a user is present in the URI, this will return that value; additionally, if the password is also present, it will be appended to the user value, with a colon (":") separating the values. The trailing "@" character is not part of the user information and MUST NOT be added.</em> |
| public | <strong>isAbsolute()</strong> : <em>bool</em><br /><em>Whether the URI is absolute, i.e. it has a scheme. An instance of UriInterface can either be an absolute URI or a relative reference. This method returns true if it is the former. An absolute URI has a scheme. A relative reference is used to express a URI relative to another URI, the base URI. Relative references can be divided into several forms: - network-path references, e.g. '//example.com/path' - absolute-path references, e.g. '/path' - relative-path references, e.g. 'subpath'</em> |
| public | <strong>isAbsolutePathReference()</strong> : <em>bool</em><br /><em>Whether the URI is a absolute-path reference. A relative reference that begins with a single slash character is termed an absolute-path reference.</em> |
| public | <strong>isDefaultPort()</strong> : <em>bool</em><br /><em>Whether the URI has the default port of the current scheme. `$uri->getPort()` may return the standard port. This method can be used for some non-http/https Uri.</em> |
| public | <strong>isNetworkPathReference()</strong> : <em>bool</em><br /><em>Whether the URI is a network-path reference. A relative reference that begins with two slash characters is termed an network-path reference.</em> |
| public | <strong>isRelativePathReference()</strong> : <em>bool</em><br /><em>Whether the URI is a relative-path reference. A relative reference that does not begin with a slash character is termed a relative-path reference.</em> |
| public | <strong>isSameDocumentReference(</strong><em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)Interface/null/\Psr\Http\Message\UriInterface</em> <strong>$base=null</strong>)</strong> : <em>bool</em><br /><em>Whether the URI is a same-document reference. A same-document reference refers to a URI that is, aside from its fragment component, identical to the base URI. When no base URI is given, only an empty URI reference (apart from its fragment) is considered a same-document reference.</em> |
| public | <strong>withFragment(</strong><em>string</em> <strong>$fragment</strong>)</strong> : <em>static A new instance with the specified fragment.</em><br /><em>Return an instance with the specified URI fragment. This method MUST retain the state of the current instance, and return an instance that contains the specified URI fragment. Users can provide both encoded and decoded fragment characters. Implementations ensure the correct encoding as outlined in getFragment(). An empty fragment value is equivalent to removing the fragment.</em> |
| public | <strong>withHost(</strong><em>string</em> <strong>$host</strong>)</strong> : <em>static A new instance with the specified host.</em><br /><em>Return an instance with the specified host. This method MUST retain the state of the current instance, and return an instance that contains the specified host. An empty host value is equivalent to removing the host.</em> |
| public | <strong>withPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>static A new instance with the specified path.</em><br /><em>Return an instance with the specified path. This method MUST retain the state of the current instance, and return an instance that contains the specified path. The path can either be empty or absolute (starting with a slash) or rootless (not starting with a slash). Implementations MUST support all three syntaxes. If the path is intended to be domain-relative rather than path relative then it must begin with a slash ("/"). Paths not starting with a slash ("/") are assumed to be relative to some base path known to the application or consumer. Users can provide both encoded and decoded path characters. Implementations ensure the correct encoding as outlined in getPath().</em> |
| public | <strong>withPort(</strong><em>null/int</em> <strong>$port</strong>)</strong> : <em>static A new instance with the specified port.</em><br /><em>Return an instance with the specified port. This method MUST retain the state of the current instance, and return an instance that contains the specified port. Implementations MUST raise an exception for ports outside the established TCP and UDP port ranges. A null value provided for the port is equivalent to removing the port information. removes the port information.</em> |
| public | <strong>withQuery(</strong><em>string</em> <strong>$query</strong>)</strong> : <em>static A new instance with the specified query string.</em><br /><em>Return an instance with the specified query string. This method MUST retain the state of the current instance, and return an instance that contains the specified query string. Users can provide both encoded and decoded query characters. Implementations ensure the correct encoding as outlined in getQuery(). An empty query string value is equivalent to removing the query string.</em> |
| public | <strong>withQueryParam(</strong><em>string</em> <strong>$key</strong>, <em>string/null</em> <strong>$value</strong>)</strong> : <em>\Psr\Http\Message\UriInterface</em> |
| public | <strong>withQueryParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>\Psr\Http\Message\UriInterface</em> |
| public | <strong>withScheme(</strong><em>string</em> <strong>$scheme</strong>)</strong> : <em>static A new instance with the specified scheme.</em><br /><em>Return an instance with the specified scheme. This method MUST retain the state of the current instance, and return an instance that contains the specified scheme. Implementations MUST support the schemes "http" and "https" case insensitively, and MAY accommodate other schemes if required. An empty scheme is equivalent to removing the scheme.</em> |
| public | <strong>withUserInfo(</strong><em>string</em> <strong>$user</strong>, <em>null/string</em> <strong>$password=null</strong>)</strong> : <em>static A new instance with the specified user information.</em><br /><em>Return an instance with the specified user information. This method MUST retain the state of the current instance, and return an instance that contains the specified user information. Password is optional, but the user information MUST include the user; an empty string for the user is equivalent to removing user information.</em> |
| public | <strong>withoutQueryParam(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Psr\Http\Message\UriInterface</em> |

*This class extends [\Grav\Framework\Psr7\AbstractUri](#class-gravframeworkpsr7abstracturi-abstract)*

*This class implements \Psr\Http\Message\UriInterface*

<hr /><a id="class-gravframeworkuriuripartsfilter"></a>
### Class: \Grav\Framework\Uri\UriPartsFilter

> Class Uri

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>filterHost(</strong><em>string</em> <strong>$host</strong>)</strong> : <em>string</em> |
| public static | <strong>filterPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string The RFC 3986 percent-encoded uri path.</em><br /><em>Filter Uri path. This method percent-encodes all reserved characters in the provided path string. This method will NOT double-encode characters that are already percent-encoded.</em> |
| public static | <strong>filterPort(</strong><em>int/null</em> <strong>$port=null</strong>)</strong> : <em>int/null</em><br /><em>Filter Uri port. This method</em> |
| public static | <strong>filterQueryOrFragment(</strong><em>string</em> <strong>$query</strong>)</strong> : <em>string The percent-encoded query string.</em><br /><em>Filters the query string or fragment of a URI.</em> |
| public static | <strong>filterScheme(</strong><em>string</em> <strong>$scheme</strong>)</strong> : <em>string</em> |
| public static | <strong>filterUserInfo(</strong><em>string</em> <strong>$info</strong>)</strong> : <em>string The percent-encoded user or password string.</em><br /><em>Filters the user info string.</em> |

