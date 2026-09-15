// SDK live (sdk-main.js, di-serve di /livechat/sdk) membaca window.chatwootSettings,
// BUKAN window.ocanelSettings/omnigoSettings -- nama field di dalamnya (locale/type/
// position/launcherTitle) tetap sama, cuma pembungkusnya yang salah nama sebelum ini.
window.chatwootSettings = {
	locale: ocanel_widget_locale,
	type: ocanel_widget_type,
	position: ocanel_widget_position,
	launcherTitle: ocanel_launcher_text,
};

(function (d, t) {
	var g = d.createElement(t),
		s = d.getElementsByTagName(t)[0];
	g.async = !0;
	g.defer = !0;
	g.src = ocanel_url + "/livechat/js";
	s.parentNode.insertBefore(g, s);
	g.onload = function () {
		window.ocanelSDK.run({
			websiteToken: ocanel_token,
			baseUrl: ocanel_url,
		});
	};
})(document, "script");
