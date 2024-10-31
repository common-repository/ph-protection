<?php
$home_url = home_url( '/' );
if ( defined( 'PHPROT_DEBUG' ) && PHPROT_DEBUG && defined( 'PHPROT_DEBUG_HOMEURL' ) ) {
	$home_url = PHPROT_DEBUG_HOMEURL;
}
$home_url_scheme = explode( ":", $home_url )[0];
$home_url = explode( "/", $home_url )[2];
$home_url = explode( ":", $home_url )[0];
$home_urls = explode( ".", $home_url );


//In order to prevent the falsification of the link URL by unauthorized proxy server, it has to be output directly.
//不正なプロキシサーバによるリンクURLの改竄を防止する目的で、直接出力するようにしています。
?>
<script>
/*
 Proxy Hacking Protection (c) 2015 Pocket Systems. | psn.hatenablog.jp
*/

window.Htnpsne=window.Htnpsne||{};Htnpsne.SiteCheck=Htnpsne.SiteCheck||{};
Htnpsne.SiteCheck.q=[{0:"uriList",1:[{"uriScheme":"<?php echo $home_url_scheme; ?>","hostName":<?php echo json_encode( $home_urls ); ?>}]}];

(function(){function f(c){!1===c instanceof Array&&(c=[]);for(var b=0;b<c.length;b++)switch(c[b][0]){case "uriList":for(d=c[b][1],b=0;b<d.length;b++)d[b].hostName=d[b].hostName.join(".")}if("undefined"===typeof d[0]||"undefined"===typeof d[0].hostName)console.log("\u8a2d\u5b9a\u304c\u3042\u308a\u307e\u305b\u3093");else{c="";for(i=0;i<d.length;i++){var b=d[i].hostName,a=location.hostname;window!=parent&&(a=document.referrer.split("/")[2].split(":")[0]);if(0!==b.indexOf(a))c=""===c?d[i]:c;else{c="";
break}}if(c){b=document.createElement("meta");b.name="robots";b.content="noindex";document.getElementsByTagName("head")[0].appendChild(b);b=document.createElement("div");a:{for(var a=document.getElementsByTagName("link"),e=0;e<a.length;e++)if("canonical"===a[e].getAttribute("rel")){a=a[e].getAttribute("href");break a}a=""}a=a.split(c.hostName)[1];if(!a){a:{a=document.getElementsByTagName("meta");for(i=0;i<a.length;i++)if("og:url"==a[i].getAttribute("property")){a=a[i].getAttribute("content");break a}a=
""}a=a.split(c.hostName)[1]}a||(a="");b.innerHTML='<div class="error-box" style="position: fixed; top: 40px; left: 30px; font-size: 1.5em; z-index: 800000; line-height: 1.1; color: #3A3A3A; padding: 0.8em; margin: 0.5em 0 1em; background-color: rgba(249, 234, 234, 0.85); border-left: 5px solid #E83731;"><a href="'+(c.uriScheme+"://"+c.hostName+a)+'" target="_top">\u3053\u306e\u30da\u30fc\u30b8\u306f\u30ad\u30e3\u30c3\u30b7\u30e5\u3055\u308c\u3066\u3044\u308b\u53ef\u80fd\u6027\u304c\u3042\u308a\u307e\u3059\u3002<br>\u8a18\u4e8b\u306e\u6700\u65b0\u7248\u306f\u3053\u3061\u3089\u304b\u3089</a>'+
g+"</div>";document.getElementsByTagName("body").item(0).appendChild(b)}}}var g='<div style="font-size: .7em;text-align: right;"><a href="'+function(c,b){return c.join(b)}("http: // psn .hatenablog .jp /entry/proxy-hacking-protection".split(" "),"")+'" target="_blank">by Proxy Hacking Protection</a></div>',d=[];"uninitialized"==document.readyState||"loading"==document.readyState?window.addEventListener("DOMContentLoaded",function(){f(Htnpsne.SiteCheck.q)},!1):f(Htnpsne.SiteCheck.q)})();
</script>
<?php
if ( defined( 'PHPROT_DEBUG' ) && PHPROT_DEBUG ) {
	// debug-start working-test
	?>
<style>
body {
	border: 5px solid #F00;
}
</style>
<?php
	// debug-end working-test
}
