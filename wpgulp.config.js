/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

// General options.
const projectURL      = 'http://localhost/tmw-whatsapp';
const productURL      = './';
const browserAutoOpen = false;
const injectChanges   = true;
const outputStyle     = 'compressed';
const errLogToConsole = true;
const precision       = 10;

// Styles to process.
const styles = [
	{
		name: 'admin',
		src: './assets/sass/admin/admin.scss',
		destination: './assets/css/',
		file: 'tmw-whatsapp-admin'
	},
	{
		name: 'app',
		src: './assets/sass/admin/app.scss',
		destination: './assets/css/',
		file: 'tmw-whatsapp-app'
	},
	{
		name: 'wpbakery',
		src: './assets/sass/admin/wpbakery.scss',
		destination: './assets/css/',
		file: 'tmw-whatsapp-wpbakery'
	},
];

// Scripts to process.
const scripts = [
	{
		name: 'admin',
		src: './assets/js/src/admin.js',
		destination: './assets/js/',
		file: 'tmw-whatsapp-admin',
	},
	{
		name: 'app',
		src: './assets/js/src/app.js',
		destination: './assets/js/',
		file: 'tmw-whatsapp-app',
	},
	{
		name: 'widgets',
		src: './assets/js/src/widgets.js',
		destination: './assets/js/',
		file: 'tmw-whatsapp-widgets',
	},
];

// Watch options.
const watchStyles  = './assets/sass/**/*.scss';
const watchScripts = './assets/js/src/**/*.js';
const watchPhp     = './**/*.php';

// Zip options.
const zipName = 'tmw-whatsapp.zip';
const zipDestination = './../'; // Default: Parent folder.
const zipIncludeGlob = ['../@(tmw-whatsapp)/**/*'];
const zipIgnoreGlob = [
	'!**/*{node_modules,node_modules/**/*}',
	'!**/*.git',
	'!**/*.svn',
	'!**/*.code-workspace',
	'!**/*phpcs.xml',
	'!**/*gulpfile.babel.js',
	'!**/*wpgulp.config.js',
	'!**/*.eslintrc.js',
	'!**/*.eslintignore',
	'!**/*.editorconfig',
	'!**/*phpcs.xml.dist',
	'!**/*vscode',
	'!**/*package.json',
	'!**/*package-lock.json',
	'!**/*assets/img/raw/**/*',
	'!**/*assets/img/raw',
	'!**/*assets/js/src/**/*',
	'!**/*assets/js/src',
	'!**/*assets/sass/',
	'!**/*assets/sass/**/*',
	'!**/*composer.json',
	'!**/*composer.lock',
	'!**/*phpcs.xml',
	'!{vendor,vendor/**/*}',
	'!**/*.map',
	'!**/*tests/**/*',
	'!**/*tests',
	'!**/*e2etests/**/*',
	'!**/*e2etests',
	'!**/*playwright-report/**/*',
	'!**/*playwright-report',
	'!**/*test-results/**/*',
	'!**/*test-results',
	'!**/*playwright.config.js',
	'!{Design,Design/**/*}',
	'!{Documentation,Documentation/**/*}',
];

// Translation options.
const textDomain = 'tmw-whatsapp';
const translationFile = 'tmw-whatsapp.pot';
const translationDestination = './languages';

// Others.
const packageName = 'tmw-whatsapp';
const bugReport = 'https://github.com/maaprote/';
const lastTranslator = 'Rodrigo Teixeira';
const team = 'Rodrigo Teixeira';
const BROWSERS_LIST = ['last 2 version', '> 1%'];

// Export.
module.exports = {

	// General options.
	projectURL,
	productURL,
	browserAutoOpen,
	injectChanges,
	outputStyle,
	errLogToConsole,
	precision,

	// Style options.
	styles,

	// Script options.
	scripts,

	// Watch options.
	watchStyles,
	watchScripts,
	watchPhp,

	// Zip options.
	zipName,
	zipDestination,
	zipIncludeGlob,
	zipIgnoreGlob,

	// Translation options.
	textDomain,
	translationFile,
	translationDestination,

	// Others.
	packageName,
	bugReport,
	lastTranslator,
	team,
	BROWSERS_LIST,

};