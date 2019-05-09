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
- [\Grav\Common\Assets\InlineCss](#class-gravcommonassetsinlinecss)
- [\Grav\Common\Assets\Js](#class-gravcommonassetsjs)
- [\Grav\Common\Assets\BaseAsset (abstract)](#class-gravcommonassetsbaseasset-abstract)
- [\Grav\Common\Assets\InlineJs](#class-gravcommonassetsinlinejs)
- [\Grav\Common\Assets\Pipeline](#class-gravcommonassetspipeline)
- [\Grav\Common\Assets\Css](#class-gravcommonassetscss)
- [\Grav\Common\Backup\Backups](#class-gravcommonbackupbackups)
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
- [\Grav\Common\Filesystem\Archiver (abstract)](#class-gravcommonfilesystemarchiver-abstract)
- [\Grav\Common\Filesystem\RecursiveDirectoryFilterIterator](#class-gravcommonfilesystemrecursivedirectoryfilteriterator)
- [\Grav\Common\Filesystem\RecursiveFolderFilterIterator](#class-gravcommonfilesystemrecursivefolderfilteriterator)
- [\Grav\Common\Filesystem\Folder (abstract)](#class-gravcommonfilesystemfolder-abstract)
- [\Grav\Common\Filesystem\ZipArchiver](#class-gravcommonfilesystemziparchiver)
- [\Grav\Common\Form\FormFlash](#class-gravcommonformformflash)
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
- [\Grav\Common\Helpers\YamlLinter](#class-gravcommonhelpersyamllinter)
- [\Grav\Common\Helpers\Excerpts](#class-gravcommonhelpersexcerpts)
- [\Grav\Common\Helpers\Base32](#class-gravcommonhelpersbase32)
- [\Grav\Common\Helpers\Truncator](#class-gravcommonhelperstruncator)
- [\Grav\Common\Helpers\LogViewer](#class-gravcommonhelperslogviewer)
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
- [\Grav\Common\Page\Interfaces\PageRoutableInterface (interface)](#interface-gravcommonpageinterfacespageroutableinterface)
- [\Grav\Common\Page\Interfaces\PageInterface (interface)](#interface-gravcommonpageinterfacespageinterface)
- [\Grav\Common\Page\Interfaces\PageLegacyInterface (interface)](#interface-gravcommonpageinterfacespagelegacyinterface)
- [\Grav\Common\Page\Interfaces\PageContentInterface (interface)](#interface-gravcommonpageinterfacespagecontentinterface)
- [\Grav\Common\Page\Interfaces\PageTranslateInterface (interface)](#interface-gravcommonpageinterfacespagetranslateinterface)
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
- [\Grav\Common\Processors\TasksProcessor](#class-gravcommonprocessorstasksprocessor)
- [\Grav\Common\Processors\PluginsProcessor](#class-gravcommonprocessorspluginsprocessor)
- [\Grav\Common\Processors\DebuggerProcessor](#class-gravcommonprocessorsdebuggerprocessor)
- [\Grav\Common\Processors\TwigProcessor](#class-gravcommonprocessorstwigprocessor)
- [\Grav\Common\Processors\DebuggerAssetsProcessor](#class-gravcommonprocessorsdebuggerassetsprocessor)
- [\Grav\Common\Processors\InitializeProcessor](#class-gravcommonprocessorsinitializeprocessor)
- [\Grav\Common\Processors\BackupsProcessor](#class-gravcommonprocessorsbackupsprocessor)
- [\Grav\Common\Processors\AssetsProcessor](#class-gravcommonprocessorsassetsprocessor)
- [\Grav\Common\Processors\RequestProcessor](#class-gravcommonprocessorsrequestprocessor)
- [\Grav\Common\Processors\ThemesProcessor](#class-gravcommonprocessorsthemesprocessor)
- [\Grav\Common\Processors\LoggerProcessor](#class-gravcommonprocessorsloggerprocessor)
- [\Grav\Common\Processors\RenderProcessor](#class-gravcommonprocessorsrenderprocessor)
- [\Grav\Common\Processors\ProcessorInterface (interface)](#interface-gravcommonprocessorsprocessorinterface)
- [\Grav\Common\Processors\SchedulerProcessor](#class-gravcommonprocessorsschedulerprocessor)
- [\Grav\Common\Processors\PagesProcessor](#class-gravcommonprocessorspagesprocessor)
- [\Grav\Common\Processors\Events\RequestHandlerEvent](#class-gravcommonprocessorseventsrequesthandlerevent)
- [\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)
- [\Grav\Common\Scheduler\Scheduler](#class-gravcommonschedulerscheduler)
- [\Grav\Common\Scheduler\Job](#class-gravcommonschedulerjob)
- [\Grav\Common\Service\BackupsServiceProvider](#class-gravcommonservicebackupsserviceprovider)
- [\Grav\Common\Service\AccountsServiceProvider](#class-gravcommonserviceaccountsserviceprovider)
- [\Grav\Common\Service\FilesystemServiceProvider](#class-gravcommonservicefilesystemserviceprovider)
- [\Grav\Common\Service\SessionServiceProvider](#class-gravcommonservicesessionserviceprovider)
- [\Grav\Common\Service\ErrorServiceProvider](#class-gravcommonserviceerrorserviceprovider)
- [\Grav\Common\Service\PagesServiceProvider](#class-gravcommonservicepagesserviceprovider)
- [\Grav\Common\Service\SchedulerServiceProvider](#class-gravcommonserviceschedulerserviceprovider)
- [\Grav\Common\Service\InflectorServiceProvider](#class-gravcommonserviceinflectorserviceprovider)
- [\Grav\Common\Service\TaskServiceProvider](#class-gravcommonservicetaskserviceprovider)
- [\Grav\Common\Service\AssetsServiceProvider](#class-gravcommonserviceassetsserviceprovider)
- [\Grav\Common\Service\ConfigServiceProvider](#class-gravcommonserviceconfigserviceprovider)
- [\Grav\Common\Service\StreamsServiceProvider](#class-gravcommonservicestreamsserviceprovider)
- [\Grav\Common\Service\OutputServiceProvider](#class-gravcommonserviceoutputserviceprovider)
- [\Grav\Common\Service\RequestServiceProvider](#class-gravcommonservicerequestserviceprovider)
- [\Grav\Common\Service\LoggerServiceProvider](#class-gravcommonserviceloggerserviceprovider)
- [\Grav\Common\Twig\TwigExtension](#class-gravcommontwigtwigextension)
- [\Grav\Common\Twig\Twig](#class-gravcommontwigtwig)
- [\Grav\Common\Twig\TwigEnvironment](#class-gravcommontwigtwigenvironment)
- [\Grav\Common\Twig\Node\TwigNodeMarkdown](#class-gravcommontwignodetwignodemarkdown)
- [\Grav\Common\Twig\Node\TwigNodeThrow](#class-gravcommontwignodetwignodethrow)
- [\Grav\Common\Twig\Node\TwigNodeRender](#class-gravcommontwignodetwignoderender)
- [\Grav\Common\Twig\Node\TwigNodeTryCatch](#class-gravcommontwignodetwignodetrycatch)
- [\Grav\Common\Twig\Node\TwigNodeScript](#class-gravcommontwignodetwignodescript)
- [\Grav\Common\Twig\Node\TwigNodeStyle](#class-gravcommontwignodetwignodestyle)
- [\Grav\Common\Twig\Node\TwigNodeSwitch](#class-gravcommontwignodetwignodeswitch)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserTryCatch](#class-gravcommontwigtokenparsertwigtokenparsertrycatch)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserRender](#class-gravcommontwigtokenparsertwigtokenparserrender)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserSwitch](#class-gravcommontwigtokenparsertwigtokenparserswitch)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserThrow](#class-gravcommontwigtokenparsertwigtokenparserthrow)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserScript](#class-gravcommontwigtokenparsertwigtokenparserscript)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserMarkdown](#class-gravcommontwigtokenparsertwigtokenparsermarkdown)
- [\Grav\Common\Twig\TokenParser\TwigTokenParserStyle](#class-gravcommontwigtokenparsertwigtokenparserstyle)
- [\Grav\Common\User\Group](#class-gravcommonusergroup)
- [\Grav\Common\User\Authentication (abstract)](#class-gravcommonuserauthentication-abstract)
- [\Grav\Common\User\DataUser\User](#class-gravcommonuserdatauseruser)
- [\Grav\Common\User\DataUser\UserCollection](#class-gravcommonuserdatauserusercollection)
- [\Grav\Common\User\FlexUser\User](#class-gravcommonuserflexuseruser)
- [\Grav\Common\User\FlexUser\UserCollection](#class-gravcommonuserflexuserusercollection)
- [\Grav\Common\User\FlexUser\UserIndex](#class-gravcommonuserflexuseruserindex)
- [\Grav\Common\User\FlexUser\Storage\UserFolderStorage](#class-gravcommonuserflexuserstorageuserfolderstorage)
- [\Grav\Common\User\FlexUser\Storage\UserFileStorage](#class-gravcommonuserflexuserstorageuserfilestorage)
- [\Grav\Common\User\Interfaces\UserInterface (interface)](#interface-gravcommonuserinterfacesuserinterface)
- [\Grav\Common\User\Interfaces\UserCollectionInterface (interface)](#interface-gravcommonuserinterfacesusercollectioninterface)
- [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)
- [\Grav\Console\Cli\YamlLinterCommand](#class-gravconsolecliyamllintercommand)
- [\Grav\Console\Cli\SchedulerCommand](#class-gravconsoleclischedulercommand)
- [\Grav\Console\Cli\SecurityCommand](#class-gravconsoleclisecuritycommand)
- [\Grav\Console\Cli\InstallCommand](#class-gravconsolecliinstallcommand)
- [\Grav\Console\Cli\ComposerCommand](#class-gravconsoleclicomposercommand)
- [\Grav\Console\Cli\LogViewerCommand](#class-gravconsoleclilogviewercommand)
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
- [\Grav\Framework\Collection\AbstractIndexCollection (abstract)](#class-gravframeworkcollectionabstractindexcollection-abstract)
- [\Grav\Framework\Collection\CollectionInterface (interface)](#interface-gravframeworkcollectioncollectioninterface)
- [\Grav\Framework\Collection\AbstractLazyCollection (abstract)](#class-gravframeworkcollectionabstractlazycollection-abstract)
- [\Grav\Framework\ContentBlock\HtmlBlock](#class-gravframeworkcontentblockhtmlblock)
- [\Grav\Framework\ContentBlock\HtmlBlockInterface (interface)](#interface-gravframeworkcontentblockhtmlblockinterface)
- [\Grav\Framework\ContentBlock\ContentBlockInterface (interface)](#interface-gravframeworkcontentblockcontentblockinterface)
- [\Grav\Framework\ContentBlock\ContentBlock](#class-gravframeworkcontentblockcontentblock)
- [\Grav\Framework\DI\Container](#class-gravframeworkdicontainer)
- [\Grav\Framework\File\File](#class-gravframeworkfilefile)
- [\Grav\Framework\File\JsonFile](#class-gravframeworkfilejsonfile)
- [\Grav\Framework\File\CsvFile](#class-gravframeworkfilecsvfile)
- [\Grav\Framework\File\AbstractFile](#class-gravframeworkfileabstractfile)
- [\Grav\Framework\File\DataFile](#class-gravframeworkfiledatafile)
- [\Grav\Framework\File\MarkdownFile](#class-gravframeworkfilemarkdownfile)
- [\Grav\Framework\File\YamlFile](#class-gravframeworkfileyamlfile)
- [\Grav\Framework\File\IniFile](#class-gravframeworkfileinifile)
- [\Grav\Framework\File\Formatter\JsonFormatter](#class-gravframeworkfileformatterjsonformatter)
- [\Grav\Framework\File\Formatter\AbstractFormatter (abstract)](#class-gravframeworkfileformatterabstractformatter-abstract)
- [\Grav\Framework\File\Formatter\FormatterInterface (interface)](#interface-gravframeworkfileformatterformatterinterface)
- [\Grav\Framework\File\Formatter\CsvFormatter](#class-gravframeworkfileformattercsvformatter)
- [\Grav\Framework\File\Formatter\SerializeFormatter](#class-gravframeworkfileformatterserializeformatter)
- [\Grav\Framework\File\Formatter\IniFormatter](#class-gravframeworkfileformatteriniformatter)
- [\Grav\Framework\File\Formatter\YamlFormatter](#class-gravframeworkfileformatteryamlformatter)
- [\Grav\Framework\File\Formatter\MarkdownFormatter](#class-gravframeworkfileformattermarkdownformatter)
- [\Grav\Framework\File\Interfaces\FileInterface (interface)](#interface-gravframeworkfileinterfacesfileinterface)
- [\Grav\Framework\File\Interfaces\FileFormatterInterface (interface)](#interface-gravframeworkfileinterfacesfileformatterinterface)
- [\Grav\Framework\Filesystem\Filesystem](#class-gravframeworkfilesystemfilesystem)
- [\Grav\Framework\Filesystem\Interfaces\FilesystemInterface (interface)](#interface-gravframeworkfilesysteminterfacesfilesysteminterface)
- [\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)
- [\Grav\Framework\Flex\Flex](#class-gravframeworkflexflex)
- [\Grav\Framework\Flex\FlexIndex](#class-gravframeworkflexflexindex)
- [\Grav\Framework\Flex\FlexForm](#class-gravframeworkflexflexform)
- [\Grav\Framework\Flex\FlexCollection](#class-gravframeworkflexflexcollection)
- [\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)
- [\Grav\Framework\Flex\Interfaces\FlexCollectionInterface (interface)](#interface-gravframeworkflexinterfacesflexcollectioninterface)
- [\Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface (interface)](#interface-gravframeworkflexinterfacesflexauthorizeinterface)
- [\Grav\Framework\Flex\Interfaces\FlexFormInterface (interface)](#interface-gravframeworkflexinterfacesflexforminterface)
- [\Grav\Framework\Flex\Interfaces\FlexStorageInterface (interface)](#interface-gravframeworkflexinterfacesflexstorageinterface)
- [\Grav\Framework\Flex\Interfaces\FlexObjectInterface (interface)](#interface-gravframeworkflexinterfacesflexobjectinterface)
- [\Grav\Framework\Flex\Interfaces\FlexCommonInterface (interface)](#interface-gravframeworkflexinterfacesflexcommoninterface)
- [\Grav\Framework\Flex\Interfaces\FlexIndexInterface (interface)](#interface-gravframeworkflexinterfacesflexindexinterface)
- [\Grav\Framework\Flex\Storage\SimpleStorage](#class-gravframeworkflexstoragesimplestorage)
- [\Grav\Framework\Flex\Storage\FolderStorage](#class-gravframeworkflexstoragefolderstorage)
- [\Grav\Framework\Flex\Storage\FileStorage](#class-gravframeworkflexstoragefilestorage)
- [\Grav\Framework\Flex\Storage\AbstractFilesystemStorage (abstract)](#class-gravframeworkflexstorageabstractfilesystemstorage-abstract)
- [\Grav\Framework\Form\FormFlash](#class-gravframeworkformformflash)
- [\Grav\Framework\Form\FormFlashFile](#class-gravframeworkformformflashfile)
- [\Grav\Framework\Form\Interfaces\FormFactoryInterface (interface)](#interface-gravframeworkforminterfacesformfactoryinterface)
- [\Grav\Framework\Form\Interfaces\FormInterface (interface)](#interface-gravframeworkforminterfacesforminterface)
- [\Grav\Framework\Interfaces\RenderInterface (interface)](#interface-gravframeworkinterfacesrenderinterface)
- [\Grav\Framework\Media\Interfaces\MediaObjectInterface (interface)](#interface-gravframeworkmediainterfacesmediaobjectinterface)
- [\Grav\Framework\Media\Interfaces\MediaManipulationInterface (interface)](#interface-gravframeworkmediainterfacesmediamanipulationinterface)
- [\Grav\Framework\Media\Interfaces\MediaInterface (interface)](#interface-gravframeworkmediainterfacesmediainterface)
- [\Grav\Framework\Media\Interfaces\MediaCollectionInterface (interface)](#interface-gravframeworkmediainterfacesmediacollectioninterface)
- [\Grav\Framework\Object\PropertyObject](#class-gravframeworkobjectpropertyobject)
- [\Grav\Framework\Object\ObjectCollection](#class-gravframeworkobjectobjectcollection)
- [\Grav\Framework\Object\ArrayObject](#class-gravframeworkobjectarrayobject)
- [\Grav\Framework\Object\ObjectIndex (abstract)](#class-gravframeworkobjectobjectindex-abstract)
- [\Grav\Framework\Object\LazyObject](#class-gravframeworkobjectlazyobject)
- [\Grav\Framework\Object\Collection\ObjectExpressionVisitor](#class-gravframeworkobjectcollectionobjectexpressionvisitor)
- [\Grav\Framework\Object\Interfaces\NestedObjectInterface (interface)](#interface-gravframeworkobjectinterfacesnestedobjectinterface)
- [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface (interface)](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)
- [\Grav\Framework\Object\Interfaces\ObjectInterface (interface)](#interface-gravframeworkobjectinterfacesobjectinterface)
- [\Grav\Framework\Pagination\PaginationPage](#class-gravframeworkpaginationpaginationpage)
- [\Grav\Framework\Pagination\Pagination](#class-gravframeworkpaginationpagination)
- [\Grav\Framework\Pagination\AbstractPaginationPage (abstract)](#class-gravframeworkpaginationabstractpaginationpage-abstract)
- [\Grav\Framework\Pagination\AbstractPagination](#class-gravframeworkpaginationabstractpagination)
- [\Grav\Framework\Pagination\Interfaces\PaginationInterface (interface)](#interface-gravframeworkpaginationinterfacespaginationinterface)
- [\Grav\Framework\Pagination\Interfaces\PaginationPageInterface (interface)](#interface-gravframeworkpaginationinterfacespaginationpageinterface)
- [\Grav\Framework\Psr7\AbstractUri (abstract)](#class-gravframeworkpsr7abstracturi-abstract)
- [\Grav\Framework\Psr7\Response](#class-gravframeworkpsr7response)
- [\Grav\Framework\Psr7\Stream](#class-gravframeworkpsr7stream)
- [\Grav\Framework\Psr7\Request](#class-gravframeworkpsr7request)
- [\Grav\Framework\Psr7\Uri](#class-gravframeworkpsr7uri)
- [\Grav\Framework\Psr7\UploadedFile](#class-gravframeworkpsr7uploadedfile)
- [\Grav\Framework\Psr7\ServerRequest](#class-gravframeworkpsr7serverrequest)
- [\Grav\Framework\RequestHandler\RequestHandler](#class-gravframeworkrequesthandlerrequesthandler)
- [\Grav\Framework\RequestHandler\Exception\NotFoundException](#class-gravframeworkrequesthandlerexceptionnotfoundexception)
- [\Grav\Framework\RequestHandler\Exception\PageExpiredException](#class-gravframeworkrequesthandlerexceptionpageexpiredexception)
- [\Grav\Framework\RequestHandler\Exception\NotHandledException](#class-gravframeworkrequesthandlerexceptionnothandledexception)
- [\Grav\Framework\RequestHandler\Exception\InvalidArgumentException](#class-gravframeworkrequesthandlerexceptioninvalidargumentexception)
- [\Grav\Framework\RequestHandler\Exception\RequestException](#class-gravframeworkrequesthandlerexceptionrequestexception)
- [\Grav\Framework\RequestHandler\Middlewares\Exceptions](#class-gravframeworkrequesthandlermiddlewaresexceptions)
- [\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)
- [\Grav\Framework\Route\RouteFactory](#class-gravframeworkrouteroutefactory)
- [\Grav\Framework\Session\Session](#class-gravframeworksessionsession)
- [\Grav\Framework\Session\SessionInterface (interface)](#interface-gravframeworksessionsessioninterface)
- [\Grav\Framework\Session\Exceptions\SessionException](#class-gravframeworksessionexceptionssessionexception)
- [\Grav\Framework\Uri\UriFactory](#class-gravframeworkuriurifactory)
- [\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)
- [\Grav\Framework\Uri\UriPartsFilter](#class-gravframeworkuriuripartsfilter)
- [\Grav\Installer\Install](#class-gravinstallerinstall)

<hr /><a id="class-gravcommontaxonomy"></a>
### Class: \Grav\Common\Taxonomy

> The Taxonomy object is a singleton that holds a reference to a 'taxonomy map'. This map is constructed as a multidimensional array. uses the taxonomy defined in the site.yaml file and is built when the page objects are recursed. Basically every time a page is found that has taxonomy references, an entry to the page is stored in the taxonomy map.  The map has the following format: [taxonomy_type][taxonomy_value][page_path] For example: [category][blog][path/to/item1] [tag][grav][path/to/item1] [tag][grav][path/to/item2] [tag][dog][path/to/item3]

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Constructor that resets the map</em> |
| public | <strong>addTaxonomy(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>array</em> <strong>$page_taxonomy=null</strong>)</strong> : <em>void</em><br /><em>Takes an individual page and processes the taxonomies configured in its header. It then adds those taxonomies to the map</em> |
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

> The GravCache object is used throughout Grav to store and retrieve cached data. It uses DoctrineCache library and supports a variety of caching mechanisms. Those include: APCu RedisCache MemCache MemCacheD FileSystem

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public static | <strong>clearCache(</strong><em>string</em> <strong>$remove=`'standard'`</strong>)</strong> : <em>array</em><br /><em>Helper method to clear all Grav caches</em> |
| public static | <strong>clearJob(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>void</em><br /><em>Static function to call as a scheduled Job to clear Grav cache</em> |
| public | <strong>contains(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>bool true if the cached items exists</em><br /><em>Returns a boolean state of whether or not the item exists in the cache based on id key</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>bool true if the item was deleted successfully</em><br /><em>Deletes an item in the cache based on the id</em> |
| public | <strong>deleteAll()</strong> : <em>bool</em><br /><em>Deletes all cache</em> |
| public | <strong>fetch(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>object/bool returns the cached entry, can be any type, or false if doesn't exist</em><br /><em>Gets a cached entry if it exists based on an id. If it does not exist, it returns false</em> |
| public | <strong>getCacheDriver()</strong> : <em>DoctrineCache\CacheProvider The cache driver to use</em><br /><em>Automatically picks the cache mechanism to use.  If you pick one manually it will use that If there is no config option for $driver in the config, or it's set to 'auto', it will pick the best option based on which cache extensions are installed.</em> |
| public | <strong>getCacheStatus()</strong> : <em>string</em><br /><em>Get cache state</em> |
| public | <strong>getDriverName()</strong> : <em>mixed</em><br /><em>Returns the current driver name</em> |
| public | <strong>getDriverSetting()</strong> : <em>mixed</em><br /><em>Returns the current driver setting</em> |
| public | <strong>getEnabled()</strong> : <em>bool</em><br /><em>Returns the current enabled state</em> |
| public | <strong>getKey()</strong> : <em>mixed</em><br /><em>Getter method to get the cache key</em> |
| public | <strong>getLifetime()</strong> : <em>mixed</em><br /><em>Retrieve the cache lifetime (in seconds)</em> |
| public | <strong>getSimpleCache()</strong> : <em>\Psr\SimpleCache\CacheInterface</em> |
| public | <strong>init(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>)</strong> : <em>void</em><br /><em>Initialization that sets a base key and the driver based on configuration settings</em> |
| public static | <strong>invalidateCache()</strong> : <em>void</em> |
| public | <strong>isVolatileDriver(</strong><em>string</em> <strong>$setting</strong>)</strong> : <em>bool</em><br /><em>is this driver a volatile driver in that it resides in PHP process memory</em> |
| public | <strong>onSchedulerInitialized(</strong><em>\RocketTheme\Toolbox\Event\Event</em> <strong>$event</strong>)</strong> : <em>void</em> |
| public static | <strong>purgeJob()</strong> : <em>void</em><br /><em>Static function to call as a scheduled Job to purge old Doctrine files</em> |
| public | <strong>purgeOldCache()</strong> : <em>int</em><br /><em>Deletes the old out of date file-based caches</em> |
| public | <strong>save(</strong><em>string</em> <strong>$id</strong>, <em>array/object</em> <strong>$data</strong>, <em>int</em> <strong>$lifetime=null</strong>)</strong> : <em>void</em><br /><em>Stores a new cached entry.</em> |
| public | <strong>setEnabled(</strong><em>bool/int</em> <strong>$enabled</strong>)</strong> : <em>void</em><br /><em>Public accessor to set the enabled state of the cache</em> |
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
| public | <strike><strong>all()</strong> : <em>array Attributes</em></strike><br /><em>DEPRECATED - 1.5 Use ->getAll() method instead.</em> |
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
| public static | <strike><strong>instance()</strong> : <em>[\Grav\Framework\Session\Session](#class-gravframeworksessionsession)</em></strike><br /><em>DEPRECATED - 1.5 Use ->getInstance() method instead.</em> |
| public | <strong>invalidate()</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Invalidates the current session.</em> |
| public | <strong>isStarted()</strong> : <em>bool</em><br /><em>Checks if the session was started.</em> |
| public | <strong>setAutoStart(</strong><em>bool</em> <strong>$auto</strong>)</strong> : <em>\Grav\Common\$this</em> |
| public | <strong>setFlashCookieObject(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$object</strong>, <em>int</em> <strong>$time=60</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Store something in cookie temporarily.</em> |
| public | <strong>setFlashObject(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$object</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Store something in session temporarily.</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session ID</em> |
| public | <strong>setName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session name</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Sets session.* ini variables.</em> |
| public | <strong>start(</strong><em>bool</em> <strong>$readonly=false</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Starts the session storage</em> |
| public | <strike><strong>started()</strong> : <em>Boolean</em></strike><br /><em>DEPRECATED - 1.5 Use ->isStarted() method instead.</em> |

*This class extends [\Grav\Framework\Session\Session](#class-gravframeworksessionsession)*

*This class implements \IteratorAggregate, \Traversable, [\Grav\Framework\Session\SessionInterface](#interface-gravframeworksessionsessioninterface)*

<hr /><a id="class-gravcommonplugin"></a>
### Class: \Grav\Common\Plugin

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$name</strong>, <em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$grav</strong>, <em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config=null</strong>)</strong> : <em>void</em><br /><em>Constructor.</em> |
| public | <strong>config()</strong> : <em>array</em><br /><em>Get configuration of the plugin.</em> |
| public | <strong>getBlueprint()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Simpler getter for the plugin blueprint</em> |
| public static | <strong>getSubscribedEvents()</strong> : <em>array</em><br /><em>By default assign all methods as listeners using the default priority.</em> |
| public | <strong>isAdmin()</strong> : <em>bool</em><br /><em>Determine if plugin is running under the admin</em> |
| public | <strong>isCli()</strong> : <em>bool</em><br /><em>Determine if plugin is running under the CLI</em> |
| public | <strong>offsetExists(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public static | <strong>saveConfig(</strong><em>string</em> <strong>$plugin_name</strong>)</strong> : <em>bool</em><br /><em>Persists to disk the plugin parameters currently stored in the Grav Config object</em> |
| public | <strong>setConfig(</strong><em>[\Grav\Common\Config\Config](#class-gravcommonconfigconfig)</em> <strong>$config</strong>)</strong> : <em>\Grav\Common\$this</em> |
| protected | <strong>disable(</strong><em>array</em> <strong>$events</strong>)</strong> : <em>void</em> |
| protected | <strong>enable(</strong><em>array</em> <strong>$events</strong>)</strong> : <em>void</em> |
| protected | <strong>isPluginActiveAdmin(</strong><em>string</em> <strong>$plugin_route</strong>)</strong> : <em>bool</em><br /><em>Determine if this route is in Admin and active for the plugin</em> |
| protected | <strong>loadBlueprint()</strong> : <em>mixed</em><br /><em>Load blueprints.</em> |
| protected | <strong>mergeConfig(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>bool/mixed</em> <strong>$deep=false</strong>, <em>array</em> <strong>$params=array()</strong>, <em>string</em> <strong>$type=`'plugins'`</strong>)</strong> : <em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em><br /><em>Merge global and page configurations. plugin settings. merge with the plugin settings.</em> |
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
| protected | <strong>mergeConfig(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>string</em> <strong>$deep=`'merge'`</strong>, <em>array</em> <strong>$params=array()</strong>, <em>string</em> <strong>$type=`'themes'`</strong>)</strong> : <em>void</em><br /><em>Override the mergeConfig method to work for themes</em> |

*This class extends [\Grav\Common\Plugin](#class-gravcommonplugin)*

*This class implements \ArrayAccess, \Symfony\Component\EventDispatcher\EventSubscriberInterface, \RocketTheme\Toolbox\Event\EventSubscriberInterface*

<hr /><a id="class-gravcommonplugins"></a>
### Class: \Grav\Common\Plugins

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>add(</strong><em>[\Grav\Common\Plugin](#class-gravcommonplugin)</em> <strong>$plugin</strong>)</strong> : <em>void</em><br /><em>Add a plugin</em> |
| public static | <strong>all()</strong> : <em>array</em><br /><em>Return list of all plugin data with their blueprints.</em> |
| public static | <strong>get(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Common\Data/null</em><br /><em>Get a plugin by name</em> |
| public | <strong>init()</strong> : <em>Plugin[] array of Plugin objects</em><br /><em>Registers all plugins.</em> |
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
| public | <strong>addCollector(</strong><em>\Grav\Common\DataCollectorInterface</em> <strong>$collector</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Adds a data collector</em> |
| public | <strong>addException(</strong><em>[\Exception](http://php.net/manual/en/class.exception.php)</em> <strong>$e</strong>)</strong> : <em>[\Grav\Common\Debugger](#class-gravcommondebugger)</em><br /><em>Dump exception into the Messages tab of the Debug Bar</em> |
| public | <strong>addMessage(</strong><em>mixed</em> <strong>$message</strong>, <em>string</em> <strong>$label=`'info'`</strong>, <em>bool</em> <strong>$isString=true</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Dump variables into the Messages tab of the Debug Bar</em> |
| public | <strong>deprecatedErrorHandler(</strong><em>int</em> <strong>$errno</strong>, <em>string</em> <strong>$errstr</strong>, <em>string</em> <strong>$errfile</strong>, <em>int</em> <strong>$errline</strong>)</strong> : <em>bool</em> |
| public | <strong>enabled(</strong><em>bool</em> <strong>$state=null</strong>)</strong> : <em>bool</em><br /><em>Set/get the enabled state of the debugger</em> |
| public | <strong>getCaller(</strong><em>mixed</em> <strong>$limit=2</strong>)</strong> : <em>mixed</em> |
| public | <strong>getCollector(</strong><em>\Grav\Common\DataCollectorInterface</em> <strong>$collector</strong>)</strong> : <em>\DebugBar\DataCollector\DataCollectorInterface</em><br /><em>Returns a data collector</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Returns collected debugger data.</em> |
| public | <strong>init()</strong> : <em>\Grav\Common\$this</em><br /><em>Initialize the debugger</em> |
| public | <strong>render()</strong> : <em>\Grav\Common\$this</em><br /><em>Displays the debug bar</em> |
| public | <strong>sendDataInHeaders()</strong> : <em>\Grav\Common\$this</em><br /><em>Sends the data through the HTTP headers</em> |
| public | <strong>setErrorHandler()</strong> : <em>void</em> |
| public | <strong>startTimer(</strong><em>string</em> <strong>$name</strong>, <em>string/null</em> <strong>$description=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Start a timer with an associated name and description</em> |
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
| public static | <strong>cleanPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>mixed/string</em><br /><em>Removes extra double slashes and fixes back-slashes</em> |
| public static | <strong>convertUrl(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>string/array</em> <strong>$url</strong>, <em>string</em> <strong>$type=`'link'`</strong>, <em>bool</em> <strong>$absolute=false</strong>, <em>bool</em> <strong>$route_only=false</strong>)</strong> : <em>string/array the more friendly formatted url</em><br /><em>Converts links from absolute '/' or relative (../..) to a Grav friendly format</em> |
| public static | <strong>convertUrlOld(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>string</em> <strong>$markdown_url</strong>, <em>string</em> <strong>$type=`'link'`</strong>, <em>null</em> <strong>$relative=null</strong>)</strong> : <em>string the more friendly formatted url</em><br /><em>Converts links from absolute '/' or relative (../..) to a Grav friendly format</em> |
| public | <strong>currentPage()</strong> : <em>int</em><br /><em>Return current page number.</em> |
| public | <strong>environment()</strong> : <em>String</em><br /><em>Gets the environment name</em> |
| public | <strong>extension(</strong><em>string/null</em> <strong>$default=null</strong>)</strong> : <em>string The extension of the URI</em><br /><em>Return the Extension of the URI</em> |
| public static | <strong>extractParams(</strong><em>mixed</em> <strong>$uri</strong>, <em>mixed</em> <strong>$delimiter</strong>)</strong> : <em>void</em> |
| public static | <strong>filterPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string The RFC 3986 percent-encoded uri path.</em><br /><em>Filter Uri path. This method percent-encodes all reserved characters in the provided path string. This method will NOT double-encode characters that are already percent-encoded.</em> |
| public static | <strong>filterQuery(</strong><em>string</em> <strong>$query</strong>)</strong> : <em>string The percent-encoded query string.</em><br /><em>Filters the query string or fragment of a URI.</em> |
| public static | <strong>filterUserInfo(</strong><em>string</em> <strong>$info</strong>)</strong> : <em>string The percent-encoded user or password string.</em><br /><em>Filters the user info string.</em> |
| public | <strong>fragment(</strong><em>string</em> <strong>$fragment=null</strong>)</strong> : <em>string/null</em><br /><em>Gets the Fragment portion of a URI (eg #target)</em> |
| public | <strong>getContentType(</strong><em>bool</em> <strong>$short=true</strong>)</strong> : <em>null/string</em><br /><em>Get content type from request</em> |
| public static | <strong>getCurrentRoute()</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em><br /><em>Returns current route.</em> |
| public static | <strong>getCurrentUri()</strong> : <em>[\Grav\Framework\Uri\Uri](#class-gravframeworkuriuri)</em><br /><em>Returns current Uri.</em> |
| public | <strong>host()</strong> : <em>string/null The host of the URI</em><br /><em>Return the host of the URI</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the URI object based on the url set on the object</em> |
| public | <strong>initializeWithUrl(</strong><em>string</em> <strong>$url=`''`</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Initialize the URI class with a url passed via parameter. Used for testing purposes.</em> |
| public | <strong>initializeWithUrlAndRootPath(</strong><em>string</em> <strong>$url</strong>, <em>string</em> <strong>$root_path</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Initialize the URI class by providing url and root_path arguments</em> |
| public static | <strong>ip()</strong> : <em>string ip address</em><br /><em>Return the IP address of the current user</em> |
| public static | <strong>isExternal(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>boolean is eternal state</em><br /><em>Is this an external URL? if it starts with `http` then yes, else false</em> |
| public | <strong>isValidExtension(</strong><em>mixed</em> <strong>$extension</strong>)</strong> : <em>bool</em><br /><em>Check if this is a valid Grav extension</em> |
| public static | <strong>isValidUrl(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>bool</em><br /><em>Is the passed in URL a valid URL?</em> |
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
| public | <strong>setUriProperties(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>[\Grav\Common\Uri](#class-gravcommonuri)</em><br /><em>Allow overriding of any element (be careful!)</em> |
| public | <strong>toArray(</strong><em>bool</em> <strong>$full=false</strong>)</strong> : <em>void</em> |
| public | <strong>toOriginalString()</strong> : <em>void</em> |
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
| public static | <strong>arrayCombine(</strong><em>array</em> <strong>$arr1</strong>, <em>array</em> <strong>$arr2</strong>)</strong> : <em>array/false</em><br /><em>Array combine but supports different array lengths</em> |
| public static | <strong>arrayDiffMultidimensional(</strong><em>array</em> <strong>$array1</strong>, <em>array</em> <strong>$array2</strong>)</strong> : <em>array</em><br /><em>Returns an array with the differences between $array1 and $array2</em> |
| public static | <strong>arrayFilterRecursive(</strong><em>array</em> <strong>$source</strong>, <em>callable</em> <strong>$fn</strong>)</strong> : <em>array</em><br /><em>Recursively filter an array, filtering values by processing them through the $fn function argument</em> |
| public static | <strong>arrayFlatten(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>array</em><br /><em>Flatten an array</em> |
| public static | <strong>arrayFlattenDotNotation(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$prepend=`''`</strong>)</strong> : <em>array</em><br /><em>Flatten a multi-dimensional associative array into dot notation</em> |
| public static | <strong>arrayIsAssociative(</strong><em>array</em> <strong>$arr</strong>)</strong> : <em>bool</em><br /><em>Array is associative or not</em> |
| public static | <strong>arrayMergeRecursiveUnique(</strong><em>array</em> <strong>$array1</strong>, <em>array</em> <strong>$array2</strong>)</strong> : <em>array</em><br /><em>Recursive Merge with uniqueness</em> |
| public static | <strong>arrayUnflattenDotNotation(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>array</em><br /><em>Opposite of flatten, convert flat dot notation array to multi dimensional array</em> |
| public static | <strong>checkFilename(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>bool</em><br /><em>Returns true if filename is considered safe.</em> |
| public static | <strong>contains(</strong><em>string</em> <strong>$haystack</strong>, <em>string/string[]</em> <strong>$needle</strong>, <em>bool</em> <strong>$case_sensitive=true</strong>)</strong> : <em>bool</em><br /><em>Check if the $haystack string contains the substring $needle</em> |
| public static | <strong>convertSize(</strong><em>int</em> <strong>$bytes</strong>, <em>string</em> <strong>$to</strong>, <em>int</em> <strong>$decimal_places=1</strong>)</strong> : <em>int Returns only the number of units, not the type letter. Returns if the $to unit type is out of scope.</em><br /><em>Convert bytes to the unit specified by the $to parameter.</em> |
| public static | <strong>date2timestamp(</strong><em>string</em> <strong>$date</strong>, <em>string</em> <strong>$format=null</strong>)</strong> : <em>int the timestamp</em><br /><em>Get the timestamp of a date strtotime argument</em> |
| public static | <strong>dateFormats()</strong> : <em>array</em><br /><em>Return the Grav date formats allowed</em> |
| public static | <strong>dateNow(</strong><em>string/null</em> <strong>$default_format=null</strong>)</strong> : <em>string</em><br /><em>Get current date/time</em> |
| public static | <strong>download(</strong><em>string</em> <strong>$file</strong>, <em>bool</em> <strong>$force_download=true</strong>, <em>int</em> <strong>$sec</strong>, <em>int</em> <strong>$bytes=1024</strong>)</strong> : <em>void</em><br /><em>Provides the ability to download a file to the browser</em> |
| public static | <strong>endsWith(</strong><em>string</em> <strong>$haystack</strong>, <em>string/string[]</em> <strong>$needle</strong>, <em>bool</em> <strong>$case_sensitive=true</strong>)</strong> : <em>bool</em><br /><em>Check if the $haystack string ends with the substring $needle</em> |
| public static | <strong>generateRandomString(</strong><em>int</em> <strong>$length=5</strong>)</strong> : <em>string</em><br /><em>Generate a random string of a given length</em> |
| public static | <strong>getDotNotation(</strong><em>array</em> <strong>$array</strong>, <em>string/int</em> <strong>$key</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Get a portion of an array (passed by reference) with dot-notation key</em> |
| public static | <strong>getExtensionByMime(</strong><em>string</em> <strong>$mime</strong>, <em>string</em> <strong>$default=`'html'`</strong>)</strong> : <em>string</em><br /><em>Return the mimetype based on filename extension</em> |
| public static | <strong>getExtensions(</strong><em>array</em> <strong>$mimetypes</strong>)</strong> : <em>array</em><br /><em>Get all the extensions for an array of mimetypes</em> |
| public static | <strong>getMimeByExtension(</strong><em>string</em> <strong>$extension</strong>, <em>string</em> <strong>$default=`'application/octet-stream'`</strong>)</strong> : <em>string</em><br /><em>Return the mimetype based on filename extension</em> |
| public static | <strong>getMimeByFilename(</strong><em>string</em> <strong>$filename</strong>, <em>string</em> <strong>$default=`'application/octet-stream'`</strong>)</strong> : <em>string</em><br /><em>Return the mimetype based on filename</em> |
| public static | <strong>getMimeByLocalFile(</strong><em>string</em> <strong>$filename</strong>, <em>string</em> <strong>$default=`'application/octet-stream'`</strong>)</strong> : <em>string/bool</em><br /><em>Return the mimetype based on existing local file</em> |
| public static | <strong>getMimeTypes(</strong><em>array</em> <strong>$extensions</strong>)</strong> : <em>array</em><br /><em>Get all the mimetypes for an array of extensions</em> |
| public static | <strong>getNonce(</strong><em>string</em> <strong>$action</strong>, <em>bool</em> <strong>$previousTick=false</strong>)</strong> : <em>string the nonce</em><br /><em>Creates a hashed nonce tied to the passed action. Tied to the current user and time. The nonce for a given action is the same for 12 hours.</em> |
| public static | <strong>getPagePathFromToken(</strong><em>string</em> <strong>$path</strong>, <em>\Grav\Common\PageInterface/null/[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page=null</strong>)</strong> : <em>string</em><br /><em>Get's path based on a token</em> |
| public static | <strong>getSubnet(</strong><em>string</em> <strong>$ip</strong>, <em>int</em> <strong>$prefix=64</strong>)</strong> : <em>string</em><br /><em>Find the subnet of an ip with CIDR prefix size</em> |
| public static | <strong>getUploadLimit()</strong> : <em>mixed</em> |
| public static | <strong>isAdminPlugin()</strong> : <em>bool</em><br /><em>Simple helper method to get whether or not the admin plugin is active</em> |
| public static | <strong>isApache()</strong> : <em>bool</em><br /><em>Utility to determine if the server running PHP is Apache</em> |
| public static | <strong>isFunctionDisabled(</strong><em>string</em> <strong>$function</strong>)</strong> : <em>bool</em><br /><em>Check whether a function is disabled in the PHP settings</em> |
| public static | <strong>isPositive(</strong><em>string</em> <strong>$value</strong>)</strong> : <em>boolean</em><br /><em>Checks if a value is positive</em> |
| public static | <strong>isWindows()</strong> : <em>bool</em><br /><em>Utility method to determine if the current OS is Windows</em> |
| public static | <strong>matchWildcard(</strong><em>string</em> <strong>$wildcard_pattern</strong>, <em>string</em> <strong>$haystack</strong>)</strong> : <em>false/int</em><br /><em>Function that can match wildcards match_wildcard('foo*', $test),      // TRUE match_wildcard('bar*', $test),      // FALSE match_wildcard('*bar*', $test),     // TRUE match_wildcard('**blob**', $test),  // TRUE match_wildcard('*a?d*', $test),     // TRUE match_wildcard('*etc**', $test)     // TRUE</em> |
| public static | <strong>mb_substr_replace(</strong><em>string</em> <strong>$original</strong>, <em>string</em> <strong>$replacement</strong>, <em>int</em> <strong>$position</strong>, <em>int</em> <strong>$length</strong>)</strong> : <em>string</em><br /><em>Multibyte compatible substr_replace</em> |
| public static | <strong>mergeObjects(</strong><em>object</em> <strong>$obj1</strong>, <em>object</em> <strong>$obj2</strong>)</strong> : <em>object</em><br /><em>Merge two objects into one.</em> |
| public static | <strong>multibyteParseUrl(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>array</em><br /><em>Multibyte-safe Parse URL function</em> |
| public static | <strong>normalizePath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Normalize path by processing relative `.` and `..` syntax and merging path</em> |
| public static | <strong>parseSize(</strong><em>string/int</em> <strong>$size</strong>)</strong> : <em>int</em><br /><em>Parse a readable file size and return a value in bytes</em> |
| public static | <strong>pathPrefixedByLangCode(</strong><em>string</em> <strong>$string</strong>)</strong> : <em>bool</em><br /><em>Checks if the passed path contains the language code prefix</em> |
| public static | <strong>prettySize(</strong><em>int</em> <strong>$bytes</strong>, <em>int</em> <strong>$precision=2</strong>)</strong> : <em>string</em><br /><em>Return a pretty size based on bytes</em> |
| public static | <strong>processMarkdown(</strong><em>string</em> <strong>$string</strong>, <em>bool</em> <strong>$block=true</strong>)</strong> : <em>string</em><br /><em>Process a string as markdown</em> |
| public static | <strong>replaceFirstOccurrence(</strong><em>string</em> <strong>$search</strong>, <em>string</em> <strong>$replace</strong>, <em>string</em> <strong>$subject</strong>)</strong> : <em>string</em><br /><em>Utility method to replace only the first occurrence in a string</em> |
| public static | <strong>replaceLastOccurrence(</strong><em>string</em> <strong>$search</strong>, <em>string</em> <strong>$replace</strong>, <em>string</em> <strong>$subject</strong>)</strong> : <em>string</em><br /><em>Utility method to replace only the last occurrence in a string</em> |
| public static | <strike><strong>resolve(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$path</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use ->getDotNotation() method instead.</em> |
| public static | <strong>safeTruncate(</strong><em>string</em> <strong>$string</strong>, <em>int</em> <strong>$limit=150</strong>)</strong> : <em>string</em><br /><em>Truncate text by number of characters in a "word-safe" manor.</em> |
| public static | <strong>safeTruncateHtml(</strong><em>string</em> <strong>$text</strong>, <em>int</em> <strong>$length=25</strong>, <em>string</em> <strong>$ellipsis=`'...'`</strong>)</strong> : <em>string</em><br /><em>Truncate HTML by number of characters in a "word-safe" manor.</em> |
| public static | <strong>setDotNotation(</strong><em>array</em> <strong>$array</strong>, <em>string/int</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>bool</em> <strong>$merge=false</strong>)</strong> : <em>mixed</em><br /><em>Set portion of array (passed by reference) for a dot-notation key and set the value</em> |
| public static | <strong>sortArrayByArray(</strong><em>array</em> <strong>$array</strong>, <em>array</em> <strong>$orderArray</strong>)</strong> : <em>array</em><br /><em>Sort a multidimensional array  by another array of ordered keys</em> |
| public static | <strong>sortArrayByKey(</strong><em>mixed</em> <strong>$array</strong>, <em>string/int</em> <strong>$array_key</strong>, <em>int</em> <strong>$direction=3</strong>, <em>int</em> <strong>$sort_flags</strong>)</strong> : <em>array</em><br /><em>Sort an array by a key value in the array</em> |
| public static | <strong>startsWith(</strong><em>string</em> <strong>$haystack</strong>, <em>string/string[]</em> <strong>$needle</strong>, <em>bool</em> <strong>$case_sensitive=true</strong>)</strong> : <em>bool</em><br /><em>Check if the $haystack string starts with the substring $needle</em> |
| public static | <strong>substrToString(</strong><em>string</em> <strong>$haystack</strong>, <em>string</em> <strong>$needle</strong>, <em>bool</em> <strong>$case_sensitive=true</strong>)</strong> : <em>string</em><br /><em>Returns the substring of a string up to a specified needle.  if not found, return the whole haystack</em> |
| public static | <strong>timezones()</strong> : <em>array</em><br /><em>Get the formatted timezones list</em> |
| public static | <strong>truncate(</strong><em>string</em> <strong>$string</strong>, <em>int</em> <strong>$limit=150</strong>, <em>bool</em> <strong>$up_to_break=false</strong>, <em>string</em> <strong>$break=`' '`</strong>, <em>string</em> <strong>$pad=`'&hellip;'`</strong>)</strong> : <em>string</em><br /><em>Truncate text by number of characters but can cut off words.</em> |
| public static | <strong>truncateHtml(</strong><em>string</em> <strong>$text</strong>, <em>int</em> <strong>$length=100</strong>, <em>string</em> <strong>$ellipsis=`'...'`</strong>)</strong> : <em>string</em><br /><em>Truncate HTML by number of characters. not "word-safe"!</em> |
| public static | <strong>url(</strong><em>string</em> <strong>$input</strong>, <em>bool</em> <strong>$domain=false</strong>)</strong> : <em>bool/null/string</em><br /><em>Simple helper method to make getting a Grav URL easier</em> |
| public static | <strong>verifyNonce(</strong><em>string/string[]</em> <strong>$nonce</strong>, <em>string</em> <strong>$action</strong>)</strong> : <em>boolean verified or not</em><br /><em>Verify the passed nonce for the give action</em> |

<hr /><a id="class-gravcommongrav"></a>
### Class: \Grav\Common\Grav

> Grav container is the heart of Grav.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em><br /><em>Magic Catch All Function Used to call closures. Source: http://stackoverflow.com/questions/419804/closures-as-class-members</em> |
| public | <strong>fallbackUrl(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>void</em><br /><em>This attempts to find media, other files, and download them</em> |
| public | <strong>fireEvent(</strong><em>string</em> <strong>$eventName</strong>, <em>\RocketTheme\Toolbox\Event\Event</em> <strong>$event=null</strong>)</strong> : <em>\RocketTheme\Toolbox\Event\Event</em><br /><em>Fires an event with optional parameters.</em> |
| public | <strong>header(</strong><em>\Grav\Common\ResponseInterface/null/\Psr\Http\Message\ResponseInterface</em> <strong>$response=null</strong>)</strong> : <em>void</em><br /><em>Set response header.</em> |
| public static | <strong>instance(</strong><em>array</em> <strong>$values=array()</strong>)</strong> : <em>[\Grav\Common\Grav](#class-gravcommongrav)</em><br /><em>Return the Grav instance. Create it if it's not already instanced</em> |
| public | <strong>measureTime(</strong><em>\string</em> <strong>$timerId</strong>, <em>\string</em> <strong>$timerTitle</strong>, <em>\callable</em> <strong>$callback</strong>)</strong> : <em>mixed Returns value returned by the callable.</em><br /><em>Measure how long it takes to do an action.</em> |
| public | <strong>process()</strong> : <em>void</em><br /><em>Process a request</em> |
| public | <strong>redirect(</strong><em>string</em> <strong>$route</strong>, <em>int</em> <strong>$code=null</strong>)</strong> : <em>void</em><br /><em>Redirect browser to another location.</em> |
| public | <strong>redirectLangSafe(</strong><em>string</em> <strong>$route</strong>, <em>int</em> <strong>$code=null</strong>)</strong> : <em>void</em><br /><em>Redirect browser to another location taking language into account (preferred)</em> |
| public static | <strong>resetInstance()</strong> : <em>void</em><br /><em>Reset the Grav instance.</em> |
| public | <strong>setLocale()</strong> : <em>void</em><br /><em>Set the system locale based on the language and configuration</em> |
| public | <strong>setup(</strong><em>\string</em> <strong>$environment=null</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Setup Grav instance using specific environment. Initializes Grav streams by</em> |
| public | <strong>shutdown()</strong> : <em>void</em><br /><em>Set the final content length for the page and flush the buffer</em> |
| protected static | <strong>load(</strong><em>array</em> <strong>$values</strong>)</strong> : <em>\Grav\Common\static</em><br /><em>Initialize and return a Grav instance</em> |
| protected | <strong>registerServices()</strong> : <em>void</em><br /><em>Register all services Services are defined in the diMap. They can either only the class of a Service Provider or a pair of serviceKey => serviceClass that gets directly mapped into the container.</em> |

*This class extends [\Grav\Framework\DI\Container](#class-gravframeworkdicontainer)*

*This class implements \Psr\Container\ContainerInterface, \ArrayAccess*

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
| public | <strong>isTrackable()</strong> : <em>bool</em><br /><em>Determine if “Do Not Track” is set by browser</em> |

<hr /><a id="class-gravcommonsecurity"></a>
### Class: \Grav\Common\Security

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>detectXss(</strong><em>string</em> <strong>$string</strong>)</strong> : <em>bool/string Type of XSS vector if the given `$string` may contain XSS, false otherwise. Copies the code from: https://github.com/symphonycms/xssfilter/blob/master/extension.driver.php#L138</em><br /><em>Determine if string potentially has a XSS attack. This simple function does not catch all XSS and it is likely to return false positives because of it tags all potentially dangerous HTML tags and attributes without looking into their content.</em> |
| public static | <strong>detectXssFromArray(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$prefix=`''`</strong>)</strong> : <em>array Returns flatten list of potentially dangerous input values, such as 'data.content'.</em> |
| public static | <strong>detectXssFromPages(</strong><em>[\Grav\Common\Page\Pages](#class-gravcommonpagepages)</em> <strong>$pages</strong>, <em>bool</em> <strong>$route=true</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommoninflector"></a>
### Class: \Grav\Common\Inflector

> This file was originally part of the Akelos Framework

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>camelize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string UpperCamelCasedWord</em><br /><em>Returns given word as CamelCased Converts a word like "send_email" to "SendEmail". It will remove non alphanumeric character from the word, so "who's online" will be converted to "WhoSOnline"</em> |
| public static | <strong>classify(</strong><em>string</em> <strong>$table_name</strong>)</strong> : <em>string SingularClassName</em><br /><em>Converts a table name to its class name according to rails naming conventions. Converts "people" to "Person"</em> |
| public static | <strong>humanize(</strong><em>string</em> <strong>$word</strong>, <em>string</em> <strong>$uppercase=`''`</strong>)</strong> : <em>string Human-readable word</em><br /><em>Returns a human-readable string from $word Returns a human-readable string from $word, by replacing underscores with a space, and by upper-casing the initial character by default. If you need to uppercase all the words you just have to pass 'all' as a second parameter. instead of just the first one.</em> |
| public static | <strong>hyphenize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string hyphenized word</em><br /><em>Converts a word "into-it-s-hyphenated-version" Convert any "CamelCased" or "ordinary Word" into an "hyphenated-word". This can be really useful for creating friendly URLs.</em> |
| public static | <strong>init()</strong> : <em>void</em> |
| public static | <strong>monthize(</strong><em>int</em> <strong>$days</strong>)</strong> : <em>int</em><br /><em>Converts a number of days to a number of months</em> |
| public static | <strong>ordinalize(</strong><em>int</em> <strong>$number</strong>)</strong> : <em>string Ordinal representation of given string.</em><br /><em>Converts number to its ordinal English form. This method converts 13 to 13th, 2 to 2nd ...</em> |
| public static | <strong>pluralize(</strong><em>string</em> <strong>$word</strong>, <em>int</em> <strong>$count=2</strong>)</strong> : <em>string Plural noun</em><br /><em>Pluralizes English nouns.</em> |
| public static | <strong>singularize(</strong><em>string</em> <strong>$word</strong>, <em>int</em> <strong>$count=1</strong>)</strong> : <em>string Singular noun.</em><br /><em>Singularizes English nouns.</em> |
| public static | <strong>tableize(</strong><em>string</em> <strong>$class_name</strong>)</strong> : <em>string plural_table_name</em><br /><em>Converts a class name to its table name according to rails naming conventions. Converts "Person" to "people"</em> |
| public static | <strong>titleize(</strong><em>string</em> <strong>$word</strong>, <em>string</em> <strong>$uppercase=`''`</strong>)</strong> : <em>string Text formatted as title</em><br /><em>Converts an underscored or CamelCase word into a English sentence. The titleize public function converts text like "WelcomePage", "welcome_page" or  "welcome page" to this "Welcome Page". If second parameter is set to 'first' it will only capitalize the first character of the title. first character. Otherwise it will uppercase all the words in the title.</em> |
| public static | <strong>underscorize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string Underscored word</em><br /><em>Converts a word "into_it_s_underscored_version" Convert any "CamelCased" or "ordinary Word" into an "underscored_word". This can be really useful for creating friendly URLs.</em> |
| public static | <strong>variablize(</strong><em>string</em> <strong>$word</strong>)</strong> : <em>string Returns a lowerCamelCasedWord</em><br /><em>Same as camelize but first char is underscored Converts a word like "send_email" to "sendEmail". It will remove non alphanumeric character from the word, so "who's online" will be converted to "whoSOnline"</em> |

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
| public | <strong>remove(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Remove item from the list.</em> |
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
| public | <strong>add(</strong><em>array/string</em> <strong>$asset</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an asset or a collection of assets. It automatically detects the asset type (JavaScript, CSS or collection). You may add more than one asset passing an array as argument.</em> |
| public | <strike><strong>addAsyncJs(</strong><em>string/array</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=10</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$group=`'head'`</strong>)</strong> : <em>[\Grav\Common\Assets](#class-gravcommonassets)</em></strike><br /><em>DEPRECATED - Please use dynamic method with ['loading' => 'async'].</em> |
| public | <strong>addCss(</strong><em>mixed</em> <strong>$asset</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add a CSS asset or a collection of assets.</em> |
| public | <strike><strong>addDeferJs(</strong><em>string/array</em> <strong>$asset</strong>, <em>int</em> <strong>$priority=10</strong>, <em>bool</em> <strong>$pipeline=true</strong>, <em>string</em> <strong>$group=`'head'`</strong>)</strong> : <em>[\Grav\Common\Assets](#class-gravcommonassets)</em></strike><br /><em>DEPRECATED - Please use dynamic method with ['loading' => 'defer'].</em> |
| public | <strong>addDir(</strong><em>string</em> <strong>$directory</strong>, <em>string</em> <strong>$pattern=`'/.\.(css|js)$/i'`</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add all assets matching $pattern within $directory.</em> |
| public | <strong>addDirCss(</strong><em>string</em> <strong>$directory</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add all CSS assets within $directory</em> |
| public | <strong>addDirJs(</strong><em>string</em> <strong>$directory</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add all JavaScript assets within $directory</em> |
| public | <strong>addInlineCss(</strong><em>mixed</em> <strong>$asset</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an Inline CSS asset or a collection of assets.</em> |
| public | <strong>addInlineJs(</strong><em>mixed</em> <strong>$asset</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add an Inline JS asset or a collection of assets.</em> |
| public | <strong>addJs(</strong><em>mixed</em> <strong>$asset</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add a JS asset or a collection of assets.</em> |
| public | <strong>config(</strong><em>array</em> <strong>$config</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Set up configuration options. All the class properties except 'js' and 'css' are accepted here. Also, an extra option 'autoload' may be passed containing an array of assets and/or collections that will be automatically added on startup.</em> |
| public | <strong>css(</strong><em>string</em> <strong>$group=`'head'`</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>string</em><br /><em>Build the CSS link tags.</em> |
| public | <strong>exists(</strong><em>string</em> <strong>$asset</strong>)</strong> : <em>bool</em><br /><em>Determines if an asset exists as a collection, CSS or JS reference</em> |
| public | <strong>getCollections()</strong> : <em>array</em><br /><em>Return the array of all the registered collections</em> |
| public | <strong>getCss(</strong><em>null/string</em> <strong>$key=null</strong>)</strong> : <em>array</em><br /><em>Return the array of all the registered CSS assets If a $key is provided, it will try to return only that asset else it will return null</em> |
| public | <strong>getJs(</strong><em>null/string</em> <strong>$key=null</strong>)</strong> : <em>array</em><br /><em>Return the array of all the registered JS assets If a $key is provided, it will try to return only that asset else it will return null</em> |
| public | <strong>getTimestamp(</strong><em>bool</em> <strong>$include_join=true</strong>)</strong> : <em>string</em><br /><em>Get the timestamp for assets</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initialization called in the Grav lifecycle to initialize the Assets with appropriate configuration</em> |
| public | <strong>js(</strong><em>string</em> <strong>$group=`'head'`</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>string</em><br /><em>Build the JavaScript script tags.</em> |
| public | <strong>registerCollection(</strong><em>string</em> <strong>$collectionName</strong>, <em>array</em> <strong>$assets</strong>, <em>bool</em> <strong>$overwrite=false</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Add/replace collection.</em> |
| public | <strong>removeCss(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Removes an item from the CSS array if set</em> |
| public | <strong>removeJs(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Removes an item from the JS array if set</em> |
| public | <strong>render(</strong><em>mixed</em> <strong>$type</strong>, <em>string</em> <strong>$group=`'head'`</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>void</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\$this</em><br /><em>Reset all assets.</em> |
| public | <strong>resetCss()</strong> : <em>\Grav\Common\$this</em><br /><em>Reset CSS assets.</em> |
| public | <strong>resetJs()</strong> : <em>\Grav\Common\$this</em><br /><em>Reset JavaScript assets.</em> |
| public | <strong>setCollection(</strong><em>array</em> <strong>$collections</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Set the array of collections explicitly</em> |
| public | <strong>setCss(</strong><em>array</em> <strong>$css</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Set the whole array of CSS assets</em> |
| public | <strong>setCssPipeline(</strong><em>bool</em> <strong>$value</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Sets the state of CSS Pipeline</em> |
| public | <strong>setJs(</strong><em>array</em> <strong>$js</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Set the whole array of JS assets</em> |
| public | <strong>setJsPipeline(</strong><em>bool</em> <strong>$value</strong>)</strong> : <em>\Grav\Common\$this</em><br /><em>Sets the state of JS Pipeline</em> |
| public | <strong>setTimestamp(</strong><em>string/int</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Explicitly set's a timestamp for assets</em> |
| protected | <strong>addType(</strong><em>mixed</em> <strong>$collection</strong>, <em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$asset</strong>, <em>mixed</em> <strong>$options</strong>)</strong> : <em>void</em> |
| protected | <strong>createArgumentsFromLegacy(</strong><em>array</em> <strong>$args</strong>, <em>array</em> <strong>$defaults</strong>)</strong> : <em>mixed</em> |
| protected | <strong>filterAssets(</strong><em>mixed</em> <strong>$assets</strong>, <em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>bool</em> <strong>$sort=false</strong>)</strong> : <em>void</em> |
| protected | <strong>rglob(</strong><em>string</em> <strong>$directory</strong>, <em>string</em> <strong>$pattern</strong>, <em>string</em> <strong>$ltrim=null</strong>)</strong> : <em>array</em><br /><em>Recursively get files matching $pattern within $directory.</em> |
| protected | <strong>sortAssets(</strong><em>mixed</em> <strong>$assets</strong>)</strong> : <em>void</em> |
| protected | <strong>unifyLegacyArguments(</strong><em>array</em> <strong>$args</strong>, <em>string</em> <strong>$type=`'Css'`</strong>)</strong> : <em>array</em> |

*This class extends [\Grav\Framework\Object\PropertyObject](#class-gravframeworkobjectpropertyobject)*

*This class implements \ArrayAccess, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \JsonSerializable, \Serializable, [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="class-gravcommonassetsinlinecss"></a>
### Class: \Grav\Common\Assets\InlineCss

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>mixed</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>render()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Assets\BaseAsset](#class-gravcommonassetsbaseasset-abstract)*

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravcommonassetsjs"></a>
### Class: \Grav\Common\Assets\Js

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>mixed</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>render()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Assets\BaseAsset](#class-gravcommonassetsbaseasset-abstract)*

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravcommonassetsbaseasset-abstract"></a>
### Class: \Grav\Common\Assets\BaseAsset (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>mixed</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>getAsset()</strong> : <em>mixed</em> |
| public | <strong>getRemote()</strong> : <em>mixed</em> |
| public | <strong>init(</strong><em>mixed</em> <strong>$asset</strong>, <em>mixed</em> <strong>$options</strong>)</strong> : <em>void</em> |
| public static | <strong>isRemoteLink(</strong><em>string</em> <strong>$link</strong>)</strong> : <em>bool</em><br /><em>Determine whether a link is local or remote. Understands both "http://" and "https://" as well as protocol agnostic links "//"</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>abstract render()</strong> : <em>void</em> |
| public | <strong>setPosition(</strong><em>mixed</em> <strong>$position</strong>)</strong> : <em>void</em> |
| protected | <strong>buildLocalLink(</strong><em>string</em> <strong>$asset</strong>)</strong> : <em>string the final link url to the asset</em><br /><em>Build local links including grav asset shortcodes</em> |
| protected | <strong>cssRewrite(</strong><em>string</em> <strong>$file</strong>, <em>string</em> <strong>$dir</strong>, <em>bool</em> <strong>$local</strong>)</strong> : <em>void</em><br /><em>Placeholder for AssetUtilsTrait method</em> |
| protected | <strong>gatherLinks(</strong><em>array</em> <strong>$assets</strong>, <em>bool</em> <strong>$css=true</strong>)</strong> : <em>string</em><br /><em>Download and concatenate the content of several links.</em> |
| protected | <strong>moveImports(</strong><em>string</em> <strong>$file</strong>)</strong> : <em>string the modified file with any @imports at the top of the file</em><br /><em>Moves @import statements to the top of the file per the CSS specification</em> |
| protected | <strong>renderAttributes()</strong> : <em>string</em><br /><em>Build an HTML attribute string from an array.</em> |
| protected | <strong>renderQueryString(</strong><em>string</em> <strong>$asset=null</strong>)</strong> : <em>string</em><br /><em>Render Querystring</em> |

*This class extends [\Grav\Framework\Object\PropertyObject](#class-gravframeworkobjectpropertyobject)*

*This class implements \ArrayAccess, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \JsonSerializable, \Serializable, [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="class-gravcommonassetsinlinejs"></a>
### Class: \Grav\Common\Assets\InlineJs

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>mixed</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>render()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Assets\BaseAsset](#class-gravcommonassetsbaseasset-abstract)*

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravcommonassetspipeline"></a>
### Class: \Grav\Common\Assets\Pipeline

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>\string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public static | <strong>isRemoteLink(</strong><em>string</em> <strong>$link</strong>)</strong> : <em>bool</em><br /><em>Determine whether a link is local or remote. Understands both "http://" and "https://" as well as protocol agnostic links "//"</em> |
| public | <strong>renderCss(</strong><em>array</em> <strong>$assets</strong>, <em>string</em> <strong>$group</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>bool/string URL or generated content if available, else false</em><br /><em>Minify and concatenate CSS</em> |
| public | <strong>renderJs(</strong><em>array</em> <strong>$assets</strong>, <em>string</em> <strong>$group</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>bool/string URL or generated content if available, else false</em><br /><em>Minify and concatenate JS files.</em> |
| protected | <strong>cssRewrite(</strong><em>string</em> <strong>$file</strong>, <em>string</em> <strong>$dir</strong>, <em>bool</em> <strong>$local</strong>)</strong> : <em>mixed</em><br /><em>Finds relative CSS urls() and rewrites the URL with an absolute one</em> |
| protected | <strong>gatherLinks(</strong><em>array</em> <strong>$assets</strong>, <em>bool</em> <strong>$css=true</strong>)</strong> : <em>string</em><br /><em>Download and concatenate the content of several links.</em> |
| protected | <strong>moveImports(</strong><em>string</em> <strong>$file</strong>)</strong> : <em>string the modified file with any @imports at the top of the file</em><br /><em>Moves @import statements to the top of the file per the CSS specification</em> |
| protected | <strong>renderAttributes()</strong> : <em>string</em><br /><em>Build an HTML attribute string from an array.</em> |
| protected | <strong>renderQueryString(</strong><em>string</em> <strong>$asset=null</strong>)</strong> : <em>string</em><br /><em>Render Querystring</em> |

*This class extends [\Grav\Framework\Object\PropertyObject](#class-gravframeworkobjectpropertyobject)*

*This class implements \ArrayAccess, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \JsonSerializable, \Serializable, [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="class-gravcommonassetscss"></a>
### Class: \Grav\Common\Assets\Css

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>mixed</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>render()</strong> : <em>void</em> |

*This class extends [\Grav\Common\Assets\BaseAsset](#class-gravcommonassetsbaseasset-abstract)*

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="class-gravcommonbackupbackups"></a>
### Class: \Grav\Common\Backup\Backups

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>backup(</strong><em>int</em> <strong>$id</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>null/string</em><br /><em>Backup</em> |
| public static | <strong>getAvailableBackups(</strong><em>bool</em> <strong>$force=false</strong>)</strong> : <em>mixed</em> |
| public | <strong>getBackupDownloadUrl(</strong><em>mixed</em> <strong>$backup</strong>, <em>mixed</em> <strong>$base_url</strong>)</strong> : <em>mixed</em> |
| public | <strong>getBackupNames()</strong> : <em>mixed</em> |
| public static | <strong>getBackupProfiles()</strong> : <em>mixed</em> |
| public static | <strong>getPurgeConfig()</strong> : <em>mixed</em> |
| public static | <strong>getTotalBackupsSize()</strong> : <em>mixed</em> |
| public | <strong>init()</strong> : <em>void</em> |
| public | <strong>onSchedulerInitialized(</strong><em>\RocketTheme\Toolbox\Event\Event</em> <strong>$event</strong>)</strong> : <em>void</em> |
| public static | <strong>purge()</strong> : <em>void</em> |
| public | <strong>setup()</strong> : <em>void</em> |
| protected static | <strong>convertExclude(</strong><em>mixed</em> <strong>$exclude</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommonconfigcompiledlanguages"></a>
### Class: \Grav\Common\Config\CompiledLanguages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$cacheFolder</strong>, <em>array</em> <strong>$files</strong>, <em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>modified()</strong> : <em>void</em><br /><em>Function gets called when cached configuration is saved.</em> |
| protected | <strong>createObject(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create configuration object.</em> |
| protected | <strong>finalizeObject()</strong> : <em>void</em><br /><em>Finalize configuration object.</em> |
| protected | <strong>loadFile(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$filename</strong>)</strong> : <em>mixed</em><br /><em>Load single configuration file and append it to the correct position.</em> |

*This class extends [\Grav\Common\Config\CompiledBase](#class-gravcommonconfigcompiledbase-abstract)*

<hr /><a id="class-gravcommonconfigcompiledconfig"></a>
### Class: \Grav\Common\Config\CompiledConfig

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$cacheFolder</strong>, <em>array</em> <strong>$files</strong>, <em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
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
| public | <strong>flattenByLang(</strong><em>mixed</em> <strong>$lang</strong>)</strong> : <em>void</em> |
| public | <strong>mergeRecursive(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>modified(</strong><em>mixed</em> <strong>$modified=null</strong>)</strong> : <em>void</em> |
| public | <strong>reformat()</strong> : <em>void</em> |
| public | <strong>timestamp(</strong><em>mixed</em> <strong>$timestamp=null</strong>)</strong> : <em>void</em> |
| public | <strong>unflatten(</strong><em>mixed</em> <strong>$array</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

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
| public | <strike><strong>getLanguages()</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.5 Use Grav::instance()['languages'] instead.</em> |
| public | <strong>init()</strong> : <em>void</em> |
| public | <strong>key()</strong> : <em>void</em> |
| public | <strong>modified(</strong><em>mixed</em> <strong>$modified=null</strong>)</strong> : <em>void</em> |
| public | <strong>reload()</strong> : <em>void</em> |
| public | <strong>timestamp(</strong><em>mixed</em> <strong>$timestamp=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

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

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

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

> Class CompiledBlueprints

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$cacheFolder</strong>, <em>array</em> <strong>$files</strong>, <em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
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
| public | <strong>__clone()</strong> : <em>void</em> |
| public | <strong>addDynamicHandler(</strong><em>\string</em> <strong>$name</strong>, <em>\callable</em> <strong>$callable</strong>)</strong> : <em>void</em> |
| public | <strong>extra(</strong><em>array</em> <strong>$data</strong>, <em>string</em> <strong>$prefix=`''`</strong>)</strong> : <em>array</em><br /><em>Return data fields that do not exist in blueprints.</em> |
| public | <strong>filter(</strong><em>array</em> <strong>$data</strong>, <em>\bool</em> <strong>$missingValuesAsNull=false</strong>, <em>\bool</em> <strong>$keepEmptyValues=false</strong>)</strong> : <em>array</em><br /><em>Filter data by using blueprints.</em> |
| public | <strong>flattenData(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Flatten data by using blueprints.</em> |
| public | <strong>getDefaults()</strong> : <em>array</em><br /><em>Get nested structure containing default values defined in the blueprints. Fields without default value are ignored in the list.</em> |
| public | <strong>init()</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Initialize blueprints with its dynamic fields.</em> |
| public | <strong>mergeData(</strong><em>array</em> <strong>$data1</strong>, <em>array</em> <strong>$data2</strong>, <em>string</em> <strong>$name=null</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>array</em><br /><em>Merge two arrays by using blueprints.</em> |
| public | <strong>processForm(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$toggles=array()</strong>)</strong> : <em>array</em><br /><em>Process data coming from a form.</em> |
| public | <strong>schema()</strong> : <em>[\Grav\Common\Data\BlueprintSchema](#class-gravcommondatablueprintschema)</em><br /><em>Return blueprint data schema.</em> |
| public | <strong>setScope(</strong><em>mixed</em> <strong>$scope</strong>)</strong> : <em>void</em> |
| public | <strong>setTypes(</strong><em>array</em> <strong>$types</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set default values for field types.</em> |
| public | <strong>validate(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Validate data against blueprints.</em> |
| protected | <strong>addPropertyRecursive(</strong><em>mixed</em> <strong>$field</strong>, <em>mixed</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>dynamicConfig(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>dynamicData(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>dynamicScope(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>dynamicSecurity(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
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
| public | <strong>filter()</strong> : <em>\Grav\Common\Data\$this</em> |
| public | <strong>get(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
| public | <strong>getDefaults()</strong> : <em>array</em><br /><em>Get nested structure containing default values defined in the blueprints. Fields without default value are ignored in the list.</em> |
| public | <strong>getJoined(</strong><em>string</em> <strong>$name</strong>, <em>array/object</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>array</em><br /><em>Get value from the configuration and join it with given data.</em> |
| public | <strong>join(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Join nested values together by using blueprints.</em> |
| public | <strong>joinDefaults(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>\Grav\Common\Data\$this</em><br /><em>Set default values by using blueprints.</em> |
| public | <strong>jsonSerialize()</strong> : <em>void</em> |
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

*This class implements [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \JsonSerializable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommondatavalidation"></a>
### Class: \Grav\Common\Data\Validation

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>filter(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>mixed Filtered value.</em><br /><em>Filter value against a blueprint field definition.</em> |
| public static | <strong>filterIgnore(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
| public static | <strong>filterItem_List(</strong><em>mixed</em> <strong>$value</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public static | <strong>filterUnset(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
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
| public static | <strong>typeUnset(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>bool True if validation succeeded.</em><br /><em>Input value which can be ignored.</em> |
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
| protected static | <strong>filterCheckbox(</strong><em>mixed</em> <strong>$value</strong>, <em>array</em> <strong>$params</strong>, <em>array</em> <strong>$field</strong>)</strong> : <em>void</em> |
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
| public | <strong>filter(</strong><em>array</em> <strong>$data</strong>, <em>bool</em> <strong>$missingValuesAsNull=false</strong>, <em>bool</em> <strong>$keepEmptyValues=false</strong>)</strong> : <em>array</em><br /><em>Filter data by using blueprints.</em> |
| public | <strong>flattenData(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Flatten data by using blueprints.</em> |
| public | <strong>getType(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>array</em> |
| public | <strong>getTypes()</strong> : <em>array</em> |
| public | <strong>processForm(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$toggles=array()</strong>)</strong> : <em>array</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=3</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>validate(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Validate data against blueprints.</em> |
| protected | <strong>checkRequired(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$fields</strong>)</strong> : <em>array</em> |
| protected | <strong>dynamicConfig(</strong><em>array</em> <strong>$field</strong>, <em>string</em> <strong>$property</strong>, <em>array</em> <strong>$call</strong>)</strong> : <em>void</em> |
| protected | <strong>filterArray(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$rules</strong>, <em>bool</em> <strong>$missingValuesAsNull</strong>, <em>bool</em> <strong>$keepEmptyValues</strong>)</strong> : <em>array</em> |
| protected | <strong>flattenArray(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$rules</strong>, <em>\string</em> <strong>$prefix</strong>)</strong> : <em>array</em> |
| protected | <strong>processFormRecursive(</strong><em>array/null/array</em> <strong>$data</strong>, <em>array</em> <strong>$toggles</strong>, <em>array</em> <strong>$nested</strong>)</strong> : <em>array/null</em> |
| protected | <strong>validateArray(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$rules</strong>)</strong> : <em>array</em> |

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
| protected | <strong>getResource(</strong><em>string</em> <strong>$resource</strong>)</strong> : <em>string</em> |

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

<hr /><a id="class-gravcommonfilesystemarchiver-abstract"></a>
### Class: \Grav\Common\Filesystem\Archiver (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>abstract addEmptyFolders(</strong><em>mixed</em> <strong>$folders</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |
| public | <strong>abstract compress(</strong><em>mixed</em> <strong>$folder</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |
| public static | <strong>create(</strong><em>mixed</em> <strong>$compression</strong>)</strong> : <em>mixed</em> |
| public | <strong>abstract extract(</strong><em>mixed</em> <strong>$destination</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |
| public | <strong>setArchive(</strong><em>mixed</em> <strong>$archive_file</strong>)</strong> : <em>void</em> |
| public | <strong>setOptions(</strong><em>mixed</em> <strong>$options</strong>)</strong> : <em>void</em> |
| protected | <strong>getArchiveFiles(</strong><em>mixed</em> <strong>$rootPath</strong>)</strong> : <em>mixed</em> |

<hr /><a id="class-gravcommonfilesystemrecursivedirectoryfilteriterator"></a>
### Class: \Grav\Common\Filesystem\RecursiveDirectoryFilterIterator

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\RecursiveIterator</em> <strong>$iterator</strong>, <em>string</em> <strong>$root</strong>, <em>array</em> <strong>$ignore_folders</strong>, <em>array</em> <strong>$ignore_files</strong>)</strong> : <em>void</em><br /><em>Create a RecursiveFilterIterator from a RecursiveIterator</em> |
| public | <strong>accept()</strong> : <em>bool true if the current element is acceptable, otherwise false.</em><br /><em>Check whether the current element of the iterator is acceptable</em> |
| public | <strong>getChildren()</strong> : <em>mixed</em> |

*This class extends \RecursiveFilterIterator*

*This class implements \RecursiveIterator, \OuterIterator, \Traversable, \Iterator*

<hr /><a id="class-gravcommonfilesystemrecursivefolderfilteriterator"></a>
### Class: \Grav\Common\Filesystem\RecursiveFolderFilterIterator

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\RecursiveIterator</em> <strong>$iterator</strong>, <em>array</em> <strong>$ignore_folders=array()</strong>)</strong> : <em>void</em><br /><em>Create a RecursiveFilterIterator from a RecursiveIterator</em> |
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
| public static | <strong>hashAllFiles(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Recursively md5 hash all files in a path</em> |
| public static | <strong>lastModifiedFile(</strong><em>string</em> <strong>$path</strong>, <em>string</em> <strong>$extensions=`'md|yaml'`</strong>)</strong> : <em>int</em><br /><em>Recursively find the last modified time under given path by file.</em> |
| public static | <strong>lastModifiedFolder(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>int</em><br /><em>Recursively find the last modified time under given path.</em> |
| public static | <strong>mkdir(</strong><em>string</em> <strong>$folder</strong>)</strong> : <em>void</em> |
| public static | <strong>move(</strong><em>string</em> <strong>$source</strong>, <em>string</em> <strong>$target</strong>)</strong> : <em>void</em><br /><em>Move directory in filesystem.</em> |
| public static | <strong>rcopy(</strong><em>string</em> <strong>$src</strong>, <em>string</em> <strong>$dest</strong>)</strong> : <em>bool</em><br /><em>Recursive copy of one directory to another</em> |
| public static | <strong>shift(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Shift first directory out of the path.</em> |
| protected static | <strong>doDelete(</strong><em>string</em> <strong>$folder</strong>, <em>bool</em> <strong>$include_target=true</strong>)</strong> : <em>bool</em> |

<hr /><a id="class-gravcommonfilesystemziparchiver"></a>
### Class: \Grav\Common\Filesystem\ZipArchiver

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addEmptyFolders(</strong><em>mixed</em> <strong>$folders</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |
| public | <strong>compress(</strong><em>mixed</em> <strong>$source</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |
| public | <strong>extract(</strong><em>mixed</em> <strong>$destination</strong>, <em>\callable</em> <strong>$status=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Filesystem\Archiver](#class-gravcommonfilesystemarchiver-abstract)*

<hr /><a id="class-gravcommonformformflash"></a>
### Class: \Grav\Common\Form\FormFlash

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>clearSession(</strong><em>\string</em> <strong>$sessionId</strong>)</strong> : <em>void</em> |
| public | <strike><strong>cropFile(</strong><em>\string</em> <strong>$field</strong>, <em>\string</em> <strong>$filename</strong>, <em>array</em> <strong>$upload</strong>, <em>array</em> <strong>$crop</strong>)</strong> : <em>bool</em></strike><br /><em>DEPRECATED - 1.6 For backwards compatibility only, do not use</em> |
| public | <strike><strong>getLegacyFiles()</strong> : <em>array</em></strike><br /><em>DEPRECATED - 1.6 For backwards compatibility only, do not use</em> |
| public static | <strong>getSessionTmpDir(</strong><em>\string</em> <strong>$sessionId</strong>)</strong> : <em>string</em> |
| public | <strong>setUser(</strong><em>\Grav\Common\Form\UserInterface/null/[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user=null</strong>)</strong> : <em>\Grav\Common\Form\$this</em> |
| public | <strike><strong>uploadFile(</strong><em>\string</em> <strong>$field</strong>, <em>\string</em> <strong>$filename</strong>, <em>array</em> <strong>$upload</strong>)</strong> : <em>bool</em></strike><br /><em>DEPRECATED - 1.6 For backwards compatibility only, do not use</em> |
| protected | <strong>getTmpIndex()</strong> : <em>\RocketTheme\Toolbox\File\YamlFile</em> |
| protected | <strong>removeTmpDir()</strong> : <em>void</em> |
| protected | <strong>removeTmpFile(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Form\FormFlash](#class-gravframeworkformformflash)*

*This class implements \JsonSerializable*

<hr /><a id="class-gravcommongpmresponse"></a>
### Class: \Grav\Common\GPM\Response

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>get(</strong><em>string</em> <strong>$uri=`''`</strong>, <em>array</em> <strong>$options=array()</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>string The response of the request</em><br /><em>Makes a request to the URL by using the preferred method</em> |
| public static | <strong>isCurlAvailable()</strong> : <em>bool</em><br /><em>Checks if cURL is available</em> |
| public static | <strong>isFopenAvailable()</strong> : <em>bool</em><br /><em>Checks if the remote fopen request is enabled in PHP</em> |
| public static | <strong>isRemote(</strong><em>string</em> <strong>$file</strong>)</strong> : <em>bool</em><br /><em>Is this a remote file or not</em> |
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
| public static | <strong>get(</strong><em>string</em> <strong>$slug=null</strong>)</strong> : <em>array/string</em><br /><em>Returns the license for a Premium package</em> |
| public static | <strong>getLicenseFile()</strong> : <em>\RocketTheme\Toolbox\File\FileInterface</em><br /><em>Get's the License File object</em> |
| public static | <strong>set(</strong><em>string</em> <strong>$slug</strong>, <em>string</em> <strong>$license</strong>)</strong> : <em>bool</em><br /><em>Returns the license for a Premium package</em> |
| public static | <strong>validate(</strong><em>string</em> <strong>$license=null</strong>)</strong> : <em>bool</em><br /><em>Validates the License format</em> |

<hr /><a id="class-gravcommongpminstaller"></a>
### Class: \Grav\Common\GPM\Installer

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>copyInstall(</strong><em>string</em> <strong>$source_path</strong>, <em>string</em> <strong>$install_path</strong>)</strong> : <em>bool</em> |
| public static | <strong>getMessage()</strong> : <em>string The message</em><br /><em>Returns the last message added by the installer</em> |
| public static | <strong>install(</strong><em>string</em> <strong>$zip</strong>, <em>string</em> <strong>$destination</strong>, <em>array</em> <strong>$options=array()</strong>, <em>string</em> <strong>$extracted=null</strong>, <em>bool</em> <strong>$keepExtracted=false</strong>)</strong> : <em>bool True if everything went fine, False otherwise.</em><br /><em>Installs a given package to a given destination.</em> |
| public static | <strong>isGravInstance(</strong><em>string</em> <strong>$target</strong>)</strong> : <em>bool True if is a Grav Instance. False otherwise</em><br /><em>Validates if the given path is a Grav Instance</em> |
| public static | <strong>isValidDestination(</strong><em>string</em> <strong>$destination</strong>, <em>array</em> <strong>$exclude=array()</strong>)</strong> : <em>bool True if validation passed. False otherwise</em><br /><em>Runs a set of checks on the destination and sets the Error if any</em> |
| public static | <strong>lastErrorCode()</strong> : <em>int/string The code of the last error</em><br /><em>Returns the last error code of the occurred error</em> |
| public static | <strong>lastErrorMsg()</strong> : <em>string The message of the last error</em><br /><em>Returns the last error occurred in a string message format</em> |
| public static | <strong>moveInstall(</strong><em>string</em> <strong>$source_path</strong>, <em>string</em> <strong>$install_path</strong>)</strong> : <em>bool</em> |
| public static | <strong>setError(</strong><em>int/string</em> <strong>$error</strong>)</strong> : <em>void</em><br /><em>Allows to manually set an error</em> |
| public static | <strong>sophisticatedInstall(</strong><em>string</em> <strong>$source_path</strong>, <em>string</em> <strong>$install_path</strong>, <em>array</em> <strong>$ignores=array()</strong>, <em>bool</em> <strong>$keep_source=false</strong>)</strong> : <em>bool</em> |
| public static | <strong>unZip(</strong><em>string</em> <strong>$zip_file</strong>, <em>string</em> <strong>$destination</strong>)</strong> : <em>bool/string</em><br /><em>Unzip a file to somewhere</em> |
| public static | <strong>uninstall(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$options=array()</strong>)</strong> : <em>bool True if everything went fine, False otherwise.</em><br /><em>Uninstalls one or more given package</em> |

<hr /><a id="class-gravcommongpmgpm"></a>
### Class: \Grav\Common\GPM\GPM

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>bool</em> <strong>$refresh=false</strong>, <em>callable</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>Creates a new GPM instance with Local and Remote packages available</em> |
| public | <strong>calculateMergedDependenciesOfPackages(</strong><em>array</em> <strong>$packages</strong>)</strong> : <em>mixed</em><br /><em>Calculates and merges the dependencies of the passed packages</em> |
| public | <strong>calculateVersionNumberFromDependencyVersion(</strong><em>string</em> <strong>$version</strong>)</strong> : <em>null/string</em><br /><em>Returns the actual version from a dependency version string. Examples: $versionInformation == '~2.0' => returns '2.0' $versionInformation == '>=2.0.2' => returns '2.0.2' $versionInformation == '2.0.2' => returns '2.0.2' $versionInformation == '*' => returns null $versionInformation == '' => returns null</em> |
| public | <strong>checkNextSignificantReleasesAreCompatible(</strong><em>string</em> <strong>$version1</strong>, <em>string</em> <strong>$version2</strong>)</strong> : <em>bool</em><br /><em>Check if two releases are compatible by next significant release ~1.2 is equivalent to >=1.2 <2.0.0 ~1.2.3 is equivalent to >=1.2.3 <1.3.0 In short, allows the last digit specified to go up</em> |
| public | <strong>checkNoOtherPackageNeedsTheseDependenciesInALowerVersion(</strong><em>mixed</em> <strong>$dependencies_slugs</strong>)</strong> : <em>void</em> |
| public | <strong>checkNoOtherPackageNeedsThisDependencyInALowerVersion(</strong><em>string</em> <strong>$slug</strong>, <em>string</em> <strong>$version_with_operator</strong>, <em>array</em> <strong>$ignore_packages_list</strong>)</strong> : <em>bool</em><br /><em>Check the package identified by $slug can be updated to the version passed as argument. Thrown an exception if it cannot be updated because another package installed requires it to be at an older version.</em> |
| public | <strong>checkPackagesCanBeInstalled(</strong><em>array</em> <strong>$packages_names_list</strong>)</strong> : <em>void</em><br /><em>Check the passed packages list can be updated</em> |
| public static | <strong>copyPackage(</strong><em>string</em> <strong>$package_file</strong>, <em>string</em> <strong>$tmp</strong>)</strong> : <em>null/string</em><br /><em>Copy the local zip package to tmp</em> |
| public | <strong>countInstalled()</strong> : <em>int Amount of installed packages</em><br /><em>Returns the amount of locally installed packages</em> |
| public | <strong>countUpdates()</strong> : <em>int Amount of available updates</em><br /><em>Returns the amount of updates available</em> |
| public static | <strong>downloadPackage(</strong><em>string</em> <strong>$package_file</strong>, <em>string</em> <strong>$tmp</strong>)</strong> : <em>null/string</em><br /><em>Download the zip package via the URL</em> |
| public | <strong>findPackage(</strong><em>string</em> <strong>$search</strong>, <em>bool</em> <strong>$ignore_exception=false</strong>)</strong> : <em>[\Grav\Common\GPM\Remote\Package](#class-gravcommongpmremotepackage)/bool Package if found, FALSE if not</em><br /><em>Searches for a Package in the repository</em> |
| public | <strong>findPackages(</strong><em>array</em> <strong>$searches=array()</strong>)</strong> : <em>array Array of found Packages Format: ['total' => int, 'not_found' => array, <found-slugs>]</em><br /><em>Searches for a list of Packages in the repository</em> |
| public static | <strong>getBlueprints(</strong><em>string</em> <strong>$source</strong>)</strong> : <em>array/bool</em><br /><em>Find/Parse the blueprint file</em> |
| public | <strong>getDependencies(</strong><em>array</em> <strong>$packages</strong>)</strong> : <em>mixed</em><br /><em>Fetch the dependencies, check the installed packages and return an array with the list of packages with associated an information on what to do: install, update or ignore. `ignore` means the package is already installed and can be safely left as-is. `install` means the package is not installed and must be installed. `update` means the package is already installed and must be updated as a dependency needs a higher version.</em> |
| public static | <strong>getInstallPath(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Get the install path for a name and a particular type of package</em> |
| public | <strong>getInstallable(</strong><em>array</em> <strong>$list_type_installed=array()</strong>)</strong> : <em>array The installed packages</em><br /><em>Returns the Locally installable packages</em> |
| public | <strong>getInstalled()</strong> : <em>[\Grav\Common\GPM\Local\Packages](#class-gravcommongpmlocalpackages)</em><br /><em>Return the locally installed packages</em> |
| public | <strong>getInstalledPackage(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>Local\Package The instance of the Package</em><br /><em>Return the instance of a specific Package</em> |
| public | <strong>getInstalledPlugin(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>Local\Package The instance of the Plugin</em><br /><em>Return the instance of a specific Plugin</em> |
| public | <strong>getInstalledPlugins()</strong> : <em>Iterator The installed plugins</em><br /><em>Returns the Locally installed plugins</em> |
| public | <strong>getInstalledTheme(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>Local\Package The instance of the Theme</em><br /><em>Return the instance of a specific Theme</em> |
| public | <strong>getInstalledThemes()</strong> : <em>Iterator The installed themes</em><br /><em>Returns the Locally installed themes</em> |
| public | <strong>getLatestVersionOfPackage(</strong><em>string</em> <strong>$package_name</strong>)</strong> : <em>string/null</em><br /><em>Get the latest release of a package from the GPM</em> |
| public static | <strong>getPackageName(</strong><em>string</em> <strong>$source</strong>)</strong> : <em>bool/string</em><br /><em>Try to guess the package name from the source files</em> |
| public static | <strong>getPackageType(</strong><em>string</em> <strong>$source</strong>)</strong> : <em>bool/string</em><br /><em>Try to guess the package type from the source files</em> |
| public | <strong>getPackagesThatDependOnPackage(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>array</em><br /><em>Return the list of packages that have the passed one as dependency</em> |
| public | <strong>getReleaseType(</strong><em>string</em> <strong>$package_name</strong>)</strong> : <em>string/null</em><br /><em>Get the release type of a package (stable / testing)</em> |
| public | <strong>getRepository()</strong> : <em>Remote\Packages Available Plugins and Themes Format: ['plugins' => array, 'themes' => array]</em><br /><em>Returns the list of Plugins and Themes available in the repository</em> |
| public | <strong>getRepositoryPlugin(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>mixed Package if found, NULL if not</em><br /><em>Returns a Plugin from the repository</em> |
| public | <strong>getRepositoryPlugins()</strong> : <em>Iterator The Plugins remotely available</em><br /><em>Returns the list of Plugins available in the repository</em> |
| public | <strong>getRepositoryTheme(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>mixed Package if found, NULL if not</em><br /><em>Returns a Theme from the repository</em> |
| public | <strong>getRepositoryThemes()</strong> : <em>Iterator The Themes remotely available</em><br /><em>Returns the list of Themes available in the repository</em> |
| public | <strong>getUpdatable(</strong><em>array</em> <strong>$list_type_update=array()</strong>)</strong> : <em>array Array of updatable Plugins and Themes. Format: ['total' => int, 'plugins' => array, 'themes' => array]</em><br /><em>Returns an array of Plugins and Themes that can be updated. Plugins and Themes are extended with the `available` property that relies to the remote version</em> |
| public | <strong>getUpdatablePlugins()</strong> : <em>array Array of updatable Plugins</em><br /><em>Returns an array of Plugins that can be updated. The Plugins are extended with the `available` property that relies to the remote version</em> |
| public | <strong>getUpdatableThemes()</strong> : <em>array Array of updatable Themes</em><br /><em>Returns an array of Themes that can be updated. The Themes are extended with the `available` property that relies to the remote version</em> |
| public | <strong>getVersionOfDependencyRequiredByPackage(</strong><em>string</em> <strong>$package_slug</strong>, <em>string</em> <strong>$dependency_slug</strong>)</strong> : <em>mixed</em><br /><em>Get the required version of a dependency of a package</em> |
| public | <strong>isPluginInstalled(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>bool True if the Plugin has been installed. False otherwise</em><br /><em>Checks if a Plugin is installed</em> |
| public | <strong>isPluginInstalledAsSymlink(</strong><em>mixed</em> <strong>$slug</strong>)</strong> : <em>bool</em> |
| public | <strong>isPluginUpdatable(</strong><em>string</em> <strong>$plugin</strong>)</strong> : <em>bool True if the Plugin is updatable. False otherwise</em><br /><em>Checks if a Plugin is updatable</em> |
| public | <strong>isStableRelease(</strong><em>string</em> <strong>$package_name</strong>)</strong> : <em>bool</em><br /><em>Returns true if the package latest release is stable</em> |
| public | <strong>isTestingRelease(</strong><em>string</em> <strong>$package_name</strong>)</strong> : <em>bool</em><br /><em>Returns true if the package latest release is testing</em> |
| public | <strong>isThemeInstalled(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>bool True if the Theme has been installed. False otherwise</em><br /><em>Checks if a Theme is installed</em> |
| public | <strong>isThemeUpdatable(</strong><em>string</em> <strong>$theme</strong>)</strong> : <em>bool True if the Theme is updatable. False otherwise</em><br /><em>Checks if a Theme is Updatable</em> |
| public | <strong>isUpdatable(</strong><em>string</em> <strong>$slug</strong>)</strong> : <em>bool True if updatable. False otherwise or if not found</em><br /><em>Check if a Plugin or Theme is updatable</em> |
| public | <strong>versionFormatIsEqualOrHigher(</strong><em>string</em> <strong>$version</strong>)</strong> : <em>bool</em><br /><em>Check if the passed version information contains equal or higher operator Example: returns true for $version: '>=2.0'</em> |
| public | <strong>versionFormatIsNextSignificantRelease(</strong><em>string</em> <strong>$version</strong>)</strong> : <em>bool</em><br /><em>Check if the passed version information contains next significant release (tilde) operator Example: returns true for $version: '~2.0'</em> |

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
| public | <strong>__set(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>void</em> |
| public | <strong>getData()</strong> : <em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em> |
| public | <strong>toArray()</strong> : <em>array</em> |
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
| public | <strong>jsonSerialize()</strong> : <em>void</em> |

*This class extends [\Grav\Common\GPM\Common\Package](#class-gravcommongpmcommonpackage)*

*This class implements \JsonSerializable*

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

<hr /><a id="class-gravcommonhelpersyamllinter"></a>
### Class: \Grav\Common\Helpers\YamlLinter

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>lint()</strong> : <em>void</em> |
| public static | <strong>lintConfig()</strong> : <em>void</em> |
| public static | <strong>lintPages()</strong> : <em>void</em> |
| public static | <strong>recurseFolder(</strong><em>mixed</em> <strong>$path</strong>, <em>string</em> <strong>$extensions=`'md|yaml'`</strong>)</strong> : <em>void</em> |
| protected static | <strong>extractYaml(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |

<hr /><a id="class-gravcommonhelpersexcerpts"></a>
### Class: \Grav\Common\Helpers\Excerpts

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getExcerptFromHtml(</strong><em>string</em> <strong>$html</strong>, <em>string</em> <strong>$tag</strong>)</strong> : <em>array/null returns nested array excerpt</em><br /><em>Get an Excerpt array from a chunk of HTML</em> |
| public static | <strong>getHtmlFromExcerpt(</strong><em>array</em> <strong>$excerpt</strong>)</strong> : <em>string</em><br /><em>Rebuild HTML tag from an excerpt array</em> |
| public static | <strong>processImageExcerpt(</strong><em>array</em> <strong>$excerpt</strong>, <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>)</strong> : <em>array</em><br /><em>Process an image excerpt</em> |
| public static | <strong>processImageHtml(</strong><em>string</em> <strong>$html</strong>, <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>)</strong> : <em>string Returns final HTML string</em><br /><em>Process Grav image media URL from HTML tag</em> |
| public static | <strong>processLinkExcerpt(</strong><em>array</em> <strong>$excerpt</strong>, <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>string</em> <strong>$type=`'link'`</strong>)</strong> : <em>mixed</em><br /><em>Process a Link excerpt</em> |
| public static | <strong>processMediaActions(</strong><em>\Grav\Common\Helpers\Medium</em> <strong>$medium</strong>, <em>string/array</em> <strong>$url</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Process media actions</em> |
| protected static | <strong>parseUrl(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>array/bool</em><br /><em>Variation of parse_url() which works also with local streams.</em> |
| protected static | <strong>resolveStream(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>bool/string</em> |

<hr /><a id="class-gravcommonhelpersbase32"></a>
### Class: \Grav\Common\Helpers\Base32

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>decode(</strong><em>string</em> <strong>$base32</strong>)</strong> : <em>string</em><br /><em>Decode in Base32</em> |
| public static | <strong>encode(</strong><em>string</em> <strong>$bytes</strong>)</strong> : <em>string</em><br /><em>Encode in Base32</em> |

<hr /><a id="class-gravcommonhelperstruncator"></a>
### Class: \Grav\Common\Helpers\Truncator

> This file is part of https://github.com/Bluetel-Solutions/twig-truncate-extension Copyright (c) 2015 Bluetel Solutions developers@bluetel.co.uk Copyright (c) 2015 Alex Wilson ajw@bluetel.co.uk For the full copyright and license information, please view the LICENSE file that was distributed with this source code.

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>htmlToDomDocument(</strong><em>string</em> <strong>$html</strong>)</strong> : <em>void</em><br /><em>Builds a DOMDocument object from a string containing HTML.</em> |
| public | <strong>truncate(</strong><em>mixed</em> <strong>$text</strong>, <em>mixed</em> <strong>$length=100</strong>, <em>string</em> <strong>$ending=`'...'`</strong>, <em>bool</em> <strong>$exact=false</strong>, <em>bool</em> <strong>$considerHtml=true</strong>)</strong> : <em>void</em> |
| public static | <strong>truncateLetters(</strong><em>string</em> <strong>$html</strong>, <em>int</em> <strong>$limit</strong>, <em>string</em> <strong>$ellipsis=`''`</strong>)</strong> : <em>string Safe truncated HTML.</em><br /><em>Safely truncates HTML by a given number of letters.</em> |
| public static | <strong>truncateWords(</strong><em>string</em> <strong>$html</strong>, <em>int</em> <strong>$limit</strong>, <em>string</em> <strong>$ellipsis=`''`</strong>)</strong> : <em>string Safe truncated HTML.</em><br /><em>Safely truncates HTML by a given number of words.</em> |

<hr /><a id="class-gravcommonhelperslogviewer"></a>
### Class: \Grav\Common\Helpers\LogViewer

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>levelColor(</strong><em>string</em> <strong>$level</strong>)</strong> : <em>mixed/string</em><br /><em>Helper class to get level color</em> |
| public | <strong>objectTail(</strong><em>string</em> <strong>$filepath</strong>, <em>int</em> <strong>$lines=1</strong>, <em>bool</em> <strong>$desc=true</strong>)</strong> : <em>array</em><br /><em>Get the objects of a tailed file</em> |
| public | <strong>parse(</strong><em>string</em> <strong>$line</strong>)</strong> : <em>array</em><br /><em>Parse a monolog row into array bits</em> |
| public static | <strong>parseTrace(</strong><em>string</em> <strong>$trace</strong>, <em>int</em> <strong>$rows=10</strong>)</strong> : <em>array</em><br /><em>Parse text of trace into an array of lines</em> |
| public | <strong>tail(</strong><em>string</em> <strong>$filepath</strong>, <em>int</em> <strong>$lines=1</strong>)</strong> : <em>bool/string</em><br /><em>Optimized way to get just the last few entries of a log file</em> |

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
| public | <strong>getActive()</strong> : <em>string</em><br /><em>Gets current active language</em> |
| public | <strong>getAvailable()</strong> : <em>string</em><br /><em>Gets a pipe-separated string of available languages</em> |
| public | <strike><strong>getBrowserLanguages(</strong><em>array</em> <strong>$accept_langs=array()</strong>)</strong> : <em>array</em></strike><br /><em>DEPRECATED - 1.6 No longer used - using content negotiation.</em> |
| public | <strong>getDefault()</strong> : <em>mixed</em><br /><em>Gets current default language</em> |
| public | <strong>getFallbackLanguages()</strong> : <em>array</em><br /><em>Gets an array of languages with active first, then fallback languages</em> |
| public | <strong>getFallbackPageExtensions(</strong><em>string/null</em> <strong>$file_ext=null</strong>)</strong> : <em>array</em><br /><em>Gets an array of valid extensions with active first, then fallback extensions</em> |
| public | <strong>getLanguage()</strong> : <em>string</em><br /><em>Gets language, active if set, else default</em> |
| public | <strong>getLanguageCode(</strong><em>string</em> <strong>$code</strong>, <em>string</em> <strong>$type=`'name'`</strong>)</strong> : <em>bool</em><br /><em>Accessible wrapper to LanguageCodes</em> |
| public | <strong>getLanguageURLPrefix(</strong><em>string/null</em> <strong>$lang=null</strong>)</strong> : <em>string</em><br /><em>Get's a URL prefix based on configuration</em> |
| public | <strong>getLanguages()</strong> : <em>array</em><br /><em>Gets the array of supported languages</em> |
| public | <strong>getTranslation(</strong><em>string</em> <strong>$lang</strong>, <em>string</em> <strong>$key</strong>, <em>bool</em> <strong>$array_support=false</strong>)</strong> : <em>string</em><br /><em>Lookup the translation text for a given lang and key</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initialize the default and enabled languages</em> |
| public | <strong>isIncludeDefaultLanguage(</strong><em>string/null</em> <strong>$lang=null</strong>)</strong> : <em>bool</em><br /><em>Test to see if language is default and language should be included in the URL</em> |
| public | <strong>isLanguageInUrl()</strong> : <em>bool</em><br /><em>Simple getter to tell if a language was found in the URL</em> |
| public | <strong>resetFallbackPageExtensions()</strong> : <em>void</em><br /><em>Resets the page_extensions value. Useful to re-initialize the pages and change site language at runtime, example: ``` $this->grav['language']->setActive('it'); $this->grav['language']->resetFallbackPageExtensions(); $this->grav['pages']->init(); ```</em> |
| public | <strong>setActive(</strong><em>string</em> <strong>$lang</strong>)</strong> : <em>string/bool</em><br /><em>Sets active language manually</em> |
| public | <strong>setActiveFromUri(</strong><em>string</em> <strong>$uri</strong>)</strong> : <em>string</em><br /><em>Sets the active language based on the first part of the URL</em> |
| public | <strong>setDefault(</strong><em>string</em> <strong>$lang</strong>)</strong> : <em>bool</em><br /><em>Sets default language manually</em> |
| public | <strong>setLanguages(</strong><em>array</em> <strong>$langs</strong>)</strong> : <em>void</em><br /><em>Sets the current supported languages manually</em> |
| public | <strong>translate(</strong><em>string/array</em> <strong>$args</strong>, <em>array</em> <strong>$languages=null</strong>, <em>bool</em> <strong>$array_support=false</strong>, <em>bool</em> <strong>$html_out=false</strong>)</strong> : <em>string</em><br /><em>Translate a key and possibly arguments into a string using current lang and fallbacks Other arguments can be passed and replaced in the translation with sprintf syntax</em> |
| public | <strong>translateArray(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$index</strong>, <em>array/null</em> <strong>$languages=null</strong>, <em>bool</em> <strong>$html_out=false</strong>)</strong> : <em>string</em><br /><em>Translate Array</em> |
| public | <strong>validate(</strong><em>string</em> <strong>$lang</strong>)</strong> : <em>bool</em><br /><em>Ensures the language is valid and supported</em> |

<hr /><a id="class-gravcommonlanguagelanguagecodes"></a>
### Class: \Grav\Common\Language\LanguageCodes

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>get(</strong><em>mixed</em> <strong>$code</strong>, <em>mixed</em> <strong>$type</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getName(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getNames(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getNativeName(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getOrientation(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>mixed</em> |
| public static | <strong>isRtl(</strong><em>mixed</em> <strong>$code</strong>)</strong> : <em>bool</em> |

<hr /><a id="class-gravcommonmarkdownparsedown"></a>
### Class: \Grav\Common\Markdown\Parsedown

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>\Grav\Common\Markdown\PageInterface</em> <strong>$page</strong>, <em>array/null</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>Parsedown constructor.</em> |
| public | <strong>addBlockType(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$tag</strong>, <em>bool</em> <strong>$continuable=false</strong>, <em>bool</em> <strong>$completable=false</strong>, <em>int/null</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Block type or override an existing one</em> |
| public | <strong>addInlineType(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$tag</strong>, <em>int/null</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Inline type or override an existing one</em> |
| public | <strong>elementToHtml(</strong><em>array</em> <strong>$Element</strong>)</strong> : <em>string markup</em><br /><em>Make the element function publicly accessible, Medium uses this to render from Twig</em> |
| public | <strong>setSpecialChars(</strong><em>array</em> <strong>$special_chars</strong>)</strong> : <em>\Grav\Common\Markdown\$this</em><br /><em>Setter for special chars</em> |
| protected | <strong>blockTwigTag(</strong><em>array</em> <strong>$line</strong>)</strong> : <em>array/null</em><br /><em>Ensure Twig tags are treated as block level items with no <p></p> tags</em> |
| protected | <strong>init(</strong><em>\Grav\Common\Markdown\PageInterface</em> <strong>$page</strong>, <em>array/null</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>Initialization function to setup key variables needed by the MarkdownGravLinkTrait</em> |
| protected | <strong>inlineImage(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineLink(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineSpecialCharacter(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>isBlockCompletable(</strong><em>string</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be completable</em> |
| protected | <strong>isBlockContinuable(</strong><em>string</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be continuable</em> |

*This class extends \Parsedown*

<hr /><a id="class-gravcommonmarkdownparsedownextra"></a>
### Class: \Grav\Common\Markdown\ParsedownExtra

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>\Grav\Common\Markdown\PageInterface</em> <strong>$page</strong>, <em>array/null</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>ParsedownExtra constructor.</em> |
| public | <strong>addBlockType(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$tag</strong>, <em>bool</em> <strong>$continuable=false</strong>, <em>bool</em> <strong>$completable=false</strong>, <em>int/null</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Block type or override an existing one</em> |
| public | <strong>addInlineType(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$tag</strong>, <em>int/null</em> <strong>$index=null</strong>)</strong> : <em>void</em><br /><em>Be able to define a new Inline type or override an existing one</em> |
| public | <strong>elementToHtml(</strong><em>array</em> <strong>$Element</strong>)</strong> : <em>string markup</em><br /><em>Make the element function publicly accessible, Medium uses this to render from Twig</em> |
| public | <strong>setSpecialChars(</strong><em>array</em> <strong>$special_chars</strong>)</strong> : <em>\Grav\Common\Markdown\$this</em><br /><em>Setter for special chars</em> |
| protected | <strong>blockTwigTag(</strong><em>array</em> <strong>$line</strong>)</strong> : <em>array/null</em><br /><em>Ensure Twig tags are treated as block level items with no <p></p> tags</em> |
| protected | <strong>init(</strong><em>\Grav\Common\Markdown\PageInterface</em> <strong>$page</strong>, <em>array/null</em> <strong>$defaults</strong>)</strong> : <em>void</em><br /><em>Initialization function to setup key variables needed by the MarkdownGravLinkTrait</em> |
| protected | <strong>inlineImage(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineLink(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>inlineSpecialCharacter(</strong><em>mixed</em> <strong>$excerpt</strong>)</strong> : <em>void</em> |
| protected | <strong>isBlockCompletable(</strong><em>string</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be completable</em> |
| protected | <strong>isBlockContinuable(</strong><em>string</em> <strong>$Type</strong>)</strong> : <em>bool</em><br /><em>Overrides the default behavior to allow for plugin-provided blocks to be continuable</em> |

*This class extends \ParsedownExtra*

<hr /><a id="interface-gravcommonmediainterfacesmediaobjectinterface"></a>
### Interface: \Grav\Common\Media\Interfaces\MediaObjectInterface

> Class implements media object interface.

| Visibility | Function |
|:-----------|:---------|

*This class implements [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface)*

<hr /><a id="interface-gravcommonmediainterfacesmediainterface"></a>
### Interface: \Grav\Common\Media\Interfaces\MediaInterface

> Class implements media interface.

| Visibility | Function |
|:-----------|:---------|

*This class implements [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface)*

<hr /><a id="interface-gravcommonmediainterfacesmediacollectioninterface"></a>
### Interface: \Grav\Common\Media\Interfaces\MediaCollectionInterface

> Class implements media collection interface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getPath()</strong> : <em>string/null</em><br /><em>Return media path.</em> |

*This class implements [\Grav\Framework\Media\Interfaces\MediaCollectionInterface](#interface-gravframeworkmediainterfacesmediacollectioninterface), \Traversable, \Iterator, \Countable, \ArrayAccess*

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
| public | <strong>add(</strong><em>string</em> <strong>$path</strong>, <em>string</em> <strong>$slug</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Add a page with path and slug</em> |
| public | <strong>addPage(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Add a single page to a collection</em> |
| public | <strong>adjacentSibling(</strong><em>string</em> <strong>$path</strong>, <em>int</em> <strong>$direction=1</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/Collection The sibling item.</em><br /><em>Returns the adjacent sibling based on a direction.</em> |
| public | <strong>batch(</strong><em>int</em> <strong>$size</strong>)</strong> : <em>array/[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)[]</em><br /><em>Split collection into array of smaller collections.</em> |
| public | <strong>copy()</strong> : <em>\Grav\Common\Page\static</em><br /><em>Create a copy of this collection</em> |
| public | <strong>current()</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em><br /><em>Returns current page.</em> |
| public | <strong>currentPosition(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>int the index of the current page.</em><br /><em>Returns the item in the current position.</em> |
| public | <strong>dateRange(</strong><em>string</em> <strong>$startDate</strong>, <em>bool</em> <strong>$endDate=false</strong>, <em>string/null</em> <strong>$field=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Returns the items between a set of date ranges of either the page date field (default) or an arbitrary datetime page field where end date is optional Dates can be passed in as text that strtotime() can process http://php.net/manual/en/function.strtotime.php</em> |
| public | <strong>intersect(</strong><em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em> <strong>$collection</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Intersect another collection with the current collection</em> |
| public | <strong>isFirst(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>bool True if item is first.</em><br /><em>Check to see if this item is the first in the collection.</em> |
| public | <strong>isLast(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>bool True if item is last.</em><br /><em>Check to see if this item is the last in the collection.</em> |
| public | <strong>key()</strong> : <em>mixed</em><br /><em>Returns current slug.</em> |
| public | <strong>merge(</strong><em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em> <strong>$collection</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Merge another collection with the current collection</em> |
| public | <strong>modular()</strong> : <em>Collection The collection with only modular pages</em><br /><em>Creates new collection with only modular pages</em> |
| public | <strong>nextSibling(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>PageInterface The next item.</em><br /><em>Gets the next sibling based on current position.</em> |
| public | <strong>nonModular()</strong> : <em>Collection The collection with only non-modular pages</em><br /><em>Creates new collection with only non-modular pages</em> |
| public | <strong>nonPublished()</strong> : <em>Collection The collection with only non-published pages</em><br /><em>Creates new collection with only non-published pages</em> |
| public | <strong>nonRoutable()</strong> : <em>Collection The collection with only non-routable pages</em><br /><em>Creates new collection with only non-routable pages</em> |
| public | <strong>nonVisible()</strong> : <em>Collection The collection with only non-visible pages</em><br /><em>Creates new collection with only non-visible pages</em> |
| public | <strong>ofOneOfTheseAccessLevels(</strong><em>array</em> <strong>$accessLevels</strong>)</strong> : <em>Collection The collection</em><br /><em>Creates new collection with only pages of one of the specified access levels</em> |
| public | <strong>ofOneOfTheseTypes(</strong><em>string[]</em> <strong>$types</strong>)</strong> : <em>Collection The collection</em><br /><em>Creates new collection with only pages of one of the specified types</em> |
| public | <strong>ofType(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>Collection The collection</em><br /><em>Creates new collection with only pages of the specified type</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>order(</strong><em>string</em> <strong>$by</strong>, <em>string</em> <strong>$dir=`'asc'`</strong>, <em>array</em> <strong>$manual=null</strong>, <em>string</em> <strong>$sort_flags=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Reorder collection.</em> |
| public | <strong>params()</strong> : <em>array</em><br /><em>Get the collection params</em> |
| public | <strong>prevSibling(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>PageInterface The previous item.</em><br /><em>Gets the previous sibling based on current position.</em> |
| public | <strong>published()</strong> : <em>Collection The collection with only published pages</em><br /><em>Creates new collection with only published pages</em> |
| public | <strong>remove(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/string/null</em> <strong>$key=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Remove item from the list.</em> |
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
| public | <strong>addContentMeta(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Add an entry to the page's contentMeta array</em> |
| public | <strong>addForms(</strong><em>array</em> <strong>$new</strong>)</strong> : <em>void</em> |
| public | <strong>adjacentSibling(</strong><em>int</em> <strong>$direction=1</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/bool the sibling page</em><br /><em>Returns the adjacent sibling based on a direction.</em> |
| public | <strong>ancestor(</strong><em>bool</em> <strong>$lookup=null</strong>)</strong> : <em>PageInterface page you were looking for if it exists</em><br /><em>Helper method to return an ancestor page.</em> |
| public | <strong>blueprintName()</strong> : <em>string</em><br /><em>Get the blueprint name for this page.  Use the blueprint form field if set</em> |
| public | <strong>blueprints()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get blueprints for the page.</em> |
| public | <strong>cacheControl(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Gets and sets the cache-control property.  If not set it will return the default value (null) https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control for more details on valid options</em> |
| public | <strong>cachePageContent()</strong> : <em>void</em><br /><em>Fires the onPageContentProcessed event, and caches the page content using a unique ID for the page</em> |
| public | <strong>canonical(</strong><em>bool</em> <strong>$include_lang=true</strong>)</strong> : <em>string</em><br /><em>Returns the canonical URL for a page</em> |
| public | <strong>childType()</strong> : <em>string</em><br /><em>Returns child page type.</em> |
| public | <strong>children()</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Returns children of this page.</em> |
| public | <strong>collection(</strong><em>string/string/array</em> <strong>$params=`'content'`</strong>, <em>bool</em> <strong>$pagination=true</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get a collection of pages in the current context.</em> |
| public | <strong>content(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string Content</em><br /><em>Gets and Sets the content based on content portion of the .md file</em> |
| public | <strong>contentMeta()</strong> : <em>mixed</em><br /><em>Get the contentMeta array and initialize content first if it's not already</em> |
| public | <strong>copy(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$parent</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Prepare a copy from the page. Copies also everything that's under the current page. Returns a new Page object for the copy. You need to call $this->save() in order to perform the move.</em> |
| public | <strong>currentPosition()</strong> : <em>int the index of the current page.</em><br /><em>Returns the item in the current position.</em> |
| public | <strong>date(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int unix timestamp representation of the date</em><br /><em>Gets and sets the date for this Page object. This is typically passed in via the page headers</em> |
| public | <strong>dateformat(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string string representation of a date format</em><br /><em>Gets and sets the date format for this Page object. This is typically passed in via the page headers using typical PHP date string structure - http://php.net/manual/en/function.date.php</em> |
| public | <strong>debugger()</strong> : <em>mixed</em><br /><em>Returns the state of the debugger override etting for this page</em> |
| public | <strong>eTag(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool show etag header</em><br /><em>Gets and sets the option to show the etag header for the page.</em> |
| public | <strong>evaluate(</strong><em>string/array</em> <strong>$value</strong>, <em>bool</em> <strong>$only_published=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Returns whether the page exists in the filesystem.</em> |
| public | <strong>expires(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int The expires value</em><br /><em>Gets and sets the expires field. If not set will return the default</em> |
| public | <strong>extension(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null/string</em><br /><em>Gets and sets the extension field.</em> |
| public | <strong>extra()</strong> : <em>array</em><br /><em>Get unknown header variables.</em> |
| public | <strong>file()</strong> : <em>\Grav\Common\Page\MarkdownFile/null</em><br /><em>Get file object to the page.</em> |
| public | <strong>filePath(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null the file path</em><br /><em>Gets and sets the path to the .md file for this Page object.</em> |
| public | <strong>filePathClean()</strong> : <em>string The relative file path</em><br /><em>Gets the relative path to the .md file</em> |
| public | <strong>filter()</strong> : <em>void</em><br /><em>Filter page header from illegal contents.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$url</strong>, <em>bool</em> <strong>$all=false</strong>)</strong> : <em>PageInterface page you were looking for if it exists</em><br /><em>Helper method to return a page.</em> |
| public | <strong>folder(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null</em><br /><em>Get/set the folder.</em> |
| public | <strong>folderExists()</strong> : <em>bool</em><br /><em>Returns whether or not the current folder exists</em> |
| public | <strong>forms()</strong> : <em>array</em><br /><em>Returns normalized list of name => form pairs.</em> |
| public | <strong>frontmatter(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets and Sets the page frontmatter</em> |
| public | <strong>getAction()</strong> : <em>string The Action string.</em><br /><em>Gets the action.</em> |
| public | <strong>getContentMeta(</strong><em>string/null</em> <strong>$name=null</strong>)</strong> : <em>string</em><br /><em>Return the whole contentMeta array as it currently stands</em> |
| public | <strong>getMedia()</strong> : <em>MediaCollectionInterface Representation of associated media.</em><br /><em>Gets the associated media collection.</em> |
| public | <strong>getMediaFolder()</strong> : <em>string/null</em><br /><em>Get filesystem path to the associated media.</em> |
| public | <strong>getMediaOrder()</strong> : <em>array Empty array means default ordering.</em><br /><em>Get display order for the associated media.</em> |
| public | <strong>getMediaUri()</strong> : <em>null/string</em><br /><em>Get URI ot the associated media. Method will return null if path isn't URI.</em> |
| public | <strong>getOriginal()</strong> : <em>PageInterface The original version of the page.</em><br /><em>Gets the Page Unmodified (original) version of the page.</em> |
| public | <strong>getRawContent()</strong> : <em>string the current page content</em><br /><em>Needed by the onPageContentProcessed event to get the raw page content</em> |
| public | <strong>header(</strong><em>object/array</em> <strong>$var=null</strong>)</strong> : <em>object the current YAML configuration</em><br /><em>Gets and Sets the header based on the YAML configuration at the top of the .md file</em> |
| public | <strong>home()</strong> : <em>bool True if it is the homepage</em><br /><em>Returns whether or not this page is the currently configured home page.</em> |
| public | <strong>httpHeaders()</strong> : <em>void</em> |
| public | <strong>httpResponseCode()</strong> : <em>int</em> |
| public | <strong>id(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the identifier</em><br /><em>Gets and sets the identifier for this Page object.</em> |
| public | <strong>inherited(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em><br /><em>Helper method to return an ancestor page to inherit from. The current page object is returned.</em> |
| public | <strong>inheritedField(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>array</em><br /><em>Helper method to return an ancestor field only to inherit from. The first occurrence of an ancestor field will be returned if at all.</em> |
| public | <strong>init(</strong><em>[\SplFileInfo](http://php.net/manual/en/class.splfileinfo.php)</em> <strong>$file</strong>, <em>string</em> <strong>$extension=null</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Initializes the page instance variables based on a file</em> |
| public | <strong>isDir()</strong> : <em>bool True if its a directory</em><br /><em>Returns whether or not this Page object is a directory or a page.</em> |
| public | <strong>isFirst()</strong> : <em>bool True if item is first.</em><br /><em>Check to see if this item is the first in an array of sub-pages.</em> |
| public | <strong>isLast()</strong> : <em>bool True if item is last</em><br /><em>Check to see if this item is the last in an array of sub-pages.</em> |
| public | <strong>isPage()</strong> : <em>bool True if its a page with a .md file associated</em><br /><em>Returns whether or not this Page object has a .md file associated with it or if its just a directory.</em> |
| public | <strong>language(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>mixed</em><br /><em>Get page language</em> |
| public | <strong>lastModified(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool show last_modified header</em><br /><em>Gets and sets the option to show the last_modified header for the page.</em> |
| public | <strong>link(</strong><em>bool</em> <strong>$include_host=false</strong>)</strong> : <em>string the permalink</em><br /><em>Gets the URL for a page - alias of url().</em> |
| public | <strike><strong>maxCount(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int the maximum number of sub-pages</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strong>media(</strong><em>[\Grav\Common\Page\Media](#class-gravcommonpagemedia)</em> <strong>$var=null</strong>)</strong> : <em>Media Representation of associated media.</em><br /><em>Gets and sets the associated media as found in the page folder.</em> |
| public | <strong>menu(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the menu field for the page</em><br /><em>Gets and sets the menu name for this Page.  This is the text that can be used specifically for navigation. If no menu field is set, it will use the title()</em> |
| public | <strong>metadata(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an Array of metadata values for the page</em><br /><em>Function to merge page metadata tags and build an array of Metadata objects that can then be rendered in the page.</em> |
| public | <strong>modified(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int modified unix timestamp</em><br /><em>Gets and sets the modified timestamp.</em> |
| public | <strong>modifyHeader(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Modify a header value directly</em> |
| public | <strong>modular(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if modular_twig</em><br /><em>Gets and sets the modular var that helps identify this page is a modular child</em> |
| public | <strong>modularTwig(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if modular_twig</em><br /><em>Gets and sets the modular_twig var that helps identify this page as a modular child page that will need twig processing handled differently from a regular page.</em> |
| public | <strong>move(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$parent</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Prepare move page to new location. Moves also everything that's under the current page. You need to call $this->save() in order to perform the move.</em> |
| public | <strong>name(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string The name of this page.</em><br /><em>Gets and sets the name field.  If no name field is set, it will return 'default.md'.</em> |
| public | <strong>nextSibling()</strong> : <em>PageInterface the next Page item</em><br /><em>Gets the next sibling based on current position.</em> |
| public | <strong>order(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int/bool</em><br /><em>Get/set order number of this page.</em> |
| public | <strike><strong>orderBy(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string supported options include "default", "title", "date", and "folder"</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strike><strong>orderDir(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the order, either "asc" or "desc"</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strike><strong>orderManual(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>array</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strong>parent(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$var=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null the parent page object if it exists.</em><br /><em>Gets and Sets the parent object for this page</em> |
| public | <strong>path(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null the path</em><br /><em>Gets and sets the path to the folder where the .md for this Page object resides. This is equivalent to the filePath but without the filename.</em> |
| public | <strong>permalink()</strong> : <em>string The permalink.</em><br /><em>Gets the URL with host information, aka Permalink.</em> |
| public | <strong>prevSibling()</strong> : <em>PageInterface the previous Page item</em><br /><em>Gets the previous sibling based on current position.</em> |
| public | <strong>process(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an Array of name value pairs where the name is the process and value is true or false</em><br /><em>Gets and Sets the process setup for this Page. This is multi-dimensional array that consists of a simple array of arrays with the form array("markdown"=>true) for example</em> |
| public | <strong>publishDate(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int unix timestamp representation of the date</em><br /><em>Gets and Sets the Page publish date</em> |
| public | <strong>published(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is published</em><br /><em>Gets and Sets whether or not this Page is considered published</em> |
| public | <strong>raw(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string Raw content string</em><br /><em>Gets and Sets the raw data</em> |
| public | <strong>rawMarkdown(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets and Sets the Page raw content</em> |
| public | <strong>rawRoute(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null/string</em><br /><em>Gets and Sets the page raw route</em> |
| public | <strong>redirect(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets the redirect set in the header.</em> |
| public | <strong>relativePagePath()</strong> : <em>void</em><br /><em>Returns the clean path to the page file</em> |
| public | <strong>resetMetadata()</strong> : <em>void</em><br /><em>Reset the metadata and pull from header again</em> |
| public | <strong>root()</strong> : <em>bool True if it is the root</em><br /><em>Returns whether or not this page is the root node of the pages tree.</em> |
| public | <strong>routable(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is routable</em><br /><em>Gets and Sets whether or not this Page is routable, ie you can reach it via a URL. The page must be *routable* and *published*</em> |
| public | <strong>route(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string The route for the Page.</em><br /><em>Gets the route for the page based on the route headers if available, else from the parents route and the current Page's slug.</em> |
| public | <strong>routeAliases(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array The route aliases for the Page.</em><br /><em>Gets the route aliases for the page based on page headers.</em> |
| public | <strong>routeCanonical(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>bool/string</em><br /><em>Gets the canonical route for this page if its set. If provided it will use that value, else if it's `true` it will use the default route.</em> |
| public | <strong>save(</strong><em>bool/bool/mixed</em> <strong>$reorder=true</strong>)</strong> : <em>void</em><br /><em>Save page if there's a file assigned to it.</em> |
| public | <strong>setContentMeta(</strong><em>array</em> <strong>$content_meta</strong>)</strong> : <em>array</em><br /><em>Sets the whole content meta array in one shot</em> |
| public | <strong>setRawContent(</strong><em>string</em> <strong>$content</strong>)</strong> : <em>void</em><br /><em>Needed by the onPageContentProcessed event to set the raw page content</em> |
| public | <strong>setSummary(</strong><em>string</em> <strong>$summary</strong>)</strong> : <em>void</em><br /><em>Sets the summary of the page</em> |
| public | <strong>shouldProcess(</strong><em>string</em> <strong>$process</strong>)</strong> : <em>bool whether or not the processing method is enabled for this Page</em><br /><em>Gets the configured state of the processing method.</em> |
| public | <strong>slug(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the slug</em><br /><em>Gets and Sets the slug for the Page. The slug is used in the URL routing. If not set it uses the parent folder from the path</em> |
| public | <strong>ssl(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>void</em> |
| public | <strong>summary(</strong><em>int</em> <strong>$size=null</strong>, <em>bool</em> <strong>$textOnly=false</strong>)</strong> : <em>string</em><br /><em>Get the summary.</em> |
| public | <strong>taxonomy(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an array of taxonomies</em><br /><em>Gets and sets the taxonomy array which defines which taxonomies this page identifies itself with.</em> |
| public | <strong>template(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the template name</em><br /><em>Gets and sets the template field. This is used to find the correct Twig template file to render. If no field is set, it will return the name without the .md extension</em> |
| public | <strong>templateFormat(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Allows a page to override the output render format, usually the extension provided in the URL. (e.g. `html`, `json`, `xml`, etc).</em> |
| public | <strong>title(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the title of the Page</em><br /><em>Gets and sets the title for this Page.  If no title is set, it will use the slug() to get a name</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert page to an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert page to JSON encoded string.</em> |
| public | <strong>toYaml()</strong> : <em>string</em><br /><em>Convert page to YAML encoded string.</em> |
| public | <strong>topParent()</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null the top parent page object if it exists.</em><br /><em>Gets the top parent object for this page</em> |
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
| protected | <strong>doReorder(</strong><em>array/null</em> <strong>$new_order</strong>)</strong> : <em>void</em><br /><em>Reorders all siblings according to a defined order</em> |
| protected | <strong>getCacheKey()</strong> : <em>string</em> |
| protected | <strong>getInheritedParams(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>array</em><br /><em>Method that contains shared logic for inherited() and inheritedField()</em> |
| protected | <strong>getMediaCache()</strong> : <em>\Grav\Common\Page\CacheInterface</em> |
| protected | <strong>normalizeForm(</strong><em>mixed</em> <strong>$form</strong>, <em>mixed</em> <strong>$name=null</strong>, <em>array</em> <strong>$rules=array()</strong>)</strong> : <em>void</em> |
| protected | <strong>processFrontmatter()</strong> : <em>void</em> |
| protected | <strong>processMarkdown()</strong> : <em>void</em><br /><em>Process the Markdown content.  Uses Parsedown or Parsedown Extra depending on configuration</em> |
| protected | <strong>setMedia(</strong><em>[\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface)</em> <strong>$media</strong>)</strong> : <em>\Grav\Common\Page\$this</em><br /><em>Sets the associated media collection.</em> |
| protected | <strong>setPublishState()</strong> : <em>void</em> |

*This class implements [\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface), [\Grav\Common\Page\Interfaces\PageLegacyInterface](#interface-gravcommonpageinterfacespagelegacyinterface), [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface), [\Grav\Common\Media\Interfaces\MediaInterface](#interface-gravcommonmediainterfacesmediainterface), [\Grav\Common\Page\Interfaces\PageTranslateInterface](#interface-gravcommonpageinterfacespagetranslateinterface), [\Grav\Common\Page\Interfaces\PageRoutableInterface](#interface-gravcommonpageinterfacespageroutableinterface), [\Grav\Common\Page\Interfaces\PageContentInterface](#interface-gravcommonpageinterfacespagecontentinterface)*

<hr /><a id="class-gravcommonpagemedia"></a>
### Class: \Grav\Common\Page\Media

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$media_order=null</strong>, <em>bool</em> <strong>$load=true</strong>)</strong> : <em>void</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Initialize static variables on unserialize.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| public | <strike><strong>path()</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use $this->getPath() instead.</em> |
| protected | <strong>init()</strong> : <em>void</em><br /><em>Initialize class.</em> |

*This class extends [\Grav\Common\Page\Medium\AbstractMedia](#class-gravcommonpagemediumabstractmedia-abstract)*

*This class implements [\Grav\Framework\Media\Interfaces\MediaCollectionInterface](#interface-gravframeworkmediainterfacesmediacollectioninterface), \Traversable, \Iterator, \Countable, \ArrayAccess, [\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface), \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagepages"></a>
### Class: \Grav\Common\Page\Pages

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$c</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>accessLevels()</strong> : <em>array</em><br /><em>Get access levels of the site pages</em> |
| public | <strong>addPage(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>string</em> <strong>$route=null</strong>)</strong> : <em>void</em><br /><em>Adds a page and assigns a route to it.</em> |
| public | <strong>all(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$current=null</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get all pages</em> |
| public | <strong>ancestor(</strong><em>string</em> <strong>$route</strong>, <em>string</em> <strong>$path=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null</em><br /><em>Get a page ancestor.</em> |
| public | <strong>base(</strong><em>string</em> <strong>$path=null</strong>)</strong> : <em>string</em><br /><em>Get or set base path for the pages.</em> |
| public | <strong>baseRoute(</strong><em>string</em> <strong>$lang=null</strong>)</strong> : <em>string</em><br /><em>Get base route for Grav pages.</em> |
| public | <strong>baseUrl(</strong><em>string</em> <strong>$lang=null</strong>, <em>bool/null</em> <strong>$absolute=null</strong>)</strong> : <em>string</em><br /><em>Get base URL for Grav pages.</em> |
| public | <strong>blueprints(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get a blueprint for a page type.</em> |
| public | <strong>children(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get children of the path.</em> |
| public | <strong>dispatch(</strong><em>string</em> <strong>$route</strong>, <em>bool</em> <strong>$all=false</strong>, <em>bool</em> <strong>$redirect=true</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null</em><br /><em>Dispatch URI to a page.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$route</strong>, <em>bool</em> <strong>$all=false</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null</em><br /><em>alias method to return find a page.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em><br /><em>Get a page instance.</em> |
| public static | <strong>getHomeRoute()</strong> : <em>string</em><br /><em>Gets the home route</em> |
| public | <strong>getList(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$current=null</strong>, <em>int</em> <strong>$level</strong>, <em>bool</em> <strong>$rawRoutes=false</strong>, <em>bool</em> <strong>$showAll=true</strong>, <em>bool</em> <strong>$showFullpath=false</strong>, <em>bool</em> <strong>$showSlug=false</strong>, <em>bool</em> <strong>$showModular=false</strong>, <em>bool</em> <strong>$limitLevels=false</strong>)</strong> : <em>array</em><br /><em>Get list of route/title of all pages.</em> |
| public | <strong>getPagesCacheId()</strong> : <em>mixed</em><br /><em>Get the Pages cache ID this is particularly useful to know if pages have changed and you want to sync another cache with pages cache - works best in `onPagesInitialized()`</em> |
| public static | <strong>getTypes()</strong> : <em>[\Grav\Common\Page\Types](#class-gravcommonpagetypes)</em><br /><em>Get available page types.</em> |
| public | <strong>homeUrl(</strong><em>string</em> <strong>$lang=null</strong>, <em>bool</em> <strong>$absolute=null</strong>)</strong> : <em>string</em><br /><em>Get home URL for Grav site.</em> |
| public | <strong>inherited(</strong><em>string</em> <strong>$route</strong>, <em>string</em> <strong>$field=null</strong>)</strong> : <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null</em><br /><em>Get a page ancestor trait.</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Class initialization. Must be called before using this class.</em> |
| public | <strong>instances()</strong> : <em>array/[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface[]</em><br /><em>Returns a list of all pages.</em> |
| public | <strong>lastModified(</strong><em>int</em> <strong>$modified=null</strong>)</strong> : <em>int/null</em><br /><em>Get or set last modification time.</em> |
| public static | <strong>modularTypes()</strong> : <em>array</em><br /><em>Get available page types.</em> |
| public static | <strong>pageTypes()</strong> : <em>array</em><br /><em>Get template types based on page type (standard or modular)</em> |
| public static | <strong>parents()</strong> : <em>array</em><br /><em>Get available parents routes</em> |
| public static | <strong>parentsRawRoutes()</strong> : <em>array</em><br /><em>Get available parents raw routes.</em> |
| public static | <strong>resetHomeRoute()</strong> : <em>void</em><br /><em>Needed for testing where we change the home route via config</em> |
| public | <strong>resetPages(</strong><em>string</em> <strong>$pages_dir</strong>)</strong> : <em>void</em><br /><em>Accessible method to manually reset the pages cache</em> |
| public | <strong>root()</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em><br /><em>Get root page.</em> |
| public | <strong>route(</strong><em>string</em> <strong>$route=`'/'`</strong>, <em>string</em> <strong>$lang=null</strong>)</strong> : <em>string</em><br /><em>Get route for Grav site.</em> |
| public | <strong>routes()</strong> : <em>array</em><br /><em>Returns a list of all routes.</em> |
| public | <strong>setCheckMethod(</strong><em>mixed</em> <strong>$method</strong>)</strong> : <em>void</em> |
| public | <strong>sort(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$page</strong>, <em>string</em> <strong>$order_by=null</strong>, <em>string</em> <strong>$order_dir=null</strong>, <em>mixed</em> <strong>$sort_flags=null</strong>)</strong> : <em>array</em><br /><em>Sort sub-pages in a page.</em> |
| public | <strong>sortCollection(</strong><em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em> <strong>$collection</strong>, <em>string/int</em> <strong>$orderBy</strong>, <em>string</em> <strong>$orderDir=`'asc'`</strong>, <em>array/null</em> <strong>$orderManual=null</strong>, <em>int/null</em> <strong>$sort_flags=null</strong>)</strong> : <em>array</em> |
| public static | <strong>types()</strong> : <em>array</em><br /><em>Get available page types.</em> |
| public | <strong>url(</strong><em>string</em> <strong>$route=`'/'`</strong>, <em>string</em> <strong>$lang=null</strong>, <em>bool</em> <strong>$absolute=null</strong>)</strong> : <em>string</em><br /><em>Get URL for Grav site.</em> |
| protected | <strong>arrayShuffle(</strong><em>array</em> <strong>$list</strong>)</strong> : <em>array</em><br /><em>Shuffles an associative array</em> |
| protected | <strong>buildPages()</strong> : <em>void</em><br /><em>Builds pages.</em> |
| protected | <strong>buildRoutes()</strong> : <em>void</em> |
| protected | <strong>buildSort(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$pages</strong>, <em>string</em> <strong>$order_by=`'default'`</strong>, <em>array/null</em> <strong>$manual=null</strong>, <em>int/null</em> <strong>$sort_flags=null</strong>)</strong> : <em>void</em> |
| protected | <strong>recurse(</strong><em>string</em> <strong>$directory</strong>, <em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)Interface/null/[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$parent=null</strong>)</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em><br /><em>Recursive function to load & build page relationships.</em> |

<hr /><a id="interface-gravcommonpageinterfacespageroutableinterface"></a>
### Interface: \Grav\Common\Page\Interfaces\PageRoutableInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>active()</strong> : <em>bool True if it is active</em><br /><em>Returns whether or not this page is the currently active page requested via the URL.</em> |
| public | <strong>activeChild()</strong> : <em>bool True if active child exists</em><br /><em>Returns whether or not this URI's URL contains the URL of the active page. Or in other words, is this page's URL in the current URL</em> |
| public | <strong>canonical(</strong><em>bool</em> <strong>$include_lang=true</strong>)</strong> : <em>string</em><br /><em>Returns the canonical URL for a page</em> |
| public | <strong>currentPosition()</strong> : <em>int the index of the current page.</em><br /><em>Returns the item in the current position.</em> |
| public | <strong>folder(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null</em><br /><em>Get/set the folder.</em> |
| public | <strong>home()</strong> : <em>bool True if it is the homepage</em><br /><em>Returns whether or not this page is the currently configured home page.</em> |
| public | <strong>link(</strong><em>bool</em> <strong>$include_host=false</strong>)</strong> : <em>string the permalink</em><br /><em>Gets the URL for a page - alias of url().</em> |
| public | <strong>parent(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$var=null</strong>)</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)/null the parent page object if it exists.</em><br /><em>Gets and Sets the parent object for this page</em> |
| public | <strong>path(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null the path</em><br /><em>Gets and sets the path to the folder where the .md for this Page object resides. This is equivalent to the filePath but without the filename.</em> |
| public | <strong>permalink()</strong> : <em>string The permalink.</em><br /><em>Gets the URL with host information, aka Permalink.</em> |
| public | <strong>rawRoute(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets and Sets the page raw route</em> |
| public | <strong>redirect(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets the redirect set in the header.</em> |
| public | <strong>relativePagePath()</strong> : <em>void</em><br /><em>Returns the clean path to the page file</em> |
| public | <strong>root()</strong> : <em>bool True if it is the root</em><br /><em>Returns whether or not this page is the root node of the pages tree.</em> |
| public | <strong>routable(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is routable</em><br /><em>Gets and Sets whether or not this Page is routable, ie you can reach it via a URL. The page must be *routable* and *published*</em> |
| public | <strong>route(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string The route for the Page.</em><br /><em>Gets the route for the page based on the route headers if available, else from the parents route and the current Page's slug.</em> |
| public | <strong>routeAliases(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array The route aliases for the Page.</em><br /><em>Gets the route aliases for the page based on page headers.</em> |
| public | <strong>routeCanonical(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>bool/string</em><br /><em>Gets the canonical route for this page if its set. If provided it will use that value, else if it's `true` it will use the default route.</em> |
| public | <strong>topParent()</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)/null the top parent page object if it exists.</em><br /><em>Gets the top parent object for this page</em> |
| public | <strong>unsetRouteSlug()</strong> : <em>void</em><br /><em>Helper method to clear the route out so it regenerates next time you use it</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$include_host=false</strong>, <em>bool</em> <strong>$canonical=false</strong>, <em>bool</em> <strong>$include_lang=true</strong>, <em>bool</em> <strong>$raw_route=false</strong>)</strong> : <em>string The url.</em><br /><em>Gets the url for the Page.</em> |
| public | <strong>urlExtension()</strong> : <em>string The extension of this page. For example `.html`</em><br /><em>Returns the page extension, got from the page `url_extension` config and falls back to the system config `system.pages.append_url_extension`.</em> |

<hr /><a id="interface-gravcommonpageinterfacespageinterface"></a>
### Interface: \Grav\Common\Page\Interfaces\PageInterface

> Class implements page interface.

| Visibility | Function |
|:-----------|:---------|

*This class implements [\Grav\Common\Page\Interfaces\PageContentInterface](#interface-gravcommonpageinterfacespagecontentinterface), [\Grav\Common\Page\Interfaces\PageRoutableInterface](#interface-gravcommonpageinterfacespageroutableinterface), [\Grav\Common\Page\Interfaces\PageTranslateInterface](#interface-gravcommonpageinterfacespagetranslateinterface), [\Grav\Common\Media\Interfaces\MediaInterface](#interface-gravcommonmediainterfacesmediainterface), [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface), [\Grav\Common\Page\Interfaces\PageLegacyInterface](#interface-gravcommonpageinterfacespagelegacyinterface)*

<hr /><a id="interface-gravcommonpageinterfacespagelegacyinterface"></a>
### Interface: \Grav\Common\Page\Interfaces\PageLegacyInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addContentMeta(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Add an entry to the page's contentMeta array</em> |
| public | <strong>addForms(</strong><em>array</em> <strong>$new</strong>)</strong> : <em>void</em> |
| public | <strong>adjacentSibling(</strong><em>int</em> <strong>$direction=1</strong>)</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)/bool the sibling page</em><br /><em>Returns the adjacent sibling based on a direction.</em> |
| public | <strong>ancestor(</strong><em>bool</em> <strong>$lookup=null</strong>)</strong> : <em>PageInterface page you were looking for if it exists</em><br /><em>Helper method to return an ancestor page.</em> |
| public | <strong>blueprintName()</strong> : <em>string</em><br /><em>Get the blueprint name for this page.  Use the blueprint form field if set</em> |
| public | <strong>blueprints()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get blueprints for the page.</em> |
| public | <strong>cacheControl(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Gets and sets the cache-control property.  If not set it will return the default value (null) https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control for more details on valid options</em> |
| public | <strong>cachePageContent()</strong> : <em>void</em><br /><em>Fires the onPageContentProcessed event, and caches the page content using a unique ID for the page</em> |
| public | <strong>childType()</strong> : <em>string</em><br /><em>Returns child page type.</em> |
| public | <strong>children()</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Returns children of this page.</em> |
| public | <strong>collection(</strong><em>string/string/array</em> <strong>$params=`'content'`</strong>, <em>bool</em> <strong>$pagination=true</strong>)</strong> : <em>[\Grav\Common\Page\Collection](#class-gravcommonpagecollection)</em><br /><em>Get a collection of pages in the current context.</em> |
| public | <strong>contentMeta()</strong> : <em>mixed</em><br /><em>Get the contentMeta array and initialize content first if it's not already</em> |
| public | <strong>copy(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$parent</strong>)</strong> : <em>\Grav\Common\Page\Interfaces\$this</em><br /><em>Prepare a copy from the page. Copies also everything that's under the current page. Returns a new Page object for the copy. You need to call $this->save() in order to perform the move.</em> |
| public | <strong>debugger()</strong> : <em>mixed</em><br /><em>Returns the state of the debugger override etting for this page</em> |
| public | <strong>eTag(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool show etag header</em><br /><em>Gets and sets the option to show the etag header for the page.</em> |
| public | <strong>evaluate(</strong><em>string/array</em> <strong>$value</strong>, <em>bool</em> <strong>$only_published=true</strong>)</strong> : <em>mixed</em> |
| public | <strong>expires(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int The expires value</em><br /><em>Gets and sets the expires field. If not set will return the default</em> |
| public | <strong>extension(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null/string</em><br /><em>Gets and sets the extension field.</em> |
| public | <strong>extra()</strong> : <em>array</em><br /><em>Get unknown header variables.</em> |
| public | <strong>file()</strong> : <em>\Grav\Common\Page\Interfaces\MarkdownFile/null</em><br /><em>Get file object to the page.</em> |
| public | <strong>filePath(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null the file path</em><br /><em>Gets and sets the path to the .md file for this Page object.</em> |
| public | <strong>filePathClean()</strong> : <em>string The relative file path</em><br /><em>Gets the relative path to the .md file</em> |
| public | <strong>filter()</strong> : <em>void</em><br /><em>Filter page header from illegal contents.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$url</strong>, <em>bool</em> <strong>$all=false</strong>)</strong> : <em>PageInterface page you were looking for if it exists</em><br /><em>Helper method to return a page.</em> |
| public | <strong>folderExists()</strong> : <em>bool</em><br /><em>Returns whether or not the current folder exists</em> |
| public | <strong>forms()</strong> : <em>array</em><br /><em>Returns normalized list of name => form pairs.</em> |
| public | <strong>frontmatter(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>string</em><br /><em>Gets and Sets the page frontmatter</em> |
| public | <strong>getAction()</strong> : <em>string The Action string.</em><br /><em>Gets the action.</em> |
| public | <strong>getContentMeta(</strong><em>string/null</em> <strong>$name=null</strong>)</strong> : <em>mixed</em><br /><em>Return the whole contentMeta array as it currently stands</em> |
| public | <strong>getOriginal()</strong> : <em>PageInterface The original version of the page.</em><br /><em>Gets the Page Unmodified (original) version of the page.</em> |
| public | <strong>httpHeaders()</strong> : <em>void</em> |
| public | <strong>httpResponseCode()</strong> : <em>int</em> |
| public | <strong>inherited(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em><br /><em>Helper method to return an ancestor page to inherit from. The current page object is returned.</em> |
| public | <strong>inheritedField(</strong><em>string</em> <strong>$field</strong>)</strong> : <em>array</em><br /><em>Helper method to return an ancestor field only to inherit from. The first occurrence of an ancestor field will be returned if at all.</em> |
| public | <strong>init(</strong><em>[\SplFileInfo](http://php.net/manual/en/class.splfileinfo.php)</em> <strong>$file</strong>, <em>string</em> <strong>$extension=null</strong>)</strong> : <em>\Grav\Common\Page\Interfaces\$this</em><br /><em>Initializes the page instance variables based on a file</em> |
| public | <strong>isFirst()</strong> : <em>bool True if item is first.</em><br /><em>Check to see if this item is the first in an array of sub-pages.</em> |
| public | <strong>isLast()</strong> : <em>bool True if item is last</em><br /><em>Check to see if this item is the last in an array of sub-pages.</em> |
| public | <strike><strong>maxCount(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int the maximum number of sub-pages</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strong>metadata(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an Array of metadata values for the page</em><br /><em>Function to merge page metadata tags and build an array of Metadata objects that can then be rendered in the page.</em> |
| public | <strong>modifyHeader(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Modify a header value directly</em> |
| public | <strong>modular(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if modular_twig</em><br /><em>Gets and sets the modular var that helps identify this page is a modular child</em> |
| public | <strong>modularTwig(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if modular_twig</em><br /><em>Gets and sets the modular_twig var that helps identify this page as a modular child page that will need twig processing handled differently from a regular page.</em> |
| public | <strong>move(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$parent</strong>)</strong> : <em>\Grav\Common\Page\Interfaces\$this</em><br /><em>Prepare move page to new location. Moves also everything that's under the current page. You need to call $this->save() in order to perform the move.</em> |
| public | <strong>name(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string The name of this page.</em><br /><em>Gets and sets the name field.  If no name field is set, it will return 'default.md'.</em> |
| public | <strong>nextSibling()</strong> : <em>PageInterface the next Page item</em><br /><em>Gets the next sibling based on current position.</em> |
| public | <strike><strong>orderBy(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string supported options include "default", "title", "date", and "folder"</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strike><strong>orderDir(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the order, either "asc" or "desc"</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strike><strong>orderManual(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>array</em></strike><br /><em>DEPRECATED - 1.6</em> |
| public | <strong>prevSibling()</strong> : <em>PageInterface the previous Page item</em><br /><em>Gets the previous sibling based on current position.</em> |
| public | <strong>raw(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string Raw content string</em><br /><em>Gets and Sets the raw data</em> |
| public | <strong>save(</strong><em>bool/bool/mixed</em> <strong>$reorder=true</strong>)</strong> : <em>void</em><br /><em>Save page if there's a file assigned to it.</em> |
| public | <strong>setContentMeta(</strong><em>array</em> <strong>$content_meta</strong>)</strong> : <em>array</em><br /><em>Sets the whole content meta array in one shot</em> |
| public | <strong>setSummary(</strong><em>string</em> <strong>$summary</strong>)</strong> : <em>void</em><br /><em>Sets the summary of the page</em> |
| public | <strong>ssl(</strong><em>mixed</em> <strong>$var=null</strong>)</strong> : <em>void</em> |
| public | <strong>template(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the template name</em><br /><em>Gets and sets the template field. This is used to find the correct Twig template file to render. If no field is set, it will return the name without the .md extension</em> |
| public | <strong>templateFormat(</strong><em>null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Allows a page to override the output render format, usually the extension provided in the URL. (e.g. `html`, `json`, `xml`, etc).</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert page to an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert page to JSON encoded string.</em> |
| public | <strong>toYaml()</strong> : <em>string</em><br /><em>Convert page to YAML encoded string.</em> |
| public | <strong>validate()</strong> : <em>void</em><br /><em>Validate page header.</em> |

<hr /><a id="interface-gravcommonpageinterfacespagecontentinterface"></a>
### Interface: \Grav\Common\Page\Interfaces\PageContentInterface

> Methods currently implemented in Flex Page emulation layer.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>content(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string Content</em><br /><em>Gets and Sets the content based on content portion of the .md file</em> |
| public | <strong>date(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int unix timestamp representation of the date</em><br /><em>Gets and sets the date for this Page object. This is typically passed in via the page headers</em> |
| public | <strong>dateformat(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string string representation of a date format</em><br /><em>Gets and sets the date format for this Page object. This is typically passed in via the page headers using typical PHP date string structure - http://php.net/manual/en/function.date.php</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Returns whether the page exists in the filesystem.</em> |
| public | <strong>folder(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string/null</em><br /><em>Get/set the folder.</em> |
| public | <strong>getRawContent()</strong> : <em>string the current page content</em><br /><em>Needed by the onPageContentProcessed event to get the raw page content</em> |
| public | <strong>header(</strong><em>object/array</em> <strong>$var=null</strong>)</strong> : <em>object the current YAML configuration</em><br /><em>Gets and Sets the header based on the YAML configuration at the top of the .md file</em> |
| public | <strong>id(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the identifier</em><br /><em>Gets and sets the identifier for this Page object.</em> |
| public | <strong>isDir()</strong> : <em>bool True if its a directory</em><br /><em>Returns whether or not this Page object is a directory or a page.</em> |
| public | <strong>isPage()</strong> : <em>bool True if its a page with a .md file associated</em><br /><em>Returns whether or not this Page object has a .md file associated with it or if its just a directory.</em> |
| public | <strong>lastModified(</strong><em>boolean</em> <strong>$var=null</strong>)</strong> : <em>boolean show last_modified header</em><br /><em>Gets and sets the option to show the last_modified header for the page.</em> |
| public | <strong>media(</strong><em>\Grav\Common\Page\Interfaces\Media</em> <strong>$var=null</strong>)</strong> : <em>Media Representation of associated media.</em><br /><em>Gets and sets the associated media as found in the page folder.</em> |
| public | <strong>menu(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the menu field for the page</em><br /><em>Gets and sets the menu name for this Page.  This is the text that can be used specifically for navigation. If no menu field is set, it will use the title()</em> |
| public | <strong>modified(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int modified unix timestamp</em><br /><em>Gets and sets the modified timestamp.</em> |
| public | <strong>order(</strong><em>int</em> <strong>$var=null</strong>)</strong> : <em>int/bool</em><br /><em>Get/set order number of this page.</em> |
| public | <strong>process(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an Array of name value pairs where the name is the process and value is true or false</em><br /><em>Gets and Sets the process setup for this Page. This is multi-dimensional array that consists of a simple array of arrays with the form array("markdown"=>true) for example</em> |
| public | <strong>publishDate(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int unix timestamp representation of the date</em><br /><em>Gets and Sets the Page publish date</em> |
| public | <strong>published(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is published</em><br /><em>Gets and Sets whether or not this Page is considered published</em> |
| public | <strong>rawMarkdown(</strong><em>string/null</em> <strong>$var=null</strong>)</strong> : <em>null</em><br /><em>Gets and Sets the Page raw content</em> |
| public | <strong>setRawContent(</strong><em>string</em> <strong>$content</strong>)</strong> : <em>void</em><br /><em>Needed by the onPageContentProcessed event to set the raw page content</em> |
| public | <strong>shouldProcess(</strong><em>string</em> <strong>$process</strong>)</strong> : <em>bool whether or not the processing method is enabled for this Page</em><br /><em>Gets the configured state of the processing method.</em> |
| public | <strong>slug(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the slug</em><br /><em>Gets and Sets the slug for the Page. The slug is used in the URL routing. If not set it uses the parent folder from the path</em> |
| public | <strong>summary(</strong><em>int</em> <strong>$size=null</strong>, <em>bool</em> <strong>$textOnly=false</strong>)</strong> : <em>string</em><br /><em>Get the summary.</em> |
| public | <strong>taxonomy(</strong><em>array</em> <strong>$var=null</strong>)</strong> : <em>array an array of taxonomies</em><br /><em>Gets and sets the taxonomy array which defines which taxonomies this page identifies itself with.</em> |
| public | <strong>title(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>string the title of the Page</em><br /><em>Gets and sets the title for this Page.  If no title is set, it will use the slug() to get a name</em> |
| public | <strong>unpublishDate(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>int/null unix timestamp representation of the date</em><br /><em>Gets and Sets the Page unpublish date</em> |
| public | <strong>value(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Get value from a page variable (used mostly for creating edit forms).</em> |
| public | <strong>visible(</strong><em>bool</em> <strong>$var=null</strong>)</strong> : <em>bool true if the page is visible</em><br /><em>Gets and Sets whether or not this Page is visible for navigation</em> |

<hr /><a id="interface-gravcommonpageinterfacespagetranslateinterface"></a>
### Interface: \Grav\Common\Page\Interfaces\PageTranslateInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>language(</strong><em>string</em> <strong>$var=null</strong>)</strong> : <em>mixed</em><br /><em>Get page language</em> |
| public | <strong>translatedLanguages(</strong><em>bool</em> <strong>$onlyPublished=false</strong>)</strong> : <em>array the page translated languages</em><br /><em>Return an array with the routes of other translated languages</em> |
| public | <strong>untranslatedLanguages(</strong><em>bool</em> <strong>$includeUnpublished=false</strong>)</strong> : <em>array the page untranslated languages</em><br /><em>Return an array listing untranslated languages available</em> |

<hr /><a id="class-gravcommonpagemediumvideomedium"></a>
### Class: \Grav\Common\Page\Medium\VideoMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>autoplay(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the autoplay attribute</em> |
| public | <strong>controls(</strong><em>bool</em> <strong>$display=true</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set or remove the HTML5 default controls</em> |
| public | <strong>loop(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the loop attribute</em> |
| public | <strong>muted(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the muted attribute</em> |
| public | <strong>playsinline(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the playsinline attribute</em> |
| public | <strong>poster(</strong><em>string</em> <strong>$urlImage</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the video's poster image</em> |
| public | <strong>preload(</strong><em>null</em> <strong>$status=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows ability to set the preload option</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset medium.</em> |
| public | <strong>resize(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Resize media by setting attributes</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \JsonSerializable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediummediumfactory"></a>
### Class: \Grav\Common\Page\Medium\MediumFactory

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>fromArray(</strong><em>array</em> <strong>$items=array()</strong>, <em>\Grav\Common\Page\Medium\Blueprint/null/[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> <strong>$blueprint=null</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create Medium from array of parameters</em> |
| public static | <strong>fromFile(</strong><em>string</em> <strong>$file</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create Medium from a file</em> |
| public static | <strong>fromUploadedFile(</strong><em>[\Grav\Framework\Form\FormFlashFile](#class-gravframeworkformformflashfile)</em> <strong>$uploadedFile</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create Medium from an uploaded file</em> |
| public static | <strong>scaledFromMedium(</strong><em>[\Grav\Common\Page\Medium\ImageMedium](#class-gravcommonpagemediumimagemedium)</em> <strong>$medium</strong>, <em>int</em> <strong>$from</strong>, <em>int</em> <strong>$to</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)/array</em><br /><em>Create a new ImageMedium by scaling another ImageMedium object.</em> |

<hr /><a id="class-gravcommonpagemediumlink"></a>
### Class: \Grav\Common\Page\Medium\Link

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>mixed</em><br /><em>Forward the call to the source element</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$attributes</strong>, <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em> <strong>$medium</strong>)</strong> : <em>void</em><br /><em>Construct.</em> |
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Get an element (is array) that can be rendered by the Parsedown engine</em> |

*This class implements [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface)*

<hr /><a id="class-gravcommonpagemediumimagefile"></a>
### Class: \Grav\Common\Page\Medium\ImageFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>cacheFile(</strong><em>string</em> <strong>$type=`'jpg'`</strong>, <em>int</em> <strong>$quality=80</strong>, <em>bool</em> <strong>$actual=false</strong>, <em>array</em> <strong>$extras=array()</strong>)</strong> : <em>string</em><br /><em>This is the same as the Gregwar Image class except this one fires a Grav Event on creation of new cached file</em> |
| public | <strong>clearOperations()</strong> : <em>void</em><br /><em>Clear previously applied operations</em> |
| public | <strong>generateHash(</strong><em>string</em> <strong>$type=`'guess'`</strong>, <em>int</em> <strong>$quality=80</strong>, <em>array</em> <strong>$extras=array()</strong>)</strong> : <em>void</em><br /><em>Generates the hash.</em> |
| public | <strong>getHash(</strong><em>string</em> <strong>$type=`'guess'`</strong>, <em>int</em> <strong>$quality=80</strong>, <em>array/\Grav\Common\Page\Medium\[]</em> <strong>$extras=array()</strong>)</strong> : <em>null</em><br /><em>Gets the hash.</em> |

*This class extends \Gregwar\Image\Image*

<hr /><a id="class-gravcommonpagemediummedium"></a>
### Class: \Grav\Common\Page\Medium\Medium

> Class Medium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allow any action to be called on this medium from twig or markdown</em> |
| public | <strong>__clone()</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> <strong>$blueprint=null</strong>)</strong> : <em>void</em><br /><em>Construct.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Return string representation of the object (html).</em> |
| public | <strong>addAlternative(</strong><em>int/float</em> <strong>$ratio</strong>, <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em> <strong>$alternative</strong>)</strong> : <em>void</em><br /><em>Add alternative Medium to this Medium.</em> |
| public | <strong>addMetaFile(</strong><em>string</em> <strong>$filepath</strong>)</strong> : <em>void</em><br /><em>Add meta file for the medium.</em> |
| public | <strong>classes()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Add a class to the element from Markdown or Twig Example: ![Example](myimg.png?classes=float-left) or ![Example](myimg.png?classes=myclass1,myclass2)</em> |
| public | <strong>copy()</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Create a copy of this media object</em> |
| public | <strong>display(</strong><em>string</em> <strong>$mode=`'source'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch display mode.</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Check if this medium exists or not</em> |
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>id(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Add an id to the element from Markdown or Twig Example: ![Example](myimg.png?id=primary-img)</em> |
| public | <strong>lightbox(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link with lightbox enabled</em> |
| public | <strong>link(</strong><em>bool</em> <strong>$reset=true</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link</em> |
| public | <strong>meta()</strong> : <em>[\Grav\Common\Data\Data](#class-gravcommondatadata)</em><br /><em>Return just metadata from the Medium object</em> |
| public | <strong>metadata()</strong> : <em>array</em><br /><em>Returns an array containing just the metadata</em> |
| public | <strong>modified()</strong> : <em>int/null</em><br /><em>Get file modification time for the medium.</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Get an element (is array) that can be rendered by the Parsedown engine</em> |
| public | <strong>path(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string path to file</em><br /><em>Return PATH to file.</em> |
| public | <strong>querystring(</strong><em>string</em> <strong>$querystring=null</strong>, <em>bool</em> <strong>$withQuestionmark=true</strong>)</strong> : <em>string</em><br /><em>Get/set querystring for the file's url</em> |
| public | <strong>relativePath(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>mixed</em><br /><em>Return the relative path to file</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset medium.</em> |
| public | <strong>setTimestamp(</strong><em>string/int/null</em> <strong>$timestamp=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Set querystring to file modification timestamp (or value provided as a parameter).</em> |
| public | <strong>size()</strong> : <em>int</em> |
| public | <strong>style(</strong><em>string</em> <strong>$style</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to add an inline style attribute from Markdown or Twig Example: ![Example](myimg.png?style=float:left)</em> |
| public | <strong>thumbnail(</strong><em>string</em> <strong>$type=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch thumbnail.</em> |
| public | <strong>thumbnailExists(</strong><em>string</em> <strong>$type=`'page'`</strong>)</strong> : <em>bool</em><br /><em>Helper method to determine if this media item has a thumbnail or not</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return URL to file.</em> |
| public | <strong>urlHash(</strong><em>string</em> <strong>$hash=null</strong>, <em>bool</em> <strong>$withHash=true</strong>)</strong> : <em>string</em><br /><em>Get/set hash for the file's url</em> |
| public | <strong>urlQuerystring(</strong><em>string</em> <strong>$url</strong>)</strong> : <em>string</em><br /><em>Get the URL with full querystring</em> |
| protected | <strong>getThumbnail()</strong> : <em>[\Grav\Common\Page\Medium\ThumbnailImageMedium](#class-gravcommonpagemediumthumbnailimagemedium)</em><br /><em>Get the thumbnail Medium object</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |
| protected | <strong>textParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for text display mode</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface)*

<hr /><a id="class-gravcommonpagemediumaudiomedium"></a>
### Class: \Grav\Common\Page\Medium\AudioMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>autoplay(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the autoplay attribute</em> |
| public | <strong>controls(</strong><em>bool</em> <strong>$display=true</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set or remove the HTML5 default controls</em> |
| public | <strong>controlsList(</strong><em>string</em> <strong>$controlsList</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the controlsList behaviour Separate multiple values with a hyphen</em> |
| public | <strong>loop(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the loop attribute</em> |
| public | <strong>muted(</strong><em>bool</em> <strong>$status=false</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the muted attribute</em> |
| public | <strong>preload(</strong><em>string</em> <strong>$preload</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the preload behaviour</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset medium.</em> |
| public | <strong>resize(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Resize media by setting attributes</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \JsonSerializable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediumimagemedium"></a>
### Class: \Grav\Common\Page\Medium\ImageMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$method</strong>, <em>mixed</em> <strong>$args</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this/mixed</em><br /><em>Forward the call to the image processing method.</em> |
| public | <strong>__clone()</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> <strong>$blueprint=null</strong>)</strong> : <em>void</em><br /><em>Construct.</em> |
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>addMetaFile(</strong><em>string</em> <strong>$filepath</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Add meta file for the medium.</em> |
| public | <strong>cache()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Simply processes with no extra methods.  Useful for triggering events.</em> |
| public | <strong>clearAlternatives()</strong> : <em>void</em><br /><em>Clear out the alternatives</em> |
| public | <strong>derivatives(</strong><em>int/int[]</em> <strong>$min_width</strong>, <em>int</em> <strong>$max_width=2500</strong>, <em>int</em> <strong>$step=200</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Generate alternative image widths, using either an array of integers, or a min width, a max width, and a step parameter to fill out the necessary widths. Existing image alternatives won't be overwritten.</em> |
| public | <strong>filter(</strong><em>string</em> <strong>$filter=`'image.filters.default'`</strong>)</strong> : <em>void</em><br /><em>Filter image by using user defined filter parameters.</em> |
| public | <strong>format(</strong><em>string</em> <strong>$format</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Sets image output format.</em> |
| public | <strong>getImagePrettyName()</strong> : <em>mixed</em> |
| public | <strong>height(</strong><em>string/mixed</em> <strong>$value=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the height attribute from Markdown or Twig Examples: ![Example](myimg.png?width=200&height=400) ![Example](myimg.png?resize=100,200&width=100&height=200) ![Example](myimg.png?width=auto&height=auto) ![Example](myimg.png?width&height) {{ page.media['myimg.png'].width().height().html }} {{ page.media['myimg.png'].resize(100,200).width(100).height(200).html }}</em> |
| public | <strong>higherQualityAlternative()</strong> : <em>ImageMedium the alternative version with higher quality</em><br /><em>Return the image higher quality version</em> |
| public | <strong>lightbox(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link with lightbox enabled</em> |
| public | <strong>link(</strong><em>bool</em> <strong>$reset=true</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link</em> |
| public | <strong>path(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string path to image</em><br /><em>Return PATH to image.</em> |
| public | <strong>quality(</strong><em>int</em> <strong>$quality=null</strong>)</strong> : <em>int/\Grav\Common\Page\Medium\$this</em><br /><em>Sets or gets the quality of the image</em> |
| public | <strong>reset()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Reset image.</em> |
| public | <strong>setImagePrettyName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Allows the ability to override the Inmage's Pretty name stored in cache</em> |
| public | <strong>sizes(</strong><em>string</em> <strong>$sizes=null</strong>)</strong> : <em>string</em><br /><em>Set or get sizes parameter for srcset media action</em> |
| public | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |
| public | <strong>srcset(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return srcset string for this Medium and its alternatives.</em> |
| public | <strong>url(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return URL to image.</em> |
| public | <strong>width(</strong><em>string/mixed</em> <strong>$value=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Allows to set the width attribute from Markdown or Twig Examples: ![Example](myimg.png?width=200&height=400) ![Example](myimg.png?resize=100,200&width=100&height=200) ![Example](myimg.png?width=auto&height=auto) ![Example](myimg.png?width&height) {{ page.media['myimg.png'].width().height().html }} {{ page.media['myimg.png'].resize(100,200).width(100).height(200).html }}</em> |
| protected | <strong>image()</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Gets medium image, resets image manipulation operations.</em> |
| protected | <strong>saveImage()</strong> : <em>string</em><br /><em>Save the image with cache.</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \JsonSerializable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

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
| public | <strong>getPath()</strong> : <em>null</em><br /><em>Return media path.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| protected | <strong>addMedium(</strong><em>string</em> <strong>$stream</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)/null</em> |
| protected | <strong>resolveStream(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>string/null</em> |

*This class extends [\Grav\Common\Page\Medium\AbstractMedia](#class-gravcommonpagemediumabstractmedia-abstract)*

*This class implements [\Grav\Framework\Media\Interfaces\MediaCollectionInterface](#interface-gravframeworkmediainterfacesmediacollectioninterface), \Traversable, \Iterator, \Countable, \ArrayAccess, [\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface), \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediumstaticimagemedium"></a>
### Class: \Grav\Common\Page\Medium\StaticImageMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>resize(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Resize media by setting attributes</em> |
| protected | <strong>sourceParsedownElement(</strong><em>array</em> <strong>$attributes</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Parsedown element for source display mode</em> |

*This class extends [\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)*

*This class implements [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), \ArrayAccess, \Countable, \JsonSerializable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="class-gravcommonpagemediumabstractmedia-abstract"></a>
### Class: \Grav\Common\Page\Medium\AbstractMedia (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__invoke(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>mixed</em><br /><em>Call object as function to get medium by filename.</em> |
| public | <strong>add(</strong><em>string</em> <strong>$name</strong>, <em>\Grav\Common\Page\Medium\MediaObjectInterface</em> <strong>$file</strong>)</strong> : <em>void</em> |
| public | <strong>all()</strong> : <em>[\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)[]</em><br /><em>Get a list of all media.</em> |
| public | <strong>audios()</strong> : <em>[\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)[]</em><br /><em>Get a list of all audio media.</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Implements Countable interface.</em> |
| public | <strong>current()</strong> : <em>mixed Can return any type.</em><br /><em>Returns the current element.</em> |
| public | <strong>files()</strong> : <em>[\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)[]</em><br /><em>Get a list of all file media.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)/null</em><br /><em>Get medium by filename.</em> |
| public | <strong>getPath()</strong> : <em>string</em><br /><em>Return media path.</em> |
| public | <strong>images()</strong> : <em>[\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)[]</em><br /><em>Get a list of all image media.</em> |
| public | <strong>key()</strong> : <em>mixed Returns scalar on success, or NULL on failure.</em><br /><em>Returns the key of the current element.</em> |
| public | <strong>next()</strong> : <em>void</em><br /><em>Moves the current position to the next element.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>rewind()</strong> : <em>void</em><br /><em>Rewinds back to the first element of the Iterator.</em> |
| public | <strong>setPath(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>setTimestamps(</strong><em>string/int/null</em> <strong>$timestamp=null</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Set file modification timestamps (query params) for all the media files.</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=3</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>valid()</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>This method is called after Iterator::rewind() and Iterator::next() to check if the current position is valid.</em> |
| public | <strong>videos()</strong> : <em>[\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface)[]</em><br /><em>Get a list of all video media.</em> |
| protected | <strong>getFileParts(</strong><em>string</em> <strong>$filename</strong>)</strong> : <em>array</em><br /><em>Get filename, extension and meta part.</em> |
| protected | <strong>orderMedia(</strong><em>array</em> <strong>$media</strong>)</strong> : <em>array</em><br /><em>Order the media based on the page's media_order</em> |

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, [\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface), \ArrayAccess, \Countable, \Iterator, \Traversable, [\Grav\Framework\Media\Interfaces\MediaCollectionInterface](#interface-gravframeworkmediainterfacesmediacollectioninterface)*

<hr /><a id="class-gravcommonpagemediumthumbnailimagemedium"></a>
### Class: \Grav\Common\Page\Medium\ThumbnailImageMedium

| Visibility | Function |
|:-----------|:---------|
| public | <strong>display(</strong><em>string</em> <strong>$mode=`'source'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch display mode.</em> |
| public | <strong>html(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return HTML markup from the medium.</em> |
| public | <strong>lightbox(</strong><em>int</em> <strong>$width=null</strong>, <em>int</em> <strong>$height=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link with lightbox enabled</em> |
| public | <strong>link(</strong><em>bool</em> <strong>$reset=true</strong>, <em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Link](#class-gravcommonpagemediumlink)</em><br /><em>Turn the current Medium into a Link</em> |
| public | <strong>parsedownElement(</strong><em>string</em> <strong>$title=null</strong>, <em>string</em> <strong>$alt=null</strong>, <em>string</em> <strong>$class=null</strong>, <em>string</em> <strong>$id=null</strong>, <em>bool</em> <strong>$reset=true</strong>)</strong> : <em>array</em><br /><em>Get an element (is array) that can be rendered by the Parsedown engine</em> |
| public | <strong>srcset(</strong><em>bool</em> <strong>$reset=true</strong>)</strong> : <em>string</em><br /><em>Return srcset string for this Medium and its alternatives.</em> |
| public | <strong>thumbnail(</strong><em>string</em> <strong>$type=`'auto'`</strong>)</strong> : <em>\Grav\Common\Page\Medium\$this</em><br /><em>Switch thumbnail.</em> |
| protected | <strong>bubble(</strong><em>string</em> <strong>$method</strong>, <em>array</em> <strong>$arguments=array()</strong>, <em>bool</em> <strong>$testLinked=true</strong>)</strong> : <em>[\Grav\Common\Page\Medium\Medium](#class-gravcommonpagemediummedium)</em><br /><em>Bubble a function call up to either the superclass function or the parent Medium instance</em> |

*This class extends [\Grav\Common\Page\Medium\ImageMedium](#class-gravcommonpagemediumimagemedium)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Common\Page\Medium\RenderableInterface](#interface-gravcommonpagemediumrenderableinterface), [\Grav\Common\Media\Interfaces\MediaObjectInterface](#interface-gravcommonmediainterfacesmediaobjectinterface), [\Grav\Framework\Media\Interfaces\MediaObjectInterface](#interface-gravframeworkmediainterfacesmediaobjectinterface)*

<hr /><a id="class-gravcommonprocessorsconfigurationprocessor"></a>
### Class: \Grav\Common\Processors\ConfigurationProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorserrorsprocessor"></a>
### Class: \Grav\Common\Processors\ErrorsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsprocessorbase-abstract"></a>
### Class: \Grav\Common\Processors\ProcessorBase (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Common\Grav](#class-gravcommongrav)</em> <strong>$container</strong>)</strong> : <em>void</em> |
| protected | <strong>addMessage(</strong><em>mixed</em> <strong>$message</strong>, <em>string</em> <strong>$label=`'info'`</strong>, <em>bool</em> <strong>$isString=true</strong>)</strong> : <em>void</em> |
| protected | <strong>startTimer(</strong><em>mixed</em> <strong>$id=null</strong>, <em>mixed</em> <strong>$title=null</strong>)</strong> : <em>void</em> |
| protected | <strong>stopTimer(</strong><em>mixed</em> <strong>$id=null</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface), \Psr\Http\Server\MiddlewareInterface*

<hr /><a id="class-gravcommonprocessorstasksprocessor"></a>
### Class: \Grav\Common\Processors\TasksProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorspluginsprocessor"></a>
### Class: \Grav\Common\Processors\PluginsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsdebuggerprocessor"></a>
### Class: \Grav\Common\Processors\DebuggerProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorstwigprocessor"></a>
### Class: \Grav\Common\Processors\TwigProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsdebuggerassetsprocessor"></a>
### Class: \Grav\Common\Processors\DebuggerAssetsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsinitializeprocessor"></a>
### Class: \Grav\Common\Processors\InitializeProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsbackupsprocessor"></a>
### Class: \Grav\Common\Processors\BackupsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsassetsprocessor"></a>
### Class: \Grav\Common\Processors\AssetsProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsrequestprocessor"></a>
### Class: \Grav\Common\Processors\RequestProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsthemesprocessor"></a>
### Class: \Grav\Common\Processors\ThemesProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsloggerprocessor"></a>
### Class: \Grav\Common\Processors\LoggerProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorsrenderprocessor"></a>
### Class: \Grav\Common\Processors\RenderProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="interface-gravcommonprocessorsprocessorinterface"></a>
### Interface: \Grav\Common\Processors\ProcessorInterface

| Visibility | Function |
|:-----------|:---------|

*This class implements \Psr\Http\Server\MiddlewareInterface*

<hr /><a id="class-gravcommonprocessorsschedulerprocessor"></a>
### Class: \Grav\Common\Processors\SchedulerProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorspagesprocessor"></a>
### Class: \Grav\Common\Processors\PagesProcessor

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Common\Processors\ProcessorBase](#class-gravcommonprocessorsprocessorbase-abstract)*

*This class implements \Psr\Http\Server\MiddlewareInterface, [\Grav\Common\Processors\ProcessorInterface](#interface-gravcommonprocessorsprocessorinterface)*

<hr /><a id="class-gravcommonprocessorseventsrequesthandlerevent"></a>
### Class: \Grav\Common\Processors\Events\RequestHandlerEvent

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addMiddleware(</strong><em>\string</em> <strong>$name</strong>, <em>\Psr\Http\Server\MiddlewareInterface</em> <strong>$middleware</strong>)</strong> : <em>[\Grav\Common\Processors\Events\RequestHandlerEvent](#class-gravcommonprocessorseventsrequesthandlerevent)</em> |
| public | <strong>getHandler()</strong> : <em>[\Grav\Framework\RequestHandler\RequestHandler](#class-gravframeworkrequesthandlerrequesthandler)</em> |
| public | <strong>getRequest()</strong> : <em>\Psr\Http\Message\ServerRequestInterface</em> |
| public | <strong>getResponse()</strong> : <em>\Grav\Common\Processors\Events\ResponseInterface/null</em> |
| public | <strong>getRoute()</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| public | <strong>setResponse(</strong><em>\Psr\Http\Message\ResponseInterface</em> <strong>$response</strong>)</strong> : <em>\Grav\Common\Processors\Events\$this</em> |

*This class extends \RocketTheme\Toolbox\Event\Event*

*This class implements \ArrayAccess*

<hr /><a id="class-gravcommonschedulercron"></a>
### Class: \Grav\Common\Scheduler\Cron

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string/null</em> <strong>$cron=null</strong>)</strong> : <em>void</em> |
| public | <strong>getCron()</strong> : <em>string</em> |
| public | <strong>getCronDaysOfMonth()</strong> : <em>string</em> |
| public | <strong>getCronDaysOfWeek()</strong> : <em>string</em> |
| public | <strong>getCronHours()</strong> : <em>string</em> |
| public | <strong>getCronMinutes()</strong> : <em>string</em> |
| public | <strong>getCronMonths()</strong> : <em>string</em> |
| public | <strong>getDaysOfMonth()</strong> : <em>array</em> |
| public | <strong>getDaysOfWeek()</strong> : <em>array</em> |
| public | <strong>getHours()</strong> : <em>array</em> |
| public | <strong>getMinutes()</strong> : <em>array</em> |
| public | <strong>getMonths()</strong> : <em>array</em> |
| public | <strong>getText(</strong><em>string</em> <strong>$lang</strong>)</strong> : <em>string</em> |
| public | <strong>getType()</strong> : <em>string</em> |
| public | <strong>matchExact(</strong><em>int/string/[\DateTime](http://php.net/manual/en/class.datetime.php)</em> <strong>$date</strong>)</strong> : <em>void</em> |
| public | <strong>matchWithMargin(</strong><em>int/string/[\DateTime](http://php.net/manual/en/class.datetime.php)</em> <strong>$date</strong>, <em>int</em> <strong>$minuteBefore</strong>, <em>int</em> <strong>$minuteAfter</strong>)</strong> : <em>void</em> |
| public | <strong>setCron(</strong><em>string</em> <strong>$cron</strong>)</strong> : <em>[\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)</em> |
| public | <strong>setDaysOfMonth(</strong><em>string/array</em> <strong>$dom</strong>)</strong> : <em>[\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)</em> |
| public | <strong>setDaysOfWeek(</strong><em>string/array</em> <strong>$dow</strong>)</strong> : <em>[\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)</em> |
| public | <strong>setHours(</strong><em>string/array</em> <strong>$hours</strong>)</strong> : <em>[\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)</em> |
| public | <strong>setMinutes(</strong><em>string/array</em> <strong>$minutes</strong>)</strong> : <em>[\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)</em> |
| public | <strong>setMonths(</strong><em>string/array</em> <strong>$months</strong>)</strong> : <em>[\Grav\Common\Scheduler\Cron](#class-gravcommonschedulercron)</em> |
| protected | <strong>arrayToCron(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>string</em> |
| protected | <strong>cronToArray(</strong><em>array/string</em> <strong>$string</strong>, <em>int</em> <strong>$min</strong>, <em>int</em> <strong>$max</strong>)</strong> : <em>array</em> |
| protected | <strong>parseDate(</strong><em>mixed</em> <strong>$date</strong>, <em>int</em> <strong>$min</strong>, <em>int</em> <strong>$hour</strong>, <em>int</em> <strong>$day</strong>, <em>int</em> <strong>$month</strong>, <em>int</em> <strong>$weekday</strong>)</strong> : <em>[\DateTime](http://php.net/manual/en/class.datetime.php)</em> |

<hr /><a id="class-gravcommonschedulerscheduler"></a>
### Class: \Grav\Common\Scheduler\Scheduler

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Create new instance.</em> |
| public | <strong>addCommand(</strong><em>string</em> <strong>$command</strong>, <em>array</em> <strong>$args=array()</strong>, <em>string</em> <strong>$id=null</strong>)</strong> : <em>[\Grav\Common\Scheduler\Job](#class-gravcommonschedulerjob)</em><br /><em>Queue a raw shell command.</em> |
| public | <strong>addFunction(</strong><em>\callable</em> <strong>$fn</strong>, <em>array</em> <strong>$args=array()</strong>, <em>string</em> <strong>$id=null</strong>)</strong> : <em>[\Grav\Common\Scheduler\Job](#class-gravcommonschedulerjob)</em><br /><em>Queues a PHP function execution.</em> |
| public | <strong>clearJobs()</strong> : <em>void</em><br /><em>Remove all queued Jobs.</em> |
| public | <strong>getAllJobs()</strong> : <em>array</em><br /><em>Get all jobs if they are disabled or not as one array</em> |
| public | <strong>getCronCommand()</strong> : <em>string</em><br /><em>Helper to get the full Cron command</em> |
| public | <strong>getJobStates()</strong> : <em>\RocketTheme\Toolbox\File\FileInterface/\Grav\Common\Scheduler\YamlFile</em><br /><em>Get the Job states file</em> |
| public | <strong>getQueuedJobs(</strong><em>bool</em> <strong>$all=false</strong>)</strong> : <em>array</em><br /><em>Get the queued jobs as background/foreground</em> |
| public | <strong>getVerboseOutput(</strong><em>string</em> <strong>$type=`'text'`</strong>)</strong> : <em>mixed The return depends on the requested $type</em><br /><em>Get the scheduler verbose output.</em> |
| public | <strong>isCrontabSetup()</strong> : <em>int</em><br /><em>Helper to determine if cron job is setup</em> |
| public | <strong>loadSavedJobs()</strong> : <em>mixed</em><br /><em>Load saved jobs from config/scheduler.yaml file</em> |
| public | <strong>resetRun()</strong> : <em>void</em><br /><em>Reset all collected data of last run. Call before run() if you call run() multiple times.</em> |
| public | <strong>run(</strong><em>[\DateTime](http://php.net/manual/en/class.datetime.php)/null/[\DateTime](http://php.net/manual/en/class.datetime.php)</em> <strong>$runTime=null</strong>)</strong> : <em>void</em><br /><em>Run the scheduler.</em> |

<hr /><a id="class-gravcommonschedulerjob"></a>
### Class: \Grav\Common\Scheduler\Job

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string/callable</em> <strong>$command</strong>, <em>array</em> <strong>$args=array()</strong>, <em>string</em> <strong>$id=null</strong>)</strong> : <em>void</em><br /><em>Create a new Job instance.</em> |
| public | <strong>april(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every April.</em> |
| public | <strong>at(</strong><em>string</em> <strong>$expression</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the Job execution time. *compo</em> |
| public | <strong>august(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every August.</em> |
| public | <strong>backlink(</strong><em>string</em> <strong>$link=null</strong>)</strong> : <em>null/string</em><br /><em>Sets/Gets an option backlink</em> |
| public | <strong>before(</strong><em>\callable</em> <strong>$fn</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set function to be called before job execution Job object is injected as a parameter to callable function.</em> |
| public | <strong>configure(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Configure the job.</em> |
| public | <strong>daily(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to once a day.</em> |
| public | <strong>december(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every December.</em> |
| public | <strong>email(</strong><em>string/array</em> <strong>$email</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the emails where the output should be sent to. The Job should be set to write output to a file for this to work.</em> |
| public | <strong>everyMinute()</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every minute.</em> |
| public | <strong>february(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every February.</em> |
| public | <strong>finalize()</strong> : <em>void</em><br /><em>Finish up processing the job</em> |
| public | <strong>friday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Friday.</em> |
| public | <strong>getArguments()</strong> : <em>string/null</em><br /><em>Get optional arguments</em> |
| public | <strong>getAt()</strong> : <em>string</em><br /><em>Get the cron 'at' syntax for this job</em> |
| public | <strong>getCommand()</strong> : <em>string</em><br /><em>Get the command</em> |
| public | <strong>getCronExpression()</strong> : <em>mixed</em> |
| public | <strong>getEnabled()</strong> : <em>bool</em><br /><em>Get the status of this job</em> |
| public | <strong>getId()</strong> : <em>string</em><br /><em>Get the Job id.</em> |
| public | <strong>getOutput()</strong> : <em>mixed</em><br /><em>Get the job output.</em> |
| public | <strong>hourly(</strong><em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every hour.</em> |
| public | <strong>inForeground()</strong> : <em>\Grav\Common\Scheduler\$this</em><br /><em>Force the Job to run in foreground.</em> |
| public | <strong>isDue(</strong><em>[\DateTime](http://php.net/manual/en/class.datetime.php)</em> <strong>$date=null</strong>)</strong> : <em>bool</em><br /><em>Check if the Job is due to run. It accepts as input a DateTime used to check if the job is due. Defaults to job creation time. It also default the execution time if not previously defined.</em> |
| public | <strong>isOverlapping()</strong> : <em>bool</em><br /><em>Check if the Job is overlapping.</em> |
| public | <strong>isSuccessful()</strong> : <em>bool</em><br /><em>Get the status of the last run for this job</em> |
| public | <strong>january(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every January.</em> |
| public | <strong>july(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every July.</em> |
| public | <strong>june(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every June.</em> |
| public | <strong>march(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every March.</em> |
| public | <strong>may(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every May.</em> |
| public | <strong>monday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Monday.</em> |
| public | <strong>monthly(</strong><em>string/int/string</em> <strong>$month=`'*'`</strong>, <em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to once a month.</em> |
| public | <strong>november(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every November.</em> |
| public | <strong>october(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every October.</em> |
| public | <strong>onlyOne(</strong><em>string</em> <strong>$tempDir=null</strong>, <em>\callable</em> <strong>$whenOverlapping=null</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>This will prevent the Job from overlapping. It prevents another instance of the same Job of being executed if the previous is still running. The job id is used as a filename for the lock file.</em> |
| public | <strong>output(</strong><em>string/array</em> <strong>$filename</strong>, <em>bool</em> <strong>$append=false</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the file/s where to write the output of the job.</em> |
| public | <strong>run()</strong> : <em>bool</em><br /><em>Run the job.</em> |
| public | <strong>runInBackground()</strong> : <em>bool</em><br /><em>Check if the Job can run in background.</em> |
| public | <strong>saturday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Saturday.</em> |
| public | <strong>september(</strong><em>int/string</em> <strong>$day=1</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every September.</em> |
| public | <strong>sunday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Sunday.</em> |
| public | <strong>then(</strong><em>\callable</em> <strong>$fn</strong>, <em>bool</em> <strong>$runInBackground=false</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set a function to be called after job execution. By default this will force the job to run in foreground because the output is injected as a parameter of this function, but it could be avoided by passing true as a second parameter. The job will run in background if it meets all the other criteria.</em> |
| public | <strong>thursday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Thursday.</em> |
| public | <strong>tuesday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Tuesday.</em> |
| public | <strong>wednesday(</strong><em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to every Wednesday.</em> |
| public | <strong>weekly(</strong><em>int/string</em> <strong>$weekday</strong>, <em>int/string</em> <strong>$hour</strong>, <em>int/string</em> <strong>$minute</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Set the execution time to once a week.</em> |
| public | <strong>when(</strong><em>\callable</em> <strong>$fn</strong>)</strong> : <em>\Grav\Common\Scheduler\self</em><br /><em>Truth test to define if the job should run if due.</em> |

<hr /><a id="class-gravcommonservicebackupsserviceprovider"></a>
### Class: \Grav\Common\Service\BackupsServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceaccountsserviceprovider"></a>
### Class: \Grav\Common\Service\AccountsServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |
| protected | <strong>dataAccounts(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |
| protected | <strong>flexAccounts(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |
| protected | <strong>getFlexStorage(</strong><em>mixed</em> <strong>$config</strong>)</strong> : <em>mixed</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonservicefilesystemserviceprovider"></a>
### Class: \Grav\Common\Service\FilesystemServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

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

<hr /><a id="class-gravcommonservicepagesserviceprovider"></a>
### Class: \Grav\Common\Service\PagesServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceschedulerserviceprovider"></a>
### Class: \Grav\Common\Service\SchedulerServiceProvider

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register(</strong><em>\Pimple\Container</em> <strong>$container</strong>)</strong> : <em>void</em> |

*This class implements \Pimple\ServiceProviderInterface*

<hr /><a id="class-gravcommonserviceinflectorserviceprovider"></a>
### Class: \Grav\Common\Service\InflectorServiceProvider

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

<hr /><a id="class-gravcommonservicerequestserviceprovider"></a>
### Class: \Grav\Common\Service\RequestServiceProvider

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
| public | <strong>absoluteUrlFilter(</strong><em>string</em> <strong>$string</strong>)</strong> : <em>mixed</em> |
| public | <strong>arrayFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>array</em><br /><em>Casts input to array.</em> |
| public | <strong>arrayIntersectFunc(</strong><em>array</em> <strong>$array1</strong>, <em>array</em> <strong>$array2</strong>)</strong> : <em>array</em><br /><em>Wrapper for array_intersect() method</em> |
| public | <strong>arrayKeyValueFunc(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$val</strong>, <em>array</em> <strong>$current_array=null</strong>)</strong> : <em>array</em><br /><em>Workaround for twig associative array initialization Returns a key => val array</em> |
| public | <strong>authorize(</strong><em>string/array</em> <strong>$action</strong>)</strong> : <em>bool Returns TRUE if the user is authorized to perform the action, FALSE otherwise.</em><br /><em>Authorize an action. Returns true if the user is logged in and has the right to execute $action. entry can be a string like 'group.action' or without dot notation an associative array.</em> |
| public | <strong>base32DecodeFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>bool/string</em><br /><em>Return Base32 decoded string</em> |
| public | <strong>base32EncodeFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Return Base32 encoded string</em> |
| public | <strong>base64DecodeFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>bool/string</em><br /><em>Return Base64 decoded string</em> |
| public | <strong>base64EncodeFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Return Base64 encoded string</em> |
| public | <strong>bodyClassFunc(</strong><em>string/string[]</em> <strong>$classes</strong>)</strong> : <em>string</em><br /><em>takes an array of classes, and if they are not set on body_classes look to see if they are set in theme config</em> |
| public | <strong>boolFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>bool</em><br /><em>Casts input to bool.</em> |
| public | <strong>chunkSplitFilter(</strong><em>string</em> <strong>$value</strong>, <em>int</em> <strong>$chars</strong>, <em>string</em> <strong>$split=`'-'`</strong>)</strong> : <em>string</em><br /><em>Wrapper for chunk_split() function</em> |
| public | <strong>containsFilter(</strong><em>string</em> <strong>$haystack</strong>, <em>string</em> <strong>$needle</strong>)</strong> : <em>bool</em><br /><em>determine if a string contains another</em> |
| public | <strong>cronFunc(</strong><em>string</em> <strong>$at</strong>)</strong> : <em>\Cron\CronExpression</em><br /><em>Get Cron object for a crontab 'at' format</em> |
| public | <strong>definedDefaultFilter(</strong><em>mixed</em> <strong>$value</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>null</em> |
| public | <strong>dump(</strong><em>\Twig_Environment</em> <strong>$env</strong>, <em>string</em> <strong>$context</strong>)</strong> : <em>void</em><br /><em>Based on Twig_Extension_Debug / twig_var_dump (c) 2011 Fabien Potencier</em> |
| public | <strong>endsWithFilter(</strong><em>string</em> <strong>$haystack</strong>, <em>string</em> <strong>$needle</strong>)</strong> : <em>bool</em> |
| public | <strong>evaluateStringFunc(</strong><em>array</em> <strong>$context</strong>, <em>string</em> <strong>$string</strong>)</strong> : <em>mixed</em><br /><em>This function will evaluate a $string through the $environment, and return its results.</em> |
| public | <strong>evaluateTwigFunc(</strong><em>array</em> <strong>$context</strong>, <em>string</em> <strong>$twig</strong>)</strong> : <em>mixed</em><br /><em>This function will evaluate Twig $twig through the $environment, and return its results.</em> |
| public | <strong>exifFunc(</strong><em>string</em> <strong>$image</strong>, <em>bool</em> <strong>$raw=false</strong>)</strong> : <em>mixed</em><br /><em>Get's the Exif data for a file</em> |
| public | <strong>fieldNameFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Filters field name by changing dot notation into array notation.</em> |
| public | <strong>floatFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>float</em><br /><em>Casts input to float.</em> |
| public | <strong>getCookie(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>mixed</em><br /><em>Used to retrieve a cookie value</em> |
| public | <strong>getFilters()</strong> : <em>array</em><br /><em>Return a list of all filters.</em> |
| public | <strong>getFunctions()</strong> : <em>array</em><br /><em>Return a list of all functions.</em> |
| public | <strong>getGlobals()</strong> : <em>array</em><br /><em>Register some standard globals</em> |
| public | <strong>getTokenParsers()</strong> : <em>array</em> |
| public | <strong>getTypeFunc(</strong><em>mixed</em> <strong>$var</strong>)</strong> : <em>string</em><br /><em>Function/Filter to return the type of variable</em> |
| public | <strong>gistFunc(</strong><em>string</em> <strong>$id</strong>, <em>bool/string/bool</em> <strong>$file=false</strong>)</strong> : <em>string</em><br /><em>Output a Gist</em> |
| public | <strong>inflectorFilter(</strong><em>string</em> <strong>$action</strong>, <em>string</em> <strong>$data</strong>, <em>int</em> <strong>$count=null</strong>)</strong> : <em>string</em><br /><em>Inflector supports following notations: `{{ 'person'|pluralize }} => people` `{{ 'shoes'|singularize }} => shoe` `{{ 'welcome page'|titleize }} => "Welcome Page"` `{{ 'send_email'|camelize }} => SendEmail` `{{ 'CamelCased'|underscorize }} => camel_cased` `{{ 'Something Text'|hyphenize }} => something-text` `{{ 'something_text_to_read'|humanize }} => "Something text to read"` `{{ '181'|monthize }} => 5` `{{ '10'|ordinalize }} => 10th`</em> |
| public | <strong>intFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>int</em><br /><em>Casts input to int.</em> |
| public | <strong>isAjaxFunc()</strong> : <em>bool True if HTTP_X_REQUESTED_WITH exists and has been set to xmlhttprequest</em><br /><em>Check if HTTP_X_REQUESTED_WITH has been set to xmlhttprequest, in which case we may unsafely assume ajax. Non critical use only.</em> |
| public | <strong>jsonDecodeFilter(</strong><em>string</em> <strong>$str</strong>, <em>bool</em> <strong>$assoc=false</strong>, <em>int</em> <strong>$depth=512</strong>, <em>int</em> <strong>$options</strong>)</strong> : <em>array</em><br /><em>Decodes string from JSON.</em> |
| public | <strong>ksortFilter(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>array</em><br /><em>Return ksorted collection.</em> |
| public | <strong>ltrimFilter(</strong><em>string</em> <strong>$value</strong>, <em>null</em> <strong>$chars=null</strong>)</strong> : <em>string</em> |
| public | <strong>markdownFunction(</strong><em>string</em> <strong>$string</strong>, <em>bool</em> <strong>$block=true</strong>)</strong> : <em>mixed/string</em> |
| public | <strong>md5Filter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Return MD5 hash from the input.</em> |
| public | <strong>mediaDirFunc(</strong><em>string</em> <strong>$media_dir</strong>)</strong> : <em>\Grav\Common\Twig\Media/null</em><br /><em>Process a folder as Media and return a media object</em> |
| public | <strong>modulusFilter(</strong><em>string/int</em> <strong>$number</strong>, <em>int</em> <strong>$divider</strong>, <em>array</em> <strong>$items=null</strong>)</strong> : <em>int</em><br /><em>Returns the modulus of an integer</em> |
| public | <strong>niceCronFilter(</strong><em>mixed</em> <strong>$at</strong>)</strong> : <em>string</em><br /><em>Gets a human readable output for cron sytnax</em> |
| public | <strong>niceFilesizeFunc(</strong><em>int</em> <strong>$bytes</strong>)</strong> : <em>string</em><br /><em>Returns a nicer more readable filesize based on bytes</em> |
| public | <strong>niceNumberFunc(</strong><em>int/float/string</em> <strong>$n</strong>)</strong> : <em>string/bool</em><br /><em>Returns a nicer more readable number</em> |
| public | <strong>nicetimeFunc(</strong><em>string</em> <strong>$date</strong>, <em>bool</em> <strong>$long_strings=true</strong>, <em>bool</em> <strong>$show_tense=true</strong>)</strong> : <em>bool</em><br /><em>displays a facebook style 'time ago' formatted date/time</em> |
| public | <strong>nonceFieldFunc(</strong><em>string</em> <strong>$action</strong>, <em>string</em> <strong>$nonceParamName=`'nonce'`</strong>)</strong> : <em>string the nonce input field</em><br /><em>Used to add a nonce to a form. Call {{ nonce_field('action') }} specifying a string representing the action. For maximum protection, ensure that the string representing the action is as specific as possible</em> |
| public | <strong>ofTypeFunc(</strong><em>mixed</em> <strong>$var</strong>, <em>string/null</em> <strong>$typeTest=null</strong>, <em>string/null</em> <strong>$className=null</strong>)</strong> : <em>bool</em><br /><em>Function/Filter to test type of variable</em> |
| public static | <strong>padFilter(</strong><em>string</em> <strong>$input</strong>, <em>int</em> <strong>$pad_length</strong>, <em>string</em> <strong>$pad_string=`' '`</strong>, <em>int</em> <strong>$pad_type=1</strong>)</strong> : <em>string</em><br /><em>Pad a string to a certain length with another string</em> |
| public | <strong>pageHeaderVarFunc(</strong><em>string</em> <strong>$var</strong>, <em>string/string[]/null</em> <strong>$pages=null</strong>)</strong> : <em>mixed</em><br /><em>Look for a page header variable in an array of pages working its way through until a value is found</em> |
| public | <strong>randomStringFunc(</strong><em>int</em> <strong>$count=5</strong>)</strong> : <em>string</em><br /><em>Generate a random string</em> |
| public | <strong>randomizeFilter(</strong><em>array</em> <strong>$original</strong>, <em>int</em> <strong>$offset</strong>)</strong> : <em>array</em><br /><em>Returns array in a random order.</em> |
| public | <strong>rangeFunc(</strong><em>int</em> <strong>$start</strong>, <em>int</em> <strong>$end=100</strong>, <em>int</em> <strong>$step=1</strong>)</strong> : <em>array</em><br /><em>Generates an array containing a range of elements, optionally stepped</em> |
| public | <strong>readFileFunc(</strong><em>string</em> <strong>$filepath</strong>)</strong> : <em>bool/string</em><br /><em>Simple function to read a file based on a filepath and output it</em> |
| public | <strong>redirectFunc(</strong><em>string</em> <strong>$url</strong>, <em>int</em> <strong>$statusCode=303</strong>)</strong> : <em>void</em><br /><em>redirect browser from twig</em> |
| public | <strong>regexFilter(</strong><em>array</em> <strong>$array</strong>, <em>string</em> <strong>$regex</strong>, <em>int</em> <strong>$flags</strong>)</strong> : <em>array</em><br /><em>Twig wrapper for PHP's preg_grep method</em> |
| public | <strong>regexReplace(</strong><em>mixed</em> <strong>$subject</strong>, <em>mixed</em> <strong>$pattern</strong>, <em>mixed</em> <strong>$replace</strong>, <em>int</em> <strong>$limit=-1</strong>)</strong> : <em>string/string[]/null the resulting content</em><br /><em>Twig wrapper for PHP's preg_replace method</em> |
| public | <strong>repeatFunc(</strong><em>string</em> <strong>$input</strong>, <em>int</em> <strong>$multiplier</strong>)</strong> : <em>string</em><br /><em>Repeat given string x times.</em> |
| public | <strong>rtrimFilter(</strong><em>string</em> <strong>$value</strong>, <em>null</em> <strong>$chars=null</strong>)</strong> : <em>string</em> |
| public | <strong>safeEmailFilter(</strong><em>string</em> <strong>$str</strong>)</strong> : <em>string</em><br /><em>Protects email address.</em> |
| public | <strong>sortByKeyFilter(</strong><em>array</em> <strong>$input</strong>, <em>string</em> <strong>$filter</strong>, <em>int</em> <strong>$direction=4</strong>, <em>int</em> <strong>$sort_flags</strong>)</strong> : <em>array</em><br /><em>Sorts a collection by key</em> |
| public | <strong>startsWithFilter(</strong><em>string</em> <strong>$haystack</strong>, <em>string</em> <strong>$needle</strong>)</strong> : <em>bool</em> |
| public | <strong>stringFilter(</strong><em>mixed</em> <strong>$input</strong>)</strong> : <em>string</em><br /><em>Casts input to string.</em> |
| public | <strong>stringFunc(</strong><em>array/string</em> <strong>$value</strong>)</strong> : <em>string</em><br /><em>Returns a string from a value. If the value is array, return it json encoded</em> |
| public | <strong>themeVarFunc(</strong><em>string</em> <strong>$var</strong>, <em>bool</em> <strong>$default=null</strong>)</strong> : <em>string</em><br /><em>Get a theme variable</em> |
| public | <strong>translate(</strong><em>\Twig_Environment</em> <strong>$twig</strong>)</strong> : <em>string</em> |
| public | <strong>translateArray(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$index</strong>, <em>array/null</em> <strong>$lang=null</strong>)</strong> : <em>string</em> |
| public | <strong>translateFunc()</strong> : <em>string</em><br /><em>Translate a string</em> |
| public | <strong>translateLanguage(</strong><em>string/array</em> <strong>$args</strong>, <em>array/null/array</em> <strong>$languages=null</strong>, <em>bool</em> <strong>$array_support=false</strong>, <em>bool</em> <strong>$html_out=false</strong>)</strong> : <em>string</em><br /><em>Translate Strings</em> |
| public | <strong>urlFunc(</strong><em>string</em> <strong>$input</strong>, <em>bool</em> <strong>$domain=false</strong>)</strong> : <em>string/null Returns url to the resource or null if resource was not found.</em><br /><em>Return URL to the resource.</em> |
| public | <strong>vardumpFunc(</strong><em>mixed</em> <strong>$var</strong>)</strong> : <em>void</em><br /><em>Dump a variable to the browser</em> |
| public | <strong>xssFunc(</strong><em>string/array</em> <strong>$data</strong>)</strong> : <em>bool/string/array</em><br /><em>Allow quick check of a string for XSS Vulnerabilities</em> |
| public | <strong>yamlDecodeFilter(</strong><em>string</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Decode/Parse data from YAML format</em> |
| public | <strong>yamlEncodeFilter(</strong><em>array</em> <strong>$data</strong>, <em>int</em> <strong>$inline=10</strong>)</strong> : <em>string</em><br /><em>Dump/Encode data into YAML format</em> |
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
| public | <strong>addPath(</strong><em>string</em> <strong>$template_path</strong>, <em>string</em> <strong>$namespace=`'__main__'`</strong>)</strong> : <em>void</em><br /><em>Wraps the Twig_Loader_Filesystem addPath method (should be used only in `onTwigLoader()` event</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Twig initialization that sets the twig loader chain, then the environment, then extensions and also the base set of twig vars</em> |
| public | <strong>loader()</strong> : <em>\Twig_Loader_Filesystem</em> |
| public | <strong>prependPath(</strong><em>string</em> <strong>$template_path</strong>, <em>string</em> <strong>$namespace=`'__main__'`</strong>)</strong> : <em>void</em><br /><em>Wraps the Twig_Loader_Filesystem prependPath method (should be used only in `onTwigLoader()` event</em> |
| public | <strong>processPage(</strong><em>[\Grav\Common\Page\Interfaces\PageInterface](#interface-gravcommonpageinterfacespageinterface)</em> <strong>$item</strong>, <em>string</em> <strong>$content=null</strong>)</strong> : <em>string The rendered output</em><br /><em>Twig process that renders a page item. It supports two variations: 1) Handles modular pages by rendering a specific page based on its modular twig template 2) Renders individual page items for twig processing before the site rendering</em> |
| public | <strong>processSite(</strong><em>string</em> <strong>$format=null</strong>, <em>array</em> <strong>$vars=array()</strong>)</strong> : <em>string the rendered output</em><br /><em>Twig process that renders the site layout. This is the main twig process that renders the overall page and handles all the layout for the site display.</em> |
| public | <strong>processString(</strong><em>string</em> <strong>$string</strong>, <em>array</em> <strong>$vars=array()</strong>)</strong> : <em>string</em><br /><em>Process a Twig template directly by using a Twig string and optional array of variables</em> |
| public | <strong>processTemplate(</strong><em>string</em> <strong>$template</strong>, <em>array</em> <strong>$vars=array()</strong>)</strong> : <em>string</em><br /><em>Process a Twig template directly by using a template name and optional array of variables</em> |
| public | <strike><strong>setAutoescape(</strong><em>bool</em> <strong>$state</strong>)</strong> : <em>void</em></strike><br /><em>DEPRECATED - 1.5 Auto-escape should always be turned on to protect against XSS issues (can be disabled per template file).</em> |
| public | <strong>setTemplate(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$template</strong>)</strong> : <em>void</em><br /><em>Adds or overrides a template.</em> |
| public | <strong>template(</strong><em>string</em> <strong>$template</strong>)</strong> : <em>string the template name</em><br /><em>Simple helper method to get the twig template if it has already been set, else return the one being passed in</em> |
| public | <strong>twig()</strong> : <em>\Twig_Environment</em> |

<hr /><a id="class-gravcommontwigtwigenvironment"></a>
### Class: \Grav\Common\Twig\TwigEnvironment

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>writeCacheFile(</strong><em>string</em> <strong>$file</strong>, <em>string</em> <strong>$content</strong>)</strong> : <em>void</em><br /><em>This exists so template cache files use the same group between apache and cli</em> |

*This class extends \Twig\Environment*

<hr /><a id="class-gravcommontwignodetwignodemarkdown"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeMarkdown

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig\Node\Node</em> <strong>$body</strong>, <em>int</em> <strong>$lineno</strong>, <em>string</em> <strong>$tag=`'markdown'`</strong>)</strong> : <em>void</em><br /><em>TwigNodeMarkdown constructor.</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeOutputInterface*

<hr /><a id="class-gravcommontwignodetwignodethrow"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeThrow

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>int</em> <strong>$code</strong>, <em>\Twig\Node\Node</em> <strong>$message</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeThrow constructor.</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface*

<hr /><a id="class-gravcommontwignodetwignoderender"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeRender

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig\Node\Expression\AbstractExpression</em> <strong>$object</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$layout</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$context</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeCaptureInterface*

<hr /><a id="class-gravcommontwignodetwignodetrycatch"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeTryCatch

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig\Node\Node</em> <strong>$try</strong>, <em>\Grav\Common\Twig\Node\Node/null/\Twig\Node\Node</em> <strong>$catch=null</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeTryCatch constructor.</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface*

<hr /><a id="class-gravcommontwignodetwignodescript"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeScript

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Grav\Common\Twig\Node\Node/null/\Twig\Node\Node</em> <strong>$body=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$file=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$group=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$priority=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$attributes=null</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeScript constructor.</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeCaptureInterface*

<hr /><a id="class-gravcommontwignodetwignodestyle"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeStyle

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Grav\Common\Twig\Node\Node/null/\Twig\Node\Node</em> <strong>$body=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$file=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$group=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$priority=null</strong>, <em>\Grav\Common\Twig\Node\AbstractExpression/null/\Twig\Node\Expression\AbstractExpression</em> <strong>$attributes=null</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeAssets constructor.</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface, \Twig\Node\NodeCaptureInterface*

<hr /><a id="class-gravcommontwignodetwignodeswitch"></a>
### Class: \Grav\Common\Twig\Node\TwigNodeSwitch

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Twig\Node\Node</em> <strong>$value</strong>, <em>\Twig\Node\Node</em> <strong>$cases</strong>, <em>\Grav\Common\Twig\Node\Node/null/\Twig\Node\Node</em> <strong>$default=null</strong>, <em>int</em> <strong>$lineno</strong>, <em>string/null</em> <strong>$tag=null</strong>)</strong> : <em>void</em><br /><em>TwigNodeSwitch constructor.</em> |
| public | <strong>compile(</strong><em>\Twig\Compiler</em> <strong>$compiler</strong>)</strong> : <em>void</em><br /><em>Compiles the node to PHP.</em> |

*This class extends \Twig\Node\Node*

*This class implements \Countable, \IteratorAggregate, \Traversable, \Twig_NodeInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparsertrycatch"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserTryCatch

> Handles try/catch in template file. <pre> {% try %} <li>{{ user.get('name') }}</li> {% catch %} {{ e.message }} {% endcatch %} </pre>

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideCatch(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>void</em> |
| public | <strong>decideEnd(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>void</em> |
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserrender"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserRender

> Renders an object. {% render object layout: 'default' with { variable: true } %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |
| protected | <strong>parseArguments(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>array</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserswitch"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserSwitch

> Adds ability use elegant switch instead of ungainly if statements {% switch type %} {% case 'foo' %} {{ my_data.foo }} {% case 'bar' %} {{ my_data.bar }} {% default %} {{ my_data.default }} {% endswitch %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideIfEnd(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>bool</em><br /><em>Decide if current token marks end of swtich block.</em> |
| public | <strong>decideIfFork(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>bool</em><br /><em>Decide if current token marks switch logic.</em> |
| public | <strong>getTag()</strong> : <em>mixed</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>void</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserthrow"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserThrow

> Handles try/catch in template file. <pre> {% throw 404 'Not Found' %} </pre>

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserscript"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserScript

> Adds a script to head/bottom/custom location in the document. {% script 'theme://js/something.js' in 'bottom' priority: 20 with { defer: true, async: true } %} {% script in 'bottom' priority: 20 %} alert('Warning!'); {% endscript %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideBlockEnd(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>bool</em> |
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |
| protected | <strong>parseArguments(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>array</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparsermarkdown"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserMarkdown

> Adds ability to inline markdown between tags. {% markdown %} This is **bold** and this _underlined_ 1. This is a bullet list 2. This is another item in that same list {% endmarkdown %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideMarkdownEnd(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>bool</em><br /><em>Decide if current token marks end of Markdown block.</em> |
| public | <strong>getTag()</strong> : <em>mixed</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>void</em> |

*This class extends \Twig\TokenParser\AbstractTokenParser*

*This class implements \Twig\TokenParser\TokenParserInterface*

<hr /><a id="class-gravcommontwigtokenparsertwigtokenparserstyle"></a>
### Class: \Grav\Common\Twig\TokenParser\TwigTokenParserStyle

> Adds a style to the document. {% style 'theme://css/foo.css' priority: 20 %} {% style priority: 20 with { media: 'screen' } %} a { color: red; } {% endstyle %}

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decideBlockEnd(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>bool</em> |
| public | <strong>getTag()</strong> : <em>string The tag name</em><br /><em>Gets the tag name associated with this token parser.</em> |
| public | <strong>parse(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>Node A Twig_Node instance</em><br /><em>Parses a token and returns a node.</em> |
| protected | <strong>parseArguments(</strong><em>\Twig\Token</em> <strong>$token</strong>)</strong> : <em>array</em> |

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

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface)*

<hr /><a id="class-gravcommonuserauthentication-abstract"></a>
### Class: \Grav\Common\User\Authentication (abstract)

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>create(</strong><em>string</em> <strong>$password</strong>)</strong> : <em>string</em><br /><em>Create password hash from plaintext password.</em> |
| public static | <strong>verify(</strong><em>string</em> <strong>$password</strong>, <em>string</em> <strong>$hash</strong>)</strong> : <em>int Returns if the check fails, 1 if password matches, 2 if hash needs to be updated.</em><br /><em>Verifies that a password matches a hash.</em> |

<hr /><a id="class-gravcommonuserdatauseruser"></a>
### Class: \Grav\Common\User\DataUser\User

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>\Grav\Common\User\DataUser\Blueprint</em> <strong>$blueprints=null</strong>)</strong> : <em>void</em><br /><em>User constructor.</em> |
| public | <strong>__sleep()</strong> : <em>void</em><br /><em>Serialize user.</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Unserialize user.</em> |
| public | <strong>authenticate(</strong><em>\string</em> <strong>$password</strong>)</strong> : <em>bool</em><br /><em>Authenticate user. If user password needs to be updated, new information will be saved.</em> |
| public | <strike><strong>authorise(</strong><em>string</em> <strong>$action</strong>)</strong> : <em>bool</em></strike><br /><em>DEPRECATED - 1.5 Use ->authorize() method instead.</em> |
| public | <strong>authorize(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>)</strong> : <em>bool</em><br /><em>Checks user authorization to the action.</em> |
| public | <strike><strong>avatarUrl()</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use ->getAvatarUrl() method instead.</em> |
| public | <strike><strong>count()</strong> : <em>int</em></strike><br /><em>DEPRECATED - 1.6 Method makes no sense for user account.</em> |
| public | <strong>getAvatarImage()</strong> : <em>\Grav\Common\User\DataUser\ImageMedium/null</em><br /><em>Return media object for the User's avatar. Note: if there's no local avatar image for the user, you should call getAvatarUrl() to get the external avatar URL.</em> |
| public | <strike><strong>getAvatarMedia()</strong> : <em>\Grav\Common\User\DataUser\ImageMedium/null</em></strike><br /><em>DEPRECATED - 1.6 Use ->getAvatarImage() method instead.</em> |
| public | <strong>getAvatarUrl()</strong> : <em>string</em><br /><em>Return the User's avatar URL</em> |
| public | <strong>getMedia()</strong> : <em>mixed</em> |
| public | <strong>getMediaFolder()</strong> : <em>mixed</em> |
| public | <strong>getMediaOrder()</strong> : <em>mixed</em> |
| public | <strong>isValid()</strong> : <em>bool</em> |
| public | <strike><strong>merge(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>\Grav\Common\User\DataUser\$this</em></strike><br /><em>DEPRECATED - 1.6 Use `->update($data)` instead (same but with data validation & filtering, file upload support).</em> |
| public | <strong>offsetExists(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>bool</em> |
| public | <strong>offsetGet(</strong><em>string</em> <strong>$offset</strong>)</strong> : <em>mixed</em> |
| public | <strong>save()</strong> : <em>void</em><br /><em>Save user without the username</em> |
| public | <strong>update(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$files=array()</strong>)</strong> : <em>\Grav\Common\User\DataUser\$this</em><br /><em>Update object with data</em> |
| protected | <strong>getAvatarFile()</strong> : <em>mixed</em> |

*This class extends [\Grav\Common\Data\Data](#class-gravcommondatadata)*

*This class implements \RocketTheme\Toolbox\ArrayTraits\ExportInterface, \JsonSerializable, \Countable, \ArrayAccess, [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface), [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface), [\Grav\Common\Media\Interfaces\MediaInterface](#interface-gravcommonmediainterfacesmediainterface)*

<hr /><a id="class-gravcommonuserdatauserusercollection"></a>
### Class: \Grav\Common\User\DataUser\UserCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$className</strong>)</strong> : <em>void</em><br /><em>UserCollection constructor.</em> |
| public | <strong>count()</strong> : <em>void</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>bool True if the action was performed</em><br /><em>Remove user account.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$query</strong>, <em>array</em> <strong>$fields=array()</strong>)</strong> : <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em><br /><em>Find a user by username, email, etc</em> |
| public | <strong>load(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em><br /><em>Load user account. Always creates user object. To check if user exists, use $this->exists().</em> |

*This class implements [\Grav\Common\User\Interfaces\UserCollectionInterface](#interface-gravcommonuserinterfacesusercollectioninterface), \Countable*

<hr /><a id="class-gravcommonuserflexuseruser"></a>
### Class: \Grav\Common\User\FlexUser\User

> Flex User Flex User is mostly compatible with the older User class, except on few key areas: - Constructor parameters have been changed. Old code creating a new user does not work. - Serializer has been changed -- existing sessions will be killed.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements</strong>, <em>mixed</em> <strong>$key</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\bool</em> <strong>$validate=false</strong>)</strong> : <em>void</em> |
| public | <strong>__debugInfo()</strong> : <em>void</em> |
| public | <strong>authenticate(</strong><em>\string</em> <strong>$password</strong>)</strong> : <em>bool</em><br /><em>Authenticate user. If user password needs to be updated, new information will be saved.</em> |
| public | <strike><strong>authorise(</strong><em>string</em> <strong>$action</strong>)</strong> : <em>bool</em></strike><br /><em>DEPRECATED - 1.5 Use ->authorize() method instead.</em> |
| public | <strong>authorize(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>)</strong> : <em>bool</em><br /><em>Checks user authorization to the action.</em> |
| public | <strike><strong>avatarUrl()</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use ->getAvatarUrl() method instead.</em> |
| public | <strong>checkMediaFilename(</strong><em>\string</em> <strong>$filename</strong>)</strong> : <em>void</em> |
| public | <strong>checkUploadedMediaFile(</strong><em>\Psr\Http\Message\UploadedFileInterface</em> <strong>$uploadedFile</strong>)</strong> : <em>void</em> |
| public | <strike><strong>count()</strong> : <em>int</em></strike><br /><em>DEPRECATED - 1.6 Method makes no sense for user account.</em> |
| public | <strong>def(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Set default value by using dot notation for nested arrays/objects.</em> |
| public | <strong>deleteMediaFile(</strong><em>\string</em> <strong>$filename</strong>)</strong> : <em>void</em> |
| public | <strong>extra()</strong> : <em>array</em><br /><em>Get extra items which haven't been defined in blueprints.</em> |
| public | <strong>file(</strong><em>\RocketTheme\Toolbox\File\FileInterface</em> <strong>$storage=null</strong>)</strong> : <em>\RocketTheme\Toolbox\File\FileInterface</em><br /><em>Set or get the data storage.</em> |
| public | <strong>filter()</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Filter all items by using blueprints.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
| public | <strong>getAvatarImage()</strong> : <em>\Grav\Common\User\FlexUser\ImageMedium/null</em><br /><em>Return media object for the User's avatar. Note: if there's no local avatar image for the user, you should call getAvatarUrl() to get the external avatar URL.</em> |
| public | <strike><strong>getAvatarMedia()</strong> : <em>\Grav\Common\User\FlexUser\ImageMedium/null</em></strike><br /><em>DEPRECATED - 1.6 Use ->getAvatarImage() method instead.</em> |
| public | <strong>getAvatarUrl()</strong> : <em>string</em><br /><em>Return the User's avatar URL</em> |
| public static | <strong>getCachedMethods()</strong> : <em>array</em> |
| public | <strong>getDefaults()</strong> : <em>array</em><br /><em>Get nested structure containing default values defined in the blueprints. Fields without default value are ignored in the list.</em> |
| public | <strong>getFormValue(</strong><em>\string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>\string</em> <strong>$separator=null</strong>)</strong> : <em>mixed</em><br /><em>Get value from a page variable (used mostly for creating edit forms).</em> |
| public | <strong>getJoined(</strong><em>string</em> <strong>$name</strong>, <em>array/object</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array</em><br /><em>Get value from the configuration and join it with given data.</em> |
| protected | <strong>getMedia()</strong> : <em>MediaCollectionInterface Representation of associated media.</em><br /><em>Gets the associated media collection.</em> |
| public | <strong>getMediaFolder()</strong> : <em>string</em> |
| public | <strong>getMediaOrder()</strong> : <em>array Empty array means default ordering.</em><br /><em>Get display order for the associated media.</em> |
| public | <strong>getMediaUri()</strong> : <em>null/string</em><br /><em>Get URI ot the associated media. Method will return null if path isn't URI.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getStorageFolder()</strong> : <em>string</em> |
| public | <strong>isAuthorized(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>, <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user=null</strong>)</strong> : <em>bool</em> |
| public | <strong>isValid()</strong> : <em>bool</em> |
| public | <strong>join(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Join nested values together by using blueprints.</em> |
| public | <strong>joinDefaults(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Set default values by using blueprints.</em> |
| public | <strike><strong>merge(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em></strike><br /><em>DEPRECATED - 1.6 Use `->update($data)` instead (same but with data validation & filtering, file upload support).</em> |
| public | <strong>prepareStorage()</strong> : <em>array</em> |
| public | <strong>raw()</strong> : <em>string</em><br /><em>Return unmodified data as raw string. NOTE: This function only returns data which has been saved to the storage.</em> |
| public | <strong>save()</strong> : <em>void</em><br /><em>Save user without the username</em> |
| public | <strong>set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Set value by using dot notation for nested arrays/objects.</em> |
| public | <strong>setDefaults(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Set default values to the configuration if variables were not set.</em> |
| public | <strong>toArray()</strong> : <em>array</em><br /><em>Convert object into an array.</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Convert object into JSON string.</em> |
| public | <strong>toYaml(</strong><em>int</em> <strong>$inline=5</strong>, <em>int</em> <strong>$indent=2</strong>)</strong> : <em>string A YAML string representing the object.</em><br /><em>Convert object into YAML string.</em> |
| public | <strong>undef(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Unset value by using dot notation for nested arrays/objects.</em> |
| public | <strong>uploadMediaFile(</strong><em>\Psr\Http\Message\UploadedFileInterface</em> <strong>$uploadedFile</strong>, <em>\string</em> <strong>$filename=null</strong>)</strong> : <em>void</em> |
| public | <strong>validate()</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Validate by blueprints.</em> |
| protected | <strong>clearMediaCache()</strong> : <em>void</em><br /><em>Clear media cache.</em> |
| protected | <strong>createMedium(</strong><em>string</em> <strong>$uri</strong>)</strong> : <em>\Grav\Common\User\FlexUser\Medium/null</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>getMediaCache()</strong> : <em>\Grav\Common\User\FlexUser\Cache</em> |
| protected | <strong>getOriginalMedia()</strong> : <em>MediaCollectionInterface Representation of associated media.</em><br /><em>Gets the associated media collection (original images).</em> |
| protected | <strong>getUpdatedMedia()</strong> : <em>array</em> |
| protected | <strong>isAuthorizedAction(</strong><em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user</strong>, <em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>)</strong> : <em>bool</em> |
| protected | <strong>isAuthorizedSuperAdmin(</strong><em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user</strong>)</strong> : <em>bool</em> |
| protected | <strong>offsetLoad_media()</strong> : <em>void</em> |
| protected | <strong>offsetSerialize_media()</strong> : <em>void</em> |
| protected | <strong>parseFileProperty(</strong><em>array</em> <strong>$value</strong>)</strong> : <em>array</em> |
| protected | <strong>saveUpdatedMedia()</strong> : <em>void</em> |
| protected | <strong>setAuthorizeRule(</strong><em>\string</em> <strong>$authorize</strong>)</strong> : <em>void</em> |
| protected | <strong>setMedia(</strong><em>[\Grav\Common\Media\Interfaces\MediaCollectionInterface](#interface-gravcommonmediainterfacesmediacollectioninterface)</em> <strong>$media</strong>)</strong> : <em>\Grav\Common\User\FlexUser\$this</em><br /><em>Sets the associated media collection.</em> |
| protected | <strong>setUpdatedMedia(</strong><em>array</em> <strong>$files</strong>)</strong> : <em>void</em> |
###### Examples of User::def()
```
$data->def('this.is.my.nested.variable', 'default');
```
###### Examples of User::get()
```
$value = $this->get('this.is.my.nested.variable');
```
###### Examples of User::set()
```
$data->set('this.is.my.nested.variable', $value);
```
###### Examples of User::undef()
```
$data->undef('this.is.my.nested.variable');
```

*This class extends [\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface](#interface-gravframeworkflexinterfacesflexauthorizeinterface), [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess, [\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface), [\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface), \RocketTheme\Toolbox\ArrayTraits\ExportInterface, [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface), [\Grav\Common\Media\Interfaces\MediaInterface](#interface-gravcommonmediainterfacesmediainterface), [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Framework\Media\Interfaces\MediaManipulationInterface](#interface-gravframeworkmediainterfacesmediamanipulationinterface), \Countable*

<hr /><a id="class-gravcommonuserflexuserusercollection"></a>
### Class: \Grav\Common\User\FlexUser\UserCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>bool True if user account was found and was deleted.</em><br /><em>Delete user account.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$query</strong>, <em>array</em> <strong>$fields=array()</strong>)</strong> : <em>[\Grav\Common\User\FlexUser\User](#class-gravcommonuserflexuseruser)</em><br /><em>Find a user by username, email, etc</em> |
| public | <strong>load(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>[\Grav\Common\User\FlexUser\User](#class-gravcommonuserflexuseruser)</em><br /><em>Load user account. Always creates user object. To check if user exists, use $this->exists().</em> |

*This class extends [\Grav\Framework\Flex\FlexCollection](#class-gravframeworkflexflexcollection)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface), \JsonSerializable, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), [\Grav\Common\User\Interfaces\UserCollectionInterface](#interface-gravcommonuserinterfacesusercollectioninterface)*

<hr /><a id="class-gravcommonuserflexuseruserindex"></a>
### Class: \Grav\Common\User\FlexUser\UserIndex

| Visibility | Function |
|:-----------|:---------|
| public | <strong>find(</strong><em>string</em> <strong>$query</strong>, <em>array</em> <strong>$fields=array()</strong>)</strong> : <em>[\Grav\Common\User\FlexUser\User](#class-gravcommonuserflexuseruser)</em><br /><em>Find a user by username, email, etc</em> |
| public | <strong>load(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>[\Grav\Common\User\FlexUser\User](#class-gravcommonuserflexuseruser)</em><br /><em>Load user account. Always creates user object. To check if user exists, use $this->exists().</em> |
| public static | <strong>loadEntriesFromStorage(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>)</strong> : <em>array</em> |
| protected static | <strong>getIndexFile(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>)</strong> : <em>mixed</em> |
| protected static | <strong>onChanges(</strong><em>array</em> <strong>$entries</strong>, <em>array</em> <strong>$added</strong>, <em>array</em> <strong>$updated</strong>, <em>array</em> <strong>$removed</strong>)</strong> : <em>void</em> |
| protected static | <strong>updateIndexData(</strong><em>mixed</em> <strong>$entry</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Flex\FlexIndex](#class-gravframeworkflexflexindex)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexIndexInterface](#interface-gravframeworkflexinterfacesflexindexinterface), [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface), \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \JsonSerializable, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="class-gravcommonuserflexuserstorageuserfolderstorage"></a>
### Class: \Grav\Common\User\FlexUser\Storage\UserFolderStorage

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Grav\Framework\Flex\Storage\FolderStorage](#class-gravframeworkflexstoragefolderstorage)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)*

<hr /><a id="class-gravcommonuserflexuserstorageuserfilestorage"></a>
### Class: \Grav\Common\User\FlexUser\Storage\UserFileStorage

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Grav\Framework\Flex\Storage\FileStorage](#class-gravframeworkflexstoragefilestorage)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)*

<hr /><a id="interface-gravcommonuserinterfacesuserinterface"></a>
### Interface: \Grav\Common\User\Interfaces\UserInterface

> Interface UserInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>authenticate(</strong><em>\string</em> <strong>$password</strong>)</strong> : <em>bool</em><br /><em>Authenticate user. If user password needs to be updated, new information will be saved.</em> |
| public | <strong>authorize(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>)</strong> : <em>bool</em><br /><em>Checks user authorization to the action.</em> |
| public | <strong>def(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Set default value by using dot notation for nested arrays/objects.</em> |
| public | <strong>exists()</strong> : <em>bool</em><br /><em>Returns whether the data already exists in the storage. NOTE: This method does not check if the data is current.</em> |
| public | <strong>get(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Value.</em><br /><em>Get value by using dot notation for nested arrays/objects.</em> |
| public | <strong>getAvatarImage()</strong> : <em>\Grav\Common\User\Interfaces\ImageMedium/null</em><br /><em>Return media object for the User's avatar. Note: if there's no local avatar image for the user, you should call getAvatarUrl() to get the external avatar URL.</em> |
| public | <strong>getAvatarUrl()</strong> : <em>string</em><br /><em>Return the User's avatar URL.</em> |
| public | <strong>getDefaults()</strong> : <em>array</em><br /><em>Get nested structure containing default values defined in the blueprints. Fields without default value are ignored in the list.</em> |
| public | <strong>getJoined(</strong><em>string</em> <strong>$name</strong>, <em>array/object</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>array</em><br /><em>Get value from the configuration and join it with given data.</em> |
| public | <strong>join(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Join nested values together by using blueprints.</em> |
| public | <strong>joinDefaults(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=`'.'`</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Set default values by using blueprints.</em> |
| public | <strong>raw()</strong> : <em>string</em><br /><em>Return unmodified data as raw string. NOTE: This function only returns data which has been saved to the storage.</em> |
| public | <strong>set(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Set value by using dot notation for nested arrays/objects.</em> |
| public | <strong>setDefaults(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Set default values to the configuration if variables were not set.</em> |
| public | <strong>undef(</strong><em>string</em> <strong>$name</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Unset value by using dot notation for nested arrays/objects.</em> |
| public | <strong>update(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$files=array()</strong>)</strong> : <em>\Grav\Common\User\Interfaces\$this</em><br /><em>Update object with data</em> |
###### Examples of UserInterface::def()
```
$data->def('this.is.my.nested.variable', 'default');
```
###### Examples of UserInterface::get()
```
$value = $this->get('this.is.my.nested.variable');
```
###### Examples of UserInterface::set()
```
$data->set('this.is.my.nested.variable', $value);
```
###### Examples of UserInterface::undef()
```
$data->undef('this.is.my.nested.variable');
```

*This class implements [\Grav\Common\Data\DataInterface](#interface-gravcommondatadatainterface), [\Grav\Common\Media\Interfaces\MediaInterface](#interface-gravcommonmediainterfacesmediainterface), [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface), \ArrayAccess, \JsonSerializable, \RocketTheme\Toolbox\ArrayTraits\ExportInterface*

<hr /><a id="interface-gravcommonuserinterfacesusercollectioninterface"></a>
### Interface: \Grav\Common\User\Interfaces\UserCollectionInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>bool True if user account was found and was deleted.</em><br /><em>Delete user account.</em> |
| public | <strong>find(</strong><em>string</em> <strong>$query</strong>, <em>array</em> <strong>$fields=array()</strong>)</strong> : <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em><br /><em>Find a user by username, email, etc</em> |
| public | <strong>load(</strong><em>string</em> <strong>$username</strong>)</strong> : <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em><br /><em>Load user account. Always creates user object. To check if user exists, use $this->exists().</em> |

*This class implements \Countable*

<hr /><a id="class-gravconsoleconsolecommand"></a>
### Class: \Grav\Console\ConsoleCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clearCache(</strong><em>array</em> <strong>$all=array()</strong>)</strong> : <em>int</em> |
| public | <strong>composerUpdate(</strong><em>mixed</em> <strong>$path</strong>, <em>string</em> <strong>$action=`'install'`</strong>)</strong> : <em>void</em> |
| public | <strong>invalidateCache()</strong> : <em>void</em> |
| public | <strong>isGravInstance(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>bool</em> |
| public | <strong>loadLocalConfig()</strong> : <em>mixed string the local config file name. false if local config does not exist</em><br /><em>Load the local config file</em> |
| public | <strong>setupConsole(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>void</em><br /><em>Set colors style definition for the formatter.</em> |
| protected | <strong>displayGPMRelease()</strong> : <em>void</em> |
| protected | <strong>execute(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>int/null/void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends \Symfony\Component\Console\Command\Command*

<hr /><a id="class-gravconsolecliyamllintercommand"></a>
### Class: \Grav\Console\Cli\YamlLinterCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>displayErrors(</strong><em>mixed</em> <strong>$errors</strong>, <em>mixed</em> <strong>$io</strong>)</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclischedulercommand"></a>
### Class: \Grav\Console\Cli\SchedulerCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclisecuritycommand"></a>
### Class: \Grav\Console\Cli\SecurityCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>outputProgress(</strong><em>array</em> <strong>$args</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolecliinstallcommand"></a>
### Class: \Grav\Console\Cli\InstallCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclicomposercommand"></a>
### Class: \Grav\Console\Cli\ComposerCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclilogviewercommand"></a>
### Class: \Grav\Console\Cli\LogViewerCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclicleancommand"></a>
### Class: \Grav\Console\Cli\CleanCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>setupConsole(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>void</em><br /><em>Set colors style definition for the formatter.</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>execute(</strong><em>\Symfony\Component\Console\Input\InputInterface</em> <strong>$input</strong>, <em>\Symfony\Component\Console\Output\OutputInterface</em> <strong>$output</strong>)</strong> : <em>void</em> |

*This class extends \Symfony\Component\Console\Command\Command*

<hr /><a id="class-gravconsoleclisandboxcommand"></a>
### Class: \Grav\Console\Cli\SandboxCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolecliclearcachecommand"></a>
### Class: \Grav\Console\Cli\ClearCacheCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclibackupcommand"></a>
### Class: \Grav\Console\Cli\BackupCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>outputProgress(</strong><em>array</em> <strong>$args</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsoleclinewprojectcommand"></a>
### Class: \Grav\Console\Cli\NewProjectCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

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
| public | <strong>askConfirmationIfMajorVersionUpdated(</strong><em>\Grav\Console\Gpm\Package</em> <strong>$package</strong>)</strong> : <em>void</em><br /><em>If the package is updated from an older major release, show warning and ask confirmation</em> |
| public | <strong>installDependencies(</strong><em>array</em> <strong>$dependencies</strong>, <em>string</em> <strong>$type</strong>, <em>string</em> <strong>$message</strong>, <em>bool</em> <strong>$required=true</strong>)</strong> : <em>void</em><br /><em>Given a $dependencies list, filters their type according to $type and shows $message prior to listing them to the user. Then asks the user a confirmation prior to installing them.</em> |
| public | <strong>progress(</strong><em>array</em> <strong>$progress</strong>)</strong> : <em>void</em> |
| public | <strong>setGpm(</strong><em>[\Grav\Common\GPM\GPM](#class-gravcommongpmgpm)</em> <strong>$gpm</strong>)</strong> : <em>void</em><br /><em>Allows to set the GPM object, used for testing the class</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>bool</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmuninstallcommand"></a>
### Class: \Grav\Console\Gpm\UninstallCommand

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

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
| protected | <strong>serve()</strong> : <em>void</em> |

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
| public | <strong>filter(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>mixed</em> |
| public | <strong>sort(</strong><em>\Grav\Console\Gpm\Packages</em> <strong>$packages</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

*This class extends [\Grav\Console\ConsoleCommand](#class-gravconsoleconsolecommand)*

<hr /><a id="class-gravconsolegpmselfupgradecommand"></a>
### Class: \Grav\Console\Gpm\SelfupgradeCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>formatBytes(</strong><em>int/float</em> <strong>$size</strong>, <em>int</em> <strong>$precision=2</strong>)</strong> : <em>string</em> |
| public | <strong>progress(</strong><em>array</em> <strong>$progress</strong>)</strong> : <em>void</em> |
| protected | <strong>configure()</strong> : <em>void</em> |
| protected | <strong>serve()</strong> : <em>void</em> |

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
| public | <strong>setValidation(</strong><em>bool</em> <strong>$validation</strong>)</strong> : <em>void</em> |
| protected | <strong>convertTtl(</strong><em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)/mixed</em> <strong>$ttl</strong>)</strong> : <em>int/null</em> |
| protected | <strong>getDefaultLifetime()</strong> : <em>int/null</em> |
| protected | <strong>getNamespace()</strong> : <em>string</em> |
| protected | <strong>init(</strong><em>string</em> <strong>$namespace=`''`</strong>, <em>null/int/[\DateInterval](http://php.net/manual/en/class.dateinterval.php)</em> <strong>$defaultLifetime=null</strong>)</strong> : <em>void</em><br /><em>Always call from constructor.</em> |
| protected | <strong>validateKey(</strong><em>string/mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
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
| protected | <strong>doInitializeChildren(</strong><em>[\RecursiveDirectoryIterator[]](http://php.net/manual/en/class.recursivedirectoryiterator.php)</em> <strong>$children</strong>, <em>mixed</em> <strong>$nestingLimit</strong>)</strong> : <em>array</em> |
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
| public | <strong>select(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Select items from collection. Collection is returned in the order of $keys given to the function.</em> |
| public | <strong>shuffle()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Shuffle items.</em> |
| public | <strong>unselect(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Un-select items from collection.</em> |

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

<hr /><a id="class-gravframeworkcollectionabstractindexcollection-abstract"></a>
### Class: \Grav\Framework\Collection\AbstractIndexCollection (abstract)

> Abstract Index Collection.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$entries=array()</strong>)</strong> : <em>void</em><br /><em>Initializes a new IndexCollection.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>add(</strong><em>mixed</em> <strong>$element</strong>)</strong> : <em>void</em> |
| public | <strong>chunk(</strong><em>int</em> <strong>$size</strong>)</strong> : <em>array</em><br /><em>Split collection into chunks.</em> |
| public | <strong>clear()</strong> : <em>void</em> |
| public | <strong>contains(</strong><em>mixed</em> <strong>$element</strong>)</strong> : <em>void</em> |
| public | <strong>containsKey(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>count()</strong> : <em>void</em> |
| public | <strong>current()</strong> : <em>void</em> |
| public | <strong>exists(</strong><em>[\Closure](http://php.net/manual/en/class.closure.php)</em> <strong>$p</strong>)</strong> : <em>void</em> |
| public | <strong>filter(</strong><em>[\Closure](http://php.net/manual/en/class.closure.php)</em> <strong>$p</strong>)</strong> : <em>void</em> |
| public | <strong>first()</strong> : <em>void</em> |
| public | <strong>forAll(</strong><em>[\Closure](http://php.net/manual/en/class.closure.php)</em> <strong>$p</strong>)</strong> : <em>void</em> |
| public | <strong>get(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>mixed</em> |
| public | <strong>getIterator()</strong> : <em>mixed</em><br /><em>Required by interface IteratorAggregate.</em> |
| public | <strong>getKeys()</strong> : <em>mixed</em> |
| public | <strong>getValues()</strong> : <em>mixed</em> |
| public | <strong>indexOf(</strong><em>mixed</em> <strong>$element</strong>)</strong> : <em>void</em> |
| public | <strong>isEmpty()</strong> : <em>bool</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implementes JsonSerializable interface.</em> |
| public | <strong>key()</strong> : <em>void</em> |
| public | <strong>last()</strong> : <em>void</em> |
| public | <strong>limit(</strong><em>int</em> <strong>$start</strong>, <em>int/null</em> <strong>$limit=null</strong>)</strong> : <em>\Grav\Framework\Collection\static</em> |
| public | <strong>map(</strong><em>[\Closure](http://php.net/manual/en/class.closure.php)</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>next()</strong> : <em>void</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Required by interface ArrayAccess.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Required by interface ArrayAccess.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Required by interface ArrayAccess.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Required by interface ArrayAccess.</em> |
| public | <strong>partition(</strong><em>[\Closure](http://php.net/manual/en/class.closure.php)</em> <strong>$p</strong>)</strong> : <em>void</em> |
| public | <strong>remove(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>removeElement(</strong><em>mixed</em> <strong>$element</strong>)</strong> : <em>void</em> |
| public | <strong>reverse()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Reverse the order of the items.</em> |
| public | <strong>select(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Select items from collection. Collection is returned in the order of $keys given to the function.</em> |
| public | <strong>serialize()</strong> : <em>string</em> |
| public | <strong>set(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>shuffle()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Shuffle items.</em> |
| public | <strong>slice(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$length=null</strong>)</strong> : <em>void</em> |
| public | <strong>toArray()</strong> : <em>void</em> |
| public | <strong>unselect(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Un-select items from collection.</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>createFrom(</strong><em>array</em> <strong>$entries</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Creates a new instance from the specified elements. This method is provided for derived classes to specify how a new instance should be created when constructor semantics have changed.</em> |
| protected | <strong>abstract getElementMeta(</strong><em>mixed</em> <strong>$element</strong>)</strong> : <em>mixed</em> |
| protected | <strong>getEntries()</strong> : <em>array</em> |
| protected | <strong>abstract isAllowedElement(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>bool</em> |
| protected | <strong>abstract loadCollection(</strong><em>array/null/array</em> <strong>$entries=null</strong>)</strong> : <em>[\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface)</em> |
| protected | <strong>abstract loadElement(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>abstract loadElements(</strong><em>array/null/array</em> <strong>$entries=null</strong>)</strong> : <em>array</em> |
| protected | <strong>setEntries(</strong><em>array</em> <strong>$entries</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection*

<hr /><a id="interface-gravframeworkcollectioncollectioninterface"></a>
### Interface: \Grav\Framework\Collection\CollectionInterface

> Collection Interface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>chunk(</strong><em>int</em> <strong>$size</strong>)</strong> : <em>array</em><br /><em>Split collection into chunks.</em> |
| public | <strong>reverse()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Reverse the order of the items.</em> |
| public | <strong>select(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Select items from collection. Collection is returned in the order of $keys given to the function.</em> |
| public | <strong>shuffle()</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Shuffle items.</em> |
| public | <strong>unselect(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\Grav\Framework\Collection\static</em><br /><em>Un-select items from collection.</em> |

*This class implements \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \JsonSerializable*

<hr /><a id="class-gravframeworkcollectionabstractlazycollection-abstract"></a>
### Class: \Grav\Framework\Collection\AbstractLazyCollection (abstract)

> General JSON serializable collection.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>chunk(</strong><em>mixed</em> <strong>$size</strong>)</strong> : <em>void</em> |
| public | <strong>jsonSerialize()</strong> : <em>void</em> |
| public | <strong>reverse()</strong> : <em>void</em> |
| public | <strong>select(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>void</em> |
| public | <strong>shuffle()</strong> : <em>void</em> |
| public | <strong>unselect(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>void</em> |

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
| public | <strong>disableCache()</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public static | <strong>fromArray(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>[\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface)</em> |
| public | <strong>getChecksum()</strong> : <em>string</em> |
| public | <strong>getId()</strong> : <em>string</em> |
| public | <strong>getToken()</strong> : <em>string</em> |
| public | <strong>isCached()</strong> : <em>bool</em> |
| public | <strong>serialize()</strong> : <em>string</em> |
| public | <strong>setChecksum(</strong><em>string</em> <strong>$checksum</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>setContent(</strong><em>string</em> <strong>$content</strong>)</strong> : <em>\Grav\Framework\ContentBlock\$this</em> |
| public | <strong>toArray()</strong> : <em>array</em> |
| public | <strong>toString()</strong> : <em>string</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>checkVersion(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>generateId()</strong> : <em>string</em> |

*This class implements [\Grav\Framework\ContentBlock\ContentBlockInterface](#interface-gravframeworkcontentblockcontentblockinterface), \Serializable*

<hr /><a id="class-gravframeworkdicontainer"></a>
### Class: \Grav\Framework\DI\Container

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>mixed</em> <strong>$id</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>mixed</em> <strong>$id</strong>)</strong> : <em>bool</em> |

*This class extends \Pimple\Container*

*This class implements \ArrayAccess, \Psr\Container\ContainerInterface*

<hr /><a id="class-gravframeworkfilefile"></a>
### Class: \Grav\Framework\File\File

| Visibility | Function |
|:-----------|:---------|
| public | <strong>load()</strong> : <em>mixed</em> |
| public | <strong>save(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\File\AbstractFile](#class-gravframeworkfileabstractfile)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface)*

<hr /><a id="class-gravframeworkfilejsonfile"></a>
### Class: \Grav\Framework\File\JsonFile

> Class JsonFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\Formatter\JsonFormatter](#class-gravframeworkfileformatterjsonformatter)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>File constructor.</em> |

*This class extends [\Grav\Framework\File\DataFile](#class-gravframeworkfiledatafile)*

*This class implements [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface), \Serializable*

<hr /><a id="class-gravframeworkfilecsvfile"></a>
### Class: \Grav\Framework\File\CsvFile

> Class IniFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\Formatter\CsvFormatter](#class-gravframeworkfileformattercsvformatter)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>File constructor.</em> |

*This class extends [\Grav\Framework\File\DataFile](#class-gravframeworkfiledatafile)*

*This class implements [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface), \Serializable*

<hr /><a id="class-gravframeworkfileabstractfile"></a>
### Class: \Grav\Framework\File\AbstractFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__clone()</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>\string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\File](#class-gravframeworkfilefile)system/null/[\Grav\Framework\Filesystem\Filesystem](#class-gravframeworkfilesystemfilesystem)</em> <strong>$filesystem=null</strong>)</strong> : <em>void</em> |
| public | <strong>__destruct()</strong> : <em>void</em><br /><em>Unlock file when the object gets destroyed.</em> |
| public | <strong>delete()</strong> : <em>void</em> |
| public | <strong>exists()</strong> : <em>void</em> |
| public | <strong>getBasename()</strong> : <em>mixed</em> |
| public | <strong>getCreationTime()</strong> : <em>mixed</em> |
| public | <strong>getExtension(</strong><em>\bool</em> <strong>$withDot=false</strong>)</strong> : <em>mixed</em> |
| public | <strong>getFilePath()</strong> : <em>mixed</em> |
| public | <strong>getFilename()</strong> : <em>mixed</em> |
| public | <strong>getModificationTime()</strong> : <em>mixed</em> |
| public | <strong>getPath()</strong> : <em>mixed</em> |
| public | <strong>isLocked()</strong> : <em>bool</em> |
| public | <strong>isReadable()</strong> : <em>bool</em> |
| public | <strong>isWritable()</strong> : <em>bool</em> |
| public | <strong>load()</strong> : <em>mixed</em> |
| public | <strong>lock(</strong><em>\bool</em> <strong>$block=true</strong>)</strong> : <em>void</em> |
| public | <strong>rename(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>save(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>serialize()</strong> : <em>string</em> |
| public | <strong>unlock()</strong> : <em>void</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>isWritablePath(</strong><em>\string</em> <strong>$dir</strong>)</strong> : <em>bool</em> |
| protected | <strong>mkdir(</strong><em>\string</em> <strong>$dir</strong>)</strong> : <em>bool</em> |
| protected | <strong>setFilepath(</strong><em>\string</em> <strong>$filepath</strong>)</strong> : <em>void</em> |
| protected | <strong>setPathInfo()</strong> : <em>void</em> |
| protected | <strong>tempname(</strong><em>\string</em> <strong>$filename</strong>, <em>\int</em> <strong>$length=5</strong>)</strong> : <em>string</em> |

*This class implements [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface), \Serializable*

<hr /><a id="class-gravframeworkfiledatafile"></a>
### Class: \Grav\Framework\File\DataFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>File constructor.</em> |
| public | <strong>load()</strong> : <em>mixed</em> |
| public | <strong>save(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\File\AbstractFile](#class-gravframeworkfileabstractfile)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface)*

<hr /><a id="class-gravframeworkfilemarkdownfile"></a>
### Class: \Grav\Framework\File\MarkdownFile

> Class MarkdownFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\Formatter\MarkdownFormatter](#class-gravframeworkfileformattermarkdownformatter)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>File constructor.</em> |

*This class extends [\Grav\Framework\File\DataFile](#class-gravframeworkfiledatafile)*

*This class implements [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface), \Serializable*

<hr /><a id="class-gravframeworkfileyamlfile"></a>
### Class: \Grav\Framework\File\YamlFile

> Class YamlFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\Formatter\YamlFormatter](#class-gravframeworkfileformatteryamlformatter)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>File constructor.</em> |

*This class extends [\Grav\Framework\File\DataFile](#class-gravframeworkfiledatafile)*

*This class implements [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface), \Serializable*

<hr /><a id="class-gravframeworkfileinifile"></a>
### Class: \Grav\Framework\File\IniFile

> Class IniFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$filepath</strong>, <em>[\Grav\Framework\File\Formatter\IniFormatter](#class-gravframeworkfileformatteriniformatter)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>File constructor.</em> |

*This class extends [\Grav\Framework\File\DataFile](#class-gravframeworkfiledatafile)*

*This class implements [\Grav\Framework\File\Interfaces\FileInterface](#interface-gravframeworkfileinterfacesfileinterface), \Serializable*

<hr /><a id="class-gravframeworkfileformatterjsonformatter"></a>
### Class: \Grav\Framework\File\Formatter\JsonFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getDecodeAssoc()</strong> : <em>bool</em><br /><em>Returns true if JSON objects will be converted into associative arrays.</em> |
| public | <strong>getDecodeDepth()</strong> : <em>int</em><br /><em>Returns recursion depth used in decode() function.</em> |
| public | <strong>getDecodeOptions()</strong> : <em>int</em><br /><em>Returns options used in decode() function.</em> |
| public | <strong>getEncodeOptions()</strong> : <em>int</em><br /><em>Returns options used in encode() function.</em> |

*This class extends [\Grav\Framework\File\Formatter\AbstractFormatter](#class-gravframeworkfileformatterabstractformatter-abstract)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)*

<hr /><a id="class-gravframeworkfileformatterabstractformatter-abstract"></a>
### Class: \Grav\Framework\File\Formatter\AbstractFormatter (abstract)

> Abstract file formatter.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>IniFormatter constructor.</em> |
| public | <strong>abstract decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>abstract encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>mixed</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>mixed</em> |
| public | <strong>serialize()</strong> : <em>string</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em><br /><em>Note: if overridden, make sure you call parent::doUnserialize()</em> |
| protected | <strong>getConfig(</strong><em>\string</em> <strong>$name=null</strong>)</strong> : <em>mixed</em><br /><em>Get either full configuration or a single option.</em> |

*This class implements [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface), \Serializable*

<hr /><a id="interface-gravframeworkfileformatterformatterinterface"></a>
### <strike>Interface: \Grav\Framework\File\Formatter\FormatterInterface</strike>

> **DEPRECATED** 1.6 Use Grav\Framework\File\Interfaces\FileFormatterInterface instead

| Visibility | Function |
|:-----------|:---------|

*This class implements [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface), \Serializable*

<hr /><a id="class-gravframeworkfileformattercsvformatter"></a>
### Class: \Grav\Framework\File\Formatter\CsvFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>IniFormatter constructor.</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>, <em>mixed</em> <strong>$delimiter=null</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>, <em>mixed</em> <strong>$delimiter=null</strong>)</strong> : <em>void</em> |
| public | <strong>getDelimiter()</strong> : <em>string</em><br /><em>Returns delimiter used to both encode and decode CSV.</em> |

*This class extends [\Grav\Framework\File\Formatter\AbstractFormatter](#class-gravframeworkfileformatterabstractformatter-abstract)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)*

<hr /><a id="class-gravframeworkfileformatterserializeformatter"></a>
### Class: \Grav\Framework\File\Formatter\SerializeFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>IniFormatter constructor.</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getOptions()</strong> : <em>array/bool</em><br /><em>Returns options used in decode(). By default only allow stdClass class.</em> |
| protected | <strong>preserveLines(</strong><em>mixed</em> <strong>$data</strong>, <em>array</em> <strong>$search</strong>, <em>array</em> <strong>$replace</strong>)</strong> : <em>mixed</em><br /><em>Preserve new lines, recursive function.</em> |

*This class extends [\Grav\Framework\File\Formatter\AbstractFormatter](#class-gravframeworkfileformatterabstractformatter-abstract)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)*

<hr /><a id="class-gravframeworkfileformatteriniformatter"></a>
### Class: \Grav\Framework\File\Formatter\IniFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>IniFormatter constructor.</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\File\Formatter\AbstractFormatter](#class-gravframeworkfileformatterabstractformatter-abstract)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)*

<hr /><a id="class-gravframeworkfileformatteryamlformatter"></a>
### Class: \Grav\Framework\File\Formatter\YamlFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>, <em>mixed</em> <strong>$inline=null</strong>, <em>mixed</em> <strong>$indent=null</strong>)</strong> : <em>void</em> |
| public | <strong>getIndentOption()</strong> : <em>int</em> |
| public | <strong>getInlineOption()</strong> : <em>int</em> |
| public | <strong>useCompatibleDecoder()</strong> : <em>bool</em> |
| public | <strong>useNativeDecoder()</strong> : <em>bool</em> |

*This class extends [\Grav\Framework\File\Formatter\AbstractFormatter](#class-gravframeworkfileformatterabstractformatter-abstract)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)*

<hr /><a id="class-gravframeworkfileformattermarkdownformatter"></a>
### Class: \Grav\Framework\File\Formatter\MarkdownFormatter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>, <em>[\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)</em> <strong>$headerFormatter=null</strong>)</strong> : <em>void</em> |
| public | <strong>decode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>getBodyField()</strong> : <em>string</em><br /><em>Returns body field used in both encode() and decode().</em> |
| public | <strong>getHeaderField()</strong> : <em>string</em><br /><em>Returns header field used in both encode() and decode().</em> |
| public | <strong>getHeaderFormatter()</strong> : <em>[\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)</em><br /><em>Returns header formatter object used in both encode() and decode().</em> |
| public | <strong>getRawField()</strong> : <em>string</em><br /><em>Returns raw field used in both encode() and decode().</em> |

*This class extends [\Grav\Framework\File\Formatter\AbstractFormatter](#class-gravframeworkfileformatterabstractformatter-abstract)*

*This class implements \Serializable, [\Grav\Framework\File\Interfaces\FileFormatterInterface](#interface-gravframeworkfileinterfacesfileformatterinterface)*

<hr /><a id="interface-gravframeworkfileinterfacesfileinterface"></a>
### Interface: \Grav\Framework\File\Interfaces\FileInterface

> Defines common interface for all file readers. File readers allow you to read and optionally write files of various file formats, such as:

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete()</strong> : <em>bool Returns `true` if the file was successfully deleted, `false` otherwise.</em><br /><em>Delete file from filesystem.</em> |
| public | <strong>exists()</strong> : <em>bool Returns `true` if the filename exists and is a regular file, `false` otherwise.</em><br /><em>Check if the file exits in the filesystem.</em> |
| public | <strong>getBasename()</strong> : <em>string Returns basename of the file.</em><br /><em>Get basename of the file (filename without the associated file extension).</em> |
| public | <strong>getCreationTime()</strong> : <em>int Returns Unix timestamp. If file does not exist, method returns current time.</em><br /><em>Get file creation time.</em> |
| public | <strong>getExtension(</strong><em>\bool</em> <strong>$withDot=false</strong>)</strong> : <em>string Returns file extension of the file (can be empty).</em><br /><em>Get file extension of the file.</em> |
| public | <strong>getFilePath()</strong> : <em>string Returns path and filename in the filesystem. Can also be URI.</em><br /><em>Get both path and filename of the file.</em> |
| public | <strong>getFilename()</strong> : <em>string Returns name of the file.</em><br /><em>Get filename of the file.</em> |
| public | <strong>getModificationTime()</strong> : <em>int Returns Unix timestamp. If file does not exist, method returns current time.</em><br /><em>Get file modification time.</em> |
| public | <strong>getPath()</strong> : <em>string Returns path in the filesystem. Can also be URI.</em><br /><em>Get path of the file.</em> |
| public | <strong>isLocked()</strong> : <em>bool Returns `true` if the file is locked, `false` otherwise.</em><br /><em>Returns true if file has been locked by you for writing.</em> |
| public | <strong>isReadable()</strong> : <em>bool Returns `true` if the file can be read, `false` otherwise.</em><br /><em>Check if file exists and can be read.</em> |
| public | <strong>isWritable()</strong> : <em>bool Returns `true` if the file can be written, `false` otherwise.</em><br /><em>Check if file can be written.</em> |
| public | <strong>load()</strong> : <em>string/array/object/false Returns file content or `false` if file couldn't be read.</em><br /><em>(Re)Load a file and return file contents.</em> |
| public | <strong>lock(</strong><em>\bool</em> <strong>$block=true</strong>)</strong> : <em>bool Returns `true` if the file was successfully locked, `false` otherwise.</em><br /><em>Lock file for writing. You need to manually call unlock().</em> |
| public | <strong>rename(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>bool Returns `true` if the file was successfully renamed, `false` otherwise.</em><br /><em>Rename file in the filesystem if it exists. Target folder will be created if if did not exist.</em> |
| public | <strong>save(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Save file. See supported data format for each of the file format.</em> |
| public | <strong>unlock()</strong> : <em>bool Returns `true` if the file was successfully unlocked, `false` otherwise.</em><br /><em>Unlock file after writing.</em> |

*This class implements \Serializable*

<hr /><a id="interface-gravframeworkfileinterfacesfileformatterinterface"></a>
### Interface: \Grav\Framework\File\Interfaces\FileFormatterInterface

> Defines common interface for all file formatters. File formatters allow you to read and optionally write various file formats, such as:

| Visibility | Function |
|:-----------|:---------|
| public | <strong>decode(</strong><em>string</em> <strong>$data</strong>)</strong> : <em>mixed Returns decoded data.</em><br /><em>Decode a string into data.</em> |
| public | <strong>encode(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>string Returns encoded data as a string.</em><br /><em>Encode data into a string.</em> |
| public | <strong>getDefaultFileExtension()</strong> : <em>string Returns file extension (can be empty).</em><br /><em>Get default file extension from current formatter (with dot). Default file extension is the first defined extension.</em> |
| public | <strong>getSupportedFileExtensions()</strong> : <em>string[] Returns list of all supported file extensions.</em><br /><em>Get file extensions supported by current formatter (with dot).</em> |

*This class implements \Serializable*

<hr /><a id="class-gravframeworkfilesystemfilesystem"></a>
### Class: \Grav\Framework\Filesystem\Filesystem

| Visibility | Function |
|:-----------|:---------|
| public | <strong>dirname(</strong><em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$levels=1</strong>)</strong> : <em>void</em> |
| public static | <strong>getInstance(</strong><em>\bool</em> <strong>$normalize=null</strong>)</strong> : <em>[\Grav\Framework\Filesystem\Filesystem](#class-gravframeworkfilesystemfilesystem)</em> |
| public | <strong>normalize(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>parent(</strong><em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$levels=1</strong>)</strong> : <em>void</em> |
| public | <strong>pathinfo(</strong><em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| public | <strong>safe()</strong> : <em>\Grav\Framework\Filesystem\static</em><br /><em>Force all paths not to be normalized (speeds up the calls if given paths are known to be normalized).</em> |
| public | <strong>setNormalization(</strong><em>\bool</em> <strong>$normalize=null</strong>)</strong> : <em>[\Grav\Framework\Filesystem\Filesystem](#class-gravframeworkfilesystemfilesystem)</em><br /><em>Set path normalization. Default option enables normalization for the streams only, but you can force the normalization to be either on or off for every path. Disabling path normalization speeds up the calls, but may cause issues if paths were not normalized.</em> |
| public | <strong>unsafe()</strong> : <em>\Grav\Framework\Filesystem\static</em><br /><em>Force all paths to be normalized.</em> |
| protected | <strong>__construct(</strong><em>\bool</em> <strong>$normalize=null</strong>)</strong> : <em>void</em><br /><em>Always use Filesystem::getInstance() instead.</em> |
| protected | <strong>dirnameInternal(</strong><em>string/null/\string</em> <strong>$scheme</strong>, <em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$levels=1</strong>)</strong> : <em>array</em> |
| protected | <strong>getSchemeAndHierarchy(</strong><em>\string</em> <strong>$filename</strong>)</strong> : <em>array</em><br /><em>Gets a 2-tuple of scheme (may be null) and hierarchical part of a filename (e.g. file:///tmp -> array(file, tmp)).</em> |
| protected | <strong>normalizePathPart(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>string</em> |
| protected | <strong>pathinfoInternal(</strong><em>string/null/\string</em> <strong>$scheme</strong>, <em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$options=null</strong>)</strong> : <em>array</em> |
| protected | <strong>toString(</strong><em>string/null/\string</em> <strong>$scheme</strong>, <em>\string</em> <strong>$path</strong>)</strong> : <em>string</em> |

*This class implements [\Grav\Framework\Filesystem\Interfaces\FilesystemInterface](#interface-gravframeworkfilesysteminterfacesfilesysteminterface)*

<hr /><a id="interface-gravframeworkfilesysteminterfacesfilesysteminterface"></a>
### Interface: \Grav\Framework\Filesystem\Interfaces\FilesystemInterface

> Defines several stream-save filesystem actions.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>dirname(</strong><em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$levels=1</strong>)</strong> : <em>string Returns path to the directory.</em><br /><em>Stream-safe `\dirname()` replacement.</em> |
| public | <strong>normalize(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>string Returns normalized path.</em><br /><em>Normalize path by cleaning up `\`, `/./`, `//` and `/../`.</em> |
| public | <strong>parent(</strong><em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$levels=1</strong>)</strong> : <em>string Returns parent path.</em><br /><em>Get parent path. Empty path is returned if there are no segments remaining. Can be used recursively to get towards the root directory.</em> |
| public | <strong>pathinfo(</strong><em>\string</em> <strong>$path</strong>, <em>\int</em> <strong>$options=null</strong>)</strong> : <em>array/string</em><br /><em>Stream-safe `\pathinfo()` replacement.</em> |

<hr /><a id="class-gravframeworkflexflexdirectory"></a>
### Class: \Grav\Framework\Flex\FlexDirectory

> Class FlexDirectory

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$type</strong>, <em>\string</em> <strong>$blueprint_file</strong>, <em>array</em> <strong>$defaults=array()</strong>)</strong> : <em>void</em><br /><em>FlexDirectory constructor.</em> |
| public | <strong>clearCache()</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>createCollection(</strong><em>array</em> <strong>$entries</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em> |
| public | <strong>createIndex(</strong><em>array</em> <strong>$entries</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexIndexInterface](#interface-gravframeworkflexinterfacesflexindexinterface)</em> |
| public | <strong>createObject(</strong><em>array</em> <strong>$data</strong>, <em>\string</em> <strong>$key=`''`</strong>, <em>\bool</em> <strong>$validate=false</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em> |
| public | <strong>getBlueprint(</strong><em>\string</em> <strong>$type=`''`</strong>, <em>\string</em> <strong>$context=`''`</strong>)</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> |
| public | <strong>getBlueprintFile(</strong><em>\string</em> <strong>$view=`''`</strong>)</strong> : <em>string</em> |
| public | <strong>getCache(</strong><em>\string</em> <strong>$namespace=null</strong>)</strong> : <em>[\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)</em> |
| public | <strong>getCollection(</strong><em>array/null/array</em> <strong>$keys=null</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em><br /><em>Get collection. In the site this will be filtered by the default filters (published etc). Use $directory->getIndex() if you want unfiltered collection.</em> |
| public | <strong>getCollectionClass()</strong> : <em>string</em> |
| public | <strong>getConfig(</strong><em>\string</em> <strong>$name=null</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getDescription()</strong> : <em>string</em> |
| public | <strong>getFlexType()</strong> : <em>string</em> |
| public | <strong>getIndex(</strong><em>array/null/array</em> <strong>$keys=null</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexIndexInterface](#interface-gravframeworkflexinterfacesflexindexinterface)</em><br /><em>Get the full collection of all stored objects. Use $directory->getCollection() if you want a filtered collection.</em> |
| public | <strong>getIndexClass()</strong> : <em>string</em> |
| public | <strong>getMediaFolder(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>string</em> |
| public | <strong>getObject(</strong><em>string</em> <strong>$key</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)Interface/null</em><br /><em>Returns an object if it exists. Note: It is not safe to use the object without checking if the user can access it.</em> |
| public | <strong>getObjectClass()</strong> : <em>string</em> |
| public | <strong>getStorage()</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> |
| public | <strong>getStorageFolder(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>string</em> |
| public | <strong>getTitle()</strong> : <em>string</em> |
| public | <strike><strong>getType()</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use ->getFlexType() method instead.</em> |
| public | <strong>isAuthorized(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>, <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user=null</strong>)</strong> : <em>bool</em> |
| public | <strong>isEnabled()</strong> : <em>bool</em> |
| public | <strong>loadCollection(</strong><em>array</em> <strong>$entries</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em> |
| public | <strong>loadObjects(</strong><em>array</em> <strong>$entries</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)[]</em> |
| public | <strong>remove(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)Interface/null</em> |
| public | <strong>update(</strong><em>array</em> <strong>$data</strong>, <em>\string</em> <strong>$key=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em> |
| protected | <strong>createStorage()</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> |
| protected | <strong>getBlueprintInternal(</strong><em>\string</em> <strong>$type_view=`''`</strong>, <em>\string</em> <strong>$context=`''`</strong>)</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> |
| protected | <strong>isAuthorizedAction(</strong><em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user</strong>, <em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>)</strong> : <em>bool</em> |
| protected | <strong>isAuthorizedSuperAdmin(</strong><em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user</strong>)</strong> : <em>bool</em> |
| protected | <strong>loadIndex()</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexIndexInterface](#interface-gravframeworkflexinterfacesflexindexinterface)</em> |
| protected | <strong>setAuthorizeRule(</strong><em>\string</em> <strong>$authorize</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface](#interface-gravframeworkflexinterfacesflexauthorizeinterface)*

<hr /><a id="class-gravframeworkflexflex"></a>
### Class: \Grav\Framework\Flex\Flex

> Class Flex

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$types</strong>, <em>array</em> <strong>$config</strong>)</strong> : <em>void</em><br /><em>Flex constructor.</em> |
| public | <strong>addDirectory(</strong><em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>addDirectoryType(</strong><em>\string</em> <strong>$type</strong>, <em>\string</em> <strong>$blueprint</strong>, <em>array</em> <strong>$config=array()</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>count()</strong> : <em>int</em> |
| public | <strong>getCollection(</strong><em>\string</em> <strong>$type</strong>, <em>array/null/array</em> <strong>$keys=null</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexCollection](#class-gravframeworkflexflexcollection)Interface/null</em> |
| public | <strong>getDirectories(</strong><em>array/string[]</em> <strong>$types=null</strong>, <em>\bool</em> <strong>$keepMissing=false</strong>)</strong> : <em>array/[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)[]</em> |
| public | <strong>getDirectory(</strong><em>\string</em> <strong>$type</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)/null</em> |
| public | <strong>getMixedCollection(</strong><em>array</em> <strong>$keys</strong>, <em>array</em> <strong>$options=array()</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em><br /><em>collection_class:   Class to be used to create the collection. Defaults to ObjectCollection.</em> |
| public | <strong>getObject(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$type=null</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)Interface/null</em> |
| public | <strong>getObjects(</strong><em>array</em> <strong>$keys</strong>, <em>array</em> <strong>$options=array()</strong>)</strong> : <em>array</em><br /><em>types:          List of allowed types. type:           Allowed type if types isn't defined, otherwise acts as default_type. default_type:   Set default type for objects given without type (only used if key_field isn't set). keep_missing:   Set to true if you want to return missing objects as null. key_field:      Key field which is used to match the objects.</em> |
| public | <strong>hasDirectory(</strong><em>\string</em> <strong>$type</strong>)</strong> : <em>bool</em> |
| protected | <strong>resolveKeyAndType(</strong><em>\string</em> <strong>$flexKey</strong>, <em>\string</em> <strong>$type=null</strong>)</strong> : <em>void</em> |
| protected | <strong>resolveType(</strong><em>\string</em> <strong>$type=null</strong>)</strong> : <em>void</em> |

*This class implements \Countable*

<hr /><a id="class-gravframeworkflexflexindex"></a>
### Class: \Grav\Framework\Flex\FlexIndex

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$arguments</strong>)</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$entries=array()</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)/null/[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory=null</strong>)</strong> : <em>void</em><br /><em>Initializes a new FlexIndex.</em> |
| public | <strong>__debugInfo()</strong> : <em>void</em> |
| public | <strong>call(</strong><em>mixed</em> <strong>$method</strong>, <em>array</em> <strong>$arguments=array()</strong>)</strong> : <em>void</em> |
| public static | <strong>createFromArray(</strong><em>array</em> <strong>$entries</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>mixed</em> |
| public static | <strong>createFromStorage(</strong><em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>)</strong> : <em>\Grav\Framework\Flex\static</em> |
| public | <strong>filterBy(</strong><em>array</em> <strong>$filters</strong>)</strong> : <em>void</em> |
| public | <strong>getCache(</strong><em>\string</em> <strong>$namespace=null</strong>)</strong> : <em>[\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)</em> |
| public | <strong>getCacheChecksum()</strong> : <em>mixed</em> |
| public | <strong>getCacheKey()</strong> : <em>mixed</em> |
| public | <strong>getFlexDirectory()</strong> : <em>mixed</em> |
| public | <strong>getFlexKeys()</strong> : <em>mixed</em> |
| public | <strong>getFlexType()</strong> : <em>mixed</em> |
| public | <strong>getIndex()</strong> : <em>mixed</em> |
| public | <strong>getIndexMap(</strong><em>\string</em> <strong>$indexKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getKeyField()</strong> : <em>string</em> |
| public | <strong>getMetaData(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>array</em> |
| public | <strong>getStorageKeys()</strong> : <em>mixed</em> |
| public | <strong>getTimestamp()</strong> : <em>mixed</em> |
| public | <strong>getTimestamps()</strong> : <em>mixed</em> |
| public | <strike><strong>getType(</strong><em>bool</em> <strong>$prefix=false</strong>)</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use `->getFlexType()` instead.</em> |
| public static | <strong>loadEntriesFromStorage(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>)</strong> : <em>array</em> |
| public | <strong>orderBy(</strong><em>array</em> <strong>$orderings</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexIndex](#class-gravframeworkflexflexindex)/[\Grav\Framework\Flex\FlexCollection](#class-gravframeworkflexflexcollection)</em> |
| public | <strong>render(</strong><em>\string</em> <strong>$layout=null</strong>, <em>array</em> <strong>$context=array()</strong>)</strong> : <em>void</em> |
| public | <strong>search(</strong><em>\string</em> <strong>$search</strong>, <em>mixed</em> <strong>$properties=null</strong>, <em>array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| public | <strong>serialize()</strong> : <em>string</em> |
| public | <strong>sort(</strong><em>array</em> <strong>$orderings</strong>)</strong> : <em>void</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>withKeyField(</strong><em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>void</em> |
| protected | <strong>createFrom(</strong><em>array</em> <strong>$entries</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>\Grav\Framework\Flex\static</em> |
| protected | <strong>getElementMeta(</strong><em>[\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)Interface</em> <strong>$object</strong>)</strong> : <em>mixed</em> |
| protected static | <strong>getIndexFile(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>)</strong> : <em>mixed</em> |
| protected | <strong>getIndexKeys()</strong> : <em>mixed</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>isAllowedElement(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>bool</em> |
| protected | <strong>loadCollection(</strong><em>array/null/array</em> <strong>$entries=null</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| protected | <strong>loadElement(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Flex\ObjectInterface/null</em> |
| protected | <strong>loadElements(</strong><em>array/null/array</em> <strong>$entries=null</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface)[]</em> |
| protected static | <strong>loadEntriesFromIndex(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>)</strong> : <em>mixed</em> |
| protected static | <strong>onChanges(</strong><em>array</em> <strong>$entries</strong>, <em>array</em> <strong>$added</strong>, <em>array</em> <strong>$updated</strong>, <em>array</em> <strong>$removed</strong>)</strong> : <em>void</em> |
| protected static | <strong>onException(</strong><em>[\Exception](http://php.net/manual/en/class.exception.php)</em> <strong>$e</strong>)</strong> : <em>void</em> |
| protected | <strong>setIndexKeys(</strong><em>array</em> <strong>$indexKeys</strong>)</strong> : <em>void</em> |
| protected | <strong>setKeyField(</strong><em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>void</em> |
| protected static | <strong>updateIndexData(</strong><em>mixed</em> <strong>$entry</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| protected static | <strong>updateIndexFile(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>, <em>array</em> <strong>$index</strong>, <em>array</em> <strong>$entries</strong>)</strong> : <em>array Compiled list of entries</em> |

*This class extends [\Grav\Framework\Object\ObjectIndex](#class-gravframeworkobjectobjectindex-abstract)*

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, [\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Flex\Interfaces\FlexIndexInterface](#interface-gravframeworkflexinterfacesflexindexinterface)*

<hr /><a id="class-gravframeworkflexflexform"></a>
### Class: \Grav\Framework\Flex\FlexForm

> Class FlexForm

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$name</strong>, <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em> <strong>$object</strong>, <em>array/null/array</em> <strong>$form=null</strong>)</strong> : <em>void</em><br /><em>FlexForm constructor.</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>getAction()</strong> : <em>mixed</em> |
| public | <strong>getBlueprint()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em> |
| public | <strong>getButtons()</strong> : <em>mixed</em> |
| public | <strong>getData()</strong> : <em>\Grav\Framework\Flex\Data/[\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)Interface</em> |
| public | <strong>getDefaultValue(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>mixed</em> |
| public | <strong>getDefaultValues()</strong> : <em>array</em> |
| public | <strong>getError()</strong> : <em>mixed</em> |
| public | <strong>getErrors()</strong> : <em>mixed</em> |
| public | <strong>getFields()</strong> : <em>mixed</em> |
| public | <strong>getFileDeleteAjaxRoute(</strong><em>string</em> <strong>$field</strong>, <em>string</em> <strong>$filename</strong>)</strong> : <em>\Grav\Framework\Flex\Route/null</em> |
| public | <strong>getFileUploadAjaxRoute()</strong> : <em>\Grav\Framework\Flex\Route/null</em> |
| public | <strong>getFiles()</strong> : <em>array/\Grav\Framework\Flex\UploadedFileInterface[]</em> |
| public | <strong>getFlash()</strong> : <em>\Grav\Framework\Flex\FormFlash</em><br /><em>Get form flash object.</em> |
| public | <strong>getFlexType()</strong> : <em>string</em> |
| public | <strong>getFormName()</strong> : <em>mixed</em> |
| public | <strong>getId()</strong> : <em>mixed</em> |
| public | <strong>getMediaTaskRoute(</strong><em>array</em> <strong>$params=array()</strong>, <em>mixed</em> <strong>$extension=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getName()</strong> : <em>string</em> |
| public | <strong>getNonce()</strong> : <em>mixed</em> |
| public | <strong>getNonceAction()</strong> : <em>mixed</em> |
| public | <strong>getNonceName()</strong> : <em>mixed</em> |
| public | <strong>getObject()</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em> |
| public | <strong>getTask()</strong> : <em>mixed</em> |
| public | <strong>getTasks()</strong> : <em>mixed</em> |
| public | <strong>getUniqueId()</strong> : <em>mixed</em> |
| public | <strong>getValue(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Get a value from the form. Note: Used in form fields.</em> |
| public | <strong>handleRequest(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>)</strong> : <em>\Grav\Framework\Flex\FormInterface/\Grav\Framework\Flex\$this</em> |
| public | <strong>isSubmitted()</strong> : <em>bool</em> |
| public | <strong>isValid()</strong> : <em>bool</em> |
| public | <strong>render(</strong><em>\string</em> <strong>$layout=null</strong>, <em>array</em> <strong>$context=array()</strong>)</strong> : <em>void</em> |
| public | <strong>reset()</strong> : <em>void</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements \Serializable::serialize().</em> |
| public | <strong>setId(</strong><em>\string</em> <strong>$id</strong>)</strong> : <em>void</em> |
| public | <strong>setRequest(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>)</strong> : <em>\Grav\Framework\Flex\FormInterface/\Grav\Framework\Flex\$this</em> |
| public | <strong>setUniqueId(</strong><em>\string</em> <strong>$uniqueId</strong>)</strong> : <em>void</em> |
| public | <strong>submit(</strong><em>array</em> <strong>$data</strong>, <em>\Grav\Framework\Flex\UploadedFileInterface[]</em> <strong>$files=null</strong>)</strong> : <em>\Grav\Framework\Flex\FormInterface/\Grav\Framework\Flex\$this</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Implements \Serializable::unserialize().</em> |
| public | <strong>updateObject()</strong> : <em>void</em> |
| public | <strong>validate()</strong> : <em>void</em> |
| protected | <strong>decodeData(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Decode POST data</em> |
| protected | <strong>doSerialize()</strong> : <em>void</em> |
| protected | <strong>doSubmit(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$files</strong>)</strong> : <em>void</em> |
| protected | <strong>doTraitSerialize()</strong> : <em>array</em> |
| protected | <strong>doTraitUnserialize(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| protected | <strong>filterData(</strong><em>\ArrayAccess</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Filter validated data.</em> |
| protected | <strong>getTemplate(</strong><em>string</em> <strong>$layout</strong>)</strong> : <em>\Twig\TemplateWrapper</em> |
| protected | <strong>jsonDecode(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Recursively JSON decode POST data.</em> |
| protected | <strong>parseRequest(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>)</strong> : <em>array</em><br /><em>Parse PSR-7 ServerRequest into data and files.</em> |
| protected | <strong>setError(</strong><em>\string</em> <strong>$error</strong>)</strong> : <em>void</em><br /><em>Set a single error.</em> |
| protected | <strong>setErrors(</strong><em>array</em> <strong>$errors</strong>)</strong> : <em>void</em><br /><em>Set all errors.</em> |
| protected | <strong>setObject(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em> <strong>$object</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em><br /><em>Note: this method clones the object.</em> |
| protected | <strong>unsetFlash()</strong> : <em>void</em> |
| protected | <strong>validateData(</strong><em>\ArrayAccess</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Validate data and throw validation exceptions if validation fails.</em> |
| protected | <strong>validateUpload(</strong><em>\Psr\Http\Message\UploadedFileInterface</em> <strong>$file</strong>)</strong> : <em>void</em><br /><em>Validate uploaded file.</em> |
| protected | <strong>validateUploads(</strong><em>array</em> <strong>$files</strong>)</strong> : <em>void</em><br /><em>Validate all uploaded files.</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexFormInterface](#interface-gravframeworkflexinterfacesflexforminterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Form\Interfaces\FormInterface](#interface-gravframeworkforminterfacesforminterface), \Serializable*

<hr /><a id="class-gravframeworkflexflexcollection"></a>
### Class: \Grav\Framework\Flex\FlexCollection

> Class FlexCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$entries=array()</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory=null</strong>)</strong> : <em>void</em> |
| public | <strong>__debugInfo()</strong> : <em>void</em> |
| public static | <strong>createFromArray(</strong><em>array</em> <strong>$entries</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>filterBy(</strong><em>array</em> <strong>$filters</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em> |
| public | <strong>find(</strong><em>string</em> <strong>$value</strong>, <em>string</em> <strong>$field=`'id'`</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexObject](#class-gravframeworkflexflexobject)/null</em> |
| public | <strong>getCache(</strong><em>\string</em> <strong>$namespace=null</strong>)</strong> : <em>[\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)</em> |
| public | <strong>getCacheChecksum()</strong> : <em>mixed</em> |
| public | <strong>getCacheKey()</strong> : <em>mixed</em> |
| public static | <strong>getCachedMethods()</strong> : <em>array Returns a list of methods with their caching information.</em><br /><em>Get list of cached methods.</em> |
| public | <strong>getFlexDirectory()</strong> : <em>mixed</em> |
| public | <strong>getFlexKeys()</strong> : <em>mixed</em> |
| public | <strong>getFlexType()</strong> : <em>mixed</em> |
| public | <strong>getIndex()</strong> : <em>mixed</em> |
| public | <strong>getKeyField()</strong> : <em>string</em> |
| public | <strong>getMetaData(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>array</em> |
| public | <strong>getStorageKeys()</strong> : <em>mixed</em> |
| public | <strong>getTimestamp()</strong> : <em>mixed</em> |
| public | <strong>getTimestamps()</strong> : <em>mixed</em> |
| public | <strike><strong>getType(</strong><em>bool</em> <strong>$prefix=false</strong>)</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use `->getFlexType()` instead.</em> |
| public | <strong>isAuthorized(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>, <em>\Grav\Framework\Flex\UserInterface/null/[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user=null</strong>)</strong> : <em>\Grav\Framework\Flex\static</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em> |
| public | <strong>render(</strong><em>\string</em> <strong>$layout=null</strong>, <em>array</em> <strong>$context=array()</strong>)</strong> : <em>void</em> |
| public | <strong>search(</strong><em>\string</em> <strong>$search</strong>, <em>mixed</em> <strong>$properties=null</strong>, <em>array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| public | <strong>setFlexDirectory(</strong><em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$type</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>sort(</strong><em>array</em> <strong>$order</strong>)</strong> : <em>void</em> |
| public | <strong>withKeyField(</strong><em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>void</em> |
| protected | <strong>createFrom(</strong><em>array</em> <strong>$elements</strong>, <em>string/null</em> <strong>$keyField=null</strong>)</strong> : <em>\Grav\Framework\Flex\static</em><br /><em>Creates a new instance from the specified elements. This method is provided for derived classes to specify how a new instance should be created when constructor semantics have changed.</em> |
| protected | <strong>getRelatedDirectory(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> |
| protected | <strong>getTemplate(</strong><em>string</em> <strong>$layout</strong>)</strong> : <em>\Twig\TemplateWrapper</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>setKeyField(</strong><em>mixed</em> <strong>$keyField=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Object\ObjectCollection](#class-gravframeworkobjectobjectcollection)*

*This class implements [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), \Doctrine\Common\Collections\Selectable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, [\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface)*

<hr /><a id="class-gravframeworkflexflexobject"></a>
### Class: \Grav\Framework\Flex\FlexObject

> Class FlexObject

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements</strong>, <em>mixed</em> <strong>$key</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\bool</em> <strong>$validate=false</strong>)</strong> : <em>void</em> |
| public | <strong>__debugInfo()</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strike><strong>blueprints()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em></strike><br /><em>DEPRECATED - 1.6 Admin compatibility</em> |
| public | <strong>create(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public static | <strong>createFromStorage(</strong><em>array</em> <strong>$elements</strong>, <em>array</em> <strong>$storage</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\bool</em> <strong>$validate=false</strong>)</strong> : <em>mixed</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>delete()</strong> : <em>void</em> |
| public | <strong>exists()</strong> : <em>void</em> |
| public | <strong>getBlueprint(</strong><em>\string</em> <strong>$name=`''`</strong>)</strong> : <em>mixed</em> |
| public | <strong>getCache(</strong><em>\string</em> <strong>$namespace=null</strong>)</strong> : <em>[\Grav\Framework\Cache\CacheInterface](#interface-gravframeworkcachecacheinterface)</em> |
| public | <strong>getCacheChecksum()</strong> : <em>mixed</em> |
| public | <strong>getCacheKey()</strong> : <em>mixed</em> |
| public static | <strong>getCachedMethods()</strong> : <em>array</em> |
| public | <strong>getChanges()</strong> : <em>array</em><br /><em>Get any changes based on data sent to update</em> |
| public | <strong>getDefaultValue(</strong><em>\string</em> <strong>$name</strong>, <em>\string</em> <strong>$separator=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getDefaultValues()</strong> : <em>array</em> |
| public | <strong>getFlexDirectory()</strong> : <em>mixed</em> |
| public | <strong>getFlexKey()</strong> : <em>mixed</em> |
| public | <strong>getFlexType()</strong> : <em>mixed</em> |
| public | <strong>getForm(</strong><em>\string</em> <strong>$name=`''`</strong>, <em>array</em> <strong>$form=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getFormValue(</strong><em>\string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>\string</em> <strong>$separator=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getKey()</strong> : <em>mixed</em> |
| public | <strong>getMetaData()</strong> : <em>mixed</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>getStorageKey()</strong> : <em>mixed</em> |
| public | <strong>getTimestamp()</strong> : <em>mixed</em> |
| public | <strike><strong>getType(</strong><em>bool</em> <strong>$prefix=false</strong>)</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use `->getFlexType()` instead.</em> |
| public | <strong>hasKey()</strong> : <em>bool</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>isAuthorized(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>, <em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user=null</strong>)</strong> : <em>bool</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>prepareStorage()</strong> : <em>void</em> |
| public | <strong>render(</strong><em>\string</em> <strong>$layout=null</strong>, <em>array</em> <strong>$context=array()</strong>)</strong> : <em>void</em> |
| public | <strong>save()</strong> : <em>void</em> |
| public | <strong>search(</strong><em>\string</em> <strong>$search</strong>, <em>mixed</em> <strong>$properties=null</strong>, <em>array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| public | <strong>searchNestedProperty(</strong><em>\string</em> <strong>$property</strong>, <em>\string</em> <strong>$search</strong>, <em>array/null/array</em> <strong>$options=null</strong>)</strong> : <em>float</em> |
| public | <strong>searchProperty(</strong><em>\string</em> <strong>$property</strong>, <em>\string</em> <strong>$search</strong>, <em>array/null/array</em> <strong>$options=null</strong>)</strong> : <em>float</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setFlexDirectory(</strong><em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>)</strong> : <em>void</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>setStorageKey(</strong><em>string/null</em> <strong>$key=null</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>setTimestamp(</strong><em>int</em> <strong>$timestamp=null</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>triggerEvent(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>unserialize(</strong><em>string</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| public | <strong>update(</strong><em>array</em> <strong>$data</strong>, <em>array</em> <strong>$files=array()</strong>)</strong> : <em>void</em> |
| public | <strike><strong>value(</strong><em>string</em> <strong>$name</strong>, <em>mixed/null</em> <strong>$default=null</strong>, <em>string/null</em> <strong>$separator=null</strong>)</strong> : <em>mixed</em></strike><br /><em>DEPRECATED - 1.6 Use ->getFormValue() method instead.</em> |
| protected | <strong>createFormObject(</strong><em>\string</em> <strong>$name</strong>, <em>array/null/array</em> <strong>$form=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexFormInterface](#interface-gravframeworkflexinterfacesflexforminterface)</em><br /><em>This methods allows you to override form objects in child classes.</em> |
| protected | <strong>doGetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>bool</em> <strong>$doCreate=false</strong>)</strong> : <em>mixed Property value.</em> |
| protected | <strong>doHasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| protected | <strong>doSerialize()</strong> : <em>array</em> |
| protected | <strong>doSetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| protected | <strong>doUnserialize(</strong><em>array</em> <strong>$serialized</strong>)</strong> : <em>void</em> |
| protected | <strong>doUnsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| protected | <strong>filterElements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>void</em><br /><em>Filter data coming to constructor or $this->update() request. NOTE: The incoming data can be an arbitrary array so do not assume anything from its content.</em> |
| protected | <strong>getCollectionByProperty(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$property</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em> |
| protected | <strong>getElement(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>getElements()</strong> : <em>array</em> |
| protected | <strong>getRelatedDirectory(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> |
| protected | <strong>getStorage()</strong> : <em>array</em> |
| protected | <strong>getTemplate(</strong><em>string</em> <strong>$layout</strong>)</strong> : <em>\Twig\TemplateWrapper</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |
| protected | <strong>getarrayelement(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>getarrayelements()</strong> : <em>array</em> |
| protected | <strong>getarrayproperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>bool</em> <strong>$doCreate=false</strong>)</strong> : <em>mixed Property value.</em> |
| protected | <strong>getobjectelement(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/null</em> |
| protected | <strong>getobjectelements()</strong> : <em>array</em> |
| protected | <strong>getobjectproperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>bool/callable/bool</em> <strong>$doCreate=false</strong>)</strong> : <em>mixed Property value.</em> |
| protected | <strong>hasarrayproperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| protected | <strong>hasobjectproperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| protected | <strong>initObjectProperties()</strong> : <em>void</em> |
| protected | <strong>isAuthorizedAction(</strong><em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user</strong>, <em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>)</strong> : <em>bool</em> |
| protected | <strong>isAuthorizedSuperAdmin(</strong><em>[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user</strong>)</strong> : <em>bool</em> |
| protected | <strong>isPropertyLoaded(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool True if property has been loaded.</em> |
| protected | <strong>offsetLoad(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>offsetPrepare(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>offsetSerialize(</strong><em>string</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| protected | <strong>searchValue(</strong><em>\string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>, <em>\string</em> <strong>$search</strong>, <em>array/null/array</em> <strong>$options=null</strong>)</strong> : <em>float</em> |
| protected | <strong>setAuthorizeRule(</strong><em>\string</em> <strong>$authorize</strong>)</strong> : <em>void</em> |
| protected | <strong>setElements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>void</em> |
| protected | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Flex\$this</em> |
| protected | <strong>setStorage(</strong><em>array</em> <strong>$storage</strong>)</strong> : <em>void</em> |
| protected | <strong>setarrayproperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>setobjectproperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| protected | <strong>unsetarrayproperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>void</em> |
| protected | <strong>unsetobjectproperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface), \ArrayAccess, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \JsonSerializable, \Serializable, [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface](#interface-gravframeworkflexinterfacesflexauthorizeinterface)*

<hr /><a id="interface-gravframeworkflexinterfacesflexcollectioninterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexCollectionInterface

> Defines a collection of Flex Objects.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array/[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)[]</em> <strong>$entries=array()</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory=null</strong>)</strong> : <em>void</em><br /><em>Creates a new Flex Collection.</em> |
| public static | <strong>createFromArray(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)[]</em> <strong>$entries</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>static Returns a new Flex Collection.</em><br /><em>Creates a Flex Collection from an array.</em> |
| public | <strong>filterBy(</strong><em>array</em> <strong>$filters</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface)</em><br /><em>Filter collection by filter array with keys and values.</em> |
| public | <strong>getFlexKeys()</strong> : <em>string[] Returns[key => flex_key, ...] pairs.</em><br /><em>Get Flex keys from all the objects in the collection.</em> |
| public | <strong>getIndex()</strong> : <em>FlexIndexInterface Returns a Flex Index from the current collection.</em><br /><em>Get Flex Index from the Flex Collection.</em> |
| public | <strong>getStorageKeys()</strong> : <em>string[] Returns [key => storage_key, ...] pairs.</em><br /><em>Get storage keys from all the objects in the collection.</em> |
| public | <strong>getTimestamps()</strong> : <em>int[] Returns [key => timestamp, ...] pairs.</em><br /><em>Get timestamps from all the objects in the collection. This method can be used for example in caching.</em> |
| public | <strong>search(</strong><em>\string</em> <strong>$search</strong>, <em>string/string[]/null</em> <strong>$properties=null</strong>, <em>array/null/array</em> <strong>$options=null</strong>)</strong> : <em>FlexCollectionInterface Returns a Flex Collection with only matching objects.</em><br /><em>Search a string from the collection.</em> |
| public | <strong>sort(</strong><em>array</em> <strong>$orderings</strong>)</strong> : <em>FlexCollectionInterface Returns a sorted version from the collection.</em><br /><em>Sort the collection.</em> |
| public | <strong>withKeyField(</strong><em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>FlexCollectionInterface Returns a new Flex Collection with new key field.</em><br /><em>Return new collection with a different key.</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Doctrine\Common\Collections\Selectable, \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \JsonSerializable, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="interface-gravframeworkflexinterfacesflexauthorizeinterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface

> Defines authorization checks for Flex Objects.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>isAuthorized(</strong><em>\string</em> <strong>$action</strong>, <em>\string</em> <strong>$scope=null</strong>, <em>\Grav\Framework\Flex\Interfaces\UserInterface/null/[\Grav\Common\User\Interfaces\UserInterface](#interface-gravcommonuserinterfacesuserinterface)</em> <strong>$user=null</strong>)</strong> : <em>bool Returns `true` if user is authorized to perform action, `false` otherwise.</em><br /><em>Check if user is authorized to perform an action for the object.</em> |

<hr /><a id="interface-gravframeworkflexinterfacesflexforminterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexFormInterface

> Defines Forms for Flex Objects.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getFileDeleteAjaxRoute(</strong><em>string</em> <strong>$field</strong>, <em>string</em> <strong>$filename</strong>)</strong> : <em>\Grav\Framework\Flex\Interfaces\Route/null Returns Route object or null if file uploads are not enabled.</em><br /><em>Get route for deleting files by AJAX.</em> |
| public | <strong>getFileUploadAjaxRoute()</strong> : <em>\Grav\Framework\Flex\Interfaces\Route/null Returns Route object or null if file uploads are not enabled.</em><br /><em>Get route for uploading files by AJAX.</em> |
| public | <strong>getMediaTaskRoute()</strong> : <em>string Returns admin route for media tasks.</em><br /><em>Get media task route.</em> |
| public | <strong>getObject()</strong> : <em>FlexObjectInterface Returns Flex Object associated to the form.</em><br /><em>Get object associated to the form.</em> |

*This class implements \Serializable, [\Grav\Framework\Form\Interfaces\FormInterface](#interface-gravframeworkforminterfacesforminterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface)*

<hr /><a id="interface-gravframeworkflexinterfacesflexstorageinterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexStorageInterface

> Defines Flex Storage layer.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>StorageInterface constructor.</em> |
| public | <strong>createRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>array Returns created rows as `[key => row, ...] pairs.</em><br /><em>Create new rows into the storage. New keys will be assigned when the objects are created.</em> |
| public | <strong>deleteRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>array Returns deleted rows. Note that non-existing rows have `null` as their value.</em><br /><em>Delete rows from the storage.</em> |
| public | <strong>getExistingKeys()</strong> : <em>array Returns all existing keys as `[key => [storage_key => key, storage_timestamp => timestamp], ...]`.</em><br /><em>Returns associated array of all existing storage keys with a timestamp.</em> |
| public | <strong>getKeyField()</strong> : <em>string</em> |
| public | <strong>getMediaPath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>string Path in the filesystem. Can be URI.</em><br /><em>Get filesystem path for the collection or object media.</em> |
| public | <strong>getStoragePath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>string Path in the filesystem. Can be URI.</em><br /><em>Get filesystem path for the collection or object storage.</em> |
| public | <strong>hasKey(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool Returns `true` if the key exists in the storage, `false` otherwise.</em><br /><em>Check if the key exists in the storage.</em> |
| public | <strong>hasKeys(</strong><em>string[]</em> <strong>$keys</strong>)</strong> : <em>bool[] Returns keys with `true` if the key exists in the storage, `false` otherwise.</em><br /><em>Check if the key exists in the storage.</em> |
| public | <strong>readRows(</strong><em>array</em> <strong>$rows</strong>, <em>array</em> <strong>$fetched=null</strong>)</strong> : <em>array Returns rows. Note that non-existing rows will have `null` as their value.</em><br /><em>Read rows from the storage. If you pass object or array as value, that value will be used to save I/O.</em> |
| public | <strong>renameRow(</strong><em>\string</em> <strong>$src</strong>, <em>\string</em> <strong>$dst</strong>)</strong> : <em>bool</em> |
| public | <strong>replaceRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>array Returns both created and updated rows.</em><br /><em>Replace rows regardless if they exist or not. All rows should have a specified key for replace to work properly.</em> |
| public | <strong>updateRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>array Returns updated rows. Note that non-existing rows will not be saved and have `null` as their value.</em><br /><em>Update existing rows in the storage.</em> |

<hr /><a id="interface-gravframeworkflexinterfacesflexobjectinterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexObjectInterface

> Defines Flex Objects.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements</strong>, <em>string</em> <strong>$key</strong>, <em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>, <em>\bool</em> <strong>$validate=false</strong>)</strong> : <em>void</em><br /><em>Construct a new Flex Object instance.</em> |
| public | <strong>create(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em><br /><em>Create new object into the storage.</em> |
| public | <strong>delete()</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em><br /><em>Delete object from the storage.</em> |
| public | <strong>exists()</strong> : <em>bool Returns `true` if the object exists, `false` otherwise.</em><br /><em>Returns true if the object exists in the storage.</em> |
| public | <strong>getBlueprint(</strong><em>\string</em> <strong>$name=`''`</strong>)</strong> : <em>Blueprint Returns a Blueprint.</em><br /><em>Returns the blueprint of the object.</em> |
| public | <strong>getDefaultValue(</strong><em>\string</em> <strong>$name</strong>, <em>\string</em> <strong>$separator=null</strong>)</strong> : <em>mixed/null Returns default value of the field, null if there is no default value.</em><br /><em>Returns default value suitable to be used in a form for the given property.</em> |
| public | <strong>getDefaultValues()</strong> : <em>array Returns default values.</em><br /><em>Returns default values suitable to be used in a form for the given property.</em> |
| public | <strong>getFlexKey()</strong> : <em>string Returns Flex Key of the object.</em><br /><em>Get a unique key for the object. Flex Keys can be used without knowing the Directory the Object belongs into.</em> |
| public | <strong>getForm(</strong><em>\string</em> <strong>$name=`''`</strong>, <em>array/null/array</em> <strong>$form=null</strong>)</strong> : <em>FlexFormInterface Returns a Form.</em><br /><em>Returns a form instance for the object.</em> |
| public | <strong>getFormValue(</strong><em>\string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>\string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Returns value of the field.</em><br /><em>Returns raw value suitable to be used in a form for the given property.</em> |
| public | <strong>getMetaData()</strong> : <em>array Returns metadata of the object.</em><br /><em>Get index data associated to the object.</em> |
| public | <strong>getStorageKey()</strong> : <em>string Returns storage key of the Object.</em><br /><em>Get an unique storage key (within the directory) which is used for figuring out the filename or database id.</em> |
| public | <strong>prepareStorage()</strong> : <em>array Returns an array of object properties containing only scalars and arrays.</em><br /><em>Prepare object for saving into the storage.</em> |
| public | <strong>save()</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em><br /><em>Save object into the storage.</em> |
| public | <strong>search(</strong><em>\string</em> <strong>$search</strong>, <em>string/string[]/null</em> <strong>$properties=null</strong>, <em>array/null/array</em> <strong>$options=null</strong>)</strong> : <em>float Returns a weight between and 1.</em><br /><em>Search a string from the object, returns weight between 0 and 1. Note: If you override this function, make sure you return value in range 0...1!</em> |
| public | <strong>update(</strong><em>array</em> <strong>$data</strong>, <em>array/array/\Grav\Framework\Flex\Interfaces\UploadedFileInterface[]</em> <strong>$files=array()</strong>)</strong> : <em>[\Grav\Framework\Flex\Interfaces\FlexObjectInterface](#interface-gravframeworkflexinterfacesflexobjectinterface)</em><br /><em>Updates object in the memory.</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), \Serializable, \JsonSerializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \ArrayAccess*

<hr /><a id="interface-gravframeworkflexinterfacesflexcommoninterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexCommonInterface

> Defines common interface shared with both Flex Objects and Collections.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getCacheChecksum()</strong> : <em>string Returns cache checksum.</em><br /><em>Get cache checksum for the object / collection. If checksum changes, cache gets invalided.</em> |
| public | <strong>getCacheKey()</strong> : <em>string Returns cache key.</em><br /><em>Get a cache key which is used for caching the object / collection.</em> |
| public | <strong>getFlexDirectory()</strong> : <em>FlexDirectory Returns associated Flex Directory.</em><br /><em>Get Flex Directory for the object / collection.</em> |
| public | <strong>getFlexType()</strong> : <em>string Returns Flex Type of the collection.</em><br /><em>Get Flex Type of the object / collection.</em> |
| public | <strong>getTimestamp()</strong> : <em>int Returns Unix timestamp.</em><br /><em>Get last updated timestamp for the object / collection.</em> |

*This class implements [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface)*

<hr /><a id="interface-gravframeworkflexinterfacesflexindexinterface"></a>
### Interface: \Grav\Framework\Flex\Interfaces\FlexIndexInterface

> Defines Indexes for Flex Objects. Flex indexes are similar to database indexes, they contain indexed fields which can be used to quickly look up or find the objects without loading them.

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>createFromStorage(</strong><em>[\Grav\Framework\Flex\FlexDirectory](#class-gravframeworkflexflexdirectory)</em> <strong>$directory</strong>)</strong> : <em>static Returns a new Flex Index.</em><br /><em>Helper method to create Flex Index.</em> |
| public | <strong>getIndexMap(</strong><em>\string</em> <strong>$indexKey=null</strong>)</strong> : <em>array</em> |
| public static | <strong>loadEntriesFromStorage(</strong><em>[\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)</em> <strong>$storage</strong>)</strong> : <em>array Returns a list of existing objects [storage_key => [storage_key => xxx, storage_timestamp => 123456, ...]]</em><br /><em>Method to load index from the object storage, usually filesystem.</em> |
| public | <strong>withKeyField(</strong><em>\string</em> <strong>$keyField=null</strong>)</strong> : <em>FlexIndexInterface Returns a new Flex Collection with new key field.</em><br /><em>Return new collection with a different key.</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexCollectionInterface](#interface-gravframeworkflexinterfacesflexcollectioninterface), [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface), [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), [\Grav\Framework\Flex\Interfaces\FlexCommonInterface](#interface-gravframeworkflexinterfacesflexcommoninterface)*

<hr /><a id="class-gravframeworkflexstoragesimplestorage"></a>
### Class: \Grav\Framework\Flex\Storage\SimpleStorage

> Class SimpleStorage

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em> |
| public | <strong>createRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>mixed</em> |
| public | <strong>deleteRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>void</em> |
| public | <strong>getExistingKeys()</strong> : <em>mixed</em> |
| public | <strong>getMediaPath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getStoragePath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>hasKey(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>readRows(</strong><em>array</em> <strong>$rows</strong>, <em>mixed</em> <strong>$fetched=null</strong>)</strong> : <em>void</em> |
| public | <strong>renameRow(</strong><em>\string</em> <strong>$src</strong>, <em>\string</em> <strong>$dst</strong>)</strong> : <em>void</em> |
| public | <strong>replaceRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>void</em> |
| public | <strong>updateRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>void</em> |
| protected | <strong>buildIndex()</strong> : <em>array</em><br /><em>Returns list of all stored keys in [key => timestamp] pairs.</em> |
| protected | <strong>getKeyFromPath(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Get key from the filesystem path.</em> |
| protected | <strong>getNewKey()</strong> : <em>string</em> |
| protected | <strong>save()</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Flex\Storage\AbstractFilesystemStorage](#class-gravframeworkflexstorageabstractfilesystemstorage-abstract)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)*

<hr /><a id="class-gravframeworkflexstoragefolderstorage"></a>
### Class: \Grav\Framework\Flex\Storage\FolderStorage

> Class FolderStorage

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em> |
| public | <strong>createRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>mixed</em> |
| public | <strong>deleteRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>void</em> |
| public | <strong>getExistingKeys()</strong> : <em>mixed</em> |
| public | <strong>getMediaPath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPathFromKey(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>string</em><br /><em>Get filesystem path from the key.</em> |
| public | <strong>getStoragePath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>hasKey(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>readRows(</strong><em>array</em> <strong>$rows</strong>, <em>mixed</em> <strong>$fetched=null</strong>)</strong> : <em>void</em> |
| public | <strong>renameRow(</strong><em>\string</em> <strong>$src</strong>, <em>\string</em> <strong>$dst</strong>)</strong> : <em>void</em> |
| public | <strong>replaceRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>void</em> |
| public | <strong>updateRows(</strong><em>array</em> <strong>$rows</strong>)</strong> : <em>void</em> |
| protected | <strong>buildIndex()</strong> : <em>array</em><br /><em>Returns list of all stored keys in [key => timestamp] pairs.</em> |
| protected | <strong>buildIndexFromFilesystem(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| protected | <strong>buildPrefixedIndexFromFilesystem(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| protected | <strong>deleteFile(</strong><em>\RocketTheme\Toolbox\File\File</em> <strong>$file</strong>)</strong> : <em>array/string</em> |
| protected | <strong>deleteFolder(</strong><em>\string</em> <strong>$path</strong>, <em>\bool</em> <strong>$include_target=false</strong>)</strong> : <em>bool</em> |
| protected | <strong>getKeyFromPath(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>string</em><br /><em>Get key from the filesystem path.</em> |
| protected | <strong>getNewKey()</strong> : <em>string</em> |
| protected | <strong>initOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em> |
| protected | <strong>loadFile(</strong><em>\RocketTheme\Toolbox\File\File</em> <strong>$file</strong>)</strong> : <em>array/null</em> |
| protected | <strong>moveFolder(</strong><em>\string</em> <strong>$src</strong>, <em>\string</em> <strong>$dst</strong>)</strong> : <em>bool</em> |
| protected | <strong>saveFile(</strong><em>\RocketTheme\Toolbox\File\File</em> <strong>$file</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>array</em> |

*This class extends [\Grav\Framework\Flex\Storage\AbstractFilesystemStorage](#class-gravframeworkflexstorageabstractfilesystemstorage-abstract)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)*

<hr /><a id="class-gravframeworkflexstoragefilestorage"></a>
### Class: \Grav\Framework\Flex\Storage\FileStorage

> Class FileStorage

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em> |
| public | <strong>getMediaPath(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| protected | <strong>buildIndex()</strong> : <em>void</em> |
| protected | <strong>getKeyFromPath(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>mixed</em> |

*This class extends [\Grav\Framework\Flex\Storage\FolderStorage](#class-gravframeworkflexstoragefolderstorage)*

*This class implements [\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)*

<hr /><a id="class-gravframeworkflexstorageabstractfilesystemstorage-abstract"></a>
### Class: \Grav\Framework\Flex\Storage\AbstractFilesystemStorage (abstract)

> Class AbstractFilesystemStorage

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getKeyField()</strong> : <em>string</em> |
| public | <strong>hasKeys(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>bool</em> |
| protected | <strong>detectDataFormatter(</strong><em>\string</em> <strong>$filename</strong>)</strong> : <em>null/string</em> |
| protected | <strong>generateKey()</strong> : <em>string</em><br /><em>Generates a random, unique key for the row.</em> |
| protected | <strong>getFile(</strong><em>\string</em> <strong>$filename</strong>)</strong> : <em>\RocketTheme\Toolbox\File\File</em> |
| protected | <strong>initDataFormatter(</strong><em>mixed</em> <strong>$formatter</strong>)</strong> : <em>void</em> |
| protected | <strong>resolvePath(</strong><em>\string</em> <strong>$path</strong>)</strong> : <em>string</em> |
| protected | <strong>validateKey(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Checks if a key is valid.</em> |

*This class implements [\Grav\Framework\Flex\Interfaces\FlexStorageInterface](#interface-gravframeworkflexinterfacesflexstorageinterface)*

<hr /><a id="class-gravframeworkformformflash"></a>
### Class: \Grav\Framework\Form\FormFlash

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$sessionId</strong>, <em>\string</em> <strong>$uniqueId</strong>, <em>\string</em> <strong>$formName=null</strong>)</strong> : <em>void</em><br /><em>FormFlashObject constructor.</em> |
| public | <strong>addFile(</strong><em>\string</em> <strong>$filename</strong>, <em>\string</em> <strong>$field</strong>, <em>array</em> <strong>$crop=null</strong>)</strong> : <em>bool</em><br /><em>Add existing file to the form flash.</em> |
| public | <strong>addUploadedFile(</strong><em>\Psr\Http\Message\UploadedFileInterface</em> <strong>$upload</strong>, <em>\string</em> <strong>$field=null</strong>, <em>array/null/array</em> <strong>$crop=null</strong>)</strong> : <em>string Return name of the file</em><br /><em>Add uploaded file to the form flash.</em> |
| public | <strong>clearFiles()</strong> : <em>void</em><br /><em>Clear form flash from all uploaded files.</em> |
| public | <strong>delete()</strong> : <em>void</em> |
| public | <strong>exists()</strong> : <em>bool</em> |
| public | <strong>getData()</strong> : <em>mixed</em> |
| public | <strong>getFilesByField(</strong><em>\string</em> <strong>$field</strong>)</strong> : <em>array</em> |
| public | <strong>getFilesByFields(</strong><em>bool</em> <strong>$includeOriginal=false</strong>)</strong> : <em>array</em> |
| public | <strong>getFormName()</strong> : <em>string</em> |
| public static | <strong>getSessionTmpDir(</strong><em>\string</em> <strong>$sessionId</strong>)</strong> : <em>string</em> |
| public | <strong>getTmpDir()</strong> : <em>string</em> |
| public | <strong>getUniqieId()</strong> : <em>string</em> |
| public | <strong>getUrl()</strong> : <em>string</em> |
| public | <strong>getUserEmail()</strong> : <em>string</em> |
| public | <strong>getUsername()</strong> : <em>string</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em> |
| public | <strong>removeFile(</strong><em>\string</em> <strong>$name</strong>, <em>\string</em> <strong>$field=null</strong>)</strong> : <em>bool</em><br /><em>Remove any file from form flash.</em> |
| public | <strong>save()</strong> : <em>\Grav\Framework\Form\$this</em> |
| public | <strong>setData(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>setUrl(</strong><em>\string</em> <strong>$url</strong>)</strong> : <em>\Grav\Framework\Form\$this</em> |
| public | <strong>setUserEmail(</strong><em>\string</em> <strong>$email=null</strong>)</strong> : <em>\Grav\Framework\Form\$this</em> |
| public | <strong>setUserName(</strong><em>\string</em> <strong>$username=null</strong>)</strong> : <em>\Grav\Framework\Form\$this</em> |
| protected | <strong>addFileInternal(</strong><em>\string</em> <strong>$field</strong>, <em>\string</em> <strong>$name</strong>, <em>array</em> <strong>$data</strong>, <em>array/null/array</em> <strong>$crop=null</strong>)</strong> : <em>void</em> |
| protected | <strong>getTmpIndex()</strong> : <em>\RocketTheme\Toolbox\File\YamlFile</em> |
| protected | <strong>removeTmpDir()</strong> : <em>void</em> |
| protected | <strong>removeTmpFile(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>void</em> |

*This class implements \JsonSerializable*

<hr /><a id="class-gravframeworkformformflashfile"></a>
### Class: \Grav\Framework\Form\FormFlashFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$field</strong>, <em>array</em> <strong>$upload</strong>, <em>[\Grav\Framework\Form\FormFlash](#class-gravframeworkformformflash)</em> <strong>$flash</strong>)</strong> : <em>void</em> |
| public | <strong>__debugInfo()</strong> : <em>void</em> |
| public | <strong>getClientFilename()</strong> : <em>mixed</em> |
| public | <strong>getClientMediaType()</strong> : <em>mixed</em> |
| public | <strong>getDestination()</strong> : <em>mixed</em> |
| public | <strong>getError()</strong> : <em>mixed</em> |
| public | <strong>getMetaData()</strong> : <em>mixed</em> |
| public | <strong>getSize()</strong> : <em>mixed</em> |
| public | <strong>getStream()</strong> : <em>\Psr\Http\Message\StreamInterface</em> |
| public | <strong>getTmpFile()</strong> : <em>mixed</em> |
| public | <strong>isMoved()</strong> : <em>bool</em> |
| public | <strong>jsonSerialize()</strong> : <em>void</em> |
| public | <strong>moveTo(</strong><em>mixed</em> <strong>$targetPath</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\UploadedFileInterface, \JsonSerializable*

<hr /><a id="interface-gravframeworkforminterfacesformfactoryinterface"></a>
### Interface: \Grav\Framework\Form\Interfaces\FormFactoryInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strike><strong>createPageForm(</strong><em>[\Grav\Common\Page\Page](#class-gravcommonpagepage)</em> <strong>$page</strong>, <em>\string</em> <strong>$name</strong>, <em>array</em> <strong>$form</strong>)</strong> : <em>[\Grav\Framework\Form\Interfaces\FormInterface](#interface-gravframeworkforminterfacesforminterface)/null</em></strike><br /><em>DEPRECATED - 1.6 Use FormFactory::createFormByPage() instead.</em> |

<hr /><a id="interface-gravframeworkforminterfacesforminterface"></a>
### Interface: \Grav\Framework\Form\Interfaces\FormInterface

> Interface FormInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getAction()</strong> : <em>string</em><br /><em>Get form action (URL). If action is empty, it points to the current page.</em> |
| public | <strong>getBlueprint()</strong> : <em>[\Grav\Common\Data\Blueprint](#class-gravcommondatablueprint)</em><br /><em>Get blueprint used in the form.</em> |
| public | <strong>getData()</strong> : <em>\Grav\Framework\Form\Interfaces\Data/object</em><br /><em>Get current data passed to the form.</em> |
| public | <strong>getError()</strong> : <em>string</em> |
| public | <strong>getErrors()</strong> : <em>array</em> |
| public | <strong>getFields()</strong> : <em>array</em><br /><em>Get form fields as an array. Note: Used in form fields.</em> |
| public | <strong>getFiles()</strong> : <em>array/\Grav\Framework\Form\Interfaces\UploadedFileInterface[]</em><br /><em>Get files which were passed to the form.</em> |
| public | <strong>getFormName()</strong> : <em>string</em><br /><em>Get form name.</em> |
| public | <strong>getId()</strong> : <em>string</em><br /><em>Get HTML id="..." attribute.</em> |
| public | <strong>getName()</strong> : <em>string</em> |
| public | <strong>getNonce()</strong> : <em>string</em><br /><em>Get the nonce value for a form</em> |
| public | <strong>getNonceAction()</strong> : <em>string</em><br /><em>Get nonce action.</em> |
| public | <strong>getNonceName()</strong> : <em>string</em><br /><em>Get nonce name.</em> |
| public | <strong>getTask()</strong> : <em>string</em><br /><em>Get task for the form if set in blueprints.</em> |
| public | <strong>getUniqueId()</strong> : <em>string</em><br /><em>Get unique id for the current form instance. By default regenerated on every page reload. This id is used to load the saved form state, if available.</em> |
| public | <strong>getValue(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Get a value from the form. Note: Used in form fields.</em> |
| public | <strong>handleRequest(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>)</strong> : <em>\Grav\Framework\Form\Interfaces\$this</em> |
| public | <strong>isSubmitted()</strong> : <em>bool</em> |
| public | <strong>isValid()</strong> : <em>bool</em> |
| public | <strong>reset()</strong> : <em>void</em><br /><em>Reset form.</em> |
| public | <strong>setId(</strong><em>\string</em> <strong>$id</strong>)</strong> : <em>void</em><br /><em>Sets HTML id="" attribute.</em> |
| public | <strong>setUniqueId(</strong><em>\string</em> <strong>$uniqueId</strong>)</strong> : <em>void</em><br /><em>Sets unique form id.</em> |
| public | <strong>submit(</strong><em>array</em> <strong>$data</strong>, <em>\Grav\Framework\Form\Interfaces\UploadedFileInterface[]</em> <strong>$files=null</strong>)</strong> : <em>\Grav\Framework\Form\Interfaces\$this</em> |

*This class implements [\Grav\Framework\Interfaces\RenderInterface](#interface-gravframeworkinterfacesrenderinterface), \Serializable*

<hr /><a id="interface-gravframeworkinterfacesrenderinterface"></a>
### Interface: \Grav\Framework\Interfaces\RenderInterface

> Defines common interface to render any object.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>render(</strong><em>\string</em> <strong>$layout=null</strong>, <em>array/array/null/array</em> <strong>$context=array()</strong>)</strong> : <em>\Grav\Framework\Interfaces\ContentBlockInterface/HtmlBlock Returns `HtmlBlock` containing the rendered output.</em><br /><em>Renders the object.</em> |
###### Examples of RenderInterface::render()
```
$block = $object->render('custom', ['variable' => 'value']);{% render object layout 'custom' with { variable: 'value' } %}
```

<hr /><a id="interface-gravframeworkmediainterfacesmediaobjectinterface"></a>
### Interface: \Grav\Framework\Media\Interfaces\MediaObjectInterface

> Class implements media object interface.

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="interface-gravframeworkmediainterfacesmediamanipulationinterface"></a>
### Interface: \Grav\Framework\Media\Interfaces\MediaManipulationInterface

> Interface MediaManipulationInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>deleteMediaFile(</strong><em>\string</em> <strong>$filename</strong>)</strong> : <em>void</em> |
| public | <strong>uploadMediaFile(</strong><em>\Psr\Http\Message\UploadedFileInterface</em> <strong>$uploadedFile</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Common\Media\Interfaces\MediaInterface](#interface-gravcommonmediainterfacesmediainterface), [\Grav\Framework\Media\Interfaces\MediaInterface](#interface-gravframeworkmediainterfacesmediainterface)*

<hr /><a id="interface-gravframeworkmediainterfacesmediainterface"></a>
### Interface: \Grav\Framework\Media\Interfaces\MediaInterface

> Class implements media interface.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getMedia()</strong> : <em>MediaCollectionInterface Collection of associated media.</em><br /><em>Gets the associated media collection.</em> |
| public | <strong>getMediaFolder()</strong> : <em>string/null Media path or null if the object doesn't have media folder.</em><br /><em>Get filesystem path to the associated media.</em> |
| public | <strong>getMediaOrder()</strong> : <em>array Empty array means default ordering.</em><br /><em>Get display order for the associated media.</em> |

<hr /><a id="interface-gravframeworkmediainterfacesmediacollectioninterface"></a>
### Interface: \Grav\Framework\Media\Interfaces\MediaCollectionInterface

> Class implements media collection interface.

| Visibility | Function |
|:-----------|:---------|

*This class implements \ArrayAccess, \Countable, \Iterator, \Traversable*

<hr /><a id="class-gravframeworkobjectpropertyobject"></a>
### Class: \Grav\Framework\Object\PropertyObject

> Property Objects keep their data in protected object properties.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>hasKey()</strong> : <em>bool</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
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

> Class contains a collection of objects.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>call(</strong><em>string</em> <strong>$method</strong>, <em>array</em> <strong>$arguments=array()</strong>)</strong> : <em>mixed[] Return values.</em> |
| public | <strong>collectionGroup(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\static[]</em><br /><em>Group items in the collection by a field and return them as associated array of collections.</em> |
| public | <strong>copy()</strong> : <em>\Grav\Framework\Object\static</em><br /><em>Create a copy from this collection by cloning all objects in the collection.</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>doDefProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>doGetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed[] Key/Value pairs of the properties.</em> |
| public | <strong>doHasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool[] Key/Value pairs of the properties.</em> |
| public | <strong>doSetProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>doUnsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array Key/Value pairs of the properties.</em> |
| public | <strong>getObjectKeys()</strong> : <em>array</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>group(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array</em><br /><em>Group items in the collection by a field.</em> |
| public | <strong>hasKey()</strong> : <em>bool</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>array Key/Value pairs of the properties.</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>limit(</strong><em>int</em> <strong>$start</strong>, <em>int/null</em> <strong>$limit=null</strong>)</strong> : <em>\Grav\Framework\Object\static</em> |
| public | <strong>matching(</strong><em>\Doctrine\Common\Collections\Criteria</em> <strong>$criteria</strong>)</strong> : <em>void</em> |
| public | <strong>orderBy(</strong><em>array</em> <strong>$ordering</strong>)</strong> : <em>\Grav\Framework\Object\Collection/\Grav\Framework\Object\static</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
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

> Array Objects keep the data in private array property.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>hasKey()</strong> : <em>bool</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
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

<hr /><a id="class-gravframeworkobjectobjectindex-abstract"></a>
### Class: \Grav\Framework\Object\ObjectIndex (abstract)

> Keeps index of objects instead of collection of objects. This class allows you to keep a list of objects and load them on demand. The class can be used seemingly instead of ObjectCollection when the objects haven't been loaded yet. This is an abstract class and has some protected abstract methods to load objects which you need to implement in order to use the class.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>abstract __call(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$arguments</strong>)</strong> : <em>void</em> |
| public | <strong>call(</strong><em>mixed</em> <strong>$method</strong>, <em>array</em> <strong>$arguments=array()</strong>)</strong> : <em>void</em> |
| public | <strong>collectionGroup(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)[]</em><br /><em>Group items in the collection by a field and return them as associated array of collections.</em> |
| public | <strong>copy()</strong> : <em>\Grav\Framework\Object\static</em><br /><em>Create a copy from this collection by cloning all objects in the collection.</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getObjectKeys()</strong> : <em>array</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>array Property values.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>group(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>array</em><br /><em>Group items in the collection by a field and return them as associated array.</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>array True if property has been defined (can be null).</em> |
| public | <strong>matching(</strong><em>\Doctrine\Common\Collections\Criteria</em> <strong>$criteria</strong>)</strong> : <em>void</em> |
| public | <strong>orderBy(</strong><em>array</em> <strong>$ordering</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$separator=null</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| protected | <strong>getTypePrefix()</strong> : <em>string</em> |

*This class extends [\Grav\Framework\Collection\AbstractIndexCollection](#class-gravframeworkcollectionabstractindexcollection-abstract)*

*This class implements \Doctrine\Common\Collections\Collection, \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \JsonSerializable, [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), [\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface), \Serializable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\NestedObjectInterface](#interface-gravframeworkobjectinterfacesnestedobjectinterface)*

<hr /><a id="class-gravframeworkobjectlazyobject"></a>
### Class: \Grav\Framework\Object\LazyObject

> Lazy Objects keep their data in both protected object properties and falls back to a stored array if property does not exist or is not initialized.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$elements=array()</strong>, <em>string</em> <strong>$key=null</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>__isset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Checks whether or not an offset exists.</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Returns a string representation of this object.</em> |
| public | <strong>__unset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Magic method to unset the attribute</em> |
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>mixed Property value.</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>getType(</strong><em>bool</em> <strong>$prefix=true</strong>)</strong> : <em>string</em> |
| public | <strong>hasKey()</strong> : <em>bool</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>bool True if property has been defined (can be null).</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em><br /><em>Implements JsonSerializable interface.</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>bool Returns TRUE on success or FALSE on failure.</em><br /><em>Whether or not an offset exists.</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>mixed Can return all value types.</em><br /><em>Returns the value at specified offset.</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Assigns a value to the specified offset.</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Unsets an offset.</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>Implements Serializable interface.</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string</em> <strong>$value</strong>, <em>string</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\$this</em> |
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

> Common Interface for both Objects and Collections

| Visibility | Function |
|:-----------|:---------|
| public | <strong>defNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>, <em>string/null</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>getNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>, <em>string/null</em> <strong>$separator=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>hasNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string/null</em> <strong>$separator=null</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>setNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>, <em>string/null</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>unsetNestedProperty(</strong><em>string</em> <strong>$property</strong>, <em>string/null</em> <strong>$separator=null</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |

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
| public | <strong>group(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>array</em><br /><em>Group items in the collection by a field and return them as associated array.</em> |
| public | <strong>limit(</strong><em>int</em> <strong>$start</strong>, <em>int/null</em> <strong>$limit=null</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>orderBy(</strong><em>array</em> <strong>$ordering</strong>)</strong> : <em>[\Grav\Framework\Object\Interfaces\ObjectCollectionInterface](#interface-gravframeworkobjectinterfacesobjectcollectioninterface)</em> |
| public | <strong>setKey(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |

*This class implements [\Grav\Framework\Collection\CollectionInterface](#interface-gravframeworkcollectioncollectioninterface), \JsonSerializable, \Countable, \IteratorAggregate, \Traversable, \ArrayAccess, \Doctrine\Common\Collections\Collection, \Doctrine\Common\Collections\Selectable, [\Grav\Framework\Object\Interfaces\ObjectInterface](#interface-gravframeworkobjectinterfacesobjectinterface), \Serializable*

<hr /><a id="interface-gravframeworkobjectinterfacesobjectinterface"></a>
### Interface: \Grav\Framework\Object\Interfaces\ObjectInterface

> Object Interface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>defProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$default</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>getKey()</strong> : <em>string</em> |
| public | <strong>getProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed/mixed[] Property value.</em> |
| public | <strong>getType()</strong> : <em>string</em> |
| public | <strong>hasProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>bool/bool[] True if property has been defined (can be null).</em> |
| public | <strong>setProperty(</strong><em>string</em> <strong>$property</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |
| public | <strong>unsetProperty(</strong><em>string</em> <strong>$property</strong>)</strong> : <em>\Grav\Framework\Object\Interfaces\$this</em> |

*This class implements \Serializable, \JsonSerializable*

<hr /><a id="class-gravframeworkpaginationpaginationpage"></a>
### Class: \Grav\Framework\Pagination\PaginationPage

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options=array()</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Pagination\AbstractPaginationPage](#class-gravframeworkpaginationabstractpaginationpage-abstract)*

*This class implements [\Grav\Framework\Pagination\Interfaces\PaginationPageInterface](#interface-gravframeworkpaginationinterfacespaginationpageinterface)*

<hr /><a id="class-gravframeworkpaginationpagination"></a>
### Class: \Grav\Framework\Pagination\Pagination

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> <strong>$route</strong>, <em>\int</em> <strong>$total</strong>, <em>\int</em> <strong>$pos=null</strong>, <em>\int</em> <strong>$limit=null</strong>, <em>array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |

*This class extends [\Grav\Framework\Pagination\AbstractPagination](#class-gravframeworkpaginationabstractpagination)*

*This class implements \Countable, \IteratorAggregate, \Traversable, [\Grav\Framework\Pagination\Interfaces\PaginationInterface](#interface-gravframeworkpaginationinterfacespaginationinterface)*

<hr /><a id="class-gravframeworkpaginationabstractpaginationpage-abstract"></a>
### Class: \Grav\Framework\Pagination\AbstractPaginationPage (abstract)

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getLabel()</strong> : <em>mixed</em> |
| public | <strong>getNumber()</strong> : <em>mixed</em> |
| public | <strong>getOptions()</strong> : <em>mixed</em> |
| public | <strong>getUrl()</strong> : <em>mixed</em> |
| public | <strong>isActive()</strong> : <em>bool</em> |
| public | <strong>isEnabled()</strong> : <em>bool</em> |
| protected | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em> |

*This class implements [\Grav\Framework\Pagination\Interfaces\PaginationPageInterface](#interface-gravframeworkpaginationinterfacespaginationpageinterface)*

<hr /><a id="class-gravframeworkpaginationabstractpagination"></a>
### Class: \Grav\Framework\Pagination\AbstractPagination

| Visibility | Function |
|:-----------|:---------|
| public | <strong>count()</strong> : <em>void</em> |
| public | <strong>getFirstPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count</strong>)</strong> : <em>mixed</em> |
| public | <strong>getIterator()</strong> : <em>mixed</em> |
| public | <strong>getLastPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count</strong>)</strong> : <em>mixed</em> |
| public | <strong>getLimit()</strong> : <em>mixed</em> |
| public | <strong>getNextNumber(</strong><em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getNextPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getOptions()</strong> : <em>mixed</em> |
| public | <strong>getPage(</strong><em>\int</em> <strong>$page</strong>, <em>\string</em> <strong>$label=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPageNumber()</strong> : <em>mixed</em> |
| public | <strong>getPages()</strong> : <em>mixed</em> |
| public | <strong>getPrevNumber(</strong><em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPrevPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getRoute()</strong> : <em>mixed</em> |
| public | <strong>getStart()</strong> : <em>mixed</em> |
| public | <strong>getTotal()</strong> : <em>mixed</em> |
| public | <strong>getTotalPages()</strong> : <em>mixed</em> |
| public | <strong>isEnabled()</strong> : <em>bool</em> |
| protected | <strong>calculateLimits()</strong> : <em>void</em> |
| protected | <strong>calculateRange()</strong> : <em>void</em> |
| protected | <strong>initialize(</strong><em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> <strong>$route</strong>, <em>\int</em> <strong>$total</strong>, <em>\int</em> <strong>$pos=null</strong>, <em>\int</em> <strong>$limit=null</strong>, <em>array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| protected | <strong>loadItems()</strong> : <em>mixed</em> |
| protected | <strong>setLimit(</strong><em>\int</em> <strong>$limit=null</strong>)</strong> : <em>\Grav\Framework\Pagination\$this</em> |
| protected | <strong>setOptions(</strong><em>array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| protected | <strong>setPage(</strong><em>\int</em> <strong>$page=null</strong>)</strong> : <em>void</em> |
| protected | <strong>setRoute(</strong><em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> <strong>$route</strong>)</strong> : <em>void</em> |
| protected | <strong>setStart(</strong><em>\int</em> <strong>$start=null</strong>)</strong> : <em>\Grav\Framework\Pagination\$this</em> |
| protected | <strong>setTotal(</strong><em>\int</em> <strong>$total</strong>)</strong> : <em>\Grav\Framework\Pagination\$this</em> |

*This class implements [\Grav\Framework\Pagination\Interfaces\PaginationInterface](#interface-gravframeworkpaginationinterfacespaginationinterface), \Traversable, \IteratorAggregate, \Countable*

<hr /><a id="interface-gravframeworkpaginationinterfacespaginationinterface"></a>
### Interface: \Grav\Framework\Pagination\Interfaces\PaginationInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>count()</strong> : <em>void</em> |
| public | <strong>getFirstPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count</strong>)</strong> : <em>mixed</em> |
| public | <strong>getLastPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count</strong>)</strong> : <em>mixed</em> |
| public | <strong>getLimit()</strong> : <em>mixed</em> |
| public | <strong>getNextNumber(</strong><em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getNextPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getOptions()</strong> : <em>mixed</em> |
| public | <strong>getPage(</strong><em>\int</em> <strong>$page</strong>, <em>\string</em> <strong>$label=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPageNumber()</strong> : <em>mixed</em> |
| public | <strong>getPrevNumber(</strong><em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPrevPage(</strong><em>\string</em> <strong>$label=null</strong>, <em>\int</em> <strong>$count=1</strong>)</strong> : <em>mixed</em> |
| public | <strong>getStart()</strong> : <em>mixed</em> |
| public | <strong>getTotal()</strong> : <em>mixed</em> |
| public | <strong>getTotalPages()</strong> : <em>mixed</em> |

*This class implements \Countable, \IteratorAggregate, \Traversable*

<hr /><a id="interface-gravframeworkpaginationinterfacespaginationpageinterface"></a>
### Interface: \Grav\Framework\Pagination\Interfaces\PaginationPageInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getLabel()</strong> : <em>mixed</em> |
| public | <strong>getNumber()</strong> : <em>mixed</em> |
| public | <strong>getOptions()</strong> : <em>mixed</em> |
| public | <strong>getUrl()</strong> : <em>mixed</em> |
| public | <strong>isActive()</strong> : <em>bool</em> |
| public | <strong>isEnabled()</strong> : <em>bool</em> |

<hr /><a id="class-gravframeworkpsr7abstracturi-abstract"></a>
### <strike>Class: \Grav\Framework\Psr7\AbstractUri (abstract)</strike>

> **DEPRECATED** 1.6 Using message PSR-7 decorators instead.

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

<hr /><a id="class-gravframeworkpsr7response"></a>
### Class: \Grav\Framework\Psr7\Response

> Class Response

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\int</em> <strong>$status=200</strong>, <em>array</em> <strong>$headers=array()</strong>, <em>string/null/\Grav\Framework\Psr7\resource/[\Grav\Framework\Psr7\Stream](#class-gravframeworkpsr7stream)Interface</em> <strong>$body=null</strong>, <em>\string</em> <strong>$version=`'1.1'`</strong>, <em>\string</em> <strong>$reason=null</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>string</em><br /><em>Convert response to string. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getBody()</strong> : <em>mixed</em> |
| public | <strong>getHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>mixed</em> |
| public | <strong>getHeaderLine(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>mixed</em> |
| public | <strong>getHeaders()</strong> : <em>mixed</em> |
| public | <strong>getProtocolVersion()</strong> : <em>mixed</em> |
| public | <strong>getReasonPhrase()</strong> : <em>mixed</em> |
| public | <strong>getResponse()</strong> : <em>\Psr\Http\Message\ResponseInterface</em><br /><em>Returns the decorated response. Since the underlying Response is immutable as well exposing it is not an issue, because it's state cannot be altered</em> |
| public | <strong>getStatusCode()</strong> : <em>mixed</em> |
| public | <strong>hasHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>bool</em> |
| public | <strong>isClientError()</strong> : <em>bool</em><br /><em>Is this response a client error? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isEmpty()</strong> : <em>bool</em><br /><em>Is this response empty? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isForbidden()</strong> : <em>bool</em><br /><em>Is this response forbidden? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isInformational()</strong> : <em>bool</em><br /><em>Is this response informational? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isNotFound()</strong> : <em>bool</em><br /><em>Is this response not Found? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isOk()</strong> : <em>bool</em><br /><em>Is this response OK? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isRedirect()</strong> : <em>bool</em><br /><em>Is this response a redirect? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isRedirection()</strong> : <em>bool</em><br /><em>Is this response a redirection? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isServerError()</strong> : <em>bool</em><br /><em>Is this response a server error? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isSuccessful()</strong> : <em>bool</em><br /><em>Is this response successful? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>withAddedHeader(</strong><em>mixed</em> <strong>$header</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>withBody(</strong><em>\Psr\Http\Message\StreamInterface</em> <strong>$body</strong>)</strong> : <em>void</em> |
| public | <strong>withHeader(</strong><em>mixed</em> <strong>$header</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>withJson(</strong><em>mixed</em> <strong>$data</strong>, <em>\int</em> <strong>$status=null</strong>, <em>\int</em> <strong>$options</strong>, <em>\int</em> <strong>$depth=512</strong>)</strong> : <em>\Grav\Framework\Psr7\static</em><br /><em>Json. Note: This method is not part of the PSR-7 standard. This method prepares the response object to return an HTTP Json response to the client.</em> |
| public | <strong>withProtocolVersion(</strong><em>mixed</em> <strong>$version</strong>)</strong> : <em>void</em> |
| public | <strong>withRedirect(</strong><em>\string</em> <strong>$url</strong>, <em>int/null</em> <strong>$status=null</strong>)</strong> : <em>\Grav\Framework\Psr7\static</em><br /><em>Redirect. Note: This method is not part of the PSR-7 standard. This method prepares the response object to return an HTTP Redirect response to the client.</em> |
| public | <strong>withResponse(</strong><em>\Psr\Http\Message\ResponseInterface</em> <strong>$response</strong>)</strong> : <em>\Grav\Framework\Psr7\self</em><br /><em>Exchanges the underlying response with another.</em> |
| public | <strong>withStatus(</strong><em>mixed</em> <strong>$code</strong>, <em>string</em> <strong>$reasonPhrase=`''`</strong>)</strong> : <em>void</em> |
| public | <strong>withoutHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\ResponseInterface, \Psr\Http\Message\MessageInterface*

<hr /><a id="class-gravframeworkpsr7stream"></a>
### Class: \Grav\Framework\Psr7\Stream

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$body=`''`</strong>)</strong> : <em>void</em> |
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>void</em> |
| public | <strong>close()</strong> : <em>void</em> |
| public | <strong>detach()</strong> : <em>void</em> |
| public | <strong>eof()</strong> : <em>void</em> |
| public | <strong>getContents()</strong> : <em>mixed</em> |
| public | <strong>getMetadata(</strong><em>mixed</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getSize()</strong> : <em>mixed</em> |
| public | <strong>isReadable()</strong> : <em>bool</em> |
| public | <strong>isSeekable()</strong> : <em>bool</em> |
| public | <strong>isWritable()</strong> : <em>bool</em> |
| public | <strong>read(</strong><em>mixed</em> <strong>$length</strong>)</strong> : <em>void</em> |
| public | <strong>rewind()</strong> : <em>void</em> |
| public | <strong>seek(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$whence</strong>)</strong> : <em>void</em> |
| public | <strong>tell()</strong> : <em>void</em> |
| public | <strong>write(</strong><em>mixed</em> <strong>$string</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\StreamInterface*

<hr /><a id="class-gravframeworkpsr7request"></a>
### Class: \Grav\Framework\Psr7\Request

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$method</strong>, <em>string/[\Grav\Framework\Psr7\Uri](#class-gravframeworkpsr7uri)Interface</em> <strong>$uri</strong>, <em>array</em> <strong>$headers=array()</strong>, <em>string/null/\Grav\Framework\Psr7\resource/[\Grav\Framework\Psr7\Stream](#class-gravframeworkpsr7stream)Interface</em> <strong>$body=null</strong>, <em>\string</em> <strong>$version=`'1.1'`</strong>)</strong> : <em>void</em> |
| public | <strong>getBody()</strong> : <em>mixed</em> |
| public | <strong>getHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>mixed</em> |
| public | <strong>getHeaderLine(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>mixed</em> |
| public | <strong>getHeaders()</strong> : <em>mixed</em> |
| public | <strong>getMethod()</strong> : <em>mixed</em> |
| public | <strong>getProtocolVersion()</strong> : <em>mixed</em> |
| public | <strong>getRequest()</strong> : <em>\Psr\Http\Message\RequestInterface</em><br /><em>Returns the decorated request. Since the underlying Request is immutable as well exposing it is not an issue, because it's state cannot be altered</em> |
| public | <strong>getRequestTarget()</strong> : <em>mixed</em> |
| public | <strong>getUri()</strong> : <em>mixed</em> |
| public | <strong>hasHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>bool</em> |
| public | <strong>withAddedHeader(</strong><em>mixed</em> <strong>$header</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>withBody(</strong><em>\Psr\Http\Message\StreamInterface</em> <strong>$body</strong>)</strong> : <em>void</em> |
| public | <strong>withHeader(</strong><em>mixed</em> <strong>$header</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>withMethod(</strong><em>mixed</em> <strong>$method</strong>)</strong> : <em>void</em> |
| public | <strong>withProtocolVersion(</strong><em>mixed</em> <strong>$version</strong>)</strong> : <em>void</em> |
| public | <strong>withRequest(</strong><em>\Psr\Http\Message\RequestInterface</em> <strong>$request</strong>)</strong> : <em>\Grav\Framework\Psr7\self</em><br /><em>Exchanges the underlying request with another.</em> |
| public | <strong>withRequestTarget(</strong><em>mixed</em> <strong>$requestTarget</strong>)</strong> : <em>void</em> |
| public | <strong>withUri(</strong><em>\Psr\Http\Message\UriInterface</em> <strong>$uri</strong>, <em>bool</em> <strong>$preserveHost=false</strong>)</strong> : <em>void</em> |
| public | <strong>withoutHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\RequestInterface, \Psr\Http\Message\MessageInterface*

<hr /><a id="class-gravframeworkpsr7uri"></a>
### Class: \Grav\Framework\Psr7\Uri

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$uri=`''`</strong>)</strong> : <em>void</em> |
| public | <strong>__toString()</strong> : <em>void</em> |
| public | <strong>getAuthority()</strong> : <em>mixed</em> |
| public | <strong>getFragment()</strong> : <em>mixed</em> |
| public | <strong>getHost()</strong> : <em>mixed</em> |
| public | <strong>getPath()</strong> : <em>mixed</em> |
| public | <strong>getPort()</strong> : <em>mixed</em> |
| public | <strong>getQuery()</strong> : <em>mixed</em> |
| public | <strong>getQueryParams()</strong> : <em>array</em> |
| public | <strong>getScheme()</strong> : <em>mixed</em> |
| public | <strong>getUserInfo()</strong> : <em>mixed</em> |
| public | <strong>isAbsolute()</strong> : <em>bool</em><br /><em>Whether the URI is absolute, i.e. it has a scheme. An instance of UriInterface can either be an absolute URI or a relative reference. This method returns true if it is the former. An absolute URI has a scheme. A relative reference is used to express a URI relative to another URI, the base URI. Relative references can be divided into several forms: - network-path references, e.g. '//example.com/path' - absolute-path references, e.g. '/path' - relative-path references, e.g. 'subpath'</em> |
| public | <strong>isAbsolutePathReference()</strong> : <em>bool</em><br /><em>Whether the URI is a absolute-path reference. A relative reference that begins with a single slash character is termed an absolute-path reference.</em> |
| public | <strong>isDefaultPort()</strong> : <em>bool</em><br /><em>Whether the URI has the default port of the current scheme. `$uri->getPort()` may return the standard port. This method can be used for some non-http/https Uri.</em> |
| public | <strong>isNetworkPathReference()</strong> : <em>bool</em><br /><em>Whether the URI is a network-path reference. A relative reference that begins with two slash characters is termed an network-path reference.</em> |
| public | <strong>isRelativePathReference()</strong> : <em>bool</em><br /><em>Whether the URI is a relative-path reference. A relative reference that does not begin with a slash character is termed a relative-path reference.</em> |
| public | <strong>isSameDocumentReference(</strong><em>[\Grav\Framework\Psr7\Uri](#class-gravframeworkpsr7uri)Interface/null/\Psr\Http\Message\UriInterface</em> <strong>$base=null</strong>)</strong> : <em>bool</em><br /><em>Whether the URI is a same-document reference. A same-document reference refers to a URI that is, aside from its fragment component, identical to the base URI. When no base URI is given, only an empty URI reference (apart from its fragment) is considered a same-document reference.</em> |
| public | <strong>withFragment(</strong><em>mixed</em> <strong>$fragment</strong>)</strong> : <em>void</em> |
| public | <strong>withHost(</strong><em>mixed</em> <strong>$host</strong>)</strong> : <em>void</em> |
| public | <strong>withPath(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>withPort(</strong><em>mixed</em> <strong>$port</strong>)</strong> : <em>void</em> |
| public | <strong>withQuery(</strong><em>mixed</em> <strong>$query</strong>)</strong> : <em>void</em> |
| public | <strong>withQueryParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>\Psr\Http\Message\UriInterface</em> |
| public | <strong>withScheme(</strong><em>mixed</em> <strong>$scheme</strong>)</strong> : <em>void</em> |
| public | <strong>withUserInfo(</strong><em>mixed</em> <strong>$user</strong>, <em>mixed</em> <strong>$password=null</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\UriInterface*

<hr /><a id="class-gravframeworkpsr7uploadedfile"></a>
### Class: \Grav\Framework\Psr7\UploadedFile

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Grav\Framework\Psr7\Stream](#class-gravframeworkpsr7stream)Interface/string/\Grav\Framework\Psr7\resource</em> <strong>$streamOrFile</strong>, <em>int</em> <strong>$size</strong>, <em>int</em> <strong>$errorStatus</strong>, <em>string/null</em> <strong>$clientFilename=null</strong>, <em>string/null</em> <strong>$clientMediaType=null</strong>)</strong> : <em>void</em> |
| public | <strong>getClientFilename()</strong> : <em>mixed</em> |
| public | <strong>getClientMediaType()</strong> : <em>mixed</em> |
| public | <strong>getError()</strong> : <em>mixed</em> |
| public | <strong>getSize()</strong> : <em>mixed</em> |
| public | <strong>getStream()</strong> : <em>mixed</em> |
| public | <strong>moveTo(</strong><em>mixed</em> <strong>$targetPath</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\UploadedFileInterface*

<hr /><a id="class-gravframeworkpsr7serverrequest"></a>
### Class: \Grav\Framework\Psr7\ServerRequest

> Class ServerRequest

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$method</strong>, <em>string/[\Grav\Framework\Psr7\Uri](#class-gravframeworkpsr7uri)Interface</em> <strong>$uri</strong>, <em>array</em> <strong>$headers=array()</strong>, <em>string/null/\Grav\Framework\Psr7\resource/[\Grav\Framework\Psr7\Stream](#class-gravframeworkpsr7stream)Interface</em> <strong>$body=null</strong>, <em>\string</em> <strong>$version=`'1.1'`</strong>, <em>array</em> <strong>$serverParams=array()</strong>)</strong> : <em>void</em> |
| public | <strong>getAttribute(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Retrieve a single derived request attribute. Retrieves a single derived request attribute as described in getAttributes(). If the attribute has not been previously set, returns the default value as provided. This method obviates the need for a hasAttribute() method, as it allows specifying a default value to return if the attribute is not found.</em> |
| public | <strong>getAttributes()</strong> : <em>array Attributes derived from the request.</em><br /><em>Retrieve attributes derived from the request. The request "attributes" may be used to allow injection of any parameters derived from the request: e.g., the results of path match operations; the results of decrypting cookies; the results of deserializing non-form-encoded message bodies; etc. Attributes will be application and request specific, and CAN be mutable.</em> |
| public | <strong>getBody()</strong> : <em>mixed</em> |
| public | <strong>getContentCharset()</strong> : <em>string/null</em><br /><em>Get serverRequest content character set, if known. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getContentLength()</strong> : <em>int/null</em><br /><em>Get serverRequest content length, if known. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getContentType()</strong> : <em>string/null The serverRequest content type, if known</em><br /><em>Get serverRequest content type. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getCookieParam(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Fetch cookie value from cookies sent by the client to the server. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getCookieParams()</strong> : <em>array</em><br /><em>Retrieve cookies. Retrieves cookies sent by the client to the server. The data MUST be compatible with the structure of the $_COOKIE superglobal.</em> |
| public | <strong>getHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>mixed</em> |
| public | <strong>getHeaderLine(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>mixed</em> |
| public | <strong>getHeaders()</strong> : <em>mixed</em> |
| public | <strong>getMediaType()</strong> : <em>string/null The serverRequest media type, minus content-type params</em><br /><em>Get serverRequest media type, if known. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getMediaTypeParams()</strong> : <em>mixed[]</em><br /><em>Get serverRequest media type params, if known. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getMethod()</strong> : <em>mixed</em> |
| public | <strong>getParam(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$default=null</strong>)</strong> : <em>mixed The parameter value.</em><br /><em>Fetch serverRequest parameter value from body or query string (in that order). Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getParams()</strong> : <em>mixed[]</em><br /><em>Fetch associative array of body and query string parameters. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getParsedBody()</strong> : <em>null/array/object The deserialized body parameters, if any. These will typically be an array or object.</em><br /><em>Retrieve any parameters provided in the request body. If the request Content-Type is either application/x-www-form-urlencoded or multipart/form-data, and the request method is POST, this method MUST return the contents of $_POST. Otherwise, this method may return any results of deserializing the request body content; as parsing returns structured content, the potential types MUST be arrays or objects only. A null value indicates the absence of body content.</em> |
| public | <strong>getParsedBodyParam(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Fetch parameter value from serverRequest body. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getProtocolVersion()</strong> : <em>mixed</em> |
| public | <strong>getQueryParam(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Fetch parameter value from query string. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getQueryParams()</strong> : <em>array</em><br /><em>Retrieve query string arguments. Retrieves the deserialized query string arguments, if any. Note: the query params might not be in sync with the URI or server params. If you need to ensure you are only getting the original values, you may need to parse the query string from `getUri()->getQuery()` or from the `QUERY_STRING` server param.</em> |
| public | <strong>getRequest()</strong> : <em>\Psr\Http\Message\ServerRequestInterface</em><br /><em>Returns the decorated request. Since the underlying Request is immutable as well exposing it is not an issue, because it's state cannot be altered</em> |
| public | <strong>getRequestTarget()</strong> : <em>mixed</em> |
| public | <strong>getServerParam(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Retrieve a server parameter. Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>getServerParams()</strong> : <em>array</em><br /><em>Retrieve server parameters. Retrieves data related to the incoming request environment, typically derived from PHP's $_SERVER superglobal. The data IS NOT REQUIRED to originate from $_SERVER.</em> |
| public | <strong>getUploadedFiles()</strong> : <em>array An array tree of UploadedFileInterface instances; an empty array MUST be returned if no data is present.</em><br /><em>Retrieve normalized file upload data. This method returns upload metadata in a normalized tree, with each leaf an instance of Psr\Http\Message\UploadedFileInterface. These values MAY be prepared from $_FILES or the message body during instantiation, or MAY be injected via withUploadedFiles().</em> |
| public | <strong>getUri()</strong> : <em>mixed</em> |
| public | <strong>hasHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>bool</em> |
| public | <strong>isDelete()</strong> : <em>bool</em><br /><em>Is this a DELETE serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isGet()</strong> : <em>bool</em><br /><em>Is this a GET serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isHead()</strong> : <em>bool</em><br /><em>Is this a HEAD serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isMethod(</strong><em>string</em> <strong>$method</strong>)</strong> : <em>bool</em><br /><em>Does this serverRequest use a given method? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isOptions()</strong> : <em>bool</em><br /><em>Is this a OPTIONS serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isPatch()</strong> : <em>bool</em><br /><em>Is this a PATCH serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isPost()</strong> : <em>bool</em><br /><em>Is this a POST serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isPut()</strong> : <em>bool</em><br /><em>Is this a PUT serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>isXhr()</strong> : <em>bool</em><br /><em>Is this an XHR serverRequest? Note: This method is not part of the PSR-7 standard.</em> |
| public | <strong>withAddedHeader(</strong><em>mixed</em> <strong>$header</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>withAttribute(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Psr\Http\Message\static</em><br /><em>Return an instance with the specified derived request attribute. This method allows setting a single derived request attribute as described in getAttributes(). This method MUST be implemented in such a way as to retain the immutability of the message, and MUST return an instance that has the updated attribute.</em> |
| public | <strong>withAttributes(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>void</em> |
| public | <strong>withBody(</strong><em>\Psr\Http\Message\StreamInterface</em> <strong>$body</strong>)</strong> : <em>void</em> |
| public | <strong>withCookieParams(</strong><em>array</em> <strong>$cookies</strong>)</strong> : <em>\Psr\Http\Message\static</em><br /><em>Return an instance with the specified cookies. The data IS NOT REQUIRED to come from the $_COOKIE superglobal, but MUST be compatible with the structure of $_COOKIE. Typically, this data will be injected at instantiation. This method MUST NOT update the related Cookie header of the request instance, nor related values in the server params. This method MUST be implemented in such a way as to retain the immutability of the message, and MUST return an instance that has the updated cookie values.</em> |
| public | <strong>withHeader(</strong><em>mixed</em> <strong>$header</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>withMethod(</strong><em>mixed</em> <strong>$method</strong>)</strong> : <em>void</em> |
| public | <strong>withParsedBody(</strong><em>null/array/object</em> <strong>$data</strong>)</strong> : <em>\Psr\Http\Message\static</em><br /><em>Return an instance with the specified body parameters. These MAY be injected during instantiation. If the request Content-Type is either application/x-www-form-urlencoded or multipart/form-data, and the request method is POST, use this method ONLY to inject the contents of $_POST. The data IS NOT REQUIRED to come from $_POST, but MUST be the results of deserializing the request body content. Deserialization/parsing returns structured data, and, as such, this method ONLY accepts arrays or objects, or a null value if nothing was available to parse. As an example, if content negotiation determines that the request data is a JSON payload, this method could be used to create a request instance with the deserialized parameters. This method MUST be implemented in such a way as to retain the immutability of the message, and MUST return an instance that has the updated body parameters. typically be in an array or object.</em> |
| public | <strong>withProtocolVersion(</strong><em>mixed</em> <strong>$version</strong>)</strong> : <em>void</em> |
| public | <strong>withQueryParams(</strong><em>array</em> <strong>$query</strong>)</strong> : <em>\Psr\Http\Message\static</em><br /><em>Return an instance with the specified query string arguments. These values SHOULD remain immutable over the course of the incoming request. They MAY be injected during instantiation, such as from PHP's $_GET superglobal, or MAY be derived from some other value such as the URI. In cases where the arguments are parsed from the URI, the data MUST be compatible with what PHP's parse_str() would return for purposes of how duplicate query parameters are handled, and how nested sets are handled. Setting query string arguments MUST NOT change the URI stored by the request, nor the values in the server params. This method MUST be implemented in such a way as to retain the immutability of the message, and MUST return an instance that has the updated query string arguments. $_GET.</em> |
| public | <strong>withRequest(</strong><em>\Psr\Http\Message\RequestInterface</em> <strong>$request</strong>)</strong> : <em>\Grav\Framework\Psr7\self</em><br /><em>Exchanges the underlying request with another.</em> |
| public | <strong>withRequestTarget(</strong><em>mixed</em> <strong>$requestTarget</strong>)</strong> : <em>void</em> |
| public | <strong>withUploadedFiles(</strong><em>array</em> <strong>$uploadedFiles</strong>)</strong> : <em>\Psr\Http\Message\static</em><br /><em>Create a new instance with the specified uploaded files. This method MUST be implemented in such a way as to retain the immutability of the message, and MUST return an instance that has the updated body parameters.</em> |
| public | <strong>withUri(</strong><em>\Psr\Http\Message\UriInterface</em> <strong>$uri</strong>, <em>bool</em> <strong>$preserveHost=false</strong>)</strong> : <em>void</em> |
| public | <strong>withoutAttribute(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Psr\Http\Message\static</em><br /><em>Return an instance that removes the specified derived request attribute. This method allows removing a single derived request attribute as described in getAttributes(). This method MUST be implemented in such a way as to retain the immutability of the message, and MUST return an instance that removes the attribute.</em> |
| public | <strong>withoutHeader(</strong><em>mixed</em> <strong>$header</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Message\ServerRequestInterface, \Psr\Http\Message\MessageInterface, \Psr\Http\Message\RequestInterface*

<hr /><a id="class-gravframeworkrequesthandlerrequesthandler"></a>
### Class: \Grav\Framework\RequestHandler\RequestHandler

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$middleware</strong>, <em>\callable</em> <strong>$default</strong>, <em>\Grav\Framework\RequestHandler\ContainerInterface/null/\Psr\Container\ContainerInterface</em> <strong>$container=null</strong>)</strong> : <em>void</em><br /><em>Delegate constructor.</em> |
| public | <strong>addCallable(</strong><em>\string</em> <strong>$name</strong>, <em>\callable</em> <strong>$callable</strong>)</strong> : <em>\Grav\Framework\RequestHandler\$this</em><br /><em>Add callable initializing Middleware that will be executed as soon as possible.</em> |
| public | <strong>addMiddleware(</strong><em>\string</em> <strong>$name</strong>, <em>\Psr\Http\Server\MiddlewareInterface</em> <strong>$middleware</strong>)</strong> : <em>\Grav\Framework\RequestHandler\$this</em><br /><em>Add Middleware that will be executed as soon as possible.</em> |
| public | <strong>handle(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Server\RequestHandlerInterface*

<hr /><a id="class-gravframeworkrequesthandlerexceptionnotfoundexception"></a>
### Class: \Grav\Framework\RequestHandler\Exception\NotFoundException

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Throwable/null/\Throwable</em> <strong>$previous=null</strong>)</strong> : <em>void</em><br /><em>NotFoundException constructor.</em> |
| public | <strong>getRequest()</strong> : <em>mixed</em> |

*This class extends [\Grav\Framework\RequestHandler\Exception\RequestException](#class-gravframeworkrequesthandlerexceptionrequestexception)*

*This class implements \Throwable*

<hr /><a id="class-gravframeworkrequesthandlerexceptionpageexpiredexception"></a>
### Class: \Grav\Framework\RequestHandler\Exception\PageExpiredException

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Throwable/null/\Throwable</em> <strong>$previous=null</strong>)</strong> : <em>void</em><br /><em>PageExpiredException constructor.</em> |

*This class extends [\Grav\Framework\RequestHandler\Exception\RequestException](#class-gravframeworkrequesthandlerexceptionrequestexception)*

*This class implements \Throwable*

<hr /><a id="class-gravframeworkrequesthandlerexceptionnothandledexception"></a>
### Class: \Grav\Framework\RequestHandler\Exception\NotHandledException

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Grav\Framework\RequestHandler\Exception\NotFoundException](#class-gravframeworkrequesthandlerexceptionnotfoundexception)*

*This class implements \Throwable*

<hr /><a id="class-gravframeworkrequesthandlerexceptioninvalidargumentexception"></a>
### Class: \Grav\Framework\RequestHandler\Exception\InvalidArgumentException

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$message=`''`</strong>, <em>mixed/null</em> <strong>$invalidMiddleware=null</strong>, <em>int</em> <strong>$code</strong>, <em>\Grav\Framework\RequestHandler\Exception\Throwable/null/\Throwable</em> <strong>$previous=null</strong>)</strong> : <em>void</em><br /><em>InvalidArgumentException constructor.</em> |
| public | <strong>getInvalidMiddleware()</strong> : <em>mixed/null</em><br /><em>Return the invalid middleware</em> |

*This class extends \InvalidArgumentException*

*This class implements \Throwable*

<hr /><a id="class-gravframeworkrequesthandlerexceptionrequestexception"></a>
### Class: \Grav\Framework\RequestHandler\Exception\RequestException

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\string</em> <strong>$message</strong>, <em>\int</em> <strong>$code=500</strong>, <em>\Throwable/null/\Throwable</em> <strong>$previous=null</strong>)</strong> : <em>void</em> |
| public | <strong>getHttpCode()</strong> : <em>mixed</em> |
| public | <strong>getHttpReason()</strong> : <em>mixed</em> |
| public | <strong>getRequest()</strong> : <em>\Psr\Http\Message\ServerRequestInterface</em> |

*This class extends \RuntimeException*

*This class implements \Throwable*

<hr /><a id="class-gravframeworkrequesthandlermiddlewaresexceptions"></a>
### Class: \Grav\Framework\RequestHandler\Middlewares\Exceptions

| Visibility | Function |
|:-----------|:---------|
| public | <strong>process(</strong><em>\Psr\Http\Message\ServerRequestInterface</em> <strong>$request</strong>, <em>\Psr\Http\Server\RequestHandlerInterface</em> <strong>$handler</strong>)</strong> : <em>void</em> |

*This class implements \Psr\Http\Server\MiddlewareInterface*

<hr /><a id="class-gravframeworkrouteroute"></a>
### Class: \Grav\Framework\Route\Route

> Implements Grav Route.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$parts=array()</strong>)</strong> : <em>void</em><br /><em>You can use `RouteFactory` functions to create new `Route` objects.</em> |
| public | <strike><strong>__toString()</strong> : <em>string</em></strike><br /><em>DEPRECATED - 1.6 Use ->toString(true) or ->getUri() instead.</em> |
| public | <strong>getExtension()</strong> : <em>string</em> |
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
| public | <strong>toString(</strong><em>\bool</em> <strong>$includeRoot=false</strong>)</strong> : <em>string</em> |
| public | <strong>withAddedPath(</strong><em>string</em> <strong>$path</strong>)</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| public | <strong>withExtension(</strong><em>string</em> <strong>$extension</strong>)</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| public | <strong>withGravParam(</strong><em>string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| public | <strong>withQueryParam(</strong><em>string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Grav\Framework\Route\Route](#class-gravframeworkrouteroute)</em> |
| public | <strong>withRoot(</strong><em>string</em> <strong>$root</strong>)</strong> : <em>\Grav\Framework\Route\$this</em><br /><em>Allow the ability to set the root to something else</em> |
| public | <strong>withRoute(</strong><em>string</em> <strong>$route</strong>)</strong> : <em>\Grav\Framework\Route\$this</em><br /><em>Allow the ability to set the route to something else</em> |
| public | <strong>withoutGravParams()</strong> : <em>void</em> |
| public | <strong>withoutParams()</strong> : <em>void</em> |
| public | <strong>withoutQueryParams()</strong> : <em>void</em> |
| protected | <strong>copy()</strong> : <em>void</em> |
| protected | <strong>getUriPath(</strong><em>bool</em> <strong>$includeRoot=false</strong>)</strong> : <em>string</em> |
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
| public | <strong>isStarted()</strong> : <em>bool</em><br /><em>Checks if the session was started.</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session ID</em> |
| public | <strong>setName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session name</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Sets session.* ini variables.</em> |
| public | <strong>start(</strong><em>bool</em> <strong>$readonly=false</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Starts the session storage</em> |
| protected | <strong>isSessionStarted()</strong> : <em>bool</em><br /><em>http://php.net/manual/en/function.session-status.php#113468 Check if session is started nicely.</em> |
| protected | <strong>setOption(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |

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
| public | <strong>isStarted()</strong> : <em>bool</em><br /><em>Checks if the session was started.</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session ID</em> |
| public | <strong>setName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Set session name</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Sets session.* ini variables.</em> |
| public | <strong>start(</strong><em>bool</em> <strong>$readonly=false</strong>)</strong> : <em>\Grav\Framework\Session\$this</em><br /><em>Starts the session storage</em> |

*This class implements \IteratorAggregate, \Traversable*

<hr /><a id="class-gravframeworksessionexceptionssessionexception"></a>
### Class: \Grav\Framework\Session\Exceptions\SessionException

| Visibility | Function |
|:-----------|:---------|

*This class extends \RuntimeException*

*This class implements \Throwable*

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

<hr /><a id="class-gravinstallerinstall"></a>
### Class: \Grav\Installer\Install

> Grav installer. NOTE: This class can be initialized during upgrade from an older version of Grav. Make sure it runs there!

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__invoke(</strong><em>\string</em> <strong>$zip</strong>)</strong> : <em>void</em> |
| public | <strong>checkRequirements()</strong> : <em>array List of failed requirements. If the list is empty, installation can go on.</em><br /><em>NOTE: This method can only be called after $grav['plugins']->init().</em> |
| public | <strong>finalize()</strong> : <em>void</em> |
| public | <strong>install()</strong> : <em>void</em> |
| public static | <strong>instance()</strong> : <em>void</em> |
| public | <strong>prepare()</strong> : <em>void</em> |
| public | <strong>setZip(</strong><em>\string</em> <strong>$zip</strong>)</strong> : <em>void</em> |
| protected | <strong>checkPlugins(</strong><em>mixed</em> <strong>$results</strong>, <em>array</em> <strong>$plugins</strong>)</strong> : <em>void</em> |
| protected | <strong>checkVersion(</strong><em>mixed</em> <strong>$results</strong>, <em>mixed</em> <strong>$type</strong>, <em>mixed</em> <strong>$name</strong>, <em>array</em> <strong>$check</strong>, <em>mixed</em> <strong>$version</strong>)</strong> : <em>void</em> |

